<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="createUser" onsubmit="return false" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Ad Soyad</label>
        <input class="form-control form-control-sm rounded-0" placeholder="Ad Soyad" name="full_name" value="<?= isset($form_error) ? set_value("full_name") : ""; ?>">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control form-control-sm rounded-0" placeholder="Email" name="email" value="<?= isset($form_error) ? set_value("email") : ""; ?>">
    </div>
    <div class="form-group">
        <label>Yetki</label>
        <select class="form-control form-control-sm rounded-0" name="role_id">
            <?php foreach ($user_roles as $role) : ?>
                <option value="<?= $role->id; ?>"><?= $role->title; ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label>Şifre</label>
        <input type="password" class="form-control form-control-sm rounded-0" placeholder="Şifre" name="password">
    </div>
    <button role="button" data-url="<?= base_url("users/save") ?>" class="btn btn-sm btn-outline-primary rounded-0 btnSave">Kaydet</button>
    <a href="javascript:void(0)" onclick="closeModal('#userModal')" class="btn btn-sm btn-outline-danger rounded-0n">İptal</a>
</form>