<!DOCTYPE html>
<html class="no-js" lang="az">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="Malybeili">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }} – @yield('title', 'Milli Azərbaycan Brendi')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('malybeili') }}/assets/images/logo/ico.ico">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/css/swiper.min.css">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="{{ asset('malybeili') }}/assets/css/main.css">

    @toastr_css
    @yield('css')
</head>
<body>

<!-- HEADER MENU====================================== -->
<div class="pageloader">
    <div class="wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="shadow"></div>
        <div class="shadow"></div>
        <div class="shadow"></div>
        <span>Yüklənir</span>
    </div>
</div>
<header class="topbar-section section bg-primary2">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-xl-8 col-md-6 col-sm-6">
                <p class="text-white text-md-left  mail mailB"><a href="tel: +994508004122"><i class="fas fa-phone"></i> (055) 800-41-22</a></p>
                <p class="text-white  mail mailB" style="padding-left: 10px;"><a href="mailto:info@malybeili.az"><i class="far fa-envelope"></i> info@malybeili.az</a></p>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-6">
                <div class="topbar-menu ">
                    <ul>
                        <li ><a class="text-white mail" style="cursor: default !important;"><i class="fas fa-subway"></i>Çatdırılma (N.Nərimanov,Gənclik,28 May,Sahil,İçərişəhər M.)</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<header class="header-section header-menu-center section bg-white d-none d-xl-block">
    <div class="container">
        <div class="row align-items-center">

            <!-- Header Logo Start -->
            <div class="col">
                <div class="header-logo">
                    <a href="{{ route('front.home') }}"><img src="{{ asset('malybeili') }}/assets/images/logo/logobg.png" alt="malybeili Logo"></a>
                </div>
            </div>
            <!-- Header Logo End -->

            <!-- Search Start -->
            <div class="col">
                <nav class="site-main-menu justify-content-center menu-height-60">
                    <ul>
                        <li><a href="{{ route('front.about') }}"><span class="menu-text">{{ __('menus.about') }}</span></a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('menus.products') }}</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                @foreach($categories as $catgory)
                                <li><a class="dropdown-item" href="{{ route('front.products',['category_slug'=>$catgory->{'slug_'.app()->getLocale()}]) }}"><span class="menu-text">{{ $catgory->{'name_'.app()->getLocale()} }}</span></a></li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="pr-5" ><a href="{{ route('front.contact') }}"><span class="menu-text">{{ __('menus.contact') }}</span></a></li>
                    </ul>
                </nav>
            </div>
            <!-- Search End -->

            <!-- Header Tools Start -->
            <div class="col">
                <div class="header-tools justify-content-end">
                    <div class="header-login">
                        @if(!auth()->check())
                        <a href="{{ route('login') }}"><i class="fal fa-user"></i></a>
                        @else
                        <a href="{{ route('logout') }}"><i class="fal fa-user"></i></a>
                        @endif
                    </div>
                    <div class="header-cart">
                        <a href="#offcanvas-cart" class="offcanvas-toggle" onclick="callSebet();"><span class="cart-count productCount">{{ Cookie::get('sebet') == '' ? 0 : count(unserialize(Cookie::get('sebet'))) }}</span><i class="fal fa-shopping-cart"></i></a>
                    </div>
                    <ul class="header-lan-curr">
                        @if(app()->getLocale() == 'az')
                            <li>
                                <a href="javascript:void:(0)">Az</a>
                                <ul class="curr-lan-sub-menu">
                                    <li><a href="{{ route('lang.swithcher',['locale'=>'ru']) }}">Ru</a></li>
                                    <li><a href="{{ route('lang.swithcher',['locale'=>'en']) }}">En</a></li>
                                </ul>
                            </li>
                        @elseif(app()->getLocale() == 'en')
                            <li>
                                <a href="javascript:void:(0)">En</a>
                                <ul class="curr-lan-sub-menu">
                                    <li><a href="{{ route('lang.swithcher',['locale'=>'az']) }}">Az</a></li>
                                    <li><a href="{{ route('lang.swithcher',['locale'=>'ru']) }}">Ru</a></li>
                                </ul>
                            </li>
                        @elseif(app()->getLocale() == 'ru')
                            <li>
                                <a href="javascript:void:(0)">Ru</a>
                                <ul class="curr-lan-sub-menu">
                                    <li><a href="{{ route('lang.swithcher',['locale'=>'az']) }}">Az</a></li>
                                    <li><a href="{{ route('lang.swithcher',['locale'=>'en']) }}">En</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- Header Tools End -->

        </div>
    </div>

