<?php
/*
**----------------------------N�o Apagar esta Se��o -------------------------
**	Paginator 
**	Pagina��o de resultados de consulta com PHP e MySQL
**
**	Vers�o 1.6.3
**
**	Nome do arquivo	:
**		paginatorbr.inc.php
**
**	Autor/Tradutor	:
**		Jorge Pinedo Rosas (Autor)
**		Com a colabora��o dos usu�rio do f�rum de PHP do www.forosdelweb.com
**		Especialmente de dooky que postou a base desse script.
**      
**      Jonathan Lamim Antunes (Tradutor)
**      Profissional de Inform�tica desde 2004, atua na �rea de desenvolvimento web.
**
**	Descri��o :
**      Retorna o resultado de uma consulta dividido em p�ginas e uma barra de navega��o para as mesmas		
**      Este script foi escrito com fins did�ticos, por isso est� todo comentado
**
**	Licen�a : 
**		GPL com as seguintes extens�es:
** 			*Use-o com o fim que quiser (pessoal ou lucrativo).
**			*Se encontrar erros no c�digo, ou melhor�-lo, envie-me um e-mail (lamim.informatica@gmail.com) informando.
**			*Este script n�o possui nenhuma garantia. Os criadores n�o se responsabilizam pelo mau uso do script ou falhas do     **           mesmo. 
**
**----------------------------------------------------------------------*/

/**
 * Vari�veis que podem ser definidas antes de incluir o script via inlude():
 * ------------------------------------------------------------------------
 * $_pagi_sql 					OBRIGAT�RIA.	Deve conter uma instru��o SQl v�lida (e sem a cl�usula "LIMIT").
 
 * $_pagi_cuantos				OPCIONAL.		(Inteiro) N�mero de resultados que queremos obter por p�gina.
 *                              Se n�o for definido um valor, ser� 20, que � o valor padr�o.
											
 * $_pagi_nav_num_enlaces		OPCIONAL		(Inteiro) Quantidade de links(p�ginas) mostrados na barra de navega��o. 
 *                              Por padr�o s�o mostrados todos.
											
 * $_pagi_mostrar_errores		OPCIONAL		(Booleano) Define se s�o mostrados ou n�o os erros de MySQL que venham a surgir.
 *                              Por padr�o est� como "true".
											
 * $_pagi_propagar				OPCIONAL       (Array) Cont�m os nomes das vari�veis que se quer enviar pela URL.
 *                              Por padr�o s�o enviadas todas as que j� venham pela URL(GET).

 * $_pagi_conteo_alternativo	OPCIONAL(Booleano) Define se os registros s�o contados pelo PHP com mysql_num_rows()(true) ou pelo *                              MySQL, com COUNT (*)(false). Por padr�o est� em "false". 
 *                              � recomendado que seja mantido com false, a n�o ser que aconte�am erros de contagem ou resultados * *                             inesperados. 

 * $_pagi_separador				OPCIONAL		S�mbolo que separa os links num�ricos na barra de navega��o entre as p�ginas.
 								Por padr�o se utiliza " | ".
								
 * $_pagi_nav_estilo			OPCIONAL		Cont�m o nome do estilo CSS para os links de pagina��o da barra de navega��o.
 *                              Por padr�o n�o se especifica o estilo. 
 
 * $_pagi_nav_anterior			OPCIONAL       Cont�m o que deve aparecer como link para a p�gina anterior. Pode ser uma tag <img>.
                                Por padr�o se utiliza "&laquo; Anterior".
								
 * $_pagi_nav_siguiente			OPCIONAL		Cont�m o que deve aparecer como link para a pr�xima p�gina. Pode ser uma tag <img>.
                                Por padr�o se utiliza "Pr�xima &raquo;".
								
 * $_pagi_nav_primera			OPCIONAL        Cont�m o que deve aparecer como link para a primeira p�gina. Pode ser uma tag <img>
                                Por padr�o se utiliza "&laquo;&laquo; Primeira".
								
 * $_pagi_nav_ultima			OPCIONAL		Cont�m o que deve aparecer como link para a �ltima p�gina. Pode ser uma tag <img>.
                                Por padr�o se utiliza "�ltima &raquo;&raquo;".
--------------------------------------------------------------------------
*/


