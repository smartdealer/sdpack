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

  Parte integrando da Suite Smart Dealership
  Todos os direitos reservados.

 */

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Untitled Document</title>
    </head>

    <body>
        <?php
        # Carrega o módulo NuSOAP 
        require('./nusoap/nusoap.php');

        # Instância Objeto nusoap_client 
        $WS_SDS = new nusoap_client('http://{cliente].smartdealer.com.br/webservice/core.php?wsdl', true); // seta a url do cliente
        # Autenticação no WS do Smart Dealer 
        $WS_SDS->setCredentials('{usuário}', '{senha}'); // seta o usuário e senha da autenticação HTTP
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //

        echo '<h1>Exemplo de consumo do M&eacute;todo "GetFiliais"</h1>';

        # Chamada do Método 
        $out = $WS_SDS->call('GetFiliais');

        # Saída em Array 
        echo '<pre>';
        print_r($out);
        echo '</pre>';

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //


        echo '<h1>Exemplo de consumo do M&eacute;todo "CarrosNovos" (Apenas ve&iacute;culos novos)</h1>';

        # Parâmetros 
        $in = array(
//				'filial'      => '01,02',  // -> (string) Código interno da filial ou não passar o parâmetro em caso de todas 
//				'estoque'     => 'VN',	// -> (string) Código do Estoque  não passar o parâmetro em caso de todos 
//				'marca'       => '', // -> (string) Marca solicitadao ou não passar o parâmetro em caso de todas
//				'modelo'      => '', // -> (string) Termo de busca para modelo ou não passar o parâmetro em caso de todas
//				'ano_min'     => '44310.00', // -> (string) Piso do ano solicitadao ou não passar o parâmetro em caso de todas
//				'ano_max'     => '', // -> (string) Teto do ano solicitadao ou não passar o parâmetro em caso de todas
//				'preco_min'   => '40000', // -> (string) Piso do valor ou não passar o parâmetro em caso de todas
//				'preco_max'   => '60000', // -> (string) Teto do valor ou não passar o parâmetro em caso de todas
//				'familia'     => '', // -> (string) Família solicitada, ou, em caso de vazio todas 
//				'cor'         => 'VERDE', // -> (string) Cor solicitada, ou, em caso de vazio todas 
//				'combustivel' => '', // -> (string) Combustível solicitado, ou, em caso de vazio todos 
//				'campo_ordenador' => 'valor', // -> (string) ['modelo', 'ano', 'valor']
//				'sentido_ordenacao' => 'desc', // -> (string) ['asc', 'desc']        


            'pp' => 1, // -> (integer) Número da página requisitada
            'qtd_por_pp' => 2   // -> (integer) Quantidade de registros por página
        );


        # Chamada do Método 
        $out = $WS_SDS->call('CarrosNovos', array('parametrospage' => $in));

        # Saída em Array 
        echo '<pre>';
        print_r($out);
        echo '</pre>';

        # Exemplo de montagem de imagem...

        foreach ($out as $car) {
            $a = explode('/', $car['url_imagem']);
            $b = explode('.', $a[1]);


            echo $car['modelo'] . '<br />';
            echo '<img src="https://core.smartdealer.com.br/webservice/get-image.php?m=' . $a[0] . '&c=' . $b[0] . '&img_w=300&o=prima_via" style="border:none;"><br />';
        }


        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //

        echo '<h1>Exemplo de consumo do M&eacute;todo "CarrosUsados" (Apenas em ve&iacute;culos usados)</h1>';

        # Parâmetros 
        $in = array(
//				'filial'      => '1', // -> (string) Código interno da filial ou não passar o parâmetro em caso de todas 
//				'estoque'     => '', // -> (string) Código do Estoque  não passar o parâmetro em caso de todos 
//				'marca'       => '', // -> (string) Marca solicitadao ou não passar o parâmetro em caso de todas
//				'modelo'      => '', // -> (string) Termo de busca para modelo ou não passar o parâmetro em caso de todas
//				'ano_min'     => '40000', // -> (string) Piso do ano solicitadao ou não passar o parâmetro em caso de todas
//				'ano_max'     => '', // -> (string) Teto do ano solicitadao ou não passar o parâmetro em caso de todas
//				'preco_min'   => '40000.00', // -> (string) Piso do valor ou não passar o parâmetro em caso de todas
//				'preco_max'   => '', // -> (string) Teto do valor ou não passar o parâmetro em caso de todas
//				'familia'     => '', // -> (string) Família solicitadao ou não passar o parâmetro em caso de todas
//				'cor'         => '', // -> (string) Cor solicitada ou não passar o parâmetro em caso de todas
//				'combustivel' => '', // -> (string) Combustível solicitado ou não passar o parâmetro em caso de todas
//				'campo_ordenador' => 'ano', // -> (string) ['modelo', 'ano', 'valor']
//				'sentido_ordenacao' => 'asc', // -> (string) ['asc', 'desc'] 

            'pp' => 1, // -> (integer) Número da página requisitada
            'qtd_por_pp' => 2 // -> (integer) Quantidade de registros por página
        );


        # Chamada do Método 
        $out = $WS_SDS->call('CarrosUsados', array('parametrospage' => $in));

        # Saída em Array 
        echo '<pre>';
        print_r($out);
        echo '</pre>';

        # Exemplo de montagem de imagem...

        foreach ($out as $car) {

            echo $car['modelo'] . '<br />';
            echo '<img src="http://core.smartdealer.com.br/img/' . $car['id'] . '/prima_via/300/1.jpg" style="border:none;"><br />';
        }


        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //

        echo '<h1>Exemplo de consumo do M&eacute;todo "CarrosCorsia" (Apenas em corsia)</h1>';

        # Parâmetros 
        $in = array(
//				'filial'      => '908061',  // -> (string) Código FIAT da filial ou não passar o parâmetro em caso de todas 
//				'estoque'     => 'CR,CG',		// -> (string) Código do Estoque  não passar o parâmetro em caso de todos 
            'familia' => '', // -> (string) Família solicitada, ou, em caso de vazio todas 
            'cor' => '', // -> (string) Cor solicitada, ou, em caso de vazio todas 
            'combustivel' => '', // -> (string) Combustível solicitado, ou, em caso de vazio todos 
            'pp' => 1, // -> (integer) Número da página requisitada
            'qtd_por_pp' => 2     // -> (integer) Quantidade de registros por página
        );


        # Chamada do Método 
        $out = $WS_SDS->call('CarrosCorsia', array('parametrospage' => $in));

        # Saída em Array 
        echo '<pre>';
        print_r($out);
        echo '</pre>';

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //

        echo '<h1>Exemplo de consumo do M&eacute;todo "CarroUsado" (Retorna os dados de um ve&iacute;culo usado por sua placa)</h1>';

        # Parâmetros 
        $in = 'MLE6373'; // -> (string) Placa do veículo desejado
        # Chamada do Método 
        $out = $WS_SDS->call('CarroUsado', array('placa' => $in));

        # Saída em Array 
        echo '<pre>';
        print_r($out);
        echo '</pre>';

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //

        echo '<h1>Exemplo de consumo do M&eacute;todo "CarroNovo" (Retorna os dados de um ve&iacute;culo novo por seu chassi)</h1>';

        # Parâmetros 
        $in = '3C3AFFAR0DT595805'; // -> (string) Chassi do veículo desejado
        # Chamada do Método 
        $out = $WS_SDS->call('CarroNovo', array('chassi' => $in));

        # Saída em Array 
        echo '<pre>';
        print_r($out);
        echo '</pre>';

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //

        echo '<h1>Exemplo de consumo do M&eacute;todo "CarroCorsia" (Retorna os dados de um ve&iacute;culo novo por seu industrial)</h1>';

        # Parâmetros 
        $in = '514147724'; // -> (string) Industrial do veículo desejado
        # Chamada do Método 
        $out = $WS_SDS->call('CarroCorsia', array('ind' => $in));

        # Saída em Array 
        echo '<pre>';
        //print_r(unserialize($out));
        print_r($out);
        echo '</pre>';


        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //

        echo '<h1>Exemplo de consumo do M&eacute;todo "GetFamilias" (Fam&iacute;lias dos ve&iacute;culos novos, usados, corsia)</h1>';

        # Parâmetros 
        $in = array(
            //'filial'  => '01',   // -> (string) Código interno da filial ou não passar o parâmetro em caso de todas 
            //'estoque' => '',	 // -> (string) Código do Estoque  não passar o parâmetro em caso de todos 	
            'modo' => 'corsia' // -> (string) ['novos', 'usados', 'corsia', 'socrosia']
        );

        # Chamada do Método 
        $out = $WS_SDS->call('GetFamilias', array('parametrosbusca' => $in));

        # Saída em Array 
        echo '<pre>';
        print_r($out);
        echo '</pre>';

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //

        echo '<h1>Exemplo de consumo do M&eacute;todo "GetCores" (Cores dos ve&iacute;culos novos, usados, corsia)</h1>';

        # Parâmetros 
        $in = array(
//				'filial'  => '01,910620',  // -> (string) Código interno da filial ou não passar o parâmetro em caso de todas 
//				'estoque' => 'CG',	// -> (string) Código do Estoque  não passar o parâmetro em caso de todos 	
            'modo' => 'corsia' // -> (string) ['novos', 'usados', 'corsia']
        );

        # Chamada do Método 
        $out = $WS_SDS->call('GetCores', array('parametrosbusca' => $in));

        # Saída em Array 
        echo '<pre>';
        print_r($out);
        echo '</pre>';

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //

        echo '<h1>Exemplo de consumo do M&eacute;todo "GetCombustiveis" (Combust&iacute;veis dos ve&iacute;culos novos, usados)</h1>';

        # Parâmetros 
        $in = array(
//				'filial'  => '01',  // -> (string) Código interno da filial ou não passar o parâmetro em caso de todas 
//				'estoque' => 'VN',	// -> (string) Código do Estoque  não passar o parâmetro em caso de todos 	
            'modo' => 'usados' // -> (string) ['novos', 'usados']	
        );

        # Chamada do Método 
        $out = $WS_SDS->call('GetCombustiveis', array('parametrosbusca' => $in));

        # Saída em Array 
        echo '<pre>';
        print_r($out);
        echo '</pre>';


        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //

        echo '<h1>Exemplo de consumo do M&eacute;todo "GetModelos" (Modelos dos ve&iacute;culos novos, usados)</h1>';

        # Parâmetros 
        $in = array(
//				'texto'   => 'BMW',  // -> (string) Marca pesquisada não passar o parâmetro em caso de todos 
//				'filial'  => '01',  // -> (string) Código interno da filial ou não passar o parâmetro em caso de todas 
//				'estoque' => 'VN',	// -> (string) Código do Estoque  não passar o parâmetro em caso de todos 	
            'modo' => 'novos' // -> (string) ['novos', 'usados']	
        );

        # Chamada do Método 
        $out = $WS_SDS->call('GetModelos', array('parametrosbusca' => $in));

        # Saída em Array 
        echo '<pre>';
        print_r($out);
        echo '</pre>';

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //

        echo '<h1>Exemplo de consumo do M&eacute;todo "GetMarcas" (Marcas dos ve&iacute;culos novos, usados)</h1>';

        # Parâmetros 
        $in = array(
//				'filial'  => '01',  // -> (string) Código interno da filial ou não passar o parâmetro em caso de todas 
//				'estoque' => 'VN',	// -> (string) Código do Estoque  não passar o parâmetro em caso de todos 	
            'modo' => 'usados' // -> (string) ['novos', 'usados']	
        );

        # Chamada do Método 
        $out = $WS_SDS->call('GetMarcas', array('parametrosbusca' => $in));

        # Saída em Array 
        echo '<pre>';
        print_r($out);
        echo '</pre>';

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //
        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - //

        echo '<h1>Exemplo de consumo do M&eacute;todo "EuQuero" (Posta requisi&ccedil;&otilde;es de ve&iacute;culos)</h1>';

        # Parâmetros 
        $in = array(
            'carro_id' => '3C3AFFAR0CT211410_01', // -> (string) Id do veículo como se encontra no retorno do WS (Chassi_Filial ou Industrial)
            'nome' => 'Smart Dealership', // -> (string) Nome do cliente 
            'telefone' => '048 0000-0000', // -> (string) Telefone do Cliente
            'e_mail' => 'contato@smartdealership.com.br', // -> (string) E-mail do Cliente
            'mensagem' => 'Exemplo de consumo do Web Service', // -> (string) Mensagem do Cliente
            'modal' => 'novos'                              // -> (string) ['novos', 'usados', 'corsia']
        );

        # Chamada do Método 
        $out = $WS_SDS->call('EuQuero', array('mensagem' => $in));

        # Saída em String 
        echo '<pre>';
        print_r($out);
        echo '</pre>';
        ?>
    </body>
</html>