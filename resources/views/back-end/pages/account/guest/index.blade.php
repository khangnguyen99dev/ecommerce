@extends('back-end.layouts.master')

@section('title')
	Tài khoản khách hàng
@endsection

@section('content')
<div class="row">
    <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Danh sách khách hàng</h5>
        </div>
        <div class="card-body pt-1">
            <div class="table-responsive">
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Giới tính</th>
                            <th>Khóa tài khoản</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Giới tính</th>
                            <th>Khóa tài khoản</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        {{ csrf_field() }}
                        @foreach ($guest as $value)
                        <tr class="guest{{$value->id}}">
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
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $(document).ready( function () {
        $('#table').DataTable();
    } );
    $(document).on('click', '.account', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let status = 0;
        if($(this).hasClass('blockaccount')) {
            status = 1;
        }
        $.ajax({
            type: 'POST',
            url: 'admin/accountStatus/'+id,
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
</script>
@endsection
