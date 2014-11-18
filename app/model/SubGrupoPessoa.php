<?php

class SubGrupoPessoa {
    // atributos
    private $grupo;
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
    
    public function setGrupo ($grupo){
        $this->grupo = $grupo;
    }
    
    public function getGrupo(){
        return $this->grupo;
    }
    
}
?>