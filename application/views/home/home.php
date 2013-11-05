<div class='titulo_page'>Painel de Leitos</div>
<div class="home">

	<div id="home_conteudo"></div>

	<div class="clear"></div>

	<div class='legenda home_andar'>
		<div class='home_andar_item'>Legenda:</div>
		<div class='home_leito_item Liberado'>Liberado</div>	<div class="clear"></div>
		<div class='home_leito_item Arrumacao'>Arrumação</div>	<div class="clear"></div>
		<div class='home_leito_item Ocupado'>Ocupado</div>	<div class="clear"></div>
	</div>

	<div class="clear"></div>
</div>
<script type="text/javascript">
	function RedirecionamentoHome(){
		$.blockUI({ message: '<h1>Ocorreu um erro no servidor!</h1>' });

		// Efetuar o redirecionamento
		setTimeout(
			function(){
				$.unblockUI();
			},
			4000
		);					
	}

	$(document).ready(function(){
		$.blockUI({ message: '<h1>Carregando os dados...</h1>' });

		var Url 		= "<?php echo BASE_URL;?>/home/montaIndex";
		var Conteudo 	= "";

		$.ajax({
			type: "get",
			url: Url,
			dataType: 'json',
			success: function(retorno){
				if(retorno.success){
					var Leitos	= retorno.Leitos;

					var Leito 			= '';
					var Quarto 			= '';
					var Andar			= '';
					var FecharDiv  		= false;

					for(Reg in Leitos){

						if(Andar != Leitos[Reg].Andar){						

							if(Andar != ""){
								Conteudo += "</div></div>";
							}

							Conteudo += '<div class="home_andar">';
							Conteudo += '<div class="home_andar_item">Andar: '+Leitos[Reg].Andar+'</div>';

							Andar 	  = Leitos[Reg].Andar;
							Quarto 	  = "";
							FecharDiv = true;
						}

						if(Quarto != Leitos[Reg].Quarto){
							if(Quarto != ""){
								Conteudo += '</div>';
							}

							Conteudo += '<div class="home_quarto">';
							Conteudo += '<div class="home_quarto_item">Quarto: '+Leitos[Reg].Quarto+'</div>';

							Quarto    = Leitos[Reg].Quarto;
							FecharDiv = true;
						}
					
						Conteudo += '<div class="home_leito_item '+Leitos[Reg].Status+'">Leito: '+Leitos[Reg].Leito+'</div>';
					}

					Conteudo += '</div></div>';					

					$("#home_conteudo").html(Conteudo);
					$.unblockUI();
				}
				else{
					RedirecionamentoHome();					
				}
			},
			error: function(){
				RedirecionamentoHome();
			}
		});
	});
</script>