</header>

<header class="sticky-header header-menu-center section d-none d-xl-block" data-bg-color="#f4f3ec">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col">
                <div class="header-logo">
                    <a href="{{ route('front.home') }}"><img src="{{ asset('malybeili') }}/assets/images/logo/logobg.png" alt="Malybeili Logo"></a>
                </div>
            </div>
            <div class="col d-none d-xl-block">
                <nav class="site-main-menu justify-content-center menu-height-60">
                    <ul>
                        <li><a href="{{ route('front.about') }}"><span class="menu-text">{{ __('menus.about') }}</span></a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('menus.products') }}</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                @foreach($categories as $catgory)
                                    <li><a class="dropdown-item" href="{{ route('front.products',['category_slug'=>$catgory->{'slug_'.app()->getLocale()}]) }}"><span class="menu-text">{{ $catgory->{'name_'.app()->getLocale()} }}</span></a></li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="pr-5" ><a href="{{ route('front.contact') }}"><span class="menu-text">{{ __('menus.contact') }}</span></a></li>
                    </ul>
                </nav>
            </div>
            <div class="col">
                <div class="header-tools justify-content-end">
                    <div class="header-login">
                        @if(!auth()->check())
                        <a href="{{ route('login') }}"><i class="fal fa-user"></i></a>
                        @else
                            <a href="{{ route('logout') }}"><i class="fal fa-user"></i></a>
                        @endif
                    </div>
                    <div class="header-cart">
                        <a href="#offcanvas-cart" onclick="callSebet();" class="offcanvas-toggle"><span class="cart-count productCount">{{ Cookie::get('sebet') == '' ? 0 : count(unserialize(Cookie::get('sebet'))) }}</span><i class="fal fa-shopping-cart"></i></a>
                    </div>
                    <ul class="header-lan-curr">
                        @if(app()->getLocale() == 'az')
                            <li>
                                <a href="{{ route('lang.swithcher',['locale'=>'az']) }}">Az</a>
                                <ul class="curr-lan-sub-menu">
                                    <li><a href="{{ route('lang.swithcher',['locale'=>'ru']) }}">Ru</a></li>
                                    <li><a href="{{ route('lang.swithcher',['locale'=>'en']) }}">En</a></li>
                                </ul>
                            </li>
                        @elseif(app()->getLocale() == 'en')
                            <li>
                                <a href="{{ route('lang.swithcher',['locale'=>'en']) }}">En</a>
                                <ul class="curr-lan-sub-menu">
                                    <li><a href="{{ route('lang.swithcher',['locale'=>'az']) }}">Az</a></li>
                                    <li><a href="{{ route('lang.swithcher',['locale'=>'ru']) }}">Ru</a></li>
                                </ul>
                            </li>
                        @elseif(app()->getLocale() == 'ru')
                            <li>
                                <a href="{{ route('lang.swithcher',['locale'=>'ru']) }}">Ru</a>
                                <ul class="curr-lan-sub-menu">
                                    <li><a href="{{ route('lang.swithcher',['locale'=>'az']) }}">Az</a></li>
                                    <li><a href="{{ route('lang.swithcher',['locale'=>'en']) }}">En</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<header class="mobile-header bg-white section d-xl-none">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <div class="header-logo">
                    <a href="{{ route('front.home') }}"><img src="{{ asset('malybeili') }}/assets/images/logo/logobg.png" alt="Malybeili Logo"></a>
                </div>
            </div>
            <div class="col-auto">
                <div class="header-tools justify-content-end">

                    <div class="mobile-menu-toggle">
                        <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                            <svg viewBox="0 0 800 600">
                                <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" class="top"></path>
                                <path d="M300,320 L540,320" class="middle"></path>
                                <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" class="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
