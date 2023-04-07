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


<section class="checkoutPage">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xl-3">
                <ul class="nav nav-pills flex-column border p-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-0 " id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true" rel="dofollow" title="<?= lang("account") ?>"><i class="fa fa-user-circle me-2"></i> <?= lang("account") ?></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-0" id="pills-order-tab" href="<?= base_url(lang("routes_orders")) ?>" type="button" role="tab" aria-controls="pills-order" aria-selected="false" rel="dofollow" title="<?= lang("orders") ?>"><i class="fa fa-boxes-stacked me-2"></i> <?= lang("orders") ?></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-0 active" id="pills-address-tab" href="<?= base_url(lang("routes_address")) ?>" type="button" role="tab" aria-controls="pills-address" aria-selected="false" rel="dofollow" title="<?= lang("my_addresses") ?>"><i class="fa fa-map-marker me-2"></i> <?= lang("my_addresses") ?></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-0" id="pills-logout-tab" href="<?= base_url(lang("routes_logout")) ?>" type="button" role="button" aria-controls="false" aria-selected="false" rel="dofollow" title="<?= lang("logout") ?>"><i class="fa fa-power-off me-2"></i> <?= lang("logout") ?></a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-8 col-xl-9">
                <div class="tab-content border p-3" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-address" role="tabpanel" aria-labelledby="pills-address-tab" tabindex="0">
                        <div class="d-flex flex-wrap align-items-center align-self-center mb-3">
                            <div class="flex-grow-1">
                                <h3 class="text-center my-auto"><?= lang("my_addresses") ?></h3>
                            </div>
                            <div class="flex-shrink-1">
                                <a class="float-end ms-auto createAddressBtn ulinaBTN px-3" data-url="<?= base_url(lang("routes_order-address-add")) ?>" href="javascript:void(0)" title="<?= lang("createNewAddress") ?>"><span><i class="fa fa-edit"></i> <?= lang("createNewAddress") ?></span></a>
                            </div>
                        </div>

                        <div id="addressPull">
                            <?php $this->load->view("account_v/addressNotChooseable") ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


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
                $("#addressPull").load("<?= base_url(lang("routes_order-address-get")) ?>");
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
                $("#addressPull").load("<?= base_url(lang("routes_order-address-get")) ?>");
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
                        $("#addressPull").load("<?= base_url(lang("routes_order-address-get")) ?>");
                    })
                }
            })
        })
    })
</script>