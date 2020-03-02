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

Route::get('/', function () {
    //return view('welcome');
    $links = \App\Link::all();
    return view('welcome', ['links' => $links]);
});

Route::get('/firsttest', function () {
    return view('firsttest');
});
Route::post('/firsttest', 'HomeController@firsttestc');

// crud
Route::get('/test', 'TestController@index');
Route::get('/create', 'TestController@create');
Route::post('save', 'TestController@save');
Route::get('/show/{aid}', 'TestController@display');
Route::get('/edit/{aid}', 'TestController@edit');
Route::post('/update/{aid}', 'TestController@update');
Route::get('/delete/{aid}', 'TestController@delete');

Route::get('/myedit/{aid}', 'TestController@edit');

Route::get('/admin', 'AdminController@index');
Route::get('/superadmin', 'SuperAdminController@index');


/*Route::get('TestController/abctesturl', 'TestController@abctesturl');
Route::get('abctesturl', 'TestController@abctesturl');
Route::get('saraswathi/abctesturl', 'TestController@abctesturl');
Route::get('saraswathi/glovision', 'TestController@abctesturl');

Route::get('abctesturl/{id?}', function ($id = null) {
	//return $id;
});
//Route::get('abctesturl', 'TestController@abctesturl');
//Route::get('saraswathi/abctesturl', 'TestController@abctesturl');
//Route::get('saraswathi/glovision', 'TestController@abctesturl');


Route::get('/abctesturl', function () {
    return redirect()->action(
      'TestController@abctesturl', ['id' => Auth::user()->id]
    );
});*/




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
