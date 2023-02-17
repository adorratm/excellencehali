<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" style="background-image: url(<?= get_picture("settings_v", $settings->about_logo) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pageBannerContent text-center">
                    <h2 class="text-white mb-0"><?= lang("dealerLogin") ?></h2>
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
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="email" name="email" placeholder="<?= lang("email") ?>" required />
                                </div>
                                <div class="col-lg-12">
                                    <input type="password" name="password" placeholder="<?= lang("password") ?>" required />
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                    <button type="submit" class="ulinaBTN w-100"><span><?= lang("login") ?></span></button>
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