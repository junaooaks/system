<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST", 
                url: "app/controller/controllerPeca.php",  
                data: dados,  
                success: function( data )  
                {   
                    //cadastra = document.getElementById('cadastrar')
                    
                        alert(data); 
                    
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
<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tl').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST", 
                url: "app/controller/controllerPeca.php",  
                data: dados,  
                success: function( data )  
                {   
                        arr = data.split('|');
                        arr[0] = arr[0].substring(1,(arr[0],20));
                        arr[11] = arr[11].substring(0,(arr[11].length - 1));
                    
                        jQuery('#idcusto')    .val( arr[0] );
                        jQuery('#unitario')   .val( arr[1] );
                        jQuery('#st')         .val( arr[2] );
                        jQuery('#ipi')        .val( arr[3] );
                        jQuery('#frete')      .val( arr[4] );
                        jQuery('#frete_p')    .val( arr[5] );
                        jQuery('#pis_confins').val( arr[6] );
                        jQuery('#ircs')       .val( arr[7] );
                        jQuery('#lucro')      .val( arr[8] );
                        jQuery('#preco_venda').val( arr[9] );
                        jQuery('#preco_custo').val( arr[10]);
                        jQuery('#comissao')   .val( arr[11]);
                   
                    
                   
                    
                }  
            }); 
        
            return false;  
        });  
    });

</script> 

<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript" src="js/money.js" charset="utf-8"></script>
<link type="text/css" href="resources/css/jquery-ui-1.8.21.custom.css" rel="stylesheet"/>
<script type="text/javascript">
    $(document).ready(function()     {
      
        $('#auto').autocomplete(
        {
        
            source: "app/view/ajax.php",
            minLength: 1
        });
    });

</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("select[name=grupo]").change(function(){
            $("select[name=subgrupo]").html('<option value="0">Carregando...</option>');
        
            $.post("app/view/combo.php",
            {idgrupo:$(this).val()},
            function(valor){
                $("select[name=subgrupo]").html(valor);
            }
        )
        })
    })
</script>
<script type="text/javascript">

function calculateSum() {

            
            var valor_uni = parseFloat(document.getElementById("unitario").value);
            var st        = parseFloat(document.getElementById("st").value);
            var ipi       = parseFloat(document.getElementById("ipi").value);
            var frete_p   = parseFloat(document.getElementById("frete_p").value);
            var frete     = parseFloat(document.getElementById("frete").value);
            
            //frete valor %
            frete_p = frete_p / 100;
            st      = st / 100;
            ipi     = ipi / 100;
            
            precocusto = ( valor_uni * (1+st+ipi+frete_p)) + frete;
            
            document.getElementById("custo").value = precocusto;
           
    }
    
    function calculateLucro(){
        
        var venda    = parseFloat(document.getElementById("preco_venda").value);
        //var lucro    = parseFloat(document.getElementById("lucro").value);
        var comissao = parseFloat(document.getElementById("comissao").value);
        var ircs     = parseFloat(document.getElementById("ircs").value);
        var pis      = parseFloat(document.getElementById("pis").value);
        var custo    = parseFloat(document.getElementById("custo").value);
        
        comissao = comissao / 100;
        ircs = ircs / 100;
        pis = pis / 100;
        
        
        preco = ((venda * 0.85) - ((venda * 0.85) *(comissao + ircs + pis )+ custo)) / (venda * 0.85);
        //arredonda casa decimal
        lucro = ((Math.round(preco * 100)));
        
        document.getElementById("lucro").value = lucro;
    }
	
	
</script>
<script type="text/javascript">
$(".soma").maskMoney({symbol:'', showSymbol:true, thousands:'', decimal:'.', symbolStay: true});
</script>

