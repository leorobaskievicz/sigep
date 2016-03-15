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
	<!-- INCLUIR ARQUIVOS JQUERY NECESSÁRIOS NO SITE -->
	<script src="<?= base_url('includes/js/geral.js') ?>" defer></script>
	<script src="<?= base_url('includes/js/mask.js') ?>" defer></script>
	<script src="<?= base_url('includes/js/form.js') ?>" defer></script>
	<script src="<?= base_url('includes/js/thumbnail.carousel.js') ?>" defer></script>
</head>
<body>
	<!-- FORMULARIO DE AVISA-ME QUANDO CHEGAR USANDO MODAL JS BOOTSTRAP -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-transfer"></span> Avisa-me quando chegar</h4>
	      </div>
	      <div class="modal-body" style="height: auto; overflow-y: auto;">
	       <form action="<?= base_url("Produtos/avisamequandochegar") ?>" method="POST" name="aviasmequandochegar" class="form-horizontal"><fieldset>
				<div class="form-group">
					<label class="col-xs-3 col-sm-2 control-label" for="textinput">* Nome</label>
					<div class="col-xs-9 col-sm-10">
						<input id="textinput nome-avisamequandochegar" name="nome-avisamequandochegar" type="text" placeholder="Nome" class="form-control input-md">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-3 col-sm-2 control-label" for="textinput">* E-mail</label>
					<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="email-avisamequandochegar" type="email" placeholder="exemplo@exemplo.com.br" class="form-control input-md">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-3 col-sm-2 control-label" for="textinput">* Telefone</label>
					<div class="col-xs-9 col-sm-10">
						<input id="textinput" name="tel-avisamequandochegar" type="text" placeholder="(XX) XXXX-XXXXX" class="form-control input-md">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-3 col-sm-2 control-label" for="textinput">* Produto</label>
					<div class="col-xs-9 col-sm-10">
						<input name="codigo-avisamequandochegar" type="hidden">
						<input name="preco-avisamequandochegar" type="hidden">
						<input id="textinput" name="produto-avisamequandochegar" type="text" disabled="disabled" class="form-control input-md">
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-3 col-sm-2 control-label" for="textinput">Observação</label>
				</div>
				<div class="form-group">
					<div class="col-xs-9 col-sm-12">
						<textarea name="obs-avisamequandochegar" class="form-control" style="height: 150px !important;"></textarea>
					</div>
				</div>
			</fieldset></form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
	        <button type="button" class="btn btn-primary" onClick=" submitAvisaMeQuandoChegar(this); ">Enviar</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- CABECALHO GERAL DO SITE -->
	<div class="main-header">
		<div class="row sup-header">
			<div class="col-xs-12 col-sm-12">
				<ul>
					<li><a href="#" target="_self">Av. Brasília, 5540, sala 05 - Novo Mundo - Curitiba - PR - CEP: 81.020-010</li>
					<li><a href="#" target="_self"><span class="glyphicon glyphicon-phone-alt"></span> (41) 3246-4533</a></li>
					<li><a href="#" target="_self"><span class="glyphicon glyphicon-envelope"></span> sac@tecworks.com.br</a></li>
				</ul>
			</div>
		</div>
		<div class="content-header">
			<div class="row menu-cliente">
				<div class="col-xs-12 col-sm-12">
					<ul id="menu-cliente-right">
						<li><a href="<?= base_url('Cadastro') ?>" target="_self">Meu Cadastro</a></li>
						<li><a href="<?= base_url('Pedidos') ?>" target="_self">Meus Pedidos</a></li>
						<li><a href="<?= base_url('Contato') ?>" target="_self">Contato</a></li>
						<li><a href="<?= base_url('Duvidas') ?>" target="_self">Duvidas</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<!-- MOSTRA LOGOTIPO DA EMPRESA -->
				<div class="col-xs-2 col-sm-4 main-logo">
					<a href="<?= base_url() ?>" target="_self"><img src="<?= base_url("includes/images/logo.png") ?>" alt="Logo"/></a>
				</div>
				<!-- BARRA DE PESQUISA DO SITE -->
				<div class="col-xs-8 col-sm-4 main-search">
					<div class="input-group">
						<input type="text" class="form-control input-lg" name="search" placeholder="Pesquisar" autocomplete="off">
						<span class="input-group-btn">
							<button class="btn btn-default input-lg" type="button"><span class="glyphicon glyphicon-search"></span></button>
						</span>
					</div><!-- /input-group -->
					<ul class="list-group sugestao-produtos">
						<li class="list-group-item"><a href="#">Olhos</a></li>
						<li class="list-group-item"><a href="#">Acessórios</a></li>
						<li class="list-group-item"><a href="#">Digestor</a></li>
	    				<li class="list-group-item"><a href="#">Veja Mais...</a></li>
					</ul>
				</div>
				<!-- MOSTRA PAINEL COM MINHA CESTA -->
				<div class="col-xs-2 col-sm-4">
					<div class="login-header">
						<?php
							if (($this->session->userdata("codigo") != null) && ($this->session->userdata("nome") != null)) {
								echo ('<header>Olá, '.$this->session->userdata("nome").'!</header>
								<p>
									<a href="'. base_url("Login/fazerLogout?volta=".base64_encode(current_url())) .'" target="_self"><span class="glyphicon glyphicon-log-out"> </span> Sair</a>
								</p>');
							} else {
								echo ('<header>Olá, visitante!</header>
								<p>
									<a href="'. base_url("Login?volta=".base64_encode(current_url())) .'" target="_self">Fazer login</a> ou <a href="'. base_url("Cadastro") .'" target="_self">se cadastrar.</a>
								</p>');
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- MENUBAR PRINCIPAL DO SITE -->
	<nav class="navbar navbar-default" data-spy="affix" data-offset-top="125" data-offset-bottom="200">
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
					<li><a href="<?= base_url() ?>" target="_self">Home</a></li>

					<?php
						// RECUPERA VALORES SALVOS EM SESSÃO
						$menu1 = $this->session->userdata('menu1');
						$menu2 = $this->session->userdata('menu2');

						// MONTA MENU DINÂMICO CONFORME BANCO DE DADOS
						for ($i = 0; $i < count($menu1); $i++) {
							if (!empty($menu2[$i])) {
								echo ('<li class="dropdown">');
									echo ('<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$menu1[$i].' <span class="caret"></span></a>');
									echo ('<ul class="dropdown-menu list-group">');
										echo ('<li  class="produto-destaque">
											<div class="col-xs-12 col-sm-12">
												<div class="thumbnail">
													<img src="'. base_url("includes/images/produtos/thumbnail/2.png") .'" alt="Nome do Produto">
													<div class="caption">
														<h3>Produto # 1</h3>
														<p><strike>De: R$ 15,99</strike> Por:  R$ 10,99</p>
														<p><a href="#" class="btn btn-default" role="button"><span class="glyphicon glyphicon-plus"> </span> Detalhes</a> <a href="#" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Comprar</a> </p>
													</div>
												</div>
											</div>	
										</li>');
										for ($j = 0; $j < count($menu2[$i]); $j++)
											echo('<li class="list-group-item"><a href="'. base_url("Produtos/departamentos/".$menu1[$i]."/".$menu2[$i][$j]) .'">'.$menu2[$i][$j].'</a></li>');
			            				
			            				echo('<li class="list-group-item"><a href="'. base_url("Produtos/departamentos/".$menu1[$i]) .'">Todos</a></li>');
									echo ('</ul>');
								echo ('</li>');
							} else
								echo ('<li><a href="'. base_url("Produtos/departamentos/".$menu1[$i]) .'" target="_self">'.$menu1[$i].'</a></li>');
						}
					?>

					<li class="dropdown minha-cesta-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $totalItens ?> itens </a>
						<ul class="dropdown-menu">
							<li>
								<header><span class="glyphicon glyphicon-shopping-cart"></span> Meu Carrinho</header>
								<article><iframe src="<?= base_url('MeuCarrinho/minhaCesta') ?>" border="0"></iframe></article>
								<footer><a href="<?= base_url('MeuCarrinho') ?>" class="btn btn-primary" role="button" style="color: #FFF !important;"><span class="glyphicon glyphicon-shopping-cart"> </span> Finalizar Compra</a> TOTAL R$ <?= number_format($totalCarrinho,2,","," ") ?></footer>
							</li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

	<!-- PAINEL - ELEMENTO QUE CENTRALIZA TODA AS PAGINAS DO SITE -->
	<div class="main-painel">
		<?php

			/*
				BARRA DE LOCALIZAÇÃO DO SITE
			*/

			if ($this->uri->total_segments() >= 1) {
				if (strtolower($this->uri->total_segments(1)) != "home") {
					// MOSTRA A LOCALIZACAO QUE USUARIO ESTA NO SITE
					echo ('<ol class="breadcrumb">
						<li><span class="glyphicon glyphicon-record"> </span>  Você está aqui </li>
						<li><a href="'. base_url() .'">Home</a></li>');
						$link = "";
						for ($i = 1; $i <= $this->uri->total_segments(); $i++) {
							$link .= $this->uri->segment($i)."/";
							echo ('<li><a href="'. base_url($link) .'">'.$this->uri->segment($i).'</a></li>');
						}
					echo ('</ol>');
				}
			}

			/*
				VERIFICA SE EXISTE VARIÁVEL DE LOGIN PARA MOSTRAR MENSAGEM NA TELA DE BEM-SUCEDIDO OU NÃO
			*/
			if ($this->session->flashdata('login') != null) {
				if (strtolower($_SESSION['login']) != "erro") {
					echo ('<div class="alert alert-success" role="alert"> ');
						echo ('<span class="glyphicon glyphicon-ok"> </span>');
						echo (' Seja bem-vindo <strong>'.$_SESSION['nome'].'</strong> <a href="#" class="alert-link"></a> ');
						echo ('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
					echo ('</div>');
				} else {
					echo ('<div class="alert alert-danger" role="alert">');
						echo ('<span class="glyphicon glyphicon-remove"> </span>');
						echo (' <strong>Login incorreto</strong>, por favor tente novamente.');
						echo ('<a href="'. base_url("Login?volta=".base64_encode(current_url())) .'" class="alert-link"> Clique aqui para fazer login. </a>');
						echo ('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
					echo ('</div>');
				}
			}