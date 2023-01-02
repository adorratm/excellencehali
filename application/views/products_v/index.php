<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" style="background-image: url(<?= !empty($products_category) && !empty($products_category->img_url) ? get_picture("product_categories_v", $products_category->banner_url) : get_picture("settings_v", $settings->product_logo) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pageBannerContent text-center">
                    <h2 class="text-white mb-0"><?= !empty($products_category) ? strto("lower|ucwords", $products_category->title) : strto("lower|ucwords", lang("products")) ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Page Banner Section -->


<!-- Shop section -->
<section class="shop-section">
    <div class="auto-container">
        <div class="row align-items-stretch align-self-stretch align-content-stretch">
            <?php $j = 0 ?>
            <?php foreach ($product_categories as $k => $v) : ?>
                <div class="col-lg-12 justify-content-center text-center">
                    <h2 class="font-weight-bold text-center mx-auto mb-5 p-3" <?= $j % 2 == 0 ? 'style="width: fit-content;border:3px solid #e10018;border-top:unset;border-right:unset"' : 'style="width: fit-content;border:3px solid #e10018;border-top:unset;border-left:unset"' ?>><?= $v->title ?></h2>
                </div>
                <?php if (!empty($products)) : ?>
                    <?php foreach ($products as $key => $value) : ?>
                        <?php if (strtotime($value->sharedAt) <= strtotime("now")) : ?>
                            <div class="col-lg-3 col-md-6 shop-block mb-4">
                                <div class="inner-box mb-0 h-100 shadow-sm p-3 border rounded">
                                    <div class="image"><a rel="dofollow" href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/{$value->url}") ?>" title="<?= $value->title ?>"> <img width="1920" height="1280" loading="lazy" data-src="<?= get_picture("products_v", $value->img_url) ?>" title="<?= $value->title ?>" alt="<?= $value->title ?>" class="img-fluid lazyload"></a></div>
                                    <div class="content-upper mb-0 border-0">
                                        <h3><a class="text-dark" rel="dofollow" href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/{$value->url}") ?>" title="<?= $value->title ?>"><?= $value->title ?></a></h3>
                                    </div>
                                    <div class="w-100 px-3">
                                        <a class="btn rounded-0 btn-block border technicalInformationButton" rel="dofollow" href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/{$value->url}") ?>" title="<?= $value->title ?>"><?= lang("viewTechnicalInformation") ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                <?php else : ?>
                    <div class="alert alert-danger col-12" role="alert">
                        <h4 class="alert-heading"><?= lang("warning") ?>!</h4>
                        <hr>
                        <p><?= lang("categoryEmpty") ?></p>
                    </div>
                <?php endif ?>
                <?php $j++ ?>
            <?php endforeach ?>
        </div>
        <?= @$links ?>
    </div>
</section>