<header class="mobile-header sticky-header bg-white section d-xl-none">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <div class="header-logo">
                    <a href="{{ route('front.home') }}"><img src="{{ asset('malybeili') }}/assets/images/logo/logobg.png" alt="Malybeili Logo"></a>
                </div>
            </div>
            <div class="col-auto">
                <div class="header-tools justify-content-end">

                    <div class="mobile-menu-toggle">
                        <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                            <svg viewBox="0 0 800 600">
                                <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" class="top"></path>
                                <path d="M300,320 L540,320" class="middle"></path>
                                <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" class="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<header id="offcanvas-mobile-menu" class="offcanvas  offcanvas-mobile-menu">
    <div class="inner customScroll">
        <div class="offcanvas-menu-search-form align-items-center" style="border-bottom: 2px solid #f4f3ec; ">
            <form action>
                <a style="cursor: default; margin-bottom: 30px;"><img src="{{ asset('malybeili') }}/assets/images/logo/logobg.png" alt="Malybeili Logo"></a>
            </form>
        </div>
        <div class="offcanvas-menu">
            <ul>
                <li><a><span class="menu-text">{{ __('menus.products') }}</span></a>
                    <ul class="sub-menu">
                        @foreach($categories as $catgory)
                            <li><a><span class="menu-text">{{ $catgory->{'name_'.app()->getLocale()} }}</span></a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="{{ route('front.about') }}"><span class="menu-text">{{ __('menus.about') }}</span></a></li>
                <li><a href="{{ route('front.contact') }}"><span class="menu-text">{{ __('menus.contact') }}</span></a></li>
            </ul>

        </div>

    </div>

    <ul class="header-lan-curr">
        @if(app()->getLocale() == 'az')
            <li>
                <a href="javascript:void:(0)">Az</a>
                <ul class="curr-lan-sub-menu">
                    <li><a href="{{ route('lang.swithcher',['locale'=>'ru']) }}">Ru</a></li>
                    <li><a href="{{ route('lang.swithcher',['locale'=>'en']) }}">En</a></li>
                </ul>
            </li>
        @elseif(app()->getLocale() == 'en')
            <li>
                <a href="javascript:void:(0)">En</a>
                <ul class="curr-lan-sub-menu">
                    <li><a href="{{ route('lang.swithcher',['locale'=>'az']) }}">Az</a></li>
                    <li><a href="{{ route('lang.swithcher',['locale'=>'ru']) }}">Ru</a></li>
                </ul>
            </li>
        @elseif(app()->getLocale() == 'ru')
            <li>
                <a href="javascript:void:(0)">Ru</a>
                <ul class="curr-lan-sub-menu">
                    <li><a href="{{ route('lang.swithcher',['locale'=>'az']) }}">Az</a></li>
                    <li><a href="{{ route('lang.swithcher',['locale'=>'en']) }}">En</a></li>
                </ul>
            </li>
        @endif
    </ul>
</header>

<!-- HEADER MENU====================================== -->
@yield('content')
<!-- FOOTER====================================== -->
<footer class="footer1-section section section-padding">
    <div class="container">
        <div class="row text-center row-cols-1">

            <div class="footer1-logo col text-center">
                <img src="{{ asset('malybeili') }}/assets/images/logo/logobg.png" alt="">
            </div>

            <div class="footer1-menu col">
                <ul class="widget-menu justify-content-center">
                    <li><a href="{{ route('front.about') }}">{{ __('menus.about') }}</a></li>
                    <li><a href="#">{{ __('menus.products') }}</a></li>
                    <li><a href="{{ route('front.contact') }}">{{ __('menus.contact') }}</a></li>
                </ul>
            </div>

            <div class="footer1-social col">
                <ul class="widget-social justify-content-center">
                    <li class="hintT-top" data-hint="Facebook"> <a href="{{ \App\Helpers\Options::getOption('facebook') }}"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="hintT-top" data-hint="Instagram"> <a href="{{ \App\Helpers\Options::getOption('instagram') }}"><i class="fab fa-instagram"></i></a></li>
                    <li class="hintT-top" data-hint="Youtube"> <a href="{{ \App\Helpers\Options::getOption('youtube') }}"><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
            <div class="footer1-copyright col">
                <p class="copyright">&copy; {{ date('Y') }}.{{ __('static.butun_huquqlar_qorunur') }} | Created with <i class="fa fa-heart" style="color:red; font-size: 15px;"></i> by <a href="https://crr.az/" target="_blank">crr.az</a></p>
            </div>

        </div>
    </div>
