$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
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

  $(document).on('submit','#form-product-add', function(event){
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
          toastr['info']('Thêm sản phẩm thành công!');
        }
      }
    });
  });