<?php

class GrupoProduto {
    // atributos
    private $grupo;
    private $idgrupo;
    private $comissao;
    

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
    public function setComissao ($comissao){
        $this->comissao = $comissao;
    }
    
    public function getComissao(){
        return $this->comissao;
    }
    
}
?>