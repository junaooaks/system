<?php
class ModelPeca {
    // atributos
    private $idpeca;
    private $status;
    private $busca;
    private $st;
    private $frete;
    private $preco_custo;
    private $ircs;
    private $preco_venda;
    private $ipi;
    private $frete_p;
    private $pis_confins;
    private $lucro;
    private $comissao;
    private $unitario;
    //relacionamento
    private $grupo;
    private $marca;
    private $unidade;
    private $empresa;
    private $subgrupo;
    private $fornecedor;
    private $custo;
    
    //descricao do produto
    private $codfabricante;
    private $codean;
    private $descricao;
    private $classificacao;
    private $fracionavel;
    private $localizacao;
    private $pesobruto;
    private $pesoliquido;
    private $estoqueatual;
    private $estoqueminimo;
    private $estoquemaximo;
    private $idgrupo;
    private $idsubgrupo;
    private $idmarca;
    private $idfornecedor;
    private $idempresa;
    private $idunidade;
    private $idcusto;
    private $custopro;
    private $pesquisa;
    private $dataAlteracao;
    private $codmang; 

        // métodos
    public function __construct(){
        
    }
    
    public function setCodMang ($codmang) {
        $this->codmang = $codmang;
    }
    public function getCodMang () {
        return $this->codmang;
    }
    
    public function setDataAlteracao ($dataAlteracao) {
        $this->dataAlteracao = $dataAlteracao;
    }
    public function getDataAlteracao () {
        return $this->dataAlteracao;
    }
    
    public function setPesquisa ($pesquisa) {
        $this->pesquisa = $pesquisa;
    }
    public function getPesquisa () {
        return $this->pesquisa;
    }
    
    public function setCustopro ($custopro) {
        $this->custopro = $custopro;
    }
    public function getCustopro () {
        return $this->custopro;
    }
    
    
    public function setIDCusto ($idcusto) {
        $this->idcusto = $idcusto;
    }
    public function getIDCusto () {
        return $this->idcusto;
    }
    
    public function setIDUnidade ($idunidade) {
        $this->idunidade = $idunidade;
    }
    public function getIDUnidade () {
        return $this->idunidade;
    }
    
    public function setIDEmpresa ($idempresa) {
        $this->idempresa = $idempresa;
    }
    public function getIDEmpresa () {
        return $this->idempresa;
    }
    
    public function setIDFornecedor ($idfornecedor) {
        $this->idfornecedor = $idfornecedor;
    }
    public function getIDFornecedor () {
        return $this->idfornecedor;
    }
    
    public function setIDMarca ($idmarca) {
        $this->idmarca = $idmarca;
    }
    public function getIDMarca () {
        return $this->idmarca;
    }
    
    public function setIDSubgrupo ($idsubgrupo) {
        $this->idsubgrupo = $idsubgrupo;
    }
    public function getIDSubgrupo () {
        return $this->idsubgrupo;
    }
    
    public function setIDGrupo ($idgrupo) {
        $this->idgrupo = $idgrupo;
    }
    public function getIDGrupo () {
        return $this->idgrupo;
    }
    
    public function setIDPeca ($idpeca) {
        $this->idpeca = $idpeca;
    }
    public function getIDPeca () {
        return $this->idpeca;
    }
    
    public function setUnitario ($unitario) {
        $this->unitario = $unitario;
    }
    public function getUnitario () {
        return $this->unitario;
    }
    
    public function setStatus ($status) {
        $this->status = $status;
    }
    public function getStatus () {
        return $this->status;
    }
    
    public function setBusca ($busca) {
        $this->busca = $busca;
    }
    public function getBusca () {
        return $this->busca;
    }
    
    
    public function setSt ($st) {
        $this->st = $st;
    }
    public function getSt () {
        return $this->st;
    }
    
    
    public function setFrete ($frete) {
        $this->frete = $frete;
    }
    public function getFrete () {
        return $this->frete;
    }
    
    public function setPrecocusto ($preco_custo) {
        $this->preco_custo = $preco_custo;
    }
    public function getPrecocusto () {
        return $this->preco_custo;
    }
    
