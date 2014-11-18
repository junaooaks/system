<?php

class DBNFentrada {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function verificar(modelNFentrada $inseri) {
        //echo $inseri->getNf();
        $sql = 'SELECT  numeroPedido FROM notaentrada WHERE numeroPedido = ?';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $inseri->getNf(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $inseri->setNf($rs->numeroPedido);

            $nfx = $inseri->getNf();
            if (!empty($nfx)) {
                echo "ESTA NOTA JA FOI DADO ENTRADA FALE COM ADMINISTRADOR";
                exit();
            }
        }

        return $nfx;
    }

    public function insert(modelNFentrada $inseri) {
        //echo "nf".$insert->getNf();exit();
        $quantidadeitens = $inseri->getQuantitem() - 1;
        $idnf = $inseri->getIDnfe();
        if (empty($idnf)) {

            $sql = 'INSERT INTO notaentrada (fornecedor_idfornecedor, operacao_idoperacao, empresa_idempresa, numeroPedido, dataEmissao, dataEntrada, valorFinal, condicaoPagamento, perAcrescimo, total, obs, totalitens, operacao)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';

            $stmt = $this->conex->prepare($sql);
            $stmt->bindParam(1, $inseri->getIDFornecedor(), PDO::PARAM_STR);
            $stmt->bindParam(2, $inseri->getIDOperacao(), PDO::PARAM_STR);
            $stmt->bindParam(3, $inseri->getIDEmpresa(), PDO::PARAM_STR);
            $stmt->bindParam(4, $inseri->getNf(), PDO::PARAM_STR);
            $stmt->bindParam(5, $inseri->getDataemissao(), PDO::PARAM_STR);
            $stmt->bindParam(6, $inseri->getDataentrada(), PDO::PARAM_STR);
            $stmt->bindParam(7, $inseri->getValorfinal(), PDO::PARAM_STR);
            $stmt->bindParam(8, $inseri->getCondicaopg(), PDO::PARAM_STR);
            $stmt->bindParam(9, $inseri->getAcrescimo(), PDO::PARAM_STR);
            $stmt->bindParam(10, $inseri->getTotal(), PDO::PARAM_STR);
            $stmt->bindParam(11, $inseri->getObs(), PDO::PARAM_STR);
            $stmt->bindValue(12, $quantidadeitens, PDO::PARAM_INT);
            $stmt->bindParam(13, $inseri->getIDOperacao(), PDO::PARAM_STR);

            $stmt->execute();

            $lastId = $this->conex->lastInsertId();
            // echo "id n ".$lastId;
        }
        //tabela de produto
        //echo $lastId;        exit ();


        for ($x = 1; $x <= $inseri->getQuantitem(); $x++) {

            if ($x == 1) {
                $x = $x + 1;
            }

            $item = $_POST["item$x"];
            $quantidade = $_POST["quantidade$x"];
            $uni = $_POST["uni$x"];
            $custo = $_POST["custo$x"];
            $ipi = $_POST["ipi$x"];
            $frete = $_POST["frete$x"];
            $st = $_POST["st$x"];

            $somatotal = $custo + $soma;

            //explode item na virgula
            $item = explode(',', $item . $x);

            //retirar espaço em branco espaço
            $item[0] = rtrim($item[0]);

            $codpro = $item[0];
            $nomepro = $item[1];
            //aqui seu código com o uso dos valores capturados

            $sql = 'INSERT INTO itensprodutonotaentrada (produto_idproduto, notaEntrada_idnotaEntrada, quantidade, valorUnitario, valorLote, data)
                VALUES (?,?,?,?,?,?)';

            $stmt = $this->conex->prepare($sql);
            $stmt->bindParam(1, $codpro, PDO::PARAM_STR);
            $stmt->bindParam(2, $lastId, PDO::PARAM_STR);
            $stmt->bindParam(3, $quantidade, PDO::PARAM_STR);
            $stmt->bindParam(4, $uni, PDO::PARAM_STR);
            $stmt->bindParam(5, $custo, PDO::PARAM_STR);
            $stmt->bindParam(6, $inseri->getDataentrada(), PDO::PARAM_STR);

            $ok = $stmt->execute();




            $sql = 'UPDATE produto, custo SET estoqueAtual = estoqueAtual + (?), st=?, ipi=?, frete=? WHERE idproduto = ? AND produto.custo_idcusto = custo.idcusto';

            $stmt = $this->conex->prepare($sql);
            $stmt->bindParam(1, $quantidade, PDO::PARAM_INT);
            $stmt->bindParam(2, $st, PDO::PARAM_STR);
            $stmt->bindParam(3, $ipi, PDO::PARAM_STR);
            $stmt->bindParam(4, $frete, PDO::PARAM_STR);
            $stmt->bindParam(5, $codpro, PDO::PARAM_INT);


            $rs = $stmt->execute();

            $soma = $somatotal;

            $x = $x++;
        }

        $msg = $ok === TRUE ? 'Nota Entrada cadastrado com sucesso!' : 'Falha ao tentar Cadastrar Nota';

        self::message($msg);
    }

