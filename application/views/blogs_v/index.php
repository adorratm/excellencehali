<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Page Title -->
<section class="page-title" style="background-image: url(<?= get_picture("settings_v", $settings->blog_logo) ?>);">
    <div class="auto-container">
        <div class="content-box">
            <div class="content-wrapper">
                <div class="title">
                    <h1><?= strto("lower|ucwords", lang("blog")); ?></h1>
                </div>
                <ul class="bread-crumb style-two">
                    <li><a href="<?= base_url(); ?>"><?= strto("lower|ucwords", lang("home")) ?></a></li>
                    <li class="active"><?= strto("lower|ucwords", lang("blog")); ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- News Section -->
<section class="news-section default-style">
    <div class="auto-container">
        <div class="row">
            <?php foreach ($blogs as $key => $value) : ?>
                <?php if (strtotime($value->sharedAt) <= strtotime("now")) : ?>
                    <div class="col-lg-4 news-block">
                        <div class="inner-box">
                            <div class="image">
                                <img data-src="<?= get_picture("blogs_v", $value->img_url) ?>" title="<?= $value->title ?>" alt="<?= $value->title ?>" class="lazyload img-fluid w-100">
                                <div class="overlay-two">
                                    <a rel="dofollow" href="<?= base_url(lang("routes_blog") . "/" . lang("routes_blog_detail") . "/{$value->seo_url}") ?>" title="<?= $value->title ?>"><span class="fa fa-link"></span></a>
                                </div>
                            </div>
                            <div class="lower-content">
                                <div class="category">
                                    [
                                    <i class="fas fa-folder"></i>
                                    <?php foreach ($categories as $k => $v) : ?>
                                        <?php if ($v->id == $value->category_id) : ?>
                                            <a rel="dofollow" href="<?= base_url(lang("routes_blog") . "/{$v->seo_url}") ?>" title="<?= $v->title ?>"><?= $v->title ?></a>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                    ]
                                </div>
                                <h3><a rel="dofollow" href="<?= base_url(lang("routes_blog") . "/" . lang("routes_blog_detail") . "/{$value->seo_url}") ?>" title="<?= $value->title ?>"><?= $value->title ?></a></h3>
                                <p><?= mb_word_wrap($value->content, 500, "...") ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
        <?= @$links ?>
    </div>
</section>