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
            <div class="col l-7 m-12 c-12 noneIndex">
                <!-- banner -->
                @include('front-end.pages.banner')
                <!-- end banner -->
            </div>

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

    </div>
</div>
<script src="assets/front-end/Javascript/base.js"></script>
@endsection