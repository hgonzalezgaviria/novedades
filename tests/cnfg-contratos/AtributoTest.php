<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Atributo;

class AtributoTest extends TestCase
{
	private $url = '/cnfg-contratos/atributos';

	public function testCreate()
	{
		$admin = $this->findUser('admin');
		$this->be($admin); //You are now authenticated
		$this->actingAs($admin)
			->visit($this->url)
			->see('Atributos')
			->click('create')
			->seePageIs($this->url.'/create')
			->see('Nuevo Atributo');

		$this->type('Prueba', 'ATRI_DESCRIPCION')
			->type('Prueba phpunit', 'ATRI_OBSERVACIONES')
			->press('submit')
			->seeInDatabase('ATRIBUTOS', ['ATRI_DESCRIPCION' => 'PRUEBA'])
			->seePageIs($this->url);
	}

	public function testModify()
	{
		$admin = $this->findUser('admin');
		$this->be($admin); //You are now authenticated

		$model = Atributo::where('ATRI_DESCRIPCION','PRUEBA')->get()->first();
		$this->actingAs($admin)
			->visit($this->url.'/'.$model->ATRI_ID.'/edit')
			->see('Actualizar Atributo')
			->type('Prueba phpunit EDITADO', 'ATRI_DESCRIPCION')
			->type('', 'ATRI_OBSERVACIONES')
			->press('submit');

		$this->seeInDatabase('ATRIBUTOS', ['ATRI_DESCRIPCION'=>'PRUEBA PHPUNIT EDITADO']);
	}

/*	public function testDelete()
	{
		$admin = $this->findUser('admin');
		$this->be($admin); //You are now authenticated

		//Admin no se puede borrar, debe presentar error 302
		$responseDelete = $this->call('POST', $this->url.'/'.$admin->id, ['_method' => 'DELETE']);
		$this->assertEquals(302, $responseDelete->status()); //Cod 302 => Redirect

		//$this->seeInDatabase('users', ['username' => 'admin'])
		//	->seeInSession('modal-danger', '¡Usuario admin no se puede borrar!');

		//Borrando usuario de prueba
		$responseDelete = $this->call('POST', $this->url.'/'.$admin->id, ['_method' => 'DELETE']);
		$this->assertEquals(302, $responseDelete->status()); //Cod 302 => Redirect
		$this->notSeeInDatabase('users', ['username' => 'prueba'])
			->seeInSession('alert-warning', ['¡Usuario prueba borrado!']);

	}
*/

	public function testPermissions()
	{
		$superoper = $this->findUser('superoper');
		$url = [
			$this->url,
			$this->url.'/create',
			$this->url.'/1/edit',
		];
		$this->validatePermissions($superoper, $url);

		$model = Atributo::where('ATRI_DESCRIPCION','PRUEBA PHPUNIT EDITADO')->get()->first();
		$responseDelete = $this->actingAs($superoper)
							->call('POST', $this->url.'/'.$model->ATRI_ID, ['_method' => 'DELETE']);
		$this->assertEquals(403, $responseDelete->status()); //Cod 403 => Redirect
        $this->see('Error 403: Forbidden');
	}


}
