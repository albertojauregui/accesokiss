<?php

class Users_Controller extends Base_Controller {

	public function action_index()
	{
		return View::make('users.index');
	}

	public function action_login()
	{
		$credentials = array(
			'username' => Input::get('username'),
			'password' => Input::get('password'),
		);
		echo "<pre>";
		print_r(Hash::check(Input::get('password'), '$2a$08$IClsKZjzFX5vJLx8aQsULuRo5s0PskVewCHMCh'));
		print_r($credentials);
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
		echo "</pre>";
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