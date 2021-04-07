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

            <table class="table table-bordered " id="table">
                    <thead>
                        <tr id="title-table">
                            <th>Mã đơn hàng</th>
                            <th>Tên người đặt</th>
                            <th>Tổng giá tiền</th>
                            <th>Trạng thái</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody id="orderItem">
                            <!-- render order -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('back-end.pages.order.show')
<script>

$(document).ready((e)=> {
    const order = async () => {
        const response = await fetch('http://kanestore.com/api/order', {
            method: 'GET',
            dataType: 'json',
        });
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return await response.json(); 
    }


    const showOrder = async () => {
        let data = [];
        try {
            data = await order();
        } catch (error) {
            console.log(error);
        }
        let html ='';
        $.each(data.order, (index, value)=> {
            html+=`
            <tr class="order${value.id}">
                <td>${value.code_order}</td>
                <td>${value.name}</td>
                <td>${value.money}</td>
                <td class="status${value.id}">`;
                if(value.status ==1){
                    html+=`Đã xử lý`;
                }else if(value.status == 2){
                    html+=`Hủy đơn hàng`;
                }else{
                    html+=`Chưa xử lý `;
                }              
                html+=`</td>
                <td>
                    <button class="show-model-order btn btn-info btn-sm" data-target="#modal-show-order" data-toggle="modal" data-id="${value.id}">
                        <i class="fa fa-eye"></i> Xem chi tiết
                    </button>
                </td>
            </tr>
            `;
        })
        return $('#orderItem').html(html);
    }

    showOrder();

    $(document).on('click','.show-model-order', function (e) {
        let id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: 'api/order/'+id,
            success: (data)=>{
                console.log(data)
                let order = data.orderDetail;
                $('#name').text(order.name);
                $('#address').text(order.address);
                $('#phone').text(order.phone);
                $('#money').text(order.money);
                $('#message').text(order.message);

                let user = data.orderDetail.user;

                $('#idUser').text(user.id);
                $('#nameUser').text(user.name);
                $('#emailUser').text(user.email);



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
                        <td class="qtyItem">`
                        if(status == 0){
                            html+=`<input type="number" value="${value.quantity}" data-id="${value.id}" data-idproduct="${value.product.id}" class="quantity" data-qty="${value.quantity}" style="width: 50px">`;
                        }else if(status ==1){
                            html += `<p class="quantity" data-qty="${value.quantity}" data-idproduct="${value.product.id}">${value.quantity}</p>`;
                        }      
                        html+=`</td>
                        <td>${value.price}</td>
                        <td>${value.price*value.quantity}</td>
                    </tr>
                    `;
                })
                html+=`<input type="hidden" id="idOrder" value="${data.orderDetail.id}">`;
                $('#product').html(html);

                switch (status) {
                    case 0:
                        $('.select-form-order').val(0);
                        $('#formPdf').addClass('d-none');
                        break;
                    case 1:
                        $('.select-form-order').val(1);
                        $('#formPdf').removeClass('d-none');
                        break;
                    case 2:
                        $('.select-form-order').val(2);
                        break; 
                }

            }
        })
    })

    $(document).on('change', '.quantity', function (e) {
        let id = $(this).data('id');
        let qty = $(this).val();
        let qtyStock = $(this).parent().parent().find('.qtyStock').data('qty');
        let oldQty = $(this).data('qty');
        toastr.options = {
            "debug": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 1000,
            "extendedTimeOut": 1000
        }	
        $.ajax({
            type: 'PUT',
            url: 'api/order/'+id,
            dataType: 'JSON',
            data: {
                'quantity': qty,
            },
            success: (data)=> {
                let result= data.orderDetail;
                if(data.error){
                    toastr["info"](data.error);
                }else{
                    let qty = result.quantity;
                    let qtyStock = result.qtyStock;
                    $('.quantity').attr('data-qty',result.quantity);
                    if(qty > qtyStock) {
                        $('.order'+data.orderDetail.id).addClass('bg-warning text-dark');
                    }else{
                        $('.order'+data.orderDetail.id).removeClass('bg-warning text-dark');
                    }
                    toastr["info"]('Cập nhật số lượng thành công');
                }
            }
        })
    })

    $(document).on('change','.select-form-order', function (e) {
        let value = parseInt($(this).val());
        let quantity = $('.quantity');
        let data = [];
        let error = false;
        let idOrder = $('#idOrder').val();
        toastr.options = {
            "debug": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 1000,
            "extendedTimeOut": 1000
        }	
        switch(value) {
            case 0:
                $.each(quantity, (index, value)=> {
                    let qty = $(value).data('qty');
                    data.push({
                        'id': $(value).data('idproduct'),
                        'qty' : qty,
                    })
                })
                if(error) {
                    toastr["info"](error);
                }else{
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('orderProcess') }}",
                        data: {
                            data: data,
                            idOrder: idOrder,
                            option: value
                        },
                        success: (data)=> {
                            if(data.error) {
                                toastr["info"](error);
                            }else{
                                $('#formPdf').addClass('d-none');
                                $('.status'+data.orderDetail.id).html('Chờ xử lý');
                                toastr["info"]('Thay đổi cập nhật thành công');
                                let status = parseInt(data.orderDetail.status);
                                let idOrder = data.orderDetail.id;
                                let orderDetail = data.orderDetail.order_detail;
                                renderProduct(orderDetail,status,idOrder);
                            }
                        }
                    })
                }
                break;
            case 1:          
                $.each(quantity, (index, value)=> {
                    let qtyStock = $(value).parent().parent().find('.qtyStock').data('qty');
                    let qty = $(value).val();
                    if(qty > qtyStock) {
                        return error = `Số lượng mua phải nhỏ hơn số lượng trong kho`;
                    }else{
                        data.push({
                            'id': $(value).data('idproduct'),
                            'qty' : qty,
                        })
                    }
                })

                if(error) {
                    toastr["info"](error);
                    $(this).val(0);
                }else{
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('orderProcess') }}",
                        data: {
                            data: data,
                            idOrder: idOrder,
                            option: value
                        },
                        success: (data)=> {                           
                            if(data.error) {
                                toastr["info"](error);
                            }else{
                                $('#formPdf').removeClass('d-none');
                                $('.status'+data.orderDetail.id).html('Đã xử lý');
                                toastr["info"]('Thay đổi cập nhật thành công');
                                let status = parseInt(data.orderDetail.status);
                                let idOrder = data.orderDetail.id;
                                let orderDetail = data.orderDetail.order_detail;
                                renderProduct(orderDetail,status,idOrder);
                            }
                        }
                    })
                }
                break;
            case 2: 
                
                break;
            }
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
                <td>${value.price}</td>
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
