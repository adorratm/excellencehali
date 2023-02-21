<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $addressTitles = @json_decode($settings->address_title, TRUE); ?>
<?php $phones = @json_decode($settings->phone, TRUE); ?>
<?php $faxes = @json_decode($settings->fax, TRUE); ?>
<?php $addresses = @json_decode($settings->address, TRUE); ?>
<?php $whatsapps = @json_decode($settings->whatsapp, TRUE); ?>
<?php $maps = @json_decode($settings->map, TRUE); ?>
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" style="background-image: url(<?= get_picture("settings_v", $settings->contact_logo) ?>);">
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

<!-- BEGIN: Map Section -->
<section class="ulinaMapSection">
    <div class="ulinaContactMap contact-map">
        <?= @htmlspecialchars_decode(@$maps[0]) ?>
    </div>
</section>
<!-- END: Map Section -->

<!-- Contact info section two -->
<section class="latestArrivalSection">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-12">
                <h2 class="secTitle"><?= lang("contactInformation") ?></h2>
                <p class="secDesc"><?= $settings->company_name ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="contactCarousel owl-carousel">
                    <?php foreach ($addresses as $key => $value) : ?>
                        <div class="productItem01 border p-3">
                            <div class="pi01Details">
                                <h4 class="text-center"><?= @$addressTitles[$key] ?></h4>
                                <ul class="nav">
                                    <?php if (!empty($value)) : ?>
                                        <li class="nav-item my-2">
                                            <div class="contactItem">
                                                <span><i class="fa fa-map-marker"></i></span>
                                                <h5><?= lang("address") ?></h5>
                                                <p><?= @$value ?></p>
                                            </div>
                                        </li>
                                    <?php endif ?>
                                    <?php if (!empty($phones[$key])) : ?>
                                        <li class="nav-item my-2">
                                            <a href="tel:<?= @str_replace(" ", "", @$phones[$key]) ?>">
                                                <div class="contactItem">
                                                    <span><i class="fa fa-phone-volume"></i></span>
                                                    <h5><?= lang("phone") ?></h5>
                                                    <p><?= @$phones[$key] ?></p>
                                                </div>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php if (!empty($faxes[$key])) : ?>
                                        <li class="nav-item my-2">
                                            <a href="tel:<?= @str_replace(" ", "", @$faxes[$key]) ?>">
                                                <div class="contactItem">
                                                    <span><i class="fa fa-fax"></i></span>
                                                    <h5><?= lang("fax") ?></h5>
                                                    <p><?= @$faxes[$key] ?></p>
                                                </div>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php if (!empty($whatsapps[$key])) : ?>
                                        <li class="nav-item my-2">
                                            <a href="https://api.whatsapp.com/send?phone=<?= @str_replace(" ", "", @$whatsapps[$key]) ?>&amp;text=<?= urlencode(lang("hello") . " " . $settings->company_name) ?>.">
                                                <div class="contactItem">
                                                    <span><i class="fa fa-whatsapp"></i></span>
                                                    <h5><?= lang("whatsapp") ?></h5>
                                                    <p><?= @$whatsapps[$key] ?></p>
                                                </div>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <li class="nav-item my-2">
                                        <a href="mailto:<?= $settings->email ?>">
                                            <div class="contactItem">
                                                <span><i class="fa fa-envelope-open"></i></span>
                                                <h5><?= lang("mail") ?></h5>
                                                <p><?= $settings->email ?></p>
                                            </div>
                                        </a>
                                    </li>
                                    <?php if (!empty($maps[$key])) : ?>
                                        <li class="nav-item my-2">
                                            <a href="<?= base_url() ?>" onclick="event.preventDefault();event.stopImmediatePropagation();$('.contact-map').html('<?= $maps[$key] ?>');$('html, body').animate({scrollTop: ($('.contact-map').offset().top - $('.header-upper').height())}, 'slow');">
                                                <div class="contactItem">
                                                    <span><i class="fa fa-map-marker"></i></span>
                                                    <h5><?= lang("map") ?></h5>
                                                    <p><?= lang("viewOnMap") ?></p>
                                                </div>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                                <ul class="nav nav-justified border-top pt-3">
                                    <?php if (!empty($settings->facebook)) : ?>
                                        <li class="align-items-center my-auto py-auto align-self-center nav-item">
                                            <a rel="dofollow" href="<?= $settings->facebook ?>" title="Facebook" target="_blank">
                                                <i class='fa fa-facebook color fa-2x'></i>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php if (!empty($settings->twitter)) : ?>
                                        <li class="align-items-center my-auto py-auto align-self-center nav-item">
                                            <a rel="dofollow" href="<?= $settings->twitter ?>" title="Twitter" target="_blank">
                                                <i class='fa fa-twitter color fa-2x'></i>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php if (!empty($settings->instagram)) : ?>
                                        <li class="align-items-center my-auto py-auto align-self-center nav-item">
                                            <a rel="dofollow" href="<?= $settings->instagram ?>" title="Instagram" target="_blank">
                                                <i class='fa fa-instagram color fa-2x'></i>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php if (!empty($settings->linkedin)) : ?>
                                        <li class="align-items-center my-auto py-auto align-self-center nav-item">
                                            <a rel="dofollow" href="<?= $settings->linkedin ?>" title="Linkedin" target="_blank">
                                                <i class='fa fa-linkedin color fa-2x'></i>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php if (!empty($settings->youtube)) : ?>
                                        <li class="align-items-center my-auto py-auto align-self-center nav-item">
                                            <a rel="dofollow" href="<?= $settings->youtube ?>" title="Youtube" target="_blank">
                                                <i class='fa fa-youtube color fa-2x'></i>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php if (!empty($settings->medium)) : ?>
                                        <li class="align-items-center my-auto py-auto align-self-center nav-item">
                                            <a rel="dofollow" href="<?= $settings->medium ?>" title="Medium" target="_blank">
                                                <i class='fa fa-medium color fa-2x'></i>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                    <?php if (!empty($settings->pinterest)) : ?>
                                        <li class="align-items-center my-auto py-auto align-self-center nav-item">
                                            <a rel="dofollow" href="<?= $settings->pinterest ?>" title="Pinterest" target="_blank">
                                                <i class='fa fa-pinterest color fa-2x'></i>
                                            </a>
                                        </li>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BEGIN: Contact Section -->
