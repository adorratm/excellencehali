<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h4 class="mb-3">
                Ürün Ebatları
                <a href="javascript:void(0)" data-url="<?= base_url("product_dimensions/getDimensions"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btn-sm float-right syncProductDimensionBtn"> <i class="fa fa-plus"></i> Ürün Ebatlarını Eşitle</a>
            </h4>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <form id="filter_form" onsubmit="return false">
                <div class="d-flex flex-wrap">
                    <label for="search" class="flex-fill mx-1">
                        <input class="form-control form-control-sm rounded-0" placeholder="Arama Yapmak İçin Metin Girin." type="text" onkeypress="return runScript(event,'productDimensionTable')" name="search">
                    </label>
                    <label for="clear_button" class="mx-1">
                        <button class="btn btn-sm btn-outline-danger rounded-0 " onclick="clearFilter('filter_form','productDimensionTable')" id="clear_button" data-toggle="tooltip" data-placement="top" data-title="Filtreyi Temizle" data-original-title="" title=""><i class="fa fa-eraser"></i></button>
                    </label>
                    <label for="search_button" class="mx-1">
                        <button class="btn btn-sm btn-outline-success rounded-0 " onclick="reloadTable('productDimensionTable')" id="search_button" data-toggle="tooltip" data-placement="top" data-title="Ürün Kategorisi Ara"><i class="fa fa-search"></i></button>
                </div>
            </form>
            <table class="table table-hover table-striped table-bordered content-container productDimensionTable">
                <thead>
                    <th class="order"><i class="fa fa-reorder"></i></th>
                    <th class="order"><i class="fa fa-reorder"></i></th>
                    <th class="w50">#id</th>
                    <th class="w50">Codes ID</th>
                    <th>Başlık</th>
                    <th>Codes Sunucusu</th>
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
                    TableInitializerV2("productDimensionTable", obj, {}, "<?= base_url("product_dimensions/datatable") ?>", "<?= base_url("product_dimensions/rankSetter") ?>", true);

                });
            </script>
        </div>
    </div>
</div>
</div>

<div id="productDimensionModal"></div>

<script>
    $(document).ready(function() {
        $(document).on("click", ".syncProductDimensionBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData();
            createAjax(url, formData, function() {
                reloadTable("productDimensionTable");
            });
        });
        $(document).on("click", ".updateProductDimensionBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#productDimensionModal').iziModal('destroy');
            let url = $(this).data("url");
            createModal("#productDimensionModal", "Ürün Kategorisi Düzenle", "Ürün Kategorisi Düzenle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
                $.post(url, {}, function(response) {
                    $("#productDimensionModal .iziModal-content").html(response);
                    TinyMCEInit();
                    flatPickrInit();
                });
            });
            openModal("#productDimensionModal");
            $("#productDimensionModal").iziModal("setFullscreen", false);
        });
        $(document).on("click", ".btnUpdate", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("updateProductDimension"));
            createAjax(url, formData, function() {
                closeModal("#productDimensionModal");
                $("#productDimensionModal").iziModal("setFullscreen", false);
                reloadTable("productDimensionTable");
            });
        });
    });
</script>