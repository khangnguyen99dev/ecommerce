@extends('front-end.layouts.main')

@section('title')
    {{ $detailProduct->name }}
@endsection

@section('content')
<!-- <link rel="stylesheet" href="{{asset('assets/css/exzoom.css')}}"> -->
<script src="{{asset('assets/js/jquery.elevatezoom.min.js')}}"></script>
<style>
li.paginationjs-page.J-paginationjs-page a {
    --height: 20px;
    font-size: 0.8rem;
    color: #939393;
    min-width: 20px;
    height: var(--height);
    line-height: var(--height);
}
</style>
<div id="product-info-container">
	<div class="grid wide">
		<div class="breadcrumbs">
			<ul class="breadcrumbs__list">
				<li class="breadcrumbs__item">
					<a href="" class="breadcrumbs__item-link">Trang chủ</a>
					<svg class="tickid-svg-icon _3kIvpP icon-arrow-right breadcrumbs__item-link" enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" style="height: 10px">
					<path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z"></path>
					</svg>
				</li>
				<li class="breadcrumbs__item">
					<a href="{{route('productByCategory',['id'=>$detailProduct->Category->id,'slug'=>$detailProduct->Category->slug])}}" class="breadcrumbs__item-link">{{ $detailProduct->Category['name'] }}</a>
					<svg class="tickid-svg-icon _3kIvpP icon-arrow-right breadcrumbs__item-link" enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" style="height: 10px">
					<path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z"></path>
					</svg>
				</li>
				<li class="breadcrumbs__item">
					<a href="{{route('productByProductType',['id'=>$detailProduct->productType->id,'slug'=>$detailProduct->productType->slug])}}" class="breadcrumbs__item-link">{{ $detailProduct->ProductType['name'] }}</a>
					<svg class="tickid-svg-icon _3kIvpP icon-arrow-right breadcrumbs__item-link" enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" style="height: 10px">
					<path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z"></path>
					</svg>
				</li>
				<li class="breadcrumbs__item">
					<span class="breadcrumbs__item-link">{{ $detailProduct->name }}</span>
				</li>
			</ul>      			
		</div>
	</div>

	<div class="grid wide">
		<!-- Product slide & content -->
		<div class="row sm-gutter product">
			<div class="col l-5">
				<div class="product-slide">
					<img src="../assets/img/upload/product/{{ $detailProduct->image }}" class="product__img zoom" id="img-primary">
					<div class="product__cards" data-id="{{$detailProduct->id}}" id="product__cards">
						<!-- <button class="product__cards-btn product__cards-btn--first">
							<i class="fas fa-chevron-left"></i>
						</button> -->

						<!-- <button class="product__cards-btn product__cards-btn--last">
							<i class="fas fa-chevron-right"></i>
						</button> -->
					</div>

					<div class="product__actions">
						<div class="product__sharing-icons">
							<div class="text">Chia sẻ:</div>
							<a href="#" class="product__action-icon messenger">
								<i class="fab fa-facebook-messenger"></i>
							</a>
							<a href="#" class="product__action-icon facebook">
								<i class="fab fa-facebook"></i>
							</a>
							<a href="#" class="product__action-icon google">
								<i class="fab fa-google-plus"></i>
							</a>
							<a href="#" class="product__action-icon pinterest">
								<i class="fab fa-pinterest"></i>
							</a>
							<a href="#" class="product__action-icon twitter">
								<i class="fab fa-twitter-square"></i>
							</a>
						</div>
						<div class="product__liking">
							<i class="product__action-icon product__action-icon--liking far fa-heart"></i>
							<a class="text">Đã thích (2,1k)</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col l-7">
				<div class="product-content">
					<div class="product__title">
						@if($detailProduct->react > 0)
						<div class="label-loving">
							Yêu Thích
						</div>
						@endif
						<span>{{ $detailProduct->name }}</span>
					</div>

					<div class="product__status">
						<div class="product__status-rating">
							<div class="product__status-rating-point underscore">{{number_format($detailProduct->rating,1,'.','.')}}</div>
							<div class="product__status-rating-stars">
								@for($i=1;$i<=5;$i++)
									@if($i <= $detailProduct->star)
									<i class="product__status-rating-star fas fa-star"></i>
									@else
									<i class="product__status-rating-star-none fas fa-star"></i>
									@endif
								@endfor
							</div>
						</div>
						<div class="product__status-reviewing">
							<span class="product__status-reviewing-qnt underscore">{{$detailProduct->countRate}}</span>
							<span class="product__status-text pr-text">Đánh Giá</span>
						</div>
						<div class="product__status-sold">
							<span class="product__status-sold-qnt">{{ $detailProduct->sold }}</span>
							<span class="product__status-text pr-text">Đã Bán</span>
						</div>
					</div>
					
					<div class="product__price">
						<div class="product__price-main">
							@if($detailProduct->Promotion->promotional > 0)
							<span class="product__price-old">{{ number_format( $detailProduct->oldPrice,0,",",".") }}₫</span>
							@endif
							<div class="product__price-current">
								<span class="product__price-new">{{ number_format( $detailProduct->currentPrice,0,",",".") }}₫</span>
								<span class="product__price-label bgr-orange">{{ $detailProduct->promotion->promotional }}% GIẢM</span>
							</div>
						</div>
						<div class="product__price-slogan">
							<i class="product__price-icon-tag fas fa-tags"></i>
							<span class="product__price-slogan-text">Ở đâu rẻ hơn, Kane Store hoàn tiền</span>
							<i class="product__price-icon-question far fa-question-circle"></i>
						</div>
					</div>

					<div class="product__info">
						<div class="product__shipping">
							<label class="product__shipping-label width-label">Vận Chuyển</label>
							<div class="product__shipping-wrapper">
								<div class="product__shipping-free">
									<div class="product__shipping-free-icon-wrapper">
										<i class="product__shipping-free-icon fas fa-truck-loading"></i>
									</div>
									<div class="product__shipping-free-wrapper">
										<div class="product__shipping-free-title">Miễn Phí Vận Chuyển</div>
										<div class="product__shipping-free-note">Miễn Phí Vận Chuyển khi đơn đạt giá trị tối thiểu</div>
									</div>
								</div>

								<div class="product__shipping-to">
									<i class="product__shipping-to-icon-truck fas fa-truck"></i>
									<div class="product__shipping-to-wrapper">
										<div class="product__shipping-to-destination">
											<label class="product__shipping-to-label">Vận Chuyển Tới</label>
											<div class="product__shipping-to-cities">
												<span class="product__shipping-to-city">Ninh Kiều, Cần Thơ</span>
												<i class="product__shipping-to-icon fas fa-chevron-down"></i>
											</div>
										</div>

										<div class="product__shipping-to-fee">
											<label class="product__shipping-to-label">Phí Vận Chuyển</label>
											<div class="product__shipping-to-fee-wrapper">
												<div class="product__shipping-to-fees">Miễn phí</div>
												<i class="product__shipping-to-icon fas fa-chevron-down"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
