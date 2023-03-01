<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="mb-3">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered w-100">
                <thead>
                    <tr>
                        <th class="text-center align-middle" colspan="2"><strong><?= strto("lower|ucwords", lang("dealerInformations")) ?></strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center align-middle">
                            <?= lang("first_name") ?> <?= lang("last_name") ?>:
                        </td>
                        <td class="text-center align-middle">
                            <strong><?= $order->first_name ?? NULL; ?> <?= $order->last_name ?? NULL ?></strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">
                            <?= lang("email") ?>:
                        </td>
                        <td class="text-center align-middle">
                            <strong><?= get_active_user()->email; ?></strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">
                            <?= lang("phone") ?>:
                        </td>
                        <td class="text-center align-middle">
                            <strong><?= $order->phone ?? NULL ?></strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">
                            <?= lang("company_name") ?>:
                        </td>
                        <td class="text-center align-middle">
                            <strong><?= $order->company_name ?? NULL ?></strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">
                            <?= lang("tax_number") ?>:
                        </td>
                        <td class="text-center align-middle">
                            <strong><?= $order->tax_number ?? NULL ?></strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center align-middle">
                            <?= lang("tax_administration") ?>:
                        </td>
                        <td class="text-center align-middle">
                            <strong><?= $order->tax_administration ?? NULL ?></strong>
                        </td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <table class="table table-hover table-striped table-bordered w-100">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center align-middle"><strong><?= strto("lower|ucwords", lang("deliveryAndInvoiceAddress")) ?></strong></th>
                    </tr>
                </thead>
                <tr>
                    <td class="text-center align-middle">
                        <?= lang("addressTitle") ?>:
                    </td>
                    <td class="text-center align-middle">
                        <strong><?= $order->address_title ?? NULL ?></strong>
                    </td>
                </tr>
                <tr>
                    <td class="text-center align-middle">
                        <?= lang("address") ?>:
                    </td>
                    <td class="text-center align-middle">
                        <strong><?= $order->address ?? NULL ?></strong>
                    </td>
                </tr>
                </tbody>
            </table>
            <hr>
            <?php if (!empty($order_products)) : ?>
                <table class="table table-bordered table-striped table-hover w-100">
                    <thead>
                        <tr>
                            <th class="font-weight-bold text-center align-middle" colspan="5"><?= strto("lower|ucwords", lang("order_detail")) ?></th>
                        </tr>
                        <tr>
                            <th class='font-weight-bold text-center align-middle'><?= lang("productThumbnail") ?></th>
                            <th class='font-weight-bold text-center align-middle'><?= lang("productName") ?></th>
                            <th class='font-weight-bold text-center align-middle'><?= lang("productQuantity") ?></th>
                            <th class='font-weight-bold text-center align-middle'><?= lang("productPrice") ?></th>
                            <th class='font-weight-bold text-center align-middle'><?= lang("subTotal") ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_products as $cart_key => $cart_value) : ?>
                            <tr>
                                <td class='text-center align-middle justify-content-center mx-auto px-auto'>
                                    <img class='img-fluid' src='data:image/webp;base64,<?= base64_encode($cart_value->img_url) ?>' style='max-width:150px;max-height:150px;' width="150" height="150">
                                </td>
                                <td class='text-center align-middle justify-content-center mx-auto px-auto'><?= stripslashes($cart_value->title) ?></td>
                                <td class='text-center align-middle justify-content-center mx-auto px-auto'><?= $cart_value->quantity ?> x</td>
                                <td class='text-center align-middle justify-content-center mx-auto px-auto'>
                                    <?= !empty($cart_value->discounted_price) ? $cart_value->discounted_price : $cart_value->price ?>
                                    <?= $order->symbol ?>
                                </td>
                                <td class='text-center align-middle justify-content-center mx-auto px-auto'>
                                    <?= $cart_value->sub_total ?>
                                    <?= $order->symbol ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-end"><?= lang("subTotal") ?> : <span class="float-end"> <?= $order->sub_total ?> <?= $order->symbol ?></span></td>
                        </tr>
                        <?php if ((float)$order->vat > 0) : ?>
                            <tr>
                                <td colspan="5" class="text-end"><?= lang("vat") ?> : <span class="float-end"> <?= $order->vat ?> <?= $order->symbol ?></span></td>
                            </tr>
                        <?php endif ?>
                        <tr>
                            <td colspan="5" class="text-end"><b><?= lang("total") ?></b> : <span class="float-end"> <?= $order->total ?> <?= $order->symbol ?></span></td>
                        </tr>
                    </tfoot>
                </table>
            <?php endif ?>
        </div>
    </div>
    <div class="form-group mb-3">
        <label><?= lang("order_status") ?></label>
        <select class="form-control form-control-sm rounded-0" name="status" id="status" disabled>
            <option value="1" <?= ($order->status == 1 ? "selected" : null) ?>><?= lang("Siparişiniz Alındı.") ?></option>
            <option value="2" <?= ($order->status == 2 ? "selected" : null) ?>><?= lang("Siparişiniz Hazırlanıyor.") ?></option>
            <option value="3" <?= ($order->status == 3 ? "selected" : null) ?>><?= lang("Siparişiniz Kargoya Verildi.") ?></option>
            <option value="4" <?= ($order->status == 4 ? "selected" : null) ?>><?= lang("Siparişiniz Tamamlandı.") ?></option>
            <option value="0" <?= ($order->status == 0 ? "selected" : null) ?>><?= lang("Siparişiniz İptal Edildi.") ?></option>
        </select>
    </div>
    <a href="javascript:void(0)" onclick="closeModal('#ordersModal')" title="<?= lang("close") ?>" class="ulinaBTN px-3"><span><?= lang("close") ?></span></a>
</div>