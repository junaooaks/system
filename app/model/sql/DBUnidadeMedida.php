<?php

class DBUnidadeMedida {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function insert(UnidadeMedida $medida) {

        $sql = 'INSERT INTO unidade (descricao, sigla) VALUES (?,?)';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $medida->getDescricao(), PDO::PARAM_STR);
        $stmt->bindParam(2, $medida->getSigla(), PDO::PARAM_STR);



        if ($stmt->execute()) {
            $msg = 'Unidade de Medida cadastrado com sucesso!';
        } else {
            $msg = 'Falha ao tentar cadastrar Unidade de Medida';
        }
        self::message($msg);
    }

    public function update(UnidadeMedida $medida) {
        $sql = 'UPDATE unidade set descricao = ?, sigla=? WHERE idunidade = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $medida->getDescricao(), PDO::PARAM_STR);
        $stmt->bindParam(2, $medida->getSigla(), PDO::PARAM_STR);
        $stmt->bindParam(3, $medida->getIDUnidade(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        $msg = $rs === TRUE ? 'Unidade Medida atualizado com sucesso!' : 'Falha ao tentar atualizar Unidade Medida'; //simples comparação para saber se deu certo ou não a execução do sql
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

    public function select(UnidadeMedida $medida) {
        $sql = 'SELECT * FROM unidade WHERE idunidade = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $medida->getIDUnidade(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $medida->setDescricao($rs->descricao);
            $medida->setSigla($rs->sigla);
            
            
        }
        return $medida;
    }

    public function selectAll() {
        $sql = 'SELECT * FROM unidade';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $medida = new UnidadeMedida();
                
                $medida->setDescricao($ln->descricao);
                $medida->setIDUnidade($ln->idunidade);
                $medida->setSigla($ln->sigla);
                
                print_r( "<tr>
                 <td>".$medida->getIDUnidade()."</td>
                 <td>".$medida->getDescricao()."</td>
                 <td>".$medida->getSigla()."</td>    
                 <td align='center'><a href=". "javascript:mudaConteudo('app/view/forUnidadeMedida.php?idunidade=".$medida->getIDUnidade()."')"."><img src='resources/images/lapis_alterar.png' title='Alterar Descricao Grupo'/></a></td>
                 <td align='center'><a href='javascript:;' onClick='confirma(".$medida->getIDUnidade().")'><img src='resources/images/excluir.png' title='Excluir Grupo'/></a></td>
 
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
