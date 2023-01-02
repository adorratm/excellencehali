<?php defined('BASEPATH') or exit('No direct script access allowed');?>
<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<h4 class="mb-3">
				Kullanıcı Listesi
				<a href="javascript:void(0)" data-url="<?= base_url("users/new_form"); ?>" class="float-right btn btn-sm btn-outline-primary rounded-0 btn-sm createUserBtn"><i class="fa fa-plus"></i>Yeni Ekle</a>
			</h4>
		</div><!-- END column -->
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<form id="filter_form" onsubmit="return false">
				<div class="d-flex flex-wrap">
					<label for="search" class="flex-fill mx-1">
						<input class="form-control form-control-sm rounded-0" placeholder="Arama Yapmak İçin Metin Girin." type="text" onkeypress="return runScript(event,'userTable')" name="search">
					</label>
					<label for="clear_button" class="mx-1">
						<button class="btn btn-sm btn-outline-danger rounded-0 " onclick="clearFilter('filter_form','userTable')" id="clear_button" data-toggle="tooltip" data-placement="top" data-title="Filtreyi Temizle" data-original-title="" title=""><i class="fa fa-eraser"></i></button>
					</label>
					<label for="search_button" class="mx-1">
						<button class="btn btn-sm btn-outline-success rounded-0 " onclick="reloadTable('userTable')" id="search_button" data-toggle="tooltip" data-placement="top" data-title="Ürün Ara"><i class="fa fa-search"></i></button>
				</div>
			</form>
			<table class="table table-hover table-striped table-bordered content-container userTable">

				<thead>
					<th class="order"><i class="fa fa-reorder"></i></th>
					<th class="order"><i class="fa fa-reorder"></i></th>
					<th class="w50">#id</th>
					<th>Ad Soyad</th>
					<th>E-Posta</th>
					<th>Durum</th>
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
					TableInitializerV2("userTable", obj, {}, "<?= base_url("users/datatable") ?>", "<?= base_url("users/rankSetter") ?>", true);

				});
			</script>
		</div><!-- .widget -->
	</div><!-- END column -->
</div>
<div id="userModal"></div>

<script>
    $(document).ready(function(){
        $(document).on("click",".createUserBtn",function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            $('#userModal').iziModal('destroy');
            createModal("#userModal","Yeni Kullanıcı Ekle","Yeni Kullanıcı Ekle",600,true,"20px",0,"#e20e17","#fff",1040,function(){
                $.post(url,{},function(response){
                    $("#userModal .iziModal-content").html(response);
                });
            });
			openModal("#userModal");
			$("#userModal").iziModal("setFullscreen",false);
        });
        $(document).on("click",".btnSave",function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("createUser"));
            createAjax(url,formData,function(){
				closeModal("#userModal");
				$("#userModal").iziModal("setFullscreen",false);
                reloadTable("userTable");
            });
        });
        $(document).on("click",".updateUserBtn",function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#userModal').iziModal('destroy');
            let url = $(this).data("url");
            createModal("#userModal","Kullanıcı Düzenle","Kullanıcı Düzenle",600,true,"20px",0,"#e20e17","#fff",1040,function(){
                $.post(url,{},function(response){
                    $("#userModal .iziModal-content").html(response);
                });
            });
			openModal("#userModal");
			$("#userModal").iziModal("setFullscreen",false);
        });
        $(document).on("click",".btnUpdate",function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData(document.getElementById("updateUser"));
            createAjax(url,formData,function(){
				closeModal("#userModal");
				$("#userModal").iziModal("setFullscreen",false);
                reloadTable("userTable");
            });
        });
    });
</script>