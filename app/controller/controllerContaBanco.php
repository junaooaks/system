<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBContaBanco.php");
require("../model/modelContaBanco.php");

// resgatando os dados do formulário
$descricao = $_POST;

// guardando num array
$dados = array(
    $descricao['idbanco'],
    $descricao['banco'],
    $descricao['agencia'],
    $descricao['conta'],
    $descricao['titular']
);


if (!empty($_GET['codExcluir'])) {
     $unidade = new UnidadeMedida();
      // echo $descricao['idgrupo'];
      $unidade->setIDUnidade($_GET['codExcluir']);

      //inserir dados no banco de daodos
      $dbMedida = new DBUnidadeMedida();
      $dbMedida->delete($unidade);
      echo "<script>mudaConteudo('app/view/forUnidadeMedida.php')</script>";
      //  echo "<script type='text/javascript'> history.go(-1);</script>";
      exit(); 
}




// validação
switch ($dados) {
    case (empty($descricao['banco'])):
        $erro = "PREENCHA CAMPO BANCO";
        echo $erro;
        break;

    case (empty($descricao['conta'])):
        $erro = "PREENCHA CAMPO NUMERO CONTA";
        echo $erro;
        break;


   /* case(!empty($descricao['idcondicao'])):
        //instalcia class
        $medida = new modelCondicaoPagamento();
        // echo $descricao['idgrupo'];
        $medida->setID($descricao['idunidade']);
        $medida->setDescricao($descricao['descricao']);
        $medida->setSigla($descricao['sigla']);

        //inserir dados no banco de daodos
        $dbUnidade = new DBUnidadeMedida();
        $dbUnidade->update($medida);

        break;*/
    case (empty($erro)):
        // caso não haja erro a instância é criada
        $medida = new modelContaBanco();

        // os valores são passados para o objeto
        $medida->setIDBanco($descricao['idbanco']);
        $medida->setBanco($descricao['banco']);
        $medida->setAgencia($descricao['agencia']);
        $medida->setConta($descricao['conta']);
        $medida->setTitular($descricao['titular']);
        
        
        //inserir dados no banco de daodos
        
        $dbcondicao = new DBContaBanco();
        if (!empty($descricao['idbanco'])) {
            $dbcondicao->update($medida);
        } else {
            $dbcondicao->insert($medida);
        }
        

        break;
}
?>
