<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerNfs.php",  
                data: dados,  
                success: function( data )  
                {  
                    alert( data );  
                    
                } 
                
            });  
  
            return false;  
        });  
    });  
</script> 

<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tl').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST", 
                url: "app/controller/controllerNfs.php",  
                data: dados,  
                success: function( data )  
                {   
                       //alert( data );
						
						arr = data.split('|');
                        
						arr[0] = arr[0].substring(1,(arr[0],20));
                        arr[9] = arr[9].substring(0,(arr[9].length - 1));
                    
                        jQuery('#idcusto')    .val( arr[0] );
                        jQuery('#unitario')   .val( arr[1] );
                        jQuery('#st')         .val( arr[2] );
                        jQuery('#ipi')        .val( arr[3] );
                        jQuery('#frete')      .val( arr[4] );
                        jQuery('#frete_p')    .val( arr[5] );
                        jQuery('#pis_confins').val( arr[6] );
			jQuery('#status')     .val( arr[7] );
			
        ativo =arr[8];
        if(ativo==''){
            ativo = 0;
        }
                        jQuery('#ativo')      .val(ativo);
                        
                        jQuery('#idcliente')  .val( arr[9] );
						
                        
                   
                    
                   
                    
                }  
            }); 
        
            return false;  
        });  
    });

</script> 



