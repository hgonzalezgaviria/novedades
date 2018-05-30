<?php

namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Vacante extends ModelWithSoftDeletes
{

	//Nombre de la tabla en la base de datos
	protected $table = 'VACANTES';
    protected $primaryKey = 'VACA_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'VACA_FECHACREADO';
	const UPDATED_AT = 'VACA_FECHAMODIFICADO';
	const DELETED_AT = 'VACA_FECHAELIMINADO';
	protected $dates = ['VACA_FECHACREADO', 'VACA_FECHAMODIFICADO', 'VACA_FECHAELIMINADO'];

	protected $fillable = [
		'VACA_FECHAINICIO',
		'VACA_FECHAFIN',
		'VACA_REQUISITOS',
		'VACA_PROGRAMA',
		'VACA_ARCHIVO',	
		'VACA_ESTADO',	
		'EMPR_ID',
	];

	public static function rules($id = 0){
		$rules = [
			'VACA_FECHAINICIO' => ['required'],
			'VACA_FECHAFIN' => ['required'],
			'VACA_REQUISITOS' => ['required'],
			'VACA_PROGRAMA' => ['required'],
			'VACA_ESTADO' => ['required'],			
			'EMPR_ID' => ['required'],
		];
		return $rules;
	}
	

	public function empresa()
	{
		$foreingKey = 'EMPR_ID';
		return $this->belongsTo(Empresa::class, $foreingKey);
	}

		public function postulacion()
	{
		$foreingKey = 'POST_ID';
		return $this->belongsTo(Postulacione::class, $foreingKey);
	}

}
