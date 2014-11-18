<script type="text/javascript"> 
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize(); 
            jQuery.ajax({ 
                title: "Geral",
                type: "POST",
                url: "app/controller/controllerPeca.php",  
                data: dados,
                dataType: 'json',
                success: function( data )  {
                    //alert(data);
                   
                    this.ret = '';
                    var clas = '#E2EBCC';
                    for(i in data){ 
                    this.ret +='<tr style=background:'+clas+'>';
                    //<td align='center'><a href=" . "javascript:mudaConteudo('app/view/forNF.php?idnf=" . $row['idnotaEntrada'] . "')" . "><img src='resources/images/lapis_alterar.png' title='Alterar Pessoa'/></a></td>
          
                    //href="."javascript:mudaConteudo('app/view/forNF.php?idnf=" . . "')" . "
                    //idproduto,descricao,estoqueAtual,localizacao, status
                    this.ret +="<td align=center><a href="+"javascript:mudaConteudo('app/view/forPeca.php?idpeca="+(data[i].idproduto)+"')"+"><img src='resources/images/lapis_alterar.png' title='Alterar Pessoa'/></a></td>";
                    this.ret +='<td>'+(data[i].idproduto)+'</td>';
                    this.ret +='<td>'+(data[i].codproduto)+'</td>';
                    this.ret +='<td>'+(data[i].descricao)+'</td>';
                    this.ret +='<td>'+(data[i].estoqueAtual)+'</td>';
                    this.ret +='<td>'+(data[i].localizacao)+'</td>';
                    this.ret +='<td>'+(data[i].status)+'</td>';
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
    <h1>CADASTRO PEÇAS</h1>
    <hr>
    <tr>
        <td id="button"><input type="submit" value="Novo" name="button"  onclick="javascript:mudaConteudo('app/view/forPeca.php');"/></td>

    </tr>
    <fieldset>
        <form name="form1" method="post" action="" id="tr">
            <tr>
                <td>PRODUTO:</td>
                <td><input type="text" id="busca" name="busca" value="" size="100" class="effect"  onkeyup="up(this)" /></td>
                <td id="button"><input type="submit" value="Procurar" name="button" /></td>
            </tr>
            <tr></tr>
       


        <table class="tabela">
            <tr class="linha">
                <td width="35">ALT..</td>
                <td width="35">ID</td>
                <td width="80">COD MANG.</td>
                <td>DESCRIÇÃO</td>
                <td>QUANT...</td>
                <td>LOCALIZAÇÃO</td>
                <td>STATUS</td>
            </tr>
            <tbody id="resul">
            <?php
            //$pessoa = $_REQUEST['cli'];
           // echo $pessoa; 

            //echo "grupo = $idgrupo - sub = $idsubgrupo";
            require("../../app/model/conexao/Conexao.php");
            require("../../app/model/sql/DBPeca.php");
            require("../../app/model/ModelPeca.php");
            $dbpeca = new DBPeca();
           
            if (empty($busca)) {
                $peca = $dbpeca->selectAll();
            } else {
                $pessoa = $dbpessoa->selectBUSCA($pessoa);
                echo "busca".$pessoa->getBusca();
            }
            ?>
                </tbody>
        </table>
             </form>
    </fieldset>

</div>