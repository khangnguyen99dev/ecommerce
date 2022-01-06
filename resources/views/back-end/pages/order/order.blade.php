@extends('back-end.layouts.master')

@section('title')
	Danh sách đơn đặt hàng
@endsection

@section('content')

<div class="row">
    <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Danh sách đơn đặt hàng</h5>
        </div>
        <div class="card-body pt-1">
            <div class="table-responsive">
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên người đặt</th>
                            <th>Tổng giá tiền</th>
                            <th>Trạng thái</th>
                            <th>Sự kiện</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên người đặt</th>
                            <th>Tổng giá tiền</th>
                            <th>Trạng thái</th>
                            <th>Sự kiện</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($order as $value)
                        <tr class="order{{$value->id}}">
                            <td>{{ $value->code_order }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ number_format($value->money,0,'.','.')}}</td>
                            <td class="status${value.id}">
                                @if($value->status == 0)
                                    {{"Chưa xử lý"}}
                                @else   
                                    {{"Đã xử lý"}}
                                @endif
                            </td>
                            <td>
                                <button class="show-model-order btn btn-info btn-sm" data-target="#modal-show-order" data-toggle="modal" data-id="{{ $value->id }}">
                                    <i class="fa fa-eye"></i> Xem chi tiết
                                </button>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('back-end.pages.order.show')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready((e)=> {
    $('#table').DataTable();
    $(document).on('click','.show-model-order', function (e) {
        let id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: '/order/'+id,
            success: (data)=>{
                console.log(data)
                let order = data.orderDetail;
                $('#name').text(order.name);
                $('#address').text(order.address);
                $('#phone').text(order.phone);
                $('#money').text(Intl.NumberFormat().format(order.money)+'₫');
                $('#message').text(order.message);

                let user = data.orderDetail.user;

                $('#idUser').text(user.id);
                $('#nameUser').text(user.name);
                $('#emailUser').text(user.email);

                $('#idOrder').val(data.id); 


                let status = parseInt(data.orderDetail.status);

                let orderDetail = data.orderDetail.order_detail;
                
                let html = '';
                orderDetail.map((value)=>{
                    if(status == 0){
                        if(value.product.quantity < value.quantity) {
                            html+=`<tr class="order${value.id} bg-warning text-dark">`;
                        }else{
                            html+=`<tr class="order${value.id}">`;
                        }
                    }else{
                        html+=`<tr class="order${value.id}">`;
                    }


                    html+=`
                        <td>${value.product.name}</td>
                        <td class="image"><img src="../assets/img/upload/product/${value.product.image}" alt="${value.product.name}" style="width: 50px"></td>
                        <td class="qtyStock" data-qty="${value.product.quantity}">${value.product.quantity}</td>
                        <td class="qtyItem"><p class="quantity" data-qty="${value.quantity}" data-idproduct="${value.product.id}">${value.quantity}</p></td>
                        <td>${Intl.NumberFormat().format(value.price)+'₫'}</td>
                        <td>${Intl.NumberFormat().format(value.price*value.quantity)+'₫'}</td>
                    </tr>
                    `;
                })
                html+=`<input type="hidden" id="idOrder" value="${data.orderDetail.id}">`;

                $('#products').html(html);


                if(status == 0) {
                    $('#formPdf').addClass('d-none');
                    $('.accept_order').removeClass('d-none');  
                                   
                }else{
                    $('#formPdf').removeClass('d-none');
                    $('.accept_order').addClass('d-none');
                }             
            }
        })
    })

    $(document).on('click', '.accept_order', function (e) {
        let idOrder = $(this).parents().find('#idOrder').val();

        toastr.options = {
            "debug": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 1000,
            "extendedTimeOut": 1000
        }
        $.post('/acceptOrder/'+idOrder, function (data) {
            if(data.error){
                toastr["info"](data.error);
            }else{
                toastr["info"]("Duyệt đơn hàng thành công");
                location.reload();
            }
        })
    })


    function renderProduct(orderDetail,status,idOrder) {
        let html = '';               
        orderDetail.map((value)=> {
            html+=`
            <tr class="order${value.id}">
                <td>${value.product.name}</td>
                <td class="image"><img src="../assets/img/upload/product/${value.product.image}" alt="${value.product.name}" style="width: 50px"></td>
                <td class="qtyStock" data-qty="${value.product.quantity}">${value.product.quantity}</td>
                <td class="qtyItem">`;
                if(status == 0){
                    html+=`<input type="number" value="${value.quantity}" data-id="${value.id}" data-idproduct="${value.product.id}" class="quantity" data-qty="${value.quantity}" style="width: 50px">`;
                }else if(status ==1){
                    html += `<p class="quantity" data-qty="${value.quantity}" data-idproduct="${value.product.id}">${value.quantity}</p>`;
                }      
                html+=`</td>
                <td>${Intl.NumberFormat().format(value.price)+'₫'}</td>
                <td>${value.price*value.quantity}</td>
            </tr>
            `;
        })
        html+=`<input type="hidden" id="idOrder" value="${idOrder}">`;
        $('#product').html(html);
    }
        $(document).on('click','#printOrder', (e)=> {
            e.preventDefault();
            $('.image').hide();
            $('.qtyStock').hide();
            $('#tblOrd').val($('#table-order').html());
            $('#tblPro').val($('#table-product').html());
            $('#tblAcc').val($('#table-account').html());

            $('#formPdf').submit();
        })
})
</script>
@endsection