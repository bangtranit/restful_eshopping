<?php
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

Route::get('/', function () {
	// return view('welcome');
	$to_name = 'thangbang';
	$to_email = 'thanhbang.it.dn2000@gmail.com';
	$data = array('name' => 'bang test mail', 'body' => 'body bang test mail');
	Mail::send('mail', $data, function($message) use ($to_name, $to_email){
		$message->to($to_name)
		->subject('laravel send mail subject');
	});
    // return view('welcome');
});



//clear cache
// Route::get('/clear-cache', function() {
//     Artisan::call('cache:clear');
//     Artisan::call('route:clear');
//     Artisan::call('config:clear');
//     Artisan::call('view:clear');
//     return "Cache is cleared";
// });