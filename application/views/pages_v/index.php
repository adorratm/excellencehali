<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<section class="pageBannerSection" style="background-image: url(<?= !empty($item->banner_url) ? get_picture("pages_v", $item->banner_url)  : get_picture("settings_v", $settings->about_logo) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pageBannerContent text-center">
                    <h2 class="text-white mb-0"><?= strto("lower|ucwords", $item->title) ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- BEGIN: About Section -->
<section class="aboutPageSection01 p-0">
    <?php if ($item->type === "ABOUT" || $item->type === "CONTENT") : ?>
        <div class="container-fluid">
            <div class="row triggerFixed align-items-stretch align-self-stretch align-content-stretch">
                <div class="col-lg-12 image-column bg-white h-100">
                    <div class="title-box rounded p-3">
                        <div class="sec-title mb-0">
                            <?php $pages = $this->general_model->get_all("pages", null, "rank ASC", ["isActive" => 1, "type" => $item->type]); ?>
                            <?php if (!empty($pages)) : ?>
                                <?php $l = 1 ?>
                                <ul class="nav pageNav justify-content-center" id="fixingBar">
                                    <?php foreach ($pages as $key => $value) : ?>
                                        <li class="nav-item <?= $l != count($pages) ? "border-end" : null ?>"><a class="nav-link text-dark <?= $this->uri->segment(3) == $value->url ? "active" : null ?>" style="font-weight: 600;font-size:13px;" rel="dofollow" title="<?= $value->title ?>" href="#<?= $value->url ?>"><?= $value->title ?></a></li>
                                        <?php $l++ ?>
                                    <?php endforeach ?>
                                </ul>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php $pages = $this->general_model->get_all("pages", null, "rank ASC", ["isActive" => 1, "type" => $item->type]); ?>
    <?php if ($item->type === "ABOUT") : ?>
        <?php $i = 0 ?>
        <!-- BEGIN: About Section -->
        <?php foreach ($pages as $key => $value) : ?>
            <div class="container-fluid  <?= $i % 2 != 0 ? "bg-dark py-4" : null ?>" id="<?= $value->url ?>">
                <div class="container">
                    <div class="row align-items-center align-self-center align-content-center my-4">
                        <?php if (!empty($value->img_url)) : ?>
                            <div class="col-lg-6 order-0 order-lg-<?= $i % 2 == 0 ? "1" : "0" ?> h-100">
                                <div class="image text-center justify-content-center d-flex"><img loading="lazy" class="img-fluid lazyload" data-src="<?= get_picture("pages_v", $value->img_url) ?>" title="<?= $value->title ?>" alt="<?= $value->title ?>"></div>
                            </div>
                        <?php endif ?>
                        <?php if (!empty(clean($value->content))) : ?>
                            <div class="col-lg-6 order-lg-<?= $i % 2 == 0 ? "0" : "1" ?> h-100">
                                <h2 class="font-weight-bold mb-4 <?= $i % 2 == 0 ? "text-dark" : "text-white" ?>"><?= $value->title ?></h2>
                                <div class="text <?= $i % 2 != 0 ? "text-white" : null ?>">
                                    <?= $value->content ?>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <?php $i++ ?>
        <?php endforeach ?>
    <?php endif ?>
    <?php if ($item->type === "CONTENT") : ?>
        <?php $i = 0 ?>
        <?php foreach ($pages as $key => $value) : ?>
            <div class="container-fluid" id="<?= $value->url ?>">
                <div class="auto-container">
                    <div class="row align-items-center align-self-center align-content-center my-4 <?= $i % 2 != 0 ? "py-4" : null ?>">
                        <?php if (!empty($value->img_url)) : ?>
                            <div class="col-lg-6 order-0 order-lg-<?= $i % 2 == 0 ? "1" : "0" ?> h-100">
                                <div class="image text-center justify-content-center d-flex"><img loading="lazy" class="img-fluid lazyload" data-src="<?= get_picture("pages_v", $value->img_url) ?>" title="<?= $value->title ?>" alt="<?= $value->title ?>"></div>
                            </div>
                        <?php endif ?>
                        <?php if (!empty(clean($value->content))) : ?>
                            <div class="col-lg-6 order-1 order-lg-<?= $i % 2 == 0 ? "0" : "1" ?> h-100">
                                <h2 class="font-weight-bold mb-4 text-dark"><?= $value->title ?></h2>
                                <div class="text">
                                    <?= $value->content ?>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <?php $i++ ?>
        <?php endforeach ?>
    <?php endif ?>
    <?php if ($item->type === "KVKK") : ?>
        <div class="container-fluid">
            <div class="container">
                <div class="row align-items-center align-self-center align-content-center my-4">
                    <div class="col-lg-12 h-100">
                        <div class="accordion" id="accordionExample">
                            <?php $i = 0 ?>
                            <?php foreach ($pages as $key => $value) : ?>
                                <div class="card">
                                    <div class="card-header bg-white" id="heading<?= $i ?>">
                                        <h2 class="mb-0">
                                            <button style="box-shadow:none" class="btn btn-link btn-block p-1 text-left font-weight-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i ?>" aria-expanded="true" aria-controls="collapse<?= $i ?>">
                                                <?= $value->title ?>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse<?= $i ?>" class="collapse <?= $value->url == $this->uri->segment(3) ? "show" : null ?>" aria-labelledby="heading<?= $i ?>" data-bs-parent="#accordionExample">
                                        <div class="card-body text">
                                            <?= $value->content ?>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++ ?>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if ($item->type === "SIMPLE") : ?>
        <div class="container py-4">
            <div class="row align-items-center align-self-center align-content-center">
                <?php if (!empty($item->img_url)) : ?>
                    <div class="col-lg-12 h-100">
                        <div class="image text-center justify-content-center d-flex"><img loading="lazy" class="img-fluid lazyload" data-src="<?= get_picture("pages_v", $item->img_url) ?>" title="<?= $item->title ?>" alt="<?= $item->title ?>"></div>
                    </div>
                <?php endif ?>
                <?php if (!empty(clean($item->content))) : ?>
                    <div class="col-lg-12 h-100">
                        <div class="text">
                            <?= $item->content ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    <?php endif ?>
