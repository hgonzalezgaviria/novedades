<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    
    private $nomTabla = 'EMPRESAS';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = $this->nomTabla.': ';

        echo '- Creando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::create($this->nomTabla, function (Blueprint $table) {

            $table->increments('EMPR_ID');
            $table->string('EMPR_DESCRIPCION', 300)->comment('Nombre de la empresa');
            $table->double('EMPR_LATITUD', 15, 9);
            $table->double('EMPR_LOGITUD', 15, 9);
            
            $table->string('EMPR_DIRECCION', 300)->comment('Nombre del propietario');
             $table->boolean('EMPR_ESTADO');
            
            
            //Traza
            $table->string('EMPR_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('EMPR_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('EMPR_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('EMPR_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('EMPR_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('EMPR_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');

         

        });
        
        if(env('DB_CONNECTION') == 'pgsql')
            DB::statement("COMMENT ON TABLE ".env('DB_SCHEMA').".\"".$this->nomTabla."\" IS '".$commentTabla."'");
        elseif(env('DB_CONNECTION') == 'mysql')
            DB::statement("ALTER TABLE ".$this->nomTabla." COMMENT = '".$commentTabla."'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        echo '- Borrando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::dropIfExists($this->nomTabla);
    }

}
