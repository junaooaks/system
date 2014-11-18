<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBSubGrupoPessoa.php");
require("../model/SubGrupoPessoa.php");

// resgatando os dados do formulário
$descricao = $_POST;

// guardando num array
$dados = array(
    $descricao['grupo'],
    $descricao['idgrupo'],
    $descricao['idsubgrupo']
);


if (!empty($_GET['codExcluir'])) {
    $pessoa = new SubGrupoPessoa();
    // echo $descricao['idgrupo'];
    $pessoa->setIDGrupo($_GET['codExcluir']);
    
    //inserir dados no banco de daodos
    $dbSubGrupoPessoa = new DBSubGrupoPessoa();
    $dbSubGrupoPessoa->delete($pessoa);
    
    echo "<script>mudaConteudo('app/view/forGrupoPessoa.php')</script>";
    
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
        $pessoa = new SubGrupoPessoa();
        // echo $descricao['idgrupo'];
        
        $pessoa->setGrupo($descricao['grupo']);
        $pessoa->setIDGrupo($descricao['idgrupo']);

        //inserir dados no banco de daodos
        $dbSubGrupoPessoa = new DBSubGrupoPessoa();
        $dbSubGrupoPessoa->update($pessoa);
       // echo "<script>mudaConteudo('app/view/forGrupoPessoa.php')</script>";
        //echo "<script>mudaConteudo('app/view/forSubGrupoCliente.php?idgrupo=" . $pessoa->getIDGrupo() . "')</script>";
        break;

    case (empty($erro)):
        // caso não haja erro a instância é criada
        $pessoa = new SubGrupoPessoa();

        // os valores são passados para o objeto
        $pessoa->setGrupo($descricao['grupo']);
        $pessoa->setIDSubGrupo($descricao['idgrupo']);



        //inserir dados no banco de daodos
        $dbSubGrupoPessoa = new DBSubGrupoPessoa();
        $dbSubGrupoPessoa->insert($pessoa);



        // os objetos são chamados pelos métodos
        // echo $grupo->getGrupo()."<br>";
        // echo $cliente->getEmail()."<br>";
        break;
}
?>
