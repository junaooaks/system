<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBContaReceber.php");
require("../model/modelContaReceber.php");

// resgatando os dados do formulário
$form = $_POST;

// guardando num array
$dados = array(
    $form['buscaCliente'],
    $form['obs'],
    $form['idpessoa'],
    $form['ativo'],
    $form['valorRecebido']);


$model = new modelContaReceber();
$db = new DBContaReceber();
//echo $form['buscaCliente'];
if (!empty($form['buscaCliente'])) {
    
    $model->setBuscaCliente($form['buscaCliente']);
    $db->selectBUSCA($model);


    exit();
}

//verifica se os dois campos estao sem valor.
/*
if (empty($form['valorRecebido']) || empty($form['ativo'])){
    $erro = "INFORME VALOR OU MARQUE UMA NOTA";
    echo $erro;
}
 * 
 */
switch ($dados) {

    case (empty($erro)):
        
        $model = new modelContaReceber();
        $db = new DBContaReceber();
        
        // os valores são passados para o objeto
        $model->setIDpessoa($form['idpessoa']);
        $model->setAtivo($form['ativo']);
        $model->setValorRecebido($form['valorRecebido']);
                
        if (!empty($form['idpessoa'])) {
            $db->update($model);
        }
              
        break;
}
?>
