<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!--Main Footer-->
<footer class="main-footer">
    <div class="upper-box">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="widget about-widget links-widget">
                        <?php if (!empty($settings->mobile_logo)) : ?>
                            <div class="logo text-center">
                                <a rel="dofollow" href="<?= base_url() ?>" title="<?= $settings->company_name ?>">
                                    <picture>
                                        <img loading="lazy" width="250" height="250" data-src="<?= get_picture("settings_v", $settings->mobile_logo) ?>" alt="<?= $settings->company_name ?>" class="lazyload img-fluid">
                                    </picture>
                                </a>
                            </div>
                        <?php endif ?>
                        <ul class="social-links text-center">
                            <?php if (!empty($settings->facebook)) : ?>
                                <li>
                                    <a rel="nofollow" href="<?= $settings->facebook ?>" title="Facebook" target="_blank">
                                        <i class='fa fa-facebook color'></i>
                                    </a>
                                </li>
                            <?php endif ?>
                            <?php if (!empty($settings->twitter)) : ?>
                                <li>
                                    <a rel="nofollow" href="<?= $settings->twitter ?>" title="Twitter" target="_blank">
                                        <i class='fa fa-twitter color'></i>
                                    </a>
                                </li>
                            <?php endif ?>
                            <?php if (!empty($settings->instagram)) : ?>
                                <li>
                                    <a rel="nofollow" href="<?= $settings->instagram ?>" title="Instagram" target="_blank">
                                        <i class='fa fa-instagram color'></i>
                                    </a>
                                </li>
                            <?php endif ?>
                            <?php if (!empty($settings->linkedin)) : ?>
                                <li>
                                    <a rel="nofollow" href="<?= $settings->linkedin ?>" title="Linkedin" target="_blank">
                                        <i class='fa fa-linkedin color'></i>
                                    </a>
                                </li>
                            <?php endif ?>
                            <?php if (!empty($settings->youtube)) : ?>
                                <li>
                                    <a rel="nofollow" href="<?= $settings->youtube ?>" title="Youtube" target="_blank">
                                        <i class='fa fa-youtube color'></i>
                                    </a>
                                </li>
                            <?php endif ?>
                            <?php if (!empty($settings->medium)) : ?>
                                <li>
                                    <a rel="nofollow" href="<?= $settings->medium ?>" title="Medium" target="_blank">
                                        <i class='fa fa-medium color'></i>
                                    </a>
                                </li>
                            <?php endif ?>
                            <?php if (!empty($settings->pinterest)) : ?>
                                <li>
                                    <a rel="nofollow" href="<?= $settings->pinterest ?>" title="Pinterest" target="_blank">
                                        <i class='fa fa-pinterest color'></i>
                                    </a>
                                </li>
                            <?php endif ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-6">
                    <div class="row justify-content-lg-between">
                        <?php if (!empty($footer_menus)) : ?>
                            <div class="col-lg-2 col-md-6">
                                <div class="widget links-widget">
                                    <h3 class="widget_title"><?= lang("corporate") ?></h3>
                                    <div class="widget-content">
                                        <?= $footer_menus ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php if (!empty($footer_product_categories)) : ?>
                            <div class="col-lg-2 col-md-6">
                                <div class="widget links-widget">
                                    <h3 class="widget_title"><?= strto("lower|ucwords",lang("products")) ?></h3>
                                    <div class="widget-content">
                                        <ul class="list">
                                            <?php foreach ($footer_product_categories as $key => $value) : ?>
                                                <li><a rel="dofollow" href="<?= base_url(lang("routes_products") . "/" . $value->seo_url) ?>" title="<?= $value->title ?>"><?= $value->title ?></a></li>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php if (!empty($footer_technical_information_categories)) : ?>
                            <div class="col-lg-2 col-md-6">
                                <div class="widget links-widget">
                                    <h3 class="widget_title"><?= strto("lower|ucwords",lang("technicalInformations")) ?></h3>
                                    <div class="widget-content">
                                        <ul class="list">
                                            <?php foreach ($footer_technical_information_categories as $key => $value) : ?>
                                                <li><a rel="dofollow" href="<?= base_url(lang("routes_technical_informations") . "/" . $value->seo_url) ?>" title="<?= $value->title ?>"><?= $value->title ?></a></li>
                                            <?php endforeach ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php if (!empty($footer_menus2)) : ?>
                            <div class="col-lg-2 col-md-6">
                                <div class="widget links-widget">
                                    <h3 class="widget_title"><?= lang("sustainability") ?></h3>
                                    <?= $footer_menus2 ?>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php if (!empty($footer_menus3)) : ?>
                            <div class="col-lg-2 col-md-6">
                                <div class="widget links-widget">
                                    <h3 class="widget_title"><?= lang("menus") ?></h3>
                                    <?= $footer_menus3 ?>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
<!--End Main Footer-->

<div class="footer-bottom">
    <div class="auto-container">
        <div class="wrapper-box">
            <div class="row m-0 align-items-center justify-content-between">
                <div class="copyright-text">© 2022 <a rel="dofollow" class="text-white" href="<?= base_url() ?>" title="<?= $settings->company_name ?>"><?= $settings->company_name ?></a> <?= lang("allRightsReserved") ?></div>
                <ul class="menu">
                    <li><a rel="nofollow" href="https://mutfakyapim.com" target="_blank" title="Mutfak Yapım Dijital Reklam Ajansı"><img loading="lazy" data-src="https://mutfakyapim.com/images/mutfak/logo.png" class="lazyload" height="40" width="176" alt="Mutfak Yapım Dijital Reklam Ajansı"></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<!--================= Wrapper End Here =================-->
