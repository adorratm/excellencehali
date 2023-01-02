<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $addressTitles = @json_decode($settings->address_title, TRUE); ?>
<?php $phones = @json_decode($settings->phone, TRUE); ?>
<?php $faxes = @json_decode($settings->fax, TRUE); ?>
<?php $addresses = @json_decode($settings->address, TRUE); ?>
<?php $whatsapps = @json_decode($settings->whatsapp, TRUE); ?>
<?php $maps = @json_decode($settings->map, TRUE); ?>
<section class="page-title" style="background-image: url(<?= get_picture("settings_v", $settings->contact_logo) ?>);">
    <div class="auto-container">
        <div class="content-box">
            <div class="content-wrapper">
                <div class="title">
                    <h1><?= strto("lower|ucwords", lang("contact")) ?></h1>
                </div>
                <ul class="bread-crumb style-two">
                    <li><a rel="dofollow" href="<?= base_url(); ?>" title="<?= strto("lower|ucwords", lang("home")) ?>"><?= strto("lower|upper", lang("home")) ?></a></li>
                    <li class="active"><?= strto("lower|ucwords", lang("contact")) ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>



<!-- Map Section -->
<section class="map-section">
    <div class="contact-map">
        <?= @htmlspecialchars_decode(@$maps[0]) ?>
    </div>
</section>

<!-- Contact info section two -->
<section class="contact-info-section-two">
    <div class="auto-container">
        <div class="wrapper-box">
            <div class="sec-title text-center">
                <div class="sub-title"><?= $settings->company_name ?></div>
                <h2><?= lang("contactInformation") ?></h2>
            </div>
            <div class="row">
                <div class="theme_carousel owl-theme owl-carousel" style="overflow-x: hidden;" data-options='{"rewind": true, "center": false, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 6000, "smartSpeed": 1000, "responsive":{ "0" :{ "items": "1" }, "600" :{ "items" : "1" }, "768" :{ "items" : "2" } , "992":{ "items" : "3" }, "1200":{ "items" : "4" }}}'>
                    <?php foreach ($addresses as $key => $value) : ?>
                        <div class="col-lg-12 contact-info-block h-100">
                            <div class="inner-box h-100">
                                <div class="lower-content">
                                    <h4><?= @$addressTitles[$key] ?></h4>
                                    <ul>
                                        <?php if (!empty($value)) : ?>
                                            <li><?= @$value ?></li>
                                        <?php endif ?>
                                        <?php if (!empty($phones[$key])) : ?>
                                            <li><a href="tel:<?= @str_replace(" ", "", @$phones[$key]) ?>"><i class="fa fa-phone-volume"></i> <span><?= @$phones[$key] ?></span></a></li>
                                        <?php endif ?>
                                        <?php if (!empty($faxes[$key])) : ?>
                                            <li><a href="tel:<?= @str_replace(" ", "", @$faxes[$key]) ?>"><i class="fa fa-fax"></i> <span><?= @$faxes[$key] ?></span></a></li>
                                        <?php endif ?>
                                        <?php if (!empty($whatsapps[$key])) : ?>
                                            <li><a href="https://api.whatsapp.com/send?phone=<?= @str_replace(" ", "", @$whatsapps[$key]) ?>&amp;text=<?= urlencode(lang("hello") . " " . $settings->company_name) ?>."><i class="fa fa-whatsapp"></i> <span><?= @$whatsapps[$key] ?></span></a></li>
                                        <?php endif ?>
                                        <li><a href="mailto:<?= $settings->email ?>"><i class="fa fa-envelope-open"></i> <span><?= $settings->email ?></span></a></li>
                                        <?php if (!empty($maps[$key])) : ?>
                                            <li><a href="<?= base_url() ?>" onclick="event.preventDefault();event.stopImmediatePropagation();$('.contact-map').html('<?= $maps[$key] ?>');$('html, body').animate({scrollTop: ($('.contact-map').offset().top - $('.header-upper').height())}, 'slow');"><i class="fa fa-map-marker"></i> <?= lang("viewOnMap") ?></a></li>
                                        <?php endif ?>
                                    </ul>
                                    <ul class="d-flex align-items-center my-3 py-auto align-self-center justify-content-center justify-content-md-start">
                                        <?php if (!empty($settings->facebook)) : ?>
                                            <li class="mx-2 align-items-center my-auto py-auto align-self-center">
                                                <a rel="dofollow" href="<?= $settings->facebook ?>" title="Facebook" target="_blank">
                                                    <i class='fa fa-facebook color fa-2x'></i>
                                                </a>
                                            </li>
                                        <?php endif ?>
                                        <?php if (!empty($settings->twitter)) : ?>
                                            <li class="mx-2 align-items-center my-auto py-auto align-self-center">
                                                <a rel="dofollow" href="<?= $settings->twitter ?>" title="Twitter" target="_blank">
                                                    <i class='fa fa-twitter color fa-2x'></i>
                                                </a>
                                            </li>
                                        <?php endif ?>
                                        <?php if (!empty($settings->instagram)) : ?>
                                            <li class="mx-2 align-items-center my-auto py-auto align-self-center">
                                                <a rel="dofollow" href="<?= $settings->instagram ?>" title="Instagram" target="_blank">
                                                    <i class='fa fa-instagram color fa-2x'></i>
                                                </a>
                                            </li>
                                        <?php endif ?>
                                        <?php if (!empty($settings->linkedin)) : ?>
                                            <li class="mx-2 align-items-center my-auto py-auto align-self-center">
                                                <a rel="dofollow" href="<?= $settings->linkedin ?>" title="Linkedin" target="_blank">
                                                    <i class='fa fa-linkedin color fa-2x'></i>
                                                </a>
                                            </li>
                                        <?php endif ?>
                                        <?php if (!empty($settings->youtube)) : ?>
                                            <li class="mx-2 align-items-center my-auto py-auto align-self-center">
                                                <a rel="dofollow" href="<?= $settings->youtube ?>" title="Youtube" target="_blank">
                                                    <i class='fa fa-youtube color fa-2x'></i>
                                                </a>
                                            </li>
                                        <?php endif ?>
                                        <?php if (!empty($settings->medium)) : ?>
                                            <li class="mx-2 align-items-center my-auto py-auto align-self-center">
                                                <a rel="dofollow" href="<?= $settings->medium ?>" title="Medium" target="_blank">
                                                    <i class='fa fa-medium color fa-2x'></i>
                                                </a>
                                            </li>
                                        <?php endif ?>
                                        <?php if (!empty($settings->pinterest)) : ?>
                                            <li class="mx-2 align-items-center my-auto py-auto align-self-center">
                                                <a rel="dofollow" href="<?= $settings->pinterest ?>" title="Pinterest" target="_blank">
                                                    <i class='fa fa-pinterest color fa-2x'></i>
                                                </a>
                                            </li>
                                        <?php endif ?>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form section -->
