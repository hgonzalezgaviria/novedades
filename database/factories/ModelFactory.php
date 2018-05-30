<?php

use App\Models\User;
use App\Models\Ticket;
use App\Models\EstadoTicket;
use App\Models\EstadoAprobacion;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'role' => 'editor',
        'USER_creadopor' => 'SYSTEM',
        'USER_fechacreado' => \Carbon\Carbon::now()->toDateTimeString(),
    ];
});


$factory->define(Ticket::class, function (Faker\Generator $faker) {

    $CONT_ID = array_rand(model_to_array(Contrato::class, 'CONT_FECHAINGRESO'));
    $ESTI_ID = array_rand(model_to_array(EstadoTicket::class, 'ESTI_DESCRIPCION'));

    $ESAP_ID = array_rand(model_to_array(EstadoAprobacion::class, 'ESAP_DESCRIPCION'));
    
    $TICK_FECHAAPROBACION = null;
    $TICK_FECHACIERRE = null;
    switch ($ESAP_ID) {
        case EstadoAprobacion::ENVIADO:
            $TICK_FECHAAPROBACION = $faker->dateTime();
            break;
        case EstadoAprobacion::FINALIZADO:
        case EstadoAprobacion::RECHAZADO:
            $TICK_FECHACIERRE = $faker->dateTime();
            $ESTI_ID = EstadoTicket::CERRADO;
            break;
    }

    $SANC_ID = null;
    if($ESAP_ID == EstadoAprobacion::FINALIZADO)
        $SANC_ID = array_rand(model_to_array(Sancion::class, 'SANC_DESCRIPCION'));

    $arrPrioridad = model_to_array(Prioridad::class, 'PRIO_DESCRIPCION');
    $arrCategorias = model_to_array(Categoria::class, 'CATE_DESCRIPCION');
    $arrTiposIncidentes = model_to_array(TipoIncidente::class, 'TIIN_DESCRIPCION');
    $arrTurnos = model_to_array(Turno::class, 'TURN_DESCRIPCION');
    $arrGrupos = model_to_array(Grupo::class, 'GRUP_DESCRIPCION');
    $arrUsers = model_to_array(User::class, 'username');

    return [
        'TICK_DESCRIPCION' => '"'.$faker->sentence().'"',
        'TICK_OBSERVACIONES' => '"'.$faker->sentence().'"',
        'TICK_FECHASOLICITUD' => $faker->dateTime(),
        'TICK_FECHAEVENTO' => $faker->dateTime(),
        'TICK_FECHACUMPLIMIENTO' => $faker->dateTime(),
        //'TICK_ARCHIVO',
        'CONT_ID' => $CONT_ID,
        'ESTI_ID' => $ESTI_ID,
        'ESAP_ID' => $ESAP_ID,
        'TICK_FECHAAPROBACION' => $TICK_FECHAAPROBACION,
        'TICK_FECHACIERRE' => $TICK_FECHACIERRE,
        'SANC_ID' => $SANC_ID,
        'PRIO_ID' => array_rand($arrPrioridad),
        'CATE_ID' => array_rand($arrCategorias),
        'TIIN_ID' => array_rand($arrTiposIncidentes),
        'TURN_ID' => array_rand($arrTurnos),
        'GRUP_ID' => array_rand($arrGrupos),
        'USER_ID' => array_rand($arrUsers),
        'TICK_CREADOPOR' => 'PRUEBAS',
    ];
});




/*
$factory->define(Encuesta::class, function (Faker\Generator $faker) {
    return [
        'ENCU_titulo' => str_limit($faker->paragraph(1), 30),
        'ENCU_descripcion' => str_limit($faker->paragraph, 230),
        'ESEN_id' => rand(1,4),
        'ENCU_fechavigencia' => $faker->dateTime(),
        'ENCU_creadopor' => 'editor2',
        'ENCU_plantilla' => false,
        'ENCU_plantillapublica' => false,
    ];
});

$factory->define(Pregunta::class, function (Faker\Generator $faker) {
    return [
        'PREG_texto' => '¿'.$faker->paragraph(1).'?',
        'TIPR_id' => rand(1,4),
        'PREG_creadopor' => 'admin',
    ];
});


$factory->define(ItemPreg::class, function (Faker\Generator $faker) {
    return [
        'ITPR_texto' => $faker->paragraph,
        'ITPR_creadopor' => 'admin',
    ];
});

$factory->define(Respuesta::class, function (Faker\Generator $faker) {
    return [
        'RESP_valor' => (Integer)($faker->numberBetween($min = 1, $max = 5)) ,
        'RESP_creadopor' => 'pepe',
    ];
});
*/