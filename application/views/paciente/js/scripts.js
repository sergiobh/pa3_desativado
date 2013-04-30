function validaDados(p_form){		
			alert('ok');
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
		return true;}




