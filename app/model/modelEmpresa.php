<?php
class modelEmpresa {
    // atributos
    private $idempresa;
    private $nome;
    private $cnpj;
    private $endereco;
    private $numero;
    private $bairro;
    private $cidade;
    private $uf;
    private $cep;
    
    // métodos
    public function __construct(){
        
    }
    public function setIDEmpresa ($idempresa) {
        $this->idempresa = $idempresa;
    }
    public function getIDEmpresa () {
        return $this->idempresa;
    }
    
    public function setNome ($nome){
        $this->nome = $nome;
    }
    
    public function getNome (){
        return $this->nome;
    }
    
    public function setCnpj ($cnpj){
        $this->cnpj = $cnpj;
    }
    
    public function getCnpj(){
        return $this->cnpj;
    }
    
    public function setEndereco ($endereco){
        $this->endereco = $endereco;
    }
    
    public function getEndereco (){
        return $this->endereco;
    }
    
    public function setNumero ($numero){
        $this->numero = $numero;
    }
    
    public function getNumero (){
        return $this->numero;
    }
    
    public function setBairro ($bairro){
        $this->bairro = $bairro;
    }
    
    public function getBairro (){
        return $this->bairro;
    }
    
    public function setCidade ($cidade){
        $this->cidade = $cidade;
    }
    
    public function getCidade (){
        return $this->cidade;
    }
    
    public function setUf ($uf){
        $this->uf = $uf;
    }
    
    public function getUf (){
        return $this->uf;
    }
    
    public function setCep ($cep){
        $this->cep = $cep;
    }
    
    public function getCep (){
        return $this->cep;
    }
        
}
?>