<?php

class Users_Controller extends Base_Controller {

	public function __construct(){
		$this->filter('before', 'auth|admin')
			->except(array('login', 'logout'));
	}

	public function action_index()
	{
		$users = User::order_by('username', 'ASC')->get();
		return View::make('users.index', array(
			'users' => $users
		));
	}

	public function action_login()
	{
		if (Request::method() == 'POST'){
			$credentials = array(
				'username' => Input::get('username'),
				'password' => Input::get('password'),
			);
			if (Auth::attempt($credentials)){				
				$Userlogin = new Userlogin;
				$Userlogin->user_id =  Auth::user()->id;
				$Userlogin->save();				
			    return Redirect::to('/credentials/index/' . Auth::user()->id);
			} else {
			    return Redirect::to('/')
					->with('status', View::make('partials.fancy-status', array('message' => 'Logueo fallido',
						'type' => 'danger',
					)));
			}
		} else {
			return Redirect::to('/')
				->with('status', View::make('partials.fancy-status', array('message' => 'Acceso restringido',
					'type' => 'danger',
				)));
		}
	}
	
	public function action_view($id)
	{
		$user = User::find($id);	
		return View::make('users.view', $user);
	}
	
	public function action_add()
	{
		if (Request::method() == 'GET'){
			return View::make('users.add');
		} elseif (Request::method() == 'POST') {
			$user = new User;
			$user->username = Input::get('username');
			$user->password = Input::get('password');
			$user->is_admin = Input::get('is_admin');
			if ($user->save()){
				// Guardado con éxito
				return Redirect::to('/users')
					->with('status', View::make('partials.fancy-status', array('message' => 'Guardado exitoso',
						'type' => 'success',
					)));

			} else {
				// Guardado fallido
				return Redirect::to('/users')
					->with('status', View::make('partials.fancy-status', array('message' => 'Guardado fallido',
						'type' => 'danger',
					)));

			}
		}
	}
	
	public function action_edit($id)
	{
		if (Request::method() == 'GET'){
			if (Request::ajax()){
				return Response::eloquent(User::find($id));
			} else {
				$user = User::find($id);
				return View::make('users.edit', $user);
			}
		} elseif (Request::method() == 'POST'){
			$user = User::find($id);
			$user->username = Input::get('username');
			$user->password = Input::get('password');
			$user->is_admin = Input::get('is_admin');
			if ($user->save()){
				// Edición exitosa
				return Redirect::to('/users')
					->with('status', View::make('partials.fancy-status', array('message' => 'Edición exitosa',
						'type' => 'success',
					)));
	
			} else {
				// Edición fallida
				return Redirect::to('/users/edit/'.$id)
					->with('status', View::make('partials.fancy-status', array('message' => 'Edición fallida',
						'type' => 'success',
					)));

			}
		}
	}
	
	public function action_delete($id)
	{
		$user = User::find($id);
		if ($user){
			$suppliers = $user->suppliers()->pivot()->get();
			if (! empty($suppliers)){
				//Tiene accesos que deben ser eliminados
				if ($user->suppliers()->delete()){
				} else {
					return Redirect::to('/users')
						->with('status', View::make('partials.fancy-status', array('message' => 'Borrado de accesos fallido',
							'type' => 'danger',
						)));
				}
			}

			$dbhandle = mysql_connect('localhost', 'root', '') or die("Unable to connect to MySQL");
			mysql_select_db('accesokiss', $dbhandle);
			$sql = "DELETE FROM userlogins WHERE user_id=".$id;
			if (!mysql_query($sql,$dbhandle)){
				die('Error: ' . mysql_error());
			}

			if ($user->delete()){
				return Redirect::to('/users')
					->with('status', View::make('partials.fancy-status', 
						array(
							'message' => 'Eliminación exitosa',
							'type' => 'success',
						)
					));
			} else {
				return Redirect::to('/users')
				->with('status', View::make('partials.fancy-status', array('message' => 'Eliminación fallida',
					'type' => 'danger',
				)));
			}
		} else {
			return Redirect::to('/users')
				->with('status', View::make('partials.fancy-status', array('message' => 'Usuario no encontrado',
					'type' => 'danger',
				)));
		}
	}

	public function action_credentials($user_id){
		$data = User::with(array('suppliers', 'suppliers.brands'))
			->where('id', '=', $user_id)
			->get();
		$suppliers = Supplier::order_by('name', 'ASC')->get();
		return View::make('credentials.index', array(
			'credentials' => $data,
			'user_id' => $user_id,
			'suppliers' => $suppliers,
		));
	}

	public function action_logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
	
}