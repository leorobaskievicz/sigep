<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		// VERIFICA SE NÃO EXISTE VARIÁVEL MENU GRAVA EM SESSÃO
		if ($this->session->userdata('menu') == null) {
			$menu = array( "menu1" => array(), "menu2" => array() );
			$this->load->model('menu');// CARREGA MODELO DE BUSCA MENU
			if ($busca = $this->menu->buscar('menu1'))
				while ($reg = $busca->fetch()) {
					array_push($menu['menu1'], $reg->descricao);// SALVA BUSCA EM VETOR ASSOCIATIVO PARA SALVAR EM SESSÃO DEPOIS
					
					if ($buscaMenu2 = $this->menu->buscar('menu2', $reg->id)) {
						while ($reg2 = $buscaMenu2->fetch()) 
							$menu['menu2'][$reg->id] = $reg2->descricao;
					}
				}

			$this->session->set_userdata($menu);// SALVA OS DADOS DA BUSCA EM SESSÃO
		}

		$this->load->view('estruturas/header');
		$this->load->view('home');
		$this->load->view('estruturas/footer');
	}
}
