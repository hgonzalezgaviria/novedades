<?php

namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Postulacione extends ModelWithSoftDeletes
{

	//Nombre de la tabla en la base de datos
	protected $table = 'POSTULACIONES';
    protected $primaryKey = 'POST_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'POST_FECHACREADO';
	const UPDATED_AT = 'POST_FECHAMODIFICADO';
	const DELETED_AT = 'POST_FECHAELIMINADO';
	protected $dates = ['POST_FECHACREADO', 'POST_FECHAMODIFICADO', 'POST_FECHAELIMINADO'];

	protected $fillable = [
		'PROP_ID',
		'VACA_ID',
		'POST_FECHA',
		
	];

	public static function rules($id = 0){
		$rules = [
			'PROP_ID' => ['required'],
			'VACA_ID' => ['required'],
			'POST_FECHA' => ['required'],
			
		];
		return $rules;
	}
	



	public function vacantes()
	{
		$foreingKey = 'VACA_ID';
		return $this->hasMany(Vacante::class, $foreingKey);
	}


	public function propietario()
	{
		$foreingKey = 'PROP_ID';
		return $this->belongsTo(Propietario::class, $foreingKey);
	}

}
