<?php

class Supplier extends Eloquent {
	
	public function users()
	{
		return $this->has_many_and_belongs_to('User')
			->order_by('name', 'ASC');
	}

	public function brands()
	{
		return $this->has_many_and_belongs_to('Brand')
			->order_by('name', 'ASC');
	}

}