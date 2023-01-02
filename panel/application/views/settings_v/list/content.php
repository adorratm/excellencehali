<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h4 class="mb-3">
                Ayar Listesi
                <a href="javascript:void(0)" data-url="<?= base_url("settings/new_form"); ?>" class="float-right btn btn-sm btn-outline-primary rounded-0 btn-sm createSettingsBtn"><i class="fa fa-plus"></i>Yeni Ekle</a>
            </h4>
            <hr>
        </div><!-- END column -->
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <form id="filter_form" onsubmit="return false">
                <div class="d-flex flex-wrap">
                    <label for="search" class="flex-fill mx-1">
                        <input class="form-control form-control-sm rounded-0" placeholder="Arama Yapmak İçin Metin Girin." type="text" onkeypress="return runScript(event,'settingsTable')" name="search">
                    </label>
                    <label for="clear_button" class="mx-1">
                        <button class="btn btn-sm btn-outline-danger rounded-0 " onclick="clearFilter('filter_form','settingsTable')" id="clear_button" data-toggle="tooltip" data-placement="top" data-title="Filtreyi Temizle" data-original-title="" title=""><i class="fa fa-eraser"></i></button>
                    </label>
                    <label for="search_button" class="mx-1">
                        <button class="btn btn-sm btn-outline-success rounded-0 " onclick="reloadTable('settingsTable')" id="search_button" data-toggle="tooltip" data-placement="top" data-title="Ürün Ara"><i class="fa fa-search"></i></button>
                </div>
            </form>
            <table class="table table-hover table-striped table-bordered content-container settingsTable">

                <thead>
                    <th class="w50"><i class="fa fa-reorder"></i></th>
                    <th class="w50 nosort"><i class="fa fa-reorder"></i></th>
                    <th class="w50">#Id</th>
                    <th>Firma Adı</th>
                    <th>Dil</th>
                    <th>Durum</th>
                    <th>Oluşturulma Tarihi</th>
                    <th>Güncelleme Tarihi</th>
                    <th class="nosort">İşlem</th>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div><!-- END column -->
    </div>
</div>
<script>
    function obj(d) {
        let appendeddata = {};
        $.each($("#filter_form").serializeArray(), function() {
            d[this.name] = this.value;
        });
        return d;
    }
    $(document).ready(function() {
        TableInitializerV2("settingsTable", obj, {}, "<?= base_url("settings/datatable") ?>", "<?= base_url("settings/rankSetter") ?>", true);

    });
</script>

<div id="settingsModal"></div>

<script>
    $(document).ready(function() {
        $(document).on("click", ".createSettingsBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            $('#settingsModal').iziModal('destroy');
            createModal("#settingsModal", "Yeni Ayar Ekle", "Yeni Ayar Ekle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
                $.post(url, {}, function(response) {
                    $("#settingsModal .iziModal-content").html(response);
                    TinyMCEInit();
                    $(".tagsInput").select2({
						placeholder: 'Düğün Paketi Hediyesi Seçiniz.',
						width: 'resolve',
						theme: "classic",
						tags: true,
						tokenSeparators: [','],
						multiple: true
					});
                });
            });
            openModal("#settingsModal");
        });
        $(document).on("click", ".btnSave", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("createSettings"));
            createAjax(url, formData, function() {
                closeModal("#settingsModal");
                reloadTable("settingsTable");
            });
        });
        $(document).on("click", ".updateSettingsBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#settingsModal').iziModal('destroy');
            let url = $(this).data("url");
            createModal("#settingsModal", "Ayar Düzenle", "Ayar Düzenle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
                $.post(url, {}, function(response) {
                    $("#settingsModal .iziModal-content").html(response);
                    TinyMCEInit();
                    $(".tagsInput").select2({
						placeholder: 'Düğün Paketi Hediyesi Seçiniz.',
						width: 'resolve',
						theme: "classic",
						tags: true,
						tokenSeparators: [','],
						multiple: true
					});
                });
            });
            openModal("#settingsModal");
        });
        $(document).on("click", ".btnUpdate", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("updateSettings"));
            createAjax(url, formData, function() {
                closeModal("#settingsModal");
                reloadTable("settingsTable");
            });
        });
        $(document).on("click", ".updateSettingsJsonbtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#settingsModal').iziModal('destroy');
            let url = $(this).data("url");
            createModal("#settingsModal", "Dil Sabitlerini Düzenle", "Dil Sabitlerini Düzenle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
                $.post(url, {}, function(response) {
                    $("#settingsModal .iziModal-content").html(response);
                    TinyMCEInit();
                });
            });
            openModal("#settingsModal");
        });
        $(document).on("click", ".btnUpdateJson", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("updateJson"));
            createAjax(url, formData, function() {
                closeModal("#settingsModal");
                reloadTable("settingsTable");
            });
        });
    });
</script>