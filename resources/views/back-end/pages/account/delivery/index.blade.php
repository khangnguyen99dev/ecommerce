@extends('back-end.layouts.master')

@section('title')
	Tài khoản giao hàng
@endsection

@section('content')
<div class="row">
    <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Danh sách giao hàng</h5>
        </div>
        <div class="card-body pt-1">
            <div class="table-responsive">
                <a href="#" class="add-delivery btn btn-success btn-sm mb-1" data-target="#modal-add-delivery" data-toggle="modal">
                    <i class="fas fa-plus"></i> Thêm nhân viên giao hàng
                </a>
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Giới tính</th>
                            <th>Sự kiện</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Giới tính</th>
                            <th>Sự kiện</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        {{ csrf_field() }}
                        @foreach ($delivery as $value)
                        <tr class="delivery{{$value->id}}">
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->phone }}</td>
                            <td>
                                @if( $value->gender == 1)
                                {{"Nam"}}
                                @elseif($value->gender == 2)
                                {{"Nữ"}}
                                @else 
                                {{"Khác"}}
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm account {{ ($value->status == 0) ? 'blockaccount' : 'unblockaccount'}}" data-id="{{$value->id}}">
                                    @if($value->status == 0)
                                        <i class="fa fa-eye"></i>
                                    @else 
                                        <i class="fas fa-eye-slash"></i>
                                    @endif
                                </a>
                                <a href="#" class="edit-modal-delivery btn btn-warning btn-sm" data-target="#modal-edit-delivery" data-toggle="modal" data-id="{{$value->id}}" data-name="{{$value->name}}" data-email="{{$value->email}}" data-phone="{{$value->phone}}">
                                    <i class="far fa-edit"></i>
                                </a>
                                <a href="#" class="delete-modal-delivery btn btn-danger btn-sm" data-target="#modal-delete-delivery" data-toggle="modal" data-id="{{$value->id}}" data-name="{{$value->name}}">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('back-end.pages.account.delivery.adddelivery')
@include('back-end.pages.account.delivery.editdelivery')
@include('back-end.pages.account.delivery.deletedelivery')
<script>
    // $(document).ready( function () {
    //     $('#table').DataTable();
    // } );
    $(document).on('click', '.account', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let status = 0;
        if($(this).hasClass('blockaccount')) {
            status = 1;
        }
        $.ajax({
            type: 'POST',
            url: 'api/accountStatus/'+id,
            data: {
                status:status,
            },
            success: (data) => {
                if(data.error) {
                    toastr['info'](data.error);
                }else{
                    if(data.status == 1) {
                        toastr['info']('Khóa tài khoản thành công');
                    }else{
                        toastr['info']('Mở khóa tài khoản thành công');
                    }
                    location.reload();
                }
            }
        })
    })

    $(document).on('click', '.edit-modal-delivery', function (e) {
        e.preventDefault();
        $('#edit-name-delivery').val($(this).data('name'));
        $('#edit-email-delivery').val($(this).data('email'));
        $('#edit-phone-delivery').val($(this).data('phone'));
        $('#id-delivery').val($(this).data('id'));
    })

    $(document).on('click', '.delete-modal-delivery', function (e) {
        e.preventDefault();

        $('.nameEmployee').html($(this).data('name'));
        $('.idEmployee').html($(this).data('id'));
    })

    $(document).on('click', '#delete-delivery', function (e) {
        e.preventDefault();

        let id = $('.idEmployee').text();
        $.ajax({
            type: 'DELETE',
            url: 'api/deleteEmployee/'+id,
            success: (data) => {
                if(data.error) {
                    toastr['info'](data.error);
                }else{
                    toastr['info']('Xóa nhân viên thành công');
                    location.reload();
                }
            }
        })       
    })

</script>
@endsection
