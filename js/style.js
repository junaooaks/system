/*<![CDATA[*/
	
	$(document).ready(function () {

		var value = $('#button input').val();
		var name = $('#button input').attr('name');
		
		$('#button input').remove();
		$('#button').html('<a href="#" class="cssSubmitButton" rel=' + name + '>' + value + '</a>');	
		
		$('#button a').live('click', function () {			

			//You can use default form submission or with the ajax call below
			//In this example, I'm using a dummy php call so that you can see the loading animation
			//$('form[name=' + $(this).attr('rel') + ']').submit();			
			
			var link = $(this);
			
			$.ajax({
				url : 'load.php',
				data: '',
				type: 'GET',
				cache: 'false',
				beforeSend: function () {
					link.addClass('loading');					
				},
				success: function () {
					link.removeClass('loading');		
					alert('Submitted');
				}			
			});
			
		});
		
	});
	
	/*]]>*/