    public function update(modelNFentrada $inseri) {

        //verificar se usuario removel algum item da nota entrada
        $ativo = $inseri->getAtivo();

        //pegar a quantidade de produto que foi dado entrada
        $sql = 'SELECT  produto_idproduto,totalitens 
                    FROM itensprodutonotaentrada, notaentrada 
                    WHERE notaEntrada_idnotaEntrada = ?
                    AND notaentrada.idnotaEntrada = itensprodutonotaentrada.notaEntrada_idnotaEntrada';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $inseri->getIDnfe(), PDO::PARAM_INT);
        $stmt->execute();

        while ($ln = $stmt->fetch(PDO::FETCH_OBJ)) {

            $totalitens = $ln->totalitens;
            $produ[] = $ln->produto_idproduto;
        }


        for ($i = 0; $i < count($ativo); $i++) {
            
            $codpro = intval($ativo[$i]);

            //verificar a quantidade de items que foi dado entrada
            $sql = 'SELECT  produto_idproduto,quantidade 
                    FROM itensprodutonotaentrada 
                    WHERE notaEntrada_idnotaEntrada = ?
                    AND produto_idproduto = ?';

            $stmt = $this->conex->prepare($sql);
            $stmt->bindParam(1, $inseri->getIDnfe(), PDO::PARAM_INT);
            $stmt->bindParam(2, $codpro, PDO::PARAM_INT);
            $stmt->execute();
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            if (is_object($rs)) {
                $quanti = $rs->quantidade;
                $produ = $rs->produto_idproduto;
                
             if ($inseri->getIDOperacao()==2){   
                $sql = 'UPDATE produto SET estoqueAtual = estoqueAtual - (?) 
                            WHERE idproduto = ? ';

                $stmt = $this->conex->prepare($sql);
                $stmt->bindParam(1, $quanti, PDO::PARAM_INT);
                $stmt->bindParam(2, $produ, PDO::PARAM_INT);


                $rs = $stmt->execute();

                //deletar item da nota de entrada
                $sql = 'DELETE FROM itensprodutonotaentrada WHERE produto_idproduto = ?
                        AND notaEntrada_idnotaEntrada = ?';
                $stmt = $this->conex->prepare($sql);
                $stmt->bindParam(1, $codpro, PDO::PARAM_INT);
                $stmt->bindParam(2, $inseri->getIDnfe(), PDO::PARAM_INT);
                $rs = $stmt->execute();

                if ($rs === true) {
                    $quantidade = $inseri->getQuantitem();
                    $quantidade = $quantidade - 2;
                }
              }
            }
        }
        
        /*********************************************************************************** */
        
        //atualizar os dados da tabela de entrada
        $sql = 'UPDATE notaentrada 
                SET fornecedor_idfornecedor = ?, operacao_idoperacao = ?,
                empresa_idempresa = ?, numeroPedido = ?, dataEmissao = ?,
                dataEntrada = ?, valorFinal = ?, condicaoPagamento = ?,
                perAcrescimo = ?, total = ?, obs = ?, totalitens = ?,
                operacao=?
                WHERE idnotaEntrada = ? ';

        //remover 1 da quantidade
        if ($rs == false) {
            $quantidade = $inseri->getQuantitem();
            $quantidade = $quantidade - 1;
        }

        if(!empty ($ativo)){
            $ret = sizeof($ativo);
            $quantidade = $quantidade - $rest;
        }

        //se tiver campos vazios tirar menos um
        //while($){}

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $inseri->getIDFornecedor(), PDO::PARAM_STR);
        $stmt->bindParam(2, $inseri->getIDOperacao(), PDO::PARAM_STR);
        $stmt->bindParam(3, $inseri->getIDEmpresa(), PDO::PARAM_STR);
        $stmt->bindParam(4, $inseri->getNf(), PDO::PARAM_STR);
        $stmt->bindParam(5, $inseri->getDataemissao(), PDO::PARAM_STR);
        $stmt->bindParam(6, $inseri->getDataentrada(), PDO::PARAM_STR);
        $stmt->bindParam(7, $inseri->getValorfinal(), PDO::PARAM_STR);
        $stmt->bindParam(8, $inseri->getCondicaopg(), PDO::PARAM_STR);
        $stmt->bindParam(9, $inseri->getAcrescimo(), PDO::PARAM_STR);
        $stmt->bindParam(10, $inseri->getTotal(), PDO::PARAM_STR);
        $stmt->bindParam(11, $inseri->getObs(), PDO::PARAM_STR);
        $stmt->bindParam(12, $quantidade, PDO::PARAM_INT);
        $stmt->bindParam(13, $inseri->getIDOperacao(), PDO::PARAM_STR);
        $stmt->bindParam(14, $inseri->getIDnfe(), PDO::PARAM_INT);

