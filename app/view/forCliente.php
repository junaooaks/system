<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerPessoa.php",  
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

<div id="datagrid">
    <table width="100%">
        <tr>
            <td style="width:90%;"><h1>CADASTRO DE CLIENTE</h1></td>
            <td id="voltar"><a href="#" class="voltar" onclick="javascript:mudaConteudo('app/view/gridCliente.php');"><img src="resources/images/voltar.png" /></a>
            </td>
        </tr>
    </table>
    <hr>
    <fieldset>
        <?php
        $idpessoa = $_GET['idpessoa'];

        require("../../app/model/conexao/Conexao.php");
        require("../../app/model/sql/DBPessoa.php");
        require("../../app/model/Pessoa.php");




        //echo "grupo = $idgrupo - sub = $idsubgrupo";


        if (!empty($idpessoa)) {
            //inserir dados no banco de daodos
            $pessoa = new Pessoa();
            $pessoa->setIDpessoa($idpessoa);

            //inserir dados no banco de daodos
            $dbpessoa = new DBPessoa();
            $dbpessoa = $dbpessoa->select($pessoa);

            $idpessoa=$pessoa->getIDpessoa();
            $idtipo=$pessoa->getIDTipo();
            $cpfCnpj=$pessoa->getCpfcnpj();
            $identidade=$pessoa->getIdentidade();

            $endereco=$pessoa->getEndereco();
            $sexo=$pessoa->getSexo();
            $fantasia=$pessoa->getFantasia();
            $numero=$pessoa->getNumero();
            $complementar=$pessoa->getComplementar();
            $bairro=$pessoa->getBairro();
            $cep=$pessoa->getCep();
            $cidade=$pessoa->getCidade();
            $uf=$pessoa->getUf();
            $ref1 = $pessoa->getRef1();
            $ref2 = $pessoa->getRef2();
            $ref3 = $pessoa->getRef3();
            $obs = $pessoa->getObs();

            $telcom=$pessoa->getTelcom();
                if(!empty($telcom)){
                    $dddcom = $telcom[1].$telcom[2];
                    $prefixocom= $telcom[5].$telcom[6].$telcom[7].$telcom[8];
                    $telcom = $telcom[10].$telcom[11].$telcom[12].$telcom[13];
                }
               
            $telres=$pessoa->getTelres();
                if(!empty($telres)){
                    $tel = ereg_replace('[()]','',$telres);
                    
                    $tel = str_replace(' ', '',$tel);
                    
                    $tel = explode('-', $tel);
                    $fone = $tel[0];
                    $fintel = $tel[1];
                    $telres = '('.$fone[0].$fone[1].') '.$fone[2].$fone[3].$fone[4].$fone[5].'-'.$tel[1];
                    
                    //$telres = $tel[0].')'.$tel[1];
                    //echo $telres;
                    
                    $dddres = $telres[1].$telres[2];
                    $prefixores= $telres[5].$telres[6].$telres[7].$telres[8];
                    $telres = $telres[10].$telres[11].$telres[12].$telres[13];
                }
            $celcom=$pessoa->getCelcom();
                if(!empty($celcom)){
                    $dddcelcom = $celcom[1].$celcom[2];
                    $prefixocelcom= $celcom[5].$celcom[6].$celcom[7].$celcom[8];
                    $celcom = $celcom[10].$celcom[11].$celcom[12].$celcom[13];
                }
            $celres=$pessoa->getCelres();
                if(!empty($celres)){
                    $dddcelres = $celres[1].$celres[2];
                    $prefixocelres= $celres[5].$celres[6].$celres[7].$celres[8];
                    $celres = $celres[10].$celres[11].$celres[12].$celres[13];
                }
            
            $email=$pessoa->getEmail();
            $nascimento= $pessoa->getDatanascimento();
            $nasc = explode("-", $nascimento);
            $pai= $pessoa->getPai();
            $mae= $pessoa->getMae();
            $civil=$pessoa->getCivil();
            $profissao=$pessoa->getProfissao();
            $empresa=$pessoa->getEmpresa();
            //$empresa=$pessoa->getData();


            $nome = $pessoa->getNome();
            $ativo = $pessoa->getStatus();
            $registro = $pessoa->getDatainsert();
            $update = $pessoa->getDataupdate();
            //echo "ss $subgrupo";
            
            $update = explode("-", $update);
            $alt = explode(" ",$update[2]);
            $dataupdate = $alt[0]."/".$update[1]."/".$update[0];
        }
        ?>   
        <form method="POST" action="" id="tr">
            <thead>
            <table border="0">
                <h1>DADOS PESSOAIS</h1><hr>
                <tr> 
                    <td width="80">Status:</td>
                    <td colspan="5"><input type="radio" name="status" value="1" class="effect" <?php if ($ativo == 1) {
            echo "checked";
        } ?>>
                        Ativado
                        <input type="radio" name="status" value="0" class="effect" <?php if ($ativo == 0) {
            echo "checked";
        } ?>>
                        Desativado
                        <input type="radio" name="status" value="2" class="effect" <?php if ($ativo == 2) {
            echo "checked";
        } ?>>
                        Pend&ecirc;ncia financeira
                        <input type="radio" name="status" value="3" class="effect" <?php if ($ativo == 3) {
            echo "checked";
        } ?>>
                        Cliente sem analise de credito
                        <input type="radio" name="status" value="4" class="effect" <?php if ($ativo == 4) {
            echo "checked";
        } ?>>
                        Cliente com analise vencido
                        <input type="radio" name="status" value="4" class="effect" <?php if ($ativo == 5) {
            echo "checked";
        } ?>>
                        Cliente especial
                    
                    
                    </td>
                </tr>
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
                        <td>Apelido/Fant.:</td>
                        <td colspan="5"><input name="fantasia" type="text" class="effect" id="fantasia" value="<?php echo $fantasia; ?>" size="92" maxlength="150" onkeyup="up(this)"/> 
                        </td>
                    </tr>

                    <tr> 
                        <td>Cpf / Cnpj</td>
                        <td><input name="cpfCnpj" type="text" class="effect" id="cpfCnpj" value="<?php echo $cpfCnpj; ?>" size="40" maxlength="14" /> 
                        </td>
                        <td align="left">Data Nasc.:</td>
                        <td colspan="3"><input name="dianas" type="text" size="5" maxlength="2" value="<?php echo $nasc[2];?>" class="effect">
                            / 
                            <input name="mesnas" type="text" size="5" maxlength="2" value="<?php echo $nasc[1];?>" class="effect">
                            / 
                            <input name="anonas" type="text" size="10" maxlength="4" value="<?php echo $nasc[0];?>" class="effect"></td>
                    </tr>

                    <tr> 
                        <td>Insc./Identid.:</td>
                        <td><input name="identidade" type="text" class="effect" id="identidade" value="<?php echo $identidade; ?>" size="40" maxlength="200" onkeyup="up(this)"/></td>
                        <td align="left">Estado Civil:</td>
                        <td><select name="civil" class="effect" id="civil">
                                <option value="CASADO" <?php if ($civil=='CASADO'){echo "selected";}?>>CASADO</option>
                                <option value="SOLTEIRO" <?php if ($civil=='SOLTEIRO'){echo "selected";}?>>SOLTEIRO</option>
                                <option value="VIUVO"<?php if ($civil=='VIUVO'){echo "selected";}?>>VIUVO</option>
                                <option value="DISQUITADO"<?php if ($civil=='DISQUITADO'){echo "selected";}?>>DISQUITADO</option>
                            </select></td>
                        <td>Sexo:</td>
                        <td>
                            <input type="radio" name="sexo" value="M" class="effect" <?php if ($sexo=="M"){echo "checked";}?>>
                            M 
                            <input type="radio" name="sexo" value="F" class="effect" <?php if ($sexo=="F"){echo "checked";}?>>
                            F
                            <input type="radio" name="sexo" value="O" class="effect" <?php if ($sexo=="O"){echo "checked";}?>>
                            O
                        </td>
                    </tr>
            </table>     
            <table border="0">
                <tr>     <h1>LOCALIZAÇÃO</h1><hr></tr>


                <tr> 
                    <td>Email:</td>
                    <td colspan="5"><input name="email" type="text" class="effect" value="<?php echo $email;?>" size="92" maxlength="150" /></td>
                </tr>
                </thead>
                <tbody>
                    <tr> 
                        <td>Endereço:</td>
                        <td><input name="endereco" type="text" class="effect" value="<?php echo $endereco;?>" size="40" maxlength="200" onkeyup="up(this)"/> 
                        </td>
                        <td> N.: </td>
                        <td><input name="numero" type="text" class="effect" value="<?php echo $numero;?>" size="10" maxlength="20" onkeyup="up(this)"/></td>
                        <td>Bairro:</td>
                        <td><input name="bairro" type="text" class="effect" value="<?php echo $bairro;?>" size="20" maxlength="150" onkeyup="up(this)"/></td>
                    </tr>
                    <tr> 
                        <td>Comple.:</td>
                        <td colspan="5"><input name="complementar" type="text" class="effect" id="complementar" value="<?php echo $complementar;?>" size="92" maxlength="150" onkeyup="up(this)"/> 
                        </td>
                    </tr>

                    <tr> 
                        <td>Cidade:</td>
                        <td><input name="cidade" type="text" class="effect" value="<?php echo $cidade;?>" size="40" maxlength="100" onkeyup="up(this)"/></td>
                        <td>UF:</td>
                        <td><input name="uf" type="text" class="effect" id="uf" value="<?php echo $uf;?>" size="10" maxlength="2" onkeyup="up(this)"/></td>
                        <td>Cep:</td>
                        <td><input name="cep" type="text" class="effect" value="<?php echo $cep;?>" size="20" maxlength="20" /></td>
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
                            <input name="dddcel" type="text" id="ddd3" size="5" maxlength="2" class="effect" value="<?php echo $dddcelres;?>">
                            ) 
                            <input name="prefixocel" type="text" id="prefixo3" size="7" maxlength="4" class="effect" value="<?php echo $prefixocelres; ?>">
                            - 
                            <input name="telefonecel" type="text" id="telefone-cel" size="7" maxlength="4" class="effect" value="<?php echo $celres;?>"></td>
                    </tr>
                    <tr> 


                        <td>Tel.Com.</td>
                        <td>(
                            <input name="dddcom" type="text" id="ddd-com" size="5" maxlength="2" class="effect" value="<?php echo $dddcom;?>">
                            ) 
                            <input name="prefixocom" type="text" id="prefixo-com" size="7" maxlength="4" class="effect" value="<?php echo $prefixocom;?>">
                            -
                            <input name="telefonecom" type="text" id="telefone-com" size="7" maxlength="4" class="effect" value="<?php echo $telcom;?>"></td>
                        <td>Cel.</td>
                        <td colspan="3">( 
                            <input name="dddcel2" type="text" id="ddd3" size="5" maxlength="2" class="effect" value="<?php echo $dddcelcom; ?>">
                            ) 
                            <input name="prefixocel2" type="text" id="prefixo3" size="7" maxlength="4" class="effect" value="<?php echo $prefixocelcom;?>">
                            - 
                            <input name="telefonecel2" type="text" id="telefone-cel2" size="7" maxlength="4" class="effect" value="<?php echo $celcom;?>"></td>
                
                <tr>
      <td>Obs:</td>
      <td colspan="5"><input type="text" class="effect" size="92" name="obs" value="<?php echo $obs;?>"/></td>
  </tr>
                </tbody>
            </table>
            
            <table border="0" id="lista">
                <thead>
                    <tr style="color:#000; font-weight:bold; background:#D9E5F3;">
                        
                    </tr>
                    <tr style="color:#FFF; font-weight:bold; background:#024B78;">
                        <td align="center">REFERENCIA RESIDENCIAL</td>
                        
                    </tr>   
                </thead>

