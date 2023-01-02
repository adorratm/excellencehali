<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="updateSku" onsubmit="return false" action="" method="post">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <button role="button" data-url="<?= base_url("technical_informations/file_update/{$item->id}/{$technical_information_id}"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnUpdate">Güncelle</button>
            <a href="javascript:void(0)" onclick="closeModal('#technicalInformationSkuModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
        </div>
    </div>
</form>