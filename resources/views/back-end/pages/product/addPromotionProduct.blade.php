<div id="modal-add-promotion-product" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm khuyến mãi cho sản phẩm</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" id="form-add-promotion-product">
                    <div class="form-group">
                        <label for="">Sản phẩm</label>
                        <select name="idProduct" id="idProduct-add-promotion-product" class="form-control" required="required">
                            @foreach($products as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                    </div>
                    <div class="form-group">
                        <label for="">Khuyến mãi</label>
                        <select name="idPromotion" id="idPromotion-add-promotion-product" class="form-control" required="required">
                            @foreach($promotion as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        <!-- <p class="error text-center alert alert-danger hidden"></p> -->
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