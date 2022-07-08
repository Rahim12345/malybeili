@extends('front.layouts.master')

@section('title') {{ __('menus.view_cart') }} @endsection

@section('css')

@endsection

@section('content')
    <!-- SHOPPING CART MENU====================================== -->
    <section class="page-title-section2 section" data-bg-image="assets/images/bg/basket-title.webp" style="border-bottom: 1px solid rgba(129, 70, 70, 0.5);">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">Səbət</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('front.home') }}">{{ __('menus.home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('menus.view_cart') }}</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="section section-padding">
        <div class="container">
            <form class="cart-form" action="#">
                <table class="cart-wishlist-table table">
                    <thead>
                    <tr>
                        <th class="name" colspan="2">Product</th>
                        <th class="price">Price</th>
                        <th class="quantity">Quantity</th>
                        <th class="subtotal">Total</th>
                        <th class="remove">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody id="totalSebet">
                    <tr>
                        <td class="thumbnail"><a href="product-details.html"><img src="assets/images/product/cart-product-1.webp" alt="cart-product-1"></a></td>
                        <td class="name"> <a href="product-details.html">Walnut Cutting Board</a></td>
                        <td class="price"><span>£100.00</span></td>
                        <td class="quantity">
                            <div class="product-quantity">
                                <span class="qty-btn minus"><i class="ti-minus"></i></span>
                                <input type="text" class="input-qty" value="1">
                                <span class="qty-btn plus"><i class="ti-plus"></i></span>
                            </div>
                        </td>
                        <td class="subtotal"><span>£100.00</span></td>
                        <td class="remove"><a href="#" class="btn">×</a></td>
                    </tr>
                    <tr>
                        <td class="thumbnail"><a href="product-details.html"><img src="assets/images/product/cart-product-2.webp" alt="cart-product-2"></a></td>
                        <td class="name"> <a href="product-details.html">Lucky Wooden Elephant</a></td>
                        <td class="price"><span>£35.00</span></td>
                        <td class="quantity">
                            <div class="product-quantity">
                                <span class="qty-btn minus"><i class="ti-minus"></i></span>
                                <input type="text" class="input-qty" value="1">
                                <span class="qty-btn plus"><i class="ti-plus"></i></span>
                            </div>
                        </td>
                        <td class="subtotal"><span>£35.00</span></td>
                        <td class="remove"><a href="#" class="btn">×</a></td>
                    </tr>
                    <tr>
                        <td class="thumbnail"><a href="product-details.html"><img src="assets/images/product/cart-product-3.webp" alt="cart-product-3"></a></td>
                        <td class="name"> <a href="product-details.html">Fish Cut Out Set</a></td>
                        <td class="price"><span>£9.00</span></td>
                        <td class="quantity">
                            <div class="product-quantity">
                                <span class="qty-btn minus"><i class="ti-minus"></i></span>
                                <input type="text" class="input-qty" value="1">
                                <span class="qty-btn plus"><i class="ti-plus"></i></span>
                            </div>
                        </td>
                        <td class="subtotal"><span>£9.00</span></td>
                        <td class="remove"><a href="#" class="btn">×</a></td>
                    </tr>
                    </tbody>
                </table>

            </form>

        </div>

    </section>
    <section class="section section-padding checkoutFr">
        <div class="container">
            <div class="section-title2">
                <h2 class="title">Məlumatlarınız</h2>
            </div>
            <form action="#" class="checkout-form learts-mb-50">
                <div class="row">
                    <div class="col-md-6 col-12 learts-mb-20">
                        <label for="bdFirstName">Adınız <abbr class="required">*</abbr></label>
                        <input type="text" id="bdFirstName" placeholder="Aydan">
                    </div>
                    <div class="col-md-6 col-12 learts-mb-20">
                        <label for="bdLastName">Soyadınız <abbr class="required">*</abbr></label>
                        <input type="text" id="bdLastName" placeholder="Ismayılova">
                    </div>
                    <div class="col-12 learts-mb-20">
                        <label for="bdAddress1">Ünvan <abbr class="required">*</abbr></label>
                        <input type="text" id="bdAddress1" placeholder="Bakı,Azərbaycan">
                    </div>
                    <div class="col-12 learts-mb-20">
                        <label for="bdPostcode">Poçt Kodu <abbr class="required">*</abbr></label>
                        <input type="text" id="bdPostcode" placeholder="Az1000">
                    </div>
                    <div class="col-md-6 col-12 learts-mb-20">
                        <label for="bdEmail">Email <abbr class="required">*</abbr></label>
                        <input type="text" id="bdEmail" placeholder="aydan@gmail.com">
                    </div>
                    <div class="col-md-6 col-12 learts-mb-30">
                        <label for="bdPhone">Telefon <abbr class="required">*</abbr></label>
                        <input type="phone" id="bdPhone" placeholder="994505555555">
                    </div>
                    <div class="col-12 learts-mb-20">
                        <label for="bdOrderNote">Əlavə şərh</label>
                        <textarea id="bdOrderNote" placeholder="Şərhinizi yazın"></textarea>
                    </div>
                </div>
            </form>
            <div class="section-title2 ">
                <h2 class="title">Sifariş</h2>
            </div>
            <div class="row learts-mb-n30 tabbl">
                <div class="col-lg-6 order-lg-2 learts-mb-30">
                    <div class="order-review">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="name">Məhsul</th>
                                <th class="total">Məbləğ</th>
                            </tr>
                            </thead>
                            <tbody id="totalSebet2">
                            <tr>
                                <td class="name">Sini&nbsp; <strong class="quantity">×&nbsp;1</strong></td>
                                <td class="total"><span>100 &#8380;</span></td>
                            </tr>
                            <tr>
                                <td class="name">Taxta&nbsp; <strong class="quantity">×&nbsp;1</strong></td>
                                <td class="total"><span>22 &#8380;</span></td>
                            </tr>
                            <tr>
                                <td class="name">Taxta&nbsp; <strong class="quantity">×&nbsp;1</strong></td>
                                <td class="total"><span>120 &#8380;</span></td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr class="subtotal">
                                <th>Toplam</th>
                                <td><span class="totalPrice">242 </span>$</td>
                            </tr>
                            <tr class="total">
                                <th>Yekun Məbləğ</th>
                                <td><strong><span class="totalPrice">242 </span>$</strong></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1 learts-mb-30">
                    <div class="order-payment">
                        <div class="payment-method">
                            <div class="accordion" id="paymentMethod">
                                <div class="card active">
                                    <div class="card-header">
                                        <button data-bs-toggle="collapse" data-bs-target="#checkPayments">Kuryerlə Ödəniş</button>
                                    </div>
                                    <div id="checkPayments" class="collapse show" data-bs-parent="#paymentMethod">
                                        <div class="card-body">
                                            <p>Zəhmət olmasa bütün məlumatları doldurun.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="payment-note" style="font-style: italic; opacity: .7; text-align: start;">Şəxsi məlumatlarınız sifarişinizi emal etmək, bu veb saytdakı təcrübənizi dəstəkləmək və məxfilik siyasətimizdə təsvir olunan digər məqsədlər üçün istifadə ediləcək.</p>
                            <button class="btn btn-dark btn-outline-hover-dark">Sifariş et</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- SHOPPING CART MENU====================================== -->
@endsection

@section('js')
    <script>
        callSebet2();

        function callSebet2() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type : 'POST',
                url  : '{!! route('front.call.sebet') !!}',
                data : {
                  action : 2
                },
                success: function (response) {
                    $('#totalSebet').html(response.output);
                    $('#totalSebet2').html(response.output2);
                    $('.totalPrice').html(response.total);
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
    </script>
@endsection


