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
use Illuminate\Http\Request;

Route::get('/','SedeController@index');
Route::resource('turno', 'TurnoController');
Route::resource('cargar', 'ContenidoController');

Route::get('/tv', function(){
	$turnos = App\Turnos::where('estado', 1)->get();
	return view('tv.index',compact('turnos'));
});
Route::post('/sede/modulos', function(Request $request){
	$id = $request->input('id_sede');
	return App\Modulo::where('sedes_id',$id)->get();
});
Route::get('/llamar/{id}', 'TurnoController@viewLlamarTurno');
Route::get('/contenido', 'TurnoController@viewLlamarTurno');

//Recepcion
Route::post('/llamarTurno', 'TurnoController@llamarTurno');
Route::post('/distraido', 'TurnoController@distraido');
Route::post('/finalizar', 'TurnoController@finalizar');

//Pantalla
Route::post('/mostrarTV', 'TurnoController@mostrarTV');
Route::post('/actualizarMostrarTV', 'TurnoController@quitarTV');

//Informadora
Route::post('/turno/entrega', ['uses' => 'TurnoController@entrega']);
Route::post('/llamarTurno', 'TurnoController@llamarTurno');
Route::post('/distraido', 'TurnoController@distraido');
Route::post('/finalizar', 'TurnoController@finalizar');
Route::get('/imprimir/{turno}',  'TurnoController@imprimir');

//Manejo turno info
Route::post('/turno/entregaInfo', ['uses' => 'TurnoController@entregaTurnoInformacion']);
Route::post('/llamarTurnoInfo', 'TurnoController@llamarTurnoInfo');
Route::post('/distraidoInfo', 'TurnoController@distraidoInfo');
Route::post('/finalizarInfo', 'TurnoController@finalizarInfo');