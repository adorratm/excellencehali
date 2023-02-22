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
                <form action="<?= base_url(lang("routes_login")) ?>" method="POST" enctype="multipart/form-data">
                    <div class="checkoutForm p-0 card bg-blue-light-5">
                        <div class="card-header">
                            <div class="card-title mb-0">
                                <h3 class="text-center my-3 fw-bold"><?= lang("dealerLogin") ?></h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center align-self-center align-content-center mb-3">
                                <label for="email" class="col-lg-2 col-form-label"><?= lang("email") ?> : </label>
                                <div class="col-lg-10">
                                    <input class="mb-0" id="email" type="email" name="email" placeholder="<?= lang("email") ?>" required value="<?= get_cookie("rememberme", true) == "on" ? get_cookie("email", true) : set_value("email") ?>" />
                                </div>
                            </div>
                            <div class="row align-items-center align-self-center align-content-center mb-3">
                                <label for="password" class="col-lg-2 col-form-label"><?= lang("password") ?> : </label>
                                <div class="col-lg-10">
                                    <input class="mb-0" id="password" type="password" name="password" placeholder="<?= lang("password") ?>" required value="<?= get_cookie("rememberme", true) == "on" ? base64_decode(get_cookie("password", true)) : set_value("password") ?>" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="rememberme" id="rememberme" <?= get_cookie("rememberme", true) ? "checked" : NULL ?>>
                                        <label for="rememberme" class="form-check-label"><?= lang("rememberMe") ?></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <a class="d-flex justify-content-end" rel="dofollow" title="<?= lang("forgotPassword") ?>" href="<?= base_url(lang("routes_forgot-password")) ?>"><?= lang("forgotPassword") ?></a>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                    <button type="submit" class="ulinaBTN w-100"><span><?= lang("login") ?></span></button>
                                </div>
                                <div class="col-lg-6">
                                    <a href="<?= base_url(lang("routes_dealer-register")) ?>" class="ulinaBTN w-100"><span><?= lang("dealerRegister") ?></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- END: Checkout Page Section -->