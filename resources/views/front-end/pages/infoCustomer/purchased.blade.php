@extends('front-end.pages.infoCustomer.indexCustomer')

@section('infoCustomer')
<div class="col l-10">
    <div class="user-page__content">
        <div class="purchase-list-page__tabs-container">
            <a href="{{ route('customer.purchased',['key'=>'all']) }}" class="purchase-list-page__tab {{$key == "all" ? "purchase-list-page__tab--selected": ""}}"><span class="purchase-list-page__tab-label">Tất cả</span></a>
            <a href="{{route('customer.purchased',['key'=>'ready'])}}" class="purchase-list-page__tab {{$key== "ready" ? "purchase-list-page__tab--selected": ""}}">
                <span class="purchase-list-page__tab-label">Đã đặt hàng</span>
            </a>
            <a href="{{route('customer.purchased',['key'=>'accepted'])}}" class="purchase-list-page__tab {{$key== "accepted" ? "purchase-list-page__tab--selected": ""}}">
                <span class="purchase-list-page__tab-label">Đã chấp nhận</span>
            </a>
            <a href="{{route('customer.purchased',['key'=>'completed'])}}" class="purchase-list-page__tab {{$key== "completed" ? "purchase-list-page__tab--selected": ""}}">
                <span class="purchase-list-page__tab-label">Đã hoàn thành</span>
            </a>
            <a href="{{route('customer.purchased',['key'=>'rated'])}}" class="purchase-list-page__tab {{$key== "rated" ? "purchase-list-page__tab--selected": ""}}">
                <span class="purchase-list-page__tab-label">Đã đánh giá</span>
            </a>
            <a href="{{route('customer.purchased',['key'=>'cancel'])}}" class="purchase-list-page__tab {{$key== "cancel" ? "purchase-list-page__tab--selected": ""}}">
                <span class="purchase-list-page__tab-label">Đã huỷ</span>
            </a>
        </div>

        <div class="purchase-list-page__search-bar">
            <form action="" method="GET">
                <svg width="19px" height="19px" viewBox="0 0 19 19">
                    <g id="Search-New" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="my-purchase-copy-27" transform="translate(-399.000000, -221.000000)" stroke-width="2">
                            <g id="Group-32" transform="translate(400.000000, 222.000000)">
                                <circle id="Oval-27" cx="7" cy="7" r="7"></circle>
                                <path d="M12,12 L16.9799555,16.919354" id="Path-184" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </g>
                    </g>
                </svg>
                <input autocomplete="off" placeholder="Tìm kiếm theo ID đơn hàng hoặc Tên Sản phẩm" value="" name="s">
            </form>
        </div>
      
        @foreach($order as $orderProduct)
        <div class="purchase-list-page__checkout-list-card-container" data-status="{{ $orderProduct->status }}">
            <div class="purchase-list-page__checkout-card-wrapper js-purchase-item">
                <div class="order-card__container">
                    <div class="order-card__header">
                        <div class="order-card__id">
                            <a href="" class="link">
                                <svg class="tickid-svg-icon" viewBox="0 -16 512.00018 512">
                                    <path d="m396 440c5.519531 0 10-4.480469 10-10s-4.480469-10-10-10-10 4.480469-10 10 4.480469 10 10 10zm0 0"></path>
                                    <path d="m230 440c5.519531 0 10-4.480469 10-10s-4.480469-10-10-10-10 4.480469-10 10 4.480469 10 10 10zm0 0"></path>
                                    <path d="m509.882812 123.847656c-1.894531-2.429687-4.804687-3.847656-7.882812-3.847656h-360.003906l-22.792969-96.875c-3.210937-13.617188-15.222656-23.125-29.203125-23.125h-60c-16.542969 0-30 13.457031-30 30s13.457031 30 30 30h36.238281l74.558594 316.875c3.210937 13.617188 15.222656 23.125 29.203125 23.125h20.027344c-6.292969 8.363281-10.027344 18.753906-10.027344 30 0 27.570312 22.429688 50 50 50s50-22.429688 50-50c0-11.246094-3.734375-21.636719-10.027344-30h86.054688c-6.292969 8.363281-10.027344 18.753906-10.027344 30 0 27.570312 22.429688 50 50 50s50-22.429688 50-50c0-11.246094-3.734375-21.636719-10.027344-30h.027344c16.542969 0 30-13.457031 30-30s-13.457031-30-30-30h-242.238281l-9.414063-40h58.621094.019531.015625 145.992188.019531.019531 57.347656c13.785157 0 25.757813-9.34375 29.109376-22.726562l36.210937-144.847657c.746094-2.988281.074219-6.152343-1.820313-8.578125zm-35.691406 76.152344h-63.863281l7.5-60h71.363281zm-118.191406 20h31.671875l-7.5 60h-54.171875v-30c0-5.523438-4.476562-10-10-10s-10 4.476562-10 10v30h-54.171875l-7.5-60h31.671875c5.523438 0 10-4.476562 10-10s-4.476562-10-10-10h-34.171875l-7.5-60h71.671875v30c0 5.523438 4.476562 10 10 10s10-4.476562 10-10v-30h71.671875l-7.5 60h-34.171875c-5.523438 0-10 4.476562-10 10s4.476562 10 10 10zm-176.359375 60-14.117187-60h58.648437l7.5 60zm34.53125-140 7.5 60h-60.855469l-14.113281-60zm45.828125 290c0 16.542969-13.457031 30-30 30s-30-13.457031-30-30 13.457031-30 30-30 30 13.457031 30 30zm166 0c0 16.542969-13.457031 30-30 30s-30-13.457031-30-30 13.457031-30 30-30 30 13.457031 30 30zm10-70c5.515625 0 10 4.484375 10 10s-4.484375 10-10 10h-266c-4.660156 0-8.664062-3.171875-9.734375-7.710938l-78.1875-332.289062h-52.078125c-5.515625 0-10-4.484375-10-10s4.484375-10 10-10h60c4.660156 0 8.664062 3.171875 9.734375 7.710938l62.1875 264.292968c.003906.015625.007813.03125.011719.050782l15.988281 67.945312zm20.089844-87.582031c-1.117188 4.464843-5.109375 7.582031-9.710938 7.582031h-46.050781l7.5-60h61.367187zm0 0"></path>
                                    <path d="m316 200c-5.519531 0-10 4.480469-10 10s4.480469 10 10 10 10-4.480469 10-10-4.480469-10-10-10zm0 0"></path>
                                </svg>ID đơn hàng: {{ $orderProduct->code_order }} - Thời gian: {{ $orderProduct->created_at }}</a>
                        </div>
                        <div class="order-card__status warning">
                            @if($orderProduct->status == 0)
                                {{ 'Đã đặt hàng' }}
                            @elseif($orderProduct->status == 1)
                                {{ 'Đã chấp nhận'}}
                            @elseif($orderProduct->status == 2)
                                {{ 'Đã hoàn thành'}} 
                            @elseif($orderProduct->status == 3)
                                {{ 'Đã đánh giá'}} 
                            @else
                                {{ 'Đã hủy'}} 
                            @endif                  
                        </div>
                    </div>
                    <div class="order-card__content-wrapper">
                        <div class="order-card__content">
                            <div class="order-content__container">
                                <div class="order-content__item-list">
                                    @foreach($orderProduct->OrderDetail as $orderDetail)
                                    <a class="order-content__item-wrapper" href="/{{$orderDetail->Product->slug}}_{{$orderDetail->Product->id}}.html">
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
                                                            <div class="tickid-image__content" style="background-image: url(../assets/img/upload/product/{{ $orderDetail->Product->image }});">
                                                                <div class="tickid-image__content--blur"> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="order-content__item__detail-content">
                                                        <div class="order-content__item__name">{{ $orderDetail->Product->name }}</div>
                                                        <div class="order-content__item__quantity">
                                                            <span class="order-content__item__quantity-price-unit">{{ number_format($orderDetail->price,0,',','.') }}₫</span> x <span class="js-qty-show{{ $orderDetail->id }}">{{ $orderDetail->quantity }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="order-content__item__price order-content__item__col order-content__item__col--small order-content__item__col--last">
                                                <div class="order-content__item__price-text">
                                                    <div class="">{{ number_format($orderDetail->price * $orderDetail->quantity,0,',','.') }}₫</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tickid-border-bottom-dotted-circle__container">
                            <div class="tickid-border-bottom-dotted-circle__circle tickid-border-bottom-dotted-circle__circle--left"> </div>
                            <div class="tickid-border-bottom-dotted-circle__circle tickid-border-bottom-dotted-circle__circle--right"> </div>
                        </div>
                    </div>
                    <div class="order-card__buttons-container">
                        <div class="purchase-card-buttons__wrapper">
                            <div class="purchase-card-buttons__total-payment">
                                <span class="purchase-card-buttons__label-price">Tổng số tiền: </span>
                                <span class="purchase-card-buttons__total-price">{{ number_format($orderProduct->money,0,',','.') }}₫</span>
                            </div>
                            <div class="purchase-card-buttons__container">
                                @if($orderProduct->status == 0)
                                <div class="purchase-card-buttons__show-button-wrapper">
                                    <button class="tickid-button-outline tickid-button-outline--fill tickid-button-outline--danger js-update-order" data-id="{{ $orderProduct->id }}"><span class="purchase-card-buttons__button-content">Cập nhật</span>
                                    </button>
                                </div>

                                <div class="purchase-card-buttons__show-button-wrapper">
                                    <button class="tickid-button-outline tickid-button-outline--fill tickid-button-outline--danger js-confirm-show js-btn-order-cancel" data-id="{{ $orderProduct->id }}"><span class="purchase-card-buttons__button-content">Huỷ đơn</span>
                                    </button>
                                </div>                             
                                @elseif($orderProduct->status == 2)
                                <div class="purchase-card-buttons__show-button-wrapper">
                                    <button class="tickid-button-outline tickid-button-outline--fill tickid-button-outline--danger js-confirm-rating " data-id="{{ $orderProduct->id }}"><span class="purchase-card-buttons__button-content">Đánh giá</span>
                                    </button>
                                </div>
                                @elseif($orderProduct->status == 3)
                                <div class="purchase-card-buttons__show-button-wrapper">
                                    <button class="tickid-button-outline tickid-button-outline--fill tickid-button-outline--danger js-show-rating " data-id="{{ $orderProduct->id }}"><span class="purchase-card-buttons__button-content">Xem đánh giá</span>
                                    </button>
                                </div>                
                                @endif
                                <!-- <div class="purchase-card-buttons__show-button-wrapper">
                                    <button class="tickid-button-outline tickid-button-outline--fill tickid-button-outline--danger js-confirm-show js-btn-order-remake" confirm-title="Bạn có chắc chắn sửa đơn?" confirm-content="Đơn hàng sẽ trở lại trạng thái đang đặt hàng. Các sản phẩm trong giỏ hàng hiện tại sẽ bị loại bỏ."><span class="purchase-card-buttons__button-content">Sửa đơn</span>
                                    </button>
                                </div> -->
                                <div class="purchase-card-buttons__show-button-wrapper">
                                    <a href="{{route('detailpurchased',['id'=>$orderProduct->id])}}" class="tickid-button-outline tickid-button-outline--fill tickid-button-outline--primary"><span class="purchase-card-buttons__button-content">Xem Chi tiết đơn hàng</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="modal" id="cancel">
    <div class="modal__overlay"></div>
    <div class="modal__body">
    <div class="modal__wrapper modal--confirm">
        <div class="modal__inner">
            <button class="modal__action js-btn-close"><svg class="tickid-svg-icon" x="0px" y="0px" viewBox="0 0 512.001 512.001"><g><g><path d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717 L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859 c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287 l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285 L284.286,256.002z"></path></g></g></svg></button>
            <div class="modal__header">
                <div class="modal__title js-title">Bạn có chắc chắn huỷ đơn?</div>
            </div>
            <div class="modal__body">
                <div class="modal__message js-content">Bạn sẽ hủy tất cả sản phẩm trong đơn hàng và không thể thay đổi sau đó.</div>
            </div>
            <div class="modal__footer">
                <div class="modal__buttons">
                    <input type="hidden" value="" class="js-id-order">
                    <button class="tickid-button-outline tickid-button-outline--fill tickid-button-outline--primary js-btn-cancel">Huỷ bỏ</button>
                    <button class="tickid-button-outline tickid-button-outline--fill tickid-button-outline--danger js-btn-accept">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<div class="modal" id="rating">
    <div class="modal__overlay"></div>
    <div class="modal__body">
        <div class="modal__wrapper modal--confirm">
            <div class="modal__inner">
                <button class="modal__action js-btn-close"><svg class="tickid-svg-icon" x="0px" y="0px" viewBox="0 0 512.001 512.001"><g><g><path d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717 L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859 c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287 l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285 L284.286,256.002z"></path></g></g></svg></button>
                <div class="modal__header">
                    <div class="modal__title js-title">Đánh giá sản phẩm</div>
                </div> 
                <div class="modal__body modal__body-rate">
                    <div class="rate">
                        <input type="radio" id="star5" name="rate" value="5" />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" />
                        <label for="star1" title="text">1 star</label>
                    </div>
                    <div class="content__rate">
                        <div class="content__rate-title">Ghi chú</div>
                        <div class="form__input-comment">
                            <textarea name="content-rate" id="content-rate" cols="30" rows="10" placeholder="Nhập một đánh giá.."></textarea>
                        </div>      
                    </div>
                </div>    
                <div class="modal__footer">
                    <div class="modal__buttons">
                        <input type="hidden" value="" class="js-order-id">
                        <button class="tickid-button-outline tickid-button-outline--fill tickid-button-outline--primary js-btn-cancel">Huỷ bỏ</button>
                        <button class="tickid-button-outline tickid-button-outline--fill tickid-button-outline--danger js-accept-rate">Đồng ý</button>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>


<div class="modal" id="showRate">
    <div class="modal__overlay"></div>
    <div class="modal__body">
        <div class="modal__wrapper modal--confirm">
            <div class="modal__inner">
                <button class="modal__action js-btn-close"><svg class="tickid-svg-icon" x="0px" y="0px" viewBox="0 0 512.001 512.001"><g><g><path d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717 L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859 c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287 l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285 L284.286,256.002z"></path></g></g></svg></button>
                <div class="modal__header">
                    <div class="modal__title js-title">Xem đánh giá</div>
                </div> 
                <div class="order-card__content-wrapper">
                        <div class="order-card__content">
                            <div class="order-content__container">
                                <div class="order-content__item-list render-showRating">

                                </div>
                            </div>
                        </div>
                        <div class="tickid-border-bottom-dotted-circle__container">
                            <div class="tickid-border-bottom-dotted-circle__circle tickid-border-bottom-dotted-circle__circle--left"> </div>
                            <div class="tickid-border-bottom-dotted-circle__circle tickid-border-bottom-dotted-circle__circle--right"> </div>
                        </div>
                    </div>
                <div class="modal__body modal__body-rate js-showComment-rate">

                </div>  
                <input type="hidden" value="" class="js-id-showOrder">    
            </div>
        </div>
    </div>
</div>

<div class="modal" id="updateOrder">
    <div class="modal__overlay"></div>
    <div class="modal__body">
        <div class="modal__wrapper modal--confirm">
            <div class="modal__inner">
                <button class="modal__action js-btn-close"><svg class="tickid-svg-icon" x="0px" y="0px" viewBox="0 0 512.001 512.001"><g><g><path d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717 L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859 c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287 l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285 L284.286,256.002z"></path></g></g></svg></button>
                <div class="modal__header">
                    <div class="modal__title js-title">Cập nhật đơn hàng</div>
                </div> 
                <div class="order-card__content-wrapper">
                        <div class="order-card__content">
                            <div class="order-content__container">
                                <div class="order-content__item-list render-showOrderDetail">

                                </div>
                            </div>
                        </div>
                        <div class="tickid-border-bottom-dotted-circle__container">
                            <div class="tickid-border-bottom-dotted-circle__circle tickid-border-bottom-dotted-circle__circle--left"> </div>
                            <div class="tickid-border-bottom-dotted-circle__circle tickid-border-bottom-dotted-circle__circle--right"> </div>
                        </div>
                </div>
                <div class="modal__footer">
                    <div class="modal__buttons">
                        <button class="tickid-button-outline tickid-button-outline--fill tickid-button-outline--primary js-btn-cancel">Huỷ bỏ</button>
                        <button class="tickid-button-outline tickid-button-outline--fill tickid-button-outline--danger js-save-updateOrder">Lưu</button>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(e){
    toastr.options = {
        "debug": false,
        "positionClass": "toast-top-center",
        "onclick": null,
        "fadeIn": 300,
        "fadeOut": 1000,
        "timeOut": 1000,
        "extendedTimeOut": 2000
    }
    $(document).on('click', '.js-confirm-show', function (e) {
        $('#cancel').css('display','flex');
        $('.modal__body').show();

        let id = $(this).data('id');

        $('#cancel').find('.js-id-order').val(id);
    })

    $(document).on('click', '.js-btn-accept', function (e) {
        let id = $(this).parent().find('.js-id-order').val();

        $.ajax({
            type: 'POST',
            url: "/cancelOrder/"+id,
            success: (data) => {
                $('.modal').hide();
                toastr["info"]("Hủy đơn hàng thành công");
                location.reload();
            }
        })
    })

    $(document).on('click', '.js-btn-cancel', function (e) {
        $('.modal').hide();
    })

    $(document).on('click', '.js-btn-close', function (e) {
        $('.modal').hide();
    })

    $(document).on('click', '.js-confirm-rating', function (e) {
        $('#rating').css('display','flex');
        $('.modal__body').show();
        let id = $(this).data('id');
        $('#rating').find('.js-order-id').val(id);
    })

    $(document).on('click','.js-update-order', function (e) {
        $('#updateOrder').css('display','flex');
        $('.modal__body').show();
        let id = $(this).data('id');
        $.get(`/orderdetail/${id}`, (data) => {
            let products = data.order.orderDetail;
            let html = '';
            products.map((value) => {
                html+=`
                <div class="order-content__item-wrapper" >
                    <div class="order-content__item">
                        <div class="order-content__item__col order-content__item__detail">
                            <div class="order-content__item__product">
                                <div class="order-content__item__image">
                                    <div class="tickid-image__wrapper">

                                        <div class="tickid-image__content" style="background-image: url(../assets/img/upload/product/${value.product.image});" >
                                            <div class="tickid-image__content--blur"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-content__item__detail-content">
                                    <div class="order-content__item__name">${value.product.name}</div>
                                </div>
                                <div class="product__qnt">                                        
                                    <div class="shop__qnt-btns">
                                        <button class="shop__qnt-btn shop__qnt-btn--dec">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input class="shop__qnt-input" data-id="${value.id}" data-quantity="${value.product.quantity + value.quantity}" type="text" value="${value.quantity}" ></input>
                                        <button class="shop__qnt-btn shop__qnt-btn--inc">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                `;
            })
            $('.render-showOrderDetail').html(html);
        })
    })

    $(document).on('click','.js-accept-rate', function (e) {
        let star = $('input[type=radio]:checked').val();
        if(star == undefined){
            alert('loi')
        }else{
            let contentRate = $('#content-rate').val();
            let idOrder = $(this).parent().find('.js-order-id').val();

            $.ajax({
                type: 'POST',
                url: '/rating',
                data:{
                    star:star,
                    contentRate:contentRate,
                    idOrder:idOrder
                },
                success: (data) => {
                    if(data.error){
                        toastr["info"](data.error);
                    }else{
                        toastr["info"]("Đánh giá sản phẩm thành công");
                        location.reload();
                    }
                }
            })      
        }
    })

    $(document).on('click','.js-show-rating', function (e) {
        let id = $(this).data('id');
        $('#showRate').css('display','flex');
        $('.modal__body').show();
        $.ajax({
            type: 'GET',
            url: '/showRating/' + id,
            success: (data) => {
                // console.log(data)
                let products = data.order.orderDetail;
                let rating = data.order.rating;
                let html = '';
                let rate = `                    
                <div class="reviews__comment">
                        <div class="image__comment">`;
                    if(data.order.user.avatar != null){
                        rate +=`<div class="header__navbar-user-img" style="background-image: url(../assets/img/upload/avatar/${data.order.user.avatar});"></div>`;
                    }else{
                        rate +=`<img src="https://via.placeholder.com/150" alt="">`;
                    }      
                    rate +=`</div>
                        <div class="content__comment">
                            <div class="info__comment">
                                <div class="info__comment-name">${data.order.user.name}</div>
                                <div class="info__comment-star">
                                    <div class="home-product-item__rating">`;
                                    for(let i = 1; i <= 5; i++){
                                        if(i <= rating.star){
                                            rate+=`<i class="home-product-item__star--gold fas fa-star"></i>`;
                                        }else{
                                            rate+=`<i class="fas fa-star"></i>`;
                                        }
                                    }   
                                    rate+=`</div>
                                </div>
                            </div>
                            <div class="message__comment">
                                ${rating.message}
                            </div>
                            <span class="date__comment">${data.order.date}</span>
                        </div>
                    </div>`;
                products.map((value) => {
                    html+=`
                    <a class="order-content__item-wrapper" href="">
                        <div class="order-content__item">
                            <div class="order-content__item__col order-content__item__detail">
                                <div class="order-content__item__product">
                                    <div class="order-content__item__image">
                                        <div class="tickid-image__wrapper">

                                            <div class="tickid-image__content" style="background-image: url(../assets/img/upload/product/${value.product.image});" >
                                                <div class="tickid-image__content--blur"> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-content__item__detail-content">
                                        <div class="order-content__item__name">${value.product.name}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    `;
                })
                $('.render-showRating').html(html);
                $('.js-showComment-rate').html(rate);
            }
        })
    })

    $(document).on('click', '.shop__qnt-btn--inc', function (e) {
        let input = $(this).parent().find('.shop__qnt-input');
        let qty = $(input).val();
        let productQty = $(input).data('quantity');
        qty++;
        (qty > productQty) ? $(input).val(productQty) : $(input).val(qty);       
    })

    $(document).on('click', '.shop__qnt-btn--dec', function (e) {
        let input = $(this).parent().find('.shop__qnt-input');
        let qty = $(input).val();
        qty--;
        (qty < 1) ? $(input).val(1) : $(input).val(qty);       
    })

    $(document).on('change','.shop__qnt-input', function (e) {
        let qty = $(this).val();
        let productQty = $(this).data('quantity');

        if(parseInt(qty)){
            if(qty > productQty)
                $(this).val(productQty);
            else if (qty < 1)
                $(this).val(1);
            else
                $(this).val(qty);
        }else{
            toastr['info']('Số lượng không phải là số');
        }
    })

    $(document).on('click', '.js-save-updateOrder', function (e) {
        let inputs = $(this).parent().parent().parent().find('.shop__qnt-input');
        let data = [];
        for (const input of inputs) {
            data.push({id:$(input).data('id'),qty:$(input).val()});
        }
        $.post(`/updateQty`,{data},function (data) {
            if(data.error) {
                toastr["info"](data.error);
                location.reload();
            }else{           
                toastr["info"]('Cập nhật số lượng thành công');
                for (const obj  of data) {
                    $('.js-qty-show'+obj.id).html(obj.quantity);
                }    
                location.reload();          
            }
        })
    })
})

</script>
@endsection



