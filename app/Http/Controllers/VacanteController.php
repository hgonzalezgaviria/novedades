<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;

use LaravelFCM\Message\Topics;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;


header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        ob_end_flush();


use App\Models\Vacante;
use App\Models\Empresa;
use App\Models\Propietario;
use App\Models\Postulacione;

use Carbon\Carbon;

class VacanteController extends Controller
{
	protected $route = 'core.vacantes';
	protected $class = Vacante::class;

	public function __construct()
	{
		//parent::__construct();
		$this->middleware('auth')->except(['getVacantes','getVacantesUbicacion','addPostulacion','validarUsuario','getVacantesUsuarios']);

	}

	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function index()
	{
		$vacantes = Vacante::leftJoin('EMPRESAS', 'EMPRESAS.EMPR_ID', '=', 'VACANTES.EMPR_ID')		
						->select([
							'VACA_ID',
							'EMPR_DESCRIPCION',
							'VACA_FECHAINICIO',
							'VACA_FECHAFIN',
							'VACA_REQUISITOS',
							'VACA_PROGRAMA',														
							'VACA_ARCHIVO',
							'VACA_ESTADO',							
						])->get();
		

		//dd($arrPropietarios );
		//$arrPropietarios = model_to_array(Propietario::class, $PROP_NOMBRECOMPLETO);

		//$arrTarjetas = model_to_array(Tarjeta::class, 'TARJ_IDTAG',[['CAMPO_FILTRO','=',valor]]);
		
		$getArrEmpresas = model_to_array(Empresa::class, 'EMPR_DESCRIPCION');
		//dd($getArrEmpresas);
/*
			$arrTarjetas = Tarjeta::select([
					'TARJ_IDTAG',								
				])->get();
				*/

		return view($this->route.'.index', compact('vacantes','getArrEmpresas'));
	}



	/**
	 * Muestra el formulario para crear un nuevo registro.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view($this->route.'.create', $this->getArraysSelect());
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
	 * @param  int  $VACA_ID
	 * @return Response
	 */
	public function edit($VACA_ID)
	{
		$vacante = Vacante::findOrFail($VACA_ID);
		return view($this->route.'.edit', $this->getArraysSelect()+compact('vacante'));
	}

	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  int  $VACA_ID
	 * @return Response
	 */
	public function update($VACA_ID)
	{
		parent::updateModel($VACA_ID);
	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  int  $VACA_ID
	 * @return Response
	 */
	public function destroy($VACA_ID)
	{
		parent::destroyModel($VACA_ID);
	}

	
	private function getArraysSelect()
	{

		$getArrEmpresas = model_to_array(Empresa::class, 'EMPR_DESCRIPCION');

		return compact('getArrEmpresas');
		
	}

	

	public function getVacantes()
	{
			/*	
				$vacantes = Vacante::leftJoin('EMPRESAS', 'EMPRESAS.EMPR_ID', '=', 'VACANTES.EMPR_ID')		
						->select([
							'VACA_ID',
							'EMPR_DESCRIPCION',
							'VACA_FECHAINICIO',
							'VACA_FECHAFIN',
							'VACA_REQUISITOS',
							'VACA_PROGRAMA',						
						])->get();
		



		return response()->json(compact('vacantes'));
		*/

		return Vacante::leftJoin('EMPRESAS', 'EMPRESAS.EMPR_ID', '=', 'VACANTES.EMPR_ID')		
						->select([
							'VACA_ID',
							'EMPR_DESCRIPCION',
							'VACA_FECHAINICIO',
							'VACA_FECHAFIN',
							'VACA_REQUISITOS',
							'VACA_PROGRAMA',						
						])->get()->toJson();
		
	}


	public function getVacantesUbicacion()
	{
		
		return Vacante::leftJoin('EMPRESAS', 'EMPRESAS.EMPR_ID', '=', 'VACANTES.EMPR_ID')		
						->select([
							'VACA_ID',
							'EMPR_DESCRIPCION',
							'VACA_FECHAINICIO',
							'VACA_FECHAFIN',
							'VACA_REQUISITOS',
							'VACA_PROGRAMA',
							'EMPR_LATITUD',
							'EMPR_LOGITUD',
						])->get()->toJson();
		
	}

		public function addPostulacion(Request $request)
				{

					$id = $request->input('id');
					$idUser = $request->input('idUsuario');
					//sdd($id);

					$postulacion = Postulacione::with('propietario')
					->where('VACA_ID', $id)
					->where('PROP_ID', $idUser)
							//->where('TARJ_ESTADO', true)
							->has('propietario')
							->get()->first();

						if(isset($postulacion)){
						
					return json_encode(["success" => "Ya esta postulado a esta vacante"]);
			}else{
				Postulacione::create([
								'PROP_ID'=>$idUser,
								'VACA_ID'=>$id,
								'POST_FECHA'=>Carbon::now(),								
							]);
						return json_encode(["success" => "Se  ha postulado a la Vacante"]); //Entra

						}

						
			}		



	public function validarUsuario(Request $request)
	{
		$mail = $request->input('mail');
		$pass = $request->input('pass');


		$propietarios = Propietario::select([
					'PROP_ID',
					'PROP_CEDULA',
					'PROP_NOMBRE',
					'PROP_APELLIDO',
					'PROP_CORREO',
					'PROP_PASS',
				])->where('PROP_CORREO', $mail)
				->where('PROP_PASS', $pass)
				->get()->first();

				if(isset($propietarios)){
					//return json_encode(["success" => 1]);
					return json_encode($propietarios);
				}

			

		return json_encode(["success" => 2]);
		
		
	}

	public function getVacantesUsuarios(Request $request)
	{
		

		$user = $request->input('user');

		return Postulacione::leftJoin('PROPIETARIOS', 'PROPIETARIOS.PROP_ID', '=', 'POSTULACIONES.PROP_ID')
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

						])->where('PROPIETARIOS.PROP_ID', $user)
						->get()->toJson();
		
	}
	

}