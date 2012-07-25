<?php

class Suppliers_Controller extends Base_Controller {

	public function action_index()
	{
		return View::make('suppliers.index');
	}
	
	public function action_view($id)
	{
		$supplier = Supplier::find($id);	
		return View::make('suppliers.view', $supplier);
	}
	
	public function action_add()
	{
		if (Request::method() == 'GET'){
			return View::make('suppliers.add');
		} elseif (Request::method() == 'POST') {
			$supplier = new Supplier;
			$supplier->name    = Input::get('name');
			$supplier->url     = Input::get('url');
			$supplier->address = Input::get('address');
			$supplier->phone   = Input::get('phone');
			if ($supplier->save()){
				// Guardado con éxito
				Session::flash('status', 'Guardado satisfactorio.');
				return Redirect::to('/suppliers');
			} else {
				// Guardado fallido
				Session::flash('status', 'Guardado fallido.');
				return Redirect::to('/suppliers/add');
			}
		}
	}
	
	public function action_edit()
	{
		
	}
	
	public function action_delete()
	{
		
	}
	
}