</section>
<!-- END: About Section -->

<script>
    window.addEventListener('DOMContentLoaded', function() {
        let anchorlinks = document.querySelectorAll('#fixingBar a[href^="#"]');

        if (anchorlinks.length > 0) {
            for (let item of anchorlinks) { // relitere 
                item.addEventListener('click', (e) => {
                    e.preventDefault();
                    let hashval = item.getAttribute('href');
                    let target = (document.querySelector(hashval).getBoundingClientRect().top + window.pageYOffset) - ($(".triggerFixed").height());
                    if (window.screen.width > 1139) {
                        target -= $(".isSticky").height();
                    }
                    if (!$(".triggerFixed").hasClass("fixed-top")) {
                        target -= $(".isSticky").height() + $(".topbarSection").height() + 20;
                    }
                    $("html, body").animate({
                        scrollTop: target
                    }, 'slow');
                    history.pushState(null, null, hashval);
                });
            }
        }


        $(window).scroll(function() {
            var windscroll = $(window).scrollTop();
            if (windscroll >= 100) {
                $('#fixingBar a').each(function(i) {
                    if ($($(this).attr("href")).position().top <= windscroll - 100) {
                        $('#fixingBar a.active').removeClass('active');
                        $('#fixingBar a').eq(i).addClass('active');
                    }
                });

            } else {
                $('#fixingBar a.active').removeClass('active');
                $('#fixingBar a:first').addClass('active');
            }

        }).scroll();

        $(window).on("load", function() {
            let lastAnchor = window.location.href.split("/").pop();
            if ($('#' + lastAnchor).length) {
                let target = (document.querySelector('#' + lastAnchor).getBoundingClientRect().top + window.pageYOffset) - ($(".triggerFixed").height());
                if (window.screen.width > 1139) {
                    target -= $(".isSticky").height();
                }
                if (!$(".triggerFixed").hasClass("fixed-top")) {
                    target -= $(".isSticky").height() + $(".topbarSection").height();
                }
                history.pushState(null, null, lastAnchor);
                $('html, body').animate({
                    scrollTop: target
                }, 'slow');
            }
        });
    });
</script>