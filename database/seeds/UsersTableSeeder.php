<?php
	
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

	class UsersTableSeeder extends Seeder {

        private $rolOwner;
        private $rolAdmin;


		public function run() {

            $pass = '123';
            $date = \Carbon\Carbon::now()->toDateTimeString();
            //$faker = Faker\Factory::create('es_ES');

            //*********************************************************************
           $this->command->info('--- Seeder Creación de Roles');

                $this->rolOwner = Role::create([
                    'name'         => 'owner',
                    'display_name' => 'Project Owner',
                    'description'  => 'User is the owner of a given project',
                ]);
                $this->rolAdmin = Role::create([
                    'name'         => 'admin',
                    'display_name' => 'Administrador',
                    'description'  => 'User is allowed to manage and edit other users',
                ]);

            //*********************************************************************
            $this->command->info('--- Seeder Creación de Permisos');

                $menu = Permission::create([
                    'name'         => 'app-menu',
                    'display_name' => 'Administrar menú',
                    'description'  => 'Permite crear, eliminar y ordenar el menú del sistema.',
                ]);
                $this->rolAdmin->attachPermission($menu);
				
                $parameters = Permission::create([
                    'name'         => 'app-parameters',
                    'display_name' => 'Administrar parámetros',
                    'description'  => 'Permite crear, eliminar y ordenar los parámetros del sistema.',
                ]);
                /*$uploads = Permission::create([
                    'name'         => 'app-upload',
                    'display_name' => 'Cargas masivas',
                    'description'  => '¡CUIDADO! Permite realizar cargas masivas de datos en el sistema.',
                ]);*/

                    $reportes = Permission::create([
                    'name'         => 'reportes',
                    'display_name' => 'Reportes',
                    'description'  => 'Permite ejecutar reportes y exportarlos.',
                ]);

                $this->rolOwner->attachPermission($reportes);
                $this->rolAdmin->attachPermissions([$reportes]);


                $this->createPermissions(User::class, 'usuarios');
                $this->createPermissions(Role::class, 'roles');
                $this->createPermissions(Permission::class, 'permisos');

                $this->createPermissions(Propietario::class, 'propietarios');
                $this->createPermissions(Vacante::class, 'vacantes');
                $this->createPermissions(Empresa::class, 'empresas');                
            

                

            //*********************************************************************
            $this->command->info('--- Seeder Creación de Usuarios prueba');

                //Admin
                $admin = User::create( [
                    'name' => 'Administrador',
                    'username' => 'admin',
                    'email' => 'sghmasterpromo@gmail.com',
                    'password'  => \Hash::make($pass),
                ]);
                $admin->attachRole($this->rolAdmin); 

                //Owner
                $owner = User::create( [
                    'name' => 'Owner',
                    'username' => 'owner',
                    'email' => 'diegoarmandocortes@outlook.com',
                    'password'  => \Hash::make($pass),
                ]);
                $owner->attachRole($this->rolOwner);
                //5 usuarios faker
                //$users = factory(App\User::class)->times(5)->create();

		}

        private function createPermissions($name, $display_name, $description = null, $attachAdmin=true)
        {
            $name = strtolower(basename($name));

            if($description == null)
                $description = $display_name;

            $create = Permission::create([
                'name'         => $name.'-create',
                'display_name' => 'Crear '.$display_name,
                'description'  => 'Crear '.$description,
            ]);
            $edit = Permission::create([
                'name'         => $name.'-edit',
                'display_name' => 'Editar '.$display_name,
                'description'  => 'Editar '.$description,
            ]);
            $index = Permission::create([
                'name'         => $name.'-index',
                'display_name' => 'Listar '.$display_name,
                'description'  => 'Listar '.$description,
            ]);
            $delete = Permission::create([
                'name'         => $name.'-delete',
                'display_name' => 'Borrar '.$display_name,
                'description'  => 'Borrar '.$description,
            ]);

            if($attachAdmin)
                $this->rolAdmin->attachPermissions([$index, $create, $edit, $delete]);

            return compact('create', 'edit', 'index', 'delete');
        }

	}