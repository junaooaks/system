<?php

class modelFuncionario {

    // atributos
    //private $idpessoa;
    private $login;
    private $idusuarios;
    private $empresa;
    private $nome;
    private $pai;
    private $mae;
    private $pis;
    private $cpf;
    private $civil;
    private $email;
    private $endereco;
    private $numero;
    private $bairro;
    private $sexo;
    private $cidade;
    private $uf;
    private $cep;
    private $valor;
    private $profissao;
    private $comissao;
    private $identidade;
    private $idfuncionario;
    private $telres;
    private $celres;
    private $celcom;
    private $datanascimento;
    private $idempresa;
    private $idsetor;
    private $setor;

    // métodos
    public function __construct() {
        
    }
    
    public function setLogin($login) {
        $this->login = $login;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setIDUsuarios($idusuarios) {
        $this->idusuarios = $idusuarios;
    }

    public function getIDUsuarios() {
        return $this->idusuarios;
    }
    
    public function setSetor($setor) {
        $this->setor = $setor;
    }

    public function getSetor() {
        return $this->setor;
    }
    
    public function setIDFuncionario($idfuncionario) {
        $this->idfuncionario = $idfuncionario;
    }

    public function getIDFuncionario() {
        return $this->idfuncionario;
    }
    
    public function setIDSetor($idsetor) {
        $this->idsetor = $idsetor;
    }

    public function getIDSetor() {
        return $this->idsetor;
    }
    
    public function setIDEmpresa($idempresa) {
        $this->idempresa = $idempresa;
    }

    public function getIDEmpresa() {
        return $this->idempresa;
    }
    
    public function setComissao($comissao) {
        $this->comissao = $comissao;
    }

    public function getComissao() {
        return $this->comissao;
    }
    
    public function setPis($pis) {
        $this->pis = $pis;
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

    public function setDatanascimento($datanascimento) {
        $this->datanascimento = $datanascimento;
    }

    public function getDatanascimento() {
        return $this->datanascimento;
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

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setUf($uf) {
        $this->uf = $uf;
    }

    public function getUf() {
        return $this->uf;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setTelres($telres) {
        $this->telres = $telres;
    }

    public function getTelres() {
        return $this->telres;
    }

    public function setCelres($celres) {
        $this->celres = $celres;
    }

    public function getCelres() {
        return $this->celres;
    }

    public function setCelcom($celcom) {
        $this->celcom = $celcom;
    }

    public function getCelcom() {
        return $this->celcom;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setProfissao($profissao) {
        $this->profissao = $profissao;
    }

    public function getProfissao() {
        return $this->profissao;
    }

    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    public function getEmpresa() {
        return $this->empresa;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function getSexo() {
        return $this->sexo;
    }

}

?>