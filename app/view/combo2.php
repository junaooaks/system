<?php
$host = "localhost";
$user = "sisgew";
$senha = "sgw258789";
$dbname = "sisgew_webcom";

//conectar ao banco de dados

mysql_connect($host, $user, $senha) or die (mysql_error());
mysql_select_db ($dbname) or die (mysql_error());

// resgatando os dados do formulário
$combo = $_POST['idgrupo'];


        $sql = mysql_query("SELECT idsetor,descricao FROM setor WHERE empresa_idempresa = '$combo'") or die(mysql_error());
        while ($ln = mysql_fetch_array($sql)) {
                $subgrupo = $ln['descricao'];
                $idsub    = $ln['idsetor'];
                
                print_r( utf8_decode("<option value=".$idsub.">".$subgrupo."</option>"));
        
        }
?>


<?php 
