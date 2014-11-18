<?php

class modelContaReceber {
    // atributos
    private $idpessoa;
    private $endereco;
    private $cidade;
    private $uf;
    private $numero;
    private $nomecliente;
    private $bairro;
    private $status;
    private $buscacliente;
    private $cep;
    private $ativo;
    private $valorRecebido;
    

    // métodos
    public function __construct(){
        
    }
    
    public function setValorRecebido ($valorRecebido){
        $this->valorRecebido = $valorRecebido;
    }
        
    public function getValorRecebido(){
        return $this->valorRecebido;
    }
    
    public function setAtivo ($ativo){
        $this->ativo = $ativo;
    }
        
    public function getAtivo(){
        return $this->ativo;
    }
    
    public function setCep ($cep){
        $this->cep = $cep;
    }
        
    public function getCep(){
        return $this->cep;
    }
    
    public function setBuscaCliente ($buscacliente){
        $this->buscacliente = $buscacliente;
    }
        
    public function getBuscaCliente(){
        return $this->buscacliente;
    }
    
    public function setIDpessoa ($idpessoa){
        $this->idpessoa = $idpessoa;
    }
        
    public function getIDpessoa(){
        return $this->idpessoa;
    }
    
    public function setStatus ($status){
        $this->status = $status;
    }
        
    public function getStatus(){
        return $this->status;
    }
    
    public function setBairro ($bairro){
        $this->bairro = $bairro;
    }
        
    public function getBairro(){
        return $this->bairro;
    }
    
    
    public function setNomeCliente ($nomecliente){
        $this->nomecliente = $nomecliente;
    }
        
    public function getNomeCliente(){
        return $this->nomecliente;
    }
    
    public function setCidade ($cidade){
        $this->cidade = $cidade;
    }
        
    public function getCidade(){
        return $this->cidade;
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
    
    public function setUF ($uf){
        $this->uf = $uf;
    }
        
    public function getUF(){
        return $this->uf;
    }
    
    
}

?>