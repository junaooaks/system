<script type="text/javascript">  
    jQuery(document).ready(function(){  
        jQuery('#tr').submit(function(){  
            var dados = jQuery( this ).serialize();  
  
            jQuery.ajax({ 
                title: "WebCom",
                type: "POST",  
                url: "app/controller/controllerSetor.php",  
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
    <h1>CADASTRO SETOR</h1>
    <hr>
    <fieldset>
        <?php
        $idempresa = $_GET['idempresa'];

        require("../../app/model/conexao/Conexao.php");
        require("../../app/model/sql/DBSetor.php");
        require("../../app/model/modelSetor.php");



        //echo "grupo = $idgrupo - sub = $idsubgrupo";


        if (!empty($idempresa)) {
            //inserir dados no banco de daodos
            $pessoa = new modelEmpresa();
            $pessoa->setIDEmpresa($idempresa);

            //inserir dados no banco de daodos
            $dbempresa = new DBEmpresa();
            $dbempresa = $dbempresa->select($pessoa);

            $idempresa = $pessoa->getIDEmpresa();
            $cnpj = $pessoa->getCnpj();
            $endereco = $pessoa->getEndereco();
            $numero = $pessoa->getNumero();
            $bairro = $pessoa->getBairro();
            $cep = $pessoa->getCep();
            $cidade = $pessoa->getCidade();
            $uf = $pessoa->getUf();
            $empresa = $pessoa->getNome();
        }
        ?>   
        <form method="POST" action="" id="tr">

            <table border="0">
                <h1>EMPRESA</h1><hr>

                <tr> 
                    <td>Empresa:</td>
                    <td colspan="5"><select name="idempresa" class="effect">


                            <?php
                            if (empty($idempresa)) {
                                echo "<option value=''>ESCOLHA...</option>";
                            }
                            //echo "ss $subgrupo";
                            $dbSetor = new DBSetor();
                            $setor = $dbSetor->selectEmpresa($idempresa);
                            //selected
                            ?>

                        </select></td>
                </tr>
            </table>     
            <table border="0">
                <tr>     <h1>DESCRIÇÃO SETOR</h1><hr></tr>
                <tr> 
                    <td>Descrição:</td>
                    <td><input name="descricao" type="text" class="effect" value="<?php echo $endereco; ?>" size="40" maxlength="200" onkeyup="up(this)"/> 
                    </td>
                    <td>Comissionado: </td>
                    <td><input type="radio" name="s" id="radio" value="comissao" />
                        <label for="n"></label> 
                        Sim
                        <input name="n" type="radio" id="radio2" value="comissao" checked="checked" />
                        Não</td>
                </tr>



            </table>

        </form>

    </fieldset>

</div>

