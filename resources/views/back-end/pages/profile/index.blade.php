@extends('back-end.layouts.master')

@section('title')
	Thông tin cá nhân
@endsection

@section('content')
<div class="row">
    <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Thông tin cá nhân</h5>
        </div>
        <div class="card-body pt-1">
            <div class="table-responsive">
                <form id="formProfile" class="form-horizontal" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name">Tên:</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{ $user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="gender">Giới tính:</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="Male" value="1" {{($user->gender == 1) ? "checked" : ""}}>
                            <label class="form-check-label" for="Male">Nam</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="Female" value="2" {{($user->gender == 2) ? "checked" : ""}}>
                            <label class="form-check-label" for="Female">Nữ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="other" value="3" {{($user->gender == 3) ? "checked" : ""}}>
                            <label class="form-check-label" for="other">Khác</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="avatar">Ảnh đại diện:</label>
                        <input type="file" class="form-control-file form-control" name="avatar" id="avatar">
                      </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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
    $(document).on('submit', '#formProfile', function(e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "/updateProfile",
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