/*
 * Verifica��o dos par�metros obrigat�rios e opcionais
 *------------------------------------------------------------------------
 */
 if(empty($_pagi_sql)){
	// Se n�o for definido $_pagi_sql... erro grave!
	// Este erro � apresentado assim (j� que n�o � um erro de mysql)
	die("<b>Mensagem de Erro: </b>A variavel \$_pagi_sql nao foi definida.");
 }
 
 if(empty($_pagi_cuantos)){
	// Se n�o for especificado um valor para a vari�vel
	// $_pagi_cuantos, o n�mero de registros por p�gina ser� 20, que � o padr�o.
	$_pagi_cuantos = 20;
 }
 
 if(!isset($_pagi_mostrar_errores)){
	// Se n�o for definido um valor para
	// $_pagi_errores ser� por padr�o true. (os erros ser�o apresentados na tela)
	$_pagi_mostrar_errores = true;
 }

 if(!isset($_pagi_conteo_alternativo)){
	// Se n�o for especificado o tipo de contagem de registros
	// ser� realizada contagem pelo mysql usando COUNT(*)
	$_pagi_conteo_alternativo = false;
 }
 
 if(!isset($_pagi_separador)){
	// Se n�o for definido um separador
	// o separador utilizado ser� o padr�o.
	$_pagi_separador = " &nbsp; ";
 }
 
  if(isset($_pagi_nav_estilo)){
	// Se for definido um estilo para os links, ser� gerado o atributo "class" para o link
	$_pagi_nav_estilo_mod = "class=\"$_pagi_nav_estilo\"";
 }else{
 	// Se n�o for definido, ser� utilizado como vazio.
 	$_pagi_nav_estilo_mod = "";
 }
 
 if(!isset($_pagi_nav_anterior)){
	// Se n�o for definido um s�mbolo ou imagem para a op��o "Anterior"
	// Ser� por padr�o o descrito abaixo.
	$_pagi_nav_anterior = "&laquo; Anterior";
 } 
 
 if(!isset($_pagi_nav_siguiente)){
	// Se n�o for definido um s�mbolo ou imagem para a op��o "Pr�xima"
	// Ser� por padr�o o descrito abaixo.
	$_pagi_nav_siguiente = "Proxima &raquo;";
 } 

 if(!isset($_pagi_nav_primera)){
	// Se n�o for definido um s�mbolo ou imagem para a op��o "Primeira"
	// Ser� por padr�o o descrito abaixo.
	$_pagi_nav_primera = "&laquo;&laquo; Primeira";
 } 
 
 if(!isset($_pagi_nav_ultima)){
	// Se n�o for definido um s�mbolo ou imagem para a op��o "�ltima"
	// Ser� por padr�o o descrito abaixo.
	$_pagi_nav_ultima = "&Uacute;ltima &raquo;&raquo;";
 } 
 
//------------------------------------------------------------------------


/*
 * Estabelecimento da p�gina atual
 *------------------------------------------------------------------------
 */
 if (empty($_GET['_pagi_pg'])){
	// Se n�o houver sido clicado em nenhuma p�gina espec�fica
	// Ou seja, se a primeira vez que se executa o script
    	// $_pagi_actual � a p�gina atual-->ser� por padr�o a primeira.
	$_pagi_actual = 1;
 }else{
	// Se foi pedido uma p�gina espec�fica:
	// A p�gina atual ser� a que foi pedida.
    	$_pagi_actual = $_GET['_pagi_pg'];
 }
//------------------------------------------------------------------------


