<?php

class modelOperacao {
    // atributos
    private $descricao;
    private $idoperacao;
    private $financa;
    private $comissao;
    private $tipo;
    
    // métodos
    public function __construct(){
        
    }
    public function setIDOperacao ($idoperacao){
        $this->idoperacao = $idoperacao;
    }
    
    public function getIDOperacao(){
        return $this->idoperacao;
    }
    
    public function setDescricao ($descricao){
        $this->descricao = $descricao;
    }
    
    public function getDescricao(){
        return $this->descricao;
    }
    public function setFinanca ($financa){
        $this->financa = $financa;
    }
    
    public function getFinanca(){
        return $this->financa;
    }
    
    public function setComissao ($comissao){
        $this->comissao = $comissao;
    }
    
    public function getComissao(){
        return $this->comissao;
    }
    
    public function setTipo ($tipo){
        $this->tipo = $tipo;
    }
    
    public function getTipo(){
        return $this->tipo;
    }
}
?>