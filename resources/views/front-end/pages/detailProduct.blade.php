@extends('front-end.layouts.main')

@section('title')
    {{ $detailProduct->name }}
@endsection

@section('content')
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
					<a href="" class="breadcrumbs__item-link">{{ $detailProduct->Category['name'] }}</a>
					<svg class="tickid-svg-icon _3kIvpP icon-arrow-right breadcrumbs__item-link" enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" style="height: 10px">
					<path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z"></path>
					</svg>
				</li>
				<li class="breadcrumbs__item">
					<a href="" class="breadcrumbs__item-link">{{ $detailProduct->ProductType['name'] }}</a>
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
					<img src="assets/img/upload/product/{{ $detailProduct->image }}" class="product__img" id="img-primary">
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
						<div class="label-loving">
							Yêu Thích
						</div>
						<span>{{ $detailProduct->name }}</span>
					</div>

					<div class="product__status">
						<div class="product__status-rating">
							<div class="product__status-rating-point underscore">4.9</div>
							<div class="product__status-rating-stars">
								<i class="product__status-rating-star fas fa-star"></i>
								<i class="product__status-rating-star fas fa-star"></i>
								<i class="product__status-rating-star fas fa-star"></i>
								<i class="product__status-rating-star fas fa-star"></i>
								<i class="product__status-rating-star fas fa-star"></i>
							</div>
						</div>
						<div class="product__status-reviewing">
							<span class="product__status-reviewing-qnt underscore">78</span>
							<span class="product__status-text pr-text">Đánh Giá</span>
						</div>
						<div class="product__status-sold">
							<span class="product__status-sold-qnt">{{ $detailProduct->sold }}</span>
							<span class="product__status-text pr-text">Đã Bán</span>
						</div>
					</div>
					
					<div class="product__price">
						<div class="product__price-main">
							<span class="product__price-old">{{ number_format( $detailProduct->oldPrice,0,",",".") }}₫</span>
							<div class="product__price-current">
								<span class="product__price-new">{{ number_format( $detailProduct->currentPrice,0,",",".") }}₫</span>
								<span class="product__price-label bgr-orange">{{ $detailProduct->promotional }}% GIẢM</span>
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

						<div class="product__options">
							<label class="product__options-label width-label">Màu sắc</label>
							<div class="product__options-items">
								<button class="product__options-item">Đen</button>
								<button class="product__options-item">Xanh</button>
								<button class="product__options-item">Đỏ</button>
							</div>
						</div>

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
									<a class="product-detail__link" href="/">
										<span>{{ $detailProduct->Category['name'] }}</span>
									</a>
								</div>
							</div>

							<div class="product-detail__wrapper">
								<span class="product-detail__label">Loại sản phẩm</span>
								<a class="product-detail__link" href="/">
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
								<span class="product-reviews__rating-score">4.9</span>
								<span class="product-reviews__rating-score-out-of"> trên 5 </span>
							</div>

							<div class="product-reviews__rating-stars">
								<i class="product-reviews__rating-star fas fa-star"></i>
								<i class="product-reviews__rating-star fas fa-star"></i>
								<i class="product-reviews__rating-star fas fa-star"></i>
								<i class="product-reviews__rating-star fas fa-star"></i>
								<i class="product-reviews__rating-star fas fa-star"></i>
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

						<div class="product-reviews__comment">Rất tiếc, hiện chưa có bình luận nào</div>
						<div class="reviews__comment">
							<div class="image__comment">
								<img src="https://via.placeholder.com/150" alt="">
							</div>
							<div class="content__comment">
								<div class="info__comment">
									<div class="info__comment-name">nguyen an khang</div>
									<div class="info__comment-star">
										<div class="home-product-item__rating">
											<i class="home-product-item__star--gold fas fa-star"></i>
											<i class="home-product-item__star--gold fas fa-star"></i>
											<i class="home-product-item__star--gold fas fa-star"></i>
											<i class="home-product-item__star--gold fas fa-star"></i>
											<i class="fas fa-star"></i>
										</div>
									</div>
								</div>
								<div class="message__comment">
									sdbdblds
								</div>
							</div>
						</div>
						<div class="reviews__comment">
							<div class="image__comment">
								<img src="https://via.placeholder.com/150" alt="">
							</div>
							<div class="content__comment">
								<div class="info__comment">
									<div class="info__comment-name">nguyen an khang</div>
									<div class="info__comment-star">
										<div class="home-product-item__rating">
											<i class="home-product-item__star--gold fas fa-star"></i>
											<i class="home-product-item__star--gold fas fa-star"></i>
											<i class="home-product-item__star--gold fas fa-star"></i>
											<i class="home-product-item__star--gold fas fa-star"></i>
											<i class="fas fa-star"></i>
										</div>
									</div>
								</div>
								<div class="message__comment">
									sdbdbldsssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss
								</div>
							</div>
						</div>

						<div class="form__group-comment">
							<div class="form__input-comment">
								<textarea name="input-comment" id="" cols="30" rows="10"></textarea>
							</div>
							<div class="from__send-comment">
								<button class="btn__comment btn btn--primary">Gửi</button>
							</div>
						</div>
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