<section class="latestArrivalSection">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="secTitle"><?= lang("contactForm") ?></h2>
                <p class="secDesc"><?= lang("contactFormDesc") ?></p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8">
                <form onsubmit="return false" enctype="multipart/form-data" method="POST" id="contact-form" class="contactForm">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="full_name" id="full_name" placeholder="<?= lang("namesurname") ?>" required minlength="2" maxlength="70">
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" id="email" placeholder="<?= lang("emailaddress") ?>" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="phone" id="phone" placeholder="<?= lang("phonenumber") ?>" required minlength="11" maxlength="19">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="subject" id="subject" placeholder="<?= lang("subject") ?>" required>
                        </div>
                        <div class="col-md-12">
                            <textarea name="comment" id="comment" cols="30" rows="8" placeholder="<?= lang("message") ?>" required></textarea>
                        </div>
                        <?php $securityPolicy = $this->general_model->get("pages", null, ["isActive" => 1, "id" => 6]) ?>
                        <?php $kvkk = $this->general_model->get("pages", null, ["isActive" => 1, "id" => 9]) ?>
                        <?php $securityPolicyUrl = '<a href="' . base_url(lang("routes_page") . "/" . $securityPolicy->url) . '" rel="dofollow" title="' . $securityPolicy->title . '">' . $securityPolicy->title . '</a>'; ?>
                        <?php $kvkkUrl = '<a href="' . base_url(lang("routes_page") . "/" . $kvkk->url) . '" rel="dofollow" title="' . $kvkk->title . '">' . $kvkk->title . '</a>'; ?>
                        <?php $companyName = '<a href="' . base_url() . '" rel="dofollow" title="' . $settings->company_name . '">' . $settings->company_name . '</a>'; ?>
                        <?php $kvkkMessage = str_replace("@kvkk@", $kvkkUrl, lang("kvkkMessage")) ?>
                        <?php $kvkkMessage = str_replace("@companyName@", $companyName, $kvkkMessage) ?>
                        <?php $kvkkMessage = str_replace("@securityPolicy@", $securityPolicyUrl, $kvkkMessage) ?>
                        <div class="col-md-12">
                            <div class="form-group d-flex">
                                <label for="kvkkMessage" class="cbx">
                                    <input type="checkbox" name="kvkkMessage" required id="kvkkMessage" class="me-3">
                                    <span class="checkmark"></span>
                                    <p><?= $kvkkMessage ?></p>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="ulinaBTN btnSubmitForm" aria-label="<?= $settings->company_name ?>" type="submit" data-url="<?= base_url(lang("routes_contact-form")) ?>">
                                <span class="px-3"><?= lang("submit") ?></span>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                </form>
            </div>
        </div>
    </div>
</section>
<!-- END Contact Section -->