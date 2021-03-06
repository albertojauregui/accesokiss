<?php

class Credentials_Controller extends Base_Controller {

	public function action_index($user_id)
	{
		$data = User::with(array('suppliers', 'suppliers.brands'))
			->where('id', '=', Auth::user()->id)
			->get();
		$suppliers = Supplier::order_by('name', 'ASC')->get();
		return View::make('credentials.index', array(
			'credentials' => $data,
			'user_id' => $user_id,
			'suppliers' => $suppliers,
		));
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
				return Redirect::to('/credentials/index/' . $user->id)
					->with('status', View::make('partials.fancy-status', array('message' => 'Guardado exitoso',
						'type' => 'success',
					)));
			} else {
				// Guardado fallido
				return Redirect::to('/credentials/index/' . $user->id)
					->with('status', View::make('partials.fancy-status', array('message' => 'Guardado fallido',
						'type' => 'danger',
					)));
			}
		}
	}

	public function action_editinfo($user_id, $pivot_id){
		if (Request::method() == 'GET'){
			if (Request::ajax()){
				return Response::eloquent(User::find($user_id)->suppliers()->pivot()->where('id', '=', $pivot_id)->get());
			}
		}
	}
	
	public function action_edit($pivot_id)
	{
		if (Request::method() == 'GET'){
		} elseif (Request::method() == 'POST') {
			$user = User::find(Input::get('user_id'));
			if ($user->suppliers()->pivot()
				->where('id', '=', $pivot_id)
				->update(
					array(
						'user' => Input::get('user'),
						'password' => Input::get('password'),
						'supplier_id' => Input::get('supplier'),
					)
				)
			)
			{
				// Guardado con éxito
				return Redirect::to('/credentials/index/' . $user->id)
					->with('status', View::make('partials.fancy-status', array('message' => 'Guardado exitoso',
						'type' => 'success',
					)));
			} else {
				// Guardado fallido
				return Redirect::to('/credentials/index/' . $user->id)
					->with('status', View::make('partials.fancy-status', array('message' => 'Guardado fallido',
						'type' => 'danger',
					)));
			}
		}
	}
	
	public function action_delete($user_id, $pivot_id)
	{
		if (User::find($user_id)->suppliers()->pivot()->where('id', '=', $pivot_id)->delete()){
			return Redirect::to('/credentials/index/' . $user_id)
				->with('status', View::make('partials.fancy-status', array('message' => 'Borrado de acceso exitoso',
					'type' => 'success',
				)));
		} else {
			return Redirect::to('/credentials/index/' . $user_id)
				->with('status', View::make('partials.fancy-status', array('message' => 'Borrado de acceso fallido',
					'type' => 'danger',
				)));
		}
	}
	
}