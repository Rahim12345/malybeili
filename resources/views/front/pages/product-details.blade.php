@extends('front.layouts.master')

@section('title') {{ __('menus.products') }} @endsection

@section('css')

@endsection

@section('content')
    <!-- PRODUCT DETAILS MENU====================================== -->

    <section class="page-title-section2 section border-bottom" data-bg-image="{{ asset('malybeili') }}/assets/images/bg/product-title.webp" style="border-bottom: 1px solid rgba(129, 70, 70, 0.5);">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-title">
                        <h1 class="title">{{ __('menus.products') }}</h1>
                        <ul class="breadcrumb" style="width: 20rem;">
                            <li class="breadcrumb-item"><a href="{{ route('front.home') }}">{{ __('menus.home') }}</a></li>
                            <li class="breadcrumb-item "><a href="javascript: void (0)">{{ __('menus.products') }}</a></li>
                            <li class="breadcrumb-item "><a href="{{ route('front.products',['category_slug'=>$category->{'slug_'.app()->getLocale()}]) }}">{{ $category->{'name_'.app()->getLocale()} }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-paddingb border-bottom productss">
        <div class="container">
            <div class="row learts-mb-n40">
                <div class="col-lg-6 col-12 learts-mb-40 imgLoad">
                    <div class="product-images">
                        <div class="product-gallery-slider ">
                            @foreach($product->images as $image)
                            <div class="lozad" data-image="{{ asset('files/products/'.$image->src) }}">
                                <img class="lozad" data-src="{{ asset('files/products/'.$image->src) }}" alt="">
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="col-lg-6 col-12 learts-mb-40 texts">
                    <div class="product-summery">
                        <h3 class="product-title">{{ $product->{'name_'.app()->getLocale()} }}</h3>
                        <div class="product-price">{{ $product->price }} &#8380;</div>
                        <div class="product-meta">
                            <table>
                                <tbody>
                                <tr>
                                    <td class="label"><span>{{ __('static.kateqoriya') }}</span></td>
                                    <td class="value">
                                        <ul class="product-category">
                                            <li><a href="{{ route('front.products',['category_slug'=>$category->{'slug_'.app()->getLocale()}]) }}">{{ $category->{'name_'.app()->getLocale()} }}</a></li>
                                        </ul>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="product-variations">
                            <table>
                                <tbody>
                                <tr>
                                    <td class="label"><span>Sayı :</span></td>
                                    <td class="value">
                                        <div class="product-quantity">
                                            <span class="qty-btn minus"><i class="ti-minus"></i></span>
                                            <input type="text" class="input-qty" id="singleValue" value="1"   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"   onkeypress="return isNumberKey(event);" onkeyup="this.value.trim() == '' ? (this.value = 1) : (this.value = this.value) ">
                                            <span class="qty-btn plus"><i class="ti-plus"></i></span>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="product-buttons">

                            <a href="javascript: void(0)" class="btn btn-dark btn-outline-hover-dark singleSebet" data-id="{{ $product->id }}"><i class="fal fa-shopping-cart"></i> {{ __('static.sebete_elave_et') }}</a>
                        </div>
                        <div class="product-thumb-slider">
                            <div class="item">
                                <img class="lozad" data-src="{{ asset('malybeili') }}/assets/images/product/single/1/product-A.webp" alt="">
                            </div>
                            <div class="item">
                                <img class="lozad" data-src="{{ asset('malybeili') }}/assets/images/product/single/1/product-A.webp" alt="">
                            </div>
                            <div class="item">
                                <img class="lozad" data-src="{{ asset('malybeili') }}/assets/images/product/single/1/product-A.webp" alt="">
                            </div>
                            <div class="item">
                                <img class="lozad" data-src="{{ asset('malybeili') }}/assets/images/product/single/1/product-A.webp" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-padding border-bottom">
        <div class="container">
            <ul class="nav product-info-tab-list">
                <li><a class="active" data-bs-toggle="tab" href="#tab-description">{{ __('static.mehsul_haqqinda') }}</a></li>
                <li><a data-bs-toggle="tab" href="#tab-additional_information">{{ __('static.olcu') }}</a></li>

            </ul>
            <div class="tab-content product-infor-tab-content">
                <div class="tab-pane fade show active" id="tab-description">
                    <div class="row">
                        <div class="col-lg-10 col-12 mx-auto text-center">
                            <p>{{ $product->{'about_'.app()->getLocale()} }}</p>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-additional_information">
                    <div class="row">
                        <div class="col-lg-8 col-md-10 col-12 mx-auto">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td>{{ __('static.olculer') }}</td>
                                        <td>{{ $product->{'size_'.app()->getLocale()} }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('static.rengler') }}</td>
                                        <td>{{ $product->{'color_'.app()->getLocale()} }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <section class="section section-padding">
        <div class="container">
            <div class="section-title2 text-center">
                <h2 class="title">Digər Məhsullar</h2>
            </div>
            <div class="product-carousel">
                @foreach($other_products as $other_product)
                <div class="col">
                    <div class="product">
                        <div class="product-thumb">
                            <a href="{{ route('front.product.details',['category_slug'=>$other_product->category->{'slug_'.app()->getLocale()},'product_slug'=>$other_product->{'slug_'.app()->getLocale()}]) }}" class="image imgLoad">
                            <span class="product-badges">
                                <span class="onsale">-{{ $other_product->discount }}%</span>
                            </span>
                                @if($other_product->images->count() > 0)
                                <img class="lozad" data-src="{{ asset('files/products/'.$other_product->images[0]->src) }}" alt="{{ $other_product->{'name_'.app()->getLocale()} }}">
                                @endif
                            </a>
                        </div>
                        <div class="product-info">
                            <h6 class="title"><a href="{{ route('front.product.details',['category_slug'=>$other_product->category->{'slug_'.app()->getLocale()},'product_slug'=>$other_product->{'slug_'.app()->getLocale()}]) }}">{{ $other_product->{'name_'.app()->getLocale()} }}</a></h6>
                            <span class="price">
                            <span class="old">{{ $other_product->price }} &#8380;</span>
                            <span class="new">{{ $other_product->price * (100 - $other_product->discount) / 100 }} &#8380;</span>
                        </span>
                            <div class="product-buttons">
                                <a href="#quickViewModal" data-bs-toggle="modal" class="product-button hintT-top"  onclick="getDetails({{ $product->id }})" data-hint="{{ __('static.ilk_baxis') }}"><i class="fal fa-search"></i></a>
                                <a href="{{ route('front.product.details',['category_slug'=>$other_product->category->{'slug_'.app()->getLocale()},'product_slug'=>$other_product->{'slug_'.app()->getLocale()}]) }}" class="product-button hintT-top" data-hint="{{ __('static.sebete_elave_et') }}"><i class="fal fa-shopping-cart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- PRODUCT DETAILS MENU====================================== -->
@endsection

@section('js')
    <script>
        function getDetails(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type : 'POST',
                url  : '{!! route('front.product.details.modal') !!}',
                data : {id : id},
                success : function (response) {
                    $('#product-title-modal').html(response.kateqoriya);
                    $('#product-price-modal').html(response.qiymet);
                    $('#product-category-modal').html(response.kateqoriya).attr('href',response.kateqoriya_link);
                    let images = '<div class="product-images imgLoad1"><div class="product-gallery-slider-quickview1">';
                    $.each(response.sekiller, function (key, value) {
                        images += '<div class="lozad" data-image="{!! env('app_url') !!}/files/products/'+value+'">';
                        images += '<img class="lozad" data-src="{!! env('app_url') !!}/files/products/'+value+'" alt="">';
                        images += '</div>';
                    });
                    images += '</div></div>';
                    console.log(images)
                    $('#modal-images').html(images);
                },
                error : function (myErrors) {
                    console.log(myErrors)
                    $.each(myErrors.responseJSON.errors, function (key, value) {
                        console.log(value)
                    });
                }
            });
        }

        $('.singleSebet').click(function () {
            let id      = $(this).attr('data-id');
            let count   = $('#singleValue').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type : 'POST',
                url  : '<?php echo route('front.sebet'); ?>',
                data : {
                    id    : id,
                    count : count
                },
                success: function (response) {
                    $('.productCount').html(response.count);
                    toastr.success(response.message);
                },
                error: function (myErrors) {
                    $.each(myErrors.responseJSON.errors, function (key, error) {
                        toastr.error(error);
                    });
                }
            });
        });
    </script>
@endsection


