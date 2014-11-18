<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerCondicaoPagamento.php",  
                data: dados,  
                success: function( data )  
                {  
                    alert( data );
                    mudaConteudo('app/view/forCondicaoPagamento.php');
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
    <h1>CADASTRO CONDIÇÃO PAGAMENTO</h1>
    <hr>
    <fieldset>

        <form method="POST" action="" id="tr">
            <thead>
          <h1>DEFINIÇÃO PG</h1><hr>
            <table border="0">
                <?php
                $idcondicao = $_GET['idcondicao'];

                require("../../app/model/conexao/Conexao.php");
                require("../../app/model/sql/DBCondicaoPagamento.php");
                require("../../app/model/modelCondicaoPagamento.php");
                
                if (!empty($idcondicao)) {
                    //inserir dados no banco de daodos
                    $medida = new modelCondicaoPagamento();
                    $medida->setIDCondicao($idcondicao);
                    
                    //inserir dados no banco de daodos
                    $dbpg = new DBCondicaoPagamento();
                    $dbpg = $dbpg->select($medida);
                    
                    $nome      = $medida->getDescricao();
                    $idpg      = $medida->getIDCondicao();
                    $np        = $medida->getNp();
                    $ip        = $medida->getIp();
                    $entrada   = $medida->getEntrada();
                    $desconto  = $medida->getDesconto();
                    $acrescimo = $medida->getAcrescimo();
                    
                }
                ?>
                <tr> 
                    <td>Descrição:</td>
                    <td><input name="descricao" type="text" class="effect" id="grupo" value="<?php echo $nome; ?>" size="20" maxlength="100" onkeyup="up(this)"/></td>
                    <td>Numero Parcelas:</td>
                    <td><input name="np" type="text" class="effect" id="np" value="<?php echo $np; ?>" size="10" maxlength="2" onkeyup="up(this)"/></td>
                    <td> Intervalo em  Dias:</td>
                    <td><input name="ip" type="text" class="effect" id="ip" value="<?php echo $ip; ?>" size="10" maxlength="2" onkeyup="up(this)"/></td>
                </tr>
                <tr>
                  <td>Entrada:</td>
                  <td><label for="entrada" ></label>
                    <select name="entrada" id="entrada" class="effect">
                     <option value='0' <?php if ($entrada=='0'){echo "selected";}?>>SIM</option>
                     <option value='1' <?php if ($entrada=='1'){echo "selected";}?>>NÃO</option>
					  
                  </select></td>
                  <td>Desconto %:</td>
                  <td><input name="desconto" type="text" class="effect" id="desconto" value="<?php echo $desconto; ?>" size="10" maxlength="2" onkeyup="up(this)"/></td>
                  <td>Acréscimo %:</td>
                  <td><input name="acrescimo" type="text" class="effect" id="acrescimo" value="<?php echo $acrescimo; ?>" size="10" maxlength="2" onkeyup="up(this)"/></td>
                </tr>
                <tr>
                  <td colspan="6" align="center"><input type="hidden" name="idcondicao" value="<?php echo $idpg; ?>" />
                  <input type="submit" name="Submit" value="Cadastrar"/></td>
                </tr>
            </table>

        </form>
        <table class="tabela">
            <tr class="linha">
            	<td width="30" align="center">ALT</td>
                <td width="25">ID</td>
                <td>DESCRICAO</td>
                <td>N PARCELAS</td>
                <td>INTERVALO</td>
                <td>ENTRADA</td>
                <td>DESCONTO</td>
                <td>ACRÉSCIMO</td>
                
                
            </tr>
            <?php
            
            $dbpg = new DBCondicaoPagamento();
            $medida = $dbpg->selectAll();
            ?> 

        </table>

    </fieldset>

</div>

