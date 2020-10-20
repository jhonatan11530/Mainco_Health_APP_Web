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
    return view('login');
});

Route::get('login', function () {
    return view('login');
});

Route::post('validar', 'LoginController@validar');

Route::get('logout', function() {
    Auth::logout();
    return view('login');
    
});


Route::group(['middleware' => 'auth'], function() {
    Route::get('home', function(){
   		return redirect('login');
    });
       
        Route::resource('inicio', 'InicioController');
        Route::resource('usuarios', 'UsuariosController');
        Route::resource('operador', 'OperadorController');
        Route::resource('control', 'ControlController');
        Route::resource('produccion', 'ProduccionController');
        Route::resource('exportar', 'ExportController');
        Route::resource('humana', 'GestionHumanaController');
        
        
        Route::get('produccion/{id}/now', 'ProduccionController@now')->name('produccion.now');
        
});