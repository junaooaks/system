<script type="text/javascript"> 
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize(); 
            jQuery.ajax({ 
                title: "Geral",
                type: "POST",
                url: "app/controller/controllerNFs.php",  
                data: dados,
                dataType: 'json',
                success: function( data )  {
                   //alert(data);
                   
                    this.ret = '';
                    var clas = '#E2EBCC';
                    for(i in data){ 
                    this.ret +='<tr style=background:'+clas+'>';
                    //<td align='center'><a href=" . "javascript:mudaConteudo('app/view/forNF.php?idnf=" . $row['idnotaEntrada'] . "')" . "><img src='resources/images/lapis_alterar.png' title='Alterar Pessoa'/></a></td>
          
                    //href="."javascript:mudaConteudo('app/view/forNF.php?idnf=" . . "')" . "
                    this.ret +="<td align=center><a href="+"javascript:mudaConteudo('app/view/forNFs.php?idnf="+(data[i].idnotaSaida)+"')"+"><img src='resources/images/lapis_alterar.png' title='Alterar Pessoa'/></a></td>";
                    this.ret +='<td>'+(data[i].idnotaSaida)+'</td>';
                    this.ret +='<td>'+(data[i].nf)+'</td>';
                    this.ret +='<td>'+(data[i].nome)+'</td>';
                    this.ret +='<td>'+(data[i].Data)+'</td>';
                    this.ret +='<td>'+(data[i].valorProdutos)+'</td>';
                    /*this.ret +='<td>'+(data[i].operacao)+'</td>';*/ 
                    this.ret +='</tr>';
                    
                    if (clas === '#E2EBCC') {
                clas = '#FFFFFF';
            } else {
                clas = '#E2EBCC';
            }
                    }
                    
                    
                    jQuery("table #um").hide();
                    //jQuery("#resul tbody").reload(this.ret);
                    //jQuery('#resul tbody').append( this.ret ).reload();
                    jQuery('#resul').html( this.ret );
                   //mudaConteudo('app/view/gridNf.php?teste=' + this.ret); 
                       
            }
                
        }); 
        
        return false;  
    });  
});
    
function up(lstr){ // converte minusculas em maiusculas
    var str=lstr.value; //obtem o valor
    lstr.value=str.toUpperCase(); //converte as strings e retorna ao campo
}

</script> 


<div id="datagrid">
    <h1>SAIDA PEDIDO</h1>
    <hr>
    <tr>
        <td id="button"><input type="submit" value="CRIAR PEDIDO" name="button"  onclick="javascript:mudaConteudo('app/view/forNfs.php?ven=<?php echo $_GET['vd']; ?>');"/></td>

    </tr>
    <fieldset>
        <form name="form1" method="post" action="" id="tr">
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td id="button"><table border="0">
                        <tr>
                            <td>NOME CLIENTE:</td>
                            <td colspan="5"><input type="text" id="busca" name="cliente" value="" size="100" class="effect"  onkeyup="up(this)" />                        <label for="textfield"></label></td>
                             <td colspan="6" align="center"><input type="submit" value="Procurar" name="button2" /></td>
                        </tr>
                        
                        
                        <input type="hidden" id="fd" name="busca" value="2" onkeyup="up(this)" />
                    </table></td>
            </tr>
            <tr></tr>



            <table class="tabela simples" >
                <tr class="linha">
                    <td width="35">ALT.</td>
                    <td width="35">N°</td>
                    <td width="35">NF</td>
                    <td>CLIENTE</td>
                    <td>DATA REGISTRO</td>
                    <td>VALOR</td>
                    
                    
                </tr>
                <tbody id="resul">
                <?php
                //$pessoa = $_REQUEST['cli'];
                // echo $pessoa; 
                //echo "grupo = $idgrupo - sub = $idsubgrupo";
                require("../../app/model/conexao/Conexao.php");
                require("../../app/model/sql/DBNfs.php");
                require("../../app/model/modelNFs.php");
                
                $dbnf = new DBNfs();
                $test = $_GET['teste'];
                if(empty ($test))
                 {
                    $nf = $dbnf->selectAll();
                } else {
                    $dbnf->selectBUSCA($pessoa);
                    //echo "busca" . $pessoa->getBusca();
                    
                }
                ?>
                </tbody>
            </table>
            
        </form>
    </fieldset>

</div>