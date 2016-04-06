<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//header('Content-type: text/plain; charset=UTF-8');

echo form_open ('Callfarma/index/7');

	echo '<select name="etiqueta">';
		foreach ($etiquetas as $etiqueta)
			echo ('<option value="'.$etiqueta->codigoobjetoect.'">'.$etiqueta->codigoobjetoect.'</option>');
	echo '</select>';
	echo '<br/>';
	echo form_submit('enviado','Enviar');

echo form_close ();