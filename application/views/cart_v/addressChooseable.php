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
                <div class="flex-shrink-1">
                    <?php if (empty($this->session->choosedAddress) && $key == 0) : ?>
                        <?php $this->session->set_userdata("choosedAddress", $value->id) ?>
                    <?php endif; ?>
                    <input type="radio" id="<?= $value->title ?><?= $key ?>" <?= (!empty($this->session->choosedAddress) && $value->id == $this->session->choosedAddress ? "checked" : ($key == 0 ? "checked" : null)) ?> name="address" class="address" onchange="changeSelectedAddress($(this))" onclick="$(this).change()" value="<?= $value->id ?>">
                    <label for="<?= $value->title ?><?= $key ?>" class="h3 my-auto py-auto"><?= lang("chooseThisAddress") ?></label>
                </div>
            </div>

        </address>
    <?php endforeach ?>
<?php endif ?>


<script>
    window.addEventListener('DOMContentLoaded', function() {
        $("input[name='address']").each(function() {
            if ($(this).is(":checked")) {
                $(this).change()
            }
        })
    });

    function changeSelectedAddress($this) {
        let selected = $this.val();
        let url = "<?= base_url(lang("routes_cart") . "/" . lang("routes_order-address-change")) ?>";
        let formData = new FormData();
        formData.append("address_id", selected);
        formData.append("<?= $this->security->get_csrf_token_name() ?>", "<?= $this->security->get_csrf_hash() ?>");
        createAjax(url, formData, function() {})
    }
</script>