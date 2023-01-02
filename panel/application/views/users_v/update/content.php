<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="updateUser" onsubmit="return false" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Ad Soyad</label>
        <input class="form-control form-control-sm rounded-0" placeholder="Ad Soyad" name="full_name" value="<?= $item->full_name ?>">
    </div>
    <div class="form-group">
        <label>Yetki</label>
        <select class="form-control form-control-sm rounded-0" name="role_id">
            <?php foreach ($user_roles as $role) : ?>
                <option <?= ($role->id == $item->role_id ? "selected" : "") ?> value="<?= $role->id; ?>"><?= $role->title; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input class="form-control form-control-sm rounded-0" type="email" placeholder="Email" name="email" value="<?= $item->email; ?>">
    </div>
    <div class="form-group">
        <label>Şifre (Boş Bırakılırsa Aynı Kalır)</label>
        <input class="form-control form-control-sm rounded-0" type="password" placeholder="Şifre" name="password">
    </div>
    <button role="button" data-url="<?= base_url("users/update/$item->id"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnUpdate">Güncelle</button>
    <a href="javascript:void(0)" onclick="closeModal('#userModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
</form>