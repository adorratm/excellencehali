<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <form data-table="detailTable" action="<?= base_url("stories/file_upload/$item->id/$item->lang"); ?>" id="dropzone<?= $item->lang ?>" class="dropzone" data-plugin="dropzone" data-options="{ url: '<?= base_url("stories/file_upload/$item->id/$item->lang"); ?>'}">
                <div class="dz-message">
                    <h3 class="m-h-lg">Yüklemek istediğiniz dosyaları buraya sürükleyiniz</h3>
                    <p class="mb-3 text-muted">(Yüklemek için dosyalarınızı sürükleyiniz yada buraya tıklayınız)</p>
                </div>
            </form>
        </div><!-- END column -->
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h4 class="my-3">
                "<b><?= $item->title ?></b>" kaydına ait Hikaye İçerikleri
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
                    TableInitializerV2("detailTable", obj, {}, "<?= base_url("stories/detailDatatable/{$item->id}") ?>", "<?= base_url("stories/fileRankSetter/") ?>", true);

                });
            </script>
        </div><!-- END column -->
    </div>
</div>

<div id="fileModal"></div>

<script>
    $(document).ready(function() {
        $(document).on("click", ".createStoryBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            $('#storyModal').iziModal('destroy');
            createModal("#storyModal", "Yeni Hikaye Ekle", "Yeni Hikaye Ekle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
                $.post(url, {}, function(response) {
                    $("#storyModal .iziModal-content").html(response);
                    TinyMCEInit();
                    flatPickrInit();
                    $(".tagsInput").select2({
                        width: 'resolve',
                        theme: "classic",
                        tags: true,
                        tokenSeparators: [',', ' ']
                    });
                });
            });
            openModal("#storyModal");
        });
        $(document).on("click", ".btnSave", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("createStory"));
            createAjax(url, formData, function() {
                closeModal("#storyModal");
                reloadTable("detailTable");
            });
        });
        $(document).on("click", ".updateStoryBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#storyModal').iziModal('destroy');
            let url = $(this).data("url");
            createModal("#storyModal", "Hikaye Düzenle", "Hikaye Düzenle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
                $.post(url, {}, function(response) {
                    $("#storyModal .iziModal-content").html(response);
                    TinyMCEInit();
                    flatPickrInit();
                    $(".tagsInput").select2({
                        width: 'resolve',
                        theme: "classic",
                        tags: true,
                        tokenSeparators: [',', ' ']
                    });
                });
            });
            openModal("#storyModal");
        });
        $(document).on("click", ".btnUpdate", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("updateStory"));
            createAjax(url, formData, function() {
                closeModal("#storyModal");
                reloadTable("storyTable");
            });
        });
    });
</script>