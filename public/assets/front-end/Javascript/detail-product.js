let id_Product = $('#product__cards').data('id');

const rating = async () => {
	const response = await fetch('/rating/'+id_Product, {
		method: 'GET',
		dataType: 'json',
	});
	if (!response.ok) {
		throw new Error(`HTTP error! status: ${response.status}`);
	}
	return await response.json(); 
}


const paginationRating = async () => {
	let data = [];
	try {
		data = await rating();
	} catch (error) {
		console.log(error);
	}
	
	let ratings = data.rating;
	let html = '';
	if(ratings.length > 0) {
		$('#pagination-rating').pagination({
			dataSource: ratings,
			pageSize: 3,
			pageNumber: 1,
			callback: function(ratings,pagination){
				renderRating(ratings);
				addBtn();
			}
		})
	}else{
		html += `<div class="product-reviews__comment">Rất tiếc, hiện chưa có đánh giá nào!</div>`;
		$('#status-rating').html(html);
	}	
} 

paginationRating();


async function getUser() {
	try {
		const response = await axios.get('/comment/'+id_Product);
		return response;
	} catch (error) {
		console.error(error);
	}
}

getUser()
	.then(res => {
		let idUser = res.data.idUser;
		let comment = res.data.comment;
		let html = '';
		if(comment.length > 0) {
			$('#pagination-comment').pagination({
				dataSource: comment,
				pageSize: 3,
				pageNumber: 1,
				callback: function(data, pagination) {
					renderComment(data,idUser);
					addBtn();
				}
			})
		}else{
			html += `<div class="product-reviews__comment">Rất tiếc, hiện chưa có bình luận nào</div>`;
			$('#status-comment').html(html);
		}	
})

function renderRating(ratings){
	let html = '';
	ratings.map((data) => {
		html+=`
		<div class="reviews__comment">
			<div class="image__comment">`;
		if(data.user.avatar == null) {
			html += `<img src="https://via.placeholder.com/150" alt="">`;
		}else {
			html += `<div class="header__navbar-user-img" style="background-image: url(../assets/img/upload/avatar/${data.user.avatar});"></div>`;
		}
		html+=`
		</div>
			<div class="content__comment">
				<div class="info__comment">
					<div class="info__comment-name">${data.user.name}</div>
					<div class="info__comment-star">
						<div class="home-product-item__rating">`;
						for(let i = 1; i <= 5; i++){
							if(i <= data.star){
								html+=`<i class="home-product-item__star--gold fas fa-star"></i>`;
							}else{
								html+=`<i class="fas fa-star"></i>`;
							}
						}   
						html+=`</div>
					</div>
				</div>
				<div class="message__comment">
					${data.message}
				</div>
				<span class="date__comment">${data.date}</span>
			</div>
		</div>`});
	$('#rating-list').html(html);
}

function renderComment(comment,idUser) {
	let html = '';
	comment.map((data) => {
		html+=`<div class="reviews__comment comment${data.id}">
			<div class="image__comment">`;
		if(data.user.avatar == null) {
			html += `<img src="https://via.placeholder.com/150" alt="">`;
		}else {
			html += `<div class="header__navbar-user-img" style="background-image: url(../assets/img/upload/avatar/${data.user.avatar});"></div>`;
		}
		html+=`
		</div>
			<div class="content__comment">
				<div class="info__comment">
					<div class="info__comment-name">${data.user.name}</div>
				</div>
				<div class="message__comment">
					${data.message}
				</div>
				<span class="date__comment">${data.date}</span>`;
				if(idUser == data.user.id){
					html+=`<span class="btn-delete__comment date__comment js-showAccept-comment" data-id="${data.id}">Xóa</span>`;
				}			
			html+=`</div>
		</div>`});
	$('#comment-list').html(html);
}

$(document).on('click', '.js-showAccept-comment', function (e) {
	$('#deleteComment').css('display','flex');
	$('.modal__overlay').show();
	let id = $(this).data('id');
	$('#deleteComment').find('.js-id-comment').val(id);
})

$(document).on('click', '.js-btn-cancel', function (e) {
	$('.modal').hide();
})

$(document).on('click', '.js-btn-close', function (e) {
	$('.modal').hide();
})

