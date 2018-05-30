<?php

namespace App\Models;

use App\Traits\ModelRulesTrait;
//use App\Traits\SoftDeletesTrait;
use App\Traits\RelationshipsTrait;
use Zizaco\Entrust\EntrustPermission;
use OwenIt\Auditing\Contracts\Auditable;

class Permission extends EntrustPermission
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

	public static function rules($id = 0){
		return [
			'name' => 'required|max:60|'.static::unique($id,'name'),
			'display_name' => 'required|max:100|'.static::unique($id,'display_name'),
			'description'  => ['required','max:100'],
		];
	}

	//establecemos las relacion de muchos a muchos con el modelo Role, ya que un permiso
	//lo pueden tener varios roles y un rol puede tener varios permisos
	public function roles(){
		return $this->belongsToMany(Role::class);
	}

	public function menu()
	{
		$foreingKey = 'PERM_ID';
		return $this->hasOne(Menu::class, $foreingKey);
	}

}