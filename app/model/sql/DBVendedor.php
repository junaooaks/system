<?php

class DBVendedor {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function insert(modelVendedor $vendedor){
   /* echo "ESTADO ".$vendedor->getUf().
         " NOME ".$vendedor->getNome().
         " CPF ".$vendedor->getCpfcnpj().
         " IDENTIDADE ".$vendedor->getIdentidade().
         " SEXO ".$vendedor->getSexo().
         " Email ".$vendedor->getEmail().
         " SITE ".$vendedor->getSite().   
         " ENDERECO ".$vendedor->getEndereco().
         " NUMERO ".$vendedor->getNumero().
         " BAIRRO ".$vendedor->getBairro().
         " CIDADE ".$vendedor->getCidade().
         " cep ".$vendedor->getCep().
         " COMPLEMENTP ".$vendedor->getComplementar().
         " data nas ".$vendedor->getDatanascimento().
         " tel1 ".$vendedor->getTelcom().
         " telres ".$vendedor->getTelres().
            " celres ".$vendedor->getCelres().
            " celcom ".$vendedor->getCelcom().
         "";exit();*/
        
        //echo "cpfcnpj".$cliente->getCpfcnpj();exit();
        
        $sql = 'INSERT INTO vendedor (nome, cpfCnpj, identidade, endereco, complementar, numero, bairro, cep, cidade, estado, telefone1, telefone2, telefone3, telefone4, email, websitePessoal, sexo, nascimento)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
  
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1, $vendedor->getNome(),     PDO::PARAM_STR);
    $stmt->bindParam(2, $vendedor->getCpfcnpj(),     PDO::PARAM_STR);
    $stmt->bindParam(3, $vendedor->getIdentidade(),  PDO::PARAM_STR);
    $stmt->bindParam(4, $vendedor->getEndereco(),  PDO::PARAM_STR);
    $stmt->bindParam(5, $vendedor->getComplementar(),        PDO::PARAM_STR);
    $stmt->bindParam(6, $vendedor->getNumero(),        PDO::PARAM_STR);
    $stmt->bindParam(7, $vendedor->getBairro(),    PDO::PARAM_STR);
    $stmt->bindParam(8, $vendedor->getCep(),    PDO::PARAM_STR);
    $stmt->bindParam(9, $vendedor->getCidade(),      PDO::PARAM_STR);
    $stmt->bindParam(10, $vendedor->getUf(),PDO::PARAM_STR);
    $stmt->bindParam(11,$vendedor->getTelres(),      PDO::PARAM_STR);
    $stmt->bindParam(12,$vendedor->getCelres(),         PDO::PARAM_STR);
    $stmt->bindParam(13,$vendedor->getTelcom(),      PDO::PARAM_STR);
    $stmt->bindParam(14,$vendedor->getCelcom(),          PDO::PARAM_STR);
    $stmt->bindParam(15,$vendedor->getEmail(),          PDO::PARAM_STR);
    $stmt->bindParam(16,$vendedor->getSite(),          PDO::PARAM_STR);
    $stmt->bindParam(17,$vendedor->getSexo(),          PDO::PARAM_STR);
    $stmt->bindParam(18,$vendedor->getDatanascimento(),          PDO::PARAM_STR);
    
