@extends('front-end.layouts.main')

@section('title')
    Trang Chủ
@endsection

@section('content')
<div class="app__container">
    <div class="grid wide">
        <div class="row sm-gutter app__content">
            <div class="col l-2 m-0 c-0">

                <!-- cateloty -->
                @include('front-end.layouts.menu')
                <!-- end catelory -->
            </div>
            @if(!isset($categoryjs) && !isset($productTypejs))
            <div class="col l-7 m-12 c-12 noneIndex">
                <!-- banner -->
                @include('front-end.pages.banner')
                <!-- end banner -->
            </div>
            @endif
            <div class="col l-3 m-0 c-0 noneIndex">
                <div class="banner">
                    <div class="banner__carousel-primary">
                        <a href="">
                            <img src="https://hondadoanhthu.vn/wp-content/uploads/2016/11/banner-home_Tablet_768x582.jpg" alt="">
                        </a>
                    </div>
                    <div class="banner__carousel-second">
                        <a href="">
                            <img src="https://shop2banh.vn/images/170221-2-670x370.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>

                
            <div class="col l-10 m-12 c-12 " id="showIndex">

                <!-- content -->
                <div class="home-filter hide-on-mobile-tablet">
                    <span class="home-filter__label">Sắp xếp theo</span>
                    <button class="home-filter__btn btn" data-click="btnPopular">Phổ biến</button>
                    <button class="home-filter__btn btn btn--primary" data-click="btnNew">Mới nhất</button>
                    <button class="home-filter__btn btn" data-click="btnSelling">Bán chạy</button>

                    <div class="select-input">
                        <span class="select-input__label">Giá</span>
                        <i class="select-input__icon fas fa-angle-down"></i>

                        <!-- List option -->
                        <ul class="select-input__list">
                            <li class="select-input__item">
                                Giá: Thấp đến cao
                            </li>
                            <li class="select-input__item">
                                Giá: Cao đến thấp
                            </li>
                        </ul>
                    </div>
                    <!-- <div id="pagition"></div> -->
                <!-- home-filter__page-btn-disabled -->
                    <div class="home-filter__page">
                        <span class="home-filter__page-num">
                            Trang <span class="home-filter__page-current">1</span>/<span class="home-filter__page-totalPage">14</span>
                        </span>
<!-- 
                        <div class="home-filter__page-control">
                            <a href="" class="home-filter__page-btn paginationjs-prev" id="prev-page">
                                <i class="home-filter__page-icon fas fa-angle-left"></i>
                            </a>
                            <a href="" class="home-filter__page-btn paginationjs-next" id="next-page">
                                <i class="home-filter__page-icon fas fa-angle-right"></i>
                            </a>
                        </div> -->
                    </div>
                </div> 

                <nav class="mobile-category">
                    <ul class="mobile-category__list">
                        @foreach($category as $idCategory => $valueCategory)
                            @if(count($category) > 0)
                            <li class="mobile-category__item" id="category-item{{ $valueCategory->id}}">
                                <a href="" idCategory="{{ $valueCategory->id}}" class="mobile-category__link">{{ $valueCategory->name}}</a>        
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </nav>

                <div class="home-product">
                    <div class="row sm-gutter" id="product">
                        <!-- Product item -->

                    </div>
                </div>
                <div id="pagition">
                    <!-- show pagition -->
                </div>
            </div>
        </div>
        @if(!isset($categoryjs) && !isset($productTypejs))
        <div class="row sm-gutter app__content noneIndex">          
            <div class="col l-12 m-12 c-12" id="showAllProduct" >
                <div class="home-product">
                    <!-- show all product -->
                </div>          
            </div>
        </div>

        <div class="row sm-gutter app__content noneIndex">          
            <div class="col l-12 m-12 c-12" >
                <div class="row sm-gutter">
                    <div class="col l-4 m-6 c-12" id="showRandom">
                        <div class="product-primary">
                        <!-- show ramdom product -->
                        </div>
                    </div>
                    <div class="col l-8" id="showRandomChild">
                        <div class="product-second">
                            <!-- show product random child                      -->
                        </div>                 
                    </div>
                </div>
            </div>
        </div>


        
        <div class="row sm-gutter app__content noneIndex">          
            <div class="col l-12 m-12 c-12" id="showProductSelling">
                <div class="home-product">
                    <!-- show product selling -->
                </div>
            </div>
        </div>
        
        <div class="row sm-gutter app__content noneIndex">          
            <div class="col l-12 m-12 c-12">
                @include('front-end.pages.slider')
            </div>
        </div>
        @endif
    </div>
