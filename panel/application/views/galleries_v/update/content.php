<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="updateGallery" onsubmit="return false" method="post">
    <div class="mb-3 nav-tabs-horizontal">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group">
                    <label>Galeri Adı</label>
                    <input class="form-control form-control-sm rounded-0" placeholder="Galeri Adı" name="title" value="<?= (!empty($item->title) ? $item->title : null); ?>" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group row">
                    <div class="col-3">
                        <picture>
                            <img src="<?= get_picture("$viewFolder/{$item->gallery_type}/" . (!empty($item->folder_name) ? $item->folder_name : null), (!empty($item->img_url) ? $item->img_url : null)) ?>" class="img-fluid" alt="<?= (!empty($item->title) ? $item->title : null) ?>">
                        </picture>
                    </div>
                    <div class="col-9">
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control rounded-0 text-truncate" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                            <span class="input-group-append">
                                <span class=" btn btn-outline-primary rounded-0 btn-file"><span class="fileinput-new">Dosya Seç</span><span class="fileinput-exists">Değiştir</span>
                                    <input type="hidden"><input type="file" name="img_url">
                                </span>
                                <a href="#" class="btn btn-outline-danger rounded-0 fileinput-exists" data-dismiss="fileinput">Kaldır</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group">
                    <label>Paylaşım Tarihi</label>
                    <input type="text" name="sharedAt" placeholder="Paylaşım Tarihi" class="form-control form-control-sm datetimepicker" data-flatpickr data-alt-input="true" data-enable-time="true" data-enable-seconds="true" value="<?= (!empty($item->sharedAt) ? $item->sharedAt : null) ?>" data-default-date="<?= (!empty($item->sharedAt) ? $item->sharedAt : null) ?>" data-date-format="Y-m-d H:i:S" required>
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
                <button data-url="<?= base_url("galleries/update/$item->id/$item->gallery_type"); ?>" type="button" class="btn btn-sm btn-outline-primary rounded-0 btnUpdate">Güncelle</button>
                <a href="javascript:void(0)" onclick="closeModal('#galleryModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
            </div>
        </div>
</form>