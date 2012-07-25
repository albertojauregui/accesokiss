<?php

class Users_Controller extends Base_Controller {

	public function action_index()
	{
		return View::make('users.index');
	}

	public function action_login()
	{
		echo "<pre>";
		print_r(Input::get());
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