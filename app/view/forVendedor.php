<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerVendedor.php",  
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

    <h1>CADASTRO VENDEDOR</h1>
    <hr>
    <fieldset>
        <?php
        $idvendedor = $_GET['idvendedor'];

        require("../../app/model/conexao/Conexao.php");
        require("../../app/model/sql/DBVendedor.php");
        require("../../app/model/modelVendedor.php");




        //echo "grupo = $idgrupo - sub = $idsubgrupo";


        if (!empty($idvendedor)) {
            //inserir dados no banco de daodos
            $vendedor = new modelVendedor();
            $vendedor->setIDVendedor($idvendedor);

            //inserir dados no banco de daodos
            $dbvendedor = new DBVendedor();
            $dbvendedor = $dbvendedor->select($vendedor);
            $idvendedor = $vendedor->getIDVendedor();
            $nome = $vendedor->getNome();
            $cpfCnpj = $vendedor->getCpfcnpj();
            $identidade = $vendedor->getIdentidade();
            $endereco = $vendedor->getEndereco();
            $complementar = $vendedor->getComplementar();
            $numero = $vendedor->getNumero();
            $bairro = $vendedor->getBairro();
            $cep = $vendedor->getCep();
            $cidade = $vendedor->getCidade();
            $uf = $vendedor->getUf();
            $email = $vendedor->getEmail();
            $site = $vendedor->getSite();
            $sexo = $vendedor->getSexo();
            

            $telcom = $vendedor->getTelcom();
            if (!empty($telcom)) {
                $dddcom = $telcom[1] . $telcom[2];
                $prefixocom = $telcom[5] . $telcom[6] . $telcom[7] . $telcom[8];
                $telcom = $telcom[10] . $telcom[11] . $telcom[12] . $telcom[13];
            }
            $telres = $vendedor->getTelres();
            if (!empty($telres)) {
                $dddres = $telres[1] . $telres[2];
                $prefixores = $telres[5] . $telres[6] . $telres[7] . $telres[8];
                $telres = $telres[10] . $telres[11] . $telres[12] . $telres[13];
            }
            $celcom = $vendedor->getCelcom();
            if (!empty($celcom)) {
                $dddcelcom = $celcom[1] . $celcom[2];
                $prefixocelcom = $celcom[5] . $celcom[6] . $celcom[7] . $celcom[8];
                $celcom = $celcom[10] . $celcom[11] . $celcom[12] . $celcom[13];
            }
            $celres = $vendedor->getCelres();
            if (!empty($celres)) {
                $dddcelres = $celres[1] . $celres[2];
                $prefixocelres = $celres[5] . $celres[6] . $celres[7] . $celres[8];
                $celres = $celres[10] . $celres[11] . $celres[12] . $celres[13];
            }

            $nascimento = $vendedor->getDatanascimento();
            $nasc = explode("-", $nascimento);

            //$empresa=$pessoa->getData();
        }
        ?>     
        <form method="POST" action="" id="tr">


            <table border="0">
                <h1>DADOS PESSOAIS</h1>
                <hr>
                <tr> 
                    <td width="80">Nome:</td>
                    <td colspan="3"><input name="nome" type="text" class="effect" id="nome" value="<?php echo $nome; ?>" size="92" maxlength="150" onkeyup="up(this)" /></td>
                </tr>
                <tr> 
                    <td>Cpf / Cnpj</td>
                    <td><input name="cpfCnpj" type="text" class="effect" id="cpfCnpj" value="<?php echo $cpfCnpj; ?>" size="40" maxlength="14" /> 
                    </td>
                    <td width="75" align="right">Data Nasc.:</td>
                    <td><input name="dianas" type="text" size="5" maxlength="2" value="<?php echo $nasc[2]; ?>" class="effect">
                        / 
                        <input name="mesnas" type="text" size="5" maxlength="2" value="<?php echo $nasc[1]; ?>" class="effect">
                        / 
                        <input name="anonas" type="text" size="10" maxlength="4" value="<?php echo $nasc[0]; ?>" class="effect"></td>
                </tr>
                <tr> 
                    <td>Insc./Identid.:</td>
                    <td><input name="identidade" type="text" class="effect" id="identidade" value="<?php echo $identidade; ?>" size="40" maxlength="200" onkeyup="up(this)"/></td>
                    <td width="75" align="right">Sexo:</td>
                    <td> 
                        <input type="radio" name="sexo" value="M" class="effect" <?php if ($sexo == "M") {
            echo "checked";
        } ?>>
                        M 
                        <input type="radio" name="sexo" value="F" class="effect" <?php if ($sexo == "F") {
            echo "checked";
        } ?>>
                        F </td>
                </tr>
            </table>   
            <tr>     <h1>LOCALIZAÇÃO</h1><hr></tr>  

            <table border="0">

                <tr> 
                    <td width="80">Site Pessoal:</td>
                    <td colspan="5"><input name="site" type="text" class="effect" value="<?php echo $site; ?>" size="92" maxlength="150" /></td>
                </tr>
                <tr> 
                    <td width="80">Email:</td>
                    <td colspan="5"><input name="email" type="text" class="effect" value="<?php echo $email; ?>" size="92" maxlength="150" /></td>
                </tr>
                <tr> 
                    <td width="80">Endereço:</td>
                    <td><input name="endereco" type="text" class="effect" value="<?php echo $endereco; ?>" size="40" maxlength="200" onkeyup="up(this)"/> 
                    </td>
                    <td> N.: </td>
                    <td><input name="numero" type="text" class="effect" value="<?php echo $numero; ?>" size="10" maxlength="20" onkeyup="up(this)"/></td>
                    <td>Bairro:</td>
                    <td><input name="bairro" type="text" class="effect" value="<?php echo $bairro; ?>" size="20" maxlength="150" onkeyup="up(this)"/></td>
                </tr>
                <tr> 
                    <td width="80">Comple.:</td>
                    <td colspan="5"><input name="complementar" type="text" class="effect" id="complementar" value="<?php echo $complementar; ?>" size="92" maxlength="150" onkeyup="up(this)"/> 
                    </td>
                </tr>
                <tr> 
                    <td width="80">Cidade:</td>
                    <td><input name="cidade" type="text" class="effect" value="<?php echo $cidade; ?>" size="40" maxlength="100" onkeyup="up(this)"/></td>
                    <td>UF:</td>
                    <td><input name="uf" type="text" class="effect" id="uf" value="<?php echo $uf; ?>" size="10" maxlength="2" onkeyup="up(this)"/></td>
                    <td>Cep:</td>
                    <td><input name="cep" type="text" class="effect" value="<?php echo $cep; ?>" size="20" maxlength="20" /></td>
                </tr>
                <tr> 
                    <td width="80">Telefone:</td>
                    <td>( 
                        <input name="ddd" type="text" id="ddd" size="5" maxlength="2" class="effect" value="<?php echo $dddres; ?>">
                        ) 
                        <input name="prefixo" type="text" id="prefixo" size="7" maxlength="4" class="effect" value="<?php echo $prefixores; ?>">
                        - 
                        <input name="telefone" type="text" id="telefone" size="7" maxlength="4" class="effect" value="<?php echo $telres; ?>"> 
                    <td>Cel.</td>
                    <td colspan="3">( 
                        <input name="dddcel" type="text" id="ddd3" size="5" maxlength="2" class="effect" value="<?php echo $dddcelres; ?>">
                        ) 
                        <input name="prefixocel" type="text" id="prefixo3" size="7" maxlength="4" class="effect" value="<?php echo $prefixocelres; ?>">
                        - 
                        <input name="telefonecel" type="text" id="telefone-cel" size="7" maxlength="4" class="effect" value="<?php echo $celres; ?>"></td>
                </tr>
                <tr> 
                    <td width="80">Telefone:</td>
                    <td>( 
                        <input name="dddcom" type="text" id="ddd-com" size="5" maxlength="2" class="effect" value="<?php echo $dddcom; ?>">
                        ) 
                        <input name="prefixocom" type="text" id="prefixo-com" size="7" maxlength="4" class="effect" value="<?php echo $prefixocom; ?>">
                        - 
                        <input name="telefonecom" type="text" id="telefone-com" size="7" maxlength="4" class="effect" value="<?php echo $telcom; ?>"></td>
                    <td>Cel.</td>
                    <td colspan="3">( 
                        <input name="dddcel2" type="text" id="ddd3" size="5" maxlength="2" class="effect" value="<?php echo $dddcelcom; ?>">
                        ) 
                        <input name="prefixocel2" type="text" id="prefixo3" size="7" maxlength="4" class="effect" value="<?php echo $prefixocelcom; ?>">
                        - 
                        <input name="telefonecel2" type="text" id="telefone-cel2" size="7" maxlength="4" class="effect" value="<?php echo $celcom; ?>"></td>
                <tr align="center"> 
                    <td colspan="6"> 
                        <input type="hidden" name="idvendedor" value="<?php echo $idvendedor; ?>" />
                        <input type="submit" name="Submit" value="Cadastrar"/>
                    </td>


            </table>
        </form>

    </fieldset>

</div>

