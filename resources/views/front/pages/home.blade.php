@extends('front.layouts.master')

@section('title') {{ __('menus.home') }} @endsection

@section('css')

@endsection

@section('content')
    <!-- ANA SEHIFE SECTIONLARI====================================== -->
    <section class="home2-slider swiper-container fix">
        <div class="swiper-wrapper">
            @php
            $count = $banners->count();
            @endphp
            @foreach($banners as $banner)
                @php
                    $bannerItem = explode('***', $banner->text);
                @endphp
                @if(app()->getLocale() == 'az')
                    @php
                        $bannerItem = $bannerItem[0];
                    @endphp
                @elseif(app()->getLocale() == 'en')
                    @php
                        $bannerItem = $bannerItem[1];
                    @endphp
                @elseif(app()->getLocale() == 'ru')
                    @php
                        $bannerItem = $bannerItem[2];
                    @endphp
                @endif
            <div class="home2-slide-item swiper-slide " data-swiper-autoplay="5000" data-bg-color="#EEE5DD">
                <div class="home2-slide1-image imgLoad" >
                    <img src="{{ asset('files/home/'.$banner->src) }}" alt="{{ $bannerItem }}">
                </div>
                <div class="home2-slide-content">
                    <h5 class="sub-title">{{ __('static.mehsulun_novu') }}</h5>
                    <h2 class="title">{{ $bannerItem }}</h2>
                </div>
                <div class="home2-slide-pages">
                    <span class="current">{{ $loop->iteration }}</span>
                    <span class="border"></span>
                    <span class="total">{{ $count }}</span>
                </div>
                <img class="bottom" src="{{ asset('malybeili') }}/assets/images/bottom.png" alt="">
                  
            </div>
          
            @endforeach
        </div>
       
    </section>
    <section class="section section-padding pt-5 fix">
        <div class="container">
            <div class="row row-cols-lg-4 row-cols-sm-2 row-cols-1 learts-mb-n40">
                @foreach($content_categories as $content_category)
                <div class="col learts-mb-40 " >
                    <div class="category-banner4" data-aos="fade-down" data-aos-duration="1000">
                        <a href="{{ route('front.products',['category_slug'=>$content_category->{'slug_'.app()->getLocale()}]) }}" class="inner">
                            <div class="image"><img src="{{ asset('files/categories/'.$content_category->src) }}" alt=""></div>
                            <div class="content" data-bg-color="#f4ede7">
                                <h3 class="title">{{ $content_category->{'name_'.app()->getLocale()} }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="section  discounts section-fluid">
        <div class="row g-0">

            <div class="col-lg-6 col-12">
                <div class="sale-banner9 bg-light">
                    <div class="inner">
                        <div class="content">
                            <h3 class="title">Kampaniya</h3>
                            <span class="offer">30% ENDİRİM</span>
                            <a href="shopping-cart.html" class="btn btn-dark btn-hover-primary">Sifariş et</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12">
                <div class="sale-banner9-image">
                    <img src="{{ asset('malybeili') }}/assets/images/banner/sale-banner9-1.2.webp" alt="">
                </div>
            </div>

        </div>
    </section>
    <section class="section section-padding border-top position-relative fix">
        <div class="container">

            <!-- Section Title Start -->
            <div class="section-title2 text-center">
                <h3 class="sub-title">Instagram</h3>
                <h2 class="title"><a href="https://www.instagram.com/malybeili/" target="_blank">@malybeili</a></h2>
            </div>
            <!-- Section Title End -->

            <div id="instafeed" class="instafeed instafeed-carousel instafeed-carousel1"></div>

        </div>
    </section>
    <!-- ANA SEHIFE SECTIONLARI====================================== -->
@endsection

@section('js')

@endsection


