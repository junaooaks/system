<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBEmpresa.php");
require("../model/modelEmpresa.php");

// resgatando os dados do formulário
$pessoa = $_POST;

// guardando num array
$dados = array(
    $pessoa['idempresa'],
    $pessoa['empresa'],
    $pessoa['cpfCnpj'],
    $pessoa['endereco'],
    $pessoa['numero'],
    $pessoa['bairro'],
    $pessoa['cidade'],
    $pessoa['uf'],
    $pessoa['cep']);

if (empty($pessoa['cpfCnpj'])) {
    $erro = "PREENCHA CAMPO Cnpj";
    echo $erro;
    exit();
}

if (!is_numeric($pessoa['cpfCnpj'])) {
    $erro = "PREENCHA CAMPO Cnpj SOMENTE NUMERO";
    echo $erro;
    exit();
}

// validação
switch ($dados) {

    case (empty($pessoa['empresa'])):
        $erro = "PREENCHA CAMPO Nome";
        echo $erro;
        break;

    case (empty($pessoa['endereco'])):
        $erro = "PREENCHA CAMPO Endereco";
        echo $erro;
        break;

    case (empty($pessoa['numero'])):
        $erro = "PREENCHA CAMPO Numero";
        echo $erro;
        break;

    case (empty($pessoa['bairro'])):
        $erro = "PREENCHA CAMPO Bairro";
        echo $erro;
        break;

    case (empty($pessoa['cidade'])):
        $erro = "PREENCHA CAMPO Cidade";
        echo $erro;
        break;

    case (empty($pessoa['uf'])):
        $erro = "PREENCHA CAMPO UF";
        echo $erro;
        break;

    case (empty($erro)):
        // caso não haja erro a instância é criada
        $cliente = new modelEmpresa();

        // os valores são passados para o objeto
        $cliente->setNome($pessoa['empresa']);
        $cliente->setCnpj($pessoa['cpfCnpj']);
        $cliente->setEndereco($pessoa['endereco']);
        $cliente->setNumero($pessoa['numero']);
        $cliente->setBairro($pessoa['bairro']);
        $cliente->setCidade($pessoa['cidade']);
        $cliente->setUf($pessoa['uf']);
        $cliente->setCep($pessoa['cep']);
        $cliente->setIDEmpresa($pessoa['idempresa']);
        //echo $cliente->getIDGrupo();exit();
        //inserir dados no banco de daodos


        $dbempresa = new DBEmpresa();
        if ($pessoa['idempresa'] <> '') {
            $dbempresa->update($cliente);
        } else {
            $dbempresa->insert($cliente);
        }
        break;
}
?>
