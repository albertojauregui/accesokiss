<?php

class Users_Controller extends Base_Controller {

	public function __construct(){
		$this->filter('before', 'auth')->except(array('login'));
	}

	public function action_index()
	{
		$users = User::all();
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
		if (Resquest::method() == 'GET'){
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
			if ($user->suppliers()->delete()){
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
					->with('status', View::make('partials.fancy-status', array('message' => 'Borrado de accesos fallido',
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
		return View::make('credentials.index', array(
			'credentials' => $data,
			'user_id' => $user_id,
		));
	}

	public function action_logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
	
}