<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Callfarma extends CI_Controller 
{

    public function index ( $cmd = null, $nrpedido = 0 )
    {
        switch ($cmd) {
            /*
                Verifica disponibilidades de Serviços
            */
            case 1:
                if ($this->input->post('cepDestino') != null) {

                    $cepDestino = $this->input->post('cepDestino');
                    $servico = $this->input->post('servico');
                    $sigep = $this->sigep->verificaDisponibilidadeServico($cepDestino, $servico);
                    if ( empty($sigep['msgErro']) )
                        echo $sigep['msgSucesso'];
                    else
                        echo $sigep['msgErro'];

                } else {

                    $this->load->model('M_Sigep');
                    if (($busca = $this->M_Sigep->buscar("SELECT descricaoServicoECT,codigoServicoECT FROM tb_servicos_ect ORDER BY idServico")) != false) {
                        $dados = $busca->fetchAll();
                        $param = array("servicos" => $dados);
                    }
                    $this->load->view("verificaDisponibilidadeServico/index", $param);

                }
                break;
            /*
                Busca dados do cliente no banco dos Correios
            */
            case 2:
                $sigep = $this->sigep->buscaCliente();
                if ( empty($sigep['msgErro']) )
                    echo $sigep['msgSucesso'];
                else
                    echo $sigep['msgErro'];
                break;

            /*
                FUNCAO PARA BUSCAR CEP
            */
            case 3:
                if ($this->input->post('cep') != null) {
                    $cep = $this->input->post('cep');
                    $sigep = $this->sigep->buscaCEP($cep);
                    if ( empty($sigep['msgErro']) )
                        echo $sigep['msgSucesso'];
                    else
                        echo $sigep['msgErro'];
                } else {
                    $this->load->view("buscaCEP/index");
                }
                break;

            /*
                FUNCAO PARA CONSULTAR STATUS DO CARTAO DE POSTAGEM
            */
            case 4:
                $sigep = $this->sigep->consultaCartaoPostagem();
                if ( empty($sigep['msgErro']) )
                    echo $sigep['msgSucesso'];
                else
                    echo $sigep['msgErro'];
                break;

            /*
                FUNCAO PARA SOLICITAR NUMERO DE ETIQUETAS
            */
            case 5:
                if ($this->input->post('nretiquetas') != null) {
                    $idservico = $this->input->post('idservico');
                    $nretiquetas = $this->input->post('nretiquetas');

                    $sigep = $this->sigep->solicitaEtiquetas($idservico, $nretiquetas);
                    if ( empty($sigep['msgErro']) ) 
                        echo $sigep['msgSucesso'];
                    else
                        echo $sigep['msgErro'];
                } else {
                    $this->load->model('M_Sigep');
                    if (($busca = $this->M_Sigep->buscar("SELECT * FROM tb_servicos_ect ORDER BY idServico")) != false) {
                        $dados = $busca->fetchAll();
                        $param = array("servicos" => $dados);
                    }
                    $this->load->view("solicitaEtiquetas/index", $param);
                }
                break;

            /*
                FUNCAO PARA SOLICITAR DIGITO VERIFICADOR DE ETIQUETA
            */
            case 6:
                if ($this->input->post('etiqueta') != null) {
                    $etiqueta = $this->input->post('etiqueta');

                    $sigep = $this->sigep->solicitaDigitoEtiquetas($etiqueta);
                    if ( empty($sigep['msgErro']) ) 
                        echo $sigep['msgSucesso'];
                    else
                        echo $sigep['msgErro'];
                } else {
                    $this->load->model('M_Sigep');
                    if (($busca = $this->M_Sigep->buscar("SELECT * FROM tb_pedido_servico ORDER BY idPedido")) != false) {
                        $dados = $busca->fetchAll();
                        $param = array("etiquetas" => $dados);
                    }
                    $this->load->view("solicitaDigitoEtiquetas/index", $param);
                }
                break;

            /*
                FUNCAO PARA ENVIAR DADOS DA ETIQUE PARA PLP
            */
            case 7:
                if ($this->input->post('etiqueta') != null) {
                    $etiqueta = $this->input->post('etiqueta');

                    $this->load->model("M_Sigep");
                    $busca = $this->M_Sigep->buscar("SELECT digitoCodigoObjetoECT FROM tb_pedido_servico WHERE codigoObjetoECT LIKE '".$etiqueta."' LIMIT 0,1");
                    $dado = $busca->fetch();

                    $sigep = $this->sigep->fechaPLP($etiqueta, $dado->digitocodigoobjetoect);
                    if ( empty($sigep['msgErro']) ) 
                        echo $sigep['msgSucesso'];
                    else
                        echo $sigep['msgErro'];
                } else {
                    $this->load->model('M_Sigep');
                    if (($busca = $this->M_Sigep->buscar("SELECT * FROM tb_pedido_servico ORDER BY idPedido")) != false) {
                        $dados = $busca->fetchAll();
                        $param = array("etiquetas" => $dados);
                    }
                    $this->load->view("fechaPLP/index", $param);
                }
                break;

            /*
                FUNCAO PARA SOLICITAR XML DE PLP ENVIADA ANTERIORMENTE
            */
            case 8:
                if ($this->input->post('idPlp') != null) {
                    $idPlp = $this->input->post('idPlp');

                    $sigep = $this->sigep->solicitaXmlPlp($idPlp);
                    if ( empty($sigep['msgErro']) ) 
                        echo $sigep['msgSucesso'];
                    else
                        echo $sigep['msgErro'];
                } else {
                    $this->load->view("solicitaXmlPlp/index");
                }
                break;

            /*
                Caso não específicado nenhum parâmetro, exibe menu na tela
            */
            default:
                $this->imprimeMenu();
                break;
        }
        return 0;
    }

    /**
    *    IMPLEMENTA COMANDO GETETIQUE ONDE SERA PASSADO O NUMERO DO PEDIDO E O SERVICO DESEJADO
    *    ENTAO O SISTEAM DEVERA RETORNAR O CODIGO DE RESTREAMENTO DO OBJETO
    *   @param id servico, int nr pedido
    *   @return CSV (codigo etiqueta ; cep destino)
    */
    
    public function  getEtiqueta ($nrpedido = 0, $servico = null)
    {
        if (( $nrpedido == 0 ) || ( $servico == null ))
            die ("Número do pedido não específicado. Ex.: Callfarma/index/getEtiqueta/NR_PEDIDO");

        // Busca dados do pedido no banco de dados
        $this->load->model("M_Pedidos");
        $pedido = $this->M_Pedidos->getByCod($nrpedido);
        if ($pedido == false)
            die ("Pedido não encontrado na base de dados do Televendas.");

        // Verifica se não existe etiqueta já solicitado para o pedido informado
        $this->load->model('M_Sigep');
        $buscaEtiquetaJaCadastrada = $this->M_Sigep->buscaEtiquetaPedido( $nrpedido );
        if ( $buscaEtiquetaJaCadastrada != false) {
            $codRestreamento = str_replace(" ", $buscaEtiquetaJaCadastrada[1], $buscaEtiquetaJaCadastrada[0]);
            die ($codRestreamento.";".$pedido->cepent);   
        }

        // Verifica disponibilidade do serviço para o ID de Serviço e CEP de destino
        $sigep = $this->sigep->verificaDisponibilidadeServico( $pedido->cepent, $servico);
        if ( !empty($sigep['msgErro']) )
            die ("Método verificaDisponibilidadeServico: ".$sigep['msgErro']);

        // Verifica disponibilidade do Cartão de Postagem do Cliente
        $sigep = $this->sigep->consultaCartaoPostagem();
        if ( !empty($sigep['msgErro']) )
            die ("Método consultaCartaoPostagem: ".$sigep['msgErro']);

        // Solicita etiqueta para o pedido e servico informado
        $sigep = $this->sigep->solicitaEtiquetas($servico, 1);
        if ( !empty($sigep['msgErro']) ) 
            die ("Método solicitaEtiquetas: ".$sigep['msgErro']);

        $codRestreamento = $sigep['msgSucesso'];

        // Solicita dígito do codigo de rastreamento
        $sigep = $this->sigep->solicitaDigitoEtiquetas($codRestreamento);
        if ( !empty($sigep['msgErro']) )
            die ("Método solicitaDigitoEtiquetas: ".$sigep['msgErro']);

        $digitoEtiqueta = $sigep['msgSucesso'];

        // Altera tabela tb_pedido_servico para informa o numero do pedido
        $param = array("idPedido" => $nrpedido);
        $this->M_Sigep->editar("tb_pedido_servico", $param, "codigoObjetoECT LIKE '".$codRestreamento."'");

        // Insere dados na tabela tb_pedido
        $param = array("idPedido" => $nrpedido, "notaFiscal" => 0);
        $this->M_Sigep->insere("tb_pedido", $param);

        // Mostra infomação de retorno em formato CSV
        // codigo_da_etiqueta;numero_do_pedido
        echo (str_replace(" ", $digitoEtiqueta, $codRestreamento).";".$pedido->cepent);
    }

    /**
    *   FECHA PLP COM AS ETIQUETAS COLETADAS
    *   @param void
    *   @return bool 
    */

    public function fechaPostagem ()
    {
        // Busca numero da PLP nos parametros
        $this->load->model("M_Sigep");
        $cliente = $this->M_Sigep->getIdPlpCliente();
        if ( $cliente == false )
            die ("Falha ao recuperar ID PLP Cliente.");

        // Busca todas as etiquetas que não foram enviadas ainda aos Correios
        $etiquetas = $this->M_Sigep->buscar("SELECT a.*,b.* FROM tb_pedido a, tb_pedido_servico b WHERE a.fgenviado = 'N' AND a.idPedido = b.idPedido");
        if ( !$etiquetas )
            die ("Falha ao recuperar as etiquetas que não foram enviadas.");

        $codigos = array();
        for ($i = 0; $reg = $etiquetas->fetch(); $i++)
            $codigos[$i] = $reg->codigoobjetoect;

        $sigep = $this->sigep->fechaPLP( $codigos, $cliente->idplpcliente);
        if ( !empty($sigep['msgErro']) )
            die ("Erro no método fechaPostagem: ".$sigep["msgErro"]);
        else {
            // Corrige todos os pedidos marcando que ja foram enviados
            $this->M_Sigep->corrigeFlagPedidos($codigos);
            // Incrementa o numero do ID PLP Cliente
            $this->M_Sigep->corrigeIdPlpCliente();
        } 
    }


    /**
    *   FUNCAO USADA PARA IMPRIMIR MENU NA TELA DO USUARIOS
    *   @param void
    *   @return void
    */

    private function imprimeMenu ()
    {
        $this->load->view("menu/index");
        return 0;
    }
}
