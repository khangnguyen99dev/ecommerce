@extends('front-end.layouts.main')

@section('title')
    Giỏ hàng
@endsection

@section('content')
<div class="grid wide" id="cart-product">
    <div class="cart-suggestion">
        <i class="fas fa-truck-loading"></i>
        <span>Nhấn vào mục Mã giảm giá ở cuối trang để hưởng miễn phí vận chuyển bạn nhé!</span>
    </div>

    <!-- Cart product header -->
    <div class="cart-page-product-header">
<!--         <div class="cart-checkbox">
            <input class="cart-checkbox__input-all" type="checkbox">
            <div class="cart-checkbox__bgc"></div>
        </div> -->
        <span class="cart-page-product-header__product">
            <span class="cart-page-product-header__product-name">Sản Phẩm</span>
        </span>
        <span class="cart-page-product-header__unit-price">Đơn Giá</span>
        <span class="cart-page-product-header__qnt">Số Lượng</span>
        <span class="cart-page-product-header__total-price">Số Tiền</span>
        <span class="cart-page-product-header__action">Thao Tác</span>
    </div>


    <div class="cart-bundle__header">
        <div class="cart-bundle-header__logo-wrapper">
            <div class="cart-bundle-header__logo-bgc">Khuyến mãi</div>
            <div class="cart-bundle-header__logo-triangle"></div>
            <div class="cart-bundle-header__logo-hide-left"></div>
            <div class="cart-bundle-header__logo-hide-right"></div>
        </div>

        <span class="cart-bundle-header__hint">Mua thêm 1 sản phẩm</span>
        <span class="cart-bundle-header__saving">(còn nhiều khuyến mãi)</span>
        <a href="{{ route('home') }}" class="cart-bundle-header__more">
            Thêm
            <i class="cart-bundle-header__more-icon fas fa-chevron-right"></i>
        </a>
    </div>

    <!-- Cart shop content-->
    <div class="cart-page-shop-container">
<!--         <div class="cart-page-shop__header">
            <div class="cart-checkbox">
                <input class="cart-checkbox__input" type="checkbox">
                <div class="cart-checkbox__bgc"></div>
            </div>
            <div class="label-loving">Yêu Thích</div>
            <span class="cart-page-shop__header-name">toykids</span>
            <button class="cart-page-shop__header-btn-chat">
                <i class="cart-page-shop__header-icon fas fa-comment-alt"></i>
            </button>
        </div> -->
        
        <div class="cart-page-shop__container-items">
            <div class="cart-bundle" id="cart">   
                @foreach($cart as $key => $value)
                <div class="cart-item cart-item{{ $value->rowId }}">


                    <div class="cart-item__group">
                        <div class="cart-checkbox">
                            <input class="cart-checkbox__input" type="checkbox" data-check="{{ $value->id }}" id="check{{ $value->id }}" name="check[]">
                            <div class="cart-checkbox__bgc"></div>
                        </div>

                        <div class="cart-item__overview">
                            <a href="#" class="cart-item__overview-img-link">
                                <img class="cart-item__overview-img" src="assets/img/upload/product/{{ $value->options['image'] }}">
                            </a>
                            <a href="#" class="cart-item__overview-name">{{ $value->name }}</a>
                        </div>
                    </div>
