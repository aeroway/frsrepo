	$('#search_text').keyup(function()
	{
		var txt = $(this).val();
		if(txt != '')
		{
			$.ajax({
				url:"index.php?r=questions/questions/search",
				method:"post",
				data:{search:txt},
				dataType:"text",
				success:function(data)
				{
					$('#result').html(data);
				}
			});
		}
		else
		{
			$('#result').html('');
		}
	});