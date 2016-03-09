$(document).on("ready", function () {

	/*
		VERIFICA SE USUÁRIO DESEJA UTILIZAR ENDEREÇOS IGUAIS OU ENDEREÇOS DIFERENTES
	*/

	$('[name=mesmoEndereco]').on('change', function () {
		var mesmoEndereco = $(this).val();

		// VERIRICA SE USUÁRIO DESEJA APROVEITAR O MESMO ENDEREÇO DE COBRANÇA
		if (mesmoEndereco == 0) {
			$('[name=cepent]').val("");
			$('[name=ruaent]').val("");
			$('[name=numeroent]').val("");
			$('[name=bairroent]').val("");
			$('[name=cidadeent]').val("");
			$('[name=estadoent]').val("");
			$('[name=complementoent]').val("");
		} else {
			$('[name=cepent]').val($('[name=cep]').val());
			$('[name=ruaent]').val($('[name=rua]').val());
			$('[name=numeroent]').val($('[name=numero]').val());
			$('[name=bairroent]').val($('[name=bairro]').val());
			$('[name=cidadeent]').val($('[name=cidade]').val());
			$('[name=estadoent]').val($('[name=estado]').val());
			$('[name=complementoent]').val($('[name=complemento]').val());
		}
	});

	/*
		VALIDA TODOS OS CAMPOS DO FORMULÁRIO DE CADASTRO DE CLIENTE NO SITE
		CPF O VALOR É VALIDO
		SE NÃO EXISTE NENHUM CAMPO EM BRANCO
		SE SENHA E CONFIRMAÇÃO SÃO IGUAIS
		SE E-MAIL É VÁLIDO
	*/

	$('[name=cadastro-cliente]').on("submit", function (event) {
		//event.preventDefault();
		var retorno = true;
		var nome = $('[name=nome]');
		var sobrenome = $('[name=sobrenome]');
		var cpf = $('[name=cpf]');
		var telefone = $('[name=telefone]');
		var email = $('[name=email]');
		var senha = $('[name=senha]');
		var confsenha = $('[name=confsenha]');
		var cep = $('[name=cep]');
		var rua = $('[name=rua]');
		var numero = $('[name=numero]');
		var bairro = $('[name=bairro]');
		var cidade = $('[name=cidade]');
		var estado = $('[name=estado]');
		var cepent = $('[name=cepent]');
		var ruaent = $('[name=ruaent]');
		var numeroent = $('[name=numeroent]');
		var bairroent = $('[name=bairroent]');
		var cidadeent = $('[name=cidadeent]');
		var estadoent = $('[name=estadoent]');

		// VERIFICA VALOR DO CPF SE É VÁLIDO OU NÃO
		if (!validaCPF(cpf.val())) {
			cpf.parent('div').parent('div').addClass('has-error');
			cpf.parent('div').append('<span class="help-block">CPF inválido.</span>');
			cpf.focus();
			return false;
		} else {
			cpf.parent('div').parent('div').removeClass('has-error');
			cpf.parent('div').find('.help-block').remove();
		}

		// VALIDA VALOR DO CAMPO E-MAIL, SE É UM ENDEREÇO DE E-MAIL VÁLIDO
		if (!validaEmail(email.val())) {
			email.parent('div').parent('div').addClass('has-error');
			email.parent('div').append('<span class="help-block">E-mail inválido.</span>');
			email.focus();
			return false;
		} else {
			email.parent('div').parent('div').removeClass('has-error');
			email.parent('div').find('.help-block').remove();
		}

		// VERIFICA SE SENHA E CONFIRMAÇÃO SÃO IGUAIS
		if (senha.val() != confsenha.val()) {
			confsenha.parent('div').parent('div').addClass('has-error');
			confsenha.parent('div').append('<span class="help-block">Confirmação da senha difere da senha informada.</span>');
			confsenha.focus();
			return false;
		} else {
			confsenha.parent('div').parent('div').removeClass('has-error');
			confsenha.parent('div').find('.help-block').remove();
		}

		// DAQUI PARA BAIXO VERIFICA SE NENHUM CAMPO OBRIGATÓRIO FOI DEIXADO EM BRANCO
		if (nome.val() == "") {
			nome.parent('div').parent('div').addClass('has-error');
			nome.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			nome.focus();
			retorno = false;
		}

		if (sobrenome.val() == "") {
			sobrenome.parent('div').parent('div').addClass('has-error');
			sobrenome.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			sobrenome.focus();
			retorno = false;
		}

		if (cpf.val() == "") {
			cpf.parent('div').parent('div').addClass('has-error');
			cpf.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			cpf.focus();
			retorno = false;
		}

		if (telefone.val() == "") {
			telefone.parent('div').parent('div').addClass('has-error');
			telefone.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			telefone.focus();
			retorno = false;
		}

		if (email.val() == "") {
			email.parent('div').parent('div').addClass('has-error');
			email.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			email.focus();
			retorno = false;
		}

		if (senha.val() == "") {
			senha.parent('div').parent('div').addClass('has-error');
			senha.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			senha.focus();
			retorno = false;
		}

		if (confsenha.val() == "") {
			confsenha.parent('div').parent('div').addClass('has-error');
			confsenha.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			confsenha.focus();
			retorno = false;
		}

		if (cep.val() == "") {
			cep.parent('div').parent('div').addClass('has-error');
			cep.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			cep.focus();
			retorno = false;
		}

		if (rua.val() == "") {
			rua.parent('div').parent('div').addClass('has-error');
			rua.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			rua.focus();
			retorno = false;
		}

		if (numero.val() == "") {
			numero.parent('div').parent('div').addClass('has-error');
			numero.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			numero.focus();
			retorno = false;
		}

		if (bairro.val() == "") {
			bairro.parent('div').parent('div').addClass('has-error');
			bairro.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			bairro.focus();
			retorno = false;
		}

		if (cidade.val() == "") {
			cidade.parent('div').parent('div').addClass('has-error');
			cidade.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			cidade.focus();
			retorno = false;
		}

		if (estado.val() == 0) {
			estado.parent('div').parent('div').addClass('has-error');
			estado.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			estado.focus();
			retorno = false;
		}

		if (cepent.val() == "") {
			cepent.parent('div').parent('div').addClass('has-error');
			cepent.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			cepent.focus();
			retorno = false;
		}

		if (ruaent.val() == "") {
			ruaent.parent('div').parent('div').addClass('has-error');
			ruaent.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			ruaent.focus();
			retorno = false;
		}

		if (numeroent.val() == "") {
			numeroent.parent('div').parent('div').addClass('has-error');
			numeroent.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			numeroent.focus();
			retorno = false;
		}

		if (bairroent.val() == "") {
			bairroent.parent('div').parent('div').addClass('has-error');
			bairroent.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			bairroent.focus();
			retorno = false;
		}

		if (cidadeent.val() == "") {
			cidadeent.parent('div').parent('div').addClass('has-error');
			cidadeent.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			cidadeent.focus();
			retorno = false;
		}

		if (estadoent.val() == 0) {
			estadoent.parent('div').parent('div').addClass('has-error');
			estadoent.parent('div').append('<span class="help-block">Campo obrigatório.</span>');
			estadoent.focus();
			retorno = false;
		}

		return retorno;

	});

	/*
		FUNÇÃO PARA BUSCA ENDEREÇO PELO CEP - FAZ REQUISIÇÃO AJAX
		@param string CEP - Ex.: 81.030-001
		@return json - Endereço referente ao cep
	*/

	$('[name=cep]').on('blur', function () {
		var cep = trim($('[name=cep]').val());
		if (cep != "")
			buscaCep( $(this) , cep );
	});

	$('[name=cepent]').on('blur', function () {
		var cep = trim($('[name=cepent]').val());
		if (cep != "")
			buscaCep( $(this) , cep );
	});

});


