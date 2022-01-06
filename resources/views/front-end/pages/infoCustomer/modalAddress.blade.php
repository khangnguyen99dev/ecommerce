<div class="modal" id="addAddress">
    <div class="modal__overlay"></div>
    <div class="modal__body">
        <form id="address-form" class="auth-form">
            @csrf
            <div class="auth-form__container">
                <div class="auth-form__header">
                    <h3 class="auth-form__heading">Thêm địa chỉ nhận hàng</h3>
                </div>
                <div class="auth-form__groups">
                    <div class="auth-form__group">
                        <!-- <label for="name" class="auth-form__label">Tên</label> -->
                        <input class="auth-form__input" placeholder="Nhập tên của bạn" id="name" type="text" />
                    </div>
                    <div class="auth-form__group">
                        <!-- <label for="phone" class="auth-form__label">Số điện thoại</label> -->
                        <input class="auth-form__input" placeholder="Số điện thoại..." id="phone" type="text" />
                    </div>
                    <div class="auth-form__group">
                        <select name="city" id="city" size="1" class="choose city selectaddress">
                            <option value="" selected="selected">--Chọn Tỉnh / Thành phố--</option>
                            @foreach($city as $value)
                            <option value="{{str_pad($value->id,2,'0',STR_PAD_LEFT)}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="auth-form__group">
                        <select name="district" id="district" size="1" class="choose district selectaddress">
                            <option value="" selected="selected">--Chọn Quận / Huyện--</option>
                        </select>
                    </div>
                    <div class="auth-form__group">
                        <select name="ward" id="ward" size="1" class="ward selectaddress">
                            <option value="" selected="selected">--Chọn Phường / Xã--</option>
                        </select>
                    </div>
                    <div class="auth-form__group">
                        <input class="auth-form__input" placeholder="Tòa nhà / Tên đường..." id="address" type="text" />
                    </div>
                    <div class="checkbox">
                        <div class="cart-checkbox checkbox-item">
                            <input class="cart-checkbox__input-default" type="checkbox" id="check-default">
                            <div class="cart-checkbox__bgc"></div>
                        </div>
                        <div class="checkbox-default">Đặt làm mặc định</div>
                    </div>
                    <div class="auth-form__controls auth-form__controls-last">
                        <span class="btn auth-form__controls-back">TRỞ LẠI</span>
                        <button class="btn btn--primary" type="button" id="btn-address">TIẾP TỤC</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>