</div>


<script>
    $(document).on('click', '.category-item__link', function (e) {
        e.preventDefault();
        $('.category-item__link').parent().removeClass('category-item--active');
        $(this).parent().addClass('category-item--active')
        let idCategory = $(this).data('id');
        let slugCategory = $(this).data('slug');
        let url = new URL(`http://kanestore.com/categories/${slugCategory}_${idCategory}.html`);
        
        $('#showIndex').show();
        $('.noneIndex').hide();
        history.pushState(null, null, url);
        $.get(`${location.pathname}`, function (data) {
            console.log(data)
            pagination(data);
        })
    })
    $(document).on('click', '.category__list-item-link', function (e) {
        e.preventDefault();
        $('.category-item__link').parent().removeClass('category-item--active');
        $(this).parent().parent().parent().addClass('category-item--active');
        let idProductType = $(this).data('id');
        let slugProductType = $(this).data('slug');
        let url = new URL(`http://kanestore.com/productTypes/${slugProductType}_${idProductType}.html`);
        
        $('#showIndex').show();
        $('.noneIndex').hide();
        history.pushState(null, null, url);

        $.get(`${location.pathname}`, function (data) {
            pagination(data);
        })
    })
function pagination(request) {
    $('.select-input__label').text('Giá');
    $('#pagition').pagination({
        dataSource: request,
        pageSize: 5,
        pageNumber: 1,
        callback: function(data, pagination) {
            if(data.length > 0){
                let totalPage = Math.ceil(pagination.totalNumber/pagination.pageSize);
                renderProduct(data);
                sortPrice(data);
                $('.home-filter__page-current').html(pagination.pageNumber);
                $('.home-filter__page-totalPage').html(totalPage);
                $('.paginationjs-prev a').html('<i class="pagination-item__icon fas fa-angle-left" ></i>');
                $('.paginationjs-next a').html('<i class="pagination-item__icon fas fa-angle-right" ></i>');
            }else{
                $('#pagition').html('');
                html= `
                <div class="purchase-empty-order__container">
                    <div class="purchase-empty-order__icon"> </div>
                    <div class="purchase-empty-order__text"> Hiện không có sản phẩm </div>
                </div>
                `;
                $('.home-product .row').html(html);

            }
        }
    })        
}

