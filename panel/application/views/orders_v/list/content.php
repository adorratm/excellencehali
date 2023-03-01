<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<h4 class="mb-3">
				Siparişler
			</h4>
		</div><!-- END column -->
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="alert alert-info" role="alert">
				<h4 class="alert-heading">Sipariş Bilgilendirmesi</h4>
				<p>- Siparişe Kargo Bilgisi Girebilmek İçin Sipariş Durumu Mesajını Güncellemelisiniz.</p>
				<p>- Sipariş Durumu Her Değiştiğinde Kullanıcıya Bildirim Amaçlı Email Gider. Emailin Gönderilmesini Beklemeli ve Başarılı Mesajını Almalısınız. Email Adresi Hatalı Olan Kullanıcılara Email Gönderilirken Hata Oluşabilir.</p>
				<hr>
				<p class="mb-0">- Kullanıcılar Siparişinin Durumunu İsterlerse E-Mail Adresinden İsterlerse Hesabım -> Siparişlerim Bölümünden Takip Edebilirler.</p>
			</div>
			<form id="filter_form" onsubmit="return false">
				<div class="d-flex flex-wrap">
					<label for="search" class="flex-fill mx-1">
						<input class="form-control form-control-sm rounded-0" placeholder="Arama Yapmak İçin Metin Girin." type="text" onkeypress="return runScript(event,'ordersTable')" name="search">
					</label>
					<label for="clear_button" class="mx-1">
						<button class="btn btn-sm btn-outline-danger rounded-0 " onclick="clearFilter('filter_form','ordersTable')" id="clear_button" data-toggle="tooltip" data-placement="top" data-title="Filtreyi Temizle" data-original-title="" title=""><i class="fa fa-eraser"></i></button>
					</label>
					<label for="search_button" class="mx-1">
						<button class="btn btn-sm btn-outline-success rounded-0 " onclick="reloadTable('ordersTable')" id="search_button" data-toggle="tooltip" data-placement="top" data-title="Ürün Ara"><i class="fa fa-search"></i></button>
				</div>
			</form>

			<table class="table table-hover table-striped table-bordered content-container ordersTable">
				<thead>
					<th class="w50">#id</th>
					<th>Ad</th>
					<th>Soyad</th>
					<th>Firma Adı</th>
					<th>Email</th>
					<th>Telefon</th>
					<th>Toplam Tutar</th>
					<th>Sipariş Durumu</th>
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
					TableInitializerV2("ordersTable", obj, {}, "<?= base_url("orders/datatable") ?>", null, true);

				});
			</script>
		</div><!-- .widget -->
	</div><!-- END column -->
</div>

<div id="ordersModal"></div>

<script>
	$(document).ready(function() {
		$(document).on("click", ".updateOrderBtn", function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();
			$('#ordersModal').iziModal('destroy');
			let url = $(this).data("url");
			createModal("#ordersModal", "Sipariş Düzenle", "Sipariş Düzenle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
				$.post(url, {}, function(response) {
					$("#ordersModal .iziModal-content").html(response);
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
			openModal("#ordersModal");
			$("#ordersModal").iziModal("setFullscreen", false);
		});
		$(document).on("click", ".btnUpdate", function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();
			let url = $(this).data("url");
			let formData = new FormData(document.getElementById("updateOrder"));
			createAjax(url, formData, function() {
				closeModal("#ordersModal");
				$("#ordersModal").iziModal("setFullscreen", false);
				reloadTable("ordersTable");
			});
		});
		$(document).on("click", ".updateOrderCargoBtn", function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();
			$('#ordersModal').iziModal('destroy');
			let url = $(this).data("url");
			createModal("#ordersModal", "Sipariş Kargo Bilgisi Düzenle", "Sipariş Kargo Bilgisi Düzenle", 600, true, "20px", 0, "#e20e17", "#fff", 1040, function() {
				$.post(url, {}, function(response) {
					$("#ordersModal .iziModal-content").html(response);
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
			openModal("#ordersModal");
			$("#ordersModal").iziModal("setFullscreen", false);
		});
		$(document).on("click", ".btnUpdateCargo", function(e) {
			e.preventDefault();
			e.stopImmediatePropagation();
			let url = $(this).data("url");
			let formData = new FormData(document.getElementById("updateOrderCargo"));
			createAjax(url, formData, function() {
				closeModal("#ordersModal");
				$("#ordersModal").iziModal("setFullscreen", false);
				reloadTable("ordersTable");
			});
		});
	});
</script>