@extends('front-end.layouts.main')

@section('title')
    Giỏ hàng
@endsection

@section('content')
<div class="grid wide">
    <div class="container" style="margin-top: 30px">
        <div class="checkout-address-selection">
            <div class="tickid-border-delivery"></div>
            <div class="checkout-address-selection__container">
                <div class="checkout-address-selection__section-header" id="add-change">
                    <div class="checkout-address-selection__section-header-text">
                        <svg class="tickid-svg-icon icon-location-marker" height="16" viewBox="0 0 12 16" width="12">
                            <path d="M6 3.2c1.506 0 2.727 1.195 2.727 2.667 0 1.473-1.22 2.666-2.727 2.666S3.273 7.34 3.273 5.867C3.273 4.395 4.493 3.2 6 3.2zM0 6c0-3.315 2.686-6 6-6s6 2.685 6 6c0 2.498-1.964 5.742-6 9.933C1.613 11.743 0 8.498 0 6z" fill-rule="evenodd"></path>
                        </svg> Địa chỉ nhận hàng
                    </div>
                    <div id="change-address-add">
                    @if(count($customer) > 0)        
                        <div class="checkout-address-selection__change-btn" id="change-address">Thay đổi</div>           
                    @endif
                    </div>
                </div>
                <div class="checkout-address-selection__list address-list" >
                    @if(count($customer) > 0)
                        <div id="address-list">
                            @foreach($customer as $value)                      
                                <div class="checkout-address-selection__item active">
                                    <div class="cart-checkbox">
                                        @if($value->active == 1)
                                        <input class="cart-checkbox__input-all" type="checkbox" checked>
                                        @else
                                        <input class="cart-checkbox__input-all" type="checkbox">
                                        @endif
                                        <div class="cart-checkbox__bgc"></div>
                                    </div>
                                    <div class="checkout-address-selection__selected-address-summary">

                                        <div class="checkout-address-row">
                                            <div class="checkout-address-row__user-detail">
                                                <span class="checkout-address-row__user-name" data-name="{{$value->name}}">{{$value->name}}</span>
                                                <span class="checkout-address-row__user-phone" data-phone="{{$value->phone}}">{{$value->phone}}</span>
                                            </div>
                                            <div class="checkout-address-row__address-summary" data-address="{{$value->address}}">{{$value->address}}</div>
                                            @if($value->active == 1)
                                            <div class="checkout-address-row__default-label">Mặc định</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>        
                            @endforeach
                        </div>
                    @else
                        <div id="address-list">
                            <div class="address-none" id="address-none">
                                <span class="address-item-none">Vui lòng thêm địa chỉ nhận hàng</span>
                            </div>
                        </div>
                    @endif
                    <div class="checkout-footer">
                    <div class="checkout-address-selection__buttons" id="back-address">
                        <button class="tickid-button-solid btn-solid-default">
                            <span class="cart-page-footer__checkout-text">Trở lại</span>
                        </button>
                    </div>
                        <div class="checkout-address-selection__buttons">
                            <button class="tickid-button-solid btn-solid-default" id="add-address">
                                <span class="cart-page-footer__checkout-text">Thêm địa chỉ mới</span>
                            </button>
                        </div>
                        </div>
                </div>

            </div>
        </div>
        <div class="checkout-product-ordered-list">
            <div class="checkout-product-ordered-list__header-block">
                <div class="checkout-product-ordered-list__headers">
                    <div class="checkout-product-ordered-list__header checkout-product-ordered-list__header--product">
                        <div class="checkout-product-ordered-list__title">Sản phẩm</div>
                    </div>
                    <div class="checkout-product-ordered-list__header hidden-sm">Đơn giá</div>
                    <div class="checkout-product-ordered-list__header hidden-sm">Số lượng</div>
                    <div class="checkout-product-ordered-list__header checkout-product-ordered-list__header--subtotal  hidden-sm">Thành tiền</div>
                </div>
            </div>
            <div class="checkout-product-ordered-list__content">
                <div class="checkout-shop-order-group">
                    @forEach($cart as $key => $value)
                    <div class="checkout-shop-order-group__orders" data-id="{{$value->rowId}}">
                        <div class="checkout-product-ordered-list-item">
                            <div class="checkout-product-ordered-list-item__items">
                                <div class="checkout-product-ordered-list-item__item checkout-product-ordered-list-item__item--non-add-on">
                                    <div class="checkout-product-ordered-list-item__header checkout-product-ordered-list-item__header--product">
                                        <img class="checkout-product-ordered-list-item__product-image" src="assets/img/upload/product/{{$value->options->image}}" width="40" height="40">
                                        <span class="checkout-product-ordered-list-item__product-info">
                                                    <span class="checkout-product-ordered-list-item__product-name">{{$value->name}}</span>
                                        </span>
                                    </div>
                                    <div class="checkout-product-ordered-list-item__header checkout-product-ordered-list-item__header--unit-price">{{number_format($value->price,0,',','.')}}₫</div>
                                    <div class="checkout-product-ordered-list-item__header checkout-product-ordered-list-item_header--amount">{{$value->qty}}</div>
                                    <div class="checkout-product-ordered-list-item__header  checkout-product-ordered-list-item__header--subtotal">{{number_format($value->qty*$value->price,0,',','.')}}₫</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforEach
                    <div class="checkout-product-message">
                        <div class="checkout-product-message__header checkout-product-message__has">
                            <div class="buyer-remark"><span>Lời nhắn:</span>
                                <div class="input-with-status">
                                    <div class="input-with-status__wrapper">
                                        <input class="input-with-status__input" type="text" placeholder="Lưu ý cho Người bán..." value="" name="user_note">
                                    </div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="checkout-product-total">
                        <div class="checkout-product-total__number">Tổng số tiền ({{$quantity}} sản phẩm):</div>
                        <div class="checkout-product-total__price">{{number_format($total,0,',','.')}}₫</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-checkout__payment-order-wrapper">
            <div class="checkout-payment-method-view">
                <div class="checkout-payment-method-view__current">
                    <div class="checkout-payment-method-view__current-title">Phương thức thanh toán</div>
                    <div class="checkout-payment-setting__payment-methods-tab">
                        <span><button class="product-variation product-variation--selected">Thanh toán khi nhận hàng</button></span>
                    </div>
                </div>

                <div class="checkout-payment-setting__payment-method-options">
                    <div class="checkout-payment-item">Thanh toán khi nhận hàng</div>
                </div>
            </div>
            <div class="page-checkout__payment-order-footer">
                <div class="flex">
                    <div class="page-checkout__payment-order-item label">Tổng tiền hàng:</div>
                    <div class="page-checkout__payment-order-item value">{{number_format($total,0,',','.')}}₫</div>
                </div>

                <div class="checkoutp-item-fee js-checkoutp-item-fee">
                    <div class="flex">
                        <div class="page-checkout__payment-order-item label">Phí Ship:</div>
                        <div class="page-checkout__payment-order-item value">Miễn phí</div>
                    </div>
                </div>

                <div class="flex">
                    <div class="page-checkout__payment-order-item label">Tổng thanh toán:</div>
                    <div class="page-checkout__payment-order-item  page-checkout__payment-order-item-value" data-total="{{ $total }}" id="total">{{number_format($total,0,',','.')}}</div>
                </div>

                <div class="cart-page-footer__checkout-payment auth-form__controls">
                    <a href="/cart" class="btn auth-form__controls-back cart-page-footer__checkout-back">Trở lại</a>
                    <button class="cart-page-footer__checkout clear-btn" id="payment">Đặt hàng</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal">
        <div class="modal__overlay"></div>
        <div class="modal__body">
            <form id="address-form" class="auth-form">
                @csrf
                <div class="auth-form__container">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">Thêm địa chỉ nhận hàng</h3>
                    </div>
                    <div class="auth-form__groups">
                        <div class="auth-form__group">
                            <!-- <label for="name" class="auth-form__label">Tên</label> -->
                            <input class="auth-form__input" placeholder="Nhập tên của bạn" id="name" type="text"/>
                        </div>
                        <div class="auth-form__group">
                            <!-- <label for="phone" class="auth-form__label">Số điện thoại</label> -->
                            <input class="auth-form__input" placeholder="Số điện thoại..."  id="phone" type="text"/>
                        </div>
                        <div class="auth-form__group">
                            <select name="city" id="city" size="1" class="choose city selectaddress">
                                <option value="" selected="selected">--Chọn Tỉnh / Thành phố--</option>
                                @foreach($city as $value)
                                    <option value="{{str_pad($value->id,2,'0',STR_PAD_LEFT)}}">{{$value->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="auth-form__group">
                            <select name="district" id="district" size="1" class="choose district selectaddress">
                                <option value="" selected="selected">--Chọn Quận / Huyện--</option>
                            </select>                         
                        </div>
                        <div class="auth-form__group">
                            <select name="ward" id="ward" size="1" class="ward selectaddress">
                                <option value="" selected="selected">--Chọn Phường / Xã--</option>
                            </select>   
                        </div>
                        <div class="auth-form__group">
                            <input class="auth-form__input" placeholder="Tòa nhà / Tên đường..." id="address" type="text"/>
                        </div>
                        <div class="checkbox">
                            <div class="cart-checkbox checkbox-item">
                                <input class="cart-checkbox__input-default" type="checkbox" id="check-default">
                                <div class="cart-checkbox__bgc"></div>
                            </div>
                            <div class="checkbox-default">Đặt làm mặc định</div>
                        </div>
                        <div class="auth-form__controls auth-form__controls-last">
                            <span class="btn auth-form__controls-back">TRỞ LẠI</span>
                            <button class="btn btn--primary" type="button" id="add-order">TIẾP TỤC</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script>

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
                window.location.href = "/";
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

    $('#add-order').on('click', (e)=> {
        let name = $('#name').val();
        let phone = $('#phone').val();
        let address = $('#address').val() +','+ $('#ward option:selected').text() + ','+ $('#district option:selected').text() + ','+ $('#city option:selected').text();
        let check = 0;
        if($('#check-default')[0].checked){
            check = 1;
        }
        $.ajax({
            type: 'POST',
            url:'{{route('customer.store')}}',
            data: {
                'name': name,
                'phone': phone,
                'address': address,
                'active': check,
            },
            success: (data)=> {
                let info = data.info;
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
                        
                html+=`<div class="cart-checkbox__bgc"></div>
                    </div>
                    <div class="checkout-address-selection__selected-address-summary">

                        <div class="checkout-address-row">
                            <div class="checkout-address-row__user-detail">
                                <span class="checkout-address-row__user-name" data-name="${info.name}">${info.name}</span>
                                <span class="checkout-address-row__user-phone" data-phone="${info.phone}">${info.phone}</span>
                            </div>
                            <div class="checkout-address-row__address-summary" data-address="${info.address}">${info.address}</div>`;
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
</script>
@endsection