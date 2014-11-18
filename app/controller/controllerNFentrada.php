<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBNFentrada.php");
require("../model/modelNFentrada.php");

// resgatando os dados do formulário
$pessoa = $_POST;

// guardando num array
$dados = array(
    $pessoa['operacao'],
    $pessoa['nf'],
    $pessoa['dataentrada'],
    $pessoa['fornecedor'],
    $pessoa['dataemissao'],
    $pessoa['valorfinal'],
    $pessoa['condicaopg'],
    $pessoa['loja'],
    $pessoa['xidnf'],
    $pessoa['acrescimo'],
    $pessoa['total'],
    $pessoa['obs'],
    $pessoa['quantidade_itens'],
    $pessoa['busca'],
    $pessoa['entrada'],
    $pessoa['emissao'],
    $pessoa['nfe'],
    $pessoa['for'],
    $pessoa['ativo'],
    $pessoa['desconto']
);
//echo $pessoa['quantidade_itens'];


$somaitens = $pessoa['quantidade_itens'];

//echo $pessoa['idnf'];exit();

if (!empty($pessoa['busca'])) {
    //print (json_encode($pessoa['for']));
    $pessoa['emissao'] = implode("-", array_reverse(explode("/", $pessoa['emissao'])));
    $pessoa['entrada'] = implode("-", array_reverse(explode("/", $pessoa['entrada'])));
    
   
    
    $inseri = new modelNFentrada();
    $inseri->setBusca($pessoa['busca']);
    $inseri->setDataemissao($pessoa['emissao']);
    $inseri->setDataentrada($pessoa['entrada']);
    $inseri->setFornecedor($pessoa['for']);
    $inseri->setNf($pessoa['nfe']);
    $dbnf = new DBNFentrada();
    $dbnf->selectBUSCA($inseri);


    exit();
}
// validação
switch ($dados) {
    case (empty($pessoa['nf'])):
        $erro = "PREENCHA CAMPO N° Pedido";
        echo $erro;
        break;

    case (empty($pessoa['dataemissao'])):
        $erro = "PREENCHA CAMPO Data Emissão";
        echo $erro;
        break;
    case (empty($pessoa['valorfinal'])):
        $erro = "PREENCHA CAMPO Valor Final";
        echo $erro;
        break;


    case (empty($erro)):

//formatar data emisao entrada entrada no mysql
        $dataemi = $pessoa['dataemissao'];
        $datae = explode('/', $dataemi);
        //$pessoa['dataemissao'] = $datae[2].'-'.$datae[1].'-'.$datae[0];
        $pessoa['dataemissao'] = implode("-", array_reverse(explode("/", $pessoa['dataemissao'])));
        $pessoa['dataentrada'] = implode("-", array_reverse(explode("/", $pessoa['dataentrada'])));

        //echo $pessoa['dataemissao'];

        for ($x = 1; $x <= $pessoa['quantidade_itens']; $x++) {

            if ($x == 1) {
                $x = $x + 1;
            }

            $item = $_POST["item$x"];
            $quantidade = $_POST["quantidade$x"];
            $uni = $_POST["uni$x"];
            $custo = $_POST["custo$x"];

            $somatotal = $custo + $soma;

//excluir as linhas vazia
            if (empty($item)) {
                $pessoa['quantidade_itens'] = $pessoa['quantidade_itens'] - 1;
            }

            //explode item na virgula
            $item = explode(',', $item . $x);

            //retirar espaço em branco espaço
            $item[0] = rtrim($item[0]);





            //verificar se a string e numerica
            if (!is_numeric($item[0])) {
                echo "Informe o codigo produto " . $item[0];
                exit();
            }


            $codpro = $item[0];
            //aqui seu código com o uso dos valores capturados
            $soma = $somatotal;

            $x = $x++;
        }



        //  $final = int($pessoa['valorfinal']);
        /*if ($somatotal <> $pessoa['valorfinal']) {
            echo "SUB-TOTAL DIFERENTE DE VALOR FINAL CORRIJA! $somatotal // " . $pessoa['valorfinal'];
            exit();
        }*/


// caso não haja erro a instância é criada
        $inseri = new modelNFentrada();

        // os valores são passados para o objeto
        $inseri->setCondicaopg($pessoa['condicaopg']);
        $inseri->setDataemissao($pessoa['dataemissao']);
        $inseri->setDataentrada($pessoa['dataentrada']);
        $inseri->setIDEmpresa($pessoa['loja']);
        $inseri->setIDFornecedor($pessoa['fornecedor']);
        $inseri->setIDOperacao($pessoa['operacao']);
        $inseri->setNf($pessoa['nf']);
        $inseri->setIDOperacao($pessoa['operacao']);
        $inseri->setValorfinal($pessoa['valorfinal']);
        $inseri->setQuantitem($pessoa['quantidade_itens']);
        $inseri->setAcrescimo($pessoa['acrescimo']);
        $inseri->setTotal($pessoa['total']);
        $inseri->setObs($pessoa['obs']);
        $inseri->setIDnfe($pessoa['idnf']);
        $inseri->setDesconto($pessoa['desconto']);
        $inseri->setAtivo($pessoa['ativo']);

//echo $inseri->getQuantitem();exit();
        $dbnf = new DBNFentrada();
//echo $pessoa['idnf'];exit();
        if (!empty($pessoa['idnf'])) {
            $dbnf->update($inseri);
        } else {
            //verificar antes se nota ja dada entrada
            $dbnf->verificar($inseri);

            $dbnf->insert($inseri);
        }
        break;
}
?>
