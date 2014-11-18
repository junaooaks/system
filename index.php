<?php

if(file_exists("init.php")){
 
	require_once "init.php";
} else {
	die("Arquivo de init nao encontrado");
}

require_once "seguranca.php";

$dados = isset($_SESSION["dados"]) ? $_SESSION["dados"] : unserialize($_COOKIE["dados"]);
//echo "Seja Bem-Vindo ". $dados["nome"]." ";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- esta meta tag tira o sistema de busca dos buscadores -->
        <meta name="robots" content="noindex,nofollow">
        <title></title>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ajax.js"></script>
        
        <style type="text/css">@import url("resources/css/style.css");</style>
        <style type="text/css">@import url("resources/css/menu.css");</style>
   
       
    </head>
    <body>
        <div id="titulo">WEBCOM
            <div class="direita"><?php echo $dados["nome"]." | <a href='sair.php'><img src ='resources/images/Exit.png' title='Sair'/> "; ?></div></div>
            <div id="tabs1">
                <ul>
                    <li><a href="javascript:mudaPage('resources/submenu/submenu.php?sub=1');"><span>ADMINISTRAÇÃO</span></a></li>
                    <li><a href="javascript:mudaPage('resources/submenu/submenu.php?sub=2');"><span>CADASTRO</span></a></li>
                    <li><a href="javascript:mudaPage('resources/submenu/submenu.php?sub=3');"><span>MOVIMENTAÇÕES</span></a></li>
                    <li><a href="javascript:mudaPage('resources/submenu/submenu.php?sub=4');"><span>FINANCEIRO</span></a></li>
                    <li><a href="javascript:mudaPage('resources/submenu/submenu.php?sub=5');"><span>RELATÓRIOS</span></a></li>
                </ul>
            </div>
            
            <div id="submenu">
                <!--img src="resources/images/carregando.gif" id="carregando"/-->
                <?php //include("resources/submenu/submenu.php");?>
            </div>
            
        </div>
        <div id="conteudo">
            <!--div id="header"></div>
            <div id="mainnav"></div>
            <div id="contents"></div>
            <div id="footer"></div-->
            
        </div>
        
    </body>
</html>
