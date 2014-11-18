<?php

class DBPeca {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function insert(ModelPeca $peca) {
        //echo "cod ".$peca->getCodfabricante()."";exit();
        //echo "cpfcnpj".$cliente->getCpfcnpj();exit();

        $idcusto = $peca->getIDCusto();
        if (empty($idcusto)) {

            $sql = 'INSERT INTO custo (valorUnitario, st, ipi, frete, fretePorcentagen, precoCusto, piscofins, irCsll, Lucro, precoVenda, percentualComissao)
                VALUES (?,?,?,?,?,?,?,?,?,?,?)';

            $stmt = $this->conex->prepare($sql);
            $stmt->bindParam(1, $peca->getUnitario(), PDO::PARAM_STR);
            $stmt->bindParam(2, $peca->getSt(), PDO::PARAM_STR);
            $stmt->bindParam(3, $peca->getIpi(), PDO::PARAM_STR);
            $stmt->bindParam(4, $peca->getFrete(), PDO::PARAM_STR);
            $stmt->bindParam(5, $peca->getFretep(), PDO::PARAM_STR);
            $stmt->bindParam(6, $peca->getPrecocusto(), PDO::PARAM_STR);
            $stmt->bindParam(7, $peca->getPisconfins(), PDO::PARAM_STR);
            $stmt->bindParam(8, $peca->getIrcs(), PDO::PARAM_STR);
            $stmt->bindParam(9, $peca->getLucro(), PDO::PARAM_STR);
            $stmt->bindParam(10, $peca->getPrecovenda(), PDO::PARAM_STR);
            $stmt->bindParam(11, $peca->getComissao(), PDO::PARAM_STR);

            $stmt->execute();

            $lastId = $this->conex->lastInsertId();
        }
        //tabela de produto
        //echo $lastId;        exit ();

