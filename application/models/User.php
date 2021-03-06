<?php

class User extends Eloquent
{	
	public static $key = 'id';
	public function suppliers()
	{
		return $this->has_many_and_belongs_to('Supplier')->with('user', 'password')->order_by('name', 'ASC');
	}
	public function Userlogins()
	{
		return $this->has_many('Userlogin','id');//->with('user', 'password')->order_by('updated_at', 'DES');
	}
}