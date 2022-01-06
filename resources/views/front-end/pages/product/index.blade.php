@extends('front-end.layouts.main')

@section('title')
    Trang Chủ
@endsection

@section('content')
<!-- <link rel="stylesheet" href="{{asset('assets/css/jquery.dataTables.min.css')}}">
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script> -->
<div class="app__container">
    <div class="grid wide">
        <div class="row sm-gutter app__content">
            <div class="col l-2 m-0 c-0">

                <!-- cateloty -->
                @include('front-end.layouts.menu')
                <!-- end catelory -->
            </div>
            <div class="col l-10 m-12 c-12 ">

                <!-- content -->
                <div class="home-filter hide-on-mobile-tablet">
                    <span class="home-filter__label">Sắp xếp theo</span>
                    <button class="home-filter__btn btn">Phổ biến</button>
                    <button class="home-filter__btn btn btn--primary">Mới nhất</button>
                    <button class="home-filter__btn btn">Bán chạy</button>

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
                <!-- home-filter__page-btn-disabled -->
                    <div class="home-filter__page">
                        <span class="home-filter__page-num">
                            Trang <span class="home-filter__page-current">{{$product->currentPage()}}</span>/<span class="home-filter__page-totalPage">{{$product->lastPage()}}</span>
                        </span>
                    </div>
                </div> 
                <div class="home-product">
                    <div class="row sm-gutter" id="product">
                        @yield('product')
                    </div>
                </div>
                <div id="pagition">
                    {{ $product->links() }}
                    <!-- show pagition -->
                </div>
            </div>
        </div>
@endsection