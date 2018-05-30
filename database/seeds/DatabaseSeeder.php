<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(MenuTableSeeder::class);
		
        $this->call(PropietariosTableSeeder::class);
        $this->call(EmpresasTableSeeder::class);
        $this->call(VacantesTableSeeder::class);
      //  $this->call(TarjetasTableSeeder::class);
       // $this->call(HorariosTableSeeder::class);
        
        
        
    }
}
