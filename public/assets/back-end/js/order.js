$(document).on('click', '.show-model-order', function() {
    let status='';
    if($(this).data('status') == 1){
        status = 'Đã xử lý'
    }else{
        status = 'Đang xử lý'
    }
   $('#id').text($(this).data('id'));
   $('#name').text($(this).data('name'));
   $('#address').text($(this).data('address'));
   $('#money').text($(this).data('money'));
   $('#phone').text($(this).data('phone'));
   $('#created_at').text($(this).data('created_at'));
});