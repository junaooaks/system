<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
           var dados = jQuery( this ).serialize();  
           
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerExportar.php",  
                data: dados,
                
                success: function( data )  
                {  
                    alert(data);
                    
                    //mudaConteudo('app/view/forCondicaoPagamento.php');
                }  
            });  
  
            return false;  
        });  
    });  
</script> 

<div id="datagrid">
    <h1>IMPORTAR DB EXTERNO</h1>
    <hr>
    <fieldset>

        <form method="POST" action="" id="tr">
           
            <thead>
          <h1>DEFINIÇÃO DB</h1><hr>
            <table border="0">
               
                <tr> 
                    <td>Banco de Dados:</td>
                    <td><input type="radio" name="db" class="effect" id="radio" value="firebird" checked="checked"/>Firebird</td>
                    <td></td>
                </tr>
                
                <tr>
                    <td>Tabelas:</td>
                <td><input type="radio" name="tabela" value="cliente" class="effect"/>Clientes</td>
                <td><input type="radio" name="tabela" value="produto" class="effect"/>Produtos </td>
                <td><input type="radio" name="tabela" value="fornecedor" class="effect"/>Fornecedor </td>
                <td><input type="radio" name="tabela" value="marca" class="effect"/>Marca </td>
                    
                </tr>
                <tr></tr>
                  <td colspan="3" align="center">
                  <input type="submit" name="Submit" value="Exportar"/></td>
                </tr>
            </table>
<tr>
                  
        </form>
        

    </fieldset>

</div>

