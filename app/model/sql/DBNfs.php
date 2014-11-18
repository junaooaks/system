<?php

class DBNfs {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function selectCX(modelNFs $model) {

        $sql = 'SELECT * FROM usuarios WHERE idusuarios = ?';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $model->getVendedor(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $model->setVendedor($rs->idusuarios);
            $model->setSenha($rs->senha);
        
            
        }

    }

    public function selectVendedor() {

        $sql = 'SELECT idusuarios, login 
                FROM usuarios, permissao
                WHERE permissao.usuarios_idusuarios = usuarios.idusuarios
                AND permissao.nivel = 301';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $login = $ln->login;
                $idlogin = $ln->idusuarios;
                print_r("<option value=" . $idlogin . ">" . $login . "</option>");
            }
        }
    }

    public function selectTipo(modelNFs $model) {

        $sql = 'SELECT desconto FROM condicaopagamento WHERE idcondicaoPagamento = ?';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $model->getFormapg(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $desconto = $rs->desconto;
        }

        return $desconto;
    }

    public function selectOperacao($idformapg) {
        $sql = 'SELECT * FROM  operacao';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $operacao = $ln->descricao;
                $idop = $ln->idoperacao;

                if ($idop == $idformapg) {
                    print_r("<option value=" . $idop . " selected>" . $operacao . "</option>");
                } else {
                    print_r("<option value=" . $idop . ">" . $operacao . "</option>");
                }
            }
        }
    }

    public function insert(modelNFs $model) {

        //echo $model->getQuantitem();exit();

        for ($x = 0; $x <= $model->getQuantitem(); $x++) {

            $item = $_POST["item$x"];
            $custo = $_POST["custo$x"];
            $quant = $_POST["quantidade$x"];


            //explode item na virgula
            $item = explode(',', $item . $x);

            $cod = (int) $item[0];
            $cod = rtrim($cod);

            if (!empty($item[0]) and (is_numeric($cod))) {

                $row = $x;
                //echo $model->getQuantitem();
            }



            $valor[$x] = $custo * $quant;

            //echo $custo.' '.$quant.' '.$valor."\n";
        }
        //total dos produto sem desconto
        $total = array_sum($valor);

        $desconto = (($total / 100) * $model->getValorDesconto()) + $total;

        //pegar o numero da ultima nota registra
        /*         * ***************************************************** */
        $s = 'SELECT nf FROM  notasaida';
        $x = $this->conex->query($s);
        if ($x) {
            while ($l = $x->fetch(PDO::FETCH_OBJ)) {
                $nf = $l->nf;
            }
        }
        if (empty($nf)) {
            $nf = 1000;
        } else {
            $nf = $nf + 1;
        }

        /*         * **************************************************** */


        $sql = 'INSERT INTO notasaida (pessoa_idpessoa, nf, operacao_idoperacao, condicaoPagamento_idcondicaoPagamento, valorProdutos, desconto, frete, valorFinal, totalLinhas)
                VALUES (?,?,?,?,?,?,?,?,?)';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $model->getIDcliente(), PDO::PARAM_STR);
        $stmt->bindParam(2, $nf, PDO::PARAM_STR);
        $stmt->bindParam(3, $model->getTipo(), PDO::PARAM_STR);
        $stmt->bindParam(4, $model->getFormapg(), PDO::PARAM_STR);
        $stmt->bindParam(5, $total, PDO::PARAM_STR);
        $stmt->bindParam(6, $model->getValorDesconto(), PDO::PARAM_STR);
        $stmt->bindParam(7, $model->getFrete(), PDO::PARAM_STR);
        $stmt->bindParam(8, $desconto, PDO::PARAM_STR);
        $stmt->bindParam(9, $row, PDO::PARAM_STR);
        $stmt->execute();

        $lastId = $this->conex->lastInsertId();

        for ($x = 1; $x <= $model->getQuantitem(); $x++) {

            $item = $_POST["item$x"];
            $quant = $_POST["quantidade$x"];
            $custo = $_POST["custo$x"];

            $item = explode(',', $item . $x);

            $cod = (int) $item[0];
            //tirar zero a esquerda
            $cod = rtrim($cod);
            $nomepro = $item[1];
            //aqui seu código com o uso dos valores capturados
            //echo $lastId.' '.$cod.' '.$quant.' '.$nomepro.' '.$model->getValorDesconto().' '.$custo;

            $sql = 'INSERT INTO itensnotasaidaproduto (notaSaida_idnotaSaida, produto_idproduto, quantidade, nomeProduto, desconto, valorProduto)
                VALUES (?,?,?,?,?,?)';

            $stmt = $this->conex->prepare($sql);
            $stmt->bindParam(1, $lastId, PDO::PARAM_STR);
            $stmt->bindParam(2, $cod, PDO::PARAM_STR);
            $stmt->bindParam(3, $quant, PDO::PARAM_STR);
            $stmt->bindParam(4, $nomepro, PDO::PARAM_STR);
            $stmt->bindParam(5, $model->getValorDesconto(), PDO::PARAM_STR);
            $stmt->bindParam(6, $custo, PDO::PARAM_STR);


            $ok = $stmt->execute();
        }
        /***************************************************************************************/
	//pegar o id do usuario cometi uma burricce aqui depois tenho que arrumar**************/
	/**************************************************************************************/
	$merda = 'SELECT * FROM usuarios WHERE idusuarios = ?';

        $caga = $this->conex->prepare($merda);
        $caga->bindParam(1, $model->getIDVendedor(), PDO::PARAM_INT);
        $caga->execute();
        $cu = $caga->fetch(PDO::FETCH_OBJ);
        if (is_object($cu)) {
            $funcionario = $cu->funcionario_idfuncionario;
        }

	/*****************************************************************************************/
         $sqs = 'INSERT INTO comissao (funcionario_idfuncionario, notaSaida_idnotaSaida)
                VALUES (?,?)';

            $s = $this->conex->prepare($sqs);
            $s->bindParam(1, $funcionario, PDO::PARAM_STR);
            $s->bindParam(2, $lastId, PDO::PARAM_STR);
            
            $o = $s->execute();

        $msg = $ok === TRUE ? 'SUCESSO! nota ' . $nf : 'Falha ao tentar registrar'; //simples comparação para saber se deu certo ou não a execução do sql

        self::message($msg);
    }

    public function update(modelNFs $model) {
        //echo 'n linhas '.$model->getQuantitem(); exit();
        //deletar todos os itens da nota


        $sql = 'DELETE FROM itensnotasaidaproduto WHERE notaSaida_idnotaSaida = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $model->getIDnfs(), PDO::PARAM_INT);
        $rs = $stmt->execute();



        for ($x = 1; $x <= $model->getQuantitem(); $x++) {

            $item = $_POST["item$x"];
            $custo = $_POST["custo$x"];
            $quant = $_POST["quantidade$x"];



            //explode item na virgula
            $item = explode(',', $item . $x);

            $cod = (int) $item[0];
            $cod = rtrim($cod);

            if (!empty($item[0]) and (is_numeric($cod))) {

                $row = $x;
                //echo $model->getQuantitem();
            }



            $valor[$x] = $custo * $quant;

            //echo $custo.' '.$quant.' '.$valor."\n";
        }
        //total dos produto sem desconto
        $total = array_sum($valor);

        $desconto = (($total / 100) * $model->getValorDesconto()) + $total;




        $sql = 'UPDATE notasaida SET operacao_idoperacao = ?, condicaoPagamento_idcondicaoPagamento = ?, valorProdutos = ?, desconto = ?, frete = ?, valorFinal=?, totalLinhas = ? WHERE idnotaSaida = ?';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $model->getTipo(), PDO::PARAM_STR);
        $stmt->bindParam(2, $model->getFormapg(), PDO::PARAM_STR);
        $stmt->bindParam(3, $total, PDO::PARAM_STR);
        $stmt->bindParam(4, $model->getValorDesconto(), PDO::PARAM_STR);
        $stmt->bindParam(5, $model->getFrete(), PDO::PARAM_STR);
        $stmt->bindParam(6, $desconto, PDO::PARAM_STR);
        $stmt->bindParam(7, $row, PDO::PARAM_STR);
        $stmt->bindParam(8, $model->getIDnfs(), PDO::PARAM_STR);


        $stmt->execute();

        //$lastId = $this->conex->lastInsertId();


        for ($x = 1; $x <= $model->getQuantitem(); $x++) {

            $item = $_POST["item$x"];
            $quant = $_POST["quantidade$x"];
            $custo = $_POST["custo$x"];

            $pro = explode(',', $item);

            $cod = (int) $pro[0];
            //tirar zero a esquerda
            $cod = rtrim($cod);
            $nomepro = ltrim($pro[1]);
            //aqui seu código com o uso dos valores capturados
            //echo $model->getIDnfs().' '.$cod.' '.$quant.' '.$nomepro.' '.$model->getValorDesconto().' '.$custo.' ';

            $sql = 'INSERT INTO itensnotasaidaproduto (notaSaida_idnotaSaida, produto_idproduto, quantidade, nomeProduto, desconto, valorProduto)
                VALUES (?,?,?,?,?,?)';

            $stmt = $this->conex->prepare($sql);
            $stmt->bindParam(1, $model->getIDnfs(), PDO::PARAM_STR);
            $stmt->bindParam(2, $cod, PDO::PARAM_STR);
            $stmt->bindParam(3, $quant, PDO::PARAM_STR);
            $stmt->bindParam(4, $nomepro, PDO::PARAM_STR);
            $stmt->bindParam(5, $model->getValorDesconto(), PDO::PARAM_STR);
            $stmt->bindParam(6, $custo, PDO::PARAM_STR);


            $ok = $stmt->execute();
        }



        $msg = $rs === TRUE ? 'Nota atualizado com sucesso!' : 'Falha ao tentar atualizar nota'; //simples comparação para saber se deu certo ou não a execução do sql
        self::message($msg);
    }

    public function delete(Pessoa $pessoa) {
        $sql = 'DELETE FROM pessoa WHERE idPessoa = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $pessoa->getIdPessoa(), PDO::PARAM_INT);
        $rs = $stmt->execute();
        $msg = $rs === TRUE ? 'Cliente deletado com sucesso!' : 'Falha na exclusão do cliente.';
        self::message($msg);
    }

    public function select(modelNFs $nfe) {

        $sql = 'SELECT  operacao, nf, condicaoPagamento_idcondicaoPagamento, desconto, 
                        idpessoa, nome, endereco, numero, bairro, cep, cidade, ativo, frete, valorFinal, totalLinhas
                FROM pessoa, notasaida WHERE idnotaSaida = ? 
                AND idpessoa = pessoa_idpessoa';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $nfe->getIDnfs(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $nfe->setFormapg($rs->operacao);
            $nfe->setIDformapg($rs->condicaoPagamento_idcondicaoPagamento);
            $nfe->setValorDesconto($rs->desconto);
            $nfe->setIDcliente($rs->idpessoa);
            $nfe->setCliente($rs->nome);
            $nfe->setEndereco($rs->endereco);
            $nfe->setNumero($rs->numero);
            $nfe->setBairro($rs->bairro);
            $nfe->setCep($rs->cep);
            $nfe->setCidade($rs->cidade);
            $nfe->setAtivo($rs->ativo);
            $nfe->setQuantitem($rs->totalLinhas);
            $nfe->setTotal($rs->valorFinal);
            $nfe->setFrete($rs->frete);
            $nfe->setNF($rs->nf);
        }
    }

    public function selectBUSCA(modelNFs $model) {
        //echo "numero pedido = ".$inseri->getNf();exit();
        //echo $inseri->getDataemissao();

        $sql = "SELECT idnotaSaida,nf,nome,DATE_FORMAT(data , '%d/%m/%Y') AS Data, valorProdutos, operacao 
                FROM pessoa INNER JOIN notasaida on pessoa.idpessoa = notasaida.pessoa_idpessoa
                WHERE pessoa.nome LIKE ?  
                ORDER BY idnotaSaida DESC";

        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(1, '%' . $model->getCliente() . '%', PDO::PARAM_STR);
        $stmt->execute();


        $arr = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ))
            $arr[] = $row;


        header('Content-type: application/json');
        echo json_encode($arr);
    }

    public function selectAll() {
        $sql = 'SELECT idnotaSaida,nf,nome,DATE_FORMAT(data , "%d/%m/%Y") AS Data, valorProdutos, operacao FROM pessoa, notasaida
                WHERE pessoa.idpessoa = notasaida.pessoa_idpessoa 
                ORDER BY idnotaSaida DESC
                LIMIT 0,30';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $pessoa = new modelNFs();
                $pessoa->setIDnfs($ln->idnotaSaida);
                $pessoa->setCliente($ln->nome);
                $pessoa->setDataentrada($ln->Data);
                $pessoa->setValorfinal($ln->valorProdutos);
                $tipo = $ln->operacao;
                $nfs = $ln->nf;

                /*                $tipo = 'ORÇAMENTO';
                  $pessoa->setTipo($tipo);
                 */
                print_r("<tr>
                 <td align='center'><a href=" . "javascript:mudaConteudo('app/view/forNfs.php?idnf=" . $pessoa->getIDnfs() . "')" . "><img src='resources/images/lapis_alterar.png' title='Alterar Pessoa'/></a></td>
                 <td>" . $pessoa->getIDnfs() . "</td>
                 <td>" . $nfs . "</td>
                 <td>" . $pessoa->getCliente() . "</td>
                 <td>" . $pessoa->getDataentrada() . "</td>
                 <td>" . $pessoa->getValorfinal() . "</td>
                 
                 </tr>");

                $pessoas[] = $pessoa;
            }
        }
        /* if (!is_array($pessoas)) {
          throw new PDOException('Nenhum registro foi encontrado');
          } */
        return $pessoas;
    }

    public function selectGrupo($idgrupo) {

        $sql = 'SELECT idgrupo,descricao FROM grupo';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $grupo = new ModelPeca();
                $grupo->setGrupo($ln->descricao);
                $grupo->setIDGrupo($ln->idgrupo);

                $idgrupox = $grupo->getIDGrupo();
                //<option value="CASADO" <?php if ($civil=='CASADO'){echo "selected";}>CASADO 
                if (!empty($idgrupo) AND ($idgrupo == $idgrupox)) {
                    print_r("<option value=" . $grupo->getIDGrupo() . " selected > " . $grupo->getGrupo() . "</option>");
                } else {
                    print_r("<option value=" . $grupo->getIDGrupo() . " > " . $grupo->getGrupo() . "</option>");
                }

                //print_r("<option value=" . $grupo->getIDGrupo() . " > " . $grupo->getGrupo() . "</option>");
                $grup[] = $grupo;
            }
        }
    }

    public function selectSubGrupo($idsubgrupo) {

        $sql = 'SELECT idsubgrupo,descricaoSubGrupo FROM subgrupo WHERE	idsubgrupo = ?';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $idsubgrupo, PDO::PARAM_INT);
        $stmt->execute();

        $ln = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($ln)) {
            $subdes = $ln->descricaoSubGrupo;
            $subid = $ln->idsubgrupo;

            print_r("<option value=" . $subid . " selected > " . $subdes . "</option>");

            $su[] = $sub;
        }
    }

    public function selectMarca($idmarca) {

        $sql = 'SELECT idmarca,descricao FROM marca';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $marca = new ModelPeca();
                $marca->setMarca($ln->descricao);
                $marca->setIDMarca($ln->idmarca);
                $xm = $marca->getIDMarca();

                if ($idmarca == $xm) {
                    print_r("<option value=" . $marca->getIDMarca() . " selected>" . $marca->getMarca() . "</option>");
                } else {
                    print_r("<option value=" . $marca->getIDMarca() . ">" . $marca->getMarca() . "</option>");
                }

                $mar[] = $marca;
            }
        }
    }

    public function selectFornecedor($idfornecedor) {
        $sql = 'SELECT idfornecedor,descricao FROM fornecedor';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $fornecedor = new ModelPeca();
                $fornecedor->setFornecedor($ln->descricao);
                $fornecedor->setIDFornecedor($ln->idfornecedor);

                $xf = $fornecedor->getIDFornecedor();

                if ($idfornecedor == $xf) {
                    print_r("<option value=" . $fornecedor->getIDFornecedor() . " selected>" . $fornecedor->getFornecedor() . "</option>");
                } else {
                    print_r("<option value=" . $fornecedor->getIDFornecedor() . ">" . $fornecedor->getFornecedor() . "</option>");
                }

                $for[] = $fornecedor;
            }
        }
    }

    public function selectEmpresa($idempresa) {
        $sql = 'SELECT idempresa,nome FROM empresa';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $empresa = new ModelPeca();
                $empresa->setEmpresa($ln->nome);
                $empresa->setIDEmpresa($ln->idempresa);

                $xe = $empresa->getIDEmpresa();

                if ($idempresa == $xe) {
                    print_r("<option value=" . $empresa->getIDEmpresa() . " selected>" . $empresa->getEmpresa() . "</option>");
                } else {
                    print_r("<option value=" . $empresa->getIDEmpresa() . ">" . $empresa->getEmpresa() . "</option>");
                }
                $empre[] = $empresa;
            }
        }
    }

    public function selectUnidade($idunidade) {
        $sql = 'SELECT idunidade,sigla FROM unidade';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $empresa = new ModelPeca();
                $empresa->setUnidade($ln->sigla);
                $empresa->setIDUnidade($ln->idunidade);

                $xu = $empresa->getIDUnidade();

                if ($idunidade == $xu) {
                    print_r("<option value=" . $empresa->getIDUnidade() . " selected>" . $empresa->getUnidade() . "</option>");
                } else {
                    print_r("<option value=" . $empresa->getIDUnidade() . ">" . $empresa->getUnidade() . "</option>");
                }

                $empre[] = $empresa;
            }
        }
    }

    public function selectCliente(modelNFs $model) {

        $sql = 'SELECT nome, endereco, numero, bairro, cep, cidade, idpessoa, ativo 
                FROM pessoa WHERE pessoa.idpessoa = ? ';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $model->getIDcliente(), PDO::PARAM_STR);
        $stmt->execute();

        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $model->setIDcliente($rs->idpessoa);
            $model->setNumero($rs->numero);
            $model->setEndereco($rs->endereco);
            $model->setBairro($rs->bairro);
            $model->setCep($rs->cep);
            $model->setCidade($rs->cidade);
            $model->setCliente($rs->nome);
            $model->setStatus($rs->ativo);
            $status = $rs->ativo;

            if (empty($status)) {
                $model->setStatus('PENDENCIA - FALE COM ADMINISTRADOR');
            }
            if ($status == 0) {
                $model->setStatus('DESATIVADO - FALE COM ADMINISTRADOR');
            }
            if ($status == 1) {
                $model->setStatus('ATIVADO - LIBERADO');
            }
            if ($status == 2) {
                $model->setStatus('PENDENCIA - FALE COM ADMINISTRADOR');
            }


            $arr = $model->getIDcliente() . "|" . $model->getNumero() . "|" . $model->getEndereco() . "|" . $model->getBairro() . "|" . $model->getCep();
            $arr = $arr . "|" . $model->getCidade() . "|" . $model->getCliente() . "|" . $model->getStatus() . "|" . $status . "|" . $model->getIDcliente();

            echo json_encode($arr);
        }
    }

    public function selectSEL($idformapg) {
        $sql = 'SELECT idcondicaoPagamento, descricao FROM  condicaopagamento';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $nfs = new modelNFs();
                $nfs->setFormapg($ln->descricao);
                $nfs->setIDformapg($ln->idcondicaoPagamento);


                $xu = $nfs->getIDformapg();

                if ($idformapg == $xu) {
                    print_r("<option value=" . $nfs->getIDformapg() . " selected>" . $nfs->getFormapg() . "</option>");
                } else {
                    print_r("<option value=" . $nfs->getIDformapg() . ">" . $nfs->getFormapg() . "</option>");
                }
            }
        }
    }

    public function selectPro($idnf) {

        $sql = 'SELECT produto_idproduto, quantidade, nomeProduto, valorProduto, estoqueAtual, totalLinhas
                FROM produto 
                INNER JOIN itensnotasaidaproduto on produto.idproduto =  itensnotasaidaproduto.produto_idproduto       
                INNER JOIN notasaida on itensnotasaidaproduto.notaSaida_idnotaSaida = notasaida.idnotasaida
                WHERE idnotaSaida = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $idnf, PDO::PARAM_INT);
        $stmt->execute();

        $x = 0;
        $somalote = 0;
        while ($ln = $stmt->fetch(PDO::FETCH_OBJ)) {

            $idproduto = ($ln->produto_idproduto);
            $produto = ($ln->nomeProduto);
            $estatual = ($ln->estoqueAtual);
            $valor = ($ln->valorProduto);
            $qt = ($ln->quantidade);
            $quantitens = ($ln->totalLinhas);

            $codpro = str_pad($idproduto, 5, "0", STR_PAD_LEFT);
            $somalote = $somalote + $valor;
            //  for ($x = 1; $x <= $quantitens; $x++) {
            if ($x <= $quantitens) {
                $next = $x;

                echo "<tr>
                    
                        
                         
                    <td><input name=\"ativo[]\" type=\"checkbox\" value=\"$codpro\" class=\"effect\"/></td>
                    <td><input type='text' name='item" . $next . "' size='70' class='effect auto item' onkeyup='up(this)' value='$codpro,  $produto' readonly='true'/></td>
                    <td><input type='text' name='est" . $next . "' size='5' class='effect' id='est2' readonly='readonly' value='$estatual' readonly='true'/><div id='tmp_name' style='display:none;'></div> </td>
		    <td><input type='text' name='custo" . $next . "' size='5' id='moeda' class='effect soma atri2' value ='$valor' readonly='true'/></td>
		    <td><input type='text' name='quantidade" . $next . "' size='5' id='quantidade1' class='effect' onBlur='calculateSum();' value = '$qt' readonly='true'/></td>
                  
                
                        
                        
                        
                        
                        
                        
            </tr>";
                //}
                //$pessoas[] = $nf;

                $x = $x + 1;
            }


            /* if (!is_array($pessoas)) {
              throw new PDOException('Nenhum registro foi encontrado');
              } */
            //return array($somalote, $somast, $somaipi, $somafrete, $somafrete);
        }
        // echo $somalote;
    }

    private function message($msg) { //imprime a mensagem na tela
        echo $msg;
    }

}

?>
