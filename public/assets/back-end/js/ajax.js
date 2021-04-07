$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

let warpper = fetch('http://kanestore.com/api/warpper')
    .then((res) => {
        return res.json();
    })
    .catch((err)=>{
    	console.log(err);
    })

// CATEGORY
$("#add-category").click(function() {
  $.ajax({
    type: 'POST',
    url: 'admin/category',
    data: {
      'name': $('#name-category-add').val(),
      'status': $('#status-category-add').val()
    },
    success: function(data){
      toastr.success('Thêm thành công!', 'Thông báo', {timeOut: 2000});
      let status = '';
      if(data.status == 1) {
          status = 'Hiển thị';
      }else{
          status = 'Ẩn';
      }
      $('#title-table').after("<tr class='category" + data.id + "'>"+
      "<td>" + data.id + "</td>"+
      "<td>" + data.name + "</td>"+
      "<td>" + data.slug + "</td>"+
      "<td>" + status + "</td>"+
      "<td><button class='show-modal btn btn-info btn-sm' data-target='#modal-show' data-toggle='modal' data-id='" + data.id + "'data-name='" + data.name + "'data-slug='" + data.slug + "'data-status='" + data.status + "'data-created_at='" + data.created_at + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-target='#modal-edit' data-toggle='modal' data-id='" + data.id  + "'data-name='" + data.name + "'data-slug='" + data.slug + "'data-status='" + data.status +"'><i class='far fa-edit'></i></button> <button class='delete-modal btn btn-danger btn-sm' data-target='#modal-delete' data-toggle='modal' data-id='" + data.id + "'data-name='" + data.name +"'><i class='far fa-trash-alt'></i></button></td>"+
      "</tr>");
    },
  });
  $('#name-category-add').val('');
  $('#status-category-add').val('1');
});

// function Edit POST
$(document).on('click', '.edit-modal', function() {
    $('#id-edit').val($(this).data('id'));
    $('#name-edit').val($(this).data('name'));
    $('#slug-edit').val($(this).data('slug'));
    $('#status-edit').val($(this).data('status'));
});

$('#update-category').click(function() {
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
        toastr.success('Cập nhật thành công!', 'Thông báo', {timeOut: 2000});
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
        toastr.success('Xóa thành công!', 'Thông báo', {timeOut: 2000});
        $('.category' + $('.id').text()).remove();
    }
  });
});



  // Show function
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




// PRODUCT TYPE
$("#add-productType").click(function() {
  $.ajax({
    type: 'POST',
    url: 'admin/productType',
    data: {
      'name': $('#name-productType-add').val(),
      'idCategory': $('#category-productType-add').val(),
      'status': $('#status-productType-add').val()
    },
    success: function(data){
      toastr.success('Thêm thành công!', 'Thông báo', {timeOut: 2000});
      let status = '';
      if(data.status == 1) {
          status = 'Hiển thị';
      }else{
          status = 'Ẩn';
      }
      $('#title-table').after("<tr class='productType" + data.id + "'>"+
      "<td>" + data.id + "</td>"+
      "<td>" + data.name + "</td>"+
      "<td>" + data.slug + "</td>"+
      "<td>" + data.nameCategory + "</td>"+
      "<td>" + status + "</td>"+
      "<td><button class='show-model-productType btn btn-info btn-sm' data-target='#modal-show-productType' data-toggle='modal' data-id='" + data.id + "'data-category='" + data.nameCategory + "'data-name='" + data.name + "'data-slug='" + data.slug + "'data-status='" + data.status + "'data-created_at='" + data.created_at + "'><span class='fa fa-eye'></span></button> <button class='edit-modal-productType btn btn-warning btn-sm' data-target='#modal-edit-productType' data-toggle='modal' data-id='" + data.id  + "'data-name='" + data.name + "'data-category='" + data.idCategory + "'data-slug='" + data.slug + "'data-status='" + data.status +"'><i class='far fa-edit'></i></button> <button class='delete-modal-productType btn btn-danger btn-sm' data-target='#modal-delete-productType' data-toggle='modal' data-id='" + data.id + "'data-name='" + data.name +"'><i class='far fa-trash-alt'></i></button></td>"+
      "</tr>");
    },
  });
  $('#name-productType-add').val('');
  $('#status-productType-add').val('1');
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

$('#update-productType').click(function() {
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
        toastr.success('Cập nhật thành công!', 'Thông báo', {timeOut: 2000});
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
        toastr.success(data.message, 'Thông báo', {timeOut: 2000});
        $('.productType' + $('.id').text()).remove();
    }
  });
});

// PRODUCT