$(document).on('click', '.js-accept-deleteComment', function (e) {
	toastr.options = {
		"debug": false,
		"positionClass": "toast-top-center",
		"onclick": null,
		"fadeIn": 300,
		"fadeOut": 1000,
		"timeOut": 1000,
		"extendedTimeOut": 2000
	}
	const idComment = $(this).parent().find('.js-id-comment').val();
	$.ajax({
		type: 'DELETE',
		url: 'comment/'+idComment,
		success: (data) => {
			if(data.error){
				toastr["info"](data.error);
			}else{
				$('.modal').hide();
				toastr["info"](data.success);
				// $('.comment'+idComment).hide();
				location.reload();
			}
		}
	})
})

function addBtn(){
	let btnPrevs = $('.paginationjs-prev a');
	let btnNexts = $('.paginationjs-next a');
	for (const btnPrev of btnPrevs) {
		$(btnPrev).html(`<i class="pagination-item__icon fas fa-angle-left" ></i>`);
	}

	for (const btnNext of btnNexts) {
		$(btnNext).html(`<i class="pagination-item__icon fas fa-angle-right" ></i>`);
	}
}

const products = async () => {
	const response = await fetch('/productRelate/'+id_Product, {
		method: 'GET',
		dataType: 'json',
	});
	if (!response.ok) {
		throw new Error(`HTTP error! status: ${response.status}`);
	}
	return await response.json(); 
}
const productRelate = async () => {
	let data = [];
	try {
		data = await products();
	} catch (error) {
		console.log(error);
	}
	let html='';
	html+=`<div class="home-product">
		<div class="row sm-gutter products-combo">
			<div class="products-combo__title">
				<span class="products-combo__text">Sản phẩm liên quan</span>
				<!-- <div class="products-combo__note">Mua 2 & giảm 5%</div> -->
			</div>
			<div class="owl-carousel owl-theme" >
			`;
			data.map((product)=>{
				html+=
				`<div class="item">
					<a href="${product.slug}_${product.id}.html" class="products-combo__card-link">
						<div class="products-combo__cards">
							<div class="products-combo__card">
								<img class="products-combo__card-img" src="assets/img/upload/product/${product.image}">
								<span class="products-combo__card-name">${product.name}</span>`
								if(product.promotion.promotional>0){
									html+=`<div class="products-combo__card-price">
										<span class="products-combo__card-price-old">${Intl.NumberFormat().format(product.oldPrice)+'₫'} </span>
										<span class="products-combo__card-price-new">${Intl.NumberFormat().format(product.currentPrice)+'₫'} </span>
									</div>`;
								}else{
									html+=`<div class="products-combo__card-price products-combo__card-price-not-sale">
										<span class="products-combo__card-price-new"> ${Intl.NumberFormat().format(product.currentPrice)+'₫'} </span>
										<svg height="12" viewBox="0 0 20 12" width="20" style="margin-right: 10px"><g fill="none" fill-rule="evenodd" transform=""><rect fill="#00bfa5" fill-rule="evenodd" height="9" rx="1" width="12" x="4"></rect><rect height="8" rx="1" stroke="#00bfa5" width="11" x="4.5" y=".5"></rect><rect fill="#00bfa5" fill-rule="evenodd" height="7" rx="1" width="7" x="13" y="2"></rect><rect height="6" rx="1" stroke="#00bfa5" width="6" x="13.5" y="2.5"></rect><circle cx="8" cy="10" fill="#00bfa5" r="2"></circle><circle cx="15" cy="10" fill="#00bfa5" r="2"></circle><path d="m6.7082481 6.7999878h-.7082481v-4.2275391h2.8488017v.5976563h-2.1405536v1.2978515h1.9603297v.5800782h-1.9603297zm2.6762505 0v-3.1904297h.6544972v.4892578h.0505892c.0980164-.3134765.4774351-.5419922.9264138-.5419922.0980165 0 .2276512.0087891.3003731.0263672v.6210938c-.053751-.0175782-.2624312-.038086-.3762568-.038086-.5122152 0-.8758247.3017578-.8758247.75v1.8837891zm3.608988-2.7158203c-.5027297 0-.8536919.328125-.8916338.8261719h1.7390022c-.0158092-.5009766-.3446386-.8261719-.8473684-.8261719zm.8442065 1.8544922h.6544972c-.1549293.571289-.7050863.9228515-1.49238.9228515-.9864885 0-1.5903965-.6269531-1.5903965-1.6464843 0-1.0195313.6165553-1.6669922 1.5872347-1.6669922.9580321 0 1.5366455.6064453 1.5366455 1.6083984v.2197266h-2.4314412v.0351562c.0221328.5595703.373095.9140625.9169284.9140625.4110369 0 .6924391-.1376953.8189119-.3867187zm2.6224996-1.8544922c-.5027297 0-.853692.328125-.8916339.8261719h1.7390022c-.0158091-.5009766-.3446386-.8261719-.8473683-.8261719zm.8442064 1.8544922h.6544972c-.1549293.571289-.7050863.9228515-1.49238.9228515-.9864885 0-1.5903965-.6269531-1.5903965-1.6464843 0-1.0195313.6165553-1.6669922 1.5872347-1.6669922.9580321 0 1.5366455.6064453 1.5366455 1.6083984v.2197266h-2.4314412v.0351562c.0221328.5595703.373095.9140625.9169284.9140625.4110369 0 .6924391-.1376953.8189119-.3867187z" fill="#fff"></path><path d="m .5 8.5h3.5v1h-3.5z" fill="#00bfa5"></path><path d="m0 10.15674h3.5v1h-3.5z" fill="#00bfa5"></path><circle cx="8" cy="10" fill="#047565" r="1"></circle><circle cx="15" cy="10" fill="#047565" r="1"></circle></g></svg>
									</div>`;
								}
								// <div class="products-combo__card-price">
								// 	<span class="products-combo__card-price-old">${product.oldPrice}₫</span>
								// 	<span class="products-combo__card-price-new">${product.currentPrice}₫</span>
								// </div>

							html+=`</div>
						</div>
					</a>
				</div>`
			})

			html+= `</div>
		</div>
	</div>`;
	$('#productRelate').html(html);
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
} 

