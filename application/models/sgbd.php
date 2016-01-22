<?php
/*
	CLASSE CRIADO PARA INTEGRAR AS FUNÇÕES DE ACESSO AO BANCO DE DADOS
	UTILIZANDO A CLASSE PDO DO PHP. TODO INSTANCIAÇÃO DESSA CLASSE JÁ
	É FEITO A CONEXÃO COM O BANCO DE DADOS. AO CONCLUIR A EXECUÇÃO DO
	SCRIPT PHP O MÉTODO DESTRUCT É INVOCADO FECHANDO TODAS AS CONEXÕES.
	1 - CRIACONEXÃO : FUNÇÃO PARA CRIAR CONEXÃO COM BD
	2 - BUSCA : FUNÇÃO PARA BUSCAR DADOS VIA SQL QUERY
	3 - INSERE: FUNÇÃO PARA INSERIR DADOS VIA SLQ QUERY
	4 - ALTERA: FUNÇÃO PARA ALTERAR DADOS VIA SQL QUERY
	5 - APAGA : FUNÇÃO PARA APAGAR DADOS VIA SQL QUERY

	@authorLEONARDO ROBASKIEVICZ - 05/12/2015
	LEONARDO@TECWORKS.COM.BR

*/
class SGBD extends CI_Model
{
	private $host  = "";
	private $user  = "";
	private $pass  = "";
	private $banco = "";
	private $link = NULL;
	/* 
		FUNÇÃO PARA SETAR TODOS OS DADOS DA CONEXÃO PASSADAS POR PARAMETRO
		NO MOMENTO DA CRIAÇÃO DO OBJETO

		@param void 
		@return void
	*/
	public function __construct() 
	{
		parent::__construct();
	}
	/*
		FUNÇÃO PARA DESTRUIR TODOS OS DADOS DA CONEÇÃO QUANDO O SCRIPT
		TERMINAR DE SER EXECUTADO

		@param void 
		@return void
	*/
	public function __destruct () 
	{
		$this->host  = "";
		$this->user  = "";
		$this->pass  = "";
		$this->banco = "";
		$this->link  = NULL;
	}
	/* 
		FUNÇÃO PARA CRIAR CONEXÃO COM O BANCO DE DADOS 

		@param { string host, string user, string senha, string banco }
		@return true -> deu certo ou false -> não foi possível conectar
	*/
	public function criaConexao ($host, $user, $senha, $banco) 
	{
		// Atribui as variaveis 
		$this->host  = $host;
		$this->user  = $user;
		$this->pass  = $senha;
		$this->banco = $banco;
		try {
			$this->load->database($this->banco);
			//$this->link = new PDO('mysql:host='.$this->host.';dbname='.$this->banco.';charset=utf8', $this->user, $this->pass);
		    //$this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    //$this->link->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
		    return True;
		} catch (PDOException $e) {
			$this->errorLog ("Erro de conexão com o servidor. PDO Error: {$e->getMessage()}\n");
			return False;
		}
	}
	/*
		Função para criar uma conex~~ao persistente com o banco de dados 

		@param { string host, string user, string senha, string banco }
		@return true -> deu certo ou false -> não foi possível conectar
	*/
	public function criaConexaoPersistente ($host, $user, $senha, $banco)
	{
		try {
			$this->load->database($banco);
			/*$this->link = new PDO('mysql:host='.$this->host.';dbname='.$this->banco.';charset=utf8', $this->user, $this->pass, array(PDO::ATTR_PERSISTENT => true));
		    $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $this->link->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
		    $this->link->setAttribute(PDO::ATTR_TIMEOUT,300);*/
		    return True;
		} catch (PDOException $e) {
			return False;
		}
	}
	/* 
		FUNÇÃO PARA FAZER BUSCAS NO BANCO DE DADOS DE ACORDO COM O SQL PASSADO NO PARAMETRO 

		@param string query -> query SQL para realizar o SELECT
		@return false -> se deu errado ou object -> com resultador do banco de dados
	*/
	public function busca ($sql) 
	{
		try {
			$busca = $this->db->simple_query($sql);
			//$retorno = $busca->setFetchMode(PDO::FETCH_OBJ);
			return ($busca);
		} catch (PDOException $e) {
			$this->errorLog ("Erro ao buscar dados no banco de dados. PDO Error: {$e->getMessage()}\n");
			return FALSE;
		}
	}
	/* 
		FUNÇÃO PARA INCLUIR DADOS NO BANCO DE DADOS VIA SQL 

		@param {string tabela, array $dados}
		@return bool
	*/
	public function insere ($tabela, $dados) 
	{
		try {
			$query = $this->db->insert_string($tabela, $dados);// Trata string SQL passado como parametro
			$insere = $this->db->simple_query($query);
			return true;
		} catch (PDOException $e) {
			$this->errorLog ("Erro ao inserir dados no banco de dados. PDO Error: {$e->getMessage()}\n");
			return false;
		}
	}
	/* 
		FUNÇÃO PARA ALTERAR OS DADOS DE UMA TABELA NO BANCO DE DADOS VIA SQL 
		
		@param string $sql
		@return bool
	*/
	public function altera ($sql) 
	{
		try {
			$altera = $this->db->simple_query($sql);
			return ($altera);
		} catch (PDOException $e) {
			$this->errorLog ("Erro ao alterar dados no banco de dados. PDO Error: {$e->getMessage()}\n");
			return false;
		}
	}
	/* 
		FUNÇÃO PARA APAGAR OS DADOS DE UMA TABELA DO BANCO VIA SQL QUERY 

		@param string $sql
		@return bool
	*/
	public function apaga ($sql) 
	{
		try {
			$apaga = $this->db->simple_query($sql);
			return ($apaga);
		} catch (PDOException $e) {
			$this->errorLog ("Erro ao apagar dados no banco de dados. PDO Error: {$e->getMessage()}\n");
			return FALSE;
		}
	}
	/* 
		FUNCAO PARA LIMPAR TODA A TABELA DO BANCO DE DADOS 
		
		@param string $tabela
		@return bool
	*/
	public function limpaTabela ($tabela) 
	{
		try {
			$limpaTabela = $this->db->simple_query("TRUNCATE TABLE ".$tabela."");
			return ($limpaTabela);
		} catch (PDOException $e) {
			$this->errorLog ("Erro ao limpar tabela do banco de dados. PDO Error: {$e->getMessage()}\n");
			return FALSE;
		}
	}
	/* 
		FUNCAO PARA BUSCA DADOS BLOB NO BANCO DE DADOS COMO IMAGENS E BULA 

	function buscaBlob ($sql) {
		try {
			$busca = $this->link->prepare($sql);
			$busca->execute();
			$busca->bindColumn(1, $lob, PDO::PARAM_LOB);
			$busca->fetch(PDO::FETCH_BOUND);
			return($lob);
		} catch (PDOException $e) {
			$this->errorLog ("Erro ao buscar dados no banco de dados. PDO Error: {$e->getMessage()}\n");
			return FALSE;
		}
	}*/
	/* 
		Funcao que e executada quando algum comando SQL falhar, entao e salvo um arquivo chamado errorLog.txt 
	*/
	private function errorLog ($erro) {
		$arq = fopen(base_url()."errorlog/errorLog.txt","a+");
		if ($arq != FALSE) {
			fwrite($arq, "\n======================================\n");
			fwrite($arq, "Data: ".date("d/m/Y as h:i:s")."\n");
			fwrite($arq, $erro);
			fclose($arq);
		}
	}
}