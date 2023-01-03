<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $user = get_active_user(); ?>
<!-- Vertical Nav -->
<nav class="hk-nav hk-nav-dark">
    <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><i class="fa fa-times position-absolute"></i>
        <picture><img class="brand-img mx-auto mt-1" width="160" src="https://mutfakyapim.com/images/mutfak/logo.png?v=1"></picture>
    </a>
    <div class="nicescroll-bar">
        <div class="navbar-nav-wrap">
            <ul class="navbar-nav flex-column">
                <?php if (isAllowedViewModule("dashboard")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url() ?>">
                            <i class="fa fa-tachometer-alt"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("settings")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "settings") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url("settings") ?>">
                            <i class="fa fa-cogs"></i>
                            <span class="nav-link-text">Ayarlar</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("emailsettings")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "emailsettings") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url("emailsettings") ?>">
                            <i class="fa fa-mail-bulk"></i>
                            <span class="nav-link-text">E-Posta Ayarları</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("galleries")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "galleries") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url("galleries") ?>">
                            <i class="fa fa-photo-video"></i>
                            <span class="nav-link-text">Galeri İşlemleri</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("stories")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "stories") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url("stories") ?>">
                            <i class="fa fa-photo-video"></i>
                            <span class="nav-link-text">Hikaye İşlemleri</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("slides")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "slides") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url("slides") ?>">
                            <i class="fa fa-images"></i>
                            <span class="nav-link-text">Slider</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("ads")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "ads") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url("ads") ?>">
                            <i class="fa fa-ad"></i>
                            <span class="nav-link-text">Reklamlar</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("blogs")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "blogs") || ($this->uri->segment(1) == "blog_categories") ? "active" : "" ?>">
                        <a class="nav-link <?= ($this->uri->segment(1) == "blogs") || ($this->uri->segment(1) == "blog_categories") ? "active" : "" ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#blogs_nav">
                            <i class="fa fa-newspaper"></i>
                            <span class="nav-link-text">Blog İşlemleri</span>
                        </a>
                        <ul id="blogs_nav" class="nav flex-column collapse  <?= ($this->uri->segment(1) == "blogs") || ($this->uri->segment(1) == "blog_categories") ? "show" : "" ?> collapse-level-1">
                            <li class="nav-item <?= ($this->uri->segment(1) == "blogs") || ($this->uri->segment(1) == "blog_categories") ? "active" : "" ?>">
                                <ul class="nav flex-column">
                                    <li class="nav-item  <?= ($this->uri->segment(1) == "blog_categories") ? "active" : "" ?>">
                                        <a class="nav-link <?= ($this->uri->segment(1) == "blog_categories") ? "active" : "" ?>" href="<?= base_url("blog_categories"); ?>">Blog Kategorileri</a>
                                    </li>
                                    <li class="nav-item  <?= ($this->uri->segment(1) == "blogs") ? "active" : "" ?>">
                                        <a class="nav-link <?= ($this->uri->segment(1) == "blogs") ? "active" : "" ?>" href="<?= base_url("blogs"); ?>">Blog</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("services")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "services") || ($this->uri->segment(1) == "service_categories") ? "active" : "" ?>">
                        <a class="nav-link <?= ($this->uri->segment(1) == "services") || ($this->uri->segment(1) == "service_categories") ? "active" : "" ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#services_nav">
                            <i class="fa fa-cog"></i>
                            <span class="nav-link-text">Hizmet İşlemleri</span>
                        </a>
                        <ul id="services_nav" class="nav flex-column collapse  <?= ($this->uri->segment(1) == "services") || ($this->uri->segment(1) == "service_categories") ? "show" : "" ?> collapse-level-1">
                            <li class="nav-item <?= ($this->uri->segment(1) == "services") || ($this->uri->segment(1) == "service_categories") ? "active" : "" ?>">
                                <ul class="nav flex-column">
                                    <li class="nav-item  <?= ($this->uri->segment(1) == "service_categories") ? "active" : "" ?>">
                                        <a class="nav-link <?= ($this->uri->segment(1) == "service_categories") ? "active" : "" ?>" href="<?= base_url("service_categories"); ?>">Hizmet Kategorileri</a>
                                    </li>
                                    <li class="nav-item  <?= ($this->uri->segment(1) == "services") ? "active" : "" ?>">
                                        <a class="nav-link <?= ($this->uri->segment(1) == "services") ? "active" : "" ?>" href="<?= base_url("services"); ?>">Hizmetler</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("sectors")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "sectors") || ($this->uri->segment(1) == "sector_categories") ? "active" : "" ?>">
                        <a class="nav-link <?= ($this->uri->segment(1) == "sectors") || ($this->uri->segment(1) == "sector_categories") ? "active" : "" ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#sectors_nav">
                            <i class="fa fa-globe"></i>
                            <span class="nav-link-text">Sektör İşlemleri</span>
                        </a>
                        <ul id="sectors_nav" class="nav flex-column collapse  <?= ($this->uri->segment(1) == "sectors") || ($this->uri->segment(1) == "sector_categories") ? "show" : "" ?> collapse-level-1">
                            <li class="nav-item <?= ($this->uri->segment(1) == "sectors") || ($this->uri->segment(1) == "sector_categories") ? "active" : "" ?>">
                                <ul class="nav flex-column">
                                    <li class="nav-item  <?= ($this->uri->segment(1) == "sector_categories") ? "active" : "" ?>">
                                        <a class="nav-link <?= ($this->uri->segment(1) == "sector_categories") ? "active" : "" ?>" href="<?= base_url("sector_categories"); ?>">Sektör Kategorileri</a>
                                    </li>
                                    <li class="nav-item  <?= ($this->uri->segment(1) == "sectors") ? "active" : "" ?>">
                                        <a class="nav-link <?= ($this->uri->segment(1) == "sectors") ? "active" : "" ?>" href="<?= base_url("sectors"); ?>">Sektörler</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("users")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "users" || $this->uri->segment(1) == "user_role") ? "active" : "" ?> ">
                        <a class="nav-link <?= ($this->uri->segment(1) == "users" || $this->uri->segment(1) == "user_role") ? "active" : "" ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#users_nav">
                            <i class="fa fa-users"></i>
                            <span class="nav-link-text">Kullanıcı İşlemleri</span>
                        </a>
                        <ul id="users_nav" class="nav flex-column collapse <?= ($this->uri->segment(1) == "user_role") || ($this->uri->segment(1) == "users") ? "show" : "" ?>  collapse-level-1">
                            <li class="nav-item <?= ($this->uri->segment(1) == "users" || $this->uri->segment(1) == "user_role") ? "active" : "" ?>">
                                <ul class="nav flex-column">
                                    <?php if (isAllowedViewModule("user_role")) { ?>
                                        <li class="nav-item <?= ($this->uri->segment(1) == "user_role") ? "active" : "" ?>">
                                            <a class="nav-link <?= ($this->uri->segment(1) == "user_role") ? "active" : "" ?>" href="<?= base_url("user_role"); ?>">Kullanıcı Yetkileri</a>
                                        </li>
                                    <?php } ?>
                                    <li class="nav-item <?= ($this->uri->segment(1) == "users") ? "active" : "" ?>">
                                        <a class="nav-link <?= ($this->uri->segment(1) == "users") ? "active" : "" ?>" href="<?= base_url("users"); ?>">Kullanıcılar</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("products")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "products") || ($this->uri->segment(1) == "product_categories") ? "active" : "" ?>">
                        <a class="nav-link <?= ($this->uri->segment(1) == "products") || ($this->uri->segment(1) == "product_categories") ? "active" : "" ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#products_nav">
                            <i class="fa fa-dropbox"></i>
                            <span class="nav-link-text">Ürün İşlemleri</span>
                        </a>
                        <ul id="products_nav" class="nav flex-column collapse  <?= ($this->uri->segment(1) == "products") || ($this->uri->segment(1) == "product_categories") ? "show" : "" ?> collapse-level-1">
                            <li class="nav-item <?= ($this->uri->segment(1) == "products") || ($this->uri->segment(1) == "products_categories") ? "active" : "" ?>">
                                <ul class="nav flex-column">
                                    <li class="nav-item  <?= ($this->uri->segment(1) == "product_categories") ? "active" : "" ?>">
                                        <a class="nav-link <?= ($this->uri->segment(1) == "product_categories") ? "active" : "" ?>" href="<?= base_url("product_categories"); ?>">Ürün Kategorileri</a>
                                    </li>
                                    <li class="nav-item  <?= ($this->uri->segment(1) == "products") ? "active" : "" ?>">
                                        <a class="nav-link <?= ($this->uri->segment(1) == "products") ? "active" : "" ?>" href="<?= base_url("products"); ?>">Ürünler</a>
                                    </li>
                                    <li class="nav-item  <?= ($this->uri->segment(1) == "product_patterns") ? "active" : "" ?>">
                                        <a class="nav-link <?= ($this->uri->segment(1) == "product_patterns") ? "active" : "" ?>" href="<?= base_url("product_patterns"); ?>">Ürün Desenleri</a>
                                    </li>
                                    <li class="nav-item  <?= ($this->uri->segment(1) == "product_dimensions") ? "active" : "" ?>">
                                        <a class="nav-link <?= ($this->uri->segment(1) == "product_dimensions") ? "active" : "" ?>" href="<?= base_url("product_dimensions"); ?>">Ürün Ebatları</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("technical_informations")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "technical_informations") || ($this->uri->segment(1) == "technical_information_categories") ? "active" : "" ?>">
                        <a class="nav-link <?= ($this->uri->segment(1) == "technical_informations") || ($this->uri->segment(1) == "technical_information_categories") ? "active" : "" ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#technical_informations_nav">
                            <i class="fa fa-info"></i>
                            <span class="nav-link-text">Teknik Bilgi İşlemleri</span>
                        </a>
                        <ul id="technical_informations_nav" class="nav flex-column collapse  <?= ($this->uri->segment(1) == "technical_informations") || ($this->uri->segment(1) == "technical_information_categories") ? "show" : "" ?> collapse-level-1">
                            <li class="nav-item <?= ($this->uri->segment(1) == "technical_informations") || ($this->uri->segment(1) == "technical_informations_categories") ? "active" : "" ?>">
                                <ul class="nav flex-column">
                                    <li class="nav-item  <?= ($this->uri->segment(1) == "technical_information_categories") ? "active" : "" ?>">
                                        <a class="nav-link <?= ($this->uri->segment(1) == "technical_information_categories") ? "active" : "" ?>" href="<?= base_url("technical_information_categories"); ?>">Teknik Bilgi Kategorileri</a>
                                    </li>
                                    <li class="nav-item  <?= ($this->uri->segment(1) == "technical_informations") ? "active" : "" ?>">
                                        <a class="nav-link <?= ($this->uri->segment(1) == "technical_informations") ? "active" : "" ?>" href="<?= base_url("technical_informations"); ?>">Teknik Bilgiler</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("orders")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "orders") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url("orders"); ?>">
                            <i class="fa fa-cash-register"></i>
                            <span class="nav-link-text">Siparişler</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("coupons")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "coupons") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url("coupons") ?>">
                            <i class="fa fa-tags"></i>
                            <span class="nav-link-text">İndirim Kuponları</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("questions")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "questions") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url("questions") ?>">
                            <i class="fa fa-question"></i>
                            <span class="nav-link-text">Soru (SSS)</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("menus")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "menus") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url("menus") ?>">
                            <i class="fa fa-list"></i>
                            <span class="nav-link-text">Menüler</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("pages")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "pages") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url("pages") ?>">
                            <i class="fa fa-sticky-note"></i>
                            <span class="nav-link-text">Sayfalar</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("brands")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "brands") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url("brands") ?>">
                            <i class="fa fa-apple"></i>
                            <span class="nav-link-text">Markalar</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("offers")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "offers") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url("offers") ?>">
                            <i class="fa fa-bell"></i>
                            <span class="nav-link-text">Teklif Başvuruları</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("testimonials")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "testimonials") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url("testimonials"); ?>">
                            <i class="fa fa-sticky-note"></i>
                            <span class="nav-link-text">Ziyaretçi Notları</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("homeitems")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "homeitems") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url("homeitems"); ?>">
                            <i class="fa fa-sticky-note"></i>
                            <span class="nav-link-text">Anasayfa İçerikleri</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("popups")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "popups") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url("popups"); ?>">
                            <i class="fa fa-lightbulb"></i>
                            <span class="nav-link-text">Popup Hizmeti</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (isAllowedViewModule("banks")) { ?>
                    <li class="nav-item <?= ($this->uri->segment(1) == "banks") ? "active" : "" ?> ">
                        <a class="nav-link" href="<?= base_url("banks"); ?>">
                            <i class="fa fa-university"></i>
                            <span class="nav-link-text">Bankalar</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <hr class="nav-separator">
            <div class="nav-header">
                <span>Siteyi Görüntüleyin</span>
                <span>SG</span>
            </div>
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="<?= str_replace("panel/", "", base_url()) ?>">
                        <i class="fa fa-external-link-alt"></i>
                        <span class="nav-link-text">Siteyi Görüntüle</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
<!-- /Vertical Nav -->