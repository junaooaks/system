<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
             
            //$('.delete').click(function () {

            if (confirm('CONFIRMA RECEBIMENTO')) {
    
                jQuery.ajax({ 
                    title: "WebCom",
                    type: "POST",  
                    url: "app/controller/controllerMovimentacao.php",  
                    data: dados,  
                    success: function( data )  
                    {  
                        alert( data );  
                    
                    } 
                
                });
                
            };
  
            return false;  
        });  
    });
    
  
</script> 

<div id="datagrid">
    <table width="100%">
        <tr>
            <td style="width:90%;"><h1>MOVIMENTAÇÃO DIÁRIA</h1></td>
            <td id="voltar"><a href="#" class="voltar" onclick="javascript:mudaConteudo('app/view/gridMovimentacao.php?cx=<?php echo $_GET['caixa']; ?>');"><img src="resources/images/voltar.png" /></a>
            </td>
        </tr>
    </table>
    <hr>
    <fieldset>
        <p>
            <?php
            $idnf = $_GET['idnf'];
            $cx = $_GET['caixa'];
            
            //echo $cx;

            require("../../app/model/conexao/Conexao.php");
            require("../../app/model/modelMovimentacao.php");
            require("../../app/model/sql/DBMovimentacao.php");

            if (!empty($idnf)) {

                //inserir dados no banco de daodos
                $nfe = new modelMovimentacao();
                $nfe->setIDnfs($idnf);

                //inserir dados no banco de daodos
                $dbnfe = new DBMovimentacao();
                $dbnfe = $dbnfe->select($nfe);

                $formapg        = $nfe->getFormapg();
                $idformapg      = $nfe->getIDformapg();
                $valordesconto  = $nfe->getValorDesconto();
                $idcliente      = $nfe->getIDcliente();
                $cliente        = $nfe->getCliente();
                $endereco       = $nfe->getEndereco();
                $numero         = $nfe->getNumero();
                $bairro         = $nfe->getBairro();
                $cep            = $nfe->getCep();
                $cidade         = $nfe->getCidade();
                $ativo          = $nfe->getAtivo();
                $idnfs          = $nfe->getIDnfs();
                $quantitens     = $nfe->getQuantitem();
                $total          = $nfe->getTotal();
                $frete          = $nfe->getFrete();
                $nf             = $nfe->getNF();
                $idvendedor     = $nfe->getIDVendedor();
                $vendedor       = $nfe->getVendedor();
                
                if ($ativo == 0) {
                    $status = 'DESATIVADO - FALE COM ADMINISTRADOR';
                }
                if ($ativo == 1) {
                    $status = 'ATIVADO - LIBERADO';
                }
                if ($ativo == 2) {
                    $status = 'PENDENCIA - FALE COM ADMINISTRADOR';
                }
            }
            
            ?>   
        </p>

        <form method="POST" action="" id="tr" name="custo">
            <h1>DADOS DO CLIENTE</h1>
            <table border="0">
                <hr />
                <tr>
                    <td>Codig.</td>
                    <td><input name="idpessoa" type="text" class="effect" id="idcusto" onkeyup="up(this)" value="<?php echo $idcliente; ?>" size="10" readonly="readonly"/></td>
                    <td>Nome :</td>
                    <td colspan="3"><input name="nome" type="text" class="effect" id="pis_confins" value="<?php echo $cliente; ?>" size="63" readonly="readonly"/></td>
                </tr>
                <tr>
                    <td>CEP:</td>
                    <td><input name="cep" type="text" class="effect" id="frete" onkeyup="up(this)"  value="<?php echo $cep; ?>" size="10" maxlength="10" readonly="readonly"/></td>
                    <td>End..:</td>
                    <td colspan="3"><input name="endereco" type="text" class="effect" id="st" onkeyup="up(this)" value="<?php echo $endereco; ?>" size="63" readonly="readonly"/></td>
                </tr>
                <tr>
                    <td>Cidade:</td>
                    <td><input name="cidade" type="text" class="effect" id="frete_p" onkeyup="up(this)" value="<?php echo $cidade; ?>" size="10" maxlength="10" readonly="readonly"/></td>
                    <td>Bairro:</td>
                    <td><input name="bairro" type="text" class="effect" id="ipi" onkeyup="up(this)" value="<?php echo $bairro; ?>" size="20" readonly="readonly"/></td>
                    <td>N°</td>
                    <td><input name="preco_custo" type="text" class="effect" id="unitario" value="<?php echo $numero; ?>" size="10" maxlength="10" onkeyup="up(this)" readonly="readonly"/></td>
                </tr>
            </table>
            
			<tr>     <h1>DADOS DO VENDEDOR</h1></tr></hr>
            
            
			<table border="0">
                <hr />
                <tr>
                    <td>Codig.</td>
                    <td><input name="idvendedor" type="text" class="effect" id="idcusto" onkeyup="up(this)" value="<?php echo $idvendedor; ?>" size="10" readonly="readonly"/></td>
                    <td>Vendedor :</td>
                    <td><input name="vendedor" type="text" class="effect" id="pis_confins" value="<?php echo $vendedor; ?>" size="60" readonly="readonly"/></td>
                </tr>
            </table>
            
            <tr>     <h1>FORMA E CONDIÇÃO DO PAGAMENTO</h1></tr></hr>
            
            
			<table border="0">
                <hr />
                <tr>
                    <td>Pagamento:</td>
                    <td><label for="pagamento"></label>
                      <select name="pagamento" id="pagamento" class="effect" >
                        <option value="DINHEIRO">DINHEIRO</option>
                        <option value="CARTAO">CARTAO</option>
                        <option value="CHEQUE">CHEQUE</option>
                        <option value="CREDIARIO">CREDIARIO</option>
                    </select></td>
                   
                    <td>Condição:</td>
                    <td><select name="condicao" id="condicao" class="effect" >
                       <?php
                            //echo "ss $subgrupo";
                            $db = new DBMovimentacao();
							
                            $db->selectCondicao($idformapg);
