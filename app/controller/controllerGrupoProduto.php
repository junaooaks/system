<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBGrupoProduto.php");
require("../model/GrupoProduto.php");

// resgatando os dados do formulário
$descricao = $_POST;

// guardando num array
$dados = array(
    $descricao['grupo'],
    $descricao['comissao'],
    $descricao['idgrupo']
);


if (!empty($_GET['codExcluir'])) {
    $pessoa = new GrupoProduto();
    // echo $descricao['idgrupo'];
    $pessoa->setIDGrupo($_GET['codExcluir']);

    //inserir dados no banco de daodos
    $dbGrupoPessoa = new DBGrupoProduto();
    $dbGrupoPessoa->delete($pessoa);
    echo "<script>mudaConteudo('app/view/forGrupoProduto.php')</script>";
  //  echo "<script type='text/javascript'> history.go(-1);</script>";
    exit();
}




// validação
switch ($dados) {
    case (empty($descricao['grupo'])):
        $erro = "PREENCHA CAMPO GRUPO";
        echo $erro;
        break;


    case(!empty($descricao['idgrupo'])):
        //instalcia class
        $pessoa = new GrupoProduto();
        // echo $descricao['idgrupo'];
        $pessoa->setIDGrupo($descricao['idgrupo']);
        $pessoa->setGrupo($descricao['grupo']);
        $pessoa->setComissao($descricao['comissao']);

        //inserir dados no banco de daodos
        $dbGrupoPessoa = new DBGrupoProduto();
        $dbGrupoPessoa->update($pessoa);

        break;
   case (empty($erro)):
        // caso não haja erro a instância é criada
        $pessoa = new GrupoProduto();

        // os valores são passados para o objeto
        $pessoa->setGrupo($descricao['grupo']);
        
        $descricao['comissao'] = substr_replace($descricao['comissao'], '.', strpos($descricao['comissao'], ","), 1);
        $pessoa->setComissao($descricao['comissao']);


        //inserir dados no banco de daodos
        $dbGrupoProduto = new DBGrupoProduto();
        $dbGrupoProduto->insert($pessoa);



        // os objetos são chamados pelos métodos
        // echo $grupo->getGrupo()."<br>";
        // echo $cliente->getEmail()."<br>";
        break;
}
?>
