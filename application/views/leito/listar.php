<div class='titulo_page'>Lista de Leitos</div>
<div class="leito_listar">
	<div id="leito_conteudo"></div>
	<div class="clear"></div>

	<div class='legenda home_andar'>
		<div class='home_andar_item'>Legenda:</div>
		<div class='home_leito_item Liberado'>Liberado</div>	<div class="clear"></div>
		<div class='home_leito_item Arrumacao'>Arrumação</div>	<div class="clear"></div>
		<div class='home_leito_item Ocupado'>Ocupado</div>	<div class="clear"></div>
		<div class='home_leito_item Desativado'>Desativado</div>	<div class="clear"></div>
	</div>
	<div class="clear"></div>	
</div>
<script type="text/javascript">
$(document).ready(function(){
	$.blockUI({ message: '<h1>Carregando os dados...</h1>' });

	var Url = "<?php echo BASE_URL;?>/leito/getListar";

	$.ajax({
		type: "get",
		url: Url,
		dataType: 'json',
		success: function(retorno){
			if(retorno.success){
				var Leitos 		= retorno.Leitos;
				var Leito 		= "";
				var Quarto 		= "";
				var Andar 		= "";
				
				var Dados 		= "";

				for(Reg in Leitos){
					if(Andar != Leitos[Reg].Andar){
						if(Andar != ""){
							Dados += '</div></div>';
						}

						Dados 		+= '<div class="home_andar">';
						Dados 		+= '<div class="home_andar_item">Andar: '+Leitos[Reg].Andar+'</div>';

						Andar 		= Leitos[Reg].Andar;
						Quarto 		= "";
					}

					if(Quarto != Leitos[Reg].Quarto){
						if(Quarto != ""){
							Dados 	+= '</div>';
						}

						Dados 		+= '<div class="home_quarto">';
						Dados 		+= '<div class="home_quarto_item">Quarto: '+Leitos[Reg].Quarto+'</div>';

						Quarto  	= Leitos[Reg].Quarto;
					}

					Dados 			+= '<a class="link_leito" href="<?php echo BASE_URL;?>/leito/editar/'+Leitos[Reg].LeitoId+'" title="Editar '+Leitos[Reg].Leito+'" >';
					Dados 			+= '<div class="home_leito_item '+Leitos[Reg].Status+'">Leito: '+Leitos[Reg].Leito+'</div>';
					Dados 			+= '</a>';
				}

				Dados 				+= "</div></div>";

				$("#leito_conteudo").html(Dados);

				$.unblockUI();
			}
			else{
				$('.retorno_ajax').html('Ocorreu um erro no servidor. Favor recarregar a página!');
				$.unblockUI();
			}
		},
		error: function(){
			$('.retorno_ajax').html('Ocorreu um erro no servidor. Tentar novamente!');
			$.unblockUI();
		}
	});

});
</script>