<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$explodedPatternChecks = !empty($_GET["patternChecks"]) ? array_map("intVal", explode(",", clean($_GET["patternChecks"]))) : [];
$explodedDimensionChecks = !empty($_GET["dimensionChecks"]) ? array_map("intVal", explode(",", clean($_GET["dimensionChecks"]))) : [];
$explodedColorChecks = !empty($_GET["colorChecks"]) ? array_map("intVal", explode(",", clean($_GET["colorChecks"]))) : [];
$explodedBrandChecks = !empty($_GET["brandChecks"]) ? array_map("intVal", explode(",", clean($_GET["brandChecks"]))) : [];
?>
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
<form class="w-100" id="searchProductForm" action="<?= !empty($this->uri->segment(4) && !is_numeric($this->uri->segment(5))) ? base_url(lang("routes_product_collections") . "/" . $this->uri->segment(3) . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(5)) : base_url(lang("routes_product_collections") . "/" . $this->uri->segment(3) . "/" . $this->uri->segment(4)) ?>" method="GET" enctype="multipart/form-data">
    <section class="collectionsSections">
        <div class="container-fluid px-5">
            <div class="row shopAccessRow align-items-center align-content-center align-self-center shadow p-2">
                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 my-2">
                    <div class="productCount"><?= $offset == 0 ? (!empty($products) ? 1 : 0) : (empty($products) ? 0 : $offset) ?>–<?= $total_rows > $offset + $per_page ? (empty($products) ? 0 : $offset + $per_page) : (empty($products) ? 0 : $total_rows) ?> / <?= empty($products) ? 0 : $total_rows ?></div>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-6 col-xl-7 d-xl-flex my-2">
                    <div class="input-group">
                        <input type="hidden" name="patternChecks" value="<?= (!empty($_GET["patternChecks"]) ? $_GET["patternChecks"] : null) ?>">
                        <input type="hidden" name="dimensionChecks" value="<?= (!empty($_GET["dimensionChecks"]) ? $_GET["dimensionChecks"] : null) ?>">
                        <input type="hidden" name="colorChecks" value="<?= (!empty($_GET["colorChecks"]) ? $_GET["colorChecks"] : null) ?>">
                        <input type="hidden" name="brandChecks" value="<?= (!empty($_GET["brandChecks"]) ? $_GET["brandChecks"] : null) ?>">
                        <input style="padding-right:37px" class="form-control" placeholder="<?= lang("searchProducts") ?>" type="text" name="search" value="<?= (!empty($_GET["search"]) ? $_GET["search"] : null) ?>">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                        <button type="button" class="btn bg-transparent rounded-0" style="margin-left: -37px; z-index: 100;" onclick="$('#searchProductForm').find('input[name=search]').val('');$('#searchProductForm').submit()">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-4 col-xl-3 my-2">
                    <div class="shopAccessBar">
                        <div class="sortNav">
                            <label><?= lang("orderBy") ?></label>
                            <select name="orderBy" onchange="$('#searchProductForm').submit()">
                                <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 1 ? "selected" : null) ?> value="1"><?= lang("newToOld") ?></option>
                                <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 2 ? "selected" : null) ?> value="2"><?= lang("oldToNew") ?></option>
                                <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 3 ? "selected" : null) ?> value="3"><?= lang("aToZ") ?></option>
                                <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 4 ? "selected" : null) ?> value="4"><?= lang("zToA") ?></option>
                                <?php if (get_active_user()) : ?>
                                    <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 5 ? "selected" : null) ?> value="5"><?= lang("priceAsc") ?></option>
                                    <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 6 ? "selected" : null) ?> value="6"><?= lang("priceDesc") ?></option>
                                <?php endif ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>


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
                                                    <input <?= in_array($ppValue->pattern_id, $explodedPatternChecks) ? "checked" : null ?> class="form-check-input productPatternCheck" type="checkbox" value="<?= $ppValue->pattern_id ?>" id="productPatternCheck<?= $ppValue->pattern_id ?>">
                                                    <label class="form-check-label" for="productPatternCheck<?= $ppValue->pattern_id ?>">
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
                                                    <input <?= in_array($pdValue->dimension_id, $explodedDimensionChecks) ? "checked" : null ?> class="form-check-input productDimensionCheck" type="checkbox" value="<?= $pdValue->dimension_id ?>" id="productDimensionCheck<?= $pdValue->dimension_id ?>">
                                                    <label class="form-check-label" for="productDimensionCheck<?= $pdValue->dimension_id ?>">
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
                                                    <input <?= in_array($pcValue->color_id, $explodedColorChecks) ? "checked" : null ?> class="form-check-input productColorCheck" type="checkbox" value="<?= $pcValue->color_id ?>" id="productColorCheck<?= $pcValue->color_id ?>">
                                                    <label class="form-check-label" for="productColorCheck<?= $pcValue->color_id ?>">
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
                                                    <input <?= in_array($pbValue->brand_id, $explodedBrandChecks) ? "checked" : null ?> class="form-check-input productBrandCheck" type="checkbox" value="<?= $pbValue->brand_id ?>" id="productBrandCheck<?= $pbValue->brand_id ?>">
                                                    <label class="form-check-label" for="productBrandCheck<?= $pbValue->brand_id ?>">
                                                        <?= $pbValue->brand ?>
                                                    </label>
                                                </div>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            </aside>
                        <?php endif ?>
                        <aside class="widget">
                            <button role="button" class="fs-5 btn btn-outline-secondary w-100"><?= lang("productFilter") ?></button>
                            <?php if (!empty($_GET)) : ?>
                                <a rel="dofollow" title="<?= lang("clearFilter") ?>" class="btn btn-outline-danger mt-2 text-center w-100 fs-5" href="<?= base_url(lang("routes_product_collections") . "/" . $this->uri->segment(3) . "/" . $this->uri->segment(4)) ?>"><?= lang("clearFilter") ?></a>
                            <?php endif ?>
                        </aside>
                    </div>
                </div>
                <div class="col-sm-7 col-md-8 col-lg-9 col-xl-10">
                    <div class="row">
                        <?php if (!empty($products)) : ?>
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
                                                    <span class="plDis">- <?= $value->price - $value->discounted_price ?><?= $symbol ?></span>
                                                    <span class="plSale"><?= lang("discountedProduct") ?></span>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                        <div class="pi01Details">
                                            <h3 class="text-center fw-medium fs-6"><a href="<?= base_url(lang("routes_product_collections") . "/" . lang("routes_product") . "/" . $value->codes . "/" . $value->seo_url) ?>" rel="dofollow" title="<?= $value->title ?>"><?= $value->title ?></a></h3>
                                            <?php if (get_active_user()) : ?>
                                                <div class="pi01Price">
                                                    <?php if (!empty($value->price) || !empty($value->discounted_price)) : ?>
                                                        <ins><?= !empty($value->discounted_price) ? $value->discounted_price : $value->price ?> <?= $symbol ?></ins>
                                                    <?php endif ?>
                                                    <?php if (!empty($value->discounted_price) && $value->discounted_price > 0) : ?>
                                                        <del><?= $value->price ?> <?= $symbol ?></del>
                                                    <?php endif ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php endif ?>
                        <?php if (empty($products)) : ?>
                            <div class="col-12">
                                <div class="alert alert-warning rounded-0 shadow" role="alert">
                                    <h4 class="alert-heading"><?= lang("warning") ?></h4>
                                    <p><?= lang("weCantFindAnyProductsWithYourSearch") ?></p>
                                    <hr>
                                    <p class="mb-0"><?= lang("youCanSearchDifferentProducts") ?></p>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>





            <?= @$links ?>
        </div>
    </section>
