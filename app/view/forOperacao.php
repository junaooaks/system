<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerOperacao.php",  
                data: dados,  
                success: function( data )  
                {  
                        alert( data );
                    mudaConteudo('app/view/forOperacao.php');
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
    <h1>CADASTRO OPERAÇÃO</h1>
    <hr>
    <fieldset>

        <form method="POST" action="" id="tr">
            <thead>
          <h1>TIPO OPERAÇÕES</h1><hr>
            <table border="0">
                <?php
                $idoperacao = $_GET['idoperacao'];

                require("../../app/model/conexao/Conexao.php");
                require("../../app/model/sql/DBOperacao.php");
                require("../../app/model/modelOperacao.php");
                
                if (!empty($idoperacao)) {
                    //inserir dados no banco de daodos
                    $medida = new modelOperacao();
                    $medida->setIDOperacao($idoperacao);
                    
                    //inserir dados no banco de daodos
                    $dbpg = new DBOperacao();
                    $dbpg = $dbpg->select($medida);
                    
                    $nome      = $medida->getDescricao();
                    $idoperacao      = $medida->getIDOperacao();
                    $comissao        = $medida->getComissao();
                    $financa        = $medida->getFinanca();
                    $tipo   = $medida->getTipo();
                    
                }
                ?>
                <tr> 
                    <td>Descrição:</td>
                    <td colspan="4"><input name="descricao" type="text" class="effect" id="grupo" value="<?php echo $nome; ?>" size="47" maxlength="100" onkeyup="up(this)" /></td>
                </tr>
                <tr>
                  <td>Gera Finança:</td>
                  <td><input name="financa" type="checkbox" id="financa" value="1" <?php if ($financa<>'0'){echo "checked='checked'";}?> />
                  <label for="financa"></label></td>
                  <td>Gera Comissão:</td>
                  <td><input name="comissao" type="checkbox" id="comissao" value="1" <?php if ($comissao<>'0'){echo "checked='checked'";}?> />
                  <label for="comissao"></label></td>
                  <td>Tipo:
                    
                    <label for="tipo"></label>
Entrada
<input name="tipo" type="radio" id="radio" value="e" <?php if (($tipo=='e') or ($tipo=='')){echo "checked='checked'";}?> />
 Saida
 <input type="radio" name="tipo" id="radio2" value="s" <?php if ($tipo=='s'){echo "checked='checked'";}?>/></td>
                </tr>
                <tr>
                  <td colspan="5" align="center"><input type="hidden" name="idoperacao" value="<?php echo $idoperacao; ?>" />
                  <input type="submit" name="Submit" value="Cadastrar"/></td>
                </tr>
            </table>

        </form>
        <table class="tabela">
            <tr class="linha">
                <td width="25">ID</td>
                <td align="center">DESCRICAO</td>
                <td align="center">FINANÇA</td>
                <td align="center">COMISSÃO</td>
                <td align="center">TIPO</td>
                <td width="100" align="center">ALTERAR</td>
                
            </tr>
            <?php
            
            $dbpg = new DBOperacao();
            $medida = $dbpg->selectAll();
            ?> 

        </table>

    </fieldset>

</div>

