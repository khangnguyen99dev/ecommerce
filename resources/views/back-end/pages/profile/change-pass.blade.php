@extends('back-end.layouts.master')

@section('title')
	Thông tin cá nhân
@endsection

@section('content')
<div class="row">
    <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Đổi mật khẩu</h5>
        </div>
        <div class="card-body pt-1">
            <div class="table-responsive">
                <form id="formChangePass" class="form-horizontal" role="form" enctype="multipart/form-data"
                oninput='repass.setCustomValidity(repass.value != newpass.value ? "Mật khẩu nhập lại không đúng." : "")'>
                    <div class="form-group">
                      <label for="password">Mật khẩu cũ:</label>
                      <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="newpass">Nhập mật khẩu mới:</label>
                        <input type="password" class="form-control" id="newpass" name="newpass" required>
                    </div>
                    <div class="form-group">
                        <label for="repass">Nhập lại mật khẩu mới:</label>
                        <input type="password" class="form-control" id="repass" name="repass" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                </form>
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
    $(document).on('submit', '#formChangePass', function (e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "/updatePass",
            data: new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: (data) => {
                if(data.error){
                    toastr['info'](data.error);
                }else{
                    toastr['info']('Cập nhật thành công');
                    location.reload();
                }
            }
        })
    })
</script>
@endsection
