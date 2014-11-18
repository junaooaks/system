<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBFuncionarioAcesso.php");
require("../model/modelFuncionarioAcesso.php");

// resgatando os dados do formulário
$pessoa = $_POST;

// guardando num array
$dados = array(
    $pessoa['acesso'],
    $pessoa['idfun'],
    $pessoa['usuario'],
    $pessoa['senha'],
    $pessoa['repete'],
    $pessoa['idacesso'],
    
    //permissoes administracao
    $pessoa['empresas'],
    $pessoa['setores'],
    $pessoa['funcionarios'],
    $pessoa['parametro'],
    $pessoa['log'],
    $pessoa['condicaopg'],
    $pessoa['operacoes'],
    $pessoa['db'],
    //permissoes cadastros
    $pessoa['pessoas'],
    $pessoa['fornecedor'],
    $pessoa['produto'],
    $pessoa['grupopessoas'],
    $pessoa['gruposub'],
    $pessoa['marcas'],
    $pessoa['unidade'],
    //movimetação
    $pessoa['nfe'],
    $pessoa['nfs'],
    //financeiro
    $pessoa['contareceber'],
    $pessoa['contapagar'],
    $pessoa['caixa'],
    $pessoa['contabanco'],
    $pessoa['cheques']);

//print_r($pessoa['acesso']);exit();

if ($pessoa['senha'] <> $pessoa['repete']) {

    $erro = "SENHA É REPETE SENHA NÃO CONFERE!";

    echo $erro;

    exit();
}

if ((empty($pessoa['usuario'])) or (empty($pessoa['senha']))) {
    $erro = "USUARIO OU SENHA VAZIO!";

    echo $erro;

    exit();

}

// validação
switch ($dados) {
    case (empty($erro)):
        // caso não haja erro a instância é criada
        $acesso = new modelFuncionarioAcesso();

        $acesso->setIDFun($pessoa['idfun']);
        $acesso->setUsuario($pessoa['usuario']);
        $acesso->setSenha($pessoa['senha']);
        
        
        
        $acesso->setRepete($pessoa['repete']);
        $acesso->setEmpresas($pessoa['empresas']);
        $acesso->setSetores($pessoa['setores']);
        $acesso->setFuncionarios($pessoa['funcionarios']);
        $acesso->setParametro($pessoa['parametro']);
        $acesso->setLog($pessoa['log']);
        $acesso->setCondicaopg($pessoa['condicaopg']);
        $acesso->setOperacoes($pessoa['operacoes']);
        $acesso->setDb($pessoa['db']);
        $acesso->setPessoas($pessoa['pessoas']);
        $acesso->setFornecedor($pessoa['fornecedor']);
        $acesso->setProduto($pessoa['produto']);
        $acesso->setGrupopessoas($pessoa['grupopessoas']);
        $acesso->setGruposub($pessoa['gruposub']);
        $acesso->setMarcas($pessoa['marcas']);
        $acesso->setUnidade($pessoa['unidade']);
        $acesso->setNfe($pessoa['nfe']);
        $acesso->setNfs($pessoa['nfs']);
        $acesso->setContareceber($pessoa['contareceber']);
        $acesso->setContapagar($pessoa['contapagar']);
        $acesso->setCaixa($pessoa['caixa']);
        $acesso->setContabanco($pessoa['contabanco']);
        $acesso->setCheques($pessoa['cheques']);
        $acesso->setAcesso($pessoa['acesso']);
        $acesso->setIDUsuarios($pessoa['idacesso']);
        
        $dbace = new DBFuncionarioAcesso();
        if ($pessoa['idacesso'] <> '') {
            $dbace->update($acesso);
        } else {
            $dbace->insert($acesso);
        }


        // os objetos são chamados pelos métodos
        //echo $cliente->getNome()."<br>";
        // echo $cliente->getCpfcnpj()."<br>";
        break;
}
?>
