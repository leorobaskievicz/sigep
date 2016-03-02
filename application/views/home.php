<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
for ($i = 1; $i <= 20; $i++) {

	// Verifica qual laco esta para pular linha
	if (($i % 5) == 0) {
		echo ('</div>');
		echo ('<div class="row">');
	} else {
		echo ('<div class="col-xs-6 col-sm-3">
				<div class="thumbnail">
					<img src="'. base_url("includes/images/produtos/thumbnail/".$i) .'" alt="Nome do Produto">
					<div class="codigo">Codigo: '.$i.'</div>
					<div class="caption">
						<h3>Produto # '.$i.'</h3>
						<p><strike>De: R$ 15,99</strike> Por:  R$ 10,99</p>
						<p><a href="#" class="btn btn-default" role="button">Detalhes</a> <a href="#" class="btn btn-success" role="button">Comprar</a> </p>
					</div>
				</div>
			</div>');
	}
}
echo ('</div>');

// MOSTRA LINKS DE PROXIMA PAGINA E ANTERIOR
echo ('<nav id="navPages">
	<ul class="pagination">
		<li>
			<a href="#" aria-label="Previous">
				<span aria-hidden="true">&laquo;</span>
			</a>
		</li>
		<li><a href="#">1</a></li>
		<li><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">4</a></li>
		<li><a href="#">5</a></li>
		<li>
			<a href="#" aria-label="Next">
				<span aria-hidden="true">&raquo;</span>
			</a>
		</li>
	</ul>
	</nav>');