$('#form-product').on('submit', function(event){
  event.preventDefault();
  for ( instance in CKEDITOR.instances ) {
      CKEDITOR.instances[instance].updateElement();
  }
  $.ajax({
    url:'admin/product',
    method:"POST",
    data:new FormData(this),
    dataType:'JSON',
    contentType: false,
    cache: false,
    processData: false,
    success: function(data){
      if(data.error){
        toastr.error(data.error, 'Thông báo', {timeOut: 2000});
      }else{
        $('#name-product-add').val('');
        $('#quantity-product-add').val('');
        $('#oldPrice-product-add').val('');
        $('#image-product-add').val('');
        $('#promotional-product-add').val('');
        $('#image-product-mutiple').val('');
        CKEDITOR.instances['description-product-add'].setData('');
        $('#category-product-add').val($("#category-product-add option:first").val());
        $('#productType-product-add').val($("#productType-product-add option:first").val());
        $('#status-product-add').val($("#status-product-add option:first").val());
        toastr.success('Thêm sản phẩm thành công', 'Thông báo', {timeOut: 2000});
      }
    }
  });
});

  // Show product function
  $(document).on('click', '.show-modal-product', function() {
    let status='';
    if($(this).data('status') == 1){
        status = 'Hiển thị'
    }else{
        status = 'Ẩn'
    }
   $('#id-product').text($(this).data('id'));
   $('#name-product').text($(this).data('name'));
   $('#slug-product').text($(this).data('slug'));
   $('#quantity-product').text($(this).data('quantity'));
   $('#sold-product').text($(this).data('sold'));
   $('#oldPrice-product').text($(this).data('oldprice'));
   $('#currentPrice-product').text($(this).data('currentprice'));
   $('#image-product').attr('src','assets/img/upload/product/'+$(this).data('image'));
   $('#react-product').text($(this).data('react'));
   $('#promotional-product').text($(this).data('promotional')+'%');
   $('#category-product').text($(this).data('category'));
   $('#productType-product').text($(this).data('producttype'));
   $('#status-product').text(status);
   $('#created_at-product').text($(this).data('created_at'));
   warpper
   .then((data)=> {
      let id = $(this).data('id');
      html = '';
      let filterWarpper = data.filter((value)=> {
          return value.idProduct == id ? 
          html+=`<img src="assets/img/upload/product/${value.path}" alt="${value.name}" style="padding: 5px; width: 120px" >`: html+=``;
      })
      if(filterWarpper.length > 0){
          $('#multiple-image').html(html);
          $('#multiple-image').parent().css('display','block');
      }else{
          $('#multiple-image').parent().css('display','flex');
          $('#multiple-image').html(` Sản phẩm này không có ảnh liên quan`);
      }
   })
   .catch((error)=> {
       console.log(error);
   })
});



// CHANGE FOR CATEGORY

$('.category-change').change(function() {
  let id = $(this).val();
  $.ajax({
    url: 'getproducttype',
    type: 'GET',
    data: {
      id: id
    },
    success: function(data) {
      console.log(data);
      let html = '';
      $.each(data, function(key,value){
        html += '<option value='+value['id']+'>'+value['name']+'</option>';
      });
      $('.producttype-change').html(html);
    }
  });
});

// CHANGE FOR PRODUCTTYPE

$('.producttype-change').change(function() {
  let idCategory  = $('option:selected', this).attr('idCategory');
  let idProductType = $('#productType-product-edit').val();
  $.ajax({
    url: 'getcategory',
    type: 'GET',
    data: {
      id: idCategory
    },
    success: function(data) {
      console.log(data);
      if(data.length!=0){
        let  html = '<option value="'+idProductType+'" idCategory="'+data[0].id+'" selected>'+data[0].name+'</option>';
        $('.category-change').prepend(html);      
      }

    }
  });
});
// DELETE PRODUCT
$(document).on('click', '.delete-modal-product', function() {
    $('#name-delete-product').text($(this).data('name'));
    $('#id-delete-product').html($(this).data('id'));
});

$('#delete-product').click(function() {
    let id = $('#id-delete-product').text();
  $.ajax({
    type: 'DELETE',
    url: 'admin/product/'+ id,
    data: {
      'id': id
    },
    success: function(data){
        toastr.success(data.success, 'Thông báo', {timeOut: 2000});
        $('.product' + $('#id-delete-product').text()).remove();
    }
  });
});
// Edit function
$(document).on('click', '.edit-modal-product', function() {
    $('#id-product-edit').val($(this).data('id'));
    $('#name-product-edit').val($(this).data('name'));
    $('#quantity-product-edit').val($(this).data('quantity'));
    $('#oldPrice-product-edit').val($(this).data('oldprice'));
    $('#img-product-edit').attr('src','assets/img/upload/product/'+$(this).data('image'));
    $('#promotional-product-edit').val($(this).data('promotional'));
    CKEDITOR.instances['description-product-edit'].setData($(this).data('description'));
    $('#category-product-edit').val($(this).data('category'));
    $('#productType-product-edit').val($(this).data('producttype'));
    $('#status-product-edit').val($(this).data('status'));

    warpper
    .then((data)=> {
       let id = $(this).data('id');
       html = '';
       let filterWarpper = data.filter((value)=> {
           return value.idProduct == id ? 
           html+=`
           <div class="imgGroup" id="${value.id}">
            <img src="assets/img/upload/product/${value.path}" alt="${value.name}" style="padding: 5px; width: 120px">
            <span class="delete-img" data-id="${value.id}"><i class="far fa-trash-alt"></i></span>
           </div>
           `: html+=``;
       })
       if(filterWarpper.length > 0){
           $('#multipleImage').html(html);
           $('#multipleImage').parent().css('display','block');
       }else{
           $('#multipleImage').html(` Sản phẩm này không có ảnh liên quan`);
       }
       deleteImg();
    })
    .catch((error)=> {
        console.log(error);
    })
});

