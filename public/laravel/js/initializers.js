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
			if ($(this).is(':checkbox')){
				$(this).attr('checked', false);
			}
			$(this).val('');
		});
	});

	$('.slide-related').click(function (event){
		event.preventDefault();
		slideContent($(this), '.list-element', '.related-container');
	});

	$('.brand-edit').click(function(){
		var attr_id = $(this).attr('id');
		var values = attr_id.split('-');
		var id = values[2];
		$.ajax({
			type: "GET",
			url: "/brands/edit/" + id
		}).done(function( data ) {
			var brand = data[0];
			$('#brand-edit .form-horizontal')
				.attr('action', '/brands/edit/'+brand.id);
			$('#brand-edit #name'). val(brand.name);
			$('#brand-edit').modal('show');
			$.each(brand.suppliers, function(){
				$('#brand-edit input:checkbox[name=suppliers[]][value='+this.id+']').attr('checked', true);
			});
		});
	});
	
	$('.supplier-edit').click(function(){
		var attr_id = $(this).attr('id');
		var values = attr_id.split('-');
		var id = values[2];
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
			$.each(supplier.brands, function(){
				$('#supplier-edit input:checkbox[name=brands[]][value='+this.id+']').attr('checked', true);
			});
			$('#supplier-edit').modal('show');
		});
	});
	
	$('.user-edit').click(function(){
		var attr_id = $(this).attr('id');
		var values = attr_id.split('-');
		var id = values[2];
		$.ajax({
			type: "GET",
			url: "/users/edit/" + id
		}).done(function( data ) {
			var user = data;
			$('#user-edit .form-horizontal')
				.attr('action', '/users/edit/'+user.id);
			$('#user-edit #username'). val(user.username);
			$('#user-edit #password'). val(user.password);
			$('#user-edit #is_admin'). attr('checked', user.is_admin);
			$('#user-edit').modal('show');
		});
	});

	$('.credential-edit').click(function(){
		var attr_id = $(this).attr('id');
		var values = attr_id.split('-');
		var user_id = values[2];
		var credential_id = values[3];
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
			$('#credential-edit').modal('show');
		});
	});
	
});

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