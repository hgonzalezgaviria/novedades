<?php
namespace App\Http\Controllers\Reportes;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;


class ReporteController extends Controller
{
	protected $data = null;

	private $reportes = [

		/*Bloque para reportes de Prospectos*/
		//==============================================================================================
		['id'=>'AccesosFechas', 'title'=>'100 - ACCESOS ENTRE FECHAS', 'filterRequired' => true],
		['id'=>'AccesosUsuarios', 'title'=>'101 - ACCESOS POR USUARIO', 'filterRequired' => true],
		
		//==============================================================================================
	];

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:reportes');
		//Datos recibidos desde la vista.
		$this->data = parent::getRequest();
	}

	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function index()
	{
		$arrReportes = $this->reportes;
		return view('reportes.index', compact('arrReportes'));
	}

	public function viewForm(Request $request)
	{
		$form = $request->input('form');

		return response()->json(view('reportes.formRep'.$form)->render());
	}


	/**
	 * 
	 *
	 * @return Response
	 */
	protected function buildJson($query, $columnChart = null)
	{
		$colletion = $query->get();
		$keys = $data = [];

		if(!$colletion->isEmpty()){
			$keys = array_keys($colletion->first()->toArray());
			$data = array_map(function ($arr){
					return array_flatten($arr);
				}, $colletion->toArray());
		}
		return response()->json(compact('keys', 'data', 'columnChart'));
	}

}