function deleteImg() {
  let removeImg = $('.delete-img');
  $.each(removeImg, (index, value)=> {
    $(value).on('click', (e)=> {
      let id = $(value).data('id');
      $.ajax({
        type: 'POST',
        url: 'admin/deleteImg/'+id,
        data: {
          id:id,
        },
        success: (data)=> {
          if(data.id){
            $('#'+data.id).hide();
          }else{
            console.log(data)
          }
        }
      })
    })
  })
}

$('#update-product-edit').on('submit', function(event){
  event.preventDefault();
  let id =  $('#id-product-edit').val()
  for ( instance in CKEDITOR.instances ) {
      CKEDITOR.instances[instance].updateElement();
  }
  $.ajax({
    url:'admin/updateproduct/'+id,
    method:"POST",
    data: new FormData(this),
    dataType:'JSON',
    contentType: false,
    cache: false,
    processData: false,
    success: function(res){
      let data = res.product;
      console.log(res)
      if(res.error){
        toastr.error(res.error, 'Thông báo', {timeOut: 2000});
      }else{
        toastr.success('Cập nhật thành công sản phẩm', 'Thông báo', {timeOut: 2000});
        let status = '';
        if(data.status == 1) {
            status = 'Hiển thị';
        }else{
            status = 'Ẩn';
        }
        $('#img-product-edit').attr('src',`assets/img/upload/product/${data.image}`);
        if(res.dataImg) {
          let img = res.dataImg;
          if(img.length > 0) {
            html = '';
            $.each(img, (index, value) => {
              html+=`
              <div class="imgGroup" id="${value.id}">
               <img src="assets/img/upload/product/${value.path}" style="padding: 5px; width: 120px">
               <span class="delete-img" data-id="${value.id}"><i class="far fa-trash-alt"></i></span>
              </div>
              `;
            })
  
            $('#multipleImage').append(html);
          }
          deleteImg();
        }
        
        $('.product' + data.id).replaceWith(" "+
        "<tr class='product" + data.id + "'>"+
        "<td>" + data.id + "</td>"+
        "<td style='max-width: 200px'>" + data.name + "</td>"+
        "<td><img src='assets/img/upload/product/"+data.image+"' alt='Ảnh "+data.name+"' width='100px'></td>"+
        "<td>" + Intl.NumberFormat().format(data.currentPrice) + "₫</td>"+
        "<td>" + data.promotional + "%</td>"+
        "<td>" + data.quantity + "</td>"+
        "<td>" + status + "</td>"+
        "<td><button class='show-modal-product btn btn-info btn-sm' data-target='#modal-show-product' data-toggle='modal' data-id='" + data.id + "'data-slug='"+data.slug+"' data-quantity='"+data.quantity+"' data-sold='"+data.sold+"' data-oldprice='"+data.oldPrice+"' data-currentprice='"+data.currentPrice+"' data-image='"+data.image+"' data-react='"+data.react+"' data-promotional='"+data.promotional+"' data-description='"+data.description+"' data-category='"+data.nameCategory+"' data-producttype='"+data.nameProductType+"'data-status='" + data.status + "'data-created_at='" + data.created_at + "'><span class='fa fa-eye'></span></button> <button class='edit-modal-productType btn btn-warning btn-sm' data-target='#modal-edit-productType' data-toggle='modal' data-id='" + data.id  + "'data-name='" + data.name + "'data-category='" + data.idCategory + "'data-slug='" + data.slug + "'data-status='" + data.status +"'><i class='far fa-edit'></i></button> <button class='delete-modal-productType btn btn-danger btn-sm' data-target='#modal-delete-productType' data-toggle='modal' data-id='" + data.id + "'data-name='" + data.name +"'><i class='far fa-trash-alt'></i></button></td>"+
        "</tr>");

        $('#image-product-edit').val('');
        $('#mulImage').val('');
      }
    }
  });
});

