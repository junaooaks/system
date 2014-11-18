<?php

class DBFuncionarioAcesso {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function insert(modelFuncionarioAcesso $acesso) {
    
       $senha = md5(hash('sha512', $acesso->getSenha()));
                
        $sql = 'INSERT INTO usuarios (funcionario_idfuncionario, login, senha)
                VALUES (?,?,?)';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $acesso->getIDFun(), PDO::PARAM_INT);
        $stmt->bindParam(2, $acesso->getUsuario(), PDO::PARAM_STR);
        $stmt->bindParam(3, $senha, PDO::PARAM_STR);

        $stmt->execute();
        $lastId = $this->conex->lastInsertId();
        $nivel  = $acesso->getAcesso(); 
                
        for ($i = 0; $i < count($nivel); $i++) {
         
            $sql = 'INSERT INTO permissao (usuarios_idusuarios, nivel)
                VALUES (?,?)';

            $stmt = $this->conex->prepare($sql);
            $stmt->bindParam(1, $lastId, PDO::PARAM_INT);
            $stmt->bindParam(2, $nivel[$i],  PDO::PARAM_STR);

            if ($stmt->execute()) {
                $msg = 'Permissoes cadastrado com sucesso!';
            } else {
                echo 'Falha ao tentar cadastrar ACESSO do Funcionario';
                exit();
            }
           
        }


        self::message($msg);
    }

    public function update(modelFuncionarioAcesso $acesso) {
        $senha = md5(hash('sha512', $acesso->getSenha()));
        //echo "id usuario ".$acesso->getIDUsuarios(); exit();
        //Update Tabela1 INNER JOIN Tabela2 ON Tabela1.tb1Cod = Tabela2.tb2Cod Set tb1Valor = (tb1Valor * tb2Valor)
        $sql = 'UPDATE usuarios SET login=?, senha=?, permissao=? WHERE idusuarios = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $acesso->getUsuario(), PDO::PARAM_STR);
        $stmt->bindParam(2, $senha, PDO::PARAM_STR);
        $stmt->bindParam(3, $acesso->getPermissao(), PDO::PARAM_STR);
        $stmt->bindParam(4, $acesso->getIDUsuarios(), PDO::PARAM_INT);
        
        $rs = $stmt->execute();
        $msg = $rs === TRUE ? 'Funcionario atualizado com sucesso!' : 'Falha ao tentar atualizar Funcionario';
        self::message($msg);
        
        $sql = 'DELETE FROM permissao WHERE usuarios_idusuarios = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $acesso->getIDUsuarios(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        $msg = $rs === TRUE ? 'Permissao deletado com sucesso!' : 'Falha na exclusão de Permissao.';
        //self::message($msg);
        
        
        $nivel  = $acesso->getAcesso(); 
        
        for ($i = 0; $i < count($nivel); $i++) {
        
            $sql = 'INSERT INTO permissao (usuarios_idusuarios, nivel)
                VALUES (?,?)';

            $stmt = $this->conex->prepare($sql);
            $stmt->bindParam(1, $acesso->getIDUsuarios(), PDO::PARAM_INT);
            $stmt->bindParam(2, $nivel[$i], PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                $msg = 'Permissoes cadastrado com sucesso!';
            } else {
                echo 'Falha ao tentar cadastrar ACESSO do Funcionario';
                exit();
            }
           
        }
        
        }
    
   /* public function nivelArray(modelFuncionarioAcesso $nivel){
        $sql  = 'SELECT nivel FROM permissao WHERE usuarios_idusuarios =  ?';
                $stmt = $this->conex->prepare($sql);
                $stmt->bindParam(1, $nivel->getIDUsuario(), PDO::PARAM_INT);
                $stmt->execute();

                while ($ln = $stmt->fetch(PDO::FETCH_OBJ)) {

                   $nivel->setAcesso($ln->nivel);
                    
                }
                print_r($nivel->getAcesso());exit();
    }*/

    public function delete(modelFuncionarioAcesso $pessoa) {
        $sql = 'DELETE FROM funcionario WHERE idfuncionario = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getIDFuncionario(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        $msg = $rs === TRUE ? 'Funcionario deletado com sucesso!' : 'Falha na exclusão do Funcionario.';
        self::message($msg);
    }
    
    public function select(modelFuncionarioAcesso $pessoa) {

        $sql = 'SELECT fun.idfuncionario, fun.setor_idsetor, fun.setor_empresa_idempresa, fun.nome, fun.sexo, fun.cpf, fun.identidade, fun.pis, 
        fun.estadoCivil, fun.nomePai, fun.nomeMae,  user.login, user.idusuarios, per.nivel
        FROM funcionario AS fun 
        LEFT JOIN usuarios AS user ON fun.idfuncionario = user.funcionario_idfuncionario
        LEFT JOIN empresa AS emp ON fun.setor_empresa_idempresa = emp.idempresa
        LEFT JOIN permissao AS per ON user.idusuarios = per.usuarios_idusuarios
        WHERE fun.idfuncionario = ?';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getIDFun(), PDO::PARAM_INT);
        $stmt->execute();
        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
        
            $pessoa->setIDFun($rs->idfuncionario);
            $pessoa->setNome($rs->nome);
            $pessoa->setSexo($rs->sexo);
            $pessoa->setCpf($rs->cpf);
            $pessoa->setIdentidade($rs->identidade);
            $pessoa->setPis($rs->pis);
            
            $pessoa->setCivil($rs->estadoCivil);
            $pessoa->setPai($rs->nomePai);
            $pessoa->setMae($rs->nomeMae);
            
            $pessoa->setIDUsuarios($rs->idusuarios);
            $pessoa->setLogin($rs->login);
            $acesso[] = $rs->nivel;
            
        }
        $pessoa->setAcesso($acesso);
        
