<?php
class Pessoa {
    // atributos
    private $idpessoa;
    private $status;
    private $nome;
    private $pai;
    private $mae;
    private $fantasia;
    private $cpfCnpj;
    private $datanascimento;
    
    private $obs;
    private $civil;
    private $email;
    private $endereco;
    private $numero;
    private $bairro;
    private $complementar;
    private $cidade;
    private $uf;
    private $cep;
    private $telres;
    private $ref1;
    private $ref2;
    private $celres;
    private $ref3;
    //private $telefonecel;
    private $telcom;
    //private $prefixocom;
    //private $telefonecom;
    private $celcom;
    //private $prefixocel2;
    //private $telefonecel2;
    private $avaliacao;
    private $profissao;
    private $empresa;
    
    private $sexo;
    private $identidade;
    private $idgrupo;
    private $datainsert;
    private $dataupdate;
    private $busca;

    // métodos
    public function __construct(){
        
    }
    public function setRef3 ($ref3) {
        $this->ref3 = $ref3;
    }
    public function getRef3 () {
        return $this->ref3;
    }
    public function setRef2 ($ref2) {
        $this->ref2 = $ref2;
    }
    public function getRef2 () {
        return $this->ref2;
    }
    
    public function setRef1 ($ref1) {
        $this->ref1 = $ref1;
    }
    public function getRef1 () {
        return $this->ref1;
    }
    
    public function setObs ($obs) {
        $this->obs = $obs;
    }
    public function getObs () {
        return $this->obs;
    }
    
    public function setBusca ($busca) {
        $this->busca = $busca;
    }
    public function getBusca () {
        return $this->busca;
    }
    
    
    public function setDatainsert ($datainsert) {
        $this->datainsert = $datainsert;
    }
    public function getDatainsert () {
        return $this->datainsert;
    }
    
    public function setDataupdate ($dataupdate) {
        $this->dataupdate = $dataupdate;
    }
    public function getDataupdate () {
        return $this->dataupdate;
    }
    
    
    public function setIDTipo ($idtipo) {
        $this->idtipo = $idtipo;
    }
    public function getIDTipo () {
        return $this->idtipo;
    }
    
    
    public function setIDGrupo ($idgrupo) {
        $this->idgrupo = $idgrupo;
    }
    public function getIDGrupo () {
        return $this->idgrupo;
    }
    
    public function setIDpessoa ($idpessoa) {
        $this->idpessoa = $idpessoa;
    }
    public function getIDpessoa () {
        return $this->idpessoa;
    }
    
    public function setIdentidade ($identidade) {
        $this->identidade = $identidade;
    }
    public function getIdentidade () {
        return $this->identidade;
    }
    
    public function setStatus ($status) {
        $this->status = $status;
    }
    public function getStatus () {
        return $this->status;
    }
    
    public function setNome ($nome){
        $this->nome = $nome;
    }
    
    public function getNome (){
        return $this->nome;
    }
    
    public function setPai ($pai){
        $this->pai = $pai;
    }
    
    public function getPai (){
        return $this->pai;
    }
    
    public function setMae ($mae){
        $this->mae = $mae;
    }
    
    public function getMae (){
        return $this->mae;
    }
    
    public function setFantasia ($fantasia){
        $this->fantasia = $fantasia;
    }
    
    public function getFantasia (){
        return $this->fantasia;
    }
    
    public function setCpfcnpj ($cpfCnpj){
        $this->cpfCnpj = $cpfCnpj;
    }
    
    public function getCpfcnpj(){
        return $this->cpfCnpj;
    }
    
    public function setDatanascimento ($datanascimento){
        $this->datanascimento = $datanascimento;
    }
    
    public function getDatanascimento (){
        return $this->datanascimento;
    }
    
    public function setCivil ($civil){
        $this->civil = $civil;
    }
    
    public function getCivil (){
        return $this->civil;
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
    
    public function setComplementar ($complementar){
        $this->complementar = $complementar;
    }
    
    public function getComplementar (){
        return $this->complementar;
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