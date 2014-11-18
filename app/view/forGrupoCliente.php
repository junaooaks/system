<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerGrupoPessoa.php",  
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

<div id="datagrid">
    <h1>CADASTRO DOS GRUPOS</h1>
    <hr>
    <fieldset>

        <form method="POST" action="" id="tr">
            <thead>
            <table border="0">
                <h1>DEFINIÇÃO DOS GRUPOS DE CLIENTES</h1><hr>
                <?php
                $idgrupo = $_GET['idgrupo'];

                require("../../app/model/conexao/Conexao.php");
                require("../../app/model/sql/DBGrupoPessoa.php");
                require("../../app/model/GrupoPessoa.php");

                //inserir dados no banco de daodos
                 $pessoa= new GrupoPessoa();
                $pessoa->setIDGrupo($idgrupo);
                //inserir dados no banco de daodos
                $dbGrupoPessoa = new DBGrupoPessoa();
                $dbGrupoPessoa = $dbGrupoPessoa->select($pessoa);
                $grupo=$pessoa->getGrupo();
                ?>
                <tr> 
                    <td>Grupo:</td>
                    <td colspan="5"><input name="grupo" type="text" class="effect" id="grupo" value="<?php echo $grupo;?>" size="92" maxlength="150" /></td>
                    <td colspan="2"><input type="submit" name="Submit" value="Cadastrar"/>
                        <input type="hidden" name="idgrupo" value="<?php echo $idgrupo; ?>" /></td>
                </tr>
            </table>

        </form>

    </fieldset>

</div>

