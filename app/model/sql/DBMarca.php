<?php

class DBMarca {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function insert(ModelMarca $pessoa) {
        //  echo $pessoa->getSubGrupo();
         $sql = 'INSERT INTO marca (descricao) VALUES (?)';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getMarca(), PDO::PARAM_STR);



        if ($stmt->execute()) {
            $msg = 'Marca cadastrado com sucesso!';
        } else {
            $msg = 'Falha ao tentar cadastrar Marca';
        }
        self::message($msg);
    }

    public function update(ModelMarca $pessoa) {
        $sql = 'UPDATE marca set descricao = ? WHERE idmarca = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getMarca(), PDO::PARAM_STR);
        $stmt->bindParam(2, $pessoa->getIDMarca(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        $msg = $rs === TRUE ? 'Marca atualizado com sucesso!' : 'Falha ao tentar atualizar Marca'; //simples comparação para saber se deu certo ou não a execução do sql
        self::message($msg);
    }

    public function delete(ModelMarca $pessoa) { 
        //echo $pessoa->getIDMarca();exit();
        $sql = 'DELETE FROM marca WHERE idmarca = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getIDMarca(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        //$msg = $rs === TRUE ? 'Grupo deletado com sucesso!' : 'Falha na exclusão do Grupo.';
        //self::message($msg);
    }
    
    
    
    public function selectSUB(ModelMarca $marca) {
        //echo $marca->getIDMarca();exit();
        $sql = 'SELECT idmarca,descricao FROM marca WHERE idmarca = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $marca->getIDMarca(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $marca->setMarca($rs->descricao);
            
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
        $sql = 'SELECT idmarca,descricao FROM marca';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $pessoa = new ModelMarca();
                $pessoa->setMarca($ln->descricao);
                $pessoa->setIDMarca($ln->idmarca);
                
                print_r( "<tr>
                 <td>".$pessoa->getIDMarca()."</td>
                 <td>".$pessoa->getMarca()."</td>
                 <td align='center'><a href=". "javascript:mudaConteudo('app/view/forMarca.php?idmarca=".$pessoa->getIDMarca()."')"."><img src='resources/images/lapis_alterar.png' title='Alterar Descricao Grupo'/></a></td>
                 <td align='center'><a href='javascript:;' onClick='confirma(".$pessoa->getIDMarca().")'><img src='resources/images/excluir.png' title='Excluir Grupo'/></a></td>
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
