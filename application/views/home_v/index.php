<?php if (!empty($slides)) : ?>
    <!-- BEGIN: Slider Section -->
    <section class="sliderSection02 mb117">
        <div class="rev_slider_wrapper">
            <div id="rev_slider_2" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.1">
                <ul>
                    <?php $i = 0 ?>
                    <?php foreach ($slides as $key => $value) : ?>
                        <?php if (strtotime($value->sharedAt) <= strtotime("now")) : ?>
                            <?php if ($value->allowButton) : ?>
                                <?php $sUrl = null; ?>
                                <?php if (!empty($value->button_url)) : ?>
                                    <?php $sUrl = $value->button_url ?>
                                <?php endif ?>
                                <?php if (!empty($value->category_id) && $value->category_id > 0) : ?>
                                    <?php $sCategory = $this->general_model->get("product_categories", null, ["isActive" => 1, "id" => $value->category_id]); ?>
                                    <?php if (!empty($sCategory)) : ?>
                                        <?php $sUrl = base_url(lang("routes_products") . "/" . $sCategory->seo_url) ?>
                                    <?php endif ?>
                                <?php endif ?>
                                <?php if (!empty($value->product_id) && $value->product_id > 0) : ?>
                                    <?php $sProduct = $this->general_model->get("products", null, ["isActive" => 1, "id" => $value->product_id]); ?>
                                    <?php if (!empty($sProduct)) : ?>
                                        <?php $sUrl = base_url(lang("routes_products") . "/" . lang("routes_product") . "/" . $sProduct->url) ?>
                                    <?php endif ?>
                                <?php endif ?>
                                <?php if (!empty($value->page_id) && $value->page_id > 0) : ?>
                                    <?php $sPage = $this->general_model->get("product_categories", null, ["isActive" => 1, "id" => $value->page_id]); ?>
                                    <?php if (!empty($sPage)) : ?>
                                        <?php $sUrl = base_url(lang("routes_products") . "/" . $sPage->url) ?>
                                    <?php endif ?>
                                <?php endif ?>
                                <?php if (!empty($value->service_id) && $value->service_id > 0) : ?>
                                    <?php $sService = $this->general_model->get("services", null, ["isActive" => 1, "id" => $value->service_id]); ?>
                                    <?php if (!empty($sService)) : ?>
                                        <?php $sUrl = base_url(lang("routes_services") . "/" . lang("routes_service_detail") . "/" . $sService->url) ?>
                                    <?php endif ?>
                                <?php endif ?>
                                <?php if (!empty($value->sector_id) && $value->sector_id > 0) : ?>
                                    <?php $sSector = $this->general_model->get("sectors", null, ["isActive" => 1, "id" => $value->sector_id]); ?>
                                    <?php if (!empty($sSector)) : ?>
                                        <?php $sUrl = base_url(lang("routes_sectors") . "/" . lang("routes_sector_detail") . "/" . $sSector->url) ?>
                                    <?php endif ?>
                                <?php endif ?>
                            <?php endif ?>
                            <li data-index="rs-<?= $i ?>" data-transition="random-premium" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="1000" data-thumb="" data-rotate="0" data-saveperformance="off" data-title="" data-param1="01" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                                <img src="<?= get_picture("slides_v", $value->img_url) ?>" alt="<?= $value->title ?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="0" class="rev-slidebg lazyload" data-no-retina />
                                <?php if (!empty($value->allowButton) && !empty($value->button_caption) && !empty($sUrl)) : ?>
                                    <div class="tp-caption ws_nowrap textLayer" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['144','144','134','80']" data-fontsize="16" data-fontweight="500" data-lineheight="55" data-width="['auto','auto','100%','100%']" data-height="auto" data-whitesapce="normal" data-color="#FFFFFF" data-type="text" data-responsive_offset="off" data-frames='[{"delay":1300,"speed":600,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"power4.inOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"power3.inOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="['0','0','0','0']" data-paddingright="['0','0','0','0']" data-paddingbottom="['0','0','0','0']" data-paddingleft="['0','0','0','0']"><a href="<?= $sUrl ?>" rel="dofollow" class="ulinaBTN ulinaSliderBTN text-capitalize" title="<?= $value->button_caption ?>"><span>Explore Now</span></a></div>
                                <?php endif ?>
                            </li>
                            <?php $i++ ?>
                        <?php endif ?>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </section>
    <!-- END: Slider Section -->
<?php endif ?>

<!--=================  About Section Start Here ================= -->
<?php if (!empty($pages[array_keys($pages)[0]])) : ?>
    <?php $aboutPage = $pages[array_keys($pages)[0]] ?>
    <?php if ($aboutPage->id == 1) : ?>
        <section class="aboutPageSection01">
            <div class="container">
                <div class="row mb117">
                    <div class="col-xl-6 noPaddingRight">
                        <div class="aboutImage">
                            <img width="1000" height="1000" data-src="<?= get_picture("pages_v", $aboutPage->img_url) ?>" title="<?= $aboutPage->title ?>" alt="<?= $aboutPage->title ?>" class="lazyload img-fluid" loading="lazy">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="aboutContent">
                            <h3 class="secSubTitle text-capitalize"><?= $settings->company_name ?></h3>
                            <h2 class="secTitle"><?= $aboutPage->title ?></h2>
                            <div class="abDesc">
                                <?= strip_tags(mb_word_wrap($aboutPage->content, 775, "...")) ?>
                            </div>
                            <a class="ulinaBTN" href="<?= base_url(lang("routes_page") . "/" . $aboutPage->url) ?>" rel="dofollow" title="<?= $aboutPage->title ?>">
                                <span><?= $aboutPage->title ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif ?>
