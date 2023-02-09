<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" style="background-image: url(<?= get_picture("settings_v", $settings->gallery_logo) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pageBannerContent text-center">
                    <h2 class="text-white mb-0"><?= strto("lower|ucwords", lang("galleries")); ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Page Banner Section -->

<!-- Services Section -->
<section class="instagramSection is03">
    <div class="container">
        <div class="row align-items-stretch align-self-stretch align-content-stretch">
            <?php if (!empty($galleries)) : ?>
                <?php foreach ($galleries as $key => $value) : ?>
                    <?php if (strtotime($value->sharedAt) <= strtotime("now")) : ?>
                        <div class="col-lg-4 col-md-6 service-block">
                            <div class="inner-box h-100">
                                <div class="image">
                                    <a rel="dofollow" href="<?= base_url(lang("routes_galleries") . "/" . lang("routes_gallery") . "/{$value->url}") ?>" title="<?= $value->title ?>">
                                        <img width="1000" height="1000" loading="lazy" data-src="<?= get_picture("galleries_v/{$value->gallery_type}/{$value->folder_name}", $value->img_url) ?>" title="<?= $value->title ?>" alt="<?= $value->title ?>" class="lazyload rounded img-fluid">
                                    </a>
                                </div>
                                <div class="mt-3">
                                    <h4 class="text-center"><a rel="dofollow" href="<?= base_url(lang("routes_galleries") . "/" . lang("routes_gallery") . "/{$value->url}") ?>" title="<?= $value->title ?>"><?= $value->title ?></a></h4>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
            <?php endif ?>
        </div>
        <?= @$links ?>
    </div>
</section>