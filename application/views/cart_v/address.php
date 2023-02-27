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
                <div class="about-content">
                    <div class="d-flex flex-wrap align-items-center align-self-center mb-3">
                        <div class="flex-grow-1">
                            <h3 class="billing-address text-dark-green my-auto"><?= lang("deliveryAndInvoiceAddress") ?></h3>
                        </div>
                        <div class="flex-shrink-1">
                            <a class="float-end ms-auto createAddressBtn ulinaBTN px-3" data-url="<?= base_url(lang("routes_cart") . "/" . lang("routes_order-address-add")) ?>" href="javascript:void(0)" title="<?= lang("createNewAddress") ?>"><span><i class="fa fa-edit"></i> <?= lang("createNewAddress") ?></span></a>
                        </div>
                    </div>
                    <div id="addressPull">
                        <?php $this->load->view("cart_v/addressChooseable") ?>
                    </div>
                    <div class="text-end justify-content-end d-flex flex-wrap">
                        <a rel="dofollow" href="<?= base_url(lang("routes_product-collections")) ?>" title="<?= lang("continueShopping") ?>" class="ulinaBTN2 px-3 me-1"><span><?= lang("continueShopping") ?></span></a>
                        <a rel="dofollow" href="<?= base_url(lang("routes_cart")) ?>" title="<?= lang("cart") ?>" class="ulinaBTN2 me-1 px-3"><span><?= lang("cart") ?></span></a>
                        <a rel="dofollow" href="<?= base_url(lang("routes_choose-payment-type")) ?>" title="<?= lang("proceedToCheckout") ?>" class="ulinaBTN px-3"><span><?= lang("proceedToCheckout") ?></span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- END: Cart Page Section -->


<!--====== Cart Ends ======-->

<!-- Address Modal -->
<div id="addressModal"></div>


<script>
    window.addEventListener('DOMContentLoaded', function() {
        $(document).on("click", ".createAddressBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            $('#addressModal').iziModal('destroy');
            createModal("#addressModal", "<?= lang("createNewDeliveryAndInvoiceAddress") ?>", "<?= lang("createNewDeliveryAndInvoiceAddress") ?>", 600, !0, "20px", 0, "#1c1833", "#fff", 3040, function() {
                $.get(url, {
                    "<?= $this->security->get_csrf_token_name() ?>": "<?= $this->security->get_csrf_hash() ?>"
                }, function(response) {
                    $("#addressModal .iziModal-content").html(response)
                })
            });
            openModal("#addressModal")
        });
        $(document).on("click", ".btnSave", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("createAddress"));
            formData.append("<?= $this->security->get_csrf_token_name() ?>", "<?= $this->security->get_csrf_hash() ?>");
            createAjax(url, formData, function() {
                closeModal("#addressModal");
                $("#addressPull").load("<?= base_url(lang("routes_cart") . "/" . lang("routes_order-address-get")) ?>");
            });
        });
        $(document).on("click", ".editAddressBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            $('#addressModal').iziModal('destroy');
            createModal("#addressModal", "<?= lang("updateDeliveryAndInvoiceAddress") ?>", "<?= lang("updateDeliveryAndInvoiceAddress") ?>", 600, !0, "20px", 0, "#1c1833", "#fff", 3040, function() {
                $.get(url, {
                    "<?= $this->security->get_csrf_token_name() ?>": "<?= $this->security->get_csrf_hash() ?>"
                }, function(response) {
                    $("#addressModal .iziModal-content").html(response)
                })
            });
            openModal("#addressModal")
        });
        $(document).on("click", ".btnUpdate", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("updateAddress"));
            formData.append("<?= $this->security->get_csrf_token_name() ?>", "<?= $this->security->get_csrf_hash() ?>");
            createAjax(url, formData, function() {
                closeModal("#addressModal");
                $("#addressPull").load("<?= base_url(lang("routes_cart") . "/" . lang("routes_order-address-get")) ?>");
            });
        });
        $(document).on('click', '.deleteAddress', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            swal.fire({
                title: '<?= lang("areYouSure") ?>',
                text: "<?= lang("cannotGetBack") ?>",
                icon: 'warning',
                showCancelButton: !0,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?= lang("yesDeleteIt") ?>',
                cancelButtonText: "<?= lang("noCancelIt") ?>"
            }).then(function(result) {
                if (result.value) {
                    let formData = new FormData();
                    formData.append("<?= $this->security->get_csrf_token_name() ?>", "<?= $this->security->get_csrf_hash() ?>");
                    createAjax(url, formData, function() {
                        $("#addressPull").load("<?= base_url(lang("routes_cart") . "/" . lang("routes_order-address-get")) ?>");
                    })
                }
            })
        })
    })
</script>