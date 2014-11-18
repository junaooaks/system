<?php

class modelCaixa {
    // atributos
    private $descricao;
    private $idcaixa;
    private $senha;


        // métodos
    public function __construct(){
        
    }
    public function setIDCaixa ($idcaixa){
        $this->idcaixa = $idcaixa;
    }
        
    public function getIDCaixa(){
        return $this->idcaixa;
    }
    
    public function setDescricao ($descricao){
        $this->descricao = $descricao;
    }
    
    public function getDescricao(){
        return $this->descricao;
    }
    
    public function setSenha ($senha){
        $this->senha = $senha;
    }
    
    public function getSenha(){
        return $this->senha;
    }
    
}
?>