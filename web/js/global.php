<?php header('Content-type: application/javascript');?>
<?php echo "/*";?><script><?php echo "*/\n";?>
$(document).ready(function(){

	$('.menu_header .menu_body').mouseover(function(){
		$(this).addClass('ativo');

		var SubMenu = $(this).attr("submenu");
		
		if(SubMenu){
			$('.'+SubMenu).show();
		}
	});

	$('.menu_header .menu_body').mouseout(function(){
		<?php /*
		/* Trata o Menu portal para não tirar a marcação de ativo caso ele já tenha sido clicado, aguarda ser clicado novamente
		*/?>
		var SubMenu_Portal = $(this).attr("submenu_portal");		

		if(! SubMenu_Portal){
			$(this).removeClass('ativo');
		}
		else if(!$('.menu_header .menu_body .menu_portal').is(":visible")){
			$(this).removeClass('ativo');
		}

		var SubMenu = $(this).attr("submenu");
		
		if(SubMenu){
			$('.'+SubMenu).hide();
		}
	});
	
	$('.menu_header .menu_body .submenu_item').mouseover(function(){
		$(this).addClass('item_ativo');
	});

	$('.menu_header .menu_body .submenu_item').mouseout(function(){
		$(this).removeClass('item_ativo');
	});

	<?php /*
	/* SubMenu Portal
	*/ ?>
	$('.menu_header .menu_body[submenu_portal="menu_portal"] .menu_text').click(function(){
		$('.menu_header .menu_body .menu_portal').toggle();
	});

});