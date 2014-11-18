<?php

class modelExportar {
    // atributos
    private $tabela;
    private $cliente;
    private $produto;
    private $fornecedor;
    private $marca;

    // métodos
    public function __construct(){
        
    }
    
    public function setProduto ($produto){
        $this->produto = $produto;
    }
        
    public function getProduto(){
        return $this->produto;
    }
    
    public function setCliente ($cliente){
        $this->cliente = $cliente;
    }
        
    public function getCliente(){
        return $this->cliente;
    }
    
    public function setTabela ($tabela){
        $this->tabela = $tabela;
    }
        
    public function getTabela(){
        return $this->tabela;
    }
    
    public function setFornecedor ($fornecedor){
        $this->fornecedor = $fornecedor;
    }
        
    public function getFornecedor(){
        return $this->fornecedor;
    }
    
    public function setMarca ($marca){
        $this->marca = $marca;
    }
        
    public function getMarca(){
        return $this->marca;
    }
        
}
?>