        $rs = $stmt->execute();

        /***************************************************************************************** */
        
        
        if(!empty ($ativo)){
            $ret = sizeof($ativo);
            $ln = $inseri->getQuantitem() - $rest;
        }else{
            $ln = $inseri->getQuantitem();
        }
        
        for ($y = 2; $y <= $ln; $y++) {

            /*if ($y == 1) {
                $y = $y + 1;
            }*/

            $item       = $_POST["item$y"];
            $qua        = $_POST["quantidade$y"];
            $uni        = $_POST["uni$y"];
            $custo      = $_POST["custo$y"];
            $ipi        = $_POST["ipi$y"];
            $frete      = $_POST["frete$y"];
            $st         = $_POST["st$y"];
            
            $frete = number_format($frete, 2, '.', '');
            
           // echo $frete;
            
            $somatotal = $custo + $soma;

            //explode item na virgula
            $item = explode(',', $item . $y);

            //retirar espaço em branco espaço
            $item[0] = rtrim($item[0]);

            $codpro = intval($item[0]);
            
            
            $nomepro = $item[1];
            
            //verifica se foi selecionado um item para deletar
            if(!empty ($ativo)){
            $produto = in_array($codpro, $ativo);
            }
            
            if(empty($produto)){
                
            //verificar se item esta inserido na tabela
            $sql = 'SELECT  produto_idproduto 
                    FROM itensprodutonotaentrada 
                    WHERE notaEntrada_idnotaEntrada = ?
                    AND produto_idproduto = ?';

            $stmt = $this->conex->prepare($sql);
            $stmt->bindParam(1, $inseri->getIDnfe(), PDO::PARAM_INT);
            $stmt->bindParam(2, $codpro, PDO::PARAM_INT);
            $stmt->execute();
            /*$rs = $stmt->fetch(PDO::FETCH_OBJ);
            if (is_object($rs)) {
                $idpror = $rs->roduto;
*/
            //contar as linha de retorno do mysql se retorno for zero entao inserir produto
            $cont = $stmt->rowCount();
           
            if(!empty ($ativo)){
                $produto = in_array($codpro, $ativo);
               // echo $produto;
            }
            
            if ($cont == '') {
                
                //inserir produto na tabela
                $sql = 'INSERT INTO itensprodutonotaentrada (produto_idproduto, notaEntrada_idnotaEntrada, quantidade, valorUnitario, valorLote, data)
                VALUES (?,?,?,?,?,?)';

                $stmt = $this->conex->prepare($sql);
                $stmt->bindParam(1, $codpro, PDO::PARAM_STR);
                $stmt->bindParam(2, $inseri->getIDnfe(), PDO::PARAM_STR);
                $stmt->bindParam(3, $qua, PDO::PARAM_STR);
                $stmt->bindParam(4, $uni, PDO::PARAM_STR);
                $stmt->bindParam(5, $custo, PDO::PARAM_STR);
                $stmt->bindParam(6, $inseri->getDataentrada(), PDO::PARAM_STR);

                $rs = $stmt->execute();

                if ($inseri->getIDOperacao()==2){
                $sql = 'UPDATE produto, custo SET estoqueAtual = estoqueAtual + (?), st=?, ipi=?, frete=? WHERE idproduto = ? AND produto.custo_idcusto = custo.idcusto';

                $stmt = $this->conex->prepare($sql);
                $stmt->bindParam(1, $qua, PDO::PARAM_INT);
                $stmt->bindParam(2, $st, PDO::PARAM_STR);
                $stmt->bindParam(3, $ipi, PDO::PARAM_STR);
                $stmt->bindParam(4, $frete, PDO::PARAM_STR);
                $stmt->bindParam(5, $codpro, PDO::PARAM_INT);


                $rs = $stmt->execute();
                }
              }
            }
         //echo $y.' ';
        }

