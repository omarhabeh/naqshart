<?php

namespace App\Http\Controllers\Language;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Torann\GeoIP\Facades\GeoIP;
class LanguageController extends Controller
{
    public function index(){
        $code = GeoIP::getLocation(request()->ip())->iso_code;
        $countries = [
            "EG",
             "DZ",
            "SD" ,
            "IQ" ,
             "MA" ,
             "SA",
            "YE",
            "SY",
            "SO",
            "TN",
             "JO",
             "AE" ,
           "LY",
            "PS",
            "OM",
             "KW",
            "MR",
            "QA",
            "BH",
            "LB"
        ];

        $language = in_array($code, $countries) ? 'ar':'en';
        return $language;
    }
}
