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
                    if(data != ''){
                        alert( data );
                    }
                    
                    if(data==''){
                        
                    caixa = document.getElementById('cx');
                    //alert(caixa);
                    mudaConteudo('app/view/gridNfs.php?vd=' + caixa.value);
                    
                    } 
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
    <h1>&nbsp;</h1>
    <fieldset>
      <?php
                
               
                
                
                ?>
  <form method="POST" action="" id="tr">
            <thead>
            <table border="0" align="center" cellpadding="5" cellspacing="0">
               
                <tr> 
                    <td rowspan="4"  bgcolor="#CED9E7"></td>
                    <td colspan="5" align="center" bgcolor="#CED9E7"><a style="color:#024B78"><strong>VENDEDOR</strong></a></td>
                    <td colspan="2" rowspan="4"  bgcolor="#CED9E7">              </tr>
                <tr>
                  <td colspan="4">Vendedor:</td> 
                  <td><select name="vendedor" id="cx" class="effect" >
                  <?php
                             //echo "grupo = $idgrupo - sub = $idsubgrupo";
                require("../../app/model/conexao/Conexao.php");
                require("../../app/model/sql/DBNfs.php");
                require("../../app/model/modelNFs.php");
                            //echo "ss $subgrupo";
                            $dbvend = new DBNfs;
                            $vend = $dbvend->selectVendedor();
                            ?>
                  </select></td>
                </tr>
                <tr>
                  <td colspan="4">Senha:</td>
                  <td><input name="senha" type="password" class="effect"/></td>
              </tr>
                <tr>
                  <td colspan="5" align="center"><input type="submit" name="Submit" value="Selecionar"/>
                  <input type="hidden" name="idmarca" value="<?php echo $idmarca; ?>" /></td>
              </tr>
                <tr>
                  <td  bgcolor="#CED9E7"></td>
                  <td colspan="5" align="center" bgcolor="#CED9E7">&nbsp;</td>
                  <td colspan="2"  bgcolor="#CED9E7">                  
              </tr>
            </table>

        </form>
  </fieldset>

</div>

