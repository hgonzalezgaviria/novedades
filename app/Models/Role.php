<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;
use App\Traits\ModelRulesTrait;
//use App\Traits\SoftDeletesTrait;
use App\Traits\RelationshipsTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends EntrustRole
{
    use RelationshipsTrait, ModelRulesTrait, \OwenIt\Auditing\Auditable;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'display_name',
		'description',
	];

	//Constantes para referenciar los roles primarios
	const OWNER 	= 1;
	const ADMIN 	= 2;
	const GESTHUM	= 3;
	const SUPEROPER	= 4;
	const COOROPER	= 5;
	const EMPLEADO	= 6;
	const EJECUTIVO	= 7;

	public static function rules($id = 0){
		return [
			'name' => 'required|max:15|'.static::unique($id,'name'),
			'display_name' => 'required|max:50|'.static::unique($id,'display_name'),
			'description'  => ['required','max:100'],
		];
	}

	//establecemos las relacion de muchos a muchos con el modelo User, ya que un rol 
	//lo pueden tener varios usuarios y un usuario puede tener varios roles
	public function users(){
		return $this->belongsToMany(User::class);
	}

	//establecemos las relaciones con el modelo Permission, ya que un permiso puede tener varios roles
	//y un rol lo pueden tener varios permisos
	public function permissions(){
		return $this->belongsToMany(Permission::class);
	}

}