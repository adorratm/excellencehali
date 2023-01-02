<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<header class="d-flex justify-content-between align-items-center">
    <a class="d-flex auth-brand" href="<?= base_url() ?>">
        <picture>
            <img class="brand-img" src="https://mutfakyapim.com/images/mutfak/logo.png?v=1" alt="Mutfak Yapım" />
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
                    <form action="<?= base_url("reset-password"); ?>" method="post">
                        <h1 class="display-4 mb-10">Şifrenizi mi unuttunuz ?</h1>
                        <p class="mb-30">Bilgilerinizle şifrenizi sıfırlayın.</p>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-sm rounded-0" placeholder="E-Posta Adresi" name="email" value="<?= isset($form_error) ? set_value("email") : ""; ?>">
                            <?php if (isset($form_error)) : ?><small class="input-form-error float-right"><?= form_error("email"); ?></small> <?php endif; ?>
                        </div>
                        <button class="btn btn-sm btn-pink rounded-0 btn-block login-btn" type="submit">Şifremi Sıfırla</button>
                        <p class="font-14 text-center mt-15">Şifrenizi Hatırladınız Mı?</p>
                        <p class="text-center"><a href="<?= base_url("login"); ?>">Giriş Yapın.</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>