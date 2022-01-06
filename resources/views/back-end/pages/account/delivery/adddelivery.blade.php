<div id="modal-add-delivery" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm nhân viên giao hàng</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="modal" id="adddelivery" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Tên:</label>
                        <input name="name" type="text" class="form-control" id="name-delivery">
                        <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                    </div>
                    <div class="form-group">
                        <label for="">Email :</label>
                        <input name="email" type="email" class="form-control" id="email-delivery">
                        <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                    </div>
                    <div class="form-group">
                        <label for="">Điện thoại :</label>
                        <input name="phone" type="text" class="form-control" id="phone-delivery">
                        <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                    </div>
                    <div class="form-group">
                        <label for="">Mật khẩu :</label>
                        <input name="password" type="password" class="form-control" id="password-delivery">
                        <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                    </div>
                    <div class="form-group">
                        <label for="">Nhập lại mật khẩu :</label>
                        <input name="repass" type="password" class="form-control" id="repass-delivery">
                        <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                    </div>
                    
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Thêm nhân viên</button>
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
    $(document).on('submit', '#adddelivery', function (e) {
      e.preventDefault();
  
      $.ajax({
          method: "POST",
          url: "api/addDelivery",
          data: new FormData(this),
          dataType:'JSON',
          contentType: false,
          cache: false,
          processData: false,
          success: (data) => {
              if(data.error){
                  toastr['info'](data.error);
              }else{
                  toastr['info']('Thêm nhân viên giao hàng thành công');
                  location.reload();
              }
          }
      })
    })
  </script>