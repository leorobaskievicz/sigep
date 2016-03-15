<?php
defined('BASEPATH') OR exit('No direct script access allowed');

echo ('<div class="row checkout-content">');

	/*
		Barra lateral com resumo do pedido
	*/

	echo ('<div class="col-xs-16 col-sm-2" data-spy="affix" data-offset-top="125" data-offset-bottom="550">');
		echo ('<div class="panel panel-default atalhoMinhaCesta">');
			echo ('<div class="panel-heading"><span class="glyphicon glyphicon-shopping-cart"></span> Meu Carrinho</div>');
			echo ('<div class="panel-body"><table class="table table-condensed">');
				echo ('<thead><tr>');
					echo ('<th>#</th>');
					echo ('<th>Qtd</th>');
					echo ('<th>Preço</th>');
				echo ('</tr></thead>');

				echo ('<tbody>');
				$i = 1;
				foreach($produtos as $item) {
					echo ('<tr>');
						echo ('<td>'.$i.'</td>');
						echo ('<td>'.$item['qty'].'</td>');
						echo ('<td>R$ '.number_format($item['price'],2,","," ").'</td>');
						echo ('</tr>');
					$i++;
				}
				echo ('</tbody>');
			echo ('</table></div>');
			echo ('<div class="panel-footer"><strong>TOTAL R$ '.number_format($totalCarrinho,2,","," ").'</strong></div>');
		echo ('</div>');
	echo ('</div>');

	/*
		Área de checkout do site
	*/

	echo ('<div class="col-xs-16 col-sm-10 checkout-page">'); 

		echo ('<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">');

			/*
				PAINEL PARA DADOS DO CARRINHO - EXIBIÇÃO DE TODOS OS PRODUTOS DO CARRINHO
			*/
			echo ('<div class="panel panel-default">');
				echo ('<div class="panel-heading" role="tab" id="headingOne">
					<h1 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							<span class="glyphicon glyphicon-shopping-cart"></span> Meu Carrinho
						</a>
					</h1>
				</div>');
				echo ('<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">');
					echo ('<div class="panel-body">');
						echo ('<p>Confira abaixo os produtos do seu carrinho</p>');
					echo ('</div>');
					echo ('<table class="table checkout">');
							echo ('<thead>');
								echo ('<tr>');
									echo ('<th>#</th>');
									echo ('<th>Produto</th>');
									echo ('<th>Preço</th>');
									echo ('<th>Qtd</th>');
									echo ('<th>Subtotal</th>');
									echo ('<th>Apagar</th>'); 
								echo ('</tr>');
							echo ('</thead>');
							echo ('<tbody>');

								if ( empty($produtos) )
									echo ('<tr><td colspan="5"><h4> Carrinho vazio </h4></td></tr>');
								else {
									$i = 1;
									foreach($produtos as $item) {
										echo ('<tr>');
											echo ('<td>'.$i.'</td>');
											echo ('<td>');
												if (file_exists(base_url("includes/images/produtos/thumbnail/".$item['id'].".png")))
													echo ('<img src="'. base_url("includes/images/produtos/thumbnail/".$item['id'].".png") .'" alt="Foto do produto '.$item['name'].'" width="70" height="70" style="margin-right: 20px;"/>');
												else
													echo ('<img src="'. base_url("includes/images/produtos/semimagem.png") .'" alt="Foto do produto '.$item['name'].'" width="70" height="70" style="margin-right: 20px;"/>');
												echo ($item['name']);
											echo ('</td>');
											echo ('<td>R$ '.number_format($item['price'],2,","," ").'</td>');
											echo ('<td>'.$item['qty'].'</td>');
											echo ('<td>R$ '.number_format(($item['qty'] * $item['price']),2,","," ").'</td>');
											echo ('<td><a href="#" target="_self" class="btn btn-danger removeCarrinho" data-rowid="'.$item['rowid'].'" data-page="'. current_url() .'"><span class="glyphicon glyphicon-trash"></span> Apagar</a></td>');
										echo ('</tr>');
										$i++;
									}
								}

							echo ('</tbody>');
							echo ('<tfooter>');
								echo ('<tr>');
									echo ('<th colspan="4" style="text-align: right; font-size: 16px;">TOTAL</th>');
									echo ('<td colspan="2" style="text-align: center; font-size: 16px;"><b>R$ '.number_format($totalCarrinho,2,","," ").'</b></td>');
								echo ('</tr>');
							echo ('</tfooter>');
						echo ('</table>');
				echo ('</div>');
			echo ('</div>');

			/*
				PAINEL PARA FAZER LOGIN
			*/
			if (($this->session->userdata("codigo") == null) && ($this->session->userdata("nome") == null)) {
				
				echo ('<div class="panel panel-default">');
					echo ('<div class="panel-heading" role="tab" id="headingTwo">
						<h1 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								<span class="glyphicon glyphicon-log-in"></span> Fazer login
							</a>
						</h1>
					</div>');
					echo (' <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">');
						echo ('<div class="panel-body">');
							echo ('<p>Faça seu login para poder continuar a compra');
								// DADOS PESSOAIS DO CADASTRO
								echo ('<form action="'. base_url("Login?volta=".base64_encode(current_url())) .'" method="POST" name="formulario-login" class="form-horizontal">');
									echo ('<div class="col-xs-12 col-sm-6">');		

											echo ('<legend>Já sou cadastrado</legend>');
							 
											echo ('<div class="form-group">');
												echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Login*</label>');
												echo ('<div class="col-xs-9 col-sm-10">
													<input id="textinput" name="email-login" type="email" placeholder="E-mail" class="form-control input-md">
												</div>');
											echo ('</div>');

											echo ('<div class="form-group">');
												echo ('<label class="col-xs-3 col-sm-2 control-label" for="textinput">Senha*</label>');
												echo ('<div class="col-xs-9 col-sm-10">
													<input id="textinput" name="senha-login" type="password" placeholder="*****" class="form-control input-md">
												</div>');
											echo ('</div>');

											echo ('<div class="form-group">');
												echo ('<div class="col-xs-12 col-sm-12" style="text-align: right;">');
													echo ('<button type="submit" class="btn btn-primary btn-md">Entrar</button>');
												echo ('</div>');
											echo ('</div>');

									echo ('</div>');
								echo ('</form>');

								// MOSTRA FORMULARIO DE CAMPOS PARA CADASTRAR-SE
								echo ('<form action="'. base_url("Cadastro") .'" method="POST" name="formulario-cadastro" class="form-horizontal">');
									echo ('<div class="col-xs-12 col-sm-6">');		

											echo ('<legend>Não sou cadastrado</legend>');
							 
											echo ('<div class="form-group">');
												echo ('<label class="col-xs-3 col-sm-3 control-label" for="textinput">Nome*</label>');
												echo ('<div class="col-xs-9 col-sm-9">
													<input id="textinput" name="nome" type="text" placeholder="Nome" class="form-control input-md">
												</div>');
											echo ('</div>');

											echo ('<div class="form-group">');
												echo ('<label class="col-xs-3 col-sm-3 control-label" for="textinput">E-mail*</label>');
												echo ('<div class="col-xs-9 col-sm-9">
													<input id="textinput" name="email" type="email" placeholder="E-mail" class="form-control input-md">
												</div>');
											echo ('</div>');

											echo ('<div class="form-group">');
												echo ('<div class="col-xs-12 col-sm-12" style="text-align: right;">');
													echo ('<button type="submit" class="btn btn-primary btn-md">Cadastrar</button>');
												echo ('</div>');
											echo ('</div>');

									echo ('</div>');
								echo ('</form>');
							echo ('</p>');
						echo ('</div>');
					echo ('</div>');
				echo ('</div>');

			}

			/*
				PAINEL PARA FORMA DE ENTREGA
			*/
			echo ('<div class="panel panel-default">');
				echo ('<div class="panel-heading" role="tab" id="headingThre">
					<h1 class="panel-title">
						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThre" aria-expanded="false" aria-controls="collapseThre">
							<span class="glyphicon glyphicon-road"></span> Modo de entrega
						</a>
					</h1>
				</div>');
				echo (' <div id="collapseThre" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThre">');
					echo ('<div class="panel-body">');
						echo ('<p>Seleciona um modo de entrega mais adequado para sua necessidade');
							// DADOS PESSOAIS DO CADASTRO
							echo ('<form action="'. base_url("Login") .'" method="POST" name="formulario-login" class="form-horizontal">');
								echo ('<div class="col-xs-12 col-sm-6">');		

										echo ('<legend>Modo de entrega</legend>');
						 
										echo ('<div class="form-group">');
											echo ('<label class="col-xs-3 col-sm-2 control-label" for="servico">Serviço</label>
												<div class="col-xs-4 col-sm-4">
													<select id="servico" name="servico" class="form-control" onChange="selecionaFrete(this);">
														<option value="0">-- </option>
														<option value="40010">SEDEX</option>
														<option value="41106">PAC</option>
													</select>
												</div>');
										echo ('</div>');

								echo ('</div>');

								echo ('<div class="col-xs-12 col-sm-6 valor-frete">');
									for ($i = 0; $i < count($entrega); $i++) {	
										echo ('<table class="table table-bordered" id="'.$entrega[$i]->codigo.'">');	
											echo ('<caption>'.$entrega[$i]->servico.'</caption>');
											echo ('<thead>');
												echo ('<tr>');
													echo ('<th>Prazo</th>');
													echo ('<th>Valor</th>');
												echo ('</tr>');
											echo ('</thead>');
											echo ('<tbody>');
												echo ('<tr>');
													echo ('<td>Até <strong>'.$entrega[$i]->prazo.'</strong> dias úteis após confirmação do pagamento</td>');
													echo ('<td>R$ '.number_format($entrega[$i]->preco,2,","," ").'</td>');
												echo ('</tr>');
											echo ('</tbody>');
										echo ('</table>');
									}
								echo ('</div>');

							echo ('</form>');
						echo ('</p>');
					echo ('</div>');
				echo ('</div>');
			echo ('</div>');

			/*
				PAINEL PARA FORMA DE PAGAMENTO
			*/
			echo ('<div class="panel panel-default">');
				echo ('<div class="panel-heading" role="tab" id="headingFour">
					<h1 class="panel-title">
						<a class="collapsed forma-pagamento" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
							<span class="glyphicon glyphicon-credit-card"></span> Forma de pagamento
						</a>
					</h1>
				</div>');
				echo (' <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">');
					echo ('<div class="panel-body">');
						echo ('<p>Você será redirecionado para o ambiente 100% seguro do Pagseguro para efetuar o pagamento de sua compra.</p>');
					echo ('</div>');
				echo ('</div>');
			echo ('</div>');

		echo ('</div>');

	echo ('</div>');// DIV.COL 
echo ('</div>');// DIV.ROW