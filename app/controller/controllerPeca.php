<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBPeca.php");
require("../model/ModelPeca.php");

// resgatando os dados do formulário
$pessoa = $_POST;

// guardando num array
$dados = array(
    $pessoa['pesquisa'],
    $pessoa['unitario'],
    $pessoa['busca'],
    $pessoa['st'],
    $pessoa['frete'],
    $pessoa['preco_custo'],
    $pessoa['ircs'],
    $pessoa['preco_venda'],
    $pessoa['ipi'],
    $pessoa['frete_p'],
    $pessoa['pis_confins'],
    $pessoa['lucro'],
    $pessoa['comissao'],
    $pessoa['idpeca'],
    //relacionamento
    $pessoa['grupo'],
    $pessoa['marca'],
    $pessoa['unidade'],
    $pessoa['empresa'],
    $pessoa['subgrupo'],
    $pessoa['fornecedor'],
    $pessoa['custo'],
    //descricao do produto
    $pessoa['status'],
    $pessoa['codfabricante'],
    $pessoa['codean'],
    $pessoa['idcusto'],
    $pessoa['descricao'],
    $pessoa['classificacao'],
    $pessoa['fracionavel'],
    $pessoa['localizacao'],
    $pessoa['pesobruto'],
    $pessoa['pesoliquido'],
    $pessoa['estoqueatual'],
    $pessoa['estoqueminimo'],
    $pessoa['estoquemaximo'],
    $pessoa['custopro'],
    $pessoa['codmang']);

//echo "teste=".$pessoa['custopro'];exit();
if (!empty($pessoa['busca'])) {
    //echo $pessoa['busca'];
    $cliente = new ModelPeca();
    $cliente->setBusca($pessoa['busca']);
    $dbPessoa = new DBPeca();
    $dbPessoa->selectBUSCA($cliente);
    exit();
}


if (!empty($pessoa['custopro'])) {
    $peca = new ModelPeca();
    $peca->setCustopro($pessoa['custopro']);
    
    $dbPeca = new DBPeca();
    $dbPeca->selectCustopro($peca);
    
    exit();
}




// validação
switch ($dados) {
    case (empty($pessoa['custo'])):
        $erro = "PREENCHA CAMPO CUSTO";
        echo $erro;
        break;
    
    case (empty($pessoa['fornecedor'])):
        $erro = "PREENCHA CAMPO FORNECEDOR";
        echo $erro;
        break;
    
    case (empty($pessoa['subgrupo'])):
        $erro = "PREENCHA CAMPO SUB-GRUPO";
        echo $erro;
        break;
    
    case (empty($pessoa['empresa'])):
        $erro = "PREENCHA CAMPO EMPRESA";
        echo $erro;
        break;
    
    case (empty($pessoa['unidade'])):
        $erro = "PREENCHA CAMPO UNIDADE";
        echo $erro;
        break;
    
    case (empty($pessoa['marca'])):
        $erro = "PREENCHA CAMPO MARCA";
        echo $erro;
        break;
    
    case (empty($pessoa['grupo'])):
        $erro = "PREENCHA CAMPO GRUPO";
        echo $erro;
        break;
    
    case (empty($pessoa['preco_custo'])):
        $erro = "PREENCHA CAMPO Preco Custo";
        echo $erro;
        break;

    case (empty($pessoa['descricao'])):
        $erro = "PREENCHA CAMPO Descricao do produto";
        echo $erro;
        break;
    case (empty($pessoa['fracionavel'])):
        $erro = "PREENCHA CAMPO Fracionavel";
        echo $erro;
        break;
    case (empty($pessoa['localizacao'])):
        $erro = "PREENCHA CAMPO Localizacao";
        echo $erro;
        break;
    case (empty($pessoa['estoqueatual'])):
        $erro = "PREENCHA CAMPO Estoque atual";
        echo $erro;
        break;
    case (empty($pessoa['estoqueminimo'])):
        $erro = "PREENCHA CAMPO Estoque minimo";
        echo $erro;
        break;
    case (empty($pessoa['estoquemaximo'])):
        $erro = "PREENCHA CAMPO Estoque maximo";
        echo $erro;
        break;

    case (empty($erro)):
        // caso não haja erro a instância é criada
        $peca = new ModelPeca();
        // os valores são passados para o objeto
        $peca->setPesquisa($pessoa['pesquisa']);
        $peca->setUnitario($pessoa['unitario']);
        $peca->setClassificacao($pessoa['classificacao']);
        $peca->setCodean($pessoa['codean']);
        $peca->setCodfabricante($pessoa['codfabricante']);
        $peca->setComissao($pessoa['comissao']);
        $peca->setCusto($pessoa['custo']);
        $peca->setDescricao($pessoa['descricao']);
        $peca->setEmpresa($pessoa['empresa']);
        $peca->setEstoqueatual($pessoa['estoqueatual']);
        $peca->setEstoquemaximo($pessoa['estoquemaximo']);
        $peca->setEstoqueminimo($pessoa['estoqueminimo']);
        $peca->setFornecedor($pessoa['fornecedor']);
        $peca->setFracionavel($pessoa['fracionavel']);
        $peca->setFrete($pessoa['frete']);
        $peca->setFretep($pessoa['frete_p']);
        $peca->setGrupo($pessoa['grupo']);
        $peca->setIpi($pessoa['ipi']);
        $peca->setIrcs($pessoa['ircs']);
        $peca->setLocalizacao($pessoa['localizacao']);
        $peca->setLucro($pessoa['lucro']);
        $peca->setMarca($pessoa['marca']);
        $peca->setPesobruto($pessoa['pesobruto']);
        $peca->setPesoliquido($pessoa['pesoliquido']);
        $peca->setPesquisa($pessoa['pesquisa']);
        $peca->setPisconfins($pessoa['pis_confins']);
        $peca->setPrecocusto($pessoa['preco_custo']);
        $peca->setPrecovenda($pessoa['preco_venda']);
        $peca->setSt($pessoa['st']);
        $peca->setStatus($pessoa['status']);
        $peca->setSubgrupo($pessoa['subgrupo']);
        $peca->setUnidade($pessoa['unidade']);
        $peca->setIDPeca($pessoa['idpeca']);
        $peca->setIDCusto($pessoa['idcusto']);
        $peca->setCodMang($pessoa['codmang']);
        
        //echo $peca->getUnitario();exit();
        //inserir dados no banco de daodos
        // echo $pessoa['idpeca'];

        $dbPeca = new DBPeca();
        if (!empty($pessoa['idpeca'])) {
            $dbPeca->update($peca);
        } else {
            $dbPeca->insert($peca);
        }


        // os objetos são chamados pelos métodos
        //echo $cliente->getNome()."<br>";
        // echo $cliente->getCpfcnpj()."<br>";
        break;
}
?>
