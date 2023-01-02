<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <?php if ($item->gallery_type != "video_urls") : ?>
                <form data-table="detailTable" action="<?= base_url("galleries/file_upload/$item->id/$item->gallery_type/$item->lang"); ?>" id="dropzone<?= $item->lang ?>" class="dropzone" data-plugin="dropzone" data-options="{ url: '<?= base_url("galleries/file_upload/$item->id/$item->gallery_type/$item->lang"); ?>'}">
                    <div class="dz-message">
                        <h3 class="m-h-lg">Yüklemek istediğiniz dosyaları buraya sürükleyiniz</h3>
                        <p class="mb-3 text-muted">(Yüklemek için dosyalarınızı sürükleyiniz yada buraya tıklayınız)</p>
                    </div>
                </form>
            <?php else : ?>
                <form id="createGalleryItem" onsubmit="return false" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Video URL (Embed)</label>
                        <input type="text" name="url" class="form-control form-control-sm rounded-0" required>
                    </div>
                    <div class="form-group">
                        <button data-url="<?= base_url("galleries/file_upload/$item->id/$item->gallery_type/$item->lang"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnSave">Videoyu Kaydet</button>
                    </div>
                </form>
            <?php endif; ?>
        </div><!-- END column -->
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h4 class="my-3">
                "<b><?= $item->title; ?></b>" kaydına ait Dosyalar
                <?php if ($item->gallery_type == "video_url") : ?>
                    <a href="javascript:void(0)" class="btn btn-sm btn-outline-info float-right rounded-0 createVideoUrlBtn"><i class="fa fa-plus"></i> Yeni Ekle</a>
                <?php endif; ?>
            </h4>
            <hr>
        </div><!-- END column -->
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <form id="filter_form" onsubmit="return false">
                <div class="d-flex flex-wrap">
                    <label for="search" class="flex-fill mx-1">
                        <input class="form-control form-control-sm rounded-0" placeholder="Arama Yapmak İçin Metin Girin." type="text" onkeypress="return runScript(event,'detailTable')" name="search">
                    </label>
                    <label for="clear_button" class="mx-1">
                        <button class="btn btn-sm btn-outline-danger rounded-0 " onclick="clearFilter('filter_form','detailTable')" id="clear_button" data-toggle="tooltip" data-placement="top" data-title="Filtreyi Temizle" data-original-title="" title=""><i class="fa fa-eraser"></i></button>
                    </label>
                    <label for="search_button" class="mx-1">
                        <button class="btn btn-sm btn-outline-success rounded-0 " onclick="reloadTable('detailTable')" id="search_button" data-toggle="tooltip" data-placement="top" data-title="Galeri Ara"><i class="fa fa-search"></i></button>
                    </label>
                </div>
            </form>
            <table class="table table-hover table-striped table-bordered content-container detailTable">
                <thead>
                    <th class="w50">#</th>
                    <th class="order nosort"><i class="fa fa-reorder"></i></th>
                    <th class="w50">#id</th>
                    <th>İçerik</th>
                    <th>Dosya Yolu/Adı</th>
                    <th>Dil</th>
                    <th>Durumu</th>
                    <th>Oluşturulma Tarihi</th>
                    <th>Güncelleme Tarihi</th>
                    <th>Paylaşım Tarihi</th>
                    <th class="nosort">İşlem</th>
                </thead>
                <tbody>

                </tbody>
            </table>
            <script>
                function obj(d) {
                    let appendeddata = {};
                    $.each($("#filter_form").serializeArray(), function() {
                        d[this.name] = this.value;
                    });
                    return d;
                }
                $(document).ready(function() {
                    TableInitializerV2("detailTable", obj, {}, "<?= base_url("galleries/detailDatatable/{$item->gallery_type}/{$item->id}") ?>", "<?= base_url("galleries/fileRankSetter/{$item->gallery_type}/{$item->id}") ?>", true);
                });
            </script>
        </div><!-- END column -->
    </div>
</div>

<div id="fileModal"></div>

<script>
    $(document).ready(function() {
        $(document).on("click", ".createGalleryItemBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            $('#fileModal').iziModal('destroy');
            createModal("#fileModal", "Yeni Galeri İçeriği Ekle", "Yeni Galeri İçeriği Ekle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
                $.post(url, {}, function(response) {
                    $("#fileModal .iziModal-content").html(response);
                    TinyMCEInit();
                    flatPickrInit();
                });
            });
            openModal("#fileModal");
        });
        $(document).on("click", ".btnSave", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("createGalleryItem"));
            createAjax(url, formData, function() {
                closeModal("#fileModal");
                reloadTable("detailTable");
            });
        });
        $(document).on("click", ".updateGalleryItemBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#fileModal').iziModal('destroy');
            let url = $(this).data("url");
            createModal("#fileModal", "Galeri İçeriği Düzenle", "Galeri İçeriği Düzenle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
                $.post(url, {}, function(response) {
                    $("#fileModal .iziModal-content").html(response);
                    TinyMCEInit();
                    flatPickrInit();
                });
            });
            openModal("#fileModal");
        });
        $(document).on("click", ".btnUpdate", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("updateGalleryItem"));
            createAjax(url, formData, function() {
                closeModal("#fileModal");
                reloadTable("detailTable");
            });
        });
    });
</script>