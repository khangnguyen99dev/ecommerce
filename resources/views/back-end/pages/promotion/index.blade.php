@extends('back-end.layouts.master')

@section('title')
	Danh sách sản phẩm
@endsection

@section('content')
<div class="row">
    <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Khuyến mãi sản phẩm</h5>
        </div>
        <div class="card-body pt-1">
            <div class="table-responsive">
                <a href="#" class=" btn btn-success btn-sm mb-1" data-target="#modal-add-promotion" data-toggle="modal">
                    <i class="fas fa-plus"></i> Thêm khuyến mãi
                </a>
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên khuyến mãi</th>
                            <th>Khuyến mãi %</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Sự kiện</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Tên khuyến mãi</th>
                            <th>Khuyến mãi %</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Sự kiện</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        {{ csrf_field() }}
                        @foreach ($promotion as $value)
                          <tr class="product{{$value->id}}">
                              <td>{{ $value->id }}</td>
                              <td style="max-width: 200px">{{ $value->name }}</td>
                              <td>{{ $value->promotional }}</td>
                              <td> {{date('d/m/Y H:i:s',strtotime($value->startDay))}}</td>
                              <td>{{date('d/m/Y H:i:s',strtotime($value->endDay))}}</td>
                              <td>
                                  <a href="" class="edit-modal-promotion btn btn-warning btn-sm" data-target="#modal-edit-promotion" data-toggle="modal" data-id="{{$value->id}}" data-name="{{$value->name}}" data-promotional="{{$value->promotional}}" data-startDay="{{date('Y-m-d\TH:i:s',strtotime($value->startDay))}}" data-endDay="{{date('Y-m-d\TH:i:s',strtotime($value->endDay))}}">
                                      <i class="far fa-edit"></i>
                                  </a>
                                  <a href="#" class="delete-modal-promotion btn btn-danger btn-sm" data-target="#modal-delete-promotion" data-toggle="modal" data-id="{{$value->id}}" data-name="{{$value->name}}"  >
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
@include('back-end.pages.promotion.addPromotion')

@include('back-end.pages.promotion.editPromotion')

@include('back-end.pages.promotion.deletePromotion')

<script>
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

    $(document).ready( function () {
        $('#table').DataTable();
    });
    $(document).on('click','.edit-modal-promotion', function (e) {
        e.preventDefault();
        console.log($(this).data('startday'))
        $('#name-promotional-edit').val($(this).data('name'));
        $('#number-promotional-edit').val($(this).data('promotional'));
        $('#startDay-edit').val($(this).data('startday'));
        $('#endDay-edit').val($(this).data('endday'));
        $('#id-promotion-edit').val($(this).data('id'));
    })

    $(document).on('click', '.delete-modal-promotion', function (e) {
        e.preventDefault();

        $('.namePromotion').html($(this).data('name'));
        $('.idPromotion').html($(this).data('id'));
    })
</script>
@endsection
