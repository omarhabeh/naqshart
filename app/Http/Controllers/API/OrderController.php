<?php

namespace App\Http\Controllers\API;

use App\Order;

use  App\Models\Palette;

use  App\Models\Discount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderResquest;
use Illuminate\Support\Facades\Validator;
use App\Rules\instock;
use Illuminate\Support\Facades\Mail;
use App\Mail\orderMail;
use App\Mail\artistOrderMail;
use Session;
use Illuminate\Support\Str;
class OrderController extends Controller
{
    public $shippment_price = 0;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }


    public function get_server_ip() {
        $ipaddress = '';
        if (env('HTTP_CLIENT_IP'))
            $ipaddress = env('HTTP_CLIENT_IP');
        else if(env('HTTP_X_FORWARDED_FOR'))
            $ipaddress = env('HTTP_X_FORWARDED_FOR');
        else if(env('HTTP_X_FORWARDED'))
            $ipaddress = env('HTTP_X_FORWARDED');
        else if(env('HTTP_FORWARDED_FOR'))
            $ipaddress = env('HTTP_FORWARDED_FOR');
        else if(env('HTTP_FORWARDED'))
        $ipaddress = env('HTTP_FORWARDED');
        else if(env('REMOTE_ADDR'))
            $ipaddress = env('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function urwa_create(OrderResquest $request){
    $this->shippment_price = $request->shippment_res;
    $totalprice = $this->totalprice($request->items, $request->promocode);
    $request['paymentstatus'] = 'pending';
    $request['totalprice'] =  $totalprice['totalprice'] + $this->shippment_price;;
    $request['discount'] = $totalprice['discount_amount'];
    $request['shippment'] = $request->shippment_res;
    $order = Order::create($request->only(['promocode', 'email', 'fname', 'lname', 'address', 'apartment', 'city', 'postcode', 'goverment', 'country', 'goverment', 'country', 'phone', 'phonecode', 'paymentid', 'paymentstatus', 'discount', 'totalprice', 'payment-transaction-return']));
    $palletes = $this->save_order_items($order, $totalprice['baletteitems']);
    $idorder =  $order->id;//Customer Order ID
    $terminalId = "naqshart";// Will be provided by URWAY
    $password = "naqshart@URWAY_123";// Will be provided by URWAY
    $merchant_key = "fb3742da128af60853970790ddc8c9705cc74e9e68946b283e086ac10004e54f";// Will be provided by URWAY
    $currencycode = "SAR";
    $amount = $request['totalprice'];
    $ipp = $this->get_server_ip();
    $txn_details= $idorder.'|'.$terminalId.'|'.$password.'|'.$merchant_key.'|'.$amount.'|'.$currencycode;
    $hash=hash('sha256', $txn_details);
    $fields = array(
        'trackid' => $idorder,
        'terminalId' => $terminalId,
        'customerEmail' => $request['email'],
        'action' => "1",  // action is always 1
        'merchantIp' =>$ipp,
        'password'=> $password,
        'currency' => $currencycode,
        'country'=>"SA",
        'amount' => $amount,
        "udf1" =>"Test1",
        "udf2" =>"https://naqshart.com/api/success",  //Response page URL
        "udf3"=>"",
        "udf4"=>"",
        "udf5"=>json_decode($request),
        'requestHash' => $hash  //generated Hash
    );
    $data = json_encode($fields);
    $ch=curl_init('https://payments.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest'); // Will be provided by URWAY
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
       'Content-Type: application/json',
       'Content-Length: ' . strlen($data))
      );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $server_output =curl_exec($ch);
    //close connection
    curl_close($ch);
    $result = json_decode($server_output);
    if (!empty($result->payid) && !empty($result->targetUrl)) {
       $url = $result->targetUrl . '?paymentid=' .  $result->payid;
        return response()->json(['url'=>$url]);

    }else{
    return response()->json(['error'=>$result->result,'reason'=>$result->reason]);
    }
    }

    public function success(Request $request){
        $terminalId = "naqshart";// Will be provided by URWAY
        $password = "naqshart@URWAY_1233";// Will be provided by URWAY
        $key = "fb3742da128af60853970790ddc8c9705cc74e9e68946b283e086ac10004e54f";// Will be provided by URWAY
        $keys['small'] = "S_avalible";
        $keys['medium'] = 'M_avalible';
        $keys['large'] = 'L_avalible';
        $order=Order::with('items')->where('id',$request->TrackId)->first();
        $requestHash = "" . $request->TranId . "|" . $key . "|" . $request->ResponseCode . "|" . $request->amount . "";
	    $txn_details1 = "" . $request->TrackId . "|" . $terminalId . "|" . $password . "|" . $key . "|" . $request->amount . "|SAR";
        $hash = hash('sha256', $requestHash);
        if ($hash === $request->responseHash) {
            $txn_details1 = "" . $request->TrackId . "|" . $terminalId . "|" . $password . "|" . $key . "|" . $request->amount . "|SAR";
            //Secure check
            $requestHash1 = hash('sha256', $txn_details1);
            $apifields    = array(
                'trackid' => $request->TrackId,
                'terminalId' => $terminalId,
                'action' => '10',
                'merchantIp' => "",
                'password' => $password,
                'currency' => "SAR",
                'transid' => "",
                'transid' => $request->TranId,
                'amount' => $request->amount,
                'udf5' => "",
                'udf3' => "",
                "udf4"=>"",
                'udf1' => "",
                'udf2' => "",
                'requestHash' => $requestHash1
            );
            $apifields_string = json_encode($apifields);
            $url = "https://payments.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest";
            $ch  = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $apifields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($apifields_string)
            ));
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            $apiresult = curl_exec($ch);
            $urldecodeapi        = (json_decode($apiresult, true));
            $inquiryResponsecode = $urldecodeapi['responseCode'];
            $inquirystatus       = $urldecodeapi['result'];
            $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
            if (Str::contains($request->Result,'Succ')  && $request->ResponseCode==='000') {
                if($inquirystatus=='Successful' || $inquiryResponsecode=='000'){
                    $palettes = collect();
                    $responseData = collect();
                    $responseData->last4Digits=substr($request->maskedPAN,-4);
                    $responseData->amount=$request->amount;
                    $responseData->payment_method=$request->cardBrand;
                    $responseData->currency='SAR';
                    $pallete_price = 0;
                    foreach ($order->items as  $item) {
                        $palette  =  Palette::find($item->palatte_id);
                        $palettes->push($palette);
                        $palette_arr = $palette->toArray();
                        $quantity_left =  $palette_arr[$keys[$item->size]];
                        $sub = $quantity_left - $item->quantity;
                        $subcopies = $palette->avalible_copies -  $item->quantity;
                        $palette->update([$keys[$item->size] => $sub, 'avalible_copies' => $subcopies]);
                        if(!$pageWasRefreshed) {
                            Mail::to($palette->artistemail)->send(new artistOrderMail($palette));
                         }
                        $pallete_price += $item->price;
                    }
                    if(!$pageWasRefreshed) {
                        Mail::to($order->email)->send(new orderMail($responseData,$order,$palettes,$pallete_price));
                        Mail::to('hello@naqshart.com')->send(new orderMail($responseData,$order,$palettes,$pallete_price));
                    }
                    $order->update(['paymentstatus' => 'Processing']);
                    return view('checkout.success', ['data' => $responseData, 'order'=>$order,'palettes'=>$palettes,'shipment'=>$this->shippment_price]);
                }
                else {
                    $order->update(['paymentstatus' => 'Failed']);
                    return view('checkout.error', ['msg' => 'Secure Check Failed']);
                }
            }
        }
        else{
            $order->update(['paymentstatus' => 'Failed']);
            return view('checkout.error', ['msg' => 'Hash Mismatch, please contat us']);
        }
        $order->update(['paymentstatus' => 'Failed']);
        return view('checkout.error', ['msg' => 'error accured please contact us']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }
    public function totalprice($arr = null, $promocode = null)
    {
        $retarr['totalprice'] = 0;
        $retarr['items'] = [];
        $retarr['discount_amount'] = null;

        $retarr['baletteitems'] = [];
        $key['small'] = "S_price";
        $key['medium'] = 'M_price';
        $key['large'] = 'L_price';


        foreach ($arr as &$item) {
            $palette =   Palette::find($item['paletteid']);
            if ($palette) {
                $price = $palette->M_price_sar;
                $retarr['totalprice'] += $price * $item['quantity'];
                $palette_items_data['size'] = $item['palettesize'];
                $palette_items_data['price'] = strval($price);
                $palette_items_data['quantity'] = strval($item['quantity']);
                $palette_items_data['id'] = $palette->id;
                array_push($retarr['baletteitems'], $palette_items_data);
            }
        }

        if ($promocode) {
            $discount = Discount::where('code', '=', $promocode)->first();
            if ($discount) {
                $discount =  $discount->discount_percentage;
                $discount_amount =  $retarr['totalprice'] * ($discount / 100);

                $retarr['totalprice'] =   $retarr['totalprice'] -  $discount_amount;
                $retarr['discount_amount'] =  $discount;
            }
        }
        return $retarr;
        return count($arr);
    }

    public function save_order_items($order = null, $arr = null)
    {
        $retarr = [];
        if ($order) {
            foreach ($arr as &$palette_items_data) {

                $orderitem = $order->items()->create(['size' => $palette_items_data['size'], 'price' => $palette_items_data['price'], 'quantity' => $palette_items_data['quantity'], 'palatte_id' => $palette_items_data['id']]);
                array_push($retarr, $orderitem);
            }
            return $retarr;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
    private function getCountryCode($country)
    {
        $json = '
                    [
                    {
                        "name": "Belarus",
                        "code": "BY"
                    },
                    {
                        "name": "Belgium",
                        "code": "BE"
                    },
                    {
                        "name": "Belize",
                        "code": "BZ"
                    },
                    {
                        "name": "Benin",
                        "code": "BJ"
                    },
                    {
                        "name": "Bermuda",
                        "code": "BM"
                    },
                    {
                        "name": "Bhutan",
                        "code": "BT"
                    },
                    {
                        "name": "Bolivia",
                        "code": "BO"
                    },
                    {
                        "name": "Bosnia and Herzegovina",
                        "code": "BA"
                    },
                    {
                        "name": "Botswana",
                        "code": "BW"
                    },
                    {
                        "name": "Bouvet Island",
                        "code": "BV"
                    },
                    {
                        "name": "Brazil",
                        "code": "BR"
                    },
                    {
                        "name": "British Indian Ocean Territory",
                        "code": "IO"
                    },
                    {
                        "name": "Brunei Darussalam",
                        "code": "BN"
                    },
                    {
                        "name": "Bulgaria",
                        "code": "BG"
                    },
                    {
                        "name": "Burkina Faso",
                        "code": "BF"
                    },
                    {
                        "name": "Burundi",
                        "code": "BI"
                    },
                    {
                        "name": "Cambodia",
                        "code": "KH"
                    },
                    {
                        "name": "Cameroon",
                        "code": "CM"
                    },
                    {
                        "name": "Canada",
                        "code": "CA"
                    },
                    {
                        "name": "Cape Verde",
                        "code": "CV"
                    },
                    {
                        "name": "Cayman Islands",
                        "code": "KY"
                    },
                    {
                        "name": "Central African Republic",
                        "code": "CF"
                    },
                    {
                        "name": "Chad",
                        "code": "TD"
                    },
                    {
                        "name": "Chile",
                        "code": "CL"
                    },
                    {
                        "name": "China",
                        "code": "CN"
                    },
                    {
                        "name": "Christmas Island",
                        "code": "CX"
                    },
                    {
                        "name": "Cocos (Keeling) Islands",
                        "code": "CC"
                    },
                    {
                        "name": "Colombia",
                        "code": "CO"
                    },
                    {
                        "name": "Comoros",
                        "code": "KM"
                    },
                    {
                        "name": "Congo",
                        "code": "CG"
                    },
                    {
                        "name": "Congo, Democratic Republic",
                        "code": "CD"
                    },
                    {
                        "name": "Cook Islands",
                        "code": "CK"
                    },
                    {
                        "name": "Costa Rica",
                        "code": "CR"
                    },
                    {
                        "name": "Cote D\"Ivoire",
                        "code": "CI"
                    },
                    {
                        "name": "Croatia",
                        "code": "HR"
                    },
                    {
                        "name": "Cuba",
                        "code": "CU"
                    },
                    {
                        "name": "Cyprus",
                        "code": "CY"
                    },
                    {
                        "name": "Czech Republic",
                        "code": "CZ"
                    },
                    {
                        "name": "Denmark",
                        "code": "DK"
                    },
                    {
                        "name": "Djibouti",
                        "code": "DJ"
                    },
                    {
                        "name": "Dominica",
                        "code": "DM"
                    },
                    {
                        "name": "Dominican Republic",
                        "code": "DO"
                    },
                    {
                        "name": "Ecuador",
                        "code": "EC"
                    },
                    {
                        "name": "Egypt",
                        "code": "EG"
                    },
                    {
                        "name": "El Salvador",
                        "code": "SV"
                    },
                    {
                        "name": "Equatorial Guinea",
                        "code": "GQ"
                    },
                    {
                        "name": "Eritrea",
                        "code": "ER"
                    },
                    {
                        "name": "Estonia",
                        "code": "EE"
                    },
                    {
                        "name": "Ethiopia",
                        "code": "ET"
                    },
                    {
                        "name": "Falkland Islands (Malvinas)",
                        "code": "FK"
                    },
                    {
                        "name": "Faroe Islands",
                        "code": "FO"
                    },
                    {
                        "name": "Fiji",
                        "code": "FJ"
                    },
                    {
                        "name": "Finland",
                        "code": "FI"
                    },
                    {
                        "name": "France",
                        "code": "FR"
                    },
                    {
                        "name": "French Guiana",
                        "code": "GF"
                    },
                    {
                        "name": "French Polynesia",
                        "code": "PF"
                    },
                    {
                        "name": "French Southern Territories",
                        "code": "TF"
                    },
                    {
                        "name": "Gabon",
                        "code": "GA"
                    },
                    {
                        "name": "Gambia",
                        "code": "GM"
                    },
                    {
                        "name": "Georgia",
                        "code": "GE"
                    },
                    {
                        "name": "Germany",
                        "code": "DE"
                    },
                    {
                        "name": "Ghana",
                        "code": "GH"
                    },
                    {
                        "name": "Gibraltar",
                        "code": "GI"
                    },
                    {
                        "name": "Greece",
                        "code": "GR"
                    },
                    {
                        "name": "Greenland",
                        "code": "GL"
                    },
                    {
                        "name": "Grenada",
                        "code": "GD"
                    },
                    {
                        "name": "Guadeloupe",
                        "code": "GP"
                    },
                    {
                        "name": "Guam",
                        "code": "GU"
                    },
                    {
                        "name": "Guatemala",
                        "code": "GT"
                    },
                    {
                        "name": "Guernsey",
                        "code": "GG"
                    },
                    {
                        "name": "Guinea",
                        "code": "GN"
                    },
                    {
                        "name": "Guinea-Bissau",
                        "code": "GW"
                    },
                    {
                        "name": "Guyana",
                        "code": "GY"
                    },
                    {
                        "name": "Haiti",
                        "code": "HT"
                    },
                    {
                        "name": "Heard Island and Mcdonald Islands",
                        "code": "HM"
                    },
                    {
                        "name": "Holy See (Vatican City State)",
                        "code": "VA"
                    },
                    {
                        "name": "Honduras",
                        "code": "HN"
                    },
                    {
                        "name": "Hong Kong",
                        "code": "HK"
                    },
                    {
                        "name": "Hungary",
                        "code": "HU"
                    },
                    {
                        "name": "Iceland",
                        "code": "IS"
                    },
                    {
                        "name": "India",
                        "code": "IN"
                    },
                    {
                        "name": "Indonesia",
                        "code": "ID"
                    },
                    {
                        "name": "Iran",
                        "code": "IR"
                    },
                    {
                        "name": "Iraq",
                        "code": "IQ"
                    },
                    {
                        "name": "Ireland",
                        "code": "IE"
                    },
                    {
                        "name": "Isle of Man",
                        "code": "IM"
                    },
                    {
                        "name": "Israel",
                        "code": "IL"
                    },
                    {
                        "name": "Italy",
                        "code": "IT"
                    },
                    {
                        "name": "Jamaica",
                        "code": "JM"
                    },
                    {
                        "name": "Japan",
                        "code": "JP"
                    },
                    {
                        "name": "Jersey",
                        "code": "JE"
                    },
                    {
                        "name": "Jordan",
                        "code": "JO"
                    },
                    {
                        "name": "Kazakhstan",
                        "code": "KZ"
                    },
                    {
                        "name": "Kenya",
                        "code": "KE"
                    },
                    {
                        "name": "Kiribati",
                        "code": "KI"
                    },
                    {
                        "name": "Korea (North)",
                        "code": "KP"
                    },
                    {
                        "name": "Korea (South)",
                        "code": "KR"
                    },
                    {
                        "name": "Kosovo",
                        "code": "XK"
                    },
                    {
                        "name": "Kuwait",
                        "code": "KW"
                    },
                    {
                        "name": "Kyrgyzstan",
                        "code": "KG"
                    },
                    {
                        "name": "Laos",
                        "code": "LA"
                    },
                    {
                        "name": "Latvia",
                        "code": "LV"
                    },
                    {
                        "name": "Lebanon",
                        "code": "LB"
                    },
                    {
                        "name": "Lesotho",
                        "code": "LS"
                    },
                    {
                        "name": "Liberia",
                        "code": "LR"
                    },
                    {
                        "name": "Libyan Arab Jamahiriya",
                        "code": "LY"
                    },
                    {
                        "name": "Liechtenstein",
                        "code": "LI"
                    },
                    {
                        "name": "Lithuania",
                        "code": "LT"
                    },
                    {
                        "name": "Luxembourg",
                        "code": "LU"
                    },
                    {
                        "name": "Macao",
                        "code": "MO"
                    },
                    {
                        "name": "Macedonia",
                        "code": "MK"
                    },
                    {
                        "name": "Madagascar",
                        "code": "MG"
                    },
                    {
                        "name": "Malawi",
                        "code": "MW"
                    },
                    {
                        "name": "Malaysia",
                        "code": "MY"
                    },
                    {
                        "name": "Maldives",
                        "code": "MV"
                    },
                    {
                        "name": "Mali",
                        "code": "ML"
                    },
                    {
                        "name": "Malta",
                        "code": "MT"
                    },
                    {
                        "name": "Marshall Islands",
                        "code": "MH"
                    },
                    {
                        "name": "Martinique",
                        "code": "MQ"
                    },
                    {
                        "name": "Mauritania",
                        "code": "MR"
                    },
                    {
                        "name": "Mauritius",
                        "code": "MU"
                    },
                    {
                        "name": "Mayotte",
                        "code": "YT"
                    },
                    {
                        "name": "Mexico",
                        "code": "MX"
                    },
                    {
                        "name": "Micronesia",
                        "code": "FM"
                    },
                    {
                        "name": "Moldova",
                        "code": "MD"
                    },
                    {
                        "name": "Monaco",
                        "code": "MC"
                    },
                    {
                        "name": "Mongolia",
                        "code": "MN"
                    },
                    {
                        "name": "Montserrat",
                        "code": "MS"
                    },
                    {
                        "name": "Morocco",
                        "code": "MA"
                    },
                    {
                        "name": "Mozambique",
                        "code": "MZ"
                    },
                    {
                        "name": "Myanmar",
                        "code": "MM"
                    },
                    {
                        "name": "Namibia",
                        "code": "NA"
                    },
                    {
                        "name": "Nauru",
                        "code": "NR"
                    },
                    {
                        "name": "Nepal",
                        "code": "NP"
                    },
                    {
                        "name": "Netherlands",
                        "code": "NL"
                    },
                    {
                        "name": "Netherlands Antilles",
                        "code": "AN"
                    },
                    {
                        "name": "New Caledonia",
                        "code": "NC"
                    },
                    {
                        "name": "New Zealand",
                        "code": "NZ"
                    },
                    {
                        "name": "Nicaragua",
                        "code": "NI"
                    },
                    {
                        "name": "Niger",
                        "code": "NE"
                    },
                    {
                        "name": "Nigeria",
                        "code": "NG"
                    },
                    {
                        "name": "Niue",
                        "code": "NU"
                    },
                    {
                        "name": "Norfolk Island",
                        "code": "NF"
                    },
                    {
                        "name": "Northern Mariana Islands",
                        "code": "MP"
                    },
                    {
                        "name": "Norway",
                        "code": "NO"
                    },
                    {
                        "name": "Oman",
                        "code": "OM"
                    },
                    {
                        "name": "Pakistan",
                        "code": "PK"
                    },
                    {
                        "name": "Palau",
                        "code": "PW"
                    },
                    {
                        "name": "Palestinian Territory, Occupied",
                        "code": "PS"
                    },
                    {
                        "name": "Panama",
                        "code": "PA"
                    },
                    {
                        "name": "Papua New Guinea",
                        "code": "PG"
                    },
                    {
                        "name": "Paraguay",
                        "code": "PY"
                    },
                    {
                        "name": "Peru",
                        "code": "PE"
                    },
                    {
                        "name": "Philippines",
                        "code": "PH"
                    },
                    {
                        "name": "Pitcairn",
                        "code": "PN"
                    },
                    {
                        "name": "Poland",
                        "code": "PL"
                    },
                    {
                        "name": "Portugal",
                        "code": "PT"
                    },
                    {
                        "name": "Puerto Rico",
                        "code": "PR"
                    },
                    {
                        "name": "Qatar",
                        "code": "QA"
                    },
                    {
                        "name": "Reunion",
                        "code": "RE"
                    },
                    {
                        "name": "Romania",
                        "code": "RO"
                    },
                    {
                        "name": "Russian Federation",
                        "code": "RU"
                    },
                    {
                        "name": "Rwanda",
                        "code": "RW"
                    },
                    {
                        "name": "Saint Helena",
                        "code": "SH"
                    },
                    {
                        "name": "Saint Kitts and Nevis",
                        "code": "KN"
                    },
                    {
                        "name": "Saint Lucia",
                        "code": "LC"
                    },
                    {
                        "name": "Saint Pierre and Miquelon",
                        "code": "PM"
                    },
                    {
                        "name": "Saint Vincent and the Grenadines",
                        "code": "VC"
                    },
                    {
                        "name": "Samoa",
                        "code": "WS"
                    },
                    {
                        "name": "San Marino",
                        "code": "SM"
                    },
                    {
                        "name": "Sao Tome and Principe",
                        "code": "ST"
                    },
                    {
                        "name": "Saudi Arabia",
                        "code": "SA"
                    },
                    {
                        "name": "Senegal",
                        "code": "SN"
                    },
                    {
                        "name": "Serbia",
                        "code": "RS"
                    },
                        {
                        "name": "Montenegro",
                        "code": "ME"
                    },
                    {
                        "name": "Seychelles",
                        "code": "SC"
                    },
                    {
                        "name": "Sierra Leone",
                        "code": "SL"
                    },
                    {
                        "name": "Singapore",
                        "code": "SG"
                    },
                    {
                        "name": "Slovakia",
                        "code": "SK"
                    },
                    {
                        "name": "Slovenia",
                        "code": "SI"
                    },
                    {
                        "name": "Solomon Islands",
                        "code": "SB"
                    },
                    {
                        "name": "Somalia",
                        "code": "SO"
                    },
                    {
                        "name": "South Africa",
                        "code": "ZA"
                    },
                    {
                        "name": "South Georgia and the South Sandwich Islands",
                        "code": "GS"
                    },
                    {
                        "name": "Spain",
                        "code": "ES"
                    },
                    {
                        "name": "Sri Lanka",
                        "code": "LK"
                    },
                    {
                        "name": "Sudan",
                        "code": "SD"
                    },
                    {
                        "name": "Suriname",
                        "code": "SR"
                    },
                    {
                        "name": "Svalbard and Jan Mayen",
                        "code": "SJ"
                    },
                    {
                        "name": "Swaziland",
                        "code": "SZ"
                    },
                    {
                        "name": "Sweden",
                        "code": "SE"
                    },
                    {
                        "name": "Switzerland",
                        "code": "CH"
                    },
                    {
                        "name": "Syrian Arab Republic",
                        "code": "SY"
                    },
                    {
                        "name": "Taiwan, Province of China",
                        "code": "TW"
                    },
                    {
                        "name": "Tajikistan",
                        "code": "TJ"
                    },
                    {
                        "name": "Tanzania",
                        "code": "TZ"
                    },
                    {
                        "name": "Thailand",
                        "code": "TH"
                    },
                    {
                        "name": "Timor-Leste",
                        "code": "TL"
                    },
                    {
                        "name": "Togo",
                        "code": "TG"
                    },
                    {
                        "name": "Tokelau",
                        "code": "TK"
                    },
                    {
                        "name": "Tonga",
                        "code": "TO"
                    },
                    {
                        "name": "Trinidad and Tobago",
                        "code": "TT"
                    },
                    {
                        "name": "Tunisia",
                        "code": "TN"
                    },
                    {
                        "name": "Turkey",
                        "code": "TR"
                    },
                    {
                        "name": "Turkmenistan",
                        "code": "TM"
                    },
                    {
                        "name": "Turks and Caicos Islands",
                        "code": "TC"
                    },
                    {
                        "name": "Tuvalu",
                        "code": "TV"
                    },
                    {
                        "name": "Uganda",
                        "code": "UG"
                    },
                    {
                        "name": "Ukraine",
                        "code": "UA"
                    },
                    {
                        "name": "United Arab Emirates",
                        "code": "AE"
                    },
                    {
                        "name": "United Kingdom",
                        "code": "GB"
                    },
                    {
                        "name": "United States",
                        "code": "US"
                    },
                    {
                        "name": "United States Minor Outlying Islands",
                        "code": "UM"
                    },
                    {
                        "name": "Uruguay",
                        "code": "UY"
                    },
                    {
                        "name": "Uzbekistan",
                        "code": "UZ"
                    },
                    {
                        "name": "Vanuatu",
                        "code": "VU"
                    },
                    {
                        "name": "Venezuela",
                        "code": "VE"
                    },
                    {
                        "name": "Viet Nam",
                        "code": "VN"
                    },
                    {
                        "name": "Virgin Islands, British",
                        "code": "VG"
                    },
                    {
                        "name": "Virgin Islands, U.S.",
                        "code": "VI"
                    },
                    {
                        "name": "Wallis and Futuna",
                        "code": "WF"
                    },
                    {
                        "name": "Western Sahara",
                        "code": "EH"
                    },
                    {
                        "name": "Yemen",
                        "code": "YE"
                    },
                    {
                        "name": "Zambia",
                        "code": "ZM"
                    },
                    {
                        "name": "Zimbabwe",
                        "code": "ZW"
                    }
]';
        $countries = json_decode($json);
        return collect($countries)->where('name', $country)->pluck('code')->first();
    }
}
