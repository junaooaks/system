<?php

class DBOperacao {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function insert(modelOperacao $medida) {

        $sql = 'INSERT INTO operacao (descricao, entradaSaida, geraFinanceiro, geraComissao) VALUES (?,?,?,?)';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $medida->getDescricao(), PDO::PARAM_STR);
        $stmt->bindParam(2, $medida->getTipo(),        PDO::PARAM_STR);
        $stmt->bindParam(3, $medida->getFinanca(),        PDO::PARAM_STR);
        $stmt->bindParam(4, $medida->getComissao(),   PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            $msg = 'Operação cadastrado com sucesso!';
        } else {
            $msg = 'Falha ao tentar cadastrar Operação';
        }
        self::message($msg);
    }

    public function update(modelOperacao $medida) {
        $sql = 'UPDATE operacao set descricao = ?, entradaSaida = ?, geraFinanceiro = ?, geraComissao = ? WHERE idoperacao = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $medida->getDescricao(),  PDO::PARAM_STR);
        $stmt->bindParam(2, $medida->getTipo(),         PDO::PARAM_STR);
        $stmt->bindParam(3, $medida->getFinanca(),         PDO::PARAM_STR);
        $stmt->bindParam(4, $medida->getComissao(),    PDO::PARAM_STR);
        $stmt->bindParam(5, $medida->getIDOperacao(),   PDO::PARAM_INT);
        $rs = $stmt->execute();
        $msg = $rs === TRUE ? 'Operacao atualizado com sucesso!' : 'Falha ao tentar atualizar Operação'; //simples comparação para saber se deu certo ou não a execução do sql
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

    public function select(modelOperacao $medida) {
        $sql = 'SELECT * FROM operacao WHERE idoperacao = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $medida->getIDOperacao(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $medida->setDescricao($rs->descricao);
            $medida->setIDOperacao($rs->idoperacao);
            $medida->setComissao($rs->geraComissao);
            $medida->setFinanca($rs->geraFinanceiro);
            $medida->setTipo($rs->entradaSaida);
            
        }
        return $medida;
    }

    public function selectAll() {
        $sql = 'SELECT * FROM operacao';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $medida = new modelOperacao();
                
                $medida->setDescricao($ln->descricao);
                $medida->setIDOperacao($ln->idoperacao);
                $medida->setComissao($ln->geraComissao);
                $medida->setFinanca($ln->geraFinanceiro);
                $medida->setTipo($ln->entradaSaida);
                
                $tipo = $medida->getTipo();
                
                if($tipo=='e'){$tipo='ENTRADA';}else{$tipo='SAIDA';}
                
                print_r( "<tr>
                 <td>".$medida->getIDOperacao()."</td>
                 <td>".$medida->getDescricao()."</td>
                 <td>".$medida->getFinanca()."</td>
                 <td>".$medida->getComissao()."</td>
                 <td>".$tipo."</td>
                 <td align='center'><a href="."javascript:mudaConteudo('app/view/forOperacao.php?idoperacao=".$medida->getIDOperacao()."')"."><img src='resources/images/lapis_alterar.png' title='Alterar Descricao Grupo'/></a></td>
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
