<?php

class DBFinanceiro {

    private $conex;

    public function __construct() {
        $this->conex = new Conexao();
    }

    public function select(modelFinanceiro $fin) {
        $sql = 'SELECT idpessoa, nome, cep, cidade, endereco, numero, bairro,
                   financeiro.idfinanceiro, idAvalista, dataAvaliacao, enderecoCobranca, dataCobranca, consultaSpc, consultaSerasa, renda, moradia, limiteCredito, referenciaComercial1, referenciaComercial2, referenciaComercial3, referenciaComercial4, referenciaComercial5, referenciaBancaria1, referenciaBancaria2, referenciaBancaria3, financeiro.obs
            FROM pessoa, financeiro 
            WHERE idPessoa = ?
            AND idpessoa = pessoa_idpessoa';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $fin->getCodCliente(), PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $fin->setCodCliente($rs->idpessoa);
            $fin->setNomeCliente($rs->nome);
            $fin->setCep($rs->cep);
            $fin->setCidade($rs->cidade);
            $fin->setEndereco($rs->endereco);
            $fin->setNumero($rs->numero);
            $fin->setBairro($rs->bairro);
            $fin->setCodFinanceiro($rs->idfinanceiro);
            $fin->setEnderecoCobranca($rs->enderecoCobranca);
            $fin->setDataCobranca($rs->dataCobranca);
            $fin->setSpc($rs->consultaSpc);
            $fin->setSerasa($rs->consultaSerasa);
            $fin->setRendaFixaCliente($rs->renda);
            $fin->setMoradia($rs->moradia);
            $fin->setCredPessoa($rs->limiteCredito);
            $fin->setComer1($rs->referenciaComercial1);
            $fin->setComer2($rs->referenciaComercial2);
            $fin->setComer3($rs->referenciaComercial3);
            $fin->setComer4($rs->referenciaComercial4);
            $fin->setComer5($rs->referenciaComercial5);
            $fin->setBanco1($rs->referenciaBancaria1);
            $fin->setBanco2($rs->referenciaBancaria2);
            $fin->setBanco3($rs->referenciaBancaria3);
            $fin->setObs($rs->obs);
        }
        return $fin;
    }

    public function selectBUSCA(modelFinanceiro $fin) {
        $idavalista = $fin->getBusca();
        //echo $idavalista;
        $sql = "SELECT idpessoa,nome,renda,limiteCredito,ativo
                FROM pessoa INNER JOIN financeiro on pessoa.idpessoa = financeiro.pessoa_idpessoa
                WHERE pessoa_idpessoa = ? ";

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $idavalista, PDO::PARAM_INT);
        $stmt->execute();

        $rs = $stmt->fetch(PDO::FETCH_OBJ);
        if (is_object($rs)) {
            $fin->setCodAvalista($rs->idpessoa);
            $fin->setNomeAvalista($rs->nome);
            $fin->setRendaFixa($rs->renda);
            $fin->setLimiteCredito($rs->limiteCredito);
            $fin->setAtivo($rs->ativo);
            
            $status = $fin->getAtivo();
            
            if (empty($status)) {
                $fin->setAtivo('PENDENCIA - FALE COM ADMINISTRADOR');
            }
            if ($status == 0) {
                $fin->setAtivo('DESATIVADO - FALE COM ADMINISTRADOR');
            }
            if ($status == 1) {
                $fin->setAtivo('ATIVADO - LIBERADO');
            }
            if ($status == 2) {
                $fin->setAtivo('PENDENCIA - FALE COM ADMINISTRADOR');
            }
            if ($status == 3) {
                $fin->setAtivo('CLIENTE SEM ANALISE DE CREDITO');
            }
            if ($status == 4) {
                $fin->setAtivo('CLIENTE COM ANALISE VENCIDO');
            }
            if ($status == 5) {
                $fin->setAtivo('CLIENTE ESPECIAL');
            }
            
            


            $arr = $fin->getCodAvalista() . "|" . $fin->getNomeAvalista() . "|" . $fin->getRendaFixa() . "|" . $fin->getAtivo()."|".$fin->getLimiteCredito();
            
            echo json_encode($arr);
        }

        /*$arr = array();
        
        while ($row = $stmt->fetch(PDO::FETCH_OBJ))
            $arr[] = $row;


        //header('Content-type: application/json');
        echo stripslashes(json_encode($arr));
       //print_r($arr);*/
    }

    public function insert(modelFinanceiro $fin) {


        $sql = 'INSERT INTO financeiro (pessoa_idpessoa, enderecoCobranca, dataCobranca, consultaSpc, consultaSerasa, renda, moradia, limiteCredito, referenciaComercial1, referenciaComercial2, referenciaComercial3, referenciaComercial4, referenciaComercial5, referenciaBancaria1, referenciaBancaria2, referenciaBancaria3)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';

        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $fin->getCodCliente(), PDO::PARAM_INT);
        $stmt->bindParam(2, $fin->getEnderecoCobranca(), PDO::PARAM_INT);
        $stmt->bindParam(3, $fin->getDataCobranca(), PDO::PARAM_STR);
        $stmt->bindParam(4, $fin->getSpc(), PDO::PARAM_STR);
        $stmt->bindParam(5, $fin->getSerasa(), PDO::PARAM_STR);
        $stmt->bindParam(6, $fin->getRendaFixaCliente(), PDO::PARAM_STR);
        $stmt->bindParam(7, $fin->getMoradia(), PDO::PARAM_STR);
        $stmt->bindParam(8, $fin->getCredPessoa(), PDO::PARAM_STR);
        $stmt->bindParam(9, $fin->getComer1(), PDO::PARAM_STR);
        $stmt->bindParam(10, $fin->getComer2(), PDO::PARAM_STR);
        $stmt->bindParam(11, $fin->getComer3(), PDO::PARAM_STR);
        $stmt->bindParam(12, $fin->getComer4(), PDO::PARAM_STR);
        $stmt->bindParam(13, $fin->getComer5(), PDO::PARAM_STR);
        $stmt->bindParam(14, $fin->getBanco1(), PDO::PARAM_STR);
        $stmt->bindParam(15, $fin->getBanco2(), PDO::PARAM_STR);
        $stmt->bindParam(16, $fin->getBanco3(), PDO::PARAM_STR);


        if ($stmt->execute()) {
            $msg = 'Financeiro cadastrado com sucesso!';
        } else {
            $msg = 'Falha ao tentar cadastrar financeiro';
        }
        self::message($msg);
    }
    
    public function update(modelFinanceiro $fin) {
        $sql = 'UPDATE financeiro 
                set idAvalista = ?, enderecoCobranca = ?, dataCobranca = ?, consultaSpc = ?, 
                consultaSerasa = ?, renda = ?, moradia = ?, limiteCredito = ?, referenciaComercial1 = ?, 
                referenciaComercial2 = ?, referenciaComercial3 = ?, referenciaComercial4 = ?, 
                referenciaComercial5 = ?, referenciaBancaria1 = ?, referenciaBancaria2 = ?, 
                referenciaBancaria3 = ?, obs = ? WHERE idfinanceiro = ?';
        $stmt = $this->conex->prepare($sql);
        $stmt->bindParam(1, $fin->getCodAvalista(), PDO::PARAM_INT);
        $stmt->bindParam(2, $fin->getEnderecoCobranca(), PDO::PARAM_STR);
        $stmt->bindParam(3, $fin->getDataCobranca(), PDO::PARAM_STR);
        $stmt->bindParam(4, $fin->getSpc(), PDO::PARAM_STR);
        $stmt->bindParam(5, $fin->getSerasa(), PDO::PARAM_STR);
        $stmt->bindParam(6, $fin->getRendaFixaCliente(), PDO::PARAM_STR);
        $stmt->bindParam(7, $fin->getMoradia(), PDO::PARAM_STR);
        $stmt->bindParam(8, $fin->getLimiteCredito(), PDO::PARAM_STR);
        $stmt->bindParam(9, $fin->getComer1(), PDO::PARAM_STR);
        $stmt->bindParam(10, $fin->getComer2(), PDO::PARAM_STR);
        $stmt->bindParam(11, $fin->getComer3(), PDO::PARAM_STR);
        $stmt->bindParam(12, $fin->getComer4(), PDO::PARAM_STR);
        $stmt->bindParam(13, $fin->getComer5(), PDO::PARAM_STR);
        $stmt->bindParam(14, $fin->getBanco1(), PDO::PARAM_STR);
        $stmt->bindParam(15, $fin->getBanco2(), PDO::PARAM_STR);
        $stmt->bindParam(16, $fin->getBanco3(), PDO::PARAM_STR);
        $stmt->bindParam(17, $fin->getObs(), PDO::PARAM_STR);
        $stmt->bindParam(18, $fin->getCodFinanceiro(), PDO::PARAM_INT);
        
        $rs = $stmt->execute();
        $msg = $rs === TRUE ? 'Financeiro atualizado com sucesso!' : 'Falha ao tentar atualizar Financeiro'; //simples comparação para saber se deu certo ou não a execução do sql
        self::message($msg);
    }

    private function message($msg) { //imprime a mensagem na tela
        echo $msg;
    }

}

?>
