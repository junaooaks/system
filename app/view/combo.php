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


        $sql = mysql_query("SELECT idsubgrupo,descricaoSubGrupo FROM subgrupo WHERE grupo_idgrupo = '$combo'") or die(mysql_error());
        while ($ln = mysql_fetch_array($sql)) {
                $subgrupo = $ln['descricaoSubGrupo'];
                $idsub    = $ln['idsubgrupo'];
                
                print_r( "<option value=".$idsub.">".$subgrupo."</option>");
        
        }
?>


<?php 
