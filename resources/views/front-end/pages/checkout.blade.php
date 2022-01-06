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
                                        <div class="cart-checkbox__bgc radio__input-address"></div>
                                    </div>
                                    <div class="checkout-address-selection__selected-address-summary">

                                        <div class="checkout-address-row">
                                            <div class="checkout-address-row__user-detail">
                                                <span class="checkout-address-row__user-name" data-name="{{$value->name}}">{{$value->name}}</span>
                                                <span class="checkout-address-row__user-phone" data-phone="{{$value->phone}}">{{$value->phone}}</span>
                                            </div>
                                            <div class="checkout-address-row__address-summary" data-address="{{$value->address}}, {{ $value->Ward->name}}, {{ $value->District->name}}, {{ $value->City->name}}">{{$value->address}}, {{ $value->Ward->name}}, {{ $value->District->name}}, {{ $value->City->name}}</div>
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
                    <a href="" class="btn-back auth-form__controls-back cart-page-footer__checkout-back">Trở lại</a>
                    <button class="cart-page-footer__checkout clear-btn" id="payment">Đặt hàng</button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('front-end.pages.infoCustomer.modalAddress')
<script src="{{ asset('assets/front-end/Javascript/checkout.js') }}"></script>
@endsection