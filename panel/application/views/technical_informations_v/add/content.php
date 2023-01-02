<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="createTechnicalInformation" onsubmit="return false" action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Başlık</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Başlık" name="title" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Kısa Açıklama</label>
                <textarea name="content" class="m-0 tinymce" required></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Açıklama</label>
                <textarea name="description" class="m-0 tinymce" required></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Özellikler</label>
                <textarea name="features" class="m-0 tinymce" required></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Teknik Bilgi Kategorisi</label>
                <select class="rounded-0 tagsInput" multiple name="category_id[]" required>
                    <option value="">Teknik Bilgi Kategorisi Seçiniz.</option>
                    <?php if (!empty($categories)) : ?>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category->id; ?>">
                                <?php if (!empty($category->top_id) && $category->top_id !== 0) : ?>
                                    <?php foreach ($categories as $k => $v) : ?>
                                        <?php if ($v->id == $category->top_id) : ?>
                                            <?= $v->title ?> >
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endif ?>
                                <?= $category->title; ?>
                            </option>
                        <?php endforeach ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Paylaşım Tarihi</label>
                <input type="text" name="sharedAt" placeholder="Paylaşım Tarihi" class="form-control form-control-sm datetimepicker" data-flatpickr data-alt-input="true" data-enable-time="true" data-enable-seconds="true" value="<?= date("Y-m-d H:i:s") ?>" data-default-date="<?= date("Y-m-d H:i:s") ?>" data-date-format="Y-m-d H:i:S" required>
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
            <button role="button" data-url="<?= base_url("technical_informations/save"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnSave">Kaydet</button>
            <a href="javascript:void(0)" onclick="closeModal('#technicalInformationModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
        </div>
    </div>
</form>