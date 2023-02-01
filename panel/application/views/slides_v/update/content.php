<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="updateSlide" onsubmit="return false" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Başlık</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Başlık" name="title" value="<?= !empty($item->title) ? $item->title : null; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Açıklama</label>
                <textarea name="description" class="m-0 tinymce"><?= !empty($item->description) ? $item->description : null; ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 my-auto py-auto">
            <picture>
                <img src="<?= get_picture($viewFolder, (!empty($item->img_url) ? $item->img_url : null)); ?>" alt="<?= (!empty($item->title) ? $item->title : null) ?>" class="img-fluid">
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
                <label>Buton Kullanımı</label><br>
                <div class="custom-control custom-switch mb-3"><input data-id="<?= $item->id ?>" name="allowButton" data-status="<?= (!empty($item->allowButton) && $item->allowButton) ? "checked" : ""; ?>" id="customSwitch<?= $item->id ?><?= $item->lang ?>" type="checkbox" <?= (!empty($item->allowButton) && $item->allowButton) ? "checked" : null; ?> class="custom-control-input button_usage_btn"> <label class="custom-control-label" for="customSwitch<?= $item->id ?><?= $item->lang ?>"></label></div>
                <div class="button-information-container row" style="display : <?= (!empty($item->allowButton) && $item->allowButton) ? "flex" : "none"; ?>">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>Buton Başlık</label>
                            <input class="form-control form-control-sm rounded-0" placeholder="Butonun Üzerindeki Yazı" name="button_caption" value="<?= (!empty($item->button_caption) ? $item->button_caption : null); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>URL Bilgisi</label>
                            <input class="form-control form-control-sm rounded-0" placeholder="Butona Basıldığında Gidilecek Olan URL Bilgisi" name="button_url" value="<?= (!empty($item->button_url) ? $item->button_url : null); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label>Sayfa Linki</label>
                            <select class="form-control form-control-sm rounded-0 tagsInput" name="page_id" required>
                                <option value="">Sayfa Seçiniz.</option>
                                <?php if (!empty($pages)) : ?>
                                    <?php foreach ($pages as $page) : ?>
                                        <option <?= ($page->id == $item->page_id ? "selected" : null) ?> value="<?= $page->id; ?>"><?= $page->title; ?></option>
                                    <?php endforeach ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label>Sektör Linki</label>
                            <select class="form-control form-control-sm rounded-0 tagsInput" name="service_id" required>
                                <option value="">Sektör Seçiniz.</option>
                                <?php if (!empty($services)) : ?>
                                    <?php foreach ($services as $service) : ?>
                                        <option <?= ($service->id == $item->service_id ? "selected" : null) ?> value="<?= $service->id; ?>"><?= $service->title; ?></option>
                                    <?php endforeach ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-none">
                        <div class="form-group">
                            <label>Kategori Linki</label>
                            <select disabled class="form-control form-control-sm rounded-0 tagsInput" name="category_id" required>
                                <option value="">Sayfa Seçiniz.</option>
                                <?php if (!empty($categories)) : ?>
                                    <?php foreach ($categories as $category) : ?>
                                        <option <?= ($category->id == $item->category_id ? "selected" : null) ?> value="<?= $category->id; ?>">
                                            <?= $category->title; ?>
                                        </option>
                                    <?php endforeach ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-none">
                        <div class="form-group">
                            <label>Ürün Linki</label>
                            <select disabled class="form-control form-control-sm rounded-0 tagsInput" name="product_id" required>
                                <option value="">Ürün Seçiniz.</option>
                                <?php if (!empty($products)) : ?>
                                    <?php foreach ($products as $product) : ?>
                                        <option <?= ($product->id == $item->product_id ? "selected" : null) ?> value="<?= $product->id; ?>"><?= $product->title; ?></option>
                                    <?php endforeach ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label>Link Açılış Türü</label>
                            <select class="form-control form-control-sm rounded-0" name="target" required>
                                <option value="_self" <?= ($item->target == "_self" ? "selected" : null) ?>>Varsayılan</option>
                                <option value="_blank" <?= ($item->target == "_blank" ? "selected" : null) ?>>Yeni Sekme</option>
                                <option value="_parent" <?= ($item->target == "_parent" ? "selected" : null) ?>>Sayfayı ana frame'de aç</option>
                                <option value="_top" <?= ($item->target == "_top" ? "selected" : null) ?>>Sayfayı pencerenin gövdesinde aç</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Video Buton Başlık</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Butonun Üzerindeki Yazı" name="video_caption" value="<?= (!empty($item->video_caption) ? $item->video_caption : null); ?>">
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Video URL Bilgisi</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Butona Basıldığında Gidilecek Olan URL Bilgisi" name="video_url" value="<?= (!empty($item->video_url) ? $item->video_url : null); ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Paylaşım Tarihi</label>
                <input type="text" name="sharedAt" placeholder="Paylaşım Tarihi" value="<?= (!empty($item->sharedAt) ? $item->sharedAt : date("Y-m-d H:i:s")) ?>" class="form-control form-control-sm datetimepicker" data-flatpickr data-alt-input="true" data-enable-time="true" data-enable-seconds="true" data-default-date="<?= (!empty($item->sharedAt) ? $item->sharedAt : date("Y-m-d H:i:s")) ?>" data-date-format="Y-m-d H:i:S">
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
            <button role="button" data-url="<?= base_url("slides/update/$item->id"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnUpdate">Güncelle</button>
            <a href="javascript:void(0)" onclick="closeModal('#slideModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
        </div>
    </div>
</form>