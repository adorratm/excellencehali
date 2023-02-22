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
                                    <input readonly class="mb-0" id="email" type="email" name="email" placeholder="<?= lang("email") ?>" required value="<?= !empty($this->input->get("email", true)) ? $this->input->get("email", true) : set_value("email") ?>" />
                                </div>
                            </div>
                            <div class="row align-items-center align-self-center align-content-center mb-3">
                                <label for="password" class="col-lg-2 col-form-label"><?= lang("password") ?> : </label>
                                <div class="col-lg-10">
                                    <input class="mb-0" id="password" type="password" name="password" placeholder="<?= lang("password") ?>" required value="<?= set_value("password") ?>" />
                                </div>
                            </div>
                            <div class="row align-items-center align-self-center align-content-center mb-3">
                                <label for="passwordRepeat" class="col-lg-2 col-form-label"><?= lang("passwordRepeat") ?> : </label>
                                <div class="col-lg-10">
                                    <input class="mb-0" id="passwordRepeat" type="password" name="passwordRepeat" placeholder="<?= lang("passwordRepeat") ?>" required value="<?= set_value("passwordRepeat") ?>" />
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
                            <input type="hidden" name="phone" value="<?= $this->input->get("phone", true) ?>">
                            <input type="hidden" name="token" value="<?= $this->input->get("token", true) ?>">
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