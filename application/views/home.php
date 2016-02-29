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
					<img src="..." alt="...">
					<div class="carousel-caption">
					...
					</div>
				</div>
				<div class="item">
					<img src="..." alt="...">
					<div class="carousel-caption">
					...
					</div>
				</div>
				...
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
					<img src="..." alt="...">
					<div class="caption">
						<h3>Thumbnail label</h3>
						<p>...</p>
						<p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
					</div>
				</div>
			</div>');
	}
}
echo ('</div>');