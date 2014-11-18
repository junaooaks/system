<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerGrupoProduto.php",  
                data: dados,  
                success: function( data )  
                {  
                    alert( data );
                    mudaConteudo('app/view/forGrupoProduto.php');
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
            mudaConteudo('app/controller/controllerGrupoProduto.php?codExcluir='+ codigo);
        }
        return false;
    }

</script>
<div id="datagrid">
    <h1>CADASTRO DOS GRUPOS</h1>
    <hr>
    <fieldset>

        <form method="POST" action="" id="tr">
            <thead>
            <table border="0">
                <h1>DEFINIÇÃO DOS GRUPOS PRODUTOS</h1><hr>
                <?php
                $idgrupo = $_GET['idgrupo'];

                require("../../app/model/conexao/Conexao.php");
                require("../../app/model/sql/DBGrupoProduto.php");
                require("../../app/model/GrupoProduto.php");

                if (!empty($idgrupo)) {
                    //inserir dados no banco de daodos
                    $pessoa = new GrupoProduto();
                    $pessoa->setIDGrupo($idgrupo);
                    //inserir dados no banco de daodos
                    $dbGrupoPessoa = new DBGrupoProduto();
                    $dbGrupoPessoa = $dbGrupoPessoa->select($pessoa);
                    $grupo = $pessoa->getGrupo();
                    $comissao= $pessoa->getComissao();
                }
                ?>
                <tr> 
                    <td>Grupo:</td>
                    <td colspan="5"><input name="grupo" type="text" class="effect" id="grupo" value="<?php echo $grupo; ?>" size="92" maxlength="150" onkeyup="up(this)"/></td>
                    <td>Comissão:</td>
                    <td colspan="5"><input name="comissao" type="text" class="effect" value="<?php echo $comissao; ?>" size="15" maxlength="10" onkeyup="up(this)"/></td>
                    <td colspan="2"><input type="submit" name="Submit" value="Cadastrar"/>
                        <input type="hidden" name="idgrupo" value="<?php echo $idgrupo; ?>" /></td>
                </tr>
            </table>

        </form>
        <table class="tabela">
            <tr class="linha">

                <td width="25">ID</td>
                <td width="400">NOME</td>
                <td width="50">COMISSÃO</td>
                <td width="100" align="center">ALTERAR</td>
                <td width="100" align="center">EXCLUIR</td>
                <td width="100" align="center">SUB GRUPO</td>

            </tr>
            <?php
            //inserir dados no banco de daodos
            // $pessoa= new GrupoPessoa();
            //inserir dados no banco de daodos
            $dbGrupoProduto = new DBGrupoProduto();
            $pessoa = $dbGrupoProduto->selectAll();
            ?> 

        </table>

    </fieldset>

</div>

