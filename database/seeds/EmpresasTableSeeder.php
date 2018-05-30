<?php

use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
            'EMPR_DESCRIPCION'=>'SMART FINANCIAL',
            'EMPR_LATITUD'=>3.492501000,
            'EMPR_LOGITUD'=>-76.522627000,
            'EMPR_DIRECCION'=>'#5BN-146, Calle 64N, Cali, Valle del Cauca, Colombia',
            'EMPR_ESTADO'=>true,
            
        ]);
        Empresa::create([
              'EMPR_DESCRIPCION'=>'PROCESOS Y TECNOLOGIA',
            'EMPR_LATITUD'=>3.3987421,
            'EMPR_LOGITUD'=>-76.5318036,
            'EMPR_DIRECCION'=>'#5BN-146, Calle 64N, Cali, Valle del Cauca, Colombia',
            'EMPR_ESTADO'=>true,
            
        ]);

           Empresa::create([
              'EMPR_DESCRIPCION'=>'Coordinadora Mercantil S.A',
            'EMPR_LATITUD'=>3.448344000,
            'EMPR_LOGITUD'=>-76.534536800,
            'EMPR_DIRECCION'=>'Cl. 9 #5-59, Cali, Valle del Cauca',
            'EMPR_ESTADO'=>true,
            
        ]);
        
    }
}