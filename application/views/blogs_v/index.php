<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" style="background-image: url(<?= get_picture("settings_v", $settings->blog_logo) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pageBannerContent text-center">
                    <h2 class="text-white mb-0"><?= $page_title ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Page Banner Section -->

<!-- BEGIN: Blog Page Section -->
<section class="blogPageSection">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <?php foreach ($blogs as $key => $value) : ?>
                    <?php if (strtotime($value->sharedAt) <= strtotime("now")) : ?>
                        <div class="blogItem04">
                            <div class="bi04Thumb">
                                <a href="<?= base_url(lang("routes_blog") . "/" . lang("routes_blog_detail") . "/{$value->seo_url}") ?>" title="<?= $value->title ?>">
                                    <img data-src="<?= get_picture("blogs_v", $value->img_url) ?>" title="<?= $value->title ?>" alt="<?= $value->title ?>" class="lazyload img-fluid w-100">
                                </a>
                            </div>
                            <div class="bi04Detail">
                                <div class="bi01Meta clearfix">
                                    <span><i class="fa-solid fa-folder-open"></i>
                                        <?php foreach ($categories as $k => $v) : ?>
                                            <?php if ($v->id == $value->category_id) : ?>
                                                <a rel="dofollow" href="<?= base_url(lang("routes_blog") . "/{$v->seo_url}") ?>" title="<?= $v->title ?>"><?= $v->title ?></a>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </span>
                                    <span><i class="fa-solid fa-clock"></i><a href="<?= base_url(lang("routes_blog") . "/" . lang("routes_blog_detail") . "/{$value->seo_url}") ?>" title="<?= $value->title ?>"><?= turkishDate("d F Y, l H:i", $value->updatedAt) ?></a></span>
                                </div>
                                <h2><a rel="dofollow" href="<?= base_url(lang("routes_blog") . "/" . lang("routes_blog_detail") . "/{$value->seo_url}") ?>" title="<?= $value->title ?>"><?= $value->title ?></a></h2>
                                <div class="bi04Excerpt"><?= mb_word_wrap($value->content, 500, "...") ?></div>
                                <div class="bi04Footer">
                                    <a rel="dofollow" href="<?= base_url(lang("routes_blog") . "/" . lang("routes_blog_detail") . "/{$value->seo_url}") ?>" title="<?= $value->title ?>" class="ulinaBTN"><span><?= lang("viewBlog") ?></span></a>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
                <div class="row">
                    <div class="col-lg-12">
                        <?= @$links ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Blog Page Section -->