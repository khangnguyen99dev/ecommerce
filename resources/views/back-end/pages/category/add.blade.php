<div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Thêm danh mục</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form">
      		<div class="form-group">
    				<label for="">Tên danh mục</label>
    				<input name="name" type="text" class="form-control" id="name-category-add" placeholder="Nhập vào tên danh mục">
    				<!-- <p class="error text-center alert alert-danger hidden"></p> -->
    			</div>
    			<div class="form-group">
    				<label for="">Trạng thái</label>
    				<select name="status" id="status-category-add" class="form-control" required="required">
    					<option value="1">Hiển thị</option>
    					<option value="0">Ẩn</option>
    				</select>
    				<!-- <p class="error text-center alert alert-danger hidden"></p> -->
    			</div>
        </form>
      </div>
          <div class="modal-footer">
            <button class="btn btn-success" type="submit" id="add-category">
              Thêm mới
            </button>
            <button class="btn btn-warning" type="button" data-dismiss="modal">
              Đóng
            </button>
          </div>
    </div>
  </div>
</div>