</footer>
<!-- FOOTER====================================== -->
<div id="offcanvas-cart" class="offcanvas offcanvas-cart ">
  <div class="inner">
            <div class="head">
                <span class="title">Cart</span>
                <button class="offcanvas-close">×</button>
            </div>
            <div class="body customScroll ps ps--theme_default" >
                <ul class="minicart-product-list" id="minicart-product-list">

                </ul>
            <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
            <div class="foot">
                <div class="sub-total">
                    <strong>Subtotal :</strong>
                    <span class="amount" id="total">$144.00</span>
                </div>
                <div class="buttons">
                    <a href="{{ route('front.shopping.cart') }}" class="btn btn-dark btn-hover-primary">{{ __('menus.view_cart') }}</a>
                    <a href="checkout.html" class="btn btn-outline-dark">checkout</a>
                </div>
                <p class="minicart-message">Free Shipping on All Orders Over $100!</p>
            </div>
        </div>
</div>
<div class="offcanvas-overlay"></div>
<!--JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="{{ asset('malybeili') }}/assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lozad.js/1.16.0/lozad.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/js/swiper.min.js"></script>

<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selection-js/1.7.1/selection.min.js"></script>
<script>
    const observer = lozad();
    observer.observe();
    AOS.init({ once: true, });
</script>
<script src="{{ asset('malybeili') }}/assets/js/plugins/select2.min.js"></script>
<script src="{{ asset('malybeili') }}/assets/js/plugins/jquery.nice-select.min.js"></script>
<script src="{{ asset('malybeili') }}/assets/js/plugins/perfect-scrollbar.min.js"></script>
{{-- <script src="{{ asset('malybeili') }}/assets/js/plugins/swiper.min.js"></script> --}}
<script src="{{ asset('malybeili') }}/assets/js/plugins/slick.min.js"></script>
<script src="{{ asset('malybeili') }}/assets/js/plugins/jquery.ajaxchimp.min.js"></script>
<script src="{{ asset('malybeili') }}/assets/js/plugins/jquery.matchHeight-min.js"></script>
<script src="{{ asset('malybeili') }}/assets/js/plugins/ion.rangeSlider.min.js"></script>
<script src="{{ asset('malybeili') }}/assets/js/plugins/jquery.sticky-sidebar.min.js"></script>
<script src="{{ asset('malybeili') }}/assets/js/plugins/jquery.magnific-popup.min.js"></script>
<script src="{{ asset('malybeili') }}/assets/js/plugins/jquery.scrollUp.min.js"></script>
<script src="{{ asset('malybeili') }}/assets/js/plugins/scrollax.min.js"></script>
<script src="{{ asset('malybeili') }}/assets/js/main.js"></script>
<script>
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        return !(charCode > 31 && (charCode < 48 || charCode > 57));
    }

    $(document).on('click','.product-removal', function () {
        let id = $(this).attr('data-id');
        productRemoval(id);
    });

    function productRemoval(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : 'POST',
            url  : '{!! route('front.product.removal') !!}',
            data : { id : id },
            success: function (response) {
                callSebet();
                @if(request()->segment(1) == 'shopping-cart')
                callSebet2();
                @endif
                $('.productCount').html(response.totalCount);
            },
            error : function (myErrors) {
                if(typeof myErrors.responseJSON !== "undefined")
                {
                    $.each(myErrors.responseJSON.errors, function (key, error) {
                        toastr.error(error);
                    });
                }
            }
        })
    }

    function callSebet() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : 'POST',
            url  : '{!! route('front.call.sebet') !!}',
            success: function (response) {
                $('#minicart-product-list').html(response.output);
                $('#total').html('$'+response.total);
            },
            error : function (myErrors) {
                if(typeof myErrors.responseJSON !== "undefined")
                {
                    $.each(myErrors.responseJSON.errors, function (key, error) {
                        toastr.error(error);
                    });
                }
            }
        })
    }

    function sebet_main(id, count) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : 'POST',
            url  : '{!! route('front.sebet') !!}',
            data : {
                id    : id,
                count : count
            },
            success: function (response) {
                callSebet();
                @if(request()->segment(1) == 'shopping-cart')
                    callSebet2();
                @endif
                toastr.success(response.message);
            },
            error: function (myErrors) {
                $.each(myErrors.responseJSON.errors, function (key, error) {
                    toastr.error(error);
                });
            }
        });
    }
</script>
@toastr_js
@toastr_render
@yield('js')
</body>
</html>
