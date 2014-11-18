<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerNFentrada.php",  
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

<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
<link type="text/css" href="resources/css/jquery-ui-1.8.21.custom.css" rel="stylesheet"/>
<script type="text/javascript" src="js/add.js"></script>
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
	
	function calculateST() {
 
        var st = 0;
        //iterate through each textboxes and add the values
        $(".stt").each(function() {
 
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                st += parseFloat(this.value);
            }
 
        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#st").html(st.toFixed(2));
    }
	
	function calculateFRETE() {
 
        var frete = 0;
		
        //iterate through each textboxes and add the values
        $(".fre").each(function() {
 
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                frete += parseFloat(this.value);
            }
 
        });
        
		//.toFixed() method will roundoff the final sum to 2 decimal places
        $("#frete").html(frete.toFixed(2));
    }
	
	function calculaIPI() {
 
        var ipi = 0;
        //iterate through each textboxes and add the values
        $(".ip").each(function() {
 
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                ipi += parseFloat(this.value);
            }
 
        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#ipi").html(ipi.toFixed(2));
    }
    
    function soma (){
        vl  = parseFloat(document.getElementById('vl').innerHTML);
        per = parseFloat(document.getElementById("per").value);
        
        resultado =((vl / 100) * per) + vl;
        
        resultado = (Math.round(resultado*100))/100;
        
        document.custo.total.value=resultado;
        
       
        
    }
</script>

<script type="text/javascript">
    $(".soma").maskMoney({symbol:'', showSymbol:true, thousands:'', decimal:'.', symbolStay: true});
	$(".stt").maskMoney({symbol:'', showSymbol:true, thousands:'', decimal:'.', symbolStay: true});
	$(".ip").maskMoney({symbol:'', showSymbol:true, thousands:'', decimal:'.', symbolStay: true});
	$(".fre").maskMoney({symbol:'', showSymbol:true, thousands:'', decimal:'.', symbolStay: true});
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
    <table width="100%">
        <tr>
            <td style="width:90%;"><h1>CADASTRO PEDIDO</h1></td>
            <td id="voltar"><a href="#" class="voltar" onclick="javascript:mudaConteudo('app/view/gridNf.php');"><img src="resources/images/voltar.png" /></a>
            </td>
        </tr>
     </table>
    
    
    
    <hr>
    <fieldset>
        <?php
        $idnf = $_GET['idnf'];

        require("../../app/model/conexao/Conexao.php");
        require("../../app/model/modelNFentrada.php");
        require("../../app/model/sql/DBNFentrada.php");


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
			
			
			//echo $quantitens;
			
        }
        ?>   

        <form method="GET" action="" id="tr" name="custo">
            <!--tr id="tr"> 
                 <td>Custo Produto:</td>
                 <td><input name="custopro" type="text" id="auto" class="effect" value="" size="92" onkeyup="up(this)" /> <input type="submit" name="consulta" value="Consultar" class="effect" id="consultar"></td></td>
                 
         </tr--> 
            <h1>PEDIDO            </h1>
            <table border="0">

              <hr>
                <tr>
                    <td>N° NF</td>
                    <td><input type="text" class="effect" value="<?php echo $nnfe; ?>" name="idnf" size="5" readonly="true"/></td>
                    <td>N° Pedido:</td>
                    <td><input name="nf" type="text" class="effect" id="nf" onkeyup="up(this)" value="<?php echo $nf;?>" <?php if (!empty($nf)){echo 'readonly=true';}?> size="10" maxlength="10" /></td>
                    <td>Data Emtrada:</td>
                    <td><input name="dataentrada" type="text" class="effect" id="dataentrada" onkeyup="up(this)" value="<?php if (!empty($dataen)) {
    echo $dataen;
} else {
    echo date('d/m/Y');
} ?>" size="10" maxlength="10" /></td>
                </tr>
                <tr>
                    <td>Operação:</td>
                    <td><select name="operacao" id="operacao" class="effect">
                     <option value="1" <?php if($idope==1){echo 'selected';}?>>PEDIDO</option>
  				     <option value="2" <?php if($idope==2){echo 'selected';}?>>ENTRADA</option>
  			
                     
                     
                      <?php /*
if (empty($idope)) {
    echo "<option value=''>ESCOLHA...</option>";
}
//echo "ss $subgrupo";
$dboperacao = new DBNFentrada();
$operacao = $dboperacao->selectOperacao($idope);
*/ ?>
                    </select></td>
                <td>Fornecedor:</td>
                    <td><select name="fornecedor" id="fornecedor" class="effect">
                      <?php
                            if (empty($idforn)) {
                                echo "<option value=''>ESCOLHA...</option>";
                            }
                            //echo "ss $subgrupo";
                            $dbforn = new DBNFentrada();
                            $for = $dbforn->selectFornecedor($idforn);
                            ?>
                  </select></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr> 
                    <td>Data Emissao:</td>
                    <td><input name="dataemissao" type="text" class="effect" id="dataemissao" onkeyup="up(this)" value="<?php if (!empty($dataem)) {
                                echo $dataem;
                            } else {
                                echo date('d/m/Y');
                            } ?>" size="10" maxlength="10" /></td>
                    <td>Valor Final:</td>
                    <td><input name="valorfinal" type="text" class="effect piada" id="valorfinal" onkeyup="up(this)" value="<?php echo $valorf; ?>" size="10" maxlength="10" /></td>
                    <td>Condição PG:</td>
                    <td><input name="condicaopg" type="text" class="effect" id="condicaopg" onkeyup="up(this)" value="<?php echo $pg; ?>" size="10" maxlength="10" /></td>
                </tr>
                <tr> 
                    <td>Loja:</td>
                    <td colspan="3"><select name="loja" id="fornecedor2" class="effect">
                      <?php
