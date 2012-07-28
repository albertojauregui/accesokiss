<?php

class Suppliers_Controller extends Base_Controller {

	public function action_index()
	{
		$suppliers = Supplier::with('brands')->get();
		$brands = Brand::all();
		return View::make('suppliers.index', array(
			'suppliers' => $suppliers,
			'brands' => $brands,
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
			$supplier = new Supplier;
			$supplier->name    = Input::get('name');
			$supplier->url     = Input::get('url');
			$supplier->address = Input::get('address');
			$supplier->phone   = Input::get('phone');
			if ($supplier->save()){
				// Guardado con éxito
				$supplier->brands()->sync(Input::get('brands'));
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
				return Redirect::to('/suppliers')
					->with('status', 'Edición exitosa.');
			} else {
				// Edición fallida
				return Redirect::to('/suppliers/edit/'.$id)
					->with('status', 'Edición fallida.');
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
						->with('status', 'Eliminación de proveedor exitoso.');
				} else {
					return Redirect::to('/suppliers')
						->with('status', 'Eliminación de proveedor fallido.');
				}
			} else {
				return Redirect::to('/suppliers')
					->with('status', 'Borrado de accesos y marcas fallido.');
			}
		} else {
			return Redirect::to('/suppliers')
				->with('status', 'Proveedor no encontrado');
		}
	}
	
}