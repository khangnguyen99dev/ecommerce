@extends('back-end.layouts.master')

@section('title')
	Danh sách sản phẩm
@endsection

@section('content')
<div class="row">
    <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h5>
        </div>
        <div class="card-body pt-1">
            <div class="table-responsive">
                <table class="table table-bordered " id="table">
                    <tr id="title-table">
                        <th>ID</th>
                        <th style="max-width: 200px">Tên sản phẩm</th>
                        <th>Ảnh</th>
                        <th>Giá</th>
                        <th>Khuyến mãi</th>
                        <th>Số lượng</th>
                        <th>Trạng thái</th>
                        <th class="text-center" width="150px"></th>
                    </tr>
                    {{ csrf_field() }}
                    @foreach ($product as $value)
                      <tr class="product{{$value->id}}">
                          <td>{{ $value->id }}</td>
                          <td style="max-width: 200px">{{ $value->name }}</td>
                          <td>
                            <img src="assets/img/upload/product/{{ $value->image}}" alt="Ảnh {{ $value->name }}" width="100px">
                          </td>
                          <td>{{ number_format($value->currentPrice,0,',','.') }}₫</td>
                          <td>{{ $value->promotional }}%</td>
                          <td>{{ $value->quantity }}</td>
                          <td>
                            @if( $value->status == 1)
                              {{"Hiển thị"}}
                            @else
                              {{"Ẩn"}}
                            @endif
                          </td>
                          <td>
                              <a href="#" class="show-modal-product btn btn-info btn-sm" data-target="#modal-show-product" data-toggle="modal" data-id="{{$value->id}}" data-name="{{$value->name}}" data-slug="{{$value->slug}}" data-quantity="{{$value->quantity}}" data-sold="{{$value->sold}}" data-oldprice="{{$value->oldPrice}}" data-currentprice="{{$value->currentPrice}}" data-image="{{$value->image}}" data-react="{{$value->react}}" data-promotional="{{$value->promotional}}" data-description="{{$value->description}}" data-category="{{$value->Category['name']}}" data-producttype="{{$value->productType['name']}}"  data-status="{{$value->status}}" data-created_at="{{$value->created_at}}">
                                  <i class="fa fa-eye"></i>
                              </a>
                              <a href="#" class="edit-modal-product btn btn-warning btn-sm" data-target="#modal-edit-product" data-toggle="modal" data-id="{{$value->id}}" data-name="{{$value->name}}" data-slug="{{$value->slug}}" data-quantity="{{$value->quantity}}" data-sold="{{$value->sold}}" data-oldprice="{{$value->oldPrice}}" data-currentprice="{{$value->currentPrice}}" data-image="{{$value->image}}" data-react="{{$value->react}}" data-promotional="{{$value->promotional}}" data-description="{{$value->description}}" data-category="{{$value->Category['id']}}" data-producttype="{{$value->productType['id']}}"  data-status="{{$value->status}}">
                                  <i class="far fa-edit"></i>
                              </a>
                              <a href="#" class="delete-modal-product btn btn-danger btn-sm" data-target="#modal-delete-product" data-toggle="modal" data-id="{{$value->id}}" data-name="{{$value->name}}">
                                  <i class="far fa-trash-alt"></i>
                              </a>
                          </td>
                      </tr>
                    @endforeach
                </table>
                <div class="float-right">{{$product->links()}}</div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Form Show POST --}}
@include('back-end.pages.product.show')

{{-- Modal Form Edit and Delete Post --}}
@include('back-end.pages.product.edit')

{{-- Form Delete Post --}}
@include('back-end.pages.product.delete')
@endsection
