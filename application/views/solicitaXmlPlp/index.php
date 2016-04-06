<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//header('Content-type: text/plain; charset=UTF-8');

echo form_open ('Callfarma/index/8');

	echo form_input('idPlp');
	echo '<br/>';
	echo form_submit('enviado','Enviar');

echo form_close ();