@extends('front.layouts.master')

@section('title') {{ __('menus.contact') }} @endsection

@section('css')

@endsection

@section('content')
    <!-- CONTACT MENU====================================== -->
    <section class="page-title-section2 section" data-bg-image="{{ asset('malybeili') }}/assets/images/bg/contact-title.webp" style="border-bottom: 1px solid rgba(129, 70, 70, 0.5);">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-title">
                        <h1 class="title">{{ __('menus.contact') }}</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('front.home') }}">{{ __('menus.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('menus.contact') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-padding border-top">
        <div class="container">
            <!-- Section Title Start -->
            <!-- Section Title End -->
            <div class="row g-0 row-cols-md-3 row-cols-1">

                <div class="icon-box3 col">
                    <div class="inner">
                        <div class="icon"><i class="ti-mobile"></i></div>
                        <div class="content">
                            <h6 class="title">{{ __('static.tel') }}</h6>
                            <p>{{ explode('***',\App\Helpers\Options::getOption('tel'))[0] }}</p>
                        </div>
                    </div>
                </div>

                <div class="icon-box3 col">
                    <div class="inner">
                        <div class="icon"><i class="ti-location-pin"></i></div>
                        <div class="content">
                            <h6 class="title">{{ __('static.unvan') }}</h6>
                            @php
                            $unvan = explode('***',\App\Helpers\Options::getOption('unvan'));
                            if(app()->getLocale() == 'az')
                            {
                                $unvan = $unvan[0];
                            }
                            elseif(app()->getLocale() == 'en')
                            {
                                $unvan = $unvan[1];
                            }
                            elseif(app()->getLocale() == 'ru')
                            {
                                $unvan = $unvan[2];
                            }
                            @endphp
                            <p>{{ $unvan }}</p>
                        </div>
                    </div>
                </div>

                <div class="icon-box3 col">
                    <div class="inner">
                        <div class="icon"><i class="ti-email"></i></div>
                        <div class="content">
                            <h6 class="title">{{ __('static.email') }}</h6>
                            <p>{{ \App\Helpers\Options::getOption('email') }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="section section-padding pt-0 sendmessage" >
        <div class="container" >
            <div class="section-title2 text-center">
                <h2 class="title">{{ __('static.mesaj_yaz') }}</h2>
            </div>
            <div class="row" >
                <div class="col-lg-8 col-12 mx-auto">
                    <div class="contact-form">
                        <form action="{!! route('front.contact.post') !!}" id="contactForm" method="post" onsubmit="return false">
                            <div class="row learts-mb-n30">
                                <div class="col-md-6 col-12 learts-mb-30">
                                    <input type="text" placeholder="{{ __('static.ad_soyad') }} *" name="name" id="name">
                                    <small class="text-danger" id="name-error"></small>
                                </div>
                                <div class="col-md-6 col-12 learts-mb-30">
                                    <input type="email" placeholder="{{ __('static.email') }} *" name="email2" id="email2">
                                    <small class="text-danger" id="email-error"></small>
                                </div>
                                <div class="col-12 learts-mb-30">
                                    <textarea name="message" id="message" placeholder="{{ __('static.mesaj') }} *"></textarea>
                                    <small class="text-danger" id="message-error"></small>
                                </div>
                                <div class="col-12 text-center learts-mb-30"><button class="btn btn-dark btn-outline-hover-dark" id="contactBtn">{{ __('static.gonder') }}</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTACT MENU====================================== -->
@endsection

@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#contactBtn').click(function () {
                $('#name-error').html('');
                $('#email-error').html('');
                $('#message-error').html('');
                let name    = $('#name').val();
                let email   = $('#email2').val();
                let message = $('#message').val();
                $.ajax({
                    url: '{!! route('front.contact.post') !!}',
                    type: 'POST',
                    data: {
                        name: name,
                        email: email,
                        message: message
                    },
                    success: function (data) {
                        toastr.success(data.message);
                        $('#contactForm').trigger("reset");
                    },
                    error: function (data) {
                        var errors = data.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function (key, value) {
                                $('#'+key+'-error').html(value);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection


