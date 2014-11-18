<?php
class DBPessoa {
    private $conex;
    
    public function __construct(){
        $this->conex = new Conexao();
   }
    
    public function insert(Pessoa $cliente){
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
        
        $sql = 'INSERT INTO pessoa (tipoPessoa_idtipoPessoa, cpfCnpj, identidateInscricao, nome, sexo, apelidoFantasia, endereco, numero, complemento, bairro, cep, cidade, estado, telefoneComercial, telefoneResidencial, celular1, celular2, email, dataNascimento, nomePai, nomeMae, estadoCivil, profissao, empresa, referencia1, referencia2, referencia3, ativo, obs)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
  
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1, $cliente->getIDGrupo(),     PDO::PARAM_INT);
    $stmt->bindParam(2, $cliente->getCpfcnpj(),     PDO::PARAM_INT);
    $stmt->bindParam(3, $cliente->getIdentidade(),  PDO::PARAM_STR);
    $stmt->bindParam(4, $cliente->getNome(),        PDO::PARAM_STR);
    $stmt->bindParam(5, $cliente->getSexo(),        PDO::PARAM_STR);
    $stmt->bindParam(6, $cliente->getFantasia(),    PDO::PARAM_STR);
    $stmt->bindParam(7, $cliente->getEndereco(),    PDO::PARAM_STR);
    $stmt->bindParam(8, $cliente->getNumero(),      PDO::PARAM_STR);
    $stmt->bindParam(9, $cliente->getComplementar(),PDO::PARAM_STR);
    $stmt->bindParam(10, $cliente->getBairro(),      PDO::PARAM_STR);
    $stmt->bindParam(11,$cliente->getCep(),         PDO::PARAM_STR);
    $stmt->bindParam(12,$cliente->getCidade(),      PDO::PARAM_STR);
    $stmt->bindParam(13,$cliente->getUf(),          PDO::PARAM_STR);
    $stmt->bindParam(14,$cliente->getTelcom(),          PDO::PARAM_STR);
    $stmt->bindParam(15,$cliente->getTelres(),          PDO::PARAM_STR);
    $stmt->bindParam(16,$cliente->getCelcom(),          PDO::PARAM_STR);
    $stmt->bindParam(17,$cliente->getCelres(),          PDO::PARAM_STR);
    $stmt->bindParam(18,$cliente->getEmail(),           PDO::PARAM_STR);
    $stmt->bindParam(19,$cliente->getDatanascimento(),  PDO::PARAM_STR);
    $stmt->bindParam(20,$cliente->getPai(),             PDO::PARAM_STR);
    $stmt->bindParam(21,$cliente->getMae(),             PDO::PARAM_STR);
    $stmt->bindParam(22,$cliente->getCivil(),           PDO::PARAM_STR);
    $stmt->bindParam(23,$cliente->getProfissao(),       PDO::PARAM_STR);
    $stmt->bindParam(24,$cliente->getEmpresa(),         PDO::PARAM_STR);
    
    $stmt->bindParam(25,$cliente->getRef1(),          PDO::PARAM_STR);
    $stmt->bindParam(26,$cliente->getRef2(),          PDO::PARAM_STR);
    $stmt->bindParam(27,$cliente->getRef3(),          PDO::PARAM_STR);
    
    $stmt->bindParam(28,$cliente->getStatus(),          PDO::PARAM_STR);
    $stmt->bindParam(29,$cliente->getObs(),          PDO::PARAM_STR);
    
