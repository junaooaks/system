<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script> 
<script>
var teste = 2; 
function setName(v) 
{ 
var retorno = null;
var id = v.split(",");

teste = teste+1;

alert(teste);
$('#name').val('Carregando...'); 
$('#tmp_name').load('buscaProdutonfs.php?text=' + id[0], function(){ 

retorno = $('#tmp_name').html();
retorno = retorno.split("|");

alert(retorno[0]);
$('#name').val(retorno[0]);
$('#custo').val(retorno[1]); 
} 
); 

} 
function alerta(){
	alert(teste);
	}
</script> 
<body>
<form id="form1" name="form1" method="post" action=""> 
<input name="id" type="text" id="id" onblur="setName(this.value);"/> 
<input type="text" name="est" id="name" />
<input type="text" name="custo" id="custo" />
<div id="tmp_name" style="display:none;"></div>

</form>
<input type="submit" name="button" id="button" value="Submit" onclick="alerta()"/>
</body>
</html>