/*
 * Estabelecendo o n�mero de p�ginas e o total de registros.
 *------------------------------------------------------------------------
 */
 // Contamos o total de registros no BD (para saber quantas p�ginas ser�o)
 // A forma de se fazer essa contagem depender� da vari�vel $_pagi_conteo_alternativo
 if($_pagi_conteo_alternativo == false){
 	$_pagi_sqlConta = eregi_replace("select[[:space:]](.*)[[:space:]]from", "SELECT COUNT(*) FROM", $_pagi_sql);
 	$_pagi_result2 = mysql_query($_pagi_sqlConta);
	// Se ocorreu erros e foram mostrados, a exibi��o dos erros est� ativada
 	if($_pagi_result2 == false && $_pagi_mostrar_errores == true){
		die (" Erro de contagem de registros: $_pagi_sqlConta. Mysql informa: <b>".mysql_error()."</b>");
 	}
 	$_pagi_totalReg = mysql_result($_pagi_result2,0,0);//total de registros
 }else{
	$_pagi_result3 = mysql_query($_pagi_sql);
	// Se ocorreu erros e foram mostrados, a exibi��o dos erros est� ativada
 	if($_pagi_result3 == false && $_pagi_mostrar_errores == true){
		die (" Erro na contagem alternativa de registros: $_pagi_sql. Mysql informa: <b>".mysql_error()."</b>");
 	}
	$_pagi_totalReg = mysql_num_rows($_pagi_result3);
 }
 // Calculamos o n�mero de p�ginas (retornar� um decimal)
 // com ceil() arredondamos e $_pagi_totalPags ser� o n�mero total (inteiro) de p�ginas que teremos
 $_pagi_totalPags = ceil($_pagi_totalReg / $_pagi_cuantos);

//------------------------------------------------------------------------


/*
 * Envio das vari�veis pela URL.
 *------------------------------------------------------------------------
 */
 // A id�ia � passar tamb�m nos links as vari�veis recebidas pela URL.
 //$_pagi_enlace = $_SERVER['PHP_SELF'];
 $_pagi_query_string = "?";
 
 if(!isset($_pagi_propagar)){
 	//Se n�o foi definido que vari�veis ser�o enviadas, ser� enviado o $_GET (por compatibilidade com vers�es anteriores)
	//Todo menos a vari�vel _pagi_pg
	if (isset($_GET['_pagi_pg'])) unset($_GET['_pagi_pg']); // Eliminamos essa vari�vel do $_GET
	$_pagi_propagar = array_keys($_GET);
 }elseif(!is_array($_pagi_propagar)){
	// Se $_pagi_propagar n�o for um array... erro grave!
	die("<b>PaginatorBR informa: </b>A vari�vel \$_pagi_propagar deve ser um array");
 }
 // Este foreach foi retirado da Classe Paginado de webstudio
 // (http://www.forosdelweb.com/showthread.php?t=65528)
 foreach($_pagi_propagar as $var){
 	if(isset($GLOBALS[$var])){
		// Se a vari�vel � global ao script
		$_pagi_query_string.= $var."=".$GLOBALS[$var]."&";
	}elseif(isset($_REQUEST[$var])){
		// Se n�o � global (ou register globals est� em OFF)
		$_pagi_query_string.= $var."=".$_REQUEST[$var]."&";
	}
 }

 // Enviamos a isntru��o SQl pela URL.
 $_pagi_enlace .= $_pagi_query_string;
 
//------------------------------------------------------------------------


