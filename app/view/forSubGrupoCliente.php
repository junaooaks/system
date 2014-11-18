<?php
 $idgrupo = $_GET['idgrupo'];
                $idsubgrupo = $_GET['idsubgrupo'];
                
                //echo "grupo = $idgrupo - sub = $idsubgrupo";
                require("../../app/model/conexao/Conexao.php");
                require("../../app/model/sql/DBGrupoProduto.php");
                require("../../app/model/GrupoProduto.php");
                require("../../app/model/sql/DBSubGrupoProduto.php");
                require("../../app/model/SubGrupoProduto.php");
                
echo "
<script>  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: 'WebCom',
                type: 'POST',  
                url: 'app/controller/controllerSubGrupoProduto.php',  
                data: dados,  
                
                success: function( data )  
                {  
                    alert(data);
                   mudaConteudo('app/view/forSubGrupoCliente.php?idgrupo=$idgrupo');
                    
                    
                }  
            });  
  
            return false;  
        });  
    }); 
                 function up(lstr){ // converte minusculas em maiusculas
        var str=lstr.value; //obtem o valor
        lstr.value=str.toUpperCase(); //converte as strings e retorna ao campo
    }
</script> ";
?>
<script language="JavaScript">

function confirma(codigo, idgrupo) {
    if( confirm( 'ESTA OPCAO E IRREVERSIVEL. DESEJA REALMENTE FAZER ISTO?' ) ) 
    {
        mudaConteudo('app/controller/controllerSubGrupoProduto.php?codExcluir='+codigo+'&idgrupo='+idgrupo);
    }
    return false;
}

</script>

<div id="datagrid">
    <h1>CADASTRO DOS GRUPOS</h1>
    <hr>
    <fieldset>
 <?php
               
                
                //inserir dados no banco de daodos
                if(!empty($idsubgrupo)){
                $sub= new SubGrupoProduto();
                $sub->setIDSubGrupo($idsubgrupo);
                
                //inserir dados no banco de daodos
                $dbSubGrupo = new DBSubGrupoProduto();
                $dbSubGrupo = $dbSubGrupo->selectSUB($sub);
                
                $subgrupo=$sub->getSubGrupo();
                //echo "ss $subgrupo";
                }
                //inserir dados no banco de daodos
                $pessoa= new GrupoProduto();
                $pessoa->setIDGrupo($idgrupo);
                //inserir dados no banco de daodos
                $dbGrupoPessoa = new DBGrupoProduto();
                $dbGrupoPessoa = $dbGrupoPessoa->select($pessoa);
                $grupo=$pessoa->getGrupo();
                
                
                ?>
        <form method="POST" action="" id="tr">
            <thead>
            <table border="0">
                <h1>SUB-GRUPO DO GRUPO - <?php echo "<font color='#FF0000'>$grupo</font>";?></h1><hr>
               
                <tr> 
                    <td>Sub-Grupo:</td>
                    <td colspan="5"><input name="subgrupo" type="text" class="effect" id="subgrupo" value="<?php echo $subgrupo; ?>" size="92" maxlength="150" onkeyup="up(this)"/></td>
                    <td colspan="2"><input type="submit" name="Submit" value="Cadastrar"/>
                        <input type="hidden" name="idgrupo" value="<?php echo $idgrupo; ?>" />
                    <input type="hidden" name="idsubgrupo" value="<?php echo $idsubgrupo; ?>" /></td>
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
                $pessoa= new SubGrupoProduto();
                $pessoa->setIDGrupo($idgrupo);
                //inserir dados no banco de daodos
                $dbSubGrupoProduto = new DBSubGrupoProduto();
                $dbSubGrupoProduto = $dbSubGrupoProduto->select($pessoa);
                $grupo=$pessoa->getIDGrupo();
        
        
?> 
             
             </table>
    </fieldset>

</div>

