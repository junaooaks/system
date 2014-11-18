<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBUnidadeMedida.php");
require("../model/ModelUnidadeMedida.php");

// resgatando os dados do formulário
$descricao = $_POST;

// guardando num array
$dados = array(
    $descricao['descricao'],
    $descricao['sigla'],
    $descricao['idunidade']
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

    case (empty($descricao['sigla'])):
        $erro = "PREENCHA CAMPO SIGLA";
        echo $erro;
        break;


    case(!empty($descricao['idunidade'])):
        //instalcia class
        $medida = new UnidadeMedida();
        // echo $descricao['idgrupo'];
        $medida->setIDUnidade($descricao['idunidade']);
        $medida->setDescricao($descricao['descricao']);
        $medida->setSigla($descricao['sigla']);

        //inserir dados no banco de daodos
        $dbUnidade = new DBUnidadeMedida();
        $dbUnidade->update($medida);

        break;
    case (empty($erro)):
        // caso não haja erro a instância é criada
        $medida = new UnidadeMedida();

        // os valores são passados para o objeto
        $medida->setDescricao($descricao['descricao']);
        $medida->setSigla($descricao['sigla']);


        //inserir dados no banco de daodos
        $dbUnidade = new DBUnidadeMedida();
        $dbUnidade->insert($medida);

        break;
}
?>
