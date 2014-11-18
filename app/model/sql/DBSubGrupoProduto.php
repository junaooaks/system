<?php

class DBSubGrupoProduto {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function insert(SubGrupoProduto $pessoa) {
        //  echo $pessoa->getSubGrupo();
        $sql = 'INSERT INTO subgrupo (grupo_idgrupo, descricaoSubGrupo) VALUES (?,?)';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getIDSubGrupo(), PDO::PARAM_INT);
        $stmt->bindParam(2, $pessoa->getSubGrupo(), PDO::PARAM_STR);



        if ($stmt->execute()) {
            $msg = 'Sub-Grupo cadastrado com sucesso!';
        } else {
            $msg = 'Falha ao tentar cadastrar Sub-Grupo';
        }
        self::message($msg);
    }

    public function update(SubGrupoProduto $pessoa) {
        $sql = 'UPDATE subgrupo set descricaoSubGrupo = ? WHERE idsubgrupo = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getSubGrupo(), PDO::PARAM_STR);
        $stmt->bindParam(2, $pessoa->getIDSubGrupo(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        $msg = $rs === TRUE ? 'Sub-Grupo atualizado com sucesso!' : 'Falha ao tentar atualizar Sub-Grupo'; //simples comparação para saber se deu certo ou não a execução do sql
        
        self::message($msg);
        
    }

    public function delete(SubGrupoProduto $pessoa) {
        $sql = 'DELETE FROM subgrupo WHERE idsubgrupo = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getIDSubGrupo(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        //$msg = $rs === TRUE ? 'Grupo deletado com sucesso!' : 'Falha na exclusão do Grupo.';
        //self::message($msg);
    }
    
    public function selectSUB(SubGrupoProduto $sub) {
        
        $sql = 'SELECT * FROM subgrupo WHERE idsubgrupo = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $sub->getIDSubGrupo(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $sub->setSubGrupo($rs->descricaoSubGrupo);
            
        }
        return $sub;
    }
    
    public function select(SubGrupoProduto $pessoa) {
        $sql = 'SELECT * FROM subgrupo WHERE grupo_idgrupo = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getIDGrupo(), PDO::PARAM_INT);
        $stmt->execute();
        
        
            while ($ln = $stmt->fetch(PDO::FETCH_OBJ)) {
                $pessoa = new SubGrupoProduto();
                $pessoa->setSubGrupo  ($ln->descricaoSubGrupo);
                $pessoa->setIDSubGrupo($ln->idsubgrupo);
                $pessoa->setIDGrupo   ($ln->grupo_idgrupo);
               
                print_r("<tr>
                 <td>" . $pessoa->getIDSubGrupo() . "</td>
                 <td>" . $pessoa->getSubGrupo() . "</td>
                 <td align='center'><a href=" . "javascript:mudaConteudo('app/view/forSubGrupoCliente.php?idsubgrupo=" . $pessoa->getIDSubGrupo() . "&"."idgrupo=" . $pessoa->getIDGrupo() ."')><img src='resources/images/lapis_alterar.png' title='Alterar Descricao Sub-Grupo'/></a></td>
                 <td align='center'><a href='javascript:;' onClick='confirma(" .$pessoa->getIDSubGrupo()."," .$pessoa->getIDGrupo(). ")'><img src='resources/images/excluir.png' title='Excluir Sub-Grupo'/></a></td>
                 
                 </tr>");


                $grupo[] = $pessoa;
            }
        
      /*  if (!is_array($grupo)) {
            throw new PDOException('Nenhum registro foi encontrado');
        }*/
        return $grupo;
    }

    private function message($msg) { //imprime a mensagem na tela
        echo $msg;
    }

}

?>
