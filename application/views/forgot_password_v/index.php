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

<!-- BEGIN: Checkout Page Section -->
<section class="checkoutPage">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="<?= base_url(lang("routes_forgot-password-reset")) ?>" method="POST" enctype="multipart/form-data">
                    <div class="checkoutForm p-0 card bg-blue-light-5">
                        <div class="card-header">
                            <div class="card-title mb-0">
                                <h3 class="text-center my-3 fw-bold"><?= lang("forgotPassword") ?></h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center align-self-center align-content-center mb-3">
                                <label for="email" class="col-lg-2 col-form-label"><?= lang("email") ?> : </label>
                                <div class="col-lg-10">
                                    <input class="mb-0" id="email" type="email" name="email" placeholder="<?= lang("email") ?>" required value="<?= get_cookie("rememberme", true) == "on" ? get_cookie("email", true) : set_value("email") ?>" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <a rel="dofollow" title="<?= lang("dealerLogin") ?>" href="<?= base_url(lang("routes_dealer-login")) ?>"><?= lang("dealerLogin") ?></a>
                                </div>
                                <div class="col-lg-6">
                                    <a class="d-flex justify-content-end" rel="dofollow" title="<?= lang("dealerRegister") ?>" href="<?= base_url(lang("routes_dealer-register")) ?>"><?= lang("dealerRegister") ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                            <button type="submit" class="ulinaBTN w-100"><span><?= lang("forgotPasswordReset") ?></span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- END: Checkout Page Section -->