<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="createEmail" onsubmit="return false" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>E-Posta Sunucu Bilgisi</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Hostname" name="host" required>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Protokol</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Protokol" name="protocol" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Port Numarası</label>
                <input type="text" class="form-control form-control-sm rounded-0" placeholder="Port Numarası" name="port" required>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>E-Posta Başlık</label>
                <input type="text" class="form-control form-control-sm rounded-0" placeholder="E-Posta Başlık" name="user_name" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>E-Posta Adresi (User)</label>
                <input type="email" class="form-control form-control-sm rounded-0" placeholder="E-Posta Adresi (User)" name="user" required>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>E-Posta Adresine Ait Şifre</label>
                <input type="password" class="form-control form-control-sm rounded-0" placeholder="E-Posta Adresine Ait Şifre" name="password" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Kimden Gidecek (From)</label>
                <input type="email" class="form-control form-control-sm rounded-0" placeholder="Kimden Gidecek (From)" name="from" required>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Kime Gidecek (To)</label>
                <input type="email" class="form-control form-control-sm rounded-0" placeholder="Kime Gidecek (To)" name="to" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Dil</label>
                <select name="lang" class="form-control form-control-sm rounded-0" required>
                    <?php if (!empty($settings)) : ?>
                        <?php foreach ($settings as $key => $value) : ?>
                            <option value="<?= $value->lang ?>"><?= $value->lang ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <button data-url="<?= base_url("emailsettings/save"); ?>" type="button" class="btn btn-sm btn-outline-primary rounded-0 btnSave">Kaydet</button>
            <a href="javascript:void(0)" onclick="closeModal('#emailModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
        </div>
    </div>
</form>