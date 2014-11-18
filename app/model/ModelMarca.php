<?php

class ModelMarca {
    // atributos
    private $marca;
    private $idmarca;
    

    // métodos
    public function __construct(){
        
    }
    public function setIDMarca ($idmarca){
        $this->idmarca = $idmarca;
    }
        
    public function getIDMarca(){
        return $this->idmarca;
    }
    
    public function setMarca ($marca){
        $this->marca = $marca;
    }
    
    public function getMarca(){
        return $this->marca;
    }
    
}
?>