@extends('back-end.layouts.master')

@section('title')
	Danh sách danh mục sản phẩm
@endsection

@section('content')
<div class="row">
    <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Danh mục sản phẩm</h5>
        </div>
        <div class="card-body pt-1">
            <div class="table-responsive">
            <a href="#" class="create-modal btn btn-success btn-sm mb-1" data-target="#modal-add" data-toggle="modal">
              <i class="fas fa-plus"></i> Thêm danh mục
            </a>
            <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Slug</th>
                        <th>Trạng thái</th>
                        <th>Sự kiện</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Slug</th>
                        <th>Trạng thái</th>
                        <th>Sự kiện</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($category as $value)
                      <tr class="category{{$value->id}}">
                          <td>{{ $value->id }}</td>
                          <td>{{ $value->name }}</td>
                          <td>{{ $value->slug }}</td>
                          <td>
                            @if( $value->status == 1)
                              {{"Hiển thị"}}
                            @else
                              {{"Ẩn"}}
                            @endif
                          </td>
                          <td>
                              <a href="#" class="show-modal btn btn-info btn-sm" data-target="#modal-show" data-toggle="modal" data-id="{{$value->id}}" data-name="{{$value->name}}" data-slug="{{$value->slug}}" data-status="{{$value->status}}" data-created_at="{{$value->created_at}}">
                                  <i class="fa fa-eye"></i>
                              </a>
                              <a href="#" class="edit-modal btn btn-warning btn-sm" data-target="#modal-edit" data-toggle="modal" data-id="{{$value->id}}" data-name="{{$value->name}}" data-slug="{{$value->slug}}" data-status="{{$value->status}}">
                                  <i class="far fa-edit"></i>
                              </a>
                              <a href="#" class="delete-modal btn btn-danger btn-sm" data-target="#modal-delete" data-toggle="modal" data-id="{{$value->id}}" data-name="{{$value->name}}">
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
    });
</script>
{{-- Modal Form Create Post --}}

@include('back-end.pages.category.add')

{{-- Modal Form Show POST --}}
@include('back-end.pages.category.show')

{{-- Modal Form Edit and Delete Post --}}
@include('back-end.pages.category.edit')

{{-- Form Delete Post --}}
@include('back-end.pages.category.delete')

<script src="assets/back-end/javascript/category.js"></script>
@endsection
