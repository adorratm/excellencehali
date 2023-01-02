<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Page Title -->
<section class="page-title" style="background-image: url(<?= get_picture("settings_v", $settings->sector_logo) ?>);">
    <div class="auto-container">
        <div class="content-box">
            <div class="content-wrapper">
                <div class="title">
                    <h1><?= strto("lower|upper", lang("sectors")) ?></h1>
                </div>
                <ul class="bread-crumb style-two">
                    <li><a rel="dofollow" href="<?= base_url(); ?>" title="<?= strto("lower|upper", lang("home")) ?>"><?= strto("lower|upper", lang("home")) ?></a></li>
                    <li class="active"><?= strto("lower|upper", lang("sectors")) ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section">
    <div class="auto-container">
        <div class="row align-items-stretch align-self-stretch align-content-stretch">
            <?php if (!empty($sectors)) : ?>
                <?php foreach ($sectors as $key => $value) : ?>
                    <?php if (strtotime($value->sharedAt) <= strtotime("now")) : ?>
                        <div class="col-lg-4 col-md-6 service-block">
                            <div class="inner-box h-100">
                                <div class="image">
                                    <a rel="dofollow" href="<?= base_url(lang("routes_sectors") . "/" . lang("routes_sector_detail") . "/{$value->seo_url}") ?>" title="<?= $value->title ?>">
                                        <img width="1920" height="1280" loading="lazy" data-src="<?= get_picture("sectors_v", $value->img_url) ?>" title="<?= $value->title ?>" alt="<?= $value->title ?>" class="lazyload rounded img-fluid">
                                    </a>
                                </div>
                                <div class="lower-content">
                                    <h4><a rel="dofollow" href="<?= base_url(lang("routes_sectors") . "/" . lang("routes_sector_detail") . "/{$value->seo_url}") ?>" title="<?= $value->title ?>"><?= $value->title ?></a></h4>
                                    <div class="text"><?= mb_word_wrap($value->content, 150, "...") ?></div>
                                    <div class="link"><a rel="dofollow" href="<?= base_url(lang("routes_sectors") . "/" . lang("routes_sector_detail") . "/{$value->seo_url}") ?>" title="<?= $value->title ?>" class="link-btn"><i class="text-white fa fa-arrow-right"></i> </a></div>
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