productRelate();


const imageLibrary = async () => {
	const response = await fetch('/imageLibrary/'+id_Product, {
		method: 'GET',
		dataType: 'json',
	});
	if (!response.ok) {
		throw new Error(`HTTP error! status: ${response.status}`);
	}
	return await response.json(); 
}

const renderImageLibrary = async () => {
	let data = [];
	try {
		data = await imageLibrary();
	} catch (error) {
		console.log(error);
	}

	let url = $('#img-primary').attr('src');
	let html =`
	<div class="owl-carousel owl-theme" >
	<div class="item">
	<div class="product__card-wrapper">
			<img src="${url}" class="product__card">
		</div>
	</div>`;
	data.map((value) => {
		html+=`
		<div class="item">
			<div class="product__card-wrapper">
				<img src="../assets/img/upload/product/${value.path}" alt="${value.name}" class="product__card">
			</div>
		</div>
		`;
	})
	html+=`</div>`;
	$('#product__cards').html(html);
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
} 
renderImageLibrary()
Pusher.logToConsole = false;

var pusher = new Pusher('9b3e94e62e0ff0812fb4', {
	cluster: 'eu'
});

var channel = pusher.subscribe('my-comment');
channel.bind('my-comment', function(data) {
//    alert(JSON.stringify(data));
	if(data.idProduct == id_Product) {
		let html = `
		<div class="reviews__comment">
			<div class="image__comment">`;
		if(data.avatar == null) {
			html += `<img src="https://via.placeholder.com/150" alt="">`;
		}else {
			html += `<div class="header__navbar-user-img" style="background-image: url(../assets/img/upload/avatar/${data.avatar});"></div>`;
		}

		html+=`
		</div>
			<div class="content__comment">
				<div class="info__comment">
					<div class="info__comment-name">${data.name}</div>
				</div>
				<div class="message__comment">
					${data.message}
				</div>
				<span class="date__comment">${data.date}</span>
			</div>
		</div>
		`;
		$('#comment-list').prepend(html);
		$('#status-comment').hide();
	}
});

