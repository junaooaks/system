<?php

class modelVendedor {
    // atributos
    private $nome;
    private $cpfCnpj;
    private $datanascimento;
    private $identidade;
    private $sexo;
    private $site;
    private $email;
    private $endereco;
    private $numero;
    private $bairro;
    private $complementar;
    private $cidade;
    private $uf;
    private $cep;
    private $telres;
    private $celres;
    private $telcom;
    private $celcom;
    private $idvendedor;
    

    // métodos
    public function __construct(){
        
    }
    public function setIDVendedor ($idvendedor){
        $this->idvendedor = $idvendedor;
    }
    
    public function getIDVendedor(){
        return $this->idvendedor;
    }
    
    public function setNome ($nome){
        $this->nome = $nome;
    }
    
    public function getNome(){
        return $this->nome;
    }
    public function setCpfcnpj ($cpfCnpj){
        $this->cpfCnpj = $cpfCnpj;
    }
    
    public function getCpfcnpj(){
        return $this->cpfCnpj;
    }
    
    public function setDatanascimento ($datanascimento){
        $this->datanascimento = $datanascimento;
    }
    
    public function getDatanascimento(){
        return $this->datanascimento;
    }
    
    public function setIdentidade ($identidade){
        $this->identidade = $identidade;
    }
    
    public function getIdentidade(){
        return $this->identidade;
    }
    
    public function setSexo ($sexo){
        $this->sexo = $sexo;
    }
    
    public function getSexo(){
        return $this->sexo;
    }
    
    public function setCidade ($cidade){
        $this->cidade = $cidade;
    }
    
    public function getCidade(){
        return $this->cidade;
    }
    
    
    public function setSite ($site){
        $this->site = $site;
    }
    
    public function getSite(){
        return $this->site;
    }
    
    public function setEmail ($email){
        $this->email = $email;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function setEndereco ($endereco){
        $this->endereco = $endereco;
    }
    
    public function getEndereco(){
        return $this->endereco;
    }
    
    public function setNumero ($numero){
        $this->numero = $numero;
    }
    
    public function getNumero(){
        return $this->numero;
    }
    
    public function setBairro ($bairro){
        $this->bairro = $bairro;
    }
    
    public function getBairro(){
        return $this->bairro;
    }
    
    public function setComplementar ($complementar){
        $this->complementar = $complementar;
    }
    
    public function getComplementar(){
        return $this->complementar;
    }
    
    public function setUf ($uf){
        $this->uf = $uf;
    }
    
    public function getUf(){
        return $this->uf;
    }
    
    public function setCep ($cep){
        $this->cep = $cep;
    }
    
    public function getCep(){
        return $this->cep;
    }
    
    public function setTelres ($telres){
        $this->telres = $telres;
    }
    
    public function getTelres(){
        return $this->telres;
    }
    
    public function setCelres ($celres){
        $this->celres = $celres;
    }
    
    public function getCelres(){
        return $this->celres;
    }
    
    public function setTelcom ($telcom){
        $this->telcom = $telcom;
    }
    
    public function getTelcom(){
        return $this->telcom;
    }
    
    public function setCelcom ($celcom){
        $this->celcom = $celcom;
    }
    
    public function getCelcom(){
        return $this->celcom;
    }
}

?>