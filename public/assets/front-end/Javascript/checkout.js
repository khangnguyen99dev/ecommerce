$(document).ready((e)=>{
    $('.choose').change(function(){
        let action = $(this).attr('id');
        let idCity = $(this).val();
        let result = '';
        if(action == 'city') {
            result = 'district';
            let html = `<option value="" selected="selected">--Chọn Phường / Xã--</option>`;
            $('#ward').html(html);
            $('#ward').attr('selected','false');
        }else{
            result = 'ward';
        }
        $.ajax({
            type: 'POST',
            url: '/chooseaddress',
            data: {
                action:action,
                idCity:idCity
            },
            success: (data)=>{
                $('#'+result).html(data.address);
            }
        })
    })
})


$(document).on('click', '.btn-back', function (e) {
    e.preventDefault();
    history.back();
})



$('#payment').on('click',(e)=>{
    let itemAddress = $('.cart-checkbox__input-all');
    let rowId = $('.checkout-shop-order-group__orders');
    let name = '';
    let phone = '';
    let address = '';
    let total = '';
    let id = [];
    $.each(itemAddress,(index,value)=>{
        if(value.checked) {
            name = $(value).parent().parent().find('.checkout-address-row__user-name').data('name');
            phone = $(value).parent().parent().find('.checkout-address-row__user-phone').data('phone');
            address = $(value).parent().parent().find('.checkout-address-row__address-summary').data('address');
            note = $('.input-with-status__input').val();
            total = $('#total').data('total');
        }
    })

    $.each(rowId, (index,value)=> {
        id.push($(value).data('id'));
    })
    $.ajax({
        type: 'POST',
        url: 'cart',
        data: {
            'idProduct': id,
            'name': name,
            'phone': phone,
            'address': address,
            'message': note,
            'money': total,
        },
        success: (data) => {
            toastr.options = {
                "debug": false,
                "positionClass": "toast-top-center",
                "onclick": null,
                "fadeIn": 300,
                "fadeOut": 1000,
                "timeOut": 1000,
                "extendedTimeOut": 2000
            }
            if(data.error){
                toastr["info"](data.error);
            }else{
                toastr["info"](data.message);
                window.location.href = "/purchased/ready";
            }
        }
    })
})
function AddressDefault(){
    let itemAddress = $('.cart-checkbox__input-all');
    if(itemAddress.length > 1) {
        $('#back-address').hide();
        $('#add-address').hide();
        $.each(itemAddress, (index,value) => {
            if(value.checked){
                $(value).parent().hide();
            }else{
                $(value).parent().parent().hide();
            }
        })
    }else{
        $('#back-address').hide();
        $('#add-address').show();
    }
}
AddressDefault();
function change() { 
    let itemAddress = $('.cart-checkbox__input-all');
    $('#change-address').on('click',(e)=>{
        $('#change-address').hide();
        $('#back-address').show();
        $('#add-address').show();
        $('#back-address').on('click',(e)=> {
            $('#change-address').show();
            AddressDefault();
        })
        if(itemAddress.length > 1) {
        $.each(itemAddress, (index,value) => {
            if(value.checked){
                $(value).parent().show();
            }else{
                $(value).parent().parent().show();
            }
        })
    }
    })
}
change();
    $('.header__cart-wrap').hide();
    $('#add-address').on('click',(e)=> {
        $('.modal').css('display','flex');
        $('.modal__body').show();
    })

    $('.modal__overlay').on('click',()=>{
        $('.modal').hide();
    })

    $('.auth-form__controls-back').on('click', ()=> {
        $('.modal').hide();
    })

    $('#btn-address').on('click', (e)=> {
        let name = $('#name').val();
        let phone = $('#phone').val();
        let address = $('#address').val();
        let idCity = $('#city').val();
        let idDistrict = $('#district').val();
        let idWard = $('#ward').val();

        let check = 0;
        if($('#check-default')[0].checked){
            check = 1;
        }
        $.ajax({
            type: 'POST',
            url:'addAddress',
            data: {
                'name': name,
                'phone': phone,
                'address': address,
                'active': check,
                'idCity': idCity,
                'idDistrict': idDistrict,
                'idWard': idWard,
            },
            success: (data)=> {
                let info = data.info[0];
                let html ='';
                if(info.active == 1) {
                    $('input[type="checkbox"]').prop('checked', false);
                    $('.checkout-address-row__default-label').hide();
                }
                html+=`<div class="checkout-address-selection__item active">
                    <div class="cart-checkbox">`;
                if(info.active == 1){
                    html+=`<input class="cart-checkbox__input-all" type="checkbox" checked>`;
                }else{
                    html+=`<input class="cart-checkbox__input-all" type="checkbox">`;
                }
                        
                html+=`<div class="cart-checkbox__bgc radio__input-address"></div>
                    </div>
                    <div class="checkout-address-selection__selected-address-summary">

                        <div class="checkout-address-row">
                            <div class="checkout-address-row__user-detail">
                                <span class="checkout-address-row__user-name" data-name="${info.name}">${info.name}</span>
                                <span class="checkout-address-row__user-phone" data-phone="${info.phone}">${info.phone}</span>
                            </div>
                            <div class="checkout-address-row__address-summary" data-address="${info.address}, ${info.ward.name}, ${info.district.name}, ${info.city.name}">${info.address}, ${info.ward.name}, ${info.district.name}, ${info.city.name}</div>`;
                if(info.active == 1){
                    html+=`<div class="checkout-address-row__default-label">Mặc định</div>`;
                }
                            
                    html+=`</div>
                    </div>
                </div>`;
                if(info.active == 1) {
                    $('#address-list').append(html);
                    $('#change-address-add').html(`<div class="checkout-address-selection__change-btn" id="change-address">Thay đổi</div>`);
                }else{
                    $('#address-list').append(html);               
                    $('#change-address-add').html(`<div class="checkout-address-selection__change-btn" id="change-address">Thay đổi</div>`);
                }
                let itemAddress = $('.cart-checkbox__input-all');
                $.each(itemAddress, (index,value) => {
                    if(value.checked){
                        $(value).parent().hide();
                    }else{
                        if($('#address-none').length > 0) {              
                            $('#change-address-add').html(`<div class="checkout-address-selection__change-btn" id="change-address">Thay đổi</div>`);     
                            $('#address-none').hide();          
                        }else{
                            $(value).parent().parent().hide();
                        }                  
                    }
                })
                AddressDefault();
                change();
                checkboxOne();
                $('.modal').hide();
            }
        })
        
    })

    $('#address-back').on('click', (e)=> {
        $('.address-list').show();
        $('.address-list-add').hide();
        $('#change-address').show();
    })
function checkboxOne(){
    $('input[type="checkbox"].cart-checkbox__input-all').on('change', function() {
        $('input[type="checkbox"]').not(this).prop('checked', false);
        change();
    });
}

checkboxOne();
