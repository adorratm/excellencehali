<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="createMenus" onsubmit="return false" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-auto pt-auto">
            <div class="form-group">
                <label>Menü Adı</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Menü Adı" name="title" required>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-auto pt-auto">
            <div class="form-group">
                <label>Menü URL (Sayfa Eklemek İstiyorsanız Boş Bırakmanız Gerekir.)</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Menü URL" name="url">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Sayfa Linki</label>
                <select class="form-control form-control-sm rounded-0" name="page_id" required>
                    <option value="">Sayfa Seçiniz.</option>
                    <?php if (!empty($pages)) : ?>
                        <?php foreach ($pages as $page) : ?>
                            <option value="<?= $page->id; ?>"><?= $page->title; ?></option>
                        <?php endforeach ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Üst Menü</label>
                <select class="form-control form-control-sm rounded-0" name="top_id" required>
                    <option value="">Ana Menü Olarak Belirle.</option>
                    <?php if (!empty($top_menus)) : ?>
                        <?php foreach ($top_menus as $menu) : ?>
                            <option value="<?= $menu->id; ?>"><?= $menu->title; ?> - <?= $menu->position ?></option>
                        <?php endforeach ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Menü Pozisyonu</label>
                <select class="form-control form-control-sm rounded-0" name="position" required>
                    <option value="HEADER">HEADER MENÜ</option>
                    <option value="HEADER_RIGHT">HEADER SAĞ MENÜ</option>
                    <option value="MOBILE">MOBİL MENÜ</option>
                    <option value="FOOTER">FOOTER MENÜ</option>
                    <option value="FOOTER2">FOOTER MENÜ 2</option>
                    <option value="FOOTER3">FOOTER MENÜ 3</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Menü Açılış Türü</label>
                <select class="form-control form-control-sm rounded-0" name="target" required>
                    <option value="_self">Varsayılan</option>
                    <option value="_blank">Yeni Sekme</option>
                    <option value="_parent">Sayfayı ana frame'de aç</option>
                    <option value="_top">Sayfayı pencerenin gövdesinde aç</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Dil</label>
                <select name="lang" class="form-control form-control-sm rounded-0" required>
                    <?php if (!empty($settings)) : ?>
                        <?php foreach ($settings as $key => $value) : ?>
                            <option value="<?= $value->lang ?>"><?= $value->lang ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <button role="button" data-url="<?= base_url("menus/save"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnSave">Kaydet</button>
            <a href="javascript:void(0)" onclick="closeModal('#menusModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
        </div>
    </div>
</form>