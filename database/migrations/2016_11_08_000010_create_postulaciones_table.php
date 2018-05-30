<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostulacionesTable extends Migration
{
    
    private $nomTabla = 'POSTULACIONES';

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

            $table->increments('POST_ID');            
            $table->unsignedInteger('PROP_ID');
            $table->unsignedInteger('VACA_ID');
            $table->dateTime('POST_FECHA');            

                        
            //Traza
            $table->string('POST_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('POST_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('POST_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('POST_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('POST_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('POST_FECHAELIMINADO')->nullable()
                ->comment('Fecha en que se eliminó el registro en la tabla.');



            //Relaciones
            $table->foreign('PROP_ID')
            ->references('PROP_ID')
            ->on('PROPIETARIOS')
            ->onDelete('cascade');

             $table->foreign('VACA_ID')
            ->references('VACA_ID')
            ->on('VACANTES')
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
