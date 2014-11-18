<?php
class DBSetor {
    private $conex;
    
    public function __construct(){
        $this->conex = new Conexao();
   }
    
    public function insert(modelSetor $cliente){
    /*echo "DESCRICAO ".$cliente->getDescricao().
         " idempresa ".$cliente->getIDEmpresa().
         " comissao ".$cliente->getComissao()."";exit();
      */  
        //echo "cpfcnpj".$cliente->getCpfcnpj();exit();
        
        $sql = 'INSERT INTO setor (empresa_idempresa, descricao, comissao)
                VALUES (?,?,?)';
  
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1,$cliente->getIDEmpresa(), PDO::PARAM_INT);
    $stmt->bindParam(2,$cliente->getDescricao(), PDO::PARAM_STR);
    $stmt->bindParam(3,$cliente->getComissao(),  PDO::PARAM_STR);
    
    
    if($stmt->execute()){
     $msg = 'Setor cadastrado com sucesso!' ;
    }else{
      $msg = 'Falha ao tentar cadastrar Setor'; 
    }
    self::message($msg);
    }
    
    public function update(modelSetor $cliente){
        /* echo "ESTADO ".$cliente->getUf().
         " NOME ".$cliente->getNome().
         " CPF ".$cliente->getCpfcnpj()."";exit();
     */    
    $sql = 'UPDATE setor set descricao = ?, comissao = ? WHERE idsetor = ?';
    $stmt = $this->conex->prepare($sql);
    
    $stmt->bindParam(1, $cliente->getDescricao(),PDO::PARAM_STR);
    $stmt->bindParam(2, $cliente->getComissao(), PDO::PARAM_STR);
    $stmt->bindParam(3, $cliente->getIDSetor(),  PDO::PARAM_INT);
    $rs = $stmt->execute();
    $msg = $rs === TRUE ? 'Setor atualizado com sucesso!' : 'Falha ao tentar atualizar Setor'; //simples comparação para saber se deu certo ou não a execução do sql
    self::message($msg);
    }

    public function delete(modelSetor $setor){
    $sql = 'DELETE FROM setor WHERE idsetor = ?';
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1,$setor->getIDSetor(),PDO::PARAM_INT);
    $rs = $stmt->execute();
    $msg = $rs === TRUE ? 'Setor deletado com sucesso!' : 'Falha na exclusão do Setor.';
    self::message($msg);
    }
    
    public function selectSetor(modelSetor $sub){
      //  echo "id ".$sub->getIDSetor().""; exit ();
    $sql = 'SELECT * FROM setor WHERE idsetor = ?';
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1,$sub->getIDSetor(),PDO::PARAM_INT);
    $stmt->execute();
    $rs = $stmt->fetch(PDO::FETCH_OBJ);
    if(is_object($rs)){
        $sub->setIDSetor($rs->idsetor);
        $sub->setIDEmpresa($rs->empresa_idempresa);
        $sub->setComissao($rs->comissao);
        $sub->setDescricao($rs->descricao);
        
    }
    return $sub;
    }
    
    
    public function select(modelSetor $pessoa){
    $sql = 'SELECT * FROM empresa WHERE idempresa = ?';
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1,$pessoa->getIDEmpresa(),PDO::PARAM_INT);
    $stmt->execute();
    $rs = $stmt->fetch(PDO::FETCH_OBJ);
    if(is_object($rs)){
        $pessoa->setIDEmpresa($rs->idempresa);
        $pessoa->setNome($rs->nome);
        $pessoa->setCnpj($rs->cnpj);
        
    }
    return $pessoa;
    }
    
    
    
    
    public function selectAll(modelSetor $setor){
        
    $sql = 'SELECT * FROM setor WHERE empresa_idempresa = ?';
    $stmt = $this->conex->prepare($sql);
    $stmt->bindParam(1,$setor->getIDEmpresa(),PDO::PARAM_INT);
    $stmt->execute();
    
    
        while($ln = $stmt->fetch(PDO::FETCH_OBJ)){
        $pessoa = new modelSetor();
        $pessoa->setIDEmpresa($ln->empresa_idempresa);
        $pessoa->setDescricao($ln->descricao);
        $pessoa->setComissao ($ln->comissao);
        $pessoa->setIDSetor  ($ln->idsetor);
        
        $comissao = $pessoa->getComissao();
        
        if($comissao=='s'){$comissao = 'SIM';}else{$comissao='NÃO';}
        
        print_r("<tr>
                 <td>".$pessoa->getIDSetor()."</td>
                 <td>".$pessoa->getDescricao()."</td>
                 <td>".$comissao."</td>
                 <td align='center'><a href=" . "javascript:mudaConteudo('app/view/forSetor.php?idsetor=" . $pessoa->getIDSetor() . "&"."idempresa=" . $pessoa->getIDEmpresa() ."')><img src='resources/images/lapis_alterar.png' title='Alterar Descricao Setor'/></a></td>
                 <td align='center'><a href='javascript:;' onClick='confirma(" .$pessoa->getIDSetor()."," .$pessoa->getIDEmpresa(). ")'><img src='resources/images/excluir.png' title='Excluir Setor'/></a></td>
                 </tr>");
        
        $pessoas[] = $pessoa;
        }
        
    //if(!is_array($pessoas)){ throw new PDOException('Nenhum registro foi encontrado');}
    return $pessoas;
    }
    
    
    public function selectEmpresa($empresa) {

        $sql = 'SELECT idempresa,nome,cnpj FROM empresa WHERE idempresa = ?';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $setor = new modelSetor();
                $setor->setNome($ln->nome);
                $setor->setIDEmpresa($ln->idempresa);
                $setor->setCnpj($ln->cnpj);

                $idgrupox = $setor->getIDEmpresa();
                //<option value="CASADO" <?php if ($civil=='CASADO'){echo "selected";}>CASADO 
                if (!empty($idempresa) AND ($idempresa == $idgrupox)) {
                    print_r("<option value=" . $setor->getIDEmpresa() . " selected > " . $setor->getNome() .' --- CNPJ '.$setor->getCnpj(). "</option>");
                } else {
                    print_r("<option value=" . $setor->getIDEmpresa() . " > " . $setor->getNome() .' --- CNPJ '.$setor->getCnpj(). "</option>");
                }

                //print_r("<option value=" . $grupo->getIDGrupo() . " > " . $grupo->getGrupo() . "</option>");
                $grup[] = $grupo;
            }
        }
    }
    
    public function selectEmpresaf(){
    $sql = 'SELECT * FROM empresa';
    $rs = $this->conex->query($sql);
    if($rs){
        while($ln = $rs->fetch(PDO::FETCH_OBJ)){
            $pessoa = new modelSetor();
        $pessoa->setIDEmpresa($ln->idempresa);
        $pessoa->setNome($ln->nome);
        $pessoa->setCnpj($ln->cnpj);
        
        print_r( "<tr>
                 <td align='center'><a href=". "javascript:mudaConteudo('app/view/forSetor.php?idempresa=".$pessoa->getIDEmpresa()."')"."><img src='resources/images/lapis_alterar.png' title='Alterar Pessoa'/></a></td>
                 <td>".$pessoa->getNome()."</td>
                 <td>".$pessoa->getCnpj()."</td>    
                 
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
