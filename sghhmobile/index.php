<!DOCTYPE html>
<html>
<head>
	<title>Hotelaria Hospitalar</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable = no">  
<meta name="apple-mobile-web-app-capable" content="yes" />
       <meta name="apple-mobile-web-app-status-bar-style" content="black" />  
    <link rel="apple-touch-icon-precomposed" href="img/ico.png"/> 
       <link rel="apple-touch-icon" href="img/ico.png"/>  
	<link rel="stylesheet" href="css/jquery.mobile-1.3.2.min.css" />
    <link rel="stylesheet" href="css/Principal.css" />
        <!-- iPhone -->
<link href="img/320x460.png"
      media="(device-width: 320px) and (device-height: 480px)
         and (-webkit-device-pixel-ratio: 1)"
      rel="apple-touch-startup-image">

<!-- iPhone (Retina) -->
<link href="img/640x920.png"
      media="(device-width: 320px) and (device-height: 480px)
         and (-webkit-device-pixel-ratio: 2)"
      rel="apple-touch-startup-image">

<!-- iPhone 5 -->
<link href="img/640x1096.png"
      media="(device-width: 320px) and (device-height: 568px)
         and (-webkit-device-pixel-ratio: 2)"
      rel="apple-touch-startup-image">

<!-- iPad -->
<link href="img/768x1004.png"
      media="(device-width: 768px) and (device-height: 1024px)
         and (orientation: portrait)
         and (-webkit-device-pixel-ratio: 1)"
      rel="apple-touch-startup-image">
<link href="img/748x1024.png"
      media="(device-width: 768px) and (device-height: 1024px)
         and (orientation: landscape)
         and (-webkit-device-pixel-ratio: 1)"
      rel="apple-touch-startup-image">

<!-- iPad (Retina) -->
<link href="img/1536x2008.png"
      media="(device-width: 768px) and (device-height: 1024px)
         and (orientation: portrait)
         and (-webkit-device-pixel-ratio: 2)"
      rel="apple-touch-startup-image">
<link href="img/1496x2048.png"
      media="(device-width: 768px) and (device-height: 1024px)
         and (orientation: landscape)
         and (-webkit-device-pixel-ratio: 2)"
      rel="apple-touch-startup-image">
	<script src="js/jquery.js"></script>
	<script src="js/jquery.mobile-1.3.2.min.js"></script>
<script language="javascript" type="text/javascript">
		$(document).bind("pageinit",function() {
				monta();
		$('#alterar').click(function(){// Declaração de variaveis
				var LeitoId 	= $("#LeitoId").text();
				var QuartoId 	= $("#QuartoId").text();
				var Identificacao 	= $("#Identificacao").text();
				var Status		= $("#Status option:selected").val();

				// Executa o POST usando metodo AJAX e retorando Json
				var Url				= 'http://<?php echo $_SERVER['SERVER_ADDR'];?>/sghh/leito/salvarEdicao';

				var data 			= 'LeitoId='+LeitoId+'&QuartoId='+QuartoId+'&Status='+Status+'&Identificacao='+Identificacao;

				$.ajax({
					type: "POST",
					url: Url,
					data: data,
					dataType: 'json',
					success: function(retorno){
					}
				});
				$('#leitos').empty();
				setTimeout(
								function(){
									monta();
								},
								1000
							);
						
				});   
    });
    </script>
            <script>
			function monta(){
				$('#leitos').empty();
         $.getJSON("pa.php?tipo=lista", function(data){
			 var andar="";
           	 $.each(data.Leitos, function(index, d){  
			 var src=""			 
					if(d.Status=="Liberado"){
						src="img/disponivel.jpg";
						} else if(d.Status=="Ocupado"){
						src="img/ocupado.jpg";
						}  else if(d.Status=="Desativado"){
						src="img/desativado.jpg";
						}  else {
						src="img/arumacao.jpg";
						}		
							if(andar!=d.Andar){
						$('#leitos').append($('<li/>', {
							'data-role':'list-divider',
							'class': 'divisor',
							'text': d.Andar
							}));	
							andar=d.Andar;
							}
										
				$('#leitos').append($('<li/>', {
				}).append($('<a/>', {
			    'href': '#popupLogin',
				'data-rel': 'popup',
				'data-transition': 'pop',
				'data-position-to': 'window',
				'onClick': 'quarto('+d.LeitoId+')'
				}).append($('<img/>',{
					'src': src	
					}),$('<h2/>',{
						'text': d.Leito
						}),$('<p/>',{
							'class': 'ui-li-aside',
							'text': d.Quarto							
							}),
							$('<p/>',{
							'text': d.Status							
				})))); 
            });
		$('#leitos').listview('refresh');
        }).error(function(jqXHR, textStatus, errorThrown){
            alert("error occurred!");
        });	
		setTimeout(
								function(){
									monta();
								},
								100000
							);
						
			}
