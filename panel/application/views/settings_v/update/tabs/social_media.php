<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="tab-pane fade" id="social-media" role="tabpanel" aria-labelledby="social-media-tab">
    <div class="row">
        <div class="form-group col-md-12">
            <label>E-posta Adresiniz</label>
            <input class="form-control form-control-sm rounded-0" placeholder="Şirketinize ait e-posta adresi" name="email" value="<?= $item->email; ?>" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label>Facebook</label>
            <input class="form-control form-control-sm rounded-0" placeholder="Facebook Adresiniz" name="facebook" value="<?= $item->facebook; ?>">
        </div>
        <div class="form-group col-md-6">
            <label>Twitter</label>
            <input class="form-control form-control-sm rounded-0" placeholder="Twitter Adresiniz" name="twitter" value="<?= $item->twitter; ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label>Instagram</label>
            <input class="form-control form-control-sm rounded-0" placeholder="Instagram Adresiniz" name="instagram" value="<?= $item->instagram; ?>">
        </div>
        <div class="form-group col-md-6">
            <label>Linkedin</label>
            <input class="form-control form-control-sm rounded-0" placeholder="Linkedin Adresiniz" name="linkedin" value="<?= $item->linkedin; ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label>Youtube</label>
            <input class="form-control form-control-sm rounded-0" placeholder="Youtube Adresiniz" name="youtube" value="<?= $item->youtube ?>">
        </div>
        <div class="form-group col-md-6">
            <label>Medium</label>
            <input class="form-control form-control-sm rounded-0" placeholder="Medium Adresiniz" name="medium" value="<?= $item->medium ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label>Pinterest</label>
            <input class="form-control form-control-sm rounded-0" placeholder="Pinterest Adresiniz" name="pinterest" <?= $item->pinterest ?>>
        </div>
    </div>
</div>