/*
 * Gera��o dos lnks de pagina��o.
 *------------------------------------------------------------------------
 */
 // A vari�vel $_pagi_navegacion conter� os links para as p�ginas.
 $_pagi_navegacion_temporal = array();
 if ($_pagi_actual != 1){
	// Se n�o estamos na p�gina 1. Colocamos o link "primeira"
	$_pagi_url = 1; //ser� o n�mero da p�gina que linkamos
        
	//$_pagi_navegacion_temporal[] = "<a ".$_pagi_nav_estilo_mod." href='".$_pagi_enlace."_pagi_pg=".$_pagi_url."'>$_pagi_nav_primera</a>";
        $_pagi_navegacion_temporal[] = "<a href=" . "javascript:mudaConteudo('app/view/gridNF.php?" .$_pagi_enlace. "_pagi_pg=".$_pagi_url."')" . ">$_pagi_nav_primera</a>";
	// Se n�o estamos na p�gina 1. Colocamos o link "anterior"
	$_pagi_url = $_pagi_actual - 1; //ser� o n�mero da p�gina que linkamos
  // <a href=" . "javascript:mudaConteudo('app/view/forNF.php?idnf=" . $row['idnotaEntrada'] . "')" . "></a>
  /* $_pagi_navegacion_temporal[] = "<a ".$_pagi_nav_estilo_mod." href='".$_pagi_enlace."_pagi_pg=".$_pagi_url."'>$_pagi_nav_anterior</a>";*/
        $_pagi_navegacion_temporal[] = "<a href=" . "javascript:mudaConteudo('app/view/gridNF.php?" .$_pagi_enlace. "_pagi_pg=".$_pagi_url."')" . ">$_pagi_nav_anterior</a>";
 }
 
 // A vari�vel $_pagi_nav_num_enlaces serve para definir quantos links com 
 // n�meros de p�ginas ser�o mostrados.
 // Obs: sempre ser� mostrado um n�mero �mpar de links. Mais informa��es na documenta��o.
 
 if(!isset($_pagi_nav_num_enlaces)){
	// Se n�o foi definida a vari�vel $_pagi_nav_num_enlaces
	// Ser�o mostrados todos os n�meros de p�ginas nos links.
	$_pagi_nav_desde = 1;//Desde la primera
	$_pagi_nav_hasta = $_pagi_totalPags;//at� a �ltima
 }else{
	// Se foi definida a vari�vel $_pagi_nav_num_enlaces
	// Calculamos o intervalo para dividir e somar a partir da p�gina atual
	$_pagi_nav_intervalo = ceil($_pagi_nav_num_enlaces/2) - 1;
	
	// Calculamos a partir de que n�mero de p�gina ser� mostrado
	$_pagi_nav_desde = $_pagi_actual - $_pagi_nav_intervalo;
	// Calculamos at� que n�mero de p�gina ser� mostrado
	$_pagi_nav_hasta = $_pagi_actual + $_pagi_nav_intervalo;
	
	// Ajustamos os valores anteriores caso sejam resultados inv�lidos
	
	// Se $_pagi_nav_desde for um n�mero negativo
	if($_pagi_nav_desde < 1){
		// O subtra�mos a quantidade restante para manter o n�mero de links que se quer mostrar. 
		$_pagi_nav_hasta -= ($_pagi_nav_desde - 1);
		// Establecemos $_pagi_nav_desde como 1.
		$_pagi_nav_desde = 1;
	}
	// Se $_pagi_nav_hasta for um n�mero maior que o total de p�ginas
	if($_pagi_nav_hasta > $_pagi_totalPags){
		// O subtra�mos a quantidade excedida ao come�ao para manter o n�mero de links que se quer mostrar.
		$_pagi_nav_desde -= ($_pagi_nav_hasta - $_pagi_totalPags);
		// Establecemos $_pagi_nav_hasta como o total de p�ginas.
		$_pagi_nav_hasta = $_pagi_totalPags;
		// Fazemos o �ltimo ajuste verificando que ao enviar $_pagi_nav_desde n�o haja um valor inv�lido.
		if($_pagi_nav_desde < 1){
			$_pagi_nav_desde = 1;
		}
	}
 }

 for ($_pagi_i = $_pagi_nav_desde; $_pagi_i<=$_pagi_nav_hasta; $_pagi_i++){//Da p�gina 1 at� a �ltima p�gina ($_pagi_totalPags)
	if ($_pagi_i == $_pagi_actual) {
		// Se o n�mero de p�gina � o atual ($_pagi_actual). Escreve-se o n�mero, mas sem link e em negrito.
		//$_pagi_navegacion_temporal[] = "<span ".$_pagi_nav_estilo_mod.">$_pagi_i</span>";
                $_pagi_navegacion_temporal[] = "<a href=" . "javascript:mudaConteudo('app/view/gridNF.php?" .$_pagi_enlace. "_pagi_pg=".$_pagi_i."')" . ">$_pagi_i</a>";
	}else{
		// Se for qualquer outro. Se escreve o link e o n�meor da p�gina.
		//$_pagi_navegacion_temporal[] = "<a ".$_pagi_nav_estilo_mod." href='".$_pagi_enlace."_pagi_pg=".$_pagi_i."'>".$_pagi_i."</a>";
                $_pagi_navegacion_temporal[] = "<a href=" . "javascript:mudaConteudo('app/view/gridNF.php?" .$_pagi_enlace. "_pagi_pg=".$_pagi_i."')" . ">$_pagi_i</a>";
	}       
 }

 if ($_pagi_actual < $_pagi_totalPags){
	// Se n�o estamos na �ltima p�gina. Colocamos o link "Seguinte"
	$_pagi_url = $_pagi_actual + 1; //ser� o n�mero da p�gina que linkamos
	//$_pagi_navegacion_temporal[] = "<a ".$_pagi_nav_estilo_mod." href='".$_pagi_enlace."_pagi_pg=".$_pagi_url."'>$_pagi_nav_siguiente</a>";
        $_pagi_navegacion_temporal[] = "<a href=" . "javascript:mudaConteudo('app/view/gridNF.php?" .$_pagi_enlace. "_pagi_pg=".$_pagi_url."')" . ">$_pagi_nav_siguiente</a>";
	// Se n�o estamos na �ltima p�gina. Colocamos o link "�ltima"
	$_pagi_url = $_pagi_totalPags; //ser� o n�mero da p�gina que linkamos
	//$_pagi_navegacion_temporal[] = "<a ".$_pagi_nav_estilo_mod." href='".$_pagi_enlace."_pagi_pg=".$_pagi_url."'>$_pagi_nav_ultima</a>";
        $_pagi_navegacion_temporal[] = "<a href=" . "javascript:mudaConteudo('app/view/gridNF.php?" .$_pagi_enlace. "_pagi_pg=".$_pagi_url."')" . ">$_pagi_nav_ultima</a>";
        }
 $_pagi_navegacion = implode($_pagi_separador, $_pagi_navegacion_temporal);

