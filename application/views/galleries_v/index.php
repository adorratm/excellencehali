<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Page Title -->
<section class="page-title" style="background-image: url(<?= get_picture("settings_v", $settings->gallery_logo) ?>);">
    <div class="auto-container">
        <div class="content-box">
            <div class="content-wrapper">
                <div class="title">
                    <h1><?= strto("lower|ucwords", lang("galleries")) ?></h1>
                </div>
                <ul class="bread-crumb style-two">
                    <li><a rel="dofollow" href="<?= base_url(); ?>" title="<?= strto("lower|ucwords", lang("home")) ?>"><?= strto("lower|ucwords", lang("home")) ?></a></li>
                    <li class="active"><?= strto("lower|ucwords", lang("galleries")) ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section">
    <div class="auto-container">
        <div class="row align-items-stretch align-self-stretch align-content-stretch">
            <?php if (!empty($galleries)) : ?>
                <?php foreach ($galleries as $key => $value) : ?>
                    <?php if (strtotime($value->sharedAt) <= strtotime("now")) : ?>
                        <div class="col-lg-4 col-md-6 service-block">
                            <div class="inner-box h-100">
                                <div class="image">
                                    <a rel="dofollow" href="<?= base_url(lang("routes_galleries") . "/" . lang("routes_gallery") . "/{$value->url}") ?>" title="<?= $value->title ?>">
                                        <img width="1920" height="1280" loading="lazy" data-src="<?= get_picture("galleries_v/{$value->gallery_type}/{$value->folder_name}", $value->img_url) ?>" title="<?= $value->title ?>" alt="<?= $value->title ?>" class="lazyload rounded img-fluid">
                                    </a>
                                </div>
                                <div class="lower-content">
                                    <h4><a rel="dofollow" href="<?= base_url(lang("routes_galleries") . "/" . lang("routes_gallery") . "/{$value->url}") ?>" title="<?= $value->title ?>"><?= $value->title ?></a></h4>
                                    <div class="text"><?= lang("viewGallery") ?></div>
                                    <div class="link"><a rel="dofollow" href="<?= base_url(lang("routes_galleries") . "/" . lang("routes_gallery") . "/{$value->url}") ?>" title="<?= $value->title ?>" class="link-btn"><i class="text-white fa fa-arrow-right"></i> </a></div>
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
        </div>
        <?= @$links ?>
    </div>
</section>