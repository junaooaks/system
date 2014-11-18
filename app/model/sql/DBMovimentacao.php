<?php

class DBMovimentacao {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function selectCX(modelMovimentacao $model) {

        $sql = 'SELECT * FROM caixa WHERE idcaixa = ?';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $model->getIdcaixa(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $model->setIdcaixa($rs->idcaixa);
            $model->setSenha($rs->senha);
        }

        return $desconto;
    }

    public function selectCaixa() {

        $sql = 'SELECT * FROM caixa';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $caixa = new modelMovimentacao();
                $caixa->setCaixa($ln->descricao);
                $caixa->setIdcaixa($ln->idcaixa);
                print_r("<option value=" . $caixa->getIdcaixa() . ">" . $caixa->getCaixa() . "</option>");
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

    public function selectCondicao($idformapg) {
        $sql = 'SELECT  * FROM condicaopagamento';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $operacao = $ln->descricao;
                $idop = $ln->idcondicaoPagamento;

                if ($idop == $idformapg) {
                    print_r("<option value=" . $idop . " selected>" . $operacao . "</option>");
                } else {
                    print_r("<option value=" . $idop . ">" . $operacao . "</option>");
                }
            }
        }
    }

    public function insert(modelMovimentacao $model) {
        //pega dados da nota de saida
        $sql = 'SELECT valorFinal FROM notasaida WHERE idnotaSaida =?';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $model->getIDnfs(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $valornf = $rs->valorFinal;
        }
        /*         * ************************************************************************** */

        
        /********************************************************************************** */
//echo $model->getIDnfs();exit();
        //ALTERAR NOTA DE SAIDA
        $cx = 'CX';
        $sss = 'UPDATE notasaida SET operacao = ? WHERE idnotaSaida = ?';

        $st = $this->conex->prepare($sss);
        $st->bindParam(1, $cx, PDO::PARAM_STR);
        $st->bindParam(2, $model->getIDnfs(), PDO::PARAM_STR);
        $st->execute();
        exit();
        /*         * ********************************************************************************** */

        //DAR BAIXA NO ESTOQUE tabela: itensnotasaidaproduto e produto
        $mysql = 'SELECT * FROM itensnotasaidaproduto WHERE notaSaida_idnotaSaida =?';

        $s = $this->conex->prepare($mysql);
        $s->bindParam(1, $model->getIDnfs(), PDO::PARAM_INT);
        $s->execute();

        while ($ln = $s->fetch(PDO::FETCH_OBJ)) {

            $idproduto = $r->produto_idproduto;
            $quantx = $r->quantidade;

            //dar baixa no estoque tabela: produto
            $sql = 'UPDATE produto SET estoqueAtual - ? WHERE idproduto = ?';

            $stmt = $this->conex->prepare($sql);
            $stmt->bindParam(1, $quantx, PDO::PARAM_STR);
            $stmt->bindParam(2, $idproduto, PDO::PARAM_STR);

            $stmt->execute();
        }

        /*         * ****************************************************************************** */

        
        // GERAR CONTAS A RECEBER
        //pegar a forma de pagamento
        $mysq = 'SELECT numeroParcelas, intervaloParcelas, entrada FROM condicaopagamento WHERE idcondicaoPagamento = ?';

        $xpto = $this->conex->prepare($mysq);
        $xpto->bindParam(1, $model->getCondicaopagamento(), PDO::PARAM_INT);
        $xpto->execute();
        $xl = $xpto->fetch(PDO::FETCH_OBJ);
        if (is_object($xl)) {
            $nparcelas = $xl->numeroParcelas;
            $dias = $xl->intervaloParcelas;
            $entrada = $xl->entrada;
        }
        
        //pegar o valor entregue ao caixa e diminur na nota
        $valorx = $valornf - $model->getValor();

        //dividir parcelas
        $valorp = $valorx / $nparcelas;
        
        //data de emissao
        $emissao = date('Y-m-d');
        
        
        /*         * ************************************************************************* */
        //se cliente nao paga a entrada fazer parcelas.
        $valorcx = $model->getValor();
        if (empty($valorcx)){
            
            
            for ($y = 1; $y <= $nparcelas; $y++) {

                $n = $dias + $n;

                //acrescentar numero de dias nas parcelas
                $venpar = date("Y\-m\-d", mktime(date('H'), date('i'), date('s'), date('m'), date('d') + $n, date('Y')));

                //numero de parcelas
                $nnpar = $y . '/' . $nparcelas;
                
                $sq = 'INSERT INTO contasreceber (notaSaida_idnotaSaida, pessoa_idpessoa, dataEmissao, dataVencimento, 
                                              valorOriginal, numeroParcela, valorParcelas)
                VALUES (?,?,?,?,?,?,?)';

                $stm = $this->conex->prepare($sq);
                $stm->bindParam(1, $model->getIDnfs(), PDO::PARAM_STR);
                $stm->bindParam(2, $model->getIDpessoa(), PDO::PARAM_STR);
                $stm->bindParam(3, $emissao, PDO::PARAM_STR);
                $stm->bindParam(4, $venpar, PDO::PARAM_STR);
                $stm->bindParam(5, $valornf, PDO::PARAM_STR);
                $stm->bindParam(6, $nnpar, PDO::PARAM_STR);
                $stm->bindParam(7, $valorp, PDO::PARAM_STR);

                $stm->execute();
            }
        }
        
        
        //se a entrada for do mesmo valor que a parcela compra avista
        if($valorcx==$valornf){
            
            $sq = 'INSERT INTO fluxocaixa (caixa_idcaixa, notasaida_idnotasaida, descricao, valorLiquido, valor)
          VALUES (?,?,?,?,?)';

          $stm = $this->conex->prepare($sq);
          $stm->bindParam(1, $model->getIdcaixa(), PDO::PARAM_STR);
          $stm->bindParam(2, $model->getIDnfs(), PDO::PARAM_STR);
          $stm->bindParam(3, $model->getObs(), PDO::PARAM_STR);
          $stm->bindParam(4, $model->getValor(), PDO::PARAM_STR);
          $stm->bindParam(5, $valornf, PDO::PARAM_STR);
         
          $stm->execute();
        }
        
        //se valor recebido no caixa form menor que o valor da nota
        //da baixa na primeira parcela e registra conta a receber nas outras
        if ($valorcx < $valornf){
            
            //dar baixa no valor recebido
            $sq = 'INSERT INTO fluxocaixa (caixa_idcaixa, notasaida_idnotasaida, descricao, valorLiquido, valor)
          VALUES (?,?,?,?,?)';

          $stm = $this->conex->prepare($sq);
          $stm->bindParam(1, $model->getIdcaixa(), PDO::PARAM_STR);
          $stm->bindParam(2, $model->getIDnfs(), PDO::PARAM_STR);
          $stm->bindParam(3, $model->getObs(), PDO::PARAM_STR);
          $stm->bindParam(4, $model->getValor(), PDO::PARAM_STR);
          $stm->bindParam(5, $valornf, PDO::PARAM_STR);
         
          $stm->execute();
          
          
         $valory = $valornf - $model->getValor();

        //dividir parcelas
        $valorpar = $valory / $nparcelas;
          
            for ($y = 1; $y <= $nparcelas; $y++) {

                $n = $dias + $n;

                //acrescentar numero de dias nas parcelas
                $venpar = date("Y\-m\-d", mktime(date('H'), date('i'), date('s'), date('m'), date('d') + $n, date('Y')));

                //numero de parcelas
                $nnpar = $y . '/' . $nparcelas;
                
                $sq = 'INSERT INTO contasreceber (notaSaida_idnotaSaida, pessoa_idpessoa, dataEmissao, dataVencimento, 
                                              valorOriginal, numeroParcela, valorParcelas)
                VALUES (?,?,?,?,?,?,?)';

                $stm = $this->conex->prepare($sq);
                $stm->bindParam(1, $model->getIDnfs(), PDO::PARAM_STR);
                $stm->bindParam(2, $model->getIDpessoa(), PDO::PARAM_STR);
                $stm->bindParam(3, $emissao, PDO::PARAM_STR);
                $stm->bindParam(4, $venpar, PDO::PARAM_STR);
                $stm->bindParam(5, $valornf, PDO::PARAM_STR);
                $stm->bindParam(6, $nnpar, PDO::PARAM_STR);
                $stm->bindParam(7, $valorpar, PDO::PARAM_STR);

                $stm->execute();
            }
        }















