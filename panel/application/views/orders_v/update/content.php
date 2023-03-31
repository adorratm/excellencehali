<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="updateOrder" onsubmit="return false" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <div class="accordion rounded-0" id="accordionExample">
            <div class="card rounded-0">
                <div class="card-header rounded-0" id="headingOne">
                    <h2 class="mb-3 rounded-0">
                        <button class="btn btn-block rounded-0 text-center btn-danger" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Sipariş İçeriğini Göster / Gizle
                        </button>
                    </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle" colspan="2"><strong>BAYİ BİLGİLERİ</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center align-middle">
                                            Ad Soyad:
                                        </td>
                                        <td class="text-center align-middle">
                                            <strong><?= $item->first_name ?? NULL ?> <?= $item->last_name ?? NULL ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center align-middle">
                                            Email:
                                        </td>
                                        <td class="text-center align-middle">
                                            <strong><?= $item->email ?? NULL ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center align-middle">
                                            Telefon:
                                        </td>
                                        <td class="text-center align-middle">
                                            <strong><?= $item->phone ?? NULL ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center align-middle">
                                            Firma Adı:
                                        </td>
                                        <td class="text-center align-middle">
                                            <strong><?= $item->company_name ?? NULL ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center align-middle">
                                            Vergi Numarası:
                                        </td>
                                        <td class="text-center align-middle">
                                            <strong><?= $item->tax_number ?? NULL ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center align-middle">
                                            Vergi Dairesi:
                                        </td>
                                        <td class="text-center align-middle">
                                            <strong><?= $item->tax_administration ?? NULL ?></strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center align-middle"><strong>TESLİMAT & FATURA ADRESİ</strong></th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td class="text-center align-middle">
                                        Adres Başlığı:
                                    </td>
                                    <td class="text-center align-middle">
                                        <strong><?= $item->address_title ?? NULL ?></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle">
                                        Adres:
                                    </td>
                                    <td class="text-center align-middle">
                                        <strong><?= $item->address ?? NULL ?></strong>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <?php if (!empty($order_data)) : ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th class="font-weight-bold text-center align-middle" colspan="6">SİPARİŞ DETAYI</th>
                                        </tr>
                                        <tr>
                                            <th class='font-weight-bold text-center align-middle'>Görsel</th>
                                            <th class='font-weight-bold text-center align-middle'>Ürün Adı</th>
                                            <th class='font-weight-bold text-center align-middle'>Sipariş Notu</th>
                                            <th class='font-weight-bold text-center align-middle'>Adet</th>
                                            <th class='font-weight-bold text-center align-middle'>Fiyat</th>
                                            <th class='font-weight-bold text-center align-middle'>Ara Toplam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($order_data as $cart_key => $cart_value) : ?>
                                            <tr>
                                                <td class='text-center align-middle'>
                                                    <img class='img-fluid' src='data:image/webp;base64,<?= base64_encode($cart_value->img_url) ?>' style='max-width:125px;max-height:150px;' width="150" height="150">
                                                </td>
                                                <td class='text-center align-middle'><?= $cart_value->title ?>
                                                    <?php if (!empty($cart_value->height) && $cart_value->dimension_type == "ROLL") : ?>
                                                        <div class="product-dimension">
                                                            <span class="fw-bold"><?= lang("height") ?>: </span>
                                                            <span class="ms-2"><?= $cart_value->height ?></span>
                                                        </div>
                                                    <?php endif ?>
                                                </td>
                                                <td class='text-center align-middle'><?= $cart_value->order_note ?></td>
                                                <td class='text-center align-middle'><?= $cart_value->quantity ?> x</td>
                                                <td class='text-center align-middle'>
                                                    <?= !empty($cart_value->discounted_price) ? $cart_value->discounted_price : $cart_value->price ?>
                                                    <?= $item->symbol ?>
                                                </td>
                                                <td class='text-center align-middle'>
                                                    <?= $cart_value->sub_total ?>
                                                    <?= $item->symbol ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6" class="text-right">Ara Toplam : <span class="float-right ml-1"> <?= $item->sub_total ?> <?= $item->symbol ?></span></td>
                                        </tr>
                                        <?php if ((float)$item->vat > 0) : ?>
                                            <tr>
                                                <td colspan="6" class="text-right">KDV : <span class="float-right ml-1"> <?= $item->vat ?> <?= $item->symbol ?></span></td>
                                            </tr>
                                        <?php endif ?>
                                        <tr>
                                            <td colspan="6" class="text-right"><b>Toplam</b> : <span class="float-right ml-1"> <?= $item->total ?> <?= $item->symbol ?></span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>SİPARİŞ DURUMU (Değiştiğinde "SİPARİŞ DURUMU MESAJI" alanı değişir.)</label>
        <select class="form-control form-control-sm rounded-0" name="status" id="statusTrigger">
            <option value="1" <?= ($item->status == 1 ? "selected" : null) ?>><?= lang("Siparişiniz Alındı.") ?></option>
            <option value="2" <?= ($item->status == 2 ? "selected" : null) ?>><?= lang("Siparişiniz Hazırlanıyor.") ?></option>
            <option value="3" <?= ($item->status == 3 ? "selected" : null) ?>><?= lang("Siparişiniz Kargoya Verildi.") ?></option>
            <option value="4" <?= ($item->status == 4 ? "selected" : null) ?>><?= lang("Siparişiniz Tamamlandı.") ?></option>
            <option value="0" <?= ($item->status == 0 ? "selected" : null) ?>><?= lang("Siparişiniz İptal Edildi.") ?></option>
        </select>
    </div>

    <div class="form-group">
        <label>SİPARİŞ DURUMU MESAJI</label>
        <textarea name="statusMessage" id="statusMessage" cols="30" rows="5" class="form-control" minlength="2" maxlength="255"><?= $item->statusMessage ?></textarea>
    </div>

    <button data-url="<?= base_url("orders/update/$item->id"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnUpdate">Güncelle</button>
    <a href="javascript:void(0)" onclick="closeModal('#ordersModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
    </div>
</form>


<script>
    $(document).on("change", "#statusTrigger", function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        let statusMessage = $(this).find("option:selected").text();
        $("#statusMessage").val(statusMessage);
    });
</script>