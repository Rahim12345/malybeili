@extends('front.layouts.master')

@section('title') {{ __('menus.about') }} @endsection

@section('css')

@endsection

@section('content')
    <!-- HAQQIMDA MENU====================================== -->
    <section class="page-title-section2 section"  data-bg-image="assets/images/bg/about-title.webp" style="border-bottom: 1px solid rgba(129, 70, 70, 0.5);">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-title">
                        <h1 class="title">{{ __('menus.about') }}</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">{{ __('menus.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('menus.about') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-padding2 aboutme"  style="border-bottom: 1px solid rgba(129, 70, 70, 0.5);">
        <div class="container">
            <div class="row learts-mb-n30">
                <div class="col-lg-12 col-12 align-self-center learts-mb-30" data-aos="fade-right" data-aos-duration="2000">
                    <div class="about-us4a">
                        <span class="title">{{ __('static.milli_brend') }}</span>
                        <h2 class="title">{{ __('static.el_isleri') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-fluid section-padding pt-0 mt-5 aboutMe">
        <div class="container">
            <div class="row learts-mb-n30 imgLoad">

                <div class="col-lg-6 col-12 text-center learts-mb-30">
                    <img class="a2image lozad" data-src="{{ asset('files/about/'.$about->src) }}" alt="">
                </div>

                <div class="col-lg-6 col-12 align-self-center learts-mb-30">
                    <div class="about-us4">
                        <div class="row learts-mb-n30">
                            <div class="col-xl-8 col-12 learts-mb-30">
                                <div class="desc mb-0 about_me">
                                    <p>{{ $about->{'about_'.app()->getLocale()} }}</p>
                                </div>
                            </div>

                            <div class="col-12 learts-mb-30">
                                <div class="icon-box4 text-left justify-content-start text-start">
                                    <div class="inner">
                                        <div class="content">
                                            <h6 class="title">{{ __('static.tel') }}</h6>
                                            @php
                                            $telFull =  explode('***',\App\Helpers\Options::getOption('tel'));
                                            $telview = $telFull[0];
                                            $telreal = $telFull[1];
                                            @endphp
                                            <a href="tel:{{ $telreal }}">{{ $telview }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 learts-mb-30">
                                <div class="icon-box4 text-left justify-content-start text-start">
                                    <div class="inner">
                                        <div class="content">
                                            <h6 class="title">{{ __('static.email') }}</h6>
                                            <a href="mailto:{{ \App\Helpers\Options::getOption('email') }}" target="_blank">{{ \App\Helpers\Options::getOption('email') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <section class="section section-padding comments">
        <div class="container">
            <div class="section-title2 row justify-content-between align-items-center">
                <div class="col-md-auto col-12">
                    <h2 class="title title-icon-right">{{ __('static.menim_sevimli_musterilerim') }}</h2>
                </div>
            </div>
            <div class="testimonial-carousel">
                @foreach($reviews as $item)
                <div class="col">
                    <div class="testimonial ">
                        <p>{{ $item->{'review_'.app()->getLocale()} }}</p>
                        <div class="author">
                            <img  src="{{ asset('files/reviews/'.$item->src) }}" alt="">
                            <div class="content">
                                <h6 class="name">{{ $item->{'name_'.app()->getLocale()} }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- HAQQIMDA MENU====================================== -->
@endsection

@section('js')

@endsection