/*
	FUNÇÃO PARA VALIDAR DÍGITO VERIFICADOR DO CPF INFORMADO NO FORMULÁRIO DE CADASTRO OU EDIÇÃO DO CADASTRO
	@param string CPF - Ex.: 111.111.111-11
	@return bool - true se cpf é válido ou false se cpf é inválido
*/

function validaCPF (cpfParam)
{	
	cpf = cpfParam.replace(/[^\d]+/g,'');    
    if(cpf == '') return false; 
    // Elimina CPFs invalidos conhecidos    
    if (cpf.length != 11 || 
        cpf == "00000000000" || 
        cpf == "11111111111" || 
        cpf == "22222222222" || 
        cpf == "33333333333" || 
        cpf == "44444444444" || 
        cpf == "55555555555" || 
        cpf == "66666666666" || 
        cpf == "77777777777" || 
        cpf == "88888888888" || 
        cpf == "99999999999")
            return false;
    // Valida 1o digito 
    add = 0;    
    for (i=0; i < 9; i ++)       
        add += parseInt(cpf.charAt(i)) * (10 - i);  
        rev = 11 - (add % 11);  
        if (rev == 10 || rev == 11)     
            rev = 0;    
        if (rev != parseInt(cpf.charAt(9)))
            return false;
    // Valida 2o digito 
    add = 0;    
    for (i = 0; i < 10; i ++)        
        add += parseInt(cpf.charAt(i)) * (11 - i);  
    rev = 11 - (add % 11);  
    if (rev == 10 || rev == 11) 
        rev = 0;    
    if (rev != parseInt(cpf.charAt(10)))
        return false;
    return true;   
}

