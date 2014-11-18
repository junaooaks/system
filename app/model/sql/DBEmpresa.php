<?php
class DBEmpresa {
    private $conex;
    
    public function __construct(){
        $this->conex = new Conexao();
   }
    
    public function insert(modelEmpresa $cliente){
    /*echo "ESTADO ".$cliente->getUf().
         " NOME ".$cliente->getNome().
         " CPF ".$cliente->getCpfcnpj().
         " IDENTIDADE ".$cliente->getIdentidade().
         " SEXO ".$cliente->getSexo().
         " APELIDO ".$cliente->getFantasia().
         " ENDERECO ".$cliente->getEndereco().
         " NUMERO ".$cliente->getNumero().
         " BAIRRO ".$cliente->getBairro().
         " CIDADE ".$cliente->getCidade().
         " cep ".$cliente->getCep().
         " COMPLEMENTP ".$cliente->getComplementar().
         " estado ".$cliente->getUf().
         " GRUPO ".$cliente->getIDGrupo()."";exit();
        */
        //echo "cpfcnpj".$cliente->getCpfcnpj();exit();
        
        $sql = 'INSERT INTO empresa (nome, endereco, numero, bairro, cidade, estado, cep, cnpj)
                VALUES (?,?,?,?,?,?,?,?)';
  
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1,$cliente->getNome(),        PDO::PARAM_STR);
    $stmt->bindParam(2,$cliente->getEndereco(),    PDO::PARAM_STR);
    $stmt->bindParam(3,$cliente->getNumero(),      PDO::PARAM_STR);
    $stmt->bindParam(4,$cliente->getBairro(),      PDO::PARAM_STR);
    $stmt->bindParam(5,$cliente->getCidade(),      PDO::PARAM_STR);
    $stmt->bindParam(6,$cliente->getUf(),          PDO::PARAM_STR);
    $stmt->bindParam(7,$cliente->getCep(),         PDO::PARAM_STR);
    $stmt->bindParam(8,$cliente->getCnpj(),        PDO::PARAM_INT);
    
    if($stmt->execute()){
     $msg = 'Empresa cadastrado com sucesso!' ;
    }else{
      $msg = 'Falha ao tentar cadastrar Empresa'; 
    }
    self::message($msg);
    }
    
    public function update(modelEmpresa $cliente){
        /* echo "ESTADO ".$cliente->getUf().
         " NOME ".$cliente->getNome().
         " CPF ".$cliente->getCpfcnpj().
         " IDENTIDADE ".$cliente->getIdentidade().
         " SEXO ".$cliente->getSexo().
         " APELIDO ".$cliente->getFantasia().
         " ENDERECO ".$cliente->getEndereco().
         " NUMERO ".$cliente->getNumero().
         " BAIRRO ".$cliente->getBairro().
         " CIDADE ".$cliente->getCidade().
         " cep ".$cliente->getCep().
         " COMPLEMENTP ".$cliente->getComplementar().
         " estado ".$cliente->getUf().
         " GRUPO ".$cliente->getIDGrupo()."";exit();
     */    
    $sql = 'UPDATE empresa set cnpj = ?, nome = ?, endereco = ?, numero = ?, bairro = ?, cep = ?, cidade = ?, estado = ? WHERE idempresa = ?';
    $stmt = $this->conex->prepare($sql);
    
    $stmt->bindParam(1, $cliente->getCnpj(),     PDO::PARAM_INT);
    
    $stmt->bindParam(2, $cliente->getNome(),        PDO::PARAM_STR);
    $stmt->bindParam(3, $cliente->getEndereco(),    PDO::PARAM_STR);
    $stmt->bindParam(4, $cliente->getNumero(),      PDO::PARAM_STR);
    $stmt->bindParam(5, $cliente->getBairro(),      PDO::PARAM_STR);
    $stmt->bindParam(6,$cliente->getCep(),         PDO::PARAM_STR);
    $stmt->bindParam(7,$cliente->getCidade(),      PDO::PARAM_STR);
    $stmt->bindParam(8,$cliente->getUf(),          PDO::PARAM_STR);
    $stmt->bindParam(9, $cliente->getIDEmpresa(),     PDO::PARAM_INT);
    $rs = $stmt->execute();
    $msg = $rs === TRUE ? 'Empresa atualizado com sucesso!' : 'Falha ao tentar atualizar Empresa'; //simples comparação para saber se deu certo ou não a execução do sql
    self::message($msg);
    }

    public function delete(Pessoa $pessoa){
    $sql = 'DELETE FROM pessoa WHERE idPessoa = ?';
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1,$pessoa->getIdPessoa(),PDO::PARAM_INT);
    $rs = $stmt->execute();
    $msg = $rs === TRUE ? 'Cliente deletado com sucesso!' : 'Falha na exclusão do cliente.';
    self::message($msg);
    }
    
    public function select(modelEmpresa $pessoa){
    $sql = 'SELECT * FROM empresa WHERE idempresa = ?';
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1,$pessoa->getIDEmpresa(),PDO::PARAM_INT);
    $stmt->execute();
    $rs = $stmt->fetch(PDO::FETCH_OBJ);
    if(is_object($rs)){
        $pessoa->setIDEmpresa($rs->idempresa);
        $pessoa->setNome($rs->nome);
        $pessoa->setEndereco($rs->endereco);
        $pessoa->setNumero($rs->numero);
        $pessoa->setBairro($rs->bairro);
        $pessoa->setCep($rs->cep);
        $pessoa->setCidade($rs->cidade);
        $pessoa->setUf($rs->estado);
        $pessoa->setCnpj($rs->cnpj);
        
    }
    return $pessoa;
    }
    
    public function selectAll(){
    $sql = 'SELECT * FROM empresa';
    $rs = $this->conex->query($sql);
    if($rs){
        while($ln = $rs->fetch(PDO::FETCH_OBJ)){
            $pessoa = new modelEmpresa();
        $pessoa->setIDEmpresa($ln->idempresa);
        $pessoa->setNome($ln->nome);
        $pessoa->setEndereco($ln->endereco);
        $pessoa->setNumero($ln->numero);
        $pessoa->setBairro($ln->bairro);
        $pessoa->setCidade($ln->cidade);
        $pessoa->setUf($ln->estado);
        
        print_r( "<tr>
                 <td align='center'><a href=". "javascript:mudaConteudo('app/view/forEmpresa.php?idempresa=".$pessoa->getIDEmpresa()."')"."><img src='resources/images/lapis_alterar.png' title='Alterar Pessoa'/></a></td>
                 <td>".$pessoa->getNome()."</td>
                 <td>".$pessoa->getEndereco()."</td>
                 <td>".$pessoa->getNumero()."</td>
                 <td>".$pessoa->getBairro()."</td>
                 <td>".$pessoa->getCidade()."</td>
                 <td>".$pessoa->getUf()."</td>    
                 
                 </tr>");
        
        $pessoas[] = $pessoa;
        }
    }
    //if(!is_array($pessoas)){ throw new PDOException('Nenhum registro foi encontrado');}
    return $pessoas;
    }
    
    private function message($msg){ //imprime a mensagem na tela
    echo $msg;
    }
}

?>
