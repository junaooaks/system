<?php
set_time_limit(0);
ini_set('memory_limit','256M');

require("../model/conexao/Firebird.php");
require("../model/conexao/Conexao.php");
require("../model/sql/DBExportar.php");
require("../model/modelExportar.php");

// resgatando os dados do formulário
$descricao = $_POST;

// guardando num array
$dados = array(
    $descricao['tabela'],
    $descricao['produto'],
    $descricao['cliente']
);

// validação
switch ($dados) {
    /*case (empty($descricao['host'])):
        $erro = "PREENCHA CAMPO HOST";
        echo $erro;
        break;


    case(empty($descricao['caminho'])):
        
        $erro = "PREENCHA CAMPO CAMINHO";
        echo $erro;
        
        break;
*/
    case (empty($erro)):
        // caso não haja erro a instância é criada
        $model = new modelExportar();

        // os valores são passados para o objeto
        $model->setTabela($descricao['tabela']);
        $model->setCliente($descricao['cliente']);
        $model->setProduto($descricao['produto']);
        //inserir dados no banco de daodos
        
        $db = new Firebird();
        $dbex = new DBExportar();
       
        if ($descricao['tabela']=='cliente'){
        $dbex->selectAll();
        
        }else if ($descricao['tabela']=='produto'){
            $dbex->produto();    
        }else if($descricao['tabela']=='marca'){
            $dbex->marca();
        }else if($descricao['tabela']=='fornecedor'){
            $dbex->fornecedor();
        }else
        {
            echo "ESCOLHA UMA TABELA";
        }
        
        break;
}
?>
