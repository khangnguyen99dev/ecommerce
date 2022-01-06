@extends('front-end.pages.infoCustomer.indexCustomer')

@section('infoCustomer')
<div class="col l-10">
    <div class="user-page__content">
        <div class="h25IfI">
            <div class="my-account-section">
                <div class="my-account-section__header">
                    <div class="my-account-section__header-left">
                        <div class="my-account-section__header-title">Hồ sơ của tôi</div>
                        <div class="my-account-section__header-subtitle">Quản lý thông tin hồ sơ để bảo mật tài khoản</div>
                    </div>
                </div>
                <form class="my-account-profile-form">
                    <div class="my-account-profile">
                        <div class="my-account-profile__left">
                            <div class="input-with-label">
                                <div class="input-with-label__wrapper">
                                    <div class="input-with-label__label">
                                        <label>Tên</label>
                                    </div>
                                    <div class="input-with-label__content">
                                        <div class="input-with-validator-wrapper">
                                            <div class="input-with-validator">
                                                <input type="text" name="name" placeholder="Họ và tên" value="{{ $user->name }}" id="name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-with-label">
                                <div class="input-with-label__wrapper">
                                    <div class="input-with-label__label">
                                        <label>Email</label>
                                    </div>
                                    <div class="input-with-label__content">
                                        <div class="my-account__inline-container">
                                            <div class="my-account__input-text">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-with-label">
                                <div class="input-with-label__wrapper">
                                    <div class="input-with-label__label">
                                        <label>Giới tính</label>
                                    </div>
                                    <div class="input-with-label__content">
                                        <div class="my-account-profile__gender">
                                            <div class="stardust-radio-group">
                                                <div class="stardust-radio js-gender-radio ">
                                                    <input type="radio" name="gender" class="hidden js-input-radio" value="1" {{ ($user->gender == 1) ? "checked" : false}}>
                                                    <div class="stardust-radio-button ">
                                                        <div class="stardust-radio-button__outer-circle">
                                                            <div class="stardust-radio-button__inner-circle"></div>
                                                        </div>
                                                    </div>
                                                    <div class="stardust-radio__content">
                                                        <div class="stardust-radio__label">Nam</div>
                                                    </div>
                                                </div>
                                                <div class="stardust-radio js-gender-radio ">
                                                    <input type="radio" name="gender" class="hidden js-input-radio" value="2" {{ ($user->gender == 2) ? "checked" : false}}>
                                                    <div class="stardust-radio-button ">
                                                        <div class="stardust-radio-button__outer-circle">
                                                            <div class="stardust-radio-button__inner-circle"></div>
                                                        </div>
                                                    </div>
                                                    <div class="stardust-radio__content">
                                                        <div class="stardust-radio__label">Nữ</div>
                                                    </div>
                                                </div>
                                                <div class="stardust-radio js-gender-radio ">
                                                    <input type="radio" name="gender" class="hidden js-input-radio" value="3" {{ ($user->gender == 3) ? "checked" : false}}>
                                                    <div class="stardust-radio-button ">
                                                        <div class="stardust-radio-button__outer-circle">
                                                            <div class="stardust-radio-button__inner-circle"></div>
                                                        </div>
                                                    </div>
                                                    <div class="stardust-radio__content">
                                                        <div class="stardust-radio__label">Khác</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="input-with-label">
                                <div class="input-with-label__wrapper">
                                    <div class="input-with-label__label">
                                        <label>Điện thoại</label>
                                    </div>
                                    <div class="input-with-label__content">
                                        <div class="input-with-validator-wrapper">
                                            <div class="input-with-validator">
                                                <input type="text" name="phone" id="phone" placeholder="Số điện thoại" value="{{ $user->phone }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="input-with-label">
                                        <div class="input-with-label__wrapper">
                                            <div class="input-with-label__label">
                                                <label>Ngày sinh</label>
                                            </div>
                                            <div class="input-with-label__content">
                                                <div class="_2AC_Jd">
                                                    <div class="tickid-dropdown tickid-dropdown--has-selected js-tickid-dropdown" type="date">
                                                        <div class="tickid-dropdown__entry tickid-dropdown__entry--selected js-dropdown-entry">
                                                            <span class="js-dropdown-current"></span>
                                                            <svg class="tickid-svg-icon icon-arrow-down" enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0">
                                                                <g>
                                                                    <path d="m11 2.5c0 .1 0 .2-.1.3l-5 6c-.1.1-.3.2-.4.2s-.3-.1-.4-.2l-5-6c-.2-.2-.1-.5.1-.7s.5-.1.7.1l4.6 5.5 4.6-5.5c.2-.2.5-.2.7-.1.1.1.2.3.2.4z"></path>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                        <div class="tickid-popover tickid-popover--default js-dropdown-popover">
                                                            <ul class="tickid-dropdown__options">

                                                                <li class="tickid-dropdown__entry tickid-dropdown__entry--optional js-dropdown-option" value="1">
                                                                    <div class="tickid-dropdown__entry-content js-dropdown-option-content">1</div>
                                                                </li>

                                                                <li class="tickid-dropdown__entry tickid-dropdown__entry--optional js-dropdown-option" value="2">
                                                                    <div class="tickid-dropdown__entry-content js-dropdown-option-content">2</div>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="tickid-dropdown tickid-dropdown--has-selected js-tickid-dropdown" type="month">
                                                        <div class="tickid-dropdown__entry tickid-dropdown__entry--selected js-dropdown-entry">
                                                            <span class="js-dropdown-current"></span>
                                                            <svg class="tickid-svg-icon icon-arrow-down" enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0">
                                                                <g>
                                                                    <path d="m11 2.5c0 .1 0 .2-.1.3l-5 6c-.1.1-.3.2-.4.2s-.3-.1-.4-.2l-5-6c-.2-.2-.1-.5.1-.7s.5-.1.7.1l4.6 5.5 4.6-5.5c.2-.2.5-.2.7-.1.1.1.2.3.2.4z"></path>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                        <div class="tickid-popover tickid-popover--default js-dropdown-popover">
                                                            <ul class="tickid-dropdown__options">
                                                                <li class="tickid-dropdown__entry tickid-dropdown__entry--optional js-dropdown-option" value="1">
                                                                    <div class="tickid-dropdown__entry-content js-dropdown-option-content">Tháng 1</div>
                                                                </li>
                                                                <li class="tickid-dropdown__entry tickid-dropdown__entry--optional js-dropdown-option" value="2">
                                                                    <div class="tickid-dropdown__entry-content js-dropdown-option-content">Tháng 2</div>
                                                                </li>
                                                                <li class="tickid-dropdown__entry tickid-dropdown__entry--optional js-dropdown-option" value="3">
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="tickid-dropdown tickid-dropdown--has-selected js-tickid-dropdown" type="year">
                                                        <div class="tickid-dropdown__entry tickid-dropdown__entry--selected js-dropdown-entry">
                                                            <span class="js-dropdown-current"></span>
                                                            <svg class="tickid-svg-icon icon-arrow-down" enable-background="new 0 0 11 11" viewBox="0 0 11 11" x="0" y="0">
                                                                <g>
                                                                    <path d="m11 2.5c0 .1 0 .2-.1.3l-5 6c-.1.1-.3.2-.4.2s-.3-.1-.4-.2l-5-6c-.2-.2-.1-.5.1-.7s.5-.1.7.1l4.6 5.5 4.6-5.5c.2-.2.5-.2.7-.1.1.1.2.3.2.4z"></path>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                        <div class="tickid-popover tickid-popover--default js-dropdown-popover">
                                                            <ul class="tickid-dropdown__options">
                                                                <li class="tickid-dropdown__entry tickid-dropdown__entry--optional js-dropdown-option" value="2021">
                                                                    <div class="tickid-dropdown__entry-content js-dropdown-option-content">2021</div>
                                                                </li>
                                                                <li class="tickid-dropdown__entry tickid-dropdown__entry--optional js-dropdown-option" value="2020">
                                                                    <div class="tickid-dropdown__entry-content js-dropdown-option-content">2020</div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                            <div class="my-account-page__submit">
                                <button type="submit" class="home-filter__btn btn btn--primary" id="save-info">Lưu</button>
                            </div>
                        </div>
                        <div class="my-account-profile__right">
                            <div class="avatar-uploader">
                                <div class="avatar-uploader__avatar">
                                    @if(empty($user->avatar))
                                    <div class="avatar-uploader__avatar-image js-avatar" id="avatar-image" style="background-image: url(https://img.abaha.vn/images/default.png);"></div>
                                    @else
                                    <div class="avatar-uploader__avatar-image js-avatar" id="avatar-image" style="background-image: url(http://kanestore.com/assets/img/upload/avatar/{{ $user->avatar }});"></div>
                                    @endif
                                </div>
                                <input id="input-image" class="avatar-uploader__file-input js-input-sl-image" name="avatar" type="file" accept=".jpg,.jpeg,.png">
                                <button type="button" class="btn btn-light btn--m btn--inline" id="choose-image">Chọn ảnh</button>
                                <div class="avatar-uploader__text-container">
                                    <div class="avatar-uploader__text">Dụng lượng file tối đa 1 MB</div>
                                    <div class="avatar-uploader__text">Định dạng:.JPEG, .PNG</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#choose-image', function (e) {
        $('#input-image').click();
    })


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();     
            reader.onload = function(e) {
                $('#avatar-image').attr('style',`background-image: url(${e.target.result})`);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#input-image").change(function() {
        readURL(this);
    });

    $(document).on('click', '#save-info', function (e) {
        e.preventDefault();
        toastr.options = {
            "debug": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 1000,
            "extendedTimeOut": 2000
        }     
        let name = $('#name').val();

        if(name.length == 0) {
            toastr["info"]('Tên không được để trống!');
        }else if(name.length <= 3) {
            toastr["info"]('Tên không hợp lệ!');
        }else {
            let frm = new FormData();

            let gender = $('input[name=gender]:checked').val();

            let phone = $('#phone').val();    
            let avatar = $('#input-image')[0].files[0];


            frm.append('phone',phone);
            frm.append('avatar',avatar);
            frm.append('gender',gender);
            frm.append('name',name);
            $.ajax({
                type: 'POST',
                url: 'customer',
                dataType: 'JSON',
                data: frm,
                processData: false,
                contentType: false,
                success: (data) => {
                    toastr["info"]('Cập nhật thành công!');
                    location.reload();
                }
            })
        }
    })

</script>
@endsection