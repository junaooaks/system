<script type="text/javascript"> 
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize(); 
            jQuery.ajax({ 
                title: "Geral",
                type: "POST",
                url: "app/controller/controllerNFentrada.php",  
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
                    this.ret +="<td align=center><a href="+"javascript:mudaConteudo('app/view/forNF.php?idnf="+(data[i].idnotaEntrada)+"')"+"><img src='resources/images/lapis_alterar.png' title='Alterar Pessoa'/></a></td>";
                    this.ret +='<td>'+(data[i].operacao)+'</td>';
                    this.ret +='<td>'+(data[i].numeroPedido)+'</td>';
                    this.ret +='<td>'+(data[i].descricao)+'</td>';
                    this.ret +='<td>'+(data[i].dataEnt)+'</td>';
                    this.ret +='<td>'+(data[i].dataEmi)+'</td>';
                    this.ret +='<td>'+(data[i].valorFinal)+'</td>'; 
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
    <h1>CADASTRO PEDIDO</h1>
    <hr>
    <tr>
        <td id="button"><input type="submit" value="Novo" name="button"  onclick="javascript:mudaConteudo('app/view/forNf.php');"/></td>

    </tr>
    <fieldset>
        <form name="form1" method="post" action="" id="tr">
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td id="button"><table border="0">
                        <tr>
                            <td>FORNECEDOR:</td>
                            <td colspan="5"><input type="text" id="busca" name="for" value="" size="100" class="effect"  onkeyup="up(this)" />                        <label for="textfield"></label></td>
                        </tr>
                        <tr>
                            <td>NUMERO NF:</td>
                            <td><input type="text" id="busca3" name="nfe" value="" size="15" class="effect"  onkeyup="up(this)" /></td>
                            <td>DATA ENTRADA:</td>
                            <td><input type="text" id="busca2" name="entrada" value="" size="15" class="effect"  onkeyup="up(this)" /></td>
                            <td>DATA EMISSAO:</td>
                            <td><input type="text" id="busca4" name="emissao" value="" size="15" class="effect"  onkeyup="up(this)" /></td>
                        </tr>
                        <tr>
                            <td colspan="6" align="center"><input type="submit" value="Procurar" name="button2" /></td>
                        </tr>
                      
                        <input type="hidden" id="fd" name="busca" value="2" onkeyup="up(this)" />
                    </table></td>
            </tr>
            <tr></tr>



            <table class="tabela simples" >
                <tr class="linha">
                    <td width="35">ALT..</td>
                    <td width="34">TIPO</td>
                    <td width="34">N.PEDIDO</td>
                    <td>FORNECEDOR</td>
                    <td>DATA ENTRADA</td>
                    <td>DATA EMISSÃO</td>
                    <td>VALOR FINAL</td>

                </tr>
                <tbody id="resul">
                <?php
                //$pessoa = $_REQUEST['cli'];
                // echo $pessoa; 
                //echo "grupo = $idgrupo - sub = $idsubgrupo";
                require("../../app/model/conexao/Conexao.php");
                require("../../app/model/sql/DBNFentrada.php");
                require("../../app/model/modelNFentrada.php");
                $dbnf = new DBNFentrada();
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