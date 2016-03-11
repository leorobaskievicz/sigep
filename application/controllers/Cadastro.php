<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller 
{

	public function index()
	{

		if (($this->session->userdata("codigo") != null) && ($this->session->userdata("nome") != null))
			$this->editar();
		else
			$this->novo();
	}

	/*
		Metodo usado para incluir novo cadastro de cliente
	*/

	public function novo()
	{
		$this->load->view('estruturas/header');
		$dados = array("email" => $this->input->post('email'), "nome" => $this->input->post('nome'));
		$this->load->view('cadastro/novo', $dados);
		$this->load->view('estruturas/footer');
	}

	/*
		Metodo usado para incluir novo cadastro de cliente
	*/

	public function editar()
	{
		// Carrega todos os arquivos necessários
		$this->load->model("clientes");

		// Tenta buscar dados do cliente no banco de dados para verificar se já não existe cadastro
		$buscaCliente = $this->clientes->buscar("SELECT * FROM admcad1 WHERE codigo = '".$this->session->userdata("codigo")."' LIMIT 0,1");
		if (($buscaCliente) && ($buscaCliente->rowCount() > 0))
			$dados = array("dados" => $buscaCliente->fetch());
		else
			$dados = array("dados" => null);

		$this->load->view('estruturas/header');
		$this->load->view('cadastro/editar', $dados);
		$this->load->view('estruturas/footer');
	}

	/*
		Metodo usado para trocar senha do usuário salvo no banco de dados
	*/

	public function trocarsenha()
	{
		if ($this->input->post('senhanova') == null) {
			$this->load->view('estruturas/header');
			$this->load->view('cadastro/trocarsenha');
			$this->load->view('estruturas/footer');
		} else {
			// ATUALIZA A SENHA DO USUÁRIO NO BANCO DE DADOS
			$senha = $this->input->post('senha');
			$senhanova = password_hash($this->input->post('senhanova'), PASSWORD_DEFAULT);

			$this->load->model('clientes');
			$buscaCliente = $this->clientes->buscar("SELECT senha FROM admcad1 WHERE codigo = '".$this->session->userdata('codigo')."'");
			if (($buscaCliente) && ($buscaCliente->rowCount() > 0)) {
				$senhaBd = $buscaCliente->fetch();
				echo ("1");
				if (password_verify($senha, $senhaBd->senha)) {
					$param = array("senha" => $senhanova);
					$altera = $this->clientes->editar($param, "codigo = ". $this->session->userdata('codigo') ." ");
					$retorno = array("alterado" => $altera);
				} else
					$retorno = array("alterado" => false);
			} else
				$retorno = array("alterado" => false);
			$this->load->view('estruturas/header');
			$this->load->view('cadastro/trocarsenha', $retorno);
			$this->load->view('estruturas/footer');
		}
	}

	/*
		Método para salvar dados do usuário no banco de dados. Informações vindas do formulário
	*/

	public function salvar ()
	{
		// Carrega todos os arquivos necessários
		$this->load->model("clientes");

		// Recebe todas as variáveis vindas do formulário de cadastro
		$nome        = $this->input->post('nome')." ".$this->input->post('sobrenome');
		$cpf         = $this->input->post('cpf');
		$sexo        = $this->input->post('sexo');
		$nascimento  = $this->input->post('nascimento');
		$tel         = $this->input->post('tel');
		$cel         = $this->input->post('cel');
		$email       = $this->input->post('email');
		$senha       = password_hash($this->input->post('senha'), PASSWORD_DEFAULT);
		$cep         = $this->input->post('cep');
		$rua         = $this->input->post('rua');
		$numero      = $this->input->post('numero');
		$bairro      = $this->input->post('bairro');
		$cidade      = $this->input->post('cidade');
		$estado      = $this->input->post('estado');
		$complemento  = $this->input->post('complemento');
		$cepent      = $this->input->post('cepent');
		$ruaent      = $this->input->post('ruaent');
		$numeroent   = $this->input->post('numeroent');
		$bairroent   = $this->input->post('bairroent');
		$cidadeent   = $this->input->post('cidadeent');
		$estadoent   = $this->input->post('estadoent');
		$complementoent  = $this->input->post('complementoent');

		$param = array("nome" => $nome,"cpf" => $cpf,"sexo" => $sexo,"nascimento" => $nascimento,"telefone" => $tel,"celular" => $cel,"email" => $email,"senha" => $senha,"cep" => $cep,"rua" => $rua,"numero" => $numero,"bairro" => $bairro,"cidade" => $cidade,"estado" => $estado,"complemento" => $complemento,"cepent" => $cepent,"ruaent" => $ruaent,"numeroent" => $numeroent,"bairroent" => $bairroent,"cidadeent" => $cidadeent,"estadoent" => $estadoent,"complementoent" => $complementoent,"cadastro" => date("d/m/Y"));

		// Tenta buscar dados do cliente no banco de dados para verificar se já não existe cadastro
		$buscaCliente = $this->clientes->buscar("SELECT codigo FROM admcad1 WHERE nome LIKE '".$nome."' OR cpf LIKE '".$cpf."' OR email LIKE '".$email."'");
		if (($buscaCliente) && ($buscaCliente->rowCount() > 0)) {
			// Cria vetor de retorno dos dados
			$retorno = array("status" => false, "msg" => "Cliente já cadastro em nosso site.");
			$retornoFinal = array_merge($retorno, $param);// Unifica os dois vetores

			$this->load->view('estruturas/header');
			$this->load->view('cadastro/salvo', $retornoFinal);
			$this->load->view('estruturas/footer');
		} else {
			// Cliente não econtrado no banco, portanto pode salvar registro
			if ($salva = $this->clientes->salvar($param)) {
				$retorno = array("status" => true, "msg" => "Cliente cadastrado com sucesso.");
				$retornoFinal = array_merge($retorno, $param);// Unifica os dois vetores

				$this->load->view('estruturas/header');
				$this->load->view('cadastro/salvo', $retornoFinal);
				$this->load->view('estruturas/footer');
			}else {
				$retorno = array("status" => false, "msg" => "Ops, ocorreu um problema ao salvar os dados. Por favor, tente novamente.");
				$retornoFinal = array_merge($retorno, $param);// Unifica os dois vetores
				
				$this->load->view('estruturas/header');
				$this->load->view('cadastro/salvo', $retornoFinal);
				$this->load->view('estruturas/footer');
			}
		}
	}

	/*
		Método para editar dados do usuário no banco de dados. Informações vindas do formulário
	*/

	public function atualizar ()
	{
		// Carrega todos os arquivos necessários
		$this->load->model("clientes");

		// Recebe todas as variáveis vindas do formulário de cadastro
		$nome        = $this->input->post('nome')." ".$this->input->post('sobrenome');
		$cpf         = $this->input->post('cpf');
		$sexo        = $this->input->post('sexo');
		$nascimento  = $this->input->post('nascimento');
		$tel         = $this->input->post('tel');
		$cel         = $this->input->post('cel');
		$email       = $this->input->post('email');
		$senha       = password_hash($this->input->post('senha'), PASSWORD_DEFAULT);
		$cep         = $this->input->post('cep');
		$rua         = $this->input->post('rua');
		$numero      = $this->input->post('numero');
		$bairro      = $this->input->post('bairro');
		$cidade      = $this->input->post('cidade');
		$estado      = $this->input->post('estado');
		$complemento  = $this->input->post('complemento');
		$cepent      = $this->input->post('cepent');
		$ruaent      = $this->input->post('ruaent');
		$numeroent   = $this->input->post('numeroent');
		$bairroent   = $this->input->post('bairroent');
		$cidadeent   = $this->input->post('cidadeent');
		$estadoent   = $this->input->post('estadoent');
		$complementoent  = $this->input->post('complementoent');

		$param = array("nome" => $nome,"cpf" => $cpf,"sexo" => $sexo,"nascimento" => $nascimento,"telefone" => $tel,"celular" => $cel,"email" => $email,"senha" => $senha,"cep" => $cep,"rua" => $rua,"numero" => $numero,"bairro" => $bairro,"cidade" => $cidade,"estado" => $estado,"complemento" => $complemento,"cepent" => $cepent,"ruaent" => $ruaent,"numeroent" => $numeroent,"bairroent" => $bairroent,"cidadeent" => $cidadeent,"estadoent" => $estadoent,"complementoent" => $complementoent,"cadastro" => date("d/m/Y"));

		$this->load->model('clientes');
		$altera = $this->clientes->editar($param, "codigo = ".$this->session->userdata('codigo')." ");
		$retorno = array("alterado" => $altera);
		
		$this->load->view('estruturas/header');
		$this->load->view('cadastro/editar', $retorno);
		$this->load->view('estruturas/footer');
		
	}
}
