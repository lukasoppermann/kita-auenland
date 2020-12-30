// open / collapse Burger Menu
$(document).ready(function(){
	
	$("#burger-button").click(function(){
		$("body").toggleClass("menu");
	});
	
	$("#mobile-menu-wrapper").click(function(){
		$("body").removeClass("menu");
	});
	
});