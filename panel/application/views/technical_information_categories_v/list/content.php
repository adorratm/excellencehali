<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h4 class="mb-3">
                Teknik Bilgi Kategorileri
                <a href="javascript:void(0)" data-url="<?= base_url("technical_information_categories/new_form"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btn-sm float-right createTechnicalInformationCategoryBtn"> <i class="fa fa-plus"></i> Yeni Ekle</a>
            </h4>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <form id="filter_form" onsubmit="return false">
                <div class="d-flex flex-wrap">
                    <label for="search" class="flex-fill mx-1">
                        <input class="form-control form-control-sm rounded-0" placeholder="Arama Yapmak İçin Metin Girin." type="text" onkeypress="return runScript(event,'technicalInformationCategoryTable')" name="search">
                    </label>
                    <label for="clear_button" class="mx-1">
                        <button class="btn btn-sm btn-outline-danger rounded-0 " onclick="clearFilter('filter_form','technicalInformationCategoryTable')" id="clear_button" data-toggle="tooltip" data-placement="top" data-title="Filtreyi Temizle" data-original-title="" title=""><i class="fa fa-eraser"></i></button>
                    </label>
                    <label for="search_button" class="mx-1">
                        <button class="btn btn-sm btn-outline-success rounded-0 " onclick="reloadTable('technicalInformationCategoryTable')" id="search_button" data-toggle="tooltip" data-placement="top" data-title="Teknik Bilgi Kategorisi Ara"><i class="fa fa-search"></i></button>
                </div>
            </form>
            <table class="table table-hover table-striped table-bordered content-container technicalInformationCategoryTable">
                <thead>
                    <th class="order"><i class="fa fa-reorder"></i></th>
                    <th class="order"><i class="fa fa-reorder"></i></th>
                    <th class="w50">#id</th>
                    <th>Başlık</th>
                    <th>Üst Kategori</th>
                    <th>Dil</th>
                    <th>Durumu</th>
                    <th>Oluşturulma Tarihi</th>
                    <th>Güncelleme Tarihi</th>
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
                    TableInitializerV2("technicalInformationCategoryTable", obj, {}, "<?= base_url("technical_information_categories/datatable") ?>", "<?= base_url("technical_information_categories/rankSetter") ?>", true);

                });
            </script>
        </div>
    </div>
</div>
</div>

<div id="technicalInformationCategoryModal"></div>

<script>
    $(document).ready(function() {
        $(document).on("click", ".createTechnicalInformationCategoryBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            $('#technicalInformationCategoryModal').iziModal('destroy');
            createModal("#technicalInformationCategoryModal", "Yeni Teknik Bilgi Kategorisi Ekle", "Yeni Teknik Bilgi Kategorisi Ekle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
                $.post(url, {}, function(response) {
                    $("#technicalInformationCategoryModal .iziModal-content").html(response);
                    TinyMCEInit();
                    flatPickrInit();
                });
            });
            openModal("#technicalInformationCategoryModal");
            $("#technicalInformationCategoryModal").iziModal("setFullscreen", false);
        });
        $(document).on("click", ".btnSave", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("createTechnicalInformationCategory"));
            createAjax(url, formData, function() {
                closeModal("#technicalInformationCategoryModal");
                $("#technicalInformationCategoryModal").iziModal("setFullscreen", false);
                reloadTable("technicalInformationCategoryTable");
            });
        });
        $(document).on("click", ".updateTechnicalInformationCategoryBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#technicalInformationCategoryModal').iziModal('destroy');
            let url = $(this).data("url");
            createModal("#technicalInformationCategoryModal", "Teknik Bilgi Kategorisi Düzenle", "Teknik Bilgi Kategorisi Düzenle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
                $.post(url, {}, function(response) {
                    $("#technicalInformationCategoryModal .iziModal-content").html(response);
                    TinyMCEInit();
                    flatPickrInit();
                });
            });
            openModal("#technicalInformationCategoryModal");
            $("#technicalInformationCategoryModal").iziModal("setFullscreen", false);
        });
        $(document).on("click", ".btnUpdate", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("updateTechnicalInformationCategory"));
            createAjax(url, formData, function() {
                closeModal("#technicalInformationCategoryModal");
                $("#technicalInformationCategoryModal").iziModal("setFullscreen", false);
                reloadTable("technicalInformationCategoryTable");
            });
        });
    });
</script>