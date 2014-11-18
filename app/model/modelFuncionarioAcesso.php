<?php

class modelFuncionarioAcesso {

    private $idfun;
    private $acesso;
    private $usuario;
    private $senha;
    private $repete;
    
    //dados pessoais
    private $nome;
    private $pai;
    private $mae;
    private $pis;
    private $cpf;
    private $civil;
    private $email;
    private $sexo;
    private $idusuarios;
    private $login;
    
    
    
    
    //permissoes administracao
    private $empresas;
    private $setores;
    private $funcionarios;
    private $parametro;
    private $log;
    private $condicaopg;
    private $operacoes;
    private $db;
    
    //permissoes cadastros
    private $pessoas;
    private $fornecedor;
    private $produto;
    private $grupopessoas;
    private $gruposub;
    private $marcas;
    private $unidade;
    
    //movimetação
    private $nfe;
    private $nfs;
    
    //financeiro
    private $contareceber;
    private $contapagar;
    private $caixa;
    private $contabanco;
    private $cheques;
    
    // métodos
    public function __construct() {
        
    }
    
    public function setPermissao($permissao) {
        $this->permissao = $permissao;
    }

    public function getPermissao() {
        return $this->permissao;
    }
    
     public function setLogin($login) {
        $this->login = $login;
    }

    public function getLogin() {
        return $this->login;
    }
    
    public function setPis($pis) {
        $this->pis = $pis;
    }
    
     public function setIDUsuarios($idusuarios) {
        $this->idusuarios = $idusuarios;
    }

    public function getIDUsuarios() {
        return $this->idusuarios;
    }
    
    public function getPis() {
        return $this->pis;
    }
    
    public function setIdentidade($identidade) {
        $this->identidade = $identidade;
    }

    public function getIdentidade() {
        return $this->identidade;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setPai($pai) {
        $this->pai = $pai;
    }

    public function getPai() {
        return $this->pai;
    }

    public function setMae($mae) {
        $this->mae = $mae;
    }

    public function getMae() {
        return $this->mae;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getCpf() {
        return $this->cpf;
    }
    public function setCivil($civil) {
        $this->civil = $civil;
    }

    public function getCivil() {
        return $this->civil;
    }
    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }
     public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function getSexo() {
        return $this->sexo;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
    
    
    /*
    public function setIDUsuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function getIDUsuario() {
        return $this->idusuario;
    }
   */ 
    public function setAcesso($acesso) {
        $this->acesso = $acesso;
    }

    public function getAcesso() {
        return $this->acesso;
    }

    public function setIDFun($idfun) {
        $this->idfun = $idfun;
    }

    public function getIDFun() {
        return $this->idfun;
    }
    
    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getUsuario() {
        return $this->usuario;
    }
    
    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getSenha() {
        return $this->senha;
    }
    
    public function setRepete($repete) {
        $this->repete = $repete;
    }

    public function getRepete() {
        return $this->repete;
    }
    
    public function setEmpresas($empresas) {
        $this->empresas = $empresas;
    }

    public function getEmpresas() {
        return $this->empresas;
    }
    
    public function setSetores($setores) {
        $this->setores = $setores;
    }

    public function getSetores() {
        return $this->setores;
    }
    
    public function setFuncionarios($funcionarios) {
        $this->funcionarios = $funcionarios;
    }

    public function getFuncionarios() {
        return $this->funcionarios;
    }

    public function setParametro($parametro) {
        $this->parametro = $parametro;
    }

    public function getParametro() {
        return $this->parametro;
    }

    public function setLog($log) {
        $this->log = $log;
    }

    public function getLog() {
        return $this->log;
    }

    public function setCondicaopg($condicaopg) {
        $this->condicaopg = $condicaopg;
    }

    public function getCondicaopg() {
        return $this->condicaopg;
    }

    public function setOperacoes($operacoes) {
        $this->operacoes = $operacoes;
    }

    public function getOperacoes() {
        return $this->operacoes;
    }

    public function setDb($db) {
        $this->db = $db;
    }

    public function getDb() {
        return $this->db;
    }

    public function setPessoas($pessoas) {
        $this->pessoas = $pessoas;
    }

    public function getPessoas() {
        return $this->pessoas;
    }

    public function setFornecedor($fornecedor) {
        $this->fornecedor = $fornecedor;
    }

    public function getFornecedor() {
        return $this->fornecedor;
    }

    public function setProduto($produto) {
        $this->produto = $produto;
    }

    public function getProduto() {
        return $this->produto;
    }

    public function setGrupopessoas($grupopessoas) {
        $this->grupopessoas = $grupopessoas;
    }

    public function getGrupopessoas() {
        return $this->grupopessoas;
    }

    public function setGruposub($gruposub) {
        $this->gruposub = $gruposub;
    }

    public function getGruposub() {
        return $this->gruposub;
    }

    public function setMarcas($marcas) {
        $this->marcas = $marcas;
    }

    public function getMarcas() {
        return $this->marcas;
    }

    public function setUnidade($unidade) {
        $this->unidade = $unidade;
    }

    public function getUnidade() {
        return $this->unidade;
    }

    public function setNfe($nfe) {
        $this->nfe = $nfe;
    }

    public function getNfe() {
        return $this->nfe;
    }

    public function setNfs($nfs) {
        $this->nfs = $nfs;
    }

    public function getNfs() {
        return $this->nfs;
    }

    public function setContareceber($contareceber) {
        $this->contareceber = $contareceber;
    }

    public function getContareceber() {
        return $this->contareceber;
    }

    public function setContapagar($contapagar) {
        $this->contapagar = $contapagar;
    }

    public function getContapagar() {
        return $this->contapagar;
    }

    public function setCaixa($caixa) {
        $this->caixa = $caixa;
    }

    public function getCaixa() {
        return $this->caixa;
    }

    public function setContabanco($contabanco) {
        $this->contabanco = $contabanco;
    }

    public function getContabanco() {
        return $this->contabanco;
    }

    public function setCheques($cheques) {
        $this->cheques = $cheques;
    }

    public function getCheques() {
        return $this->cheques;
    }

}

?>