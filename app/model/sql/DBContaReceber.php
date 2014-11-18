<?php

class DBContaReceber {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
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




        $sql = 'INSERT INTO notasaida (pessoa_idpessoa, operacao, condicaoPagamento_idcondicaoPagamento, valorProdutos, desconto, frete, valorFinal, totalLinhas)
                VALUES (?,?,?,?,?,?,?,?)';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $model->getIDcliente(), PDO::PARAM_STR);
        $stmt->bindParam(2, $model->getTipo(), PDO::PARAM_STR);
        $stmt->bindParam(3, $model->getFormapg(), PDO::PARAM_STR);
        $stmt->bindParam(4, $total, PDO::PARAM_STR);
        $stmt->bindParam(5, $model->getValorDesconto(), PDO::PARAM_STR);
        $stmt->bindParam(6, $model->getFrete(), PDO::PARAM_STR);
        $stmt->bindParam(7, $desconto, PDO::PARAM_STR);
        $stmt->bindParam(8, $row, PDO::PARAM_STR);
        $stmt->execute();

        $lastId = $this->conex->lastInsertId();

        /*         * **********************contas a receber**************************************************************************** */
        if ($model->getTipo() <> 3) {

            //date de emissao
            $emissao = date('Y-m-d');

            /*             * **********dados de forma de pagamento********************* */
            $sql = 'SELECT numeroParcelas, intervaloParcelas, entrada FROM condicaopagamento WHERE idcondicaoPagamento = ?';

            $stmt = $this->conex->prepare($sql);
            $stmt->bindParam(1, $model->getFormapg(), PDO::PARAM_INT);
            $stmt->execute();
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            if (is_object($rs)) {
                $nparcelas = $rs->numeroParcelas;
                $dias = $rs->intervaloParcelas;
                $entrada = $rs->entrada;
            }
            $totalgeral = $model->getTotal();
            echo $totalgeral;
            if (empty($totalgeral)) {
                $valorparcela = $totalgeral / $nparcelas;
            } else {
                $valorparcela = $total / $nparcelas;
            }

//colocar mas o numero de dias em cada parcelas
            for ($x = 1; $x <= $nparcelas; $x++) {

                if ($entrada == 0) {
                    $n = $emissao;
                    $entrada = 1;
                } else {
                    $n = $dias + $n;
                }

                //date("d \/ m \/ Y", mktime(date('H'),date('i'),date('s'),date('m'), date('d')-30, date('Y')));
                $venpar = date("Y\-m\-d", mktime(date('H'), date('i'), date('s'), date('m'), date('d') + $n, date('Y')));


                /*                 * ********************************************************* */
                //echo 'nn '.$lastId.' emissao '.$emissao.' venp '.$venpar.' total '.$model->getTotal().' nparcelas '.$x.' valorpar '.$valorparcela;
                $sql = 'INSERT INTO contasreceber (notaSaida_idnotaSaida, dataEmissao, dataVencimento, valorOriginal, numeroParcela, valorParcelas)
                VALUES (?,?,?,?,?,?)';

                $stmt = $this->conex->prepare($sql);
                $stmt->bindParam(1, $lastId, PDO::PARAM_STR);
                $stmt->bindParam(2, $emissao, PDO::PARAM_STR);
                $stmt->bindParam(3, $venpar, PDO::PARAM_STR);
                $stmt->bindParam(4, $model->getTotal(), PDO::PARAM_STR);
                $stmt->bindParam(5, $x, PDO::PARAM_STR);
                $stmt->bindParam(6, $valorparcela, PDO::PARAM_STR);

                $msg = $stmt->execute();
            }
        }
        /*         * ********************fim contas a receber********************************************************************************* */

        for ($x = 0; $x <= $model->getQuantitem(); $x++) {

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


            if ($model->getTipo() <> 3) {
                //tirar espaço vazio
                $quant = rtrim($quant);

                $sql = 'UPDATE produto SET estoqueAtual = estoqueAtual - (?) WHERE idproduto = ?';

                $stmt = $this->conex->prepare($sql);
                $stmt->bindParam(1, $quant, PDO::PARAM_STR);
                $stmt->bindParam(2, $cod, PDO::PARAM_INT);


                $rs = $stmt->execute();
            }
        }


