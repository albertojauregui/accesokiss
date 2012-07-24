<?php

class Supplier extends Eloquent {
	
	public function users()
	{
		return $this->has_many_and_belongs_to('User');
	}

	public function brands()
	{
		return $this->has_many_and_belongs_to('Brand');
	}

}