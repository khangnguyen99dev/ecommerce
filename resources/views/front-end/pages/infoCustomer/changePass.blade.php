@extends('front-end.pages.infoCustomer.indexCustomer')

@section('infoCustomer')
<div class="col l-10">
    <div class="user-page__content">
        <div class="h25IfI">
            <div class="my-account-section">
                <div class="my-account-section__header">
                    <div class="my-account-section__header-left">
                        <div class="my-account-section__header-title">Thông tin cá nhân</div>
                        <div class="my-account-section__header-subtitle">Thay đổi mật khẩu</div>
                    </div>
                </div>
                <form class="my-account-profile-form" id="form-change-pass">
                    <div class="my-account-profile">
                        <div class="my-account-profile__left">
                            <div class="input-with-label">
                                <div class="input-with-label__wrapper">
                                    <div class="input-with-label__label">
                                        <label>Nhập mật khẩu cũ</label>
                                    </div>
                                    <div class="input-with-label__content">
                                        <div class="input-with-validator-wrapper">
                                            <div class="input-with-validator">
                                                <input type="password" name="password" placeholder="Mật khẩu cũ" value="" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-with-label">
                                <div class="input-with-label__wrapper">
                                    <div class="input-with-label__label">
                                        <label>Nhập mật khẩu mới</label>
                                    </div>
                                    <div class="input-with-label__content">
                                        <div class="input-with-validator-wrapper">
                                            <div class="input-with-validator">
                                                <input type="password" name="newpass" placeholder="Nhập mật khẩu mới" value="" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-with-label">
                                <div class="input-with-label__wrapper">
                                    <div class="input-with-label__label">
                                        <label>Nhập lại mật khẩu</label>
                                    </div>
                                    <div class="input-with-label__content">
                                        <div class="input-with-validator-wrapper">
                                            <div class="input-with-validator">
                                                <input type="password" name="renewpass" placeholder="Nhập lại mật khẩu mới" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="my-account-page__submit">
                                <button type="submit" class="home-filter__btn btn btn--primary">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('submit', '#form-change-pass', function (e) {
        e.preventDefault();
        $.ajax({
          method: "POST",
          url: "/updatePass",
          data: new FormData(this),
          dataType:'JSON',
          contentType: false,
          cache: false,
          processData: false,
          success: (data) => {
              if(data.error){
                  toastr['info'](data.error);
              }else{
                  toastr['info']('Cập nhật mật khẩu thành công');
                  location.reload();
              }
          }
      })
    })
</script>
@endsection