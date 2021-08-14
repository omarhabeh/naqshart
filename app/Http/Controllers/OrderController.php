<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('ssss');
        $appliedartists = Order::orderBy('id', 'DESC')->paginate(7);
        $failed = Order::where('paymentstatus','failed')->get()->count();
        $refunded = Order::where('paymentstatus','refunded')->get()->count();
        $completed = Order::where('paymentstatus','completed')->get()->count();
        $delivering = Order::where('paymentstatus','delivering')->get()->count();
        $proccessing = Order::where('paymentstatus','Processing')->get()->count();
        $pending = Order::where('paymentstatus','pending')->get()->count();
        return view('orders.index')
            ->with('appliedartists', $appliedartists)->with('failed',$failed)->with('refunded',$refunded)
            ->with('completed',$completed)->with('delivering',$delivering)->with('proccessing',$proccessing)->with('type','')->with('pending',$pending);
    }
    public function type($type = '')
    {
        $appliedartists = Order::where('paymentstatus',$type)->paginate(7);
        $failed = Order::where('paymentstatus','failed')->get()->count();
        $refunded = Order::where('paymentstatus','refunded')->get()->count();
        $completed = Order::where('paymentstatus','completed')->get()->count();
        $delivering = Order::where('paymentstatus','delivering')->get()->count();
        $proccessing = Order::where('paymentstatus','Processing')->get()->count();
        $pending = Order::where('paymentstatus','pending')->get()->count();

        return view('orders.index')
            ->with('appliedartists', $appliedartists)->with('failed',$failed)->with('refunded',$refunded)
            ->with('completed',$completed)->with('delivering',$delivering)->with('proccessing',$proccessing)->with('type',$type)->with('pending',$pending);
    }
    public function daily(){
        $data = Order::select([
            Order::raw('count(id) as `count`'),
            Order::raw('DATE(created_at) as day'),
            Order::raw('count(paymentstatus) as `failed`'),
          ])->groupBy('day')

          ->where('created_at', '>=', Carbon::now()->subWeeks(1))
          ->get();

          $failed = Order::select([
            Order::raw('DATE(created_at) as day'),
            Order::raw('count(paymentstatus) as `status`'),
          ])->groupBy('day')
          ->where('created_at', '>=', Carbon::now()->subWeeks(1))
          ->where('paymentstatus','=', 'failed')
          ->get();

          $completed = Order::select([
            Order::raw('DATE(created_at) as day'),
            Order::raw('count(paymentstatus) as `status`'),
          ])->groupBy('day')
          ->where('created_at', '>=', Carbon::now()->subWeeks(1))
          ->where('paymentstatus','=', 'completed')
          ->get();

  
        return view('orders.daily')->with('data',$data)->with('completed',$completed)->with('failed',$failed);
    }
    public function orderindex($id = null)
    {
        // dd('ssss');
        $order = Order::find($id);
        if ($order) {
            // dd($order->items);
            return view('orders.orderindex')
                ->with('appliedartists', $order->items);
        }


        return view('orders.index')
            ->with('appliedartists', $appliedartists);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

        /*** complete the order */
    public function complete(Request $request, Order $order)
    {
        if ($order->paymentstatus == 'Processing')
            $order->update(['paymentstatus' => 'delivering']);
        return \back();
    }
    public function finished(Request $request, Order $order)
    {
        if ($order->paymentstatus == 'delivering')
            $order->update(['paymentstatus' => 'Completed']);
        return \back();
    }

    /*** export a cvs file of orders */
    public function csv(Request $request) {
        $fileName = 'orders.csv';
        $orders = Order::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Name', 'Email', 'Phone', 'Adress', 'Appartment', 'City', 'PostCode', 'Goverment', 'Country', 'Payment-code', 'payment-status', 'PromoCode', 'Discoun', 'TotalPrice', 'Payment Transaction REturn', 'Date and time');

        $callback = function() use($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($orders as $order) {
                $row['Name']  = $order->fname;
                $row['Email']    = $order->email;
                $row['Phone']    = $order->phone;
                $row['Adress']  = $order->adress;
                $row['Apartment']  = $order->apartment;
                $row['City']  = $order->city;
                $row['PostCode']  = $order->postcode;
                $row['Goverment']  = $order->goverment;
                $row['Country']  = $order->country;
                $row['Payment-code']  = $order->paymentid;
                $row['Payment-status']  = $order->paymentstatus;
                $row['PromoCode']  = $order->promocode;
                $row['TotalPrice']  = $order->totalprice;
                $row['Payment Transaction REturn']  = $order->payment_transaction;
                $row['Date and Time']  = $order->created_at;

                fputcsv($file, array($row['Name'], $row['Email'], $row['Phone'], $row['Appartment'], $row['city'], $row['PostCode'], $row['Goverment'], $row['Country'], $row['Payment-code'], $row['Payment-status'], $row['PromoCode'], $row['Discount'], $row['TotalPrice'], $row['Payment Transaction REturn'], $row['Date and Time']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(['status' => true]);
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
        if ($order->paymentstatus == 'Processing')
            $order->update(['paymentstatus' => 'Refunded']);
        return \back();
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
}
