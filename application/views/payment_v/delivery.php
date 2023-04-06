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
                            <h3 class="mb-2 fs-1 fw-bold"><?= lang("delivery_methods") ?></h3>
                            <p class="mb-0"><?= lang("choose_delivery_method_text") ?></p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="collapse show mb-3" id="collapseExample1">
                            <div class="card card-body">
                                <div class="row align-items-center ">
                                    <div class="col-md-7 mb-3 mb-md-0">
                                        <p class="fs-5 mb-0 fw-semibold d-block"><?= lang("delivery_method_1") ?></p>
                                    </div>
                                    <div class="col-md-5 text-md-end mb-3 mb-md-0">
                                        <input type="radio" id="delivery_method_1" checked name="delivery_method" class="address delivery_method" onchange="changeDeliveryMethod($(this))" onclick="$(this).change()" value="<?= lang("delivery_method_1") ?>">
                                        <label for="delivery_method_1" class="h5 my-auto py-auto"><?= lang("chooseThisDeliveryMethod") ?></label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="collapse show mb-3" id="collapseExample2">
                            <div class="card card-body">
                                <div class="row align-items-center ">
                                    <div class="col-md-7 mb-3 mb-md-0">
                                        <p class="fs-5 mb-0 fw-semibold d-block"><?= lang("delivery_method_2") ?></p>
                                    </div>
                                    <div class="col-md-5 text-md-end mb-3 mb-md-0">
                                        <input type="radio" id="delivery_method_2" name="delivery_method" class="address delivery_method" onchange="changeDeliveryMethod($(this))" onclick="$(this).change()" value="<?= lang("delivery_method_2") ?>">
                                        <label for="delivery_method_2" class="h5 my-auto py-auto"><?= lang("chooseThisDeliveryMethod") ?></label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="collapse show mb-3" id="collapseExample3">
                            <div class="card card-body">
                                <div class="row align-items-center ">
                                    <div class="col-md-7 mb-3 mb-md-0">
                                        <p class="fs-5 mb-0 fw-semibold d-block"><?= lang("delivery_method_3") ?></p>
                                    </div>
                                    <div class="col-md-5 text-md-end mb-3 mb-md-0">
                                        <input type="radio" id="delivery_method_3" name="delivery_method" class="address delivery_method" onchange="changeDeliveryMethod($(this))" onclick="$(this).change()" value="<?= lang("delivery_method_3") ?>">
                                        <label for="delivery_method_3" class="h5 my-auto py-auto"><?= lang("chooseThisDeliveryMethod") ?></label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="collapse show" id="collapseExample4">
                            <div class="card card-body">
                                <div class="row align-items-center ">
                                    <div class="col-md-7 mb-3 mb-md-0">
                                        <p class="fs-5 mb-0 fw-semibold d-block"><?= lang("delivery_method_4") ?></p>
                                    </div>
                                    <div class="col-md-5 text-md-end mb-3 mb-md-0">
                                        <input type="radio" id="delivery_method_4" name="delivery_method" class="address delivery_method" onchange="changeDeliveryMethod($(this))" onclick="$(this).change()" value="<?= lang("delivery_method_4") ?>">
                                        <label for="delivery_method_4" class="h5 my-auto py-auto"><?= lang("chooseThisDeliveryMethod") ?></label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-end justify-content-end d-flex flex-wrap">
                            <a rel="dofollow" href="<?= base_url(lang("routes_product-collections")) ?>" title="<?= lang("continueShopping") ?>" class="ulinaBTN2 px-3 me-1"><span><?= lang("continueShopping") ?></span></a>
                            <a rel="dofollow" href="<?= base_url(lang("routes_cart")) ?>" title="<?= lang("cart") ?>" class="ulinaBTN2 me-1 px-3"><span><?= lang("cart") ?></span></a>
                            <a rel="dofollow" href="<?= base_url(lang("routes_choose-payment-method")) ?>" title="<?= lang("choose_payment_method") ?>" class="ulinaBTN2 me-1 px-3"><span><?= lang("choose_payment_method") ?></span></a>
                            <a rel="dofollow" href="<?= base_url(lang("routes_create-order")) ?>" title="<?= lang("proceedToCheckout") ?>" class="ulinaBTN px-3"><span><?= lang("proceedToCheckout") ?></span></a>
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
        $("input[name='delivery_method']").each(function() {
            if ($(this).is(":checked")) {
                $(this).change()
            }
        })
    });

    function changeDeliveryMethod($this) {
        let selected = $this.val();
        let url = "<?= base_url(lang("routes_delivery-method-change")) ?>";
        let formData = new FormData();
        formData.append("delivery_method", selected);
        formData.append("<?= $this->security->get_csrf_token_name() ?>", "<?= $this->security->get_csrf_hash() ?>");
        createAjax(url, formData, function() {})
    }
</script>