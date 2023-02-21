<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" style="background-image: url(<?= get_picture("settings_v", $settings->gallery_logo) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pageBannerContent text-center">
                    <h2 class="text-white mb-0"><?= $page_title; ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Page Banner Section -->

<!-- BEGIN: Instagram Section -->
<section class="instagramSection is03">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row clearfix <?= ($gallery->gallery_type != "files" ? "lightgallery" : null) ?>">
                    <?php if (!empty($gallery_items)) : ?>
                        <?php foreach ($gallery_items as $key => $value) : ?>
                            <?php if ($gallery->gallery_type == "files") : ?>
                                <?php $extension = pathinfo(FCPATH . "galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}/" . $value->url)["extension"] ?>
                                <div class="<?= strto("lower", $extension) === "pdf" ? "col-lg-6 col-md-12" : "col-lg-4 col-md-6" ?>">
                                    <div class="inner-box h-100">
                                        <div class="<?= strto("lower", $extension) === "pdf" ? null : "image" ?>">
                                            <a class="d-block text-center" rel="dofollow" href="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" alt="<?= $value->title ?>" <?= (!empty($extension) && $extension != "pdf" ? "download='" . (!empty($value->title) ? $value->title . "." . $extension : null) . "'" : "target='_blank'") ?>>
                                                <?php if (strto("lower", $extension) === "pdf") : ?>
                                                    <iframe loading="lazy" data-src="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" frameborder="0" class="w-100 lazyload vh-100"></iframe>
                                                <?php else : ?>
                                                    <i class="fa fa-cloud-download fa-10x d-block"></i>
                                                <?php endif ?>
                                            </a>
                                        </div>
                                        <div class="lower-content m-0">
                                            <h4 class="mb-0"><a rel="dofollow" href="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" alt="<?= $value->title ?>" <?= (!empty($extension) && $extension != "pdf" ? "download='" . (!empty($value->title) ? $value->title . "." . $extension : null) . "'" : "target='_blank'") ?>><?= !empty($value->title) && !empty($extension) ? $value->title . "." . $extension : $value->url ?></a></h4>
                                            <div class="link"><a rel="dofollow" href="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" alt="<?= $value->title ?>" <?= (!empty($extension) && $extension != "pdf" ? "download='" . (!empty($value->title) ? $value->title . "." . $extension : null) . "'" : "target='_blank'") ?> class="link-btn"><i class="text-white fa fa-download"></i> </a></div>
                                        </div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="<?= ($gallery->gallery_type == "videos" || $gallery->gallery_type == "video_urls" ? "col-lg-12 col-xl-12" : "col-lg-4 col-md-6") ?>">
                                    <div class="h-100">
                                        <?php if ($gallery->gallery_type == "videos") : ?>
                                            <video id="my-video<?= $key ?>" controls preload="auto" width="100%">
                                                <source src="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" />
                                            </video>
                                        <?php elseif ($gallery->gallery_type == "video_urls") : ?>
                                            <?= htmlspecialchars_decode($value->url) ?>
                                        <?php else : ?>
                                            <a class="lightimg" rel="dofollow" data-exthumbimage="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" href="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" title="<?= $value->title ?>">
                                                <img width="1000" height="1000" loading="lazy" data-src="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" title="<?= $value->title ?>" alt="<?= $value->title ?>" class="lazyload rounded img-fluid">
                                            </a>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endif ?>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Instagram Section -->

<script>
    window.addEventListener('DOMContentLoaded', function() {
        if (($('#lightgallery, .lightgallery').length > 0)) {
            $('#lightgallery, .lightgallery').lightGallery({
                selector: '.lightimg',
                loop: !0,
                thumbnail: !0,
                exThumbImage: 'data-exthumbimage'
            })
        }
    });
</script>