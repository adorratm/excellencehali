<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Page Title -->
<section class="page-title" style="background-image: url(<?= get_picture("settings_v", $settings->blog_logo) ?>);">
    <div class="auto-container">
        <div class="content-box">
            <div class="content-wrapper">
                <div class="title">
                    <h1><?= strto("lower|ucwords", $blog->title); ?></h1>
                </div>
                <ul class="bread-crumb style-two">
                    <li><a rel="dofollow" href="<?= base_url(); ?>" title="<?= strto("lower|ucwords", lang("home")) ?>"><?= strto("lower|ucwords", lang("home")) ?></a></li>
                    <li><a rel="dofollow" href="<?= base_url(); ?>" title="<?= strto("lower|ucwords", lang("blog")) ?>"><?= strto("lower|ucwords", lang("blog")) ?></a></li>
                    <li class="active"><?= strto("lower|ucwords", $blog->title); ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- News Section -->
<section class="sidebar-page-container">
    <div class="auto-container">
        <div class="row text-center justify-content-center">
            <div class="col-lg-12 text-center justify-content-center">
                <div class="news-block-two blog-single-post">
                    <div class="inner-box">
                        <div class="upper-content">
                            <h3><?= $blog->title ?></h3>
                            <ul class="post-meta">
                                <?php foreach ($categories as $k => $v) : ?>
                                    <?php if ($v->id == $blog->category_id) : ?>
                                        <li><a rel="dofollow" href="<?= base_url(lang("routes_blog") . "/{$v->seo_url}") ?>" title="<?= $v->title ?>"><i class="far fa-folder"></i> <?= $v->title ?></a></li>
                                    <?php endif ?>
                                <?php endforeach ?>
                                <li><i class="far fa-clock"></i> <?= iconv("ISO-8859-9", "UTF-8", @strftime("%d %B %Y, %A %X", strtotime($blog->updatedAt))); ?></li>
                            </ul>
                        </div>
                        <div class="image">
                            <img width="1920" height="1280" loading="lazy" data-src="<?= get_picture("blogs_v", $blog->img_url) ?>" title="<?= $blog->title ?>" alt="<?= $blog->title ?>" class="img-fluid w-100 lazyload">
                        </div>
                        <div class="lower-content">
                            <div class="text mb-40"><?= $blog->content ?></div>
                            <div class="author-box d-flex align-self-center align-items-center align-content-center justify-center">
                                <div class="image position-relative mb-0" style="top:unset;left:unset"><img class="lazyload img-fluid" data-src="<?= get_picture("settings_v", $settings->logo) ?>" alt="<?= $settings->company_name ?>" title="<?= $settings->company_name ?>"></div>
                                <h4 class="ml-4"><?= $settings->company_name ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>