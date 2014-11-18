<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerVendedor.php",  
                data: dados,  
                success: function( data )  
                {  
                    alert( data );
                    mudaConteudo('app/view/gridVendedor.php');
                }  
            });  
  
            return false;  
        });  
    });  
</script> 
<script language="JavaScript">

    function confirma(codigo) {
        if( confirm( 'ESTA OPCAO E IRREVERSIVEL. DESEJA REALMENTE FAZER ISTO?' ) ) 
        {
            mudaConteudo('app/controller/controllerVendedor.php?codExcluir='+ codigo);
        }
        return false;
    }

</script>

<?php
require("../../app/model/conexao/Conexao.php");
require("../../app/model/sql/DBVendedor.php");
require("../../app/model/modelVendedor.php");

require("../../app/model/sql/DBFornecedor.php");
require("../../app/model/modelFornecedor.php");
?>
<div id="datagrid">
    <h1>CADASTRO VENDEDOR/FORNECEDOR</h1>
    <hr>

    <fieldset>


        <tr>
            <td id="button"><input type="submit" value="Vendedor" name="button"  onclick="javascript:mudaConteudo('app/view/forVendedor.php');"/></td>
            <td align="left" id="button"><input type="submit" value="Fornecedor" name="button"  onclick="javascript:mudaConteudo('app/view/forFornecedor.php');"/></td>

        </tr>
        <table class="tabela">
            <tr class="linha">

                <td width="25">ALTE..</td>
                <td>VENDEDOR / EMPRESA</td>
                <td>CIDADE</td>
                <td>UF</td>

            </tr>
<?php
//inserir dados no banco de daodos
// $pessoa= new GrupoPessoa();
//inserir dados no banco de daodos
$dbVendedor = new DBVendedor();
$vendedor = $dbVendedor->selectAll();

$dbFornecedor = new DBFornecedor();
$fornecedor = $dbFornecedor->selectAll();
?> 

        </table>

    </fieldset>

</div>

