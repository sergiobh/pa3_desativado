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

    var MSGContato = '<div class="bloco_msg"><b>I.</b> Não revelar fora do âmbito profissional estado ou informação de qualquer natureza de que tenha conhecimento por força de minhas atribuições, salvo em decorrência de decisão competente na esfera legal ou judicial, bem como de autoridade superior;</div>';
    MSGContato += '<br /><div class="bloco_msg"><b>II.</b> Utilizar os dados do sistema informatizado de acesso restrito e manter a necessária cautela quando da exibição de dados em tela, impressora ou na gravação em meios eletrônicos, a fim de evitar que deles venham a tomar ciência pessoas não autorizadas;</div>';
    MSGContato += '<br /><div class="bloco_msg"><b>III.</b> Não me ausentar da estação de trabalho sem encerrar a sessão de uso do sistema, garantindo assim a impossibilidade de acesso indevido por terceiros;</div>';
    MSGContato += '<br /><div class="bloco_msg"><b>IV.</b> Não revelar minha senha de acesso ao(s) sistema(s) a ninguém e tomar o máximo de cuidado para que ela permaneça somente de meu conhecimento;</div>';
    MSGContato += '<br /><div class="bloco_msg">Declaro, nesta data, ter ciência e estar de acordo com os procedimentos acima descritos, comprometendo-me a respeitá-los e cumpri-los plena e integralmente, além de manter sempre verdadeiros os dados de instituição e de minha área de competência.</div>';


    jConfirm(MSGContato, 'TERMO DE RESPONSABILIDADE', function(r) {
      if(r){
        logar();
      }
    });

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
          //alert('Usuário ou senha inválido');

          jAlert('Usuário ou senha inválido!', 'CONTROLE DE ACESSO');          

          $.unblockUI();
        }
      },
      error: function(){
        //$('.retorno_ajax').html('Ocorreu um erro no servidor. Tentar novamente!');
        $.unblockUI();
        jAlert('Erro no servidor', 'CONTROLE DE ACESSO');
      }
    });
  }  
});
</script>