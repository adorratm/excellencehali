<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" style="background-image: url(<?= get_picture("settings_v", $settings->blog_logo) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pageBannerContent text-center">
                    <h2 class="text-white mb-0"><?= strto("lower|ucwords", $blog->title); ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Page Banner Section -->

<!-- BEGIN: Blog Page Section -->
<section class="blogDetailsPageSection">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="blogDetailsThumb">
                    <img width="1920" height="1280" loading="lazy" data-src="<?= get_picture("blogs_v", $blog->img_url) ?>" title="<?= $blog->title ?>" alt="<?= $blog->title ?>" class="img-fluid w-100 lazyload">
                </div>
                <div class="blogDetailsContentArea">
                    <div class="bi01Meta clearfix">
                        <span><i class="fa-solid fa-folder-open"></i>
                            <?php foreach ($categories as $k => $v) : ?>
                                <?php if ($v->id == $blog->category_id) : ?>
                                    <a rel="dofollow" href="<?= base_url(lang("routes_blog") . "/{$v->seo_url}") ?>" title="<?= $v->title ?>"><?= $v->title ?></a>
                                <?php endif ?>
                            <?php endforeach ?>
                        </span>
                        <span><i class="fa-solid fa-clock"></i><?= turkishDate("d F Y, l H:i", $blog->createdAt) ?></span>
                        <span><i class="fa-solid fa-clock"></i><?= turkishDate("d F Y, l H:i", $blog->updatedAt) ?></span>
                    </div>
                    <h2 class="postTitle"><?= $blog->title ?></h2>
                    <div class="blogDetailscontent">
                        <?= $blog->content ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="postAuthorBox clearfix">
                    <a href="<?= base_url() ?>" rel="dofollow" title="<?= $settings->company_name ?>">
                        <img class="lazyload img-fluid" data-src="<?= get_picture("settings_v", $settings->logo) ?>" alt="<?= $settings->company_name ?>" title="<?= $settings->company_name ?>">
                        <h3><?= $settings->company_name ?></h3>
                    </a>
                    <div class="pabSocial">
                        <?php if (!empty($settings->facebook)) : ?>
                            <a rel="nofollow" href="<?= $settings->facebook ?>" title="Facebook" target="_blank">
                                <i class='fa fa-facebook'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->twitter)) : ?>
                            <a rel="nofollow" href="<?= $settings->twitter ?>" title="Twitter" target="_blank">
                                <i class='fa fa-twitter'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->instagram)) : ?>
                            <a rel="nofollow" href="<?= $settings->instagram ?>" title="Instagram" target="_blank">
                                <i class='fa fa-instagram'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->linkedin)) : ?>
                            <a rel="nofollow" href="<?= $settings->linkedin ?>" title="Linkedin" target="_blank">
                                <i class='fa fa-linkedin'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->youtube)) : ?>
                            <a rel="nofollow" href="<?= $settings->youtube ?>" title="Youtube" target="_blank">
                                <i class='fa fa-youtube'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->medium)) : ?>
                            <a rel="nofollow" href="<?= $settings->medium ?>" title="Medium" target="_blank">
                                <i class='fa fa-medium'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->pinterest)) : ?>
                            <a rel="nofollow" href="<?= $settings->pinterest ?>" title="Pinterest" target="_blank">
                                <i class='fa fa-pinterest'></i>
                            </a>
                        <?php endif ?>
                    </div>
                    <p>
                        <?= stripslashes($settings->meta_description) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Blog Page Section -->