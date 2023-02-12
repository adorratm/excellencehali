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
                    <div id="carouselExample" class="carousel slide">
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
                    <div class="productRadingsStock clearfix">
                        <div class="productRatings float-start">
                            <div class="productRatingWrap">
                                <div class="star-rating"><span></span></div>
                            </div>
                            <div class="ratingCounts">52 Reviews</div>
                        </div>
                        <div class="productStock float-end">
                            <span><?= lang("availableStock") ?> :</span> <?= $product->stock ?>
                        </div>
                    </div>
                    <div class="pcExcerpt">
                        <?= $product->description ?>
                    </div>
                    <div class="pcVariations">
                        <div class="pcVariation">
                            <span><?= lang("productColor") ?></span>
                            <div class="pcvContainer">
                                <div class="pi01VCItem">
                                    <input checked type="radio" name="color_4_6" value="Blue" id="color_4_6251_1_blue" />
                                    <label for="color_4_6251_1_blue"></label>
                                </div>
                                <div class="pi01VCItem yellows">
                                    <input type="radio" name="color_4_6" value="Yellow" id="color_4_6502_2_blue" />
                                    <label for="color_4_6502_2_blue"></label>
                                </div>
                                <div class="pi01VCItem reds">
                                    <input type="radio" name="color_4_6" value="Red" id="color_4_603rt_3_blue" />
                                    <label for="color_4_603rt_3_blue"></label>
                                </div>
                            </div>
                        </div>
                        <div class="pcVariation pcv2">
                            <span>Size</span>
                            <div class="pcvContainer">
                                <div class="pswItem">
                                    <input checked="" type="radio" name="ws_1" value="S" id="ws_145gb_s">
                                    <label for="ws_145gb_s">S</label>
                                </div>
                                <div class="pswItem">
                                    <input type="radio" name="ws_1" value="M" id="ws_1780fg_m">
                                    <label for="ws_1780fg_m">M</label>
                                </div>
                                <div class="pswItem">
                                    <input type="radio" name="ws_1" value="L" id="ws_14rghb_l">
                                    <label for="ws_14rghb_l">L</label>
                                </div>
                                <div class="pswItem">
                                    <input type="radio" name="ws_1" value="XL" id="ws_1t67u_xl">
                                    <label for="ws_1t67u_xl">XL</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pcBtns">
                        <div class="quantity clearfix">
                            <button type="button" name="btnMinus" class="qtyBtn btnMinus">_</button>
                            <input type="number" class="carqty input-text qty text" name="quantity" value="01">
                            <button type="button" name="btnPlus" class="qtyBtn btnPlus">+</button>
                        </div>
                        <button type="submit" class="ulinaBTN"><span>Add to Cart</span></button>
                        <a href="wishlist.html" class="pcWishlist"><i class="fa-solid fa-heart"></i></a>
                        <a href="javascript:void(0);" class="pcCompare"><i class="fa-solid fa-right-left"></i></a>
                    </div>
                    <div class="pcMeta">
                        <p>
                            <span>Sku</span>
                            <a href="javascript:void(0);">3489 JE0765</a>
                        </p>
                        <p class="pcmTags">
                            <span>Tags:</span>
                            <a href="javascript:void(0);">Fashion</a>, <a href="javascript:void(0);">Bags</a>, <a href="javascript:void(0);">Girls</a>
                        </p>
                        <p class="pcmSocial">
                            <span>Share</span>
                            <a class="fac" href="javascript:void(0);"><i class="fa-brands fa-facebook-f"></i></a>
                            <a class="twi" href="javascript:void(0);"><i class="fa-brands fa-twitter"></i></a>
                            <a class="lin" href="javascript:void(0);"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a class="ins" href="javascript:void(0);"><i class="fa-brands fa-instagram"></i></a>
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
        <div class="row relatedProductRow">
            <div class="col-lg-12">
                <h2 class="secTitle">More Products Like This</h2>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="productCarousel owl-carousel">
                            <div class="productItem01">
                                <div class="pi01Thumb">
                                    <img src="images/products/1.jpg" alt="Ulina Product" />
                                    <img src="images/products/1.1.jpg" alt="Ulina Product" />
                                    <div class="pi01Actions">
                                        <a href="javascript:void(0);" class="pi01Cart"><i class="fa-solid fa-shopping-cart"></i></a>
                                        <a href="javascript:void(0);" class="pi01QuickView"><i class="fa-solid fa-arrows-up-down-left-right"></i></a>
                                        <a href="javascript:void(0);" class="pi01Wishlist"><i class="fa-solid fa-heart"></i></a>
                                    </div>
                                    <div class="productLabels clearfix">
                                        <span class="plDis">- $49</span>
                                        <span class="plSale">Sale</span>
                                    </div>
                                </div>
                                <div class="pi01Details">
                                    <div class="productRatings">
                                        <div class="productRatingWrap">
                                            <div class="star-rating"><span></span></div>
                                        </div>
                                        <div class="ratingCounts">10 Reviews</div>
                                    </div>
                                    <h3><a href="shop_details1.html">Men’s blue cotton t-shirt</a></h3>
                                    <div class="pi01Price">
                                        <ins>$49</ins>
                                        <del>$60</del>
                                    </div>
                                    <div class="pi01Variations">
                                        <div class="pi01VColor">
                                            <div class="pi01VCItem">
                                                <input checked type="radio" name="color1" value="Blue" id="color1_blue" />
                                                <label for="color1_blue"></label>
                                            </div>
                                            <div class="pi01VCItem yellows">
                                                <input type="radio" name="color1" value="Yellow" id="color1_yellow" />
                                                <label for="color1_yellow"></label>
                                            </div>
                                            <div class="pi01VCItem reds">
                                                <input type="radio" name="color1" value="Red" id="color1_red" />
                                                <label for="color1_red"></label>
                                            </div>
                                        </div>
                                        <div class="pi01VSize">
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size1" value="Blue" id="size1_s" />
                                                <label for="size1_s">S</label>
                                            </div>
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size1" value="Yellow" id="size1_m" />
                                                <label for="size1_m">M</label>
                                            </div>
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size1" value="Red" id="size1_xl" />
                                                <label for="size1_xl">XL</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="productItem01 pi01NoRating">
                                <div class="pi01Thumb">
                                    <img src="images/products/2.jpg" alt="Ulina Product" />
                                    <img src="images/products/2.1.jpg" alt="Ulina Product" />
                                    <div class="pi01Actions">
                                        <a href="javascript:void(0);" class="pi01Cart"><i class="fa-solid fa-shopping-cart"></i></a>
                                        <a href="javascript:void(0);" class="pi01QuickView"><i class="fa-solid fa-arrows-up-down-left-right"></i></a>
                                        <a href="javascript:void(0);" class="pi01Wishlist"><i class="fa-solid fa-heart"></i></a>
                                    </div>
                                    <div class="productLabels clearfix">
                                        <span class="plHot">Hot</span>
                                    </div>
                                </div>
                                <div class="pi01Details">
                                    <h3><a href="shop_details2.html">Ulina black clean t-shirt</a></h3>
                                    <div class="pi01Price">
                                        <ins>$14</ins>
                                        <del>$30</del>
                                    </div>
                                    <div class="pi01Variations">
                                        <div class="pi01VColor">
                                            <div class="pi01VCItem">
                                                <input checked type="radio" name="color2" value="Blue" id="color2_blue" />
                                                <label for="color2_blue"></label>
                                            </div>
                                            <div class="pi01VCItem yellows">
                                                <input type="radio" name="color2" value="Yellow" id="color2_yellow" />
                                                <label for="color2_yellow"></label>
                                            </div>
                                            <div class="pi01VCItem reds">
                                                <input type="radio" name="color2" value="Red" id="color2_red" />
                                                <label for="color2_red"></label>
                                            </div>
                                        </div>
                                        <div class="pi01VSize">
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size2" value="Blue" id="size2_s" />
                                                <label for="size2_s">S</label>
                                            </div>
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size2" value="Yellow" id="size2_m" />
                                                <label for="size2_m">M</label>
                                            </div>
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size2" value="Red" id="size2_xl" />
                                                <label for="size2_xl">XL</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="productItem01 pi01NoRating">
                                <div class="pi01Thumb">
                                    <img src="images/products/3.jpg" alt="Ulina Product" />
                                    <img src="images/products/3.1.jpg" alt="Ulina Product" />
                                    <div class="pi01Actions">
                                        <a href="javascript:void(0);" class="pi01Cart"><i class="fa-solid fa-shopping-cart"></i></a>
                                        <a href="javascript:void(0);" class="pi01QuickView"><i class="fa-solid fa-arrows-up-down-left-right"></i></a>
                                        <a href="javascript:void(0);" class="pi01Wishlist"><i class="fa-solid fa-heart"></i></a>
                                    </div>
                                    <div class="productLabels clearfix">
                                        <span class="plNew float-end">New</span>
                                    </div>
                                </div>
                                <div class="pi01Details">
                                    <h3><a href="shop_details1.html">Apple white jacket</a></h3>
                                    <div class="pi01Price">
                                        <ins>$39</ins>
                                        <del>$57</del>
                                    </div>
                                    <div class="pi01Variations">
                                        <div class="pi01VColor">
                                            <div class="pi01VCItem">
                                                <input checked type="radio" name="color3" value="Blue" id="color3_blue" />
                                                <label for="color3_blue"></label>
                                            </div>
                                            <div class="pi01VCItem yellows">
                                                <input type="radio" name="color3" value="Yellow" id="color3_yellow" />
                                                <label for="color3_yellow"></label>
                                            </div>
                                            <div class="pi01VCItem reds">
                                                <input type="radio" name="color3" value="Red" id="color3_red" />
                                                <label for="color3_red"></label>
                                            </div>
                                        </div>
                                        <div class="pi01VSize">
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size3" value="Blue" id="size3_s" />
                                                <label for="size3_s">S</label>
                                            </div>
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size3" value="Yellow" id="size3_m" />
                                                <label for="size3_m">M</label>
                                            </div>
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size3" value="Red" id="size3_xl" />
                                                <label for="size3_xl">XL</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="productItem01 pi01NoRating">
                                <div class="pi01Thumb">
                                    <img src="images/products/4.jpg" alt="Ulina Product" />
                                    <img src="images/products/4.1.jpg" alt="Ulina Product" />
                                    <div class="pi01Actions">
                                        <a href="javascript:void(0);" class="pi01Cart"><i class="fa-solid fa-shopping-cart"></i></a>
                                        <a href="javascript:void(0);" class="pi01QuickView"><i class="fa-solid fa-arrows-up-down-left-right"></i></a>
                                        <a href="javascript:void(0);" class="pi01Wishlist"><i class="fa-solid fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="pi01Details">
                                    <h3><a href="shop_details2.html">One color cotton t-shirt</a></h3>
                                    <div class="pi01Price">
                                        <ins>$29</ins>
                                    </div>
                                    <div class="pi01Variations">
                                        <div class="pi01VColor">
                                            <div class="pi01VCItem">
                                                <input checked type="radio" name="color4" value="Blue" id="color4_blue" />
                                                <label for="color4_blue"></label>
                                            </div>
                                            <div class="pi01VCItem yellows">
                                                <input type="radio" name="color1" value="Yellow" id="color4_yellow" />
                                                <label for="color4_yellow"></label>
                                            </div>
                                            <div class="pi01VCItem reds">
                                                <input type="radio" name="color4" value="Red" id="color4_red" />
                                                <label for="color4_red"></label>
                                            </div>
                                        </div>
                                        <div class="pi01VSize">
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size4" value="Blue" id="size4_s" />
                                                <label for="size4_s">S</label>
                                            </div>
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size4" value="Yellow" id="size4_m" />
                                                <label for="size4_m">M</label>
                                            </div>
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size4" value="Red" id="size4_xl" />
                                                <label for="size4_xl">XL</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="productItem01">
                                <div class="pi01Thumb">
                                    <img src="images/products/5.jpg" alt="Ulina Product" />
                                    <img src="images/products/5.1.jpg" alt="Ulina Product" />
                                    <div class="pi01Actions">
                                        <a href="javascript:void(0);" class="pi01Cart"><i class="fa-solid fa-shopping-cart"></i></a>
                                        <a href="javascript:void(0);" class="pi01QuickView"><i class="fa-solid fa-arrows-up-down-left-right"></i></a>
                                        <a href="javascript:void(0);" class="pi01Wishlist"><i class="fa-solid fa-heart"></i></a>
                                    </div>
                                    <div class="productLabels clearfix">
                                        <span class="plDis">- $49</span>
                                        <span class="plSale">Sale</span>
                                    </div>
                                </div>
                                <div class="pi01Details">
                                    <div class="productRatings">
                                        <div class="productRatingWrap">
                                            <div class="star-rating"><span></span></div>
                                        </div>
                                        <div class="ratingCounts">10 Reviews</div>
                                    </div>
                                    <h3><a href="shop_details1.html">Stylish white leather bag</a></h3>
                                    <div class="pi01Price">
                                        <ins>$29</ins>
                                        <del>$56</del>
                                    </div>
                                    <div class="pi01Variations">
                                        <div class="pi01VColor">
                                            <div class="pi01VCItem">
                                                <input checked type="radio" name="color5" value="Blue" id="color5_blue" />
                                                <label for="color5_blue"></label>
                                            </div>
                                            <div class="pi01VCItem yellows">
                                                <input type="radio" name="color5" value="Yellow" id="color5_yellow" />
                                                <label for="color5_yellow"></label>
                                            </div>
                                            <div class="pi01VCItem reds">
                                                <input type="radio" name="color5" value="Red" id="color5_red" />
                                                <label for="color5_red"></label>
                                            </div>
                                        </div>
                                        <div class="pi01VSize">
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size5" value="Blue" id="size5_s" />
                                                <label for="size5_s">S</label>
                                            </div>
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size5" value="Yellow" id="size5_m" />
                                                <label for="size5_m">M</label>
                                            </div>
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size5" value="Red" id="size5_xl" />
                                                <label for="size5_xl">XL</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="productItem01">
                                <div class="pi01Thumb">
                                    <img src="images/products/6.jpg" alt="Ulina Product" />
                                    <img src="images/products/6.1.jpg" alt="Ulina Product" />
                                    <div class="pi01Actions">
                                        <a href="javascript:void(0);" class="pi01Cart"><i class="fa-solid fa-shopping-cart"></i></a>
                                        <a href="javascript:void(0);" class="pi01QuickView"><i class="fa-solid fa-arrows-up-down-left-right"></i></a>
                                        <a href="javascript:void(0);" class="pi01Wishlist"><i class="fa-solid fa-heart"></i></a>
                                    </div>
                                    <div class="productLabels clearfix">
                                        <span class="plNew float-end">New</span>
                                    </div>
                                </div>
                                <div class="pi01Details">
                                    <div class="productRatings">
                                        <div class="productRatingWrap">
                                            <div class="star-rating"><span></span></div>
                                        </div>
                                        <div class="ratingCounts">13 Reviews</div>
                                    </div>
                                    <h3><a href="shop_details2.html">Luxury maroon sweater</a></h3>
                                    <div class="pi01Price">
                                        <ins>$49</ins>
                                        <del>$60</del>
                                    </div>
                                    <div class="pi01Variations">
                                        <div class="pi01VColor">
                                            <div class="pi01VCItem">
                                                <input checked type="radio" name="color6" value="Blue" id="color6_blue" />
                                                <label for="color6_blue"></label>
                                            </div>
                                            <div class="pi01VCItem yellows">
                                                <input type="radio" name="color6" value="Yellow" id="color6_yellow" />
                                                <label for="color6_yellow"></label>
                                            </div>
                                            <div class="pi01VCItem reds">
                                                <input type="radio" name="color6" value="Red" id="color6_red" />
                                                <label for="color6_red"></label>
                                            </div>
                                        </div>
                                        <div class="pi01VSize">
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size6" value="Blue" id="size6_s" />
                                                <label for="size6_s">S</label>
                                            </div>
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size6" value="Yellow" id="size6_m" />
                                                <label for="size6_m">M</label>
                                            </div>
                                            <div class="pi01VSItem">
                                                <input type="radio" name="size6" value="Red" id="size6_xl" />
                                                <label for="size6_xl">XL</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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