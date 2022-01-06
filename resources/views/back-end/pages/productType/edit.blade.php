<div id="modal-edit-productType"class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Chỉnh sửa danh mục</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="modal" id="form-edit-productType">
          <div class="form-group">
            <label for="">ID :</label>
            <input name="name" type="text" class="form-control" id="id-edit-productType" disabled required>
            <!-- <p class="error text-center alert alert-danger hidden"></p> -->
          </div>
          <div class="form-group">
            <label for="">Tên loại sản phẩm :</label>
            <input name="name" type="text" class="form-control" id="name-edit-productType" required>
            <!-- <p class="error text-center alert alert-danger hidden"></p> -->
          </div>
          <div class="form-group">
            <label for="">Slug :</label>
            <input name="name" type="text" class="form-control" id="slug-edit-productType" required>
            <!-- <p class="error text-center alert alert-danger hidden"></p> -->
          </div>
          <div class="form-group">
            <label for="">Danh mục</label>
            <select name="category" id="category-edit-productType" class="form-control" required="required">
              @foreach($category as $key => $value)
              <option value="{{ $value->id }}">{{ $value->name }}</option>
              @endforeach
            </select>
            <!-- <p class="error text-center alert alert-danger hidden"></p> -->
          </div>
          <div class="form-group">
            <label for="">Trạng thái</label>
            <select name="status" id="status-edit-productType" class="form-control" required="required">
              <option value="1">Hiển thị</option>
              <option value="0">Ẩn</option>
            </select>
            <!-- <p class="error text-center alert alert-danger hidden"></p> -->
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Cập nhật</button>
    
            <button type="button" class="btn btn-warning" data-dismiss="modal">Đóng</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>