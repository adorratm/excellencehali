<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" style="background-image: url(<?= get_picture("settings_v", $settings->product_detail_logo) ?>);">
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




<!-- BEGIN: Shop Details Section -->
<section class="shopDetailsPageSection">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="productGalleryWrap">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="true">
                        <div class="carousel-inner lightgallery productGallery">
                            <?php $i = 0 ?>
                            <?php if (!empty($product_own_images)) : ?>
                                <?php foreach ($product_own_images as $k => $v) : ?>
                                    <?php if ($v->codes_id == $product->codes_id && $v->codes == $product->codes) : ?>
                                        <div class="carousel-item <?= $i == 0 ? "active" : null ?>" data-index="<?= $i ?>">
                                            <a rel="dofollow" title="<?= $product->title ?>" data-exthumbimage="<?= get_picture("products_v", $v->url) ?>" href="<?= get_picture("products_v", $v->url) ?>" data-index="<?= $i ?>" class="pgImage lightimg">
                                                <img width="1000" height="1000" loading="lazy" data-src="<?= get_picture("products_v", $v->url) ?>" title="<?= $product->title ?>" alt="<?= $product->title ?>" data-zoom-image="<?= get_picture("products_v", $v->url) ?>" class="rounded img-fluid lazyload w-100 d-block">
                                            </a>
                                        </div>
                                        <?php $i++ ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endif ?>
                            <button aria-label="<?= $settings->company_name ?>" style="box-shadow:unset!important" class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-secondary border rounded" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button aria-label="<?= $settings->company_name ?>" style="box-shadow:unset!important" class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-secondary border rounded" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="carousel-indicators productGalleryThumb position-relative mx-0 mx-xxl-0 mt-3">
                            <div class="owl-thumbs d-flex">
                                <?php $i = 0 ?>
                                <?php if (!empty($product_own_images)) : ?>
                                    <?php foreach ($product_own_images as $k => $v) : ?>
                                        <?php if ($v->codes_id == $product->codes_id && $v->codes == $product->codes) : ?>
                                            <div data-bs-target="#carouselExample" style="max-width: 135px;" class="owl-thumb-item border <?= ($i == 0 ? "active" : null) ?>" data-bs-touch="true" data-bs-slide-to="<?= $i ?>" data-bs-image="<?= get_picture("products_v", $v->url) ?>">
                                                <img width="1000" height="1000" loading="lazy" data-src="<?= get_picture("products_v", $v->url) ?>" title="<?= $product->title ?>" alt="<?= $product->title ?>" class="rounded lazyload img-fluid w-100 d-block">
                                            </div>
                                            <?php $i++ ?>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endif; ?>
                            </div>

                            <button aria-label="<?= $settings->company_name ?>" style="box-shadow:unset!important" class="carousel-control-prev bg-transparent" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-secondary border rounded" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button aria-label="<?= $settings->company_name ?>" style="box-shadow:unset!important" class="carousel-control-next bg-transparent" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-secondary border rounded" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="productContent">
                    <?php if ($product->collection_title) : ?>
                        <div class="pcCategory">
                            <a rel="dofollow" title="<?= $product->collection_title ?>" href="<?= base_url(lang("routes_product_collections") . "/" . $product->collection_codes . "/" . $product->collection_seo_url) ?>"><?= $product->collection_title ?></a>
                        </div>
                    <?php endif ?>
                    <h2><?= $product->title ?></h2>
                    <?php if (get_active_user()) : ?>
                        <div class="pi01Price">
                            <?php if ($product->price) : ?>
                                <ins><?= $product->price ?> <?= $symbol ?></ins>
                            <?php endif ?>
                            <?php if ($product->discounted_price) : ?>
                                <del><?= $product->discounted_price ?> <?= $symbol ?></del>
                            <?php endif ?>
                        </div>
                    <?php endif ?>

                    <div class="pcExcerpt">
                        <?= $product->content ?>
                    </div>
                    <div class="pcVariations">
                        <div class="pcVariation align-items-center align-self-center align-content-center pcv2">
                            <span><?= lang("productCollection") ?> : </span>
                            <div class="pcvContainer ms-2">
                                <div class="pswItem">
                                    <input checked type="radio" name="collection" value="<?= $product->collection_id ?>" id="<?= seo($product->collection) ?>-<?= $product->collection_id ?>">
                                    <label for="<?= seo($product->collection) ?>-<?= $product->collection_id ?>"><?= $product->collection ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="pcVariation align-items-center align-self-center align-content-center pcv2">
                            <span><?= lang("productPattern") ?> : </span>
                            <div class="pcvContainer ms-2">
                                <div class="pswItem">
                                    <input checked type="radio" name="pattern" value="<?= $product->pattern_id ?>" id="<?= seo($product->pattern) ?>-<?= $product->pattern_id ?>">
                                    <label for="<?= seo($product->pattern) ?>-<?= $product->pattern_id ?>"><?= $product->pattern ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="pcVariation align-items-center align-self-center align-content-center">
                            <span><?= lang("productColor") ?> : </span>
                            <div class="pcvContainer ms-2">
                                <div class="pi01VCItem d-flex align-items-center align-self-center align-content-center">
                                    <input checked type="radio" name="color" value="<?= $product->color_id ?>" id="<?= seo($product->color) ?>-<?= $product->color_id ?>" />
                                    <label for="<?= seo($product->color) ?>-<?= $product->color_id ?>"><span style="background: linear-gradient(90deg, #fa4750 0%, #e24597 13%, #a550ff 25%, #6c7ff8 38%, #70bbfd 50%, #2effd4 61%, #57e4a0 73%, #d2ab48 86%, #fdde0a 100%);"></span></label>
                                    <span class="ms-2"><?= $product->color ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="pcVariation align-items-center align-self-center align-content-center pcv2">
                            <span><?= lang("productDimension") ?> : </span>
                            <div class="pcvContainer ms-2">
                                <div class="pswItem">
                                    <input checked type="radio" name="dimension" value="<?= $product->dimension_id ?>" id="<?= seo($product->dimension) ?>-<?= $product->dimension_id ?>">
                                    <label for="<?= seo($product->dimension) ?>-<?= $product->dimension_id ?>"><?= $product->dimension ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="pcVariation align-items-center align-self-center align-content-center pcv2">
                            <span><?= lang("productBrand") ?> : </span>
                            <div class="pcvContainer ms-2">
                                <div class="pswItem">
                                    <input checked type="radio" name="brand" value="<?= $product->brand_id ?>" id="<?= seo($product->brand) ?>-<?= $product->brand_id ?>">
                                    <label for="<?= seo($product->brand) ?>-<?= $product->brand_id ?>"><?= $product->brand ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (get_active_user()) : ?>
                        <div class="pcBtns align-items-center align-self-center align-content-center">
                            <?php if (!empty($product->stock)) : ?>
                                <div class="quantity clearfix">
                                    <button type="button" class="qtyBtn btnMinus"><i class="fa fa-minus"></i></button>
                                    <input type="number" class="carqty input-text qty text" name="quantity" min="1" value="1" max="<?= $product->stock ?>">
                                    <button type="button" class="qtyBtn btnPlus" data-max="<?= $product->stock ?>"><i class="fa fa-plus"></i></button>
                                </div>
                            <?php endif ?>
                            <div class="productRadingsStock clearfix mb-0 me-3">
                                <div class="productStock float-start">
                                    <span><?= lang("availableStock") ?> :</span> <b class="<?= !empty($product->stock) && $product->stock > 15 ? "text-dark" : "text-danger" ?> "><?= !empty($product->stock) ? $product->stock : lang("outOfStock") ?></b>
                                </div>
                            </div>
                            <?php if (!empty($product->stock)) : ?>
                                <button type="button" class="ulinaBTN addToCart" data-quantity="1" data-product-id="<?= $product->codes_id ?>" data-product-codes="<?= $product->codes ?>"><span><?= lang("addToCart") ?></span></button>
                            <?php endif ?>
                        </div>
                    <?php endif ?>
                    <div class="pcMeta">
                        <p>
                            <span><?= lang("productBarcode") ?> : </span>
                            <a href="javascript:void(0);"><?= $product->barcode ?></a>
                        </p>
                        <p class="pcmSocial border rounded p-3" style="width: fit-content;">
                            <span class="me-2"><?= lang("shareProduct") ?> : </span>
                            <a class="fac" rel="nofollow" title="Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&t=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>"><i class="fa-brands fa-facebook"></i></a>
                            <a class="twi" rel="nofollow" title="Twitter" target="_blank" href="https://twitter.com/intent/tweet?text=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&t=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>"><i class="fa-brands fa-twitter"></i></a>
                            <a class="lin" rel="nofollow" title="Linkedin" target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&title=<?= urlencode($product->title) ?>"><i class="fa-brands fa-linkedin"></i></a>
                            <a class="ins" rel="nofollow" title="Pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&description=<?= urlencode($product->title) ?>"><i class="fa-brands fa-pinterest"></i></a>
                            <a class="ins" rel="nofollow" title="Reddit" target="_blank" href="https://www.reddit.com/submit?url=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&title=<?= urlencode($product->title) ?>"><i class="fa-brands fa-reddit"></i></a>
                            <a class="ins" rel="nofollow" title="Whatsapp" target="_blank" href="https://wa.me/?text=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>"><i class="fa-brands fa-whatsapp"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty(clean($product->description)) || !empty(clean($product->features))) : ?>
            <div class="row productTabRow">
                <div class="col-lg-12">
                    <ul class="nav productDetailsTab" id="productDetailsTab" role="tablist">
                        <?php if (!empty(clean($product->description))) : ?>
                            <li role="presentation">
                                <button class="active" id="<?= seo(lang("productDescription")) ?>-tab" data-bs-toggle="tab" data-bs-target="#<?= seo(lang("productDescription")) ?>" type="button" role="tab" aria-controls="<?= seo(lang("productDescription")) ?>" aria-selected="true"><?= lang("productDescription") ?></button>
                            </li>
                        <?php endif ?>
                        <?php if (!empty(clean($product->features))) : ?>
                            <li role="presentation">
                                <button <?= empty(clean($product->description)) ? "class='active'" : null ?> id="<?= seo(lang("productFeatures")) ?>-tab" data-bs-toggle="tab" data-bs-target="#<?= seo(lang("productFeatures")) ?>" type="button" role="tab" aria-controls="<?= seo(lang("productFeatures")) ?>" aria-selected="false" tabindex="-1"><?= lang("productFeatures") ?></button>
                            </li>
                        <?php endif ?>
                    </ul>
                    <div class="tab-content" id="desInfoRev_content">
                        <?php if (!empty(clean($product->description))) : ?>
                            <div class="tab-pane fade show active" id="<?= seo(lang("productDescription")) ?>" role="tabpanel" aria-labelledby="<?= seo(lang("productDescription")) ?>-tab" tabindex="0">
                                <div class="productDescContentArea">
                                    <?= $product->description ?>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php if (!empty(clean($product->features))) : ?>
                            <div class="tab-pane fade <?= empty(clean($product->description)) ? "show active" : null ?>" id="<?= seo(lang("productFeatures")) ?>" role="tabpanel" aria-labelledby="<?= seo(lang("productFeatures")) ?>-tab" tabindex="0">
                                <div class="additionalContentArea">
                                    <?= $product->features ?>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <?php $this->load->view("includes/productSlider", ["title" => lang("sameProducts"), "data" => $same_products]); ?>
    </div>
