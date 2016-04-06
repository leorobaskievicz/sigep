<?php
/**
*	CLASSE CRIADO PARA ADMINISTRAR TODO O CADASTRO DE TABELAS DO SISTEMA SIGEP DOS CORREIOS
*
*	@author LEONARDO ROBASKIEVICZ - 23/03/2016
*	LEONARDO@TECWORKS.COM.BR
*
*/
class M_Sigep extends CI_Model
{

	/** 
	*	FUNÇÃO PARA SETAR TODOS OS DADOS DA CONEXÃO PASSADAS POR PARAMETRO
	*	NO MOMENTO DA CRIAÇÃO DO OBJETO
	*
	*	@param void 
	*	@return void
	*/
	public function __construct() 
	{
		parent::__construct();
	}

	/**
	*	FUNÇÃO PARA BUSCAR O ID DA PLP DO CLIENTE
	*	@param void
	*	@return int id_plp ou false
	*/

	public function getIdPlpCliente ()
	{
		$this->load->database();// Cria conexao de banco de dados
		$busca = $this->db->simple_query("SELECT idPlpCliente FROM tb_cliente WHERE idCliente = 1");
		if (( !$busca ) || ( $busca->rowCount() <= 0 ))
			return false;
		else
			return $busca->fetch();
	}

	/**
	*	FUNÇÃO PARA BUSCAR OS DADOS NECESSARIOS PARA OBJETO POSTAL DO XML DA PLP
	*	@param string codigo_etiqueta
	*	@return pdo object com dados ou false em caso de falha
	*/

	public function getObjetoPostal ( $etiqueta = null )
	{
		if ( $etiqueta == null )
			return false;

		$this->load->database();// Cria conexao de banco de dados

		$busca = $this->db->simple_query("SELECT * FROM tb_pedido_servico WHERE codigoObjetoECT = '".$etiqueta."'");
		if (( !$busca ) || ( $busca->rowCount() <= 0 ))
			return false;
		else {
			$dados1 = $busca->fetch();
			
			$db = $this->load->database("televendas", true);
			$busca = $db->simple_query("SELECT a.* FROM admcad1 a, admped1 b WHERE b.cliente = a.codigo and b.pedido = '".$dados1->idpedido."'");
			if (( !$busca ) || ( $busca->rowCount() <= 0 ))
				return false;
			else {
				$dados2 = $busca->fetch();
				return array($dados1, $dados2);
			}
		}
	}

	/**
	*	FUNÇÃO PARA BUSCAR OS DADOS DO CLIENTE NO BANCO DADOS
	*	@param array() cliente - Vetor com os dados do cliente para inclusão no banco de dados
	*	@return bool - true em caso de sucesso ou false em caso de falha
	*/

	public function buscar ($query)
	{
		$this->load->database();// Cria conexao de banco de dados
		$busca = $this->db->simple_query($query);
		return $busca;
	}

	/**
	*	FUNÇÃO PARA SABER SE PEDIDO DE ETIQUETA PARA O PEDIDO JA FOI FEITO
	*	@param int id_pedido
	*	@return CSV dados da etiqueta ou false caso de falha
	*/

	public function buscaEtiquetaPedido ( $nrpedido = 0 )
	{
		if ( $nrpedido == 0 )
			return false;

		$this->load->database();// Cria conexao de banco de dados
		$busca = $this->db->simple_query("SELECT * FROM tb_pedido WHERE idPedido = '".$nrpedido."' LIMIT 0,1");
		if (( !$busca ) || ($busca->rowCount() <= 0))
			return false;
		
		$busca = $this->db->simple_query("SELECT * FROM tb_pedido_servico WHERE idPedido = '".$nrpedido."' LIMIT 0,1");
		if (( !$busca ) || ($busca->rowCount() <= 0))
			return false;

		$dados = $busca->fetch();

		return array($dados->codigoobjetoect, $dados->digitocodigoobjetoect);
	}

	/**
	*	FUNÇÃO PARA SALVAR OS DADOS NO BANCO DE DADOS
	*	@param string nome da tabela, array(nome coluna => valor)
	*	@return bool - true em caso de sucesso ou false em caso de falha
	*/

	public function insere ($table, $dados)
	{
		$this->load->database();// Cria conexao de banco de dados
		
		$query = $this->db->insert_string($table, $dados);
		
		$insere = $this->db->simple_query($query);
		
		if ($insere)
			return true;
		else
			return false;
	}

	/*
		FUNÇÃO PARA EDITAR OS DADOS DO CLIENTE NO BANCO DADOS
		@param array() cliente - Vetor com os dados do cliente para inclusão no banco de dados
		@return bool - true em caso de sucesso ou false em caso de falha
	*/

	public function editar ($table, $dados, $where)
	{
		$this->load->database();// Cria conexao de banco de dados

		$query = $this->db->update_string($table, $dados, $where);
		
		$insere = $this->db->simple_query($query);
		if ($insere)
			return true;
		else
			return false;
	}

	/**
	*	FUNÇÃO PARA INCREMENTAR O NUMERO DO ID DO PLP DO CLIENTE
	*	@param void
	*	@return bool - true em caso de sucesso ou false em caso de falha
	*/

	public function corrigeIdPlpCliente ()
	{
		$this->load->database();// Cria conexao de banco de dados

		$query = $this->db->update_string("tb_cliente", array("idPlpCliente" => "idPlpCliente + 1"), "idCliente = 1");
		
		$insere = $this->db->simple_query($query);
		if ($insere)
			return true;
		else
			return false;
	}

	/**
	*	FUNÇÃO PARA CORRIGIR FLAG DE ENVIADOS NO TABELA DE PEDIDOS
	*	@param array string codigos de rastreamento
	*	@return bool - true em caso de sucesso ou false em caso de falha
	*/

	public function corrigeFlagPedidos ( $etiquetas = null)
	{
		$falha = false;
		if ( $etiquetas == null )
			return false;

		$this->load->database();// Cria conexao de banco de dados

		for ($i = 0; $i < count($etiquetas); $i++) {
			$aletra = $this->db->simple_query("UPDATE tb_pedido a, tb_pedido_servico b SET a.fgenviado = 'S' WHERE a.idPedido = b.idPedido and b.codigoObjetoECT = '".$etiquetas[$i]."'");
			if ( !$aletra )
				$falha = true;
		}
		return $falha;		
	}

	/**
	*	FUNCAO PARA LIMPAR A TABELA COM TRUNCATE TABLE
	*	@param string nome da tabela
	*	@return bool - true em caso de sucesso ou false em caso de falha
	*/

	public function limpaTabela ($nomeTabela = null)
	{
		if ($nomeTabela == null)
			return false;

		$this->load->database();// Cria conexao de banco de dados

		$limpa = $this->db->simple_query("TRUNCATE TABLE ".$nomeTabela);

		if ($limpa)
			return true;
		else
			return false;
	}
}