<?php

class modelContaBanco {
    // atributos
    private $banco;
    private $idbanco;
    private $agencia;
    private $conta;
    private $titular;
    
    // métodos
    public function __construct(){
        
    }
    public function setIDBanco ($idbanco){
        $this->idbanco = $idbanco;
    }
    
    public function getIDBanco(){
        return $this->idbanco;
    }
    
    public function setBanco ($banco){
        $this->banco = $banco;
    }
    
    public function getBanco(){
        return $this->banco;
    }
    public function setAgencia ($agencia){
        $this->agencia = $agencia;
    }
    
    public function getAgencia(){
        return $this->agencia;
    }
    
    public function setConta ($conta){
        $this->conta = $conta;
    }
    
    public function getConta(){
        return $this->conta;
    }
    
    public function setTitular ($titular){
        $this->titular = $titular;
    }
    
    public function getTitular(){
        return $this->titular;
    }
    
}
?>