<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Ecommerce</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=9,chrome=1" /><!-- Definie padrões para renderizar como IE9 -->
	<!--<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>-->
	<link href="<?= base_url('includes/css/reset.css') ?>" type="text/css" rel="stylesheet" />
	<link href="<?= base_url('includes/css/style.css') ?>" type="text/css" rel="stylesheet" />
	<link href="<?= base_url('includes/css/home.css') ?>" type="text/css" rel="stylesheet" />
	<!-- Definições do favicon, imagem no endereço -->
	<link href='<?= base_url('includes/css/favicon.ico') ?>' rel='shortcut icon'/>
    <link href='<?= base_url('includes/css/favicon.png') ?>' rel='shortcut icon'/>
    <link href='<?= base_url('includes/css/favicon.png') ?>' rel='apple-touch-icon'/>
    <link href='<?= base_url('includes/css/favicon.png') ?>' rel='shortcut icon' type='image/x-icon'/>
	<!-- Definições para webapp, para iPhone -->
	<link rel="apple-touch-icon" href="<?= base_url('includes/css/apple-icon.png') ?>" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('includes/css/apple-icon.png') ?>" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('includes/css/apple-icon2.png') ?>" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('includes/css/apple-icon3.png') ?>" />
	<link rel="apple-touch-startup-image" href="<?= base_url('includes/css/apple-startup.png') ?>">
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-includes/css" content="black"/>
	<!-- imagem pra startup screen -->
	<meta name="msapplication-TileImage" content="<?= base_url('includes/css/logo.png') ?>">
	<meta name="msapplication-TileColor" content="#E6E6E6">
	<meta name="msapplication-badge" content="frequency=1440; polling-uri=http://tecworks.com.br">
	<!-- Biblioteca JQuery e funções do site 
	<script type="text/javascript" src="<?= base_url() ?>includes/js/functions.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>includes/js/main.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>includes/js/botoes.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>includes/js/table.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>includes/js/buscas.js"></script> -->
	<!-- Include Bootstrap -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<link rel="stylesheet" href="<?= base_url('includes/bootstrap/css/bootstrap.min.css') ?>">
	<script src="<?= base_url('includes/bootstrap/js/bootstrap.min.js') ?>"></script>
	<!-- Include NProgress -->
	<script src="<?= base_url('includes/js/nprogress/nprogress.js') ?>"></script>
	<link rel="stylesheet" href="<?= base_url('includes/js/nprogress/nprogress.css') ?>">
	<!-- Include jQuery Mask -->
	<script src="<?= base_url('includes/js/jqueryMask.js') ?>"></script>
	<script language="javascript">
		$(document).on("ready", function () {
			// Configura a barra de loader
			NProgress.configure({ showSpinner: true });
			NProgress.start();// Inicia barra de progresso
			$('#nprogress .bar').css({'background': '#00FFFF'});
			$('#nprogress .peg').css({'box-shadow': '0 0 10px #00FFFF, 0 0 5px #00FFFF'});
			$('#nprogress .spinner-icon').css({'border-top-color': '#fff', 'border-left-color': '#fff'});
			// Configura mascára nos campos necessários
			$("[name=data]").mask("99/99/9999");
			$("#data").mask("99/99/9999");
			$("[name=horas]").mask("99:99");
			// Funcao para corrigir tamanho da tela modal de acordo com monitor
			$('#myModal').on('show.bs.modal', function () {
			    $('.modal .modal-body').css('overflow-y', 'auto'); 
			    $('.modal .modal-body').css('height', $(window).height() * 0.7);
			});
			NProgress.done();// Encerre barra de progresso
		});
	</script>