</form>
<!-- END: Collections Section -->


<script>
    window.addEventListener('DOMContentLoaded', function() {
        let productPatternChecks = <?= (!empty($_GET["patternChecks"]) ? "[" . $_GET["patternChecks"] . "]" : "[]") ?>,
            productDimensionChecks = <?= (!empty($_GET["dimensionChecks"]) ? "[" . $_GET["dimensionChecks"] . "]" : "[]") ?>,
            productColorChecks = <?= (!empty($_GET["colorChecks"]) ? "[" . $_GET["colorChecks"] . "]" : "[]") ?>,
            productBrandChecks = <?= (!empty($_GET["brandChecks"]) ? "[" . $_GET["brandChecks"] . "]" : "[]") ?>;
        let productPatternCheckboxes = document.querySelectorAll('input.productPatternCheck');
        let productDimensionCheckboxes = document.querySelectorAll('input.productDimensionCheck');
        let productColorCheckboxes = document.querySelectorAll('input.productColorCheck');
        let productBrandCheckboxes = document.querySelectorAll('input.productBrandCheck');
        productPatternCheckboxes.forEach(function(productPatternCheckbox) {
            productPatternCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    productPatternChecks.push(parseInt(this.value));
                } else {
                    productPatternChecks = productPatternChecks.filter(function(e) {
                        return e !== parseInt(this.value);
                    }, this);
                }
                let productPatternCheckboxes = document.querySelectorAll('input.productPatternCheck');
                productPatternCheckboxes.forEach(function(productPatternCheckbox) {
                    productPatternCheckbox.checked = false;
                });
                productPatternChecks.forEach(function(productPatternCheck) {
                    let productPatternCheckbox = document.querySelector('input.productPatternCheck[value="' + productPatternCheck + '"]');
                    productPatternCheckbox.checked = true;
                });
                $("input[name='patternChecks").val(productPatternChecks.join(','));
                $('#searchProductForm').submit();
            });
        });
        productDimensionCheckboxes.forEach(function(productDimensionCheckbox) {
            productDimensionCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    productDimensionChecks.push(parseInt(this.value));
                } else {
                    productDimensionChecks = productDimensionChecks.filter(function(e) {
                        return e !== parseInt(this.value);
                    }, this);
                }
                let productDimensionCheckboxes = document.querySelectorAll('input.productDimensionCheck');
                productDimensionCheckboxes.forEach(function(productDimensionCheckbox) {
                    productDimensionCheckbox.checked = false;
                });
                productDimensionChecks.forEach(function(productDimensionCheck) {
                    let productDimensionCheckbox = document.querySelector('input.productDimensionCheck[value="' + productDimensionCheck + '"]');
                    productDimensionCheckbox.checked = true;
                });
                $("input[name='dimensionChecks").val(productDimensionChecks.join(','));
                $('#searchProductForm').submit();
            });
        });
        productColorCheckboxes.forEach(function(productColorCheckbox) {
            productColorCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    productColorChecks.push(parseInt(this.value));
                } else {
                    productColorChecks = productColorChecks.filter(function(e) {
                        return e !== parseInt(this.value);
                    }, this);
                }
                let productColorCheckboxes = document.querySelectorAll('input.productColorCheck');
                productColorCheckboxes.forEach(function(productColorCheckbox) {
                    productColorCheckbox.checked = false;
                });
                productColorChecks.forEach(function(productColorCheck) {
                    let productColorCheckbox = document.querySelector('input.productColorCheck[value="' + productColorCheck + '"]');
                    productColorCheckbox.checked = true;
                });
                $("input[name='colorChecks").val(productColorChecks.join(','));
                $('#searchProductForm').submit();
            });
        });
        productBrandCheckboxes.forEach(function(productBrandCheckbox) {
            productBrandCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    productBrandChecks.push(parseInt(this.value));
                } else {
                    productBrandChecks = productBrandChecks.filter(function(e) {
                        return e !== parseInt(this.value)
                    }, this);
                }
                let productBrandCheckboxes = document.querySelectorAll('input.productBrandCheck');
                productBrandCheckboxes.forEach(function(productBrandCheckbox) {
                    productBrandCheckbox.checked = false;
                });
                productBrandChecks.forEach(function(productBrandCheck) {
                    let productBrandCheckbox = document.querySelector('input.productBrandCheck[value="' + productBrandCheck + '"]');
                    productBrandCheckbox.checked = true;
                });
                $("input[name='brandChecks").val(productBrandChecks.join(','));
                $('#searchProductForm').submit();
            });
        });
    });

    const searchFunction = (inputId, ulId) => {
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