<?php

namespace App\Http\Controllers;

use App\Sede;
use Illuminate\Http\Request;
use App\User;
use App\Modulo;
use App\MotivoPausa;
use App\TipoPaciente;

class SedeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sedes = Sede::all();
        return view('sede.index', compact('sedes'));    
    }


    public function login(Request $request){
        $documento = $request->input('documento');
        $modulo_id = $request->input('recepcionModulo');
        $sede_id = $request->input('recepcionSede');
        $modulo = Modulo::find($modulo_id);
        $user = User::where('username', $documento)->get()[0];
        $user_id = $user->id;        
        $nombre = $user->name;
        $id = $modulo->id;

        if($modulo->tipo == 1){
            //LLamado de turno
            $nombreModulo = $modulo->nombre;
            $motivoPausa = MotivoPausa::all();
            return view('turno.llamar', compact('nombreModulo', 'id', 'motivoPausa', 'nombre', 'user_id'));
        }else if ($modulo->tipo == 3) {
            //Información
            $tipoPaciente = TipoPaciente::where('tipo',0)->get();
            return view("turno.entrega", compact('tipoPaciente', 'id', 'nombre', 'user_id'));
        } else if ($modulo->tipo == 4) {
            //Administración
            return view('admin.index', compact('nombre','user_id'));
        } else if ($modulo->tipo == 5) {
            //LLamado de turno
            $nombreModulo = $modulo->nombre;
            $motivoPausa = MotivoPausa::all();
            //AnaliExpress
            return view('turno.llamarAnaliexpress', compact('nombreModulo', 'id', 'motivoPausa', 'nombre', 'user_id'));
        } 
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
     * @param  \App\Sede  $sede
     * @return \Illuminate\Http\Response
     */
    public function show(Sede $sede)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sede  $sede
     * @return \Illuminate\Http\Response
     */
    public function edit(Sede $sede)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sede  $sede
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sede $sede)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sede  $sede
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sede $sede)
    {
        //
    }
}
