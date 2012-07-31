<?php

class Brand extends Eloquent {
	
	public function suppliers()
	{
		return $this->has_many_and_belongs_to('Supplier')
			->order_by('name', 'ASC');
	}

}