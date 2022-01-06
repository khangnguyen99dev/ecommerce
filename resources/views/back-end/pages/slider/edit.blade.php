<div id="modal-edit-slider"class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Chỉnh sửa Banner</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" role="modal" id="formEditBanner" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">ID :</label>
                <input name="id" type="text" class="form-control" id="id-slider-edit" disabled>
            </div>
            <div class="form-group">
                <label for="">Tên slider</label>
                <input name="name" type="text" class="form-control" id="name-slider-edit" required>
            </div>         
            <div class="form-group">
                <label for="" style="display: block">Ảnh slider</label>
                <img src="" alt="" id="img-slider-show" width="120px" class="mb-2">
                <input name="image" type="file" class="form-control" id="image-slider-edit" >
            </div>

            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" class="form-control" id="description-slider-edit" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="">Trạng thái</label>
                <select name="status" id="status-slider-edit" class="form-control" required="required">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Lưu</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Đóng</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
