<script type="text/javascript"> 
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize(); 
            jQuery.ajax({ 
                title: "Geral",
                type: "POST",
                url: "app/controller/controllerPessoa.php",  
                data: dados,
                dataType: 'json',
                success: function( data )  {
                   // alert(data);
                   
                    this.ret = '';
                    var clas = '#E2EBCC';
                    for(i in data){ 
                    this.ret +='<tr style=background:'+clas+'>';
                    //<td align='center'><a href=" . "javascript:mudaConteudo('app/view/forNF.php?idnf=" . $row['idnotaEntrada'] . "')" . "><img src='resources/images/lapis_alterar.png' title='Alterar Pessoa'/></a></td>
          
                    //href="."javascript:mudaConteudo('app/view/forNF.php?idnf=" . . "')" . "
                    //idpessoa,nome,endereco,numero, telefoneResidencial, celular1, cidade, estado
                    this.ret +="<td align=center><a href="+"javascript:mudaConteudo('app/view/forCliente.php?idpessoa="+(data[i].idpessoa)+"')"+"><img src='resources/images/lapis_alterar.png' title='Alterar Pessoa'/></a></td>";
                    this.ret +='<td>'+(data[i].idpessoa)+'</td>';
                    this.ret +='<td>'+(data[i].nome)+'</td>';
                    this.ret +='<td>'+(data[i].endereco)+'</td>';
                    this.ret +='<td>'+(data[i].numero)+'</td>';
                    this.ret +='<td>'+(data[i].telefoneResidencial)+'</td>';
                    this.ret +='<td>'+(data[i].celular1)+'</td>'; 
                    this.ret +='<td>'+(data[i].cidade)+'</td>'; 
                    this.ret +='<td>'+(data[i].estado)+'</td>'; 
                    this.ret +="<td align=center><a href="+"javascript:mudaConteudo('app/view/forFinanceiro.php?idpessoa="+(data[i].idpessoa)+"')"+"><img src='resources/images/financeiroCliente.png' title='Alterar Pessoa'/></a></td>";
                     
                    this.ret +='</tr>';
                    
                    if (clas === '#E2EBCC') {
                clas = '#FFFFFF';
            } else {
                clas = '#E2EBCC';
            }
                    }
                    
                    
                    jQuery("table #um").hide();
                    //jQuery("#resul tbody").reload(this.ret);
                    //jQuery('#resul tbody').append( this.ret ).reload();
                    jQuery('#resul').html( this.ret );
                   //mudaConteudo('app/view/gridNf.php?teste=' + this.ret); 
                       
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

<div id="datagrid">
    <h1>CADASTRO DE CLIENTE</h1>
    <hr>
    <tr>
        <td id="button"><input type="submit" value="Novo" name="button"  onclick="javascript:mudaConteudo('app/view/forCliente.php');"/></td>

    </tr>
    <fieldset>
        <form name="form1" method="post" action="" id="tr">
            <tr>
                <td>CLIENTE:</td>
                <td><input type="text" id="busca" name="busca" value="" size="100" class="effect"  onkeyup="up(this)" /></td>
                <td id="button"><input type="submit" value="Procurar" name="button" /></td>
            </tr>
            <tr></tr>
        


        <table class="tabela">
            <tr class="linha">
                <td width="35">ALT..</td>
                <td>ID</td>
                <td>NOME</td>
                <td>ENDEREÇO</td>
                <td>NUMERO</td>
                <td>TEL. RESIDEN.</td>
                <td>CEL. PESSOAL</td>
                <td>CIDADE</td>
                <td>UF</td>
                <td width="35">FINAN.</td>
            </tr>
            <tbody id="resul">
            <?php
            //$pessoa = $_REQUEST['cli'];
           // echo $pessoa; 

            //echo "grupo = $idgrupo - sub = $idsubgrupo";
            require("../../app/model/conexao/Conexao.php");
            require("../../app/model/sql/DBPessoa.php");
            require("../../app/model/Pessoa.php");
            
          /* $idpessoa = $_GET['idpessoa'];
           //$idpessoa = $cliente->getIDpessoa(); 
           echo "id - $idpessoa";exit();
           */
          $cliente = new Pessoa();
          $busca = $cliente->getIDpessoa();
           // echo 'nome'.$busca;
            
            $dbpessoa = new DBPessoa();
          
          if (empty($busca)) {
                $pessoa = $dbpessoa->selectAll();
            } else {
           
                $pessoa = $dbpessoa->selectBUSCA();
                echo "busca".$pessoa->getBusca();
            }
            ?>
                 </tbody>
        </table>
</form>
    </fieldset>

</div>