    if($stmt->execute()){
     $msg = 'Cliente cadastrado com sucesso!' ;
    }else{
      $msg = 'Falha ao tentar cadastrar cliente'; 
    }
    self::message($msg);
    }
    
    public function update(Pessoa $cliente){
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
    $sql = 'UPDATE pessoa set tipoPessoa_idtipoPessoa = ?, cpfCnpj = ?, identidateInscricao = ?, nome = ?, sexo = ?, apelidoFantasia = ?, endereco = ?, numero = ?, complemento = ?, bairro = ?, cep = ?, cidade = ?, estado = ?, telefoneComercial = ?, telefoneResidencial = ?, celular2 = ?, celular1 = ?, email = ?, dataNascimento = ?, nomePai = ?, nomeMae = ?, estadoCivil = ?, profissao = ?, empresa = ?, referencia1=? , referencia2=?, referencia3=?, ativo = ?, obs=? WHERE idPessoa = ?';
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1, $cliente->getIDGrupo(),     PDO::PARAM_INT);
    $stmt->bindParam(2, $cliente->getCpfcnpj(),     PDO::PARAM_INT);
    $stmt->bindParam(3, $cliente->getIdentidade(),  PDO::PARAM_STR);
    $stmt->bindParam(4, $cliente->getNome(),        PDO::PARAM_STR);
    $stmt->bindParam(5, $cliente->getSexo(),        PDO::PARAM_STR);
    $stmt->bindParam(6, $cliente->getFantasia(),    PDO::PARAM_STR);
    $stmt->bindParam(7, $cliente->getEndereco(),    PDO::PARAM_STR);
    $stmt->bindParam(8, $cliente->getNumero(),      PDO::PARAM_STR);
    $stmt->bindParam(9, $cliente->getComplementar(),PDO::PARAM_STR);
    $stmt->bindParam(10, $cliente->getBairro(),      PDO::PARAM_STR);
    $stmt->bindParam(11,$cliente->getCep(),         PDO::PARAM_STR);
    $stmt->bindParam(12,$cliente->getCidade(),      PDO::PARAM_STR);
    $stmt->bindParam(13,$cliente->getUf(),          PDO::PARAM_STR);
    $stmt->bindParam(14,$cliente->getTelcom(),          PDO::PARAM_STR);
    $stmt->bindParam(15,$cliente->getTelres(),          PDO::PARAM_STR);
    $stmt->bindParam(16,$cliente->getCelcom(),          PDO::PARAM_STR);
    $stmt->bindParam(17,$cliente->getCelres(),          PDO::PARAM_STR);
    $stmt->bindParam(18,$cliente->getEmail(),           PDO::PARAM_STR);
    $stmt->bindParam(19,$cliente->getDatanascimento(),  PDO::PARAM_STR);
    $stmt->bindParam(20,$cliente->getPai(),             PDO::PARAM_STR);
    $stmt->bindParam(21,$cliente->getMae(),             PDO::PARAM_STR);
    $stmt->bindParam(22,$cliente->getCivil(),           PDO::PARAM_STR);
    $stmt->bindParam(23,$cliente->getProfissao(),       PDO::PARAM_STR);
    $stmt->bindParam(24,$cliente->getEmpresa(),         PDO::PARAM_STR);
    $stmt->bindParam(25,$cliente->getRef1(),          PDO::PARAM_STR);
    $stmt->bindParam(26,$cliente->getRef2(),          PDO::PARAM_STR);
    $stmt->bindParam(27,$cliente->getRef3(),          PDO::PARAM_STR);
    $stmt->bindParam(28,$cliente->getStatus(),          PDO::PARAM_STR);
    $stmt->bindParam(29,$cliente->getObs(),          PDO::PARAM_STR);
    $stmt->bindParam(30, $cliente->getIDpessoa(),     PDO::PARAM_INT);
    $rs = $stmt->execute();
    $msg = $rs === TRUE ? 'Cliente atualizado com sucesso!' : 'Falha ao tentar atualizar cliente'; //simples comparação para saber se deu certo ou não a execução do sql
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
    
    public function select(Pessoa $pessoa){
    $sql = 'SELECT idpessoa, tipoPessoa_idtipoPessoa, cpfCnpj, identidateInscricao, nome, endereco, sexo, apelidoFantasia, numero, complemento, bairro, cep, cidade, estado, telefoneComercial, telefoneResidencial, celular2, celular1, email, dataNascimento, nomePai, nomeMae, estadoCivil, profissao, empresa, referencia1, referencia2, referencia3, ativo, obs, dataInsert, dataUpdate FROM pessoa WHERE idPessoa = ?';
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1,$pessoa->getIdPessoa(),PDO::PARAM_INT);
    $stmt->execute();
    $rs = $stmt->fetch(PDO::FETCH_OBJ);
    if(is_object($rs)){
        $pessoa->setIDpessoa($rs->idpessoa);
        $pessoa->setIDTipo($rs->tipoPessoa_idtipoPessoa);
        $pessoa->setCpfcnpj($rs->cpfCnpj);
        $pessoa->setIdentidade($rs->identidateInscricao);
        $pessoa->setNome($rs->nome);
        $pessoa->setEndereco($rs->endereco);
        $pessoa->setSexo($rs->sexo);
        $pessoa->setFantasia($rs->apelidoFantasia);
        $pessoa->setNumero($rs->numero);
        $pessoa->setComplementar($rs->complemento);
        $pessoa->setBairro($rs->bairro);
        $pessoa->setCep($rs->cep);
        $pessoa->setCidade($rs->cidade);
        $pessoa->setUf($rs->estado);
        $pessoa->setTelcom($rs->telefoneComercial);
        $pessoa->setTelres($rs->telefoneResidencial);
        $pessoa->setCelcom($rs->celular2);
        $pessoa->setCelres($rs->celular1);
        $pessoa->setEmail($rs->email);
        $pessoa->setDatanascimento($rs->dataNascimento);
        $pessoa->setPai($rs->nomePai);
        $pessoa->setMae($rs->nomeMae);
        $pessoa->setCivil($rs->estadoCivil);
        $pessoa->setProfissao($rs->profissao);
        $pessoa->setEmpresa($rs->empresa);
        $pessoa->setStatus($rs->ativo);
        $pessoa->setDatainsert($rs->dataInsert);
        $pessoa->setDataupdate($rs->dataUpdate);
        $pessoa->setObs($rs->obs);
        $pessoa->setRef1($rs->referencia1);
        $pessoa->setRef2($rs->referencia2);
        $pessoa->setRef3($rs->referencia3);
    }
    return $pessoa;
    }
    
    public function selectBUSCA(Pessoa $cliente){
    //echo  " NOME ".$cliente->getBusca();exit();
        
        $sql = "SELECT idpessoa,nome,endereco,numero, telefoneResidencial, celular1, cidade, estado 
                FROM pessoa WHERE nome LIKE ? ORDER BY nome ASC ";

        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(1, '%'.$cliente->getBusca().'%', PDO::PARAM_STR);
        $stmt->execute();

        
        $arr = array();
while($row = $stmt->fetch(PDO::FETCH_OBJ)) $arr[] = $row;


header('Content-type: application/json');
echo json_encode($arr);

    }
    
    public function selectAll(){
    $sql = 'SELECT idpessoa,nome,endereco,numero, telefoneResidencial, celular1, cidade, estado FROM pessoa LIMIT 30';
    $rs = $this->conex->query($sql);
    if($rs){
        while($ln = $rs->fetch(PDO::FETCH_OBJ)){
            $pessoa = new Pessoa();
        $pessoa->setIDpessoa($ln->idpessoa);
        $pessoa->setNome($ln->nome);
        $pessoa->setEndereco($ln->endereco);
        $pessoa->setNumero($ln->numero);
        $pessoa->setTelres($ln->telefoneResidencial);
        $pessoa->setCelres($ln->celular1);
        $pessoa->setCidade($ln->cidade);
        $pessoa->setUf($ln->estado);
        
        print_r( "<tr>
                 <td align='center'><a href=". "javascript:mudaConteudo('app/view/forCliente.php?idpessoa=".$pessoa->getIDpessoa()."')"."><img src='resources/images/lapis_alterar.png' title='Alterar Pessoa'/></a></td>
                 <td>".$pessoa->getIDpessoa()."</td>
                 <td>".$pessoa->getNome()."</td>
                 <td>".$pessoa->getEndereco()."</td>
                 <td>".$pessoa->getNumero()."</td>
                 <td>".$pessoa->getTelres()."</td>
                 <td>".$pessoa->getCelres()."</td>
                 <td>".$pessoa->getCidade()."</td>
                 <td>".$pessoa->getUf()."</td>   
                 <td align='center'><a href=". "javascript:mudaConteudo('app/view/forFinanceiro.php?idpessoa=".$pessoa->getIDpessoa()."')"."><img src='resources/images/financeiroCliente.png' title='Alterar Pessoa'/></a></td>
                 </tr>");
        
        $pessoas[] = $pessoa;
        }
    }
   /* if(!is_array($pessoas)){ throw new PDOException('Nenhum registro foi encontrado');}*/
    return $pessoas;
    }
    
    private function message($msg){ //imprime a mensagem na tela
    echo $msg;
    }
}

?>
