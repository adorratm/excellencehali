<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="createProductCategory" onsubmit="return false" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Başlık</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Başlık" name="title" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Görsel Seçiniz</label>
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                    <div class="form-control rounded-0 text-truncate" data-trigger="fileinput"><i class="fa fa-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                    <span class="input-group-append">
                        <span class=" btn btn-outline-primary rounded-0 btn-file"><span class="fileinput-new">Dosya Seç</span><span class="fileinput-exists">Değiştir</span>
                            <input type="hidden"><input type="file" name="img_url" required>
                        </span>
                        <a href="#" class="btn btn-outline-danger rounded-0 fileinput-exists" data-dismiss="fileinput">Kaldır</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Anasayfa Yatay Görseli Seçiniz</label>
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                    <div class="form-control rounded-0 text-truncate" data-trigger="fileinput"><i class="fa fa-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                    <span class="input-group-append">
                        <span class=" btn btn-outline-primary rounded-0 btn-file"><span class="fileinput-new">Dosya Seç</span><span class="fileinput-exists">Değiştir</span>
                            <input type="hidden"><input type="file" name="home_url" required>
                        </span>
                        <a href="#" class="btn btn-outline-danger rounded-0 fileinput-exists" data-dismiss="fileinput">Kaldır</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Banner Görseli Seçiniz</label>
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                    <div class="form-control rounded-0 text-truncate" data-trigger="fileinput"><i class="fa fa-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                    <span class="input-group-append">
                        <span class=" btn btn-outline-primary rounded-0 btn-file"><span class="fileinput-new">Dosya Seç</span><span class="fileinput-exists">Değiştir</span>
                            <input type="hidden"><input type="file" name="banner_url" required>
                        </span>
                        <a href="#" class="btn btn-outline-danger rounded-0 fileinput-exists" data-dismiss="fileinput">Kaldır</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($categories)) : ?>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group">
                    <label>Üst Kategorisi</label>
                    <select name="top_id" id="top_id" class="form-control">
                        <option value="">Üst Kategori Seçiniz.</option>
                        <?php foreach ($categories as $key => $value) : ?>
                            <option value="<?= $value->id ?>">
                                <?php if (!empty($value->top_id) && $value->top_id !== 0) : ?>
                                    <?php foreach ($categories as $k => $v) : ?>
                                        <?php if ($v->id == $value->top_id) : ?>
                                            <?= $v->title ?> >
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endif ?>
                                <?= $value->title ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
    <?php endif ?>
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
            <button role="button" data-url="<?= base_url("product_categories/save"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnSave">Kaydet</button>
            <a href="javascript:void(0)" onclick="closeModal('#productCategoryModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
        </div>
    </div>
</form>