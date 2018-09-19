<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoPaciente;
use App\Turnos;
use App\Modulo;
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
        $turnoSiguiente = Turnos::where("estado", 0)->take(1)->get()->get(0);
        $turnoSiguiente->estado = 1;
        $turnoSiguiente->modulo = "Cubiculo x";
        $turnoSiguiente->save();
        return $turnoSiguiente;
    }

    public function viewLlamarTurno($id){
        $nombre = Modulo::find($id)->nombre;
        return view('turno.llamar', compact('nombre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
