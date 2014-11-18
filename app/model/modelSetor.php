<?php
class modelSetor {
    // atributos
    private $idempresa;
    private $idsetor;
    private $nome;
    private $cnpj;
    private $descricao;
    private $comissao;
    
    // métodos
    public function __construct(){
        
    }
    
    public function setIDSetor ($idsetor) {
        $this->idsetor = $idsetor;
    }
    public function getIDSetor () {
        return $this->idsetor;
    }
    
    public function setIDEmpresa ($idempresa) {
        $this->idempresa = $idempresa;
    }
    public function getIDEmpresa () {
        return $this->idempresa;
    }
    
    public function setCnpj ($cnpj){
        $this->cnpj = $cnpj;
    }
    
    public function getCnpj (){
        return $this->cnpj;
    }
    
    public function setNome ($nome){
        $this->nome = $nome;
    }
    
    public function getNome (){
        return $this->nome;
    }
    
    public function setDescricao ($descricao){
        $this->descricao = $descricao;
    }
    
    public function getDescricao (){
        return $this->descricao;
    }
    
    public function setComissao ($comissao){
        $this->comissao = $comissao;
    }
    
    public function getComissao(){
        return $this->comissao;
    }
    
    
}
?>