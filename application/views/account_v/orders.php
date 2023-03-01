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
                        <a class="nav-link rounded-0" id="pills-account-tab" href="<?= base_url(lang("routes_account")) ?>" type="button" role="tab" aria-controls="pills-account" aria-selected="true" rel="dofollow" title="<?= lang("account") ?>"><i class="fa fa-user-circle me-2"></i> <?= lang("account") ?></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-0 active" id="pills-order-tab" data-bs-toggle="pill" data-bs-target="#pills-order" type="button" role="tab" aria-controls="pills-order" aria-selected="false" rel="dofollow" title="<?= lang("orders") ?>"><i class="fa fa-boxes-stacked me-2"></i> <?= lang("orders") ?></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-0" id="pills-logout-tab" href="<?= base_url(lang("routes_logout")) ?>" type="button" role="button" aria-controls="false" aria-selected="false" rel="dofollow" title="<?= lang("logout") ?>"><i class="fa fa-power-off me-2"></i> <?= lang("logout") ?></a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-8 col-xl-9">
                <div class="tab-content border p-3" id="pills-tabContent">
                    <div class="tab-pane fade  show active" id="pills-order" role="tabpanel" aria-labelledby="pills-order-tab" tabindex="0">
                        <h3 class="text-center"><?= lang("orders") ?></h3>
                        <table class="table table-hover table-light table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle"><?= lang("order_code") ?></th>
                                    <th class="text-center align-middle"><?= lang("total") ?></th>
                                    <th class="text-center align-middle"><?= lang("order_status") ?></th>
                                    <th class="text-center align-middle"><?= lang("order_date") ?></th>
                                    <th class="text-center align-middle"><?= lang("actions") ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($orders)) : ?>
                                    <?php foreach ($orders as $key => $value) : ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $value->order_code ?></td>
                                            <td class="text-center align-middle"><?= number_format($value->total, 2) ?> <?= $value->symbol ?></td>
                                            <td class="text-center align-middle"><b><?= $value->statusMessage ?></b></td>
                                            <td class="text-center align-middle"><?= $value->createdAt ?></td>
                                            <td class="d-flex align-middle text-center justify-content-center">
                                                <a rel="dofollow" href="javascript:void(0)" class="ulinaBTN rounded-0 px-3 getOrderBtn" data-url="<?= base_url(lang("routes-order-detail") . "/" . $value->order_code) ?>" data-toggle="tooltip" data-placement="top" data-title="<?= lang("order_detail") ?>" title="<?= lang("order_detail") ?>"><span><i class="fa fa-file"></i></span></a>
                                                <?php if (strtotime("+30 minutes", strtotime($value->createdAt)) >= strtotime("now") && $value->status == 1) : ?>
                                                    <a rel="dofollow" href="javascript:void(0)" class="ulinaBTN rounded-0 px-3 cancelOrderBtn ms-1" data-url="<?= base_url(lang("routes-order-cancel") . "/" . $value->order_code) ?>" data-toggle="tooltip" data-placement="top" data-title="<?= lang("cancel_order") ?>" title="<?= lang("cancel_order") ?>"><span><i class="fa fa-times"></i></span></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /.cart-area -->

<!-- Address Modal -->
<div id="ordersModal"></div>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        $(document).on("click", ".getOrderBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#ordersModal').iziModal('destroy');
            let url = $(this).data("url");
            let formData = new FormData();
            formData.append("<?= $this->security->get_csrf_token_name() ?>", "<?= $this->security->get_csrf_hash() ?>");

            createModal("#ordersModal", "<?= lang("order_detail") ?>", "<?= lang("order_detail") ?>", 600, true, "20px", 0, "#1c1833", "#fff", 1040, function() {
                createAjax(url, formData, function(response) {
                    console.log(response);
                    if (response.success) {
                        $("#ordersModal .iziModal-content").html(response.data);
                    }

                });
            });
            openModal("#ordersModal");
            $("#ordersModal").iziModal("setFullscreen", false);
        });
        $(document).on("click", ".cancelOrderBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData();
            formData.append("<?= $this->security->get_csrf_token_name() ?>", "<?= $this->security->get_csrf_hash() ?>");
            let $this = $(this);
            if ($this.prop("disabled") == false || $this.prop("disabled") == undefined) {
                $this.prop("disabled", true);
                createAjax(url, formData, function(response) {
                    if (response.success) {
                        setTimeout(function() {
                            window.location.href = "<?= base_url(lang("routes_orders")) ?>";
                        }, 1000);
                    }
                    $this.prop("disabled", false);
                });
            }
        });
    });
</script>