<?php
require("../model/conexao/Conexao.php");
require("../model/sql/DBFornecedor.php");
require("../model/modelFornecedor.php");
require("validaCpfCnpj.php");

// resgatando os dados do formulário
$pessoa = $_POST;

// guardando num array
$dados = array(
    $pessoa['busca'],
    $pessoa['idfornecedor'],
    $pessoa['idvendedor'],
    
    $pessoa['nome'],
    $pessoa['cnpj'],
    $pessoa['site'],
    $pessoa['email'],
    $pessoa['endereco'],
    $pessoa['numero'],
    $pessoa['bairro'],
    $pessoa['cidade'],
    $pessoa['uf'],
    $pessoa['cep'],
    
    $pessoa['ddd'],
    $pessoa['prefixo'],
    $pessoa['telefone'],
    $pessoa['dddcel'],
    $pessoa['prefixocel'],
    $pessoa['telefonecel'],
    $pessoa['dddcom'],
    $pessoa['prefixocom'],
    $pessoa['telefonecom'],
    $pessoa['dddcel2'],
    $pessoa['prefixocel2'],
    $pessoa['telefonecel2'],
    
    $pessoa['ie']);

//implode dos telefone
$pessoa['telres'] = "(".$pessoa['ddd'].") ".$pessoa['prefixo']."-".$pessoa['telefone'];
$pessoa['celres'] = "(".$pessoa['dddcel'].") ".$pessoa['prefixocel']."-".$pessoa['telefonecel'];
$pessoa['telcom'] = "(".$pessoa['dddcom'].") ".$pessoa['prefixocom']."-".$pessoa['telefonecom'];
$pessoa['celcom'] = "(".$pessoa['dddcel2'].") ".$pessoa['prefixocel2']."-".$pessoa['telefonecel2'];


//echo $pessoa['idvendedor'];exit();
//echo $pessoa['telres'], $pessoa['celres'], $pessoa['telcom'], $pessoa['celcom'],$pessoa['datanascimento'];exit();
//converter array para maiusculo
//$pessoa = strtoupper(serialize($dados));
if(!empty($pessoa['busca'])){
    $cliente = new Pessoa();
    $cliente->setBusca($pessoa['busca']);
        //echo $cliente->getIDGrupo();exit();
        //inserir dados no banco de daodos
    //echo $cliente->getBusca();
    
   $dbPessoa = new DBPessoa();
    $dbPessoa->selectBUSCA($cliente);
     //  echo $cliente->getBusca(); 
        exit();   
}


if(empty($pessoa['cnpj'])){
        $erro = "PREENCHA CAMPO Cnpj";
        echo $erro;
    exit();
}

if(!is_numeric($pessoa['cnpj'])){
        $erro = "PREENCHA CAMPO Cnpj SOMENTE NUMERO";
        echo $erro;
    exit();
}

//instanciar class
$valida = new validaCpfCnpj();

$cnpj = $pessoa['cnpj'];
//echo strlen($pessoa['cpfCnpj']);

if($valida->cnpj($cnpj)){

}else{
print "$cnpj CNPJ INVALIDO!";
exit();

}
if (!empty($pessoa['email'])){
        if(!filter_var($pessoa['email'], FILTER_VALIDATE_EMAIL)){
        $erro = "ESTE EMAIL E INVALIDO";
        echo $erro;
        exit();
        }
        
        }

// validação
switch($dados) {
    case (empty($pessoa['nome'])):
        $erro = "PREENCHA CAMPO Nome";
        echo $erro;
    break;
    
    case (empty($pessoa['ie'])):
        $erro = "PREENCHA CAMPO I.E";
        echo $erro;
    break;
    case (empty($pessoa['endereco'])):
        $erro = "PREENCHA CAMPO Endereco";
        echo $erro;
    break;
    case (empty($pessoa['numero'])):
        $erro = "PREENCHA CAMPO Numero";
        echo $erro;
    break;
    case (empty($pessoa['bairro'])):
        $erro = "PREENCHA CAMPO Bairro";
        echo $erro;
    break;
    case (empty($pessoa['cidade'])):
        $erro = "PREENCHA CAMPO Cidade";
        echo $erro;
    break;
    case (empty($pessoa['uf'])):
        $erro = "PREENCHA CAMPO UF";
        echo $erro;
    break;
   
    
    case (empty($erro)):
        // caso não haja erro a instância é criada
        $cliente = new modelFornecedor();
                                   
        // os valores são passados para o objeto
        
        $cliente->setNome($pessoa['nome']);
        
        
        $cliente->setCnpj($pessoa['cnpj']);
        $cliente->setSite($pessoa['site']);
        $cliente->setEmail($pessoa['email']);
        $cliente->setEndereco($pessoa['endereco']);
        $cliente->setNumero($pessoa['numero']);
        $cliente->setBairro($pessoa['bairro']);
        
        $cliente->setCidade($pessoa['cidade']);
        $cliente->setUf($pessoa['uf']);
        $cliente->setCep($pessoa['cep']);
        $cliente->setTelres($pessoa['telres']);
        $cliente->setCelres($pessoa['celres']);
        $cliente->setTelcom($pessoa['telcom']);
        $cliente->setCelcom($pessoa['celcom']);
        $cliente->setIDFornecedor($pessoa['idfornecedor']);
        $cliente->setIDVendedor($pessoa['idvendedor']);
        $cliente->setIe($pessoa['ie']);
        
        //echo $cliente->getIDGrupo();exit();
        //inserir dados no banco de daodos
        
        
        $dbfornecedor = new DBFornecedor();
        if ($pessoa['idfornecedor']<>''){
            $dbfornecedor->update($cliente);
        }else{
        $dbfornecedor->insert($cliente);
        }
        
        
        // os objetos são chamados pelos métodos
       //echo $cliente->getNome()."<br>";
       // echo $cliente->getCpfcnpj()."<br>";
    break;
}

?>
