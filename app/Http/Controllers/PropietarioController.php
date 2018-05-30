<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

use App\Models\Propietario;

class PropietarioController extends Controller
{
	protected $route = 'core.propietarios';
	protected $class = Propietario::class;

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function index()
	{
		$propietarios = Propietario::select([
					'PROP_ID',
					'PROP_CEDULA',
					'PROP_NOMBRE',
					'PROP_APELLIDO',
					'PROP_PASS',
				])->get();

		return view($this->route.'.index', compact('propietarios'));
	}


	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view($this->route.'.create');
	}

	/**
	 * Guarda el registro nuevo en la base de datos.
	 *
	 * @return Response
	 */
	public function store()
	{
		parent::storeModel();
	}

	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $PROP_ID
	 * @return Response
	 */
	public function edit($PROP_ID)
	{
		$propietario = Propietario::findOrFail($PROP_ID);
		return view($this->route.'.edit', compact('propietario'));
	}

	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $PROP_ID
	 * @return Response
	 */
	public function update($PROP_ID)
	{
		parent::updateModel($PROP_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $PROP_ID
	 * @return Response
	 */
	public function destroy($PROP_ID)
	{
		parent::destroyModel($PROP_ID);
	}

	private function getArraysSelect()
	{
		//Se crea un array con los vehiculos disponibles
		//$arrVehiculos = model_to_array(Vehiculo::class, 'VEHI_PLACA');

		//return compact('arrVehiculos');
	}

}

