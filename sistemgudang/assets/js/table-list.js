function reload_data() {
    data_send = new Object();
    data_send = $('#display-table').serializeObject();
	//console.log($('#display-table').attr('action'));

    $.ajax({
        type : 'POST',
        dataType : 'json',
        data : data_send,
        url  : $('#display-table').attr('action'),
        success : function(result) {
            if(result == null) {
                var tr_count = $( "#listed-table thead tr th" ).length;
                $('#listed-table tbody').html("<tr><td colspan='"+tr_count+"' class='alert alert-danger'>Terjadi Kesalahan Pada Sistem!</td></tr>");
                return;
            }
            //console.log(result.content);
            if(result.content === undefined) {

                var tr_count = $( "#listed-table thead tr th" ).length;
                $('#listed-table tbody').html("<tr><td colspan='"+tr_count+"'  class='alert alert-danger'>Terjadi Kesalahan Pada Sistem!</td></tr>");
                return;
            }
            else {
                if(result.hasPrev == 'true') {
                    $('.prev-page').removeClass('disabled');
                }else {
                    $('.prev-page').addClass('disabled');
                }

                if(result.hasNext == 'true') {
                    $('.next-page').removeClass('disabled');
                }else {
                    $('.next-page').addClass('disabled');
                }


                $('#listed-table tbody').html(result.content);
            }
        },
        beforeSend : function(){
            var tr_count = $( "#listed-table thead tr th" ).length;
            $('#listed-table tbody').html("<tr><td colspan='"+tr_count+"'  class='alert alert-info'>Loading...</td></tr>");
        }
    });
}

function reload_data2(){
    data_send = new Object();
    data_send = $('#display-table').serializeObject();
    //console.log($('#display-table').attr('action'));
    $.ajax({
        type : 'POST',
        dataType : 'json',
        data : data_send,
        url  : $('#display-table2').attr('action'),
        success : function(result) {
            if(result == null) {
                var tr_count = $( "#listed-table2 thead tr th" ).length;
                $('#listed-table2 tbody').html("<tr><td colspan='"+tr_count+"' class='alert alert-danger'>Terjadi Kesalahan Pada Sistem!</td></tr>");
                return;
            }
            //console.log(result.content);
            if(result.content === undefined) {

                var tr_count = $( "#listed-table2 thead tr th" ).length;
                $('#listed-table2 tbody').html("<tr><td colspan='"+tr_count+"'  class='alert alert-danger'>Terjadi Kesalahan Pada Sistem!</td></tr>");
                return;
            }
            else {
                if(result.hasPrev == 'true') {
                    $('.prev-page').removeClass('disabled');
                }else {
                    $('.prev-page').addClass('disabled');
                }

                if(result.hasNext == 'true') {
                    $('.next-page').removeClass('disabled');
                }else {
                    $('.next-page').addClass('disabled');
                }


                $('#listed-table2 tbody').html(result.content);
            }
        },
        beforeSend : function(){
            var tr_count = $( "#listed-table2 thead tr th" ).length;
            $('#listed-table2 tbody').html("<tr><td colspan='"+tr_count+"'  class='alert alert-info'>Loading...</td></tr>");
        }
    });
}

$(document).ready(function(){
    reload_data();
    reload_data2();
	console.log($('#display-table').serializeObject());
	
    $('#select-filter').click(function(){

        if($('#tanggal') !== undefined) {
             var tahun = $('#year-choose').val();
            var bulan = $('#month-choose').val();
            console.log();
            $('#tanggal').html(tahun+'-'+bulan);
        }

        reload_data();
        reload_data2();

        return false;
    })

    $('.prev-page').click(function() {
        page_now = $('.current-page').val();

        if(page_now > 1) {
            $('.current-page').val(parseInt(page_now) - 1);
            reload_data2();
            reload_data();
        }

        return false;
    })

    $('.next-page').click(function(){
        page_now = $('.current-page').val();

        if(!$(this).hasClass('disabled')) {
            $('.current-page').val(parseInt(page_now) + 1);
            reload_data();
            reload_data2();
        }

        return false;
    });
});
