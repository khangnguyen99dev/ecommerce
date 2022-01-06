<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Quản trị</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        @if(Auth::user()->role == 1)
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Trang Chủ</span>
        </a>
        @elseif (Auth::user()->role == 2)
        <a class="nav-link" href="/employee">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Trang Chủ</span>
        </a>
        @else
        <a class="nav-link" href="/delivery">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Trang Chủ</span>
        </a>
        @endif
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lý
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @if(Auth::user()->role == 1)
    <li class="nav-item">
        <a href="{{ route('category.index') }}" class="nav-link"><i class="fas fa-table"></i> Danh mục</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('productType.index') }}" class="nav-link"><i class="fas fa-list"></i> Loại sản phẩm</a>
    </li>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product" aria-expanded="true" aria-controls="product">
            <i class="fas fa-list"></i>
            <span>Sản phẩm</span>
        </a>
        <div id="product" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý:</h6>
                <a class="collapse-item" href="{{ route('product.index') }}">Danh sách</a>
                <a class="collapse-item" href="{{ route('product.create') }}">Thêm mới</a>
                <a class="collapse-item" href="{{ route('promotion.index') }}">Khuyến mãi</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#account" aria-expanded="true" aria-controls="account">
            <i class="fas fa-list"></i>
            <span>Tài khoản</span>
        </a>
        <div id="account" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý:</h6>
                <a class="collapse-item" href="{{ route('account.employee') }}">Nhân viên</a>
                <a class="collapse-item" href="{{ route('account.guest') }}">Khách hàng</a>
                <a class="collapse-item" href="{{ route('account.delivery') }}">Giao hàng</a>
            </div>
        </div>
    </li>
    @endif

    @if(Auth::user()->role == 1)
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#orders" aria-expanded="true" aria-controls="orders">
            <i class="fas fa-list"></i>
            <span>Đặt hàng</span>
        </a>
        <div id="orders" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý:</h6>
                <a class="collapse-item" href="admin/order">Chưa duyệt</a>
                <a class="collapse-item" href="admin/orderAccepted">Đã duyệt</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a href="admin/banner" class="nav-link"><i class="fas fa-list"></i>Banner</a>
    </li>

    <li class="nav-item">
        <a href="admin/slider" class="nav-link"><i class="fas fa-list"></i>Slider</a>
    </li>
    @elseif (Auth::user()->role == 2)
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#orders" aria-expanded="true" aria-controls="orders">
            <i class="fas fa-list"></i>
            <span>Đặt hàng</span>
        </a>
        <div id="orders" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý:</h6>
                <a class="collapse-item" href="employee/order">Chưa duyệt</a>
                <a class="collapse-item" href="employee/orderAccepted">Đã duyệt</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a href="employee/banner" class="nav-link"><i class="fas fa-list"></i>Banner</a>
    </li>

    <li class="nav-item">
        <a href="employee/slider" class="nav-link"><i class="fas fa-list"></i>Slider</a>
    </li>
    @endif

    @if(Auth::user()->role == 1 )
    <li class="nav-item">
        <a href="admin/delivery" class="nav-link"><i class="fas fa-list"></i>Giao hàng</a>
    </li>
    @elseif (Auth::user()->role == 3)
    <li class="nav-item">
        <a href="delivery/delivery" class="nav-link"><i class="fas fa-list"></i>Giao hàng</a>
    </li>
    @endif
    <!-- Divider -->

</ul>


