<?php

class DBCaixa {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function insert(modelCaixa $pessoa) {
         
         $sql = 'INSERT INTO caixa (descricao, senha) VALUES (?,?)';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getDescricao(), PDO::PARAM_STR);
        $stmt->bindParam(2, $pessoa->getSenha(), PDO::PARAM_STR);



        if ($stmt->execute()) {
            $msg = 'Caixa cadastrado com sucesso!';
        } else {
            $msg = 'Falha ao tentar cadastrar Caixa';
        }
        self::message($msg);
    }

    public function update(modelCaixa $pessoa) {
        $sql = 'UPDATE caixa set descricao = ?, senha = ? WHERE idcaixa = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getDescricao(), PDO::PARAM_STR);
        $stmt->bindParam(2, $pessoa->getSenha(), PDO::PARAM_STR);
        $stmt->bindParam(3, $pessoa->getIDCaixa(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        
        $msg = $rs === TRUE ? 'Caixa atualizado com sucesso!' : 'Falha ao tentar atualizar Caixa'; //simples comparação para saber se deu certo ou não a execução do sql
        self::message($msg);
    }

    public function delete(modelCaixa $pessoa) { 
        //echo $pessoa->getIDMarca();exit();
        $sql = 'DELETE FROM caixa WHERE idcaixa = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getIDCaixa(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        //$msg = $rs === TRUE ? 'Grupo deletado com sucesso!' : 'Falha na exclusão do Grupo.';
        //self::message($msg);
    }
    
    
    
    public function selectSUB(modelCaixa $marca) {
        //echo $marca->getIDMarca();exit();
        $sql = 'SELECT idcaixa,descricao, senha FROM caixa WHERE idcaixa = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $marca->getIDCaixa(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $marca->setDescricao($rs->descricao);
            $marca->setSenha($rs->senha);
            
        }
        return $marca;
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
        $sql = 'SELECT idcaixa,descricao FROM caixa';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $pessoa = new modelCaixa();
                $pessoa->setDescricao($ln->descricao);
                $pessoa->setIDCaixa($ln->idcaixa);
                
                print_r( "<tr>
                 <td>".$pessoa->getIDCaixa()."</td>
                 <td>".$pessoa->getDescricao()."</td>
                 <td align='center'><a href=". "javascript:mudaConteudo('app/view/forCaixa.php?idcaixa=".$pessoa->getIDCaixa()."')"."><img src='resources/images/lapis_alterar.png' title='Alterar Descricao Caixa'/></a></td>
                 <td align='center'><a href='javascript:;' onClick='confirma(".$pessoa->getIDCaixa().")'><img src='resources/images/excluir.png' title='Excluir Caixa'/></a></td>
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
