<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Content-type: text/plain; charset=UTF-8');

if ($msgErro != null)
	echo ($msgErro);
else
	echo ($msgSucesso);