@extends('back-end.layouts.master')

@section('title')
	Giao hàng
@endsection

@section('content')
<div class="row">
    <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng</h5>
        </div>
        <div class="card-body pt-1">
            <div class="table-responsive">
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên KH</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Tổng tiền</th>
                            <th>Ghi chú</th>
                            <th style="width: 100px">Sự kiện</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên KH</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Tổng tiền</th>
                            <th>Ghi chú</th>
                            <th>Sự kiện</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($delivery as $value)
                        <tr class="delivery{{$value->id}}">
                            <td>{{ $value->code_order }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->phone }}</td>
                            <td>{{ $value->address }}</td>
                            <td>{{ number_format($value->money,0,'.','.')}}</td>
                            <td>{{ $value->message }}</td>
                            <td>
                                <a href="#" class="show-modal-delivery btn btn-info btn-sm" data-target="#modal-show-delivery" data-toggle="modal" data-id="{{$value->id}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <button class="btn btn-danger btn-sm btn-order-show" data-target="#modal-accept-delivery" data-toggle="modal"  data-id="{{$value->id}}" data-idOrderDelivery="{{$value->code_order}}">Xác nhận</button>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('back-end.pages.delivery.acceptDelivery')

@include('back-end.pages.delivery.showDelivery')
<script>
    $(document).ready( function () {
        $('#table').DataTable();
    });
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $(document).on('click','.btn-order-show', function (e) {
      e.preventDefault();
      let id = $(this).data('id');
      $('#id-accept-order').val(id);
      $('.nameDelivery').html($(this).data('idorderdelivery'));

  })
    $(document).on('click','.js-btn-accept-delivery', function (e) {
        let id = $('#id-accept-order').val();
        $.ajax({
            type: 'POST',
            url: 'updateDelivery/'+id,
            success: (data) => {
                if(data.error){
                    toastr["info"](data.error);
                }else{
                    toastr["info"](data.success);
                    location.reload();
                }
            }
        })
    })

    $(document).on('click','.show-modal-delivery', function (e) {
        let id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: 'order/'+id,
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
            }
        })
    })
</script>
@endsection
