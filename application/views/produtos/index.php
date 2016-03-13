<?php
defined('BASEPATH') OR exit('No direct script access allowed');

echo ('<div class="row">');

	// MENU LEFT DE LINKS NA PÁGINA DE PRODUTOS
	echo ('<div class="col-xs-6 col-sm-2" >');
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
		if (($produtos == null) || ($produtos->rowCount() == 0))
			echo ('<h2>Nenhum produto encontrado.</h2>');
		else {
			for ($i = 0; $reg = $produtos->fetch(); $i++) {

				// Verifica qual laco esta para pular linha
				if (($i % 4) == 0) {
					echo ('</div>');
					echo ('<div class="row">');
				} else {
					echo ('<div class="col-xs-6 col-sm-4 box-produtos">
							<div class="thumbnail">');
								if (file_exists(base_url("includes/images/produtos/thumbnail/".$reg->codigo.".png"))) {
									list($width, $height, $type, $attr) = getimagesize(base_url("includes/images/produtos/thumbnail/".$reg->codigo.".png"));
									if ($height > $width)
										echo ('<img src="'. base_url("includes/images/produtos/thumbnail/".$reg->codigo.".png") .'" style="height: 170px !important;" alt="'.$reg->nome.'">');
									else
										echo ('<img src="'. base_url("includes/images/produtos/thumbnail/".$reg->codigo.".png") .'" style="width: 170px !important;" alt="'.$reg->nome.'">');
								} else
									echo ('<img src="'. base_url("includes/images/produtos/semimagem.png") .'" style="width: 170px !important;" alt="'.$reg->nome.'">');
								echo ('<div class="codigo">Codigo: '.$reg->codigo.'</div>
								<div class="caption">
									<h3>'.formataString($reg->nome).'</h3>');
									if (($reg->prepro < $reg->preco) && ($reg->prepro > 0))
										echo ('<p><strike>De: R$ '.$reg->preco.'</strike> Por:  R$ '.$reg->prepro.'</p>');
									else
										echo ('<p>Por:  R$ '.$reg->preco.'</p>');
									echo ('<p><a href="'. base_url("Produtos/detalhes/".formataStringToURL($reg->nome)."/".$reg->codigo) .'" class="btn btn-default" role="button"><span class="glyphicon glyphicon-plus"> </span> Detalhes</a> <a href="#" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Comprar</a> </p>
								</div>
							</div>
						</div>');
				}

			}
		}
	echo ('</div>');

	// MOSTRA LINKS DE PROXIMA PAGINA E ANTERIOR
	echo ('<nav id="navPages">
		<ul class="pagination">');
			if ($limitInf > 0)
				echo ('<li>
					<a href="'. base_url("Produtos/index/".($limitInf - 20)) .'" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</li>');

			//echo ('<li><a href="'. base_url("Home/index/".($limitInf + 20)) .'">1</a></li>');
			echo ('<li><a href="#">Página atual <strong>'. (ceil($limitInf/20) + 1) .'</strong></a></li>');

			echo ('<li>
				<a href="'. base_url("Produtos/index/".($limitInf + 20)) .'" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
				</a>
			</li>');
	echo ('</ul></nav>');

	echo ('</div>');// FECHA .ROW ABERTA SOMENTE PARA PRODUTOS

echo ('</div>');// DIV.ROW MENULEFT