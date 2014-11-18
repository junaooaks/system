<?php

class DBContaBanco {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function insert(modelContaBanco $medida) {

        $sql = 'INSERT INTO contabanco (banco, agencia, contaCorrente, titular) VALUES (?,?,?,?)';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $medida->getBanco(),    PDO::PARAM_STR);
        $stmt->bindParam(2, $medida->getAgencia(),  PDO::PARAM_STR);
        $stmt->bindParam(3, $medida->getConta(),    PDO::PARAM_STR);
        $stmt->bindParam(4, $medida->getTitular(),  PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            $msg = 'Conta Bancaria cadastrado com sucesso!';
        } else {
            $msg = 'Falha ao tentar cadastrar Conta Bancaria';
        }
        self::message($msg);
    }

    public function update(modelContaBanco $medida) {
        $sql = 'UPDATE contabanco set banco=?, agencia=?, contaCorrente=?, titular=? WHERE idcontaBanco = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $medida->getBanco(),    PDO::PARAM_STR);
        $stmt->bindParam(2, $medida->getAgencia(),  PDO::PARAM_STR);
        $stmt->bindParam(3, $medida->getConta(),    PDO::PARAM_STR);
        $stmt->bindParam(4, $medida->getTitular(),  PDO::PARAM_STR);
        $stmt->bindParam(5, $medida->getIDBanco(),  PDO::PARAM_INT);
        $rs = $stmt->execute();
        $msg = $rs === TRUE ? 'Conta Bancaria atualizado com sucesso!' : 'Falha ao tentar atualizar Conta Bancaria'; //simples comparação para saber se deu certo ou não a execução do sql
        self::message($msg);
    }

    public function delete(UnidadeMedida $unidade) {
        $sql = 'DELETE FROM unidade WHERE idunidade = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $unidade->getIDUnidade(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        //$msg = $rs === TRUE ? 'Grupo deletado com sucesso!' : 'Falha na exclusão do Grupo.';
        //self::message($msg);
    }

    public function select(modelContaBanco $medida) {
       
        $sql = 'SELECT * FROM contaBanco WHERE idcontaBanco = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $medida->getIDBanco(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $medida->setBanco($rs->banco);
            $medida->setIDBanco($rs->idcontaBanco);
            $medida->setAgencia($rs->agencia);
            $medida->setTitular($rs->titular);
            $medida->setConta($rs->contaCorrente);
            
        }
        return $medida;
    }

    public function selectAll() {
        $sql = 'SELECT * FROM contaBanco';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $medida = new modelContaBanco();
                
                $medida->setBanco($ln->banco);
                $medida->setIDBanco($ln->idcontaBanco);
                $medida->setAgencia($ln->agencia);
                $medida->setTitular($ln->titular);
                
                print_r( "<tr>
                 <td>".$medida->getIDBanco()."</td>
                 <td>".$medida->getBanco()."</td>
                 <td>".$medida->getAgencia()."</td>
                 <td>".$medida->getTitular()."</td>
                 <td align='center'><a href="."javascript:mudaConteudo('app/view/forContaBanco.php?idbanco=".$medida->getIDBanco()."')"."><img src='resources/images/lapis_alterar.png' title='Alterar Descricao Banco'/></a></td>
                 
                 </tr>");
                
                
               
                
                
                
                
                $unidade[] = $medida;
            }
        }
        
    }

    private function message($msg) { //imprime a mensagem na tela
        echo $msg;
    }

}

?>
