<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

use App\Models\Empresa;

class EmpresaController extends Controller
{
	protected $route = 'core.empresas';
	protected $class = Empresa::class;

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

			$empresas = Empresa::select([
							'EMPR_ID',
							'EMPR_DESCRIPCION',
							'EMPR_LATITUD',
							'EMPR_LOGITUD',
							'EMPR_DIRECCION',							
							'EMPR_ESTADO',							
						])->get();

		return view($this->route.'.index', compact('empresas'));
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
	 * @param  int  $EMPR_ID
	 * @return Response
	 */
	public function edit($EMPR_ID)
	{
		$empresa = Empresa::findOrFail($EMPR_ID);
		return view($this->route.'.edit', compact('empresa'));
	}

	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $EMPR_ID
	 * @return Response
	 */
	public function update($EMPR_ID)
	{
		parent::updateModel($EMPR_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $EMPR_ID
	 * @return Response
	 */
	public function destroy($EMPR_ID)
	{
		parent::destroyModel($EMPR_ID);
	}

	

}

