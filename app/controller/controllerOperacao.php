<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBOperacao.php");
require("../model/modelOperacao.php");

// resgatando os dados do formulário
$descricao = $_POST;

// guardando num array
$dados = array(
    $descricao['idoperacao'],
    $descricao['descricao'],
    $descricao['financa'],
    $descricao['comissao'],
    $descricao['tipo']
);
//echo $descricao['tipo'];exit();

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
        $medida = new modelOperacao();
        
        if (empty ($descricao['financa'])){$descricao['financa']='0';}
        if (empty ($descricao['comissao'])){$descricao['comissao']='0';}
        
        // os valores são passados para o objeto
        $medida->setIDOperacao($descricao['idoperacao']);
        $medida->setDescricao($descricao['descricao']);
        $medida->setComissao($descricao['comissao']);
        $medida->setFinanca($descricao['financa']);
        $medida->setTipo($descricao['tipo']);
        
        //inserir dados no banco de daodos
        
        $dboperacao = new DBOperacao();
        if (!empty($descricao['idoperacao'])) {
            $dboperacao->update($medida);
        } else {
            $dboperacao->insert($medida);
        }
        

        break;
}
?>