//------------------------------------------------------------------------


/*
 * Obten��o dos resgistros que ser�o mostrados na p�gina atual.
 *------------------------------------------------------------------------
 */
 // Calculamos a partir de qu� registro ser� mostrado na p�gina
 // Lembre que o contatdor come�a em ZERO.
 $_pagi_inicial = ($_pagi_actual-1) * $_pagi_cuantos;
 
 // Consulta SQL. Retorna $cantidad registros come�ando a partir de $_pagi_inicial
 $_pagi_sqlLim = $_pagi_sql." LIMIT $_pagi_inicial,$_pagi_cuantos";
 $_pagi_result = mysql_query($_pagi_sqlLim);
 // Se ocorreu erro e for mostrado, � porque a exibi��o de erros est� ativada
 if($_pagi_result == false && $_pagi_mostrar_errores == true){
 	die ("Erro na consulta: $_pagi_sqlLim. Mysql informa: <b>".mysql_error()."</b>");
 }

//------------------------------------------------------------------------


/*
 * Gera��o da informa��o sobre os registros mostrados.
 *------------------------------------------------------------------------
 */
 // N�mero do primeiro registro da p�gina atual
 $_pagi_desde = $_pagi_inicial + 1;
 
 // N�meor do �ltimo registro da p�gina atual.
 $_pagi_hasta = $_pagi_inicial + $_pagi_cuantos;
 if($_pagi_hasta > $_pagi_totalReg){
 	// Se estivermos na �ltima p�gina
	// O �ltimo registro da p�gina atual ser� igual ao n�mero de registros.
 	$_pagi_hasta = $_pagi_totalReg;
 }
 
 $_pagi_info = "De $_pagi_desde at&eacute; $_pagi_hasta de um total de $_pagi_totalReg resultados";

//------------------------------------------------------------------------


/**
 * Vari�veis que ficam dispon�veis ap�s incluir o script via include():
 * ------------------------------------------------------------------------
 
 * $_pagi_result		Identificador do resultado da consulta ao BD para os registros da p�gina atual. 
 				Pronto para ser passado por uma fun��o como mysql_fetch_row(), mysql_fetch_array(), 
				mysql_fetch_assoc(), etc.
							
 * $_pagi_navegacion		Vari�vel que contem a barra de navega��o com os links para as p�ginas de resultados.
 				Exemplo: "<<Primeira | <Anterior | 1 | 2 | 3 | 4 | Pr�xima> | �ltima>>".
							
 * $_pagi_info			Vari�vel que cont�m informa��es sobre os registros da p�gina atual.
 				Exemplo: "De 16 at� 30 de um total de 123";				

*/
?>