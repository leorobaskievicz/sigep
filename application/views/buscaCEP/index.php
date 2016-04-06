<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//header('Content-type: text/plain; charset=UTF-8');

echo form_open ('Callfarma/index/3');

	echo form_input('cep')."<br/>";
	echo '<br/>';
	echo form_submit('enviado','Enviar');

echo form_close ();