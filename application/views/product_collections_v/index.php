<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" style="background-image: url(<?= get_picture("settings_v", $settings->collection_logo) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pageBannerContent text-center">
                    <h2 class="text-white mb-0"><?= strto("lower|ucwords", lang("product_collections")) ?></h2>
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
                <div class="productCount"><?= $offset == 0 ? (!empty($product_collections) ? 1 : 0) : (empty($product_collections) ? 0 : $offset) ?>–<?= $total_rows > $offset + $per_page ? (empty($product_collections) ? 0 : $offset + $per_page) : (empty($product_collections) ? 0 : $total_rows) ?> / <?= empty($product_collections) ? 0 : $total_rows ?></div>
            </div>
            <div class="col-sm-12 col-md-5 col-lg-6 col-xl-7 d-xl-flex my-2">
                <form class="w-100" id="searchCollectionForm" action="<?= !empty($this->uri->segment(3) && !is_numeric($this->uri->segment(3))) ? base_url(lang("routes_product_collections") . "/" . $this->uri->segment(3)) : base_url(lang("routes_product_collections")) ?>" method="GET" enctype="multipart/form-data">

                    <div class="input-group">
                        <input type="hidden" name="orderBy" value="<?= (!empty($_GET["orderBy"]) ? $_GET["orderBy"] : "1") ?>">
                        <input style="padding-right:37px" class="form-control" placeholder="<?= lang("searchCollections") ?>" type="text" name="search" value="<?= (!empty($_GET["search"]) ? $_GET["search"] : null) ?>">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                        <button type="button" class="btn bg-transparent rounded-0" style="margin-left: -37px; z-index: 100;" onclick="$('#searchCollectionForm').find('input[name=search]').val('');$('#searchCollectionForm').submit()">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>

                </form>
            </div>
            <div class="col-sm-12 col-md-5 col-lg-4 col-xl-3 my-2">
                <div class="shopAccessBar">
                    <div class="sortNav">
                        <label><?= lang("orderBy") ?></label>
                        <select name="productFilter" onchange="$('#searchCollectionForm').find('input[name=orderBy]').val($(this).val());$('#searchCollectionForm').submit()">
                            <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 1 ? "selected" : null) ?> value="1"><?= lang("newToOld") ?></option>
                            <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 2 ? "selected" : null) ?> value="2"><?= lang("oldToNew") ?></option>
                            <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 3 ? "selected" : null) ?> value="3"><?= lang("aToZ") ?></option>
                            <option <?= (!empty($_GET["orderBy"]) && $_GET["orderBy"] == 4 ? "selected" : null) ?> value="4"><?= lang("zToA") ?></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($product_collections)) : ?>
            <div class="row collectionProductRow bg-white shadow p-2 align-items-stretch align-self-stretch align-content-stretch">
                <?php foreach ($product_collections as $k => $v) : ?>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xxl-2 my-3">
                        <div class="productItem01 border rounded p-3 h-100 shadow-sm">
                            <div class="pi01Thumb">
                                <img data-src="<?= get_picture("product_collections_v", $v->img_url) ?>" class="img-fluid lazyload" alt="<?= $v->title ?>" title="<?= $v->title ?>" />
                                <img data-src="<?= get_picture("product_collections_v", $v->img_url) ?>" class="img-fluid lazyload" alt="<?= $v->title ?>" title="<?= $v->title ?>" />
                                <div class="pi01Actions">
                                    <a href="<?= base_url(lang("routes_product_collections") . "/" . $v->codes . "/" . $v->seo_url) ?>" rel="dofollow" title="<?= lang("viewProducts") ?>"><i class="fa-solid fa-arrows-up-down-left-right"></i></a>
                                </div>
                            </div>
                            <div class="pi01Details">
                                <h3 class="secTitle text-center fw-medium fs-6"><a href="<?= base_url(lang("routes_product_collections") . "/" . $v->codes . "/" . $v->seo_url) ?>" rel="dofollow" title="<?= lang("viewProducts") ?>"><?= $v->title ?></a></h3>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        <?php if (empty($product_collections)) : ?>
            <div class="alert alert-warning rounded-0 shadow" role="alert">
                <h4 class="alert-heading"><?= lang("warning") ?></h4>
                <p><?= lang("weCantFindAnyProductCollectionsWithYourSearch") ?></p>
                <hr>
                <p class="mb-0"><?= lang("youCanSearchDifferentProductCollections") ?></p>
            </div>
        <?php endif ?>

        <?= @$links ?>
    </div>
</section>
<!-- END: Collections Section -->