<div id="datagrid">
     <table width="100%">
        <tr>
            <td style="width:90%;"><h1>CADASTRO PEÇAS</h1></td>
            <td id="voltar"><a href="#" class="voltar" onclick="javascript:mudaConteudo('app/view/gridPeca.php');"><img src="resources/images/voltar.png" /></a>
            </td>
        </tr>
    </table>
    <hr>
    <fieldset>
        <?php
        $idpeca = $_GET['idpeca'];

        require("../../app/model/conexao/Conexao.php");
        require("../../app/model/ModelPeca.php");
        require("../../app/model/GrupoPessoa.php");

        require("../../app/model/sql/DBPeca.php");
        require("../../app/model/SubGrupoPessoa.php");


        //echo "grupo = $idgrupo - sub = $idsubgrupo";


        if (!empty($idpeca)) {

            //inserir dados no banco de daodos
            $peca = new ModelPeca();
            $peca->setIDPeca($idpeca);

            //inserir dados no banco de daodos
            $dbpeca = new DBPeca();
            $dbpeca = $dbpeca->select($peca);
            $idpeca = $peca->getIDPeca();
            $idcusto = $peca->getIDCusto();
            $idgrupo = $peca->getIDGrupo();
            $idsubgrupo = $peca->getIDSubgrupo();
            $idmarca = $peca->getIDMarca();
            $idfornecedor = $peca->getIDFornecedor();
            $idunidade = $peca->getIDUnidade();
            $idempresa = $peca->getIDEmpresa();


            $valoruni = $peca->getUnitario();
            $st = $peca->getSt();
            $ipi = $peca->getIpi();
            $frete = $peca->getFrete();
            $fretep = $peca->getFretep();
            $precocusto = $peca->getPrecocusto();
            $piscon = $peca->getPisconfins();
            $ircs = $peca->getIrcs();
            $lucro = $peca->getLucro();
            $precovenda = $peca->getPrecovenda();
            $comissao = $peca->getComissao();

            $status = $peca->getStatus();
            $codfabricante = $peca->getCodfabricante();
            $codead = $peca->getCodean();
            $nomeproduto = $peca->getDescricao();

            $classificado = $peca->getClassificacao();
            $fracionavel = $peca->getFracionavel();
            $localizacao = $peca->getLocalizacao();
            $pesobruto = $peca->getPesobruto();
            $pesoliquido = $peca->getPesoliquido();
            $estoqueatual = $peca->getEstoqueatual();
            $estoqueminimo = $peca->getEstoqueminimo();
            $estoquemaximo = $peca->getEstoquemaximo();
            $marca = $peca->getMarca();
            $dataAteracao = $peca->getDataAlteracao();
            $codmang = $peca->getCodMang();
        }
        ?>   

        <form method="POST" action="" id="tl" name="formu">
            <tr id="tr"> 
                <td>Custo Produto:</td>
                <td><input name="custopro" type="text" id="auto" class="effect" value="" size="92" onkeyup="up(this)" /> <input type="submit" name="consulta" value="Consultar" class="effect" id="consultar" onclick="clicado=true" ></td></td>

            </tr> 
        </form>
        <form method="POST" action="" id="tr" name="custo">

            <h1>CUSTO</h1>
            <table border="0">

                <hr>
                <tr>
                    <td>Data Atual:</td>
                    <td><input name="dataAtual" type="text" class="effect" id="dataAtual" onkeyup="up(this)" value="<?php echo date("d/m/Y"); ?>" size="10" readonly="true" /></td>
                    <td>Data Alteração:</td>
                    <td><input name="dataAlteracao" type="text" class="effect" id="dataAlteracao" value="<?php echo $dataAlteracao; ?>" size="10" readonly="true"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>ID Custo:</td>
                    <td><input name="idcusto" type="text" class="effect" id="idcusto" value="<?php echo $idcusto; ?>" size="10" maxlength="10" readonly="true"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td> 
                    
                <tr>
                    <td>Valor Uni.:</td>
                    <td><input name="unitario" type="text" class="effect soma" id="unitario" onkeyup="up(this)" value="<?php echo $valoruni; if(empty($valoruni)){echo '0.00';} ?>" size="10" maxlength="10" onBlur="calculateSum();"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td> 
                </tr>
                <tr> 
                    <td>ST:</td>
                    <td><input name="st" type="text" class="effect" id="st" value="<?php echo $st; if(empty($st)){echo '0.00';} ?>" onkeyup="up(this)"  value="<?php echo $st; ?>" size="10" maxlength="10" onBlur="calculateSum();"/></td>
                    <td>IPI:</td>
                    <td><input name="ipi" type="text" class="effect" id="ipi" onkeyup="up(this)" value="<?php echo $ipi; if(empty($ipi)){echo '0.00';} ?>" size="10" maxlength="10" onBlur="calculateSum();"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr> 
                    <td>Frete:</td>
                    <td><input name="frete" type="text" class="effect soma" id="frete" onkeyup="up(this)" value="<?php echo $frete; if(empty($ipi)){echo '0.00';}?>" size="10" maxlength="10" onBlur="calculateSum();"/> 
                    </td>
                    <td>Frete %:</td>
                    <td><input name="frete_p" type="text" class="effect " id="frete_p" onkeyup="up(this)" value="<?php echo $fretep; if(empty($ipi)){echo '0.00';}?>" size="10" maxlength="10" onBlur="calculateSum();"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                <tr> 
                    <td>Preço Custo:</td>
                    <td><input name="preco_custo" type="text" class="effect soma" id="custo" value="<?php echo $precocusto; if(empty($precocusto)){echo '0.00';}?>" size="10" maxlength="10" onkeyup="up(this)" onBlur="calculateLucro();"/> 
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr> 
                    <td>Ircs ll.:</td>
                    <td><input name="ircs" type="text" class="effect soma" id="ircs" value="<?php echo $ircs; if(empty($ircs)){echo '0.00';}?>" size="10" maxlength="10" onkeyup="up(this)" onBlur="calculateLucro();"/> 
                    </td>
                    <td>Comissão:</td>
                    <td><input name="comissao" type="text" class="effect soma" id="comissao" value="<?php echo $comissao; if(empty($comissao)){echo '0.00';}?>" size="10" maxlength="10" onkeyup="up(this)" onBlur="calculateLucro();"/></td>
                    <td>Pis Confins:</td>
                    <td><input name="pis_confins" type="text" class="effect soma" id="pis" value="<?php echo $piscon; if(empty($piscon)){echo '0.00';}?>" size="10" maxlength="10" onkeyup="up(this)" onBlur="calculateLucro();"/></td>
                </tr>
                <tr> 
                    <td>Preço Venda:</td>
                    <td><input name="preco_venda" type="text" class="effect soma" id="preco_venda" value="<?php echo $precovenda; if(empty($precovenda)){echo '0.00';}?>" size="10" maxlength="10" onBlur="calculateLucro();"/> 
                    </td>
                    <td>Lucro:</td>
                    <td><input name="lucro" type="text" class="effect" id="lucro" value="<?php echo $lucro; if(empty($lucro)){echo '0.00';}?>" size="10" maxlength="10" onkeyup="up(this)"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table> 
