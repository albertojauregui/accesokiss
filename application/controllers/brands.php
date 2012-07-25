<?php

class Brands_Controller extends Base_Controller {

	public function action_index()
	{
		return View::make('brands.index');
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
				Session::flash('status', 'Guardado satisfactorio.');
				return Redirect::to('/brands');
			} else {
				// Guardado fallido
				Session::flash('status', 'Guardado fallido.');
				return Redirect::to('/brands/add');
			}
		}
	}
	
	public function action_edit($id)
	{
		if (Resquest::method() == 'GET'){
			$brand = Brand::find($id);
			return View::make('brands.edit', $brand);
		} elseif (Request::method() == 'POST'){
			$brand = Brand::find($id);
			$brand->name = Input::get('name');
			if ($brand->save()){
				// Edición exitosa
				Session::flash('status', 'Edición satisfactoria.');
				return Redirect::to('/brands');
			} else {
				// Edición fallida
				Session::flash('status', 'Edición fallida.');
				return Redirect::to('/brands/edit/'.$id);
			}
		}
	}
	
	public function action_delete()
	{
		
	}
	
}