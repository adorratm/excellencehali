<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="updateProduct" onsubmit="return false" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Başlık</label>
                <input disabled class="form-control form-control-sm rounded-0" placeholder="Başlık" name="title" value="<?= !empty($item->title) ? $item->title : null; ?>" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Kısa Açıklama</label>
                <textarea name="content" class="m-0 tinymce" required><?= !empty($item->content) ? $item->content : null; ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Açıklama</label>
                <textarea name="description" class="m-0 tinymce" required><?= !empty($item->description) ? $item->description : null; ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Özellikler</label>
                <textarea name="features" class="m-0 tinymce" required><?= !empty($item->features) ? $item->features : null; ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 my-auto py-auto">
            <picture>
                <img src="<?= get_picture($viewFolder, !empty($item->img_url) ? $item->img_url : null); ?>" alt="<?= !empty($item->title) ? $item->title : null ?>" class="img-fluid">
            </picture>
        </div>
        <div class="col-9 col-sm-9 col-md-9 col-lg-9 col-xl-9 my-auto py-auto">
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
                <label>Ürün Koleksiyonu</label>
                <select class="rounded-0 tagsInput" name="collection_id" required disabled>
                    <?php foreach ($collections as $collection) : ?>
                        <option <?= ($collection->id == $item->collection_id ? "selected" : null) ?> value="<?= $collection->id; ?>">
                            <?= $collection->id ?> - <?= $collection->title; ?>
                        </option>
                    <?php endforeach ?>
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
            <button role="button" data-url="<?= base_url("products/update/$item->codes_id/$item->codes"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnUpdate">Güncelle</button>
            <a href="javascript:void(0)" onclick="closeModal('#productModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
        </div>
    </div>
</form>