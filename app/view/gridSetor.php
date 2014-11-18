<script type="text/javascript"> 
/*      
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
    
    
  */  
   function up(lstr){ // converte minusculas em maiusculas
        var str=lstr.value; //obtem o valor
        lstr.value=str.toUpperCase(); //converte as strings e retorna ao campo
    }
</script>  

<div id="datagrid">
    <h1>CADASTRO SETORES</h1>
    <hr>
    
    <fieldset>
        
        <table class="tabela">
            <tr class="linha">
                <td width="35">SELE...</td>
                <td>EMPRESA</td>
                <td>CNPJ</td>
            </tr>
            <?php
            //$pessoa = $_REQUEST['cli'];
           // echo $pessoa; 

            //echo "grupo = $idgrupo - sub = $idsubgrupo";
            require("../../app/model/conexao/Conexao.php");
            require("../../app/model/sql/DBSetor.php");
            require("../../app/model/modelSetor.php");
            $dbempresa = new DBSetor();
           
                $pessoa = $dbempresa->selectEmpresaf();
            
            ?>
        </table>

    </fieldset>

</div>