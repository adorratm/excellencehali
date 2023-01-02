<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="createGallery" onsubmit="return false" enctype="multipart/form-data" method="post">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Galeri Adı</label>
                <input type="text" class="form-control form-control-sm rounded-0" placeholder="Galeri Adı" name="title" required>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Galeri Kapak Görseli</label>
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                    <div class="form-control form-control-sm rounded-0 text-truncate" data-trigger="fileinput"><i class="fa fa-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                    <span class="input-group-append">
                        <span class=" btn btn-sm btn-outline-primary rounded-0 btn-file"><span class="fileinput-new">Dosya Seç</span><span class="fileinput-exists">Değiştir</span>
                            <input type="hidden"><input type="file" name="img_url" required>
                        </span>
                        <a href="#" class="btn btn-outline-danger rounded-0 fileinput-exists" data-dismiss="fileinput">Kaldır</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Galeri Türü</label>
                <select class="form-control form-control-sm rounded-0" name="gallery_type" required>
                    <option value="images">Resim</option>
                    <option value="files">Dosya</option>
                    <option value="videos">Video</option>
                    <option value="video_urls">Video URL</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
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
            <button data-url="<?= base_url("galleries/save"); ?>" type="button" class="btn btn-sm btn-outline-primary rounded-0 btnSave">Kaydet</button>
            <a href="javascript:void(0)" onclick="closeModal('#galleryModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
        </div>
    </div>
</form>