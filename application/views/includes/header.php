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
                <div class="anItems align-items-center align-self-center align-content-center">
                    <div class="anSearch"><a href="javascript:void(0);"><i class="fa-solid fa-search"></i></a></div>
                    <div class="anUser">
                        <?php if (get_active_user()) : ?>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-md dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user me-2"></i> <?= get_active_user()->full_name ?>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" rel="dofollow" title="<?= lang("account") ?>" href="<?= base_url(lang("routes_account")) ?>"><i class="fa-solid fa-user-circle me-2"></i> <?= lang("account") ?></a></li>
                                    <li><a class="dropdown-item" rel="dofollow" title="<?= lang("orders") ?>" href="<?= base_url(lang("routes_orders")) ?>"><i class="fa-solid fa-boxes-stacked me-2"></i> <?= lang("orders") ?></a></li>
                                    <li><a class="dropdown-item" rel="dofollow" title="<?= lang("logout") ?>" href="<?= base_url(lang("routes_logout")) ?>"><i class="fa-solid fa-power-off me-2"></i> <?= lang("logout") ?></a></li>
                                </ul>
                            </div>
                        <?php endif ?>
                        <?php if (!get_active_user()) : ?>
                            <a rel="dofollow" href="<?= base_url(lang("routes_dealer-login")) ?>" title="<?= lang("dealerLogin") ?>"><span><i class="fa-solid fa-lock me-2"></i> <?= lang("dealerLogin") ?></span></a>
                        <?php endif ?>
                    </div>
                    <div class="anCart">
                        <a href="javascript:void(0);"><i class="fa-solid fa-shopping-cart"></i><span class="totalItemsCount"><?= $total_items ?></span></a>
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
                        <a rel="dofollow" title="<?= $settings->company_name ?>" href="<?= base_url() ?>"><img class="img-fluid lazyload" data-src="<?= get_picture("settings_v", $settings->mobile_logo) ?>" alt="<?= $settings->company_name ?>"></a>
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
                            <form class="w-100" id="searchCollectionFormHeader" action="<?= base_url(lang("routes_product_collections")) ?>" method="GET" enctype="multipart/form-data">

                                <div class="input-group">
                                    <input type="hidden" name="orderBy" value="1">
                                    <input style="padding-right:37px" class="form-control" placeholder="<?= lang("searchCollections") ?>" type="text" name="search" value="<?= (!empty($_GET["search"]) ? $_GET["search"] : null) ?>">
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                                    <button type="button" class="btn bg-transparent rounded-0" style="margin-left: -37px; z-index: 100;" onclick="$('#searchCollectionFormHeader').find('input[name=search]').val('');$('#searchCollectionFormHeader').submit()">
                                        <i class="fa fa-times"></i>
                                    </button>
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