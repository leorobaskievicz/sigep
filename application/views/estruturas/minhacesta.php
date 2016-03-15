<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Meu Carrinho</title>
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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

echo ('<table class="table">');
	echo ('<thead>');
		echo ('<tr>');
			echo ('<th style="font-size: 14px; padding: 3px;">#</th>');
			echo ('<th style="font-size: 14px; padding: 3px;">Produto</th>');
			echo ('<th style="font-size: 14px; padding: 3px;">Preço</th>');
			echo ('<th style="font-size: 14px; padding: 3px;">Qtd</th>');
			echo ('<th style="font-size: 14px; padding: 3px;">Subtotal</th>');
		echo ('</tr>');
	echo ('</thead>');
	echo ('<tbody>');

		if ( empty($produtos) )
			echo ('<tr><td colspan="5"><h4> Carrinho vazia </h4></td></tr>');
		else {
			$i = 1;
			foreach($produtos as $item) {
				echo ('<tr>');
					echo ('<td style="font-size: 12px; padding: 4px 5px;">'.$i.'</td>');
					echo ('<td style="font-size: 12px; padding: 4px 5px;">');
						if (file_exists(base_url("includes/images/produtos/thumbnail/".$item['id'].".png")))
							echo ('<img src="'. base_url("includes/images/produtos/thumbnail/".$item['id'].".png") .'" alt="Foto do produto '.$item['name'].'" width="40" height="40" style="float: left;"/>');
						else
							echo ('<img src="'. base_url("includes/images/produtos/semimagem.png") .'" alt="Foto do produto '.$item['name'].'" width="40" height="40" style="float: left;"/>');
						echo ($item['name']);
					echo ('</td>');
					echo ('<td style="font-size: 12px; padding: 4px 5px;">R$ '.number_format($item['price'],2,","," ").'</td>');
					echo ('<td style="font-size: 12px; padding: 4px 5px;">'.$item['qty'].'</td>');
					echo ('<td style="font-size: 12px; padding: 4px 5px;">R$ '.number_format(($item['qty'] * $item['price']),2,","," ").'</td>');
				echo ('</tr>');
				$i++;
			}
		}

	echo ('</tbody>');
echo ('</table>');
?>
</body>
</html>