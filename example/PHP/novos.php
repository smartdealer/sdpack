<?php

/*

  #########################################
  #     _____                      _      #
  #    / ____|                    | |     #
  #   | (___  _ __ ___   __ _ _ __| |_    #
  #    \___ \| '_ ` _ \ / _` | '__| __|   #
  #    ____) | | | | | | (_| | |  | |_    #
  #   |_____/|_| |_| |_|\__,_|_|   \__|   #
  #                                       #
  #                                       #
  #    _____             _                #
  #   |  __ \           | |               #
  #   | |  | | ___  __ _| | ___ _ __      #
  #   | |  | |/ _ \/ _` | |/ _ \ '__|     #
  #   | |__| |  __/ (_| | |  __/ |        #
  #   |_____/ \___|\__,_|_|\___|_|        #
  #                                       #
  #########################################

  Parte integrado da Suite Smart Dealer

 */

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

# adiciona a lib Nusoap
require('nusoap/nusoap.php');

# nome da instância do cliente (ex: grupox)
$owner = '{instancia}';       // alterar
$ws_user = '{usuario}';       // alterar
$ws_pass = '{senha}';         // alterar

# cria a conexão com o webservice
$ws = new nusoap_client('http://' . $owner . '.smartdealer.com.br/webservice/core.php?wsdl', true);

# configuração
#$ws->soap_defencoding = 'UTF-8';
#$ws->decode_utf8 = true;
# autentica o usuário  
$login = $ws->setCredentials($ws_user, $ws_pass);

# verifica os erros
if ($err_msg = $ws->getError()) {
    die('um erro ocorreu: ' . $err_msg);
}

/* LEITURA DOS VEÍCULOS NOVOS */

# configura o método
$call = 'CarrosNovos';

# seta os parâmetros
$elem = array(
    'pp' => 1,
    'qtd_por_pp' => 10,
     #'filial' => 2 // código filial
);

$param = array('parametrospage' => $elem);

# efetua a chamada ao webservice (método CarrosNovos)
$return = $ws->call($call, $param);

if ($err_msg = $ws->getError() or ! is_array($return))
    die('um erro ocorreu: ' . $err_msg . ' : ' . $return);

echo '<pre>';
print_r($return);
exit;
