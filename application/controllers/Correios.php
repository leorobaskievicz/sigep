<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Correios extends CI_Controller {

	public function index()
	{
		echo ("Especifique qual metodos voce deseja utilizar.");
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

	
}
