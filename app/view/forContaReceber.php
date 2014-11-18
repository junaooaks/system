<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
             
            //$('.delete').click(function () {

            if (confirm('CONFIRMA RECEBIMENTO')) {
    
                jQuery.ajax({ 
                    title: "WebCom",
                    type: "POST",  
                    url: "app/controller/controllerContaReceber.php",  
                    data: dados,  
                    success: function( data )  
                    {  
                        alert( data );  
                    
                    } 
                
                });
                //  }
            };
  
            return false;  
        });  
    });
    
  
</script> 

<div id="datagrid">
    <table width="100%">
        <tr>
            <td style="width:90%;"><h1>CONTAS A RECEBER</h1></td>
            <td id="voltar"><a href="#" class="voltar" onclick="javascript:mudaConteudo('app/view/gridContaReceber.php');"><img src="resources/images/voltar.png" /></a>
            </td>
        </tr>
    </table>
    <hr>
    <fieldset>
        <p>
            <?php
            $idcliente = $_GET['idcliente'];

            require("../../app/model/conexao/Conexao.php");
            require("../../app/model/modelContaReceber.php");
            require("../../app/model/sql/DBContaReceber.php");

            //seta valor no metodo
            $cr = new modelContaReceber();
            $cr->setIDpessoa($idcliente);

            //instancia class do banco de dados
            $dbcr = new DBContaReceber();
            $dbcr = $dbcr->select($cr);
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
                    <td colspan="3"><input name="idcusto" type="text" class="effect" id="pis_confins" value="<?php echo $cr->getNomeCliente(); ?>" size="80" readonly="readonly"/></td>
                </tr>
                <tr>
                    <td>CEP:</td>
                    <td><input name="st" type="text" class="effect" id="frete" onkeyup="up(this)"  value="<?php echo $cr->getCep(); ?>" size="10" maxlength="10" readonly="readonly"/></td>
                    <td>End..:</td>
                    <td colspan="3"><input name="ipi" type="text" class="effect" id="st" onkeyup="up(this)" value="<?php echo $cr->getEndereco(); ?>" size="80" readonly="readonly"/></td>
                </tr>
                <tr>
                    <td>Cidade:</td>
                    <td><input name="frete" type="text" class="effect" id="frete_p" onkeyup="up(this)" value="<?php echo $cr->getCidade(); ?>" size="10" maxlength="10" readonly="readonly"/></td>
                    <td>Bairro:</td>
                    <td><input name="frete_p" type="text" class="effect" id="ipi" onkeyup="up(this)" value="<?php echo $cr->getBairro(); ?>" size="20" readonly="readonly"/></td>
                    <td>N°</td>
                    <td><input name="preco_custo" type="text" class="effect" id="unitario" value="<?php echo $cr->getNumero(); ?>" size="10" maxlength="10" onkeyup="up(this)" readonly="readonly"/></td>
                </tr>
            </table>


            <tr>     <h1>ITENS PEDIDO</h1></tr><hr>

            
    <table border="0" id="lista">
      <thead>
        <tr style="color:#FFF; font-weight:bold; background:#024B78;"> 
          <td align="center"><img src="resources/images/apply.png"/></td>
          <td align="center">NOTA</td>
          <td align="center">N.PARCELA</td>
          <td align="center">EMISSAO</td>
          <td align="center">VENCIMENTO</td>
          <td align="center">VALOR</td>
          <td align="center">VL.ATUAL</td>
        </tr>
      </thead>
      <?php
                /*
                 */
                $dbcr = new DBContaReceber();
                $totalAtrasado = $dbcr->selectNF($cr);
              
                ?>
      <!--input type="hidden" value="1" id="row" name="quantidade_itens" /-->
      <tr> 
        <td height="10" colspan="7"><span id="st" style="color:#F00;"> </span></td>
      </tr>
      <tr> 
        <td colspan="2">Total Atrasado:</td>
        <td><span id="st" style="color:#F00;"> 
          <?php echo $totalAtrasado; if($totalAtrasado==''){echo '0';} ?>
          </span></td>
        <td colspan="2">Valor Recebido: 
          <input name="valorRecebido" type="text" class="effect" id="valorRecebido" value="" size="10" maxlength="10" onKeyUp="up(this)" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td colspan="7" align="center"><input type="submit" name="button" id="button" value="Baixar Notas" /></td>
      </tr>
    </table>
        </form>
    </fieldset>

</div>