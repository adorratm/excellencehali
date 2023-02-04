<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" style="background-image: url(<?= !empty($products_collection) && !empty($products_collection->img_url) ? get_picture("product_collections_v", $products_collection->banner_url) : get_picture("settings_v", $settings->product_logo) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pageBannerContent text-center">
                    <h2 class="text-white mb-0"><?= !empty($products_collection) ? strto("lower|ucwords", $products_collection->title) : strto("lower|ucwords", lang("products")) ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Page Banner Section -->



<!-- END: Collections Section -->
<section class="collectionsSections">
    <div class="container-fluid px-5">
        <div class="row shopAccessRow align-items-center align-content-center align-self-center shadow p-2">
            <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 my-2">
                <div class="productCount"><?= $offset == 0 ? (!empty($products) ? 1 : 0) : (empty($products) ? 0 : $offset) ?>–<?= $total_rows > $offset + $per_page ? (empty($products) ? 0 : $offset + $per_page) : (empty($products) ? 0 : $total_rows) ?> / <?= empty($products) ? 0 : $total_rows ?></div>
            </div>
            <div class="col-sm-12 col-md-5 col-lg-6 col-xl-7 d-xl-flex my-2">
                <form class="w-100" id="searchProductForm" action="<?= !empty($this->uri->segment(4) && !is_numeric($this->uri->segment(5))) ? base_url(lang("routes_product_collections") . "/" . $this->uri->segment(3) . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(5)) : base_url(lang("routes_product_collections") . "/" . $this->uri->segment(3) . "/" . $this->uri->segment(4)) ?>" method="GET" enctype="multipart/form-data">
                    <div class="input-group">
                        <input type="hidden" name="orderBy" value="<?= (!empty($_GET["orderBy"]) ? $_GET["orderBy"] : "1") ?>">
                        <input style="padding-right:37px" class="form-control" placeholder="<?= lang("searchProducts") ?>" type="text" name="search" value="<?= (!empty($_GET["search"]) ? $_GET["search"] : null) ?>">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                        <button type="button" class="btn bg-transparent rounded-0" style="margin-left: -37px; z-index: 100;" onclick="$('#searchProductForm').find('input[name=search]').val('');$('#searchProductForm').submit()">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-5 col-lg-4 col-xl-3 my-2">
                <div class="shopAccessBar">
                    <div class="sortNav">
                        <label><?= lang("orderBy") ?></label>
                        <select name="productFilter" onchange="$('#searchProductForm').find('input[name=orderBy]').val($(this).val());$('#searchProductForm').submit()">
                            <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 1 ? "selected" : null) ?> value="1"><?= lang("newToOld") ?></option>
                            <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 2 ? "selected" : null) ?> value="2"><?= lang("oldToNew") ?></option>
                            <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 3 ? "selected" : null) ?> value="3"><?= lang("aToZ") ?></option>
                            <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 4 ? "selected" : null) ?> value="4"><?= lang("zToA") ?></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($products)) : ?>
            <div class="row bg-white shadow p-2 align-items-stretch align-self-stretch align-content-stretch collectionProductRow">
                <div class="col-sm-5 col-md-4 col-lg-3 col-xl-2">
                    <div class="shopSidebar">
                        <?php if (!empty($product_patterns)) : ?>
                            <aside class="widget sizeFilter">
                                <h3 class="widgetTitle" data-bs-toggle="collapse" data-bs-target="#searchablePatternsDiv" aria-expanded="true"><?= lang("productPattern") ?></h3>
                                <div id="searchablePatternsDiv" class="collapse show">
                                    <input class="form-control form-control-sm mb-2" type="text" id="productPatternSearch" onkeyup="searchFunction('productPatternSearch','searchablePatterns')" placeholder="<?= lang("productPatternSearch") ?>">
                                    <ul id="searchablePatterns">
                                        <?php foreach ($product_patterns as $ppKey => $ppValue) : ?>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="<?= $ppValue->pattern_id ?>" id="dimensionCheck<?= $ppValue->pattern_id ?>">
                                                    <label class="form-check-label" for="dimensionCheck<?= $ppValue->pattern_id ?>">
                                                        <?= $ppValue->pattern ?>
                                                    </label>
                                                </div>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </aside>
                        <?php endif ?>
                        <?php if (!empty($product_dimensions)) : ?>
                            <aside class="widget sizeFilter">
                                <h3 class="widgetTitle" data-bs-toggle="collapse" data-bs-target="#searchableDimensionsDiv" aria-expanded="true"><?= lang("productDimension") ?></h3>
                                <div id="searchableDimensionsDiv" class="collapse show">
                                    <input class="form-control form-control-sm mb-2" type="text" id="productDimensionSearch" onkeyup="searchFunction('productDimensionSearch','searchableDimensions')" placeholder="<?= lang("productDimensionSearch") ?>">
                                    <ul id="searchableDimensions">
                                        <?php foreach ($product_dimensions as $pdKey => $pdValue) : ?>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="<?= $pdValue->dimension_id ?>" id="dimensionCheck<?= $pdValue->dimension_id ?>">
                                                    <label class="form-check-label" for="dimensionCheck<?= $pdValue->dimension_id ?>">
                                                        <?= $pdValue->dimension ?>
                                                    </label>
                                                </div>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </aside>
                        <?php endif ?>
                        <?php if (!empty($product_colors)) : ?>
                            <aside class="widget">
                                <h3 class="widgetTitle" data-bs-toggle="collapse" data-bs-target="#searchableColorsDiv" aria-expanded="true"><?= lang("productColor") ?></h3>
                                <div id="searchableColorsDiv" class="collapse show">
                                    <input class="form-control form-control-sm mb-2" type="text" id="productColorSearch" onkeyup="searchFunction('productColorSearch','searchableColors')" placeholder="<?= lang("productColorSearch") ?>">
                                    <ul id="searchableColors">
                                        <?php foreach ($product_colors as $pcKey => $pcValue) : ?>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="<?= $pcValue->color_id ?>" id="dimensionCheck<?= $pcValue->color_id ?>">
                                                    <label class="form-check-label" for="dimensionCheck<?= $pcValue->color_id ?>">
                                                        <?= $pcValue->color ?>
                                                    </label>
                                                </div>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </aside>
                        <?php endif ?>
                        <?php if (!empty($product_brands)) : ?>
                            <aside class="widget">
                                <h3 class="widgetTitle" data-bs-toggle="collapse" data-bs-target="#searchableBrandsDiv" aria-expanded="true"><?= lang("productBrand") ?></h3>
                                <div id="searchableBrandsDiv" class="collapse show">
                                    <input class="form-control form-control-sm mb-2" type="text" id="productBrandSearch" onkeyup="searchFunction('productBrandSearch','searchableBrands')" placeholder="<?= lang("productBrandSearch") ?>">
                                    <ul id="searchableBrands">
                                        <?php foreach ($product_brands as $pbKey => $pbValue) : ?>
                                            <li>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="<?= $pbValue->brand_id ?>" id="dimensionCheck<?= $pbValue->brand_id ?>">
                                                    <label class="form-check-label" for="dimensionCheck<?= $pbValue->brand_id ?>">
                                                        <?= $pbValue->brand ?>
                                                    </label>
                                                </div>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </aside>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-sm-7 col-md-8 col-lg-9 col-xl-10">
                    <div class="row">
                        <?php foreach ($products as $key => $value) : ?>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 col-xxl-3 my-3">
                                <div class="productItem01 rounded border p-3 h-100 shadow-sm">
                                    <div class="pi01Thumb">
                                        <img loading="lazy" width="1000" height="1000" data-src="<?= get_picture("products_v", $value->img_url) ?>" alt="<?= $value->title ?>" title="<?= $value->title ?>" class="img-fluid lazyload" />
                                        <?php $secondaryImage = get_secondary_image($value->codes_id, $value->codes, $value->img_url, $lang) ?>
                                        <?php if (!empty($secondaryImage)) : ?>
                                            <img loading="lazy" width="1000" height="1000" data-src="<?= get_picture("products_v", $secondaryImage) ?>" alt="<?= $value->title ?>" title="<?= $value->title ?>" class="img-fluid lazyload">
                                        <?php endif ?>
                                        <div class="pi01Actions">
                                            <a href="<?= base_url(lang("routes_product_collections") . "/" . lang("routes_product") . "/" . $value->codes . "/" . $value->seo_url) ?>" rel="dofollow" title="<?= $value->title ?>"><i class="fa-solid fa-arrows-up-down-left-right"></i></a>
                                        </div>
                                        <?php if (!empty($value->discounted_price)) : ?>
                                            <div class="productLabels clearfix">
                                                <span class="plDis"><?= lang("discountedProduct") ?></span>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="pi01Details">
                                        <h3 class="text-center fw-medium fs-6"><a href="<?= base_url(lang("routes_product_collections") . "/" . lang("routes_product") . "/" . $value->codes . "/" . $value->seo_url) ?>" rel="dofollow" title="<?= $value->title ?>"><?= $value->title ?></a></h3>
                                        <?php if (get_active_user()) : ?>
                                            <div class="pi01Price">
                                                <ins><?= !empty($value->discounted_price) ? $value->discounted_price : $value->price ?></ins>
                                                <?php if (!empty($value->discounted_price)) : ?>
                                                    <del><?= $value->price ?></del>
                                                <?php endif ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>

        <?php endif ?>

        <?php if (empty($products)) : ?>
            <div class="alert alert-warning rounded-0 shadow" role="alert">
                <h4 class="alert-heading"><?= lang("warning") ?></h4>
                <p><?= lang("weCantFindAnyProductsWithYourSearch") ?></p>
                <hr>
                <p class="mb-0"><?= lang("youCanSearchDifferentProducts") ?></p>
            </div>
        <?php endif ?>

        <?= @$links ?>
    </div>
</section>
<!-- END: Collections Section -->


<script>
    function searchFunction(inputId, ulId) {
        // Declare variables
        let input, filter, ul, li, label, i, txtValue;
        input = document.getElementById(inputId);
        filter = input.value.toLocaleUpperCase("<?= strto("lower|upper", $lang) ?>");
        ul = document.getElementById(ulId);
        li = ul.getElementsByTagName('li');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            label = li[i].getElementsByTagName("label")[0];
            txtValue = label.textContent || label.innerText;
            if (txtValue.toLocaleUpperCase("<?= strto("lower|upper", $lang) ?>").indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>