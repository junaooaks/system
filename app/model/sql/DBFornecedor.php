<?php

class DBFornecedor {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function insert(modelFornecedor $cliente){
    /*echo 
        "IDVENDEDOR".$cliente->getIDVendedor().
        "ESTADO ".$cliente->getUf().
         " NOME ".$cliente->getNome().
         " CNPJ ".$cliente->getCnpj().
         " IE ".$cliente->getIe().
         " Email ".$cliente->getEmail().
         " SITE ".$cliente->getSite().   
         " ENDERECO ".$cliente->getEndereco().
         " NUMERO ".$cliente->getNumero().
         " BAIRRO ".$cliente->getBairro().
         " CIDADE ".$cliente->getCidade().
         " cep ".$cliente->getCep().
         " tel1 ".$cliente->getTelcom().
         " telres ".$cliente->getTelres().
            " celres ".$cliente->getCelres().
            " celcom ".$cliente->getCelcom().
         "";exit();*/
        
        //echo "cpfcnpj".$cliente->getCpfcnpj();exit();
        
        $sql = 'INSERT INTO fornecedor (vendedor_idvendedor, descricao, cnpj, ie, endereco, bairro, numero, cep, cidade, estado, telefone, telefone2, telefone3, telefone4, email, website)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
  
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1, $cliente->getIDVendedor(), PDO::PARAM_INT);
    $stmt->bindParam(2, $cliente->getNome(),       PDO::PARAM_STR);
    $stmt->bindParam(3, $cliente->getCnpj(),       PDO::PARAM_STR);
    $stmt->bindParam(4, $cliente->getIe(),         PDO::PARAM_STR);
    $stmt->bindParam(5, $cliente->getEndereco(),   PDO::PARAM_STR);
    $stmt->bindParam(6, $cliente->getBairro(),     PDO::PARAM_STR);
    $stmt->bindParam(7, $cliente->getNumero(),     PDO::PARAM_STR);
    $stmt->bindParam(8, $cliente->getCep(),        PDO::PARAM_STR);
    $stmt->bindParam(9, $cliente->getCidade(),     PDO::PARAM_STR);
    $stmt->bindParam(10,$cliente->getUf(),         PDO::PARAM_STR);
    $stmt->bindParam(11,$cliente->getTelres(),     PDO::PARAM_STR);
    $stmt->bindParam(12,$cliente->getTelcom(),     PDO::PARAM_STR);
    $stmt->bindParam(13,$cliente->getCelres(),     PDO::PARAM_STR);
    $stmt->bindParam(14,$cliente->getCelcom(),     PDO::PARAM_STR);
    $stmt->bindParam(15,$cliente->getEmail(),      PDO::PARAM_STR);
    $stmt->bindParam(16,$cliente->getSite(),       PDO::PARAM_STR);
    
    
    if($stmt->execute()){
     $msg = 'Fornecedor cadastrado com sucesso!' ;
    }else{
      $msg = 'Falha ao tentar cadastrar Fornecedor'; 
    }
    self::message($msg);
    }

    public function update(modelFornecedor $cliente){
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
    $sql = 'UPDATE fornecedor set vendedor_idvendedor = ?, descricao = ?, cnpj = ?, ie = ?, endereco = ?, bairro = ?, numero = ?, 
        cep = ?, cidade = ?, estado = ?, telefone = ?, telefone2 = ?, telefone3 = ?, telefone4 = ?, email = ?, website = ?  WHERE idfornecedor = ?';
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1, $cliente->getIDVendedor(), PDO::PARAM_INT);
    $stmt->bindParam(2, $cliente->getNome(),       PDO::PARAM_STR);
    $stmt->bindParam(3, $cliente->getCnpj(),       PDO::PARAM_STR);
    $stmt->bindParam(4, $cliente->getIe(),         PDO::PARAM_STR);
    $stmt->bindParam(5, $cliente->getEndereco(),   PDO::PARAM_STR);
    $stmt->bindParam(6, $cliente->getBairro(),     PDO::PARAM_STR);
    $stmt->bindParam(7, $cliente->getNumero(),     PDO::PARAM_STR);
    $stmt->bindParam(8, $cliente->getCep(),        PDO::PARAM_STR);
    $stmt->bindParam(9, $cliente->getCidade(),     PDO::PARAM_STR);
    $stmt->bindParam(10,$cliente->getUf(),         PDO::PARAM_STR);
    $stmt->bindParam(11,$cliente->getTelres(),     PDO::PARAM_STR);
    $stmt->bindParam(12,$cliente->getTelcom(),     PDO::PARAM_STR);
    $stmt->bindParam(13,$cliente->getCelres(),     PDO::PARAM_STR);
    $stmt->bindParam(14,$cliente->getCelcom(),     PDO::PARAM_STR);
    $stmt->bindParam(15,$cliente->getEmail(),      PDO::PARAM_STR);
    $stmt->bindParam(16,$cliente->getSite(),       PDO::PARAM_STR);
    $stmt->bindParam(17,$cliente->getIDFornecedor(),       PDO::PARAM_INT);
    
    $rs = $stmt->execute();
    $msg = $rs === TRUE ? 'Fornecedor atualizado com sucesso!' : 'Falha ao tentar atualizar Fornecedor'; //simples comparação para saber se deu certo ou não a execução do sql
    self::message($msg);
    }

    public function delete(GrupoProduto $pessoa) {
        $sql = 'DELETE FROM grupo WHERE idgrupo = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getIDGrupo(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        //$msg = $rs === TRUE ? 'Grupo deletado com sucesso!' : 'Falha na exclusão do Grupo.';
        //self::message($msg);
    }

    public function select(modelFornecedor $for) {
        $sql = 'SELECT * FROM fornecedor WHERE idfornecedor = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $for->getIDFornecedor(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
        $for->setIDFornecedor($rs->idfornecedor);
        $for->setIDVendedor($rs->vendedor_idvendedor);
        $for->setCnpj($rs->cnpj);
        $for->setIe($rs->ie);
        $for->setNome($rs->descricao);
        $for->setEndereco($rs->endereco);
        $for->setBairro($rs->bairro);
        $for->setCep($rs->cep);
        $for->setCidade($rs->cidade);
        $for->setUf($rs->estado);
        $for->setTelres($rs->telefone);
        $for->setCelres($rs->telefone3);
        $for->setTelcom($rs->telefone2);
        $for->setCelcom($rs->telefone4);
        $for->setEmail($rs->email);
        $for->setSite($rs->website);
        $for->setNumero($rs->numero);
        
            
        }
        return $for;
    }

    public function selectAll() {
        $sql = 'SELECT * FROM fornecedor';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $fornecedor = new modelFornecedor();
                $fornecedor->setNome  ($ln->descricao);
                $fornecedor->setCidade ($ln->cidade);
                $fornecedor->setUf($ln->estado);
                $fornecedor->setIDFornecedor($ln->idfornecedor);
                
                print_r( "<tr>
<td align='center'><a href=". "javascript:mudaConteudo('app/view/forFornecedor.php?idfornecedor=".$fornecedor->getIDFornecedor()."')"."><img src='resources/images/lapis_alterar.png' title='Alterar Descricao Vendedor'/></a></td>                 
<td>".$fornecedor->getNome()."</td>
                 <td>".$fornecedor->getCidade()."</td>
                 <td>".$fornecedor->getUf()."</td>    
                 
                 </tr>");
                
                
                $grupo[] = $vendedor;
            }
        }
        
    }
    public function selectSEL() {
        $sql = 'SELECT idvendedor,nome FROM vendedor';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $vendedor = new modelVendedor();
                $vendedor->setIDVendedor($ln->idvendedor);
                $vendedor->setNome($ln->nome);
                
                print_r( "<option value=".$vendedor->getIDVendedor().">".$vendedor->getNome()."</option>");
                
                
                $grupo[] = $vendedor;
            }
        }
        
        }

    private function message($msg) { //imprime a mensagem na tela
        echo $msg;
    }

}

?>
