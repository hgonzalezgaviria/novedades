<?php

namespace App\Models;

use App\Traits\RelationshipsTrait;

use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Contracts\UserResolver;

use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements AuditableContract, UserResolver
{
	use EntrustUserTrait, RelationshipsTrait, AuditableTrait;

	//Nombre de la tabla en la base de datos
	protected $table = 'users';
    //protected $primaryKey = 'id';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'modified_at';
	const DELETED_AT = 'deleted_at';
	protected $dates = ['created_at', 'modified_at', 'deleted_at'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'username',
		'cedula',
		'email',
		'password',
		'USER_CREADOPOR',
		'USER_MODIFICADOPOR',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	public static function rules($id = 0){
		return [
			'name'      => 'required|max:255',
			'username'  => ['required','max:15',static::unique($id,'username')],
			'cedula'    => ['required','max:15',static::unique($id,'cedula')],
			'email'     => ['required','email','max:320',static::unique($id,'email')],
			'roles_ids' => 'required|array',
			'password'  => 'required|min:6|confirmed',
		];
	}

    protected static function unique($id, $column, $table = null){
        $instance = new static;
        if(!isset($table))
            $table = $instance->table;
        return 'unique:'.$table.','.$column.','.$id.','.$instance->getKeyName();
    }

	//establecemos las relaciones con el modelo Role, ya que un usuario puede tener varios roles
	//y un rol lo pueden tener varios usuarios
	public function roles(){
		return $this->belongsToMany(Role::class);
	}

	/*
	 * Relación users-EMPLEADORES (muchos a muchos). 
	 */
	public function empleadores()
	{
		$foreingKey = 'USER_ID';
		$otherKey   = 'EMPL_ID';
		return $this->belongsToMany(Empleador::class, 'USUARIOS_EMPLEADORES', $foreingKey,  $otherKey);
	}

	/*
	 * Relación users-TEMPORALES (muchos a muchos). 
	 */
	public function temporales()
	{
		$foreingKey = 'USER_ID';
		$otherKey   = 'TEMP_ID';
		return $this->belongsToMany(Temporal::class, 'USUARIOS_TEMPORALES', $foreingKey,  $otherKey);
	}

	/*
	 * Relación users-GERENCIAS (muchos a muchos). 
	 */
	public function gerencias()
	{
		$foreingKey = 'USER_ID';
		$otherKey   = 'GERE_ID';
		return $this->belongsToMany(Gerencia::class, 'USUARIOS_GERENCIAS', $foreingKey,  $otherKey);
	}

	public function tickets()
	{
		$foreingKey = 'USER_ID';
		return $this->hasMany(Ticket::class, $foreingKey);
	}

    /**
     * Perform the actual delete query on this model instance.
     * 
     * @return void
     */
    protected function runSoftDelete()
    {
        $query = $this->newQueryWithoutScopes()->where($this->getKeyName(), $this->getKey());

        $this->{$this->getDeletedAtColumn()} = $time = $this->freshTimestamp();

        $prefix = strtoupper(substr($this::CREATED_AT, 0, 4));
        $deleted_by = $prefix.'_ELIMINADOPOR';

        $query->update([
           $this->getDeletedAtColumn() => $this->fromDateTime($time),
           $deleted_by => auth()->user()->username
        ]);

        //$deleted_by => (\Auth::id()) ?: null
    }


    protected static function boot() {
        parent::boot();

        static::creating(function($model) {
            $model->username = strtolower($model->username);
            if(!isset($model->USER_CREADOPOR))
            	$model->USER_CREADOPOR = auth()->check() ? auth()->user()->username : 'SYSTEM';
            return true;
        });
        static::updating(function($model) {
            $model->USER_MODIFICADOPOR = auth()->check() ? auth()->user()->username : 'SYSTEM';
            return true;
        });
    }

    public static function resolveId() {
    	return auth()->check() ? auth()->user()->getAuthIdentifier() : null;
    }
}