        self::message($msg);
    }

    public function update(modelContaReceber $model) {
        
        
        //verificar checkbox <> de vazio
        $ativo = $model->getAtivo();
        $set   = 'P';
        if(!empty($ativo)){
            
            //contar quantos foi escolhido
            $qtd = count($ativo);
            
            for($x=0; $x <= $qtd; $x++){
                $status = $ativo[$x];
                
                $sql = 'UPDATE contasreceber SET status = ? WHERE idcontareceber = ?';
                $stmt = $this->conex->prepare($sql);
                $stmt->bindParam(1, $set, PDO::PARAM_STR);
                $stmt->bindParam(2, $status, PDO::PARAM_STR);
                $rs = $stmt->execute();
            
               // $msg = $rs === TRUE ? 'Nota Recebida com sucesso!' : 'Falha no Recebimento'; //simples comparação para saber se deu certo ou não a execução do sql
        
            }
        }
        $valorRecebido = $model->getValorRecebido();
       
        if(!empty($valorRecebido)){
           
            //valor passado pelo formulario
            $valorform = $model->getValorRecebido();
            //verificar nota valor menor que valor pago
            $sql = 'SELECT valorParcelas, idcontareceber 
                    FROM contasreceber 
                    WHERE pessoa_idpessoa = ? AND statu IS NULL 
                    ORDER BY dataVencimento ASC';

            $stmt = $this->conex->prepare($sql);
            $stmt->bindParam(1, $model->getIDpessoa(), PDO::PARAM_INT);
            //$stmt->bindParam(2, $set, PDO::PARAM_STR);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_OBJ)){
                $valorParcelas = $row->valorParcelas;
                $idcontareceber = $row->idcontareceber;
                
                //verificar se valor recebido no form e maior que o valor da prestação
                if($valorform >= $valorParcelas){
                    //COLOCAR NOTA COMO BAIXADA
                    
                    $sql = 'UPDATE contasreceber SET statu = ? WHERE idcontareceber = ?';
                    $stmt = $this->conex->prepare($sql);
                    $stmt->bindParam(1, $set, PDO::PARAM_STR);
                    $stmt->bindParam(2, $idcontareceber, PDO::PARAM_STR);
                    $rs = $stmt->execute();
                    echo ' '.$valorform.' '.$valorParcelas;
                    //tirar valor recebido do form
                    $valorform = $valorform - $valorParcelas;
                    $resto = $valorform;
                }else{
                    $resto = $valorform;
                }
                
            }
            // se o resto for diferente de 0 tirar o valor a prestação esta estive em mais atraso
            if($resto<>0){
                
                //verificar nota valor menor que valor pago
            $sql = 'SELECT valorParcelas, idcontareceber,notaSaida_idnotaSaida 
                    FROM contasreceber 
                    WHERE pessoa_idpessoa = ? AND statu IS NULL
                    ORDER BY dataVencimento ASC';

            $stmt = $this->conex->prepare($sql);
            $stmt->bindParam(1, $model->getIDpessoa(), PDO::PARAM_INT);
            //$stmt->bindParam(2, $set, PDO::PARAM_STR);
            $stmt->execute();
                $rs = $stmt->fetch(PDO::FETCH_OBJ);
                if (is_object($rs)) {
                    $valorParcelas = $rs->valorParcelas;
                    $idcontareceber = $rs->idcontareceber;
                    $idnotasaida    = $rs->notaSaida_idnotaSaida;
                }
                    $valorGerar = $valorParcelas - $resto;
                    
                    $sql = 'UPDATE contasreceber SET valorRecebido = ?, statu = ? WHERE idcontareceber = ?';
                    $stmt = $this->conex->prepare($sql);
                    $stmt->bindParam(1, $resto, PDO::PARAM_STR);
                    $stmt->bindParam(2, $set, PDO::PARAM_STR);
                    $stmt->bindParam(3, $idcontareceber, PDO::PARAM_STR);
                    $rs = $stmt->execute();
             }
             if($valorGerar<>0){
                 //criar nova nota
                 //date("d \/ m \/ Y", mktime(date('H'),date('i'),date('s'),date('m'), date('d')-30, date('Y')));
                $venpar = date("Y\-m\-d", mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 30, date('Y')));
                $emissao = date("Y-m-d");
                $np = 1;
                /*                 * ********************************************************* */
                //echo 'id '.$idnotasaida.' emissao '.$emissao.' venp '.$venpar.' total '.$valorParcelas.' nparcelas '.$np.' valorpar '.$valorGerar;
                $sql = 'INSERT INTO contasreceber (notaSaida_idnotaSaida, pessoa_idpessoa, dataEmissao, dataVencimento, valorOriginal, numeroParcela, valorParcelas)
                VALUES (?,?,?,?,?,?,?)';

                $stmt = $this->conex->prepare($sql);
                $stmt->bindParam(1, $idnotasaida, PDO::PARAM_STR);
                $stmt->bindParam(2, $model->getIDpessoa(), PDO::PARAM_STR);
                $stmt->bindParam(3, $emissao, PDO::PARAM_STR);
                $stmt->bindParam(4, $venpar, PDO::PARAM_STR);
                $stmt->bindParam(5, $valorParcelas, PDO::PARAM_STR);
                $stmt->bindParam(6, $np, PDO::PARAM_STR);
                $stmt->bindParam(7, $valorGerar, PDO::PARAM_STR);

                $msg = $stmt->execute();
             }
        }
        $msg = $rs === TRUE ? 'Nota Recebida com sucesso!' : 'Falha no Recebimento'; //simples comparação para saber se deu certo ou não a execução do sql
        
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

    public function select(modelContaReceber $cr) {

        $sql = 'SELECT  cep, numero, endereco, nome, bairro, cidade
                FROM pessoa WHERE idpessoa = ?
                ';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $cr->getIDpessoa(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        
        if (is_object($rs)) {
            $cr->setBairro($rs->bairro);
            $cr->setCidade($rs->cidade);
            $cr->setEndereco($rs->endereco);
            $cr->setNomeCliente($rs->nome);
            $cr->setNumero($rs->numero);
            $cr->setCep($rs->cep);
        }
    }

    public function selectBUSCA(modelContaReceber $model) {
        
        $sql = "SELECT idpessoa,nome,endereco, numero, bairro, cidade, estado FROM pessoa
                WHERE pessoa.nome LIKE ?
                ORDER BY nome ASC";

        $stmt = $this->conex->prepare($sql);
        $stmt->bindValue(1, '%' . $model->getBuscaCliente() . '%', PDO::PARAM_STR);
        $stmt->execute();


        $arr = array();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ))
            $arr[] = $row;


        header('Content-type: application/json');
        echo json_encode($arr);
    }

    public function selectAll() {
        $sql = 'SELECT idpessoa,nome,endereco, numero, bairro, cidade, estado FROM pessoa
                ORDER BY nome ASC
                LIMIT 0,30';
        $rs = $this->conex->query($sql);
        if ($rs) {
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {
                $pessoa = new modelContaReceber();
                $pessoa->setIDpessoa($ln->idpessoa);
                $pessoa->setNomeCliente($ln->nome);
                $pessoa->setEndereco($ln->endereco);
                $pessoa->setNumero($ln->numero);
                $pessoa->setBairro($ln->bairro);
                $pessoa->setCidade($ln->cidade);
                $pessoa->setUF($ln->estado);

                print_r("<tr>
                 <td align='center'><a href=" . "javascript:mudaConteudo('app/view/forContaReceber.php?idcliente=" . $pessoa->getIDpessoa() . "')" . "><img src='resources/images/apply.png' title='Visualizar Notas'/></a></td>
                 <td>" . $pessoa->getIDpessoa() . "</td>
                 <td>" . $pessoa->getNomeCliente() . "</td>
                 <td>" . $pessoa->getEndereco() . "</td>
                 <td>" . $pessoa->getNumero() . "</td>
                 <td>" . $pessoa->getBairro() . "</td>
                 <td>" . $pessoa->getCidade() . "</td>
                 <td>" . $pessoa->getUF() . "</td>
                 </tr>");

                $pessoas[] = $pessoa;
            }
        }
        /* if (!is_array($pessoas)) {
          throw new PDOException('Nenhum registro foi encontrado');
          } */
        return $pessoas;
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

    public function selectNF(modelContaReceber $cr) {
        $status = 'P';
        $sql = 'SELECT idcontareceber, notaSaida_idnotaSaida, DATE_FORMAT(dataEmissao , "%d/%m/%Y") AS emissao, 
                DATE_FORMAT(dataVencimento, "%d/%m/%Y") AS vencimento, numeroParcela, valorParcelas
                FROM  contasreceber 
                WHERE pessoa_idpessoa = ?
                AND statu IS NULL 
                ORDER BY idcontareceber';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $cr->getIDpessoa(), PDO::PARAM_INT);
        //$stmt->bindParam(2, $status, PDO::PARAM_STR);
        $stmt->execute();
        
        $dataatual = date('d/m/Y');
        $data_inicial = implode(array_reverse(explode("/", $dataatual)));
        
        while ($ln = $stmt->fetch(PDO::FETCH_OBJ)) {
            $idcr = ($ln->idcontareceber);
            $idnf = ($ln->notaSaida_idnotaSaida);
            $emissao = ($ln->emissao);
            $vencimento = ($ln->vencimento);
            $nparcelas = ($ln->numeroParcela);
            $valor = ($ln->valorParcelas);
            
            echo "<tr>
                         
                    <td><input name=\"ativo[]\" type=\"checkbox\" value=\"$idcr\" class=\"effect\"/></td>
                    <td align='center'>$idnf</td>
                    <td align='center' width='90'>$nparcelas</td>
                    <td align='center' width='90'>$emissao</td>
                    <td align='center' width='90'>$vencimento</td>
                    <td align='center' width='90'>$valor</td>
           </tr>";
            
            
            $data_final = implode(array_reverse(explode("/", $vencimento)));
            
            if($data_inicial>$data_final){
                $vlr = $vlr + $valor;
            }
        }
        return $vlr;
    }

    private function message($msg) { //imprime a mensagem na tela
        echo $msg;
    }

}

?>
