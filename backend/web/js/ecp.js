$(document).ready(function() {
    /* ЭЦП */
    $( "#yourSelect" ).change(function() {
        if($("select#yourSelect").val() != '') {
            $.ajax({
                type: 'GET',
                url: 'index.php?r=empl-ecp/doit',
                data: 'id=' + $("select#yourSelect").val(),
                success: function(data) {
                    if (data==0) {
                        //alert('Данные отсутствуют.');
                        $("#emplecp-idm_empl").empty();
                        $("#emplecp-idm_empl").append( $('<option value="">Нет данных</option>'));
                    } else {
                        $("#emplecp-idm_empl").empty();
                        $("#emplecp-idm_empl").append($(data));
                        //alert('Данные получены.');
                    }
                }
            });
        }
    });
});