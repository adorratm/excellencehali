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
        <div class="row justify-content-center">
            <div class="col-12 text-center justify-content-center">
                <h3><?= lang("order_received") ?> <b><?= $order_code ?></b></h3>
                <img loading="lazy" data-src="<?= asset_url("public/images/okok.gif") ?>" alt="<?= $settings->company_name ?>" class="img-fluid lazyload d-block mx-auto" width="500" height="500">
                <a class="ulinaBTN px-3 my-3" href="<?= base_url() ?>" rel="dofollow" title="<?= $settings->company_name ?>" data-toggle="tooltip" data-placement="bottom" data-title="<?= $settings->company_name ?>"><span><?= lang("goToHome") ?></span></a>
            </div>
        </div>
    </div>
</section>
<!-- END: Cart Page Section -->


<!--====== Cart Ends ======-->