<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" style="background-image: url(<?= get_picture("settings_v", $settings->about_logo) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pageBannerContent text-center">
                    <h2 class="text-white mb-0"><?= lang("pageNotFound") ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Page Banner Section -->

<!-- BEGIN: 404 Section -->
<section class="fofPage">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="fofContent text-center">
                    <h2>404</h2>
                    <h3><i class="fa-regular fa-face-sad-cry"></i> <?= lang("pageNotFound") ?></h3>
                    <p><?= lang("404Desc") ?></p>
                    <a rel="dofollow" href="<?= base_url() ?>" title="<?= lang("404Home") ?>" class="ulinaBTN"><span><?= lang("404Home") ?></span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: 404 Section -->