if (empty($idem)) {
    echo "<option value=''>ESCOLHA...</option>";
}
//echo "ss $subgrupo";
$dbempresa = new DBNFentrada();
$empresa = $dbempresa->selectEmpresa($idem);
?>
                    </select></td>
                    <td>Desconto %:</td>
                    <td><input name="desconto" type="text" class="effect" id="desconto" onkeyup="up(this)" value="<?php echo $pg; ?>" size="10" maxlength="10" /></td>
            </table> 
<tr>     <h1>ITENS PEDIDO</h1></tr><hr>

            <table border="0" id="lista">
                <tr style="color:#000; font-weight:bold; background:#D9E5F3;">
                    <td colspan="10" align=""><a href="#" id="mais"><img src="resources/images/add.png" border="0"/></a></td>
                </tr>
                <tr style="color:#FFF; font-weight:bold; background:#024B78;">
                    <td align="center">DEL..</td>
                    <td align="center">PRODUTO</td>
                    <td align="center">QUANT.</td>
                    <td align="center">CUSTO UNI.</td>
                    <td align="center">CUSTO</td>
                    <td align="center">ST</td>
                    <td align="center">IPI</td>
                    <td align="center">FRETE</td>
                    <td align="center">EXC...</td>
                </tr>
                <?php
                /*
                 */
                if (!empty($quantitens)) {
                    
                    //consultar dados
                    $dbitens = new DBNFentrada();
                    $somalote = $dbitens->selectPro($nnfe, $quantitens);
                    
					
                           
                    /*for ($x = 1; $x <= $quantitens; $x++) {
                        $next = 1 + $x;

                        echo "<tr>
                    
                    <td><input type='text' name='item" . $next . "' size='70' class='effect auto' onkeyup='up(this)'/></td>
                    <td><input type='text' name='quantidade" . $next . "' size='5' class='effect' onkeyup='up(this)' id='quantidade1'/></td>
                    <td><input type='text' name='uni" . $next . "' size='8' class='effect' onkeyup='up(this)'/></td>
                    <td><input type='text' name='custo" . $next . "' size='5' id='moeda' class='effect soma' onBlur='calculateSum();'/></td>
                    <td align='center' id='menos" . $next . "'><a href='#' onclick ='$(this).parent().parent().remove(); calculateSum();'><img src='resources/images/menos.png' border='0'/></a></td>
                
                </tr>";
                    }*/
                } else {
                    echo "<tr>
                    <td></td>
                    <td><input type=\"text\" name=\"item2\" size=\"70\" class=\"effect auto\" onkeyup=\"up(this)\"/></td>
                    <td><input type=\"text\" name=\"quantidade2\" size=\"5\" class=\"effect\" onkeyup=\"up(this)\" id=\"quantidade1\"/></td>
                    <td><input type=\"text\" name=\"uni2\" size=\"8\" class=\"effect\" onkeyup=\"up(this)\"/></td>
                    <td><input type=\"text\" name=\"custo2\" size=\"5\" id=\"moeda\" class=\"effect soma\" onBlur=\"calculateSum();\"/></td>
		    <td><input type=\"text\" name=\"st2\" size=\"5\" class=\"effect stt\" onBlur=\"calculateST();\"/></td>
		    <td><input type=\"text\" name=\"ipi2\" size=\"5\" class=\"effect ip\" onBlur=\"calculaIPI();\"/></td>
		    <td><input type=\"text\" name=\"frete2\" size=\"5\" class=\"effect fre\" onBlur=\"calculateFRETE();\"/></td>
                    <td align=\"center\"><img src=\"resources/images/menos.png\" border=\"0\" /></td>
                
                </tr>";
                }
                ?>
                <input type="hidden" value="<?php if(!empty($idnf)){ echo $quantitens;}else{echo '1';} ?>" name="quantidade_itens" />
            </table>
      <tr>     </tr>

            <tr>
            <h1>TOTAL PEDIDO</h1><hr>
            </tr>
            <table border="0">
                <tr>
                    <td width="83">Total ST:</td>
                    <td width="62"><span id="st" style="color:#F00;"><?php print_r($somalote[1]); if(empty ($somalote[1])){echo "0";} ?></span></td>
                    <td width="77">Total IPI:</td>
                    <td width="70"><span id="ipi" style="color:#F00;"><?php print_r($somalote[2]); if(empty ($somalote[2])){echo "0";} ?></span></td>
                    <td width="70">Total Frete:</td>
                    <td width="6"></span></td>
                    <td width="85"><span id="frete" style="color:#F00;"><?php print_r($somalote[3]); if(empty ($somalote[3])){echo "0";} ?></td>
                    <td width="90">&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td width="62">&nbsp;</td>
                  <td width="77">&nbsp;</td>
                  <td width="70">&nbsp;</td>
                  <td width="70">&nbsp;</td>
                  <td width="6">&nbsp;</td>
                  <td width="85">&nbsp;</td>
                  <td width="90">&nbsp;</td>
                </tr>
                <tr>
                    <td valign="top">Observações:</td>
                    <td colspan="4" rowspan="3"><label for="textarea"></label>
                        <textarea name="obs" id="textarea" cols="45" rows="5"><?php echo $obs; ?></textarea></td>
                    <td>&nbsp;</td>
                    <td>Sub-Total:</td>
                    <td id ="sub"><span id="vl" style="color:#F00;"><?php print_r($somalote[0]); if(empty ($somalote[0])){echo "0";} ?></span>  </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>% Acréscimo:</td>
                    <td><input name="acrescimo" type="text" class="effect piada" id="per" value="<?php echo $acres; ?>" size="15" onBlur="soma();" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>Total:</td>
                    <td><input name="total" style="color:#F00;" type="text" class="effect" id="pesobruto3" value="<?php echo $total; ?>" size="15" /></td>
                </tr>
                <tr>
                    <td colspan="8" align="center"><input type="submit" name="button2" id="button2" value="Fechar Pedido" /></td>
                </tr>
            </table>
        </form>

    </fieldset>

</div>