        $sql = 'INSERT INTO produto (codproduto,grupo_idgrupo, subgrupo_idsubgrupo, marca_idmarca, fornecedor_idfornecedor, 
            unidade_idunidade, empresa_idempresa, custo_idcusto, codFabricante, codigoEAN, descricao, classificacao, 
            fracionavel, localizacao, pesoBruto, pesoLiquido, estoqueAtual, estoqueMaximo, estoqueMinimo, status)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $peca->getCodMang(), PDO::PARAM_STR);
        $stmt->bindParam(2, $peca->getGrupo(), PDO::PARAM_STR);
        $stmt->bindParam(3, $peca->getSubgrupo(), PDO::PARAM_STR);
        $stmt->bindParam(4, $peca->getMarca(), PDO::PARAM_STR);
        $stmt->bindParam(5, $peca->getFornecedor(), PDO::PARAM_STR);
        $stmt->bindParam(6, $peca->getUnidade(), PDO::PARAM_STR);
        $stmt->bindParam(7, $peca->getEmpresa(), PDO::PARAM_STR);

        if (empty($idcusto)) {
            $stmt->bindParam(8, $lastId, PDO::PARAM_STR);
        } else {
            $stmt->bindParam(8, $peca->getIDCusto(), PDO::PARAM_STR);
        }

        $stmt->bindParam(9, $peca->getCodfabricante(), PDO::PARAM_STR);
        $stmt->bindParam(10, $peca->getCodean(), PDO::PARAM_STR);
        $stmt->bindParam(11, $peca->getDescricao(), PDO::PARAM_STR);
        $stmt->bindParam(12, $peca->getClassificacao(), PDO::PARAM_STR);
        $stmt->bindParam(13, $peca->getFracionavel(), PDO::PARAM_STR);
        $stmt->bindParam(14, $peca->getLocalizacao(), PDO::PARAM_STR);
        $stmt->bindParam(15, $peca->getPesobruto(), PDO::PARAM_STR);
        $stmt->bindParam(16, $peca->getPesoliquido(), PDO::PARAM_STR);
        $stmt->bindParam(17, $peca->getEstoqueatual(), PDO::PARAM_STR);
        $stmt->bindParam(18, $peca->getEstoquemaximo(), PDO::PARAM_STR);
        $stmt->bindParam(19, $peca->getEstoqueminimo(), PDO::PARAM_STR);
        $stmt->bindParam(20, $peca->getStatus(), PDO::PARAM_STR);


        if ($stmt->execute()) {
            $msg = 'Cadastrado com sucesso!';
        } else {
            $msg = 'Falha ao tentar cadastrar Produto';
        }
        self::message($msg);
    }

    public function update(ModelPeca $peca) {
     /*echo "ESTADO ".$cliente->getUf().
          " NOME ".$cliente->getNome().
          " CPF ".$cliente->getCpfcnpj().
          " IDENTIDADE ".$cliente->getIdentidade().
          " SEXO ".$cliente->getSexo().
          " APELIDO ".$cliente->getFantasia().
          " ENDERECO ".$cliente->getEndereco().
          " NUMERO ".$cliente->getNumero().
          " BAIRRO ".$cliente->getBairro().
          " CIDADE ".$cliente->getCidade().
          " cep ".$cliente->getCep().
          " COMPLEMENTP ".$cliente->getComplementar().
          " estado ".$cliente->getUf().
          " GRUPO ".$cliente->getIDGrupo()."";exit();
        
        echo 'produto '.$peca->getDescricao().
              '</br> unid '.$peca->getUnitario().
'</br> st '.$peca->getSt().
'</br> ipi '.$peca->getIpi().
'</br> frete '.$peca->getFrete().
'</br> fretep '.$peca->getFretep().
'</br> prec c '.$peca->getPrecocusto().
'</br> pis '.$peca->getPisconfins().
'</br> ircs '.$peca->getIrcs().
' lucro '.$peca->getLucro().
' preco v '.$peca->getPrecovenda().
' comissao '.$peca->getComissao().
' grupo '.$peca->getGrupo().
' subg '.$peca->getSubgrupo().
' marca '.$peca->getMarca().
' forne '. $peca->getFornecedor().
' unidade '.$peca->getUnidade().
' empres '.$peca->getEmpresa().
' cod f '.$peca->getCodfabricante().
' codan '.$peca->getCodean().

' classi '.$peca->getClassificacao().
' frac '.$peca->getFracionavel().
' loca '.$peca->getLocalizacao().
' pesobru '.$peca->getPesobruto().
' peso l '.$peca->getPesoliquido().
' est at '.$peca->getEstoqueatual().
' est max '.$peca->getEstoquemaximo().
' est min '.$peca->getEstoqueminimo().
' stat '.$peca->getStatus().
' idpe '.$peca->getIDPeca().
              '';exit();
    */    
        $sql = 'UPDATE custo, produto 
                SET custo.valorUnitario = ?, custo.st = ?, custo.ipi = ?, custo.frete = ?, custo.fretePorcentagen = ?, custo.precoCusto = ?, custo.piscofins = ?, custo.irCsll = ?, custo.Lucro = ?, custo.precoVenda = ?, custo.percentualComissao = ?,
                    produto.codproduto = ?, produto.grupo_idgrupo = ?, produto.subgrupo_idsubgrupo = ?, produto.marca_idmarca = ?, produto.fornecedor_idfornecedor = ?, produto.unidade_idunidade = ?, produto.empresa_idempresa = ?, produto.codFabricante = ?, produto.codigoEAN = ?, produto.descricao = ?, produto.classificacao = ?, produto.fracionavel = ?, produto.localizacao = ?, produto.pesoBruto = ?, produto.pesoLiquido = ?, produto.estoqueAtual = ?, produto.estoqueMaximo = ?, produto.estoqueMinimo = ?, produto.status = ?
                WHERE produto.idproduto = ? 
                AND produto.custo_idcusto = custo.idcusto';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $peca->getUnitario(), PDO::PARAM_STR);
        $stmt->bindParam(2, $peca->getSt(), PDO::PARAM_STR);
        $stmt->bindParam(3, $peca->getIpi(), PDO::PARAM_STR);
        $stmt->bindParam(4, $peca->getFrete(), PDO::PARAM_STR);
        $stmt->bindParam(5, $peca->getFretep(), PDO::PARAM_STR);
        $stmt->bindParam(6, $peca->getPrecocusto(), PDO::PARAM_STR);
        $stmt->bindParam(7, $peca->getPisconfins(), PDO::PARAM_STR);
        $stmt->bindParam(8, $peca->getIrcs(), PDO::PARAM_STR);
        $stmt->bindParam(9, $peca->getLucro(), PDO::PARAM_STR);
        $stmt->bindParam(10, $peca->getPrecovenda(), PDO::PARAM_STR);
        $stmt->bindParam(11, $peca->getComissao(), PDO::PARAM_STR);
        $stmt->bindParam(12, $peca->getCodMang(), PDO::PARAM_STR);
        $stmt->bindParam(13, $peca->getGrupo(), PDO::PARAM_STR);
        $stmt->bindParam(14, $peca->getSubgrupo(), PDO::PARAM_STR);
        $stmt->bindParam(15, $peca->getMarca(), PDO::PARAM_STR);
        $stmt->bindParam(16, $peca->getFornecedor(), PDO::PARAM_STR);
        $stmt->bindParam(17, $peca->getUnidade(), PDO::PARAM_STR);
        $stmt->bindParam(18, $peca->getEmpresa(), PDO::PARAM_STR);
//        $stmt->bindParam(18, $lastId, PDO::PARAM_STR);
        $stmt->bindParam(19, $peca->getCodfabricante(), PDO::PARAM_STR);
        $stmt->bindParam(20, $peca->getCodean(), PDO::PARAM_STR);
        $stmt->bindParam(21, $peca->getDescricao(), PDO::PARAM_STR);
        $stmt->bindParam(22, $peca->getClassificacao(), PDO::PARAM_STR);
        $stmt->bindParam(23, $peca->getFracionavel(), PDO::PARAM_STR);
        $stmt->bindParam(24, $peca->getLocalizacao(), PDO::PARAM_STR);
        $stmt->bindParam(25, $peca->getPesobruto(), PDO::PARAM_STR);
        $stmt->bindParam(26, $peca->getPesoliquido(), PDO::PARAM_STR);
        $stmt->bindParam(27, $peca->getEstoqueatual(), PDO::PARAM_STR);
        $stmt->bindParam(28, $peca->getEstoquemaximo(), PDO::PARAM_STR);
        $stmt->bindParam(29, $peca->getEstoqueminimo(), PDO::PARAM_STR);
        $stmt->bindParam(30, $peca->getStatus(), PDO::PARAM_STR);
        $stmt->bindParam(31, $peca->getIDPeca(), PDO::PARAM_INT);

        $rs = $stmt->execute();
        $msg = $rs === TRUE ? 'Produto atualizado com sucesso!' : 'Falha ao tentar atualizar Produto'; //simples comparação para saber se deu certo ou não a execução do sql
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

    public function select(ModelPeca $peca) {
//echo $peca->getIDPeca();exit();
       
        $sql = "SELECT pro.codproduto, pro.dataUpdate, pro.idproduto, pro.codFabricante, pro.codigoEAN, pro.descricao AS nome_pro, pro.classificacao, pro.fracionavel, pro.localizacao, pro.pesoBruto, pro.pesoLiquido, pro.estoqueAtual, pro.estoqueMaximo, pro.estoqueMinimo, pro.status,
                       cust.idcusto, cust.valorUnitario, cust.st, cust.ipi, cust.frete, cust.fretePorcentagen, cust.precoCusto, cust.piscofins, cust.irCsll, cust.Lucro, cust.precoVenda, cust.percentualComissao,
                       grup.idgrupo, grup.descricao AS nome_gru,
                       subg.idsubgrupo, subg.descricaoSubGrupo,
                       marc.idmarca, marc.descricao AS nome_mar,
                       forn.idfornecedor, forn.descricao AS nome_for,
                       unid.idunidade, unid.descricao AS nome_uni,
                       empr.idempresa, empr.nome AS nome_emp
                        
                FROM produto pro LEFT JOIN custo cust      ON pro.custo_idcusto = cust.idcusto
                                 LEFT JOIN grupo grup      ON pro.grupo_idgrupo = grup.idgrupo
                                 LEFT JOIN subgrupo subg   ON pro.subgrupo_idsubgrupo = subg.idsubgrupo
                                 LEFT JOIN marca marc      ON pro.marca_idmarca = marc.idmarca
                                 LEFT JOIN fornecedor forn ON pro.fornecedor_idfornecedor = forn.idfornecedor
                                 LEFT JOIN unidade unid    ON pro.unidade_idunidade = unid.idunidade
                                 LEFT JOIN empresa empr    ON pro.empresa_idempresa = empr.idempresa
                 WHERE pro.idproduto = ?";
       
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $peca->getIDPeca(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $peca->setCodMang($rs->codproduto);
            $peca->setUnitario($rs->valorUnitario);
            $peca->setSt($rs->st);
            $peca->setIpi($rs->ipi);
            $peca->setFrete($rs->frete);
            $peca->setFretep($rs->fretePorcentagen);
            $peca->setPisconfins($rs->piscofins);
            $peca->setIrcs($rs->irCsll);
            $peca->setLucro($rs->Lucro);
            $peca->setPrecovenda($rs->precoVenda);
            $peca->setPrecocusto($rs->precoCusto);
            $peca->setComissao($rs->percentualComissao);
            $peca->setIDCusto($rs->idcusto);
            $peca->setIDGrupo($rs->idgrupo);
            $peca->setIDSubgrupo($rs->idsubgrupo);
            $peca->setIDMarca($rs->idmarca);
            $peca->setMarca($rs->nome_mar);
            $peca->setIDFornecedor($rs->idfornecedor);
            $peca->setIDUnidade($rs->idunidade);
            $peca->setIDEmpresa($rs->idempresa);
            $peca->setCodfabricante($rs->codFabricante);
            $peca->setCodean($rs->codigoEAN);
            $peca->setDescricao($rs->nome_pro);
            $peca->setClassificacao($rs->classificacao);
            $peca->setFracionavel($rs->fracionavel);
            $peca->setLocalizacao($rs->localizacao);
            $peca->setPesobruto($rs->pesoBruto);
            $peca->setPesoliquido($rs->pesoLiquido);
            $peca->setEstoqueatual($rs->estoqueAtual);
            $peca->setEstoquemaximo($rs->estoqueMaximo);
            $peca->setEstoqueminimo($rs->estoqueMinimo);
            $peca->setStatus($rs->status);
            $peca->setDataAlteracao($rs->dataUpdate);
        }
        echo $peca->getDescricao();
        return $peca;
    }

    public function selectBUSCA(ModelPeca $cliente) {
        // echo  " NOME ".$cliente->getBusca();exit();


        $sql = "SELECT idproduto,codproduto,descricao,estoqueAtual,localizacao, status FROM produto
            WHERE descricao LIKE ? ORDER BY descricao ASC ";

        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(1, '%' . $cliente->getBusca() . '%', PDO::PARAM_STR);
        $stmt->execute();


        $arr = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ))
            $arr[] = $row;


        header('Content-type: application/json');
        echo json_encode($arr);
    }

    public function selectAll() {
        $sql = 'SELECT idproduto, codproduto, descricao,estoqueAtual,localizacao, status FROM produto ORDER BY idproduto LIMIT 30';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $pessoa = new ModelPeca();
                $pessoa->setIDPeca($ln->idproduto);
                $pessoa->setCodMang($ln->codproduto);
                $pessoa->setDescricao($ln->descricao);
                $pessoa->setEstoqueatual($ln->estoqueAtual);
                $pessoa->setLocalizacao($ln->localizacao);
                $pessoa->setStatus($ln->status);

                print_r("<tr>
                 <td align='center'><a href=" . "javascript:mudaConteudo('app/view/forPeca.php?idpeca=" . $pessoa->getIDPeca() . "')" . "><img src='resources/images/lapis_alterar.png' title='Alterar Pessoa'/></a></td>
                 <td>" . $pessoa->getIDPeca() . "</td>
                 <td>" . $pessoa->getCodMang() . "</td>
                 <td>" . $pessoa->getDescricao() . "</td>
                 <td>" . $pessoa->getEstoqueatual() . "</td>
                 <td>" . $pessoa->getLocalizacao() . "</td>
                 <td>" . $pessoa->getStatus() . "</td>
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

    public function selectCustopro(ModelPeca $peca) {

        $sql = 'SELECT custo.idcusto, custo.valorUnitario, custo.st, custo.ipi, custo.frete, custo.fretePorcentagen, custo.precoCusto, custo.piscofins, custo.irCsll, custo.Lucro, custo.precoVenda, custo.percentualComissao 
                FROM produto, custo WHERE produto.descricao = ? AND produto.custo_idcusto = custo.idcusto';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $peca->getCustopro(), PDO::PARAM_STR);
        $stmt->execute();

        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $peca->setIDCusto($rs->idcusto);
            $peca->setUnitario($rs->valorUnitario);
            $peca->setSt($rs->st);
            $peca->setIpi($rs->ipi);
            $peca->setFrete($rs->frete);
            $peca->setFretep($rs->fretePorcentagen);
            $peca->setPisconfins($rs->piscofins);
            $peca->setIrcs($rs->irCsll);
            $peca->setLucro($rs->Lucro);
            $peca->setPrecovenda($rs->precoVenda);
            $peca->setPrecocusto($rs->precoCusto);
            $peca->setComissao($rs->percentualComissao);

            /*
              $arr = array();
              $arr['frete']      = $peca->getFrete();
              $arr['idcusto']    = $peca->getIDCusto();
              $arr['unitario']   = $peca->getUnitario();
              $arr['st']         = $peca->getSt();
              $arr['ipi']        = $peca->getIpi();
              $arr['frete_p']    = $peca->getFretep();
              $arr['pisconfins'] = $peca->getPisconfins();
              $arr['ircs']       = $peca->getIrcs();
              $arr['lucro']      = $peca->getLucro();
              $arr['precovenda'] = $peca->getPrecovenda();
              $arr['precocusto'] = $peca->getPrecocusto();
              $arr['comissao']   = $peca->getComissao();
             */

            $arr = $peca->getIDCusto() . "|" . $peca->getUnitario() . "|" . $peca->getSt() . "|" . $peca->getIpi() . "|" . $peca->getFrete();
            $arr = $arr . "|" . $peca->getFretep() . "|" . $peca->getPisconfins() . "|" . $peca->getIrcs() . "|" . $peca->getLucro() . "|" . $peca->getPrecovenda() . "|" . $peca->getPrecocusto() . "|" . $peca->getComissao();
            echo json_encode($arr);

            $su[] = $sub;
        }
    }

    private function message($msg) { //imprime a mensagem na tela
        echo $msg;
    }

}

?>
