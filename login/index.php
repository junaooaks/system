<?php
if(file_exists("init.php")){
	require_once "init.php";
} else {
	die("Arquivo de init n�o encontrado");
}

require_once "seguranca.php";

$dados = isset($_SESSION["dados"]) ? $_SESSION["dados"] : unserialize($_COOKIE["dados"]);
echo "Seja Bem-Vindo ". $dados["nome"]." ";
?>
<a href="sair.php">Sair</a>