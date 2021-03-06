<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/front-end/CSS/base.css" />
<link rel="stylesheet" type="text/css" href="assets/front-end/CSS/main.css" />
<link rel="stylesheet" type="text/css" href="assets/front-end/CSS/validator.css" />
<link rel="stylesheet" href="{{ asset('assets/css/toastr.css')}}">
<div class="modal" style="display: flex">
    <div class="modal__overlay" style="display: block"></div>

    <div class="modal__body">
        <!-- Login Form -->
        <form id="login-form" style="display: block" class="auth-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="auth-form__container">
                <div class="auth-form__header">
                    <h3 class="auth-form__heading">Đăng nhập</h3>
                    <a href="{{route('register')}}" class="auth-form__switch-btn">Đăng ký</a>
                </div>

                <div class="auth-form__groups">
                    <div class="auth-form__group form-group">
                        <label for="email" class="auth-form__label">Email</label>
                        <input class="auth-form__input" rules="required|email|check_mail_login" placeholder="Email của bạn" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                        <span class="form-message"></span>
                    </div>
                    <div class="auth-form__group form-group">
                        <label for="password" class="auth-form__label">Mật khẩu</label>
                        <input class="auth-form__input" rules="required|min:6" placeholder="Mật khẩu của bạn" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                        <span class="form-message"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Nhớ mật khẩu') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="auth-form__aside">
                    <div class="auth-form__help">
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="auth-form__help-link auth-form__help-forgot">Quên mật khẩu</a> @endif
                    </div>
                </div>

                <div class="auth-form__controls">
                    <a href="{{route('home')}}" class="btn auth-form__controls-back">TRỞ LẠI</a>
                    <!-- <button class="btn auth-form__controls-back">TRỞ LẠI</button> -->
                    <button class="btn btn--primary" type="submit">ĐĂNG NHẬP</button>
                </div>
            </div>


            <div class="auth-form__socials">
                <a href="{{ url('/auth/redirect/facebook') }}" class="auth-form__socials--facebook btn btn--size-s btn--with-icon">
                    <i class="auth-form__socials-icon fab fa-facebook-square"></i>
                    <span class="auth-form__socials-title">
				Kết nối với Facebook
			</span>
                </a>
                <a href="" class="auth-form__socials--google btn btn--size-s btn--with-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" enable-background="new 0 0 512 512" height="24" viewBox="0 0 512 512" width="24">
                        <g>
                            <path d="m120 256c0-25.367 6.989-49.13 19.131-69.477v-86.308h-86.308c-34.255 44.488-52.823 98.707-52.823 155.785s18.568 111.297 52.823 155.785h86.308v-86.308c-12.142-20.347-19.131-44.11-19.131-69.477z" fill="#fbbd00" />
                            <path d="m256 392-60 60 60 60c57.079 0 111.297-18.568 155.785-52.823v-86.216h-86.216c-20.525 12.186-44.388 19.039-69.569 19.039z" fill="#0f9d58" />
                            <path d="m139.131 325.477-86.308 86.308c6.782 8.808 14.167 17.243 22.158 25.235 48.352 48.351 112.639 74.98 181.019 74.98v-120c-49.624 0-93.117-26.72-116.869-66.523z" fill="#31aa52" />
                            <path d="m512 256c0-15.575-1.41-31.179-4.192-46.377l-2.251-12.299h-249.557v120h121.452c-11.794 23.461-29.928 42.602-51.884 55.638l86.216 86.216c8.808-6.782 17.243-14.167 25.235-22.158 48.352-48.353 74.981-112.64 74.981-181.02z" fill="#3c79e6" />
                            <path d="m352.167 159.833 10.606 10.606 84.853-84.852-10.606-10.606c-48.352-48.352-112.639-74.981-181.02-74.981l-60 60 60 60c36.326 0 70.479 14.146 96.167 39.833z" fill="#cf2d48" />
                            <path d="m256 120v-120c-68.38 0-132.667 26.629-181.02 74.98-7.991 7.991-15.376 16.426-22.158 25.235l86.308 86.308c23.753-39.803 67.246-66.523 116.87-66.523z" fill="#eb4132" />
                        </g>
                    </svg>
                    <span class="auth-form__socials-title">
				Kết nối với Google
			</span>
                </a>
            </div>
        </form>

    </div>
</div>
<script src="{{ asset('assets/js/toastr.min.js')}}"></script>
@if(isset($error))
<script>
    toastr.options = {
        "debug": false,
        "positionClass": "toast-top-center",
        "onclick": null,
        "fadeIn": 300,
        "fadeOut": 1000,
        "timeOut": 1000,
        "extendedTimeOut": 2000
    }
    toastr["info"]('{{$error}}');    
</script>
@endif
<script src="{{ asset('assets/js/Validator.js') }}"></script>
<script>
    Validator('#login-form');
</script>