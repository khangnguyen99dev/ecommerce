$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// PRODUCT TYPE
 
$(document).on('submit', '#form-productType', function(e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: 'admin/productType',
      data: {
        'name': $('#name-productType-add').val(),
        'idCategory': $('#category-productType-add').val(),
        'status': $('#status-productType-add').val()
      },
      success: function(data){
        if(data.error) {
          toastr['info'](data.error);
        }else{
          toastr['info']('Thêm loại sản phẩm thành công!');
          location.reload();
        }
        
        // let status = '';
        // if(data.status == 1) {
        //     status = 'Hiển thị';
        // }else{
        //     status = 'Ẩn';
        // }
        // $('#title-table').after("<tr class='productType" + data.id + "'>"+
        // "<td>" + data.id + "</td>"+
        // "<td>" + data.name + "</td>"+
        // "<td>" + data.slug + "</td>"+
        // "<td>" + data.nameCategory + "</td>"+
        // "<td>" + status + "</td>"+
        // "<td><button class='show-model-productType btn btn-info btn-sm' data-target='#modal-show-productType' data-toggle='modal' data-id='" + data.id + "'data-category='" + data.nameCategory + "'data-name='" + data.name + "'data-slug='" + data.slug + "'data-status='" + data.status + "'data-created_at='" + data.created_at + "'><span class='fa fa-eye'></span></button> <button class='edit-modal-productType btn btn-warning btn-sm' data-target='#modal-edit-productType' data-toggle='modal' data-id='" + data.id  + "'data-name='" + data.name + "'data-category='" + data.idCategory + "'data-slug='" + data.slug + "'data-status='" + data.status +"'><i class='far fa-edit'></i></button> <button class='delete-modal-productType btn btn-danger btn-sm' data-target='#modal-delete-productType' data-toggle='modal' data-id='" + data.id + "'data-name='" + data.name +"'><i class='far fa-trash-alt'></i></button></td>"+
        // "</tr>");
      },
    });
    // $('#name-productType-add').val('');
    // $('#status-productType-add').val('1');
  });
  
    // Show productType function
    $(document).on('click', '.show-model-productType', function() {
      let status='';
      if($(this).data('status') == 1){
          status = 'Hiển thị'
      }else{
          status = 'Ẩn'
      }
     $('#id').text($(this).data('id'));
     $('#name').text($(this).data('name'));
     $('#slug').text($(this).data('slug'));
     $('#category').text($(this).data('category'));
     $('#status').text(status);
     $('#created_at').text($(this).data('created_at'));
  });
  
  // function Edit POST
  $(document).on('click', '.edit-modal-productType', function() {
      $('#id-edit-productType').val($(this).data('id'));
      $('#name-edit-productType').val($(this).data('name'));
      $('#category-edit-productType').val($(this).data('category'));
      $('#slug-edit-productType').val($(this).data('slug'));
      $('#status-edit-productType').val($(this).data('status'));
  });
  
  $(document).on('submit', '#form-edit-productType', function (e) {
      e.preventDefault();
      let id = $('#id-edit-productType').val();
    $.ajax({
      type : 'PUT',
      url: 'admin/productType/'+ id,
      data: {
      'name': $('#name-edit-productType').val(),
      'slug': $('#slug-edit-productType').val(),
      'idCategory': $('#category-edit-productType').val(),
      'status': $('#status-edit-productType').val()
      },
      success: function(data) {
          toastr['info']('Cập nhật loại sản phẩm thành công!');
          console.log(data);
          let status = '';
          if(data.status == 1) {
              status = 'Hiển thị';
          }else{
              status = 'Ẩn';
          }
          $('.productType' + data.id).replaceWith(" "+
          "<tr class='productType" + data.id + "'>"+
          "<td>" + data.id + "</td>"+
          "<td>" + data.name + "</td>"+
          "<td>" + data.slug + "</td>"+
          "<td>" + data.nameCategory + "</td>"+
          "<td>" + status + "</td>"+
          "<td><button class='show-model-productType btn btn-info btn-sm' data-target='#modal-show-productType' data-toggle='modal' data-id='" + data.id + "'data-category='" + data.nameCategory + "'data-name='" + data.name + "'data-slug='" + data.slug + "'data-status='" + data.status + "'data-created_at='" + data.created_at + "'><span class='fa fa-eye'></span></button> <button class='edit-modal-productType btn btn-warning btn-sm' data-target='#modal-edit-productType' data-toggle='modal' data-id='" + data.id  + "'data-name='" + data.name + "'data-category='" + data.idCategory + "'data-slug='" + data.slug + "'data-status='" + data.status +"'><i class='far fa-edit'></i></button> <button class='delete-modal-productType btn btn-danger btn-sm' data-target='#modal-delete-productType' data-toggle='modal' data-id='" + data.id + "'data-name='" + data.name +"'><i class='far fa-trash-alt'></i></button></td>"+
          "</tr>");
          }
      });
  });
  
  // form Delete function
  $(document).on('click', '.delete-modal-productType', function() {
      $('.id').text($(this).data('id'));
      $('.name').html($(this).data('name'));
  });
  
  $('#delete-productType').click(function() {
      let id = $('.id').text();
    $.ajax({
      type: 'DELETE',
      url: 'admin/productType/'+ id,
      data: {
        'id': id
      },
      success: function(data){
          if(data.error){
            toastr['info'](data.error);
          }else{
            toastr['info']('Xóa loại sản phẩm thành công!');
            $('.productType' + $('.id').text()).remove();
          }
      }
    });
  });
  