<style>
    .startDay , .endDay {
        z-index: 100000 !important;
    }
</style>
<div id="modal-add-promotion" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm khuyến mãi</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="form-promotion">
                    <div class="form-group">
                        <label for="">Tên khuyến mãi</label>
                        <input name="name" type="text" required class="form-control" id="name-promotional-add" placeholder="Nhập vào tên khuyến mãi">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Khuyến mãi %</label>
                        <input name="promotional" type="number" min="0" max="100" class="form-control" id="number-promotional" required>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Ngày bắt đầu</label>
                        <div class="input-group" >
                            <input type="datetime-local" class="form-control" name="startDay" placeholder="Chọn ngày bắt đầu" required/>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>                      
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Ngày kết thúc</label>
                        <div class="input-group">
                            <input type="datetime-local" class="form-control" name="endDay" placeholder="Chọn ngày kết thúc" required/>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>                    
                        <span class="form-message"></span>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">
                            Thêm mới
                        </button>
                        <button class="btn btn-warning" type="button" data-dismiss="modal">
                            Đóng
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('submit', '#form-promotion', function (e) {
      e.preventDefault();
      $.ajax({
          method: "POST",
          url: "admin/addPromotion",
          data: new FormData(this),
          dataType:'JSON',
          contentType: false,
          cache: false,
          processData: false,
          success: (data) => {
              if(data.error){
                  toastr['info'](data.error);
              }else{
                  toastr['info']('Thêm khuyến mãi thành công');
                  location.reload();
              }
          }
      })
    })
</script>