<section class="contact-form-section style-four">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper-box">
                    <div class="sec-title">
                        <div class="sub-title"><?= $settings->company_name ?></div>
                        <h2><?= lang("contactForm") ?></h2>
                        <div class="text"><?= lang("contactFormDesc") ?></div>
                    </div>
                    <!--Contact Form-->
                    <div class="contact-form">
                        <form onsubmit="return false" enctype="multipart/form-data" method="POST" id="contact-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="full_name"><?= lang("namesurname") ?></label>
                                        <input type="text" name="full_name" id="full_name" placeholder="<?= lang("namesurname") ?>" required minlength="2" maxlength="70">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email"><?= lang("emailaddress") ?></label>
                                        <input type="email" name="email" id="email" placeholder="<?= lang("emailaddress") ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone"><?= lang("phonenumber") ?></label>
                                        <input type="text" name="phone" id="phone" placeholder="<?= lang("phonenumber") ?>" required minlength="11" maxlength="19">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone"><?= lang("subject") ?></label>
                                        <input type="text" name="subject" id="subject" placeholder="<?= lang("subject") ?>" required>
                                    </div>
                                </div>
                                <?php $securityPolicy = $this->general_model->get("pages", null, ["isActive" => 1, "id" => 9]) ?>
                                <?php $kvkk = $this->general_model->get("pages", null, ["isActive" => 1, "id" => 12]) ?>
                                <?php $securityPolicyUrl = '<a href="' . base_url(lang("routes_page") . "/" . $securityPolicy->url) . '" rel="dofollow" title="' . $securityPolicy->title . '">' . $securityPolicy->title . '</a>'; ?>
                                <?php $kvkkUrl = '<a href="' . base_url(lang("routes_page") . "/" . $kvkk->url) . '" rel="dofollow" title="' . $kvkk->title . '">' . $kvkk->title . '</a>'; ?>
                                <?php $companyName = '<a href="' . base_url() . '" rel="dofollow" title="' . $settings->company_name . '">' . $settings->company_name . '</a>'; ?>
                                <?php $kvkkMessage = str_replace("@kvkk@", $kvkkUrl, lang("kvkkMessage")) ?>
                                <?php $kvkkMessage = str_replace("@companyName@", $companyName, $kvkkMessage) ?>
                                <?php $kvkkMessage = str_replace("@securityPolicy@", $securityPolicyUrl, $kvkkMessage) ?>
                                <div class="col-md-12">
                                    <div class="form-group d-flex">
                                        <input type="checkbox" name="kvkkMessage" required id="kvkkMessage" class="w-auto d-flex mr-3"><label for="kvkkMessage" style="text-transform:unset"><?= $kvkkMessage ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="message"><?= lang("message") ?></label>
                                        <textarea name="comment" id="comment" cols="30" rows="8" placeholder="<?= lang("message") ?>" required></textarea>
                                        <div class="form-btn">
                                            <button class="theme-btn btn-style-one btnSubmitForm" aria-label="<?= $settings->company_name ?>" type="submit" data-url="<?= base_url(lang("routes_contact-form")) ?>"><span><i class="fa fa-arrow-right"></i><?= lang("submit") ?></span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        </form>
                    </div>
                    <!--End Contact Form-->
                </div>
            </div>
        </div>
    </div>
</section>