</head>
<body>
	<!-- Modal Windows BootStrap - BoxSelect -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"></h4>
	      </div>
	      <div class="modal-body" style="height: auto; overflow-y: auto;">
	        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
	      </div>
	    </div>
	  </div>
	</div>

	<!-- CABECALHO GERAL DO SITE -->
	<div class="main-header">
		<div class="row menu-cliente">
			<div class="col-xs-6 col-sm-4"></div>
			<div class="col-xs-6 col-sm-4">
				<ul>
					<li><a href="#" target="_self"><span class="glyphicon glyphicon-phone-alt"></span> (41) 3246-4533</a></li>
					<li><a href="#" target="_self"><span class="glyphicon glyphicon-envelope"></span> sac@tecworks.com.br</a></li>
				</ul>
			</div>
			<div class="col-xs-6 col-sm-4">
				<ul id="menu-cliente-right">
					<li><a href="#" target="_self">Meu Cadastro</a></li>
					<li><a href="#" target="_self">Meus Pedidos</a></li>
					<li><a href="#" target="_self">Contato</a></li>
					<li><a href="#" target="_self">Duvidas</a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<!-- MOSTRA LOGOTIPO DA EMPRESA -->
			<div class="col-xs-6 col-sm-4 main-logo">
				<a href="#" target="_self"><img src="<?= base_url("includes/images/logo.png") ?>" alt="Logo"/></a>
			</div>
			<!-- BARRA DE PESQUISA DO SITE -->
			<div class="col-xs-6 col-sm-4 main-search">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Pesquisar">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
					</span>
				</div><!-- /input-group -->
			</div>
			<!-- MOSTRA PAINEL COM MINHA CESTA -->
			<div class="col-xs-6 col-sm-4">
				<div class="login-header">
					<header>Olá, visitante!</header>
					<p>
						Fazer login ou se cadastrar.
					</p>
				</div>
			</div>
		</div>
	</div>

	<!-- MENUBAR PRINCIPAL DO SITE -->
	<nav class="navbar navbar-default" data-spy="affix" data-offset-top="80" data-offset-bottom="200">
		<div class="container-fluid main-menubar">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- <a class="navbar-brand" href="#">Home</a> -->
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="#" target="_self">Home</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Aparelhos <span class="caret"></span></a>
						<ul class="dropdown-menu list-group">
							<li  class="produto-destaque">
								<div class="col-xs-12 col-sm-12">
									<div class="thumbnail">
										<img src="<?= base_url("includes/images/produtos/thumbnail/2") ?>" alt="Nome do Produto">
										<div class="caption">
											<h3>Produto # 1</h3>
											<p><strike>De: R$ 15,99</strike> Por:  R$ 10,99</p>
											<p><a href="#" class="btn btn-default" role="button">Detalhes</a> <a href="#" class="btn btn-success" role="button">Comprar</a> </p>
										</div>
									</div>
								</div>	
							</li>
							<li class="list-group-item"><a href="#">Olhos</a></li>
							<li class="list-group-item"><a href="#">Acessórios</a></li>
							<li class="list-group-item"><a href="#">Digestor</a></li>
            				<li class="list-group-item"><a href="#">Veja Mais...</a></li>
            				
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Medicamentos <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Cabelo</a></li>
							<li><a href="#">Higieno Bucal</a></li>
							<li><a href="#">Corpo</a></li>
							<li><a href="#">Rosto</a></li>
							<li><a href="#">Pressã Alta</a></li>
							<li role="separator" class="divider"></li>
            				<li><a href="#">Veja Mais...</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Genéricos <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Cabelo</a></li>
							<li><a href="#">Higieno Bucal</a></li>
							<li><a href="#">Corpo</a></li>
							<li><a href="#">Rosto</a></li>
							<li><a href="#">Pressã Alta</a></li>
							<li role="separator" class="divider"></li>
            				<li><a href="#">Veja Mais...</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dermocosméticos <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Cabelo</a></li>
							<li><a href="#">Higieno Bucal</a></li>
							<li><a href="#">Corpo</a></li>
							<li><a href="#">Rosto</a></li>
							<li><a href="#">Pressã Alta</a></li>
							<li role="separator" class="divider"></li>
            				<li><a href="#">Veja Mais...</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sua Beleza <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Cabelo</a></li>
							<li><a href="#">Higieno Bucal</a></li>
							<li><a href="#">Corpo</a></li>
							<li><a href="#">Rosto</a></li>
							<li><a href="#">Pressã Alta</a></li>
							<li role="separator" class="divider"></li>
            				<li><a href="#">Veja Mais...</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Seu Dia a Dia <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Cabelo</a></li>
							<li><a href="#">Higieno Bucal</a></li>
							<li><a href="#">Corpo</a></li>
							<li><a href="#">Rosto</a></li>
							<li><a href="#">Pressã Alta</a></li>
							<li role="separator" class="divider"></li>
            				<li><a href="#">Veja Mais...</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Outros <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Cabelo</a></li>
							<li><a href="#">Higieno Bucal</a></li>
							<li><a href="#">Corpo</a></li>
							<li><a href="#">Rosto</a></li>
							<li><a href="#">Pressã Alta</a></li>
							<li role="separator" class="divider"></li>
            				<li><a href="#">Veja Mais...</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">0 itens </a>
						<ul class="dropdown-menu">
							<li><a href="#">Cabelo</a></li>
							<li><a href="#">Higieno Bucal</a></li>
							<li><a href="#">Corpo</a></li>
							<li><a href="#">Rosto</a></li>
							<li><a href="#">Pressã Alta</a></li>
							<li role="separator" class="divider"></li>
            				<li><a href="#">Veja Mais...</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

	<!-- PAINEL - ELEMENTO QUE CENTRALIZA TODA AS PAGINAS DO SITE -->
	<div class="main-painel">