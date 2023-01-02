<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="updateBlogCategory" onsubmit="return false" action="" method="post">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Başlık </label>
                <input class="form-control form-control-sm rounded-0" placeholder="Başlık" name="title" value="<?= $item->title; ?>" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Dil</label>
                <input type="text" class="form-control form-control-sm rounded-0" name="lang" disabled value="<?= !empty($item->lang) ? $item->lang : "tr" ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <button role="button" data-url="<?= base_url("blog_categories/update/{$item->id}"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnUpdate">Güncelle</button>
            <a href="javascript:void(0)" onclick="closeModal('#blogCategoryModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
        </div>
    </div>
</form>