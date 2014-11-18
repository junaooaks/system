<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerEmpresa.php",  
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
    <h1>CADASTRO EMPRESA</h1>
    <hr>
    <fieldset>
        <?php
        $idempresa = $_GET['idempresa'];

        require("../../app/model/conexao/Conexao.php");
        require("../../app/model/sql/DBEmpresa.php");
        require("../../app/model/modelEmpresa.php");



        //echo "grupo = $idgrupo - sub = $idsubgrupo";


        if (!empty($idempresa)) {
            //inserir dados no banco de daodos
            $pessoa = new modelEmpresa();
            $pessoa->setIDEmpresa($idempresa);

            //inserir dados no banco de daodos
            $dbempresa = new DBEmpresa();
            $dbempresa = $dbempresa->select($pessoa);

            $idempresa = $pessoa->getIDEmpresa();
            $cnpj      = $pessoa->getCnpj();
            $endereco  = $pessoa->getEndereco();
            $numero    = $pessoa->getNumero();
            $bairro    = $pessoa->getBairro();
            $cep       = $pessoa->getCep();
            $cidade    = $pessoa->getCidade();
            $uf        = $pessoa->getUf();
            $empresa   = $pessoa->getNome();
            
          
        }
        ?>   
        <form method="POST" action="" id="tr">

            <table border="0">
                <h1>DADOS PESSOAIS</h1><hr>

                <tr> 
                    <td>Empresa:</td>
                    <td colspan="5"><input name="empresa" type="text" class="effect" value="<?php echo $empresa; ?>" size="92" maxlength="150" onkeyup="up(this)" /></td>
                </tr>

                <tr> 
                    <td>Cnpj</td>
                    <td><input name="cpfCnpj" type="text" class="effect" id="cpfCnpj" value="<?php echo $cnpj; ?>" size="40" maxlength="14" /> 
                    </td>
                </tr>


            </table>     
            <table border="0">
                <tr>     <h1>LOCALIZAÇÃO</h1><hr></tr>
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
                    <td width="80">Cidade:</td>
                    <td><input name="cidade" type="text" class="effect" value="<?php echo $cidade; ?>" size="40" maxlength="100" onkeyup="up(this)"/></td>
                    <td>UF:</td>
                    <td><input name="uf" type="text" class="effect" id="uf" value="<?php echo $uf; ?>" size="10" maxlength="2" onkeyup="up(this)"/></td>
                    <td>Cep:</td>
                    <td><input name="cep" type="text" class="effect" value="<?php echo $cep; ?>" size="20" maxlength="20" /></td>
                </tr>
                <tr align="center"> <input type="hidden" name="idempresa" value="<?php echo $idempresa; ?>" />
                    <td colspan="5"><input type="submit" name="Submit" value="Cadastrar"/></td>
                </tr> 
                
            </table>
            
        </form>

    </fieldset>

</div>

