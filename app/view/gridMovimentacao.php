<script type="text/javascript"> 
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize(); 
            jQuery.ajax({ 
                title: "Geral",
                type: "POST",
                url: "app/controller/controllerMovimentacao.php",  
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
                    this.ret +="<td align=center><a href="+"javascript:mudaConteudo('app/view/forMovimentacao.php?idpessoa="+(data[i].idnotaSaida)+"')"+"><img src='resources/images/apply.png' title='Alterar Pessoa'/></a></td>";
                    this.ret +='<td>'+(data[i].nf)+'</td>';
                    this.ret +='<td>'+(data[i].nome)+'</td>';
                    this.ret +='<td>'+(data[i].Data)+'</td>';
                    this.ret +='<td>'+(data[i].valorProdutos)+'</td>';
                    this.ret +='<td>'+(data[i].operacao)+'</td>';
                    this.ret +='<td>'+(data[i].condicaopagamento)+'</td>'; 
                     
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
     <table width="100%">
        <tr>
            <td style="width:90%;"><h1>MOVIMENTAÇÃO DIÁRIA</h1></td>
            <td id="voltar"><?php
            
            $caixa = $_GET['cx'];
            require("../../app/model/conexao/Conexao.php");
            require("../../app/model/sql/DBMovimentacao.php");
            require("../../app/model/modelMovimentacao.php");
            
            // $dbmovimentacao = new modelMovimentacao();
            
            ?></td>
        </tr>
    </table>
    
    <hr>
    
    <fieldset>
        <form name="form1" method="post" action="" id="tr">
            <tr>
                <td>COD NOTA:</td>
                <td><input type="text" id="cod" name="cod" value="" size="20" class="effect"  onkeyup="up(this)" /></td>
                <td>CLIENTE:</td>
                <td><input type="text" id="busca" name="buscaCliente" value="" size="100" class="effect"  onkeyup="up(this)" /></td>
                
                <td id="button"><input type="submit" value="Procurar" name="button" /></td>
            </tr>
            <tr></tr>
        
            <br>

        <table class="tabela">
            <tr class="linha">
                <td width="35" align="center"><img src="resources/images/apply.png"/></td>
                <td>NOTA</td>
                <td>CLIENTE</td>
                <td>DATA DE REGISTRO</td>
                <td>VALOR</td>
                <td>OPERAÇÃO</td>
                <td>COND. PG</td>
            </tr>
            <tbody id="resul">
            <?php
            //$pessoa = $_REQUEST['cli'];
           // echo $pessoa; 

            //echo "grupo = $idgrupo - sub = $idsubgrupo";
           
            
          /* $idpessoa = $_GET['idpessoa'];
           //$idpessoa = $cliente->getIDpessoa(); 
           echo "id - $idpessoa";exit();
           */
          //$mov = new modelMovimentacao();
          //$busca = $mov->getIDpessoa();
           // echo 'nome'.$busca;
            
            $dbmov = new DBMovimentacao();
          
          if (empty($busca)) {
                $diaria = $dbmov->selectAll($caixa);
            } else {
           
                $diaria = $dbmov->selectBUSCA();
               // echo "busca".$mov->getBusca();
            }
            ?>
                 </tbody>
        </table>
</form>
    </fieldset>

</div>