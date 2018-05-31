<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacantesTable extends Migration
{
    
    private $nomTabla = 'VACANTES';

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

            $table->increments('VACA_ID');            
            $table->unsignedInteger('EMPR_ID');
            $table->dateTime('VACA_FECHAINICIO');
            $table->dateTime('VACA_FECHAFIN')->nullable();
             $table->string('VACA_REQUISITOS', 500)->comment('Nombre del propietario');
             $table->string('VACA_PROGRAMA', 300)->comment('Nombre del propietario');
            $table->double('VACA_SALARIO', 12,2 )->nullable();

            $table->boolean('VACA_ESTADO');
            
            //Traza
            $table->string('VACA_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('VACA_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('VACA_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('VACA_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('VACA_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('VACA_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');



            //Relaciones
            $table->foreign('EMPR_ID')
            ->references('EMPR_ID')
            ->on('EMPRESAS')
            ->onDelete('cascade');

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
