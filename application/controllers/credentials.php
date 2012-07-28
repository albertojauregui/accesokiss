<?php

class Credentials_Controller extends Base_Controller {

	public function action_index()
	{
		$data = Supplier::with('brands')->get();
		return View::make('credentials.index', array('credentials' => $data));
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
			$user = User::find(Input::get('user_id'));
			$user->suppliers->pivot->user = Input::get('user');
			$user->suppliers->pivot->password = Input::get('password');
			if ($user->suppliers->pivot->save()){
				// Guardado con éxito
				return Redirect::to('/suppliers')
					->with('status', 'Guardado exitoso.');
			} else {
				// Guardado fallido
				return Redirect::to('/suppliers/add')
					->with('status', 'Guardado fallido.');
			}
		}
	}
	
	public function action_edit($id)
	{
		if (Resquest::method() == 'GET'){
			$supplier = Supplier::find($id);
			return View::make('suppliers.edit', $supplier);
		} elseif (Request::method() == 'POST'){
			$supplier = Supplier::find($id);
			$supplier->name    = Input::get('name');
			$supplier->url     = Input::get('url');
			$supplier->address = Input::get('address');
			$supplier->phone   = Input::get('phone');
			if ($supplier->save()){
				// Edición exitosa
				Session::flash('status', 'Edición satisfactoria.');
				return Redirect::to('/suppliers');
			} else {
				// Edición fallida
				Session::flash('status', 'Edición fallida.');
				return Redirect::to('/suppliers/edit/'.$id);
			}
		}
	}
	
	public function action_delete()
	{
		
	}
	
}