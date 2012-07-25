<?php

class Users_Controller extends Base_Controller {

	public function action_index()
	{
		return View::make('users.index');
	}

	public function action_login()
	{
		if (Request::method() == 'POST'){
			$credentials = array(
				'username' => Input::get('username'),
				'password' => Input::get('password'),
			);
			if (Auth::attempt($credentials)){
			    // return Redirect::to('/suppliers');
			} else {
			    // return Redirect::to('/');
			}
			if (Auth::check()){
				echo "Logueado!";
			} else {
				echo ":(";
			}
		}
		return false;
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
			$user->id_admin = Input::get('is_admin');
			if ($user->save()){
				// Guardado con éxito
				Session::flash('status', 'Guardado satisfactorio.');
				return Redirect::to('/users');
			} else {
				// Guardado fallido
				Session::flash('status', 'Guardado fallido.');
				return Redirect::to('/users/add');
			}
		}
	}
	
	public function action_edit()
	{
		
	}
	
	public function action_delete()
	{
		
	}
	
}