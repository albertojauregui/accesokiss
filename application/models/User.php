<?php

class User extends Eloquent {
	
	public function suppliers()
	{
		return $this->has_many_and_belongs_to('Supplier');
	}

}