<script>
let products = fetch('http://kanestore.com/api/product')
    .then((res) => {
        return res.json();
    })
    .catch((err)=>{
    	console.log(err);
    })

let warpper = fetch('http://kanestore.com/api/warpper')
    .then((res) => {
        return res.json();
    })
    .catch((err)=>{
    	console.log(err);
    })


function renderProductWarpper() {
	let id = $('#product__cards').data('id');
	warpper
		.then((data)=> {
			return new Promise((resolve,reject)=>{
				let url = $('#img-primary').attr('src');
				
				let html =`
				<div class="owl-carousel owl-theme" >
				<div class="item">
				<div class="product__card-wrapper">
						<img src="${url}" class="product__card">
					</div>
					</div>
					`;
				let filterWarpper = data.filter((value) => {
					return value.idProduct == id ? html+=`
					<div class="item">
					<div class="product__card-wrapper">
						<img src="assets/img/upload/product/${value.path}" alt="${value.name}" class="product__card">
					</div>
					</div>
					`: html+=``;
				})
				html+=`</div>`;
				if(filterWarpper.length > 0) {
					resolve($('#product__cards').html(html));
				}else{
					$('#product__cards').html(html)
					reject();
				}
			})
		})
		.then((data)=>{
			$('.owl-carousel').owlCarousel({
				responsiveClass:true,
				responsive:{
					0:{
						items:2,
						nav:true
					},
					600:{
						items:4,
						nav:false
					},
					1000:{
						items:5,
						nav:true,
						loop:false
					}
				}
			})
		})
		.catch((error)=> {
			console.log(error);
		})
}

renderProductWarpper()

function productSelling() {
    products
    .then((data) => {     
        let sort = data.sort((a,b)=> {
            b = b.sold;
            a = a.sold;
            return b-a;
        })
        let list = sort.slice(0,10)
        return new Promise((resolve, reject) => {         
            html='';
            html+=`<div class="home-product">
                <div class="row sm-gutter products-combo">
                    <div class="products-combo__title">
                        <span class="products-combo__text">Sản phẩm bán chạy</span>
                        <!-- <div class="products-combo__note">Mua 2 & giảm 5%</div> -->
                    </div>
                    <div class="owl-carousel owl-theme" >
                    `;
                    list.map((product)=>{
                        html+=
                        `<div class="item">
                            <a href="${product.slug}_${product.id}.html" class="products-combo__card-link">
                                <div class="products-combo__cards">
                                    <div class="products-combo__card">
                                        <img class="products-combo__card-img" src="assets/img/upload/product/${product.image}">
                                        <span class="products-combo__card-name">${product.name}</span>
                                        <div class="products-combo__card-price">
                                            <span class="products-combo__card-price-old">${product.oldPrice}₫</span>
                                            <span class="products-combo__card-price-new">${product.currentPrice}₫</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>`
                    })

                    html+= `</div>
                </div>
            </div>`;
            resolve($('#productRelate').html(html));
        })
    })
    .then((data)=>{
        $('.owl-carousel').owlCarousel({
            margin:10,
            responsiveClass:true,
            responsive:{
                0:{
                    items:2,
                    nav:true
                },
                600:{
                    items:4,
                    nav:false
                },
                1000:{
                    items:6,
                    nav:true,
                    loop:false
                }
            }
        })
    })
    .catch((error) => {
        console.log('co loi')
    })    
}

