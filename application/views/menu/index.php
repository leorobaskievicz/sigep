<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Content-type: text/plain; charset=UTF-8');
echo (PHP_EOL."==============================================================================================================".PHP_EOL);
echo ("============================          SISTEMA PARA INTEGRACAO COM SIGEP           ============================".PHP_EOL);
echo ("=== Abaixo listado as funções disponíveis neste sistema.                                                   ===".PHP_EOL);
echo ("=== 1) verificaDisponibilidadeServico - Verifica disponibilidade dos serviços dos Correios                 ===".PHP_EOL);
echo ("=== 2) buscaCliente - Busca dados da empresa (cliente) cadastrados nos Correios                            ===".PHP_EOL);
echo ("=== 3) buscaCEP - Pesquisa endereço pelo CEP                                                               ===".PHP_EOL);
echo ("=== 4) consultaCartaoPostagem - Consulta situação do cartão postagem da empresa nos Correios               ===".PHP_EOL);
echo ("=== 5) solicitaEtiquetas - Solicita números de etiquetas nos Correios                                      ===".PHP_EOL);
echo ("=== 6) solicitaDigitoEtiquetas - Solicita dígitos das etiquetas recuperadas na função antetior             ===".PHP_EOL);
echo ("=== 7) fechaPLP - Envia aos Correios lista de Pré-Postagem                                                 ===".PHP_EOL);
echo ("=== 8) solicitaXmlPlp - Recupera o XML enviado aos Correios na função acima                                ===".PHP_EOL);
echo ("=== 9) getEtiqueta - Retorna código de rastreamento para número do pedido e id do serviço passados         ===".PHP_EOL);
echo ("=== 10) fechaPostagem - Envia dados com todos os Códigos abertos para os Correios                          ===".PHP_EOL);
echo ("==============================================================================================================".PHP_EOL);