<?php endif ?>
<!--================= About Section End Here ================= -->

<!-- Our Facts section -->
<section class="featureSection2 mb117">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="iconBox01 ib01LightMode">
                    <i class="fa fa-city fa-2x mx-auto"></i>
                    <h3>Free Shipping</h3>
                    <p>
                        Ut enim ad minim veniam liquip ami tomader
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="iconBox01 ib01LightMode">
                    <i class="fa fa-city fa-2x mx-auto"></i>
                    <h3>Secure Payments</h3>
                    <p>
                        Eonim ad minim veniam liquip tomader
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="iconBox01 ib01LightMode">
                    <i class="fa fa-city fa-2x mx-auto"></i>
                    <h3>Easy Returns</h3>
                    <p>
                        Be enim ad minim veniam liquipa ami tomader
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="iconBox01 ib01LightMode">
                    <i class="fa fa-city fa-2x mx-auto"></i>
                    <h3>24/7 Support</h3>
                    <p>
                        Ut enim ad minim veniam liquip ami tomader
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<?php if (empty($homeitems)) : ?>
    <!--=================  Popular Topics Section Start Here ================= -->
    <div class="react_populars_topics react_populars_topics2 pt---60 pb---60">
        <div class="container">
            <div class="row home-top">
                <?php foreach ($homeitems as $key => $value) : ?>
                    <?php if (strtotime($value->sharedAt) <= strtotime("now")) : ?>
                        <div class="col-md-3 mb-3 align-items-stretch align-content-stretch align-self-stretch">
                            <div class="item__inner h-100">
                                <div class="icon">
                                    <img width="44" height="40" class="lazyload" data-src="<?= get_picture("homeitems_v", $value->img_url) ?>" title="<?= $value->title ?>" alt="<?= $value->title ?>">
                                </div>
                                <div class="react-content">
                                    <h3 class="react-title"><?= $value->title ?></h3>
                                    <?= $value->content ?>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <!--=================  Popular Topics Section End Here ================= -->
<?php endif ?>

<?php if (empty($homeitemsFooter)) : ?>
    <!--=================  Popular Topics Section Start Here ================= -->
    <div class="react_populars_topics react_populars_topics2 pt---60 pb---60 graybg-home">
        <div class="container">
            <div class="row">
                <?php foreach ($homeitemsFooter as $key => $value) : ?>
                    <?php if (strtotime($value->sharedAt) <= strtotime("now")) : ?>
                        <div class="col-md-3 mb-3 align-items-stretch align-content-stretch align-self-stretch">
                            <div class="item__inner h-100">
                                <div class="icon">
                                    <img width="44" height="40" class="lazyload" data-src="<?= get_picture("homeitems_v", $value->img_url) ?>" title="<?= $value->title ?>" alt="<?= $value->title ?>">
                                </div>
                                <div class="react-content">
                                    <h3 class="react-title"><?= $value->title ?></h3>
                                    <?= $value->content ?>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <!--=================  Popular Topics Section End Here ================= -->
<?php endif ?>

<?php if (!empty($settings->instagram)) : ?>
    <?php $userName = str_replace("/", "", (str_replace("https://www.instagram.com/", "", str_replace("https://instagram.com/", "", $settings->instagram)))); ?>

    <?php
    if (!empty($userName)) :
        $this->instastory->login($settings->crawler_email, $settings->crawler_password);
        $this->instastory->getProfile($userName);
        $medias = $this->instastory->getMedias();
        $downloadMedias = $this->instastory->downloadMedias();
    ?>
        <section class="instagramSection is02">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="secTitle"><?= lang("followUsOnInstagram") ?> <a rel="nofollow" href="<?= $settings->instagram ?>" target="_blank" title="Instagram">@<?= $userName ?></a></h2>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($medias as $mediaKey => $mediaValue) : ?>
                        <?php $url = substr(str_replace('/', '-', parse_url($mediaValue->getDisplaySrc(), PHP_URL_PATH)), 1); ?>
                        <div class="col-lg-3 mb-3">
                            <a rel="nofollow" title="<?= $settings->company_name ?>" href="<?= $mediaValue->getLink() ?>" target="_blank" class="instagramPhoto imgPopup">
                                <img data-src="<?= get_picture("instastory", $url) ?>" style="max-height:300px;object-fit:cover" class="img-fluid lazyload" alt="<?= $settings->company_name ?>">
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </section>
    <?php endif ?>
<?php endif ?>