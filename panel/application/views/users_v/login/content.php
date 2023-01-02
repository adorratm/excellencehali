<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<header class="d-flex justify-content-between align-items-center">
    <a class="d-flex auth-brand" href="<?= base_url() ?>">
        <picture>
            <img class="brand-img img-fluid" src="https://mutfakyapim.com/images/mutfak/logo.png?v=1" alt="Mutfak Yapım" />
        </picture>
    </a>
    <div class="btn-group btn-group-sm">
        <a href="https://mutfakyapim.com/iletisim" class="btn btn-sm btn-outline-secondary rounded-0">İletişim</a>
        <a href="https://mutfakyapim.com/biz-kimiz" class="btn btn-sm btn-outline-secondary rounded-0">Hakkımızda</a>
    </div>
</header>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-5 pa-0">
            <div id="owl_demo_1" class="owl-carousel dots-on-item owl-theme">
                <div class="fadeOut item auth-cover-img overlay-wrap" style="background-image:url(<?= base_url("assets/img/background.jpg") ?>);">
                    <div class="auth-cover-info py-xl-0 pt-100 pb-50">
                        <div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">
                            <h1 class="display-3 text-white mb-20">Websitenizi Daha İyi Yönetin.</h1>
                            <p class="text-white">Yönetim panelinize hoşgeldiniz. Websitenizin ihtiyacını karşılayabileceğiniz tüm özellikleri sunuyoruz...</p>
                        </div>
                    </div>
                    <div class="bg-overlay bg-trans-dark-75"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-7 pa-0">
            <div class="auth-form-wrap py-xl-0 py-50">
                <div class="auth-form w-xxl-55 w-xl-75 w-sm-90 w-xs-100">
                    <form action="<?= base_url("userop/do_login"); ?>" method="post">
                        <h1 class="display-4 mb-10">Tekrar Hoşgeldiniz :)</h1>
                        <p class="mb-30">Bilgilerinizle Panele giriş Yapın.</p>
                        <div class="form-group">
                            <input id="sign-in-email" type="email" class="form-control form-control-sm rounded-0" placeholder="Email" name="user_email">
                            <?php if (isset($form_error)) : ?><small class="input-form-error float-right"><?= form_error("user_email"); ?></small> <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <input id="sign-in-password" type="password" class="form-control form-control-sm rounded-0" placeholder="Şifre" name="user_password">
                                <?php if (isset($form_error)) : ?><small class="input-form-error float-right"><?= form_error("user_password"); ?></small> <?php endif; ?>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-pink rounded-0 btn-block login-btn" type="submit">Giriş Yap</button>
                        <p class="font-14 text-center mt-15">Oturum Açarken Problem Mi Yaşıyorsunuz?</p>
                        <p class="text-center"><a href="<?= base_url("sifremi-unuttum"); ?>">Şifremi unuttum.</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>