/*

        //pegar o valor entregue ao caixa e diminur na nota
        $valorx = $valornf - $model->getValor();

        //dividir parcelas
        $valorp = $valorx / $nparcelas;

        //data de emissao
        $emissao = date('Y-m-d');

        //SE TIVER ENTRADA PEGA O VALOR ENTRE E REGISTRA COMO ENTRADA
       /* if (($entrada <> 0) || (!empty($entrada))) {
            $sq = 'INSERT INTO contasreceber (notaSaida_idnotaSaida, dataEmissao, dataVencimento, dataRecebimento, valorOriginal, valorRecebido, statu)
                VALUES (?,?,?,?,?,?,?)';

            $stm = $this->conex->prepare($sq);
            $stm->bindParam(1, $model->getIDnfs(), PDO::PARAM_STR);
            $stm->bindParam(2, $emissao, PDO::PARAM_STR);
            $stm->bindParam(3, $emissao, PDO::PARAM_STR);
            $stm->bindParam(4, $emissao, PDO::PARAM_STR);
            $stm->bindParam(5, $model->getValor(), PDO::PARAM_STR);
            $stm->bindParam(6, $valornf, PDO::PARAM_STR);
            $stm->bindParam(7, 'PG', PDO::PARAM_STR);


            $stm->execute();
        }

        //se dinheiro entregue ao caixa for menor que valor da nota parcela o resto
        if (!empty($valorx) || ($valorx <> 0) || ($valorx <> 0.00)) {

            for ($y = 1; $y <= $nparcelas; $y++) {

                $n = $dias + $n;

                //acrescentar numero de dias nas parcelas
                $venpar = date("Y\-m\-d", mktime(date('H'), date('i'), date('s'), date('m'), date('d') + $n, date('Y')));

                //numero de parcelas
                $nnpar = $y . '/' . $nparcelas;

                $sq = 'INSERT INTO contasreceber (notaSaida_idnotaSaida, dataEmissao, dataVencimento, 
                                              valorOriginal, numeroParcela, valorParcelas)
                VALUES (?,?,?,?,?,?)';

                $stm = $this->conex->prepare($sq);
                $stm->bindParam(1, $model->getIDnfs(), PDO::PARAM_STR);
                $stm->bindParam(2, $emissao, PDO::PARAM_STR);
                $stm->bindParam(3, $venpar, PDO::PARAM_STR);
                $stm->bindParam(4, $valornf, PDO::PARAM_STR);
                $stm->bindParam(5, $nnpar, PDO::PARAM_STR);

                $stm->execute();
            }
        }


*/

