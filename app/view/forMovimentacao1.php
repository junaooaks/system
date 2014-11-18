<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
             
            //$('.delete').click(function () {

            if (confirm('DESEJA REALMENTE FECHAR')) {
    
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
                //  }
            };
  
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
                    // alert( data );
						
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
                    jQuery('#ativo')      .val( arr[8] );
                    jQuery('#idcliente')  .val( arr[9] );
						
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

        $('#lista tbody').find("tr").each(function() {
            var primeiroTd = $(this).children("td").first();
            var valor = primeiroTd.next().next().next().children("input").first().val();
            var qtd = primeiroTd.next().next().next().next().children("input").first().val();
            
            vl+= valor * qtd;
        });
        
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#vl").html(vl.toFixed(2));
    }
    
    function soma (){
        vl  = document.getElementById('vl').innerHTML;
        per = document.getElementById('valordesconto').value;
        
        //frete
        frete = document.getElementById('per2').value;
        
        if(vl == ''){vl = 0.00;}
        if(per == ''){per = 0.00;}
        if(frete ==''){frete = 0.00;}
        
        resultado =(vl - (vl / 100) * per) + frete;
        //resultado = vl+frete;
        
        resultado = (Math.round(resultado*100))/100;
        
        document.custo.total.value=resultado;
        
       
        
    }
	
    function estoque(){
        vl  = parseFloat(document.getElementById('vl').innerHTML);
        per = parseFloat(document.getElementById("valordesconto").value);
        
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
    <table width="100%">
        <tr>
            <td style="width:90%;"><h1>MOVIMENTAÇÃO DIÁRIA</h1></td>
            <td id="voltar"><a href="#" class="voltar" onclick="javascript:mudaConteudo('app/view/gridMovimentacao.php');"><img src="resources/images/voltar.png" /></a>
            </td>
        </tr>
    </table>
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
                $nfe = new modelNFs();
                $nfe->setIDnfs($idnf);

                //inserir dados no banco de daodos
                $dbnfe = new DBNfs();
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
        <form method="GET" action="" id="tr" name="custo">
            <!--tr id="tr"> 
                 <td>Custo Produto:</td>
                 <td><input name="custopro" type="text" id="auto" class="effect" value="" size="92" onkeyup="up(this)" /> <input type="submit" name="consulta" value="Consultar" class="effect" id="consultar"></td></td>
                 
         </tr--> 
            <h1>STATUS:
                <input name="status" type="text" class="effect" id="status" value="<?php echo $status; ?>" size="80" readonly="readonly"/>
                <input type="hidden" id="ativo" value="<?php echo $ativo; ?>" name="ativo" />
                <input type="hidden" id="idcliente" value="<?php echo $idcliente; ?>" name="idcliente" />
                <input type="hidden" value="<?php echo $idnfs; ?>" name="idnfs" />
                <br />
            </h1>
            <hr />
            <h1>DADOS DO CLIENTE</h1>
            <table border="0">
                <hr />
                <tr>
                    <td>Codig.</td>
                    <td><input name="unitario" type="text" class="effect" id="idcusto" onkeyup="up(this)" value="<?php echo $idcliente; ?>" size="10" readonly="readonly"/></td>
                    <td>Nome :</td>
                    <td colspan="3"><input name="idcusto" type="text" class="effect" id="pis_confins" value="<?php echo $cliente; ?>" size="80" readonly="readonly"/></td>
                </tr>
                <tr>
                    <td>CEP:</td>
                    <td><input name="st" type="text" class="effect" id="frete" onkeyup="up(this)"  value="<?php echo $cep; ?>" size="10" maxlength="10" readonly="readonly"/></td>
                    <td>End..:</td>
                    <td colspan="3"><input name="ipi" type="text" class="effect" id="st" onkeyup="up(this)" value="<?php echo $endereco; ?>" size="80" readonly="readonly"/></td>
                </tr>
                <tr>
                    <td>Cidade:</td>
                    <td><input name="frete" type="text" class="effect" id="frete_p" onkeyup="up(this)" value="<?php echo $cidade; ?>" size="10" maxlength="10" readonly="readonly"/></td>
                    <td>Bairro:</td>
                    <td><input name="frete_p" type="text" class="effect" id="ipi" onkeyup="up(this)" value="<?php echo $bairro; ?>" size="20" readonly="readonly"/></td>
                    <td>N°</td>
                    <td><input name="preco_custo" type="text" class="effect" id="unitario" value="<?php echo $numero; ?>" size="10" maxlength="10" onkeyup="up(this)" readonly="readonly"/></td>
                </tr>
            </table>
            <tr>     <h1>TIPO PEDIDO</h1></tr><hr>
            <table border="0">
                <tr>
                    <td>Operação:
                        <select name="tipo" id="tipo" class="effect">
                            <option value="" selected>Escolha Operacao</option>
                           <?php
                            //echo "ss $subgrupo";
                            $db = new DBNfs();
                            $db->selectOperacao($idformapg);
?>  
                            
                        </select>           </td>
                    <td>N° Nota:</td>
                    <td><input name="nnotad" type="text" class="effect" id="nnotad" onkeyup="up(this)" size="10" maxlength="10" value="<?php echo $nf;?>"/></td>
                </tr>
                <tr>
                    <td>Condição de Pagamento:
                        <label for="formapg"></label>
                        <select name="formapg" id="formapg">
<?php
//echo "ss $subgrupo";
$dbNFs = new DBNfs();
$dbNFs->selectSEL($idformapg);
?>
                        </select>             <label for="select2"></label></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            
            <tr>     <h1>ITENS PEDIDO</h1></tr><hr>

            <table border="0" id="lista">
                <thead>
                    <tr style="color:#000; font-weight:bold; background:#D9E5F3;">
                        <td colspan="6" align=""><a href="#" id="mais"><img src="resources/images/add.png" border="0"/></a></td>
                    </tr>
                    <tr style="color:#FFF; font-weight:bold; background:#024B78;">
                        <td align="center">DEL..</td>
                        <td align="center">PRODUTO</td>
                        <td align="center">EST.A</td>
                        <td align="center">VALOR</td>
                        <td align="center">QUANT.</td>
                        <td align="center">EXC...</td>
                    </tr>   
                </thead>

<?php
/*
 */
if (!empty($idnf)) {

    //consultar dados
    $dbnfe = new DBNfs();
    $dbnfe->selectPro($idnf);
} else {
    echo "<tr>
                    <td></td>
                    <td><input type=\"text\" name=\"item0\" size=\"70\" class=\"effect auto item\" onkeyup=\"up(this)\"/></td>
                    <td><input type=\"text\" name=\"est0\" size=\"5\" class=\"effect\" id=\"est2\" readonly=\"readonly\"/><div id=\"tmp_name\" style=\"display:none;\"></div> </td>
					
                    <td><input type=\"text\" name=\"custo0\" size=\"5\" id=\"moeda\" class=\"effect soma atri2\" readonly=\"readonly\"/></td>
		    <td><input type=\"text\" name=\"quantidade0\" size=\"5\" class=\"effect \" onkeyup=\"up(this)\" id=\"quantidade1\" onBlur=\"calculateSum();\"/></td>
                    <td align=\"center\" class=\"menos\"><img src=\"resources/images/menos.png\" border=\"0\" /></td>
                
                </tr>";
}
?>
                <input type="hidden" value="<?php if(!empty($idnf)){ echo $quantitens;}else{echo '1';} ?>" id="row" name="quantidade_itens" />
                <!--input type="hidden" value="1" id="row" name="quantidade_itens" /-->
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
                    <td id ="sub"><span id="vl" style="color:#F00;"><?php
                echo $somalote;
                if (empty($somalote)) {
                    echo "0";
                }
            ?></span>
                    </td>
                </tr>
                <tr>
                    <td>Frete:</td>
                    <td id ="sub2"><input name="frete" type="text" class="effect piada" id="per2" size="15" onblur="soma();" value="<?php echo $frete; ?>"/></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>Desconto:</td>
                    <td>
                        <!--input name="valordesconto" type="text" class="effect" id="valordesconto" onkeyup="up(this)" value="" size="10" maxlength="10" /-->
                        <input name="valordesconto" type="text" class="effect piada" id="valordesconto" value="<?php echo $valordesconto; ?>" size="15" onBlur="soma();" /></td-->
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
                    <td colspan="5" align="center"><input type="submit" name="button2" id="button2"  class="delete"  value="Fechar Pedido" /></td>
                </tr>
            </table>
            <input type="hidden" value="<?php echo $idnf; ?>" name="idnf" />
        </form>

    </fieldset>

</div>