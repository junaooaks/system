<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBSetor.php");
require("../model/modelSetor.php");

// resgatando os dados do formulário
$pessoa = $_POST;

// guardando num array
$dados = array(
    $pessoa['idempresa'],
    $pessoa['idsetor'],
    $pessoa['descricao'],
    $pessoa['comissao']);

if (!empty($_GET['codExcluir'])) {
    $setor = new modelSetor();
    // echo $descricao['idgrupo'];
    $setor->setIDSetor($_GET['codExcluir']);
    
    //inserir dados no banco de daodos
    $dbsetor = new DBSetor();
    $dbsetor->delete($setor);
    
    $idem= $_GET['idem'];
    echo "<script>mudaConteudo('app/view/forSetor.php?idempresa=$idem')</script>";
    //  echo "<script type='text/javascript'> history.go(-1);</script>";
    exit();
}

// validação
switch ($dados) {

    case (empty($pessoa['descricao'])):
        $erro = "PREENCHA CAMPO SETOR";
        echo $erro;
        break;

    case (empty($erro)):
        // caso não haja erro a instância é criada
        $cliente = new modelSetor();

        // os valores são passados para o objeto
        $cliente->setDescricao($pessoa['descricao']);
        $cliente->setIDEmpresa($pessoa['idempresa']);
        $cliente->setComissao($pessoa['comissao']);
        $cliente->setIDSetor($pessoa['idsetor']);
        
        //echo $cliente->getIDGrupo();exit();
        //inserir dados no banco de daodos


        $dbsetor = new DBSetor();
        if ($pessoa['idsetor'] <> '') {
            $dbsetor->update($cliente);
        } else {
            $dbsetor->insert($cliente);
        }
        break;
}
?>
