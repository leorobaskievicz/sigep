<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// VERIFICA SE EXISTE VARIÁVEL DE RETORNO DE SUCESSO OU NÃO
if (isset($alterado)) {
	if ($alterado) {
		echo ('<div class="alert alert-success" role="alert"> ');
			echo ('<span class="glyphicon glyphicon-ok"> </span>');
			echo (' Senha atualizada com sucesso. <a href="#" class="alert-link"></a> ');
			echo ('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
		echo ('</div>');
	} else {
		echo ('<div class="alert alert-danger" role="alert">');
			echo ('<span class="glyphicon glyphicon-remove"> </span>');
			echo (' <strong>Ops</strong>, não foi possível alterar sua senha, por favor tente novamente.');
			echo ('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
		echo ('</div>');
	}
}

// MOSTRA FORMULARIO DE CAMPOS
echo ('<form action="'. base_url("Cadastro/trocarsenha") .'" method="POST" name="trocarsenha-cliente" class="form-horizontal"><fieldset>');

	/* 
		DADOS DO PERFIL DO USUÁRIO
	*/
	
	echo ('<div class="row">');
		
		echo ('<div class="col-xs-12 col-sm-6">');		

				echo ('<legend>Trocar senha</legend>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-4 col-sm-4 control-label" for="textinput">Senha atual*</label>');
					echo ('<div class="col-xs-7 col-sm-7">
						<input id="textinput" name="senha" type="password" placeholder="*****" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-4 col-sm-4 control-label" for="textinput">Senha nova*</label>');
					echo ('<div class="col-xs-7 col-sm-7">
						<input id="textinput" name="senhanova" type="password" placeholder="*****" class="form-control input-md">
					</div>');
				echo ('</div>');

				echo ('<div class="form-group">');
					echo ('<label class="col-xs-4 col-sm-4 control-label" for="textinput">Confirmação de Senha*</label>');
					echo ('<div class="col-xs-7 col-sm-7">
						<input id="textinput" name="confsenhanova" type="password" placeholder="*****" class="form-control input-md">
					</div>');
				echo ('</div>');

			echo ('<div class="form-group">');
				echo ('<div class="col-xs-11 col-sm-11" style="text-align: right;">');
					echo ('<button type="submit" class="btn btn-primary btn-md">Trocar senha</button>');
				echo ('</div>');
			echo ('</div>');

		echo ('</div>');

	echo ('</div>');

echo ('</fieldset></form>');