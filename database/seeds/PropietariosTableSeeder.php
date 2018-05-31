<?php

use Illuminate\Database\Seeder;
use App\Models\Propietario;

class PropietariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

           Propietario::create([
            'PROP_CEDULA'    => 1144042747,
            'PROP_NOMBRE'    => 'HECTOR',
            'PROP_APELLIDO'  => 'GONZALEZ',
            'PROP_CORREO' => 'hfg@gmail.com',
            'PROP_PASS' => 'zxcvbnm1',
            'PROP_CREADOPOR' => 'PRUEBA',
        ]);

        Propietario::create([
            'PROP_CEDULA'    => 1130615462,
            'PROP_NOMBRE'    => 'DIEGO',
            'PROP_APELLIDO'  => 'CORTES',
            'PROP_CORREO' => 'dc@gmail.com',
            'PROP_PASS' => '123456',
            'PROP_CREADOPOR' => 'PRUEBA',
            
        ]);
        Propietario::create([
            'PROP_CEDULA'    => 1144263850,
            'PROP_NOMBRE'    => 'KEVIN',
            'PROP_APELLIDO'  => 'RODRIGUEZ',
            'PROP_CORREO' => 'kr@gmail.com',
            'PROP_PASS' => '123456',
            'PROP_CREADOPOR' => 'PRUEBA',
        ]);
    }
}