<tr>     <h1>RELACIONAMENTO</h1><hr></tr>

            <table border="0">
                <tr> 
                    <td>Grupo:</td>
                    <td><select name="grupo" id="grupo" class="effect">

<?php
if (empty($idgrupo)) {
    echo "<option value=''>ESCOLHA...</option>";
}
//echo "ss $subgrupo";
$dbGrupoPessoa = new DBPeca();
$pessoa = $dbGrupoPessoa->selectGrupo($idgrupo);
//selected
?>
                        </select> </td>
                    <td>Sub-Grupo:</td>

                    <td> <select name="subgrupo" id="subgrupo" class="effect">
                            <option value="">ESCOLHA...</option>
                            <?php
                            if (empty($idsubgrupo)) {
                                echo "<option value=''>ESCOLHA...</option>";
                            }
                            //echo "ss $subgrupo";
                            $dbsub = new DBPeca();
                            $subgrupo = $dbsub->selectSubGrupo($idsubgrupo);
                            //selected
                            ?> 

                        </select></td>
                </tr></thead>
                <tbody>
                    <tr> 
                        <td width="80">Marca:</td>

                        <td><select name="marca" id="marca" class="effect">

                                <?php
                                if (empty($idmarca)) {
                                    echo "<option value=''>ESCOLHA...</option>";
                                }
                                //echo "ss $subgrupo";
                                //if(!empty ($idmarca)){echo "<option value='$idmarca'>".$marca."</option>";}
                                $dbmarca = new DBPeca();
                                $pessoa = $dbmarca->selectMarca($idmarca);
                                ?>
                            </select> </td>
                        <td>Fornecedor:</td>
                        <td><select name="fornecedor" id="select2" class="effect">
                                <option value="">ESCOLHA...</option>
                                <?php
                                if (empty($idfornecedor)) {
                                    echo "<option value=''>ESCOLHA...</option>";
                                }
                                //echo "ss $subgrupo";
                                $dbfornecedor = new DBPeca();
                                $for = $dbfornecedor->selectFornecedor($idfornecedor);
                                ?>
                            </select> </td>
                    </tr>
                    <tr> 
                        <td width="80">Unidade:</td>
                        <td><select name="unidade" id="select2" class="effect">
                                <?php
                                if (empty($idunidade)) {
                                    echo "<option value=''>ESCOLHA...</option>";
                                }
                                //echo "ss $subgrupo";
                                $dbunidade = new DBPeca();
                                $medida = $dbunidade->selectUnidade($idunidade);
                                ?>
                            </select></td>
                        <td>Custo:</td>
                        <td><input name="custo" type="text" class="effect" id="custo" value="<?php echo $precocusto; ?>" size="10" maxlength="10" /></td>
                    </tr>
                    <tr> 
                        <td width="80">Empresa:</td>
                        <td colspan="3"><select name="empresa" id="select4" class="effect">
                                <?php
                                if (empty($idempresa)) {
                                    echo "<option value=''>ESCOLHA...</option>";
                                }
                                //echo "ss $subgrupo";
                                $dbempresa = new DBPeca();
                                $empresa = $dbempresa->selectEmpresa($idempresa);
                                ?>
                            </select></td>
                    </tr>
                </tbody>
            </table>
            <tr>     <h1>DESCRIÇÃO</h1><hr></tr>      
            <table border="0">
                <tr> 
                    <td>Status:</td>
                    <td colspan="3"><input type="radio" name="status" value="1" class="effect" <?php if ($status == '1') {
                                    echo "checked='checked'";
                                } ?>>
                        Ativado <input type="radio" name="status" value="0" class="effect" <?php if ($status == '0') {
                                    echo "checked='checked'";
                                } ?>>
                        Desativado</td>
                    <td>Cod.Mang.:</td>
                    <td><input name="codmang" type="text" class="effect" value="<?php echo $codmang; ?>" size="15"/></td>
                    
                </tr>
                <tr> 
                    <td>CodFabricante:</td>
                    <td><input name="codfabricante" type="text" class="effect" id="odfabricante9" value="<?php echo $codfabricante; ?>" size="15" /></td>
                    <td>Cod EAN:</td>
                    <td><input name="codean" type="text" class="effect" id="codean2" value="<?php echo $codead; ?>" size="15" /></td>
                    <td>Data Cadastro:</td>
                    <td><input name="datacadastro" type="text" class="effect" id="datacadastro" value="<?php
                        if ($dataupdate <> '') {
                            echo $dataupdate;
                        } else {
                            echo date('d/m/Y');
                        }
                                ?>" size="15" maxlength="10" /></td>
                </tr>
                <tr> 
                    <td>Descrição:</td>
                    <td colspan="5"><input name="descricao" type="text" class="effect" id="empresa" value="<?php echo $nomeproduto; ?>" size="92" maxlength="150" onkeyup="up(this)"/></td>
                </tr>
                <tr> 
                    <td>Classificação:</td>
                    <td><input name="classificacao" type="text" class="effect" id="odfabricante4" value="<?php echo $classificado; ?>" size="15" /></td>
                    <td>Fracionavel:</td>
                    <td><input name="fracionavel" type="text" class="effect" id="odfabricante5" value="<?php echo $fracionavel; ?>" size="15" /></td>
                    <td>Localização:</td>
                    <td><input name="localizacao" type="text" class="effect" id="odfabricante6" value="<?php echo $localizacao; ?>" size="15" /></td>
                </tr>
                <tr> 
                    <td>Peso Bruto:</td>
                    <td><input name="pesobruto" type="text" class="effect" id="odfabricante7" value="<?php echo $pesobruto; ?>" size="15" /></td>
                    <td>Peso Liquido:</td>
                    <td><input name="pesoliquido" type="text" class="effect" id="odfabricante8" value="<?php echo $pesoliquido; ?>" size="15" /></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr> 
                    <td>Estoque Atual:</td>
                    <td><input name="estoqueatual" type="text" class="effect" id="pesobruto" value="<?php echo $estoqueatual; ?>" size="15" /></td>
                    <td>Estoque Mini.:</td>
                    <td><input name="estoqueminimo" type="text" class="effect" id="estoqueminimo" value="<?php echo $estoqueminimo; ?>" size="15" /></td>
                    <td>Estoque Max.:</td>
                    <td><input name="estoquemaximo" type="text" class="effect" id="pesobruto3" value="<?php echo $estoquemaximo; ?>" size="15" /></td>
                </tr>
                <tr align="center"> 
                <input type="hidden" name="idpeca" value="<?php echo $idpeca; ?>" />
                <td colspan="5"><input type="submit" name="cadastrar" value="Cadastrar" class="effect" id="cadastrar"></td>
                </tr>
            </table>

        </form>

    </fieldset>

</div>

