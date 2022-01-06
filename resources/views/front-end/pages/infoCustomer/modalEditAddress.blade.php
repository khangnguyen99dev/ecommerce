<div class="modal" id="editAddress">
    <div class="modal__overlay"></div>
    <div class="modal__body">
        <form id="addressEdit-form" class="auth-form">
            @csrf
            <div class="auth-form__container">
                <div class="auth-form__header">
                    <h3 class="auth-form__heading">Chỉnh sửa địa chỉ nhận hàng</h3>
                </div>
                <div class="auth-form__groups">
                    <div class="auth-form__group">
                        <!-- <label for="name" class="auth-form__label">Tên</label> -->
                        <input name="name" class="auth-form__input" placeholder="Nhập tên của bạn" id="nameEdit" type="text" />
                    </div>
                    <div class="auth-form__group">
                        <!-- <label for="phone" class="auth-form__label">Số điện thoại</label> -->
                        <input name="phone" class="auth-form__input" placeholder="Số điện thoại..." id="phoneEdit" type="text" />
                    </div>
                    <div class="auth-form__group">
                        <select name="idCity" id="cityEdit" size="1" class="js-chooseEdit city selectaddress">
                        </select>
                    </div>
                    <div class="auth-form__group">
                        <select name="idDistrict" id="districtEdit" size="1" class="js-chooseEdit district selectaddress">
                        </select>
                    </div>
                    <div class="auth-form__group">
                        <select name="idWard" id="wardEdit" size="1" class="ward selectaddress">
                        </select>
                    </div>
                    <div class="auth-form__group">
                        <input name="address" class="auth-form__input" placeholder="Tòa nhà / Tên đường..." id="addressEdit" type="text" />
                    </div>
                    <div class="auth-form__controls auth-form__controls-last">
                        <span class="btn auth-form__controls-back">TRỞ LẠI</span>
                        <button class="btn btn--primary" type="submit">HOÀN THÀNH</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>