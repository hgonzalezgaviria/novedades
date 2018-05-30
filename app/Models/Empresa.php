<?php

namespace App\Models;

use App\Models\ModelWithSoftDeletes;

class Empresa extends ModelWithSoftDeletes
{

	//Nombre de la tabla en la base de datos
	protected $table = 'EMPRESAS';
    protected $primaryKey = 'EMPR_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'EMPR_FECHACREADO';
	const UPDATED_AT = 'EMPR_FECHAMODIFICADO';
	const DELETED_AT = 'EMPR_FECHAELIMINADO';
	protected $dates = ['EMPR_FECHACREADO', 'EMPR_FECHAMODIFICADO', 'EMPR_FECHAELIMINADO'];

	protected $fillable = [
		'EMPR_DESCRIPCION',
		'EMPR_LATITUD',
		'EMPR_LOGITUD',
		'EMPR_DIRECCION',
		'EMPR_ESTADO',
	];

	public static function rules($id = 0){
		$rules = [
			'EMPR_DESCRIPCION' => ['required','max:300'],
			'EMPR_LATITUD'  => ['numeric','required'],
			'EMPR_LOGITUD'  => ['numeric','required'],
			'EMPR_DIRECCION' => ['required'],
			'EMPR_ESTADO' => ['required'],
		];
		return $rules;
	}
	
	public function vacantes()
	{
		$foreingKey = 'VACA_ID';
		return $this->hasMany(Vacante::class, $foreingKey);
	}

}
