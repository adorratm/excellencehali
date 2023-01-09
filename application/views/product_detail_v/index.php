<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="page-title" style="background-image: url(<?= get_picture("settings_v", $settings->product_detail_logo) ?>);">
    <div class="auto-container">
        <div class="content-box">
            <div class="content-wrapper">
                <div class="title">
                    <h1><?= strto("lower|ucwords", $product->title) ?></h1>
                </div>
                <ul class="bread-crumb style-two">
                    <li>
                        <a rel="dofollow" href="<?= base_url(); ?>" title="<?= strto("lower|ucwords", lang("home")) ?>"><?= strto("lower|ucwords", lang("home")) ?></a>
                    </li>
                    <li>
                        <a href="<?= base_url(lang("routes_products")); ?>" rel="dofollow" title="<?= strto("lower|ucwords", lang("products")) ?>"><?= strto("lower|ucwords", lang("products")) ?></a>
                    </li>
                    <?php if (!empty($product->category_ids)) : ?>
                        <li>
                            <?php $i = 1 ?>
                            <?php $count = count(explode(",", $product->category_ids)) ?>
                            <?php foreach (explode(",", $product->category_titles) as $k => $v) : ?>
                                <?php $seo_url = explode(",", $product->category_seos)[$k]; ?>
                                <?php if ($i < $count) : ?>
                                    <a rel="dofollow" href="<?= base_url(lang("routes_products") . "/{$seo_url}") ?>" title="<?= strto("lower|ucwords", $v) ?>"><?= strto("lower|ucwords", $v) ?></a>,
                                <?php else : ?>
                                    <a rel="dofollow" href="<?= base_url(lang("routes_products") . "/{$seo_url}") ?>" title="<?= strto("lower|ucwords", $v) ?>"><?= strto("lower|ucwords", $v) ?></a>
                                <?php endif ?>
                                <?php $i++ ?>
                            <?php endforeach ?>
                        </li>
                    <?php endif ?>
                    <li>
                        <?= strto("lower|ucwords", $product->title) ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- shop-details -->
