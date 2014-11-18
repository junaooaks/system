<?php
class modelFinanceiro {
    // atributos
    
    private $busca;
    private $codFinanceiro;
    private $codAvalista;
    private $codCliente;
    private $dataAvaliacao;
    private $limiteCredito;
    private $enderecoCobranca;
    private $dataCobranca;
    private $rendaFixa;
    private $moradia;
    private $spc;
    private $serasa;
    private $obs;
    private $comer1;
    private $comer2;
    private $comer3;
    private $comer4;
    private $comer5;
    private $banco1;
    private $banco2;
    private $banco3;
    private $nomecliente;
    private $cep;
    private $endereco;
    private $bairro;
    private $cidade;
    private $numero;
    private $ativo;
    private $nomeavalista;
    private $rendafixacliente;
    private $credpessoa;
    
    public function __construct(){
        
    }
    public function setCodFinanceiro ($codFinanceiro) {
        $this->codFinanceiro = $codFinanceiro;
    }
    public function getCodFinanceiro () {
        return $this->codFinanceiro;
    }
    public function setCredPessoa ($credpessoa) {
        $this->credpessoa = $credpessoa;
    }
    public function getCredPessoa () {
        return $this->credpessoa;
    }
    public function setRendaFixaCliente ($rendafixacliente) {
        $this->rendafixacliente = $rendafixacliente;
    }
    public function getRendaFixaCliente () {
        return $this->rendafixacliente;
    }
    public function setNomeAvalista ($nomeavalista) {
        $this->nomeavalista = $nomeavalista;
    }
    public function getNomeAvalista () {
        return $this->nomeavalista;
    }
    public function setAtivo ($ativo) {
        $this->ativo = $ativo;
    }
    public function getAtivo () {
        return $this->ativo;
    }
    public function setCep ($cep) {
        $this->cep = $cep;
    }
    public function getCep () {
        return $this->cep;
    }
    public function setEndereco ($endereco) {
        $this->endereco = $endereco;
    }
    public function getEndereco () {
        return $this->endereco;
    }
    public function setBairro ($bairro) {
        $this->bairro = $bairro;
    }
    public function getBairro () {
        return $this->bairro;
    }
    public function setCidade ($cidade) {
        $this->cidade = $cidade;
    }
    public function getCidade () {
        return $this->cidade;
    }
    public function setNumero ($numero) {
        $this->numero = $numero;
    }
    public function getNumero () {
        return $this->numero;
    }
    public function setNomeCliente ($nomecliente) {
        $this->nomecliente = $nomecliente;
    }
    public function getNomeCliente () {
        return $this->nomecliente;
    }
    public function setBusca ($busca) {
        $this->busca = $busca;
    }
    public function getBusca () {
        return $this->busca;
    }
    public function setCodAvalista ($codAvalista) {
        $this->codAvalista = $codAvalista;
    }
    public function getCodAvalista () {
        return $this->codAvalista;
    }
    public function setCodCliente ($codCliente) {
        $this->codCliente = $codCliente;
    }
    public function getCodCliente () {
        return $this->codCliente;
    }
    public function setDataAvaliacao ($dataAvaliacao) {
        $this->dataAvaliacao = $dataAvaliacao;
    }
    public function getDataAvaliacao () {
        return $this->dataAvaliacao;
    }
    public function setLimiteCredito ($limiteCredito) {
        $this->limiteCredito = $limiteCredito;
    }
    public function getLimiteCredito () {
        return $this->limiteCredito;
    }
    public function setEnderecoCobranca ($enderecoCobranca) {
        $this->enderecoCobranca = $enderecoCobranca;
    }
    public function getEnderecoCobranca () {
        return $this->enderecoCobranca;
    }
    public function setDataCobranca ($dataCobranca) {
        $this->dataCobranca = $dataCobranca;
    }
    public function getDataCobranca () {
        return $this->dataCobranca;
    }
    public function setRendaFixa ($rendaFixa) {
        $this->rendaFixa = $rendaFixa;
    }
    public function getRendaFixa () {
        return $this->rendaFixa;
    }
    public function setMoradia ($moradia) {
        $this->moradia = $moradia;
    }
    public function getMoradia () {
        return $this->moradia;
    }
    public function setSpc ($spc) {
        $this->spc = $spc;
    }
    public function getSpc () {
        return $this->spc;
    }
    public function setSerasa ($serasa) {
        $this->serasa = $serasa;
    }
    public function getSerasa () {
        return $this->serasa;
    }
    public function setObs ($obs) {
        $this->obs = $obs;
    }
    public function getObs () {
        return $this->obs;
    }
    public function setComer1 ($comer1) {
        $this->comer1 = $comer1;
    }
    public function getComer1 () {
        return $this->comer1;
    }
    public function setComer2 ($comer2) {
        $this->comer2 = $comer2;
    }
    public function getComer2 () {
        return $this->comer2;
    }
    public function setComer3 ($comer3) {
        $this->comer3 = $comer3;
    }
    public function getComer3 () {
        return $this->comer3;
    }
    public function setComer4 ($comer4) {
        $this->comer4 = $comer4;
    }
    public function getComer4 () {
        return $this->comer4;
    }
    public function setComer5 ($comer5) {
        $this->comer5 = $comer5;
    }
    public function getComer5 () {
        return $this->comer5;
    }
    public function setBanco1 ($banco1) {
        $this->banco1 = $banco1;
    }
    public function getBanco1 () {
        return $this->banco1;
    }
    public function setBanco2 ($banco2) {
        $this->banco2 = $banco2;
    }
    public function getBanco2 () {
        return $this->banco2;
    }
    public function setBanco3 ($banco3) {
        $this->banco3 = $banco3;
    }
    public function getBanco3 () {
        return $this->banco3;
    }
    
    }
?>
