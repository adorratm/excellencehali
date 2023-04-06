<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" style="background-image: url(<?= get_picture("settings_v", $settings->about_logo) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pageBannerContent text-center">
                    <h2 class="text-white mb-0"><?= $page_title ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Page Banner Section -->




<!-- END: Cart Page Section -->
<section class="checkoutPage">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card rounded-0">
                    <div class="card-header">
                        <div class="card-title mb-0">
                            <h3 class="mb-2 fs-1 fw-bold"><?= lang("payment_methods") ?></h3>
                            <p class="mb-0"><?= lang("choose_payment_method_text") ?></p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="collapse show" id="collapseExample">
                            <div class="card card-body">
                                <div class="row align-items-center ">
                                    <div class="col-md-7 mb-3 mb-md-0">
                                        <a class="fs-5 mb-3 fw-semibold d-block" rel="nofollow" href="https://tahsilat.selgehali.com.tr/" title="<?= lang("payment_method_1") ?>" target="_blank"><?= lang("payment_method_1") ?></a>
                                        <a class="fs-5 fw-semibold" rel="nofollow" href="https://tahsilat.yalcinkayahali.com.tr/" title="<?= lang("payment_method_1") ?>" target="_blank"><?= lang("payment_method_2") ?></a>
                                    </div>
                                    <div class="col-md-5 text-md-end mb-3 mb-md-0">
                                        <input type="radio" id="payment_method_1" checked name="payment_method" class="address payment_method" onchange="changePaymentMethod($(this))" onclick="$(this).change()" value="1">
                                        <label for="payment_method_1" class="h5 my-auto py-auto"><?= lang("chooseThisPaymentMethod") ?></label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-end justify-content-end d-flex flex-wrap">
                            <a rel="dofollow" href="<?= base_url(lang("routes_product-collections")) ?>" title="<?= lang("continueShopping") ?>" class="ulinaBTN2 px-3 me-1"><span><?= lang("continueShopping") ?></span></a>
                            <a rel="dofollow" href="<?= base_url(lang("routes_cart")) ?>" title="<?= lang("cart") ?>" class="ulinaBTN2 me-1 px-3"><span><?= lang("cart") ?></span></a>
                            <a rel="dofollow" href="<?= base_url(lang("routes_order-address")) ?>" title="<?= lang("choose_order_address") ?>" class="ulinaBTN2 me-1 px-3"><span><?= lang("choose_order_address") ?></span></a>
                            <a rel="dofollow" href="<?= base_url(lang("routes_choose-delivery-method")) ?>" title="<?= lang("proceedToCheckout") ?>" class="ulinaBTN px-3"><span><?= lang("proceedToCheckout") ?></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Cart Page Section -->


<!--====== Cart Ends ======-->

<script>
    window.addEventListener('DOMContentLoaded', function() {
        $("input[name='payment_method']").each(function() {
            if ($(this).is(":checked")) {
                $(this).change()
            }
        })
    });

    function changePaymentMethod($this) {
        let selected = $this.val();
        let url = "<?= base_url(lang("routes_payment-method-change")) ?>";
        let formData = new FormData();
        formData.append("payment_method", selected);
        formData.append("<?= $this->security->get_csrf_token_name() ?>", "<?= $this->security->get_csrf_hash() ?>");
        createAjax(url, formData, function() {})
    }
</script>