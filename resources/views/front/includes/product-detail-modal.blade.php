<!-- MODAL====================================== -->
<div class="modal fade" id="mymodal_one" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('static.suretli_baxis') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="modal_main">
            <div class="modal_left col-lg-6 overflow-hidden position-relative" id="modal_main">
            </div>
            <div class="modal_right col-lg-6 overflow-hidden position-relative">
                <div class="product-summery customScroll">
                    <h3 class="product-title" id="product-title-modal">Telefon Tutacağı</h3>
                    <div class="product-price"><span id="product-price-modal">18</span> &#8380;</div>
                    <input type="hidden" id="productId" value="">
                    <input type="hidden" id="initialValue" value="">
                    <div class="product-variations">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="label"><span>{{ __('static.sayi') }}</span></td>
                                    <td class="value">
                                        <div class="product-quantity">
                                            <span class="qty-btn minus" onclick="pricer('-')"><i class="ti-minus"></i></span>
                                            <input type="text" class="input-qty" value="1" id="counter"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"   onkeypress="return isNumberKey(event);" onkeyup="this.value.trim() == '' ? (this.value = 1) : (this.value = this.value) ">
                                            <span class="qty-btn plus" onclick="pricer('+')"><i class="ti-plus"></i></span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="product-meta mb-0">
                        <table>
                            <tbody>
                            <tr>
                                <td class="label"><span>{{ __('static.kateqoriya') }} : </span></td>
                                <td class="value">
                                    <ul class="product-category">
                                        <li><a href="#" id="product-category-modal">Mətbəx</a></li>
                                    </ul>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-color" onclick="sebet();">{{ __('static.sebete_elave_et') }}</button>
        </div>
      </div>
    </div>
  </div>
<!-- MODAL====================================== -->
