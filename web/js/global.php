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


<?php 
/* Apartir daqui são as funções gerais para todas as telas */
?>

function validaDados(p_form){		
	var msg = '';
	var elementos = p_form.elements;

	for(var i = 0; i < elementos.length; i++){
		if((elementos[i].value == '') && (elementos[i].getAttribute('obrigatorio') == 'sim')){
			msg += 'O campo ' + elementos[i].getAttribute('descricao') + ' é obrigatório  \n';
			elementos[i].className += 'vazio';
		}
	}
	
	if(msg != ''){
		alert(msg);
		return false;
	}
	
	alert("Cadastro realizado com sucesso");
	return true;
}


function validaDados2(formulario){
	var msg = '';
	var elementos 	= $('.'+formulario);
	elementos 		= elementos[0];
	var Tipo;
	var Classe;

//console.log(elementos);


	for(var i = 0; i < elementos.length; i++){

		if(elementos[i].getAttribute('obrigatorio') == 'sim'){
			Tipo = elementos[i].type;

			switch(Tipo){
				case 'text':
					if(elementos[i].value == ''){
						msg += 'O campo ' + elementos[i].getAttribute('descricao') + ' é obrigatório <br />';

						if(elementos[i].className.indexOf('vazio') == -1){
							elementos[i].className += ' vazio';	
						}
					}
					else{
						Classe 					= elementos[i].className;
						Classe 					= Classe.replace("vazio","");
						elementos[i].className 	= Classe;
					}
					break;
				case 'select-one':
					if(elementos[i].value == -1){
						msg += 'O campo ' + elementos[i].getAttribute('descricao') + ' é obrigatório <br />';
						
						if(elementos[i].className.indexOf('vazio') == -1){
							elementos[i].className += ' vazio';	
						}
					}
					else{
						Classe 					= elementos[i].className;
						Classe 					= Classe.replace("vazio","");
						elementos[i].className 	= Classe;
					}
					break;
			}
		}
	}
	
	if(msg != ''){
		//alert(msg);
		$('.retorno_ajax').html(msg);
		fecharMsgErro();
		return false;
	}

	return true;
}

function fecharMsgErro(){
	setTimeout(
		function(){
			$(".retorno_ajax").html('');
		},
		5000
	);		
}