<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="page-title" style="background-image: url(<?= get_picture("settings_v", $settings->technical_information_detail_logo) ?>);">
    <div class="auto-container">
        <div class="content-box">
            <div class="content-wrapper">
                <div class="title">
                    <h1><?= strto("lower|ucwords", $technical_information->title) ?></h1>
                </div>
                <ul class="bread-crumb style-two">
                    <li>
                        <a rel="dofollow" href="<?= base_url(); ?>" title="<?= strto("lower|ucwords", lang("home")) ?>"><?= strto("lower|ucwords", lang("home")) ?></a>
                    </li>
                    <li>
                        <a href="<?= base_url(lang("routes_technical_informations")); ?>" rel="dofollow" title="<?= strto("lower|ucwords", lang("technicalInformations")) ?>"><?= strto("lower|ucwords", lang("technicalInformations")) ?></a>
                    </li>
                    <li>
                        <?= strto("lower|ucwords", $technical_information->title) ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- shop-details -->
<section class="shop-details">
    <div class="auto-container">
        <div class="product-details-content">
            <div class="row clearfix">
                <div class="col-lg-12 content-column">
                    <div class="product-details">
                        <div class="title-box">
                            <h3 class="text-center"><?= $technical_information->title ?></h3>
                        </div>
                        <?php if (!empty($technicalInformationDimensions)) : ?>
                            <hr>
                            <h3 class="text-center font-weight-bold mb-4 text-danger h1"><?= lang("technicalInformationDimensions") ?></h3>
                            <div class="lightgallery2 row justify-content-center">
                                <?php foreach ($technicalInformationDimensions as $pdKey => $pdValue) : ?>
                                    <div class="col-lg-<?= count($technicalInformationDimensions) > 1 ? "6" : "8" ?>">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <?php if (!empty($pdValue->title)) : ?>
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center align-middle justify-content-center font-weight-bold h2"><?= $pdValue->title ?></th>
                                                        </tr>
                                                    </thead>
                                                <?php endif ?>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center align-middle justify-content-center"><img data-exthumbimage2="<?= get_picture("technical_informations_v", $pdValue->img_url) ?>" data-src="<?= get_picture("technical_informations_v", $pdValue->img_url) ?>" class="lazyload img-fluid w-100 lightimg2" loading="lazy" style="cursor:pointer"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        <?php endif ?>
                        <div class="text">
                            <?= $technical_information->description ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-discription">
            <?php if (!empty(clean($technical_information->content)) || !empty(clean($technical_information->features))) : ?>
                <div class="tabs-box">
                    <div class="tab-btn-box">
                        <ul class="tab-btns tab-buttons centred clearfix">
                            <?php if (!empty(clean($technical_information->content))) : ?>
                                <li class="tab-btn active-btn" data-tab="#tab-1"><?= lang("description") ?></li>
                            <?php endif ?>
                            <?php if (!empty(clean($technical_information->features))) : ?>
                                <li class="tab-btn" data-tab="#tab-2"><?= lang("features") ?></li>
                            <?php endif ?>
                        </ul>
                    </div>
                    <div class="tabs-content">
                        <?php if (!empty(clean($technical_information->content))) : ?>
                            <div class="tab active-tab" id="tab-1">
                                <div class="text">
                                    <h3><?= lang("description") ?></h3>
                                    <?= $technical_information->content ?>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php if (!empty(clean($technical_information->features))) : ?>
                            <div class="tab" id="tab-2">
                                <div class="text">
                                    <h3><?= lang("features") ?></h3>
                                    <?= $technical_information->features ?>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
</section>
<!-- shop-details end -->

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
        if (($('#lightgallery2, .lightgallery2').length > 0)) {
            $('#lightgallery2, .lightgallery2').lightGallery({
                selector: '.lightimg2',
                loop: !0,
                thumbnail: !0,
                exThumbImage: 'data-exthumbimage2'
            })
        }
        $(".carousel").on("slid.bs.carousel", function(event) {
            $(".single-product-thumbb:not('.d-none')[data-slide-to=" + event.from + "]").removeClass("active");
            $(".single-product-thumbb:not('.d-none')[data-slide-to=" + event.to + "]").addClass("active");
            let x = $(".single-product-thumbb.active:not('.d-none')[data-slide-to=" + event.to + "]").width();
            $('.owl-thumbs').animate({
                scrollLeft: event.to * x
            }, 500);
        });
    });
</script>