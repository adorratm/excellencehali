<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<section class="page-title" style="background-image: url(<?= !empty($technical_informations_category) && !empty($technical_informations_category->img_url) ? get_picture("technical_information_categories_v", $technical_informations_category->banner_url) : get_picture("settings_v", $settings->technical_information_logo) ?>);">
    <div class="auto-container">
        <div class="content-box">
            <div class="content-wrapper">
                <div class="title">
                    <h1><?= !empty($technical_informations_category) ? strto("lower|ucwords", $technical_informations_category->title) : strto("lower|ucwords", lang("technicalInformations")) ?></h1>
                </div>
                <ul class="bread-crumb style-two">
                    <li>
                        <a rel="dofollow" href="<?= base_url(); ?>" title="<?= strto("lower|ucwords", lang("home")) ?>"><?= strto("lower|ucwords", lang("home")) ?></a>
                    </li>
                    <li>
                        <a href="<?= base_url(lang("routes_technical_informations")); ?>" rel="dofollow" title="<?= strto("lower|ucwords", lang("technicalInformations")) ?>"><?= strto("lower|ucwords", lang("technicalInformations")) ?></a>
                    </li>
                    <?php if (!empty($technical_informations_category)) : ?>
                        <li class="active">
                            <?= strto("lower|ucwords", $technical_informations_category->title) ?>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </div>
</section>


<!-- Shop section -->
<section class="shop-section">
    <div class="auto-container">
        <div class="row align-items-stretch align-self-stretch align-content-stretch">
            <?php $technical_informations_categories = $this->general_model->get_all("technical_information_categories", null, "rank ASC", ["isActive" => 1]); ?>
            <?php $j = 0 ?>
            <?php foreach ($technical_informations_categories as $k => $v) : ?>
                <div class="col-lg-12 justify-content-center text-center">
                    <h2 class="font-weight-bold text-center mb-5 mx-auto p-3" <?= $j % 2 == 0 ? 'style="width: fit-content;border:3px solid #e10018;border-top:unset;border-right:unset"' : 'style="width: fit-content;border:3px solid #e10018;border-top:unset;border-left:unset"' ?>><?= $v->title ?></h2>
                </div>
                <?php
                $search = null;
                if (!empty(clean($this->input->get("search")))) :
                    $search = clean($this->input->get("search"));
                endif;
                $seo_url = $this->uri->segment(3);
                $category_id = null;
                $category = null;
                if (!empty($seo_url) && !is_numeric($seo_url)) :
                    $category = $this->general_model->get("technical_information_categories", null, ["isActive" => 1, "lang" => $this->viewData->lang, "seo_url" => $seo_url]);
                    if (!empty($category)) :
                        $category_id = $category->id;
                        $category->seo_url = (!empty($category->seo_url) ? $category->seo_url : null);
                        $category->title = (!empty($category->title) ? $category->title : null);
                    endif;
                endif;
                /**
                 * Order
                 */
                $order = !empty($_GET["orderBy"]) ? clean($_GET["orderBy"]) : "p.id DESC";
                /**
                 * Likes
                 */
                $likes = [];
                if (!empty($search)) :
                    $likes["p.title"] = $search;
                    $likes["p.content"] = $search;
                    $likes["p.createdAt"] = $search;
                    $likes["p.updatedAt"] = $search;
                    $likes["p.description"] = $search;
                    $likes["p.features"] = $search;
                endif;
                $wheres = [];
                if (!empty($category_id)) :
                    //$wheres["pwc.category_id"] = $category_id;
                endif;
                /**
                 * Wheres
                 */
                $wheres["p.isActive"] = 1;
                $wheres["pi.isCover"] = 1;
                $wheres["pc.id"] = $v->id;

                $wheres["p.lang"] = $this->viewData->lang;
                $joins = ["technical_informations_w_categories pwc" => ["p.id = pwc.technical_information_id", "left"], "technical_information_categories pc" => ["pwc.category_id = pc.id", "left"], "technical_information_images pi" => ["pi.technical_information_id = p.id", "left"]];

                $select = "GROUP_CONCAT(pc.seo_url) category_seos,GROUP_CONCAT(pc.title) category_titles,GROUP_CONCAT(pc.id) category_ids,p.id,p.title,p.seo_url,pi.url img_url,p.isActive,p.sharedAt";
                $distinct = true;
                $groupBy = ["p.id", "pwc.technical_information_id"];
                $technical_informations = $this->general_model->get_all("technical_informations p", $select, $order, $wheres, $likes, $joins, [], [], $distinct, $groupBy);
                ?>
                <?php if (!empty($technical_informations)) : ?>
                    <?php foreach ($technical_informations as $key => $value) : ?>
                        <?php if (strtotime($value->sharedAt) <= strtotime("now")) : ?>
                            <div class="col-lg-3 col-md-6 shop-block mb-4">
                                <div class="inner-box mb-0 h-100 shadow-sm p-3 border rounded">
                                    <div class="image"><a rel="dofollow" href="<?= base_url(lang("routes_technical_informations") . "/" . lang("routes_technical_information") . "/{$value->url}") ?>" title="<?= $value->title ?>"> <img width="1920" height="1280" loading="lazy" data-src="<?= get_picture("technical_informations_v", $value->img_url) ?>" title="<?= $value->title ?>" alt="<?= $value->title ?>" class="img-fluid rounded lazyload"></a></div>
                                    <div class="content-upper mb-0 border-0">
                                        <h5 class="font-weight-bold"><a class="text-dark" rel="dofollow" href="<?= base_url(lang("routes_technical_informations") . "/" . lang("routes_technical_information") . "/{$value->url}") ?>" title="<?= $value->title ?>"><?= $value->title ?></a></h5>
                                    </div>
                                    <div class="w-100 px-3">
                                        <a class="btn rounded-0 btn-block border technicalInformationButton" rel="dofollow" href="<?= base_url(lang("routes_technical_informations") . "/" . lang("routes_technical_information") . "/{$value->url}") ?>" title="<?= $value->title ?>"><?= lang("viewTechnicalInformation") ?></a>
                                    </div>
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
                <?php $j++ ?>
            <?php endforeach ?>

        </div>
        <?= @$links ?>
    </div>
</section>