        return $pessoa;
    }

    public function selectBUSCA(Pessoa $cliente) {
        //echo  " NOME ".$cliente->getBusca();exit();
        $sql = 'SELECT idpessoa,nome,endereco,numero, telefoneResidencial, celular1, cidade, estado FROM pessoa WHERE nome =?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $cliente->getBusca(), PDO::PARAM_STR);
        $stmt->execute();
        $ln = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($ln)) {
            $cliente->setIDpessoa($ln->idpessoa);
            $cliente->setNome($ln->nome);
            $cliente->setEndereco($ln->endereco);
            $cliente->setNumero($ln->numero);
            $cliente->setTelres($ln->telefoneResidencial);
            $cliente->setCelres($ln->celular1);
            $cliente->setCidade($ln->cidade);
            $cliente->setUf($ln->estado);

            print_r("<tr>
                 <td align='center'><a href=" . "javascript:mudaConteudo('app/view/forCliente.php?idpessoa=" . $cliente->getIDpessoa() . "')" . "><img src='resources/images/lapis_alterar.png' title='Alterar Pessoa'/></a></td>
                 <td>" . $cliente->getIDpessoa() . "</td>
                 <td>" . $cliente->getNome() . "</td>
                 <td>" . $cliente->getEndereco() . "</td>
                 <td>" . $cliente->getNumero() . "</td>
                 <td>" . $cliente->getTelres() . "</td>
                 <td>" . $cliente->getCelres() . "</td>
                 <td>" . $cliente->getCidade() . "</td>
                 <td>" . $cliente->getUf() . "</td>    
                 </tr>");
        }
        return $cliente;
    }

    public function selectAll() {
        $sql = 'SELECT fun.idfuncionario, fun.nome, fun.telefone, fun.celular1, fun.celuar2, se.descricao, emp.nome AS empresa 
                FROM funcionario AS fun, setor AS se, empresa AS emp 
                WHERE fun.setor_idsetor = se.idsetor AND fun.setor_empresa_idempresa = emp.idempresa ';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $pessoa = new modelFuncionario();
                $pessoa->setIDFuncionario($ln->idfuncionario);
                $pessoa->setNome($ln->nome);
                $pessoa->setTelres($ln->telefone);
                $pessoa->setCelres($ln->celular1);
                $pessoa->setCelcom($ln->celular2);
                $pessoa->setEmpresa($ln->empresa);
                $pessoa->setSetor($ln->descricao);

                $pessoa->setUf($ln->estado);

                print_r("<tr>
                 <td align='center'><a href=" . "javascript:mudaConteudo('app/view/forFuncionario.php?idfun=" . $pessoa->getIDFuncionario() . "')" . "><img src='resources/images/lapis_alterar.png' title='Alterar Funcionario'/></a></td>
                 <td align='center'><a href=" . "javascript:mudaConteudo('app/view/forFuncionarioAcesso.php?idfun=" . $pessoa->getIDFuncionario() . "')" . "><img src='resources/images/acesso.png' title='PERMITIR ACESSO'/></a></td>
                 <td>" . $pessoa->getIDFuncionario() . "</td>
                 <td>" . $pessoa->getNome() . "</td>
                 <td>" . $pessoa->getTelres() . "</td>
                 <td>" . $pessoa->getCelres() . "</td>
                 <td>" . $pessoa->getEmpresa() . "</td>
                 <td>" . $pessoa->getSetor() . "</td> 
                 <td align='center'><a href='javascript:;' onClick='confirma(" . $pessoa->getIDFuncionario() . ")'><img src='resources/images/excluir.png' title='Excluir Funcionario'/></a></td>    
                 </tr>");

                $pessoas[] = $pessoa;
            }
        }
        //if(!is_array($pessoas)){ throw new PDOException('Nenhum registro foi encontrado');}
        return $pessoas;
    }

    public function selectEmpresa($idempresa) {

        $sql = 'SELECT idempresa,nome FROM empresa';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $grupo = new modelFuncionario();
                $grupo->setEmpresa($ln->nome);
                $grupo->setIDEmpresa($ln->idempresa);

                $idgrupox = $grupo->getIDEmpresa();
                //<option value="CASADO" <?php if ($civil=='CASADO'){echo "selected";}>CASADO 
                if (!empty($idempresa) AND ($idempresa == $idgrupox)) {
                    print_r("<option value=" . $grupo->getIDEmpresa() . " selected > " . $grupo->getEmpresa() . "</option>");
                } else {
                    print_r("<option value=" . $grupo->getIDEmpresa() . " > " . $grupo->getEmpresa() . "</option>");
                }

                //print_r("<option value=" . $grupo->getIDGrupo() . " > " . $grupo->getGrupo() . "</option>");
                $grup[] = $grupo;
            }
        }
    }

    public function selectSetor($idsetor) {

        $sql = 'SELECT idsetor,descricao FROM setor WHERE idsetor = ?';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $idsetor, PDO::PARAM_INT);
        $stmt->execute();

        $ln = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($ln)) {
            $subdes = $ln->descricao;
            $subid = $ln->idsetor;

            print_r("<option value=" . $subid . " selected > " . $subdes . "</option>");

            $su[] = $sub;
        }
    }

    private function message($msg) { //imprime a mensagem na tela
        echo $msg;
    }

}

?>
