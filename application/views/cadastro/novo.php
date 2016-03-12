<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// MOSTRA FORMULARIO DE CAMPOS
echo ('<form action="'. base_url("Cadastro/salvar") .'" method="POST" name="cadastro-cliente" class="form-horizontal"><fieldset>');
	echo ('<div class="row">');
		// DADOS PESSOAIS DO CADASTRO
		echo ('<div class="col-xs-12 col-sm-6">');		

				echo ('<legend>Dados Pessoais</legend>');
 
				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Nome*</label>');
					if ($nome != null)
						echo ('<div class="col-xs-9 col-sm-10">
							<input id="textinput" name="nome" type="text" placeholder="Nome" class="form-control input-md" value="'.$nome.'">
						</div>');
					else
						echo ('<div class="col-xs-9 col-sm-10">
							<input id="textinput" name="nome" type="text" placeholder="Nome" class="form-control input-md">
						</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Sobrenome*</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="sobrenome" type="text" placeholder="Sobrenome" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="radios">Pessoa</label>
					<div class="col-xs-9 col-sm-10"> 
						<label class="radio-inline" for="radios-0">
							<input type="radio" name="pessoa" id="radios-0" value="f" checked="checked">
							Fisica
						</label> 
						<label class="radio-inline" for="radios-1">
							<input type="radio" name="pessoa" id="radios-1" value="j">
							Juridica
						</label> 
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">CPF*</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="cpf" type="text" placeholder="000.000.000-00" class="form-control input-md">
					</div>');
				echo ('</div>');
				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="selectbasic">Sexo</label>
						<div class="col-xs-4 col-sm-4">
							<select id="selectbasic" name="sexo" class="form-control">
								<option value="0">-- </option>
								<option value="f">Feminio</option>
								<option value="m">Masculino</option>
							</select>
						</div>');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Nascimento</label>');
					echo ('<div class="col-xs-4 col-sm-4">
						<input id="textinput" name="nascimento" type="text" placeholder="00/00/0000" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Telefone*</label>');
						echo ('<div class="col-xs-4 col-sm-4">
							<input id="textinput" name="tel" type="text" placeholder="(00) 00000-0000" class="form-control input-md">
						</div>');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Celular</label>');
						echo ('<div class="col-xs-4 col-sm-4">
							<input id="textinput" name="cel" type="text" placeholder="(00) 00000-0000" class="form-control input-md">
						</div>');
				echo ('</div>');
		echo ('</div>');

		/*
			MOSTRA QUADRO DE AVISOS AO LADO ESQUERDO
		*/
		echo ('<div class="col-xs-1 col-sm-1"></div>');
		echo ('<div class="col-xs-11 col-sm-5">');
			echo ('<div class="panel panel-warning">');
				echo ('<div class="panel-heading">');
					echo ('<h3 class="panel-title">Atenção</h3>');
				echo ('</div>');
				echo ('<div class="panel-body">');
					echo ('<ul>');
						echo ('<li>Todos os campos com * são obrigatórios</li>');
					echo ('</ul>');
				echo ('</div>');
			echo ('</div>');
		echo ('</div>');

	echo ('</div>');

	echo ('<p>&nbsp;</p>');

	/* 
		DADOS DO PERFIL DO USUÁRIO
	*/
	
	echo ('<div class="row">');
		
		echo ('<div class="col-xs-12 col-sm-6">');		

				echo ('<legend>Dados do Pefil</legend>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">E-mail*</label>');
					if ($email != null)
						echo ('<div class="col-xs-9 col-sm-10">
							<input id="textinput" name="email" type="email" placeholder="email@email.com.br" class="form-control input-md" value="'.$email.'">
						</div>');
					else
						echo ('<div class="col-xs-9 col-sm-10">
							<input id="textinput" name="email" type="email" placeholder="email@email.com.br" class="form-control input-md">
						</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Senha*</label>');
					echo ('<div class="col-xs-7 col-sm-7">
						<input id="textinput" name="senha" type="password" placeholder="*****" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Confirmação de Senha*</label>');
					echo ('<div class="col-xs-7 col-sm-7">
						<input id="textinput" name="confsenha" type="password" placeholder="*****" class="form-control input-md">
					</div>');
				echo ('</div>');

		echo ('</div>');

	echo ('</div>');

	echo ('<p>&nbsp;</p>');

	/* 
		DADOS DO ENDEREÇO
	*/
	
	echo ('<div class="row">');
		
		echo ('<div class="col-xs-12 col-sm-6">');		

				echo ('<legend>Endereço</legend>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">CEP*</label>');
					echo ('<div class="col-xs-5 col-sm-5">
						<input id="textinput" name="cep" type="text" placeholder="00.000-000" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Rua*</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="rua" type="text" placeholder="Av. Teste" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Número*</label>');
					echo ('<div class="col-xs-5 col-sm-5">
						<input id="textinput" name="numero" type="number" placeholder="123" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Bairro*</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="bairro" type="text" placeholder="Bairro" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Cidade*</label>');
					echo ('<div class="col-xs-4 col-sm-4">
						<input id="textinput" name="cidade" type="text" placeholder="Cidade" class="form-control input-md">
					</div>');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">UF*</label>');
					echo ('<div class="col-xs-4 col-sm-4">
						<select id="textinput" name="estado" placeholder="Estado" class="form-control input-md">
							<option value="0">--</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espirito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
						</select>
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Complemento</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="complemento" type="text" placeholder="Ap. 07" class="form-control input-md">
					</div>');
				echo ('</div>');

		echo ('</div>');

	echo ('</div>');

	echo ('<p>&nbsp;</p>');

	/* 
		DADOS DO ENDEREÇO DE ENTREGA
	*/
	
	echo ('<div class="row">');
		
		echo ('<div class="col-xs-12 col-sm-6">');		

				echo ('<legend>Endereço de Entrega</legend>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-5 col-sm-5 control-label" for="radios">Usar mesmo endereço</label>
					<div class="col-xs-5 col-sm-5"> 
						<label class="radio-inline" for="radios-0">
							<input type="radio" name="mesmoEndereco" id="radios-0" value="1">
							Sim
						</label> 
						<label class="radio-inline" for="radios-1">
							<input type="radio" name="mesmoEndereco" id="radios-1" value="0" checked="checked">
							Não
						</label> 
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">CEP*</label>');
					echo ('<div class="col-xs-5 col-sm-5">
						<input id="textinput" name="cepent" type="text" placeholder="00.000-000" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Rua*</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="ruaent" type="text" placeholder="Av. Teste" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Número*</label>');
					echo ('<div class="col-xs-5 col-sm-5">
						<input id="textinput" name="numeroent" type="number" placeholder="123" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Bairro*</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="bairroent" type="text" placeholder="Bairro" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Cidade*</label>');
					echo ('<div class="col-xs-4 col-sm-4">
						<input id="textinput" name="cidadeent" type="text" placeholder="Cidade" class="form-control input-md">
					</div>');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">UF*</label>');
					echo ('<div class="col-xs-4 col-sm-4">
						<select id="textinput" name="estadoent" placeholder="Estado" class="form-control input-md">
							<option value="0">--</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espirito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
						</select>
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Complemento</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="complementoent" type="text" placeholder="Ap. 07" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<div class="col-xs-12 col-sm-12" style="text-align: right;">');
						echo ('<button type="submit" class="btn btn-primary btn-md">Cadastrar</button>');
					echo ('</div>');
				echo ('</div>');

		echo ('</div>');

	echo ('</div>');

echo ('</fieldset></form>');