<div id="modal-delete-promotion" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">    
          <h4 class="modal-title">Xóa khuyến mãi</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="deleteContent">
            Bạn có chắc chắn muốn xóa <span class="namePromotion"></span> có ID: 
            <span class="hidden idPromotion"></span> ?
          </div>
  
        </div>
        <div class="modal-footer">
  
          <button type="button" class="btn btn-danger" id="delete-promotional" data-dismiss="modal">Xóa</button>
  
          <button type="button" class="btn btn-warning" data-dismiss="modal">Đóng</button>
  
        </div>
      </div>
    </div>
  </div>

<script>
    $(document).on('click', '#delete-promotional', function(e) {
        e.preventDefault();
        let id = $('.idPromotion').text();
        $.ajax({
            type: 'DELETE',
            url: 'admin/deletePromotion/'+id,
            success: (data)=> {
                if(data.error){
                  toastr['info'](data.error);
                }else{
                    toastr['info']('Xóa khuyến mãi thành công');
                    location.reload();
                }
            }
        })
    })
</script>