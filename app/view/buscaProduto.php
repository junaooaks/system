<?php
$hostname = "localhost";
$user = "sisgew";
$pass = "sgw258789";
$basedados = "sisgew_webcom";
$connect = mysql_connect($hostname,$user,$pass) or die ("Impossível estabelecer conexão com o servidor de banco de dados");
mysql_select_db($basedados) or die ("Impossivel estabelecer conexão com o banco de dados");
 
//busca valor digitado no campo autocomplete "$_GET['term']
$text = mysql_real_escape_string($_GET['term']);
$query = "SELECT * FROM produto WHERE descricao LIKE '%$text%' ORDER BY descricao ASC";
$result = mysql_query($query);
//formata o resultado para JSON
$json = '[';
$first = true;

while($row = mysql_fetch_array($result))
{   
    // acrescentar zero a esquerda para remover usar ltrim.
    $codpro = str_pad($row['idproduto'], 5, "0", STR_PAD_LEFT);
    
  if (!$first) { $json .=  ','; } else { $first = false; }
  $json .= '{"value":"'.utf8_encode($codpro.',  '.$row['descricao']).'"}';
  
}

$json .= ']';

echo $json;
?>