<!--                     <div class="cart-item__variations">
                        <div class="cart-item__variation-label">
                            Danh mục: 
                            <button class="cart-item__variation-btn-arrow">
                                <i class="cart-item__variation-icon-arrow-down fas fa-sort-down"></i>
                            </button>
                        </div>
                        <div class="cart-item__variation-model">{{ $value->options['Category'] }}</div>
                    </div> -->

                    <div class="cart-item__price">
                        <div class="cart-item__price-old">{{ number_format($value->options['oldPrice'],0,",",".") }}₫</div>
                        <div class="cart-item__price-current">{{ number_format($value->price,0,",",".") }}₫</div>
                    </div>

                    <div class="shop__qnt-btns" data-id="{{ $value->id }}">
                        <button class="shop__qnt-btn shop__qnt-btn--dec">
                            <i class="fas fa-minus"></i>
                            <!-- shop__qnt-btn-icon -->
                        </button>
                        <input class="shop__qnt-input quantity-product" type="text" value="{{ $value->qty }}" id="{{ $value->id }}" data-id="{{ $value->rowId}}"></input>
                        <button class="shop__qnt-btn shop__qnt-btn--inc">
                            <i class="fas fa-plus"></i>
                            <!-- shop__qnt-btn-icon -->
                        </button>
                    </div>

                    <div class="cart-item__price-total" id="total{{$value->id}}" data-total="{{$value->price*$value->qty}}"> {{ number_format($value->price*$value->qty,0,",",".") }}₫</div>

                    <div class="cart-item__actions">
                        <button class="cart-item__action-remove cart-remove" data-id="{{ $value->rowId}}">Xóa</button>
 <!--                        <button class="cart-item__action-search">
                            <span class="cart-item__action-search-title">Tìm sản phẩm tương tự</span>
                            <i class="cart-item__action-search-icon fas fa-sort-down"></i>
                        </button> -->
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="cart-voucher">
            <i class="cart-voucher__icon fas fa-archive"></i>
            <div class="cart-voucher__message">Lưu voucher giảm ₫8k</div>
            <button class="cart-voucher__btn-save">Lưu</button>
        </div>

        <div class="cart-shipping">
            <i class="cart-shipping__icon fas fa-shipping-fast"></i>
            <div class="cart-shipping__message">Miễn Phí Vận Chuyển cho đơn hàng từ ₫50.000 (giảm tối đa ₫20.000); Miễn Phí Vận Chuyển cho đơn hàng từ ₫300.000 (giảm tối đa ₫70.000)</div>
            <div class="cart-shipping__learn-more">Tìm hiểu thêm</div>
        </div>
    </div>

    <!-- Cart page footer -->
    <div class="cart-page-footer">
        <!-- <div class="cart-page-footer__row1">
            <div class="cart-page-footer__voucher">
                <i class="cart-page-footer__voucher-icon fas fa-box-tissue"></i>
                <div class="cart-page-footer__voucher-name">Minecraft Shop Voucher</div>
            </div>
            <div class="cart-page-footer__option">Chọn hoặc nhập mã</div>
        </div>

        <div class="cart-page-footer__row2">
            <div class="cart-page-footer__checkbox">
                <div class="cart-checkbox cart-checkbox--disabled">
                    <input class="cart-checkbox__input" type="checkbox">
                    <div class="cart-checkbox__bgc"></div>
                </div>
            </div>

            <div class="cart-page-footer__title">
                <i class="cart-page-footer__title-icon-label blur-item fas fa-donate"></i>
                <div class="cart-page-footer__title-name blur-item">Kane Store Xu</div>
                <div class="cart-page-footer__title-message">Bạn chưa có Minecraft Xu</div>
                <i class="cart-page-footer__title-icon-question far fa-question-circle"></i>
            </div>
            <div class="cart-page-footer__value">-₫0</div>
        </div> -->
        
        <div class="cart-page-footer__row3">
            <div class="cart-page-footer__actions">
                <div class="cart-checkbox">
                    <input class="cart-checkbox__input-all" type="checkbox">
                    <div class="cart-checkbox__bgc"></div>
                </div>
                <button class="cart-page-footer__actions-btn cart-page-footer__select-all clear-btn" id="select-all-checkbox">Chọn tất cả ({{ Cart::count() }})</button>
                <button class="cart-page-footer__actions-btn cart-page-footer__remove clear-btn">Xóa</button>
                <!-- <button class="cart-page-footer__actions-btn cart-page-footer__save clear-btn">Lưu vào mục Đã thích</button> -->
            </div>

            <div class="cart-page-footer__summary">
                <div class="cart-page-footer__summary-total">
                    <div class="cart-page-footer__summary-total-text">Tổng tiền hàng (0 sản phẩm):</div>
                    <div class="cart-page-footer__summary-total-amount" data-alltotal="0">0₫</div>
                </div>
                <div class="cart-page-footer__summary-bonus">Nhận thêm: 0 Xu</div>
            </div>
            <form action="{{route('checkout')}}" method="POST" id="formdata">
                @csrf
                <div id="datasend">

                </div>
                <button class="cart-page-footer__checkout clear-btn" id="checkout" type="submit">Mua Hàng</button>
            </form>
        </div>
    </div>

    <!-- Cart carousel -->
