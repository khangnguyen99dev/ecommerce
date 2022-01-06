@extends('front-end.pages.infoCustomer.indexCustomer')

@section('infoCustomer')
<div class="user-page__content">
    <div class="order-detail-header__back-button">
        <a href="" class="block js-purchased-back" >
            <svg class="tickid-svg-icon order-detail-header__back-button--arrow icon-arrow-left" enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0">
                <g>
                    <path d="m8.5 11c-.1 0-.2 0-.3-.1l-6-5c-.1-.1-.2-.3-.2-.4s.1-.3.2-.4l6-5c .2-.2.5-.1.7.1s.1.5-.1.7l-5.5 4.6 5.5 4.6c.2.2.2.5.1.7-.1.1-.3.2-.4.2z"></path>
                </g>
            </svg> TRỞ LẠI</a>
    </div>
    <div class="order-detail-page__delivery__container-wrapper">
        <div class="tickid-border-delivery"></div>
        <div class="order-detail-page__delivery__container">
            <div class="order-detail-page__delivery__header">
                <div class="order-detail-page__delivery__header__title">Địa chỉ nhận hàng</div>
            </div>
            <div class="order-detail-page__delivery__content">
                <div class="order-detail-page__delivery__shipping-address__container">
                    <div class="order-detail-page__delivery__shipping-address">
                        <div class="order-detail-page__delivery__shipping-address__shipping-name">{{$order->name}}</div>
                        <div class="order-detail-page__delivery__shipping-address__detail">{{$order->phone}}
                            <br>{{$order->address}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tickid-border-delivery"></div>
    </div>

    <div class="order-detail-page__main-content-wrapper">
        <div class="_1zdufp">
            <div class="_2XBFNq">
                <div class="order-content__container">
                    <div class="order-content__item-list">
                    @foreach($order->orderDetail as $value)
                        <a class="order-content__item-wrapper" href="/set-5-goi-dung-thu-mat-na-thai-doc-sum">
                            <div class="order-content__item">
                                <div class="order-content__item__col order-content__item__detail">
                                    <div class="order-content__item__product">
                                        <div class="order-content__item__image">
                                            <div class="tickid-image__wrapper">
                                                <div class="tickid-image__place-holder">
                                                    <svg class="tickid-svg-icon icon-loading-image" enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0">
                                                        <g>
                                                            <rect fill="none" height="8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" width="10" x="1" y="4.5"></rect>
                                                            <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="1" x2="11" y1="6.5" y2="6.5"></line>
                                                            <rect fill="none" height="3" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" width="3" x="11" y="6.5"></rect>
                                                            <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="1" x2="11" y1="14.5" y2="14.5"></line>
                                                            <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="6" x2="6" y1=".5" y2="3"></line>
                                                            <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="3.5" x2="3.5" y1="1" y2="3"></line>
                                                            <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="8.5" x2="8.5" y1="1" y2="3"></line>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="tickid-image__content" style="background-image: url(../assets/img/upload/product/{{$value->Product->image}});">
                                                    <div class="tickid-image__content--blur"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="order-content__item__detail-content">
                                            <div class="order-content__item__name">{{$value->Product->name}}</div>
                                            <div class="order-content__item__quantity">x {{$value->quantity}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-content__item__price order-content__item__col order-content__item__col--small order-content__item__col--last">
                                    <div class="order-content__item__price-text">
                                        <div class="">{{number_format($value->quantity*$value->price,0,',','.')}}₫</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="payment-detail__container _1R4a4Y">
                <div class="payment-detail__item">
                    <div class="payment-detail__item__description">Phí Ship</div>
                    <div class="payment-detail__item__value">
                        <div class="payment-detail__item__value-text">Miễn phí</div>
                    </div>
                </div>
<!-- 
                <div class="payment-detail__item">
                    <div class="payment-detail__item__description">Ví tích điểm</div>
                    <div class="payment-detail__item__value">
                        <div class="payment-detail__item__value-text">+100 điểm</div>
                    </div>
                </div> -->

                <div class="payment-detail__item payment-detail__item--last">
                    <div class="payment-detail__item__description">Tổng số tiền</div>
                    <div class="payment-detail__item__value payment-detail__item__value--highlighted">
                        <div class="payment-detail__item__value-text">{{number_format($order->money,0,',','.')}}₫</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tickid-border-bottom-dotted-circle__container">
            <div class="tickid-border-bottom-dotted-circle__circle tickid-border-bottom-dotted-circle__circle--left"> </div>
            <div class="tickid-border-bottom-dotted-circle__circle tickid-border-bottom-dotted-circle__circle--right"> </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click','.js-purchased-back', function(e) {
        e.preventDefault();
        history.back();
    })
</script>
@endsection