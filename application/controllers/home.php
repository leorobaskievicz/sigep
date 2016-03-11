<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index($limitInf = 0)
	{
		// VERIFICA SE NÃO EXISTE VARIÁVEL MENU GRAVA EM SESSÃO
		if ($this->session->userdata('menu') == null) {
			$menu = array( "menu1" => array(), "menu2" => array() );
			$this->load->model('menu');// CARREGA MODELO DE BUSCA MENU
			if ($busca = $this->menu->buscar('menu1'))
				$i = 0;
				while ($reg = $busca->fetch()) {
					array_push($menu['menu1'], $reg->descricao);// SALVA BUSCA EM VETOR ASSOCIATIVO PARA SALVAR EM SESSÃO DEPOIS
					
					if ($buscaMenu2 = $this->menu->buscar('menu2', $reg->id)) {
						$menu['menu2'][$i] = array();
						while ($reg2 = $buscaMenu2->fetch()) 
							array_push($menu['menu2'][$i], $reg2->descricao);
					}

					$i++;
				}

			$this->session->set_userdata($menu);// SALVA OS DADOS DA BUSCA EM SESSÃO
		}

		// Carrega modelo de busca de produtos no banco de dados
		$this->load->model("m_produtos");
		$dados = array("produtos" => null, "limitInf" => $limitInf);
		if ($produtos = $this->m_produtos->buscar("SELECT CODIGO,NOME,PVENDA,PREPRO,FOTO FROM admprodu LIMIT ".$limitInf))
			if ($produtos->rowCount() > 0)
				$dados = array("produtos" => $produtos, "limitInf" => $limitInf);

		$this->load->view('estruturas/header');
		$this->load->view('home', $dados);
		$this->load->view('estruturas/footer');
	}
}
