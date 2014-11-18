 <script language="JavaScript">

function confirma(codigo) {
    if( confirm( 'ESTA OPCAO E IRREVERSIVEL. DESEJA REALMENTE FAZER ISTO?' ) ) 
    {
        mudaConteudo('app/controller/controllerFuncionario.php?codExcluir='+ codigo);
    }
    return false;
}

</script>

<div id="datagrid">
    <h1>CADASTRO DE FUNCIONÁRIO</h1>
    <hr>
    <tr>
        <td id="button"><input type="submit" value="Novo" name="button"  onclick="javascript:mudaConteudo('app/view/forFuncionario.php');"/></td>

    </tr>
    <fieldset>
        <form name="form1" method="post" action="" id="tr">

            <table class="tabela">
                <tr class="linha">
                    <td width="35">ALT..</td>
                    <td width="35">ACESSO</td>
                    <td>ID</td>
                    <td>NOME</td>
                    <td>TEL. RESIDEN.</td>
                    <td>CEL. PESSOAL</td>
                    <td>EMPRESA</td>
                    <td>SETOR</td>
                    <td width="35">EXC..</td>
                    
                </tr>
                <?php
                //$pessoa = $_REQUEST['cli'];
                // echo $pessoa; 
                //echo "grupo = $idgrupo - sub = $idsubgrupo";
                require("../../app/model/conexao/Conexao.php");
                require("../../app/model/sql/DBFuncionario.php");
                require("../../app/model/modelFuncionario.php");

                /* $idpessoa = $_GET['idpessoa'];
                  //$idpessoa = $cliente->getIDpessoa();
                  echo "id - $idpessoa";exit();
                 */
                
                /*
                $cliente = new modelFuncionario();
                $busca = $cliente->getIDpessoa();
                echo 'nome' . $busca;
                */
                
                $dbfun = new DBFuncionario();

                //if (empty($busca)) {
                    $pessoa = $dbfun->selectAll();
                //} else {
                    /*
                    $pessoa = $dbpessoa->selectBUSCA();
                    echo "busca" . $pessoa->getBusca();
                }*/
                ?>
            </table>
        </form>
    </fieldset>

</div>