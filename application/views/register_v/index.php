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
                <form action="<?= base_url(lang("routes_register")) ?>" method="POST" enctype="multipart/form-data">
                    <div class="checkoutForm p-0 card bg-blue-light-5">
                        <div class="card-header">
                            <div class="card-title mb-0">
                                <h3 class="text-center my-3 fw-bold"><?= lang("dealerRegister") ?></h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center align-self-center align-content-center mb-3">
                                <label for="first_name" class="col-lg-3 col-form-label"><?= lang("first_name") ?> : </label>
                                <div class="col-lg-9">
                                    <input class="mb-0" id="first_name" type="text" name="first_name" placeholder="<?= lang("first_name") ?>" required value="<?= set_value("first_name") ?>" />
                                </div>
                            </div>
                            <div class="row align-items-center align-self-center align-content-center mb-3">
                                <label for="last_name" class="col-lg-3 col-form-label"><?= lang("last_name") ?> : </label>
                                <div class="col-lg-9">
                                    <input class="mb-0" id="last_name" type="text" name="last_name" placeholder="<?= lang("last_name") ?>" required value="<?= set_value("last_name") ?>" />
                                </div>
                            </div>
                            <div class="row align-items-center align-self-center align-content-center mb-3">
                                <label for="company_name" class="col-lg-3 col-form-label"><?= lang("company_name") ?> : </label>
                                <div class="col-lg-9">
                                    <input class="mb-0" id="company_name" type="text" name="company_name" placeholder="<?= lang("company_name") ?>" required value="<?= set_value("company_name") ?>" />
                                </div>
                            </div>
                            <div class="row align-items-center align-self-center align-content-center mb-3">
                                <label for="tax_number" class="col-lg-3 col-form-label"><?= lang("tax_number") ?> : </label>
                                <div class="col-lg-9">
                                    <input class="mb-0" id="tax_number" type="text" name="tax_number" placeholder="<?= lang("tax_number") ?>" required value="<?= set_value("tax_number") ?>" maxlength="11" minlength="10" />
                                </div>
                            </div>
                            <div class="row align-items-center align-self-center align-content-center mb-3">
                                <label for="tax_administration" class="col-lg-3 col-form-label"><?= lang("tax_administration") ?> : </label>
                                <div class="col-lg-9">
                                    <input class="mb-0" id="tax_administration" type="text" name="tax_administration" placeholder="<?= lang("tax_administration") ?>" required value="<?= set_value("tax_administration") ?>" />
                                </div>
                            </div>
                            <div class="row align-items-center align-self-center align-content-center mb-3">
                                <label for="address" class="col-lg-3 col-form-label"><?= lang("address") ?> : </label>
                                <div class="col-lg-9">
                                    <textarea class="mb-0" name="address" id="address" cols="30" rows="10" placeholder="<?= lang("address") ?>" required><?= set_value("address") ?></textarea>
                                </div>
                            </div>
                            <div class="row align-items-center align-self-center align-content-center mb-3">
                                <label for="phone" class="col-lg-3 col-form-label"><?= lang("phone") ?> : </label>
                                <div class="col-lg-9">
                                    <input class="mb-0" id="phone" type="tel" name="phone" placeholder="<?= lang("phone") ?>" required value="<?= set_value("phone") ?>" maxlength="20" minlength="11" />
                                </div>
                            </div>
                            <div class="row align-items-center align-self-center align-content-center mb-3">
                                <label for="email" class="col-lg-3 col-form-label"><?= lang("email") ?> : </label>
                                <div class="col-lg-9">
                                    <input class="mb-0" id="email" type="email" name="email" placeholder="<?= lang("email") ?>" required value="<?= set_value("email") ?>" />
                                </div>
                            </div>
                            <div class="row align-items-center align-self-center align-content-center mb-3">
                                <label for="password" class="col-lg-3 col-form-label"><?= lang("password") ?> : </label>
                                <div class="col-lg-9">
                                    <input class="mb-0" id="password" type="password" name="password" placeholder="<?= lang("password") ?>" required value="<?= set_value("password") ?>" />
                                </div>
                            </div>
                            <div class="row align-items-center align-self-center align-content-center mb-3">
                                <label for="passwordRepeat" class="col-lg-3 col-form-label"><?= lang("passwordRepeat") ?> : </label>
                                <div class="col-lg-9">
                                    <input class="mb-0" id="passwordRepeat" type="password" name="passwordRepeat" placeholder="<?= lang("passwordRepeat") ?>" required value="<?= set_value("passwordRepeat") ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                    <button type="submit" class="ulinaBTN w-100"><span><?= lang("register") ?></span></button>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <a href="<?= base_url(lang("routes_dealer-login")) ?>" class="ulinaBTN w-100"><span><?= lang("dealerLogin") ?></span></a>
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