        /* print_r($codpro);exit();
          //verificar se variavel e tipo array
          if(is_array($codpro)){


          $lnmais = array_diff($codpro, $produ);

          print_r($lnmais);

          } */





        /*
          $cont = count($inseri->getQuantitem());

          //pegar a quantidade de produto que foi dado entrada
          $sql = 'SELECT  produto_idproduto,quantidade
          FROM itensprodutonotaentrada
          WHERE notaEntrada_idnotaEntrada = ?
          ';

          $stmt = $this->conex->prepare($sql);
          $stmt->bindParam(1, $inseri->getIDnfe(), PDO::PARAM_INT);
          $stmt->execute();

          while ($ln = $stmt->fetch(PDO::FETCH_OBJ)) {

          $quanti = $ln->quantidade;
          $produ[] = $ln->produto_idproduto;
          }

          $ativo = $inseri->getAtivo();

          for ($x = 1; $x <= $inseri->getQuantitem(); $x++) {

          if ($x == 1) {
          $x = $x + 1;
          }


          $item = $_POST["item$x"];
          $quantidade = $_POST["quantidade$x"];
          $uni = $_POST["uni$x"];
          $custo = $_POST["custo$x"];
          $ipi = $_POST["ipi$x"];
          $frete = $_POST["frete$x"];
          $st = $_POST["st$x"];

          $somatotal = $custo + $soma;

          //explode item na virgula
          $item = explode(',', $item . $x);

          //retirar espaço em branco espaço
          $item[0] = rtrim($item[0]);

          $codpro = $item[0];
          $nomepro = $item[1];

          //aqui seu código com o uso dos valores capturados

          $sql = 'SELECT  produto_idproduto,quantidade
          FROM itensprodutonotaentrada
          WHERE notaEntrada_idnotaEntrada = ?';

          $stmt = $this->conex->prepare($sql);
          $stmt->bindParam(1, $inseri->getIDnfe(), PDO::PARAM_INT);
          $stmt->execute();
          $rs = $stmt->fetch(PDO::FETCH_OBJ);
          if (is_object($rs)) {
          $quanti = $rs->quantidade;

          $produ = $rs->produto_idproduto;

          //fazer o calculo matematico para alterar tabela
          if ($produ == $codpro) {
          if ($quantidade <> $quanti) {
          $quan = $quantidade - $quanti;
          }
          }
          }


          $sql = 'UPDATE itensprodutonotaentrada
          SET produto_idproduto=?, quantidade=?, valorUnitario=?, valorLote=?, data=?
          WHERE notaEntrada_idnotaEntrada=?
          AND produto_idproduto=?';

          $stmt = $this->conex->prepare($sql);
          $stmt->bindParam(1, $produ, PDO::PARAM_STR);
          $stmt->bindParam(2, $quantidade, PDO::PARAM_STR);
          $stmt->bindParam(3, $uni, PDO::PARAM_STR);
          $stmt->bindParam(4, $custo, PDO::PARAM_STR);
          $stmt->bindParam(5, $inseri->getDataentrada(), PDO::PARAM_STR);
          $stmt->bindParam(6, $inseri->getIDnfe(), PDO::PARAM_STR);
          $stmt->bindParam(7, $codpro, PDO::PARAM_STR);

          $ok = $stmt->execute();

          $sql = 'UPDATE produto, custo SET estoqueAtual = estoqueAtual + (?), st=?, ipi=?, frete=?
          WHERE idproduto = ?
          AND produto.custo_idcusto = custo.idcusto';

          $stmt = $this->conex->prepare($sql);
          $stmt->bindParam(1, $quan, PDO::PARAM_INT);
          $stmt->bindParam(2, $st, PDO::PARAM_STR);
          $stmt->bindParam(3, $ipi, PDO::PARAM_STR);
          $stmt->bindParam(4, $frete, PDO::PARAM_STR);
          $stmt->bindParam(5, $codpro, PDO::PARAM_INT);


          $rs = $stmt->execute();

          $soma = $somatotal;

          $x = $x++;
          }

          if($cont<>$quantpro){
          //verificar qual produto que foi adicionado para registra no banco de dados
          $sql = 'SELECT  produto_idproduto
          FROM itensprodutonotaentrada
          WHERE notaEntrada_idnotaEntrada = ?';

          $stmt = $this->conex->prepare($sql);
          $stmt->bindParam(1, $inseri->getIDnfe(), PDO::PARAM_INT);

          $stmt->execute();
          $rs = $stmt->fetch(PDO::FETCH_OBJ);
          if (is_object($rs)) {
          $quanti = $rs->quantidade;
          $produ = $rs->produto_idproduto;
          }
          //remover zero a esquerda

          //$propro = intval($codpro);

          //print_r($produ.','.$propro);
          //$resul = array_diff($codpro,$produ);

          }
         */

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