//$ok = $stmt->execute();


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




        $sql = 'UPDATE notasaida SET operacao = ?, condicaoPagamento_idcondicaoPagamento = ?, valorProdutos = ?, desconto = ?, frete = ?, valorFinal=?, totalLinhas = ? WHERE idnotaSaida = ?';

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

    public function select(modelMovimentacao $nfe) {

        $sql = 'SELECT  operacao, nf, condicaoPagamento_idcondicaoPagamento, desconto, 
                        idpessoa, pessoa.nome AS pessoa, pessoa.endereco AS enderecoPessoa, pessoa.numero AS pessoaN, 
                        pessoa.bairro AS pessoaB, pessoa.cep AS pessoaC, pessoa.cidade AS pessoaC, ativo, frete, 
                        valorFinal, totalLinhas, funcionario.nome AS funcionario, funcionario.idfuncionario
                FROM pessoa, notasaida, comissao, funcionario
                WHERE idnotaSaida =?
                AND idpessoa = pessoa_idpessoa
                AND funcionario.idfuncionario = comissao.funcionario_idfuncionario
                AND notasaida.idnotasaida = comissao.notaSaida_idnotaSaida';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $nfe->getIDnfs(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $nfe->setFormapg($rs->operacao);
            $nfe->setIDformapg($rs->condicaoPagamento_idcondicaoPagamento);
            $nfe->setValorDesconto($rs->desconto);
            $nfe->setIDcliente($rs->idpessoa);
            $nfe->setCliente($rs->pessoa);
            $nfe->setEndereco($rs->enderecoPessoa);
            $nfe->setNumero($rs->pessoaN);
            $nfe->setBairro($rs->pessoaB);
            $nfe->setCep($rs->pessoaC);
            $nfe->setCidade($rs->pessoaC);
            $nfe->setAtivo($rs->ativo);
            $nfe->setQuantitem($rs->totalLinhas);
            $nfe->setTotal($rs->valorFinal);
            $nfe->setFrete($rs->frete);
            $nfe->setNF($rs->nf);
            $nfe->setIDVendedor($rs->idfuncionario);
            $nfe->setVendedor($rs->funcionario);
        }
    }

    public function selectBUSCA(modelMovimentacao $model) {
        $cliente = trim($model->getBuscaCliente());
        /* SELECT idnotaSaida,nf,nome,DATE_FORMAT(data , "%d/%m/%Y") AS Data, valorProdutos, operacao.descricao AS operacao, condicaopagamento.descricao AS condicaopagamento
          FROM pessoa, notasaida, operacao, condicaoPagamento
          WHERE pessoa.nome LIKE ? || notasaida.nf = ?
          AND pessoa.idpessoa = notasaida.pessoa_idpessoa
          AND notasaida.operacao_idoperacao = operacao.idoperacao
          AND notasaida.condicaoPagamento_idcondicaoPagamento = condicaoPagamento.idcondicaoPagamento */

        $sql = 'SELECT idnotaSaida,nf,nome,DATE_FORMAT(data , "%d/%m/%Y") AS Data, valorProdutos, operacao.descricao AS operacao, condicaopagamento.descricao AS condicaopagamento
                FROM pessoa
                INNER JOIN notasaida ON pessoa.idpessoa =  notasaida.pessoa_idpessoa
                INNER JOIN operacao ON notasaida.operacao_idoperacao = operacao.idoperacao
                INNER JOIN condicaoPagamento ON notasaida.condicaoPagamento_idcondicaoPagamento = condicaoPagamento.idcondicaoPagamento
                WHERE pessoa.nome LIKE ? || notasaida.nf = ?
                AND notasaida.situacao IS NULL
                ';

        /*
         * 'SELECT produto_idproduto, quantidade, nomeProduto, valorProduto, estoqueAtual, totalLinhas
          FROM produto
          INNER JOIN itensnotasaidaproduto on produto.idproduto =  itensnotasaidaproduto.produto_idproduto
          INNER JOIN notasaida on itensnotasaidaproduto.notaSaida_idnotaSaida = notasaida.idnotasaida
          WHERE idnotaSaida = ?'
         */

        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(1, '%' . $cliente . '%', PDO::PARAM_STR);
        $stmt->bindParam(2, $model->getCodnfe(), PDO::PARAM_STR);

        $stmt->execute();


        $arr = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ))
            $arr[] = $row;


        header('Content-type: application/json');
        echo json_encode($arr);
    }

    public function selectAll($caixa) {

        $sql = 'SELECT idnotaSaida,nf,nome,DATE_FORMAT(data , "%d/%m/%Y") AS Data, valorProdutos, operacao, operacao.descricao AS operacao, 
			  condicaopagamento.descricao AS condicaopagamento

                FROM pessoa, notasaida, operacao, condicaopagamento

                WHERE pessoa.idpessoa = notasaida.pessoa_idpessoa
                AND notasaida.operacao_idoperacao = operacao.idoperacao
                AND notasaida.condicaoPagamento_idcondicaoPagamento = condicaopagamento.idcondicaoPagamento
                AND notasaida.situacao IS NULL
                ORDER BY idnotaSaida DESC
                ';

        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $pessoa = new modelMovimentacao();
                $pessoa->setIDnfs($ln->idnotaSaida);
                $pessoa->setCliente($ln->nome);
                $pessoa->setDataentrada($ln->Data);
                $pessoa->setValorfinal($ln->valorProdutos);
                $pessoa->setOperacao($ln->operacao);
                $pessoa->setCondicaopagamento($ln->condicaopagamento);
                //$tipo = $ln->operacao;
                $nfs = $ln->nf;

                /*                $tipo = 'ORÇAMENTO';
                  $pessoa->setTipo($tipo);
                 */
                print_r("<tr>  
                 <td align='center'><a href=" . "javascript:mudaConteudo('app/view/forMovimentacao.php?idnf=" . $pessoa->getIDnfs() . "&caixa=" . $caixa . "')" . "><img src='resources/images/apply.png' title='Alterar Pessoa'/></a></td>
                 <td>" . $nfs . "</td>
                 <td>" . $pessoa->getCliente() . "</td>
                 <td>" . $pessoa->getDataentrada() . "</td>
                 <td>" . $pessoa->getValorfinal() . "</td>
                 <td>" . $pessoa->getOperacao() . "</td>
                 <td>" . $pessoa->getCondicaopagamento() . "</td>
                 
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

    /* public function selectSEL($idformapg) {
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
      } */

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

    public function selectNF(modelMovimentacao $nfe) {

        $sql = 'SELECT idnotaSaida,nf,DATE_FORMAT(data , "%d/%m/%Y") AS Data, valorProdutos, operacao, operacao.descricao AS operacao, condicaopagamento.descricao AS condicaopagamento
                FROM notasaida, operacao, condicaopagamento
                WHERE notasaida.idnotaSaida = ?
                AND notasaida.operacao_idoperacao = operacao.idoperacao
                AND notasaida.condicaoPagamento_idcondicaoPagamento = condicaopagamento.idcondicaoPagamento';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $nfe->getIDnfs(), PDO::PARAM_INT);
        $stmt->execute();
        while ($ln = $stmt->fetch(PDO::FETCH_OBJ)) {
            $nfe->setIDnfs($ln->idnotaSaida);
            $nfe->setCliente($ln->nome);
            $nfe->setDataentrada($ln->Data);
            $nfe->setValorfinal($ln->valorProdutos);
            $nfe->setOperacao($ln->operacao);
            $nfe->setCondicaopagamento($ln->condicaopagamento);
            //$tipo = $ln->operacao;
            $nfs = $ln->nf;

            /*                $tipo = 'ORÇAMENTO';
              $pessoa->setTipo($tipo);
             */
            echo "<tr>
                         
                    <td align='center'><input name=\"ativo[]\" type=\"checkbox\" value=\"$nfe->getIDnfs()\" class=\"effect\"/></td>
                    <td align='center'>$nfs</td>
                    <td align='center'>" . $nfe->getDataentrada() . "</td>
                    <td align='center'>" . $nfe->getValorfinal() . "</td>
                    
           </tr>";


            /*
              print_r("<tr>
              <td align='center'><a href=" . "javascript:mudaConteudo('app/view/forMovimentacao.php?idnf=" . $nfe->getIDnfs() . "')" . "><img src='resources/images/apply.png' title='Alterar Pessoa'/></a></td>
              <td>" . $nfs . "</td>
              <td>" . $nfe->getDataentrada() . "</td>
              <td align='center'>" . $nfe->getValorfinal() . "</td>
              <!--td>" . $nfe->getOperacao() . "</td>
              <td >" . $nfe->getCondicaopagamento() . "</td-->

              </tr>");
             */
        }
    }

    private function message($msg) { //imprime a mensagem na tela
        echo $msg;
    }

}

?>
