<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	VERIFICA SE EXISTE VARIÁVEL DE LOGIN PARA MOSTRAR MENSAGEM NA TELA DE BEM-SUCEDIDO OU NÃO
*/
if (isset($login)) {
	if ($login) {
		echo ('<div class="alert alert-success" role="alert"> ');
			echo ('<span class="glyphicon glyphicon-ok"> </span>');
			echo (' Seja bem-vindo <strong>'.$_SESSION['nome'].'</strong> <a href="#" class="alert-link"></a> ');
			echo ('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
		echo ('</div>');
	} else {
		echo ('<div class="alert alert-danger" role="alert">');
			echo ('<span class="glyphicon glyphicon-remove"> </span>');
			echo (' <strong>Login incorreto</strong>, por favor tente novamente.');
			echo ('<a href="'. base_url("Login") .'" class="alert-link"> Clique aqui para fazer login. </a>');
			echo ('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
		echo ('</div>');
	}
}

// SLIDE DE IMAGENS PARA OS BANNERS DO SITE
echo ('<div id="home-slider">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				<li data-target="#carousel-example-generic" data-slide-to="1"></li>
				<li data-target="#carousel-example-generic" data-slide-to="2"></li>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img src="'. base_url("includes/images/1.png") .'" alt="Banner 1" class="slider-img">
					<div class="carousel-caption">
						<h3>Banner 1 de exibição</h3>
					</div>
				</div>
					<div class="item">
					<img src="'. base_url("includes/images/2.png") .'" alt="banner 2" class="slider-img">
					<div class="carousel-caption">
						<h3>Banner 2 de exibição no site</h3>
					</div>
				</div>
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
		</div>');

// MOSTRA A LOCALIZACAO QUE USUARIO ESTA NO SITE
/*echo ('<ol class="breadcrumb">
			<li><a href="#">Home</a></li>
		</ol>');*/

// GRADE DE PRODUTO DO SITE
echo ('<div class="row">');
if ($produtos == null)
	echo ('<h2>Nenhum produto encontrado.</h2>');
else {
	for ($i = 0; $reg = $produtos->fetch(); $i++) {

		// Verifica qual laco esta para pular linha
		if (($i % 5) == 0) {
			echo ('</div>');
			echo ('<div class="row">');
		} else {
			echo ('<div class="col-xs-6 col-sm-3">
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
				<a href="'. base_url("Home/index/".($limitInf - 20)) .'" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
				</a>
			</li>');

		//echo ('<li><a href="'. base_url("Home/index/".($limitInf + 20)) .'">1</a></li>');
		echo ('<li><a href="#">Página atual <strong>'. (ceil($limitInf/20) + 1) .'</strong></a></li>');

		echo ('<li>
			<a href="'. base_url("Home/index/".($limitInf + 20)) .'" aria-label="Next">
				<span aria-hidden="true">&raquo;</span>
			</a>
		</li>');
echo ('</ul>
	</nav>');