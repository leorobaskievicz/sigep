<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//header('Content-type: text/plain; charset=UTF-8');

echo form_open ('Callfarma/index/1');

	echo form_input('cepDestino')."<br/>";
	echo '<select name="servico">';
		foreach ($servicos as $servico)
			echo ('<option value="'.$servico->codigoservicoect.'">'.$servico->descricaoservicoect.'</option>');
	echo '</select>';
	echo '<br/>';
	echo form_submit('enviado','Enviar');

echo form_close ();