<!-- 
						<div class="product__options">
							<label class="product__options-label width-label">Màu sắc</label>
							<div class="product__options-items">
								<button class="product__options-item">Đen</button>
								<button class="product__options-item">Xanh</button>
								<button class="product__options-item">Đỏ</button>
							</div>
						</div> -->

						<div class="product__qnt">
							<label class="product__qnt-label width-label">Số Lượng</label>
							<div class="shop__qnt-btns">
								<button class="shop__qnt-btn shop__qnt-btn--dec">
									<i class="fas fa-minus"></i>
									<!-- shop__qnt-btn-icon  -->
								</button>
								<input class="shop__qnt-input" data-id="{{ $detailProduct->id}}" type="text" value="1" id="quantity"></input>
								<button class="shop__qnt-btn shop__qnt-btn--inc">
									<i class="fas fa-plus"></i>
									<!-- shop__qnt-btn-icon  -->
								</button>
							</div>
							<div class="product__qnt-note">{{ $detailProduct->quantity}} sản phẩm có sẵn</div>
						</div>
						
						<div class="product-btns-main">
							<button class="product-btn-main product-btn-main__adding">
								<i class="product-btn-main__adding-icon fas fa-cart-plus"></i>
								<span class="product-btn-main__text product-btn-main__adding-text">Thêm Vào Giỏ Hàng</span>
							</button>

							<button class="product-btn-main product-btn-main__buying">
								<span class="product-btn-main__text product-btn-main__buying-text">Mua Ngay</span>
							</button>
						</div>
					</div>
					
					<div style="margin-top: 30px; border-top: 1px solid rgba(0, 0, 0, 0.05);">
						<a href="*" class="product__guarantee">
							<span><img class="img_shiled" src="assets/front-end/Images/shiled.png" alt=""></span>
							<div class="product__guarantee-text">Kane Store Đảm Bảo</div>
							<span class="product__guarantee-note">3 Ngày Trả Hàng / Hoàn Tiền</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<div class="grid wide">
		<div class="row sm-gutter product-content__side" style="padding-bottom: 25px;">
			<!-- Product left content -->
			<div class="product-content--left">
				<!-- Product details -->
				<div class="product-details">
					<div class="product-detail">
						<div class="product-detail__title">CHI TIẾT SẢN PHẨM</div>
						<div class="product-detail__-wrapper">
							<div class="product-detail__wrapper">
								<span class="product-detail__label">Danh Mục</span>
								<div class="product-detail__links">
									<a class="product-detail__link" href="/">
										<span>Kane Store</span>
									</a>
									<svg class="product-detail__icon" enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="shopee-svg-icon _3kIvpP icon-arrow-right"><path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z"></path></svg>
									<a class="product-detail__link" href="{{route('productByCategory',['id'=>$detailProduct->Category->id,'slug'=>$detailProduct->Category->slug])}}">
										<span>{{ $detailProduct->Category['name'] }}</span>
									</a>
								</div>
							</div>

							<div class="product-detail__wrapper">
								<span class="product-detail__label">Loại sản phẩm</span>
								<a class="product-detail__link" href="{{route('productByProductType',['id'=>$detailProduct->productType->id,'slug'=>$detailProduct->productType->slug])}}">
									<span>{{ $detailProduct->ProductType['name'] }}</span>
								</a>
							</div>

							<div class="product-detail__wrapper">
								<span class="product-detail__label">Tên sản phẩm</span>
								<span class="product-detail__text">{{ $detailProduct->name }}</span>
							</div>
						</div>
					</div>

					<div class="product-description">
						<div class="product-description__title">MÔ TẢ SẢN PHẨM</div>
						<span class="product-description__content">{!!$detailProduct->description!!}
						</span>

					</div>
				</div>

				<!-- Product reviews -->
				<div class="product-reviews">
					<div class="product-reviews__header">ĐÁNH GIÁ SẢN PHẨM</div>
					<div class="product-reviews__container">
						<div class="product-reviews__rating">
							<div class="product-reviews__rating-score-wrapper">
								<span class="product-reviews__rating-score">{{number_format($detailProduct->rating,1,'.','.')}}</span>
								<span class="product-reviews__rating-score-out-of"> trên 5 </span>
							</div>

							<div class="product-reviews__rating-stars">
								@for($i=1;$i<=5;$i++)
									@if($i <= $detailProduct->star)
									<i class="product-reviews__rating-star fas fa-star"></i>
									@else
									<i class="product-reviews__rating-star-none fas fa-star"></i>
									@endif
								@endfor
							</div>
						</div>

						<div class="product-reviews__filters">
							<div class="product-reviews__filter product-reviews__filter--active">tất cả</div>
							<div class="product-reviews__filter">5 Sao (0)</div>
							<div class="product-reviews__filter">4 Sao (0)</div>
							<div class="product-reviews__filter">3 Sao (0)</div>
							<div class="product-reviews__filter">2 Sao (0)</div>
							<div class="product-reviews__filter">1 Sao (0)</div>
							<div class="product-reviews__filter product-reviews__filter--comment">Có Bình luận (0)</div>
							<div class="product-reviews__filter product-reviews__filter--photo">Có hình ảnh / video (0)</div>
						</div>
					</div>
					<div class="product-reviews__comments">
						<div id="status-rating">
							<div class="product-reviews__comment text-comment">Đánh giá</div>
						</div>						
						<div id="rating-list"></div>
						<div id="pagination-rating"></div>
					</div>
					<div class="product-reviews__comments">
						<div id="status-comment">
							<div class="product-reviews__comment text-comment">Bình luận</div>
						</div>
						<!-- <div class="product-reviews__comment">Rất tiếc, hiện chưa có bình luận nào</div> -->						
						<div id="comment-list"></div>
						<div id="pagination-comment"></div>
						@if(Auth::check())
						<div class="form__group-comment">
							<div class="form__input-comment">
								<textarea name="input-comment" id="comment" placeholder="Nhập một bình luận" cols="30" rows="10"></textarea>
							</div>
							<div class="from__send-comment">
								<button class="btn__comment btn btn--primary send-comment">Gửi</button>
							</div>
						</div>
						@endif
					</div>
				</div>
			</div>

			<div class="product-content--right">
				<!-- Product vouchers -->
				<div class="product-vouchers">
					<div class="product-vouchers__header">Mã giảm giá của Shop</div>
					<div class="product-vouchers__list">
						<div class="product-vouchers__item">
							<div class="product-vouchers__item-wrapper">
								<div class="product-vouchers__item-title">Giảm ₫3k Đơn Tối Thiểu ₫89k</div>
								<div class="product-vouchers__item-expiry">HSD:31-03-2021</div>
							</div>
							<div class="product-vouchers__btn-wrapper">
								<button class="product-vouchers__btn-save">Lưu</button>
								<div class="product-vouchers__border-dashed"></div>
							</div>
							<div class="product-vouchers__border-circle">
								<div class="product-vouchers__border-circle-edge"></div>
							</div>
						</div>

						<div class="product-vouchers__item">
							<div class="product-vouchers__item-wrapper">
								<div class="product-vouchers__item-title">Giảm ₫3k Đơn Tối Thiểu ₫89k</div>
								<div class="product-vouchers__item-expiry">HSD:31-03-2021</div>
							</div>  
							<div class="product-vouchers__btn-wrapper">
								<button class="product-vouchers__btn-save">Lưu</button>
								<div class="product-vouchers__border-dashed"></div>
							</div>
							<div class="product-vouchers__border-circle">
								<div class="product-vouchers__border-circle-edge"></div>
							</div>
						</div>

						<div class="product-vouchers__item">
							<div class="product-vouchers__item-wrapper">
								<div class="product-vouchers__item-title">Giảm ₫3k Đơn Tối Thiểu ₫89k</div>
								<div class="product-vouchers__item-expiry">HSD:31-03-2021</div>
							</div>
							<div class="product-vouchers__btn-wrapper">
								<button class="product-vouchers__btn-save">Lưu</button>
								<div class="product-vouchers__border-dashed"></div>
							</div>
							<div class="product-vouchers__border-circle">
								<div class="product-vouchers__border-circle-edge"></div>
							</div>
						</div>
					</div>
				</div>

				<!-- Product hot sales -->
				<div class="product-hot-sales">
					<div class="product-hot-sales__header">Top Sản Phẩm Bán Chạy</div>
					<a href="#" class="product-hot-sales__link">
						<div>
							<img class="product-hot-sales__item-img" src="https://shop2banh.vn/images/thumbs/2020/03/dia-nhom-probike-7075-a3-cho-winner-44t-1149-slide-products-5e6af8c189d2f.jpg">
						</div>
						<div class="product-hot-sales__item-wrapper">
							<div class="product-hot-sales__item-name">Dĩa nhôm Probike 7075 A3 cho Winner 44T</div>
							<div class="product-hot-sales__item-price">₫149.000 - ₫219.000</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>   
	<div class="grid wide">
		<!-- Product combo cards -->
        <div class="row sm-gutter app__content noneIndex">          
            <div class="col l-12 m-12 c-12" id="productRelate">
                <div class="home-product">
                    <!-- show product selling -->
                </div>
            </div>
        </div>
	</div>
