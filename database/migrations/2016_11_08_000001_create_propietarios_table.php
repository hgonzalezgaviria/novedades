<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropietariosTable extends Migration
{
    
    private $nomTabla = 'PROPIETARIOS';

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

            $table->increments('PROP_ID');
            $table->unsignedInteger('PROP_CEDULA');
            $table->string('PROP_NOMBRE', 300)->comment('Nombre del propietario');
            $table->string('PROP_APELLIDO', 300)->comment('Apellido del propietario');
            $table->string('PROP_CORREO', 300)->comment('Apellido del propietario');
            $table->string('PROP_PASS', 300)->comment('Apellido del propietario');
            
            //Traza
            $table->string('PROP_CREADOPOR')
                ->comment('Usuario que creó el registro en la tabla');
            $table->timestamp('PROP_FECHACREADO')
                ->comment('Fecha en que se creó el registro en la tabla.');
            $table->string('PROP_MODIFICADOPOR')->nullable()
                ->comment('Usuario que realizó la última modificación del registro en la tabla.');
            $table->timestamp('PROP_FECHAMODIFICADO')->nullable()
                ->comment('Fecha de la última modificación del registro en la tabla.');
            $table->string('PROP_ELIMINADOPOR')->nullable()
                ->comment('Usuario que eliminó el registro en la tabla.');
            $table->timestamp('PROP_FECHAELIMINADO')->nullable()
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
