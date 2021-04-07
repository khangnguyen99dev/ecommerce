// fix hover error of notification's text in nav bar
let notifyNav = document.querySelector('.header__navbar-item--has-notify'); // get the element of notification in nav bar
let notifyText = document.querySelector('.header__navbar-item-link'); // get the element of notification's text in nav bar

notifyNav.onmouseover = () => {
    notifyText.style.color = 'rgba(255, 255, 255, 0.7)';
}

notifyNav.onmouseout = () => {
    notifyText.style.color = 'white';
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function remove() {
	const listRemove = document.querySelectorAll('.cart-remove');
	if(listRemove.length > 0){

		$.each(listRemove, (index, value) => {
			value.addEventListener('click', (e) => {
				let id = value.getAttribute('data-id');
				$.ajax({
				    type: 'DELETE',
				    url: 'cart/'+id,
				    data: {
				      'quantity': $('#quantity').val()
				    },
				    success: function(data){
				        if(data) {
							toastr.options = {
							  "debug": false,
							  "positionClass": "toast-top-center",
							  "onclick": null,
							  "fadeIn": 300,
							  "fadeOut": 1000,
							  "timeOut": 1000,
							  "extendedTimeOut": 2000
							}
				        	toastr["info"]('Đã xóa sản phẩm khỏi giỏ hàng ');
				        	document.querySelector('.header__cart-wrap-notice').innerHTML = data.cartCount;
				        	$('.header__cart-item'+id).remove();

				        	if($('#cart').hasClass('cart-bundle')){
				        		document.getElementById("select-all-checkbox").innerHTML = `Chọn tất cả (${data.cartCount})`;
				        		$('.cart-item'+id).remove();
				        	}
				        	
				        	if($('.header__cart-list-item').find(".header__cart-item").length == 0){
								let noCart = document.querySelector('.header__cart-list-has');
								if(noCart){
									noCart.style.display = "none";
									renderNone();
								}					        		
				        	}
				        }
				    }
				});
			})			
		})

	}
}

remove();
function renderNone() {
	let html = `
    <div class="header__cart-list-none" >
        <img src="assets/front-end/Images/no-cart.png" class="header__cart-no-card-img"></img>
        <span class="header__cart-list-no-card-msg">
            Chưa có sản phẩm
        </span>
    </div>
	`;
	document.querySelector('.header__cart-list').innerHTML = html;
}

function renderList(request) {
	let html = `<div class="header__cart-list-has">
                <div class="header__cart-heading">Sản phẩm đã thêm</div>
                <ul class="header__cart-list-item">`;
	for (const data in request) {
		html+=`                                    
        <li title="${request[data].name}" class="header__cart-item header__cart-item${request[data].rowId}">
            <div class="header__cart-img-wrapper">
                <img src="assets/img/upload/product/${request[data].options.image}" class="header__cart-img">
            </div>
            <div class="header__cart-item-info">
                <div class="header__cart-item-head">
                    <div class="header__cart-item-name">${request[data].name}</div>
                    <div class="header__cart-item-price-wrap">
                        <span class="header__cart-item-price">${Intl.NumberFormat().format(request[data].price)+'₫'}</span>
                        <span class="header__cart-item-multiply">x</span>
                        <span class="header__cart-item-qnt">${request[data].qty}</span>
                    </div>
                </div>
                <div class="header__cart-item-body">
                    <span class="header__cart-item-description">
						Danh mục: ${request[data].options.Category}
					</span>
                    <span class="header__cart-item-remove cart-remove" data-id="${request[data].rowId}">Xóa</span>
                </div>
            </div>
        </li>`
    }  
	html+=`</ul>
        <a href="/cart" class="header__cart-view-cart btn btn--primary">Xem giỏ hàng</a>
    </div>`;  
	
	let none = document.querySelector('.header__cart-list-none');
	if(none){
		none.style.display = "none";
	}
    document.querySelector('.header__cart-list').innerHTML = html;
}

function encode(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a"); 
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"); 
    str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i"); 
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o"); 
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"); 
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"); 
    str = str.replace(/đ/g,"d");
    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    str = str.replace(/Đ/g, "D");
    // Some system encode vietnamese combining accent as individual utf-8 characters
    // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
    str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
    str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
    // Remove extra spaces
    // Bỏ các khoảng trắng liền nhau
    str = str.replace(/ + /g," ");
    str = str.trim();
    // Remove punctuations
    // Bỏ dấu câu, kí tự đặc biệt
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
    return str;
}

const search = () => {
    products
        .then((res) => {
            $('#search').keyup(() => {
                $('#result-search').html('');
                let searchField = encode($('#search').val()).toLowerCase();
                $('.header__search-history').show();
                $.each(res, (key,value) => {
                    if(encode(value.name).toLowerCase().search(searchField) != -1) {
                        $('#result-search').append(`
                            <li class="header__search-history-item">
                            		<img src="assets/img/upload/product/${value.image}" alt="${value.name}" style="width: 30px; height: 30px">
                                    <a href="${value.slug}_${value.id}.html" class="header__search-history-item-link">${value.name}</a>
                            </li>
                        `);
                    }
                })

            $('#header-search').mouseleave((e) => {
            	$('.header__search-history').hide();
            })

            })
        })
}


function slider() {
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:1,
                nav:false
            },
            1000:{
                items:1,
                nav:true
            }
        }
    })
}


