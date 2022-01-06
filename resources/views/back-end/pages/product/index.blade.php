@extends('back-end.layouts.master')

@section('title')
	Danh sách sản phẩm
@endsection

@section('content')
<style>
    span.delete-img:hover {
    cursor: pointer !important;
}
</style>
<div class="row">
    <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h5>
        </div>
        <div class="card-body pt-1">
            <div class="table-responsive">
                <a href="#" class="modal-add-promotion-product btn btn-success btn-sm mb-1" data-target="#modal-add-promotion-product" data-toggle="modal">
                    <i class="fas fa-plus"></i> Thêm khuyến mãi sản phẩm
                </a>
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh</th>
                            <th>Giá</th>
                            <th>Khuyến mãi</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th>Sự kiện</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh</th>
                            <th>Giá</th>
                            <th>Khuyến mãi</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th>Sự kiện</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        
                        {{ csrf_field() }}
                        @foreach ($product as $value)
                          <tr class="product{{$value->id}}">
                              <td>{{ $value->id }}</td>
                              <td style="max-width: 200px">{{ $value->name }}</td>
                              <td>
                                <img src="assets/img/upload/product/{{ $value->image}}" alt="Ảnh {{ $value->name }}" width="100px">
                              </td>
                              <td>{{ number_format($value->currentPrice,0,',','.') }}₫</td>
                              <td>{{ $value->Promotion->promotional }}%</td>
                              <td>{{ $value->quantity }}</td>
                              <td>
                                @if( $value->status == 1)
                                  {{"Hiển thị"}}
                                @else
                                  {{"Ẩn"}}
                                @endif
                              </td>
                              <td>
                                  <a href="" class="show-modal-product btn btn-info btn-sm" data-target="#modal-show-product" data-toggle="modal" data-id="{{$value->id}}" data-name="{{$value->name}}" data-slug="{{$value->slug}}" data-quantity="{{$value->quantity}}" data-sold="{{$value->sold}}" data-oldprice="{{$value->oldPrice}}" data-currentprice="{{$value->currentPrice}}" data-image="{{$value->image}}" data-react="{{$value->react}}" data-promotional="{{$value->Promotion->promotional}}" data-description="{{$value->description}}" data-category="{{$value->Category['name']}}" data-producttype="{{$value->productType['name']}}"  data-status="{{$value->status}}" data-created_at="{{$value->created_at}}">
                                      <i class="fa fa-eye"></i>
                                  </a>
                                  <a href="" class="edit-modal-product btn btn-warning btn-sm" data-target="#modal-edit-product" data-toggle="modal" data-id="{{$value->id}}" data-name="{{$value->name}}" data-slug="{{$value->slug}}" data-quantity="{{$value->quantity}}" data-sold="{{$value->sold}}" data-oldprice="{{$value->oldPrice}}" data-currentprice="{{$value->currentPrice}}" data-image="{{$value->image}}" data-react="{{$value->react}}" data-promotional="{{$value->idPromotion}}" data-description="{{$value->description}}" data-category="{{$value->Category['id']}}" data-producttype="{{$value->productType['id']}}"  data-status="{{$value->status}}">
                                      <i class="far fa-edit"></i>
                                  </a>
                                  <a href="" class="delete-modal-product btn btn-danger btn-sm" data-target="#modal-delete-product" data-toggle="modal" data-id="{{$value->id}}" data-name="{{$value->name}}">
                                      <i class="far fa-trash-alt"></i>
                                  </a>
                              </td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
    $('#table').DataTable();
} );
</script>
{{-- Modal Form Show POST --}}
@include('back-end.pages.product.show')

{{-- Modal Form Edit and Delete Post --}}
@include('back-end.pages.product.edit')

{{-- Form Delete Post --}}
@include('back-end.pages.product.delete')

@include('back-end.pages.product.addPromotionProduct')

<script src="assets/back-end/javascript/product.js"></script>
@endsection
