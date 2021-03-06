$(document).ready(function() { $("#txt-search").focus(); })
$(function (){

	$('a[rel=tooltip]').tooltip();

	// Ajustamos el menu al ancho de la ventana
	resizeMenu('.btn-group.menu', '.btn-group.menu .btn');

	// Ajustamos el menu al ancho de la ventana cuando cuando se modifique
	$(window).resize(function (){
		resizeMenu('.btn-group.menu', '.btn-group.menu .btn');
	});

	// Limpiamos los formularios al cerrarse
	$('.modal').on('hidden', function(){
		var $inputs = $(this).find('input');
		$.each($inputs, function(){
			if ($(this).attr('type') != 'hidden'){
				if ($(this).is(':checkbox')){
					$(this).attr('checked', false);
				} else {
					$(this).val('');
				}
			}
		});
		$('.btn.active, .btn.disable').button('reset');
	});

	$('.slide-related').click(function (event){
		event.preventDefault();
		slideContent($(this), '.list-element', '.related-container');
	});

	$('.brand-edit').click(function(event){
		event.preventDefault();
		var $boton = $(this);
		var attr_id = $(this).attr('id');
		var values = attr_id.split('-');
		var id = values[2];
		$boton.button('loading');
		$.ajax({
			type: "GET",
			url: "/brands/edit/" + id
		}).done(function( data ) {
			var brand = data[0];
			$('#brand-edit .form-horizontal')
				.attr('action', '/brands/edit/'+brand.id);
			$('#brand-edit #name'). val(brand.name);
			if (brand.suppliers){
				$.each(brand.suppliers, function(){
					$('#brand-edit input:checkbox[name=suppliers[]][value='+this.id+']').attr('checked', true);
				});
			}
			$boton.button('reset');
			$('#brand-edit').modal('show');
		});
	});
	
	$('.supplier-edit').click(function(){
		var $boton = $(this);
		var attr_id = $(this).attr('id');
		var values = attr_id.split('-');
		var id = values[2];
		$boton.button('loading');
		$.ajax({
			type: "GET",
			url: "/suppliers/edit/" + id
		}).done(function( data ) {
			var supplier = data[0];
			$('#supplier-edit .form-horizontal')
				.attr('action', '/suppliers/edit/'+supplier.id);
			$('#supplier-edit #name'). val(supplier.name);
			$('#supplier-edit #url'). val(supplier.url);
			$('#supplier-edit #address'). val(supplier.address);
			$('#supplier-edit #phone'). val(supplier.phone);
			if (supplier.brands){
				$.each(supplier.brands, function(){
					$('#supplier-edit input:checkbox[name=brands[]][value='+this.id+']').attr('checked', true);
				});
			}
			$boton.button('reset');
			$('#supplier-edit').modal('show');
		});
	});
	
	$('.user-edit').click(function(){
		$("#user-edit #is_admin option").removeAttr("selected");
		var $boton = $(this);
		var attr_id = $(this).attr('id');
		var values = attr_id.split('-');
		var id = values[2];
		$boton.button('loading');
		$.ajax({
			type: "GET",
			url: "/users/edit/" + id
		}).done(function( data ) {
			var user = data;
			$('#user-edit .form-horizontal')
				.attr('action', '/users/edit/'+user.id);
			$('#user-edit #username'). val(user.username);
			$('#user-edit #password'). val(user.password);
			if(user.is_admin > 0){
				$("#user-edit #is_admin option[value="+user.is_admin+"]").attr("selected", true);
			}else{
				$("#user-edit #is_admin option[value=0]").attr("selected", true);
			}
			$boton.button('reset');
			$('#user-edit').modal('show');
		});
	});

	$('.credential-edit').click(function(){
		var $boton = $(this);
		var attr_id = $(this).attr('id');
		var values = attr_id.split('-');
		var user_id = values[2];
		var credential_id = values[3];
		$boton.button('loading');
		$.ajax({
			type: "GET",
			url: "/credentials/editinfo/" + user_id + '/' + credential_id
		}).done(function( data ) {
			var credential = data[0];
			console.log(data);
			$('#credential-edit .form-horizontal')
				.attr('action', '/credentials/edit/'+credential.id);
			$('#credential-edit #user'). val(credential.user);
			$('#credential-edit #password'). val(credential.password);
			$('#credential-edit #supplier'). val(credential.supplier_id);
			$boton.button('reset');
			$('#credential-edit').modal('show');
		});
	});

	//Agregamos el mensaje de confirmación a los botones de eliminar
	$('.btn-delete-supplier').click(function(event){
		event.preventDefault();
		$this = $(this);
		var data = $this.attr('id').split('-');
		if (confirm('¿Deseas eliminar al provedor: ' + data[3] + '?')){
			//Eliminarlo
			window.location = $this.attr('href');
		} else {
			//No hacer nada
		}
	});
	
	//Agregamos el mensaje de confirmación a los botones de eliminar
	$('.btn-delete-brand').click(function(event){
		event.preventDefault();
		$this = $(this);
		var data = $this.attr('id').split('-');
		if (confirm('¿Deseas eliminar la marca: ' + data[3] + '?')){
			//Eliminarlo
			window.location = $this.attr('href');
		} else {
			//No hacer nada
		}
	});
	
	//Agregamos el mensaje de confirmación a los botones de eliminar
	$('.btn-delete-user').click(function(event){
		event.preventDefault();
		$this = $(this);
		var data = $this.attr('id').split('-');
		if (confirm('¿Deseas eliminar al usuario: ' + data[3] + '?')){
			//Eliminarlo
			window.location = $this.attr('href');
		} else {
			//No hacer nada
		}
	});
	
	//Agregamos el mensaje de confirmación a los botones de eliminar
	$('.btn-delete-credential').click(function(event){
		event.preventDefault();
		$this = $(this);
		var data = $this.attr('id').split('-');
		if (confirm('¿Deseas eliminar el acceso a: ' + data[3] + '?')){
			//Eliminarlo
			window.location = $this.attr('href');
		} else {
			//No hacer nada
		}
	});
	
	$('#txt-search').keyup(function(event){	
			var criteria = this.value;
			elementSearch(criteria);
	});
	
	 $('#btn-search').click(function(event){
		var criteria;
		var element = $('#txt-search');		
		criteria = element.attr('value');	
		elementSearch(criteria);
      });
	 $('#btn-clear').click(function(event){		    
			var criteria;
			var element;
			element = $('#txt-search')			
			element.attr('value','');			
			criteria = element.attr('value');		
			elementSearch(criteria);
			element.focus();
	      });
});

function elementSearch(searchCriteria) {
	var id;
	var text = searchCriteria.toUpperCase();
	var supplierName;
	var elements = $('.list-element');			
	for(i=0; i<elements.length; i ++){				 
		supplierName = elements[i].id.toUpperCase();				
		supplierName = supplierName.substring(supplierName.indexOf('-') + 1);
		supplierName = supplierName.substring(supplierName.indexOf('-') + 1);
		if(supplierName.indexOf(text)!=-1) {
			elements[i].style.display= '';
		}				
		else{
			elements[i].style.display= 'none';
		}
	}			
}

function resizeMenu(selectorMenu, selectorMenuItems){
	var menuItems = $(selectorMenuItems).length;
	var width     = $(selectorMenu).width();
	var size      = width / menuItems - 2;
	$.each($(selectorMenuItems), function(){
		$(this).css('width', size);
	});
}

function slideContent(element, parentSelector, contentSelector){
	var $parent = element.parents(parentSelector);
	var $son    = $parent.find(contentSelector);
	$son.slideToggle();
}