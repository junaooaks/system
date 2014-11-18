<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBGrupoPessoa.php");
require("../model/GrupoPessoa.php");

// resgatando os dados do formulário
$descricao = $_POST;

// guardando num array
$dados = array(
    $descricao['grupo'],
    $descricao['idgrupo']
);


if (!empty($_GET['codExcluir'])) {
    $pessoa = new GrupoPessoa();
    // echo $descricao['idgrupo'];
    $pessoa->setIDGrupo($_GET['codExcluir']);

    //inserir dados no banco de daodos
    $dbGrupoPessoa = new DBGrupoPessoa();
    $dbGrupoPessoa->delete($pessoa);
    echo "<script>mudaConteudo('app/view/gridGrupoCliente.php')</script>";
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
        $pessoa = new GrupoPessoa();
        // echo $descricao['idgrupo'];
        $pessoa->setIDGrupo($descricao['idgrupo']);
        $pessoa->setGrupo($descricao['grupo']);

        //inserir dados no banco de daodos
        $dbGrupoPessoa = new DBGrupoPessoa();
        $dbGrupoPessoa->update($pessoa);

        break;

    case (empty($erro)):
        // caso não haja erro a instância é criada
        $pessoa = new GrupoPessoa();

        // os valores são passados para o objeto
        $pessoa->setGrupo($descricao['grupo']);



        //inserir dados no banco de daodos
        $dbGrupoPessoa = new DBGrupoPessoa();
        $dbGrupoPessoa->insert($pessoa);



        // os objetos são chamados pelos métodos
        // echo $grupo->getGrupo()."<br>";
        // echo $cliente->getEmail()."<br>";
        break;
}
?>
