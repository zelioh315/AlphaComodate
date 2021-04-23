<?php

use Illuminate\Support\Facades\Route;


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

Route::get('/', 'PagesController@index');
Route::get('/demo', function () {
    Mail::to('chiatiah@gmail.com')->send(new App\Mail\EmailFromAPotentialTenant());
    return new App\Mail\EmailFromAPotentialTenant();
});

// Route::get('get-location-from-ip',function(){
//     $ip= \Request::ip();
//     $data = \Location::get($ip);
//     dd($data);
// });
Route::get('/properties/{id}/Sendemail', 'PagesController@sendAnEmail');
// Route::get('/properties/{id}/pictureUpload', 'PagesController@pictureUpload');
Route::get('/students', 'PagesController@students');
Route::get('/forSale', 'PagesController@forSale');
Route::get('/about', 'PagesController@about');
Route::get('/servicedAccomodations', 'PagesController@servicedAccomodations');
// Route::get('/googlemap', 'MapController@map');
Route::get('/properties-on-location', 'PropertyController@propertiesOnLocation');

Route::resource('properties', 'PropertyController');
Route::get('/properties/{radius}/{lng}/{lat}', 'PropertyController@gettingProperties');
Route::get('/properties/properties-around-you/{city}', 'PropertyController@propertyCities');
Route::get('/properties/propertyonmap/{id}', 'PropertyController@propertyonmap');
Route::resource('propertiesForRent', 'PropertyForRentController');
Route::resource('email', 'emailController');
Route::resource('sendsms', 'smsController');
Route::resource('photos', 'PhotoController');

//Route::resource('/', 'PropertyController');



Auth::routes();
Route::get('/chat', 'chatController@index');
Route::get('/message/{id}', 'chatController@getMessage')->name('message');
Route::post('message', 'chatController@sendMessage');
Route::get('/home', 'HomeController@index')->name('home');
// Route::resource('/home', 'HomeController@index')->name('home');
Route::resource('profile', 'profileController');


