$("body").on("click", "a[href*='createstatus']", function(e){   
    $.ajax({
        url: this,                             
        success: function (data) {
		$('#req-setup').html(data);
        }
    });
});
$("body").on("click", "a[href*='createdatereturn']", function(e){   
    $.ajax({
        url: this,                             
        success: function (data) {
		$('#req-setup').html(data);
        }
    });
});
//$.fn.modal.Constructor.prototype.enforceFocus = function() {};


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

$("body").on("click", "a[href*='addparts']", function(e){   
    $.ajax({
        url: this,                             
        success: function (data) {
		$('#inventory-parts-setup').html(data);
        }
    });
});
$("body").on("click", "a[href*='updatee']", function(e){   
    $.ajax({
        url: this,                             
        success: function (data) {
		$('#inventory-parts-setup').html(data);
        }
    });
});
/*
$("input[type='checkbox']").click(function(e){
	if ($(this).is(':checked')){
		$(this).parent().parent().addClass('info');
	} else {
		$(this).parent().parent().removeClass('info');
	}
})
*/