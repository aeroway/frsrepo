/* Заказ дел из архива */
$("body").on("click", "a[href*='setcuruser']", function(e) {
    $.ajax({
        url: this,
        success: function (data) {
            $('#req-setup').html(data);
        }
    });
});

$("body").on("click", "a[href*='createstatus']", function(e) {
    $.ajax({
        url: this,
        success: function (data) {
            $('#req-setup').html(data);
        }
    });
});

$("body").on("click", "a[href*='createdatereturn']", function(e) {
    $.ajax({
        url: this,
        success: function (data) {
            $('#req-setup').html(data);
        }
    });
});

/* Учёт техники */
$("body").on("click", "a[href*='addparts']", function(e) {
    $.ajax({
        url: this,
        success: function (data) {
            $('#inventory-parts-setup').html(data);
        }
    });
});

$("body").on("click", "a[href*='updatee']", function(e) {
    $.ajax({
        url: this,
        success: function (data) {
            $('#inventory-parts-setup').html(data);
        }
    });
});

$("body").on("click", "a[href*='createmodal']", function(e) {
    $.ajax({
        url: this,
        success: function (data) {
            $('#planstages-modal').html(data);
        }
    });
});

$(document).ready(function() {
    /* Блокировка аккаутов */
    $("#yourSelect").change(function() {
        if($("select#yourSelect").val() != '') {
            $.ajax({
                type: 'GET',
                url: 'index.php?r=abemployee/doit',
                data: 'id=' + $("select#yourSelect").val(),
                success: function(data) {
                    if (data==0) {
                        $("#abemployee-id_employee").empty();
                        $("#abemployee-id_employee").append( $('<option value="">Нет данных</option>'));
                    } else {
                        $("#abemployee-id_employee").empty();
                        $("#abemployee-id_employee").append( $(data));
                    }
                }
            });
        }
    });

    /* Бухгалтерия */
    if($("#purchaseplan-is_percent").attr("checked") != 'checked') {
        $(".field-purchaseplan-econom").hide();
    }

    $("input[id='purchaseplan-is_percent']").click(function(e) {
        if ($(this).is(':checked')) {
            $(".field-purchaseplan-econom").show();
        } else {
            $(".field-purchaseplan-econom").hide();
        }
    });

    /* Архив */
    $(".field-req-scan_doc").hide();
    $('#req-type').change(function() {
        var select = $(this).val();
        if (select == '5') {
            $( ".field-req-scan_doc" ).show();
        } else {
            $('#req-scan_doc').val('');
            $( ".field-req-scan_doc" ).hide();
        }
    });

    /* ГЗН */
	$( "#selectPunishment" ).change(function()
	{
		if($("select#selectPunishment").val() != '')
		{
			$.ajax(
			{
				type: 'GET',
				url: 'index.php?r=gzn-object/selectpunishment',
				data: 'id=' + $("select#selectPunishment").val() + '&name="' + $("#selectPunishment option:selected").html() + '"',
				success: function(data)
				{
					if (data==0)
					{
						alert('Данные отсутствуют.');
						$("#gznobject-punishment").empty();
						$("#gznobject-punishment").append( $('<option value="">Нет данных</option>'));
					}
					else
					{
						$("#gznobject-punishment").empty();
						$("#gznobject-punishment").append( $(data));
						//alert('Данные получены.');
					}
				}
			});
		}
	});

});
