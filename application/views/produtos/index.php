<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// MOSTRA A LOCALIZACAO QUE USUARIO ESTA NO SITE
echo ('<ol class="breadcrumb">
			<li><span class="glyphicon glyphicon-record"> </span>  Você está aqui </li>
			<li><a href="'. base_url() .'">Home</a></li>
			<li><a href="'. base_url("Produtos") .'">Produtos</a></li>
		</ol>');


echo ('<div class="row">');

	// MENU LEFT DE LINKS NA PÁGINA DE PRODUTOS
	echo ('<div class="col-xs-6 col-sm-2">');
		echo ('<div class="panel panel-default menuLeft">');
			
			if ((!isset($menu1)) && (!isset($menu2))) {
				// Default panel contents --> CABEÇALHO DO MENU LEFT
 				echo ('<div class="panel-heading">Produtos</div>');

				// List group -->
				echo ('<ul class="list-group">');
					echo ('<li class="list-group-item">Cras justo odio</li>');
					echo ('<li class="list-group-item">Dapibus ac facilisis in</li>');
					echo ('<li class="list-group-item">Morbi leo risus</li>');
					echo ('<li class="list-group-item">Porta ac consectetur ac</li>');
					echo ('<li class="list-group-item">Vestibulum at eros</li>');
				echo ('</ul>');
			}
			
		echo ('</div>');
	echo ('</div>');

	// GRADE DE PRODUTO DO SITE
	echo ('<div class="col-xs-6 col-sm-10 painel-produtos"><div class="row">');
		if ($produtos == null)
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
								//if (file_exists("includes/images/produtos/thumbnail/".$reg->codigo.".png"))
									echo ('<img src="'. base_url("includes/images/produtos/thumbnail/".$reg->codigo.".png") .'" alt="'.$reg->nome.'">');
								//else
								//	echo ('<img src="'. base_url("includes/images/produtos/semimagem.png") .'" alt="'.$reg->nome.'">');
								echo ('<div class="codigo">Codigo: '.$reg->codigo.'</div>
								<div class="caption">
									<h3>'.formataString($reg->nome).'</h3>');
									if (($reg->prepro < $reg->pvenda) && ($reg->prepro > 0))
										echo ('<p><strike>De: R$ '.$reg->prepro.'</strike> Por:  R$ '.$reg->pvenda.'</p>');
									else
										echo ('<p>Por:  R$ '.$reg->pvenda.'</p>');
									echo ('<p><a href="#" class="btn btn-default" role="button"><span class="glyphicon glyphicon-plus"> </span> Detalhes</a> <a href="#" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Comprar</a> </p>
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