    public function select(modelNFentrada $nfe) {

        $sql = 'SELECT  fornecedor.idfornecedor, fornecedor.descricao AS fornema,
                        notaentrada.idnotaEntrada, notaentrada.numeroPedido, DATE_FORMAT(notaentrada.dataEmissao, "%d/%m/%Y") AS dataEm, DATE_FORMAT(notaentrada.dataEntrada, "%d/%m/%Y") AS dataEn, notaentrada.valorFinal,
                        notaentrada.totalitens, notaentrada.total, notaentrada.condicaoPagamento, notaentrada.perAcrescimo, notaentrada.obs, notaentrada.operacao,
                        operacao.idoperacao, operacao.descricao AS opename,
                        empresa.idempresa, empresa.nome AS empname
                
                FROM notaentrada,fornecedor, operacao, empresa 
                WHERE notaentrada.idnotaEntrada = ? 
                AND notaentrada.fornecedor_idfornecedor = fornecedor.idfornecedor
                AND notaentrada.operacao_idoperacao = operacao.idoperacao
                AND notaentrada.empresa_idempresa = empresa.idempresa';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $nfe->getIDnfe(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $nfe->setIDFornecedor($rs->idfornecedor);
            $nfe->setFornecedor($rs->fornema);
            $nfe->setNf($rs->numeroPedido);
            $nfe->setDataemissao($rs->dataEm);
            $nfe->setDataentrada($rs->dataEn);
            $nfe->setValorfinal($rs->valorFinal);
            $nfe->setCondicaopg($rs->condicaoPagamento);
            $nfe->setAcrescimo($rs->perAcrescimo);
            $nfe->setObs($rs->obs);
            $nfe->setTotal($rs->total);
            $nfe->setIDOperacao($rs->operacao);
            $nfe->setOperacao($rs->opename);
            $nfe->setIDnfe($rs->idnotaEntrada);
            $nfe->setIDEmpresa($rs->idempresa);
            $nfe->setEmpresa($rs->empname);
            $setQuantitem = $rs->totalitens + 1;
            $nfe->setQuantitem($setQuantitem);

            // echo $nfe->getQuantitem();
        }

