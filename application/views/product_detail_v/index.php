<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" style="background-image: url(<?= get_picture("settings_v", $settings->product_detail_logo) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pageBannerContent text-center">
                    <h2 class="text-white mb-0"><?= strto("lower|ucwords", $product->title) ?></h2>
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
                        <?= $product->description ?>
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
                                    <label for="<?= seo($product->color) ?>-<?= $product->color_id ?>"><span style="background: <?= translate_color($product->color) ?>;"></span></label>
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
                    <div class="pcBtns align-items-center align-self-center align-content-center">
                        <?php if (!empty($product->stock)) : ?>
                            <div class="quantity clearfix">
                                <button type="button" name="btnMinus" class="qtyBtn btnMinus">_</button>
                                <input type="number" class="carqty input-text qty text" name="quantity" value="1" max="<?= $product->stock ?>">
                                <button type="button" name="btnPlus" class="qtyBtn btnPlus">+</button>
                            </div>
                        <?php endif ?>
                        <div class="productRadingsStock clearfix mb-0 me-3">
                            <div class="productStock float-start">
                                <span><?= lang("availableStock") ?> :</span> <b class="<?= !empty($product->stock) && $product->stock > 15 ? "text-dark" : "text-danger" ?> "><?= !empty($product->stock) ? $product->stock : lang("outOfStock") ?></b>
                            </div>
                        </div>
                        <?php if (!empty($product->stock)) : ?>
                            <button type="button" class="ulinaBTN"><span><?= lang("addToCart") ?></span></button>
                        <?php endif ?>
                    </div>
                    <div class="pcMeta">
                        <p>
                            <span><?= lang("productBarcode") ?> : </span>
                            <a href="javascript:void(0);"><?= $product->barcode ?></a>
                        </p>
                        <p class="pcmSocial border p-3" style="width: fit-content;">
                            <span class="me-2"><?= lang("shareProduct") ?> : </span>
                            <a class="fac" rel="nofollow" title="Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&t=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>"><i class="fa-brands fa-facebook-f"></i></a>
                            <a class="twi" rel="nofollow" title="Twitter" target="_blank" href="https://twitter.com/intent/tweet?text=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&t=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>"><i class="fa-brands fa-twitter"></i></a>
                            <a class="lin" rel="nofollow" title="Linkedin" target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&title=<?= urlencode($product->title) ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a class="ins" rel="nofollow" title="Pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&description=<?= urlencode($product->title) ?>"><i class="fa-brands fa-pinterest"></i></a>
                            <a class="ins" rel="nofollow" title="Reddit" target="_blank" href="https://www.reddit.com/submit?url=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&title=<?= urlencode($product->title) ?>"><i class="fa-brands fa-reddit"></i></a>
                            <a class="ins" rel="nofollow" title="Whatsapp" target="_blank" href="https://wa.me/?text=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>"><i class="fa-brands fa-whatsapp"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row productTabRow">
            <div class="col-lg-12">
                <ul class="nav productDetailsTab" id="productDetailsTab" role="tablist">
                    <li role="presentation">
                        <button class="active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                    </li>
                    <li role="presentation">
                        <button id="additionalinfo-tab" data-bs-toggle="tab" data-bs-target="#additionalinfo" type="button" role="tab" aria-controls="additionalinfo" aria-selected="false" tabindex="-1">Additional Information</button>
                    </li>
                    <li role="presentation">
                        <button id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false" tabindex="-1">Item
                            Review</button>
                    </li>
                </ul>
                <div class="tab-content" id="desInfoRev_content">
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab" tabindex="0">
                        <div class="productDescContentArea">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="descriptionContent">
                                        <h3>Product Details</h3>
                                        <p>
                                            Desectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                                            et dolore ma na alihote pare ei gansh es gan qua.
                                        </p>
                                        <p>
                                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                            uet aliquip ex ea commodo consequat. Duis aute irure dolor in
                                            reprehenderit in volupteat velit esse cillum dolore eu fugiat nulla
                                            pariatur. Excepteur sint occaecat cupiatat non proiden re dolor in
                                            reprehend.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="descriptionContent featureCols">
                                        <h3>Product Features</h3>
                                        <ul>
                                            <li>Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                                accusantium </li>
                                            <li>Letotam rem aperiam, eaque ipsa quae ab illo inventore veritatis
                                            </li>
                                            <li>Vitae dicta sunt explicabo. Nemo enim ipsam volupta aut odit aut
                                                fugit </li>
                                            <li>Lesed quia consequuntur magni dolores eos qui ratione voluptate.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="additionalinfo" role="tabpanel" aria-labelledby="additionalinfo-tab" tabindex="0">
                        <div class="additionalContentArea">
                            <h3>Additional Information</h3>
                            <table>
                                <tbody>
                                    <tr>
                                        <th>Item Code</th>
                                        <td>AB42 - 2394 - DS023</td>
                                    </tr>
                                    <tr>
                                        <th>Brand</th>
                                        <td>Ulina</td>
                                    </tr>
                                    <tr>
                                        <th>Dimention</th>
                                        <td>12 Cm x 42 Cm x 20 Cm</td>
                                    </tr>
                                    <tr>
                                        <th>Specification</th>
                                        <td>1pc dress, 1 pc soap, 1 cleaner</td>
                                    </tr>
                                    <tr>
                                        <th>Weight</th>
                                        <td>2 kg</td>
                                    </tr>
                                    <tr>
                                        <th>Warranty</th>
                                        <td>1 year</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">
                        <div class="productReviewArea">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3>10 Reviews</h3>
                                    <div class="reviewList">
                                        <ol>
                                            <li>
                                                <div class="postReview">
                                                    <img src="images/author/7.jpg" alt="Post Review">
                                                    <h2>Greaet product. Packaging was also good!</h2>
                                                    <div class="postReviewContent">
                                                        Desectetur adipisicing elit, sed do eiusmod tempor
                                                        incididunt ut labore et dolore ma na alihote pare ei gansh
                                                        es gan quim veniam, quis nostr udg exercitation ullamco
                                                        laboris nisi ut aliquip
                                                    </div>
                                                    <div class="productRatingWrap">
                                                        <div class="star-rating"><span></span></div>
                                                    </div>
                                                    <div class="reviewMeta">
                                                        <h4>John Manna</h4>
                                                        <span>on June 10, 2022</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="postReview">
                                                    <img src="images/author/8.jpg" alt="Post Review">
                                                    <h2>The item is very comfortable and soft!</h2>
                                                    <div class="postReviewContent">
                                                        Desectetur adipisicing elit, sed do eiusmod tempor
                                                        incididunt ut labore et dolore ma na alihote pare ei gansh
                                                        es gan quim veniam, quis nostr udg exercitation ullamco
                                                        laboris nisi ut aliquip
                                                    </div>
                                                    <div class="productRatingWrap">
                                                        <div class="star-rating"><span></span></div>
                                                    </div>
                                                    <div class="reviewMeta">
                                                        <h4>Robert Thomas</h4>
                                                        <span>on June 10, 2022</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="postReview">
                                                    <img src="images/author/9.jpg" alt="Post Review">
                                                    <h2>I liked the product, it is awesome.</h2>
                                                    <div class="postReviewContent">
                                                        Desectetur adipisicing elit, sed do eiusmod tempor
                                                        incididunt ut labore et dolore ma na alihote pare ei gansh
                                                        es gan quim veniam, quis nostr udg exercitation ullamco
                                                        laboris nisi ut aliquip
                                                    </div>
                                                    <div class="productRatingWrap">
                                                        <div class="star-rating"><span></span></div>
                                                    </div>
                                                    <div class="reviewMeta">
                                                        <h4>Ken Williams</h4>
                                                        <span>on June 10, 2022</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="commentFormArea">
                                        <h3>Add A Review</h3>
                                        <div class="reviewFrom">
                                            <form method="post" action="#" class="row">
                                                <div class="col-lg-12">
                                                    <div class="reviewStar">
                                                        <label>Your Rating</label>
                                                        <div class="rsStars"><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <input type="text" name="comTitle" placeholder="Review title">
                                                </div>
                                                <div class="col-lg-12">
                                                    <textarea name="comComment" placeholder="Write your review here"></textarea>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="text" name="comName" placeholder="Your name">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="email" name="comEmail" placeholder="Your email">
                                                </div>
                                                <div class="col-lg-12">
                                                    <button type="submit" name="reviewtSubmit" class="ulinaBTN"><span>Submit Now</span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view("includes/productSlider", ["title" => lang("sameProducts"), "data" => $same_products]); ?>
    </div>
</section>
<!-- END: Shop Details Section -->

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
            $(".owl-thumb-item:not('.d-none')[data-bs-slide-to=" + event.from + "]").removeClass("active");
            $(".owl-thumb-item:not('.d-none')[data-bs-slide-to=" + event.to + "]").addClass("active");
            let x = $(".owl-thumb-item.active:not('.d-none')[data-bs-slide-to=" + event.to + "]").width();
            $('.owl-thumbs').animate({
                scrollLeft: event.to * x
            }, 500);
        });
    });
</script>