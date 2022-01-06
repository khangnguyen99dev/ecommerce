<div id="modal-edit-banner"class="modal fade" role="dialog">
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
                <input name="id" type="text" class="form-control" id="id-banner-edit" disabled required>
            </div>
            <div class="form-group">
                <label for="">Tên banner</label>
                <input name="name" type="text" class="form-control" id="name-banner-edit" required>
            </div>         
            <div class="form-group">
                <label for="" style="display: block">Ảnh banner</label>
                <img src="" alt="" id="img-banner-show" width="120px" class="mb-2">
                <input name="image" type="file" class="form-control" id="image-banner-edit">
            </div>

            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" class="form-control" id="description-banner-edit" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="">Trạng thái</label>
                <select name="status" id="status-banner-edit" class="form-control" required="required">
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
