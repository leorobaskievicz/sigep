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
									echo ('<img src="'. base_url("includes/images/produtos/thumbnail/".($produto->codigo + $i).".png") .'" alt="0.jpg" class="img-responsive">');
								echo ('</div>');
					  		}
					  	echo ('</div>');

					  	// Thumbnails --> 
						echo ('<ul class="thumbnails-carousel clearfix">');
							for ($i = 0; $i <= 3; $i++)
								echo ('<li><img src="'. base_url("includes/images/produtos/thumbnail/".($produto->codigo + $i) .".png") .'" alt="1_tn.jpg"></li>');
						echo ('</ul>');
					echo ('</div>');
				} else
					echo ('<img src="'. base_url("includes/images/produtos/semimagem.png") .'" alt="Foto de '.$produto->nome.'" title="'.$produto->nome.'"/>');

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
								echo ('<form action="'. base_url("Cadastro/salvar") .'" method="POST" name="cadastro-cliente" class="form-horizontal"><fieldset>');
									echo ('<legend><span class="glyphicon glyphicon-shopping-cart"></span> Adicionar ao carrinho</legend>');
									echo ('<div class="form-group">');
										echo ('<label class="col-xs-3 col-sm-3 control-label" for="selectbasic">Quantidade</label>
											<div class="col-xs-2 col-sm-4">
												<select id="selectbasic" name="qtd" class="form-control">');

												for ($i = 1; $i <= $produto->estoque; $i++)
													echo ('<option value="'.$i.'">'.$i.'</option>');

												echo ('</select>
											</div>');
											echo ('<div class="col-xs-12 col-sm-5">');
												echo ('<button type="submit" class="btn btn-primary btn-md">Comprar</button>');
											echo ('</div>');
									echo ('</div>');
								echo ('</fieldset></form>');
							echo ('</div>');

							// DADOS PARA MOSTRAR MODO DE ENTREGA
							echo ('<div class="col-xs-6 col-sm-5">');
								echo ('<form action="'. base_url("Cadastro/salvar") .'" method="POST" name="cadastro-cliente" class="form-horizontal"><fieldset>');
									echo ('<legend><span class="glyphicon glyphicon-road"></span> Modo de entrega</legend>');
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
						echo ('<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce gravida, arcu nec ultrices pulvinar, sapien mauris rutrum mi, aliquet pellentesque odio velit et nulla. Nullam viverra in justo ac iaculis. Aliquam at odio vitae turpis dapibus tempus quis consectetur risus. Nunc auctor quis diam ut hendrerit. Aliquam condimentum vulputate dapibus. Praesent quis nulla non elit ullamcorper luctus eu tempor erat. Suspendisse molestie ex non sollicitudin consequat. Maecenas facilisis quam a sapien imperdiet venenatis.</p>
						<p>Integer suscipit efficitur erat, sit amet eleifend est rhoncus a. Maecenas at vehicula velit. Duis ultrices massa id ante rutrum, vitae faucibus velit vestibulum. Aliquam sit amet neque consectetur, elementum mauris at, blandit turpis. In eleifend arcu augue, quis rhoncus est pharetra at. Ut rutrum metus est, a cursus sem laoreet id. Mauris ultrices elit quis eleifend sodales. Nam non egestas mauris, nec bibendum libero. Duis maximus consectetur lacus, et lobortis velit pharetra nec. Duis ut ligula aliquet, aliquam ex eleifend, condimentum eros. Vestibulum imperdiet mattis felis sed auctor. Etiam aliquam sed tortor sed tempus. Phasellus molestie tellus risus, nec condimentum neque rutrum eget. In mauris justo, imperdiet at rhoncus sit amet, dapibus ac leo. Suspendisse fringilla sapien sed nibh commodo pulvinar. Vivamus eu diam elit.</p>');
						echo ('<p>'.$produtoCompl->descricao1.'</p>');
					echo('</div>');
					echo('<div id="informacao2" class="tab-pane fade">');
						echo ('<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam a magna non mi rutrum fermentum a ut dui. Pellentesque a mi placerat, sollicitudin tellus in, sollicitudin erat. Pellentesque accumsan velit at justo vulputate volutpat. Nunc dictum pulvinar quam, placerat ultricies neque sagittis ut. Vivamus sit amet nisl eu quam consequat lacinia. Nam efficitur pulvinar sapien, non fringilla sem consequat nec. Cras et tortor nec libero iaculis laoreet. Curabitur quis ipsum id urna consectetur pharetra. Nulla condimentum id dolor eget condimentum. Morbi efficitur eu lacus in varius. Morbi eu sapien efficitur est molestie cursus ac facilisis mauris.</p>');
						echo ('<p>'.$produtoCompl->descricao2.'</p>');
					echo('</div>');
					echo('<div id="informacao3" class="tab-pane fade">');
						echo ('<p>'.$produtoCompl->descricao3.'</p>');
						echo ('<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris fringilla non metus id dictum. Maecenas nec leo est. Vestibulum ut semper elit. Nullam tempus metus at pellentesque consectetur. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc semper facilisis porttitor. Phasellus lobortis interdum viverra.</p>
						<p>Curabitur vel imperdiet velit, nec sagittis metus. In dignissim ac ex quis gravida. Proin aliquet et dolor quis tincidunt. Etiam odio mi, feugiat ac felis a, bibendum aliquet sem. Nam eu nunc ornare, tincidunt neque sed, elementum lorem. Donec sit amet lectus id magna euismod aliquet sed ut est. Praesent sed libero blandit, placerat sem non, efficitur sem. Nam laoreet purus nec quam convallis, quis eleifend risus facilisis.</p>
						<p>Aenean at lacinia odio. Sed interdum vitae dui a interdum. Morbi sagittis libero ut tempus ullamcorper. Nulla pharetra tempus enim luctus pulvinar. Sed vel lobortis mi. Suspendisse id dui sit amet erat commodo molestie. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam a neque odio. Proin gravida finibus vehicula. Suspendisse potenti. Vivamus ac elit nec enim condimentum ultrices ut eget metus. Quisque sit amet massa condimentum, fermentum diam ut, lobortis mauris. In est ante, hendrerit at venenatis et, tincidunt non augue.</p>
						<p>Praesent a dui viverra magna fringilla iaculis nec eget mauris. Phasellus elementum a enim elementum ullamcorper. Morbi porttitor dapibus auctor. Praesent et est quis orci vestibulum luctus. Ut vitae enim suscipit, facilisis neque sed, molestie sapien. Curabitur dolor nulla, suscipit at sem at, laoreet pharetra velit. Integer sed felis porttitor, tincidunt turpis sed, molestie sem. Quisque nec tellus mauris. Fusce sit amet neque ut purus tincidunt imperdiet ac at mauris.</p>');
					echo('</div>');
					echo('</div>');
			echo ('</div>');

		echo ('</div>');

		// THUMBNAIL COM PRODUTOS PARECIDOS ---
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
		
	echo ('</div></div>');

echo ('</div>');// DIV.ROW MENULEFT