<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="updateMenus" onsubmit="return false" action="" method="post">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-auto pt-auto">
            <div class="form-group">
                <label>Menü Adı </label>
                <input class="form-control form-control-sm rounded-0" placeholder="Menü Adı" name="title" value="<?= (!empty($item->title) ? $item->title : null); ?>" required>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-auto pt-auto">
            <div class="form-group">
                <label>Menü URL (Sayfa Eklemek İstiyorsanız Boş Bırakmanız Gerekir.)</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Menü URL" name="url" value="<?= (!empty($item->url) ? $item->url : null); ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Sayfa Linki (URL Eklemek İstiyorsanız Boş Bırakmanız Gerekir.)</label>
                <select class="form-control form-control-sm rounded-0" name="page_id" required>
                    <option value="">Sayfa Seçiniz.</option>
                    <?php if (!empty($pages)) : ?>
                        <?php foreach ($pages as $page) : ?>
                            <option value="<?= $page->id; ?>" <?= ($item->page_id == $page->id ? "selected" : null) ?>><?= $page->title; ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Üst Menü </label>
                <select class="form-control form-control-sm rounded-0" name="top_id" required>
                    <option value="">Ana Menü Olarak Belirle.</option>
                    <?php if (!empty($top_menus)) : ?>
                        <?php foreach ($top_menus as $menu) : ?>
                            <option value="<?= $menu->id; ?>" <?= ($item->top_id == $menu->id ? "selected" : null) ?>><?= $menu->title; ?> - <?= $menu->position ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Menü Pozisyonu</label>
                <select class="form-control form-control-sm rounded-0" name="position" required>
                    <option value="HEADER" <?= ($item->position == "HEADER" ? "selected" : null) ?>>HEADER MENÜ</option>
                    <option value="HEADER_RIGHT" <?= ($item->position == "HEADER_RIGHT" ? "selected" : null) ?>>HEADER SAĞ MENÜ</option>
                    <option value="MOBILE" <?= ($item->position == "MOBILE" ? "selected" : null) ?>>MOBİL MENÜ</option>
                    <option value="FOOTER" <?= ($item->position == "FOOTER" ? "selected" : null) ?>>FOOTER MENÜ</option>
                    <option value="FOOTER2" <?= ($item->position == "FOOTER2" ? "selected" : null) ?>>FOOTER MENÜ 2</option>
                    <option value="FOOTER3" <?= ($item->position == "FOOTER3" ? "selected" : null) ?>>FOOTER MENÜ 3</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Menü Açılış Türü</label>
                <select class="form-control form-control-sm rounded-0" name="target" required>
                    <option value="_self" <?= ($item->target == "_self" ? "selected" : null) ?>>Varsayılan</option>
                    <option value="_blank" <?= ($item->target == "_blank" ? "selected" : null) ?>>Yeni Sekme</option>
                    <option value="_parent" <?= ($item->target == "_parent" ? "selected" : null) ?>>Sayfayı ana frame'de aç</option>
                    <option value="_top" <?= ($item->target == "_top" ? "selected" : null) ?>>Sayfayı pencerenin gövdesinde aç</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Dil</label>
                <input type="text" class="form-control form-control-sm rounded-0" name="lang" disabled value="<?= !empty($item->lang) ? $item->lang : "tr" ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <button role="button" data-url="<?= base_url("menus/update/{$item->id}"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnUpdate">Güncelle</button>
            <a href="javascript:void(0)" onclick="closeModal('#menusModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
        </div>
    </div>
</form>