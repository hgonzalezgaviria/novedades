<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\User;
use App\Models\Role;

class UserTest extends TestCase
{

	public function testCreate()
	{
		$admin = $this->findUser('admin');
		$this->be($admin); //You are now authenticated
		$this->actingAs($admin)
			->visit('/auth/usuarios')
			->see('Usuarios Locales')
			->click('create')
			->seePageIs('/register')
			->see('Nuevo usuario');

		$userTest = $this->findUser('prueba');
		if(isset($userTest))
			$userTest->forceDelete();

		$this->type('prueba', 'username')
			->type('Prueba phpunit', 'name')
			->type('123456789', 'cedula')
			->type('ad@ad.com', 'email')
			->select([Role::ADMIN, Role::OWNER], 'roles_ids')
			->type('123456789', 'password')
			->type('123456789', 'password_confirmation')
			->press('submit')
			->followRedirects()
			->seeInDatabase('users', ['username' => 'prueba']);
	}

	public function testModify()
	{
		$admin = $this->findUser('admin');
		$this->be($admin); //You are now authenticated

		$userTest = $this->findUser('prueba');

		$this->actingAs($admin)
			->visit('/auth/usuarios/'.$userTest->id.'/edit')
			->see('Actualizar usuario')
			->type('Prueba phpunit EDITADO', 'name')
			->select([Role::EMPLEADO], 'roles_ids')
			->select([2,3], 'EMPL_ids')
			->select([1,2], 'GERE_ids')
			->press('submit')
			->followRedirects();

		$this->seeInDatabase('users', ['username'=>'prueba', 'name'=>'Prueba phpunit EDITADO'])
			->seeInDatabase('role_user', ['user_id'=>$userTest->id, 'role_id'=>Role::EMPLEADO])
			->notSeeInDatabase('role_user', ['user_id'=>$userTest->id, 'role_id'=>Role::ADMIN])
			->seeInDatabase('USUARIOS_EMPLEADORES', ['USER_ID'=>$userTest->id, 'EMPL_ID'=>2])
			->seeInDatabase('USUARIOS_EMPLEADORES', ['USER_ID'=>$userTest->id, 'EMPL_ID'=>3])
			->seeInDatabase('USUARIOS_GERENCIAS', ['USER_ID'=>$userTest->id, 'GERE_ID'=>1])
			->seeInDatabase('USUARIOS_GERENCIAS', ['USER_ID'=>$userTest->id, 'GERE_ID'=>2]);
	}

	public function testDelete()
	{
		$admin = $this->findUser('admin');
		$this->be($admin); //You are now authenticated

		//Admin no se puede borrar, debe presentar error 302
		$responseDelete = $this->call('POST', 'auth/usuarios/'.$admin->id, ['_method' => 'DELETE']);
		$this->assertEquals(302, $responseDelete->status()); //Cod 302 => Redirect

		$this->seeInDatabase('users', ['username' => 'admin'])
			->seeInSession('modal-danger', '¡Usuario admin no se puede borrar!');

		//Borrando usuario de prueba
		$userTest = $this->findUser('prueba');
		$responseDelete = $this->call('POST', 'auth/usuarios/'.$userTest->id, ['_method' => 'DELETE']);
		$this->assertEquals(302, $responseDelete->status()); //Cod 302 => Redirect
		$this->notSeeInDatabase('users', ['username' => 'prueba'])
			->seeInSession('alert-warning', ['¡Usuario prueba borrado!']);

	}


	public function testPermissions()
	{
		$gesthum = $this->findUser('gesthum1');
		$url = [
			'/auth/usuarios',
			'/auth/usuarios/1/edit',
			'/register',
		];
		$this->validatePermissions($gesthum, $url);

		$responseDelete = $this->actingAs($gesthum)
							->call('POST', 'auth/usuarios/'.$gesthum->id, ['_method' => 'DELETE']);
		$this->assertEquals(403, $responseDelete->status()); //Cod 403 => Redirect
        $this->see('Error 403: Forbidden');
	}


}
