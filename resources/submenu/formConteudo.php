<?php

$pagina = $_GET["sub"];

switch ($pagina) {
    //menu administracao
    case "100":
        $url = "../../app/view/gridEmpresa.php";
        break;
    case "101":
        $url = "../../app/view/gridSetor.php";
        break;
    case "102":
        $url = "../../app/view/gridFuncionario.php";
        break;
    case "105":
        $url = "../../app/view/forCondicaoPagamento.php";
        break;
    case "106":
        $url = "../../app/view/forOperacao.php";
        break;
    case "107":
        $url = "../../app/view/exportaDB.php";
        break;
    
    //cadastro pertence ao menu cadastro
    case "200":
        $url = "../../app/view/gridCliente.php";
        break;
    case "201":
        $url = "sobre.php";
        break;
    case "202":
        $url = "../../app/view/gridVendedor.php";
        break;
    case "203":
        $url = "../../app/view/forGrupoProduto.php";
        break;
    case "204":
        $url = "../../app/view/forMarca.php";
        break;
    case "205":
        $url = "../../app/view/forGrupoPessoa.php";
        break;
    case "206":
        $url = "../../app/view/gridPeca.php";
        break;
    case "207":
        $url = "../../app/view/forUnidadeMedida.php";
        break;
    
    case "300":
        $url = "../../app/view/gridNf.php";
        break;
    case "301":
        $url = "../../app/view/forSelecionarVendedor.php";
        break;
    
    case "401":
        $url = "../../app/view/gridContaReceber.php";
        break;
    case "403":
        $url = "../../app/view/forCaixa.php";
        break;
    case "404":
        $url = "../../app/view/forContaBanco.php";
        break;
    case "405":
        $url = "../../app/view/forSelecionarCaixa.php";
        break;
    default:
        $url = "inicio.php";
        break;
}

include($url);
?>