<!--     <div class="cart-page-carousel-container">
        <div class="cart-page-carousel__title">CÓ THỂ BẠN CŨNG THÍCH</div>
        <div class="cart-page-carousel__items">
            <button class="cart-page-carousel__items-btn cart-page-carousel__items-btn--left clear-btn">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="cart-page-carousel__items-btn cart-page-carousel__items-btn--right clear-btn">
                <i class="fas fa-chevron-right"></i>
            </button>
            <div class="cart-page-carousel__item-wrapper">
                <a href="#" class="cart-page-carousel__item">
                    <div class="cart-page-carousel__item-img-wrapper">
                        <img class="cart-page-carousel__item-img" src="https://cdn.shopify.com/s/files/1/0251/2155/4510/products/7652p_262c_2x_6fd3fe79-79c8-4092-84b3-34ebbce9a769_800x.jpg?v=1608318433">
                    </div>

                    <div class="product-favourite">Yêu thích</div>

                    <div class="product-sale-off">
                        <span class="product-sale-off__percent">33%</span>
                        <span class="product-sale-off__label">GIẢM</span>
                    </div>

                    <div class="cart-page-carousel__item-container">
                        <div class="cart-page-carousel__item-name">[KHAI TRƯƠNG 149K-219K] Chuỗi Balo, Túi xách Minecraft được giảm giá đặc biệt nhân ngày mở bán</div>
                        <div class="cart-page-carousel__item-bottom">
                            <div class="cart-page-carousel__item-price">₫310.000</div>
                            <div class="cart-page-carousel__item-sold">Đã bán 15</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div> -->

</div>
<script>

let products = fetch('http://kanestore.com/api/product')
    .then((res) => {
        return res.json();
    })
    .catch((err) => {
        console.log(err);
    })

// cart
//     .then((data) => {
//         return new Promise((resolve, reject) => {
//             reject();
//         })
//     })
//     .then((data) => {
//         console.log(data)
//     })
//     .catch((error) => {
//         console.log('co loi')
//     })

$(document).ready(() => {

    document.querySelector('.header__cart-wrap').style.display = "none";
    addCheckbox();
    allProduct();
    inc();
    dec();
    search();

    $('#checkout').on('click', (e) => {
        e.preventDefault();
        let allCheck = document.querySelectorAll('.cart-checkbox__input');
        let item = [];
        $.each(allCheck,(index,value)=> {
            if(value.checked){
                let id = value.getAttribute('data-check');
                item.push(id);
                $('#datasend').append(`<input type="hidden" value="${id}" name="item[]">`);
            }      
        }) 
        console.log(item)
        if(item.length > 0) {
            $('#formdata').submit();
        }else{
            toastr.options = {
                "debug": false,
                "positionClass": "toast-top-center",
                "onclick": null,
                "fadeIn": 300,
                "fadeOut": 1000,
                "timeOut": 1000,
                "extendedTimeOut": 2000
            }
            toastr["info"]('Bạn chưa chọn sản phẩm!');  
        }     
    })
}) 

// document.querySelector('.header__cart').style.display = "none";

function addCheckbox() {
    let allCheck = document.querySelectorAll('.cart-checkbox__input');
    let lengthCheck = allCheck.length;
    if(lengthCheck > 0) {
        $.each(allCheck, (index, value) => {
            value.addEventListener('change' , (e) => {
                let id = value.getAttribute('id');
                if(value.checked) {
                    $('#'+id).checked = false;
                }else{
                    $('#'+id).checked = true;
                }
                changeTotal();
                getQuantity();
            })

        })
    }
}


function changeTotal() {
    let check = $('input[name="check[]"]:checked');
    if(check.length > 0) {
        let total = 0;
        $.each(check, (index,value) => {
            let id = $(value).attr('data-check');
            let price = $('#total'+id).attr('data-total');
            total += parseInt(price);
        })
        $('.cart-page-footer__summary-total-amount').html(Intl.NumberFormat().format(total)+'₫');
    }else{
        $('.cart-page-footer__summary-total-amount').html(0+'₫');
    }
}


function allProduct () {
    let allProduct = document.querySelectorAll('.cart-checkbox__input-all');
    let allList = document.querySelectorAll('.cart-checkbox__input');
    let lengthProduct = allProduct.length;
    let lengthList = allList.length;
    if(lengthProduct > 0) {
        $.each(allProduct, (index, value) => {
            value.addEventListener('change', (e) => {
                if(value.checked){
                    for(let j=0; j < lengthList; j++) {
                        if(allList[j].checked) {
                            continue;
                        }else{
                            allList[j].checked = true;
                        }
                    } 
                }else{
                    for(let j=0; j < lengthList; j++) {
                        if(allList[j].checked) {
                            allList[j].checked = false;
                        }
                    }              
                }
                changeTotal();
                getQuantity();
            })             
        })
    }
}


