<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// MOSTRA A LOCALIZACAO QUE USUARIO ESTA NO SITE
echo ('<ol class="breadcrumb">
			<li><span class="glyphicon glyphicon-record"> </span>  Você está aqui </li>
			<li><a href="'. base_url() .'">Home</a></li>
			<li><a href="'. base_url("Login") .'">Fazer Login</a></li>
		</ol>');

echo ('<h1>Fazer login</h1>');

/*
	VERIFICA SE EXISTE VARIÁVEL DE LOGIN PARA MOSTRAR MENSAGEM NA TELA DE BEM-SUCEDIDO OU NÃO
*/
if (isset($login)) {
	if ($login)
		echo ('<div class="alert alert-success" role="alert"> <span class="glyphicon glyphicon-ok"> </span> Login efetuado com sucesso. <a href="#" class="alert-link"></a> </div>');
	else
		echo ('<div class="alert alert-danger" role="alert">');
			echo ('<span class="glyphicon glyphicon-remove"> </span>');
			echo (' <strong>Login incorreto</strong>, por favor tente novamente.');
			echo ('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
		echo ('</div>');
}

// MOSTRA FORMULARIO DE CAMPOS PARA LOGIN
echo ('<div class="row">');
	// DADOS PESSOAIS DO CADASTRO
	echo ('<form action="'. base_url("Login") .'" method="POST" name="formulario-login" class="form-horizontal">');
		echo ('<div class="col-xs-12 col-sm-6">');		

				echo ('<legend>Já sou cadastrado</legend>');
 
				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Login*</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="email-login" type="email" placeholder="E-mail" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Senha*</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="senha-login" type="password" placeholder="*****" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<div class="col-xs-12 col-sm-12" style="text-align: right;">');
						echo ('<button type="submit" class="btn btn-primary btn-md">Entrar</button>');
					echo ('</div>');
				echo ('</div>');

		echo ('</div>');
	echo ('</form>');

	// MOSTRA FORMULARIO DE CAMPOS PARA CADASTRAR-SE
	echo ('<form action="'. base_url("Cadastro") .'" method="POST" name="formulario-cadastro" class="form-horizontal">');
		echo ('<div class="col-xs-12 col-sm-6">');		

				echo ('<legend>Não sou cadastrado</legend>');
 
				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Nome*</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="nome" type="text" placeholder="Nome" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">E-mail*</label>');
					echo ('<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="email" type="email" placeholder="E-mail" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<div class="col-xs-12 col-sm-12" style="text-align: right;">');
						echo ('<button type="submit" class="btn btn-primary btn-md">Cadastrar</button>');
					echo ('</div>');
				echo ('</div>');

		echo ('</div>');
	echo ('</form>');

echo ('</div>');