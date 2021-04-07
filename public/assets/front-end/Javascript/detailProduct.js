
function renderProductInfo() {
    let productInfo =
    `<div class="grid wide" style="padding-top: 25px;">
        <!-- Product slide & content -->
        <div class="row sm-gutter product">
            <div class="col l-5">
                <div class="product-slide">
                    <img src="https://cdn.shopify.com/s/files/1/0251/2155/4510/products/7652p_262c_1x_e931ecde-ec21-47ef-96eb-8424c3913890_800x.jpg?v=1608318433" class="product__img">
                    <div class="product__cards">
                        <button class="product__cards-btn product__cards-btn--first">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <div class="product__card-wrapper">
                            <img src="https://cdn.shopify.com/s/files/1/0251/2155/4510/products/7652p_262c_2x_6fd3fe79-79c8-4092-84b3-34ebbce9a769_800x.jpg?v=1608318433" class="product__card">
                        </div>
                        <div class="product__card-wrapper">
                            <img src="https://cdn.shopify.com/s/files/1/0251/2155/4510/products/7652p_262c_3x_30bac2ea-8b48-44df-88af-7c1125246cdc_800x.jpg?v=1608318433" class="product__card">
                        </div>
                        <div class="product__card-wrapper">
                            <img src="https://cdn.shopify.com/s/files/1/0251/2155/4510/products/7652p_28c_1x_e91fa224-a83b-4609-8a69-50a797fe1c09_800x.jpg?v=1608318433" class="product__card">
                        </div>
                        <div class="product__card-wrapper">
                            <img src="https://cdn.shopify.com/s/files/1/0251/2155/4510/products/7652p_28c_2x_aa586525-952b-4fe0-884e-2f1d4ab33dee_800x.jpg?v=1608318433" class="product__card">
                        </div>
                        <div class="product__card-wrapper">
                            <img src="https://cdn.shopify.com/s/files/1/0251/2155/4510/products/7652p_28c_3x_1fb36bcd-e635-49e8-a759-63297aa0cdd1_800x.jpg?v=1608318433" class="product__card">
                        </div>
                        <button class="product__cards-btn product__cards-btn--last">
                            <i class="fas fa-chevron-right"></i>
                        </button>
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
                            <a class="text">Đã thích (${product.liked}k)</a>
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
                        <span>[KHAI TRƯƠNG 149K-219K] Chuỗi Balo, Túi xách Minecraft được giảm giá đặc biệt nhân ngày mở bán</span>
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
                            <span class="product__status-reviewing-qnt underscore">${product.rev}</span>
                            <span class="product__status-text pr-text">Đánh Giá</span>
                        </div>
                        <div class="product__status-sold">
                            <span class="product__status-sold-qnt">${product.sold}</span>
                            <span class="product__status-text pr-text">Đã Bán</span>
                        </div>
                    </div>
                    
                    <div class="product__price">
                        <div class="product__price-main">
                            <span class="product__price-old">${product.oldPriceInfo}</span>
                            <div class="product__price-current">
                                <span class="product__price-new">${product.curPriceInfo}</span>
                                <span class="product__price-label bgr-orange">${product.per}% GIẢM</span>
                            </div>
                        </div>
                        <div class="product__price-slogan">
                            <i class="product__price-icon-tag fas fa-tags"></i>
                            <span class="product__price-slogan-text">Ở đâu rẻ hơn, Minecraft Shop hoàn tiền</span>
                            <i class="product__price-icon-question far fa-question-circle"></i>
                        </div>
                    </div>

                    <div class="product__info">
                        <div class="product__codes">
                            <label class="product__codes-label width-label">Mã Giảm Giá Của Shop</label>
                            <div class="product__codes-wrapper">
                                <div class="product__code">Giảm ₫3k</div>
                                <div class="product__code">Giảm ₫5k</div>
                                <div class="product__code">Giảm ₫8k</div>
                            </div>
                        </div>

                        <div class="product__combo">
                            <label class="product__combo-label width-label">Combo Khuyến Mãi</label>
                            <div class="product__combo-note">Mua 2 & giảm 5%</div>
                        </div>

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
                                                <span class="product__shipping-to-city">Huyện Ba Vì, Hà Nội</span>
                                                <i class="product__shipping-to-icon fas fa-chevron-down"></i>
                                            </div>
                                        </div>

                                        <div class="product__shipping-to-fee">
                                            <label class="product__shipping-to-label">Phí Vận Chuyển</label>
                                            <div class="product__shipping-to-fee-wrapper">
                                                <div class="product__shipping-to-fees">₫10.500</div>
                                                <i class="product__shipping-to-icon fas fa-chevron-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product__options">
                            <label class="product__options-label width-label">Balo Minecraft</label>
                            <div class="product__options-items">
                                <button class="product__options-item">Balo Creeper</button>
                                <button class="product__options-item">Túi chéo</button>
                                <button class="product__options-item">Túi xách tay</button>
                            </div>
                        </div>

                        <div class="product__qnt">
                            <label class="product__qnt-label width-label">Số Lượng</label>
                            <div class="shop__qnt-btns">
                                <button class="shop__qnt-btn shop__qnt-btn--dec">
                                    <i class="shop__qnt-btn-icon fas fa-minus"></i>
                                </button>
                                <input class="shop__qnt-input" type="text" value="1"></input>
                                <button class="shop__qnt-btn shop__qnt-btn--inc">
                                    <i class="shop__qnt-btn-icon fas fa-plus"></i>
                                </button>
                            </div>
                            <div class="product__qnt-note">${product.available} sản phẩm có sẵn</div>
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
                            <span><i class="product__guarantee-icon fas fa-clipboard-check"></i></span>
                            <div class="product__guarantee-text">Minecraft Shop Đảm Bảo</div>
                            <span class="product__guarantee-note">3 Ngày Trả Hàng / Hoàn Tiền</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid wide">
        <!-- Product combo cards -->
        <div class="row sm-gutter products-combo">
            <div class="products-combo__title">
                <span class="products-combo__text">Combo khuyến mãi</span>
                <div class="products-combo__note">Mua 2 & giảm 5%</div>
            </div>

            <div class="products-combo__cards">
                <div class="products-combo__card">
                    <a href="/" class="products-combo__card-link">
                        <img class="products-combo__card-img" src="https://cdn.shopify.com/s/files/1/0251/2155/4510/products/9523p_5c_1x_b1f223d0-2a5a-4ffd-8b27-4b771a89e884_800x.jpg?v=1610398986">
                        <span class="products-combo__card-name">[XẢ HÀNG] Balo Minecraft in hình trọn bộ nhân vật siêu xinh dành cho các bé</span>
                        <div class="products-combo__card-price">
                            <span class="products-combo__card-price-old">₫220.000</span>
                            <span class="products-combo__card-price-new">₫149.000</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid wide">
        <!-- Product shop -->
        <div class="row sm-gutter product-shop">
            <div class="product-shop__contact">
                <a href="#" class="product-shop__contact-img-link">
                    <div class="product-shop__contact-avatar-wrapper">
                        <img class="product-shop__contact-avatar"src="./Images/shop_manager.png">
                    </div>
                    <span class="label-loving">Yêu thích</span>
                </a>

                <div class="product-shop__contact-container">
                    <div class="product-shop__contact-name">${product.owner}</div>
                    <div class="product-shop__contact-online-time">Online 28 Phút Trước</div>
                    <div class="product-shop__contact-main">
                        <button class="product-shop__contact-btn product-shop__contact-message-btn">
                            <i class="product-shop__contact-icon far fa-comment-alt"></i>
                            <span class="product-shop__contact-message-text">Chat Ngay</span>
                        </button>

                        <a href="#" class="product-shop__contact-btn product-shop__contact-viewing">
                            <i class="product-shop__contact-icon fas fa-store"></i>
                            <div class="product-shop__contact-viewing-text">Xem Shop</div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="product-shop__side">
                <div class="product-shop__side-container">
                    <div class="product-shop__side-wrapper">
                        <label class="product-shop__side-label">Đánh giá</label>
                        <div class="product-shop__side-qnt">${product.revTotal}</div>
                    </div>

                    <a href="#" class="product-shop__side-wrapper">
                        <label class="product-shop__side-label">Sản phẩm</label>
                        <div href="#" class="product-shop__side-qnt product-shop__side-qnt--link">${product.proQnt}</div>
                    </a>
                </div>

                <div class="product-shop__side-container">
                    <div class="product-shop__side-wrapper">
                        <label class="product-shop__side-label">Tỉ Lệ Phản Hồi</label>
                        <div class="product-shop__side-qnt">${product.resRate}%</div>
                    </div>

                    <div class="product-shop__side-wrapper">
                        <label class="product-shop__side-label">Thời Gian Phản Hồi</label>
                        <div class="product-shop__side-qnt">${product.resTime}</div>
                    </div>
                </div>

                <div class="product-shop__side-container">
                    <div class="product-shop__side-wrapper">
                        <label class="product-shop__side-label">Tham gia</label>
                        <div class="product-shop__side-qnt">${product.join} tháng trước</div>
                    </div>

                    <div class="product-shop__side-wrapper">
                        <label class="product-shop__side-label">Người theo dõi</label>
                        <div class="product-shop__side-qnt">${product.follower}k</div>
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
                                        <span>Minecraft Shop</span>
                                    </a>
                                    <svg class="product-detail__icon" enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="shopee-svg-icon _3kIvpP icon-arrow-right"><path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z"></path></svg>
                                    <a class="product-detail__link" href="/">
                                        <span>Phụ kiện</span>
                                    </a>
                                    <svg class="product-detail__icon" enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0" class="shopee-svg-icon _3kIvpP icon-arrow-right"><path d="m2.5 11c .1 0 .2 0 .3-.1l6-5c .1-.1.2-.3.2-.4s-.1-.3-.2-.4l-6-5c-.2-.2-.5-.1-.7.1s-.1.5.1.7l5.5 4.6-5.5 4.6c-.2.2-.2.5-.1.7.1.1.3.2.4.2z"></path></svg>
                                    <a class="product-detail__link" href="/">
                                        <span>Balo</span>
                                    </a>
                                </div>
                            </div>

                            <div class="product-detail__wrapper">
                                <span class="product-detail__label">${product.brand}</span>
                                <a class="product-detail__link" href="/">
                                    <span>No brand</span>
                                </a>
                            </div>

                            <div class="product-detail__wrapper">
                                <span class="product-detail__label">${product.material}</span>
                                <span class="product-detail__text">Vải</span>
                            </div>

                            <div class="product-detail__wrapper">
                                <span class="product-detail__label">${product.origin}</span>
                                <span class="product-detail__text">Mỹ</span>
                            </div>

                            <div class="product-detail__wrapper">
                                <span class="product-detail__label">Kho hàng</span>
                                <span class="product-detail__text">${product.depot}</span>
                            </div>
                            
                            <div class="product-detail__wrapper">
                                <span class="product-detail__label">Gửi từ</span>
                                <span class="product-detail__text">${product.from}</span>
                            </div>
                        </div>
                    </div>

                    <div class="product-description">
                        <div class="product-description__title">MÔ TẢ SẢN PHẨM</div>
                        <span class="product-description__content">🎉 Balo Minecraft creeper backpack là mẫu ba lô siêu hot mới ra mắt năm 2017. Chất liệu: 100% polyester 🎉
*** Kích thước: 43x30x14cm ***
🌼 Sản xuất bởi J!NX
🌼 Hàng chính hãng USA
🌼 Ba lô được thiết kế dựa trên hoa văn của creeper, với màu xanh làm chủ đạo, bên ngoài là màu xanh nền cỏ của creeper.
🌼 Ngăn chính gồm các hoa văn in mặt của creeper màu ghi, nhìn xa giống như một hang đá vậy
🌼 Ngăn phụ bên ngoài in hình TNT giống như khối thuốc nổ chứa trong người con creeper ^^
🌼 Phần phía lưng cũng có hình creeper được may vào lớp đệm, mỗi khóa kéo đều là một khuôn mặt của creeper
🌼 Trọng lượng của ba lô rất nhẹ chỉ hơn 300g
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
                            <img class="product-hot-sales__item-img" src="https://cdn.shopify.com/s/files/1/0251/2155/4510/products/7652p_262c_1x_e931ecde-ec21-47ef-96eb-8424c3913890_800x.jpg?v=1608318433">
                        </div>
                        <div class="product-hot-sales__item-wrapper">
                            <div class="product-hot-sales__item-name">Balo Creepr nhiều túi vô cùng tiện lợi</div>
                            <div class="product-hot-sales__item-price">₫149.000 - ₫219.000</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>`

    return productInfo;
}
