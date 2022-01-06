let products = fetch('http://kanestore.com/api/product')
    .then((res) => {
        return res.json();
    })
    .catch((err) => {
        console.log(err);
    })

$(document).ready(() => {  
    renderAllProduct();
    renderRandom();
    renderRandomChild();
    productSelling();
    // productByCategory();
    // productByProductType();
    // sortProducts();   
    search();
})

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
                                            <span class="products-combo__card-price-old">${Intl.NumberFormat().format(product.oldPrice)+'₫'} </span>
                                            <span class="products-combo__card-price-new">${Intl.NumberFormat().format(product.currentPrice)+'₫'} </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>`
                    })

                    html+= `</div>
                </div>
            </div>`;
            resolve($('#showProductSelling').html(html));
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

function renderRandomChild() {
   products
   .then((data) => {   
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
                                if(product.promotional>0){
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
       })
   .catch((error) => {
       console.log('co loi')
   })  
}

function renderRandom() {
    products
    .then((data) => {   
        const randomElement = Math.floor(Math.random() * data.length);    
        const product = data[randomElement];
        let html='';
                html+=`
                <div class="product-primary">
                    <a href="${product.slug}_${product.id}.html" class="home-product-item">
                    <img src=" assets/img/upload/product/${product.image}" class="home-product-item__img">
                    <div class="home-product-item__name">${product.name}</div>`
                if(product.promotional>0){   
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
                    if(product.promotional>0){
                    html+=`<div class="product-sale-off">
                        <span class="product-sale-off__percent">${product.promotional}%</span>
                        <span class="product-sale-off__label"> GIẢM </span>
                    </div>`
                    }
                html+= `</a>
            </div>`;
            $('#showRandom').html(html);
        })
    .catch((error) => {
        console.log('co loi')
    })  
}

function renderAllProduct() {
    products
    .then((data) => {
        return new Promise((resolve, reject) => {         
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
                                        <span class="products-combo__card-name">${product.name}</span>
                                        <div class="products-combo__card-price">
                                            <span class="products-combo__card-price-old">${Intl.NumberFormat().format(product.oldPrice)+'₫'} </span>
                                            <span class="products-combo__card-price-new">${Intl.NumberFormat().format(product.currentPrice)+'₫'} </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>`
                    })

                    html+= `</div>
                </div>
            </div>`;
            resolve($('#showAllProduct').html(html));
        })
    })
    .then((data) => {
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

// function pagination(request) {
//     $('.select-input__label').text('Giá');
//     $('#pagition').pagination({
//         dataSource: request,
//         pageSize: 5,
//         pageNumber: 1,
//         callback: function(data, pagination) {
//             let totalPage = Math.ceil(pagination.totalNumber/pagination.pageSize);
//             renderProduct(data);
//             sortPrice(data);
//             document.querySelector('.home-filter__page-current').innerHTML = pagination.pageNumber;
//             document.querySelector('.home-filter__page-totalPage').innerHTML = totalPage;
//             document.querySelector('.paginationjs-prev a').innerHTML = '<i class="pagination-item__icon fas fa-angle-left" ></i>';
//             document.querySelector('.paginationjs-next a').innerHTML = '<i class="pagination-item__icon fas fa-angle-right" ></i>';
//         }
//     })        
// }




// const productByCategory = () => {
//     products
//         .then((request) => {
//             const btn = document.querySelectorAll('.category-item__link');
//             for(i = 0; i < btn.length; i++) {
//                 btn[i].addEventListener('click', (e) => {
//                     const noneIndex = document.querySelectorAll('.noneIndex');
//                     for (let i = 0 ; i < noneIndex.length; i++) {
//                         noneIndex[i].style.display = 'none';
//                     }
//                     document.querySelector('#showIndex').style.display = 'block';
//                     function changeColorCategory() {
//                         const remove = e.target.parentNode.parentNode.getElementsByTagName('li');
//                         for (let el of remove) {
//                             el.classList.remove('category-item--active');
//                         }
//                         const active = e.target.parentNode.classList.add('category-item--active');
//                     }
//                     e.preventDefault();

//                     const filter = e.target.getAttribute('idCategory');         
//                     let data = request.filter(function(obj) {
//                         return obj.idCategory == filter ? obj : false ;              
//                     })
//                     if(data.length!= 0) {               
//                         changeColorCategory();
//                         pagination(data);
//                     }else{
//                         const check = e.target.getAttribute('id');
//                         if(check == 'all-product') {
//                             changeColorCategory();
//                             pagination(request);
//                         }else{
//                             let html = `
//                             <div class="purchase-empty-order__container">
//                                 <div class="purchase-empty-order__icon"> </div>
//                                 <div class="purchase-empty-order__text"> Hiện không có sản phẩm </div>
//                             </div>
//                             `;
//                             document.querySelector('.home-product .row').innerHTML = html;
//                         }               
//                     }   
//                 })
//             }            
//         })
// }

// const productByProductType = () => {
//     products
//         .then((request) => {
//             const btn = document.querySelectorAll('.category__list-item-link');
//             for(i = 0; i < btn.length; i++ ) {
//                 btn[i].addEventListener('click', (e) => {
//                     const noneIndex = document.querySelectorAll('.noneIndex');
//                     for (let i = 0 ; i < noneIndex.length; i++) {
//                         noneIndex[i].style.display = 'none';
//                     }
//                     document.querySelector('#showIndex').style.display = 'block';
//                     function changeColorCategory() {
//                         const remove = e.target.parentNode.parentNode.parentNode.parentNode.getElementsByClassName('category-item-list');
//                         for (let el of remove) {
//                             el.classList.remove('category-item--active');
//                         }
//                         const active = e.target.parentNode.parentNode.parentNode.classList.add('category-item--active');
//                     }
//                     e.preventDefault();
//                     const filter = e.target.getAttribute('idProductType');
//                     let data = request.filter(function(obj) {
//                         return obj.idProductType == filter ? obj : false;
//                     })
//                     if(data.length != 0) {
//                         changeColorCategory();
//                         pagination(data);         
//                     }else{
//                         const check = e.target.parentNode.getAttribute('id');
//                         if(check == 'all-product') {
//                             changeColorCategory();
//                             pagination(request);
//                         }else{
//                             let html = `
//                             <div class="purchase-empty-order__container">
//                                 <div class="purchase-empty-order__icon"> </div>
//                                 <div class="purchase-empty-order__text"> Hiện không có sản phẩm </div>
//                             </div>
//                             `;
//                             document.querySelector('.home-product .row').innerHTML = html;
//                         }  
//                     }
//                 })
//             }            
//         })
// }


const sortProducts = () => {
    products
        .then((data) => {
            let btnClassList = document.getElementsByClassName('home-filter__btn'); // get button class list
            let cmBtn = btnClassList[0]; // get element of the common button
            let newBtn = btnClassList[1]; // get element of the newest button
            let sellBtn = btnClassList[2]; // get element of best-selling button

            // remove background class of button
            function removeBgrClass() {
                for (let el of btnClassList) {
                    el.classList.remove('btn--primary');
                }
            }

            if (cmBtn) {
                cmBtn.onclick = () => {
                    removeBgrClass();
                    cmBtn.classList.add('btn--primary');
                    data.sort((a, b) => {
                        return b.sold - a.sold;
                    })
                    pagination(data);
                }
            }

            if (newBtn) {
                newBtn.onclick = () => {
                    removeBgrClass();
                    newBtn.classList.add('btn--primary');
                    data.sort((a, b) => {
                        return a.sold - b.sold;
                    })
                    pagination(data);            
                }
            }
            
            if (sellBtn) {
                sellBtn.onclick = () => {
                    removeBgrClass();
                    sellBtn.classList.add('btn--primary');
                    data.sort((a, b) => {
                        return a.id - b.id;
                    })
                    pagination(data);
                }
            }            
        })
}


// console.log(products)
// sort price
// function sortPrice(data) {
//     let sortName = document.querySelector('.select-input__label');
//     let firstSelection = document.querySelector('.select-input__list > li:first-child');
//     let lastSelection = document.querySelector('.select-input__list > li:last-child');

//     // Remove dots and convert to numbers from price
//     // function fixPrice(num) {
//     //     return Number.parseInt(num.replace(/[\.]/g, ''));
//     // }
//     // Sort from low to high
//     if (firstSelection) {
//         firstSelection.onclick = () => {
//             // console.log(sortName);
//             data.sort((a, b) => {
//                 a = a.oldPrice;
//                 b = b.currentPrice;
//                 return a - b;
//             })
//             document.querySelector('.select-input__label').innerHTML = 'Giá từ thấp đến cao';
//             renderProduct(data);
//         }
//     }

//     // Sort from high to low
//     if (lastSelection) {
//         lastSelection.onclick = () => {
//             data.sort((a, b) => {
//                 a = a.oldPrice;
//                 b = b.currentPrice;
//                 return b - a;
//             })
//             document.querySelector('.select-input__label').innerHTML = 'Giá từ cao đến thấp';
//             renderProduct(data);
//         }
//     }
// }

// function renderProduct(request) {
//         if(request.length == 0){
//             toastr["info"]("Hiện không có sản phẩm!");
//         }else{
//         let htmls = '';
//         request.map(function (product) {
//                 htmls+=`
//                 <div class="col l-2-4 m-4 c-6">
//                     <a href="${product.slug}_${product.id}.html" id="${product.id}" class="home-product-item">
//                         <img src=" assets/img/upload/product/${product.image}" class="home-product-item__img">
//                         <div class="home-product-item__name"> ${product.name} </div>
//                 `;

//                 if(product.promotional > 0){
//                     htmls+=`
//                     <div class="home-product-item__price">
//                         <span class="home-product-item__price-old"> ${Intl.NumberFormat().format(product.oldPrice)+'₫'} </span>
//                         <span class="home-product-item__price-current"> ${Intl.NumberFormat().format(product.currentPrice)+'₫'}</span>
//                     </div>
//                     `;
//                 }else{
//                     htmls+=`
//                     <div class="home-product-item__price home-product-item__price-not-sale">
//                         <span class="home-product-item__price-current"> ${Intl.NumberFormat().format(product.currentPrice)+'₫'}</span>
//                         <svg height="12" viewBox="0 0 20 12" width="20" style="margin-right: 10px"><g fill="none" fill-rule="evenodd" transform=""><rect fill="#00bfa5" fill-rule="evenodd" height="9" rx="1" width="12" x="4"></rect><rect height="8" rx="1" stroke="#00bfa5" width="11" x="4.5" y=".5"></rect><rect fill="#00bfa5" fill-rule="evenodd" height="7" rx="1" width="7" x="13" y="2"></rect><rect height="6" rx="1" stroke="#00bfa5" width="6" x="13.5" y="2.5"></rect><circle cx="8" cy="10" fill="#00bfa5" r="2"></circle><circle cx="15" cy="10" fill="#00bfa5" r="2"></circle><path d="m6.7082481 6.7999878h-.7082481v-4.2275391h2.8488017v.5976563h-2.1405536v1.2978515h1.9603297v.5800782h-1.9603297zm2.6762505 0v-3.1904297h.6544972v.4892578h.0505892c.0980164-.3134765.4774351-.5419922.9264138-.5419922.0980165 0 .2276512.0087891.3003731.0263672v.6210938c-.053751-.0175782-.2624312-.038086-.3762568-.038086-.5122152 0-.8758247.3017578-.8758247.75v1.8837891zm3.608988-2.7158203c-.5027297 0-.8536919.328125-.8916338.8261719h1.7390022c-.0158092-.5009766-.3446386-.8261719-.8473684-.8261719zm.8442065 1.8544922h.6544972c-.1549293.571289-.7050863.9228515-1.49238.9228515-.9864885 0-1.5903965-.6269531-1.5903965-1.6464843 0-1.0195313.6165553-1.6669922 1.5872347-1.6669922.9580321 0 1.5366455.6064453 1.5366455 1.6083984v.2197266h-2.4314412v.0351562c.0221328.5595703.373095.9140625.9169284.9140625.4110369 0 .6924391-.1376953.8189119-.3867187zm2.6224996-1.8544922c-.5027297 0-.853692.328125-.8916339.8261719h1.7390022c-.0158091-.5009766-.3446386-.8261719-.8473683-.8261719zm.8442064 1.8544922h.6544972c-.1549293.571289-.7050863.9228515-1.49238.9228515-.9864885 0-1.5903965-.6269531-1.5903965-1.6464843 0-1.0195313.6165553-1.6669922 1.5872347-1.6669922.9580321 0 1.5366455.6064453 1.5366455 1.6083984v.2197266h-2.4314412v.0351562c.0221328.5595703.373095.9140625.9169284.9140625.4110369 0 .6924391-.1376953.8189119-.3867187z" fill="#fff"></path><path d="m .5 8.5h3.5v1h-3.5z" fill="#00bfa5"></path><path d="m0 10.15674h3.5v1h-3.5z" fill="#00bfa5"></path><circle cx="8" cy="10" fill="#047565" r="1"></circle><circle cx="15" cy="10" fill="#047565" r="1"></circle></g></svg>
//                     </div>
//                     `;
//                 }

//                 htmls+=`
//                 <div class="home-product-item__action">
//                     <span class="home-product-item__like home-product-item__like--liked">
//                         <i class="home-product-item__like-icon-empty far fa-heart"></i>
//                         <i class="home-product-item__like-icon-fill fas fa-heart"></i>
//                     </span>
//                     <div class="home-product-item__rating">`;
//                 for(let i = 1; i <= 5; i++){
//                     if(i <= product.rating){
//                         htmls+=`<i class="home-product-item__star--gold fas fa-star"></i>`;
//                     }else{
//                         htmls+=`<i class="fas fa-star"></i>`;
//                     }
//                 }
//                     htmls+=`</div>
//                     <span class="home-product-item__sold"> ${product.sold + ' đã bán'} </span>
//                 </div>

//                 <div class="home-product-item__origin">
//                     <span class="home-product-item__brand"> ${product.category.name} </span>
//                     <span class="home-product-item__origin-name"> ${product.product_type.name} </span>
//                 </div>
//                 `;

//                 if(product.react > 0) {
//                     htmls+=`
//                     <div class="product-favourite">
//                         <i class="fas fa-check"></i>
//                         <span>Yêu thích</span>
//                     </div>
//                     `;
//                 }

//                 if(product.promotional >0){
//                     htmls+=`
//                     <div class="product-sale-off">
//                         <span class="product-sale-off__percent"> ${product.promotional+'%'}</span>
//                         <span class="product-sale-off__label"> GIẢM </span>
//                     </div>
//                     `;
//                 }

//                 htmls+=`
//                     </a>
//                 </div>
//                 `;     
//         })
            
//         document.querySelector('.home-product .row').innerHTML = htmls;
//     }
// }