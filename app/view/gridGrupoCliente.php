 <script language="JavaScript">

function confirma(codigo) {
    if( confirm( 'ESTA OPCAO E IRREVERSIVEL. DESEJA REALMENTE FAZER ISTO?' ) ) 
    {
        mudaConteudo('app/controller/controllerGrupoPessoa.php?codExcluir='+ codigo);
    }
    return false;
}

</script>
        
<div id="datagrid">
  <h1>CADASTRO DOS GRUPOS/SUBGRUPOS</h1>
  <hr>
  <tr>
      <td id="button"><input type="submit" value="Novo" name="button"  onclick="javascript:mudaConteudo('app/view/forGrupoCliente.php');"/></td>
     
  </tr>
     <fieldset>
           
         <form name="linha" id="tr">
         <table class="tabela">
             <tr class="linha">
                 
                 <td width="25">ID</td>
                 <td width="500">NOME</td>
                 <td width="100" align="center">ALTERAR</td>
                 <td width="100" align="center">EXCLUIR</td>
                 <td width="100" align="center">SUB GRUPO</td>
                 
             </tr>
             <?php
             
require("../../app/model/conexao/Conexao.php");
require("../../app/model/sql/DBGrupoPessoa.php");
require("../../app/model/GrupoPessoa.php");

        //inserir dados no banco de daodos
      // $pessoa= new GrupoPessoa();
        
        //inserir dados no banco de daodos
        $dbGrupoPessoa = new DBGrupoPessoa();
        $pessoa = $dbGrupoPessoa->selectAll();
        
        
?> 
             
             </table>
                </form>
        </fieldset>
    
</div>