<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
<link type="text/css" href="resources/css/jquery-ui-1.8.21.custom.css" rel="stylesheet"/>
<script type="text/javascript" src="js/addnfs.js"></script>
<script type="text/javascript" src="js/money.js"></script>
<script>
    $(document).ready(function(){
 
        //iterate through each textboxes and add keyup
        //handler to trigger sum event
        $(".soma").each(function() {
 
            $(this).keyup(function(){
                calculateSum();
           
        
            });
        });
        
 
    });
 
    function calculateSum() {
 
        var vl = 0;
        //iterate through each textboxes and add the values
        $(".soma").each(function() {
 
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                vl += parseFloat(this.value);
            }
 		
		
        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#vl").html(vl.toFixed(2));
    }
    
    function soma (){
        vl  = parseFloat(document.getElementById('vl').innerHTML);
        per = parseFloat(document.getElementById("per").value);
        
        resultado =((vl / 100) * per) + vl;
        
        resultado = (Math.round(resultado*100))/100;
        
        document.custo.total.value=resultado;
        
       
        
    }
	
	 function estoque(){
        vl  = parseFloat(document.getElementById('vl').innerHTML);
        per = parseFloat(document.getElementById("per").value);
        
        resultado =((vl / 100) * per) + vl;
        
        resultado = (Math.round(resultado*100))/100;
        
        document.custo.total.value=resultado;
        
       
        
    }
	
	

	
</script>

<script type="text/javascript">
    $(document).ready(function()     {
      
        $('#auto').autocomplete(
        {
        
            source: "app/view/cliente.php",
            minLength: 1
        });
    });

</script>

<script type="text/javascript">
    $(".soma").maskMoney({symbol:'', showSymbol:true, thousands:'', decimal:'.', symbolStay: true});

</script>
<script type="text/javascript">
    $(".piada").maskMoney({symbol:'', showSymbol:true, thousands:'', decimal:'.', symbolStay: true});

</script>
<script type="text/javascript">
   
    $(document).ready(function()     {
      
        $('.auto').autocomplete(
        {
            source: "app/view/buscaProduto.php",
            minLength: 1
        });
    });
  
</script>

<div id="datagrid">
    <h1>CADASTRO PEDIDO</h1>
    <hr>
    <fieldset>
        <p>
          <?php
        $idnf = $_GET['idnf'];

        require("../../app/model/conexao/Conexao.php");
        require("../../app/model/modelNFentrada.php");
        require("../../app/model/sql/DBNFentrada.php");
        require("../../app/model/sql/DBNFs.php");
        require("../../app/model/modelNFs.php");


        //echo "grupo = $idgrupo - sub = $idsubgrupo";


        if (!empty($idnf)) {

            //inserir dados no banco de daodos
            $nfe = new modelNFentrada();
            $nfe->setIDnfe($idnf);

            //inserir dados no banco de daodos
            $dbnfe = new DBNFentrada();
            $dbnfe = $dbnfe->select($nfe);

            $idforn = $nfe->getIDFornecedor();
            $forn = $nfe->getFornecedor();
            $nf = $nfe->getNf();
            $dataem = $nfe->getDataemissao();
            $dataen = $nfe->getDataentrada();
            $valorf = $nfe->getValorfinal();
            $pg = $nfe->getCondicaopg();
            $acres = $nfe->getAcrescimo();
            $obs = $nfe->getObs();
            $idope = $nfe->getIDOperacao();
            $opera = $nfe->getOperacao();
            $idem = $nfe->getIDEmpresa();
            $emp = $nfe->getEmpresa();
            $total = $nfe->getTotal();
            $quantitens = $nfe->getQuantitem();
            $nnfe = $nfe->getIDnfe();
			$status = $nfe->getAtivo();
        }
        ?>   
        </p>
        <form method="POST" action="" id="tl" name="formu">
            <tr id="tr"> 
                <td>Nome Cliente:</td>
                <td><input name="cliente" type="text" id="auto" class="effect" value="" size="92" onkeyup="up(this)" /> <input type="submit" name="consulta" value="Consultar" class="effect" id="consultar" onclick="clicado=true" ></td>
          </td></tr> 
        </form>
        
        <form method="GET" action="" id="tr" name="custo">
            <!--tr id="tr"> 
                 <td>Custo Produto:</td>
                 <td><input name="custopro" type="text" id="auto" class="effect" value="" size="92" onkeyup="up(this)" /> <input type="submit" name="consulta" value="Consultar" class="effect" id="consultar"></td></td>
                 
         </tr--> 
      <h1>STATUS:
        <input name="status" type="text" class="effect" id="status" value="<?php echo $status; ?>" size="80" readonly="readonly"/>
        <input type="hidden" id="ativo" value="<?php if($ativo==''){$ativo=0;}else{echo $ativo;} ?>" name="ativo" />
        <input type="hidden" id="idcliente" value="<?php echo $idcliente; ?>" name="idcliente" />
<br />
      </h1>
      <hr />
      <h1>DADOS DO CLIENTE</h1>
      <table border="0">
        <hr />
        <tr>
          <td>Codig.</td>
          <td><input name="unitario" type="text" class="effect" id="idcusto" onkeyup="up(this)" value="<?php echo $valoruni; ?>" size="10" readonly="readonly"/></td>
          <td>Nome :</td>
          <td colspan="3"><input name="idcusto" type="text" class="effect" id="pis_confins" value="<?php echo $idcusto; ?>" size="80" readonly="readonly"/></td>
        </tr>
        <tr>
          <td>CEP:</td>
          <td><input name="st" type="text" class="effect" id="frete" onkeyup="up(this)"  value="<?php echo $st; ?>" size="10" maxlength="10" readonly="readonly"/></td>
          <td>End..:</td>
          <td colspan="3"><input name="ipi" type="text" class="effect" id="st" onkeyup="up(this)" value="<?php echo $ipi; ?>" size="80" readonly="readonly"/></td>
        </tr>
        <tr>
          <td>Cidade:</td>
          <td><input name="frete" type="text" class="effect" id="frete_p" onkeyup="up(this)" value="<?php echo $frete; ?>" size="10" maxlength="10" readonly="readonly" /></td>
          <td>Bairro:</td>
          <td><input name="frete_p" type="text" class="effect" id="ipi" onkeyup="up(this)" value="<?php echo $fretep; ?>" size="20" readonly="readonly"/></td>
          <td>N°</td>
          <td><input name="preco_custo" type="text" class="effect" id="unitario" value="<?php echo $precocusto; ?>" size="10" maxlength="10" onkeyup="up(this)" readonly="readonly"/></td>
        </tr>
      </table>
       <tr>     <h1>TIPO PEDIDO</h1></tr><hr>
       <table border="0">
         <tr>
           <td>Operação:
             <select name="tipo" id="tipo" class="effect">
  			 <option value="1">VENDA</option>
  			 <option value="2">PERDA</option>
  			 <option value="3">ORÇAMENTO</option>
             <option value="4">DEVOLUÇÃO</option>
               
               </select>           </td>
           <td>N° Nota:</td>
           <td><input name="nnotad" type="text" class="effect" id="nnotad" onkeyup="up(this)" size="10" maxlength="10" /></td>
         </tr>
         <tr>
           <td>Condição de Pagamento:
             <label for="formapg"></label>
             <select name="formapg" id="formapg">
               <?php
                            //echo "ss $subgrupo";
                            $dbNFs = new DBNfs();
                            $dbNFs->selectSEL();
                            ?>
           </select>             <label for="select2"></label></td>
           
        <td>Desconto %: </td>
           <td><input name="valordesconto" type="text" class="effect" id="valordesconto" onkeyup="up(this)" value="<?php echo $valordesconto; ?>" size="10" maxlength="10" /></td>
         </tr>
       </table>
<p><!--table border="0">

                <hr>
                <tr>
                    <td>Operação:</td>
                    <td><select name="operacao" id="operacao" class="effect">
<?php
/*if (empty($idope)) {
    echo "<option value=''>ESCOLHA...</option>";
}
//echo "ss $subgrupo";
$dboperacao = new DBNFentrada();
$operacao = $dboperacao->selectOperacao($idope);
*/?>
                        </select></td>
                    <td>N° Pedido:</td>
                    <td><input name="nf" type="text" class="effect" id="nf" onkeyup="up(this)" value="<?php //echo $nf; ?>" size="10" maxlength="10" /></td>
                    <td>Data Emtrada:</td>
                    <td><input name="dataentrada" type="text" class="effect" id="dataentrada" onkeyup="up(this)" value="<?php /*if (!empty($dataen)) {
    echo $dataen;
} else {
    echo date('d/m/Y');
}*/ ?>" size="10" maxlength="10" /></td>
                </tr>
                <tr>
                    <td>Fornecedor:</td>
                    <td colspan="5"><select name="fornecedor" id="fornecedor" class="effect">
                            <?php
							/*
                            if (empty($idforn)) {
                                echo "<option value=''>ESCOLHA...</option>";
                            }
                            //echo "ss $subgrupo";
                            $dbforn = new DBNFentrada();
                            $for = $dbforn->selectFornecedor($idforn);
                           */ ?>
                        </select></td>
                </tr>
                <tr> 
                    <td>Data Emissao:</td>
                    <td><input name="dataemissao" type="text" class="effect" id="dataemissao" onkeyup="up(this)" value="<?php /*if (!empty($dataem)) {
                                echo $dataem;
                            } else {
                                echo date('d/m/Y');
                            } */?>" size="10" maxlength="10" /></td>
                    <td>Valor Final:</td>
                    <td><input name="valorfinal" type="text" class="effect piada" id="valorfinal" onkeyup="up(this)" value="<?php //echo $valorf; ?>" size="10" maxlength="10" /></td>
                    <td>Condição PG:</td>
                    <td><input name="condicaopg" type="text" class="effect" id="condicaopg" onkeyup="up(this)" value="<?php //echo $pg; ?>" size="10" maxlength="10" /></td>
                </tr>
                <tr> 
                    <td>Loja:</td>
                    <td colspan="5"><select name="loja" id="fornecedor2" class="effect">
