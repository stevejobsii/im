$(function () {

    $('.info-btn').on('click', function (e) {
        e.preventDefault();
        var orderId = $(this).attr('data-order');
        $.get('order/' + orderId, function (response) {
            $('#data-table').empty().append($(response));
            $('#orderModal').modal('show');
        });
    });

    $('.deliver_goods').on('click', function (e) {
        e.preventDefault();
        var orderId = $(this).attr('data-order');
        $.post('deliver_goods/' + orderId, function (response) {
            if($response == 1){
            	alert"已经发货";
            }else{
            	alert"错误";
            }
        });
    });
//sdf
});

