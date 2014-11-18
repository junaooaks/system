<?php
 $idempresa = $_GET['idempresa'];
 $idsetor   = $_GET['idsetor'];
 //$idsubgrupo = $_GET['idsubgrupo'];
                
                //echo "grupo = $idgrupo - sub = $idsubgrupo";
                require("../../app/model/conexao/Conexao.php");
                require("../../app/model/sql/DBSetor.php");
                require("../../app/model/modelSetor.php");
                
echo "
<script>  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: 'WebCom',
                type: 'POST',  
                url: 'app/controller/controllerSetor.php',  
                data: dados,  
                
                success: function( data )  
                {  
                    alert(data);
                   mudaConteudo('app/view/forSetor.php?idempresa=$idempresa');
                    
                    
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

function confirma(codigo, idempresa) {
    if( confirm( 'ESTA OPCAO E IRREVERSIVEL. DESEJA REALMENTE FAZER ISTO?' ) ) 
    {
        mudaConteudo('app/controller/controllerSetor.php?codExcluir='+codigo+'&idem='+idempresa);
    }
    return false;
}

</script>

<div id="datagrid">
    <h1>CADASTRO DOS SETORES</h1>
    <hr>
    <fieldset>
 <?php
               
                
                //inserir dados no banco de daodos
                if(!empty($idsetor)){
                $sub= new modelSetor();
                $sub->setIDSetor($idsetor);
                
                //inserir dados no banco de daodos
                $dbsetor = new DBSetor();
                $dbsetor = $dbsetor->selectSetor($sub);
                
                $descricao=$sub->getDescricao();
                $comissao = $sub->getComissao();
                
               
                //echo "ss $subgrupo";
                }
                //inserir dados no banco de daodos
                $pessoa= new modelSetor();
                $pessoa->setIDEmpresa($idempresa);
                
                $dbsetor = new DBSetor();
                $dbsetor = $dbsetor->select($pessoa);
                                
                $nomeempresa=$pessoa->getNome();
                
                
                ?>
        <form method="POST" action="" id="tr">
            <thead>
            <table border="0">
                <h1>EMPRESA - <?php echo "<font color='#FF0000'>$nomeempresa</font>";?></h1><hr>
               
                <tr> 
                    <td>SETOR:</td>
                    <td colspan="5"><input name="descricao" type="text" class="effect" id="" value="<?php echo $descricao; ?>" size="92" maxlength="150" onkeyup="up(this)"/></td>
                   
                        <input type="hidden" name="idempresa" value="<?php echo $idempresa; ?>" />
                    <input type="hidden" name="idsetor" value="<?php echo $idsetor; ?>" /></td>
                    
                    
                    <td>Comissionado: </td>
                    <td><input type="radio" name="comissao" id="radio" value="s"  <?php if($comissao=='s'){echo "checked='checked'";}?> />
                        <label for="n"></label> 
                        Sim
                        <input name="comissao" type="radio" id="radio2" value="n" <?php if(($comissao=='n')or($comissao=='')){echo "checked='checked'";}?> />
                        Não</td>
                    <td></td>
                     <td><input type="submit" name="Submit" value="Cadastrar"/></td>
                </tr>
            </table>

        </form>
<table class="tabela">
             <tr class="linha">
                 
                 <td width="25">ID</td>
                 <td width="500">NOME SETOR</td>
                 <td width="500">COMISSIONADO</td>
                 <td width="100" align="center">ALTERAR</td>
                 <td width="100" align="center">EXCLUIR</td>
                 
                 
             </tr>
             <?php
             

//require("../../app/model/sql/DBSubGrupoPessoa.php");
//require("../../app/model/SubGrupoPessoa.php");

       //inserir dados no banco de daodos
               
                $setor= new modelSetor();
                $setor->setIDEmpresa($idempresa);
                //inserir dados no banco de daodos
                $dbsetor = new DBSetor();
                $dbsetor = $dbsetor->selectAll($setor);
                //$grupo=$setor->getIDGrupo();
        
        
?> 
             
             </table>
    </fieldset>

</div>

