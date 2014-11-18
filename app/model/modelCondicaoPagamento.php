<?php

class modelCondicaoPagamento {
    // atributos
    private $descricao;
    private $idcondicao;
    private $np;
    private $ip;
    private $entrada;
    private $desconto;
    private $acrescimo;
    

    // métodos
    public function __construct(){
        
    }
    public function setIDCondicao ($idcondicao){
        $this->idcondicao = $idcondicao;
    }
    
    public function getIDCondicao(){
        return $this->idcondicao;
    }
    
    public function setDescricao ($descricao){
        $this->descricao = $descricao;
    }
    
    public function getDescricao(){
        return $this->descricao;
    }
    public function setNp ($np){
        $this->np = $np;
    }
    
    public function getNp(){
        return $this->np;
    }
    
    public function setIp ($ip){
        $this->ip = $ip;
    }
    
    public function getIp(){
        return $this->ip;
    }
    
    public function setEntrada ($entrada){
        $this->entrada = $entrada;
    }
    
    public function getEntrada(){
        return $this->entrada;
    }
    
    public function setDesconto ($desconto){
        $this->desconto = $desconto;
    }
    
    public function getDesconto(){
        return $this->desconto;
    }
    
    public function setAcrescimo ($acrescimo){
        $this->acrescimo = $acrescimo;
    }
    
    public function getAcrescimo(){
        return $this->acrescimo;
    }
    
}
?>