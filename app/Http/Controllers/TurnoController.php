<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoPaciente;
use App\Turnos;
use App\Modulo;
use stdClass;
use Carbon\Carbon;
class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    /**
        Permite cargar la vista de impresion de turnos
    */
    public function imprimir($turno){
        $time = Carbon::now();        
        return view('turno.imprimir', compact('turno', 'time'));
    }

    /**
    */
    public function show($id){
        $tipoPaciente = TipoPaciente::where('tipo',0)->get();
        return view("turno.entrega", compact('tipoPaciente', 'id'));
    }

     //-------------------------------------------------------
    //              INFORMACION
    //-------------------------------------------------------

    /**
        Metodo que genera el turno para la recepcion
    */
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
    /**
        Metodo POST para generar el turno de las informadoras
        0   -> Recepcion 
        1   -> Resutado
        2   -> Muestras pendientes
        3   -> Preparacion
        4   -> Informacion
        5   -> Analiexpress
    */
    public function entregaTurnoInformacion(Request $request){
        $tipo = $request->input('tipo');
        $id = $request->input('id');
        if($tipo == 1 || $tipo == 2 || $tipo == 3 || $tipo == 4 || $tipo == 5){
            return $this->turnoInfo($tipo, $id);
        }else{
            $json = array('turno' => "No hay turnos disponibles", 'estado' => 1);;
            return json_encode($json);
        }
    }
    /**
        Metodo que genera el turno de las informadoras
    */
    public function turnoInfo($tipo){
        $object = TipoPaciente::where('tipo', $tipo)->get();
        
        $turno = $object[0]->sigla.$object[0]->consecutivo;
        $object[0]->consecutivo = $object[0]->consecutivo + 1;
        $object[0]->save();

        $turnoNuevo = new Turnos();
        $turnoNuevo->codigo = $turno;
        $turnoNuevo->estado = 5;
        $turnoNuevo->save();
        return $turno;
    }

     /**
        Metodo POST para generar el turno de la recepcion
    */
    public function llamarTurnoInfo(Request $request){
        //logica para siguiente turno
        $id = $request->input('id');
        return $this->llamarInfo($id,0);
    }

    /**
        Metodo que permite llamar el turno siguiente en recepcion
    */
    function llamarInfo($id, $pos){
        $turnoSiguiente = $this->siguienteTurnoInfo($pos);
        if(empty($turnoSiguiente)){
            $json = array('turno' => "No hay turnos disponibles", 'estado' => 1);;
            return json_encode($json);
        }else{
            $turnoSiguiente->estado = 8;
            $turnoSiguiente->enTV = 0;
            $turnoSiguiente->modulos()->attach($id);
            $turnoSiguiente->save();
            event(new TurnWasReceived);
            $json = array('turno' => $turnoSiguiente->codigo, 'estado' => 0, 'id' => $turnoSiguiente->id);            
            return json_encode($json);
        }
    }
    /**
        Metodo que permite cambiar el estado la atencion de un turno en recepcion a distraido
    */
    public function distraidoInfo(Request $request){
        $id_turno = $request->input('id');
        $id_modulo = $request->input('id_modulo');
        $turno = Turnos::find($id_turno);
        if ($turno->cantLlamados == 3) {
            $turno->estado = 7;
            $turno->save();            
        }else{
            $turno->estado = 6;
            $turno->enTV = 0;
            $turno->cantLlamados = $turno->cantLlamados + 1;
            $turno->save();
        }
        return $this->llamarInfo($id_modulo, 1);
    }
    /**
        Metodo que permite finalizar la atencion de un turno en recepcion
    */
    public function finalizarInfo(Request $request){
        $id_turno = $request->input('id');
        $id_modulo = $request->input('id_modulo');
        $turno = Turnos::find($id_turno);
        $turno->estado = 7;
        $turno->save();        
        return $this->llamarInfo($id_modulo, 0);
    }
    /**
        Logica de colas
        0->Recepcion
        1->Toma de muestra
    */
    public function siguienteTurnoInfo($servicio){
        //llamar o Finalizar
        if ($servicio == 0) {
            return Turnos::where("estado", 5)->orWhere("estado", 6)->take(1)->get()->get(0);
            //distraido
        }else if($servicio == 1){
            return Turnos::where("estado", 5)->orWhere("estado", 6)->take(2)->get()->get(1);
        }

    }
    //-------------------------------------------------------
    //              RECEPCION
    //-------------------------------------------------------
    /**
        Metodo POST para generar el turno de la recepcion
    */
    public function llamarTurno(Request $request){
        //logica para siguiente turno
        $id = $request->input('id');
        return $this->llamar($id,0);
    }

    /**
        Metodo que permite llamar el turno siguiente en recepcion
    */
    function llamar($id, $pos){
        $turnoSiguiente = $this->siguienteTurno($pos);
        if(empty($turnoSiguiente)){
            $json = array('turno' => "No hay turnos disponibles", 'estado' => 1);;
            return json_encode($json);
        }else{
            $turnoSiguiente->estado = 1;
            $turnoSiguiente->enTV = 0;
            $turnoSiguiente->modulos()->attach($id);
            $turnoSiguiente->save();
            $json = array('turno' => $turnoSiguiente->codigo, 'estado' => 0, 'id' => $turnoSiguiente->id);            
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
            return Turnos::where("estado", 0)->orWhere("estado", 2)->take(1)->get()->get(0);
        }else if($servicio == 1){
            return Turnos::where("estado", 0)->orWhere("estado", 2)->take(2)->get()->get(1);
        }

    }

    /**
        Metodo que permite cambiar el estado la atencion de un turno en recepcion a distraido
    */
    public function distraido(Request $request){
        $id_turno = $request->input('id');
        $id_modulo = $request->input('id_modulo');
        $turno = Turnos::find($id_turno);
        if ($turno->cantLlamados == 3) {
            $turno->estado = 4;
            $turno->save();            
        }else{
            $turno->estado = 2;
            $turno->enTV = 0;
            $turno->cantLlamados = $turno->cantLlamados + 1;
            $turno->save();
        }
        return $this->llamar($id_modulo, 1);
    }
    /**
        Metodo que permite finalizar la atencion de un turno en recepcion
    */
    public function finalizar(Request $request){
        $id_turno = $request->input('id');
        $id_modulo = $request->input('id_modulo');
        $turno = Turnos::find($id_turno);
        $turno->estado = 4;
        $turno->save();        
        return $this->llamar($id_modulo,0);
    }
 
    /**
        Metodo que permite cargar la vista de la informadora
    */
    public function viewLlamarTurno($id){
        $nombre = Modulo::find($id)->nombre;
        return view('turno.llamar', compact('nombre','id'));
    }

    //-------------------------------------------------------
    //              PANTALLA TV
    //-------------------------------------------------------

    /**
        Metodo POST para mostrar los turnos disponibles en la pantalla
    */
    public function mostrarTV(Request $request){
        return Turnos::where("enTV", 0)->where(function ($q) {
            $q->where('estado',1)->orWhere('estado',8);
        })->has('modulos')->with('modulos')->take(5)->get();
    }
    /**
        Metodo POST para quitar los turnos disponibles de la pantalla
    */
    public function quitarTV(Request $request){
        $id = $request->input("id");
        $turno = Turnos::find($id);
        $turno->enTV = 1;
        $turno->save();
    }
}