</div>

<div class="modal" id="deleteComment">
    <div class="modal__overlay"></div>
    <div class="modal__body">
    <div class="modal__wrapper modal--confirm">
        <div class="modal__inner">
            <button class="modal__action js-btn-close"><svg class="tickid-svg-icon" x="0px" y="0px" viewBox="0 0 512.001 512.001"><g><g><path d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717 L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859 c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287 l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285 L284.286,256.002z"></path></g></g></svg></button>
            <div class="modal__header">
                <div class="modal__title js-title">Bạn có chắc chắn muốn xóa bình luận?</div>
            </div>
            <div class="modal__body">
                <div class="modal__message js-content">Bạn sẽ xóa bình luận và không thể thay đổi sau đó.</div>
            </div>
            <div class="modal__footer">
                <div class="modal__buttons">
                    <input type="hidden" value="" class="js-id-comment">
                    <button class="tickid-button-outline tickid-button-outline--fill tickid-button-outline--primary js-btn-cancel">Huỷ bỏ</button>
                    <button class="tickid-button-outline tickid-button-outline--fill tickid-button-outline--danger js-accept-deleteComment">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
{{-- <script>
$("#img-primary").elevateZoom({constrainType:"height", constrainSize:274, zoomType: "lens", containLensZoom: true, gallery:'gallery_01', cursor: 'pointer', galleryActiveClass: "active"}); 

$("#zoom_03").bind("click", function(e) {  
  var ez =   $('#zoom_03').data('elevateZoom');	
	$.fancybox(ez.getGalleryList());
  return false;
});
</script> --}}
<script src="{{ asset('assets/front-end/Javascript/detail-product.js') }}"></script>
@endsection