<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $vat = 0 ?>
<?php $totalVat = 0 ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="cartHeader">
                <h3 class="fw-bold text-center mb-5"><?= lang("cart") ?></h3>
            </div>
        </div>
        <div class="col-lg-12">
            <table class="shop_table cart_table">
                <thead>
                    <tr>
                        <th class="product-thumbnail text-center align-items-center align-self-center align-content-center align-middle justify-content-center"><?= lang("productThumbnail") ?></th>
                        <th class="product-name text-center align-items-center align-self-center align-content-center align-middle justify-content-center"><?= lang("productName") ?></th>
                        <th class="product-name text-center align-items-center align-self-center align-content-center align-middle justify-content-center"><?= lang("orderNote") ?></th>
                        <th class="product-price text-center align-items-center align-self-center align-content-center align-middle justify-content-center"><?= lang("productPrice") ?></th>
                        <th class="product-quantity text-center align-items-center align-self-center align-content-center align-middle justify-content-center"><?= lang("productQuantity") ?></th>
                        <th class="product-subtotal text-center align-items-center align-self-center align-content-center align-middle justify-content-center"><?= lang("subTotal") ?></th>
                        <th class="product-remove text-center align-items-center align-self-center align-content-center align-middle justify-content-center"><?= lang("actions") ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($this->cart->contents())) : ?>
                        <?php foreach ($this->cart->contents() as $items) : ?>
                            <?php
                            /**
                             * Cart & Wishlist Products
                             */
                            $wheres["p.isActive"] = 1;
                            $wheres["pi.isCover"] = 1;
                            $wheres["p.lang"] = $this->viewData->lang;
                            $wheres["p.codes_id"] = $items["id"];
                            $wheres["p.codes"] = $items["options"]["codes"];
                            $wheres["p.stock>="]  = 1;
                            $joins = ["product_details pd" => ["pd.codes_id = p.codes_id AND pd.codes = p.codes", "left"], "product_collections pc" => ["p.collection_id = pc.id", "left"], "product_images pi" => ["pi.codes_id = p.codes_id AND pi.codes = p.codes", "left"]];

                            $select = "p.dimension_type,p.dimension,p.vat,p.stock,p.codes_id,p.codes,p.price,p.discounted_price,p.id,p.title,p.seo_url,pi.url img_url,p.isActive";
                            $distinct = true;
                            $groupBy = ["p.codes_id"];
                            $product = $this->general_model->get("products p", $select, $wheres, $joins, [], [], $distinct, $groupBy);
                            $dimension = ($product->dimension_type == "ROLL" ? @floatval(@str_replace("XR", "", $product->dimension)) : $product->dimension);
                            $dimensionStock = 0;
                            foreach ($this->cart->contents() as $rollItems) :
                                if ($rollItems["id"] == $product->codes_id && $rollItems["options"]["codes"] == $product->codes && $rollItems["options"]["dimension_type"] == "ROLL") {
                                    $dimensionStock += (($dimension / 100) * $rollItems["options"]["height"] * $rollItems["qty"]);
                                }
                            endforeach;
                            $maxStock =  ($product->dimension_type == "ROLL" ? @intval((($product->stock) / ((($dimension / 100) * $items["options"]["height"])))) : $product->stock);

                            ?>
                            <?php if (!empty($product)) : ?>
                                <?php ($product->vat ? $vat =  ((float)$items['price'] * (int)$items["qty"]) - ((int)$items["qty"] * ($product->discounted_price ? (float)$product->discounted_price : (float)$product->price) * ((float)$product->vat / 100)) : 0) ?>
                                <?php ($product->vat ? $totalVat +=  ((int)$items["qty"] * ($product->discounted_price ? (float)$product->discounted_price : (float)$product->price) * ((float)$product->vat / 100)) : 0) ?>
                                <tr>
                                    <td class="product-thumbnail text-center align-items-center align-self-center align-content-center align-middle justify-content-center">
                                        <a rel="dofollow" href="<?= base_url(lang("routes_product-collections") . "/" . lang("routes_product") . "/" . $product->codes . "/" . $product->seo_url) ?>" title="<?= stripslashes($items["name"]) ?>"><img width="1000" height="1000" loading="lazy" data-src="<?= get_picture("products_v", $product->img_url) ?>" alt="<?= $items['name']; ?>" class="img-fluid lazyload"></a>
                                    </td>
                                    <td class="product-name text-center align-items-center align-self-center align-content-center align-middle justify-content-center">
                                        <a rel="dofollow" href="<?= base_url(lang("routes_product-collections") . "/" . lang("routes_product") . "/" . $product->codes . "/" . $product->seo_url) ?>" title="<?= stripslashes($items["name"]) ?>"><?= stripslashes($items["name"]) ?>
                                            <?php if (!empty($items["options"]["height"]) && $product->dimension_type == "ROLL") : ?>
                                                <div class="product-dimension">
                                                    <span class="fw-bold"><?= lang("height") ?>: </span>
                                                    <span class="ms-2"><?= $items["options"]["height"] ?></span>
                                                </div>
                                            <?php endif ?>
                                        </a>
                                    </td>
                                    <td class="order-note text-center align-items-center align-self-center align-content-center align-middle justify-content-center">
                                        <?= $items["options"]["order_note"] ?>
                                    </td>
                                    <td class="product-price text-center align-items-center align-self-center align-content-center align-middle justify-content-center">
                                        <?php if (!empty($product->price) || !empty($product->discounted_price)) : ?>
                                            <div class="pi01Price text-center align-items-center align-self-center align-content-center align-middle justify-content-center">
                                                <ins><?= !empty($product->discounted_price) ? $product->discounted_price : $product->price ?> <?= $this->viewData->symbol ?></ins>
                                                <?php if (!empty($product->discounted_price) && $product->discounted_price > 0) : ?>
                                                    <del><?= $product->price ?> <?= $this->viewData->symbol ?></del>
                                                <?php endif ?>
                                            </div>
                                        <?php endif ?>
                                    </td>
                                    <td class="product-quantity text-center align-items-center align-self-center align-content-center align-middle justify-content-center">
                                        <div class="quantity d-flex mx-auto clearfix text-center align-items-center align-self-center align-content-center align-middle justify-content-center">
                                            <button type="button" class="qtyBtn btnMinus"><i class="fa fa-minus"></i></button>
                                            <input type="number" class="carqty input-text qty text" name="quantity" min="1" value="<?= $items["qty"] ?>" max="<?= intval($maxStock) ?>" data-rowid="<?= $items['rowid'] ?>">
                                            <button type="button" class="qtyBtn btnPlus" data-max="<?= intval($maxStock) ?>"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </td>
                                    <td class="product-subtotal text-center align-items-center align-self-center align-content-center align-middle justify-content-center">
                                        <div class="pi01Price text-center align-items-center align-self-center align-content-center align-middle justify-content-center">
                                            <?= $this->viewData->symbol . $this->cart->format_number($items["subtotal"]); ?>
                                        </div>
                                    </td>
                                    <td class="product-remove text-center align-items-center align-self-center align-content-center align-middle justify-content-center">
                                        <a class="cartRemoveProducts remove" data-rowid="<?= $items['rowid'] ?>" rel="dofollow" href="<?= base_url(lang("routes_product-collections") . "/" . lang("routes_product") . "/" . $product->codes . "/" . $product->seo_url) ?>" title="<?= stripslashes($items["name"]) ?>"><span></span></a>
                                    </td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                    <?php endif ?>
                    <?php if (empty($this->cart->contents())) : ?>
                        <tr>
                            <td colspan="6" class="text-center align-items-center align-self-center align-content-center align-middle justify-content-center">
                                <div class="alert alert-danger text-center fw-bold" role="alert">
                                    <?= lang("emptyCart") ?>
                                </div>
                            </td>
                        </tr>
                    <?php endif ?>
                </tbody>
                <tfoot>
                    <tr class="actions">
                        <td colspan="2" class="text-start">
                            <a rel="dofollow" href="<?= base_url(lang("routes_product-collections")) ?>" title="<?= lang("continueShopping") ?>" class="ulinaBTN"><span><?= lang("continueShopping") ?></span></a>
                        </td>
                        <td colspan="5" class="text-end">
                            <a rel="dofollow" href="<?= base_url(lang("routes_cart")) ?>" class="ulinaBTN2 updateCart" onclick="event.preventDefault();event.stopImmediatePropagation();headerCart();" title="<?= lang("updateCart") ?>"><?= lang("updateCart") ?></a>
                            <a rel="dofollow" href="<?= base_url(lang("routes_cart")) ?>" class="ulinaBTN2 emptyCart" title="<?= lang("clearCart") ?>"><?= lang("clearCart") ?></a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="row cartAccessRow justify-content-end mt-4">
        <div class="col-lg-4">
            <?php
            $totalPrice = 0;
            $subTotalPrice = 0;

            $totalPrice = (float)$this->cart->total();
            $subTotalPrice = (float)$this->cart->total() - (float)$totalVat;
            ?>
            <div class="col-sm-12 cart_totals">
                <table class="shop_table shop_table_responsive">
                    <tr class="cart-subtotal">
                        <th><?= lang("subTotal") ?></th>
                        <td data-title="Subtotal">
                            <div class="pi01Price">
                                <ins><?= $this->viewData->symbol . $this->cart->format_number($subTotalPrice); ?></ins>
                            </div>
                        </td>
                    </tr>
                    <?php if ($totalVat > 0) : ?>
                        <tr class="cart-shipping">
                            <th><?= lang("vat") ?></th>
                            <td data-title="Subtotal">
                                <div class="pi01Price">
                                    <ins><?= $this->viewData->symbol . $this->cart->format_number($totalVat); ?></ins>
                                </div>
                            </td>
                        </tr>
                    <?php endif ?>
                    <tr class="order-total">
                        <th><?= lang("total") ?></th>
                        <td data-title="Subtotal">
                            <div class="pi01Price">
                                <ins><?= $this->viewData->symbol . $this->cart->format_number($totalPrice); ?></ins>
                            </div>
                        </td>
                    </tr>
                </table>
                <?php $checkoutData = [
                    "cart" => $this->cart->contents(),
                    "subTotal" => (float)$subTotalPrice,
                    "vat" => (float)$totalVat,
                    "total" => (float)$totalPrice,
                    "symbol" => $this->viewData->symbol
                ];
                $this->session->set_userdata("checkout", $checkoutData);
                ?>
                <a href="<?= base_url(lang("routes_cart") . "/" . lang("routes_order-address")) ?>" class="checkout-button ulinaBTN">
                    <span><?= lang("proceedToCheckout") ?></span>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        /**
         * Cart Operations
         */
        $(document).on("click", ".btnMinus", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let $this = $(this);
            let input = $(this).parent().find("input[name='quantity']");
            let value = parseInt(input.val());
            if (value > 1) {
                input.val(value - 1);
                $(this).parent().find("input[name='quantity']").trigger("change");
            }
        });
        $(document).on("click", ".btnPlus", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let input = $(this).parent().find("input[name='quantity']");
            let value = parseInt(input.val());
            if (value < parseInt(input.attr("max"))) {
                input.val(value + 1);
                $(this).parent().find("input[name='quantity']").trigger("change");
            }
        });
        $(document).on("change", "input[name='quantity']", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let $this = $(this);
            if (parseInt($this.val()) < 1) {
                $this.val(1);
            }
            if (parseInt($this.val()) > parseInt($this.attr("max"))) {
                $this.val(parseInt($this.attr("max")));
            }
            if ($this.prop("disabled") == false || $this.prop("disabled") == undefined) {
                $this.prop("disabled", true);
                let formData = new FormData();
                formData.append("<?= $this->security->get_csrf_token_name() ?>", "<?= $this->security->get_csrf_hash() ?>");
                formData.append("rowid", $this.data("rowid"));
                formData.append("quantity", $this.val());
                createAjax("<?= base_url(lang("routes_cart") . "/" . lang("routes_update-cart")) ?>", formData, () => {
                    headerCart();
                    $this.prop("disabled", false);
                }, () => {
                    $this.prop("disabled", false);
                });
            }
        });
    });
</script>