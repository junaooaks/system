<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Requisição Ajax com gif Animado - Felipe Silveira</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#loader").hide();
        $("#teste").bind("change",function(){
            $("#loader").fadeIn();
            $("#loader").load("teste.php",function(response){
                $("#loader").hide();
            });
        });
    });
    </script>
</head>
<body>
<center>
    <div class="corpo">
        <img src="resources/images/ico-loading.gif" id="loader"/>
        <select id="teste">
            <option value="1">Teste</option>
            <option value="1">Teste 2</option>
            <option value="1">Teste 3</option>
        </select>
        <div id="content">
 
        </div>
    </div>
</center>
</body>
</html>