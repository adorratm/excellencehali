<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<h4 class="mb-3">
				Sektör Listesi
				<a href="javascript:void(0)" data-url="<?= base_url("sectors/new_form"); ?>" class="float-right btn btn-sm btn-outline-primary rounded-0 createSectorBtn"><i class="fa fa-plus"></i>Yeni Ekle</a>
			</h4>
		</div><!-- END column -->
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<form id="filter_form" onsubmit="return false">
				<div class="d-flex flex-wrap">
					<label for="search" class="flex-fill mx-1">
						<input class="form-control form-control-sm rounded-0" placeholder="Arama Yapmak İçin Metin Girin." type="text" onkeypress="return runScript(event,'sectorsTable')" name="search">
					</label>
					<label for="clear_button" class="mx-1">
						<button class="btn btn-sm btn-outline-danger rounded-0 " onclick="clearFilter('filter_form','sectorsTable')" id="clear_button" data-toggle="tooltip" data-placement="top" data-title="Filtreyi Temizle" data-original-title="" title=""><i class="fa fa-eraser"></i></button>
					</label>
					<label for="search_button" class="mx-1">
						<button class="btn btn-sm btn-outline-success rounded-0 " onclick="reloadTable('sectorsTable')" id="search_button" data-toggle="tooltip" data-placement="top" data-title="Ürün Ara"><i class="fa fa-search"></i></button>
				</div>
			</form>
			<table class="table table-hover table-striped table-bordered content-container sectorsTable">

				<thead>
					<th class="order"><i class="fa fa-reorder"></i></th>
					<th class="order"><i class="fa fa-reorder"></i></th>
					<th class="w50">#id</th>
					<th>Başlık</th>
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
					TableInitializerV2("sectorsTable", obj, {}, "<?= base_url("sectors/datatable") ?>", "<?= base_url("sectors/rankSetter") ?>", true);

				});
			</script>
		</div><!-- .widget -->
	</div><!-- END column -->
</div>
</div>

<div id="sectorsModal"></div>

<script>
	$(document).ready(function() {
		$(document).on("click", ".createSectorBtn", function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();
			let url = $(this).data("url");
			$('#sectorsModal').iziModal('destroy');
			createModal("#sectorsModal", "Yeni Sektör Ekle", "Yeni Sektör Ekle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
				$.post(url, {}, function(response) {
					$("#sectorsModal .iziModal-content").html(response);
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
			openModal("#sectorsModal");
			$("#sectorsModal").iziModal("setFullscreen", false);
		});
		$(document).on("click", ".btnSave", function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();
			let url = $(this).data("url");
			let formData = new FormData(document.getElementById("createSector"));
			createAjax(url, formData, function() {
				closeModal("#sectorsModal");
				$("#sectorsModal").iziModal("setFullscreen", false);
				reloadTable("sectorsTable");
			});
		});
		$(document).on("click", ".updateSectorBtn", function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();
			$('#sectorsModal').iziModal('destroy');
			let url = $(this).data("url");
			createModal("#sectorsModal", "Sektör Düzenle", "Sektör Düzenle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
				$.post(url, {}, function(response) {
					$("#sectorsModal .iziModal-content").html(response);
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
			openModal("#sectorsModal");
			$("#sectorsModal").iziModal("setFullscreen", false);
		});
		$(document).on("click", ".btnUpdate", function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();
			let url = $(this).data("url");
			let formData = new FormData(document.getElementById("updateSector"));
			createAjax(url, formData, function() {
				closeModal("#sectorsModal");
				$("#sectorsModal").iziModal("setFullscreen", false);
				reloadTable("sectorsTable");
			});
		});
	});
</script>