<?php

class DBCondicaoPagamento {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function insert(modelCondicaoPagamento $medida) {

        $sql = 'INSERT INTO condicaopagamento (descricao, numeroParcelas, intervaloParcelas, entrada, desconto, acrescimo) VALUES (?,?,?,?,?,?)';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $medida->getDescricao(), PDO::PARAM_STR);
        $stmt->bindParam(2, $medida->getNp(),        PDO::PARAM_STR);
        $stmt->bindParam(3, $medida->getIp(),        PDO::PARAM_STR);
        $stmt->bindParam(4, $medida->getEntrada(),   PDO::PARAM_STR);
        $stmt->bindParam(5, $medida->getDesconto(),  PDO::PARAM_STR);
        $stmt->bindParam(6, $medida->getAcrescimo(), PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            $msg = 'Condicao Pagamento cadastrado com sucesso!';
        } else {
            $msg = 'Falha ao tentar cadastrar Condicao Pagamento';
        }
        self::message($msg);
    }

    public function update(modelCondicaoPagamento $medida) {
        $sql = 'UPDATE condicaopagamento set descricao = ?, numeroParcelas = ?, intervaloParcelas = ?, entrada = ?, desconto = ?, acrescimo = ? WHERE idcondicaoPagamento = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $medida->getDescricao(),  PDO::PARAM_STR);
        $stmt->bindParam(2, $medida->getNp(),         PDO::PARAM_STR);
        $stmt->bindParam(3, $medida->getIp(),         PDO::PARAM_STR);
        $stmt->bindParam(4, $medida->getEntrada(),    PDO::PARAM_STR);
        $stmt->bindParam(5, $medida->getDesconto(),   PDO::PARAM_STR);
        $stmt->bindParam(6, $medida->getAcrescimo(),  PDO::PARAM_STR);
        $stmt->bindParam(7, $medida->getIDCondicao(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        $msg = $rs === TRUE ? 'Condicao de Pagamento atualizado com sucesso!' : 'Falha ao tentar atualizar Condicao de Pagamento'; //simples comparação para saber se deu certo ou não a execução do sql
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

    public function select(modelCondicaoPagamento $medida) {
        $sql = 'SELECT * FROM condicaopagamento WHERE idcondicaoPagamento = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $medida->getIDCondicao(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $medida->setDescricao($rs->descricao);
            $medida->setIDCondicao($rs->idcondicaoPagamento);
            $medida->setNp($rs->numeroParcelas);
            $medida->setIp($rs->intervaloParcelas);
            $medida->setEntrada($rs->entrada);
            $medida->setDesconto($rs->desconto);
            $medida->setAcrescimo($rs->acrescimo);
            
            
        }
        return $medida;
    }

    public function selectAll() {
        $sql = 'SELECT * FROM condicaopagamento';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $medida = new modelCondicaoPagamento();
                
                $medida->setDescricao($ln->descricao);
                $medida->setIDCondicao($ln->idcondicaoPagamento);
                $medida->setNp($ln->numeroParcelas);
                $medida->setIp($ln->intervaloParcelas);
                $medida->setEntrada($ln->entrada);
                $medida->setDesconto($ln->desconto);
                $medida->setAcrescimo($ln->acrescimo);
                
                if($medida->getEntrada()==0){
                    $medida->setEntrada('SIM');
                }else{
                    $medida->setEntrada('NÃO');
                }
                
                print_r( "<tr>
                 <td align='center'><a href="."javascript:mudaConteudo('app/view/forCondicaoPagamento.php?idcondicao=".$medida->getIDCondicao()."')"."><img src='resources/images/lapis_alterar.png' title='Alterar Descricao Grupo'/></a></td>
                 <td>".$medida->getIDCondicao()."</td>
                 <td>".$medida->getDescricao()."</td>
                 <td>".$medida->getNp()."</td>
                 <td>".$medida->getIp()."</td>
                 <td>".$medida->getEntrada()."</td>
                 <td>".$medida->getDesconto()."</td>
                 <td>".$medida->getAcrescimo()."</td>    
                 
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