</div>
<!--================= Footer Section End Here =================-->

<!--================= Scroll to Top Start =================-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-left"></span></div>

<!--================= Scroll to Top End =================-->
<!-- Jquery -->

<script src="<?= asset_url("public/js/jquery.min.js") ?>"></script>
<script>
    jQuery.event.special.touchstart = {
        setup: function(_, ns, handle) {
            this.addEventListener("touchstart", handle, {
                passive: !ns.includes("noPreventDefault")
            });
        }
    };
    jQuery.event.special.touchmove = {
        setup: function(_, ns, handle) {
            this.addEventListener("touchmove", handle, {
                passive: !ns.includes("noPreventDefault")
            });
        }
    };
    jQuery.event.special.wheel = {
        setup: function(_, ns, handle) {
            this.addEventListener("wheel", handle, {
                passive: true
            });
        }
    };
    jQuery.event.special.mousewheel = {
        setup: function(_, ns, handle) {
            this.addEventListener("mousewheel", handle, {
                passive: true
            });
        }
    };
</script>
<!-- #Jquery -->
<!--FOOTER END-->
<?php if (!empty(@json_decode($settings->phone, TRUE)[0])) : ?>
    <a rel="dofollow" class="fixed-phone bg-danger d-none" href="tel:<?= @json_decode($settings->phone, TRUE)[0] ?>" title="<?= lang("phone") ?>" data-toggle="tooltip" data-placement="top"><i class="fa fa-phone"></i></a>
<?php endif ?>
<?php if (!empty(@json_decode($settings->whatsapp, TRUE)[0])) : ?>
    <a rel="nofollow" target="_blank" class="fixed-whatsapp bg-success" href="https://api.whatsapp.com/send?phone=<?= str_replace(" ", "", @json_decode($settings->whatsapp, TRUE)[0]) ?>&amp;text=<?= urlencode(lang("hello") . " " . $settings->company_name) ?>." title="WhatsApp" data-toggle="tooltip" data-placement="top"><i class="fa fa-whatsapp"></i></a>
<?php endif ?>
<?php if (!empty($settings->linkedin)) : ?>
    <a rel="dofollow" class="fixed-phone bg-primary" href="<?= $settings->linkedin ?>" target="_blank" title="Linkedin" data-toggle="tooltip" data-placement="top"><i class="fa fa-linkedin"></i></a>
<?php endif ?>
<!--layout end-->
<!-- SCRIPTS -->
<!-- Lazysizes -->
<script async defer src="<?= asset_url("public/js/lazysizes.min.js") ?>"></script>
<!-- #Lazysizes -->

<!-- iziToast -->
<script defer src="<?= asset_url("public/js/iziToast.min.js") ?>"></script>
<!-- #iziToast -->

<script defer src="<?= asset_url("public/js/lightgallery-all.min.js") ?>"></script>

<!-- Site Scripts -->
<script defer src="<?= asset_url("public/js/jquery-migrate.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/jquery-ui.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/bootstrap.bundle.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/shuffle.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/owl.carousel.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/owl.carousel.filter.js") ?>"></script>
<script defer src="<?= asset_url("public/js/jquery.appear.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/jquery.nice-select.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/slick.js") ?>"></script>
<script defer src="<?= asset_url("public/js/jquery.plugin.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/jquery.countdown.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/circle-progress.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/jquery.themepunch.tools.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/jquery.themepunch.revolution.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/extensions/revolution.extension.actions.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/extensions/revolution.extension.carousel.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/extensions/revolution.extension.kenburn.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/extensions/revolution.extension.layeranimation.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/extensions/revolution.extension.migration.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/extensions/revolution.extension.navigation.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/extensions/revolution.extension.parallax.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/extensions/revolution.extension.slideanims.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/extensions/revolution.extension.video.min.js") ?>"></script>

<script async defer src="<?= asset_url("public/js/sweetalert.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/theme.js") ?>"></script>
<script defer src="<?= asset_url("public/js/app.js") ?>"></script>
<!-- #Site Scripts -->

<!-- SCRIPTS -->
<script>
    window.addEventListener('DOMContentLoaded', function() {
        $(document).on("click", ".map-address", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let dest = $(this).data("destination");
            if (navigator.geolocation) {
                if ((navigator.platform.indexOf("iPhone") != -1) ||
                    (navigator.platform.indexOf("iPad") != -1) ||
                    (navigator.platform.indexOf("iPod") != -1))
                    window.open("comgooglemapsurl://maps.google.com/maps/dir/?api=1&destination=" + dest + "&travelmode=driving");
                else {
                    window.open("https://www.google.com/maps/dir/?api=1&destination=" + dest + "&travelmode=driving");
                }
            } else {
                iziToast.show({
                    type: "error",
                    title: "<?= lang("error") ?>",
                    message: "<?= lang("allowGeoLocation") ?>",
                    position: "topCenter"
                });
            }
        });
    });
</script>
<?php $this->load->view("includes/alert") ?>
</body>

</html>