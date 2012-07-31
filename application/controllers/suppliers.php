<?php

class Suppliers_Controller extends Base_Controller {

	public function action_index()
	{
		if (Request::ajax()){
			return Response::eloquent(Supplier::all());
		} else {
			$suppliers = Supplier::with('brands')->get();
			$brands = Brand::all();
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
		if (Resquest::method() == 'GET'){
			if (Request::ajax()){
				return Response::eloquent(Supplier::find($id));
			} else {
				$supplier = Supplier::find($id);
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
		$suppliers = Supplier::find($id);
		if ($supplier){
			if (    $supplier->brands()->delete() 
				and $supplier->users()->delete())
			{
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
					->with('status', View::make('partials.fancy-status', array('message' => 'Eliminación de accesos y marcas fallida',
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