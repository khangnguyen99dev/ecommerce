<div id="modal-add-banner" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm banner</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="formBanner" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên banner</label>
                        <input name="name" type="text" class="form-control" id="name-banner-add" placeholder="Nhập vào tên banner">
                    </div>

                    <div class="form-group">
                        <label for="">Ảnh banner</label>
                        <input name="image" type="file" class="form-control" id="image-banner-add">
                    </div>

                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea name="description" class="form-control" id="description-banner-add" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <select name="status" id="status-banner-add" class="form-control" required="required">
                            <option value="1">Hiển thị</option>
                            <option value="0">Ẩn</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Thêm mới</button>
                        <button class="btn btn-warning" type="button" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>