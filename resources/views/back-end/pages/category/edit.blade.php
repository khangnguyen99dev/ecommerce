<div id="modal-edit"class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Chỉnh sửa danh mục</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="modal">
          <div class="form-group">
            <label for="">ID :</label>
            <input name="name" type="text" class="form-control" id="id-edit" disabled>
            <!-- <p class="error text-center alert alert-danger hidden"></p> -->
          </div>
          <div class="form-group">
            <label for="">Tên danh mục :</label>
            <input name="name" type="text" class="form-control" id="name-edit" >
            <!-- <p class="error text-center alert alert-danger hidden"></p> -->
          </div>
          <div class="form-group">
            <label for="">Slug :</label>
            <input name="name" type="text" class="form-control" id="slug-edit">
            <!-- <p class="error text-center alert alert-danger hidden"></p> -->
          </div>
          <div class="form-group">
            <label for="">Trạng thái</label>
            <select name="status" id="status-edit" class="form-control" required="required">
              <option value="1">Hiển thị</option>
              <option value="0">Ẩn</option>
            </select>
            <!-- <p class="error text-center alert alert-danger hidden"></p> -->
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="update-category">Lưu</button>

        <button type="button" class="btn btn-warning" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>