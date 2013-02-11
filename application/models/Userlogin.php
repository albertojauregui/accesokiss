<?php
class Userlogin extends Eloquent {	
	public static $timestamps = true;	
	public static $key = 'id';
	public function Users()
	{		
		return $this->belongs_to('User','user_id');//->with('user', 'password');
	}
}