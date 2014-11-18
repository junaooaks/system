<?php
$hostname = "localhost";
$user = "sisgew";
$pass = "sgw258789";
$basedados = "sisgew_webcom";
$connect = mysql_connect($hostname,$user,$pass) or die ("Impossível estabelecer conexão com o servidor de banco de dados");
mysql_select_db($basedados) or die ("Impossivel estabelecer conexão com o banco de dados");
 
//busca valor digitado no campo autocomplete "$_GET['term']
$text = mysql_real_escape_string($_GET['text']);

//remover espaço no meio da string
$text = str_replace(" ", "", $text);
//explodir a string
$ex = explode(",", $text);
//remover zero a esquerda
$idproduto = intval($ex[0]);

$query = "SELECT estoqueAtual, precoVenda FROM produto, custo WHERE idproduto = '$idproduto' 
          AND produto.custo_idcusto = custo.idcusto";
$result = mysql_query($query);

$row = mysql_fetch_array($result);

$json = $row['estoqueAtual']."|".$row['precoVenda'];



echo $json;
?>