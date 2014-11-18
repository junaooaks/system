<?php

class modelNFentrada {
    // atributos
    private $idnfe;
    private $operacao;
    private $idoperacao;
    private $idfornecedor;
    private $idvendedor;
    private $nf;
    private $fornecedor;
    private $dataemissao;
    private $valorfinal;
    private $condicaopg;
    private $vendedor;
    private $empresa;
    private $idempresa;
    private $dataentrada;
    private $quantitem;
    private $obs;
    private $acrescimo;
    private $total;
    private $busca;
    private $desconto;
    private $ativo;

    // métodos
    public function __construct(){
        
    }
    
    public function setAtivo ($ativo){
        $this->ativo= $ativo;
    }
        
    public function getAtivo(){
        return $this->ativo;
    }
    
    public function setDesconto ($desconto){
        $this->desconto= $desconto;
    }
        
    public function getDesconto(){
        return $this->desconto;
    }
    
    public function setBusca ($busca){
        $this->busca= $busca;
    }
        
    public function getBusca(){
        return $this->busca;
    }
    
    public function setTotal ($total){
        $this->total= $total;
    }
        
    public function getTotal(){
        return $this->total;
    }
    
    public function setAcrescimo ($acrescimo){
        $this->acrescimo = $acrescimo;
    }
        
    public function getAcrescimo(){
        return $this->acrescimo;
    }
    
    public function setObs ($obs){
        $this->obs = $obs;
    }
        
    public function getObs(){
        return $this->obs;
    }
    
    public function setQuantitem ($quantitem){
        $this->quantitem = $quantitem;
    }
        
    public function getQuantitem(){
        return $this->quantitem;
    }
    
    public function setDataentrada ($dataentrada){
        $this->dataentrada = $dataentrada;
    }
        
    public function getDataentrada(){
        return $this->dataentrada;
    }
    
    
    public function setIDEmpresa ($idempresa){
        $this->idempresa = $idempresa;
    }
        
    public function getIDEmpresa(){
        return $this->idempresa;
    }
    
    public function setEmpresa ($empresa){
        $this->empresa = $empresa;
    }
        
    public function getEmpresa(){
        return $this->empresa;
    }
    
    public function setVendedor ($vendedor){
        $this->vendedor = $vendedor;
    }
        
    public function getVendedor(){
        return $this->vendedor;
    }
    
    public function setIDVendedor ($idvendedor){
        $this->idvendedor = $idvendedor;
    }
        
    public function getIDVendedor(){
        return $this->idvendedor;
    }
    
    public function setIDFornecedor ($idfornecedor){
        $this->idfornecedor = $idfornecedor;
    }
        
    public function getIDFornecedor(){
        return $this->idfornecedor;
    }
    
    public function setIDnfe ($idnfe){
        $this->idnfe = $idnfe;
    }
        
    public function getIDnfe(){
        return $this->idnfe;
    }
    
    public function setIDOperacao ($idoperacao){
        $this->idoperacao = $idoperacao;
    }
        
    public function getIDOperacao(){
        return $this->idoperacao;
    }
    
    public function setOperacao ($operacao){
        $this->operacao = $operacao;
    }
        
    public function getOperacao(){
        return $this->operacao;
    }
    
    public function setNf ($nf){
        $this->nf = $nf;
    }
        
    public function getNf(){
        return $this->nf;
    }
    
    public function setFornecedor ($fornecedor){
        $this->fornecedor = $fornecedor;
    }
        
    public function getFornecedor(){
        return $this->fornecedor;
    }
    
    public function setDataemissao ($dataemissao){
        $this->dataemissao = $dataemissao;
    }
        
    public function getDataemissao(){
        return $this->dataemissao;
    }
    
    public function setValorfinal ($valorfinal){
        $this->valorfinal = $valorfinal;
    }
        
    public function getValorfinal(){
        return $this->valorfinal;
    }
    
    public function setCondicaopg ($condicaopg){
        $this->condicaopg = $condicaopg;
    }
        
    public function getCondicaopg(){
        return $this->condicaopg;
    }
    
}
?>