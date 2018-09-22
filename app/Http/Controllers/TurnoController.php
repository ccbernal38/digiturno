<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoPaciente;
use App\Turnos;
use App\Modulo;
use stdClass;
class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoPaciente = TipoPaciente::all();
        return view("turno.entrega", compact('tipoPaciente'));
    }

    public function entrega(Request $request){
        $tipo = $request->input('recepcion');
        $object = TipoPaciente::where('sigla','like', $tipo)->get();
        
        $turno = $object[0]->sigla.$object[0]->consecutivo;
        $object[0]->consecutivo = $object[0]->consecutivo + 1;
        $object[0]->save();

        $turnoNuevo = new Turnos();
        $turnoNuevo->codigo = $turno;
        $turnoNuevo->estado = 0;
         $turnoNuevo->save();
        return $turno;
    }

    public function llamarTurno(Request $request){
        //logica para siguiente turno
        $id = $request->input('id');
         $turnoSiguiente = $this->siguienteTurno(0);
        if(empty($turnoSiguiente)){
            $json = array('turno' => "No hay turnos disponibles", 'estado' => 1);;
            return json_encode($json);
        }else{
            $turnoSiguiente->estado = 1;
            $turnoSiguiente->modulos()->attach($id);
            $turnoSiguiente->save();
            $json = array('turno' => $turnoSiguiente->codigo, 'estado' => 0);            
            return json_encode($json);
        }
        
        
    }

    public function llamarTurnoTomaMuestra(Request $request){
        //logica para siguiente turno
        $id = $request->input('id');
        $turnoSiguiente = $this->siguienteTurno(1);
        if(empty($turnoSiguiente)){
            $json = array('turno' => "No hay turnos disponibles", 'estado' => 1);;
            return json_encode($json);
        }else{
            $turnoSiguiente->estado = 1;
            $turnoSiguiente->modulos()->attach($id);
            $turnoSiguiente->save();
            $json = array('turno' => $turnoSiguiente->codigo, 'estado' => 0);            
            return json_encode($json);
        }
    }
    /**
        Logica de colas
        0->Recepcion
        1->Toma de muestra
    */
    public function siguienteTurno($servicio){
        if ($servicio == 0) {
            return Turnos::where("estado", 0)->take(1)->get()->get(0);
        }else if($servicio == 1){
            return Turnos::where("estado", 1)->take(1)->get()->get(0);
        }

    }

    public function pasarTomaMuestra(Request $request){
        //logica para siguiente turno
        $turnoSiguiente = Turnos::where("estado", 0)->take(1)->get()->get(0);
        if(empty($turnoSiguiente)){
            $json = array('turno' => "No hay turnos disponibles", 'estado' => 1);;
            return json_encode($json);
        }else{
            $turnoSiguiente->estado = 1;
            $turnoSiguiente->modulos()->attach($id);
            $turnoSiguiente->save();
            $json = array('turno' => $turnoSiguiente->codigo, 'estado' => 0);            
            return json_encode($json);
        }        
        
    }

    public function distraido(Request $request){
        $tipo = $request->input('recepcion');
    }

    public function finalizar(Request $request){
                
    }
 
    public function viewLlamarTurno($id){
        $nombre = Modulo::find($id)->nombre;
        return view('turno.llamar', compact('nombre','id'));
    }

    public function mostrarTV(Request $request){
        return Turnos::where("enTV", 0)->has('modulos')->with('modulos')->take(5)->get();
    }

    public function quitarTV(Request $request){
        $id = $request->input("id");
        $turno = Turnos::find($id);
        $turno->enTV = 1;
        $turno->save();
    }
}
