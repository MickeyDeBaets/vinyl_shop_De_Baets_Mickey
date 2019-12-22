<?php

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

//Route::get('/', function () {
//    //return view('welcome');
//    return 'The Vinyl Shop';
//});
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
Route::view('/', 'home');
Route::get('shop', 'ShopController@index');
Route::get('shop_alt', 'ShopControllerAlt@index');
Route::get('shop/{id}', 'ShopController@show');
Route::view('contact-us', 'contact');
Route::get('contact-us', 'ContactUsController@show');
Route::post('contact-us', 'ContactUsController@sendEmail');
//Old Version
//Route::get( 'admin/records', function (){
//    $records = [
//        'Queen - Greatest Hits',
//        'The Rolling Stones - Sticky Fingers',
//        'The Beatles - Abbey Road'
//    ];
//    return view('admin.records.index', [
//        'records' => $records
//    ]);
//});

// New version with prefix and group
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::redirect('/', 'records');
    Route::get('genres/qryGenres', 'Admin\GenreController@qryGenres');
    Route::resource('genres', 'Admin\GenreController');
    Route::resource('records', 'Admin\RecordController');

});

//user
Route::redirect('user', '/user/profile');
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('profile', 'User\ProfileController@edit');
    Route::post('profile', 'User\ProfileController@update');
    Route::get('password', 'User\PasswordController@edit');
    Route::post('password', 'User\PasswordController@update');
});

