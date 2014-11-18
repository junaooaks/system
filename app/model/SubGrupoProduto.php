<?php

class SubGrupoProduto {
    // atributos
    private $subgrupo;
    private $idsubgrupo;
    private $idgrupo;

    // métodos
    public function __construct(){
        
    }
    public function setIDSubGrupo ($idsubgrupo){
        $this->idsubgrupo = $idsubgrupo;
    }
        
    public function getIDSubGrupo(){
        return $this->idsubgrupo;
    }
    
    public function setIDGrupo ($idgrupo){
        $this->idgrupo = $idgrupo;
    }
    public function getIDGrupo(){
        return $this->idgrupo;
    }
    
    public function setSubGrupo ($subgrupo){
        $this->subgrupo = $subgrupo;
    }
    
    public function getSubGrupo(){
        return $this->subgrupo;
    }
    
}
?>