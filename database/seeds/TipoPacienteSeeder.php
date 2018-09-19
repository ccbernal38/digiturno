<?php

use Illuminate\Database\Seeder;

class TipoPacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(App\TipoPaciente::class, 50)->create()->each(function ($u) {
        $u->posts()->save(factory(App\TipoPaciente::class)->make());
    });
        DB::table('tipo_paciente')->insert([
            'nombre' => "General",
            'sigla' => "G",
            'prioridad' => 0,
            'consecutivo' =>0,
        ]);
        DB::table('tipo_paciente')->insert([
            'nombre' => "Prioritarios sin discapacidad (Mayores a 65 años)",
            'sigla' => "PS",
            'prioridad' => 1,
            'consecutivo' =>0,
        ]);
        DB::table('tipo_paciente')->insert([
            'nombre' => "Paciente con discapacidad",
            'sigla' => "PD",
            'prioridad' => 1,
            'consecutivo' =>0,
        ]);
        DB::table('tipo_paciente')->insert([
            'nombre' => "Niños menores a 10 años",
            'sigla' => "K",
            'prioridad' => 0,
            'consecutivo' =>0,
        ]);
       	DB::table('tipo_paciente')->insert([
            'nombre' => "Mujeres embarazadas",
            'sigla' => "ME",
            'prioridad' => 1,
            'consecutivo' =>0,
        ]);
    }
}
