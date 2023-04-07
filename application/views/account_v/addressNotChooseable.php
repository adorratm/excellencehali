<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if (!empty($address_informations)) : ?>
    <?php foreach ($address_informations as $key => $value) : ?>
        <address class="mb-3 border p-3">
            <p class="mb-3">
                <strong class="fw-bolder h3">
                    <?= $value->title ?>
                </strong>
            </p>
            <p class="mb-3 fw-bold"><?= $value->first_name ?> <?= $value->last_name ?></p>
            <?php if (!empty($value->company_name)) : ?>
                <p class="mb-3"><?= lang("company_name") ?> : <?= $value->company_name ?></p>
            <?php endif ?>
            <address class="mb-3"><?= lang("address") ?> : <?= $value->address ?></address>
            <p class="mb-3"> <?= lang("phone") ?> : <?= $value->phone ?> </p>
            <div class="d-flex flex-wrap align-items-center align-self-center">
                <div class="flex-grow-1 pe-3">
                    <a rel="dofollow" data-url="<?= base_url(lang("routes_cart") . "/" . lang("routes_order-address-update") . "/{$value->id}") ?>" href="javascript:void(0)" class="btn border w-100 p-3 mb-3 mb-lg-0 mb-xl-0 editAddressBtn" title="<?= lang("addressEdit") ?>"><i class="fa fa-edit"></i> <?= lang("addressEdit") ?></a>
                </div>
                <div class="flex-grow-1 pe-3">
                    <button aria-label="<?= $settings->company_name ?>" data-url="<?= base_url(lang("routes_cart") . "/" . lang("routes_order-address-delete") . "/{$value->id}") ?>" class="btn w-100 border p-3 mb-3 mb-lg-0 mb-xl-0 deleteAddress"><i class="fa fa-trash"></i> <?= lang("addressDelete") ?></button>
                </div>
            </div>

        </address>
    <?php endforeach ?>
<?php endif ?>