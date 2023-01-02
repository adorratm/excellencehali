<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="updateGalleryItem" onsubmit="return false" method="post">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Başlık</label>
                <input name="title" class="form-control form-control-sm rounded-0" value="<?= $item->title ?>" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Açıklama</label>
                <textarea name="description" class="form-control form-control-sm m-0 tinymce" required><?= $item->description ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>İçerik Kapak Görseli</label>
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
                <label>Paylaşım Tarihi</label>
                <input type="text" name="sharedAt" placeholder="Paylaşım Tarihi" class="form-control form-control-sm datetimepicker" data-flatpickr data-alt-input="true" data-enable-time="true" data-enable-seconds="true" value="<?= (empty($item->sharedAt) ? date("Y-m-d H:i:s") : $item->sharedAt) ?>" data-default-date="<?= (empty($item->sharedAt) ? date("Y-m-d H:i:s") : $item->sharedAt) ?>" data-date-format="Y-m-d H:i:S" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <button role="button" data-url="<?= base_url("galleries/file_update/{$item->id}/$gallery->id"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnUpdate">Güncelle</button>
            <a href="javascript:void(0)" onclick="closeModal('#fileModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
        </div>
    </div>
</form>