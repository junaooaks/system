<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
             
            //$('.delete').click(function () {

            if (confirm('DESEJA REALMENTE FECHAR')) {
    
                jQuery.ajax({ 
                    title: "WebCom",
                    type: "POST",  
                    url: "app/controller/controllerFinanceiro.php",  
                    data: dados,  
                    success: function( data )  
                    {  
                        alert( data );  
                    
                    } 
                
                });
                //  }
            };
  
            return false;  
        });  
    });
    
  
</script> 

<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tl').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST", 
                url: "app/controller/controllerFinanceiro.php",  
                data: dados,
                
                success: function( data )  
                {   
                    alert(data);
						
                    //$('#nomeAvalista').html(data.nome);
                    
                   arr = data.split('|');
                        
                    //idpessoa,nome,renda,limiteCredito,ativo
                     
                    arr[0] = arr[0].substring(1,(arr[0],20));
                    arr[4] = arr[4].substring(0,(arr[4].length - 1));
                    //idpessoa,nome,renda,limiteCredito,ativo
                  // for(i in data) document.write(data[i].idpessoa+"\n");
                   
                    
                    jQuery('#codAvalista')    .val( arr[0] );
                    jQuery('#nomeAvalista')   .val( arr[1] );
                    jQuery('#rendaAvalista')  .val( arr[2] );
                    jQuery('#ativoAvalista')  .val( arr[3] );
                    jQuery('#credAvalista')   .val( arr[4] );
                    
                    
                   
                }  
                
            }); 
        
            return false;  
        });  
    });

</script> 



<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
<link type="text/css" href="resources/css/jquery-ui-1.8.21.custom.css" rel="stylesheet"/>
<script type="text/javascript" src="js/addnfs.js"></script>
<script type="text/javascript">
    $(document).ready(function()     {
      
        $('#auto').autocomplete(
        {
        
            source: "app/view/cliente.php",
            minLength: 1
        });
    });

</script>


<script type="text/javascript">
   
    $(document).ready(function()     {
      
        $('.auto').autocomplete(
        {
            source: "app/view/buscaProduto.php",
            minLength: 1
        });
    });
  
</script>

