<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerFuncionarioAcesso.php",  
                data: dados,  
                success: function( data )  
                {  
                    alert( data );  
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
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
<link type="text/css" href="resources/css/jquery-ui-1.8.21.custom.css" rel="stylesheet"/>


<div id="datagrid">
    <table width="100%">
        <tr>
            <td style="width:90%;"><h1>CADASTRO DE PERMISSÕES</h1></td>
            <td id="voltar"><a href="#" class="voltar" onclick="javascript:mudaConteudo('app/view/gridFuncionario.php');"><img src="resources/images/voltar.png" /></a>
            </td>
        </tr>
    </table>







    <hr />

    <fieldset>
        <?php
        $idpessoa = $_GET['idfun'];

        require("../../app/model/conexao/Conexao.php");
        require("../../app/model/sql/DBFuncionarioAcesso.php");
        //require("../../app/model/modelFuncionario.php");
        require("../../app/model/modelFuncionarioAcesso.php");

        //echo "grupo = $idgrupo - sub = $idsubgrupo";

        if (!empty($idpessoa)) {
            //inserir dados no banco de daodos
            $pessoa = new modelFuncionarioAcesso();
            $pessoa->setIDFun($idpessoa);

            //inserir dados no banco de daodos
            $dbpessoa = new DBFuncionarioAcesso();
            $dbpessoa = $dbpessoa->select($pessoa);


            $idfun = $pessoa->getIDFun();
            $nome = $pessoa->getNome();
            $sexo = $pessoa->getSexo();
            $cpf = $pessoa->getCpf();
            $identidade = $pessoa->getIdentidade();
            $pis = $pessoa->getPis();

            $civil = $pessoa->getCivil();
            $pai = $pessoa->getPai();
            $mae = $pessoa->getMae();
            $usuario = $pessoa->getLogin();
            $idusuario = $pessoa->getIDUsuarios();
            $nivel    = $pessoa->getAcesso();
            $idacesso = $pessoa->getIDUsuarios();
           
        }
        ?>
        <form method="POST" action="" id="tr">
            <thead>
            <table border="0">
                <h1>DADOS PESSOAIS</h1><hr>
                <tr> 
                    <td>Nome:</td>
                    <td colspan="5"><input name="nome" type="text" class="effect" id="nome" value="<?php echo $nome; ?>" size="92" maxlength="150" onkeyup="up(this)" readonly="true"/></td>
                </tr>
                </thead>
                <tbody>
                    <tr> 
                        <td>Pai:</td>
                        <td colspan="5"><input name="pai" type="text" class="effect" id="pai" value="<?php echo $pai; ?>" size="92" maxlength="200" onkeyup="up(this)" readonly="true"/> 
                        </td>
                    <tr> 
                        <td>Mãe:</td>
                        <td colspan="5"><input name="mae" type="text" class="effect" id="mae" value="<?php echo $mae; ?>" size="92" maxlength="200" onkeyup="up(this)" readonly="true"/> 
                        </td>
                    </tr>

                    <tr> 
                        <td>Cpf:</td>
                        <td><input name="cpf" type="text" class="effect" id="cpf" value="<?php echo $cpf; ?>" size="40" maxlength="14" readonly="true" /> 
                        </td>
                        <td align="right">Pis:</td>
                        <td colspan="3"><input name="pis" type="text" class="effect" id="pis" value="<?php echo $pis; ?>" size="32" maxlength="14" readonly="true"/></td>
                    </tr>

                    <tr> 
                        <td>Identidad:</td>
                        <td><input name="identidade" type="text" class="effect" id="identidade" value="<?php echo $identidade; ?>" size="40" maxlength="200" onkeyup="up(this)" readonly="true"/></td>
                        <td align="right">Estado Civil:</td>
                        <td><select name="civil" class="effect" id="civil">
                                <option value="CASADO" <?php
        if ($civil == 'CASADO') {
            echo "selected";
        }
        ?>>CASADO</option>
                                <option value="SOLTEIRO" <?php
                                        if ($civil == 'SOLTEIRO') {
                                            echo "selected";
                                        }
        ?>>SOLTEIRO</option>
                                <option value="VIUVO"<?php
                                        if ($civil == 'VIUVO') {
                                            echo "selected";
                                        }
        ?>>VIUVO</option>
                                <option value="DISQUITADO"<?php
                                        if ($civil == 'DISQUITADO') {
                                            echo "selected";
                                        }
        ?>>DISQUITADO</option>
                            </select></td>
                        <td>Sexo:</td>
                        <td><input type="radio" name="sexo" value="M" class="effect" <?php
                                        if ($sexo == "M") {
                                            echo "checked";
                                        }
        ?>>
                            M 
                            <input type="radio" name="sexo" value="F" class="effect" <?php
                                   if ($sexo == "F") {
                                       echo "checked";
                                   }
        ?>>
                            F </td>
                    </tr>
            </table>
            <input type="hidden" name="idfun" value="<?php echo $idpessoa; ?>" />
            <input name="idacesso" type="hidden" id="idacesso" value="<?php echo $idacesso; ?>" />
<h1>DADOS DE LOGIN</h1><hr>
            <table border="0">
                <tr>
                    <td width="58">Usuário:</td>
                    <td><input name="usuario" type="text" class="effect" id="usuario" value="<?php echo $usuario; ?>" size="20" maxlength="20"/></td>
                    <td>Senha:</td>
                    <td><input name="senha" type="text" class="effect" id="senha" maxlength="20"/></td>
                    <td>Repete Senha:</td>
                    <td><input name="repete" type="text" class="effect" id="repete" size="20" maxlength="20"/></td>
                </tr>
            </table>

            <h1>NIVEL PERMISSÃO</h1><hr>
            <table border="0">
              <tr>
                <td width="367"><table width="367" border="0">
                  <tr>
                    <td>ADMINISTRAÇÃO:</td>
                    <td>EMPRESAS</td>
                    <td><input name="acesso[]" type="checkbox" id="empresas3" value="100" class="effect" <?php if(in_array('100', $nivel)) echo "checked='checked'"; ?>/></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>SETORES </td>
                    <td><input name="acesso[]" type="checkbox" id="setores3" value="101" class="effect" <?php if(in_array('101', $nivel)) echo "checked='checked'"; ?>/></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>FUNCIONARIOS </td>
                    <td><input name="acesso[]" type="checkbox" id="funcionarios3" value="102" class="effect" <?php if(in_array('102', $nivel)) echo "checked='checked'"; ?>/></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>PARAMETRO </td>
                    <td><input name="acesso[]" type="checkbox" id="parametro3" value="103" class="effect" <?php if(in_array('103', $nivel)) echo "checked='checked'"; ?>/></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>LOG </td>
                    <td><input name="acesso[]" type="checkbox" id="log3" value="104" class="effect" <?php if(in_array('104', $nivel)) echo "checked='checked'"; ?>/></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>CONDIÇÃO DE PG </td>
                    <td><input name="acesso[]" type="checkbox" id="condicaopg" value="105" class="effect" <?php if(in_array('105', $nivel)) echo "checked='checked'"; ?>/></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>OPERAÇÕES </td>
                    <td><input name="acesso[]" type="checkbox" id="operacoes" value="106" class="effect" <?php if(in_array('106', $nivel)) echo "checked='checked'"; ?>/></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>CONEXÕES DB </td>
                    <td><input name="acesso[]" type="checkbox" id="condicaopg3" value="107" class="effect" <?php if(in_array('107', $nivel)) echo "checked='checked'"; ?>/></td>
                  </tr>
                </table></td>
                <td width="388" valign="top"><table width="385" border="0">
                  <tr>
                    <td width="117">CADASTROS:</td>
                    <td width="207">PESSOAS</td>
                    <td width="20"><input name="acesso[]" type="checkbox" id="condicaopg4" value="200" class="effect" <?php if(in_array('200', $nivel)) echo "checked='checked'"; ?>/></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>FORNECEDOR/VENDEDOR</td>
                    <td><input name="acesso[]" type="checkbox" id="condicaopg5" value="202" class="effect" <?php if(in_array('202', $nivel)) echo "checked='checked'"; ?>/></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>PRODUTOS</td>
                    <td><input name="acesso[]" type="checkbox" id="produto" value="206" class="effect" <?php if(in_array('206', $nivel)) echo "checked='checked'"; ?>/></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>GRUPO PESSOAS</td>
                    <td><input name="acesso[]" type="checkbox" id="condicaopg7" value="205" class="effect" <?php if(in_array('205', $nivel)) echo "checked='checked'"; ?>/></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>GRUPO/SUB-GRUPO PRODUTOS </td>
                    <td><input name="acesso[]" type="checkbox" id="condicaopg6" value="203" class="effect" <?php if(in_array('203', $nivel)) echo "checked='checked'"; ?>/></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>MARCAS</td>
                    <td><input name="acesso[]" type="checkbox" id="condicaopg8" value="204" class="effect" <?php if(in_array('204', $nivel)) echo "checked='checked'"; ?>/></td>
                  </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td>UNIDADE MEDIDA</td>
                    <td><input name="acesso[]" type="checkbox" id="unidade" value="207" class="effect" <?php if(in_array('207', $nivel)) echo "checked='checked'"; ?>/></td>
                  </tr>
                </table></td>
              </tr>
          </table> 
          <hr />
          <table border="0">
            <tr>
              <td width="367" valign="top"><table width="367" border="0">
                <tr>
                  <td>MOVIMENTAÇÕES:</td>
                  <td>NOTA DE ENTRADA</td>
                  <td><input name="acesso[]" type="checkbox" id="empresas" value="300" class="effect" <?php if(in_array('300', $nivel)) echo "checked='checked'"; ?>/></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>NOTA DE SAIDA</td>
                  <td><input name="acesso[]" type="checkbox" id="nfs" value="301" class="effect" <?php if(in_array('301', $nivel)) echo "checked='checked'"; ?>/></td>
                </tr>
              </table></td>
              <td width="381"><table width="385" border="0">
                <tr>
                  <td width="117">FINANCEIRO:</td>
                  <td width="237">CONTAS A RECEBER</td>
                  <td width="17"><input name="acesso[]" type="checkbox" id="contareceber" value="400" class="effect" <?php if(in_array('400', $nivel)) echo "checked='checked'"; ?>/></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>CONTAS A PAGAR</td>
                  <td><input name="acesso[]" type="checkbox" id="contapagar" value="401" class="effect" <?php if(in_array('401', $nivel)) echo "checked='checked'"; ?>/></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>CAIXA</td>
                  <td><input name="acesso[]" type="checkbox" id="caixa" value="403" class="effect" <?php if(in_array('403', $nivel)) echo "checked='checked'"; ?>/></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>CONTA BANCARIA</td>
                  <td><input name="acesso[]" type="checkbox" id="contabanco" value="404" class="effect" <?php if(in_array('404', $nivel)) echo "checked='checked'"; ?> /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>CHEQUES</td>
                  <td><input name="acesso[]" type="checkbox" id="cheques" value="405" class="effect" <?php if(in_array('405', $nivel)) echo "checked='checked'"; ?>/></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <hr />
          <table width="752" border="0">
 
      <tr> 
          <td>RELATORIOS:</td>
          </tr>
      <tr> 
          <td><div align="center">
            <input type="submit" name="Submit" value="Cadastrar"/>
          </div></td>
      
</table>
           
            <tr> </tr>
        </form>

    </fieldset>

</div>