        return $nfe;
    }

    public function selectBUSCA(modelNFentrada $inseri) {
        //echo "numero pedido = ".$inseri->getNf();exit();
       //echo $inseri->getDataemissao();
        
        $sql = "SELECT idnotaEntrada, numeroPedido,  DATE_FORMAT(dataEntrada, '%d/%m/%Y') as dataEnt, DATE_FORMAT(dataEmissao,'%d/%m/%Y') as dataEmi, valorFinal, condicaoPagamento, descricao, operacao 
                      FROM notaentrada INNER JOIN fornecedor on fornecedor_idfornecedor = idfornecedor
                      WHERE fornecedor.descricao LIKE ? 
                      AND notaentrada.dataEmissao LIKE ?
                      AND notaentrada.dataEntrada LIKE ?
                      AND notaentrada.numeroPedido LIKE ?
                      ";

        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(1, '%' . $inseri->getFornecedor() . '%', PDO::PARAM_STR);
        $stmt->bindValue(2, '%' . $inseri->getDataemissao() . '%', PDO::PARAM_STR);
        $stmt->bindValue(3, '%' . $inseri->getDataentrada() . '%', PDO::PARAM_STR);
        $stmt->bindValue(4, '%' . $inseri->getNf() . '%', PDO::PARAM_STR);
        $stmt->execute();


        $arr = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ))
            $arr[] = $row;


        header('Content-type: application/json');
        echo json_encode($arr);
    }

    public function selectAll() {
        mysql_connect('localhost', 'sisgew', 'sgw258789');
        mysql_select_db('sisgew_webcom');

        $_pagi_sql = "SELECT operacao,idnotaEntrada, numeroPedido,  DATE_FORMAT(dataEntrada, '%d/%m/%Y') as dataEnt, DATE_FORMAT(dataEmissao,'%d/%m/%Y') as dataEmi, valorFinal, condicaoPagamento, descricao FROM notaentrada, fornecedor WHERE fornecedor_idfornecedor = idfornecedor ORDER BY dataEntrada DESC";
        $_pagi_cuantos = 100; //número de registros por pagina. Padrão:20

        include_once('../../app/controller/paginator.inc.php');

        $class = '#E2EBCC';

        while ($row = mysql_fetch_array($_pagi_result)) {
            $op = $row['operacao'];
            
            if($op==1){
                $tipo = 'PEDIDO';
            }
            if($op==2){
                $tipo = 'ENTRADA';
            }
            echo "
                <tr style='background:$class;' id ='um'>
          <td align='center'><a href=" . "javascript:mudaConteudo('app/view/forNF.php?idnf=" . $row['idnotaEntrada'] . "')" . "><img src='resources/images/lapis_alterar.png' title='Alterar Pessoa'/></a></td>
          <td>" . $tipo . "</td>
          <td>" . $row['numeroPedido'] . "</td>
          <td>" . $row['descricao'] . "</td>
          <td>" . $row['dataEnt'] . "</td>
          <td>" . $row['dataEmi'] . "</td>
          <td> R$: " . $row['valorFinal'] . "</td>
         
          </tr>";


            if ($class == '#E2EBCC') {
                $class = '#FFFFFF';
            } else {
                $class = '#E2EBCC';
            }
        }


        /* if (mysql_num_rows($_pagi_result) > 0) {
          echo"


          <td height='30' valign='bottom' colspan='6' id ='dois'> " . $_pagi_navegacion . "</td>
          ";
          } */
    }

    public function selectPro($nnfe, $quantitens) {

        $sql = 'SELECT produto.idproduto, produto.descricao, 
                custo.st, custo.ipi, custo.frete,
                itensprodutonotaentrada.quantidade, itensprodutonotaentrada.valorUnitario, itensprodutonotaentrada.valorLote 
                FROM notaentrada, itensprodutonotaentrada, produto, custo
                WHERE notaentrada.idnotaEntrada = ?
                AND notaentrada.idnotaEntrada = itensprodutonotaentrada.notaEntrada_idnotaEntrada
                AND itensprodutonotaentrada.produto_idproduto = produto.idproduto
                AND produto.custo_idcusto = custo.idcusto';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $nnfe, PDO::PARAM_INT);
        $stmt->execute();

        $x = 1;
        while ($ln = $stmt->fetch(PDO::FETCH_OBJ)) {

            $idproduto = ($ln->idproduto);
            $produto = ($ln->descricao);
            $quantidade = ($ln->quantidade);
            $unitario = ($ln->valorUnitario);
            $lote = ($ln->valorLote);

            $st = ($ln->st);
            $ipi = ($ln->ipi);
            $frete = ($ln->frete);

            $codpro = str_pad($idproduto, 5, "0", STR_PAD_LEFT);

            // for ($x = 1; $x <= $quantitens; $x++) {
            if ($x <= $quantitens) {
                $next = 1 + $x;

                echo "<tr>
                    <td><input name=\"ativo[]\" type=\"checkbox\" value=\"$codpro\" class=\"effect\"/></td>
                    <td><input type='text' name='item" . $next . "' size='70' class='effect auto' onkeyup='up(this)' value='$codpro,  $produto' readonly='true'/></td>
                    <td><input type='text' name='quantidade" . $next . "' size='5' class='effect' onkeyup='up(this)' id='quantidade1' value='$quantidade' readonly='true'/></td>
                    <td><input type='text' name='uni" . $next . "' size='8' class='effect' onkeyup='up(this)' value ='$unitario' readonly='true'/></td>
                    <td><input type='text' name='custo" . $next . "' size='5' id='moeda' class='effect soma' onBlur='calculateSum();' value = '$lote' readonly='true'/></td>
                    <td><input type='text' name='st" . $next . "' size='5' class='effect stt ' onBlur='calculateST();' value='$st' readonly='true'/></td>
                    <td><input type='text' name='ipi" . $next . "' size='5' class='effect ip ' onBlur='calculaIPI();' value = '$ipi' readonly='true'/></td>
                    <td><input type='text' name='frete" . $next . "' size='5' class='effect fre ' onBlur='calculateFRETE();' value = '$frete' readonly='true'/></td>
                    <!--td align='center' id='menos" . $next . "'><a href='#' onclick ='$(this).parent().parent().remove(); calculateSum();calculateFRETE();calculaIPI();calculateST();'><img src='resources/images/menos.png' border='0'/></a></td-->
                
            </tr>";
            }


            //$pessoas[] = $nf;

            $x = $x + 1;
            $somast = $st + $somast;
            $somaipi = $ipi + $somaipi;
            $somafrete = $frete + $somafrete;
            $somalote = $lote + $somalote;
        }

        /* if (!is_array($pessoas)) {
          throw new PDOException('Nenhum registro foi encontrado');
          } */
        return array($somalote, $somast, $somaipi, $somafrete, $somafrete);
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

    public function selectOperacao($idope) {
        $sql = 'SELECT idoperacao, descricao FROM operacao';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $operacao = new modelNFentrada();

                $operacao->setOperacao($ln->descricao);
                $operacao->setIDOperacao($ln->idoperacao);

                $xe = $operacao->getIDOperacao();

                if ($idope == $xe) {
                    print_r("<option value=" . $operacao->getIDOperacao() . " selected>" . $operacao->getOperacao() . "</option>");
                } else {
                    print_r("<option value=" . $operacao->getIDOperacao() . ">" . $operacao->getOperacao() . "</option>");
                }
                $oper[] = $operacao;
            }
        }
    }

    public function selectFornecedor($idforn) {

        $sql = 'SELECT idfornecedor,descricao  FROM fornecedor';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {

                $nf = new modelNFentrada();

                $nf->setFornecedor($ln->descricao);
                $nf->setIDFornecedor($ln->idfornecedor);


                $xu = $nf->getIDFornecedor();

                if ($idforn == $xu) {
                    print_r("<option value=" . $nf->getIDFornecedor() . " selected>" . $nf->getFornecedor() . "</option>");
                } else {
                    print_r("<option value=" . $nf->getIDFornecedor() . ">" . $nf->getFornecedor() . "</option>");
                }

                //  $f[] = $nf;
            }
        }
    }

    public function selectEmpresa($idem) {

        $sql = 'SELECT idempresa, nome  FROM empresa';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {

                $empresa = new modelNFentrada();

                $empresa->setEmpresa($ln->nome);
                $empresa->setIDEmpresa($ln->idempresa);


                $xu = $empresa->getIDEmpresa();

                if ($idem == $xu) {
                    print_r("<option value=" . $empresa->getIDEmpresa() . " selected>" . $empresa->getEmpresa() . "</option>");
                } else {
                    print_r("<option value=" . $empresa->getIDEmpresa() . ">" . $empresa->getEmpresa() . "</option>");
                }

                //  $f[] = $nf;
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
