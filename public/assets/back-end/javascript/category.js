$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#add-category").click(function() {
    $.ajax({
        type: 'POST',
        url: 'admin/category',
        data: {
        'name': $('#name-category-add').val(),
        'status': $('#status-category-add').val()
        },
        success: function(data){
            if(data.error) {
                toastr['info'](data.error);
            }else{
                toastr['info']('Thêm danh mục thành công!');
                location.reload();
            }
        
        // let status = '';
        // if(data.status == 1) {
        //     status = 'Hiển thị';
        // }else{
        //     status = 'Ẩn';
        // }
        // $('#title-table').after("<tr class='category" + data.id + "'>"+
        // "<td>" + data.id + "</td>"+
        // "<td>" + data.name + "</td>"+
        // "<td>" + data.slug + "</td>"+
        // "<td>" + status + "</td>"+
        // "<td><button class='show-modal btn btn-info btn-sm' data-target='#modal-show' data-toggle='modal' data-id='" + data.id + "'data-name='" + data.name + "'data-slug='" + data.slug + "'data-status='" + data.status + "'data-created_at='" + data.created_at + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-target='#modal-edit' data-toggle='modal' data-id='" + data.id  + "'data-name='" + data.name + "'data-slug='" + data.slug + "'data-status='" + data.status +"'><i class='far fa-edit'></i></button> <button class='delete-modal btn btn-danger btn-sm' data-target='#modal-delete' data-toggle='modal' data-id='" + data.id + "'data-name='" + data.name +"'><i class='far fa-trash-alt'></i></button></td>"+
        // "</tr>");
        },
    });
    // $('#name-category-add').val('');
    // $('#status-category-add').val('1');
});

// function Edit POST 
$(document).on('click', '.edit-modal', function() {
    $('#id-edit').val($(this).data('id'));
    $('#name-edit').val($(this).data('name'));
    $('#slug-edit').val($(this).data('slug'));
    $('#status-edit').val($(this).data('status'));
});


$(document).on('submit', '#form-edit-category', function (e) {
    e.preventDefault();
    let id = $('#id-edit').val();
    $.ajax({
        type : 'PUT',
        url: 'admin/category/'+ id,
        data: {
        'name': $('#name-edit').val(),
        'slug': $('#slug-edit').val(),
        'status': $('#status-edit').val()
        },
        success: function(data) {
            toastr['info']('Cập nhật danh mục thành công!');
            let status = '';
            if(data.status == 1) {
                status = 'Hiển thị';
            }else{
                status = 'Ẩn';
            }
            $('.category' + data.id).replaceWith(" "+
            "<tr class='category" + data.id + "'>"+
            "<td>" + data.id + "</td>"+
            "<td>" + data.name + "</td>"+
            "<td>" + data.slug + "</td>"+
            "<td>" + status + "</td>"+
            "<td><button class='show-modal btn btn-info btn-sm' data-target='#modal-show' data-toggle='modal' data-id='" + data.id + "'data-name='" + data.name + "'data-slug='" + data.slug + "'data-status='" + data.status + "'data-created_at='" + data.created_at + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-target='#modal-edit' data-toggle='modal' data-id='" + data.id +"'data-name='" + data.name + "'data-slug='" + data.slug + "'data-status='" + data.status +"'><i class='far fa-edit'></i></button> <button class='delete-modal btn btn-danger btn-sm' data-target='#modal-delete' data-toggle='modal' data-id='" + data.id + "'data-name='" + data.name +"'><i class='far fa-trash-alt'></i></button></td>"+
            "</tr>");
            }
    });
});


// form Delete function
$(document).on('click', '.delete-modal', function() {
    $('.id').text($(this).data('id'));
    $('.name').html($(this).data('name'));
});

$('#delete-catogory').click(function() {
    let id = $('.id').text();
$.ajax({
    type: 'DELETE',
    url: 'admin/category/'+ id,
    data: {
    'id': id
    },
    success: function(data){
    if(data.error) {
        toastr['info'](data.error);
    }else{
        toastr['info']('Xóa danh mục thành công!');
        $('.category' + $('.id').text()).remove();
    }        
    }
});
});

$(document).on('click', '.show-modal', function() {
    let status='';
    if($(this).data('status') == 1){
        status = 'Hiển thị'
    }else{
        status = 'Ẩn'
    }
   $('#id').text($(this).data('id'));
   $('#name').text($(this).data('name'));
   $('#slug').text($(this).data('slug'));
   $('#status').text(status);
   $('#created_at').text($(this).data('created_at'));
});