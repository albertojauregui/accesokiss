<?php

class Users_Controller extends Base_Controller {

	public function action_index()
	{
		return View::make('users.index');
	}

	public function action_login()
	{
		echo Hash::make(Input::get('password'));
		$credentials = array(
			'username' => Input::get('username'),
			'password' => Input::get('password'),
		);
		if (Auth::attempt($credentials)){
			if (Auth::check()){
				echo "Logueado!";
			}
		    // return Redirect::to('/suppliers');
		} else {
		    // return Redirect::to('/');
		}
		return false;
	}
	
	public function action_view()
	{
		
	}
	
	public function action_add()
	{
		
	}
	
	public function action_edit()
	{
		
	}
	
	public function action_delete()
	{
		
	}
	
}