<tr>
                    <td><input type="text" name="ref1" size="107" class="effect auto item" onkeyup="up(this)" value="<?php echo $ref1;?>"/></td></tr>
                    <tr><td><input type="text" name="ref2" size="107" class="effect auto item" onkeyup="up(this)" value="<?php echo $ref2;?>"/></td></tr>
                   <tr><td><input type="text" name="ref3" size="107" class="effect auto item" onkeyup="up(this)" value="<?php echo ref3;?>"/></td>
                   
                </tr>
                <!--input type="hidden" value="1" id="row" name="quantidade_itens" /-->
                <div id="tmp_name" style="display:none;"></div>
                
            </table>
            
            <tr>     <h1>PROFISSÃO</h1><hr></tr>      
            <table border="0">
                
                <tr>

                    <td>Profissão:</td>
                    <td colspan="2"><input name="profissao" type="text" class="effect" id="profissao" value="<?php echo $profissao;?>" size="40" maxlength="150" onkeyup="up(this)"/></td>
                    <td colspan="3">Grupo:<select name="idgrupo" class="effect">


                            <?php
                            require("../../app/model/sql/DBGrupoPessoa.php");
                            require("../../app/model/GrupoPessoa.php");
                            require("../../app/model/sql/DBSubGrupoPessoa.php");
                            require("../../app/model/SubGrupoPessoa.php");


                            //echo "ss $subgrupo";
                            $dbGrupoPessoa = new DBSubGrupoPessoa();
                            $pessoa = $dbGrupoPessoa->selectSEL();
                            ?>

                        </select></td>
                </tr>
                <tr> 
                    <td>Empresa:</td>
                    <td colspan="5"><input name="empresa" type="text" class="effect" id="empresa" value="<?php echo $empresa;?>" size="92" maxlength="150" onkeyup="up(this)"/></td>
                </tr>
                <tr></tr>
                
                <tr align="center"> <input type="hidden" name="idpessoa" value="<?php echo $idpessoa; ?>" />
                    <td colspan="5"><input type="submit" name="Submit" value="Cadastrar"/></td>
                </tr> 
            </table>

        </form>

    </fieldset>

</div>

