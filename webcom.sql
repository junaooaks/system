CREATE TABLE IF NOT EXISTS `caixa` (
  `idcaixa` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`idcaixa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cheques`
--

CREATE TABLE IF NOT EXISTS `cheques` (
  `idcheques` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_idpessoa` int(11) NOT NULL,
  `titular` varchar(200) DEFAULT NULL,
  `emissao` date NOT NULL,
  `vencimento` date NOT NULL,
  `valor` float(18,2) DEFAULT NULL,
  `situacao` char(30) NOT NULL,
  PRIMARY KEY (`idcheques`),
  KEY `fk_cheques_pessoa1` (`pessoa_idpessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comissao`
--

CREATE TABLE IF NOT EXISTS `comissao` (
  `idcomissao` int(11) NOT NULL AUTO_INCREMENT,
  `funcionario_idfuncionario` int(11) NOT NULL,
  `notaSaida_idnotaSaida` int(11) NOT NULL,
  PRIMARY KEY (`idcomissao`),
  KEY `fk_comissao_funcionario1` (`funcionario_idfuncionario`),
  KEY `fk_comissao_notaSaida1` (`notaSaida_idnotaSaida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `condicaopagamento`
--

CREATE TABLE IF NOT EXISTS `condicaopagamento` (
  `idcondicaoPagamento` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `numeroParcelas` int(11) DEFAULT NULL,
  `intervaloParcelas` int(11) DEFAULT NULL,
  `entrada` mediumint(9) DEFAULT NULL,
  `desconto` mediumint(9) DEFAULT NULL,
  `acrescimo` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`idcondicaoPagamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contabanco`
--

CREATE TABLE IF NOT EXISTS `contabanco` (
  `idcontaBanco` int(11) NOT NULL AUTO_INCREMENT,
  `banco` char(20) NOT NULL,
  `agencia` char(20) NOT NULL,
  `contaCorrente` char(20) NOT NULL,
  `titular` varchar(150) NOT NULL,
  PRIMARY KEY (`idcontaBanco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contaspagar`
--

CREATE TABLE IF NOT EXISTS `contaspagar` (
  `notaEntrada_idnotaEntrada` int(11) NOT NULL,
  `fluxoCaixa_idfluxoCaixa` int(11) NOT NULL,
  `dataEmissao` date NOT NULL,
  `dataVencimento` date NOT NULL,
  `valorOriginal` float(18,2) NOT NULL,
  `numeroParcela` int(11) NOT NULL,
  `valorParcelas` float(18,2) DEFAULT NULL,
  `valorPago` float(18,2) DEFAULT NULL,
  PRIMARY KEY (`notaEntrada_idnotaEntrada`,`fluxoCaixa_idfluxoCaixa`),
  KEY `fk_notaEntrada_has_fluxoCaixa_fluxoCaixa1` (`fluxoCaixa_idfluxoCaixa`),
  KEY `fk_notaEntrada_has_fluxoCaixa_notaEntrada1` (`notaEntrada_idnotaEntrada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contasreceber`
--

CREATE TABLE IF NOT EXISTS `contasreceber` (
  `idcontareceber` int(11) NOT NULL AUTO_INCREMENT,
  `notaSaida_idnotaSaida` int(11) NOT NULL,
  `pessoa_idpessoa` int(11) NOT NULL,
  `movimentoBancario_idmovimentoBancario` int(11) DEFAULT NULL,
  `dataEmissao` date DEFAULT NULL,
  `dataVencimento` date DEFAULT NULL,
  `dataRecebimento` date DEFAULT NULL,
  `valorOriginal` float(18,2) DEFAULT NULL,
  `numeroParcela` int(11) DEFAULT NULL,
  `valorParcelas` float(18,2) DEFAULT NULL,
  `valorRecebido` float(18,2) DEFAULT NULL,
  `statu` char(5) DEFAULT NULL,
  PRIMARY KEY (`idcontareceber`,`notaSaida_idnotaSaida`),
  KEY `fk_fluxoCaixa_has_notaSaida_notaSaida1` (`notaSaida_idnotaSaida`),
  KEY `fk_pessoa` (`pessoa_idpessoa`),
  KEY `fk_fluxoCaixa_has_notaSaida_fluxoCaixa1` (`idcontareceber`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `custo`
--

CREATE TABLE IF NOT EXISTS `custo` (
  `idcusto` int(11) NOT NULL AUTO_INCREMENT,
  `valorUnitario` float(18,3) NOT NULL,
  `st` char(10) NOT NULL,
  `ipi` char(10) NOT NULL,
  `frete` float(18,2) NOT NULL,
  `fretePorcentagen` tinyint(1) NOT NULL,
  `precoCusto` float(18,3) NOT NULL,
  `piscofins` float(18,2) NOT NULL,
  `irCsll` float(18,2) NOT NULL,
  `Lucro` float(18,2) NOT NULL,
  `precoVenda` float(18,2) NOT NULL,
  `percentualComissao` mediumint(9) NOT NULL,
  PRIMARY KEY (`idcusto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ecommerce`
--

CREATE TABLE IF NOT EXISTS `ecommerce` (
  `idecommerce` int(11) NOT NULL AUTO_INCREMENT,
  `fornecedor_idfornecedor` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `usuario` char(50) NOT NULL,
  `senha` char(50) NOT NULL,
  PRIMARY KEY (`idecommerce`,`fornecedor_idfornecedor`),
  KEY `fk_ecommerce_fornecedor` (`fornecedor_idfornecedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `idempresa` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `endereco` varchar(200) NOT NULL,
  `numero` char(20) DEFAULT NULL,
  `bairro` varchar(200) NOT NULL,
  `cidade` varchar(200) NOT NULL,
  `estado` char(5) NOT NULL,
  `cep` char(20) NOT NULL,
  `cnpj` char(20) NOT NULL,
  PRIMARY KEY (`idempresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `financeiro`
--

CREATE TABLE IF NOT EXISTS `financeiro` (
  `idfinanceiro` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_idpessoa` int(11) NOT NULL,
  `idAvalista` int(11) DEFAULT NULL,
  `dataAvaliacao` datetime NOT NULL,
  `dataUpdate` datetime DEFAULT NULL,
  `enderecoCobranca` varchar(200) DEFAULT NULL,
  `dataCobranca` char(3) NOT NULL,
  `consultaSpc` varchar(200) DEFAULT NULL,
  `consultaSerasa` char(10) NOT NULL,
  `renda` float(18,2) NOT NULL,
  `moradia` char(50) NOT NULL,
  `limiteCredito` float(18,2) DEFAULT NULL,
  `referenciaComercial1` varchar(200) DEFAULT NULL,
  `referenciaComercial2` varchar(200) DEFAULT NULL,
  `referenciaComercial3` varchar(200) DEFAULT NULL,
  `referenciaComercial4` varchar(200) DEFAULT NULL,
  `referenciaComercial5` varchar(200) DEFAULT NULL,
  `referenciaBancaria1` varchar(200) DEFAULT NULL,
  `referenciaBancaria2` varchar(200) DEFAULT NULL,
  `referenciaBancaria3` varchar(200) DEFAULT NULL,
  `obs` text NOT NULL,
  PRIMARY KEY (`idfinanceiro`),
  KEY `fk_financeiro_pessoa1` (`pessoa_idpessoa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

--
-- Gatilhos `financeiro`
--
DROP TRIGGER IF EXISTS `bi_financeiro`;
DELIMITER //
CREATE TRIGGER `bi_financeiro` BEFORE INSERT ON `financeiro`
 FOR EACH ROW set new.dataAvaliacao = current_timestamp
//
DELIMITER ;
DROP TRIGGER IF EXISTS `bu_financeiro`;
DELIMITER //
CREATE TRIGGER `bu_financeiro` BEFORE UPDATE ON `financeiro`
 FOR EACH ROW set new.dataUpdate = current_timestamp
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fluxocaixa`
--

CREATE TABLE IF NOT EXISTS `fluxocaixa` (
  `idfluxoCaixa` int(11) NOT NULL AUTO_INCREMENT,
  `caixa_idcaixa` int(11) NOT NULL,
  `cheques_idcheques` int(11) NOT NULL,
  `data` date NOT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `valorLiquido` float(18,2) DEFAULT NULL,
  `valor` float(18,2) DEFAULT NULL,
  `valorCheque` float(18,2) DEFAULT NULL,
  PRIMARY KEY (`idfluxoCaixa`),
  KEY `fk_fluxoCaixa_caixa` (`caixa_idcaixa`),
  KEY `fk_fluxoCaixa_cheques` (`cheques_idcheques`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE IF NOT EXISTS `fornecedor` (
  `idfornecedor` int(11) NOT NULL AUTO_INCREMENT,
  `vendedor_idvendedor` int(11) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `cnpj` char(20) NOT NULL,
  `ie` char(20) DEFAULT NULL,
  `endereco` varchar(150) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `numero` char(10) NOT NULL,
  `cep` char(20) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` char(5) NOT NULL,
  `telefone` char(20) NOT NULL,
  `telefone2` char(20) DEFAULT NULL,
  `telefone3` char(20) DEFAULT NULL,
  `telefone4` char(20) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idfornecedor`),
  KEY `fk_fornecedor_vendedor1` (`vendedor_idvendedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
  `idfuncionario` int(11) NOT NULL AUTO_INCREMENT,
  `setor_idsetor` int(11) NOT NULL,
  `setor_empresa_idempresa` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `sexo` char(5) NOT NULL,
  `cpf` int(11) NOT NULL,
  `identidade` char(20) NOT NULL,
  `pis` char(20) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `estadoCivil` char(20) NOT NULL,
  `dataNascimento` date NOT NULL,
  `nomePai` varchar(200) DEFAULT NULL,
  `nomeMae` varchar(200) DEFAULT NULL,
  `dataCadastro` datetime NOT NULL,
  `dataUpdate` datetime DEFAULT NULL,
  `endereco` varchar(200) NOT NULL,
  `bairro` varchar(200) NOT NULL,
  `cep` char(20) NOT NULL,
  `cidade` varchar(150) NOT NULL,
  `uf` char(5) NOT NULL,
  `numero` char(20) DEFAULT NULL,
  `telefone` char(20) DEFAULT NULL,
  `celular1` char(20) DEFAULT NULL,
  `celuar2` char(20) DEFAULT NULL,
  `percentualComissao` decimal(5,2) DEFAULT NULL,
  `comissao` char(2) NOT NULL,
  `profissao` varchar(200) NOT NULL,
  PRIMARY KEY (`idfuncionario`),
  KEY `fk_funcionario_setor1` (`setor_idsetor`,`setor_empresa_idempresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

--
-- Gatilhos `funcionario`
--
DROP TRIGGER IF EXISTS `bi_func`;
DELIMITER //
CREATE TRIGGER `bi_func` BEFORE INSERT ON `funcionario`
 FOR EACH ROW set new.dataCadastro = current_timestamp
//
DELIMITER ;
DROP TRIGGER IF EXISTS `bu_func`;
DELIMITER //
CREATE TRIGGER `bu_func` BEFORE UPDATE ON `funcionario`
 FOR EACH ROW set new.dataUpdate = current_timestamp
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `idgrupo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `comissao` double(5,2) DEFAULT NULL,
  PRIMARY KEY (`idgrupo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itensnotasaidaproduto`
--

CREATE TABLE IF NOT EXISTS `itensnotasaidaproduto` (
  `notaSaida_idnotaSaida` int(11) NOT NULL,
  `produto_idproduto` int(11) NOT NULL DEFAULT '0',
  `quantidade` char(10) DEFAULT NULL,
  `nomeProduto` varchar(200) DEFAULT NULL,
  `desconto` char(10) DEFAULT NULL,
  `valorProduto` float(18,2) DEFAULT NULL,
  PRIMARY KEY (`notaSaida_idnotaSaida`,`produto_idproduto`),
  KEY `fk_notaSaida_has_produto_produto1` (`produto_idproduto`),
  KEY `fk_notaSaida_has_produto_notaSaida1` (`notaSaida_idnotaSaida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itensprodutonotaentrada`
--

CREATE TABLE IF NOT EXISTS `itensprodutonotaentrada` (
  `iditensnotaentrada` int(11) NOT NULL AUTO_INCREMENT,
  `produto_idproduto` int(11) NOT NULL,
  `notaEntrada_idnotaEntrada` int(11) NOT NULL,
  `quantidade` mediumint(9) NOT NULL,
  `valorUnitario` float(18,2) DEFAULT NULL,
  `valorLote` float(18,2) DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`iditensnotaentrada`,`produto_idproduto`,`notaEntrada_idnotaEntrada`),
  KEY `fk_produto_has_notaEntrada_notaEntrada1` (`notaEntrada_idnotaEntrada`),
  KEY `fk_produto_has_notaEntrada_produto1` (`produto_idproduto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `legendasituacaopessoa`
--

CREATE TABLE IF NOT EXISTS `legendasituacaopessoa` (
  `idlegendaSituacaoPessoa` int(11) NOT NULL AUTO_INCREMENT,
  `Situacao` varchar(45) DEFAULT NULL,
  `Status` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`idlegendaSituacaoPessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `idlog` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `tabela` varchar(100) NOT NULL,
  `campo` varchar(100) NOT NULL,
  `antigo` varchar(200) NOT NULL,
  `novo` varchar(200) NOT NULL,
  PRIMARY KEY (`idlog`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `idmarca` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentobancario`
--

CREATE TABLE IF NOT EXISTS `movimentobancario` (
  `idmovimentoBancario` int(11) NOT NULL AUTO_INCREMENT,
  `contaBanco_idcontaBanco` int(11) NOT NULL,
  `data` date NOT NULL,
  `contaBanco` char(50) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `descricaoBanco` varchar(150) NOT NULL,
  `contaCaixa` varchar(100) NOT NULL,
  `valor` float(18,2) NOT NULL,
  `pendenciaRealizada` char(5) NOT NULL,
  PRIMARY KEY (`idmovimentoBancario`),
  KEY `fk_movimentoBancario_contaBanco1` (`contaBanco_idcontaBanco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `notaentrada`
--

CREATE TABLE IF NOT EXISTS `notaentrada` (
  `idnotaEntrada` int(11) NOT NULL AUTO_INCREMENT,
  `fornecedor_idfornecedor` int(11) NOT NULL,
  `operacao_idoperacao` int(11) NOT NULL,
  `empresa_idempresa` int(11) NOT NULL,
  `numeroPedido` int(11) NOT NULL,
  `dataEmissao` date NOT NULL,
  `dataEntrada` date NOT NULL,
  `valorFinal` float(18,2) NOT NULL,
  `condicaoPagamento` varchar(45) DEFAULT NULL,
  `perAcrescimo` float(18,2) NOT NULL,
  `total` float(18,2) NOT NULL,
  `obs` text NOT NULL,
  `totalitens` int(11) NOT NULL,
  `operacao` int(11) NOT NULL,
  `dataInsert` datetime NOT NULL,
  `dataUpdate` datetime NOT NULL,
  PRIMARY KEY (`idnotaEntrada`),
  KEY `fk_notaEntrada_fornecedor1` (`fornecedor_idfornecedor`),
  KEY `fk_notaEntrada_operacao1` (`operacao_idoperacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

--
-- Gatilhos `notaentrada`
--
DROP TRIGGER IF EXISTS `bi_notaentrada`;
DELIMITER //
CREATE TRIGGER `bi_notaentrada` BEFORE INSERT ON `notaentrada`
 FOR EACH ROW set new.dataInsert = current_timestamp
//
DELIMITER ;
DROP TRIGGER IF EXISTS `bu_notaentrada`;
DELIMITER //
CREATE TRIGGER `bu_notaentrada` BEFORE UPDATE ON `notaentrada`
 FOR EACH ROW set new.dataUpdate = current_timestamp
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `notasaida`
--

CREATE TABLE IF NOT EXISTS `notasaida` (
  `idnotaSaida` int(11) NOT NULL AUTO_INCREMENT,
  `pessoa_idpessoa` int(11) DEFAULT NULL,
  `operacao_idoperacao` int(11) DEFAULT NULL,
  `operacao` char(10) DEFAULT NULL,
  `condicaoPagamento_idcondicaoPagamento` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `dataUpdate` datetime NOT NULL,
  `valorProdutos` float(18,2) DEFAULT NULL,
  `desconto` mediumint(9) DEFAULT NULL,
  `acrescimo` mediumint(9) DEFAULT NULL,
  `frete` float(18,2) NOT NULL,
  `valorFinal` float(18,2) DEFAULT NULL,
  `situacao` char(50) DEFAULT NULL,
  `totalLinhas` int(11) NOT NULL,
  PRIMARY KEY (`idnotaSaida`),
  KEY `fk_notaSaida_pessoa1` (`pessoa_idpessoa`),
  KEY `fk_notaSaida_operacao2` (`operacao_idoperacao`),
  KEY `fk_notaSaida_condicaoPagamento1` (`condicaoPagamento_idcondicaoPagamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

--
-- Gatilhos `notasaida`
--
DROP TRIGGER IF EXISTS `bi_notasaida`;
DELIMITER //
CREATE TRIGGER `bi_notasaida` BEFORE INSERT ON `notasaida`
 FOR EACH ROW set new.data = current_timestamp
//
DELIMITER ;
DROP TRIGGER IF EXISTS `bu_notasaida`;
DELIMITER //
CREATE TRIGGER `bu_notasaida` BEFORE UPDATE ON `notasaida`
 FOR EACH ROW set new.dataUpdate = current_timestamp
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `operacao`
--

CREATE TABLE IF NOT EXISTS `operacao` (
  `idoperacao` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) NOT NULL,
  `entradaSaida` char(5) DEFAULT NULL,
  `geraFinanceiro` int(1) DEFAULT '0',
  `geraComissao` int(1) DEFAULT '0',
  PRIMARY KEY (`idoperacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `parametros`
--

CREATE TABLE IF NOT EXISTS `parametros` (
  `idparametros` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idparametros`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

CREATE TABLE IF NOT EXISTS `permissao` (
  `idpermissao` int(11) NOT NULL AUTO_INCREMENT,
  `usuarios_idusuarios` int(11) NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY (`idpermissao`),
  KEY `fk_permissao_usuarios1` (`usuarios_idusuarios`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE IF NOT EXISTS `pessoa` (
  `idpessoa` int(11) NOT NULL AUTO_INCREMENT,
  `tipoPessoa_idtipoPessoa` int(11) DEFAULT NULL,
  `cpfCnpj` char(20) DEFAULT NULL,
  `identidateInscricao` char(20) DEFAULT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `sexo` char(5) DEFAULT NULL,
  `apelidoFantasia` varchar(200) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `numero` char(20) DEFAULT NULL,
  `complemento` varchar(150) DEFAULT NULL,
  `bairro` varchar(150) DEFAULT NULL,
  `cep` char(20) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` char(5) DEFAULT NULL,
  `telefoneComercial` char(20) DEFAULT NULL,
  `telefoneResidencial` char(20) DEFAULT NULL,
  `celular1` char(20) DEFAULT NULL,
  `celular2` char(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `dataNascimento` date DEFAULT NULL,
  `nomePai` varchar(200) DEFAULT NULL,
  `nomeMae` varchar(200) DEFAULT NULL,
  `estadoCivil` char(20) DEFAULT NULL,
  `profissao` varchar(150) DEFAULT NULL,
  `empresa` varchar(150) DEFAULT NULL,
  `referencia1` varchar(150) NOT NULL,
  `referencia2` varchar(150) NOT NULL,
  `referencia3` varchar(150) NOT NULL,
  `ativo` char(5) DEFAULT NULL,
  `obs` text NOT NULL,
  `dataInsert` datetime DEFAULT NULL,
  `dataUpdate` datetime DEFAULT NULL,
  PRIMARY KEY (`idpessoa`),
  KEY `fk_pessoa_tipoPessoa1` (`tipoPessoa_idtipoPessoa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

--
-- Gatilhos `pessoa`
--
DROP TRIGGER IF EXISTS `bi_registro`;
DELIMITER //
CREATE TRIGGER `bi_registro` BEFORE INSERT ON `pessoa`
 FOR EACH ROW set new.dataInsert = current_timestamp
//
DELIMITER ;
DROP TRIGGER IF EXISTS `bu_registro`;
DELIMITER //
CREATE TRIGGER `bu_registro` BEFORE UPDATE ON `pessoa`
 FOR EACH ROW set new.dataUpdate = current_timestamp
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `idproduto` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_idgrupo` int(11) DEFAULT NULL,
  `subgrupo_idsubgrupo` int(11) DEFAULT NULL,
  `marca_idmarca` int(11) DEFAULT NULL,
  `fornecedor_idfornecedor` int(11) DEFAULT NULL,
  `unidade_idunidade` int(11) DEFAULT NULL,
  `empresa_idempresa` int(11) DEFAULT NULL,
  `custo_idcusto` int(11) DEFAULT NULL,
  `codFabricante` int(11) DEFAULT NULL,
  `codigoEAN` varchar(13) DEFAULT NULL,
  `dataCadastro` datetime DEFAULT NULL,
  `dataUpdate` datetime DEFAULT NULL,
  `descricao` varchar(200) NOT NULL,
  `classificacao` char(20) DEFAULT NULL,
  `fracionavel` char(5) NOT NULL,
  `localizacao` char(50) NOT NULL,
  `pesoBruto` char(20) DEFAULT NULL,
  `pesoLiquido` char(20) DEFAULT NULL,
  `estoqueAtual` int(11) DEFAULT NULL,
  `estoqueMaximo` mediumint(9) NOT NULL,
  `estoqueMinimo` mediumint(9) NOT NULL,
  `status` char(20) NOT NULL,
  PRIMARY KEY (`idproduto`),
  KEY `fk_produto_custo1` (`custo_idcusto`),
  KEY `fk_produto_empresa1` (`empresa_idempresa`),
  KEY `fk_produto_fornecedor1` (`fornecedor_idfornecedor`),
  KEY `fk_produto_grupo1` (`grupo_idgrupo`),
  KEY `fk_produto_marca1` (`marca_idmarca`),
  KEY `fk_produto_subgrupo1` (`subgrupo_idsubgrupo`),
  KEY `fk_produto_unidade1` (`unidade_idunidade`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

--
-- Gatilhos `produto`
--
DROP TRIGGER IF EXISTS `bi_produto`;
DELIMITER //
CREATE TRIGGER `bi_produto` BEFORE INSERT ON `produto`
 FOR EACH ROW set new.dataCadastro = current_timestamp
//
DELIMITER ;
DROP TRIGGER IF EXISTS `bu_produto`;
DELIMITER //
CREATE TRIGGER `bu_produto` BEFORE UPDATE ON `produto`
 FOR EACH ROW set new.dataUpdate = current_timestamp
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `setor`
--

CREATE TABLE IF NOT EXISTS `setor` (
  `idsetor` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_idempresa` int(11) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `comissao` char(5) NOT NULL,
  PRIMARY KEY (`idsetor`,`empresa_idempresa`),
  KEY `fk_setor_empresa1` (`empresa_idempresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `subgrupo`
--

CREATE TABLE IF NOT EXISTS `subgrupo` (
  `idsubgrupo` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_idgrupo` int(11) NOT NULL,
  `descricaoSubGrupo` varchar(100) NOT NULL,
  PRIMARY KEY (`idsubgrupo`),
  KEY `fk_subgrupo_grupo1` (`grupo_idgrupo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipopessoa`
--

CREATE TABLE IF NOT EXISTS `tipopessoa` (
  `idtipoPessoa` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtipoPessoa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidade`
--

CREATE TABLE IF NOT EXISTS `unidade` (
  `idunidade` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `sigla` char(10) NOT NULL,
  PRIMARY KEY (`idunidade`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `funcionario_idfuncionario` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `permissao` varchar(45) NOT NULL,
  PRIMARY KEY (`idusuarios`),
  KEY `fk_usuarios_funcionario1` (`funcionario_idfuncionario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedor`
--

CREATE TABLE IF NOT EXISTS `vendedor` (
  `idvendedor` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpfCnpj` char(20) NOT NULL,
  `identidade` char(20) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `complementar` varchar(100) NOT NULL,
  `numero` char(10) NOT NULL,
  `bairro` varchar(150) NOT NULL,
  `cep` char(20) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` char(5) NOT NULL,
  `telefone1` char(15) NOT NULL,
  `telefone2` char(15) DEFAULT NULL,
  `telefone3` char(15) DEFAULT NULL,
  `telefone4` char(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `websitePessoal` varchar(100) DEFAULT NULL,
  `sexo` char(5) NOT NULL,
  `nascimento` date NOT NULL,
  `dataInsert` datetime NOT NULL,
  `dataUpdate` datetime NOT NULL,
  PRIMARY KEY (`idvendedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

--
-- Gatilhos `vendedor`
--
DROP TRIGGER IF EXISTS `bi_vendedor`;
DELIMITER //
CREATE TRIGGER `bi_vendedor` BEFORE INSERT ON `vendedor`
 FOR EACH ROW set new.dataInsert = current_timestamp
//
DELIMITER ;
DROP TRIGGER IF EXISTS `bu_vendedor`;
DELIMITER //
CREATE TRIGGER `bu_vendedor` BEFORE UPDATE ON `vendedor`
 FOR EACH ROW set new.dataUpdate = current_timestamp
//
DELIMITER ;

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `cheques`
--
ALTER TABLE `cheques`
  ADD CONSTRAINT `fk_cheques_pessoa1` FOREIGN KEY (`pessoa_idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `comissao`
--
ALTER TABLE `comissao`
  ADD CONSTRAINT `fk_comissao_funcionario1` FOREIGN KEY (`funcionario_idfuncionario`) REFERENCES `funcionario` (`idfuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comissao_notaSaida1` FOREIGN KEY (`notaSaida_idnotaSaida`) REFERENCES `notasaida` (`idnotaSaida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `contaspagar`
--
ALTER TABLE `contaspagar`
  ADD CONSTRAINT `fk_notaEntrada_has_fluxoCaixa_fluxoCaixa1` FOREIGN KEY (`fluxoCaixa_idfluxoCaixa`) REFERENCES `fluxocaixa` (`idfluxoCaixa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notaEntrada_has_fluxoCaixa_notaEntrada1` FOREIGN KEY (`notaEntrada_idnotaEntrada`) REFERENCES `notaentrada` (`idnotaEntrada`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `ecommerce`
--
ALTER TABLE `ecommerce`
  ADD CONSTRAINT `fk_ecommerce_fornecedor` FOREIGN KEY (`fornecedor_idfornecedor`) REFERENCES `fornecedor` (`idfornecedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `financeiro`
--
ALTER TABLE `financeiro`
  ADD CONSTRAINT `fk_financeiro_pessoa1` FOREIGN KEY (`pessoa_idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `fluxocaixa`
--
ALTER TABLE `fluxocaixa`
  ADD CONSTRAINT `fk_fluxoCaixa_caixa` FOREIGN KEY (`caixa_idcaixa`) REFERENCES `caixa` (`idcaixa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fluxoCaixa_cheques` FOREIGN KEY (`cheques_idcheques`) REFERENCES `cheques` (`idcheques`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD CONSTRAINT `fk_fornecedor_vendedor1` FOREIGN KEY (`vendedor_idvendedor`) REFERENCES `vendedor` (`idvendedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_funcionario_setor1` FOREIGN KEY (`setor_idsetor`, `setor_empresa_idempresa`) REFERENCES `setor` (`idsetor`, `empresa_idempresa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `itensnotasaidaproduto`
--
ALTER TABLE `itensnotasaidaproduto`
  ADD CONSTRAINT `fk_notaSaida_has_produto_notaSaida1` FOREIGN KEY (`notaSaida_idnotaSaida`) REFERENCES `notasaida` (`idnotaSaida`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notaSaida_has_produto_produto1` FOREIGN KEY (`produto_idproduto`) REFERENCES `produto` (`idproduto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `itensprodutonotaentrada`
--
ALTER TABLE `itensprodutonotaentrada`
  ADD CONSTRAINT `fk_produto_has_notaEntrada_notaEntrada1` FOREIGN KEY (`notaEntrada_idnotaEntrada`) REFERENCES `notaentrada` (`idnotaEntrada`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produto_has_notaEntrada_produto1` FOREIGN KEY (`produto_idproduto`) REFERENCES `produto` (`idproduto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `movimentobancario`
--
ALTER TABLE `movimentobancario`
  ADD CONSTRAINT `fk_movimentoBancario_contaBanco1` FOREIGN KEY (`contaBanco_idcontaBanco`) REFERENCES `contabanco` (`idcontaBanco`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `notaentrada`
--
ALTER TABLE `notaentrada`
  ADD CONSTRAINT `fk_notaEntrada_fornecedor1` FOREIGN KEY (`fornecedor_idfornecedor`) REFERENCES `fornecedor` (`idfornecedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notaEntrada_operacao1` FOREIGN KEY (`operacao_idoperacao`) REFERENCES `operacao` (`idoperacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `notasaida`
--
ALTER TABLE `notasaida`
  ADD CONSTRAINT `fk_notaSaida_condicaoPagamento1` FOREIGN KEY (`condicaoPagamento_idcondicaoPagamento`) REFERENCES `condicaopagamento` (`idcondicaoPagamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notaSaida_operacao2` FOREIGN KEY (`operacao_idoperacao`) REFERENCES `operacao` (`idoperacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notaSaida_pessoa1` FOREIGN KEY (`pessoa_idpessoa`) REFERENCES `pessoa` (`idpessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `permissao`
--
ALTER TABLE `permissao`
  ADD CONSTRAINT `fk_permissao_usuarios1` FOREIGN KEY (`usuarios_idusuarios`) REFERENCES `usuarios` (`idusuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD CONSTRAINT `fk_pessoa_tipoPessoa1` FOREIGN KEY (`tipoPessoa_idtipoPessoa`) REFERENCES `tipopessoa` (`idtipoPessoa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_produto_custo1` FOREIGN KEY (`custo_idcusto`) REFERENCES `custo` (`idcusto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produto_empresa1` FOREIGN KEY (`empresa_idempresa`) REFERENCES `empresa` (`idempresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produto_fornecedor1` FOREIGN KEY (`fornecedor_idfornecedor`) REFERENCES `fornecedor` (`idfornecedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produto_grupo1` FOREIGN KEY (`grupo_idgrupo`) REFERENCES `grupo` (`idgrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produto_marca1` FOREIGN KEY (`marca_idmarca`) REFERENCES `marca` (`idmarca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produto_subgrupo1` FOREIGN KEY (`subgrupo_idsubgrupo`) REFERENCES `subgrupo` (`idsubgrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produto_unidade1` FOREIGN KEY (`unidade_idunidade`) REFERENCES `unidade` (`idunidade`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `setor`
--
ALTER TABLE `setor`
  ADD CONSTRAINT `fk_setor_empresa1` FOREIGN KEY (`empresa_idempresa`) REFERENCES `empresa` (`idempresa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `subgrupo`
--
ALTER TABLE `subgrupo`
  ADD CONSTRAINT `fk_subgrupo_grupo1` FOREIGN KEY (`grupo_idgrupo`) REFERENCES `grupo` (`idgrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_funcionario1` FOREIGN KEY (`funcionario_idfuncionario`) REFERENCES `funcionario` (`idfuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION;