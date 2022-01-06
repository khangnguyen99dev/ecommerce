<style>
    .startDay , .endDay {
        z-index: 100000 !important;
    }
</style>
<div id="modal-edit-promotion" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cập nhật khuyến mãi</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="form-edit-promotion">
                    <input type="hidden" value="" name="id" id="id-promotion-edit">
                    <div class="form-group">
                        <label for="">Tên khuyến mãi</label>
                        <input name="name" type="text" required class="form-control" id="name-promotional-edit" placeholder="Nhập vào tên khuyến mãi">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Khuyến mãi %</label>
                        <input name="promotional" type="number" min="0" max="100" class="form-control" id="number-promotional-edit" required>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Ngày bắt đầu</label>
                        <div class="input-group">
                            <input type="datetime-local" class="form-control" name="startDay" id="startDay-edit" required/>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>                      
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Ngày kết thúc</label>
                        <div class="input-group">
                            <input type="datetime-local" class="form-control" name="endDay" id="endDay-edit" required/>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>                    
                        <span class="form-message"></span>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">
                            Cập nhật
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
    $(document).on('submit', '#form-edit-promotion', function (e) {
      e.preventDefault();
    let id = $('#id-promotion-edit').val();
      $.ajax({
          method: "POST",
          url: "admin/editPromotion/"+id,
          data: new FormData(this),
          dataType:'JSON',
          contentType: false,
          cache: false,
          processData: false,
          success: (data) => {
              if(data.error){
                  toastr['info'](data.error);
              }else{
                  toastr['info']('Cập nhật khuyến mãi thành công');
                  location.reload();
              }
          }
      })
    })

$(function(){
   $('.startDay').datepicker({
      format: 'dd-mm-yyyy'
    });
});

$(function(){
   $('.endDay').datepicker({
      format: 'yyyy-mm-dd'
    });
});
</script>