$(document).ready(() => {
	productSelling();
	search();
	products
		.then((res) => {
	    	let id = $('#quantity').data('id');
			let product = res.find((product) => product.id === id);		
			// next click
			$('.shop__qnt-btn--inc').on('click', function() {
				let number = $('#quantity').val();	
				number ++;
		        if(number > product.quantity) {
		        	$('#quantity').val(product.quantity);
		        	document.querySelector('.product__qnt-note').innerHTML = `Trong kho chỉ còn ${product.quantity} sản phẩm`;
		        	document.querySelector('.product__qnt-note').style.color = "red";
		        }else{
		        	document.querySelector('.product__qnt-note').innerHTML = `${product.quantity} sản phẩm có sẵn`;
		        	document.querySelector('.product__qnt-note').style.color = "#767676";
		        	$('#quantity').val(number);
		        }
			})
			// prev click
			$('.shop__qnt-btn--dec').on('click', function() {
				let number = $('#quantity').val();	
				number --;
		        if(number <= 0) {
		        	$('#quantity').val(1);
		        	document.querySelector('.product__qnt-note').innerHTML = `Số lượng đạt mức tối thiểu`;
		        	document.querySelector('.product__qnt-note').style.color = "red";
		        }else{
		        	document.querySelector('.product__qnt-note').innerHTML = `${product.quantity} sản phẩm có sẵn`;
		        	document.querySelector('.product__qnt-note').style.color = "#767676";
		        	$('#quantity').val(number);
		        }
			})				
			// change value
			$('#quantity').on('change', function(e) {
				let number = $(this).val();		
		        if(number > product.quantity) {
		        	$('#quantity').val(product.quantity);
		        	document.querySelector('.product__qnt-note').innerHTML = `Trong kho chỉ còn ${product.quantity} sản phẩm`;
		        	document.querySelector('.product__qnt-note').style.color = "red";
		        }else if(number <= 0){
		        	$('#quantity').val(1);
		        	document.querySelector('.product__qnt-note').innerHTML = `Số lượng đạt mức tối thiểu`;
		        	document.querySelector('.product__qnt-note').style.color = "red";
		        }else{
		        	document.querySelector('.product__qnt-note').innerHTML = `${product.quantity} sản phẩm có sẵn`;
		        	document.querySelector('.product__qnt-note').style.color = "#767676";
		        	$('#quantity').val(number);
		        }
			})
			// add click
			$('.product-btn-main__adding').on('click', ()=>{
				let number = $('#quantity').val();
		        if(number > product.quantity) {
		        	$('#quantity').val(product.quantity);
		        	document.querySelector('.product__qnt-note').innerHTML = `Trong kho chỉ còn ${product.quantity} sản phẩm`;
		        	document.querySelector('.product__qnt-note').style.color = "red";
		        }else{
		        	if(number <= product.quantity) {
						$.ajax({
						    type: 'GET',
						    url: 'addcart/'+id,
						    data: {
						      'quantity': $('#quantity').val()
						    },
						    success: function(data){
								toastr.options = {
									"debug": false,
									"positionClass": "toast-top-center",
									"onclick": null,
									"fadeIn": 300,
									"fadeOut": 1000,
									"timeOut": 1000,
									"extendedTimeOut": 1000
								}
								toastr["info"](data.message);
								if(data.cartCount){
									document.querySelector('.header__cart-wrap-notice').innerHTML = data.cartCount;
									renderList(data.cartContent);
									remove();
								}
							}
						});
		        	}
		        	$('#quantity').val(1);
		        }			
			})
			$('.product-btn-main__buying').on('click', (e) => {
				let number = $('#quantity').val();
		        if(number > product.quantity) {
		        	$('#quantity').val(product.quantity);
		        	document.querySelector('.product__qnt-note').innerHTML = `Trong kho chỉ còn ${product.quantity} sản phẩm`;
		        	document.querySelector('.product__qnt-note').style.color = "red";
		        }else{
		        	if(number <= product.quantity) {
						$.ajax({
						    type: 'GET',
						    url: 'addcart/'+id,
						    data: {
						      'quantity': $('#quantity').val()
						    },
						    success: function(data){
						        window.location.href = "/cart";
						    }
						});
		        	}
		        	$('#quantity').val(1);
		        }					
			})	
		})
})
</script>
@endsection