<?php
use App\Http\Controllers\Admin;
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
    return view('welcome');
});

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


//Route::group([
//    'prefix' => 'admin',
//    'as' => 'admin',
//    'namespace' => 'App\\Http\\Controllers\\Admin',
//
//], function(){
//
//    Route::get('/',                         [AdminController::class,        'index' ])->name('admin.index');
//});
//yacht methods
Route::namespace('Admin')->group(function(){
    Route::prefix('admin')->group(function () {
        Route::get('/', 'AdminController@index')->name('admin.index');

        Route::get('/yacht', 'YachtController@index')->name('admin.yacht');
        Route::get('/yacht/add', 'YachtController@add')->name('admin.yacht.add');
        Route::post('/yacht/store', 'YachtController@store')->name('admin.yacht.store');
        Route::get('/yacht/change/{id}', 'YachtController@change')->name('admin.yacht.change');
        Route::post('/yacht/update/{id}', 'YachtController@update')->name('admin.yacht.update');

        Route::get('/vendor', 'VendorController@index')->name('admin.vendor');
        Route::get('/vendor/edit/{id}', 'VendorController@edit')->name('admin.vendor.edit');
        Route::get('/vendor/activate/{id}', 'VendorController@activate')->name('admin.vendor.activate');

        Route::get('/vendor/yachts/{vendorId}', 'YachtController@by_vendor')->name('admin.vendor.yachts');
    });

});

Route::namespace('Client')->group(function(){

    Route::prefix('client')->group(function () {
        Route::get('/', 'HomeController@index')->name('index');
        Route::post('registration', 'HomeController@register')->name('register');
        Route::post('login', 'HomeController@login')->name('login');

        //vendors
        Route::prefix('vendor')->group(function () {
            Route::post('login', 'VendorController@login')->name('vendor_login');
            Route::get('register', 'VendorController@register')->name('vendor_register');
            Route::post('register/save', 'VendorController@store')->name('vendor_register_save');

        });

        //yachts
        Route::prefix('yacht')->group(function () {
            Route::get('/', 'YachtController@index')->name('admin.yacht.index');
        });
    });
});

//Route::namespace('Client')->group(function(){
//        Route::get('/',  'HomeController@index')->name('index');
//
//    Route::post('registration',  'HomeController@register')->name('register');
//    Route::post('login',         'HomeController@login')->name('login');
//
//    //vendors
//    Route::prefix('vendor')->group(function () {
//        Route::post('login',     'VendorController@login')->name('vendor_login');
//        Route::get('register',   'VendorController@register')->name('vendor_register');
//        Route::post('register/save',  'VendorController@store')->name('vendor_register_save');
//
//    });
//
//    //yachts
//    Route::prefix('yacht')->group(function () {
//        Route::get('/',  'YachtController@index')->name('admin.yacht.index');
//    });
//});


//    //yachts
//    Route::prefix('yacht')->group(function () {
//        Route::get('/',  [YachtController::class, 'index'])->name('admin.yacht.index');
//    });
//});
//
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');
//
//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


require __DIR__.'/mobile.php';