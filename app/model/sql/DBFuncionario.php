<?php
class DBFuncionario {
    private $conex;
    
    public function __construct(){
        $this->conex = new Conexao();
   }
    
    public function insert(modelFuncionario $cliente){
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
        
        $sql = 'INSERT INTO funcionario (setor_idsetor, setor_empresa_idempresa, nome, sexo, cpf, identidade,
            pis, email, estadoCivil, dataNascimento, nomePai, nomeMae, endereco, bairro, cep, cidade, uf, 
            numero, telefone, celular1, celuar2, percentualComissao, comissao, profissao)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
  
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1, $cliente->getIDSetor(),         PDO::PARAM_INT);
    $stmt->bindParam(2, $cliente->getEmpresa(),         PDO::PARAM_INT);
    $stmt->bindParam(3, $cliente->getNome(),            PDO::PARAM_STR);
    $stmt->bindParam(4, $cliente->getSexo(),            PDO::PARAM_STR);
    $stmt->bindParam(5, $cliente->getCpf(),             PDO::PARAM_INT);
    $stmt->bindParam(6, $cliente->getIdentidade(),      PDO::PARAM_STR);
    $stmt->bindParam(7, $cliente->getPis(),             PDO::PARAM_STR);
    $stmt->bindParam(8,$cliente->getEmail(),            PDO::PARAM_STR);
    $stmt->bindParam(9,$cliente->getCivil(),            PDO::PARAM_STR);
    $stmt->bindParam(10,$cliente->getDatanascimento(),  PDO::PARAM_STR);
    $stmt->bindParam(11,$cliente->getPai(),             PDO::PARAM_STR);
    $stmt->bindParam(12,$cliente->getMae(),             PDO::PARAM_STR);
    $stmt->bindParam(13, $cliente->getEndereco(),       PDO::PARAM_STR);
    $stmt->bindParam(14, $cliente->getBairro(),         PDO::PARAM_STR);
    $stmt->bindParam(15,$cliente->getCep(),             PDO::PARAM_STR);
    $stmt->bindParam(16,$cliente->getCidade(),          PDO::PARAM_STR);
    $stmt->bindParam(17,$cliente->getUf(),              PDO::PARAM_STR);
    $stmt->bindParam(18, $cliente->getNumero(),         PDO::PARAM_STR);
    $stmt->bindParam(19,$cliente->getTelres(),          PDO::PARAM_STR);
    $stmt->bindParam(20,$cliente->getCelcom(),          PDO::PARAM_STR);
    $stmt->bindParam(21,$cliente->getCelres(),          PDO::PARAM_STR);
    $stmt->bindParam(22,$cliente->getValor(),           PDO::PARAM_STR);
    $stmt->bindParam(23,$cliente->getComissao(),        PDO::PARAM_STR);
    $stmt->bindParam(24,$cliente->getProfissao(),       PDO::PARAM_STR);
    
    if($stmt->execute()){
     $msg = 'Funcionario cadastrado com sucesso!' ;
    }else{
      $msg = 'Falha ao tentar cadastrar Funcionario'; 
    }
    self::message($msg);
    }
    
    public function update(modelFuncionario $cliente){
        //echo "nome".$cliente->getNome(). "id ".$cliente->getIDFuncionario()."" ;
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
    $sql = 'UPDATE funcionario set setor_idsetor = ?, setor_empresa_idempresa = ?, nome = ?, sexo = ?, cpf = ?, identidade = ?, pis = ?, email = ?, estadoCivil = ?, dataNascimento = ?, nomePai = ?, nomeMae = ?, endereco = ?, bairro = ?, cep = ?, cidade = ?, uf = ?, numero = ?, telefone = ?, celular1 = ?, celuar2 = ?, percentualComissao = ?, comissao = ?, profissao = ? WHERE idfuncionario = ?';
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1, $cliente->getIDSetor(),         PDO::PARAM_INT);
    $stmt->bindParam(2, $cliente->getEmpresa(),         PDO::PARAM_INT);
    $stmt->bindParam(3, $cliente->getNome(),            PDO::PARAM_STR);
    $stmt->bindParam(4, $cliente->getSexo(),            PDO::PARAM_STR);
    $stmt->bindParam(5, $cliente->getCpf(),             PDO::PARAM_INT);
    $stmt->bindParam(6, $cliente->getIdentidade(),      PDO::PARAM_STR);
    $stmt->bindParam(7, $cliente->getPis(),             PDO::PARAM_STR);
    $stmt->bindParam(8,$cliente->getEmail(),            PDO::PARAM_STR);
    $stmt->bindParam(9,$cliente->getCivil(),            PDO::PARAM_STR);
    $stmt->bindParam(10,$cliente->getDatanascimento(),  PDO::PARAM_STR);
    $stmt->bindParam(11,$cliente->getPai(),             PDO::PARAM_STR);
    $stmt->bindParam(12,$cliente->getMae(),             PDO::PARAM_STR);
    $stmt->bindParam(13, $cliente->getEndereco(),       PDO::PARAM_STR);
    $stmt->bindParam(14, $cliente->getBairro(),         PDO::PARAM_STR);
    $stmt->bindParam(15,$cliente->getCep(),             PDO::PARAM_STR);
    $stmt->bindParam(16,$cliente->getCidade(),          PDO::PARAM_STR);
    $stmt->bindParam(17,$cliente->getUf(),              PDO::PARAM_STR);
    $stmt->bindParam(18, $cliente->getNumero(),         PDO::PARAM_STR);
    $stmt->bindParam(19,$cliente->getTelres(),          PDO::PARAM_STR);
    $stmt->bindParam(20,$cliente->getCelcom(),          PDO::PARAM_STR);
    $stmt->bindParam(21,$cliente->getCelres(),          PDO::PARAM_STR);
    $stmt->bindParam(22,$cliente->getValor(),           PDO::PARAM_STR);
    $stmt->bindParam(23,$cliente->getComissao(),        PDO::PARAM_STR);
    $stmt->bindParam(24,$cliente->getProfissao(),       PDO::PARAM_STR);
    $stmt->bindParam(25, $cliente->getIDFuncionario(),  PDO::PARAM_INT);
    $rs = $stmt->execute();
    $msg = $rs === TRUE ? 'Funcionario atualizado com sucesso!' : 'Falha ao tentar atualizar Funcionario'; //simples comparação para saber se deu certo ou não a execução do sql
    self::message($msg);
    }

    public function delete(modelFuncionario $pessoa){
    $sql = 'DELETE FROM funcionario WHERE idfuncionario = ?';
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1,$pessoa->getIDFuncionario(),PDO::PARAM_INT);
    $rs = $stmt->execute();
    $msg = $rs === TRUE ? 'Funcionario deletado com sucesso!' : 'Falha na exclusão do Funcionario.';
    self::message($msg);
    }
    
    public function select(modelFuncionario $pessoa){
       
        
    $sql = 'SELECT fun.idfuncionario, fun.setor_idsetor, fun.setor_empresa_idempresa, fun.nome, fun.sexo, fun.cpf, fun.identidade, fun.pis, 
        fun.email, fun.estadoCivil, fun.dataNascimento, fun.nomePai, fun.nomeMae, 
        fun.endereco, fun.bairro, fun.cep, fun.cidade, fun.uf, fun.numero, fun.telefone, fun.celular1, fun.celuar2, 
        fun.percentualComissao, fun.comissao, fun.profissao, se.descricao, emp.nome AS empresa 
        FROM funcionario AS fun, setor AS se, empresa AS emp 
        WHERE fun.idfuncionario = ? 
        ';
    
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1,$pessoa->getIDFuncionario(),PDO::PARAM_INT);
    $stmt->execute();
    $rs = $stmt->fetch(PDO::FETCH_OBJ);
    if(is_object($rs)){
        $pessoa->setIDFuncionario($rs->idfuncionario);
        $pessoa->setIDSetor($rs->setor_idsetor);
        $pessoa->setIDEmpresa($rs->setor_empresa_idempresa);
        $pessoa->setNome($rs->nome);
        $pessoa->setSexo($rs->sexo);
        $pessoa->setCpf($rs->cpf);
        $pessoa->setIdentidade($rs->identidade);
        $pessoa->setPis($rs->pis);
        $pessoa->setEmail($rs->email);
        $pessoa->setCivil($rs->estadoCivil);
        $pessoa->setDatanascimento($rs->dataNascimento);
        $pessoa->setPai($rs->nomePai);
        $pessoa->setMae($rs->nomeMae);
        $pessoa->setEndereco($rs->endereco);
        $pessoa->setBairro($rs->bairro);
        $pessoa->setCep($rs->cep);
        $pessoa->setCidade($rs->cidade);
        $pessoa->setUf($rs->uf);
        $pessoa->setNumero($rs->numero);
        $pessoa->setTelres($rs->telefone);
        $pessoa->setCelcom($rs->celuar2);
        $pessoa->setCelres($rs->celular1);
        $pessoa->setValor($rs->percentualComissao);
        $pessoa->setComissao($rs->comissao);
        $pessoa->setProfissao($rs->profissao);
        $pessoa->setSetor($rs->descricao);
        $pessoa->setEmpresa($rs->empresa);
        
        
    }
    return $pessoa;
    }
    
    public function selectBUSCA(Pessoa $cliente){
    //echo  " NOME ".$cliente->getBusca();exit();
    $sql = 'SELECT idpessoa,nome,endereco,numero, telefoneResidencial, celular1, cidade, estado FROM pessoa WHERE nome =?';
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1,$cliente->getBusca(),PDO::PARAM_STR);
    $stmt->execute();
    $ln = $stmt->fetch(PDO::FETCH_OBJ);
    if(is_object($ln)){
        $cliente->setIDpessoa($ln->idpessoa);
        $cliente->setNome($ln->nome);
        $cliente->setEndereco($ln->endereco);
        $cliente->setNumero($ln->numero);
        $cliente->setTelres($ln->telefoneResidencial);
        $cliente->setCelres($ln->celular1);
        $cliente->setCidade($ln->cidade);
        $cliente->setUf($ln->estado);
        
        print_r( "<tr>
                 <td align='center'><a href=". "javascript:mudaConteudo('app/view/forCliente.php?idpessoa=".$cliente->getIDpessoa()."')"."><img src='resources/images/lapis_alterar.png' title='Alterar Pessoa'/></a></td>
                 <td>".$cliente->getIDpessoa()."</td>
                 <td>".$cliente->getNome()."</td>
                 <td>".$cliente->getEndereco()."</td>
                 <td>".$cliente->getNumero()."</td>
                 <td>".$cliente->getTelres()."</td>
                 <td>".$cliente->getCelres()."</td>
                 <td>".$cliente->getCidade()."</td>
                 <td>".$cliente->getUf()."</td>    
                 </tr>");
        }
    return $cliente;
    }
    
    public function selectAll(){
    $sql = 'SELECT fun.idfuncionario, fun.nome, fun.telefone, fun.celular1, fun.celuar2, se.descricao, emp.nome AS empresa FROM funcionario AS fun, setor AS se, empresa AS emp WHERE fun.setor_idsetor = se.idsetor AND fun.setor_empresa_idempresa = emp.idempresa ';
    $rs = $this->conex->query($sql);
    if($rs){
        while($ln = $rs->fetch(PDO::FETCH_OBJ)){
            $pessoa = new modelFuncionario();
        $pessoa->setIDFuncionario($ln->idfuncionario);
        $pessoa->setNome($ln->nome);
        $pessoa->setTelres($ln->telefone);
        $pessoa->setCelres($ln->celular1);
        $pessoa->setCelcom($ln->celular2);
        $pessoa->setEmpresa($ln->empresa);
        $pessoa->setSetor($ln->descricao);
        
        $pessoa->setUf($ln->estado);
        
        print_r( "<tr>
                 <td align='center'><a href=". "javascript:mudaConteudo('app/view/forFuncionario.php?idfun=".$pessoa->getIDFuncionario()."')"."><img src='resources/images/lapis_alterar.png' title='Alterar Funcionario'/></a></td>
                 <td align='center'><a href=". "javascript:mudaConteudo('app/view/forFuncionarioAcesso.php?idfun=".$pessoa->getIDFuncionario()."')"."><img src='resources/images/acesso.png' title='PERMITIR ACESSO'/></a></td>
                 <td>".$pessoa->getIDFuncionario()."</td>
                 <td>".$pessoa->getNome()."</td>
                 <td>".$pessoa->getTelres()."</td>
                 <td>".$pessoa->getCelres()."</td>
                 <td>".$pessoa->getEmpresa()."</td>
                 <td>".$pessoa->getSetor()."</td> 
                 <td align='center'><a href='javascript:;' onClick='confirma(".$pessoa->getIDFuncionario().")'><img src='resources/images/excluir.png' title='Excluir Funcionario'/></a></td>    
                 </tr>");
        
        $pessoas[] = $pessoa;
        }
    }
    //if(!is_array($pessoas)){ throw new PDOException('Nenhum registro foi encontrado');}
    return $pessoas;
    }
    
    public function selectEmpresa($idempresa) {

        $sql = 'SELECT idempresa,nome FROM empresa';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $grupo = new modelFuncionario();
                $grupo->setEmpresa($ln->nome);
                $grupo->setIDEmpresa($ln->idempresa);

                $idgrupox = $grupo->getIDEmpresa();
                //<option value="CASADO" <?php if ($civil=='CASADO'){echo "selected";}>CASADO 
                if (!empty($idempresa) AND ($idempresa == $idgrupox)) {
                    print_r("<option value=" . $grupo->getIDEmpresa() . " selected > " . $grupo->getEmpresa() . "</option>");
                } else {
                    print_r("<option value=" . $grupo->getIDEmpresa() . " > " . $grupo->getEmpresa() . "</option>");
                }

                //print_r("<option value=" . $grupo->getIDGrupo() . " > " . $grupo->getGrupo() . "</option>");
                $grup[] = $grupo;
            }
        }
    }
    public function selectSetor($idsetor) {

        $sql = 'SELECT idsetor,descricao FROM setor WHERE idsetor = ?';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $idsetor, PDO::PARAM_INT);
        $stmt->execute();

        $ln = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($ln)) {
            $subdes = $ln->descricao;
            $subid = $ln->idsetor;

            print_r("<option value=" . $subid . " selected > " . $subdes . "</option>");

            $su[] = $sub;
        }
    }
    
    private function message($msg){ //imprime a mensagem na tela
    echo $msg;
    }
}

?>
