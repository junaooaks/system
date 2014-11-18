<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBCondicaoPagamento.php");
require("../model/modelCondicaoPagamento.php");

// resgatando os dados do formulário
$descricao = $_POST;

// guardando num array
$dados = array(
    $descricao['idcondicao'],
    $descricao['descricao'],
    $descricao['np'],
    $descricao['ip'],
    $descricao['entrada'],
    $descricao['desconto'],
    $descricao['acrescimo']
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
    case (empty($descricao['descricao'])):
        $erro = "PREENCHA CAMPO DESCRICAO";
        echo $erro;
        break;

    case (empty($descricao['np'])):
        $erro = "PREENCHA CAMPO NUMERO PARCELAS";
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
        $medida = new modelCondicaoPagamento();

        // os valores são passados para o objeto
        $medida->setIDCondicao($descricao['idcondicao']);
        $medida->setDescricao($descricao['descricao']);
        $medida->setNp($descricao['np']);
        $medida->setIp($descricao['ip']);
        $medida->setAcrescimo($descricao['acrescimo']);
        $medida->setDesconto($descricao['desconto']);
        $medida->setEntrada($descricao['entrada']);
        
        //inserir dados no banco de daodos
        
        $dbcondicao = new DBCondicaoPagamento();
        if (!empty($descricao['idcondicao'])) {
            $dbcondicao->update($medida);
        } else {
            $dbcondicao->insert($medida);
        }
        

        break;
}
?>
