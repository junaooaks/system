<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBMovimentacao.php");
require("../model/modelMovimentacao.php");

// resgatando os dados do formulário
$form = $_POST;

// guardando num array
$dados = array(
    $form['buscaCliente'],
    $form['cod'],
    $form['obs'],
    $form['idpessoa'],
    $form['ativo'],
    $form['valorRecebido'],
    $form['caixa'],
    $form['senha'],
    $form['vendedor'],
    $form['idcaixa'],
    $form['troco'],
    $form['idnfs'],
    $form['condicao']);


$model = new modelMovimentacao();
$db = new DBMovimentacao();
//echo $form['buscaCliente'];
if (!empty($form['buscaCliente'])or(!empty($form['cod']))) {
    
    $model->setBuscaCliente($form['buscaCliente']);
    $model->setCodnfe($form['cod']);
    
    $db->selectBUSCA($model);


    exit();
}

if(!empty($form['caixa'])){
    $model->setIdcaixa($form['caixa']);
    $model->setSenha($form['senha']);
    //verificar se senha esta correta
    
    $db->selectCX($model);
    
    if($form['senha']<>$model->getSenha()){
        echo 'SENHA INCORRETA';
        
    }
    exit();
}

switch ($dados) {
    case (empty($form['vendedor'])):
        echo "VENDEDOR NAO INFORMADO";
        break;
    case (empty($erro)):
        
        $model = new modelMovimentacao();
        $db = new DBMovimentacao();
        
        // os valores são passados para o objeto
        $model->setIDpessoa($form['idpessoa']);
        $model->setValor($form['valorRecebido']);
        $model->setTroco($form['troco']);
        $model->setIdcaixa($form['idcaixa']);
        $model->setIDnfs($form['idnfs']);
        $model->setObs($form['obs']);
        $model->setCondicaopagamento($form['condicao']);
        
                
        if (!empty($form['idnfs'])) {
            $db->insert($model);
        }
              
        break;
}
?>