/*
	FUNÇÃO PARA VALIDAR O VALOR DO CAMPO E-MAIL, VERIFICA SE É UM ENDEREÇO DE E-MAIL VÁLIDO
	@param string e-mail - Ex.: teste@teste.com.br
	@return bool - true se e-mail é válido ou false se e-mail é inválido
*/

function validaEmail (emailParam)
{
	var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	if(filtro.test(emailParam))
		return true;
	else
		return false;
}

/*
	FUNÇÃO PARA BUSCA ENDEREÇO PELO CEP - FAZ REQUISIÇÃO AJAX
	@param string CEP - Ex.: 81.030-001
	@return json - Endereço referente ao cep
*/

function buscaCep (campo, cep)
{	
	var link = "/Correios/buscaCep/"+cep;
	$.ajax({
		url: link,
		cache: false,
		assync: false,
		beforeSend: function () {
			// Desativa os campos do formulario

			if (campo.attr("name") == "cep") {

				$('[name=rua]').attr('disabled','disabled');
				$('[name=bairro]').attr('disabled','disabled');
				$('[name=cidade]').attr('disabled','disabled');
				$('[name=estado]').attr('disabled','disabled');

			} else {

				$('[name=ruaent]').attr('disabled','disabled');
				$('[name=bairroent]').attr('disabled','disabled');
				$('[name=cidadeent]').attr('disabled','disabled');
				$('[name=estadoent]').attr('disabled','disabled');

			}
		},
		success: function(data) {

			if (data == "") {
				alert("CEP não encontrado.");
				return false;
			}

			var retorno = data.split(';');

			if (retorno.length == 2) {
				// Ativa os campos do formulario novamente
				if (campo.attr("name") == "cep") {
					$('[name=rua]').removeAttr('disabled').val("");
					$('[name=bairro]').removeAttr('disabled').val("");
					$('[name=cidade]').removeAttr('disabled').val(retorno[0]);
					$('[name=estado]').removeAttr('disabled').val(retorno[1]);
				} else {
					$('[name=ruaent]').removeAttr('disabled').val("");
					$('[name=bairroent]').removeAttr('disabled').val("");
					$('[name=cidadeent]').removeAttr('disabled').val(retorno[0]);
					$('[name=estadoent]').removeAttr('disabled').val(retorno[1]);
				}
			} else {
				// Ativa os campos do formulario novamente
				if (campo.attr("name") == "cep") {
					$('[name=rua]').removeAttr('disabled').val(retorno[0]);
					$('[name=bairro]').removeAttr('disabled').val(retorno[1]);
					$('[name=cidade]').removeAttr('disabled').val(retorno[2]);
					$('[name=estado]').removeAttr('disabled').val(retorno[3]);
				} else {
					$('[name=ruaent]').removeAttr('disabled').val(retorno[0]);
					$('[name=bairroent]').removeAttr('disabled').val(retorno[1]);
					$('[name=cidadeent]').removeAttr('disabled').val(retorno[2]);
					$('[name=estadoent]').removeAttr('disabled').val(retorno[3]);
				}
			}
		}
	});
}