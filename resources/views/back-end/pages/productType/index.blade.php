@extends('back-end.layouts.master')

@section('title')
	Danh sách loại sản phẩm
@endsection

@section('content')
<div class="row">
    <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Loại sản phẩm</h5>
        </div>
        <div class="card-body pt-1">
            <div class="table-responsive">
            <a href="#" class="create-modal btn btn-success btn-sm mb-1" data-target="#modal-add" data-toggle="modal">
              <i class="fas fa-plus"></i> Thêm loại sản phẩm
            </a>
                <table class="table table-bordered " id="table">
                    <tr id="title-table">
                        <th>ID</th>
                        <th>Tên loại sản phẩm</th>
                        <th>Slug</th>
                        <th>Danh mục</th>
                        <th>Trạng thái</th>
                        <th class="text-center" width="150px"></th>
                    </tr>
                    {{ csrf_field() }}
                    @foreach ($productType as $key => $value)
                      <tr class="productType{{$value->id}}">
                          <td>{{ $value->id }}</td>
                          <td>{{ $value->name }}</td>
                          <td>{{ $value->slug }}</td>
                          <td>{{ $value->Category['name'] }}</td>
                          <td>
                            @if( $value->status == 1)
                              {{"Hiển thị"}}
                            @else
                              {{"Ẩn"}}
                            @endif
                          </td>
                          <td>
                              <a href="#" class="show-model-productType btn btn-info btn-sm" data-target="#modal-show-productType" data-toggle="modal" data-id="{{$value->id}}" data-category="{{$value->Category['name']}}" data-name="{{$value->name}}" data-slug="{{$value->slug}}" data-status="{{$value->status}}" data-created_at="{{$value->created_at}}">
                                  <i class="fa fa-eye"></i>
                              </a>
                              <a href="#" class="edit-modal-productType btn btn-warning btn-sm" data-target="#modal-edit-productType" data-toggle="modal" data-id="{{$value->id}}" data-category="{{$value->Category['id']}}" data-name="{{$value->name}}" data-slug="{{$value->slug}}" data-status="{{$value->status}}">
                                  <i class="far fa-edit"></i>
                              </a>
                              <a href="#" class="delete-modal-productType btn btn-danger btn-sm" data-target="#modal-delete-productType" data-toggle="modal" data-id="{{$value->id}}" data-name="{{$value->name}}">
                                  <i class="far fa-trash-alt"></i>
                              </a>
                          </td>
                      </tr>
                    @endforeach
                </table>
                <div class="float-right">{{$productType->links()}}</div>
            </div>
        </div>
    </div>
</div>
{{-- Modal Form Create Post --}}

@include('back-end.pages.productType.add')

{{-- Modal Form Show POST --}}
@include('back-end.pages.productType.show')

{{-- Modal Form Edit and Delete Post --}}
@include('back-end.pages.productType.edit')

{{-- Form Delete Post --}}
@include('back-end.pages.productType.delete')
@endsection
