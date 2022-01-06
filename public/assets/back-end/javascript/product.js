$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $(document).on('click', '.show-modal-product', function(e) {
        e.preventDefault();
      let status='';
      if($(this).data('status') == 1){
          status = 'Hiển thị';
      }else{
          status = 'Ẩn';
      }
      let idProduct = $(this).data('id');
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

     $.get('api/wapper/'+idProduct, function (data) {
      html = '';
      data.wapper.map((value)=> {
        return html+=`<img src="assets/img/upload/product/${value.path}" alt="${value.name}" style="padding: 5px; width: 120px" >`;
      })
      $('#multiple-image').html(html);
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
          if(data.error){
            toastr['info'](data.error);
          }else{
            toastr['info'](data.success);
            $('.product' + $('#id-delete-product').text()).remove();
          }        
      }
    });
  });
  // Edit function
  $(document).on('click', '.edit-modal-product', function(e) {
      e.preventDefault();
      $('#id-product-edit').val($(this).data('id'));
      $('#name-product-edit').val($(this).data('name'));
      $('#quantity-product-edit').val($(this).data('quantity'));
      $('#oldPrice-product-edit').val($(this).data('oldprice'));
      $('#img-product-edit').attr('src','assets/img/upload/product/'+$(this).data('image'));
      $('#promotion-product-edit').val($(this).data('promotional'));
      CKEDITOR.instances['description-product-edit'].setData($(this).data('description'));
      $('#category-product-edit').val($(this).data('category'));
      $('#productType-product-edit').val($(this).data('producttype'));
      $('#status-product-edit').val($(this).data('status'));
      let idProduct = $(this).data('id')
      $.get('api/wapper/'+idProduct, function (data) {
        html = '';
        data.wapper.map((value)=> {
          return  html+=`
          <div class="imgGroup" id="${value.id}">
           <img src="assets/img/upload/product/${value.path}" alt="${value.name}" style="padding: 5px; width: 120px">
           <span class="delete-img" data-id="${value.id}"><i class="far fa-trash-alt"></i></span>
          </div>
          `;
        })
        $('#multipleImage').html(html);
        deleteImg();
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
  
  $(document).on('submit', '#form-add-promotion-product', function (e) {
    e.preventDefault();
    $.ajax({
      method: "POST",
      url: "admin/addPromotionProduct", 
      data: new FormData(this),
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success: (data) => {
          if(data.error){
              toastr['info'](data.error);
          }else{
              toastr['info']('Thêm khuyến mãi thành công');
              location.reload();
          }
      }
    })
})

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
        if(res.error){
          toastr['info'](data.error);
        }else{
          toastr['info']('Cập nhật sản phẩm thành công');
          location.reload();
          // let status = '';
          // if(data.status == 1) {
          //     status = 'Hiển thị';
          // }else{
          //     status = 'Ẩn';
          // }
          // $('#img-product-edit').attr('src',`assets/img/upload/product/${data.image}`);
          // if(res.dataImg) {
          //   let img = res.dataImg;
          //   if(img.length > 0) {
          //     html = '';
          //     $.each(img, (index, value) => {
          //       html+=`
          //       <div class="imgGroup" id="${value.id}">
          //        <img src="assets/img/upload/product/${value.path}" style="padding: 5px; width: 120px">
          //        <span class="delete-img" data-id="${value.id}"><i class="far fa-trash-alt"></i></span>
          //       </div>
          //       `;
          //     })
    
          //     $('#multipleImage').append(html);
          //   }
          //   deleteImg();
          // }
          
          // $('.product' + data.id).replaceWith(" "+
          // "<tr class='product" + data.id + "'>"+
          // "<td>" + data.id + "</td>"+
          // "<td style='max-width: 200px'>" + data.name + "</td>"+
          // "<td><img src='assets/img/upload/product/"+data.image+"' alt='Ảnh "+data.name+"' width='100px'></td>"+
          // "<td>" + Intl.NumberFormat().format(data.currentPrice) + "₫</td>"+
          // "<td>" + data.promotion.promotional + "%</td>"+
          // "<td>" + data.quantity + "</td>"+
          // "<td>" + status + "</td>"+
          // "<td><button class='show-modal-product btn btn-info btn-sm' data-target='#modal-show-product' data-toggle='modal' data-id='" + data.id + "'data-slug='"+data.slug+"' data-quantity='"+data.quantity+"' data-sold='"+data.sold+"' data-oldprice='"+data.oldPrice+"' data-currentprice='"+data.currentPrice+"' data-image='"+data.image+"' data-react='"+data.react+"' data-promotional='"+data.promotional+"' data-description='"+data.description+"' data-category='"+data.nameCategory+"' data-producttype='"+data.nameProductType+"'data-status='" + data.status + "'data-created_at='" + data.created_at + "'><span class='fa fa-eye'></span></button> <button class='edit-modal-productType btn btn-warning btn-sm' data-target='#modal-edit-productType' data-toggle='modal' data-id='" + data.id  + "'data-name='" + data.name + "'data-category='" + data.idCategory + "'data-slug='" + data.slug + "'data-status='" + data.status +"'><i class='far fa-edit'></i></button> <button class='delete-modal-productType btn btn-danger btn-sm' data-target='#modal-delete-productType' data-toggle='modal' data-id='" + data.id + "'data-name='" + data.name +"'><i class='far fa-trash-alt'></i></button></td>"+
          // "</tr>");
  
          // $('#image-product-edit').val('');
          // $('#mulImage').val('');
        }
      }
    });
  });
  
  