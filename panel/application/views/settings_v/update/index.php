<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form onsubmit="return false" method="post" enctype="multipart/form-data" id="updateSettings">
    <div class="mb-3 nav-tabs-horizontal">
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="site-informations-tab" data-toggle="tab" href="#site-informations" role="tab" aria-controls="site-informations" aria-selected="true">Site Bilgileri</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="address-informations-tab" data-toggle="tab" href="#address-informations" role="tab" aria-controls="address-informations" aria-selected="false">Adres Bilgisi</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="social-media-tab" data-toggle="tab" href="#social-media" role="tab" aria-controls="social-media" aria-selected="false">Sosyal Medya</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="logo-tab" data-toggle="tab" href="#logo" role="tab" aria-controls="logo" aria-selected="false">Logo</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="meta-tag-tab" data-toggle="tab" href="#meta-tag" role="tab" aria-controls="meta-tag" aria-selected="false">Meta Tag</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="site-analysis-tab" data-toggle="tab" href="#site-analysis" role="tab" aria-controls="site-analysis" aria-selected="false">Site Analysis</a>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/site_info"); ?>
            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/address"); ?>
            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/social_media"); ?>
            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/logo"); ?>
            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/site_meta"); ?>
            <?php $this->load->view("$viewFolder/$subViewFolder/tabs/site_analysis"); ?>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <label>Ayar Dili</label>
            <select name="lang" id="lang" class="form-control form-control-sm rounded-0" disabled required>
                <?php foreach($languages as $key => $value):?>
                    <option value="<?=$value->code?>" <?=($item->lang == $value->code ? "selected" : null)?>><?=$value->name?> (<?=$value->code?>)</option>
                <?php endforeach?>
            </select>
            <input type="hidden" name="lang" value="tr" readonly>
        </div>
    </div>
    <button data-url="<?= base_url("settings/update/$item->id"); ?>" type="button" class="btn btn-sm btn-outline-primary rounded-0 btnUpdate">Güncelle</button>
    <a href="javascript:void(0)" onclick="closeModal('#settingsModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
</form>