function quarto(reg){
 $('#Status').empty();
 
			 $('#LeitoId').text(reg);
$.getJSON("pa.php?tipo=leito&leitoid="+reg, function(data){	
           	 $.each(data.Status, function(index, d){ 
			 $('#Status').append($('<option />',{
				 'value': d.Status,
				 'text': d.Nome
				 }));
			 });
			 $('#Status').val(data.Leito.Status).change();
			 $('#Quarto').text(data.Leito.Quarto);
			 $('#QuartoId').text(data.Leito.QuartoId);
			 $('#Identificacao').text(data.Leito.Identificacao);
			 
	});
}

function valida(){
	if(1!=1){
	window.location="#";
window.location.reload();}
}

</script>
</head>
<body>

<div data-role="page"  data-theme="d" id="demo-page" data-divider-theme="c" class="my-page">
<div data-role="popup" id="popupLogin" data-theme="c" class="ui-corner-all">
<a href="#" data-rel="back" data-role="button" data-theme="b" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    <form method="post" >
        <div style="padding:10px 20px;">
            <label for="un" class="ui-hidden-accessible">Login:</label>
            <input name="user" id="un" value="" placeholder="Login" data-theme="d" type="text">
            <label for="pw" class="ui-hidden-accessible">Senha:</label>
            <input name="pass" id="pw" value="" placeholder="Senha" data-theme="d" type="password">        
           <a href="#popupDialog" onClick="valida()" data-rel="popup" data-position-to="window" data-rel="back" data-role="button" data-theme="d" data-icon="check">Logar</a>
        </div>
    </form>
</div>
<div data-role="popup" id="popupDialog" align="center" data-overlay-theme="d" data-theme="d" data-dismissible="false" style="width:300px;max-width:400px;" class="ui-corner-all">
    <div data-role="header" data-theme="d" class="ui-corner-top">
        <h1 style="color:rgba(0,0,0,1)">Alterar</h1>
    </div><label for="LeitoId" style="display:none" id="LeitoId"></label>
    <label for="QuartoId" style="display:none" id="QuartoId"></label>
    <table align="center" style="margin:2px"><tr><td>
    		Quarto:<label for="Quarto" id="Quarto"></label></td></tr><tr><td>
            Identifica&ccedil;&atilde;o:<label for="Identificacao" id="Identificacao"></label></td></tr><tr><td>
            <label for="Status">Status:</label></td></tr><tr><td>
    <select name="Status" style="margin:2px" id="Status">
    </select></td></tr><tr><td>
     <a href="#" data-role="button" data-inline="true" data-rel="back" data-theme="c">Cancel</a>
        <a href="#" data-role="button" id="alterar" data-inline="true" data-rel="back" data-theme="b">Alterar</a>
        </td></tr></table>
            </div>
	<div data-role="header" align="center" data-theme="c"><br>
	<img class="logo1" src="img/logo.png" /><img class="logo2" src="img/ico.png" /><br>
	</div><!-- /header -->

       
	<div data-role="content">
    <ul  id="leitos" data-role="listview" data-inset="true">
           </ul>
    </div><!-- /content -->
<div data-role="footer" align="center" data-theme="d" >


Software de Gest&atilde;o de Hotelaria Hospitalar (SGHH)<br>

Enrique Bonif&aacute;cio - F&aacute;bio Mello - Jorge Pimenta - Igor Sales - S&eacute;rgio Macedo - Weslei Nunes<br>

UNA-BH 2sem/2013 - Todos os direitos reservados.

</div>
</div><!-- /page -->

</body>
</html>