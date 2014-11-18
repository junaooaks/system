<?php

class modelNFs {
    // atributos
    private $busca;
    private $idnfs;
    private $idcliente;
    private $idformapg;
    private $tipo;
    private $formapg;
    private $valordesconto;
    private $valorfinal;
    private $idvendedor;
    private $idempresa;
    private $dataentrada;
    private $quantitem;
    private $obs;
    private $acrescimo;
    private $total;
    private $ativo;
    private $numero;
    private $endereco;
    private $cep;
    private $cidade;
    private $cliente;
    private $bairro;
    private $status;
    private $frete;
    private $nnotad;
    private $nf;
    private $vendedor;
    private $senha;
    
    

    // métodos
    public function __construct(){
        
    }
    
    public function setVendedor ($vendedor){
        $this->vendedor = $vendedor;
    }
        
    public function getVendedor(){
        return $this->vendedor;
    }
    
    public function setSenha ($senha){
        $this->senha = $senha;
    }
        
    public function getSenha(){
        return $this->senha;
    }
    
    public function setNF ($nf){
        $this->nf = $nf;
    }
        
    public function getNF(){
        return $this->nf;
    }
    
    public function setBusca ($busca){
        $this->busca = $busca;
    }
        
    public function getBusca(){
        return $this->busca;
    }
    
    public function setNotaDevolucao ($nnotad){
        $this->nnotad = $nnotad;
    }
        
    public function getNotaDevolucao(){
        return $this->nnotad;
    }
    
    public function setFrete ($frete){
        $this->frete = $frete;
    }
        
    public function getFrete(){
        return $this->frete;
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
    
    
    public function setCliente ($cliente){
        $this->cliente = $cliente;
    }
        
    public function getCliente(){
        return $this->cliente;
    }
    
    public function setCidade ($cidade){
        $this->cidade = $cidade;
    }
        
    public function getCidade(){
        return $this->cidade;
    }
    
    public function setCep ($cep){
        $this->cep = $cep;
    }
        
    public function getCep(){
        return $this->cep;
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
    
    public function setIDformapg ($idformapg){
        $this->idformapg = $idformapg;
    }
        
    public function getIDformapg(){
        return $this->idformapg;
    }
    
    public function setIDcliente ($idcliente){
        $this->idcliente = $idcliente;
    }
        
    public function getIDcliente(){
        return $this->idcliente;
    }
    
    public function setAtivo ($ativo){
        $this->ativo= $ativo;
    }
        
    public function getAtivo(){
        return $this->ativo;
    }
    
    public function setValorDesconto ($valordesconto){
        $this->valordesconto= $valordesconto;
    }
        
    public function getValorDesconto(){
        return $this->valordesconto;
    }
    
    public function setTotal ($total){
        $this->total= $total;
    }
        
    public function getTotal(){
        return $this->total;
    }
    
    public function setAcrescimo ($acrescimo){
        $this->acrescimo = $acrescimo;
    }
        
    public function getAcrescimo(){
        return $this->acrescimo;
    }
    
    public function setObs ($obs){
        $this->obs = $obs;
    }
        
    public function getObs(){
        return $this->obs;
    }
    
    public function setQuantitem ($quantitem){
        $this->quantitem = $quantitem;
    }
        
    public function getQuantitem(){
        return $this->quantitem;
    }
    
    public function setDataentrada ($dataentrada){
        $this->dataentrada = $dataentrada;
    }
        
    public function getDataentrada(){
        return $this->dataentrada;
    }
    
    
    public function setIDEmpresa ($idempresa){
        $this->idempresa = $idempresa;
    }
        
    public function getIDEmpresa(){
        return $this->idempresa;
    }
    
    public function setIDVendedor ($idvendedor){
        $this->idvendedor = $idvendedor;
    }
        
    public function getIDVendedor(){
        return $this->idvendedor;
    }
    
    public function setIDnfs ($idnfs){
        $this->idnfs = $idnfs;
    }
        
    public function getIDnfs(){
        return $this->idnfs;
    }
    
    public function setTipo ($tipo){
        $this->tipo = $tipo;
    }
        
    public function getTipo(){
        return $this->tipo;
    }
    
    public function setFormapg ($formapg){
        $this->formapg = $formapg;
    }
        
    public function getFormapg(){
        return $this->formapg;
    }
    
    public function setValorfinal ($valorfinal){
        $this->valorfinal = $valorfinal;
    }
        
    public function getValorfinal(){
        return $this->valorfinal;
    }
    
}

?>