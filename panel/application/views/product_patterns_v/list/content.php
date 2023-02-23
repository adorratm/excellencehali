<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h4 class="mb-3">
                Ürün Desenleri
                <a href="javascript:void(0)" data-url="<?= base_url("product_patterns/getPatterns"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btn-sm float-right syncProductPatternBtn"> <i class="fa fa-rotate"></i> Ürün Desenlerini Codes İle Eşitle</a>
            </h4>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <form id="filter_form" onsubmit="return false">
                <div class="d-flex flex-wrap">
                    <label for="search" class="flex-fill mx-1">
                        <input class="form-control form-control-sm rounded-0" placeholder="Arama Yapmak İçin Metin Girin." type="text" onkeypress="return runScript(event,'productPatternTable')" name="search">
                    </label>
                    <label for="clear_button" class="mx-1">
                        <button class="btn btn-sm btn-outline-danger rounded-0 " onclick="clearFilter('filter_form','productPatternTable')" id="clear_button" data-toggle="tooltip" data-placement="top" data-title="Filtreyi Temizle" data-original-title="" title=""><i class="fa fa-eraser"></i></button>
                    </label>
                    <label for="search_button" class="mx-1">
                        <button class="btn btn-sm btn-outline-success rounded-0 " onclick="reloadTable('productPatternTable')" id="search_button" data-toggle="tooltip" data-placement="top" data-title="Ürün Deseni Ara"><i class="fa fa-search"></i></button>
                </div>
            </form>
            <table class="table table-hover table-striped table-bordered content-container productPatternTable">
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
                    TableInitializerV2("productPatternTable", obj, {}, "<?= base_url("product_patterns/datatable") ?>", "<?= base_url("product_patterns/rankSetter") ?>", true);

                });
            </script>
        </div>
    </div>
</div>
</div>

<div id="productPatternModal"></div>

<script>
    $(document).ready(function() {
        $(document).on("click", ".syncProductPatternBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData();
            let button = $(this);
            iziToast.info({
                title: 'Bilgi!',
                message: 'Eşitleme İşlemi Başlatıldı Lütfen Sayfayı Kapatmadan Bekleyiniz...',
                position: "topCenter",
                displayMode: 'once',
            });
            button.text("Eşitleme İşlemi Yapılıyor Lütfen Bekleyin...");
            button.prop("disabled", true);
            $.get("<?= base_url("products/getStocks"); ?>", () => {
                createAjax(url, formData, function() {
                    reloadTable("productPatternTable");
                    button.text("Eşitleme İşlemi Tamamlandı");
                    setTimeout(function() {
                        button.text("Ürün Desenlerini Codes İle Eşitle");
                        button.prop("disabled", false);
                    }, 1000);
                });
            });
        });
        $(document).on("click", ".updateProductPatternBtn", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#productPatternModal').iziModal('destroy');
            let url = $(this).data("url");
            createModal("#productPatternModal", "Ürün Deseni Düzenle", "Ürün Deseni Düzenle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
                $.post(url, {}, function(response) {
                    $("#productPatternModal .iziModal-content").html(response);
                    TinyMCEInit();
                    flatPickrInit();
                });
            });
            openModal("#productPatternModal");
            $("#productPatternModal").iziModal("setFullscreen", false);
        });
        $(document).on("click", ".btnUpdate", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("updateProductPattern"));
            createAjax(url, formData, function() {
                closeModal("#productPatternModal");
                $("#productPatternModal").iziModal("setFullscreen", false);
                reloadTable("productPatternTable");
            });
        });
    });
</script>