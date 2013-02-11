<?php

class Suppliers_Controller extends Base_Controller {

/*	public function __construct()
	{
		$this->filter('before', 'admin');
	}
*/
	public function action_index()
	{
		if (Request::ajax()){
			return Response::eloquent(
				Supplier::order_by('name', 'ASC')->get()
			);
		} else {
			$suppliers = Supplier::with('brands')
				->left_join('users', 'users.id', '=', 'suppliers.user_id')
				->order_by('name', 'ASC')
				->get();
			$brands = Brand::order_by('name', 'ASC')->get();
			return View::make('suppliers.index', array(
				'suppliers' => $suppliers,
				'brands' => $brands,
			));
		}
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
			$supplier->user_id = Input::get('user_id');
			if ($supplier->save()){
				// Guardado con éxito
				if (Input::get('brands')){
					$supplier->brands()->sync(Input::get('brands'));
				}
				return Redirect::to('/suppliers')
					->with('status', View::make('partials.fancy-status', array('message' => 'Guardado exitoso',
						'type' => 'success',
					)));
			} else {
				// Guardado fallido
				return Redirect::to('/suppliers')
					->with('status', View::make('partials.fancy-status', array('message' => 'Guardado fallido',
						'type' => 'danger',
					)));
			}
		}
	}
	
	public function action_edit($id)
	{
		if (Request::method() == 'GET'){
			if (Request::ajax()){
				return Response::eloquent(
					Supplier::with('brands')
						->where('id', '=', $id)
						->order_by('name', 'ASC')
						->get()
					);
			} else {
				$supplier = Supplier::find($id)->order_by('name', 'ASC');
				return View::make('suppliers.edit', $supplier);
			}
		} elseif (Request::method() == 'POST'){
			$supplier = Supplier::find($id);
			$supplier->name    = Input::get('name');
			$supplier->url     = Input::get('url');
			$supplier->address = Input::get('address');
			$supplier->phone   = Input::get('phone');
			if ($supplier->save()){
				// Edición exitosa
				if (Input::get('brands')){
					$supplier->brands()->sync(Input::get('brands'));
				}
				return Redirect::to('/suppliers')
					->with('status', View::make('partials.fancy-status', array('message' => 'Edición exitosa',
						'type' => 'success',
					)));
			} else {
				// Edición fallida
				return Redirect::to('/suppliers/edit/'.$id)
					->with('status', View::make('partials.fancy-status', array('message' => 'Edición fallida',
						'type' => 'danger',
					)));
			}
		}
	}
	
	public function action_delete($id)
	{
		$supplier = Supplier::find($id);
		if ($supplier){
			$brands = $supplier->brands()->pivot()->get();
			$users  = $supplier->users()->pivot()->get();
			if (! empty($brands)){
				// Tiene elementos relacionados
				if ($supplier->brands()->delete()){
				} else {
					return Redirect::to('/suppliers')
						->with('status', View::make('partials.fancy-status', array('message' => 'Eliminación de asociación de marcas fallida',
							'type' => 'danger',
						)));
				}
			}
			if (! empty($users)){
				//Tiene elementos relacionados
				if ($supplier->users()->delete()){
				} else {
					return Redirect::to('/suppliers')
						->with('status', View::make('partials.fancy-status', array('message' => 'Eliminación de asociación de usuarios fallida',
							'type' => 'danger',
						)));
				}
			}
			if ($supplier->delete()){
				return Redirect::to('/suppliers')
					->with('status', View::make('partials.fancy-status', array('message' => 'Eliminación exitosa',
						'type' => 'success',
					)));
			} else {
				return Redirect::to('/suppliers')
					->with('status', View::make('partials.fancy-status', array('message' => 'Eliminación fallida',
						'type' => 'danger',
					)));
			}
		} else {
			return Redirect::to('/suppliers')
				->with('status', View::make('partials.fancy-status', array('message' => 'Proveedor no encontrado',
					'type' => 'danger',
				)));
		}
	}
	
}