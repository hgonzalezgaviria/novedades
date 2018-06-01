<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

use App\Models\Postulacione;
use App\Models\Vacante;
use App\Models\Empresa;
use App\Models\Propietario;


class PostulacioneController extends Controller
{
	protected $route = 'core.postulaciones';
	protected $class = Postulacione::class;

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
		$postulaciones = Postulacione::leftJoin('PROPIETARIOS', 'PROPIETARIOS.PROP_ID', '=', 'POSTULACIONES.PROP_ID')
							->leftJoin('VACANTES', 'VACANTES.VACA_ID', '=', 'POSTULACIONES.VACA_ID')
							->leftJoin('EMPRESAS', 'EMPRESAS.EMPR_ID', '=', 'VACANTES.EMPR_ID')
							->select([
							'POSTULACIONES.VACA_ID',
							'EMPRESAS.EMPR_DESCRIPCION',
							'VACA_FECHAINICIO',
							'VACA_FECHAFIN',
							'VACA_REQUISITOS',
							'VACA_PROGRAMA',
							'POST_FECHA',
							'PROP_CEDULA',
							'PROP_NOMBRE',
							'PROP_CORREO',
							'POST_ID',
							'VACA_SALARIO',

						])->get();



		return view($this->route.'.index', compact('postulaciones'));
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
	 * @param  int  $POST_ID
	 * @return Response
	 */
	public function edit($POST_ID)
	{
		$postulacione = Postulacione::findOrFail($POST_ID);
		return view($this->route.'.edit', compact('postulacione'));
	}

	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $POST_ID
	 * @return Response
	 */
	public function update($POST_ID)
	{
		parent::updateModel($POST_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $POST_ID
	 * @return Response
	 */
	public function destroy($POST_ID)
	{
		parent::destroyModel($POST_ID);
	}

	private function getArraysSelect()
	{
		//Se crea un array con los vehiculos disponibles
		//$arrVehiculos = model_to_array(Vehiculo::class, 'VEHI_PLACA');

		//return compact('arrVehiculos');
	}

}

