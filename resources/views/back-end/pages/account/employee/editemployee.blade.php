<div id="modal-edit-employee" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cập nhật thông tin nhân viên</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="modal" id="editemployee" role="form" enctype="multipart/form-data"
                oninput='renewpass.setCustomValidity(renewpass.value != newpass.value ? "Mật khẩu nhập lại không đúng." : "")'>
                    <div class="form-group">
                        <label for="">Tên:</label>
                        <input name="name" type="text" class="form-control" id="edit-name-employee">
                        <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                    </div>
                    <div class="form-group">
                        <label for="">Email :</label>
                        <input name="email" type="email" class="form-control" id="edit-email-employee">
                        <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                    </div>
                    <div class="form-group">
                        <label for="">Điện thoại :</label>
                        <input name="phone" type="text" class="form-control" id="edit-phone-employee">
                        <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                    </div>
                    <div class="form-group">
                        <label for="">Mật khẩu mới:</label>
                        <input name="newpass" type="password" class="form-control" id="edit-newpass-employee">
                        <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                    </div>
                    <div class="form-group">
                        <label for="">Nhập lại mật khẩu :</label>
                        <input name="renewpass" type="password" class="form-control" id="edit-renewpass-employee">
                        <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                    </div>
                    <input type="hidden" value="" id="id-employee" name="id">
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Cập nhật</button>
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Đóng</button>
                  </div>
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
    $(document).on('submit', '#editemployee', function (e) {
      e.preventDefault();
      $.ajax({
          method: "POST",
          url: "admin/updateEmployee",
          data: new FormData(this),
          dataType:'JSON',
          contentType: false,
          cache: false,
          processData: false,
          success: (data) => {
              if(data.error){
                  toastr['info'](data.error);
              }else{
                  toastr['info']('Cập nhật nhân viên thành công');
                  location.reload();
              }
          }
      })
    })
  </script>