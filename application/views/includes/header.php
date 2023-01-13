<!-- BEGIN: TopBar Section -->
<section class="topbarSection">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-md-6">
                <div class="tbInfo">
                    <?php if (!empty($settings->email)) : ?>
                        <a rel="dofollow" title="Email" href="mailto:<?= $settings->email ?>" class="ulinaLink"><i class="fa-solid fa-envelope-open"></i> <?= $settings->email ?></a>
                    <?php endif ?>
                    <?php if (!empty(@json_decode($settings->phone, TRUE)[0])) : ?>
                        <a rel="dofollow" title="<?= lang("phone") ?>" href="tel:<?= @json_decode($settings->phone, TRUE)[0] ?>" class="ulinaLink"><i class="fa-solid fa-phone-volume"></i><?= @json_decode($settings->phone, TRUE)[0] ?></a>
                    <?php endif ?>
                </div>
            </div>
            <div class="col-sm-4 col-md-6">
                <div class="tbAccessNav">
                    <div class="anSocial">
                        <?php if (!empty($settings->facebook)) : ?>
                            <a class="facebook" rel="nofollow" href="<?= $settings->facebook ?>" title="Facebook" target="_blank">
                                <span aria-hidden="true" class="fa fa-facebook"></span>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->twitter)) : ?>
                            <a class="twitter" rel="nofollow" href="<?= $settings->twitter ?>" title="Twitter" target="_blank">
                                <span aria-hidden="true" class="fa fa-twitter"></span>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->instagram)) : ?>
                            <a class="instagram" rel="nofollow" href="<?= $settings->instagram ?>" title="Instagram" target="_blank">
                                <span aria-hidden="true" class="fa fa-instagram"></span>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->linkedin)) : ?>
                            <a class="linkedin" rel="nofollow" href="<?= $settings->linkedin ?>" title="Linkedin" target="_blank">
                                <span aria-hidden="true" class="fa fa-linkedin"></span>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->youtube)) : ?>
                            <a class="youtube" rel="nofollow" href="<?= $settings->youtube ?>" title="Youtube" target="_blank">
                                <span aria-hidden="true" class="fa fa-youtube"></span>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->medium)) : ?>
                            <a class="medium" rel="nofollow" href="<?= $settings->medium ?>" title="Medium" target="_blank">
                                <span aria-hidden="true" class="fa fa-medium"></span>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->pinterest)) : ?>
                            <a class="pinterest" rel="nofollow" href="<?= $settings->pinterest ?>" title="Pinterest" target="_blank">
                                <span aria-hidden="true" class="fa fa-pinterest"></span>
                            </a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="tbBar"></div>
            </div>
        </div>
    </div>
</section>
<!-- END: TopBar Section -->

<!-- BEGIN: Section -->
<header class="header01 h01Mode2 isSticky">
    <div class="container-fluid">
        <div class="headerInner02">
            <div class="logo">
                <a rel="dofollow" href="<?= base_url() ?>" title="<?= $settings->company_name ?>">
                    <picture>
                        <img width="300" height="90" data-src="<?= get_picture("settings_v", $settings->logo) ?>" alt="<?= $settings->company_name ?>" class="lazyload img-fluid rounded">
                    </picture>
                </a>
            </div>
            <div class="mainMenu">
                <?= $menus ?>
            </div>
            <div class="accessNav">
                <a href="javascript:void(0);" class="menuToggler"><i class="fa-solid fa-bars"></i> <span>Menu</span></a>
                <div class="anItems">
                    <div class="anSearch"><a href="javascript:void(0);"><i class="fa-solid fa-search"></i></a></div>
                    <div class="anUser"><a href="javascript:void(0);"><i class="fa-solid fa-user"></i></a></div>
                    <div class="anCart">
                        <a href="javascript:void(0);"><i class="fa-solid fa-shopping-cart"></i><span><?= count($this->cart->contents()) ?></span></a>
                        <div class="cartWidgetArea">
                            <?php $this->load->view("includes/headerCart") ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="blankHeader"></div>
<!-- END: Section -->

<!-- BEGIN: Search Popup Section -->
<section class="popup_search_sec">
    <div class="popup_search_overlay"></div>
    <div class="pop_search_background">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="popup_logo">
                        <a rel="dofollow" href="<?= base_url() ?>" title="<?= $settings->company_name ?>">
                            <picture>
                                <img width="300" height="90" data-src="<?= get_picture("settings_v", $settings->logo) ?>" alt="<?= $settings->company_name ?>" class="lazyload img-fluid">
                            </picture>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <a href="javascript:void(0);" id="search_Closer" class="search_Closer"></a>
                </div>
            </div>
        </div>
        <div class="middle_search">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="popup_search_form">
                            <form id="searchForm" action="<?= !empty($this->uri->segment(2) && !is_numeric($this->uri->segment(2))) ? base_url(lang("routes_product_categories")) : base_url(lang("routes_product_categories")) ?>" method="GET" enctype="multipart/form-data">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                <div class="input-group">
                                    <select class="form-select" onchange="$('#searchForm,#searchFormMobile').attr('action',$(this).val())">
                                        <option value="<?= base_url(lang("routes_product_categories")) ?>"><?= lang("searchAllCategories") ?></option>
                                        <?php if (!empty($menuCategories)) : ?>
                                            <?php foreach ($menuCategories as $key => $value) : ?>
                                                <?php if ($value->top_id == 0) : ?>
                                                    <option value="<?= base_url(lang("routes_product_categories") . "/" . $value->seo_url) ?>"><?= $value->title ?></option>
                                                <?php endif ?>
                                            <?php endforeach; ?>
                                        <?php endif ?>
                                    </select>
                                    <input type="hidden" name="orderBy" value="<?= (!empty($_GET["orderBy"]) ? clean($_GET["orderBy"]) : null) ?>">
                                    <input type="hidden" name="amount" value="<?= (!empty($_GET["amount"]) ? clean($_GET["amount"]) : null) ?>">
                                    <input type="hidden" name="key" value="<?= (!empty($_GET["key"]) ? clean($_GET["key"]) : null) ?>">
                                    <input name="search" id="search" type="search" placeholder="<?= lang("searchProduct") ?>..." required>
                                    <button type="submit" aria-label="<?= $settings->company_name ?>"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Search Popup Section -->