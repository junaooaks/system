<?php

class DBGrupoProduto {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function insert(GrupoProduto $pessoa) {

        $sql = 'INSERT INTO grupo (descricao, comissao) VALUES (?,?)';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getGrupo(), PDO::PARAM_STR);
        $stmt->bindParam(2, $pessoa->getComissao(), PDO::PARAM_STR);



        if ($stmt->execute()) {
            $msg = 'Grupo cadastrado com sucesso!';
        } else {
            $msg = 'Falha ao tentar cadastrar Grupo';
        }
        self::message($msg);
    }

    public function update(GrupoProduto $pessoa) {
        $sql = 'UPDATE grupo set descricao = ?, comissao=? WHERE idGrupo = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getGrupo(), PDO::PARAM_STR);
        $stmt->bindParam(2, $pessoa->getComissao(), PDO::PARAM_STR);
        $stmt->bindParam(3, $pessoa->getIDGrupo(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        $msg = $rs === TRUE ? 'Grupo atualizado com sucesso!' : 'Falha ao tentar atualizar Grupo'; //simples comparação para saber se deu certo ou não a execução do sql
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

    public function select(GrupoProduto $pessoa) {
        $sql = 'SELECT * FROM grupo WHERE idgrupo = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getIDGrupo(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $pessoa->setGrupo($rs->descricao);
            $pessoa->setComissao($rs->comissao);
            
        }
        return $pessoa;
    }

    public function selectAll() {
        $sql = 'SELECT * FROM grupo';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $pessoa = new GrupoProduto();
                $pessoa->setGrupo   ($ln->descricao);
                $pessoa->setIDGrupo ($ln->idgrupo);
                $pessoa->setComissao($ln->comissao);
                
                print_r( "<tr>
                 <td>".$pessoa->getIDGrupo()."</td>
                 <td>".$pessoa->getGrupo()."</td>
                 <td>".$pessoa->getComissao()."</td>    
                 <td align='center'><a href=". "javascript:mudaConteudo('app/view/forGrupoProduto.php?idgrupo=".$pessoa->getIDGrupo()."')"."><img src='resources/images/lapis_alterar.png' title='Alterar Descricao Grupo'/></a></td>
                 <td align='center'><a href='javascript:;' onClick='confirma(".$pessoa->getIDGrupo().")'><img src='resources/images/excluir.png' title='Excluir Grupo'/></a></td>
                 <td align='center'><a href=". "javascript:mudaConteudo('app/view/forSubGrupoCliente.php?idgrupo=".$pessoa->getIDGrupo()."')"."><img src='resources/images/sub.png' title='Inserir SubGrupo'/></a></td>
                 </tr>");
                
                
                $grupo[] = $pessoa;
            }
        }
        
    }

    private function message($msg) { //imprime a mensagem na tela
        echo $msg;
    }

}

?>