<?php
/*if (empty($idem)) {
    echo "<option value=''>ESCOLHA...</option>";
}
//echo "ss $subgrupo";
$dbempresa = new DBNFentrada();
$empresa = $dbempresa->selectEmpresa($idem);
*/?>
                        </select></td>
          </table--> 
        </p>
<tr>     <h1>ITENS PEDIDO</h1></tr><hr>

            <table border="0" id="lista">
                <tr style="color:#000; font-weight:bold; background:#D9E5F3;">
                    <td colspan="6" align=""><a href="#" id="mais"><img src="resources/images/add.png" border="0"/></a></td>
                </tr>
                <tr style="color:#FFF; font-weight:bold; background:#024B78;">
                    <td align="center">PRODUTO</td>
                    <td align="center">EST.A</td>
                    <td align="center">VALOR</td>
                    <td align="center">QUANT.</td>
                    <td align="center">EXC...</td>
                </tr>
                <?php
                /*
                 */
                if (!empty($quantitens)) {
                    
                    //consultar dados
                    $dbitens = new DBNFentrada();
                    $somalote = $dbitens->selectPro($nnfe, $quantitens);
                   
                } else {
                    echo "<tr>
                    
                    <td><input type=\"text\" name=\"item2\" size=\"70\" class=\"effect auto\" onkeyup=\"up(this)\" onBlur=\"estoq(this.value)\"/></td>
                    <td><input type=\"text\" name=\"est2\" size=\"5\" class=\"effect\" id=\"est2\" readonly=\"readonly\"/><div id=\"tmp_name\" style=\"display:none;\"></div> </td>
					
                    <td><input type=\"text\" name=\"custo2\" size=\"5\" id=\"moeda\" class=\"effect soma atri2\" readonly=\"readonly\"/></td>
					<td><input type=\"text\" name=\"quantidade2\" size=\"5\" class=\"effect \" onkeyup=\"up(this)\" id=\"quantidade1\" onBlur=\"calculateSum();\"/></td>
                    <td align=\"center\"><img src=\"resources/images/menos.png\" border=\"0\" /></td>
                
                </tr>";
                }
                ?>
                <input type="hidden" value="1" name="quantidade_itens" />
            <div id="tmp_name" style="display:none;"></div>
            </table>
      <tr>     </tr>

            <tr>
            <h1>TOTAL PEDIDO</h1><hr>
            </tr>
            <table border="0">
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td rowspan="2">&nbsp;</td>
                    <td rowspan="2" valign="top">Observações:</td>
                    <td rowspan="4"><label for="textarea"></label>
                        <textarea name="obs" id="textarea" cols="45" rows="5"><?php echo $obs; ?></textarea></td>
                    <td rowspan="2">&nbsp;</td>
                    <td>Sub-Total:</td>
                    <td id ="sub"><span id="vl" style="color:#F00;"><?php echo $somalote; if(empty ($somalote)){echo "0";} ?></span>  </td>
                </tr>
                <tr>
                  <td>Frete:</td>
                  <td id ="sub2"><input name="frete" type="text" class="effect piada" id="per2" size="15" onblur="soma();" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>% Acréscimo:</td>
                    <td><input name="acrescimo" type="text" class="effect piada" id="per" value="<?php echo $acres; ?>" size="15" onBlur="soma();" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>Total:</td>
                    <td><input name="total" style="color:#F00;" type="text" class="effect" id="pesobruto3" value="<?php echo $total; ?>" size="15" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="5" align="center"><input type="submit" name="button2" id="button2" value="Fechar Pedido" /></td>
                </tr>
            </table>
            <input type="hidden" value="<?php echo $idnf; ?>" name="idnf" />
      </form>

    </fieldset>

</div>