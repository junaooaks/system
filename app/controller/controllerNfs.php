<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBNfs.php");
require("../model/modelNFs.php");

// resgatando os dados do formulário
$form = $_POST;

// guardando num array
$dados = array(
    $form['cliente'],
    $form['idcliente'],
    $form['ativo'],
    $form['formapg'],
    $form['valordesconto'],
    $form['frete'],
    $form['acrescimo'],
    $form['total'],
    $form['tipo'],
    $form['nnotad'],
    $form['quantidade_itens'],
    $form['idnfs'],
    $form['busca'],
    $form['obs'],
    $form['vendedor'],
    $form['senha'],
    $form['idvendedor']);

if ($form['valordesconto'] == '') {
    $form['valordesconto'] = 0;
}


$model = new modelNFs();
$db = new DBNfs();

if(!empty($form['vendedor'])){
    $model->setVendedor($form['vendedor']);
    $model->setSenha($form['senha']);
    //verificar se senha esta correta
    
    $db->selectCX($model);
    $senha= md5(hash('sha512', $form['senha']));
    //echo $senha;
    if($senha<>$model->getSenha()){
        echo 'SENHA INCORRETA';
        
    }
    exit();
}


if (!empty($form['busca'])) {
    
    $model->setCliente($form['cliente']);
    $db->selectBUSCA($model);


    exit();
}


if (!empty($form['cliente'])) {

    $cliente = explode(',', $form['cliente']);
    $form['cliente'] = $cliente[0];
    $model->setIDcliente($form['cliente']);


    $db->selectCliente($model);

    exit();
}

switch ($dados) {

    case (empty($form['idcliente'])):

        $erro = "ESCOLHA CLIENTE CADASTRADO NO SISTEMA";
        echo $erro;
     break;

 case ($form['tipo'] == 4):

        if (empty($form['nnotad'])) {
            $erro = "NOTA DE DEVOLUÇÃO PRECISA INFORMAR O NUMERO DA NOTA";
            echo $erro;
        }

     break;

    

     case (empty($erro)):
        
        // os valores são passados para o objeto
        $model->setIDcliente($form['idcliente']);
        $model->setFormapg($form['formapg']);
        $model->setValorDesconto($form['valorDesconto']);
        $model->setFrete($form['frete']);
        $model->setTotal($form['total']);
        $model->setTipo($form['tipo']);
        $model->setNotaDevolucao($form['nnotad']);
        $model->setObs($form['obs']);
        $model->setQuantitem($form['quantidade_itens']);
        $model->setIDnfs($form['idnfs']);
        $model->setIDVendedor($form['idvendedor']);

        
        if (!empty($form['idnfs'])) {
            $db->update($model);
        } else {
            $db->insert($model);
        }
        break;
}
?>
