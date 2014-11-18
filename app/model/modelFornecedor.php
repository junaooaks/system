<?php
class modelFornecedor {
    // atributos
    private $idfornecedor;
    private $idvendedor;
    private $nome;
    
    private $cnpj;
    private $ie;
    private $email;
    private $endereco;
    private $numero;
    private $bairro;
    private $cidade;
    private $uf;
    private $cep;
    private $telres;
    private $celres;
    private $telcom;
    private $celcom;
    private $site;
    private $busca;

    // métodos
    public function __construct(){
        
    }
    
    public function setSite ($site) {
        $this->site = $site;
    }
    public function getSite () {
        return $this->site;
    }
    
    public function setBusca ($busca) {
        $this->busca = $busca;
    }
    public function getBusca () {
        return $this->busca;
    }

    public function setIDFornecedor ($idfornecedor) {
        $this->idfornecedor = $idfornecedor;
    }
    public function getIDFornecedor () {
        return $this->idfornecedor;
    }
    
    
    public function setIDVendedor ($idvendedor) {
        $this->idvendedor = $idvendedor;
    }
    public function getIDVendedor () {
        return $this->idvendedor;
    }
    
    public function setNome ($nome) {
        $this->nome = $nome;
    }
    public function getNome () {
        return $this->nome;
    }
    
    public function setIe ($ie) {
        $this->ie = $ie;
    }
    public function getIe () {
        return $this->ie;
    }
    
    public function setCnpj ($cnpj){
        $this->cnpj = $cnpj;
    }
    
    public function getCnpj(){
        return $this->cnpj;
    }
    
    public function setEmail ($email) {
        $this->email = $email;
    }
    public function getEmail () {
        return $this->email;
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
    
    public function setTelres ($telres){
        $this->telres = $telres;
    }
    
    public function getTelres (){
        return $this->telres;
    }
    
    public function setCelres ($celres){
        $this->celres = $celres;
    }
    
    public function getCelres (){
        return $this->celres;
    }
    
    public function setTelcom ($telcom){
        $this->telcom = $telcom;
    }
    
    public function getTelcom (){
        return $this->telcom;
    }
    
    public function setCelcom ($celcom){
        $this->celcom = $celcom;
    }
    
    public function getCelcom (){
        return $this->celcom;
    }
    
    public function setAvaliacao ($avaliacao){
        $this->avaliacao = $avaliacao;
    }
    
    public function getAvaliacao(){
        return $this->avaliacao;
    }
    
    public function setProfissao ($profissao){
        $this->profissao = $profissao;
    }
    
    public function getProfissao(){
        return $this->profissao;
    }
    
     public function setEmpresa ($empresa){
        $this->empresa = $empresa;
    }
    
    public function getEmpresa(){
        return $this->empresa;
    }
    
    public function setSexo ($sexo){
        $this->sexo = $sexo;
    }
    
    public function getSexo(){
        return $this->sexo;
    } 
    
}
?>