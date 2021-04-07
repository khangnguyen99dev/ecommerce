@extends('back-end.layouts.master')

@section('title')
	Banner
@endsection

@section('content')
<div class="row">
    <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Banner</h5>
        </div>
        <div class="card-body pt-1">
            <div class="table-responsive">
            <a href="#" class="create-modal btn btn-success btn-sm mb-1" data-target="#modal-add-banner" data-toggle="modal">
              <i class="fas fa-plus"></i> Thêm Banner
            </a>
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr id="title-table">
                            <th>ID</th>
                            <th>Tên banner</th>
                            <th>Ảnh</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody id="bannerItem">
                        <!-- render banner -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('back-end.pages.banner.add')

@include('back-end.pages.banner.edit')

@include('back-end.pages.banner.delete')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready((e)=>{
    const banner = async () => {
        const response = await fetch('http://kanestore.com/api/banner', {
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
            data = await banner();
        } catch (error) {
            console.log(error);
        }
        let html ='';
        $.each(data.banner, (index, value)=> {
            html+=`
            <tr class="banner${value.id}">
                <td>${value.id}</td>
                <td>${value.name}</td>
                <td><img src="assets/img/upload/banner/${value.image}" alt="${value.name}" width="300px"></td>
                <td>${value.description}</td>`;
                if(value.status == 1) {
                    html +=`<td>Hiển thị</td>`;
                }else{
                    html +=`<td>Ẩn</td>`;
                }
                html+=`<td>
                    <a href="#" class="edit-modal-banner btn btn-warning btn-sm" data-target="#modal-edit-banner" data-toggle="modal" data-id="${value.id}" data-name="${value.name}" data-image="${value.image}" data-description="${value.description}" data-status="${value.status}">
                        <i class="far fa-edit"></i>
                    </a>
                    <a href="#" class="delete-modal-banner btn btn-danger btn-sm" data-target="#modal-delete-banner" data-toggle="modal" data-id="${value.id}" data-name="${value.name}">
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
            url:'api/banner',
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
                    toastr["info"]('Đã thêm banner thành công');
                    let banner = data.banner;
                    let html = `
                    <tr class="banner">
                        <td>${banner.id}</td>
                        <td>${banner.name}</td>
                        <td><img src="assets/img/upload/banner/${banner.image}" alt="${banner.name}" width="300px"></td>
                        <td>${banner.description}</td>`;
                        if(banner.status == 1) {
                            html +=`<td>Hiển thị</td>`;
                        }else{
                            html +=`<td>Ẩn</td>`;
                        }
                        html+=`<td>
                            <a href="#" class="edit-modal-banner btn btn-warning btn-sm" data-target="#modal-edit-banner" data-toggle="modal" data-id="${banner.id}" data-name="${banner.name}" data-image="${banner.image}" data-description="${banner.description}" data-status="${banner.status}">
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="#" class="delete-modal-banner btn btn-danger btn-sm" data-target="#modal-delete-banner" data-toggle="modal" data-id="${banner.id}" data-name="${banner.name}">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    `;
                    $('#bannerItem').append(html);
                    $('#name-banner-add').val('');
                    $('#image-banner-add').val('');
                    $('#description-banner-add').val('');
                    $('#status-banner-add').val(1);
                }
            }
        })
    })

    $(document).on('click','.edit-modal-banner',function () {
        $('#id-banner-edit').val($(this).data('id'));
        $('#name-banner-edit').val($(this).data('name'));
        $('#img-banner-show').attr('src',`assets/img/upload/banner/${$(this).data('image')}`);
        $('#description-banner-edit').val($(this).data('description'));
        $('#status-banner-edit').val($(this).data('status'));
    })

    $('#formEditBanner').on('submit', function (e) {
        e.preventDefault();
        let id = $('#id-banner-edit').val();
        $.ajax({
            url:'api/banner/'+id,
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
                    toastr["info"]('Đã cập nhật banner thành công');
                    let banner = data.banner;
                    $('#image-banner-edit').val('');
                    $('#img-banner-show').attr('src',`assets/img/upload/banner/${banner.image}`);
                    let html = `
                    <tr class="banner${banner.id}">
                        <td>${banner.id}</td>
                        <td>${banner.name}</td>
                        <td><img src="assets/img/upload/banner/${banner.image}" alt="${banner.name}" width="300px"></td>
                        <td>${banner.description}</td>`;
                        if(banner.status == 1) {
                            html +=`<td>Hiển thị</td>`;
                        }else{
                            html +=`<td>Ẩn</td>`;
                        }
                        html+=`<td>
                            <a href="#" class="edit-modal-banner btn btn-warning btn-sm" data-target="#modal-edit-banner" data-toggle="modal" data-id="${banner.id}" data-name="${banner.name}" data-image="${banner.image}" data-description="${banner.description}" data-status="${banner.status}">
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="#" class="delete-modal-banner btn btn-danger btn-sm" data-target="#modal-delete-banner" data-toggle="modal" data-id="${banner.id}" data-name="${banner.name}">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    `;     
                    $('.banner'+data.banner.id).replaceWith(html);
                }
            }
        })
    })

    $(document).on('click','.delete-modal-banner', function(e) {
        $('#name-delete-banner').text($(this).data('name'));
        $('#id-delete-banner').text($(this).data('id'));
    })
    $(document).on('click', '#delete-banner', function (e) {
        e.preventDefault();
        let id = $('#id-delete-banner').text();
        $.ajax({
            type: 'DELETE',
            url: 'api/banner/'+id,
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
                    toastr["info"]('Đã xóa banner thành công');
                    $('.banner'+data.banner.id).hide();
                }
            }
        })
    })
})
</script>
@endsection
