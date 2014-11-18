// JavaScript Document
var cont = '';
var lop = '';
$(document).ready(function(){

    $(".menos").live("click", function(){
    
        var qtdProdutos = $('#lista tbody').children('tr').length;
        if( qtdProdutos == 1){
            //alert("nao e possível remover todos produtos")
        }else{
            
           $(this).parent().remove();
           $('#row').val(qtdProdutos-1);
           calculateSum();
           calculateFRETE();
           calculaIPI();
           calculateST();   
        }
        
    });

    $(".item").live("blur", estoq);
	
    $('#mais').click(function(){
	    
        var next = $('#lista tbody').children('tr').length;
	
        $('#lista tbody').append('<tr class="remover'+next+'">' +
            '<td></td>'+
            '<td><input type="text" name="item' + next + '" size="70" class="effect auto item" onkeyup="up(this)"/></td>' +
            '<td><input type="text" name="est' + next + '" id="est'+next+'" size="5" class="effect" onkeyup="up(this)" readonly="readonly"/></td>' +
            '<td><input type="text"  name="custo' + next + '" size="5" id="valor soma'+next+'" class="effect soma total'+next+' atri'+next+'" /></td>' +
            '<td><input type="text" name="quantidade' + next + '" size="5" class="effect" onkeyup="up(this)" onBlur="calculateSum();"/></td>' +
            '<td align="center" class="menos" id="menos'+ next +'"><img src="resources/images/menos.png" border="0" class="diminuir"/></td>'+
            '</tr>');
        //....  
       cont = next;
        $('.remover'+next).find('.auto').autocomplete(
    {
      source: "app/view/buscaProduto.php",
     minLength: 1
    })
    
    $('.remover'+next).find('.diminuir').autocomplete(
    {
      source: "app/view/buscaProduto.php",
     minLength: 1
    })
	$(".total"+next).maskMoney({symbol:'', showSymbol:true, thousands:'', decimal:'.', symbolStay: true});	
        //$(':hidden').val(next);
        $('#row').val($('#lista tbody').children('tr').length);
        return false;
    });
    
    
            
            
    $('form').submit(function(){
		
        var parametros = $(this).serialize();
		
        $.get(
        $(this).attr('action'),
        parametros,
        function(data){
            $('#resultado').empty().append(data);
        },
        "html"
    )
		
        return false;
		
    });
	
    $('#enviar').click(function(){
        $('form').submit();
    });
	
    $(':text').live('focus',function(){
        $(this).closest('tr').addClass('input-focus');
    }).live('blur',function(){
        $(this).closest('tr').removeClass();
    });
        
    $("#menos").click(function(){
        if($("tr").length == 1){
            alert("nao e possível remover todas as combos")
        }else{
            $("tr:last").remove();
            
        }
    });

});

function estoq() 
    {
    var v = $(this);
    var retorno = null;
    var id = v.val().split(",");
    

    if(lop==''){lop = 2;}else{lop = lop+1;}

     v.parent().next().children("input").val('Carregando...');
    $('#tmp_name').load('app/view/buscaProdutonfs.php?text=' + id[0], function(){

    retorno = $('#tmp_name').html();
    retorno = retorno.split("|");
    console.info(retorno);

    v.parent().next().children("input").val(retorno[0]);
    v.parent().next().next().children("input").val(retorno[1]);
    }
); 

}  