function renderProduct(request) {
        let htmls = '';
        request.map(function (product) {
                htmls+=`
                <div class="col l-2-4 m-4 c-6">
                    <a href="/${product.slug}_${product.id}.html" id="${product.id}" class="home-product-item">
                        <img src="../assets/img/upload/product/${product.image}" class="home-product-item__img">
                        <div class="home-product-item__name"> ${product.name} </div>
                `;

                if(product.promotion.promotional > 0){
                    htmls+=`
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old"> ${Intl.NumberFormat().format(product.oldPrice)+'₫'} </span>
                        <span class="home-product-item__price-current"> ${Intl.NumberFormat().format(product.currentPrice)+'₫'}</span>
                    </div>
                    `;
                }else{
                    htmls+=`
                    <div class="home-product-item__price home-product-item__price-not-sale">
                        <span class="home-product-item__price-current"> ${Intl.NumberFormat().format(product.currentPrice)+'₫'}</span>
                        <svg height="12" viewBox="0 0 20 12" width="20" style="margin-right: 10px"><g fill="none" fill-rule="evenodd" transform=""><rect fill="#00bfa5" fill-rule="evenodd" height="9" rx="1" width="12" x="4"></rect><rect height="8" rx="1" stroke="#00bfa5" width="11" x="4.5" y=".5"></rect><rect fill="#00bfa5" fill-rule="evenodd" height="7" rx="1" width="7" x="13" y="2"></rect><rect height="6" rx="1" stroke="#00bfa5" width="6" x="13.5" y="2.5"></rect><circle cx="8" cy="10" fill="#00bfa5" r="2"></circle><circle cx="15" cy="10" fill="#00bfa5" r="2"></circle><path d="m6.7082481 6.7999878h-.7082481v-4.2275391h2.8488017v.5976563h-2.1405536v1.2978515h1.9603297v.5800782h-1.9603297zm2.6762505 0v-3.1904297h.6544972v.4892578h.0505892c.0980164-.3134765.4774351-.5419922.9264138-.5419922.0980165 0 .2276512.0087891.3003731.0263672v.6210938c-.053751-.0175782-.2624312-.038086-.3762568-.038086-.5122152 0-.8758247.3017578-.8758247.75v1.8837891zm3.608988-2.7158203c-.5027297 0-.8536919.328125-.8916338.8261719h1.7390022c-.0158092-.5009766-.3446386-.8261719-.8473684-.8261719zm.8442065 1.8544922h.6544972c-.1549293.571289-.7050863.9228515-1.49238.9228515-.9864885 0-1.5903965-.6269531-1.5903965-1.6464843 0-1.0195313.6165553-1.6669922 1.5872347-1.6669922.9580321 0 1.5366455.6064453 1.5366455 1.6083984v.2197266h-2.4314412v.0351562c.0221328.5595703.373095.9140625.9169284.9140625.4110369 0 .6924391-.1376953.8189119-.3867187zm2.6224996-1.8544922c-.5027297 0-.853692.328125-.8916339.8261719h1.7390022c-.0158091-.5009766-.3446386-.8261719-.8473683-.8261719zm.8442064 1.8544922h.6544972c-.1549293.571289-.7050863.9228515-1.49238.9228515-.9864885 0-1.5903965-.6269531-1.5903965-1.6464843 0-1.0195313.6165553-1.6669922 1.5872347-1.6669922.9580321 0 1.5366455.6064453 1.5366455 1.6083984v.2197266h-2.4314412v.0351562c.0221328.5595703.373095.9140625.9169284.9140625.4110369 0 .6924391-.1376953.8189119-.3867187z" fill="#fff"></path><path d="m .5 8.5h3.5v1h-3.5z" fill="#00bfa5"></path><path d="m0 10.15674h3.5v1h-3.5z" fill="#00bfa5"></path><circle cx="8" cy="10" fill="#047565" r="1"></circle><circle cx="15" cy="10" fill="#047565" r="1"></circle></g></svg>
                    </div>
                    `;
                }

                htmls+=`
                <div class="home-product-item__action">
                    <span class="home-product-item__like home-product-item__like--liked">
                        <i class="home-product-item__like-icon-empty far fa-heart"></i>
                        <i class="home-product-item__like-icon-fill fas fa-heart"></i>
                    </span>
                    <div class="home-product-item__rating">`;
                if(product.avg_rating.length > 0){
                    for(let i = 1; i <= 5; i++){
                        if(i <= Math.round(product.avg_rating[0].avg_star) ){
                            htmls+=`<i class="home-product-item__star--gold fas fa-star"></i>`;
                        }else{
                            htmls+=`<i class="fas fa-star"></i>`;
                        }
                    }
                }else{
                    for(let i = 1; i <= 5; i++){
                            htmls+=`<i class="fas fa-star"></i>`;
                    }                
                }
                    htmls+=`</div>
                    <span class="home-product-item__sold"> ${product.sold + ' đã bán'} </span>
                </div>

                <div class="home-product-item__origin">
                    <span class="home-product-item__brand"> ${product.category.name} </span>
                    <span class="home-product-item__origin-name"> ${product.product_type.name} </span>
                </div>
                `;

                if(product.react > 0) {
                    htmls+=`
                    <div class="product-favourite">
                        <i class="fas fa-check"></i>
                        <span>Yêu thích</span>
                    </div>
                    `;
                }

                if(product.promotion.promotional >0){
                    htmls+=`
                    <div class="product-sale-off">
                        <span class="product-sale-off__percent"> ${product.promotion.promotional+'%'}</span>
                        <span class="product-sale-off__label"> GIẢM </span>
                    </div>
                    `;
                }

                htmls+=`
                    </a>
                </div>
                `;     
        })

    $('.home-product .row').html(htmls);
}

