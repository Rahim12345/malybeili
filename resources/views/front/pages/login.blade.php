@extends('front.layouts.master')

@section('title') {{ __('menus.contact') }} @endsection

@section('css')

@endsection

@section('content')
    <!-- LOGIN MENU====================================== -->
    <section class="page-title-section2 section"  data-bg-image="{{ asset('malybeili/assets/images/bg/about-title.webp') }}" style="border-bottom: 1px solid rgba(129, 70, 70, 0.5);">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-title">
                        <h1 class="title">{{ __('menus.hesab') }}</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('front.home') }}">{{ __('menus.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('menus.hesab') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mylogin section section-padding">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-6 updiv">
                    <div class="user-login-register bg-light">
                        <div class="login-register-title">
                            <h2 class="title">{{ __('login.login') }}</h2>
                            <p class="desc">{{ __('login.great') }}</p>
                        </div>
                        <div class="login-register-form">
                            <form action="#" method="post" onsubmit="return false">
                                <div class="row learts-mb-n50">
                                    <div class="col-12 learts-mb-50">
                                        <input type="email" placeholder="{{ __('login.email') }}" id="loginEmail">
                                        <small class="text-danger" id="loginEmail-error"></small>
                                    </div>
                                    <div class="col-12 learts-mb-50">
                                        <input type="password" placeholder="{{ __('login.password') }}" id="loginPassword">
                                        <small class="text-danger" id="loginPassword-error"></small>
                                    </div>
                                    <div class="col-12 text-center learts-mb-20">
                                        <button class="btn btn-dark btn-outline-hover-dark" type="button" id="loginBtn">{{ __('login.login') }}</button>
                                    </div>
                                    <div class="col-12 learts-mb-80">
                                        <div class="row learts-mb-n20">
                                            <a class="googleIn" href="javascript:(0)">
                                                <button class="google-sign-in my-button base border-radius-30 h6-500 " type="button" >
                                                    <div class="imag">
                                                        <img src="{{ asset('malybeili/assets/images/Google_Logo.svg') }}" alt="google sign in"  >{{ __('login.google_ile') }}
                                                    </div>
                                                </button>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="user-login-register">
                        <div class="login-register-title">
                            <h2 class="title">{{ __('login.qeydiyyat') }}</h2>
                            <p class="desc">{{ __('login.hesabiniz_yoxdursa') }}</p>
                        </div>
                        <div class="login-register-form">
                            <form action="#" method="post" onsubmit="return false">
                                <div class="row learts-mb-n50">
                                    <div class="col-12 learts-mb-20">
                                        <label for="registerEmail">{{ __('login.email') }} <abbr class="required">*</abbr></label>
                                        <input type="email" id="registerEmail">
                                        <small class="text-danger" id="registerEmail-error"></small>
                                    </div>
                                    <div class="col-12 learts-mb-20">
                                        <label for="registerPassword">{{ __('login.password') }} <abbr class="required">*</abbr></label>
                                        <input type="password" id="registerPassword">
                                        <small class="text-danger" id="registerPassword-error"></small>
                                    </div>
                                    <div class="col-12 learts-mb-20">
                                        <label for="registerRepeatPassword">{{ __('login.sifre_yanlisdir') }} <abbr class="required">*</abbr></label>
                                        <input type="password" id="registerRepeatPassword">
                                        <small class="text-danger" id="registerRepeatPassword-error"></small>
                                    </div>

                                    <div class="col-12 text-center learts-mb-50">
                                        <button class="btn btn-dark btn-outline-hover-dark" type="button" id="registrationBtn">{{ __('login.qeydiyyat') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <!-- LOGIN MENU====================================== -->
@endsection

@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#registrationBtn').click(function () {
                $('#registerEmail-error').html('');
                $('#registerPassword-error').html('');
                $('#registerRepeatPassword-error').html('');
                let registerEmail           = $('#registerEmail').val();
                let registerPassword        = $('#registerPassword').val();
                let registerRepeatPassword  = $('#registerRepeatPassword').val();
                $.ajax({
                    type : 'POST',
                    url  : '{!! route('login.post') !!}',
                    data : {
                        action                      : 'registration',
                        registerEmail               : registerEmail,
                        registerPassword            : registerPassword,
                        registerRepeatPassword      : registerRepeatPassword
                    },
                    success : function (response) {
                        toastr.success(response.message);
                        window.location.href = response.url;
                    },
                    error : function (myErrors) {
                        if (myErrors.status == 429)
                        {
                            toastr.error('Too Many Requests');
                        }
                        else
                        {
                            $.each(myErrors.responseJSON.errors, function (key, error) {
                                if (key == 'action')
                                {
                                    toastr.error(error);
                                }
                                else
                                {
                                    $('#'+key+'-error').html(error);
                                }
                            });
                        }
                    }
                });
            });

            $('#loginBtn').click(function () {
                $('#loginEmail-error').html('');
                $('#loginPassword-error').html('');
                let loginEmail           = $('#loginEmail').val();
                let loginPassword        = $('#loginPassword').val();
                $.ajax({
                    type : 'POST',
                    url  : '{!! route('login.post') !!}',
                    data : {
                        action                      : 'login',
                        loginEmail                  : loginEmail,
                        loginPassword               : loginPassword
                    },
                    success : function (response) {
                        toastr.success(response.message);
                        window.location.href = response.url;
                    },
                    error : function (myErrors) {
                        if (myErrors.status == 429)
                        {
                            toastr.error('Too Many Requests');
                        }
                        else if (myErrors.status == 403)
                        {
                            toastr.error('{!! __('login.email_ve_ya_sifre') !!}');
                        }
                        else
                        {
                            $.each(myErrors.responseJSON.errors, function (key, error) {
                                if (key == 'action')
                                {
                                    toastr.error(error);
                                }
                                else
                                {
                                    $('#'+key+'-error').html(error);
                                }
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection


