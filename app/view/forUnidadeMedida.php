<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerUnidadeMedida.php",  
                data: dados,  
                success: function( data )  
                {  
                    alert( data );
                    mudaConteudo('app/view/forUnidadeMedida.php');
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
<script language="JavaScript">

    function confirma(codigo) {
        if( confirm( 'ESTA OPCAO E IRREVERSIVEL. DESEJA REALMENTE FAZER ISTO?' ) ) 
        {
            mudaConteudo('app/controller/controllerUnidadeMedida.php?codExcluir='+ codigo);
        }
        return false;
    }

</script>
<div id="datagrid">
    <h1>CADASTRO UNIDADE DE MEDIDA</h1>
    <hr>
    <fieldset>

        <form method="POST" action="" id="tr">
            <thead>
                <h1>DEFINIÇÃO MEDIDA</h1><hr>
            <table border="0">
                <?php
                $idunidade = $_GET['idunidade'];

                require("../../app/model/conexao/Conexao.php");
                require("../../app/model/sql/DBUnidadeMedida.php");
                //require("../../app/model/GrupoProduto.php");
                require("../../app/model/ModelUnidadeMedida.php");
                
                if (!empty($idunidade)) {
                    //inserir dados no banco de daodos
                    $medida = new UnidadeMedida();
                    $medida->setIDUnidade($idunidade);
                    
                    //inserir dados no banco de daodos
                    $dbMedida = new DBUnidadeMedida();
                    $dbMedida = $dbMedida->select($medida);
                    
                    $nome = $medida->getDescricao();
                    $sigla= $medida->getSigla();
                    
                }
                ?>
                <tr> 
                    <td>Descrição:</td>
                    <td colspan="5"><input name="descricao" type="text" class="effect" id="grupo" value="<?php echo $nome; ?>" size="92" maxlength="150" onkeyup="up(this)"/></td>
                    <td>Sigla:</td>
                    <td colspan="5"><input name="sigla" type="text" class="effect" value="<?php echo $sigla; ?>" size="15" maxlength="10" onkeyup="up(this)"/></td>
                    <td colspan="2"><input type="submit" name="Submit" value="Cadastrar"/>
                        <input type="hidden" name="idunidade" value="<?php echo $idunidade; ?>" /></td>
                </tr>
            </table>

        </form>
        <table class="tabela">
            <tr class="linha">
                <td width="25">ID</td>
                <td width="400">DESCRICAO</td>
                <td width="50">SIGLA</td>
                <td width="100" align="center">ALTERAR</td>
                <td width="100" align="center">EXCLUIR</td>
            </tr>
            <?php
            
            $dbUnidade = new DBUnidadeMedida();
            $medida = $dbUnidade->selectAll();
            ?> 

        </table>

    </fieldset>

</div>

