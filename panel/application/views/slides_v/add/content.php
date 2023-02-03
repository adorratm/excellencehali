<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="createSlide" onsubmit="return false" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Başlık</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Başlık" name="title">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Açıklama</label>
                <textarea name="description" class="m-0 tinymce"></textarea>
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
                <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="button_usage_btn btn-sm custom-control-input" id="customSwitchBtn" name="allowButton" checked>
                    <label class="custom-control-label " for="customSwitchBtn">Buton Kullanımı</label>
                </div>
                <div class="button-information-container row">
                    <div class="col-12">
                        <div class="form-group">

                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>Buton Başlık</label>
                            <input class="form-control form-control-sm rounded-0" placeholder="Butonun Üzerindeki Yazı" name="button_caption">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label>URL Bilgisi</label>
                            <input class="form-control form-control-sm rounded-0" placeholder="Butona Basıldığında Gidilecek Olan URL Bilgisi" name="button_url">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label>Sayfa Linki</label>
                            <select class="form-control form-control-sm rounded-0 tagsInput" name="page_id" required>
                                <option value="">Sayfa Seçiniz.</option>
                                <?php if (!empty($pages)) : ?>
                                    <?php foreach ($pages as $page) : ?>
                                        <option value="<?= $page->id; ?>"><?= $page->title; ?></option>
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
                                        <option value="<?= $service->id; ?>"><?= $service->title; ?></option>
                                    <?php endforeach ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-none">
                        <div class="form-group">
                            <label>Koleksiyon Linki</label>
                            <select disabled class="form-control form-control-sm rounded-0 tagsInput" name="collection_id" required>
                                <option value="">Sayfa Seçiniz.</option>
                                <?php if (!empty($collections)) : ?>
                                    <?php foreach ($collections as $collection) : ?>
                                        <option value="<?= $collection->id; ?>">
                                            <?= $collection->title; ?>
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
                                        <option value="<?= $product->id; ?>"><?= $product->title; ?></option>
                                    <?php endforeach ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label>Link Açılış Türü</label>
                            <select class="form-control form-control-sm rounded-0" name="target" required>
                                <option value="_self">Varsayılan</option>
                                <option value="_blank">Yeni Sekme</option>
                                <option value="_parent">Sayfayı ana frame'de aç</option>
                                <option value="_top">Sayfayı pencerenin gövdesinde aç</option>
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
                <input class="form-control form-control-sm rounded-0" placeholder="Butonun Üzerindeki Yazı" name="video_caption">
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Video URL Bilgisi</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Butona Basıldığında Gidilecek Olan URL Bilgisi" name="video_url">
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
            <button role="button" data-url="<?= base_url("slides/save"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnSave">Kaydet</button>
            <a href="javascript:void(0)" onclick="closeModal('#slideModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
        </div>
    </div>
</form>