</section>
<!-- END: Shop Details Section -->

<script>
    window.addEventListener('DOMContentLoaded', () => {
        $(".colorLabel").click();


        if (($('#lightgallery, .lightgallery').length > 0)) {
            $('#lightgallery, .lightgallery').lightGallery({
                selector: '.lightimg',
                loop: !0,
                thumbnail: !0,
                exThumbImage: 'data-exthumbimage',
                download: false,
            })
        }
        $(".carousel").on("slid.bs.carousel", (event) => {
            $(".owl-thumb-item:not('.d-none')[data-bs-slide-to=" + event.from + "]").removeClass("active");
            $(".owl-thumb-item:not('.d-none')[data-bs-slide-to=" + event.to + "]").addClass("active");
            let x = $(".owl-thumb-item.active:not('.d-none')[data-bs-slide-to=" + event.to + "]").width();
            $('.owl-thumbs').animate({
                scrollLeft: event.to * x
            }, 500);
        });
        /**
         * Cart Operations
         */
        $(".btnMinus").on("click", () => {
            let $this = $(this);
            let input = $("input[name='quantity']");
            let value = parseInt(input.val());
            if (value > 1) {
                input.val(value - 1);
                $("input[name='quantity']").trigger("change");
            }
        });
        $(".btnPlus").on("click", () => {
            let input = $("input[name='quantity']");
            let value = parseInt(input.val());
            if (value < parseInt(input.attr("max"))) {
                input.val(value + 1);
                $("input[name='quantity']").trigger("change");
            }
        });
        $("input[name='quantity']").on("change", () => {
            if (parseInt($("input[name='quantity']").val()) < 1) {
                $("input[name='quantity']").val(1);
            }
            if (parseInt($("input[name='quantity']").val()) > parseInt($("input[name='quantity']").attr("max"))) {
                $("input[name='quantity']").val($("input[name='quantity']").attr("max"));
            }
            $(".addToCart").data("quantity", $("input[name='quantity']").val());
        });
        /**
         * Add To Cart
         */
        $(document).on("click", ".addToCart", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let $this = $(this);
            $this.attr("disabled", "disabled");
            let productId = $this.data("product-id");
            let codes = $this.data("product-codes");
            let quantity = $this.data("quantity");
            $.post('<?= base_url(lang("routes_cart") . "/" . lang("routes_add-to-cart")) ?>', {
                "codes_id": productId,
                "codes": codes,
                "quantity": quantity,
                "<?= $this->security->get_csrf_token_name() ?>": "<?= $this->security->get_csrf_hash() ?>"
            }, function(response) {
                if (response.success) {
                    iziToast.success({
                        title: response.title,
                        message: response.message,
                        position: "topCenter",
                    });
                    $(".cartWidgetArea").load('<?= base_url(lang("routes_cart") . "/" . lang("routes_cart-header")) ?>');
                    element.load('<?= base_url(lang("routes_cart") . "/" . lang("routes_cart-quantity")) ?>');
                } else {
                    iziToast.error({
                        title: response.title,
                        message: response.message,
                        position: "topCenter",
                    });
                }
                $this.removeAttr("disabled");
            }, 'JSON');
        });
        /**
         * #Cart Operations
         */
    });
</script>