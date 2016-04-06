<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//header('Content-type: text/plain; charset=UTF-8');

echo form_open ('Callfarma/index/5');

	echo form_input('nretiquetas')."<br/>";
	echo '<select name="idservico">';
		foreach ($servicos as $servico)
			echo ('<option value="'.$servico->idservico.'">'.$servico->descricaoservicoect.'</option>');
	echo '</select>';
	echo '<br/>';
	echo form_submit('enviado','Enviar');

echo form_close ();