<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerContaBanco.php",  
                data: dados,  
                success: function( data )  
                {  
                    alert( data );
                    mudaConteudo('app/view/forContaBanco.php');
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
    <h1>CADASTRO CONTA BANCARIA</h1>
    <hr>
    <fieldset>

        <form method="POST" action="" id="tr">
            <thead>
          <h1>CONTAS BANCARIAS</h1><hr>
            <table border="0">
                <?php
                $idbanco = $_GET['idbanco'];

                require("../../app/model/conexao/Conexao.php");
                require("../../app/model/sql/DBContaBanco.php");
                require("../../app/model/modelContaBanco.php");
                
                if (!empty($idbanco)) {
                    
                    //inserir dados no banco de daodos
                    $medida = new modelContaBanco();
                    $medida->setIDBanco($idbanco);
                    
                    //inserir dados no banco de daodos
                    $dbpg = new DBContaBanco();
                    $dbpg = $dbpg->select($medida);
                    
                     $banco   = $medida->getBanco();
                     $idbanco = $medida->getIDBanco();
                     $agencia = $medida->getAgencia();
                     $titular = $medida->getTitular();
                     $conta   = $medida->getConta();
                    
                }
                ?>
                <tr> 
                    <td>Banco:</td>
                    <td><input name="banco" type="text" class="effect" id="grupo" value="<?php echo $banco; ?>" size="20" maxlength="100" onkeyup="up(this)"/></td>
                    <td>N° Agência:</td>
                    <td><input name="agencia" type="text" class="effect" id="np" value="<?php echo $agencia; ?>" size="20" maxlength="10" onkeyup="up(this)"/></td>
                </tr>
                <tr>
                  <td>N° Conta:</td>
                  <td><input name="conta" type="text" class="effect" id="entrada" value="<?php echo $conta; ?>" size="20" maxlength="10" onkeyup="up(this)"/></td>
                  <td>Titular:</td>
                  <td><input name="titular" type="text" class="effect" id="desconto" value="<?php echo $titular; ?>" size="20" maxlength="10" onkeyup="up(this)"/></td>
                </tr>
                <tr>
                  <td colspan="4" align="center"><input type="hidden" name="idbanco" value="<?php echo $idbanco; ?>" />
                  <input type="submit" name="Submit" value="Cadastrar"/></td>
                </tr>
            </table>

        </form>
        <table class="tabela">
            <tr class="linha">
                <td width="25">ID</td>
                <td>BANCO</td>
                <td>AGENCIA</td>
                <td>TITULAR</td>
                
                <td width="100" align="center">ALTERAR</td>
                
            </tr>
            <?php
            
            $dbpg = new DBContaBanco();
            $medida = $dbpg->selectAll();
            ?> 

        </table>

    </fieldset>

</div>

