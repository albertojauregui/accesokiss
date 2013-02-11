<?php

class Userlogins_Controller extends Base_Controller {
	public function __construct()
	{
		$this->filter('before', 'admin');
	}

	public function action_index()
	{	
		$date = new DateTime(date('Y-m-d',time()));
		$date->sub(new DateInterval('P30D'));		
		
		
		$userlogins = Userlogin::with('Users')->where('updated_at','>',$date->format('Y-m-d'))->order_by('updated_at','DESC')->get();		
		return View::make('userslogins.index', array('userlogin'=>$userlogins));	
	}
	
	public function action_view($id)
	{
		return View::make('userslogins.index');
	}	
}