@extends('front.layouts.master')

@section('title') {{ __('menus.products') }} @endsection

@section('css')

@endsection

@section('content')
    <!-- SHOP MENU====================================== -->
    <section class="page-title-section2 section" data-bg-image="{{ asset('malybeili') }}/assets/images/bg/products-title.webp" style="border-bottom: 1px solid rgba(129, 70, 70, 0.5);">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-title">
                        <h1 class="title">Məhsullar</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('front.home') }}">{{ __('menus.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('menus.products') }}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="section learts-mt-70 mb-5">
        <div class="container clearfix">
            <div class="row learts-mb-n50">
                <div class="clearfix"></div>
                <div class="col-lg-9 col-12 learts-mb-50">
                    <!-- Products Start -->
                    <div id="shop-products" class="products row row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-1 clearfix">
                        @foreach($products as $product)
                        <div class="grid-item col featured clearfix imgLoad">
                            <div class="product">
                                <div class="product-thumb">
                                    <a href="{{ route('front.product.details',['category_slug'=>$product->category->{'slug_'.app()->getLocale()},'product_slug'=>$product->{'slug_'.app()->getLocale()}]) }}" class="image">
                                        @if($product->images->count() > 0)
                                        <img src="{{ asset('files/products/'.$product->images[0]->src) }}" alt="{{ $product->{'name_'.app()->getLocale()} }}">
                                        @endif
                                    </a>

                                </div>
                                <div class="product-info">
                                    <h6 class="title"><a href="{{ route('front.product.details',['category_slug'=>$product->category->{'slug_'.app()->getLocale()},'product_slug'=>$product->{'slug_'.app()->getLocale()}]) }}">{{ $product->{'name_'.app()->getLocale()} }}</a></h6>
                                    <span class="price">
                                    {{ $product->price }} 	&#8380;
                                </span>
                                    <div class="product-buttons">
                                        <a data-bs-toggle="modal" data-bs-target="#mymodal_one" class="product-button hintT-top" onclick="getDetails({{ $product->id }})" data-hint="{{ __('static.ilk_baxis') }}"><i class="fal fa-search"></i></a>
                                        <a href="#offcanvas-cart" class="product-button hintT-top offcanvas-toggle" data-hint="{{ __('static.sebete_elave_et') }}"><i class="fal fa-shopping-cart"></i></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Products End -->

                </div>

                <div class="col-lg-3 col-12 learts-mb-10">

                    <!-- Search Start -->
                    <div class="single-widget learts-mb-40">
                        <div class="widget-search">
                            <form action="#">
                                <input type="text" placeholder="{{ __('static.axtar') }}...">
                                <button><i class="fal fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- Search End -->

                    <!-- Categories Start -->
                    <div class="single-widget learts-mb-40">
                        <h3 class="widget-title product-filter-widget-title">{{ __('static.kateqoriyalar') }}</h3>
                        <ul class="widget-list">
                            @foreach($categories as $category)
                            <li><a href="{{ route('front.products',['category_slug'=>$category->{'slug_'.app()->getLocale()}]) }}">{{ $category->{'name_'.app()->getLocale()} }}</a> <span class="count">{{ $category->products->count() }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Categories End -->

                    <!-- Price Range Start -->
                    <div class="single-widget learts-mb-40">
                        <h3 class="widget-title product-filter-widget-title">{{ __('static.qiymet') }}</h3>
                        <div class="widget-price-range">
                            <input class="range-slider" type="text" data-min="0" data-max="250" data-from="0" data-to="250" />
                            <div class="d-flex justify-content-end">
                                <button class="btn-danger" style="padding: 5px 10px 5px 10px; border: none; outline: none; margin-top: 20px;">{{ __('static.axtar') }}</button>
                            </div>
                        </div>
                    </div>
                    <!-- Price Range End -->

                    <!-- List Product Widget Start -->
{{--                    <div class="single-widget learts-mb-40 imgLoad">--}}
{{--                        <h3 class="widget-title product-filter-widget-title">{{ __('menus.products') }}</h3>--}}
{{--                        <ul class="widget-products">--}}
{{--                            <li class="product">--}}
{{--                                <div class="thumbnail">--}}
{{--                                    <a href="product-details.html"><img src="{{ asset('malybeili') }}/assets/images/product/s270/product-1.webp" alt="List product"></a>--}}
{{--                                </div>--}}
{{--                                <div class="content">--}}
{{--                                    <h6 class="title"><a href="product-details.html">Məhsul 1</a></h6>--}}
{{--                                    <span class="price">--}}
{{--                                    18 &#8380;--}}
{{--                                </span>--}}

{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="product imgLoad">--}}
{{--                                <div class="thumbnail">--}}
{{--                                    <a href="product-details.html"><img src="{{ asset('malybeili') }}/assets/images/product/s270/product-2.webp" alt="List product"></a>--}}
{{--                                </div>--}}
{{--                                <div class="content">--}}
{{--                                    <h6 class="title"><a href="product-details.html">Məhsul 2</a></h6>--}}
{{--                                    <span class="price">--}}
{{--                                    35 &#8380;--}}
{{--                                </span>--}}

{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="product imgLoad">--}}
{{--                                <div class="thumbnail">--}}
{{--                                    <a href="product-details.html"><img src="{{ asset('malybeili') }}/assets/images/product/s270/product-3.webp" alt="List product"></a>--}}
{{--                                </div>--}}
{{--                                <div class="content">--}}
{{--                                    <h6 class="title"><a href="product-details.html">Məhsul 3</a></h6>--}}
{{--                                    <span class="price">--}}
{{--                                    35 &#8380;--}}
{{--                                </span>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
                    <!-- List Product Widget End -->



                </div>

            </div>
        </div>
    </section>
    <!-- SHOP MENU====================================== -->

    @include('front.includes.product-detail-modal')

@endsection

@section('js')
    <script>
        function getDetails(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#counter').val(1);
            $.ajax({
                type : 'POST',
                url  : '{!! route('front.product.details.modal') !!}',
                data : {id : id},
                success : function (response) {
                    $('#product-title-modal').html(response.kateqoriya);
                    $('#product-price-modal').html(response.qiymet);
                    $('#initialValue').val(response.qiymet);
                    $('#productId').val(response.id);
                    $('#product-category-modal').html(response.kateqoriya).attr('href',response.kateqoriya_link);
                    let images = '<div class="product-gallery-slider-quickview modal_sliders">';
                    $.each(response.sekiller, function (key, value) {
                        images += '<img  src="{{ asset('files/products/') }}/'+value+'" alt="">';
                    });
                    images += '</div>';

// console.log(images)
                    $('#modal_main').html(images);
                },
                error : function (myErrors) {
                    // console.log(myErrors)
                    $.each(myErrors.responseJSON.errors, function (key, value) {
                        console.log(value)
                    });
                }
            });
        }

        function pricer(action) {
            let counter = $('#counter').val();
            let initVal = $('#initialValue').val();
            if (counter != 1 && action == '+')
            {
                counter = parseInt(counter) + 1;
            }
            else if (counter == 1 && action == '+')
            {
                counter = parseInt(counter) + 1;
            }
            else if (counter != 1 && action == '-')
            {
                counter = parseInt(counter) - 1;
            }
            $('#product-price-modal').html(counter * initVal);
        }

        function sebet() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type : 'POST',
                url  : '{!! route('front.sebet') !!}',
                data : {
                  id    : $('#productId').val(),
                  count : $('#counter').val()
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
        }
    </script>
@endsection


