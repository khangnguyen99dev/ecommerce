@extends('back-end.layouts.master')

@section('title')
	Slider
@endsection

@section('content')
<div class="row">
    <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Slider</h5>
        </div>
        <div class="card-body pt-1">
            <div class="table-responsive">
            <a href="#" class="create-modal btn btn-success btn-sm mb-1" data-target="#modal-add-slider" data-toggle="modal">
              <i class="fas fa-plus"></i> Thêm Slider
            </a>
                <table class="table table-bordered " id="table">
                <thead>
                    <tr id="title-table">
                        <th>ID</th>
                        <th>Tên slider</th>
                        <th>Ảnh</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody id="bannerItem">
                    <!-- render slider -->
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('back-end.pages.slider.add')

@include('back-end.pages.slider.edit')

@include('back-end.pages.slider.delete')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready((e)=>{
    const slider = async () => {
        const response = await fetch('http://kanestore.com/api/slider', {
            method: 'GET',
            dataType: 'json',
        });
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return await response.json(); 
    }

    const showBanner = async () => {
        let data = [];
        try {
            data = await slider();
        } catch (error) {
            console.log(error);
        }
        let html ='';
        $.each(data.slider, (index, value)=> {
            html+=`
            <tr class="slider${value.id}">
                <td>${value.id}</td>
                <td>${value.name}</td>
                <td><img src="assets/img/upload/slider/${value.image}" alt="${value.name}" width="300px"></td>
                <td>${value.description}</td>`;
                if(value.status == 1) {
                    html +=`<td>Hiển thị</td>`;
                }else{
                    html +=`<td>Ẩn</td>`;
                }
                html+=`<td>
                    <a href="#" class="edit-modal-slider btn btn-warning btn-sm" data-target="#modal-edit-slider" data-toggle="modal" data-id="${value.id}" data-name="${value.name}" data-image="${value.image}" data-description="${value.description}" data-status="${value.status}">
                        <i class="far fa-edit"></i>
                    </a>
                    <a href="#" class="delete-modal-slider btn btn-danger btn-sm" data-target="#modal-delete-slider" data-toggle="modal" data-id="${value.id}" data-name="${value.name}">
                        <i class="far fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            `;
        })
        return $('#bannerItem').html(html);
    }

    showBanner();

    $('#formBanner').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url:'api/slider',
            method:"POST",
            data: new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                toastr.options = {
                    "debug": false,
                    "positionClass": "toast-top-center",
                    "onclick": null,
                    "fadeIn": 300,
                    "fadeOut": 1000,
                    "timeOut": 1000,
                    "extendedTimeOut": 1000
                }	

                if(data.error){
                    toastr["info"](data.error);
                }else{
                    toastr["info"]('Đã thêm slider thành công');
                    let slider = data.slider;
                    let html = `
                    <tr class="slider">
                        <td>${slider.id}</td>
                        <td>${slider.name}</td>
                        <td><img src="assets/img/upload/slider/${slider.image}" alt="${slider.name}" width="300px"></td>
                        <td>${slider.description}</td>`;
                        if(slider.status == 1) {
                            html +=`<td>Hiển thị</td>`;
                        }else{
                            html +=`<td>Ẩn</td>`;
                        }
                        html+=`<td>
                            <a href="#" class="edit-modal-slider btn btn-warning btn-sm" data-target="#modal-edit-slider" data-toggle="modal" data-id="${slider.id}" data-name="${slider.name}" data-image="${slider.image}" data-description="${slider.description}" data-status="${slider.status}">
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="#" class="delete-modal-slider btn btn-danger btn-sm" data-target="#modal-delete-slider" data-toggle="modal" data-id="${slider.id}" data-name="${slider.name}">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    `;
                    $('#bannerItem').append(html);
                    $('#name-slider-add').val('');
                    $('#image-slider-add').val('');
                    $('#description-slider-add').val('');
                    $('#status-slider-add').val(1);
                }
            }
        })
    })

    $(document).on('click','.edit-modal-slider',function () {
        $('#id-slider-edit').val($(this).data('id'));
        $('#name-slider-edit').val($(this).data('name'));
        $('#img-slider-show').attr('src',`assets/img/upload/slider/${$(this).data('image')}`);
        $('#description-slider-edit').val($(this).data('description'));
        $('#status-slider-edit').val($(this).data('status'));
    })

    $('#formEditBanner').on('submit', function (e) {
        e.preventDefault();
        let id = $('#id-slider-edit').val();
        $.ajax({
            url:'api/slider/'+id,
            type: 'POST',
            data: new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                toastr.options = {
                    "debug": false,
                    "positionClass": "toast-top-center",
                    "onclick": null,
                    "fadeIn": 300,
                    "fadeOut": 1000,
                    "timeOut": 1000,
                    "extendedTimeOut": 1000
                }								
                if(data.error) {
                    toastr["info"](data.error);
                }else{
                    toastr["info"]('Đã cập nhật slider thành công');
                    let slider = data.slider;
                    $('#image-slider-edit').val('');
                    $('#img-slider-show').attr('src',`assets/img/upload/slider/${slider.image}`);
                    let html = `
                    <tr class="slider${slider.id}">
                        <td>${slider.id}</td>
                        <td>${slider.name}</td>
                        <td><img src="assets/img/upload/slider/${slider.image}" alt="${slider.name}" width="300px"></td>
                        <td>${slider.description}</td>`;
                        if(slider.status == 1) {
                            html +=`<td>Hiển thị</td>`;
                        }else{
                            html +=`<td>Ẩn</td>`;
                        }
                        html+=`<td>
                            <a href="#" class="edit-modal-slider btn btn-warning btn-sm" data-target="#modal-edit-slider" data-toggle="modal" data-id="${slider.id}" data-name="${slider.name}" data-image="${slider.image}" data-description="${slider.description}" data-status="${slider.status}">
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="#" class="delete-modal-slider btn btn-danger btn-sm" data-target="#modal-delete-slider" data-toggle="modal" data-id="${slider.id}" data-name="${slider.name}">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    `;     
                    $('.slider'+data.slider.id).replaceWith(html);
                }
            }
        })
    })

    $(document).on('click','.delete-modal-slider', function(e) {
        $('#name-delete-slider').text($(this).data('name'));
        $('#id-delete-slider').text($(this).data('id'));
    })
    $(document).on('click', '#delete-slider', function (e) {
        e.preventDefault();
        let id = $('#id-delete-slider').text();
        $.ajax({
            type: 'DELETE',
            url: 'api/slider/'+id,
            dataType: 'JSON',
            success: (data)=> {
                toastr.options = {
                    "debug": false,
                    "positionClass": "toast-top-center",
                    "onclick": null,
                    "fadeIn": 300,
                    "fadeOut": 1000,
                    "timeOut": 1000,
                    "extendedTimeOut": 1000
                }	
                if(data.error){
                    toastr["info"](data.error);
                }else{
                    toastr["info"]('Đã xóa slider thành công');
                    $('.slider'+data.slider.id).hide();
                }
            }
        })
    })
})
</script>
@endsection
