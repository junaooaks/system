<script type="text/javascript"> 
      
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerPessoa.php",  
                data: dados,  
                success: function( data )  
                {  
                    alert( data );
                    mudaConteudo('app/view/gridCliente.php')
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
    <h1>CADASTRO EMPRESA</h1>
    <hr>
    <tr>
        <td id="button"><input type="submit" value="Novo" name="button"  onclick="javascript:mudaConteudo('app/view/forEmpresa.php');"/></td>

    </tr>
    <fieldset>
        
        <table class="tabela">
            <tr class="linha">
                <td width="35">ALT..</td>
                <td>NOME</td>
                <td>ENDEREÇO</td>
                <td>NUMERO</td>
                <td>BAIRRO</td>
                <td>CIDADE</td>
                <td>UF</td>
            </tr>
            <?php
            //$pessoa = $_REQUEST['cli'];
           // echo $pessoa; 

            //echo "grupo = $idgrupo - sub = $idsubgrupo";
            require("../../app/model/conexao/Conexao.php");
            require("../../app/model/sql/DBEmpresa.php");
            require("../../app/model/modelEmpresa.php");
            $dbempresa = new DBEmpresa();
           
                $pessoa = $dbempresa->selectAll();
            
            ?>
        </table>

    </fieldset>

</div>