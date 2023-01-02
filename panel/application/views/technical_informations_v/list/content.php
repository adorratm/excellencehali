<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<h4 class="mb-3">
				Teknik Bilgi Listesi
				<a href="javascript:void(0)" data-url="<?= base_url("technical_informations/new_form"); ?>" class="btn btn-sm btn-outline-primary rounded-0 float-right createTechnicalInformationBtn"> <i class="fa fa-plus"></i> Yeni Ekle</a>
			</h4>
		</div>
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<form id="filter_form" onsubmit="return false">
				<div class="d-flex flex-wrap">
					<label for="search" class="flex-fill mx-1">
						<input class="form-control form-control-sm rounded-0" placeholder="Arama Yapmak İçin Metin Girin." type="text" onkeypress="return runScript(event,'technicalInformationTable')" name="search">
					</label>
					<label for="clear_button" class="mx-1">
						<button class="btn btn-sm btn-outline-danger rounded-0 " onclick="clearFilter('filter_form','technicalInformationTable')" id="clear_button" data-toggle="tooltip" data-placement="top" data-title="Filtreyi Temizle" data-original-title="" title=""><i class="fa fa-eraser"></i></button>
					</label>
					<label for="search_button" class="mx-1">
						<button class="btn btn-sm btn-outline-success rounded-0 " onclick="reloadTable('technicalInformationTable')" id="search_button" data-toggle="tooltip" data-placement="top" data-title="Teknik Bilgi Ara"><i class="fa fa-search"></i></button>
					</label>
					<label for="delete_button" class="mx-1 toggleLabel d-none">
						<button class="btn btn-sm btn-outline-danger rounded-0 " data-url="<?= base_url("technical_informations/deleteBulk") ?>" id="delete_button" data-toggle="tooltip" data-placement="top" data-title="Seçili Teknik Bilgileri Sil"><i class="fa fa-trash"></i></button>
					</label>
				</div>
			</form>
			<table class="table table-hover table-striped table-bordered content-container technicalInformationTable">
				<thead>
					<th class="order"><i class="fa fa-reorder"></i></th>
					<th class="order"><i class="fa fa-reorder"></i></th>
					<th class="w50">#id</th>
					<th class="w50 nosort"><input type="checkbox" name="selectAll" onclick="toggleSelected(this)"></th>
					<th>Başlık</th>
					<th>Durumu</th>
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
					TableInitializerV2("technicalInformationTable", obj, {}, "<?= base_url("technical_informations/datatable") ?>", "<?= base_url("technical_informations/rankSetter") ?>", true);

				});
			</script>
		</div>
	</div>
</div>

<div id="technicalInformationModal"></div>

<script>
	function toggleSelected($this) {
		if ($this.checked) {
			if ($(".toggleLabel").hasClass("d-none")) {
				$(".toggleLabel").removeClass("d-none");
			}
		} else {
			$(".toggleLabel").addClass("d-none");
		}
		$('input.editor-active').each(function() {
			$(this).prop('checked', $this.checked);
		});
	}

	$(document).on("change", "input.editor-active", function() {
		let selectedCounter = 0;
		$("input.editor-active").each(function() {
			if ($(this).is(":checked")) {
				selectedCounter++;
			}
		});
		if (selectedCounter > 0) {
			$(".toggleLabel").removeClass("d-none");
		} else {
			$(".toggleLabel").addClass("d-none");
		}
		if ($(this).is(":checked")) {
			$(".toggleLabel").removeClass("d-none");
		}
	});

	$(document).ready(function() {
		$(document).on("click", ".createTechnicalInformationBtn", function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();
			let url = $(this).data("url");
			$('#technicalInformationModal').iziModal('destroy');
			createModal("#technicalInformationModal", "Yeni Teknik Bilgi Ekle", "Yeni Teknik Bilgi Ekle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
				$.post(url, {}, function(response) {
					$("#technicalInformationModal .iziModal-content").html(response);
					TinyMCEInit();
					flatPickrInit();
					$(".tagsInput").select2({
						placeholder: 'Teknik Bilgi Kategorisi Seçiniz.',
						width: 'resolve',
						theme: "classic",
						tags: false,
						tokenSeparators: [',', ' '],
						multiple: true
					});
				});
			});
			openModal("#technicalInformationModal");
			$("#technicalInformationModal").iziModal("setFullscreen", false);
		});
		$(document).on("click", ".btnSave", function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();
			let url = $(this).data("url");
			let formData = new FormData(document.getElementById("createTechnicalInformation"));
			createAjax(url, formData, function() {
				closeModal("#technicalInformationModal");
				$("#technicalInformationModal").iziModal("setFullscreen", false);
				reloadTable("technicalInformationTable");
			});
		});
		$(document).on("click", ".updateTechnicalInformationBtn", function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();
			$('#technicalInformationModal').iziModal('destroy');
			let url = $(this).data("url");
			createModal("#technicalInformationModal", "Teknik Bilgi Düzenle", "Teknik Bilgi Düzenle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
				$.post(url, {}, function(response) {
					$("#technicalInformationModal .iziModal-content").html(response);
					TinyMCEInit();
					flatPickrInit();
					$(".tagsInput").select2({
						placeholder: 'Teknik Bilgi Kategorisi Seçiniz.',
						width: 'resolve',
						theme: "classic",
						tags: false,
						tokenSeparators: [',', ' '],
						multiple: true
					});
				});
			});
			openModal("#technicalInformationModal");
			$("#technicalInformationModal").iziModal("setFullscreen", false);
		});
		$(document).on("click", ".btnUpdate", function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();
			let url = $(this).data("url");
			let formData = new FormData(document.getElementById("updateTechnicalInformation"));
			createAjax(url, formData, function() {
				closeModal("#technicalInformationModal");
				$("#technicalInformationModal").iziModal("setFullscreen", false);
				reloadTable("technicalInformationTable");
			});
		});
		$(document).on("click", "#delete_button", function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();
			let url = $(this).data("url");
			let idArray = [];
			$('input.editor-active').each(function() {
				if ($(this).is(":checked")) {
					idArray.push($(this).val());
				}
			});
			idArray.sort();
			swal.fire({
				title: 'Emin Misiniz?',
				text: "Bu işlemi geri alamayacaksınız!",
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Evet, Sil!',
				cancelButtonText: "Hayır"
			}).then(function(result) {
				if (result.value) {
					let formData = new FormData();
					formData.append("technical_information_ids",idArray);
					createAjax(url, formData, function() {
						reloadTable("technicalInformationTable");
					});
				}
			});
		});
	});
</script>