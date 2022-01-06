@extends('back-end.layouts.master')

@section('title')
  Danh sách sản phẩm
@endsection

@section('content')
<div class="row">
    <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Thêm sản phẩm</h5>
        </div>
        <div class="card-body pt-1">
            <form id="form-product-add" class="form-horizontal" role="form" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Tên sản phẩm</label>
                    <input name="name" type="text" required class="form-control" id="name-product-add" placeholder="Nhập vào tên sản phẩm">
                    <span class="form-message"></span>
                </div>
                <div class="form-group">
                    <label for="">Số lượng</label>
                    <input name="quantity" required type="number" class="form-control" id="quantity-product-add">
                    <span class="form-message"></span>
                </div>
                <div class="form-group">
                    <label for="">Giá</label>
                    <input name="oldPrice" required type="number" class="form-control" id="oldPrice-product-add">
                    <span class="form-message"></span>
                </div>
                <div class="form-group">
                    <label for="">Ảnh đại diện</label>
                    <input name="image" required type="file" class="form-control" id="image-product-add">
                    <span class="form-message"></span>
                </div>
                <div class="form-group">
                    <label for="">Ảnh liên quan</label>
                    <input name="multipleImage[]" type="file" class="form-control" id="image-product-mutiple" multiple>
                    <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                </div>
                <div class="form-group">
                    <label for="">Khuyến mãi</label>
                    <select name="idPromotion" id="promotion-product-add" class="form-control" required="required">
                        @foreach($promotion as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                    <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                </div>
                <div class="form-group">
                    <label for="">Mô tả</label>
                    <textarea name="description" id="description-product-add" cols="5" rows="5" class="ckeditor form-control"></textarea>
                    <span class="form-message"></span>
                </div>
                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select name="idCategory" id="category-product-add" class="form-control category-change" required="required">
                        @foreach($category as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                    <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                </div>
                <div class="form-group">
                    <label for="">Loại sản phẩm</label>
                    <select name="idProductType" id="productType-product-add" class="form-control producttype-change" required="required">
                        @foreach($productType as $key => $value)
                        <option value="{{ $value->id }}" idCategory="{{ $value->idCategory }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                    <!-- <p class="error text-center alert alert-danger hidden"></p> -->
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <select name="status" id="status-product-add" class="form-control" required="required">
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
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

<script src="assets/back-end/javascript/productadd.js"></script>
@endsection