?>  
                           
                            
                        
                    </select></td>
                </tr>
            </table>
            
            
            
            
          <tr>     <h1>ITENS PEDIDO</h1></tr><hr>

            
    <table border="0" id="lista">
      <thead>
        <tr style="color:#FFF; font-weight:bold; background:#024B78;"> 
          <td width="75" align="center"><img src="resources/images/apply.png"/></td>
          <td width="109" align="center">NOTA</td>
          <td width="130" align="center">EMISSAO</td>
          <td width="109" align="center">VALOR</td>
          
        </tr>
      </thead>
      <?php
                /*
                 */
                $dbcr = new DBMovimentacao();
                $totalAtrasado = $dbcr->selectNF($nfe);
              
                ?>
      <!--input type="hidden" value="1" id="row" name="quantidade_itens" /-->
      <tr> 
        <td height="10" colspan="7"><span id="st" style="color:#F00;"> </span></td>
      </tr>
      <tr> 
        <td colspan="7">Valor Recebido:          
          <input name="valorRecebido" type="text" class="effect" id="valorRecebido" value="" size="10" maxlength="10" onkeyup="up(this)" />          Troco:
          <input name="troco" type="text" class="effect" value="" size="10" maxlength="10" onkeyup="up(this)" /></td>
        </tr>
        
        <tr> 
            <td valign="top">Observação:</td>
            <td colspan="6"><textarea name="obs" rows="4" cols="40" class="effect"></textarea></td>
      </tr>
      <tr> 
        <input type="hidden" value="<?php echo $cx; ?>" name="idcaixa" />
        <input type="hidden" value="<?php echo $idnf; ?>" name="idnfs" />
        <td colspan="7" align="center"><input type="submit" name="button" id="button" value="Baixar Notas" /></td>
      </tr>
    </table>
        </form>
    </fieldset>

</div>