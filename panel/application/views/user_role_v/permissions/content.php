<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $permissions = json_decode($item->permissions); ?>
<form id="updatePermission" onsubmit="return false" method="post" enctype="multipart/form-data">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover mw-100 w-100">
            <thead>
                <th>Modül Adı</th>
                <th>Görüntüleme</th>
                <th>Ekleme</th>
                <th>Düzenleme</th>
                <th>Silme</th>
            </thead>
            <tbody>
                <?php $i = 0 ?>
                <?php foreach (getControllerList() as $controllerName) : ?>
                    <tr>
                        <?php $name = get_controller_name($controllerName); ?>
                        <td><?= ($name == "") ? $controllerName : $name; ?></td>
                        <td class="w50 text-center">
                            <div class="custom-control custom-switch"><input <?= (isset($permissions->$controllerName) && isset($permissions->$controllerName->read)) ? "checked" : ""; ?> name="permissions[<?= $controllerName; ?>][read]" data-status="<?= (isset($permissions->$controllerName) && isset($permissions->$controllerName->read)) ? "checked" : ""; ?>" id="customSwitch<?= $i ?>r" type="checkbox" class="custom-control-input"> <label class="custom-control-label" for="customSwitch<?= $i ?>r"></label></div>
                        </td>
                        <td class="w50 text-center">
                            <div class="custom-control custom-switch"><input <?= (isset($permissions->$controllerName) && isset($permissions->$controllerName->write)) ? "checked" : ""; ?> name="permissions[<?= $controllerName; ?>][write]" data-status="<?= (isset($permissions->$controllerName) && isset($permissions->$controllerName->write)) ? "checked" : ""; ?>" id="customSwitch<?= $i ?>w" type="checkbox" class="custom-control-input"> <label class="custom-control-label" for="customSwitch<?= $i ?>w"></label></div>
                        </td>
                        <td class="w50 text-center">
                            <div class="custom-control custom-switch"><input <?= (isset($permissions->$controllerName) && isset($permissions->$controllerName->update)) ? "checked" : ""; ?> name="permissions[<?= $controllerName; ?>][update]" data-status="<?= (isset($permissions->$controllerName) && isset($permissions->$controllerName->update)) ? "checked" : ""; ?>" id="customSwitch<?= $i ?>u" type="checkbox" class="custom-control-input"> <label class="custom-control-label" for="customSwitch<?= $i ?>u"></label></div>
                        </td>
                        <td class="w50 text-center">
                            <div class="custom-control custom-switch"><input <?= (isset($permissions->$controllerName) && isset($permissions->$controllerName->delete)) ? "checked" : ""; ?> name="permissions[<?= $controllerName; ?>][delete]" data-status="<?= (isset($permissions->$controllerName) && isset($permissions->$controllerName->delete)) ? "checked" : ""; ?>" id="customSwitch<?= $i ?>d" type="checkbox" class="custom-control-input"> <label class="custom-control-label" for="customSwitch<?= $i ?>d"></label></div>
                        </td>
                    </tr>
                    <?php $i++ ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <button role="button" data-url="<?= base_url("user_role/update_permissions/$item->id"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnUpdatePermission">Güncelle</button>
    <a href="javascript:void(0)" onclick="closeModal('#userRoleModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
</form>