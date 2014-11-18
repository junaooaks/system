// JavaScript Document
$(function(){
	
    $('#mais').click(function(){
	    
        var next = $('#lista tbody').children('tr').length;
	
        
	
        $('#lista tbody').append('<tr class="remover'+next+'">' +
            '<td></td>'+
            '<input type="hidden" name="codpro' + next + '" />'+
            '<td><input type="text" name="item' + next + '" size="70" class="effect auto" onkeyup="up(this)" /></td>' + 
            '<td><input type="text" name="quantidade' + next + '" size="5" class="effect" onkeyup="up(this)"/></td>' +
            '<td><input type="text" name="uni' + next + '" size="8" class="effect" onkeyup="up(this)" /></td>' +
            '<td><input type="text" name="custo' + next + '" size="5" id="soma'+next+'" class="effect soma total'+next+'" onBlur="calculateSum();"/></td>' +
            '<td><input type="text" name="st' + next + '" size="5" class="effect stt total'+next+'" onBlur="calculateST()" /></td>' +
            '<td><input type="text" name="ipi' + next + '" size="5" class="effect ip total'+next+'" onBlur="calculaIPI()" /></td>' +
            '<td><input type="text" name="frete' + next + '" size="5" class="effect fre total'+next+'" onBlur="calculateFRETE()" /></td>' +
            '<td align="center" id="menos'+ next +'"><a href="#" onclick ="$(this).parent().parent().remove(); calculateSum();calculateFRETE();calculaIPI();calculateST();"><img src="resources/images/menos.png" border="0" class="diminuir"/></a></td>'+
            '</tr>');
        //....  
        
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