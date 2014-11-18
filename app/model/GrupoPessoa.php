<?php

class GrupoPessoa {
    // atributos
    private $grupo;
    

    // métodos
    public function __construct(){
        
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