<?php

require("../model/conexao/Conexao.php");
require("../model/sql/DBVendedor.php");
require("../model/modelVendedor.php");

// resgatando os dados do formulário
$descricao = $_POST;

// guardando num array
$dados = array(
    $descricao['idvendedor'],
    $descricao['nome'],
    $descricao['cpfCnpj'],
    
    $descricao['dianas'],
    $descricao['mesnas'],
    $descricao['anonas'],
    
    $descricao['identidade'],
    $descricao['sexo'],
    $descricao['site'],
    $descricao['email'],
    $descricao['endereco'],
    $descricao['numero'],
    $descricao['bairro'],
    $descricao['complementar'],
    $descricao['cidade'],
    $descricao['uf'],
    $descricao['cep'],
    
    $descricao['ddd'],
    $descricao['prefixo'],
    $descricao['telefone'],
    
    $descricao['dddcel'],
    $descricao['prefixocel'],
    $descricao['telefonecel'],
    
    $descricao['dddcom'],
    $descricao['prefixocom'],
    $descricao['telefonecom'],
    
    $descricao['dddcel2'],
    $descricao['prefixocel2'],
    $descricao['telefonecel2']
);

//implode dos telefone
$descricao['telres'] = "(".$descricao['ddd'].") ".$descricao['prefixo']."-".$descricao['telefone'];
$descricao['celres'] = "(".$descricao['dddcel'].") ".$descricao['prefixocel']."-".$descricao['telefonecel'];
$descricao['telcom'] = "(".$descricao['dddcom'].") ".$descricao['prefixocom']."-".$descricao['telefonecom'];
$descricao['celcom'] = "(".$descricao['dddcel2'].") ".$descricao['prefixocel2']."-".$descricao['telefonecel2'];

$descricao['datanascimento'] = $descricao['anonas']."-".$descricao['mesnas']."-".$descricao['dianas'];

// validação
switch ($dados) {
    case (empty($descricao['nome'])):
        $erro = "PREENCHA CAMPO NOME";
        echo $erro;
    break;

   case (empty($erro)):
        // caso não haja erro a instância é criada
        $vendedor = new modelVendedor();

        // os valores são passados para o objeto
        $vendedor->setIDVendedor($descricao['idvendedor']);
        $vendedor->setNome($descricao['nome']);
        $vendedor->setCpfcnpj($descricao['cpfCnpj']);
        $vendedor->setDatanascimento($descricao['datanascimento']);
        $vendedor->setIdentidade($descricao['identidade']);
        $vendedor->setSexo($descricao['sexo']);
        $vendedor->setSite($descricao['site']);
        $vendedor->setEmail($descricao['email']);
        $vendedor->setEndereco($descricao['endereco']);
        $vendedor->setNumero($descricao['numero']);
        $vendedor->setBairro($descricao['bairro']);
        $vendedor->setComplementar($descricao['complementar']);
        $vendedor->setCidade($descricao['cidade']);
        $vendedor->setUf($descricao['uf']);
        $vendedor->setCep($descricao['cep']);
        $vendedor->setTelres($descricao['telres']);
        $vendedor->setTelcom($descricao['telcom']);
        $vendedor->setCelres($descricao['celres']);
        $vendedor->setCelcom($descricao['celcom']);
        
       // echo $descricao['telres'];exit();
        
        //inserir dados no banco de daodos
        $dbVendedor = new DBVendedor();
        if ($descricao['idvendedor']<>''){
            $dbVendedor->update($vendedor);
        }else{
        $dbVendedor->insert($vendedor);
        }
        
        // os objetos são chamados pelos métodos
        // echo $grupo->getGrupo()."<br>";
        // echo $cliente->getEmail()."<br>";
        break;
}
?>