    public function setIrcs ($ircs) {
        $this->ircs = $ircs;
    }
    public function getIrcs () {
        return $this->ircs;
    }
    
    public function setPrecovenda ($preco_venda) {
        $this->preco_venda = $preco_venda;
    }
    public function getPrecovenda () {
        return $this->preco_venda;
    }
    
    public function setIpi ($ipi){
        $this->ipi = $ipi;
    }
    
    public function getIpi (){
        return $this->ipi;
    }
    
    public function setFretep ($frete_p){
        $this->frete_p = $frete_p;
    }
    
    public function getFretep (){
        return $this->frete_p;
    }
    
    public function setPisconfins ($pis_confins){
        $this->pis_confins = $pis_confins;
    }
    
    public function getPisconfins (){
        return $this->pis_confins;
    }
    
    public function setLucro ($lucro){
        $this->lucro = $lucro;
    }
    
    public function getLucro (){
        return $this->lucro;
    }
    
    public function setComissao ($comissao){
        $this->comissao = $comissao;
    }
    
    public function getComissao(){
        return $this->comissao;
    }
    
    public function setGrupo ($grupo){
        $this->grupo = $grupo;
    }
    
    public function getGrupo (){
        return $this->grupo;
    }
    
    public function setMarca ($marca){
        $this->marca = $marca;
    }
    
    public function getMarca (){
        return $this->marca;
    }
    
    public function setUnidade ($unidade) {
        $this->unidade = $unidade;
    }
    public function getUnidade () {
        return $this->unidade;
    }
    
    public function setEmpresa ($empresa){
        $this->empresa = $empresa;
    }
    
    public function getEmpresa (){
        return $this->empresa;
    }
    
    public function setSubgrupo ($subgrupo){
        $this->subgrupo = $subgrupo;
    }
    
    public function getSubgrupo (){
        return $this->subgrupo;
    }
    
    public function setFornecedor ($fornecedor){
        $this->fornecedor = $fornecedor;
    }
    
    public function getFornecedor (){
        return $this->fornecedor;
    }
    
    public function setCusto ($custo){
        $this->custo = $custo;
    }
    
    public function getCusto (){
        return $this->custo;
    }
    
    public function setCodfabricante ($codfabricante){
        $this->codfabricante = $codfabricante;
    }
    
    public function getCodfabricante (){
        return $this->codfabricante;
    }
    
    public function setCodean ($codean){
        $this->codean = $codean;
    }
    
    public function getCodean (){
        return $this->codean;
    }
    
    public function setDescricao ($descricao){
        $this->descricao = $descricao;
    }
    
    public function getDescricao (){
        return $this->descricao;
    }
    
    public function setClassificacao ($classificacao){
        $this->classificacao = $classificacao;
    }
    
    public function getClassificacao (){
        return $this->classificacao;
    }
    
    public function setFracionavel ($fracionavel){
        $this->fracionavel = $fracionavel;
    }
    
    public function getFracionavel (){
        return $this->fracionavel;
    }
    
    public function setLocalizacao ($localizacao){
        $this->localizacao = $localizacao;
    }
    
    public function getLocalizacao (){
        return $this->localizacao;
    }
    
    public function setPesobruto ($pesobruto){
        $this->pesobruto = $pesobruto;
    }
    
    public function getPesobruto (){
        return $this->pesobruto;
    }
    
    public function setPesoliquido ($pesoliquido){
        $this->pesoliquido = $pesoliquido;
    }
    
    public function getPesoliquido(){
        return $this->pesoliquido;
    }
    
    public function setEstoqueatual ($estoqueatual){
        $this->estoqueatual = $estoqueatual;
    }
    
    public function getEstoqueatual(){
        return $this->estoqueatual;
    }
    
     public function setEstoqueminimo ($estoqueminimo){
        $this->estoqueminimo = $estoqueminimo;
    }
    
    public function getEstoqueminimo(){
        return $this->estoqueminimo;
    }
    
    public function setEstoquemaximo ($estoquemaximo){
        $this->estoquemaximo = $estoquemaximo;
    }
    
    public function getEstoquemaximo(){
        return $this->estoquemaximo;
    } 
    
}
?>