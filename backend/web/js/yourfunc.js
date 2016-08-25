$(document).ready(function() {
	$( "#yourSelect" ).change(function()
	{
		if($("select#yourSelect").val() != '')
		{
			$.ajax(
			{
				type: 'GET',
				url: 'index.php?r=abemployee/doit',
				data: 'id=' + $("select#yourSelect").val(),
				success: function(data)
				{
					if (data==0)
					{
						//alert('Данные отсутствуют.');
						$("#abemployee-id_employee").empty();
						$("#abemployee-id_employee").append( $('<option value="">Нет данных</option>'));
					}
					else
					{
						$("#abemployee-id_employee").empty();
						$("#abemployee-id_employee").append( $(data));
						//alert('Данные получены.');
					}
				}
			});
		}
	});
});