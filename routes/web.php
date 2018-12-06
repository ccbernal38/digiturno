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
use Illuminate\Support\Facades\Storage;
use App\GrupoFamiliar;
use App\contenido;
use App\User;
use Illuminate\Support\Facades\Hash;


Route::get('/','SedeController@index');
Route::resource('turno', 'TurnoController');
Route::resource('cargar', 'ContenidoController');

Route::get('/tv', function(){
	$turnos = App\Turnos::where('estado', 1)->get();
	$contenido = contenido::orderBy('duracion','asc')->get();
	return view('tv.index',compact('turnos', 'contenido'));
});

Route::post('/create/role', function(Request $request){
	$mensaje = "Se ha registrado correctamente el nuevo rol";
	$tipo = 0;
	try {
		$role = new App\Roles();
		$role->nombre = $request->input('role_name');
		$role->descripcion = $request->input('role_description');
		$role->save();
		
	} catch (Exception $e) {
		$mensaje = "Se ha producido un error registrando el nuevo rol";
		$tipo = 1;
	}
	//return $request->input('role_name');
	
	return view('user.role',compact('mensaje', 'tipo'));
});

Route::get('/create/role', function(){
	return view('user.role');
});

Route::get('/create/user', function(){
	$roles = App\roles::all();
	return view('user.create',compact('roles'));
});

Route::post('/create/user', function(Request $request){
	$user = new User();
	$user->name = $request->input('name');
	$user->username = $request->input('documento');	
	$user->password = Hash::make($request->input('documento'));	
	$user->save();
	$user->roles()->sync($request->input('checkd'));
	$user->save();
	return view('user.create', compact('roles'));
});

Route::post('/login', 'SedeController@login');
Route::get('/login', function(){
	return redirect('/');
});

Route::post('/sede/modulos', function(Request $request){
	$id = $request->input('id_sede');
	return App\Modulo::where('sedes_id',$id)->get();
});
Route::get('/llamar/{id}/{nombre}', 'TurnoController@viewLlamarTurno');
Route::get('/turno/{id}/{nombre}', 'TurnoController@viewLoadInformadora');
Route::get('/contenido', 'TurnoController@viewLlamarTurno');

//Recepcion
Route::post('/llamarTurno', 'TurnoController@llamarTurno');
Route::post('/distraido', 'TurnoController@distraido');
Route::post('/finalizar', 'TurnoController@finalizar');

//Analiexpress
Route::post('/llamarTurnoAnaliexpress', 'TurnoController@llamarTurnoAnaliexpress');
Route::post('/distraidoAnaliexpress', 'TurnoController@distraidoAnaliexpress');
Route::post('/finalizarAnaliexpress', 'TurnoController@finalizarAnaliexpress');

//Pantalla
Route::post('/mostrarTV', 'TurnoController@mostrarTV');
Route::post('/actualizarMostrarTV', 'TurnoController@quitarTV');

//Informadora
Route::post('/turno/entrega', ['uses' => 'TurnoController@entrega']);
Route::post('/distraido', 'TurnoController@distraido');
Route::post('/finalizar', 'TurnoController@finalizar');
Route::get('/imprimir/{turno}',  'TurnoController@imprimir');

//Manejo turno info
Route::post('/turno/entregaInfo', ['uses' => 'TurnoController@entregaTurnoInformacion']);
Route::post('/llamarTurnoInfo', 'TurnoController@llamarTurnoInfo');
Route::post('/distraidoInfo', 'TurnoController@distraidoInfo');
Route::post('/finalizarInfo', 'TurnoController@finalizarInfo');

Route::get('/admin/turnos', 'AdministradorController@viewColaTurnos');
Route::post('/admin/turnos', 'AdministradorController@getColaTurnos');

Route::get('/admin/modulos', function(){
	return view("admin.modulos");
});
Route::get('/prueba', 'TurnoController@resetConsecutivo');