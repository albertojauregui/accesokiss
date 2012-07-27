$(function (){

	$('a[rel=tooltip]').tooltip();

	resizeMenu('.btn-group.menu', '.btn-group.menu .btn');

	$(window).resize(function (){
		resizeMenu('.btn-group.menu', '.btn-group.menu .btn');
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