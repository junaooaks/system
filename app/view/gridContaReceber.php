<script type="text/javascript"> 
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize(); 
            jQuery.ajax({ 
                title: "Geral",
                type: "POST",
                url: "app/controller/controllerContaReceber.php",  
                data: dados,
                dataType: 'json',
                success: function( data )  {
                 //  alert(data);
                   
                    this.ret = '';
                    var clas = '#E2EBCC';
                    for(i in data){ 
                    this.ret +='<tr style=background:'+clas+'>';
                    this.ret +="<td align=center><a href="+"javascript:mudaConteudo('app/view/forContaReceber.php?idcliente="+(data[i].idpessoa)+"')"+"><img src='resources/images/apply.png' title='Alterar Pessoa'/></a></td>";
                    this.ret +='<td>'+(data[i].idpessoa)+'</td>';
                    this.ret +='<td>'+(data[i].nome)+'</td>';
                    this.ret +='<td>'+(data[i].endereco)+'</td>';
                    this.ret +='<td>'+(data[i].numero)+'</td>';
                    this.ret +='<td>'+(data[i].bairro)+'</td>';
                    this.ret +='<td>'+(data[i].cidade)+'</td>';
                    this.ret +='<td>'+(data[i].estado)+'</td>'; 
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
    <h1>CONTAS A RECEBER</h1>
    <hr>
    
    <fieldset>
        <form name="form1" method="post" action="" id="tr">
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td id="button"><table border="0">
                        <tr>
                            <td>NOME CLIENTE:</td>
                            <td colspan="5"><input type="text" id="busca" name="buscaCliente" value="" size="100" class="effect"  onkeyup="up(this)" />                        <label for="textfield"></label></td>
                             <td colspan="6" align="center"><input type="submit" value="Procurar" name="button2" /></td>
                        </tr>
                        
                        
                        <input type="hidden" id="fd" name="busca" value="2" onkeyup="up(this)" />
                    </table></td>
            </tr>
            <tr></tr>



            <table class="tabela simples" >
                <tr class="linha">
                    <td width="35" align="center"><img src="resources/images/apply.png"/></td>
                    <td width="35">NF.</td>
                    <td>CLIENTE</td>
                    <td>ENDEREÇO</td>
                    <td>N°</td>
                    <td>BAIRRO</td>
                    <td>CIDADE</td>
                    <td>UF</td>
                    
                </tr>
                <tbody id="resul">
                <?php
                //$pessoa = $_REQUEST['cli'];
                // echo $pessoa; 
                //echo "grupo = $idgrupo - sub = $idsubgrupo";
                require("../../app/model/conexao/Conexao.php");
                require("../../app/model/sql/DBContaReceber.php");
                require("../../app/model/modelContaReceber.php");
                
                $dbnf = new DBContaReceber();
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