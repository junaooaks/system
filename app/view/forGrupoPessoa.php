<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerSubGrupoPessoa.php",  
                data: dados,  
                success: function( data )  
                {  
                    alert( data );  
                    mudaConteudo('app/view/forGrupoPessoa.php')
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
        mudaConteudo('app/controller/controllerSubGrupoPessoa.php?codExcluir='+codigo);
    }
    return false;
}

</script>

<div id="datagrid">
    <h1>CADASTRO GRUPO PESSOA</h1>
    <hr>
    <fieldset>
 <?php
                $idgrupo = $_GET['idgrupo'];
                
                
                //echo "grupo = $idgrupo - sub = $idsubgrupo";
                require("../../app/model/conexao/Conexao.php");
                require("../../app/model/sql/DBGrupoPessoa.php");
                require("../../app/model/GrupoPessoa.php");
                require("../../app/model/sql/DBSubGrupoPessoa.php");
                require("../../app/model/SubGrupoPessoa.php");
                
                //inserir dados no banco de daodos
                $sub= new SubGrupoPessoa();
                $sub->setIDSubGrupo($idgrupo);
                
                //inserir dados no banco de daodos
                $dbSubGrupoPessoa = new DBSubGrupoPessoa();
                $dbSubGrupoPessoa = $dbSubGrupoPessoa->selectSUB($sub);
                
                $subgrupo=$sub->getGrupo();
                //echo "ss $subgrupo";
                
                ?>
        <form method="POST" action="" id="tr">
            <thead>
            <table border="0">
               
                <tr> 
                    <td>Grupo Pessoa:</td>
                    <td colspan="5"><input name="grupo" type="text" class="effect" id="grupo" value="<?php echo $subgrupo; ?>" size="92" maxlength="150" onkeyup="up(this)"/></td>
                    <td colspan="2"><input type="submit" name="Submit" value="Cadastrar"/>
                        <input type="hidden" name="idgrupo" value="<?php echo $idgrupo; ?>" />
                    
                </tr>
            </table>

        </form>
<table class="tabela">
             <tr class="linha">
                 
                 <td width="25">ID</td>
                 <td width="500">NOME</td>
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
        $dbGrupoPessoa = new DBSubGrupoPessoa();
        $pessoa = $dbGrupoPessoa->selectAll();
        
?> 
             
             </table>
    </fieldset>

</div>

