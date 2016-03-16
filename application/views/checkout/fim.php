<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	PAINEL DE MENSAGEM DE SUCESSO OU FALHA 
*/
echo ('<div class="row">');
	echo ('<div class="col-xs-6 col-sm-3"></div><div class="col-xs-6 col-sm-6">');
		
		if ($gravou) {
			echo ('<div class="panel panel-success">
				<div class="panel-heading"><h4><span class="glyphicon glyphicon-ok"></span> Pedigo gravado com sucesso</h4></div>
				<div class="panel-body">Obrigado pela sua compra! Você poderá acompanhar seu pedido pelas notificações enviadas por e-mail ou pela Central do Cliente.</div>
			</div>');
		} else {
			echo ('<div class="panel panel-danger">
				<div class="panel-heading"><h4><span class="glyphicon glyphicon-remove"></span> Pedido não gravado</h4></div>
				<div class="panel-body">Algo não ocorreu como esperado, seu pedido não foi recebido. Por favor, tente novamente.</div>
			</div>');
		}

	echo ('</div><div class="col-xs-6 col-sm-3"></div>');
echo ('</div>');

/*
	DADOS DO CLIENTE
*/

echo ('<div class="row">');
	echo ('<div class="col-xs-12 col-sm-12">');
		echo ('<h4>Dados do pedido</h4>');
		echo ('<table class="table">');
			echo ('<tr><th colspan="8">Dados pessoais</th></tr>');
			echo ('<tr>');
				echo ('<th>Cliente</th>');
				echo ('<td colspan="3">Leonardo Robaskievicz</td>');
				echo ('<th>CPF</th>');
				echo ('<td>085.001.219-80</td>');
				echo ('<th>E-mail</th>');
				echo ('<td>leonardo@tecworks.com.br</td>');
			echo ('</tr>');
			echo ('<tr><th colspan="8">Endereço de entrega</th></tr>');
			echo ('<tr>');
				echo ('<th>Endereço</th>');
				echo ('<td colspan="3">Rua Omilío Monteiro Soares</td>');
				echo ('<th>Número</th>');
				echo ('<td>2470</td>');
				echo ('<th>Complemento</th>');
				echo ('<td>Sobrado 07</td>');
			echo ('</tr>');
			echo ('<tr>');
				echo ('<th>CEP</th>');
				echo ('<td>81.030-380</td>');
				echo ('<th>Bairro</th>');
				echo ('<td>Fanny</td>');
				echo ('<th>Cidade</th>');
				echo ('<td>Curitiba</td>');
				echo ('<th>Estado</th>');
				echo ('<td>PR</td>');
			echo ('</tr>');
		echo ('</table>');
	echo ('</div>');
echo ('</div>');

/*
	MODO DE ENTREGA
*/

echo ('<div class="row">');
	echo ('<div class="col-xs-12 col-sm-12">');
		echo ('<h4>Modo de entrega do pedido</h4>');
		echo ('<table class="table">');
			echo ('<thead>');
				echo ('<tr>');
					echo ('<th>Serviço</th>');
					echo ('<th>Prazo</th>');
					echo ('<th>Preço</th>');
				echo ('</tr>');
			echo ('</thead>');
			echo ('<tbody>');
				echo ('<tr>');
					echo ('<td>SEDEX</td>');
					echo ('<td>Até 4 dias úteis após confirmação do pagamento</td>');
					echo ('<td>R$ '.number_format(10.00,2,","," ").'</td>');
				echo ('</tr>');
			echo ('</tbody>');
		echo ('</table>');
	echo ('</div>');
echo ('</div>');

/*
	TABELA COM DADOS DO PEDIDOS
*/

echo ('<div class="row">');
	echo ('<div class="col-xs-12 col-sm-12">');
		echo ('<h4>Produtos do pedido</h4>');
		echo ('<table class="table table-striped">');
			echo ('<thead>');
				echo ('<tr>');
					echo ('<th>#</th>');
					echo ('<th>Produto</th>');
					echo ('<th>Preço</th>');
					echo ('<th>Quantidade</th>');
					echo ('<th>Subtotal</th>');
				echo ('</tr>');
			echo ('</thead>');
			echo ('<tbody>');
				$i = 1;
				$total = 0;
				foreach($produtos as $item){
					$subtotal = ($item['price'] * $item['qty']);
					$total += $subtotal;
					echo ('<tr>');
						echo ('<td>'.$i.'</td>');
						echo ('<td>'.$item['name'].'</td>');
						echo ('<td>R$ '.number_format($item['price'],2,","," ").'</td>');
						echo ('<td>'.$item['qty'].'</td>');
						echo ('<td>R$ '.number_format($subtotal,2,",", " ").'</td>');
					echo ('</tr>');
					$i++;
				}
			echo ('</tbody>');
			echo ('<tfooter>');
				echo ('<tr>');
					echo ('<th colspan="4" style="text-align: right;">TOTAL</th>');
					echo ('<td>R$ '.number_format($total,2,","," ").'</td>');
				echo ('</tr>');
			echo ('</tfooter>');
		echo ('</table>');

		echo ('<a href="'. base_url("/Home") .'" target="_self" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Voltar para loja</a>');
	echo ('</div>');
echo ('</div>');