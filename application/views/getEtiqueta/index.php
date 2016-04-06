<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//header('Content-type: text/plain; charset=UTF-8');

echo form_open ('Callfarma/index/getEtiqueta/'.$nrpedido);

	echo form_input("nrpedido", $nrpedido);
	echo '<select name="servico">';
		foreach ($servicos as $servico)
			echo ('<option value="'.$servico->idservico.'">'.$servico->descricaoservicoect.'</option>');
	echo '</select>';
	echo '<br/>';
	echo form_submit('enviado','Enviar');

echo form_close ();