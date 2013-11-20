<div class='titulo_page'>Login de Funcionários</div>
<form class='formulario'>
  <table cellspacing = "10" border = '0'>
    <tr>
      <td class='col_titulo'>Cpf:</td>
      <td>
        <input type = 'text' maxlength = '11' id='Cpf' name = 'cpf' descricao = 'Cpf'  obrigatorio = 'sim' />
      </td>
    </tr>
    <tr>
      <td class='col_titulo'>Senha:</td>
      <td>
        <input type = 'password' maxlength = '10' id='Senha' name = 'senha' descricao = 'Senha'  obrigatorio = 'sim' />
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <div class='retorno_ajax'></div>
        <input class='botao_submit' type = 'button' value = 'Enviar' />
        <input class='botao_reset' type = 'reset' value = 'Limpar' />
      </td>
    </tr>
  </table>
</form>
<script type="text/javascript">
$(document).ready(function(){
  $('.botao_submit').click(function(){

    // Validação do formulário padrão
    if(! validaDados2('formulario')){
      return false;
    }

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


  });
});
</script>