<section class="shop-details">
    <div class="auto-container">
        <div class="product-details-content mb-0 mb-lg-5">
            <div class="row clearfix">
                <div class="col-lg-6 content-column">
                    <div class="product-details ">
                        <div class="title-box">
                            <h3 class="text-center"><?= $product->title ?></h3>
                        </div>
                        <div class="text">
                            <?= $product->content ?>
                            <div class="row align-items-center align-self-center align-content-center">
                                <div class="col-lg-6">
                                    <?= $product->description ?>
                                </div>
                            </div>

                            <blockquote class="p-3 font-weight-bold border shadow-sm text-center h3"><cite><?= clean($product->features) ?></cite></blockquote>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="products-carousel border border-dark">
                        <div id="carouselExampleCaptions" class="carousel slide carousel-dark" data-ride="carousel">
                            <div class="carousel-inner product-content wow fadeInUp lightgallery" data-wow-delay="300ms">
                                <?php $i = 0 ?>
                                <?php if (!empty($product_own_images)) : ?>
                                    <?php foreach ($product_own_images as $k => $v) : ?>
                                        <?php if ($v->codes_id == $product->codes_id && $v->codes == $product->codes) : ?>
                                            <div class="carousel-item item <?= $i == 0 ? "active" : null ?>" data-index="<?= $i ?>">
                                                <a rel="dofollow" title="<?= $product->title ?>" data-exthumbimage="<?= get_picture("products_v", $v->url) ?>" href="<?= get_picture("products_v", $v->url) ?>" data-index="<?= $i ?>" class="d-block fancyboximg top-img product-simple-preview-image lightimg">
                                                    <img width="1920" height="1280" loading="lazy" data-src="<?= get_picture("products_v", $v->url) ?>" title="<?= $product->title ?>" alt="<?= $product->title ?>" data-zoom-image="<?= get_picture("products_v", $v->url) ?>" class="product-zoom rounded img-fluid product-simple-preview-image-zoom lazyload">
                                                </a>
                                            </div>
                                            <?php $i++ ?>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endif ?>
                                <button aria-label="<?= $settings->company_name ?>" style="box-shadow:unset!important" class="carousel-control-prev btn" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
                                    <span class="carousel-control-prev-icon bg-secondary" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </button>
                                <button aria-label="<?= $settings->company_name ?>" style="box-shadow:unset!important" class="carousel-control-next btn" type="button" data-target="#carouselExampleCaptions" data-slide="nextWhenVisible">
                                    <span class="carousel-control-next-icon bg-secondary" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </button>
                            </div>
                            <div class="product-thumbs-wrapper border-top">
                                <div class="carousel-indicators owl-thumbs position-relative d-flex d-md-block d-lg-flex d-xxl-block mx-0 mx-xxl-0">
                                    <?php $i = 0 ?>
                                    <?php if (!empty($product_own_images)) : ?>
                                        <?php foreach ($product_own_images as $k => $v) : ?>
                                            <?php if ($v->codes_id == $product->codes_id && $v->codes == $product->codes) : ?>
                                                <div data-target="#carouselExampleCaptions" style="max-width: 135px;" class="owl-thumb-item border mx-0 mx-xxl-0 single-product-thumbb <?= ($i == 0 ? "active" : null) ?>" data-touch="true" data-slide-to="<?= $i ?>" data-image="<?= get_picture("products_v", $v->url) ?>">
                                                    <div class="top-img">
                                                        <img width="1920" height="1280" loading="lazy" data-src="<?= get_picture("products_v", $v->url) ?>" title="<?= $product->title ?>" alt="<?= $product->title ?>" class="lazyload img-fluid">
                                                    </div>
                                                </div>
                                                <?php $i++ ?>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="product-discription">
            <?php if (!empty($productDimensions)) : ?>
                <div class="lightgallery2 row justify-content-center">
                    <?php $lastTitle = null ?>
                    <?php foreach ($productDimensions as $pdKey => $pdValue) : ?>
                        <?php if ($lastTitle != $pdValue->title) : ?>
                            <?php $lastTitle = $pdValue->title ?>
                            <div class="col-lg-<?= count($productDimensions) > 1 ? "12" : "8" ?>">
                                <div class="text-center justify-content-center font-weight-bold h2"><?= $pdValue->title ?></div>
                            </div>
                        <?php endif ?>
                        <div class="col-lg-<?= count($productDimensions) > 1 ? "6" : "8" ?>">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td class="text-center align-middle justify-content-center"><img data-exthumbimage2="<?= get_picture("products_v", $pdValue->img_url) ?>" data-src="<?= get_picture("products_v", $pdValue->img_url) ?>" class="lazyload img-fluid w-100 lightimg2" loading="lazy" style="cursor:pointer"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
            <?php if (!empty($product->technical_information_id)) : ?>
                <?php $technicalInformation = $this->general_model->get("technical_informations", null, ["isActive" => 1, "id" => $product->technical_information_id]) ?>
                <div class="text-center my-3">
                    <a class="theme-btn style-six btn-lg p-lg-3 rounded-0 shadow justify-content-center text-center mx-auto font-weight-bold" href="<?= base_url(lang("routes_technical_informations") . "/" . lang("routes_technical_information") . "/" . $technicalInformation->url) ?>" rel="dofollow" title="<?= $technicalInformation->title ?>"><span><?= lang("clickForTable") ?></span></a>
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
                exThumbImage: 'data-exthumbimage',
                download: false,
            })
        }
        if (($('#lightgallery2, .lightgallery2').length > 0)) {
            $('#lightgallery2, .lightgallery2').lightGallery({
                selector: '.lightimg2',
                loop: !0,
                thumbnail: !0,
                exThumbImage: 'data-exthumbimage2',
                download: false
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