function sortPrice(data) {
    let sortName = document.querySelector('.select-input__label');
    let firstSelection = document.querySelector('.select-input__list > li:first-child');
    let lastSelection = document.querySelector('.select-input__list > li:last-child');

    // Remove dots and convert to numbers from price
    // function fixPrice(num) {
    //     return Number.parseInt(num.replace(/[\.]/g, ''));
    // }
    // Sort from low to high
    if (firstSelection) {
        firstSelection.onclick = () => {
            // console.log(sortName);
            data.sort((a, b) => {
                a = a.oldPrice;
                b = b.currentPrice;
                return a - b;
            })
            document.querySelector('.select-input__label').innerHTML = 'Giá từ thấp đến cao';
            renderProduct(data);
        }
    }

    // Sort from high to low
    if (lastSelection) {
        lastSelection.onclick = () => {
            data.sort((a, b) => {
                a = a.oldPrice;
                b = b.currentPrice;
                return b - a;
            })
            document.querySelector('.select-input__label').innerHTML = 'Giá từ cao đến thấp';
            renderProduct(data);
        }
    }
}

const products = async () => {
	const response = await fetch('/product', {
		method: 'GET',
		dataType: 'json',
	});
	if (!response.ok) {
		throw new Error(`HTTP error! status: ${response.status}`);
	}
	return await response.json(); 
}