function upadte(id,qty) {
    console.log(id,qty)
    $.ajax({
        type: 'PUT',
        url: 'cart/'+id,
        data: {
          'quantity': qty,
        },
        success: function(data){
            if(data.cartContent) {
                document.querySelector('.header__cart-wrap-notice').innerHTML = data.cartCount;
            }
        }
    });
}

function getQuantity() {
    let allQty = document.querySelectorAll('.quantity-product');
    let lengthQty = allQty.length;
    let totalQty = 0;
    let allPro = 0;

    let allList = document.querySelectorAll('.cart-checkbox__input');

    $.each(allList, (index, value) => {
        if(value.checked) {
            let id = value.getAttribute('data-check');

            let qty = $('#'+id).val();

            totalQty += parseInt(qty);
        }
    })

    $.each(allQty, (index, value) => {
        allPro += parseInt(value.value);
    })

    $('.cart-page-footer__summary-total-text').html('Tổng tiền hàng ('+totalQty+' sản phẩm):');
    $('.cart-page-footer__select-all').html('Chọn tất cả ('+allPro+'):');
}

const inc = () => {
    products
    .then((res) => {
        let listProduct = document.querySelectorAll('.shop__qnt-btn--inc');
        let length = listProduct.length;
        if(length > 0) {
            for(let i=0; i < length; i++) {
                listProduct[i].addEventListener('click' , (e) => {
                    let parent = listProduct[i].parentNode;
                    let id = parent.getAttribute('data-id');
                    let product = res.find((product) => {
                        return product.id == id
                    });
                    let number = $('#'+id).val();
                    let idCart = $('#'+id).data('id'); 
                    number ++;
                    if(number > product.quantity) {
                        $('#'+id).val(product.quantity);
                    }else{
                        $('#'+id).val(number);
                        let price  = number*product.currentPrice;
                        $('#total'+id).attr('data-total',price);
                        $('#total'+id).html(Intl.NumberFormat().format(price)+'₫');

                        if($('#check'+id).is(":checked")) {
                            let check = $('input[name="check[]"]:checked');
                            if(check.length > 0) {
                                let total = 0;
                                for(let i =0 ; i < check.length; i++) {
                                    let idcheck = check[i].getAttribute('data-check');
                                    let price = document.getElementById('total'+idcheck).getAttribute('data-total');

                                    total += parseInt(price);
                                }

                                document.querySelector('.cart-page-footer__summary-total-amount').innerHTML = Intl.NumberFormat().format(total)+'₫';
                            }
                        }
                        getQuantity();
                        upadte(idCart,number);
                    }
                })
            }
        } 
    })
}

const dec = () => {
    products
    .then((res) => {
        let listPrev = document.querySelectorAll('.shop__qnt-btn--dec');
        let lengthPrev = listPrev.length;
        if(lengthPrev > 0) {
            for(let i=0; i < lengthPrev; i++) {
                listPrev[i].addEventListener('click' , (e) => {
                    let parent = listPrev[i].parentNode;
                    let id = parent.getAttribute('data-id');
                    let product = res.find((product) => {
                        return product.id == id
                    });
                    let number = $('#'+id).val();
                    let idCart = $('#'+id).data('id');  
                    number --;
                    if(number <= 0) {
                        $('#'+id).val(1);
                    }else{
                        $('#'+id).val(number);
                        let price  = number*product.currentPrice;

                        $('#total'+id).html(Intl.NumberFormat().format(price)+'₫');

                        $('#total'+id).attr('data-total',price);

                        if($('#check'+id).is(":checked")) {
                            let check = $('input[name="check[]"]:checked');
                            if(check.length > 0) {
                                let total = 0;

                                for(let i =0 ; i < check.length; i++) {
                                    let idcheck = check[i].getAttribute('data-check');
                                    let price = document.getElementById('total'+idcheck).getAttribute('data-total');

                                    total += parseInt(price);
                                }

                                document.querySelector('.cart-page-footer__summary-total-amount').innerHTML = Intl.NumberFormat().format(total)+'₫';
                            }
                        }
                        getQuantity();
                        upadte(idCart,number);
                    }
                })
            }
        }        
    })
}
</script>
@endsection