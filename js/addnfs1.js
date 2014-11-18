// JavaScript Document
var cont = '';
var lop = '';
$(function(){
	
    $('#mais').click(function(){
	    
        var next = $('#lista tbody').children('tr').length;
	
        $('#lista tbody').append('<tr class="remover'+next+'">' +
            '<td><input type="text" name="item' + next + '" size="70" class="effect auto" onkeyup="up(this)" onBlur="estoq(this.value)"/></td>' + 
            '<td><input type="text" name="est' + next + '" id="est'+next+'" size="5" class="effect" onkeyup="up(this)" readonly="readonly"/></td>' +
            '<td><input type="text" name="custo' + next + '" size="5" id="soma'+next+'" class="effect soma total'+next+' atri'+next+'" /></td>' +
            '<td><input type="text" name="quantidade' + next + '" size="5" class="effect" onkeyup="up(this)" onBlur="calculateSum();"/></td>' +
            '<td align="center" id="menos'+ next +'"><a href="#" onclick ="$(this).parent().parent().remove(); calculateSum();calculateFRETE();calculaIPI();calculateST();"><img src="resources/images/menos.png" border="0" class="diminuir"/></a></td>'+
            '</tr>');
        //....  
       cont = next;
        $('.remover'+next).find('.auto').autocomplete(
    {
      source: "app/view/buscaProduto.php",
     minLength: 1
    }
    
    
)
    
    $('.remover'+next).find('.diminuir').autocomplete(
    {
      source: "app/view/buscaProduto.php",
     minLength: 1
    })
	$(".total"+next).maskMoney({symbol:'', showSymbol:true, thousands:'', decimal:'.', symbolStay: true});	
        $(':hidden').val(next);
         
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

function estoq(v) 
	{ 
	
	var retorno = null;
	var id = v.split(",");

	if(lop==''){lop = 2;}else{lop = lop+1;}
	
	$('#est'+lop).val('Carregando...'); 
	$('#tmp_name').load('app/view/buscaProdutonfs.php?text=' + id[0], function(){ 

		retorno = $('#tmp_name').html();
		retorno = retorno.split("|");

		$('#est'+lop).val(retorno[0]);
		$('.atri'+lop).val(retorno[1]); 
	} 
); 

}  