<div id="datagrid">
    <table width="100%">
        <tr>
            <td style="width:90%;"><h1>FINANCEIRO CLIENTE</h1></td>
            <td id="voltar"><a href="#" class="voltar" onclick="javascript:mudaConteudo('app/view/gridCliente.php');"><img src="resources/images/voltar.png" /></a>
            </td>
        </tr>
    </table>
    <hr>
    <fieldset>
        <p>
            <?php
            $idpessoa = $_GET['idpessoa'];

            require("../../app/model/conexao/Conexao.php");
            require("../../app/model/modelFinanceiro.php");
            require("../../app/model/sql/DBFinanceiro.php");

            if (!empty($idpessoa)) {

                //inserir dados no banco de daodos
                $fin = new modelFinanceiro();
                $fin->setCodCliente($idpessoa);

                //inserir dados no banco de daodos
                $dbfin = new DBFinanceiro();
                $dbfin = $dbfin->select($fin);

                $renda = $fin->getRendaFixa();
                $avalista = $fin->getNomeAvalista();
                $codavalista = $fin->getCodAvalista();
                $codcliente = $fin->getCodCliente();
                $nomecliente = $fin->getNomeCliente();
                $cep = $fin->getCep();
                $endereco = $fin->getEndereco();
                $bairro = $fin->getBairro();
                $cidade = $fin->getCidade();
                $numero = $fin->getNumero();
                $limite = $fin->getLimiteCredito();
                $ativo = $fin->getAtivo();
                $dataavaliacao = $fin->getDataAvaliacao();

                $credPessoa = $fin->getCredPessoa();
                $codFinanceiro = $fin->getCodFinanceiro();
                $obs = $fin->getObs();
                $serasa = $fin->getSerasa();
                $spc = $fin->getSpc();
                $moradia = $fin->getMoradia();
                $endCobranca = $fin->getEnderecoCobranca();
                $dataCobranca = $fin->getDataCobranca();
                $rendaFixa = $fin->getRendaFixaCliente();
                $banco1 = $fin->getBanco1();
                $banco2 = $fin->getBanco2();
                $banco3 = $fin->getBanco3();
                $comer1 = $fin->getComer1();
                $comer2 = $fin->getComer2();
                $comer3 = $fin->getComer3();
                $comer4 = $fin->getComer4();
                $comer5 = $fin->getComer5();
                
                if ($ativo == 0) {
                    $status = 'DESATIVADO - FALE COM ADMINISTRADOR';
                }
                if ($ativo == 1) {
                    $status = 'ATIVADO - LIBERADO';
                }
                if ($ativo == 2) {
                    $status = 'PENDENCIA FINANCEIRA- FALE COM ADMINISTRADOR';
                }
                if ($ativo == 3) {
                    $status = 'CLIENTE SEM ANALISE DE CREDITO';
                }
                if ($ativo == 4) {
                    $status = 'CLIENTE COM ANALISE VENCIDO';
                }
            }
            ?>   
        </p>
        <form method="POST" action="" id="tl" name="formu">
            <tr id="tr"> 
                <td>Avalista Nome:</td>
                <td><input name="busca" type="text" id="auto" class="effect" value="" size="92" onkeyup="up(this)" /> <input type="submit" name="consulta" value="Consultar" class="effect" id="consultar" onclick="clicado=true" ></td>
                </td></tr> 
        </form>

        <form method="GET" action="" id="tr" name="custo">
            <!--tr id="tr"> 
                 <td>Custo Produto:</td>
                 <td><input name="custopro" type="text" id="auto" class="effect" value="" size="92" onkeyup="up(this)" /> <input type="submit" name="consulta" value="Consultar" class="effect" id="consultar"></td></td>
                 
         </tr--> 
            <h1>STATUS AVALISTA:
                <input name="status" type="text" class="effect" id="ativoAvalista" value="<?php if(!empty($codavalista)){echo $status;} ?>" size="80" readonly="readonly"/>
                <br />
            </h1>
            <hr />
            <h1>DADOS DO AVALISTA</h1>
            <table border="0">
                <hr />
                <tr>
                    <td>Codig.</td>
                    <td><input name="codAvalista" type="text" class="effect" id="codAvalista" onkeyup="up(this)" value="<?php echo $codavalista; ?>" size="10" readonly="readonly"/></td>
                    <td>Nome :</td>
                    <td colspan="3"><input name="nomeAvalista" type="text" class="effect" id="nomeAvalista" value="<?php echo $avalista; ?>" size="80" readonly="readonly"/></td>
                </tr>
                <tr>
                    <td>Renda:</td>
                    <td><input name="rendaAvalista" type="text" id="rendaAvalista" class="effect" id="frete" onkeyup="up(this)"  value="<?php echo $renda; ?>" size="10" maxlength="10" readonly="readonly" /></td>
                    <td>Limite de Cred.:</td>
                    <td colspan="3"><input name="credAvalista" type="text" class="effect" id="credAvalista" onkeyup="up(this)" value="<?php echo $limite; ?>" size="80" readonly="readonly" /></td>
                </tr>

            </table>
            <h1>DADOS DO CLIENTE</h1>
            <table border="0">
                <hr />
                <tr>
                    <td>Codig.</td>
                    <td><input name="codCliente" type="text" class="effect" id="idcusto" onkeyup="up(this)" value="<?php echo $codcliente; ?>" size="10" readonly="readonly"/></td>
                    <td>Nome :</td>
                    <td colspan="3"><input name="nomeCliente" type="text" class="effect" id="pis_confins" value="<?php echo $nomecliente; ?>" size="80" readonly="readonly"/></td>
                </tr>
                <tr>
                    <td>CEP:</td>
                    <td><input name="cep" type="text" class="effect" id="frete" onkeyup="up(this)"  value="<?php echo $cep; ?>" size="10" maxlength="10" readonly="readonly"/></td>
                    <td>End..:</td>
                    <td colspan="3"><input name="endereco" type="text" class="effect" id="st" onkeyup="up(this)" value="<?php echo $endereco; ?>" size="80" readonly="readonly"/></td>
                </tr>
                <tr>
                    <td>Cidade:</td>
                    <td><input name="cidade" type="text" class="effect" id="frete_p" onkeyup="up(this)" value="<?php echo $cidade; ?>" size="10" maxlength="10" readonly="readonly"/></td>
                    <td>Bairro:</td>
                    <td><input name="bairro" type="text" class="effect" id="ipi" onkeyup="up(this)" value="<?php echo $bairro; ?>" size="20" readonly="readonly"/></td>
                    <td>N°</td>
                    <td><input name="numero" type="text" class="effect" id="unitario" value="<?php echo $numero; ?>" size="10" maxlength="10" onkeyup="up(this)" readonly="readonly"/></td>
                </tr>
            </table>

            <tr>     <h1>DADOS DE COBRANÇA</h1></tr><hr>
            <table border="0">
                <tr> 
                    <td>Avaliação:</td>
                    <td><input name="dataAvaliacao" type="text" class="effect" id="avaliacao" value="<?php if ($dataavaliacao <> '') {
                echo $dataavaliacao;
            } else {
                echo date('d/m/Y');
            } ?>" size="15" maxlength="10" /></td>
                    <td>Limite de Credito</td>
                    <td colspan="2"><input name="limiteCredito" type="text" class="effect" id="limiteCredito" onKeyUp="up(this)" value="<?php echo $credPessoa; ?>" size="10" maxlength="10" /></td>              
                </tr>
                <tr> 
                    <td >Endere&ccedil;o Cobranca</td>
                    <td colspan="5"><input name="enderecoCobranca" type="text" class="effect" id="rendaFixa" onKeyUp="up(this)" size="80" value="<?php echo $endCobranca; ?>"/></td>
                </tr>
                <tr> 
                    <td>Data Cobranca: </td>
                    <td ><input name="dataCobranca" type="text" class="effect" id="dataCobranca" onKeyUp="up(this)" size="2" maxlength="10" value="<?php echo $dataCobranca; ?>"/></td>
                    <td >Renda Fixa:</td>
                    <td ><input name="rendaFixa" type="text" class="effect" id="dataCobranca2" onKeyUp="up(this)" size="10" maxlength="10" value="<?php echo $rendaFixa; ?>"/></td>
                    <td >&nbsp;</td>
                    <td>&nbsp;</td>
                <tr> 
                    <td> Moradia:</td>
                    <td><select name="moradia" class="effect">
                            <option value="FIXA" <?php if ($moradia == 'FIXA') {
                echo 'selected';
            } ?>>FIXA</option>
                            <option value="ALUGUEL" <?php if ($moradia == 'ALUGUEL') {
                echo 'selected';
            } ?>>ALUGUEL</option>
                            <option value="FAMILIAR" <?php if ($moradia == 'FAMILIAR') {
                echo 'selected';
            } ?>>FAMILIAR</option>
                            <option value="FINANCIADO" <?php if ($moradia == 'FINANCIADO') {
                echo 'selected';
            } ?>>FINANCIADO</option>
                        </select></td>
                    <td>Consulta SPC: </td>
                    <td><select name="spc" id="select3" class="effect">
                            <option value=""></option>
                            <option value="POSITIVO" <?php if ($spc == 'POSITIVO') {
                echo 'selected';
            } ?>>POSITIVO</option>
                            <option value="NEGATIVO" <?php if ($spc == 'NEGATIVO') {
                echo 'selected';
            } ?>>NEGATIVO</option>
                        </select></td>
                    <td>SERASA</td>
                    <td><select name="serasa" id="select3" class="effect">
                            <option value=""></option>
                            <option value="POSITIVO" <?php if ($serasa == 'POSITIVO') {
                echo 'selected';
            } ?>>POSITIVO</option>
                            <option value="NEGATIVO" <?php if ($serasa == 'NEGATIVO') {
                echo 'selected';
            } ?>>NEGATIVO</option>
                        </select></td>
                </tr>
                <tr>
                    <td>Obs:</td>
                    <td colspan="5"><input type="text" class="effect" size="80" name="obs" value="<?php echo $obs; ?>" onkeyup="up(this)"/></td>
                </tr>
            </table>

            <tr>     <h1>REFERENCIA</h1></tr><hr>

            </table>



            <table><tr><td>
                        <table border="0" id="lista">

                            <thead>
                                <tr style="color:#000; font-weight:bold; background:#D9E5F3;">
                                </tr>
                                <tr style="color:#FFF; font-weight:bold; background:#024B78;">
                                    <td align="center">REFERENCIA COMERCIAL</td>

                                </tr>   
                            </thead>

                            <tr>
                            <td><input type="text" name="comer1" size="120" class="effect auto item" onkeyup="up(this)" value="<?php echo $comer1; ?>"/></td></tr>
                            <tr><td><input type="text" name="comer2" size="120" class="effect auto item" onkeyup="up(this)" value="<?php echo $comer2; ?>"/></td></tr>
                            <tr><td><input type="text" name="comer3" size="120" class="effect auto item" onkeyup="up(this)" value="<?php echo $comer3; ?>"/></td></tr>
                            <tr><td><input type="text" name="comer4" size="120" class="effect auto item" onkeyup="up(this)" value="<?php echo $comer4; ?>"/></td></tr>
                            <tr> <td><input type="text" name="comer5" size="120" class="effect auto item" onkeyup="up(this)" value="<?php echo $comer5; ?>"/></td>

                            </tr>
                            <!--input type="hidden" value="1" id="row" name="quantidade_itens" /-->
                            <div id="tmp_name" style="display:none;"></div>

                        </table>

                    </td>
                </tr>






                <tr>
                    <td>
                        <table border="0" id="lista">
                            <thead>
                                <tr style="color:#000; font-weight:bold; background:#D9E5F3;">

                                </tr>
                                <tr style="color:#FFF; font-weight:bold; background:#024B78;">
                                    <td align="center">REFERENCIA BANCARIA</td>

                                </tr>   
                            </thead>

<tr>
                    <td><input type="text" name="banco1" size="120" class="effect auto item" onkeyup="up(this)" value="<?php echo $banco1; ?>"/></td></tr>
                    <tr><td><input type="text" name="banco2" size="120" class="effect auto item" onkeyup="up(this)" value="<?php echo $banco2; ?>"/></td></tr>
                   <tr><td><input type="text" name="banco3" size="120" class="effect auto item" onkeyup="up(this)" value="<?php echo $banco3; ?>"/></td>
                   
                </tr>
                            <input type="hidden" value="<?php echo $codFinanceiro; ?>" name="codFinanceiro" />
                            <div id="tmp_name" style="display:none;"></div>

                        </table>

                    </td>
                </tr>
                <tr>

                    <td  colspan="2" align="center"><input type="submit" name="button2" id="button2"  class="delete"  value="Fechar" /></td>
                </tr>
            </table>    

        </form>

    </fieldset>

</div>