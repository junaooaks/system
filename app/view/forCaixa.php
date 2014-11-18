<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerCaixa.php",  
                data: dados,  
                success: function( data )  
                {  
                    alert( data );  
                    mudaConteudo('app/view/forCaixa.php')
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

function confirma(codigo, idgrupo) {
    if( confirm( 'ESTA OPCAO E IRREVERSIVEL. DESEJA REALMENTE FAZER ISTO?' ) ) 
    {
        mudaConteudo('app/controller/controllerCaixa.php?codExcluir='+codigo);
    }
    return false;
}

</script>

<div id="datagrid">
    <h1>CADASTRO CAIXAS</h1>
    <hr>
    <fieldset>
 <?php
                $idcaixa = $_GET['idcaixa'];
                
                
                //echo "grupo = $idgrupo - sub = $idsubgrupo";
                require("../../app/model/conexao/Conexao.php");
                require("../../app/model/sql/DBCaixa.php");
                require("../../app/model/modelCaixa.php");
                
                if(!empty($idcaixa)){
                //inserir dados no banco de daodos
                $marca= new modelCaixa();
                $marca->setIDCaixa($idcaixa);
                
                //inserir dados no banco de daodos
                $dbcx = new DBCaixa();
                $dbcx = $dbcx->selectSUB($marca);
                $senha=$marca->getSenha();
                $marca=$marca->getDescricao();
                
                }
                ?>
        <form method="POST" action="" id="tr">
            <thead>
            <table border="0">
               
                <tr> 
                    <td>Caixa:</td>
                    <td><input name="descricao" type="text" class="effect" id="marca" value="<?php echo $marca; ?>" size="92" maxlength="150" onkeyup="up(this)"/></td>
                    <td>Senha:</td>
                    <td colspan="3"><input name="senha" type="text" class="effect" value="<?php echo $senha; ?>" size="20" maxlength="8"/></td>
                    
                    <td colspan="2"><input type="submit" name="Submit" value="Cadastrar"/>
                    
                        <input type="hidden" name="idcaixa" value="<?php echo $idcaixa; ?>" />
                    
                </tr>
            </table>

        </form>
<table class="tabela">
             <tr class="linha">
                 
                 <td width="25">ID</td>
                 <td width="500">DESCRICAO</td>
                 <td width="100" align="center">ALTERAR</td>
                 <td width="100" align="center">EXCLUIR</td>
                 
                 
             </tr>
             <?php
             

//require("../../app/model/sql/DBSubGrupoPessoa.php");
//require("../../app/model/SubGrupoPessoa.php");

       //inserir dados no banco de daodos
               /* $pessoa= new SubGrupoPessoa();
                $pessoa->setIDGrupo($idgrupo);
                //inserir dados no banco de daodos
                $dbSubGrupoPessoa = new DBSubGrupoPessoa();
                $dbSubGrupoPessoa = $dbSubGrupoPessoa->selectAll($pessoa);
                $grupo=$pessoa->getIDGrupo();
        */
             //inserir dados no banco de daodos
       
      
        $dbmarca = new DBCaixa();
        $pessoa = $dbmarca->selectAll();
        
?> 
             
             </table>
    </fieldset>

</div>

