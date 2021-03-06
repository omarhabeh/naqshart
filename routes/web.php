<?php

use Facade\FlareClient\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Log;
use App\Mail\artistOrderMail;
use App\Mail\joinusNotification;
use App\Mail\orderMail;
use App\Mail\track;
use App\Order;
use App\OrderPalette;
use App\Models\Palette;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::get('/export_excel/excel', 'InvitationController@excel')->name('export_excel.excel');
Route::get('/aramexcode/{id}/{code}',function($id,$code){
    $order = Order::find($id);
    $palettes = OrderPalette::where('order_id',$id)->get()->first();
    $palette = Palette::find($palettes->palatte_id);
    Mail::to($order->email)->send(new track($order,$code,$palette));
    if ($order->paymentstatus == 'Processing'){
        $order->update(['paymentstatus' => 'delivering']); }
    return response()->json([$palette,$order,$palettes]);
});
Route::view('/', 'userLayout.home');
Route::group(['middleware' => 'isadmin'], function () {
    Route::get('/invitations-show', 'InvitationController@index');
    Route::get('/admin', 'AdminController@index')->name("admin.index");
    Route::resource('appliedartists', 'AppliedartistController');
    Route::resource('artists', 'ArtistController');
    // Route::resource('reviews', 'ReviewController');
    Route::resource('palettes', 'PaletteController');
    Route::resource('paletteimages', 'PaletteimageController');

    Route::get('orders', 'OrderController@index');
    Route::get('daily', 'OrderController@daily');
    Route::put('orders/{order}', 'OrderController@update')->name('orders.refund');
    Route::put('orders/complete/{order}', 'OrderController@complete')->name('orders.complete');
    Route::put('orders/finished/{order}', 'OrderController@finished')->name('orders.finished');
    Route::get('appliedorders/{id?}', 'OrderController@orderindex')->name('appliedorder.show');

    Route::get('addpaletteimages/{palette?}/create', 'PaletteimageController@create')->name("addimgpalette");
    Route::get('changeStatus', 'UserController@changeStatus');
    Route::get('users', 'UserController@index');
    Route::get('changeStatus', 'UserController@changeStatus');
    Route::get('changeStatus_2', 'UserController@changeStatus_2');
    Route::resource('homeDatas', 'HomeDataController');
    Route::resource('aboutContents', 'AboutContentController');
    Route::resource('paletteGif', 'PaletteGifController');
    Route::resource('homeGif', 'HomeGifController');
    Route::resource('paletteContent', 'PaletteContentController');
    Route::resource('aboutAretists', 'AboutAretistsController');
    Route::resource('aboutContacts', 'About_ContactController');
    Route::resource('discounts', 'DiscountController');
    Route::resource('aboutContactsTexts', 'About_Contacts_TextController');
    Route::resource('joinusTexts', 'joinus_TextController');
});
Route::get('orders', 'OrderController@index')->middleware('modirator');
Route::get('orders/{type}', 'OrderController@type')->middleware('modirator');
Route::get('appliedorders/{id?}', 'OrderController@orderindex')->name('appliedorder.show')->middleware('modirator');


Route::get('/home', 'HomeController@index')->name("home.index");
Route::post('reviews-api', 'ReviewController@store');
Route::post('aboutContacts-api', 'About_ContactController@store');
Route::get('/payment-failOpen', 'failController@index');
Route::get('/home', 'HomeController@index')->middleware('verified')->name("home.index");
Route::get('/', 'HomeController@index')->name('mainPage');

// invitations
Route::get('/export_csv', 'InvitationController@csv')->name('export_csv');
Route::get('/export_csv_orders', 'OrderController@csv')->name('export_csv_orders');


Route::post('like', 'ReviewController@like');
Route::post('dislike', 'ReviewController@dislike');

Route::get('payment/{id?}', function ($id = null) {
    // dd('asd');
    Log::info('id' . $id);
})->name('payment');
Route::get('/geo','Language\LanguageController@index');
Route::view('/{any}', 'userLayout.home');
