<?php

class DBExportar {

    private $conex;
    private $mysql;
    private $nome;
    private $apelido;
    private $endereco;
    private $bairro;
    private $cidade;
    private $uf;
    private $cep;
    private $complemento;
    private $sexo;
    private $telefone1;
    private $telefone2;
    private $telefone3;
    private $celular;
    private $email;
    private $rg;
    private $cpf;
    private $filiacao;
    private $estadocivil;
    private $profissao;
    private $empresa;
    private $nacimento;
    private $numero;
    private $cod;
//tabela de produto
    private $codbarra;
    private $produto;
    private $precocusto;
    private $precovenda;
    private $estoque;
    private $estoqueminimo;
    private $localizacao;
    private $peso;
    private $comissao;
    private $codproduto;
    private $codfornecedor;
    private $codmarcac;
//tabela de marca    
    private $nomemarca;
    private $codmarca;
//tabela de fornecedor
    private $codfor;
    private $nomefor;
    private $enderecofor;
    private $bairrofor;
    private $cidadefor;
    private $uffor;
    private $cepfor;
    private $telefone1for;
    private $telefone2for;
    private $celular1for;
    private $celular2for;
    private $emailfor;            
    private $homepagefor;            
    private $cnpjfor;           
    private $iefor;           


    public function __construct() {
        $this->conex = new Firebird();
        $this->mysql = new Conexao();
    }

    public function selectAll() {
        ini_set('memory_limit', '1024M');

        $sql = 'SELECT * FROM C000007 ORDER BY CODIGO ASC';
        $rs = $this->conex->query($sql);


        if ($rs) {

            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {

//$pessoa = new modelExportar();

                $this->nome = $ln->NOME;
                $this->apelido = $ln->APELIDO;
                $this->endereco = $ln->ENDERECO;
                $this->bairro = $ln->BAIRRO;
                $this->cidade = $ln->CIDADE;
                $this->uf = $ln->UF;
                $this->cep = $ln->CEP;
                $this->complemento = $ln->COMPLEMENTO;
                $this->telefone1 = $ln->TELEFONE1;
                $this->telefone2 = $ln->TELEFONE2;
                $this->telefone3 = $ln->TELEFONE3;
                $this->celular = $ln->CELULAR;
                $this->email = $ln->EMAIL;
                $this->rg = $ln->RG;
                $this->cpf = $ln->CPF;
                $this->filiacao = $ln->FILIACAO;
                $this->estadocivil = $ln->ESTADOCIVIL;
                $this->profissao = $ln->PROFISSAO;
                $this->empresa = $ln->EMPRESA;
                $this->sexo = $ln->SEXO;
                $this->nacimento = $ln->NASCIMENTO;
                $this->numero = $ln->NUMERO;
                $this->cod = $ln->CODIGO;


// print_r($this->cod.' '.$this->nome."\n");
// exit(); 
//insert

                $sql = 'INSERT INTO pessoa (cpfCnpj, nome, apelidoFantasia, endereco, bairro, cidade, estado, cep, complemento, telefoneResidencial, telefoneComercial, celular2, celular1, email, identidateInscricao, nomeMae, estadoCivil, profissao, empresa, dataNascimento, sexo, numero)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';

                $stmt = $this->mysql->prepare($sql);

                $stmt->bindParam(1, $this->cpf, PDO::PARAM_STR);
                $stmt->bindParam(2, $this->nome, PDO::PARAM_STR);
                $stmt->bindParam(3, $this->apelido, PDO::PARAM_STR);
                $stmt->bindParam(4, $this->endereco, PDO::PARAM_STR);
                $stmt->bindParam(5, $this->bairro, PDO::PARAM_STR);
                $stmt->bindParam(6, $this->cidade, PDO::PARAM_STR);
                $stmt->bindParam(7, $this->uf, PDO::PARAM_STR);
                $stmt->bindParam(8, $this->cep, PDO::PARAM_STR);
                $stmt->bindParam(9, $this->complemento, PDO::PARAM_STR);
                $stmt->bindParam(10, $this->telefone1, PDO::PARAM_STR);
                $stmt->bindParam(11, $this->telefone2, PDO::PARAM_STR);
                $stmt->bindParam(12, $this->telefone3, PDO::PARAM_STR);
                $stmt->bindParam(13, $this->celular, PDO::PARAM_STR);
                $stmt->bindParam(14, $this->email, PDO::PARAM_STR);
                $stmt->bindParam(15, $this->rg, PDO::PARAM_STR);
                $stmt->bindParam(16, $this->filiacao, PDO::PARAM_STR);
                $stmt->bindParam(17, $this->estadocivil, PDO::PARAM_STR);
                $stmt->bindParam(18, $this->profissao, PDO::PARAM_STR);
                $stmt->bindParam(19, $this->empresa, PDO::PARAM_STR);
                $stmt->bindParam(20, $this->nacimento, PDO::PARAM_STR);
                $stmt->bindParam(21, $this->sexo, PDO::PARAM_STR);
                $stmt->bindParam(22, $this->numero, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    $msg = 'EXECUTADO COM SUCESSO!';
                } else {
                    $msg = 'FALHA FALE COM ADMINISTRADOR';
                }
//self::message($msg);



                

//
            }
        }

        echo $msg;
//return $pessoas;
    }

