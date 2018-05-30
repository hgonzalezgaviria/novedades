<?php
/**
 * This file is part of the Laravel Auditing package.
 *
 * @author     Antério Vieira <anteriovieira@gmail.com>
 * @author     Quetzy Garcia  <quetzyg@altek.org>
 * @author     Raphael França <raphaelfrancabsb@gmail.com>
 * @copyright  2015-2017
 *
 * For the full copyright and license information,
 * please view the LICENSE.md file that was distributed
 * with this source code.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{

    private $nomTabla = '';

    public function __construct(){
        $this->nomTabla = Config::get('audit.drivers.database.table');
    }


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $commentTabla = 'AUDITORÍAS: Registra todas las transacciones realizadas.';

        echo '- Creando tabla '.$this->nomTabla.'...' . PHP_EOL;
        Schema::connection(Config::get('audit.drivers.database.connection'))
            ->create($this->nomTabla, function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger(Config::get('audit.user.foreign_key', 'user_id'))->nullable();
                $table->string('event');
                $table->morphs('auditable');
                $table->text('old_values')->nullable();
                $table->text('new_values')->nullable();
                $table->text('url')->nullable();
                $table->ipAddress('ip_address')->nullable();
                $table->string('user_agent')->nullable();
                $table->timestamps();
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
        Schema::connection(Config::get('audit.drivers.database.connection'))
            ->dropIfExists($this->nomTabla);
    }
}
