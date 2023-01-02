<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="updateBank" onsubmit="return false" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Başlık</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Başlık" name="title" value="<?= !empty($item->title) ? $item->title : null; ?>" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Açıklama</label>
                <textarea class="form-control form-control-sm rounded-0 tinymce" name="content" placeholder="Açıklama" required><?= !empty($item->content) ? $item->content : null; ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 image_upload_container my-auto py-auto">
            <picture>
                <img src="<?= get_picture($viewFolder, (!empty($item->img_url) ? $item->img_url : null)); ?>" alt="<?= !empty($item->title) ? $item->title : null ?>" class="img-fluid">
            </picture>
        </div>
        <div class="col-9 col-sm-9 col-md-9 col-lg-9 col-xl-9">
            <div class="form-group">
                <label>Görsel Seçiniz</label>
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                    <div class="form-control rounded-0 text-truncate" data-trigger="fileinput"><i class="fa fa-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
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
            <button data-url="<?= base_url("banks/update/$item->id"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnUpdate">Güncelle</button>
            <a href="javascript:void(0)" onclick="closeModal('#bankModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
        </div>
    </div>
</form>