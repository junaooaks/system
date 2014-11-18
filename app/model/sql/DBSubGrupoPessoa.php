<?php

class DBSubGrupoPessoa {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function insert(SubGrupoPessoa $pessoa) {
        //  echo $pessoa->getSubGrupo();
         $sql = 'INSERT INTO tipopessoa (descricao) VALUES (?)';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getGrupo(), PDO::PARAM_STR);



        if ($stmt->execute()) {
            $msg = 'Sub-Grupo cadastrado com sucesso!';
        } else {
            $msg = 'Falha ao tentar cadastrar Grupo';
        }
        self::message($msg);
    }

    public function update(SubGrupoPessoa $pessoa) {
        $sql = 'UPDATE tipopessoa set descricao = ? WHERE idtipoPessoa = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getGrupo(), PDO::PARAM_STR);
        $stmt->bindParam(2, $pessoa->getIDGrupo(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        $msg = $rs === TRUE ? 'Grupo atualizado com sucesso!' : 'Falha ao tentar atualizar Grupo'; //simples comparação para saber se deu certo ou não a execução do sql
        self::message($msg);
    }

    public function delete(SubGrupoPessoa $pessoa) { 
        //echo $pessoa->getIDGrupo();exit();
        $sql = 'DELETE FROM tipopessoa WHERE idtipoPessoa = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getIDGrupo(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        //$msg = $rs === TRUE ? 'Grupo deletado com sucesso!' : 'Falha na exclusão do Grupo.';
        //self::message($msg);
    }
    
    
    
    public function selectSUB(SubGrupoPessoa $sub) {
        
        $sql = 'SELECT idtipoPessoa, descricao FROM tipopessoa WHERE idtipoPessoa = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $sub->getIDSubGrupo(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $sub->setGrupo($rs->descricao);
            
        }
        return $sub;
    }
    
    public function select(SubGrupoPessoa $pessoa) {
        $sql = 'SELECT idtiposubpessoa, descricao,tipoPessoa_idtipoPessoa FROM tiposubpessoa WHERE tipoPessoa_idtipoPessoa = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getIDGrupo(), PDO::PARAM_INT);
        $stmt->execute();
        
        
            while ($ln = $stmt->fetch(PDO::FETCH_OBJ)) {
                $pessoa = new SubGrupoPessoa();
                $pessoa->setSubGrupo  ($ln->descricao);
                $pessoa->setIDSubGrupo($ln->idtiposubpessoa);
                $pessoa->setIDGrupo   ($ln->tipoPessoa_idtipoPessoa);
               
                print_r("<tr>
                 <td>" . $pessoa->getIDSubGrupo() . "</td>
                 <td>" . $pessoa->getSubGrupo() . "</td>
                 <td align='center'><a href=" . "javascript:mudaConteudo('app/view/forSubGrupoCliente.php?idsubgrupo=" . $pessoa->getIDSubGrupo() . "&"."idgrupo=" . $pessoa->getIDGrupo() ."')><img src='resources/images/lapis_alterar.png' title='Alterar Descricao Sub-Grupo'/></a></td>
                 <td align='center'><a href='javascript:;' onClick='confirma(" .$pessoa->getIDSubGrupo()."," .$pessoa->getIDGrupo(). ")'><img src='resources/images/excluir.png' title='Excluir Sub-Grupo'/></a></td>
                 
                 </tr>");


                $grupo[] = $pessoa;
            }
        
        if (!is_array($grupo)) {
            throw new PDOException('Nenhum registro foi encontrado');
        }
        return $grupo;
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
                 <td align='center'><a href=". "javascript:mudaConteudo('app/view/forGrupoPessoa.php?idgrupo=".$pessoa->getIDGrupo()."')"."><img src='resources/images/lapis_alterar.png' title='Alterar Descricao Grupo'/></a></td>
                 <td align='center'><a href='javascript:;' onClick='confirma(".$pessoa->getIDGrupo().")'><img src='resources/images/excluir.png' title='Excluir Grupo'/></a></td>
                 </tr>");
                
                
                $grupo[] = $pessoa;
            }
        }
        
        }
        public function selectSEL() {
        $sql = 'SELECT idtipoPessoa,descricao FROM tipopessoa';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $pessoa = new GrupoPessoa();
                $pessoa->setGrupo($ln->descricao);
                $pessoa->setIDGrupo($ln->idtipoPessoa);
                
                print_r( "<option value=".$pessoa->getIDGrupo().">".$pessoa->getGrupo()."</option>");
                
                
                $grupo[] = $pessoa;
            }
        }
        
        }

    private function message($msg) { //imprime a mensagem na tela
        echo $msg;
    }

}

?>
