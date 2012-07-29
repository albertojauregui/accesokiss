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
			if ($user->suppliers()->attach(Input::get('supplier'), array(
				'user' => Input::get('user'),
				'password' => Input::get('password'),
			)))
			{
				// Guardado con éxito
				return Redirect::to('/credentials')
					->with('status', View::make('partials.fancy-status', array('message' => 'Guardado exitoso',
						'type' => 'success',
					)));
			} else {
				// Guardado fallido
				return Redirect::to('/credentials')
					->with('status', View::make('partials.fancy-status', array('message' => 'Guardado fallido',
						'type' => 'danger',
					)));
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