<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBFinanceiro.php");
require("../model/modelFinanceiro.php");

$form = $_POST;

// guardando num array
$dados = array(
    $form['busca'],
    $form['codFinanceiro'],
    $form['codAvalista'],
    $form['codCliente'],
    $form['dataAvaliacao'],
    $form['limiteCredito'],
    $form['enderecoCobranca'],
    $form['dataCobranca'],
    $form['rendaFixa'],
    $form['moradia'],
    $form['spc'],
    $form['serasa'],
    $form['obs'],
    $form['comer1'],
    $form['comer2'],
    $form['comer3'],
    $form['comer4'],
    $form['comer5'],
    $form['banco1'],
    $form['banco2'],
    $form['banco3']);
$fin = new modelFinanceiro();
$dbfin = new DBFinanceiro();



if (!empty($form['busca'])) {
    $form['busca'] = explode(',', $form['busca']);
    $idbusca = trim($form['busca'][0]);
    
    $fin->setBusca($idbusca);


    $dbfin->selectBUSCA($fin);
    //  echo $cliente->getBusca(); 
    exit();
}

switch ($dados) {
    case (empty($form['limiteCredito'])):
        $erro = "PREENCHA CAMPO Limite de Credito";
        echo $erro;
        break;
    case (empty($form['dataCobranca'])):
        $erro = "PREENCHA CAMPO Data Cobranca";
        echo $erro;
        break;
    case (empty($form['rendaFixa'])):
        $erro = "PREENCHA CAMPO Renda Fixa";
        echo $erro;
        break;
    case (empty($erro)):
        //$form['dataCobranca'] = implode("-", array_reverse(explode("/", $form['dataCobranca'])));

        $fin->setBanco1($form['banco1']);
        $fin->setBanco2($form['banco2']);
        $fin->setBanco3($form['banco3']);
        $fin->setCodFinanceiro($form['codFinanceiro']);
        $fin->setCodAvalista($form['codAvalista']);
        $fin->setCodCliente($form['codCliente']);
        $fin->setComer1($form['comer1']);
        $fin->setComer2($form['comer2']);
        $fin->setComer3($form['comer3']);
        $fin->setComer4($form['comer4']);
        $fin->setComer5($form['comer5']);
        $fin->setCredPessoa($form['limiteCredito']);
        $fin->setDataCobranca($form['dataCobranca']);
        $fin->setEnderecoCobranca($form['enderecoCobranca']);
        $fin->setMoradia($form['moradia']);
        $fin->setObs($form['obs']);
        $fin->setRendaFixaCliente($form['rendaFixa']);
        $fin->setSerasa($form['serasa']);
        $fin->setSpc($form['spc']);

        if (!empty($form['codFinanceiro'])) {
            $dbfin->update($fin);
        } else {
            $dbfin->insert($fin);
        }


        break;
}
?>
