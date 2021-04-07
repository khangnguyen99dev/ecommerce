<nav class="category">
    <div class="category__heading-wrapper">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" heigth="16px" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60.123 60.123" style="enable-background:new 0 0 60.123 60.123; margin-right: 3px" xml:space="preserve">
        <g>
            <path d="M57.124,51.893H16.92c-1.657,0-3-1.343-3-3s1.343-3,3-3h40.203c1.657,0,3,1.343,3,3S58.781,51.893,57.124,51.893z"/>
            <path d="M57.124,33.062H16.92c-1.657,0-3-1.343-3-3s1.343-3,3-3h40.203c1.657,0,3,1.343,3,3   C60.124,31.719,58.781,33.062,57.124,33.062z"/>
            <path d="M57.124,14.231H16.92c-1.657,0-3-1.343-3-3s1.343-3,3-3h40.203c1.657,0,3,1.343,3,3S58.781,14.231,57.124,14.231z"/>
            <circle cx="4.029" cy="11.463" r="4.029"/>
            <circle cx="4.029" cy="30.062" r="4.029"/>
            <circle cx="4.029" cy="48.661" r="4.029"/>
        </g>
        </svg>
        <div class="category__heading">Danh mục</div>
    </div>
    <ul class="category-list" id="category-list">
        <li class="category-item category__item-hover category-item-list category-item--active">
            <a href="#"   class="category-item__link" id="all-product">Tất cả sản phẩm</a>
        </li>
        @foreach($category as $idCategory => $valueCategory)
            @if(count($category) > 0)
            <li class="category-item category__item-hover category-item-list">
                <a href="#" idCategory="{{ $valueCategory->id}}" class="category-item__link">{{ $valueCategory->name}}</a>
                <i class="category-item-icon fas fa-chevron-right"></i>
                <ul class="category__item-list">
                    @foreach($productType as $idProductType => $valueProductType)
                        @if($valueCategory->id == $valueProductType->idCategory)
                            <li class="category__item-list-item">
                                <a href="#" idProductType="{{ $valueProductType->id }}" class="category__list-item-link">{{ $valueProductType->name}}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>           
            </li>
            @endif
        @endforeach
        <li class="category-item category__item-hover category-item-list">
            <a href="#"   class="category-item__link">Dịch vụ</a>
        </li>
        <!-- category-item--active -->
    </ul>
</nav>

