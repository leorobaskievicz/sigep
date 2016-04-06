<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sigep
{
    private $CI;// Variável usada para carregar models, views CodIgniter

    /*
        DEFINICAO DE CONSTANTES UTILIZADAS NO PROJETO SIGEP
    */
    private $end_dev = 'https://apphom.correios.com.br/SigepMasterJPA/AtendeClienteService/AtendeCliente?wsdl';
    private $end_pro = 'https://apps.correios.com.br/SigepMasterJPA/AtendeClienteService/AtendeCliente?wsdl';
    private $cod_adm = null;
    private $cod_contrato = null;
    private $cod_cartao = null;
    private $cnpj = null;
    private $usuario = null;
    private $senha = null;
    private $cep = null;

	private $disponibilidadeServico = false;
	private $erro = false;
    private $msgErro = null;
	private $msgSucesso = null;

    /**
    *   CONTRUTOR DA CLASSE - BUSCA DADOS NO BANCO DE DADOS PARA USAR NO WEBSERVICE DOS CORREIOS
    */

    public function __construct ()
    {
        $this->CI =& get_instance();

        $this->CI->load->model("M_Sigep");
        if ( ($busca = $this->CI->M_Sigep->buscar("SELECT * FROM tb_cliente LIMIT 0,1")) == false)
            return false;

        if ($busca->rowCount() <= 0)
            return false;

        $dados = $busca->fetch();
        $this->cod_adm = $dados->codadministrativo;
        $this->cod_contrato = $dados->contrato;
        $this->cnpj = $dados->cnpj;
        $this->cod_cartao = $dados->cartaopostagem;
        $this->usuario = $dados->usuario;
        $this->senha = $dados->senha;
        $this->cep = $dados->cep;
        return true;
    }

	/**
	*  VERIFICA DISPONIBILIDADE DO SERVICO PARA O CODIGO ADMINITRATIVO, SERVICO SOLICITADO E CEP DE DESTINO
	*  @param int cep de destino, int numero do servico
	*  @return bool true e caso de consulta bem sucedida ou false em caso de consulta falhou
	*  Os retornos da funcao dos correios sao salvas nas variaveis de classe
	*/

	public function verificaDisponibilidadeServico ($cepDestino = null, $numeroServico = null) 
	{
		if (($cepDestino == null) || ($numeroServico == null)) {
			$this->msgErro = "CEP de destino ou número de serviço não específicado.";
            $this->erro = true;
        } else {

            $cepDestino = limpaString($cepDestino);
            $numeroServico = limpaString($numeroServico);

            try{
                $service = new SoapClient($this->end_dev);

                // Verifica Cartão de Postagem
                $soapArgs = array(
                    'codAdministrativo' => $this->cod_adm,
                    'numeroServico' => $numeroServico,
                    'cepOrigem' => $this->cep,
                    'cepDestino' => $cepDestino,
                    'usuario' => $this->usuario,
                    'senha' => $this->senha
                );

                // Resultados possíveis de $result->return: Normal | Cancelado
                $result = $service->verificaDisponibilidadeServico( $soapArgs );   

                if ($result)
                    $this->msgSucesso = true;
                else 
                    $this->msgSucesso = false;

            } catch( Exception $e ) {

                $this->msgErro = 'Erro retornado do SIGEP: ' . $e->getMessage();
                $this->erro = true;

            }

        }

        return array("msgErro" => $this->msgErro, "msgSucesso" => $this->msgSucesso);
	}

	/**
	*  CONSULTA SERVICOS DISPONIVEIS PARA O CONTRATO DO CLIENTE
	*  @param void
	*  @return bool true e caso de consulta bem sucedida ou false em caso de consulta falhou
	*  Os retornos da funcao dos correios sao salvas nas variaveis de classe
	*  Essa funcao serve para montar a tabela Tb_Servicos_ECT - Pode ser excutado periodicamente
	*/

	public function buscaCliente ()
	{
		try{

            $service = new SoapClient($this->end_dev);

            // Verifica Cartão de Postagem
            $soapArgs = array(
                'idContrato' => $this->cod_contrato,
                'idCartaoPostagem' => $this->cod_cartao,
                'usuario' => $this->usuario,
                'senha' => $this->senha
            );

            // Resultados possíveis de $result->return: Normal | Cancelado
            $result = $service->buscaCliente( $soapArgs );   
			           
            $this->CI->load->model("M_Sigep");

            // Verifica se foi retornados dados de servicos
            if (count($result->return->contratos->cartoesPostagem->servicos) > 0)
            	$this->CI->M_Sigep->limpaTabela("tb_servicos_ect");

            // Com os servicos retornados salva os dados da tabela tb_servicos_ect
            foreach ($result->return->contratos->cartoesPostagem->servicos as $servico) {
            	$param = array(
            		"idServico" => $servico->id,
            		"codigoServicoECT" => utf8_encode($servico->codigo),
            		"descricaoServicoECT" => $servico->descricao);

            	$insere = $this->CI->M_Sigep->insere("tb_servicos_ect", $param);

            	if (!$insere) {
            		$this->erro = true;
            		$this->msgErro = "Erro ao inserir o serviço ".$servico->descricao." no banco de dados";
            	}
            
            }

            $this->msgSucesso = "Dados atualizados com sucesso.";

        } catch( Exception $e ) {

            $this->msgErro = 'Erro retornado do SIGEP: ' . $e->getMessage();
            $this->erro = true;

        }

        return array("msgErro" => $this->msgErro, "msgSucesso" => $this->msgSucesso);
	}

	/**
	*	CONSULTA CEP DE DESTINO
	* @param int numero do cep
	* @return json com dados do endereco do CEP correspondete
	*/

	public function buscaCEP ( $cep = null )
	{
		if ($cep == null) {
            $this->msgErro = 'CEP não específicado. Ex.: buscaCEP/81030001';
            $this->erro = true;
        } else {

            // Remove todas as pontucoes da string de cep caso tenha
            $cep = limpaString( $cep );

            try{

                $service = new SoapClient($this->end_dev);

                // Verifica CEP
                $soapArgs = array( 'cep' => $cep );

                // Resultados possíveis de $result->return: Normal | Cancelado
                $result = $service->consultaCEP( $soapArgs );   

                // Monta objeto para o retorno dos correios
                $obj = new stdClass();
                $obj->label = "Endereço para o CEP informado.";
                $obj->data = array(
                    "cep" => $result->return->cep,
                    "end" => $result->return->end,
                    "bairro" => $result->return->bairro,
                    "cidade" => $result->return->cidade,
                    "uf" => $result->return->uf,
                    "complemento" => $result->return->complemento,
                    "complemento2" => $result->return->complemento2);
                // Converte o obj de retorno em json
                $retorno = json_encode($obj);

                $this->msgSucesso = $retorno;

            } catch( Exception $e ) {

                $this->msgErro = 'Erro retornado do SIGEP: ' . $e->getMessage();
                $this->erro = true;

            }

        }

        return array("msgErro" => $this->msgErro, "msgSucesso" => $this->msgSucesso);
	}

	/**
	*	VERIFICA STATUS DO CARTAO DE POSTAGEM
	* @param void
	* @return bool true e caso de consulta bem sucedida ou false em caso de consulta falhou
	*/

	public function consultaCartaoPostagem ()
	{

		try{
            $service = new SoapClient($this->end_dev);

            // Verifica Cartão de Postagem
            $soapArgs = array(
                'numeroCartaoPostagem' => $this->cod_cartao,
                'usuario' => $this->usuario,
                'senha' => $this->senha
            );

            // Resultados possíveis de $result->return: Normal | Cancelado
            $result = $service->getStatusCartaoPostagem( $soapArgs );   

            $this->msgSucesso = $result->return;

        } catch( Exception $e ) {

            $this->msgErro = 'Erro retornado do SIGEP: ' . $e->getMessage();
            $this->erro = true;

        }
        return array("msgErro" => $this->msgErro, "msgSucesso" => $this->msgSucesso);
	}

	/**
	*	FUNCAO PARA SOLICITAR FAIXA DE NUMERACAO DE ETIQUETAS
	* @param int id do servico, int quantida de etiquetas
	* @return bool true em caso de sucesso
	*/

	public function solicitaEtiquetas ( $idServico = null, $qtd = null)
	{
		if (($idServico == null) || ($qtd == null)) {
            $this->erro = true;
            $this->msgErro = "ID e QTD DE ETIQUETAS não específicado. Ex.: solicitaEtiquetas/idservico/qtdEtiquetas";
        } else {

            try{
                $service = new SoapClient($this->end_dev);

                // Verifica Cartão de Postagem
                $soapArgs = array(
                    'tipoDestinatario' => "C",
                    'identificador' => $this->cnpj,
                    'idServico' => $idServico,
                    'qtdEtiquetas' => $qtd,
                    'usuario' => $this->usuario,
                    'senha' => $this->senha
                );

                // Faz consulta no SIGEP dos correios
                $result = $service->solicitaEtiquetas( $soapArgs );  

                if ( $qtd > 1 ) {

                    $etiquetas = explode(",", $result->return);
                    $prefix   = substr($etiquetas[0], 0, 2);
                    $sufix    = substr($etiquetas[0], 10);
                    $faixaIni = substr($etiquetas[0], 2, 8);
                    $faixaFim = substr($etiquetas[1], 2, 8);

                    $this->CI->load->model("M_Sigep");

                    $retorno = $etiquetas[0].";";
                    $insere = $this->CI->M_Sigep->insere("tb_pedido_servico", array("idServicosECT" => $idServico, "codigoObjetoECT" => $etiquetas[0]));

                    for ($i = ($faixaIni + 1); $i <= ($faixaFim - 1); $i++) {
                        $retorno .= $prefix.$i.$sufix.";";
                        $insere = $this->CI->M_Sigep->insere("tb_pedido_servico", array("idServicosECT" => $idServico, "codigoObjetoECT" => $prefix.$i.$sufix));
                    }
                    $retorno .= $etiquetas[1];
                    $insere = $this->CI->M_Sigep->insere("tb_pedido_servico", array("idServicosECT" => $idServico, "codigoObjetoECT" => $etiquetas[1]));

                } else {

                    $etiquetas = explode(",", $result->return);
                    $insere = $this->CI->M_Sigep->insere("tb_pedido_servico", array("idServicosECT" => $idServico, "codigoObjetoECT" => $etiquetas[0]));
                    $retorno = $etiquetas[0];

                }

                $this->msgSucesso = $retorno;

            } catch( Exception $e ) {

                $this->msgErro = 'Erro retornado do SIGEP: ' . $e->getMessage();
                $this->erro = true;

            }

        }
        return array("msgErro" => $this->msgErro, "msgSucesso" => $this->msgSucesso);
	}

	/**
	*	FUNCAO PARA SOLICITAR DIGITO VERIFICADOR DE DETERMINADA ETIQUETA
	* @param int id do servico, int quantida de etiquetas
	* @return bool true em caso de sucesso
	*/

	public function solicitaDigitoEtiquetas ( $etiquetas = null)
	{
		if ( $etiquetas == null ) {
            $this->msgErro = "Número de Etiqueta não específicado. Ex.: solicitaDigitoEtiquetas/ID_ETIQUETA";
            $this->erro = true;
        } else {

            try{
                $service = new SoapClient($this->end_dev);

                $soapArgs = array(
                    'etiquetas' => urldecode($etiquetas),
                    'usuario' => $this->usuario, 
                    'senha' => $this->senha);

                // Faz consulta no SIGEP dos correios
                $result = $service->geraDigitoVerificadorEtiquetas( $soapArgs );   

                $this->msgSucesso = $result->return;

                $this->CI->load->model("M_Sigep");
                $param = array("digitoCodigoObjetoECT" => $this->msgSucesso);
                $this->CI->M_Sigep->editar("tb_pedido_servico", $param, "codigoObjetoECT LIKE '".$etiquetas."'");

            } catch( Exception $e ) {

                $this->msgErro = 'Erro retornado do SIGEP: ' . $e->getMessage();
                $this->erro = true;

            }

        }
        return array("msgErro" => $this->msgErro, "msgSucesso" => $this->msgSucesso);
	}

	/**
	*	FUNCAO PARA FECHAR DADOS DA PLP - NO QUAL ENVIA DADOS DO ENVIO PARA O CORREIOS
	* @param int id do servico, int quantida de etiquetas
	* @return bool true em caso de sucesso
	*/

	public function fechaPLP ( $etiquetas = null , $idPlpCliente = null )
	{  
        if ( $etiquetas == null ) {
            $this->msgErro = "Números de etiquetas não informado.";
            $this->erro = true;
        } else {

            try{
                $service = new SoapClient($this->end_dev);

                // Monta XML com dados de envio
                $xml = $this->montaXMLPLP ($etiquetas);

                $arq = fopen("../plp.xml", "w");
                fwrite($arq, $xml);
                fclose($arq);

                $soapArgs = array(
                    'xml' => $xml,
                    'idPlpCliente' => $idPlpCliente,
                    'cartaoPostagem' => $this->cod_cartao,
                    'listaEtiquetas' => $etiquetas,
                    'usuario' => $this->usuario,
                    'senha' => $this->senha);

                // Faz consulta no SIGEP dos correios
                $result = $service->fechaPlpVariosServicos( $soapArgs );   

                $idPlp = $result->return;
                $this->msgSucesso = $idPlp;

            } catch( Exception $e ) {

                $this->msgErro = 'Erro retornado do SIGEP: ' . $e->getMessage();
                $this->erro = true;

            }

        }
        return array("msgErro" => $this->msgErro, "msgSucesso" => $this->msgSucesso);
	}

	/**
	*	FUNCAO PARA RECUPERAR O XML DA PLP PASSADA PELO PARAMETRO COM OS DADOS AFERIDOS PELO CORREIOS
	* @param int id PLP
	* @return bool true em caso de sucesso
	*/

	public function solicitaXmlPlp ( $idPlp = null )
	{
		if ( $idPlp == null ) {
            $this->msgErro = "ID da PLP não específicado. Ex.: solicitaXmlPlp/ID_PLP";
            $this->erro = true;
        } else {

            try{
                $service = new SoapClient($this->end_dev);

                $soapArgs = array(
                    'idPlpMaster' => $idPlp,
                    'usuario' => $this->usuario,
                    'senha' => $this->senha);

                // Faz consulta no SIGEP dos correios
                $result = $service->solicitaXmlPlp( $soapArgs );   

                $this->msgSucesso = $result; 

            } catch( Exception $e ) {

                $this->msgErro = 'Erro retornado do SIGEP: ' . $e->getMessage();
                $this->erro = true;

            }

        }
        return array("msgErro" => $this->msgErro, "msgSucesso" => $this->msgSucesso);
	}

	/**
	*	FUNCAO PARA MONTRA XML QUE SERA PASSA COMO PARAMETRO AO WEBSERVICE FECHAPLP DOS CORREIOS
	*	@return xml
	*/

	private function montaXMLPLP ($etiquetas)
	{
        $this->CI->load->model("M_Sigep");

		$xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		$xml .= "<correioslog>";
			$xml .= "<tipo_arquivo>Postagem</tipo_arquivo>";
			$xml .= "<versao_arquivo>2.3</versao_arquivo>";
			$xml .= "<plp>";
				$xml .= "<id_plp></id_plp>";
				$xml .= "<valor_global></valor_global>";
				$xml .= "<mcu_unidade_postagem></mcu_unidade_postagem>";
				$xml .= "<nome_unidade_postagem></nome_unidade_postagem>";
				$xml .= "<cartao_postagem>".$this->cod_cartao."</cartao_postagem>";
			$xml .= "</plp>";
			$xml .= "<remetente>";
				$xml .= "<numero_contrato>".$this->cod_contrato."</numero_contrato>";
				$xml .= "<numero_diretoria>36</numero_diretoria>";
				$xml .= "<codigo_administrativo>".$this->cod_adm."</codigo_administrativo>";
				$xml .= "<nome_remetente><![CDATA[CallFarma]]></nome_remetente>";
				$xml .= "<logradouro_remetente><![CDATA[Av Manoel Ribas]]></logradouro_remetente>";
				$xml .= "<numero_remetente>123</numero_remetente>";
				$xml .= "<complemento_remetente><![CDATA[Segundo andar]]></complemento_remetente>";
				$xml .= "<bairro_remetente><![CDATA[Mêrces]]></bairro_remetente>";
				$xml .= "<cep_remetente><![CDATA[80810000]]></cep_remetente>";
				$xml .= "<cidade_remetente><![CDATA[Curitiba]]></cidade_remetente>";
				$xml .= "<uf_remetente>PR</uf_remetente>";
				$xml .= "<telefone_remetente><![CDATA[4132464533]]></telefone_remetente>";
				$xml .= "<fax_remetente><![CDATA[]]></fax_remetente>";
				$xml .= "<email_remetente><![CDATA[callfarma@callfarma.com.br]]></email_remetente>";
			$xml .= "</remetente>";
			$xml .= "<forma_pagamento></forma_pagamento>";
            for ($i = 0; $i < count($etiquetas); $i++) {
                $xml .= "<objeto_postal>";
                    $objetoPostal = $this->CI->M_Sigep->getObjetoPostal($etiquetas[$i]);

                    if ( $objetoPostal != false ) {
                        $etiqueta = str_replace(" ", $objetoPostal[0]->digitocodigoobjetoect, $objetoPostal[0]->codigoobjetoect);

        				$xml .= "<numero_etiqueta>".$etiqueta."</numero_etiqueta>";
        				$xml .= "<codigo_objeto_cliente></codigo_objeto_cliente>";
        				$xml .= "<codigo_servico_postagem>".$objetoPostal[0]->idservicosect."</codigo_servico_postagem>";
        				$xml .= "<cubagem>0,00</cubagem>";
        				$xml .= "<peso>200</peso>";
        				$xml .= "<rt1></rt1>";
        				$xml .= "<rt2></rt2>";
        				$xml .= "<destinatario>";
        					$xml .= "<nome_destinatario><![CDATA[".$objetoPostal[1]->nome."]]></nome_destinatario>";
        					$xml .= "<telefone_destinatario><![CDATA[".$objetoPostal[1]->telefone."]]></telefone_destinatario>";
        					$xml .= "<celular_destinatario><![CDATA[".$objetoPostal[1]->celular."]]></celular_destinatario>";
        					$xml .= "<email_destinatario><![CDATA[".$objetoPostal[1]->email."]]></email_destinatario>";
        					$xml .= "<logradouro_destinatario><![CDATA[".$objetoPostal[1]->ruaent."]]></logradouro_destinatario>";
        					$xml .= "<complemento_destinatario><![CDATA[".$objetoPostal[1]->complementoent."]]></complemento_destinatario>";
        					$xml .= "<numero_end_destinatario>".$objetoPostal[1]->numeroent."</numero_end_destinatario>";
        				$xml .= "</destinatario>";
        				$xml .= "<nacional>";
        					$xml .= "<bairro_destinatario><![CDATA[".$objetoPostal[1]->bairroent."]]></bairro_destinatario>";
        					$xml .= "<cidade_destinatario><![CDATA[".$objetoPostal[1]->cidadeent."]]></cidade_destinatario>";
        					$xml .= "<uf_destinatario>".$objetoPostal[1]->estadoent."</uf_destinatario>";
        					$xml .= "<cep_destinatario><![CDATA[".$objetoPostal[1]->cepent."]]></cep_destinatario>";
        					$xml .= "<codigo_usuario_postal></codigo_usuario_postal>";
        					$xml .= "<centro_custo_cliente></centro_custo_cliente>";
        					$xml .= "<numero_nota_fiscal>123</numero_nota_fiscal>";
        					$xml .= "<serie_nota_fiscal></serie_nota_fiscal>";
        					$xml .= "<valor_nota_fiscal></valor_nota_fiscal>";
        					$xml .= "<natureza_nota_fiscal></natureza_nota_fiscal>";
        					$xml .= "<descricao_objeto><![CDATA[]]></descricao_objeto>";
        					$xml .= "<valor_a_cobrar>0,00</valor_a_cobrar>";
        				$xml .= "</nacional>";
        				$xml .= "<servico_adicional>";
        					$xml .= "<codigo_servico_adicional>025</codigo_servico_adicional>";
        				$xml .= "</servico_adicional>";
        				$xml .= "<dimensao_objeto>";
        					$xml .= "<tipo_objeto>002</tipo_objeto>";
        					$xml .= "<dimensao_altura>20</dimensao_altura>";
        					$xml .= "<dimensao_largura>30</dimensao_largura>";
        					$xml .= "<dimensao_comprimento>38</dimensao_comprimento>";
        					$xml .= "<dimensao_diametro>0</dimensao_diametro>";
        				$xml .= "</dimensao_objeto>";
        				$xml .= "<data_postagem_sara></data_postagem_sara>";
        				$xml .= "<status_processamento>0</status_processamento>";
        				$xml .= "<numero_comprovante_postagem></numero_comprovante_postagem>";
        				$xml .= "<valor_cobrado></valor_cobrado>";
                    }
                $xml .= "</objeto_postal>";
            }
		$xml .= "</correioslog>";

		return $xml;
	}

}
