<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// MOSTRA A LOCALIZACAO QUE USUARIO ESTA NO SITE
echo ('<ol class="breadcrumb">
			<li><a href="'. base_url() .'">Home</a></li>
			<li><a href="'. base_url("Cadastro") .'">Cadastro</a></li>
			<li><a href="'. base_url("Cadastro/novo") .'">Novo</a></li>
		</ol>');

// MOSTRA FORMULARIO DE CAMPOS
echo ('<div class="row">');
	// DADOS PESSOAIS DO CADASTRO
	echo ('<div class="col-xs-6 col-sm-6">');
		echo ('<form class="form-horizontal"><fieldset>');
			echo ('<legend>Dados Pessoais</legend>');

			echo ('<div class="form-group">');
				echo ('<label class="col-xs-2 col-sm-2 control-label" for="textinput">Nome</label>');
				echo ('<div class="col-xs-10 col-sm-10">
					<input id="textinput" name="nome" type="text" placeholder="Nome" class="form-control input-md">
				</div>');
			echo ('</div>');

			echo ('<div class="form-group">');
				echo ('<label class="col-xs-2 col-sm-2 control-label" for="textinput">Sobrenome</label>');
				echo ('<div class="col-xs-10 col-sm-10">
					<input id="textinput" name="sobrenome" type="text" placeholder="Sobrenome" class="form-control input-md">
				</div>');
			echo ('</div>');

			echo ('<div class="form-group">');
				echo ('<label class="col-xs-2 col-sm-2 control-label" for="radios">Pessoa</label>
				<div class="col-xs-10 col-sm-10"> 
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
				echo ('<label class="col-xs-2 col-sm-2 control-label" for="textinput">CPF</label>');
				echo ('<div class="col-xs-10 col-sm-10">
					<input id="textinput" name="cpf" type="text" placeholder="000.000.000-00" class="form-control input-md">
				</div>');
			echo ('</div>');
			echo ('<div class="form-group">');
				echo ('<label class="col-xs-2 col-sm-2 control-label" for="selectbasic">Sexo</label>
					<div class="col-xs-4 col-sm-4">
						<select id="selectbasic" name="sexo" class="form-control">
							<option value="f">Feminio</option>
							<option value="m">Masculino</option>
						</select>
					</div>');
				echo ('<label class="col-xs-2 col-sm-2 control-label" for="textinput">Nascimento</label>');
				echo ('<div class="col-xs-4 col-sm-4">
					<input id="textinput" name="nascimento" type="text" placeholder="00/00/0000" class="form-control input-md">
				</div>');
			echo ('</div>');

			echo ('<div class="form-group">');
				echo ('<label class="col-xs-2 col-sm-2 control-label" for="textinput">Telefone</label>');
					echo ('<div class="col-xs-4 col-sm-4">
						<input id="textinput" name="tel" type="text" placeholder="(00) 00000-0000" class="form-control input-md">
					</div>');
				echo ('<label class="col-xs-2 col-sm-2 control-label" for="textinput">Celular</label>');
					echo ('<div class="col-xs-4 col-sm-4">
						<input id="textinput" name="cel" type="text" placeholder="(00) 00000-0000" class="form-control input-md">
					</div>');
			echo ('</div>');
	echo ('</fieldset></div>');

	// DADOS DO PERFIL
	echo ('<div class="col-xs-6 col-sm-6"><fieldset>');
			echo ('<legend>Dados do Perfil</legend>');

			echo ('<div class="form-group">');
				echo ('<label class="col-xs-2 col-sm-2 control-label" for="textinput">E-mail</label>');
				echo ('<div class="col-xs-9 col-sm-9">
					<input id="textinput" name="email" type="text" placeholder="joao@teste.com.br" class="form-control input-md">
				</div>');
			echo ('</div>');

			echo ('<div class="form-group">');
				echo ('<label class="col-xs-2 col-sm-2 control-label" for="textinput">Senha</label>');
					echo ('<div class="col-xs-4 col-sm-4">
						<input id="textinput" name="tel" type="text" placeholder="(00) 00000-0000" class="form-control input-md">
					</div>');
			echo ('</div>');

			echo ('<div class="form-group">');
				echo ('<label class="col-xs-2 col-sm-2 control-label" for="textinput">Confirmacao Senha</label>');
					echo ('<div class="col-xs-4 col-sm-4">
						<input id="textinput" name="cel" type="text" placeholder="(00) 00000-0000" class="form-control input-md">
					</div>');
			echo ('</div>');

	echo ('</fieldset></div>');

	echo ('</form>');
echo ('</div>');