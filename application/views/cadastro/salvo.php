<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// MOSTRA A LOCALIZACAO QUE USUARIO ESTA NO SITE
echo ('<ol class="breadcrumb">
			<li><span class="glyphicon glyphicon-record"> </span>  Você está aqui </li>
			<li><a href="'. base_url() .'">Home</a></li>
			<li><a href="'. base_url("Cadastro") .'">Cadastro</a></li>
			<li><a href="'. base_url("Cadastro/salvo") .'">Salvar</a></li>
		</ol>');

// MOSTRA FORMULARIO DE CAMPOS
echo ('<form action="#" method="POST" name="cadastro-cliente" class="form-horizontal"><fieldset>');
	echo ('<div class="row">');
		// DADOS PESSOAIS DO CADASTRO
		echo ('<div class="col-xs-12 col-sm-6">');	

				// MOSTRA MENSAGEM DE RETORNO NA TELA
				if ($status)
					echo ('<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> '.$msg.'</div>');
				else
					echo ('<div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> '.$msg.'</div>');

				echo ('<legend>Dados Pessoais</legend>');
 
				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Nome*</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="nome" type="text" placeholder="Nome" class="form-control input-md" value="'.$nome.'" disabled>
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">CPF*</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="cpf" type="text" placeholder="000.000.000-00" class="form-control input-md" value="'.$cpf.'" disabled>
					</div>');
				echo ('</div>');
				echo ('<div class="form-group">');
					if (strtolower($sexo) == "f")
						echo ('<label class="col-xs-3 col-sm-2 control-label" for="selectbasic">Sexo</label>
							<div class="col-xs-4 col-sm-4">
								<input id="textinput" name="cidadeent" type="text" placeholder="Cidade" class="form-control input-md" value="Feminino" disabled>
							</div>');
					else
						echo ('<label class="col-xs-3 col-sm-2 control-label" for="selectbasic">Sexo</label>
							<div class="col-xs-4 col-sm-4">
								<input id="textinput" name="cidadeent" type="text" placeholder="Cidade" class="form-control input-md" value="Masculino" disabled>
							</div>');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Nascimento</label>');
					echo ('<div class="col-xs-4 col-sm-4">
						<input id="textinput" name="nascimento" type="text" placeholder="00/00/0000" class="form-control input-md" value="'.$nascimento.'" disabled>
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Telefone*</label>');
						echo ('<div class="col-xs-4 col-sm-4">
							<input id="textinput" name="tel" type="text" placeholder="(00) 00000-0000" class="form-control input-md" value="'.$telefone.'" disabled>
						</div>');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Celular</label>');
						echo ('<div class="col-xs-4 col-sm-4">
							<input id="textinput" name="cel" type="text" placeholder="(00) 00000-0000" class="form-control input-md" value="'.$celular.'" disabled>
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
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="email" type="email" placeholder="email@email.com.br" class="form-control input-md" value="'.$email.'" disabled>
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Senha*</label>');
					echo ('<div class="col-xs-7 col-sm-7">
						<input id="textinput" name="senha" type="password" placeholder="*****" class="form-control input-md" value="***" disabled>
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Confirmação de Senha*</label>');
					echo ('<div class="col-xs-7 col-sm-7">
						<input id="textinput" name="confsenha" type="password" placeholder="*****" class="form-control input-md" value="***" disabled>
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
						<input id="textinput" name="cep" type="text" placeholder="00.000-000" class="form-control input-md" value="'.$cep.'" disabled>
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Rua*</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="rua" type="text" placeholder="Av. Teste" class="form-control input-md" value="'.$rua.'" disabled>
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Número*</label>');
					echo ('<div class="col-xs-5 col-sm-5">
						<input id="textinput" name="numero" type="number" placeholder="123" class="form-control input-md" value="'.$numero.'" disabled>
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Bairro*</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="bairro" type="text" placeholder="Bairro" class="form-control input-md" value="'.$bairro.'" disabled>
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Cidade*</label>');
					echo ('<div class="col-xs-4 col-sm-4">
						<input id="textinput" name="cidade" type="text" placeholder="Cidade" class="form-control input-md" value="'.$cidade.'" disabled>
					</div>');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">UF*</label>');
					echo ('<div class="col-xs-4 col-sm-4">
						<input id="textinput" name="cidadeent" type="text" placeholder="Cidade" class="form-control input-md" value="'.$estado.'" disabled>
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Complemento</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="complemento" type="text" placeholder="Ap. 07" class="form-control input-md" value="'.$complemento.'" disabled>
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
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">CEP*</label>');
					echo ('<div class="col-xs-5 col-sm-5">
						<input id="textinput" name="cepent" type="text" placeholder="00.000-000" class="form-control input-md" value="'.$cepent.'" disabled>
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Rua*</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="ruaent" type="text" placeholder="Av. Teste" class="form-control input-md" value="'.$ruaent.'" disabled>
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Número*</label>');
					echo ('<div class="col-xs-5 col-sm-5">
						<input id="textinput" name="numeroent" type="number" placeholder="123" class="form-control input-md" value="'.$numeroent.'" disabled>
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Bairro*</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="bairroent" type="text" placeholder="Bairro" class="form-control input-md" value="'.$bairroent.'" disabled>
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Cidade*</label>');
					echo ('<div class="col-xs-4 col-sm-4">
						<input id="textinput" name="cidadeent" type="text" placeholder="Cidade" class="form-control input-md" value="'.$cidadeent.'" disabled>
					</div>');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">UF*</label>');
					echo ('<div class="col-xs-4 col-sm-4">
						<input id="textinput" name="cidadeent" type="text" placeholder="Cidade" class="form-control input-md" value="'.$estadoent.'" disabled>
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Complemento</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="complementoent" type="text" placeholder="Ap. 07" class="form-control input-md" value="'.$complementoent.'" disabled>
					</div>');
				echo ('</div>');
echo ('</fieldset></form>');

				echo ('<div class="row">');
					echo ('<div class="col-xs-6 col-sm-6">');
						echo ('<a href="'.base_url("Cadastro").'" target="_self"><button class="btn btn-default btn-md">Voltar</button></a>');
					echo ('</div>');
				echo ('</div>');
		echo ('</div>');
	echo ('</div>');