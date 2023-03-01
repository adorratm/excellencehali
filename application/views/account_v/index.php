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
                        <a class="nav-link rounded-0 active" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true" rel="dofollow" title="<?= lang("account") ?>"><i class="fa fa-user-circle me-2"></i> <?= lang("account") ?></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-0" id="pills-order-tab" href="<?=base_url(lang("routes_orders"))?>" type="button" role="tab" aria-controls="pills-order" aria-selected="false" rel="dofollow" title="<?= lang("orders") ?>"><i class="fa fa-boxes-stacked me-2"></i> <?= lang("orders") ?></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-0" id="pills-logout-tab" href="<?= base_url(lang("routes_logout")) ?>" type="button" role="button" aria-controls="false" aria-selected="false" rel="dofollow" title="<?= lang("logout") ?>"><i class="fa fa-power-off me-2"></i> <?= lang("logout") ?></a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-8 col-xl-9">
                <div class="tab-content border p-3" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
                        <h3 class="text-center"><?= lang("account") ?></h3>
                        <form action="<?= base_url(lang("routes_account-update")) ?>" method="POST" enctype="multipart/form-data">

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label"><?= lang("first_name") ?> : </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="first_name" placeholder="<?= lang("first_name") ?>" maxlength="70" minlength="4" value="<?= !empty(set_value('first_name')) ? set_value('first_name') : $user->first_name ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label"><?= lang("last_name") ?> : </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="last_name" placeholder="<?= lang("last_name") ?>" maxlength="70" minlength="4" value="<?= !empty(set_value('last_name')) ? set_value('last_name') : $user->last_name ?>" required>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label"><?= lang("email") ?> : </label>
                                <div class="col-lg-10">
                                    <input type="email" class="form-control" name="email" placeholder="<?= lang("email") ?>" minlength="3" value="<?= !empty(set_value('email')) ? set_value('email') : $user->email ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label"><?= lang("phone") ?> : </label>
                                <div class="col-lg-10">
                                    <input type="tel" class="form-control" name="phone" placeholder="<?= lang("phone") ?>" minlength="11" maxlength="20" value="<?= !empty(set_value('phone')) ? set_value('phone') : $user->phone ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label"><?= lang("password") ?> : </label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" name="password" placeholder="<?= lang("password") ?>" minlength="6" value="<?= !empty(set_value('password')) ? set_value('password') : null ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-lg-2 col-form-label"><?= lang("passwordRepeat") ?> : </label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" name="passwordRepeat" placeholder="<?= lang("passwordRepeat") ?>" minlength="6" <?= !empty(set_value('passwordRepeat')) ? set_value('passwordRepeat') : null ?>>
                                </div>
                            </div>

                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-10">
                                    <button aria-label="<?= $settings->company_name ?>" class="ulinaBTN px-3" type="submit"><span><?= lang("updateAccountDetails") ?></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /.cart-area -->

<!-- Address Modal -->
<div id="addressModal"></div>

<script>
    window.addEventListener('DOMContentLoaded', function() {
    });
</script>