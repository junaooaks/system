<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBCaixa.php");
require("../model/modelCaixa.php");

// resgatando os dados do formulário
$descricao = $_POST;

// guardando num array
$dados = array(
    $descricao['descricao'],
    $descricao['idcaixa'],
    $descricao['senha']
);


if (!empty($_GET['codExcluir'])) {
    $pessoa = new modelCaixa();
    // echo $descricao['idgrupo'];
    $pessoa->setIDCaixa($_GET['codExcluir']);
    
    //inserir dados no banco de daodos
    $dbMarca = new DBCaixa();
    $dbMarca->delete($pessoa);
    
    echo "<script>mudaConteudo('app/view/forCaixa.php')</script>";
    
    exit();
}




// validação
switch ($dados) {
    case (empty($descricao['descricao'])):
        $erro = "PREENCHA CAMPO CAIXA";
        echo $erro;
        break;
    case (empty($descricao['senha'])):
        $erro = "PREENCHA CAMPO SENHA";
        echo $erro;
        break;

    case(!empty($descricao['idcaixa'])):
        //instalcia class
        $pessoa = new modelCaixa();
        // echo $descricao['idgrupo'];
        
        $pessoa->setDescricao($descricao['descricao']);
        $pessoa->setIDCaixa($descricao['idcaixa']);
        $pessoa->setSenha($descricao['senha']);

        //inserir dados no banco de daodos
        $dbmarca = new DBcaixa();
        $dbmarca->update($pessoa);
       // echo "<script>mudaConteudo('app/view/forGrupoPessoa.php')</script>";
        //echo "<script>mudaConteudo('app/view/forSubGrupoCliente.php?idgrupo=" . $pessoa->getIDGrupo() . "')</script>";
        break;

    case (empty($erro)):
        // caso não haja erro a instância é criada
        $pessoa = new modelCaixa();

        // os valores são passados para o objeto
        $pessoa->setDescricao($descricao['descricao']);
        $pessoa->setIDCaixa($descricao['idcaixa']);
        $pessoa->setSenha($descricao['senha']);

        //inserir dados no banco de daodos
        $dbcaixa = new DBCaixa();
        $dbcaixa->insert($pessoa);

        break;
}
?>