    public function produto() {

        $sql = 'SELECT CODIGO,CODBARRA, PRODUTO, 
                CAST(PRECOVENDA AS VARCHAR(15)) AS VENDA, 
                CAST(PRECOCUSTO AS VARCHAR(15)) AS CUSTO, 
                CAST(ESTOQUE AS VARCHAR(15)) AS ESTO, 
                CAST(ESTOQUEMINIMO AS VARCHAR(15)) AS ESTMIN, 
                CODFORNECEDOR, CODMARCA, LOCALICAZAO, PESO, COMISSAO FROM C000025 ORDER BY CODIGO ASC';
        $rs = $this->conex->query($sql);


        if ($rs) {

            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {

//$pessoa = new modelExportar();
                $this->codfornecedor  = $ln->CODFORNECEDOR;
                $this->codmarcac      = $ln->CODMARCA;
                $this->codproduto     = $ln->CODIGO;
                $this->codbarra       = $ln->CODBARRA;
                $this->produto        = $ln->PRODUTO;
                $this->precocusto     = $ln->CUSTO;
                $this->precovenda     = $ln->VENDA;

                $this->estoque        = $ln->ESTO;
                $this->estoqueminimo  = $ln->ESTMIN;
                $this->localizacao    = $ln->LOCALICAZAO;
                $this->peso           = $ln->PESO;

                $this->comissao       = $ln->COMISSAO;

                //$this->codproduto = $ln->CODIGO;
                
                //echo $this->estoqueminimo.' '.$this->estoque."\n";

                $sql = 'INSERT INTO custo (codproduto, precoCusto, precoVenda, percentualComissao)
                VALUES (?,?,?,?)';

                $st = $this->mysql->prepare($sql);
                $st->bindParam(1, $this->codproduto, PDO::PARAM_STR);
                $st->bindParam(2, $this->precocusto, PDO::PARAM_STR);
                $st->bindParam(3, $this->precovenda, PDO::PARAM_STR);
                $st->bindParam(4, $this->comissao, PDO::PARAM_STR);

                $st->execute();

                $lastId = $this->mysql->lastInsertId();
                
                $ql = 'SELECT idmarca FROM marca WHERE codmarca = ?';
                
                $ss = $this->mysql->prepare($ql);
                $ss->bindParam(1, $this->codmarcac, PDO::PARAM_STR);
                $ss->execute();
                $rss = $ss->fetch(PDO::FETCH_OBJ);
                
                if(is_object($rss)){
                    $idmarca = $rss->idmarca;
                }
               
                $qls = 'SELECT * FROM fornecedor WHERE codfornecedor = ?';
                
                $sl = $this->mysql->prepare($qls);
                $sl->bindParam(1,$this->codfornecedor,PDO::PARAM_STR);
                $sl->execute();
                $rsr = $sl->fetch(PDO::FETCH_OBJ);
                
                if(is_object($rsr)){
                    $idfornecedor = $rsr->idfornecedor;
                }
                
                $sq = 'INSERT INTO produto (codproduto, marca_idmarca, fornecedor_idfornecedor, custo_idcusto, codigoEAN, descricao, estoqueAtual, estoqueMinimo, localizacao, pesoBruto)
                VALUES (?,?,?,?,?,?,?,?,?,?)';

                $stmt = $this->mysql->prepare($sq);
                $stmt->bindParam(1, $this->codproduto,    PDO::PARAM_STR);
                $stmt->bindParam(2, $idmarca,             PDO::PARAM_STR);
                $stmt->bindParam(3, $idfornecedor,        PDO::PARAM_STR);
                $stmt->bindParam(4, $lastId,              PDO::PARAM_STR);
                $stmt->bindParam(5, $this->codbarra,      PDO::PARAM_STR);
                $stmt->bindParam(6, $this->produto,       PDO::PARAM_STR);
                $stmt->bindParam(7, $this->estoque,       PDO::PARAM_STR);
                $stmt->bindParam(8, $this->estoqueminimo, PDO::PARAM_STR);
                $stmt->bindParam(9, $this->localizacao,   PDO::PARAM_STR);
                $stmt->bindParam(10, $this->peso,         PDO::PARAM_STR);

                if ($stmt->execute()) {
                   $msg = 'Produto cadastrado com sucesso!';
                } else {
                   $msg = 'Falha ao tentar cadastrar Produto';
                }
 
           }
 
            echo $msg;
        }
//self::message($msg);
    }
    public function marca() {

        $sql = 'SELECT CODIGO, NOME
                FROM C000019 ORDER BY CODIGO ASC';
        $ro = $this->conex->query($sql);

        
        if ($ro) {

            while ($ln = $ro->fetch(PDO::FETCH_OBJ)) {

//$pessoa = new modelExportar();
                
                $this->codmarca = $ln->CODIGO;
                $this->nomemarca = $ln->NOME;
                
                $sql = 'INSERT INTO marca (codmarca,descricao)
                VALUES (?,?)';
                
                $stmt = $this->mysql->prepare($sql);
                
                $stmt->bindParam(1, $this->codmarca, PDO::PARAM_STR);
                $stmt->bindParam(2, $this->nomemarca, PDO::PARAM_STR);
                
                if ($stmt->execute()) {
                   $msg = 'Marca cadastrado com sucesso!';
                } else {
                   $msg = 'Falha ao tentar cadastrar Marca';
                }
                
           }
 
            echo $msg;
        }
//self::message($msg);
    }
    