    if($stmt->execute()){
     $msg = 'Vendedor cadastrado com sucesso!' ;
    }else{
      $msg = 'Falha ao tentar cadastrar Vendedor'; 
    }
    self::message($msg);
    }

    public function update(modelVendedor $vendedor){
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
    $sql = 'UPDATE vendedor set nome = ?, cpfCnpj = ?, identidade = ?, endereco = ?, complementar = ?, numero = ?, bairro = ?, 
        cep = ?, cidade = ?, estado = ?, telefone1 = ?, telefone2 = ?, telefone3 = ?, telefone4 = ?, email = ?, 
        websitePessoal = ?, sexo = ?, nascimento = ?  WHERE idVendedor = ?';
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1, $vendedor->getNome(),     PDO::PARAM_STR);
    $stmt->bindParam(2, $vendedor->getCpfcnpj(),     PDO::PARAM_STR);
    $stmt->bindParam(3, $vendedor->getIdentidade(),  PDO::PARAM_STR);
    $stmt->bindParam(4, $vendedor->getEndereco(),        PDO::PARAM_STR);
    $stmt->bindParam(5, $vendedor->getComplementar(),        PDO::PARAM_STR);
    $stmt->bindParam(6, $vendedor->getNumero(),    PDO::PARAM_STR);
    $stmt->bindParam(7, $vendedor->getBairro(),    PDO::PARAM_STR);
    $stmt->bindParam(8, $vendedor->getCep(),      PDO::PARAM_STR);
    $stmt->bindParam(9, $vendedor->getCidade(),PDO::PARAM_STR);
    $stmt->bindParam(10, $vendedor->getUf(),      PDO::PARAM_STR);
    $stmt->bindParam(11,$vendedor->getTelres(),         PDO::PARAM_STR);
    $stmt->bindParam(12,$vendedor->getCelres(),      PDO::PARAM_STR);
    $stmt->bindParam(13,$vendedor->getTelcom(),          PDO::PARAM_STR);
    $stmt->bindParam(14,$vendedor->getCelcom(),          PDO::PARAM_STR);
    $stmt->bindParam(15,$vendedor->getEmail(),          PDO::PARAM_STR);
    $stmt->bindParam(16,$vendedor->getSite(),          PDO::PARAM_STR);
    $stmt->bindParam(17,$vendedor->getSexo(),          PDO::PARAM_STR);
    $stmt->bindParam(18,$vendedor->getDatanascimento(),           PDO::PARAM_STR);
    $stmt->bindParam(19,$vendedor->getIDVendedor(),  PDO::PARAM_STR);
    
    $rs = $stmt->execute();
    $msg = $rs === TRUE ? 'Vendedor atualizado com sucesso!' : 'Falha ao tentar atualizar Vendedor'; //simples comparação para saber se deu certo ou não a execução do sql
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

    public function select(modelVendedor $vendedor) {
        $sql = 'SELECT * FROM vendedor WHERE idvendedor = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $vendedor->getIDVendedor(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
        $vendedor->setIDVendedor($rs->idvendedor);
        $vendedor->setCpfcnpj($rs->cpfCnpj);
        $vendedor->setIdentidade($rs->identidade);
        $vendedor->setNome($rs->nome);
        $vendedor->setEndereco($rs->endereco);
        $vendedor->setSexo($rs->sexo);
        $vendedor->setNumero($rs->numero);
        $vendedor->setComplementar($rs->complementar);
        $vendedor->setBairro($rs->bairro);
        $vendedor->setCep($rs->cep);
        $vendedor->setCidade($rs->cidade);
        $vendedor->setUf($rs->estado);
        $vendedor->setTelcom($rs->telefone3);
        $vendedor->setTelres($rs->telefone1);
        $vendedor->setCelcom($rs->telefone4);
        $vendedor->setCelres($rs->telefone2);
        $vendedor->setEmail($rs->email);
        $vendedor->setDatanascimento($rs->nascimento);
        $vendedor->setSite($rs->websitePessoal);
        
            
        }
        return $vendedor;
    }

    public function selectAll() {
        $sql = 'SELECT * FROM vendedor';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $vendedor = new modelVendedor();
                $vendedor->setNome   ($ln->nome);
                $vendedor->setCidade ($ln->cidade);
                $vendedor->setUf($ln->estado);
                $vendedor->setIDVendedor($ln->idvendedor);
                
                print_r( "<tr>
<td align='center'><a href=". "javascript:mudaConteudo('app/view/forVendedor.php?idvendedor=".$vendedor->getIDVendedor()."')"."><img src='resources/images/lapis_alterar.png' title='Alterar Descricao Vendedor'/></a></td>                 
<td>".$vendedor->getNome()."</td>
                 <td>".$vendedor->getCidade()."</td>
                 <td>".$vendedor->getUf()."</td>    
                 
                 </tr>");
                
                
                $grupo[] = $vendedor;
            }
        }
        
    }
    public function selectSEL($idvendedor) {
        $sql = 'SELECT idvendedor,nome FROM vendedor';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $vendedor = new modelVendedor();
                $vendedor->setIDVendedor($ln->idvendedor);
                $vendedor->setNome($ln->nome);
                
                if(!empty($idvendedor)){
                    if($idvendedor==$vendedor->getIDVendedor()){
                    print_r("<option value=".$vendedor->getIDVendedor()." selected>".$vendedor->getNome()."</option>");
                    }
                    
                    }
                if($idvendedor<>$vendedor->getIDVendedor()){
                 print_r( "<option value=".$vendedor->getIDVendedor().">".$vendedor->getNome()."</option>");
                }
                
                $grupo[] = $vendedor;
            }
        }
        
        }

    private function message($msg) { //imprime a mensagem na tela
        echo $msg;
    }

}

?>
