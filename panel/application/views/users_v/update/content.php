<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="updateUser" onsubmit="return false" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Ad</label>
        <input class="form-control form-control-sm rounded-0" placeholder="Ad" name="first_name" value="<?= isset($form_error) ? set_value("first_name") : $item->first_name ?>" minlength="2" maxlength="50" required>
    </div>
    <div class="form-group">
        <label>Soyad</label>
        <input class="form-control form-control-sm rounded-0" placeholder="Soyad" name="last_name" value="<?= isset($form_error) ? set_value("last_name") : $item->last_name ?>" minlength="2" maxlength="50" required>
    </div>
    <div class="form-group">
        <label>Firma Adı</label>
        <input class="form-control form-control-sm rounded-0" placeholder="Firma Adı" name="company_name" value="<?= isset($form_error) ? set_value("company_name") : $item->company_name; ?>" minlength="2" maxlength="255" required>
    </div>
    <div class="form-group">
        <label>Vergi Dairesi</label>
        <input class="form-control form-control-sm rounded-0" placeholder="Vergi Dairesi" name="tax_administration" value="<?= isset($form_error) ? set_value("tax_administration") : $item->tax_administration; ?>" minlength="2" maxlength="255" required>
    </div>
    <div class="form-group">
        <label>Vergi Numarası</label>
        <input class="form-control form-control-sm rounded-0" placeholder="Vergi Numarası" name="tax_number" value="<?= isset($form_error) ? set_value("tax_number") : $item->tax_number; ?>" minlength="10" maxlength="11" required>
    </div>
    <div class="form-group">
        <label>Telefon</label>
        <input class="form-control form-control-sm rounded-0" placeholder="Telefon" name="phone" value="<?= isset($form_error) ? set_value("phone") : $item->phone; ?>" minlength="11" maxlength="20" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input class="form-control form-control-sm rounded-0" type="email" placeholder="Email" name="email" value="<?= isset($form_error) ? set_value("email") : $item->email; ?>" minlength="2" maxlength="255" required>
    </div>
    <div class="form-group">
        <label>Şifre (Boş Bırakılırsa Aynı Kalır)</label>
        <input class="form-control form-control-sm rounded-0" type="password" placeholder="Şifre" name="password" value="<?= isset($form_error) ? set_value("password") : NULL ?>" minlength="6">
    </div>
    <div class="form-group">
        <label>Yetki</label>
        <select class="form-control form-control-sm rounded-0" name="role_id" required>
            <?php foreach ($user_roles as $role) : ?>
                <option <?= ($role->id == $item->role_id ? "selected" : "") ?> value="<?= $role->id; ?>"><?= $role->title; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button role="button" data-url="<?= base_url("users/update/$item->id"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnUpdate">Güncelle</button>
    <a href="javascript:void(0)" onclick="closeModal('#userModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
</form>