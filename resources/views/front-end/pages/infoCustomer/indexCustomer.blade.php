@extends('front-end.layouts.main')

@section('title')
    Thông tin tài khoản
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('assets/front-end/css/infoCustomer.css') }}">
<div class="grid wide">
    <div class="row sm-gutter mt-app">
        <div class="col l-2">
            <div class="userpage-sidebar">
                <div class="user-page-brief">
                    <a class="user-page-brief__avatar" href="{{ route('customer.index') }}">
                        <div class="tickid-avatar">
                            <div class="tickid-avatar__placeholder">
                                <figure class="figure tickid-avatar__image">
                                    @if(empty($user->avatar))
                                    <img src="https://via.placeholder.com/150">
                                    @else
                                    <div class="avatar-uploader__avatar-image js-avatar" style="background-image: url(http://kanestore.com/assets/img/upload/avatar/{{ $user->avatar }});"></div>
                                    @endif
                                </figure>
                            </div>
                        </div>
                    </a>
                    <div class="user-page-brief__right">
                        <div class="user-page-brief__username">{{ $user->name}}</div>
                        <div>
                            <a class="user-page-brief__edit" href="{{ route('customer.index') }}">
                                <svg width="12" height="12" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg" style="margin-right: 4px;">
                                    <path d="M8.54 0L6.987 1.56l3.46 3.48L12 3.48M0 8.52l.073 3.428L3.46 12l6.21-6.18-3.46-3.48" fill="#9B9B9B" fill-rule="evenodd"></path>
                                </svg>Sửa hồ sơ</a>
                        </div>
                    </div>
                </div>
                <div class="userpage-sidebar-menu">
                    <div class="stardust-dropdown stardust-dropdown--open">
                        <div class="stardust-dropdown__item-header">
                            <a class="userpage-sidebar-menu-entry" href="{{ route('customer.index') }}">
                                <div class="userpage-sidebar-menu-entry__icon" style="background-color: rgb(255, 193, 7);">
                                    <svg class="tickid-svg-icon user-page-sidebar-icon icon-headshot" enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0">
                                        <g>
                                            <circle cx="7.5" cy="4.5" fill="none" r="3.8" stroke-miterlimit="10"></circle>
                                            <path d="m1.5 14.2c0-3.3 2.7-6 6-6s6 2.7 6 6" fill="none" stroke-linecap="round" stroke-miterlimit="10"></path>
                                        </g>
                                    </svg>
                                </div>
                                <div class="userpage-sidebar-menu-entry__text">Tài khoản của tôi</div>
                            </a>
                        </div>
                    </div>
                    <a class="userpage-sidebar-menu-entry " href="{{ route('customer.purchased',['key'=>'all']) }}">
                        <div class="userpage-sidebar-menu-entry__icon" style="background-color: rgb(68, 181, 255);">
                            <svg class="tickid-svg-icon user-page-sidebar-icon " enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0" style="fill: rgb(255, 255, 255);">
                                <g>
                                    <rect fill="none" height="10" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" width="8" x="4.5" y="1.5"></rect>
                                    <polyline fill="none" points="2.5 1.5 2.5 13.5 12.5 13.5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"></polyline>
                                    <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="6.5" x2="10.5" y1="4" y2="4"></line>
                                    <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="6.5" x2="10.5" y1="6.5" y2="6.5"></line>
                                    <line fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="6.5" x2="10.5" y1="9" y2="9"></line>
                                </g>
                            </svg>
                        </div>
                        <div class="userpage-sidebar-menu-entry__text">Đơn Mua</div>
                    </a>
                    <a class="userpage-sidebar-menu-entry " href="{{ route('customer.address') }}">
                        <div class="userpage-sidebar-menu-entry__icon" style="background-color: rgb(238, 77, 45);">
                            <!-- <svg class="tickid-svg-icon user-page-sidebar-icon " enable-background="new 0 0 15 15" viewBox="0 0 15 15" x="0" y="0">
                                <g>
                                    <path d="m12 10.2 1.5 2h-12l1.5-2v-7.4c0-.5.5-1 1-1h7c .6 0 1 .5 1 1z" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"></path>
                                    <path d="m6 2c0-.8.7-1.5 1.5-1.5s1.5.7 1.5 1.5" fill="none" stroke-miterlimit="10"></path>
                                    <path d="m5.8 13.5c.4.6 1 1 1.8 1s1.4-.4 1.8-1z"></path>
                                </g>
                            </svg> -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" id="Layer_1"  viewBox="0 0 128 128" data-name="Layer 1"><path d="m78.761 51.236a12.211 12.211 0 1 0 -12.21-12.21 12.224 12.224 0 0 0 12.21 12.21zm0-20.921a8.711 8.711 0 1 1 -8.71 8.711 8.72 8.72 0 0 1 8.71-8.712z"/><path d="m112.5 110.75h-19.1v-39.186l5.127 2.716a1.75 1.75 0 0 0 1.639-3.093l-11.282-5.974c6.866-7.406 15.152-18.031 15.152-26.188a25.275 25.275 0 1 0 -50.55 0c0 4.587 2.626 9.956 6.142 15.095l-31.8 17.063a1.75 1.75 0 1 0 1.655 3.084l5.082-2.727v39.21h-19.065a1.75 1.75 0 0 0 0 3.5h97a1.75 1.75 0 0 0 0-3.5zm-33.739-93.5a21.8 21.8 0 0 1 21.775 21.775c0 4.88-3.911 11.987-11.312 20.553a140.4 140.4 0 0 1 -10.463 10.791 140.587 140.587 0 0 1 -10.461-10.791c-7.4-8.565-11.311-15.673-11.311-20.553a21.8 21.8 0 0 1 21.772-21.775zm-40.693 52.411 23.624-12.676a131.088 131.088 0 0 0 15.908 17.063 1.75 1.75 0 0 0 2.313 0c.321-.283 3-2.662 6.46-6.2l3.527 1.862v41.04h-14.711v-17.9a1.75 1.75 0 0 0 -1.75-1.75h-18.915a1.75 1.75 0 0 0 -1.75 1.75v17.9h-14.706zm33.621 41.089h-15.415v-16.15h15.415z"/></svg>
                        </div>
                        <div class="userpage-sidebar-menu-entry__text">Địa chỉ</div>
                    </a>


                    <a class="userpage-sidebar-menu-entry " href="/change-pass-user">
                        <div class="userpage-sidebar-menu-entry__icon" style="background-color: rgb(68, 181, 255);">
                            <svg viewBox="0 0 512 512" class="tickid-svg-icon user-page-sidebar-icon" x="0" y="0" style="fill: rgb(255, 255, 255);">
                                <g id="outline">
                                    <path d="M97.276,83.073,82.6,79.405a3.439,3.439,0,0,1-.7-6.411,13.7,13.7,0,0,1,12.2,0l6.323,3.161a8,8,0,0,0,7.156-14.31l-6.323-3.162A29.273,29.273,0,0,0,96,56.671V45H80V56.671a29.273,29.273,0,0,0-5.255,2.012,19.438,19.438,0,0,0,3.979,36.244L93.4,98.6a3.439,3.439,0,0,1,.7,6.411,13.708,13.708,0,0,1-12.2,0l-6.323-3.161a8,8,0,0,0-7.156,14.31l6.323,3.162A29.273,29.273,0,0,0,80,121.329V133H96V121.329a29.273,29.273,0,0,0,5.255-2.012,19.438,19.438,0,0,0-3.979-36.244Z"></path>
                                    <path d="M424,352a71.633,71.633,0,0,0-44.906,15.781l-21.437-21.438-.845.845a135.733,135.733,0,0,0,.794-181.481l21.488-21.488a72.118,72.118,0,1,0-11.313-11.313l-21.488,21.488a135.718,135.718,0,0,0-180.586,0l-21.488-21.488a72.118,72.118,0,1,0-11.313,11.313l21.488,21.488a135.718,135.718,0,0,0,0,180.586l-21.488,21.488a72.118,72.118,0,1,0,11.313,11.313l21.488-21.488a135.733,135.733,0,0,0,181.481-.794l-.845.845,21.438,21.437A71.959,71.959,0,1,0,424,352Zm0-320a56,56,0,1,1-56,56A56.064,56.064,0,0,1,424,32ZM88,144a56,56,0,1,1,56-56A56.064,56.064,0,0,1,88,144Zm0,336a56,56,0,1,1,56-56A56.064,56.064,0,0,1,88,480ZM256,376A120,120,0,1,1,376,256,120.136,120.136,0,0,1,256,376ZM424,480a56,56,0,1,1,56-56A56.064,56.064,0,0,1,424,480Z"></path>
                                    <path d="M97.276,419.073,82.6,415.405a3.439,3.439,0,0,1-.7-6.411,13.7,13.7,0,0,1,12.2,0l6.323,3.161a8,8,0,1,0,7.156-14.31l-6.323-3.162A29.273,29.273,0,0,0,96,392.671V381H80v11.671a29.273,29.273,0,0,0-5.255,2.012,19.438,19.438,0,0,0,3.979,36.244L93.4,434.6a3.439,3.439,0,0,1,.7,6.411,13.708,13.708,0,0,1-12.2,0l-6.323-3.161a8,8,0,1,0-7.156,14.31l6.323,3.162A29.273,29.273,0,0,0,80,457.329V469H96V457.329a29.273,29.273,0,0,0,5.255-2.012,19.438,19.438,0,0,0-3.979-36.244Z"></path>
                                    <path d="M414.724,94.927,429.4,98.6a3.439,3.439,0,0,1,.7,6.411,13.708,13.708,0,0,1-12.2,0l-6.323-3.161a8,8,0,0,0-7.156,14.31l6.323,3.162A29.273,29.273,0,0,0,416,121.329V133h16V121.329a29.273,29.273,0,0,0,5.255-2.012,19.438,19.438,0,0,0-3.979-36.244L418.6,79.405a3.439,3.439,0,0,1-.7-6.411,13.7,13.7,0,0,1,12.2,0l6.323,3.161a8,8,0,1,0,7.156-14.31l-6.323-3.162A29.273,29.273,0,0,0,432,56.671V45H416V56.671a29.273,29.273,0,0,0-5.255,2.012,19.438,19.438,0,0,0,3.979,36.244Z"></path>
                                    <path d="M433.276,419.073,418.6,415.405a3.439,3.439,0,0,1-.7-6.411,13.7,13.7,0,0,1,12.2,0l6.323,3.161a8,8,0,0,0,7.156-14.31l-6.323-3.162A29.273,29.273,0,0,0,432,392.671V381H416v11.671a29.273,29.273,0,0,0-5.255,2.012,19.438,19.438,0,0,0,3.979,36.244L429.4,434.6a3.439,3.439,0,0,1,.7,6.411,13.708,13.708,0,0,1-12.2,0l-6.323-3.161a8,8,0,1,0-7.156,14.31l6.323,3.162A29.273,29.273,0,0,0,416,457.329V469h16V457.329a29.273,29.273,0,0,0,5.255-2.012,19.438,19.438,0,0,0-3.979-36.244Z"></path>
                                    <path d="M289,232a32.992,32.992,0,1,0-31.533-23.263l-34.281,22.854a33,33,0,1,0,0,48.818l34.281,22.854a33.086,33.086,0,1,0,8.314-13.687L232.073,267.1a32.956,32.956,0,0,0,0-22.208l33.708-22.472A32.894,32.894,0,0,0,289,232Zm0-50a17,17,0,1,1-17,17A17.019,17.019,0,0,1,289,182Zm-88,91a17,17,0,1,1,17-17A17.019,17.019,0,0,1,201,273Zm88,23a17,17,0,1,1-17,17A17.019,17.019,0,0,1,289,296Z"></path>
                                </g>
                            </svg>
                        </div>
                        <div class="userpage-sidebar-menu-entry__text">Đổi mật khẩu</div>
                    </a>

                </div>
            </div>
        </div>

        @yield('infoCustomer')

    </div>
</div>
@endsection