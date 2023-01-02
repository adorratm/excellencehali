<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="updateEmail" onsubmit="return false" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>E-Posta Sunucu Bilgisi</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Hostname" name="host" value="<?= (!empty($item->host) ? $item->host : null) ?>" required>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Protokol</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Protokol" name="protocol" value="<?= (!empty($item->protocol) ? $item->protocol : null) ?>" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Port Numarası</label>
                <input type="text" class="form-control form-control-sm rounded-0" placeholder="Port Numarası" name="port" value="<?= (!empty($item->port) ? $item->port : null) ?>" required>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>E-Posta Başlık</label>
                <input type="text" class="form-control form-control-sm rounded-0" placeholder="E-Posta Başlık" name="user_name" value="<?= (!empty($item->user_name) ? $item->user_name : null) ?>" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>E-Posta Adresi (User)</label>
                <input type="email" class="form-control form-control-sm rounded-0" placeholder="E-Posta Adresi (User)" name="user" value="<?= (!empty($item->user) ? $item->user : null) ?>" required>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>E-Posta Adresine Ait Şifre</label>
                <input type="password" class="form-control form-control-sm rounded-0" placeholder="E-Posta Adresine Ait Şifre" name="password" value="<?= (!empty($item->password) ? $item->password : null) ?>" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Kimden Gidecek (From)</label>
                <input type="email" class="form-control form-control-sm rounded-0" placeholder="Kimden Gidecek (From)" name="from" value="<?= (!empty($item->from) ? $item->from : null) ?>" required>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Kime Gidecek (To)</label>
                <input type="email" class="form-control form-control-sm rounded-0" placeholder="Kime Gidecek (To)" name="to" value="<?= (!empty($item->to) ? $item->to : null) ?>" required>
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
            <button type="button" data-url="<?= base_url("emailsettings/update/$item->id"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnUpdate">Kaydet</button>
            <a href="javascript:void(0)" onclick="closeModal('#emailModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
        </div>
    </div>
</form>