<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* ============================================================================================== */
/* ===== string.php é uma biblioteca criada para conter funções auxiliares nas aplicações    ==== */
/* ===== Autor: Leonardo Robaskievicz Data: 20-01-2016                                       ==== */
/* ===== 1 - validaVar (any $var) --> Função para sanitizar var passada como parametro       ==== */
/* =====     Retorno: any $var sanitizado, sem char especial e código HTML,JS e SQL          ==== */
/* ============================================================================================== */

/* validaVar é uma função criada para remover caraceters especiais de uma variável  */
/* @param void $var                                                                 */
/* @return void $var - sem char espciais                                            */

if (! function_exists('validaVar'))
{
	function validaVar ($var)
	{
		return (filter_var($var, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_HIGH));
	}
}

/* formataString é uma função criada para tornar um padrão na exibição de string como nome do produtop  */
/* @param string $var                                                                                   */
/* @return string $var - formatada                                                                      */

if (! function_exists('formataString'))
{
	function formataString ($var = null)
	{
		if ($var == null)
			return "";
		else {
			$newString = "";
			$dados = explode(" ", mb_convert_case($var,MB_CASE_LOWER,mb_detect_encoding($var)));
			
			for ($i = 0; $i <= (count($dados) - 1); $i++){
				switch($dados[$i]) {
					case "a":
					case "e":
					case "i":
					case "o":
					case "u":
					case "da":
					case "de":
					case "di":
					case "do":
					case "du":
					case "com":
						$newString = $newString.$dados[$i]." ";
						break;
					default:
						$newString = $newString.ucfirst($dados[$i])." ";
						break;
				}
			}
			
			return $newString;
		}
	}
}

/* formataStringToURL é uma função criada para transformar uma string em URL (sem caraceters especiais) */
/* @param string $var                                                                                   */
/* @return string $var - formatada                                                                      */

function formataStringToURL ($strIn) {
	return(strtolower(preg_replace("/[^a-zA-Z0-9_]/", "", strtr($strIn, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC"))));
}
