<div id="modal-edit-product"class="modal fade" role="dialog">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Chỉnh sửa sản phẩm</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="modal" id="update-product-edit" enctype="multipart/form-data">
          @csrf
                <div class="form-group">
                    <label for="">ID</label>
                    <input name="id" type="text" class="form-control" id="id-product-edit" disabled="true">
                    <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                </div>
                <div class="form-group">
                    <label for="">Tên sản phẩm</label>
                    <input name="name" type="text" class="form-control" id="name-product-edit" placeholder="Nhập vào tên sản phẩm">
                    <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                </div>
                <div class="form-group">
                    <label for="">Số lượng</label>
                    <input name="quantity" type="number" class="form-control" id="quantity-product-edit">
                    <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                </div>
                <div class="form-group">
                    <label for="">Giá</label>
                    <input name="oldPrice" type="number" class="form-control" id="oldPrice-product-edit">
                    <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                </div>
                <div class="form-group">
                    <p>Ảnh đại diện</p>
                    <img src="" alt="Ảnh sản phẩm" id="img-product-edit" width="120px" class="mb-2">
                    <input name="image" type="file" class="form-control" id="image-product-edit">
                    <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                </div>

                <div class="form-group">
                    <p>Ảnh liên quan</p>
                    <input name="multipleImage[]" type="file" class="form-control" id="mulImage" multiple>
                    <div class="" id="multipleImage" style="display: flex; flex-wrap: wrap;">

                    </div>
                    <!-- <img src="" alt="Ảnh sản phẩm" id="img-product-edit" width="120px" class="mb-2"> -->
                    <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                </div>
                <div class="form-group">
                  <label for="">Khuyến mãi</label>
                  <select name="idPromotion" id="promotion-product-edit" class="form-control" required="required">
                      @foreach($promotion as $key => $value)
                      <option value="{{ $value->id }}">{{ $value->name }}</option>
                      @endforeach
                  </select>
                  <!-- <p class="error text-center alert alert-danger hidden"></p> -->
              </div>
                <div class="form-group">
                    <label for="">Mô tả</label>
                    <textarea name="description" id="description-product-edit" cols="5" rows="5" class="ckeditor form-control"></textarea>
                    <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                </div>
                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select name="idCategory" id="category-product-edit" class="form-control category-change" required="required">
                      @foreach($category as $key => $value)
                      <option value="{{ $value->id }}">{{ $value->name }}</option>
                      @endforeach
                    </select>
                    <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                </div>
                <div class="form-group">
                    <label for="">Loại sản phẩm</label>
                    <select name="idProductType" id="productType-product-edit" class="form-control producttype-change" required="required">
                      @foreach($productType as $key => $value)
                      <option value="{{ $value->id }}" idCategory="{{ $value->idCategory }}">{{ $value->name }}</option>
                      @endforeach
                    </select>
                    <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <select name="status" id="status-product-edit" class="form-control" required="required">
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                    <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Lưu lại</button>
                  <button type="button" class="btn btn-warning" data-dismiss="modal">Đóng</button>
                </div>
        </form>
      </div>
    </div>
  </div>
</div>