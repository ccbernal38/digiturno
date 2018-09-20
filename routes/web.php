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
    return view('welcome');
});
Route::resource('turno', 'TurnoController');
Route::post('/turno/entrega', ['uses' => 'TurnoController@entrega']);
Route::get('/tv', function(){
	$turnos = App\Turnos::where('estado', 1)->get();
	return view('tv.index',compact('turnos'));
});
Route::get('/llamar/{id}', 'TurnoController@viewLlamarTurno');
Route::post('/llamarTurno', 'TurnoController@llamarTurno');
Route::post('/pasarTomaMuestra', 'TurnoController@pasarTomaMuestra');
Route::post('/distraido', 'TurnoController@distraido');
Route::post('/finalizar', 'TurnoController@finalizar');