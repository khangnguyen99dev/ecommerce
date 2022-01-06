@extends('front-end.pages.infoCustomer.indexCustomer')

@section('infoCustomer')

<div class="col l-10">
    <div class="user-page__content">
        <div class="h25IfI">
            <div class="my-account-section">
                <div class="my-account-section__header">
                    <div class="my-account-section__header-left">
                        <div class="my-account-section__header-title">Địa chỉ của tôi</div>
                    </div>
                    <div class="my-account-section__header-right">
                        <button type="submit" class="home-filter__btn btn btn--primary" id="add-address" >Thêm địa chỉ mới</button>
                    </div>
                </div>
                <div class="address_cards">
                @foreach($user->Customer as $address) 
                    <div class="address-card">
                        <div class="address-display__left">
                            <div class="address-display__field-container">
                                <div class="address-display__field-label">Tên</div>
                                <div class="address-display__field-content">
                                    <span class="address-display__name-text">{{ $address->name }}</span>
                                    @if($address->active == 1)
                                        <div class="bacc-default-badge">Mặc định</div>
                                    @endif
                                </div>
                            </div>
                            <div class="address-display__field-container">
                                <div class="address-display__field-label">Điện thoại</div>
                                <div class="address-display__field-content">{{ $address->phone }}</div>
                            </div>
                            <div class="address-display__field-container">
                                <div class="address-display__field-label">Địa chỉ</div>
                                <div class="address-display__field-content">{{ $address->address }}, {{ $address->ward->name }} ,{{ $address->district->name }}, {{ $address->city->name }}</div>
                            </div>
                        </div>
                        <div class="address-card__buttons">
                            <div class="address-card__button-group">
                            
                                <button type="button" class="bacc-secondary-action-btn btn-address-edit js-btn-edit" data-id="{{ $address->id }}" data-name="{{ $address->name }}" data-phone="{{ $address->phone }}" data-address="{{ $address->address }}" data-idcity="{{$address->city->id}}" data-idistrict="{{$address->district->id}}" data-idward="{{$address->ward->id}}">Sửa</button>
                                <button type="button" class="bacc-secondary-action-btn btn-address-delete js-btn-delete" data-id="{{ $address->id }}">Xóa</button>
                            </div>
                            <div class="address-card__button-group">
                                <button type="button" class="btn-address js-default-address" aria-disabled="false" data-id="{{ $address->id }}">Thiết lập mặc định</button>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('front-end.pages.infoCustomer.modalAddress')

@include('front-end.pages.infoCustomer.modalEditAddress')

<script>
$(document).on('click', '#add-address', function (e) {
    $('#addAddress').css('display','flex');
    $('.modal__body').show();  
})

$('.modal__overlay').on('click',()=>{
    $('.modal').hide();
})

$('.auth-form__controls-back').on('click', ()=> {
    $('.modal').hide();
})

$(document).on('click', '.js-btn-edit', function (e) {

    $('#editAddress').css('display','flex');
    $('.modal__body').show(); 
    
    let id = $(this).data('id');

    let name = $(this).data('name');

    let phone = $(this).data('phone');

    let address = $(this).data('address');

    let idCity = $(this).data('idcity');

    let idDistrict = $(this).data('idistrict');

    let idWard = $(this).data('idward');

    $.ajax({
        type: 'POST',
        url: 'showEditAddress',
        data: {
            idCity:idCity,
            idDistrict:idDistrict,
            idWard:idWard
        },
        success: (data)=>{
            

            let city = data.city;
            let district = data.district;
            let ward = data.ward;

            let htmlCity = '';
            let htmlDistrict = '';
            let htmlWard = '';

            city.map((value)=> {
                htmlCity += `<option value="${value.id.toString().padStart(2,'0')}">${value.name}</option>`;
            })

            district.map((value)=> {
                htmlDistrict += `<option value="${value.id.toString().padStart(3,'0')}">${value.name}</option>`;
            })

            ward.map((value)=> {
                htmlWard += `<option value="${value.id.toString().padStart(5,'0')}">${value.name}</option>`;
            })

            $('#cityEdit').html(htmlCity);
            $('#districtEdit').html(htmlDistrict);
            $('#wardEdit').html(htmlWard);

            $('#cityEdit').val(idCity.toString().padStart(2,'0'));
            $('#districtEdit').val(idDistrict.toString().padStart(3,'0'));
            $('#wardEdit').val(idWard.toString().padStart(5,'0'));

        }
    })

    $('#addressEdit-form').attr('data-id',id);
    $('#nameEdit').val(name);
    $('#phoneEdit').val(phone);
    $('#addressEdit').val(address);
})


$(document).on('click', '.js-btn-delete', function (e) {
    toastr.options = {
        "debug": false,
        "positionClass": "toast-top-center",
        "onclick": null,
        "fadeIn": 300,
        "fadeOut": 1000,
        "timeOut": 1000,
        "extendedTimeOut": 2000
    } 
    let id = $(this).data('id');
    $.ajax({
        type: 'DELETE',
        url: 'customer/'+id,
        data: id,
        success: (data)=> {
            if(data.error) {
                toastr["info"](data.error);
            }else{
                location.reload();
            }
        }
    })
})

$(document).on('change', '.js-chooseEdit', function (e) {
    let action = $(this).attr('id');
    let id = $(this).val();
    let result = '';
    if(action == 'cityEdit') {
        result = 'districtEdit';
        $('#wardEdit').html(`<option value="">-- Chọn Phường / Xã --</option>`);
    }else{
        result = 'wardEdit';
    }
    $.ajax({
        type: 'POST',
        url: 'chooseAddressEdit',
        data: {
            action:action,
            id:id
        },
        success: (data)=>{
            $('#'+result).html(data.address);
        }
    })

})

$('#btn-address').on('click', (e)=> {
        let name = $('#name').val();
        let phone = $('#phone').val();
        let address = $('#address').val();
        let idCity = $('#city').val();
        let idDistrict = $('#district').val();
        let idWard = $('#ward').val();

        let check = 0;
        if($('#check-default')[0].checked){
            check = 1;
        }
        $.ajax({
            type: 'POST',
            url:'addAddress',
            data: {
                'name': name,
                'phone': phone,
                'address': address,
                'active': check,
                'idCity': idCity,
                'idDistrict': idDistrict,
                'idWard': idWard,
            },
            success: (data)=> {
                location.reload();
            }
        })
        
    })

$(document).on('click', '.js-default-address', function (e) {
    let id = $(this).data('id');
    $.ajax({
        type: 'POST',
        url: 'defaultAddress',
        data: {id:id},
        success: (data) => {
            location.reload();
        }
    })
})

$(document).on('change', '.choose', function (e) {
    let action = $(this).attr('id');
    let idCity = $(this).val();
    let result = '';
    if(action == 'city') {
        result = 'district';
        let html = `<option value="" selected="selected">--Chọn Phường / Xã--</option>`;
        $('#ward').html(html);
        $('#ward').attr('selected','false');
    }else{
        result = 'ward';
    }
    $.ajax({
        type: 'POST',
        url: '/chooseaddress',
        data: {
            action:action,
            idCity:idCity
        },
        success: (data)=>{
            $('#'+result).html(data.address);
        }
    })
})

$(document).on('submit', '#addressEdit-form', function (e) {
    e.preventDefault();

    let form = new FormData(this);

    let id = $(this).data('id');

    $.ajax({
        type: 'POST',
        url: 'customer/'+id,
        data: form,
        cache:false,
        contentType: false,
        processData: false,
        success: (data)=>{
            location.reload();
        }
    })
})
</script>
@endsection