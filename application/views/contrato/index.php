<script type="text/javascript" src="<?php echo BASE_URL;?>/web/js/jquery/jquery.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>/web/js/jquery/jquery.blockUI.js"></script>
<div class="contrato_texto">
	<div class="linha">fklhasfl htnjahtlknhtvanthvt vath tvlh tlvwt tlw</div>
	<div class="aceite_contrato" id="aceite_contrato">Aceito</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#aceite_contrato").click(function(){
	    alert("clicou contrato");
		logar();
	});

  function logar(){
    var Cpf       = $("#Cpf").val();
    var Senha     = $("#Senha").val();

    // Executa o POST usando metodo AJAX e retorando Json
    var Url       = '<?php echo BASE_URL;?>/funcionario/logar';

    var data      = 'Cpf='+Cpf+'&Senha='+Senha;

    $.blockUI({ message: '<h1>Logando...</h1>' });

    $.ajax({
      dataType: 'json',
      type: "POST",
      url: Url,
      data: data,
      success: function(retorno){
        if(retorno.success){

          $.blockUI({ message: '<h1>Login efetuado, redirecionando...</h1>' });

          // Efetuar o redirecionamento
          setTimeout(
            function(){
              window.location = "<?php echo BASE_URL; echo (isset($_SESSION['REDIRECT_URL']) && $_SESSION['REDIRECT_URL'] != '/') ? $_SESSION['REDIRECT_URL'] : '';?>"
            },
            4000
          );
          
        }
        else{
          // Se php retornou erro irá salvar o retorno da div "retorno"
          alert('Usuário ou senha inválido');
          $.unblockUI();
        }
      },
      error: function(){
        //$('.retorno_ajax').html('Ocorreu um erro no servidor. Tentar novamente!');
        alert('Erro no servidor');
        //$.unblockUI();
      }
    });
  }
});
</script>