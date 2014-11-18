<?php

class UnidadeMedida {
    // atributos
    private $descricao;
    private $idunidade;
    private $sigla;
    

    // métodos
    public function __construct(){
        
    }
    public function setIDUnidade ($idunidade){
        $this->idunidade = $idunidade;
    }
    
    public function getIDUnidade(){
        return $this->idunidade;
    }
    
    public function setDescricao ($descricao){
        $this->descricao = $descricao;
    }
    
    public function getDescricao(){
        return $this->descricao;
    }
    public function setSigla ($sigla){
        $this->sigla = $sigla;
    }
    
    public function getSigla(){
        return $this->sigla;
    }
    
}
?>