<?php
defined('BASEPATH') OR exit('No direct script access allowed');

echo ('<div class="row">');

	// MENU LEFT DE LINKS NA PÁGINA DE PRODUTOS
	echo ('<div class="col-xs-6 col-sm-2">');
		echo ('<div class="panel panel-default menuLeft">');

			if (($menu2 == null) && ($menu3 == null)) {
				// Default panel contents --> CABEÇALHO DO MENU LEFT
 				echo ('<div class="panel-heading">Produtos</div>');
				// List group -->
				echo ('<ul class="list-group">');
					while ($reg = $menu1->fetch())
						echo ('<li class="list-group-item"><a href="'. base_url("Produtos/departamentos/".$reg->descricao) .'" target="_self">'.$reg->descricao.'</a></li>');
				echo ('</ul>');
			} else if ($menu3 == null) {
				// Default panel contents --> CABEÇALHO DO MENU LEFT
				$reg1 = $menu1->fetch(); 
 				echo ('<div class="panel-heading">'.$reg1->descricao.'</div>');
				// List group -->
				echo ('<ul class="list-group">');
					while ($reg2 = $menu2->fetch())
						echo ('<li class="list-group-item"><a href="'. base_url("Produtos/departamentos/".$reg1->descricao."/".$reg2->descricao) .'" target="_self">'.$reg2->descricao.'</a></li>');
				echo ('</ul>');
			} else {
				// Default panel contents --> CABEÇALHO DO MENU LEFT
				$reg1 = $menu1->fetch(); 
				$reg2 = $menu2->fetch(); 
 				echo ('<div class="panel-heading">'.$reg2->descricao.'</div>');
				// List group -->
				echo ('<ul class="list-group">');
					while ($reg3 = $menu3->fetch())
						echo ('<li class="list-group-item"><a href="'. base_url("Produtos/departamentos/".$reg1->descricao."/".$reg2->descricao."/".$reg3->descricao) .'" target="_self">'.$reg3->descricao.'</a></li>');
				echo ('</ul>');
			}
			
		echo ('</div>');
	echo ('</div>');

	// GRADE DE PRODUTO DO SITE
	echo ('<div class="col-xs-6 col-sm-10 painel-produtos"><div class="row">');

		// FOTO DO PRODUTO
		echo ('<div class="col-xs-6 col-sm-4 foto-produto">');
			echo ('<img src="'. base_url("includes/images/produtos/thumbnail/".$produto->codigo.".png") .'" alt="Foto do produto '.$produto->nome.'" title="'.$produto->nome.'"/>');
		echo ('</div>');

		// NOME DO PRODUTO
		echo ('<div class="col-xs-6 col-sm-8 nome-produto">');
			echo ('<div class="panel panel-default expoProdu">');
				echo ('<div class="panel-heading">');
					echo ('<h3 class="panel-title">'.$produto->nome.'</h3>');
				echo ('</div>');
				echo ('<div class="panel-body">');

					// MOSTRA CÓDIGO DO PRODUTO, ESTOQUE E AVISOS
					echo ('<div class="row">');

						echo ('<div class="col-xs-6 col-sm-5">');
							// CÓDIGO
							echo ('<strong>Código:</strong> '.$produto->codigo.'<br/>');
							// ESTOQUE
							echo ('<strong>Estoque:</strong> '.$produto->estoque.'<br/>');
						echo ('</div>');

						// MOSTRA AVISOS DOS PRODUTOS
						echo ('<div class="col-xs-6 col-sm-7">');
							echo ('<div class="alert alert-warning" role="alert">Preços válidos somente para loja online.</div>');
						echo ('</div>');
					echo ('</div>');

					// MOSTRA PREÇO DO PRODUTO
					echo ('<div class="row"><div class="col-xs-6 col-sm-12">');
						echo ('<h4><span><strong><strike>De:</strike></strong> R$ '.number_format($produto->pvenda,2,","," ").'</span> <strong>Por: </strong> R$ '.number_format($produto->prepro,2,","," ").'</h4>');
					echo ('</div></div>');
					echo ('<br/>');

					// DADOS PARA ADICIONAR O PRODUTO NO CARRINHO
					echo ('<div class="row">');
						echo ('<div class="col-xs-6 col-sm-6">');
							echo ('<form action="'. base_url("Cadastro/salvar") .'" method="POST" name="cadastro-cliente" class="form-horizontal"><fieldset>');
								echo ('<legend>Adicionar ao carrinho</legend>');
								echo ('<div class="form-group">');
									echo ('<label class="col-xs-3 col-sm-5 control-label" for="selectbasic">Quantidade</label>
										<div class="col-xs-2 col-sm-5">
											<select id="selectbasic" name="qtd" class="form-control">');

											for ($i = 1; $i <= $produto->estoque; $i++)
												echo ('<option value="'.$i.'">'.$i.'</option>');

											echo ('</select>
										</div>');
								echo ('</div>');
							echo ('</fieldset></form>');
						echo ('</div>');

						// DADOS PARA MOSTRAR MODO DE ENTREGA
						echo ('<div class="col-xs-6 col-sm-6">');
							echo ('<form action="'. base_url("Cadastro/salvar") .'" method="POST" name="cadastro-cliente" class="form-horizontal"><fieldset>');
								echo ('<legend>Modo de entrega</legend>');
								echo ('<div class="form-group">');
									echo ('<label class="col-xs-3 col-sm-3 control-label" for="selectbasic">CEP</label>
										<div class="col-xs-2 col-sm-7">
											<input id="textinput" name="cep" type="text" placeholder="00.000-000" class="form-control input-md">
										</div>');
								echo ('</div>');
							echo ('</fieldset></form>');
						echo ('</div>');
					echo ('</div>');

					// LISTA PARA LINKS DIVERSOS
					echo ('<ul class="list-group">');
						echo ('<li class="list-group-item">Redes Sociais</li>');
					echo ('</ul>');

				echo ('</div>');
			echo ('</div>');
		echo ('</div>');
		
	echo ('</div></div>');

echo ('</div>');// DIV.ROW MENULEFT