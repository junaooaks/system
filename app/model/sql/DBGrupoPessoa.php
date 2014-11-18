<?php

class DBGrupoPessoa {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function insert(GrupoPessoa $pessoa) {

        $sql = 'INSERT INTO tipopessoa (descricao) VALUES (?)';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getGrupo(), PDO::PARAM_STR);



        if ($stmt->execute()) {
            $msg = 'Grupo cadastrado com sucesso!';
        } else {
            $msg = 'Falha ao tentar cadastrar Grupo';
        }
        self::message($msg);
    }

    public function update(GrupoPessoa $pessoa) {
        $sql = 'UPDATE tipopessoa set descricao = ? WHERE idtipoPessoa = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getGrupo(), PDO::PARAM_STR);
        $stmt->bindParam(2, $pessoa->getIDGrupo(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        $msg = $rs === TRUE ? 'Grupo atualizado com sucesso!' : 'Falha ao tentar atualizar Grupo'; //simples comparação para saber se deu certo ou não a execução do sql
        self::message($msg);
    }

    public function delete(GrupoPessoa $pessoa) {
        $sql = 'DELETE FROM tipopessoa WHERE idtipoPessoa = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getIDGrupo(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        //$msg = $rs === TRUE ? 'Grupo deletado com sucesso!' : 'Falha na exclusão do Grupo.';
        //self::message($msg);
    }

    public function select(GrupoPessoa $pessoa) {
        $sql = 'SELECT idtipoPessoa,descricao FROM tipopessoa WHERE idtipoPessoa = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getIDGrupo(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $pessoa->setGrupo($rs->descricao);
            
        }
        return $pessoa;
    }

    public function selectAll() {
        $sql = 'SELECT idtipoPessoa,descricao FROM tipopessoa';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $pessoa = new GrupoPessoa();
                $pessoa->setGrupo($ln->descricao);
                $pessoa->setIDGrupo($ln->idtipoPessoa);
                
                print_r( "<tr>
                 <td>".$pessoa->getIDGrupo()."</td>
                 <td>".$pessoa->getGrupo()."</td>
                 <td align='center'><a href=". "javascript:mudaConteudo('app/view/forGrupoCliente.php?idgrupo=".$pessoa->getIDGrupo()."')"."><img src='resources/images/lapis_alterar.png' title='Alterar Descricao Grupo'/></a></td>
                 <td align='center'><a href='javascript:;' onClick='confirma(".$pessoa->getIDGrupo().")'><img src='resources/images/excluir.png' title='Excluir Grupo'/></a></td>
                 <td align='center'><a href=". "javascript:mudaConteudo('app/view/forSubGrupoCliente.php?idgrupo=".$pessoa->getIDGrupo()."')"."><img src='resources/images/sub.png' title='Inserir SubGrupo'/></a></td>
                 </tr>");
                
                
                $grupo[] = $pessoa;
            }
        }
        if (!is_array($grupo)) {
            throw new PDOException('Nenhum registro foi encontrado');
        }
        return $grupo;
    }

    private function message($msg) { //imprime a mensagem na tela
        echo $msg;
    }

}

?>
