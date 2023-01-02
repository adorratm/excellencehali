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
                    <li class="active"><a rel="dofollow" href="<?= base_url(lang("routes_galleries")); ?>" title="<?= strto("lower|ucwords", lang("galleries")) ?>"><?= strto("lower|ucwords", lang("galleries")) ?></a></li>
                    <li class="active"><?= strto("lower|ucwords", $gallery->title) ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section">
    <div class="auto-container">
        <div class="row align-items-stretch align-self-stretch align-content-stretch <?= ($gallery->gallery_type != "files" ? "lightgallery" : null) ?>">
            <?php if (!empty($gallery_items)) : ?>
                <?php foreach ($gallery_items as $key => $value) : ?>
                    <?php if ($gallery->gallery_type == "files") : ?>
                        <?php $extension = pathinfo(FCPATH . "galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}/" . $value->url)["extension"] ?>
                        <div class="<?= strto("lower", $extension) === "pdf" ? "col-lg-6 col-md-12" : "col-lg-4 col-md-6" ?> service-block">
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
                        <div class="<?= ($gallery->gallery_type == "videos" || $gallery->gallery_type == "video_urls" ? "col-lg-12 col-xl-12" : "col-lg-4 col-md-6") ?> service-block">
                            <div class="inner-box h-100">
                                <?php if ($gallery->gallery_type == "videos") : ?>
                                    <video id="my-video<?= $key ?>" controls preload="auto" width="100%">
                                        <source src="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" />
                                    </video>
                                <?php elseif ($gallery->gallery_type == "video_urls") : ?>
                                    <?= htmlspecialchars_decode($value->url) ?>
                                <?php else : ?>
                                    <div class="image">
                                        <a rel="dofollow" href="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" title="<?= $value->title ?>">
                                            <img width="1920" height="1280" loading="lazy" data-src="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" title="<?= $value->title ?>" alt="<?= $value->title ?>" class="lazyload rounded img-fluid">
                                        </a>
                                    </div>
                                    <div class="lower-content">
                                        <?php if (!empty($value->title)) : ?>
                                            <h4 class="mb-0"><a rel="dofollow" href="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" title="<?= $value->title ?>"><?= $value->title ?></a></h4>
                                        <?php endif ?>
                                        <div class="text">
                                            <?php if (!empty($value->description)) : ?>
                                                <?= $value->description ?>
                                            <?php endif ?>
                                            <p class="text-center mb-0 pt-4 font-weight-bold"><?= lang("viewItem") ?></p>
                                        </div>
                                        <div class="link"><a rel="dofollow" data-exthumbimage="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" href="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" title="<?= $value->title ?>" class="link-btn lightimg"><i class="text-white fa fa-eye"></i> </a></div>
                                    </div>
                                <?php endif ?>
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