$(document).on('click', '.send-comment', function (e) {
	if("{{ Auth::check() }}") {
		let message = $('#comment').val();
		$('#comment').val('');
		if(message != '' && id_Product != '') {
			let datastr = 'idProduct='+id_Product+'&message='+message;
			$.ajax({
				type: 'POST',
				url: 'comment',
				data: datastr,
				cache: false,
				success: (data)=> {
					
				},
				error: (error) => {

				}
			}) 
		}
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
		toastr["info"]('Bạn cần đăng nhập trước khi bình luận');
		$('#comment').val('');
	}
})


$(document).on('click','.product-btn-main__adding', function (e){
	let quantity = $('#quantity').val();
	$.ajax({
		type: 'GET',
		url: 'addcart/'+id_Product,
		data: {
			'quantity': quantity
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
			if(data.error){
				toastr["info"](data.error);
				location.reload();
			}else{
				toastr["info"](data.message);
				if(data.cartCount){
					$('.header__cart-wrap-notice').html(data.cartCount);
					renderList(data.cartContent);
					remove();
				}
			}
		}
	})	
	$('#quantity').val(1)	
})

$(document).on('click','.product-btn-main__buying', function(e) {
	let quantity = $('#quantity').val();
	$.ajax({
		type: 'GET',
		url: 'addcart/'+id_Product,
		data: {
		'quantity': quantity
		},
		success: function(data){
			if(data.error){
				toastr["info"](data.error);
				location.reload();				
			}else{
				window.location.href = "/cart";
			}
			$('#quantity').val(1);
		}
	})				
})	

$(document).ready(()=>{
	checkQuantity();
})


$(document).on('mouseenter','.product__card', function(e) {
	let url = $(this).attr('src');
	$('#img-primary').attr('src',url);
	$('.magnify-lens').css({'background':`url(${url}) 1000px 1000px no-repeat`});
})

const checkQuantity = async () => {
	let data = [];
	try {
		data = await products();
	} catch (error) {
		console.log(error);
	}
	let product = data.find((product) => product.id === id_Product);
	
	$(document).on('click', '.shop__qnt-btn--inc', function (e) {
		let qty = $(this).parent().find('.shop__qnt-input').val();
		qty++;
		if(qty > product.quantity){
			$(this).parent().find('.shop__qnt-input').val(product.quantity);
			$('.product__qnt-note').html(`Trong kho chỉ còn ${product.quantity} sản phẩm`);
			$('.product__qnt-note').css('color','red');
		}else{
			$(this).parent().find('.shop__qnt-input').val(qty);
			$('.product__qnt-note').html(`${product.quantity} sản phẩm có sẵn`);
			$('.product__qnt-note').css('color','#767676');	
		}
	})

	$(document).on('change','.shop__qnt-input', function (e) {
		let qty = $(this).val();
		if(!$.isNumeric(qty)){
			$(this).parent().find('.shop__qnt-input').val(1);
			$('.product__qnt-note').html(`Số lượng phải là số`);
			$('.product__qnt-note').css('color','red');				
		}else{
			if(qty > product.quantity){
				$(this).parent().find('.shop__qnt-input').val(product.quantity);
				$('.product__qnt-note').html(`Trong kho chỉ còn ${product.quantity} sản phẩm`);
				$('.product__qnt-note').css('color','red');			
			}else if(qty <= 0) {
				$(this).parent().find('.shop__qnt-input').val(1);
				$('.product__qnt-note').html(`Số lượng đạt mức tối thiểu`);
				$('.product__qnt-note').css('color','red');	
			}else{
				$(this).parent().find('.shop__qnt-input').val(qty);
				$('.product__qnt-note').html(`${product.quantity} sản phẩm có sẵn`);
				$('.product__qnt-note').css('color','#767676');				
			}
		}
	})
	$(document).on('click', '.shop__qnt-btn--dec', function (e) {
		let qty = $(this).parent().find('.shop__qnt-input').val();
		qty--;
		if(qty <= 0){
			$(this).parent().find('.shop__qnt-input').val(1);
			$('.product__qnt-note').html(`Số lượng đạt mức tối thiểu`);
			$('.product__qnt-note').css('color','red');
		}else{
			$(this).parent().find('.shop__qnt-input').val(qty);
			$('.product__qnt-note').html(`${product.quantity} sản phẩm có sẵn`);
			$('.product__qnt-note').css('color','#767676');	
		}
	})
	
} 