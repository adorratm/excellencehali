<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Page Title -->
<section class="page-title" style="background-image: url(<?= !empty($service->banner_url) ? get_picture("services_v", $service->banner_url) : get_picture("settings_v", $settings->service_logo) ?>);">
    <div class="auto-container">
        <div class="content-box">
            <div class="content-wrapper">
                <div class="title">
                    <h1><?= strto("lower|ucwords", $service->title) ?></h1>
                </div>
                <ul class="bread-crumb style-two">
                    <li><a rel="dofollow" href="<?= base_url(); ?>" title="<?= strto("lower|ucwords", lang("home")) ?>"><?= strto("lower|ucwords", lang("home")) ?></a></li>
                    <li><a rel="dofollow" href="<?= base_url(lang("routes_services")); ?>" title="<?= strto("lower|ucwords", lang("services")) ?>"><?= strto("lower|ucwords", lang("services")) ?></a></li>
                    <li class="active"><?= strto("lower|ucwords", $service->title) ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Service details -->
<div class="service-details-page">
    <div class="auto-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="service-details">
                    <div class="image"><img width="1920" height="1280" loading="lazy" data-src="<?= get_picture("services_v", $service->img_url) ?>" alt="<?= $service->title ?>" title="<?= $service->title ?>" class="img-fluid w-100 lazyload rounded"></div>
                    <div class="text-block">
                        <h2><?= $service->title ?></h2>
                        <ul class="list-inline mb-3">
                            <li class="list-inline-item"><i class="fa fa-folder"></i></li>
                            <?php foreach ($categories as $k => $v) : ?>
                                <?php if ($v->id == $service->category_id) : ?>
                                    <li class="list-inline-item"><a style="font-size: 13px;color: black;font-weight: 700;" rel="dofollow" href="<?= base_url(lang("routes_services") . "/{$v->seo_url}") ?>" title="<?= $v->title ?>"> <span> <?= $v->title ?></span></a></li>
                                <?php endif ?>
                            <?php endforeach ?>
                        </ul>
                        <hr>
                        <div class="text">
                            <?= $service->content ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>