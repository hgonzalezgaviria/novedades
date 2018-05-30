<?php

namespace App\Http\Controllers\Auth;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\App\MenuController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Models\User;
use App\Models\Rol;
use App\Models\Menu;



class AuthController extends Controller
{
	protected $username = 'username';
	protected $route = 'auth.usuarios';
	protected $class = User::class;

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	/**
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//Lista de acciones que no requieren autenticación
		$arrActionsLogin = [
			'logout',
			'login',
			'getLogout',
			'showLoginForm',
		];

		//Lista de acciones que solo puede realizar los administradores
		$arrActionsAdmin = [
			'index',
			'edit',
			'show',
			'update',
			'destroy',
			'register',
			'showRegistrationForm',
			'getRegister',
			'postRegister',
		];

		//Requiere que el usuario inicie sesión, excepto en la vista logout.
		$this->middleware('auth', [ 'except' => $arrActionsLogin ]);

		$this->middleware('permission:user-index',  ['only' => ['index']]);
		$this->middleware('permission:user-create', ['only' => ['showRegistrationForm','register']]);
		$this->middleware('permission:user-edit',   ['only' => ['edit', 'update']]);
		$this->middleware('permission:user-delete', ['only' => ['destroy']]);
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'username' => 'required|max:15|unique:users',
			'cedula' => 'required|max:15|unique:users',
			'email' => 'required|email|max:255|unique:users',
			'roles_ids' => 'required|array',
			'password' => 'required|min:6|confirmed',
		]);
	}

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showRegistrationForm()
	{
		//Se crea un array con los Role disponibles
		$arrRoles = model_to_array(Role::class, 'display_name');

		


		// Muestra el formulario de creación y los array para los 'select'
		return view('auth.register', compact('arrRoles'));
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function register(Request $request)
	{
		
		parent::storeModel(['roles'=>'roles_ids']);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	protected function create(array $data)
	{
		return User::create([
			'name' => $data['name'],
			'username' => strtolower($data['username']),
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'created_by' => auth()->user()->username,
		]);
	}
	 */

	/**
	 * Get the login username to be used by the controller.
	 *
	 * @return string
	 */
	public function loginUsername()
	{
		//Se modifica para que la autenticación se realice por username y no por email
		return property_exists($this, 'username') ? strtolower($this->username) : 'username';
	}


    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
    	$credentials = $request->only($this->loginUsername(), 'password');
    	$credentials['username'] = strtolower($credentials['username']);
        return $credentials;
    }

	/**
	 * Muestra una lista de los registros.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Se obtienen todos los registros.
		$usuarios = User::orderBy('id')->get();
		//Se carga la vista y se pasan los registros
		return view('auth/index', compact('usuarios'));
	}

	/**
	 * Muestra el formulario para editar un registro en particular.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// Se obtiene el registro
		$usuario = User::findOrFail($id);

		//Se crea un array con los Role disponibles
		$arrRoles = model_to_array(Role::class, 'display_name');
		$roles_ids = $usuario->roles->pluck('id')->toJson();

		

		// Muestra el formulario de edición y pasa el registro a editar
		return view('auth/edit', compact('usuario','arrRoles','roles_ids'));
	}

	/**
	 * Actualiza un registro en la base de datos.
	 *
	 * @param  User|int  $usuario
	 * @return Response
	 */
	public function update($usuario)
	{
		// Valida si $usuario es un objeto User o el id
		$usuario = isset($usuario->id) ? $usuario : User::findOrFail($usuario);

		//Validación de datos
		$validator = Validator::make(request()->all(), [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users,email,'.$usuario->id.',id',
			'cedula' => 'required|numeric|unique:users,cedula,'.$usuario->id.',id',
		]);

		if($validator->passes()){
			$usuario->name = Input::get('name');
			$usuario->email = Input::get('email');
			$usuario->cedula = Input::get('cedula');
			$usuario->USER_MODIFICADOPOR = auth()->user()->username;
			//Se guarda modelo
			$usuario->save();

			//Relación con roles
			$roles_ids = Input::has('roles_ids') ? Input::get('roles_ids') : [];
			$usuario->roles()->sync($roles_ids, true);

			
			$usuario->temporales()->sync($temp_ids, true);

			// redirecciona al index de controlador
			flash_alert( 'Usuario '.$usuario->username.' modificado exitosamente!', 'success' );
			return redirect()->route('auth.usuarios.index');
		} else {
			return redirect()->back()->withErrors($validator)->withInput();
		}

	}

	/**
	 * Elimina un registro de la base de datos.
	 *
	 * @param  User|int  $usuario
	 * @return Response
	 */
	public function destroy($usuario)
	{
		// Valida si $usuario es un objeto User o el id
		$usuario = isset($usuario->id) ? $usuario : User::findOrFail($usuario);

		//Si el usuario fue creado por SYSTEM, no se puede borrar.
		if($usuario->USER_CREADOPOR == 'SYSTEM'){
			flash_modal( '¡Usuario '.$usuario->username.' no se puede borrar!', 'danger' );
		} else {
			$usuario->delete();
			flash_alert( '¡Usuario '.$usuario->username.' borrado!', 'warning' );
		}

		return redirect()->route('auth.usuarios.index')->send();
	}

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
    	//Se crea arreglo en session con los items del menú disponibles
        MenuController::refreshMenu();

        //parent::handleUserWasAuthenticated($request, $throttles);
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::guard($this->getGuard())->user());
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
    	//Se elimina arreglo en session con los items del menú disponibles
        MenuController::destroyMenu();

        \Auth::guard($this->getGuard())->logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

}
