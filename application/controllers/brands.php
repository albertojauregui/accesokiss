<?php

class Brands_Controller extends Base_Controller {

	public function action_index()
	{
		$brands = Brand::with('suppliers')->order_by('name', 'ASC')->get();
		$suppliers = Supplier::order_by('name', 'ASC')->get();
		return View::make('brands.index', array(
			'brands' => $brands,
			'suppliers' => $suppliers,
		));
	}
	
	public function action_view($id)
	{
		$brand = Brand::find($id);	
		return View::make('brands.view', $brand);
	}
	
	public function action_add()
	{
		if (Request::method() == 'GET'){
			return View::make('brands.add');
		} elseif (Request::method() == 'POST') {
			$brand = new Brand;
			$brand->name = Input::get('name');
			if ($brand->save()){
				// Guardado con éxito
				if (Input::get('suppliers')){
					$brand->suppliers()->sync(Input::get('suppliers'));
				}
				return Redirect::to('/brands')
					->with('status', View::make('partials.fancy-status', array('message' => 'Guardado exitoso',
						'type' => 'success',
					)));
			} else {
				// Guardado fallido
				return Redirect::to('/brands')
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
					Brand::with('suppliers')
						->where('id', '=', $id)
						->get()
				);
			} else {
				$brand = Brand::find($id);
				return View::make('brands.edit', $brand);
			}
		} elseif (Request::method() == 'POST'){
			$brand = Brand::find($id);
			$brand->name = Input::get('name');
			if ($brand->save()){
				// Edición exitosa
				if (Input::get('suppliers')){
					$brand->suppliers()->sync(Input::get('suppliers'));
				}
				return Redirect::to('/brands')
					->with('status', View::make('partials.fancy-status', array('message' => 'Edición exitosa',
						'type' => 'success',
					)));
			} else {
				// Edición fallida
				return Redirect::to('/brands/edit/'.$id)
					->with('status', View::make('partials.fancy-status', array('message' => 'Edición fallido',
						'type' => 'danger',
					)));
			}
		}
	}
	
	public function action_delete($id)
	{
		$brand = Brand::find($id);
		if ($brand){
			$suppliers = $brand->suppliers()->pivot()->get();
			if (! empty($suppliers)){
				//Tiene elementos relacionados	
				if ($brand->suppliers()->delete()){
				} else {
					return Redirect::to('/brands')
						->with('status', View::make('partials.fancy-status', array('message' => 'Borrado de asociación de  proveedores fallido',
							'type' => 'danger',
						)));
				}
			}
			if ($brand->delete()){
				return Redirect::to('/brands')
					->with('status', View::make('partials.fancy-status', array('message' => 'Eliminación exitosa',
						'type' => 'success',
					)));
			} else {
				return Redirect::to('/brands')
					->with('status', View::make('partials.fancy-status', array('message' => 'Eliminación fallida',
						'type' => 'danger',
					)));
			}
		} else {
			return Redirect::to('/brands')
				->with('status', View::make('partials.fancy-status', array('message' => 'Marca no encontrada',
					'type' => 'danger',
				)));
		}
	}
	
}