const renderAllProduct = async () => {
	let data = [];
	try {
		data = await products();
	} catch (error) {
		console.log(error);
	}      
    html='';
    html+=`<div class="home-product">
        <div class="row sm-gutter products-combo">
            <div class="products-combo__title">
                <span class="products-combo__text">Tất cả sản phẩm</span>
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
                                //     <span class="products-combo__card-price-old">${Intl.NumberFormat().format(product.oldPrice)+'₫'} </span>
                                //     <span class="products-combo__card-price-new">${Intl.NumberFormat().format(product.currentPrice)+'₫'} </span>
                                // </div>
                                
                            html+=`</div>
                        </div>
                    </a>
                </div>`
            })

            html+= `</div>
        </div>
    </div>`;
    $('#showAllProduct').html(html);
    owlCarousel();
} 

renderAllProduct();


const renderRandom = async() => {
	let data = [];
	try {
		data = await products();
	} catch (error) {
		console.log(error);
	}   
    const randomElement = Math.floor(Math.random() * data.length);    
    const product = data[randomElement];
    let html='';
        html+=`
        <div class="product-primary">
            <a href="${product.slug}_${product.id}.html" class="home-product-item">
            <img src=" assets/img/upload/product/${product.image}" class="home-product-item__img">
            <div class="home-product-item__name">${product.name}</div>`
        if(product.promotion.promotional>0){   
        html+=`<div class="home-product-item__price">
                <span class="home-product-item__price-old"> ${Intl.NumberFormat().format(product.oldPrice)+'₫'} </span>
                <span class="home-product-item__price-current"> ${Intl.NumberFormat().format(product.currentPrice)+'₫'} </span>
            </div>`
        }else{
        html+=`
        <div class="home-product-item__price home-product-item__price-not-sale">
            <span class="home-product-item__price-current"> ${Intl.NumberFormat().format(product.currentPrice)+'₫'} </span>
            <svg height="12" viewBox="0 0 20 12" width="20" style="margin-right: 10px"><g fill="none" fill-rule="evenodd" transform=""><rect fill="#00bfa5" fill-rule="evenodd" height="9" rx="1" width="12" x="4"></rect><rect height="8" rx="1" stroke="#00bfa5" width="11" x="4.5" y=".5"></rect><rect fill="#00bfa5" fill-rule="evenodd" height="7" rx="1" width="7" x="13" y="2"></rect><rect height="6" rx="1" stroke="#00bfa5" width="6" x="13.5" y="2.5"></rect><circle cx="8" cy="10" fill="#00bfa5" r="2"></circle><circle cx="15" cy="10" fill="#00bfa5" r="2"></circle><path d="m6.7082481 6.7999878h-.7082481v-4.2275391h2.8488017v.5976563h-2.1405536v1.2978515h1.9603297v.5800782h-1.9603297zm2.6762505 0v-3.1904297h.6544972v.4892578h.0505892c.0980164-.3134765.4774351-.5419922.9264138-.5419922.0980165 0 .2276512.0087891.3003731.0263672v.6210938c-.053751-.0175782-.2624312-.038086-.3762568-.038086-.5122152 0-.8758247.3017578-.8758247.75v1.8837891zm3.608988-2.7158203c-.5027297 0-.8536919.328125-.8916338.8261719h1.7390022c-.0158092-.5009766-.3446386-.8261719-.8473684-.8261719zm.8442065 1.8544922h.6544972c-.1549293.571289-.7050863.9228515-1.49238.9228515-.9864885 0-1.5903965-.6269531-1.5903965-1.6464843 0-1.0195313.6165553-1.6669922 1.5872347-1.6669922.9580321 0 1.5366455.6064453 1.5366455 1.6083984v.2197266h-2.4314412v.0351562c.0221328.5595703.373095.9140625.9169284.9140625.4110369 0 .6924391-.1376953.8189119-.3867187zm2.6224996-1.8544922c-.5027297 0-.853692.328125-.8916339.8261719h1.7390022c-.0158091-.5009766-.3446386-.8261719-.8473683-.8261719zm.8442064 1.8544922h.6544972c-.1549293.571289-.7050863.9228515-1.49238.9228515-.9864885 0-1.5903965-.6269531-1.5903965-1.6464843 0-1.0195313.6165553-1.6669922 1.5872347-1.6669922.9580321 0 1.5366455.6064453 1.5366455 1.6083984v.2197266h-2.4314412v.0351562c.0221328.5595703.373095.9140625.9169284.9140625.4110369 0 .6924391-.1376953.8189119-.3867187z" fill="#fff"></path><path d="m .5 8.5h3.5v1h-3.5z" fill="#00bfa5"></path><path d="m0 10.15674h3.5v1h-3.5z" fill="#00bfa5"></path><circle cx="8" cy="10" fill="#047565" r="1"></circle><circle cx="15" cy="10" fill="#047565" r="1"></circle></g></svg>
        </div>        
        `
        }
        html+=`<div class="home-product-item__action">
                <span class="home-product-item__like home-product-item__like--liked">
                    <i class="home-product-item__like-icon-empty far fa-heart"></i>
                    <i class="home-product-item__like-icon-fill fas fa-heart"></i>
                </span>
                <div class="home-product-item__rating">`;
                for(let i = 1; i <= 5; i++){
                    if(i <= product.rating){
                        html+=`<i class="home-product-item__star--gold fas fa-star"></i>`;
                    }else{
                        html+=`<i class="fas fa-star"></i>`;
                    }
                }                    
                html+=`</div>
                <span class="home-product-item__sold">${product.sold} đã bán </span>
            </div>
            <div class="home-product-item__origin">
                <span class="home-product-item__brand"> ${product.category.name} </span>
                <span class="home-product-item__origin-name">${product.product_type.name} </span>
            </div>`;
            if(product.react>0){
            html+=`<div class="product-favourite">
                <i class="fas fa-check"></i>
                <span>Yêu thích</span>
            </div>`;
            }
            if(product.promotion.promotional>0){
            html+=`<div class="product-sale-off">
                <span class="product-sale-off__percent">${product.promotion.promotional}%</span>
                <span class="product-sale-off__label"> GIẢM </span>
            </div>`
            }
        html+= `</a>
    </div>`;
    $('#showRandom').html(html);
}

renderRandom();


const renderRandomChild = async() => {
	let data = [];
	try {
		data = await products();
	} catch (error) {
		console.log(error);
	}   
    let shuffled = data.sort(function(){return .8 - Math.random()});
    let list=shuffled.slice(0,8);
    let html='<div class="product-second">';
    list.map((product)=> {
        html+=`
        <div class="col l-3 m-4 c-6">
            <div class="home-product-item">
                <a href="${product.slug}_${product.id}.html" class="products-combo__card-link">
                    <div class="products-combo__cards">
                        <div class="products-combo__card">
                            <img class="products-combo__card-img" src="assets/img/upload/product/${product.image}">
                            <span class="products-combo__card-name">${product.name}</span>`;
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
                        html+=`</div>
                    </div>
                </a>    
            </div>                  
        </div>          
        `;
    })
    html+=`<\div>`;

    $('#showRandomChild').html(html);
}

renderRandomChild();

const renderSelling = async() => {
	let data = [];
	try {
		data = await products();
	} catch (error) {
		console.log(error);
	}  
    let sort = data.sort((a,b)=> {
			b = b.sold;
			a = a.sold;
			return b-a;
		})
    let list = sort.slice(0,10)
    let html='';
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
                                //     <span class="products-combo__card-price-old">${Intl.NumberFormat().format(product.oldPrice)+'₫'}</span>
                                //     <span class="products-combo__card-price-new">${Intl.NumberFormat().format(product.currentPrice)+'₫'}</span>
                                // </div>

                            html+=`</div>
                        </div>
                    </a>
                </div>`
            })

            html+= `</div>
        </div>
    </div>`;
    $('#showProductSelling').html(html);
    owlCarousel();
}
renderSelling();

$(document).on('click', '.home-filter__btn', function (e) {
    let btn = $(this).data('click');
    $(this).parent().find('.home-filter__btn').removeClass('btn--primary');
    $(this).addClass('btn--primary'); 
	products()
        .then((res) => {
            switch (btn) {
                case "btnPopular":
                    res.sort((a, b) => {
                        return a.sold - b.sold;
                    })
                    renderProduct(res);
                    pagination(res);
                    break;
                case "btnNew":
                    res.sort((a, b) => {
                        return b.id - a.id;
                    })
                    renderProduct(res);
                    pagination(res);
                    break;
                case "btnSelling":
                    res.sort((a, b) => {
                        return b.sold - a.sold;
                    })
                    renderProduct(res);
                    pagination(res);
                    break;
            }
        })
})

function owlCarousel() {
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

</script>
@if(isset($categoryjs))
<script>
    let idCategory = "{{$categoryjs}}";
    if(idCategory == 'all'){
        $('.categoryall').click();
    }else{
        $(`.category${idCategory}`).click();
    }
    
</script>
@endif
@if(isset($productTypejs))
<script>
    let idProductType = "{{$productTypejs}}";
    $(`.productType${idProductType}`).click(); 
</script>
@endif

@if(isset($search))
<script>
    const key = "{{$search}}"; 
    $.ajax({
        type: 'GET',
        url: `/api/search/`+key,
        success: (data) => {
            $('#showIndex').show();
            $('.noneIndex').hide();        
            renderProduct(data);
        }
    })
</script>
@endif
<!-- <script src="assets/front-end/Javascript/base.js"></script> -->
@endsection