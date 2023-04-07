<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="updateAddress" onsubmit="return false" method="POST" enctype="multipart/form-data">
    <div class="form-group row mb-3">
        <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 my-auto py-auto">
            <label for="title"><?= lang("addressTitle") ?> : </label>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
            <input class="form-control" id="title" type="text" name="title" placeholder="<?= lang("addressTitle") ?>" minlength="2" maxlength="255" required value="<?= $address->title ?? NULL ?>">
        </div>
    </div>

    <div class="form-group row mb-3">
        <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 my-auto py-auto">
            <label for="first_name"><?= lang("first_name") ?> : </label>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
            <input class="form-control" id="first_name" type="text" name="first_name" placeholder="<?= lang("first_name") ?>" minlength="2" maxlength="50" required value="<?= $address->first_name ?? NULL ?>">
        </div>
    </div>

    <div class="form-group row mb-3">
        <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 my-auto py-auto">
            <label for="last_name"><?= lang("last_name") ?> : </label>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
            <input class="form-control" id="last_name" type="text" name="last_name" placeholder="<?= lang("last_name") ?>" minlength="2" maxlength="50" required value="<?= $address->last_name ?? NULL ?>">
        </div>
    </div>

    <div class="form-group row mb-3">
        <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 my-auto py-auto">
            <label for="phone"><?= lang("phone") ?> : </label>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
            <input class="form-control" id="phone" type="tel" name="phone" placeholder="<?= lang("phone") ?>" minlength="11" maxlength="20" required value="<?= $address->phone ?? NULL ?>">
        </div>
    </div>

    <div class="form-group row mb-3">
        <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 my-auto py-auto">
            <label for="company_name"><?= lang("company_name") ?> : </label>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
            <input class="form-control" id="company_name" type="text" name="company_name" placeholder="<?= lang("company_name") ?>" minlength="2" maxlength="255" required value="<?= $address->company_name ?? NULL ?>">
        </div>
    </div>

    <div class="form-group row mb-3">
        <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 my-auto py-auto">
            <label for="tax_number"><?= lang("tax_number") ?> : </label>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
            <input class="form-control" id="tax_number" type="text" name="tax_number" placeholder="<?= lang("tax_number") ?>" minlength="10" maxlength="11" required value="<?= $address->tax_number ?? NULL ?>">
        </div>
    </div>

    <div class="form-group row mb-3">
        <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 my-auto py-auto">
            <label for="tax_administration"><?= lang("tax_administration") ?> : </label>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
            <input class="form-control" id="tax_administration" type="text" name="tax_administration" placeholder="<?= lang("tax_administration") ?>" minlength="2" maxlength="255" required value="<?= $address->tax_administration ?? NULL ?>">
        </div>
    </div>

    <div class="form-group row mb-3">
        <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 my-auto py-auto">
            <label for="address"><?= lang("address") ?> : </label>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
            <textarea class="form-control" name="address" id="address" placeholder="<?= lang("address") ?>" cols="5" rows="3" required minlength="2"><?= $address->address ?? NULL ?></textarea>
        </div>
    </div>
    <div class="form-group mb-3">
        <button aria-label="<?= $settings->company_name ?>" role="button" class="ulinaBTN btnUpdate w-100" data-url="<?= base_url(lang("routes_order-address-update") . "/" . $address->id) ?>"><span><?= lang("updateAddressInformation") ?></span></button>
    </div>
</form>