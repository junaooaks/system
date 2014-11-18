<?php

$pagina = $_GET["sub"];

switch($pagina){
        case "1":
                echo "<tr>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=100')"."><img src='resources/images/empresa.png' title='Cadastrar Empresas'/></a></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=101')"."><img src='resources/images/setores.png' title='Cadastro de Setores'/></a></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=102')"."><img src='resources/images/funcionarios.png' title='Cadastro de Funcionarios'/></a></td>
                    <td><a href='#'><img src='resources/images/parametro.png' title='Parametros do Sistema'/></a></td>
                    <td><a href='#'><img src='resources/images/log.png' title='Registro de Log'/></a></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=105')"."><img src='resources/images/condicaoPG.png' title='Condiçoes de Pagamento'/></td>
                    <!--td><a href='#'><img src='resources/images/tipoPessoas.png' title='Categoria de Clientes'/></td-->
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=106')"."><img src='resources/images/operacoes.png' title='Opecaçoes'/></td>
                    <!--td><a href='#'><img src='resources/images/caixas.png' title='Cadastro de Caixas'/></td-->
                    <td><a href="."javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=107')"."><img src='resources/images/conexaobd.png' title='Canexão Banco Externo'/></td>
                </tr>";
                break;
        case "2":
                echo "
                <tr>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=200')"."><img src='resources/images/cliente.png' title='Cadastro de Clientes'/></a></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=202')"."><img src='resources/images/fornecedor.png' title='Cadastro de Fornecedor'/></a></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=206')"."><img src='resources/images/produtos.png' title='Cadastro de Produtos'/></a></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=205')"."><img src='resources/images/grupoCliente.png' title='Cadastro de Grupo Cliente'/></a></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=203')"."><img src='resources/images/gruposubgrupo.png' title='Cadastro de Grupo/Sub-Grupo'/></a></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=204')"."><img src='resources/images/marcas.png' title='Cadastro de Marcas'/></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=207')"."><img src='resources/images/unidademedida.png' title='Cadastro de Medida'/></td>
                </tr>";
            
                break;
        case "3":
                echo "<tr>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=300')"."><img src='resources/images/notaEntrada.png' title='Registro Nota Entrada'/></a></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=301')"."><img src='resources/images/notaSaida.png' title='Saida de Mercadoria'/></a></td>
                </tr>";
                break;
        case "4":
                echo "<tr>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=401')"."><img src='resources/images/contaReceber.png' title='Contas a Receber'/></a></td>
                    <td><a href='#'><img src='resources/images/contaPagar.png' title='Contas a Pagar'/></a></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=403')"."><img src='resources/images/financeiroCaixa.png' title='Registro de Caixa'/></a></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=404')"."><img src='resources/images/contaBancaria.png' title='Contas Bancarias'/></a></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=405')"."><img src='resources/images/movimentacao.png' title='Movimentação Diária'/></a></td>
                    <td><a href='#'><img src='resources/images/cheques.png' title='Registro de Cheques'/></td>
                </tr>";
                break;
        case "5":
                echo "RELATORIO";
                break;
            
        default:
                echo "<tr>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=200')"."><img src='resources/images/cliente.png' title='Cadastro de Clientes'/></a></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=202')"."><img src='resources/images/fornecedor.png' title='Cadastro de Fornecedor'/></a></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=206')"."><img src='resources/images/produtos.png' title='Cadastro de Produtos'/></a></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=205')"."><img src='resources/images/grupoCliente.png' title='Cadastro de Grupo Cliente'/></a></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=203')"."><img src='resources/images/gruposubgrupo.png' title='Cadastro de Grupo/Sub-Grupo'/></a></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=204')"."><img src='resources/images/marcas.png' title='Cadastro de Marcas'/></td>
                    <td><a href=". "javascript:mudaConteudo('resources/submenu/formConteudo.php?sub=207')"."><img src='resources/images/unidademedida.png' title='Cadastro de Medida'/></td>
                </tr>";
                break;
}
//include($url);

?>
