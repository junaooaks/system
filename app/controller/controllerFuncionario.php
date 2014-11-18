<?php
require("../model/conexao/Conexao.php");
require("../model/sql/DBFuncionario.php");
require("../model/modelFuncionario.php");
require("validaCpfCnpj.php");

// resgatando os dados do formulário
$pessoa = $_POST;

// guardando num array
$dados = array(
    //$pessoa['idfun'],
    $pessoa['idfuncionario'],
    $pessoa['nome'],
    $pessoa['pai'],
    $pessoa['mae'],
    $pessoa['pis'],
    $pessoa['cpf'],
    $pessoa['dianas'],
    $pessoa['mesnas'],
    $pessoa['anonas'],
    $pessoa['civil'],
    $pessoa['email'],
    $pessoa['endereco'],
    $pessoa['numero'],
    $pessoa['bairro'],
    $pessoa['sexo'],
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
    $pessoa['valor'],
    $pessoa['profissao'],
    $pessoa['grupo'],
    $pessoa['subgrupo'],
    //$pessoa['empresa'],
    //$pessoa['setor'],
    
    $pessoa['comissao'],
    $pessoa['identidade'],
    $pessoa['idpessoa']);

//implode dos telefone
$pessoa['telres'] = "(".$pessoa['ddd'].") ".$pessoa['prefixo']."-".$pessoa['telefone'];
$pessoa['celres'] = "(".$pessoa['dddcel'].") ".$pessoa['prefixocel']."-".$pessoa['telefonecel'];
//$pessoa['telcom'] = "(".$pessoa['dddcom'].") ".$pessoa['prefixocom']."-".$pessoa['telefonecom'];
$pessoa['celcom'] = "(".$pessoa['dddcel2'].") ".$pessoa['prefixocel2']."-".$pessoa['telefonecel2'];

$pessoa['datanascimento'] = $pessoa['anonas']."-".$pessoa['mesnas']."-".$pessoa['dianas'];

/*echo $pessoa['telres']." - ". 
     $pessoa['celres']." - ".
     
     $pessoa['celcom']." - ".
     $pessoa['datanascimento']." - ".
     $pessoa['nome']." - ".
     $pessoa['pai']." - ".
    $pessoa['mae']." - ".
    $pessoa['pis']." - ".
    $pessoa['cpf']." - ".
    $pessoa['dianas']." - ".
    $pessoa['mesnas']." - ".
    $pessoa['anonas']." - ".
    $pessoa['civil']." - ".
    $pessoa['email']." - ".
    $pessoa['endereco']." - ".
    $pessoa['numero']." - ".
    $pessoa['bairro']." - ".
    $pessoa['sexo']." - ".
    $pessoa['cidade']." - ".
    $pessoa['uf']." - ".
    $pessoa['cep']." - ".
    $pessoa['comissao']." - ".
    $pessoa['valor']." - ".
    $pessoa['identidade']." - ".
    $pessoa['profissao']." - ".
    $pessoa['idpessoa'];exit();*/
//converter array para maiusculo
//$pessoa = strtoupper(serialize($dados));
//echo $pessoa['busca'];

/*if(!empty($pessoa['busca'])){
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
*/

if (!empty($_GET['codExcluir'])) {
    $pessoa = new modelFuncionario();
    // echo $descricao['idgrupo'];
    $pessoa->setIDFuncionario($_GET['codExcluir']);

    //inserir dados no banco de daodos
    $dbfun = new DBFuncionario();
    $dbfun->delete($pessoa);
    echo "<script>mudaConteudo('app/view/gridFuncionario.php')</script>";
  
    exit();
}


if(empty($pessoa['cpf'])){
        $erro = "PREENCHA CAMPO Cpf";
        echo $erro;
    exit();
}

if(!is_numeric($pessoa['cpf'])){
        $erro = "PREENCHA CAMPO Cpf SOMENTE NUMERO";
        echo $erro;
    exit();
}

//instanciar class
$valida = new validaCpfCnpj();

if (strlen($pessoa['cpfCnpj'])==11){$cpf = $pessoa['cpfCnpj'];

if($valida->cpf($cpf)){
//print "$cpf — CPF VALIDO!";

}
else{
print "$cpf — CPF INVALIDO!";
exit();
}
}

if (strlen($pessoa['cpfCnpj'])==14){$cnpj = $pessoa['cpfCnpj'];
echo strlen($pessoa['cpfCnpj']);

if($valida->cnpj($cnpj)){
print "$cnpj CNPJ VALIDO!";
}else{
print "$cnpj CNPJ INVALIDO!";
exit();
}
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
    
    case (empty($pessoa['identidade'])):
        $erro = "PREENCHA CAMPO Insc./Identid";
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
    case (empty($pessoa['dianas'])):
          case (empty($pessoa['mesnas'])):
              case (empty($pessoa['anonas'])):
        $erro = "PREENCHA CAMPO Data Nascimento";
        echo $erro;
    break;
    
    case (empty($erro)):
        // caso não haja erro a instância é criada
        $cliente = new modelFuncionario();
                                   
        // os valores são passados para o objeto
        $cliente->setIDFuncionario($pessoa['idfuncionario']);
        $cliente->setNome($pessoa['nome']);
        $cliente->setPai($pessoa['pai']);
        $cliente->setMae($pessoa['mae']);
        $cliente->setCpf($pessoa['cpf']);
        $cliente->setDatanascimento($pessoa['datanascimento']);
        $cliente->setCivil($pessoa['civil']);
        $cliente->setEmail($pessoa['email']);
        $cliente->setEndereco($pessoa['endereco']);
        $cliente->setNumero($pessoa['numero']);
        $cliente->setBairro($pessoa['bairro']);
        $cliente->setCidade($pessoa['cidade']);
        $cliente->setUf($pessoa['uf']);
        $cliente->setCep($pessoa['cep']);
        $cliente->setTelres($pessoa['telres']);
        $cliente->setCelres($pessoa['celres']);
        $cliente->setCelcom($pessoa['celcom']);
        $cliente->setProfissao($pessoa['profissao']);
        $cliente->setEmpresa($pessoa['grupo']);
        $cliente->setIdentidade($pessoa['identidade']);
        $cliente->setSexo($pessoa['sexo']);
        $cliente->setPis($pessoa['pis']);
        $cliente->setComissao($pessoa['comissao']);
        $cliente->setValor($pessoa['valor']);
        $cliente->setIDSetor($pessoa['subgrupo']);
        //echo $cliente->getIDGrupo();exit();
        //inserir dados no banco de daodos
        
        
        $dbfun = new DBFuncionario();
        if ($pessoa['idfuncionario']<>''){
            $dbfun->update($cliente);
        }else{
        $dbfun->insert($cliente);
        }
        
        
        // os objetos são chamados pelos métodos
       //echo $cliente->getNome()."<br>";
       // echo $cliente->getCpfcnpj()."<br>";
    break;
}

?>
