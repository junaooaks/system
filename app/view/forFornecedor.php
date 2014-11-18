<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerFornecedor.php",  
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
    <h1>CADASTRO FORNECEDOR</h1>
    <hr>
    <fieldset>
        <?php
        $idfornecedor = $_GET['idfornecedor'];

        require("../../app/model/conexao/Conexao.php");
        require("../../app/model/sql/DBFornecedor.php");
        require("../../app/model/modelFornecedor.php");




        //echo "grupo = $idgrupo - sub = $idsubgrupo";


        if (!empty($idfornecedor)) {
            //inserir dados no banco de daodos
            $for = new modelFornecedor();
            $for->setIDFornecedor($idfornecedor);

            //inserir dados no banco de daodos
            $dbfor = new DBFornecedor();
            $dbfor = $dbfor->select($for);
            
            $idfor=$for->getIDFornecedor();
            $idvendedor=$for->getIDVendedor();
            $cnpj=$for->getCnpj();
            $ie=$for->getIe();
            $numero = $for->getNumero();
            $endereco=$for->getEndereco();
            $bairro=$for->getBairro();
            $cep=$for->getCep();
            $cidade=$for->getCidade();
            $uf=$for->getUf();

            $telcom=$for->getTelcom();
                if(!empty($telcom)){
                    $dddcom = $telcom[1].$telcom[2];
                    $prefixocom= $telcom[5].$telcom[6].$telcom[7].$telcom[8];
                    $telcom = $telcom[10].$telcom[11].$telcom[12].$telcom[13];
                }
            $telres=$for->getTelres();
                if(!empty($telres)){
                    $dddres = $telres[1].$telres[2];
                    $prefixores= $telres[5].$telres[6].$telres[7].$telres[8];
                    $telres = $telres[10].$telres[11].$telres[12].$telres[13];
                }
            $celcom=$for->getCelcom();
                if(!empty($celcom)){
                    $dddcelcom = $celcom[1].$celcom[2];
                    $prefixocelcom= $celcom[5].$celcom[6].$celcom[7].$celcom[8];
                    $celcom = $celcom[10].$celcom[11].$celcom[12].$celcom[13];
                }
            $celres=$for->getCelres();
                if(!empty($celres)){
                    $dddcelres = $celres[1].$celres[2];
                    $prefixocelres= $celres[5].$celres[6].$celres[7].$celres[8];
                    $celres = $celres[10].$celres[11].$celres[12].$celres[13];
                }
            
            $email=$for->getEmail();
            $site = $for->getSite();
            //$empresa=$pessoa->getData();


            $nome = $for->getNome();
            //echo "ss $subgrupo";
            
        } 
        ?>   
        <form method="POST" action="" id="tr">
            <thead>
            <table border="0">
                <h1>DADOS PESSOAIS</h1><hr>
                
                <tr> 
                    <td>Empresa:</td>
                    <td><input name="nome" type="text" class="effect" id="nome" value="<?php echo $nome; ?>" size="40" maxlength="150" onkeyup="up(this)" /></td>
                <td colspan="3">Vendedor:<select name="idvendedor" class="effect">
                            

                            <?php
                            if (empty($idvendedor)){echo "<option value=''</option>";}
                            require("../../app/model/sql/DBVendedor.php");
                            require("../../app/model/modelVendedor.php");

                            
                            //echo "ss $subgrupo";
                            $dbvendedor = new DBVendedor();
                            $vendedor = $dbvendedor->selectSEL($idvendedor);
                            ?>

                        </select></td>
                
                
                </tr>
                    <tr> 
                        <td>Cnpj</td>
                        <td><input name="cnpj" type="text" class="effect" id="cnpj" value="<?php echo $cnpj; ?>" size="40" maxlength="14" /> 
                        </td>
                        <td width="7" align="right">I.E.:</td>
                        <td><input name="ie" type="text" class="effect" id="ie" value="<?php echo $ie; ?>" size="20" maxlength="200" onkeyup="up(this)"/></td>  </tr>

            </table>     
            <table border="0">
                <tr>     <h1>LOCALIZAÇÃO</h1><hr></tr>

                <tr> 
                    <td width="80">Site:</td>
                    <td colspan="5"><input name="site" type="text" class="effect" value="<?php echo $site;?>" size="92" maxlength="150" /></td>
                </tr>
                <tr> 
                    <td width="80">Email:</td>
                    <td colspan="5"><input name="email" type="text" class="effect" value="<?php echo $email;?>" size="92" maxlength="150" /></td>
                </tr>
                </thead>
                <tbody>
                    <tr> 
                        <td width="80">Endereço:</td>
                        <td><input name="endereco" type="text" class="effect" value="<?php echo $endereco;?>" size="40" maxlength="200" onkeyup="up(this)"/> 
                        </td>
                        <td> N.: </td>
                        <td><input name="numero" type="text" class="effect" value="<?php echo $numero;?>" size="10" maxlength="20" onkeyup="up(this)"/></td>
                        <td>Bairro:</td>
                        <td><input name="bairro" type="text" class="effect" value="<?php echo $bairro;?>" size="20" maxlength="150" onkeyup="up(this)"/></td>
                    </tr>
                    <tr> 
                        <td width="80">Cidade:</td>
                        <td><input name="cidade" type="text" class="effect" value="<?php echo $cidade;?>" size="40" maxlength="100" onkeyup="up(this)"/></td>
                        <td>UF:</td>
                        <td><input name="uf" type="text" class="effect" id="uf" value="<?php echo $uf;?>" size="10" maxlength="2" onkeyup="up(this)"/></td>
                        <td>Cep:</td>
                        <td><input name="cep" type="text" class="effect" value="<?php echo $cep;?>" size="20" maxlength="20" /></td>
                    </tr>
                    <tr> 
                        <td width="80">Telefone.</td>
                        <td>(
                            <input name="ddd" type="text" id="ddd" size="5" maxlength="2" class="effect" value="<?php echo $dddres; ?>">
                            ) 
                            <input name="prefixo" type="text" id="prefixo" size="7" maxlength="4" class="effect" value="<?php echo $prefixores; ?>">
                            -
                            <input name="telefone" type="text" id="telefone" size="7" maxlength="4" class="effect" value="<?php echo $telres; ?>"></td>
                        <td>Telefone.</td>
                        <td colspan="3">( 
                            <input name="dddcel" type="text" id="ddd3" size="5" maxlength="2" class="effect" value="<?php echo $dddcelres;?>">
                            ) 
                            <input name="prefixocel" type="text" id="prefixo3" size="7" maxlength="4" class="effect" value="<?php echo $prefixocelres; ?>">
                            - 
                            <input name="telefonecel" type="text" id="telefone-cel" size="7" maxlength="4" class="effect" value="<?php echo $celres;?>"></td>
                    </tr>
                    <tr> 


                        <td width="80">Celular.</td>
                        <td>(
                            <input name="dddcom" type="text" id="ddd-com" size="5" maxlength="2" class="effect" value="<?php echo $dddcom;?>">
                            ) 
                            <input name="prefixocom" type="text" id="prefixo-com" size="7" maxlength="4" class="effect" value="<?php echo $prefixocom;?>">
                            -
                            <input name="telefonecom" type="text" id="telefone-com" size="7" maxlength="4" class="effect" value="<?php echo $telcom;?>"></td>
                        <td>Celular.</td>
                        <td colspan="3">( 
                            <input name="dddcel2" type="text" id="ddd3" size="5" maxlength="2" class="effect" value="<?php echo $dddcelcom; ?>">
                            ) 
                            <input name="prefixocel2" type="text" id="prefixo3" size="7" maxlength="4" class="effect" value="<?php echo $prefixocelcom;?>">
                            - 
                            <input name="telefonecel2" type="text" id="telefone-cel2" size="7" maxlength="4" class="effect" value="<?php echo $celcom;?>"></td>
                    </tr>
                    <tr>
                    <tr align="center"> <input type="hidden" name="idfornecedor" value="<?php echo $idfor; ?>" />
                    <td colspan="5"><input type="submit" name="Submit" value="Cadastrar"/></td>
                </tr> 
                    </tr>
                </tbody>
            </table>
            
        </form>

    </fieldset>

</div>

