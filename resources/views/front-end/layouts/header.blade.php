<header class="header" id="header-search">
    <div class="grid wide">
        <nav class="header__navbar hide-on-mobile-tablet">
            <ul class="header__navbar-list">
                <div class="header__navbar-item header__navbar-item-separate">
                    Kênh người bán
                </div>

                <li class="header__navbar-item header__navbar-item-has-qr header__navbar-item-separate">
                    Tải ứng dụng
                    <!-- Header QR code -->
                    <div class="header__qr">
                        <img src="" alt="QR code" class="header__qr-img" />
                        <div class="header__qr-apps">
                            <a class="header__qr-link">
                                <img src="assets/front-end/Images/google_play.png" alt="Google Play" class="header__qr-dowload-img"></img>
                            </a>
                            <a class="header__qr-link">
                                <img src="assets/front-end/Images/app_store.png" alt="App Store" class="header__qr-dowload-img"></img>
                            </a>
                        </div>
                    </div>
                </li>

                <li class="header__navbar-item">
                    <span class="header__navbar-title--no-pointer">Kết nối</span>
                    <a href="" class="header__navbar-icon-link">
                        <i class="header__navbar-icon fab fa-facebook"></i>
                    </a>
                    <a href="" class="header__navbar-icon-link">
                        <i class="header__navbar-icon fab fa-instagram"></i>
                    </a>
                </li>
            </ul>

            <ul class="header__navbar-list">
                <li class="header__navbar-item header__navbar-item--has-notify">
                    <a class="header__navbar-item-link">
                        <i class="header__navbar-icon far fa-bell"></i> Thông Báo
                    </a>
                    <div class="header__notify">
                        <header class="header__notify-header">
                            Thông báo mới nhận
                        </header>
                        <ul class="header__notify-list">
                            <li class="header__notify-item header__notify-item--viewed">
                                <a href="" class="header__notify-link">
                                    <img src="" alt="" class="header__notify-img">
                                    <div class="header__notify-info">
                                        <span class="header__notify-name">Áo thun Minecraft chính hãng</span>
                                        <span class="header__notify-description">Mô tả sản phẩm</span>
                                    </div>
                                </a>
                            </li>
                            <footer class="header__notify-footer">
                                <a href="" class="header__notify-footer-btn">Xem tất cả</a>
                            </footer>
                        </ul>
                    </div>
                </li>
                <li class="header__navbar-item">
                    <a class="header__navbar-item-link">
                        <i class="header__navbar-icon far fa-question-circle"></i> Trợ Giúp
                    </a>
                </li>
                @if(Auth::check())
                   <li class="header__navbar-item header__navbar-user">
                        <img src="assets/front-end/Images/user.png" class="header__navbar-user-img"></img>
                        <span class="header__navbar-user-name">{{ Auth::user()->name}}</span>
                        <ul class="header__navbar-user-menu">
                            <li class="header__navbar-user-item">
                                <a href="">Tài khoản của tôi</a>
                            </li>
                            <li class="header__navbar-user-item">
                                <a href="">Địa chỉ của tôi</a>
                            </li>
                            <li class="header__navbar-user-item">
                                <a href="">Đơn mua</a>
                            </li>
                            <li class="header__navbar-user-item header__navbar-user-item--separate">
                                <a href="{{ route('logout') }}">Đăng xuất</a>
                            </li>
                        </ul>
                    </li>
                @else
                <!-- <li id="register-item" > -->
                    <a href="{{route('register')}}" class="header__navbar-item header__navbar-item-separate">Đăng Ký</a>
                <!-- </li> -->
                <!-- <li id="login-item" > -->
                    <a href="{{route('login')}}" class="header__navbar-item">Đăng Nhập</a>
                <!-- </li> -->
                @endif
            </ul>
        </nav>

        <input type="checkbox" hidden class="nav__input" id="nav-mobile-input"></input>

        <!-- Nav on mobile -->
        <div class="nav__mobile">
            <ul class="nav__mobile-list">
                <div class="category__heading">Danh mục</div>
                <!-- category-item--active -->
                <ul class="category-list">
                    <li class="category-item ">
                        <a href="" class="category-item__link">Đồ bán chạy hôm nay</a>
                    </li>
                    <li class="category-item">
                        <a href="" class="category-item__link">Bình giữ nhiệt</a>
                    </li>
                    <li class="category-item">
                        <a href="" class="category-item__link">Bộ lắp ghép Minecraft</a>
                    </li>
                    <li class="category-item">
                        <a href="" class="category-item__link">Hộp bút chì Creeper</a>
                    </li>
                    <li class="category-item">
                        <a href="" class="category-item__link">Túi khăn tắm 3 hộp</a>
                    </li>
                    <li class="category-item">
                        <a href="" class="category-item__link">Balo Creeper</a>
                    </li>
                    <li class="category-item">
                        <a href="" class="category-item__link">Móc khóa Diamond Word</a>
                    </li>
                    <li class="category-item">
                        <a href="" class="category-item__link">Bộ lắp ghép Bàn chế tạo</a>
                    </li>
                    <li class="category-item">
                        <a href="" class="category-item__link">Hộp thẻ bài 4 người</a>
                    </li>
                    <li class="category-item">
                        <a href="" class="category-item__link">Cốc lạc đà Llama</a>
                    </li>
                </ul>
            </ul>
            <label for="nav-mobile-input" class="nav__mobile-close">
                <i class="nav__mobile-close--icon fas fa-times"></i>
            </label>
        </div>

        <label for="nav-mobile-input" class="nav__overlay"></label>

        <!-- Header-with-search -->
        <div class="header-with-search">
            <label for="nav-mobile-input" class="mobile__menu-btn">
                <i class="mobile__menu-icon fas fa-bars"></i>
            </label>
            <label for="mobile-search-checkbox" class="header__mobile-search">
                <i class="header__mobile-search-icon fas fa-search"></i>
            </label>
            <input type="checkbox" hidden class="header__search-checkbox" id="mobile-search-checkbox">

            <div class="header__logo hide-on-tablet">
                <a href="{{ route('home') }}" class="header__logo-link">
                    <img src="assets/front-end/Images/logo.png" alt="">
                </a>
            </div>
            <div class="header__search" >
                <div class="header__search-input-wrap" >
                    <input type="text" class="header__search-input" placeholder="Nhập để tìm kiếm.." id="search"></input>

                    <!-- Search history -->
                    <div class="header__search-history">
                        <div class="header__search-history-heading">Tìm kiếm</div>
                        <ul class="header__search-history-list" id="result-search">
       <!--                      <li class="header__search-history-item">
                                <img src="assets/img/upload/product/957315518-dia-recto-46t-chinh-hang-cho-exciter-155-1461-slide-products-6020c1caf317b.jpg" alt="" style="width: 30px; height: 30px">
                                <a href="#" class="header__search-history-item-link">Đồ chơi</a>
                            </li> -->
                     <!--        <li class="header__search-history-item">
                                <a href="#">Cặp sách</a>
                            </li> -->
                        </ul>
                    </div>
                </div>

                <button class="header__search-btn">
                    <i class="header__search-btn-icon fas fa-search"></i>
                </button>
            </div>

            <!-- Cart layout -->
            <div class="header__cart">             
                    <div class="header__cart-wrap">
                        <a href="{{ route('cart.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -31 512.00026 512" width="30px"><path fill="#ffffff" d="m164.960938 300.003906h.023437c.019531 0 .039063-.003906.058594-.003906h271.957031c6.695312 0 12.582031-4.441406 14.421875-10.878906l60-210c1.292969-4.527344.386719-9.394532-2.445313-13.152344-2.835937-3.757812-7.269531-5.96875-11.976562-5.96875h-366.632812l-10.722657-48.253906c-1.527343-6.863282-7.613281-11.746094-14.644531-11.746094h-90c-8.285156 0-15 6.714844-15 15s6.714844 15 15 15h77.96875c1.898438 8.550781 51.3125 230.917969 54.15625 243.710938-15.941406 6.929687-27.125 22.824218-27.125 41.289062 0 24.8125 20.1875 45 45 45h272c8.285156 0 15-6.714844 15-15s-6.714844-15-15-15h-272c-8.269531 0-15-6.730469-15-15 0-8.257812 6.707031-14.976562 14.960938-14.996094zm312.152343-210.003906-51.429687 180h-248.652344l-40-180zm0 0"/><path fill="#ffffff" d="m150 405c0 24.8125 20.1875 45 45 45s45-20.1875 45-45-20.1875-45-45-45-45 20.1875-45 45zm45-15c8.269531 0 15 6.730469 15 15s-6.730469 15-15 15-15-6.730469-15-15 6.730469-15 15-15zm0 0"/><path fill="#ffffff" d="m362 405c0 24.8125 20.1875 45 45 45s45-20.1875 45-45-20.1875-45-45-45-45 20.1875-45 45zm45-15c8.269531 0 15 6.730469 15 15s-6.730469 15-15 15-15-6.730469-15-15 6.730469-15 15-15zm0 0"/></svg>
                        <span class="header__cart-wrap-notice">{{Cart::count()}}</span>
                        </a>
                        <!-- No cart: Header__cart-list--no-cart -->
                        <div class="header__cart-list">
                            @if(Cart::count() > 0)
                            <div class="header__cart-list-has">
                                <div class="header__cart-heading">Sản phẩm đã thêm</div>
                                <ul class="header__cart-list-item">
                                    <!-- Cart item -->
                                    
                                    @foreach($cart = Cart::content() as $key => $value)
                                    <li title="{{ $value->name }}" class="header__cart-item header__cart-item{{ $value->rowId }}">
                                        <div class="header__cart-img-wrapper">
                                            <img src="assets/img/upload/product/{{ $value->options['image'] }}" class="header__cart-img">
                                        </div>
                                        <div class="header__cart-item-info">
                                            <div class="header__cart-item-head">
                                                <div class="header__cart-item-name">{{ $value->name }}</div>
                                                <div class="header__cart-item-price-wrap">
                                                    <span class="header__cart-item-price">{{ number_format($value->price,0,",",".") }}₫</span>
                                                    <span class="header__cart-item-multiply">x</span>
                                                    <span class="header__cart-item-qnt">{{ $value->qty }}</span>
                                                </div>
                                            </div>
                                            <div class="header__cart-item-body">
                                                <span class="header__cart-item-description">
        											Danh mục: {{ $value->options['Category'] }}
        										</span>
                                                <span class="header__cart-item-remove cart-remove" data-id="{{$value->rowId}}">Xóa</span>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                    
                                </ul>

                                <a href="{{route('cart.index') }}" class="header__cart-view-cart btn btn--primary">Xem giỏ hàng</a>
                            </div>
                            @else

                            <div class="header__cart-list-none" >
                                <img src="assets/front-end/Images/no-cart.png" class="header__cart-no-card-img"></img>
                                <span class="header__cart-list-no-card-msg">
                                    Chưa có sản phẩm
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                
            </div>
        </div>
    </div>

    <!-- Sort bar on mobile -->
    <ul class="header__sort-bar">
        <li class="header__sort-item">
            <a href="" class="header__sort-link">Liên quan</a>
        </li>
        <li class="header__sort-item header__sort-item--active">
            <a href="" class="header__sort-link">Mới nhất</a>
        </li>
        <li class="header__sort-item">
            <a href="" class="header__sort-link">Bán chạy</a>
        </li>
        <li class="header__sort-item">
            <a href="" class="header__sort-link">Giá</a>
        </li>
    </ul>
</header>