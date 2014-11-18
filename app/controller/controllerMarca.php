<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBMarca.php");
require("../model/ModelMarca.php");

// resgatando os dados do formulário
$descricao = $_POST;

// guardando num array
$dados = array(
    $descricao['marca'],
    $descricao['idmarca'],
   
);


if (!empty($_GET['codExcluir'])) {
    $pessoa = new ModelMarca();
    // echo $descricao['idgrupo'];
    $pessoa->setIDMarca($_GET['codExcluir']);
    
    //inserir dados no banco de daodos
    $dbMarca = new DBMarca();
    $dbMarca->delete($pessoa);
    
    echo "<script>mudaConteudo('app/view/forMarca.php')</script>";
    
    exit();
}




// validação
switch ($dados) {
    case (empty($descricao['marca'])):
        $erro = "PREENCHA CAMPO GRUPO";
        echo $erro;
        break;


    case(!empty($descricao['idmarca'])):
        //instalcia class
        $pessoa = new ModelMarca();
        // echo $descricao['idgrupo'];
        
        $pessoa->setMarca($descricao['marca']);
        $pessoa->setIDMarca($descricao['idmarca']);

        //inserir dados no banco de daodos
        $dbmarca = new DBMarca();
        $dbmarca->update($pessoa);
       // echo "<script>mudaConteudo('app/view/forGrupoPessoa.php')</script>";
        //echo "<script>mudaConteudo('app/view/forSubGrupoCliente.php?idgrupo=" . $pessoa->getIDGrupo() . "')</script>";
        break;

    case (empty($erro)):
        // caso não haja erro a instância é criada
        $pessoa = new ModelMarca();

        // os valores são passados para o objeto
        $pessoa->setMarca($descricao['marca']);
        $pessoa->setIDMarca($descricao['idmarca']);



        //inserir dados no banco de daodos
        $dbmarca = new DBMarca();
        $dbmarca->insert($pessoa);



        // os objetos são chamados pelos métodos
        // echo $grupo->getGrupo()."<br>";
        // echo $cliente->getEmail()."<br>";
        break;
}
?>
