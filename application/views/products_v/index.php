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

<?php if (!empty($product_categories)) : ?>
    <!-- END: Collections Section -->
    <section class="collectionsSections">
        <div class="container">
            <div class="row collectionProductRow">
                <?php foreach ($product_categories as $k => $v) : ?>
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="productItem01">
                            <div class="pi01Thumb">
                                <img data-src="<?= get_picture("product_categories_v", $v->img_url) ?>" class="img-fluid lazyload" alt="<?= $v->title ?>" title="<?= $v->title ?>" />
                                <img data-src="<?= get_picture("product_categories_v", $v->img_url) ?>" class="img-fluid lazyload" alt="<?= $v->title ?>" title="<?= $v->title ?>" />
                                <div class="pi01Actions">
                                    <a href="<?= base_url(lang("routes_products") . "/" . $v->seo_url) ?>" rel="dofollow" title="<?= lang("viewProducts") ?>"><i class="fa-solid fa-arrows-up-down-left-right"></i></a>
                                </div>
                            </div>
                            <div class="pi01Details">
                                <h3 class="secTitle text-center"><a href="<?= base_url(lang("routes_products") . "/" . $v->seo_url) ?>" rel="dofollow" title="<?= lang("viewProducts") ?>"><?= $v->title ?></a></h3>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <?= @$links ?>
        </div>
    </section>
    <!-- END: Collections Section -->
<?php endif ?>


<?php if (!empty($products)) : ?>
    <!-- BEGIN: Shop Page Section -->
    <section class="shopPageSection">
        <div class="container">
            <div class="row shopAccessRow">
                <div class="col-sm-6 col-xl-4">
                    <div class="productCount">Showing <strong>1 - 16</strong> of <strong>220</strong> items</div>
                </div>
                <div class="d-none col-lg-4 col-xl-4 d-xl-flex">
                    <ul class="filterUL">
                        <li class="active">All</li>
                        <li>Men</li>
                        <li>Women</li>
                        <li>Kids</li>
                        <li>Accesories</li>
                    </ul>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="shopAccessBar">
                        <div class="filterNav">
                            <a href="javascript:void(0);">Filter<i class="fa-solid fa-sliders"></i></a>
                        </div>
                        <div class="sortNav">
                            <form method="post" action="#">
                                <label>Sort By</label>
                                <select name="productFilter">
                                    <option value="">Default</option>
                                    <option value="1">High to low</option>
                                    <option value="2">Low to high</option>
                                    <option value="3">Top rated</option>
                                    <option value="4">Recently viewed</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row shopProductRow">
                <?php foreach ($products as $key => $value) : ?>
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="productItem01">
                            <div class="pi01Thumb">
                                <img loading="lazy" width="1000" height="1000" data-src="<?= get_picture("products_v", $value->img_url) ?>" alt="<?= $value->title ?>" title="<?= $value->title ?>" class="img-fluid lazyload" />
                                <?php $secondaryImage = get_secondary_image($value->codes_id, $value->codes, $value->img_url, $lang) ?>
                                <?php if (!empty($secondaryImage)) : ?>
                                    <img loading="lazy" width="1000" height="1000" data-src="<?= get_picture("products_v", $secondaryImage) ?>" alt="<?= $value->title ?>" title="<?= $value->title ?>" class="img-fluid lazyload">
                                <?php endif ?>
                                <div class="pi01Actions">
                                    <a href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/" . $value->seo_url) ?>" rel="dofollow" title="<?= $value->title ?>"><i class="fa-solid fa-arrows-up-down-left-right"></i></a>
                                </div>
                                <?php if (!empty($value->discounted_price)) : ?>
                                    <div class="productLabels clearfix">
                                        <span class="plDis"><?= lang("discountedProduct") ?></span>
                                    </div>
                                <?php endif ?>
                            </div>
                            <div class="pi01Details">
                                <h3><a href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/" . $value->seo_url) ?>" rel="dofollow" title="<?= $value->title ?>"><?= $value->title ?></a></h3>
                                <div class="pi01Price">
                                    <ins><?= !empty($value->discounted_price) ? $value->discounted_price : $value->price ?></ins>
                                    <?php if (!empty($value->discounted_price)) : ?>
                                        <del><?= $value->price ?></del>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="row shopPaginationRow">
                <div class="col-lg-12 text-center">
                    <?= @$links ?>
                </div>
            </div>
        </div>
    </section>
    <!-- END: Shop Page Section -->
<?php endif ?>