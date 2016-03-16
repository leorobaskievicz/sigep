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
		echo ('<div class="row">');
			echo ('<div class="col-xs-6 col-sm-4 foto-produto">');
				if (file_exists(base_url("includes/images/produtos/thumbnail/".$produto->codigo.".png"))) {
					echo ('<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">');
						// Wrapper for slides -->
					  	echo ('<div class="carousel-inner">');
					  		for ($i = 0; $i <= 5; $i++) {
					  			if ($i == 0)
					  				echo ('<div class="item active srle">');
					  			else
									echo ('<div class="item">');
									echo ('<img src="'. base_url("includes/images/produtos/thumbnail/".($produto->codigo + $i).".png") .'" alt="0.jpg" class="img-responsive" id="foto-produto">');
								echo ('</div>');
					  		}
					  	echo ('</div>');

					  	// Thumbnails --> 
						echo ('<ul class="thumbnails-carousel clearfix">');
							for ($i = 0; $i <= 3; $i++)
								echo ('<li><img src="'. base_url("includes/images/produtos/thumbnail/".($produto->codigo + $i) .".png") .'" alt="1_tn.jpg" id="foto-produto"></li>');
						echo ('</ul>');
					echo ('</div>');
				} else
					echo ('<img src="'. base_url("includes/images/produtos/semimagem.png") .'" alt="Foto de '.$produto->nome.'" title="'.$produto->nome.'" id="foto-produto"/>');

			echo ('</div>');

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
								echo ('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-info-sign"></span> Preços válidos somente para loja online.</div>');
							echo ('</div>');
						echo ('</div>');

						// MOSTRA PREÇO DO PRODUTO
						echo ('<div class="row"><div class="col-xs-6 col-sm-12 preco-produto">');
							if (($produto->prepro < $produto->preco) && ($produto->prepro > 0))
								echo ('<h4><span><strong><strike>De:</strong> R$ '.number_format($produto->preco,2,","," ").'</strike></span> <strong>Por: </strong> R$ '.number_format($produto->prepro,2,","," ").'</h4>');
							else
								echo ('<h4><strong>Por: </strong> R$ '.number_format($produto->preco,2,","," ").'</h4>');
						echo ('</div></div>');
						echo ('<br/>');

						// DADOS PARA ADICIONAR O PRODUTO NO CARRINHO
						echo ('<div class="row">');

							echo ('<div class="col-xs-6 col-sm-7">');
								echo ('<form action="'. base_url("Carrinho/salvar") .'" method="GET" name="add-carrinho" class="form-horizontal"><fieldset>');
									echo ('<legend><span class="glyphicon glyphicon-shopping-cart"></span> Adicionar ao carrinho</legend>');
									echo ('<input type="hidden" name="codigo" value="'.$produto->codigo.'" />');
									echo ('<input type="hidden" name="nome" value="'.formataStringToURL($produto->nome).'" />');
									echo ('<div class="form-group">');
										if ($produto->estoque > 0) {
											echo ('<label class="col-xs-3 col-sm-3 control-label" for="selectbasic">Quantidade</label>
												<div class="col-xs-2 col-sm-4">
													<select id="selectbasic" name="qtd" class="form-control">');

													for ($i = 1; $i <= $produto->estoque; $i++)
														echo ('<option value="'.$i.'">'.$i.'</option>');

													echo ('</select>
												</div>');
												echo ('<div class="col-xs-12 col-sm-5">');
													echo ('<button type="submit" class="btn btn-primary btn-md" id="addCarrinho">Comprar</button>');
												echo ('</div>');
										} else {
											echo ('<div class="col-xs-12 col-sm-12">');
												echo ('<button type="submit" class="btn btn-success btn-md" id="avisaMeQuandoChegar" data-codigo="'.$produto->codigo.'" data-produto="'.$produto->nome.'" data-preco="'.$produto->preco.'">Avisa-me quando chegar</button>');
											echo ('</div>');
										}
									echo ('</div>');
									if (($produto->prepro < $produto->preco) && ($produto->prepro > 0))
										echo ('<input type="hidden" name="preco" value="'.$produto->prepro.'" />');
									else
										echo ('<input type="hidden" name="preco" value="'.$produto->preco.'" />');
									echo ('<input type="hidden" name="peso" value="'.$produto->peso.'" />');
								echo ('</fieldset></form>');
							echo ('</div>');

							// DADOS PARA MOSTRAR MODO DE ENTREGA
							echo ('<div class="col-xs-6 col-sm-5">');
								echo ('<fieldset>');
									echo ('<legend><span class="glyphicon glyphicon-road"></span> Modo de entrega</legend>');
									echo ('<div class="form-group">');
										echo ('<label class="col-xs-3 col-sm-3 control-label" for="selectbasic">CEP</label>
											<div class="col-xs-2 col-sm-7">
												<input id="textinput" name="cep-entrega" data-peso="'.$produto->peso.'" type="text" placeholder="00.000-000" class="form-control input-md">
											</div>');
									echo ('</div>');
								echo ('</fieldset>');
							echo ('</div>');
						echo ('</div>');

						// DADOS PARA MOSTRAR SIMULAÇÃO DO FRETE
						echo ('<div class="col-xs-6 col-sm-12 resultado-frete">');
							echo ('<div class="panel panel-default">');
								echo ('<div class="panel-heading">Simulação de entrega</div>');
								echo ('<div class="panel-body">');
									echo ('<p>Prazos e preços de entrega sujeito a alteração conforme tabela dos Correios.</p>');
								echo ('</div>');
								echo ('<table class="table table-condensed">');
									echo ('<thead><tr>');
										echo ('<th>Modo de entrega</th>');
										echo ('<th>Prazo</th>');
										echo ('<th>Preço</th>');
									echo ('</tr></thead>');
									echo ('<tbody></tbody>');
								echo ('</table>');
							echo ('</div>');
						echo ('</div>');

						// LISTA PARA LINKS DIVERSOS
						echo ('<ul class="list-group">');
							echo ('<li class="list-group-item">Redes Sociais</li>');
						echo ('</ul>');

					echo ('</div>');
				echo ('</div>');
			echo ('</div>');
		echo ('</div>');

		// INFORMAÇÕES COMPLEMENTARS
		echo ('<div class="row">');

			// ESPECIFICAÇÕES TÉCNICAS
			echo ('<div class="col-xs-6 col-sm-12">');
				echo ('<h2><span class="glyphicon glyphicon-tag"></span> Sobre este produto</h2>');
				echo ('<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#informacao1">Especificação técnica</a></li>
					<li><a data-toggle="tab" href="#informacao2">Dados complementares 1</a></li>
					<li><a data-toggle="tab" href="#informacao3">Dados complementares 2</a></li>
				</ul>');

				echo ('<div class="tab-content">');
					echo ('<div id="informacao1" class="tab-pane fade in active">');
						if ($produtoCompl != null)
							echo ('<p>'.$produtoCompl->descricao1.'</p>');
					echo('</div>');
					echo('<div id="informacao2" class="tab-pane fade">');
						if ($produtoCompl != null)
							echo ('<p>'.$produtoCompl->descricao2.'</p>');
					echo('</div>');
					echo('<div id="informacao3" class="tab-pane fade">');
						if ($produtoCompl != null)
							echo ('<p>'.$produtoCompl->descricao3.'</p>');
					echo('</div>');
					echo('</div>');
			echo ('</div>');

		echo ('</div>');

		// THUMBNAIL COM PRODUTOS PARECIDOS ---
		if ($parecidos != null) {
			echo ('<div class="row">');
				echo ('<div class="col-xs-6 col-sm-12 produtos-parecido-container">');
					echo ('<h2><span class="glyphicon glyphicon-pushpin"></span> Produtos parecidos</h2>');
					echo ('<div id="produtos-parecidos" class="carousel slide produtos-parecido" data-ride="carousel">');
						// Wrapper for slides -->
						echo ('<div class="carousel-inner" role="listbox">');

							for ($i = 1; $i <= $parecidos->rowCount(); $i+=3) {
								if ($i == 1)
									echo ('<div class="item active row">');
								else
									echo ('<div class="item row">');
								for ($j = $i; ($j <= $i+2 && ($reg = $parecidos->fetch())) ; $j++) {
									
									echo ('<div class="col-xs-6 col-sm-4"><div class="thumbnail">');
										if (file_exists(base_url("includes/images/produtos/thumbnail/".$reg->codigo.".png"))) {
											list($width, $height, $type, $attr) = getimagesize(base_url("includes/images/produtos/thumbnail/".$reg->codigo.".png"));
											if ($height > $width)
												echo ('<img src="'. base_url("includes/images/produtos/thumbnail/".$reg->codigo.".png") .'" style="height: 170px !important;" alt="'.$reg->nome.'">');
											else
												echo ('<img src="'. base_url("includes/images/produtos/thumbnail/".$reg->codigo.".png") .'" style="width: 170px !important;" alt="'.$reg->nome.'">');
										}else
											echo ('<img src="'. base_url("includes/images/produtos/semimagem.png") .'" alt="'.$reg->nome.'">');
										echo ('<div class="codigo">Codigo: '.$reg->codigo.'</div>');
										echo ('<div class="caption">');
											echo ('<h3>'.formataString($reg->nome).'</h3>');
											if (($reg->prepro < $reg->preco) && ($reg->prepro > 0))
												echo ('<p><strike>De: R$ '.number_format($reg->preco,2,","," ").'</strike> Por:  R$ '.number_format($reg->prepro,2,","," ").'</p>');
											else
												echo ('<p>Por:  R$ '.number_format($reg->preco,2,","," ").'</p>');
											echo ('<p><a href="'. base_url("Produtos/detalhes/".formataStringToURL($reg->nome)."/".$reg->codigo) .'" class="btn btn-default" role="button"><span class="glyphicon glyphicon-plus"> </span> Detalhes</a> <a href="#" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-shopping-cart"> </span> Comprar</a> </p>');
										echo ('</div>');
									echo ('</div></div>');
								}
								echo ('</div>');
							}
						echo ('</div>');

						// Controls -->
						echo ('<a class="left carousel-control" href="#produtos-parecidos" role="button" data-slide="prev">');
							echo ('<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>');
							echo ('<span class="sr-only">Previous</span>');
						echo ('</a>');
						echo ('<a class="right carousel-control" href="#produtos-parecidos" role="button" data-slide="next">');
							echo ('<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>');
							echo ('<span class="sr-only">Next</span>');
						echo ('</a>');
					echo ('</div>');
				echo ('</div>');
			echo ('</div>');
		}
		
	echo ('</div></div>');

echo ('</div>');// DIV.ROW MENULEFT