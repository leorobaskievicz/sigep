<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Correios extends CI_Controller {

	public function index()
	{
		echo ("Especifique qual métodos você deseja utilizar.");
	}

	/*
		FUNCAO PARA BUSCAR ENDERECO ATRAVEZ DO CEP
		@param string cep 
		@return string endereco
	*/

	public function buscaCep ($cep = null)
	{
		if ($cep != null) {
			$localizacao = file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=json');  

		    if(!$localizacao){  
		        $localizacao = "&resultado=0&resultado_txt=erro+ao+buscar+cep";  
		    }  

		    $retorno = json_decode($localizacao);

		    switch ($retorno->resultado) {
		    	case 1:
		    		// Cep normal
		    		$texto = $retorno->tipo_logradouro." ".$retorno->logradouro.";".$retorno->bairro.";".$retorno->cidade.";".$retorno->uf;
		    		break;
		    	case 2:
		    		// Cep somente cidade e estado
		    		$texto = $retorno->cidade.";".$retorno->uf;
		    		break;
		    	default:
		    		// Falha ao receber frete
		    		$texto = "";
		    		break;
		    }

		    echo $texto;  
		} else
			echo "";
	}

	/*
		FUNCAO PARA CALCULAR PRAZO E PREÇO DE ENTREGA
		@param int cep 
		@return array(array(serviço, prazo, preco))
	*/

	public function calcFrete ($cep = null)
	{
		$retorno = array();

		if ($this->input->get("cep") != null)
			$cep = $this->input->get("cep");

		if ( $cep != null ) {

			/* ===== Calcula a valor total e prazo de entrega do frete ===== */
	        $data['nCdEmpresa'] = '';
	        $data['sDsSenha'] = '';
	        $data['sCepOrigem'] = '81020010';
	        $data['sCepDestino'] = $cep;
	        $data['nVlPeso'] = '0.5';
	        $data['nCdFormato'] = '1';
	        $data['nVlComprimento'] = '16';
	        $data['nVlAltura'] = '2';
	        $data['nVlLargura'] = '11';
	        $data['nVlDiametro'] = '1';
	        $data['sCdMaoPropria'] = 'n';
	        $data['nVlValorDeclarado'] = '0';
	        $data['sCdAvisoRecebimento'] = 'n';
	        $data['StrRetorno'] = 'xml';
	        //$data['nCdServico'] = "81019,40096,41068";
	        $data['nCdServico'] = "40010,41106";
	        $data = http_build_query($data);
	        $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';
	        $curl = curl_init($url . '?' . $data);
	        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	        $result = curl_exec($curl);
	        $result = simplexml_load_string($result);
	        $naoTemESEDEX = true;
	        foreach($result -> cServico as $row)  {
	            //Os dados de cada serviço estará aqui
	            if ($row->Erro == 0) {
	            	// Recebe as variaveis
	            	$codigoServico = intval($row->Codigo);
	            	$prazoEntrega  = (intval($row->PrazoEntrega) + 2);
	            	$precoEntrega  = floatval(str_replace(",",".",$row->Valor));

	            	switch($row->Codigo) {
	            		case 40010:
	            			$nomeServico = "SEDEX";
	            			break;
	            		case 41106:
	            			$nomeServico = "PAC";
	            			break;
	            		default:
	            			$nomeServico = "INDEFINIDO";
	            			break;
	            	}

	            	array_push($retorno, array(
	            		"codigo" => $codigoServico,
	            		"servico" => $nomeServico,
	            		"prazo" => $prazoEntrega,
	            		"preco" => $precoEntrega
	            	));
	            } else {
	            	$msgErro = $row->MsgErro;
	            	array_push($retorno, array(
	            		"codigo" => "999",
	            		"servico" => $msgErro,
	            		"prazo" => "0",
	            		"preco" => "0.00"
	            	));
	            }
	        }
	    }

	    $retorno = json_encode($retorno);

	    echo ($retorno);
	}


	
}