    public function fornecedor() {
        
        $sql = 'SELECT *
                FROM C000009 ORDER BY CODIGO ASC';
        $rs = $this->conex->query($sql);

        
        if ($rs) {
           
            while ($ln = $rs->fetch(PDO::FETCH_OBJ)) {

//$pessoa = new modelExportar();

                $this->codfor = $ln->CODIGO;
                $this->nomefor = $ln->NOME;
                $this->enderecofor = $ln->ENDERECO;
                $this->bairrofor = $ln->BAIRRO;
                $this->cidadefor = $ln->CIDADE;
                $this->uffor = $ln->UF;
                $this->cepfor = $ln->CEP;
                $this->telefone1for = $ln->TELEFONE1;
                $this->telefone2for = $ln->TELEFONE2;
                $this->celular1for = $ln->CELULAR1;
                $this->celular2for = $ln->CELULAR2;
                $this->emailfor = $ln->EMAIL;
                $this->homepagefor = $ln->HOMEPAGE;
                $this->cnpjfor = $ln->CNPJ;
                $this->iefor = $ln->IE;


                $sql = 'INSERT INTO fornecedor (codFornecedor,descricao, cnpj, ie, endereco, bairro, cep, cidade, estado, telefone, telefone2, telefone3, telefone4, email, website)
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';

                $stmt = $this->mysql->prepare($sql);
                $stmt->bindParam(1, $this->codfor, PDO::PARAM_STR);
                $stmt->bindParam(2, $this->nomefor, PDO::PARAM_STR);
                $stmt->bindParam(3, $this->cnpjfor, PDO::PARAM_STR);
                $stmt->bindParam(4, $this->iefor, PDO::PARAM_STR);
                $stmt->bindParam(5, $this->enderecofor, PDO::PARAM_STR);
                $stmt->bindParam(6, $this->bairrofor, PDO::PARAM_STR);
                $stmt->bindParam(7, $this->cepfor, PDO::PARAM_STR);
                $stmt->bindParam(8, $this->cidadefor, PDO::PARAM_STR);
                $stmt->bindParam(9, $this->uffor, PDO::PARAM_STR);
                $stmt->bindParam(10, $this->telefone1for, PDO::PARAM_STR);
                $stmt->bindParam(11, $this->telefone2for, PDO::PARAM_STR);
                $stmt->bindParam(12, $this->celular1for, PDO::PARAM_STR);
                $stmt->bindParam(13, $this->celular2for, PDO::PARAM_STR);
                $stmt->bindParam(14, $this->emailfor, PDO::PARAM_STR);
                $stmt->bindParam(15, $this->homepagefor, PDO::PARAM_STR);
                

                if ($stmt->execute()) {
                   $msg = 'FORNECEDOR cadastrado com sucesso!';
                } else {
                   $msg = 'Falha ao tentar cadastrar FORNECEDOR';
                }
 
           }
 
            echo $msg;
        }
//self::message($msg);
    }

}

?>