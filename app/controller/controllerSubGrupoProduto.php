<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBSubGrupoProduto.php");
require("../model/SubGrupoProduto.php");

// resgatando os dados do formulário
$descricao = $_POST;

// guardando num array
$dados = array(
    $descricao['subgrupo'],
    $descricao['idgrupo'],
    $descricao['idsubgrupo']
);


if (!empty($_GET['codExcluir'])) {
    $pessoa = new SubGrupoProduto();
    // echo $descricao['idgrupo'];
    $pessoa->setIDSubGrupo($_GET['codExcluir']);
    
    //inserir dados no banco de daodos
    $dbSubGrupo = new DBSubGrupoProduto();
    $dbSubGrupo->delete($pessoa);
    
    $idgrupo= $_GET['idgrupo'];
    echo "<script>mudaConteudo('app/view/forSubGrupoCliente.php?idgrupo=$idgrupo')</script>";
    //  echo "<script type='text/javascript'> history.go(-1);</script>";
    exit();
}




// validação
switch ($dados) {
    case (empty($descricao['subgrupo'])):
        $erro = "PREENCHA CAMPO SUB-GRUPO";
        echo $erro;
        break;


    case(!empty($descricao['idsubgrupo'])):
        //instalcia class
        $pessoa = new SubGrupoProduto();
        // echo $descricao['idgrupo'];
        $pessoa->setIDSubGrupo($descricao['idsubgrupo']);
        $pessoa->setSubGrupo($descricao['subgrupo']);
        $pessoa->setIDGrupo($descricao['idgrupo']);

        
        //inserir dados no banco de daodos
        $dbSubGrupo = new DBSubGrupoProduto();
        $dbSubGrupo->update($pessoa);
        $idgrupo = $pessoa->getIDGrupo();
        //print_r("<script>mudaConteudo('forSubGrupoCliente.php?idgrupo=" . $pessoa->getIDGrupo() . "')</script>");
        break;

    case (empty($erro)):
        // caso não haja erro a instância é criada
        $pessoa = new SubGrupoProduto();

        // os valores são passados para o objeto
        $pessoa->setSubGrupo($descricao['subgrupo']);
        $pessoa->setIDSubGrupo($descricao['idgrupo']);



        //inserir dados no banco de daodos
        $dbSubGrupoPessoa = new DBSubGrupoProduto();
        $dbSubGrupoPessoa->insert($pessoa);



        // os objetos são chamados pelos métodos
        // echo $grupo->getGrupo()."<br>";
        // echo $cliente->getEmail()."<br>";
        break;
}
?>
