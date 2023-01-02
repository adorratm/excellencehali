<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="updateUserRole" onsubmit="return false" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Başlık</label>
        <input class="form-control form-control-sm rounded-0" placeholder="Başlık" name="title" value="<?= $item->title; ?>" required>
    </div>
    <button role="button" data-url="<?= base_url("user_role/update/$item->id"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnUpdate">Güncelle</button>
    <a href="javascript:void(0)" onclick="closeModal('#userRoleModal')" class="btn btn-sm btn-outline-danger rounded-0n">İptal</a>
</form>