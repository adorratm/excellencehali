<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if (!empty($data)) : ?>
    <div class="products-area py-3 py-lg-4">
        <div class="container-fluid">
            <div class="section-title">
                <h2 class="text-center text-dark-green mb-5"><?= $title ?></h2>
            </div>
            <div class="products-slider owl-theme owl-carousel">
                <?php foreach ($data as $key => $value) : ?>
                    <?php if (strtotime($value->sharedAt) <= strtotime("now")) : ?>
                        <div class="products-item h-100">
                            <div class="top">
                                <?php if ($value->isDiscount && (int)$value->discount > 0) : ?>
                                    <a rel="dofollow" href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/{$value->url}" . (!empty($_GET["key"]) ? "?key=" . clean($_GET["key"]) : null)) ?>" title="<?= $value->title ?>" class="product-type two">%<?= (int)$value->discount ?></a>
                                <?php endif ?>
                                <a rel="dofollow" href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/{$value->url}" . (!empty($_GET["key"]) ? "?key=" . clean($_GET["key"]) : null)) ?>" title="<?= $value->title ?>">
                                    <img width="1920" height="1280" loading="lazy" data-src="<?= get_picture("products_v", $value->img_url) ?>" alt="<?= $value->title ?>" class="img-fluid lazyload">
                                </a>
                                <div class="inner">
                                    <h3>
                                        <a rel="dofollow" href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/{$value->url}" . (!empty($_GET["key"]) ? "?key=" . clean($_GET["key"]) : null)) ?>" title="<?= $value->title ?>"><?= $value->title ?></a>
                                    </h3>
                                    <span>
                                        <?php $i = 1 ?>
                                        <?php $count = count(explode(",", $value->category_ids)) ?>
                                        <?php foreach (explode(",", $value->category_titles) as $k => $v) : ?>
                                            <?php $seo_url = explode(",", $value->category_seos)[$k]; ?>
                                            <?php if ($i < $count) : ?>
                                                <a style="color:#0d0d0dd1;" rel="dofollow" href="<?= base_url(lang("routes_products") . "/{$seo_url}" . (!empty($_GET["key"]) ? "?key=" . clean($_GET["key"]) : null)) ?>" title="<?= $v ?>"><?= $v ?></a>,
                                            <?php else : ?>
                                                <a style="color:#0d0d0dd1;" rel="dofollow" href="<?= base_url(lang("routes_products") . "/{$seo_url}" . (!empty($_GET["key"]) ? "?key=" . clean($_GET["key"]) : null)) ?>" title="<?= $v ?>"><?= $v ?></a>
                                            <?php endif ?>
                                            <?php $i++ ?>
                                        <?php endforeach ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif ?>