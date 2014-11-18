<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerFuncionario.php",  
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
        
            $.post("app/view/combo2.php",
            {idgrupo:$(this).val()},
            function(valor){
                $("select[name=subgrupo]").html(valor);
            }
        )
        })
    })
</script>

<div id="datagrid">
    <h1>CADASTRO DE FUNCIONÁRIO</h1>
    <hr>
    <fieldset>
        <?php
        $idpessoa = $_GET['idfun'];
           
        require("../../app/model/conexao/Conexao.php");
        require("../../app/model/sql/DBFuncionario.php");
        require("../../app/model/modelFuncionario.php");

        //echo "grupo = $idgrupo - sub = $idsubgrupo";

        if (!empty($idpessoa)) {
            //inserir dados no banco de daodos
            $pessoa = new modelFuncionario();
            $pessoa->setIDFuncionario($idpessoa);

            //inserir dados no banco de daodos
            $dbpessoa = new DBFuncionario();
            $dbpessoa = $dbpessoa->select($pessoa);


            $idfun     = $pessoa->getIDFuncionario();
            $idsetor   = $pessoa->getIDSetor();
            $idempresa = $pessoa->getIDEmpresa();
            $nome      = $pessoa->getNome();
            $sexo      = $pessoa->getSexo();
            $cpf       = $pessoa->getCpf();
            $identidade= $pessoa->getIdentidade();
            $pis       = $pessoa->getPis();
            $email     = $pessoa->getEmail();
            $civil     = $pessoa->getCivil();
            $nasc      = $pessoa->getDatanascimento();
            $pai       = $pessoa->getPai();
            $mae       = $pessoa->getMae();
            $endereco  = $pessoa->getEndereco();
            $bairro    = $pessoa->getBairro();
            $cep       = $pessoa->getCep();
            $cidade    = $pessoa->getCidade();
            $estado    = $pessoa->getUf();
            $numero    = $pessoa->getNumero();
            $telres    = $pessoa->getTelres();
            $celcom    = $pessoa->getCelcom();
            $celres    = $pessoa->getCelres();
            $valor     = $pessoa->getValor();
            $comissao  = $pessoa->getComissao();
            $profissao = $pessoa->getProfissao();
            $setor     = $pessoa->getSetor();
            $empresa   = $pessoa->getEmpresa();

            if (!empty($telres)) {
                $dddres = $telres[1] . $telres[2];
                $prefixores = $telres[5] . $telres[6] . $telres[7] . $telres[8];
                $telres = $telres[10] . $telres[11] . $telres[12] . $telres[13];
            }
            if (!empty($celcom)) {
                $dddcelcom = $celcom[1] . $celcom[2];
                $prefixocelcom = $celcom[5] . $celcom[6] . $celcom[7] . $celcom[8];
                $celcom = $celcom[10] . $celcom[11] . $celcom[12] . $celcom[13];
            }
            if (!empty($celres)) {
                $dddcelres = $celres[1] . $celres[2];
                $prefixocelres = $celres[5] . $celres[6] . $celres[7] . $celres[8];
                $celres = $celres[10] . $celres[11] . $celres[12] . $celres[13];
            }

 
            $nas = explode("-", $nasc);
            $data = $nas[2] . "/" . $nas[1] . "/" . $nas[0];
        }
        
        ?>   
        <form method="POST" action="" id="tr">
            <thead>
            <table border="0">
                <h1>DADOS PESSOAIS</h1><hr>
                <tr> 
                    <td>Nome:</td>
                    <td colspan="5"><input name="nome" type="text" class="effect" id="nome" value="<?php echo $nome; ?>" size="92" maxlength="150" onkeyup="up(this)" /></td>
                </tr>
                </thead>
                <tbody>
                    <tr> 
                        <td>Pai:</td>
                        <td colspan="5"><input name="pai" type="text" class="effect" id="pai" value="<?php echo $pai; ?>" size="92" maxlength="200" onkeyup="up(this)"/> 
                        </td>
                    <tr> 
                        <td>Mãe:</td>
                        <td colspan="5"><input name="mae" type="text" class="effect" id="mae" value="<?php echo $mae; ?>" size="92" maxlength="200" onkeyup="up(this)"/> 
                        </td>
                    </tr>

                    <tr> 
                        <td>Cpf:</td>
                        <td><input name="cpf" type="text" class="effect" id="cpf" value="<?php echo $cpf; ?>" size="40" maxlength="14" /> 
                        </td>
                        <td align="right">Pis:</td>
                        <td colspan="3"><input name="pis" type="text" class="effect" id="pis" value="<?php echo $pis; ?>" size="32" maxlength="14" /></td>
                    </tr>

                    <tr> 
                        <td>Identidad:</td>
                        <td><input name="identidade" type="text" class="effect" id="identidade" value="<?php echo $identidade; ?>" size="40" maxlength="200" onkeyup="up(this)"/></td>
                        <td align="right">Estado Civil:</td>
                        <td><select name="civil" class="effect" id="civil">
                                <option value="CASADO" <?php if ($civil == 'CASADO') {
            echo "selected";
        } ?>>CASADO</option>
                                <option value="SOLTEIRO" <?php if ($civil == 'SOLTEIRO') {
            echo "selected";
        } ?>>SOLTEIRO</option>
                                <option value="VIUVO"<?php if ($civil == 'VIUVO') {
            echo "selected";
        } ?>>VIUVO</option>
                                <option value="DISQUITADO"<?php if ($civil == 'DISQUITADO') {
            echo "selected";
        } ?>>DISQUITADO</option>
                            </select></td>
                        <td>Sexo:</td>
                        <td><input type="radio" name="sexo" value="M" class="effect" <?php if ($sexo == "M") {
            echo "checked";
        } ?>>
                            M 
                            <input type="radio" name="sexo" value="F" class="effect" <?php if ($sexo == "F") {
            echo "checked";
        } ?>>
                            F </td>
                    </tr>
            </table>     
            <table border="0">
                <tr>     <h1>LOCALIZAÇÃO</h1><hr></tr>
                <tr> 
                    <td>Email:</td>
                    <td><input name="email" type="text" class="effect" value="<?php echo $email; ?>" size="40" maxlength="150" /></td>
                    <td colspan="2" align="right">Data Nasc.:</td>
                    <td colspan="2"><input name="dianas" type="text" size="5" maxlength="2" value="<?php echo $nas[2]; ?>" class="effect" />
                        /
                        <input name="mesnas" type="text" size="5" maxlength="2" value="<?php echo $nas[1]; ?>" class="effect" />
                        /
                        <input name="anonas" type="text" size="5" maxlength="4" value="<?php echo $nas[0]; ?>" class="effect" /></td>
                </tr>
                </thead>
                <tbody>
                    <tr> 
                        <td>Endereço:</td>
                        <td><input name="endereco" type="text" class="effect" value="<?php echo $endereco; ?>" size="40" maxlength="200" onkeyup="up(this)"/> 
                        </td>
                        <td> N°.: </td>
                        <td><input name="numero" type="text" class="effect" value="<?php echo $numero; ?>" size="10" maxlength="20" onkeyup="up(this)"/></td>
                        <td>Bairro:</td>
                        <td><input name="bairro" type="text" class="effect" value="<?php echo $bairro; ?>" size="20" maxlength="150" onkeyup="up(this)"/></td>
                    </tr>


                    <tr> 
                        <td>Cidade:</td>
                        <td><input name="cidade" type="text" class="effect" value="<?php echo $cidade; ?>" size="40" maxlength="100" onkeyup="up(this)"/></td>
                        <td>UF:</td>
                        <td><input name="uf" type="text" class="effect" id="uf" value="<?php echo $estado; ?>" size="10" maxlength="2" onkeyup="up(this)"/></td>
                        <td>Cep:</td>
                        <td><input name="cep" type="text" class="effect" value="<?php echo $cep; ?>" size="20" maxlength="20" /></td>
                    </tr>
                    <tr> 
                        <td>Tel.Res.</td>
                        <td>(
                            <input name="ddd" type="text" id="ddd" size="5" maxlength="2" class="effect" value="<?php echo $dddres; ?>">
                            ) 
                            <input name="prefixo" type="text" id="prefixo" size="7" maxlength="4" class="effect" value="<?php echo $prefixores; ?>">
                            -
                            <input name="telefone" type="text" id="telefone" size="7" maxlength="4" class="effect" value="<?php echo $telres; ?>"></td>
                        <td>Cel.</td>
                        <td colspan="3">( 
                            <input name="dddcel" type="text" id="ddd3" size="5" maxlength="2" class="effect" value="<?php echo $dddcelres; ?>">
                            ) 
                            <input name="prefixocel" type="text" id="prefixo3" size="7" maxlength="4" class="effect" value="<?php echo $prefixocelres; ?>">
                            - 
                            <input name="telefonecel" type="text" id="telefone-cel" size="7" maxlength="4" class="effect" value="<?php echo $celres; ?>"></td>
                    </tr>
                    <tr> 


                        <td>Cel 2.</td>
                        <td>(
                            <input name="dddcel2" type="text" id="ddd2" size="5" maxlength="2" class="effect" value="<?php echo $dddcelcom; ?>" />
                            )
                            <input name="prefixocel2" type="text" id="prefixo2" size="7" maxlength="4" class="effect" value="<?php echo $prefixocelcom; ?>" />
                            -
                            <input name="telefonecel2" type="text" id="telefone-cel2" size="7" maxlength="4" class="effect" value="<?php echo $celcom; ?>" /></td>
                        <td>&nbsp;</td>
                        <td colspan="3">&nbsp;</td>
                </tbody>
            </table>
            <tr>     <h1>PROFISSÃO</h1><hr></tr>      
            <table border="0">
                <tr> 
                    <td>Data Cadastro:</td>
                    <td><input name="datacadastro" type="text" class="effect" id="avaliacao" value="<?php if ($dataupdate <> '') {
            echo $dataupdate;
        } else {
            echo date('d/m/Y');
        } ?>" size="15" maxlength="10" /></td>
                    <td colspan="3">Comissionado:
                      <input type="radio" name="comissao" id="radio" value="s" <?php if ($comissao=='s'){echo "checked='checked'";}?> />
                        <label for="comissao">Sim 
                            <input name="comissao" type="radio" id="radio2" value="n"  <?php if ($comissao=='n'){echo "checked='checked'";}?> />
                            Não
                    </label>                      Valor %: 
                    <input name="valor" type="text" class="effect" id="valor" value="<?php echo $valor; ?>" size="20" maxlength="150" onkeyup="up(this)"/></td>
                </tr>
                <tr>

                    <td>Profissão:</td>
                    <td colspan="4"><input name="profissao" type="text" class="effect" id="profissao" value="<?php echo $profissao; ?>" size="92" maxlength="150" onkeyup="up(this)"/></td>
                </tr>
                <tr> 
                    <td>Empresa:</td>
                    <td><select name="grupo" id="grupo" class="effect">
                            <?php
                            if(empty ($idempresa)){echo "<option value=''>ESCOLHA...</option>";}
                            //echo "ss $subgrupo";
                            $dbfun = new DBFuncionario();
                            $pessoa = $dbfun->selectEmpresa($idempresa);
                            //selected
                            ?>
                        </select> </td>
                        
                    <td>Setor: <select name="subgrupo" id="subgrupo" class="effect">
                            <option value="">ESCOLHA...</option>
<?php 
  if(empty($idsetor)){echo "<option value=''>ESCOLHA...</option>";}
  //echo "ss $subgrupo";
  $dbsub = new DBFuncionario();
  $subgrupo = $dbsub->selectSetor($idsetor);
  //selected
  ?> 

                    </select></td>
                </tr>
                <tr align="center"> <input type="hidden" name="idfuncionario" value="<?php echo $idfun; ?>" />
                <td colspan="4"><input type="submit" name="Submit" value="Cadastrar"/></td>
                </tr> 
            </table>

        </form>

    </fieldset>

</div>