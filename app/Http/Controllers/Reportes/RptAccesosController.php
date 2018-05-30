<?php

namespace App\Http\Controllers\Reportes;
use App\Http\Controllers\Controller;


use \Carbon\Carbon;

use App\Models\Acceso;
use App\Models\Tarjeta;
use App\Models\Propietario;

class RptAccesosController extends ReporteController
{

	public function __construct()
	{
		parent::__construct();
	}


	private function getQuery()
	{


				$query = Acceso::leftJoin('PROPIETARIOS', 'PROPIETARIOS.PROP_ID', '=', 'ACCESOS.PROP_ID')
							->leftJoin('TARJETAS', 'TARJETAS.TARJ_ID', '=', 'ACCESOS.TARJ_ID')
						->select([
							'ACCESOS.ACCE_ID AS ID',
							'PROPIETARIOS.PROP_CEDULA AS CEDULA',
							'PROPIETARIOS.PROP_NOMBRE AS NOMBRE',
							'PROPIETARIOS.PROP_APELLIDO AS APELLIDO',
							'TARJETAS.TARJ_IDTAG AS TARJETA',
							'ACCESOS.ACCE_FECHAENTRADA AS FECHA_ENTRADA',
							'ACCESOS.ACCE_FECHASALIDA AS FECHA_SALIDA',
							'ACCESOS.ACCE_ESTADO AS ESTADO'
						]);



		return $query;
	}

	/**
	 * 
	 *
	 * @return Json
	 */
	public function accesosFechas()
	{
		$query = $this->getQuery()
						->whereDate('ACCE_FECHAENTRADA', '>=', Carbon::parse($this->data['fechaDesde']))
						->whereDate('ACCE_FECHAENTRADA', '<=', Carbon::parse($this->data['fechaHasta']));
					//->whereIn('ESTADOSCONTRATOS.ESCO_ID', [EstadoContrato::ACTIVO, EstadoContrato::VACACIONES, EstadoContrato::RETIRADO]);

		return $this->buildJson($query);
	}

	/**
	 * 
	 *
	 * @return Json
	 */
	public function accesosUsuarios()
	{
		$query = $this->getQuery()
					->where('PROPIETARIOS.PROP_CEDULA', $this->data['PROP_ID']);


		return $this->buildJson($query);
	}


}