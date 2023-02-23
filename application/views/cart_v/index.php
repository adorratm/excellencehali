<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" style="background-image: url(<?= get_picture("settings_v", $settings->about_logo) ?>);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pageBannerContent text-center">
                    <h2 class="text-white mb-0"><?= $page_title ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Page Banner Section -->

<?php $vat = 0 ?>
<?php $totalVat = 0 ?>
<?php $mainQuantity = 0 ?>



<!-- END: Cart Page Section -->
<section class="cartPageSection woocommerce">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cartHeader">
                    <h3><?= lang("cart") ?></h3>
                </div>
            </div>
            <div class="col-lg-12">
                <table class="shop_table cart_table">
                    <thead>
                        <tr>
                            <th class="product-thumbnail">Item Name</th>
                            <th class="product-name">&nbsp;</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-subtotal">Total</th>
                            <th class="product-remove">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
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
                            $joins = ["product_details pd" => ["pd.codes = p.codes_id AND pd.codes = p.codes", "left"], "product_collections pc" => ["p.collection_id = pc.id", "left"], "product_images pi" => ["pi.codes_id = p.codes_id AND pi.codes = p.codes", "left"]];

                            $select = "p.vat,p.stock,p.codes_id,p.codes,p.price,p.discounted_price,p.id,p.title,p.seo_url,pi.url img_url,p.isActive";
                            $distinct = true;
                            $groupBy = ["p.id"];
                            $product = $this->general_model->get("products p", $select, $wheres, $joins, [], [], $distinct, $groupBy);
                            ?>
                            <?php if (!empty($product)) : ?>
                                <?php ((bool)$product->vat ? $vat =  (((float)$items['price'] * (float)$items["qty"]) - ((float)$items["qty"] * (float)$product->price)) : 0) ?>
                                <?php ((bool)$product->vat ? $totalVat +=  (((float)$items['price'] * (float)$items["qty"]) - ((float)$items["qty"] * (float)$product->price)) : 0) ?>
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="shop_details1.html"><img src="images/cart/1.jpg" alt="Cart Item" /></a>
                                    </td>
                                    <td class="product-name">
                                        <a href="shop_details1.html">Ulina luxurious bag for men women</a>
                                    </td>
                                    <td class="product-price">
                                        <div class="pi01Price">
                                            <ins>$48.00</ins>
                                        </div>
                                    </td>
                                    <td class="product-quantity">
                                        <div class="quantity clearfix">
                                            <button type="button" class="qtyBtn btnMinus"><i class="fa fa-minus"></i></button>
                                            <input type="number" class="carqty input-text qty text" name="quantity" min="1" value="1" max="<?= $product->stock ?>">
                                            <button type="button" class="qtyBtn btnPlus" data-max="<?= $product->stock ?>"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </td>
                                    <td class="product-subtotal">
                                        <div class="pi01Price">
                                            <?php if (!empty($product->price) || !empty($product->discounted_price)) : ?>
                                                <ins><?= !empty($product->discounted_price) ? $product->discounted_price : $product->price ?> <?= $symbol ?></ins>
                                            <?php endif ?>
                                            <?php if (!empty($product->discounted_price) && $product->discounted_price > 0) : ?>
                                                <del><?= $product->price ?> <?= $symbol ?></del>
                                            <?php endif ?>
                                        </div>
                                    </td>
                                    <td class="product-remove">
                                        <a href="javascript:void(0);" class="remove"><span></span></a>
                                    </td>
                                </tr>
                            <?php endif ?>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr class="actions">
                            <td colspan="2" class="text-start">
                                <a href="shop_full_width.html" class="ulinaBTN"><span>Continue Shopping</span></a>
                            </td>
                            <td colspan="4" class="text-end">
                                <a href="shop_full_width.html" class="ulinaBTN2">Update Cart</a>
                                <a href="shop_full_width.html" class="ulinaBTN2">Clear All</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row cartAccessRow">
            <div class="col-lg-4">
                <div class="col-sm-12 cart_totals">
                    <table class="shop_table shop_table_responsive">
                        <tr class="cart-subtotal">
                            <th>Subtotal</th>
                            <td data-title="Subtotal">
                                <div class="pi01Price">
                                    <ins>$133.00</ins>
                                </div>
                            </td>
                        </tr>
                        <tr class="cart-shipping">
                            <th>Shipping</th>
                            <td data-title="Subtotal">
                                <div class="pi01Price">
                                    <ins>$10.00</ins>
                                </div>
                            </td>
                        </tr>
                        <tr class="order-total">
                            <th>Grand Total</th>
                            <td data-title="Subtotal">
                                <div class="pi01Price">
                                    <ins>$143.00</ins>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <a href="checkout.html" class="checkout-button ulinaBTN">
                        <span>Proceed to checkout</span>
                    </a>
                    <p class="cartHints">Checkout with multiple address</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Cart Page Section -->



<div class="checkout-area pt-30 pb-30">
    <div class="container">
        <div class="section-title">
            <h2 class="text-center text-green"><?= lang("cart") ?></h2>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="cart-table table-responsive">
                    <table class="table table-light table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="delete product_remove text-center align-middle"><?= lang("delete") ?></th>
                                <th class="product_thumb text-center align-middle"><?= lang("image") ?></th>
                                <th class="product product_name text-center align-middle"><?= lang("productName") ?></th>
                                <th class="price product-price text-center align-middle"><?= lang("price") ?></th>
                                <th class="quantity text-center align-middle"><?= lang("quantity") ?></th>
                                <th class="Total product_total text-center align-middle"><?= lang("subTotal") ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->cart->contents() as $items) : ?>
                                <?php
                                /**
                                 * Cart & Wishlist Products
                                 */
                                $wheres["p.isActive"] = 1;
                                $wheres["pi.isCover"] = 1;
                                $wheres["p.lang"] = $this->viewData->lang;
                                $wheres["p.codes_id"] = $items["codes_id"];
                                $joins = ["product_details pd" => ["pd.codes = p.codes_id AND pd.codes = p.codes", "left"], "product_collections pc" => ["p.collection_id = pc.id", "left"], "product_images pi" => ["pi.codes_id = p.codes_id AND pi.codes = p.codes", "left"]];

                                $select = "p.vat,p.stock,p.codes_id,p.codes,p.price,p.discounted_price,p.id,p.title,p.seo_url,pi.url img_url,p.isActive";
                                $distinct = true;
                                $groupBy = ["p.id"];
                                $product = $this->general_model->get("products p", $select, $wheres, $joins, [], [], $distinct, $groupBy);
                                ?>
                                <?php if (!empty($product)) : ?>
                                    <?php ((bool)$product->vat ? $vat =  (((float)$items['price'] * (float)$items["qty"]) - ((float)$items["qty"] * (float)$product->price)) : 0) ?>
                                    <?php ((bool)$product->vat ? $totalVat +=  (((float)$items['price'] * (float)$items["qty"]) - ((float)$items["qty"] * (float)$product->price)) : 0) ?>
                                    <tr>
                                        <td class="delete text-center align-middle">
                                            <a rel="dofollow" href="javascript:void(0)" class="removeItem text-dark-green product-delete" data-rowid="<?= $items['rowid'] ?>" title="<?= stripslashes($items["name"]) ?>"><i class="bx bx-trash"></i></a>
                                        </td>
                                        <td class="product text-center align-middle">
                                            <div class="cart-product">
                                                <div class="product-image">
                                                    <a rel="dofollow" href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/{$product->url}") ?>" title="<?= stripslashes($items["name"]) ?>">
                                                        <img width="1920" height="1280" loading="lazy" data-src="<?= get_picture("products_v", $product->img_url) ?>" alt="<?= stripslashes($items['name']); ?>" class="img-fluid lazyload" style="width: 150px;" width="150" height="150">
                                                    </a>
                                                </div>

                                            </div>
                                        </td>
                                        <td class="product text-center align-middle">
                                            <div class="product-content">
                                                <h5 class="title">
                                                    <a class="text-dark-green" rel="dofollow" href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/{$product->url}") ?>" title="<?= stripslashes($items["name"]) ?>"><?= stripslashes($items["name"]) ?></a>
                                                </h5>

                                            </div>
                                        </td>
                                        <td class="price text-center align-middle">
                                            <p class="cart-price price"><?= $symbol . $this->cart->format_number((empty($items["options"]["mainQuantity"]) || $items["options"]["mainQuantity"] == FALSE ? $items["price"] - ($product->discountedPrice ? (float)$product->discountedPrice : (float)$product->price) : $items['price'])); ?></p>
                                        </td>
                                        <td class="text-center align-middle" style="width: 120px;">
                                            <ul class="number">
                                                <li>
                                                    <span class="minus">-</span>
                                                    <input id="quantity" class="cart-plus-minus updateItem quantity" name="qty" min="1" data-rowid="<?= $items['rowid'] ?>" value="<?= $items["qty"] ?>" type="text" />
                                                    <span class="plus">+</span>
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="Total text-center align-middle">
                                            <p class="cart-price price"><?= $symbol . $this->cart->format_number((empty($items["options"]["mainQuantity"]) || $items["options"]["mainQuantity"] == FALSE ? $items["subtotal"] - ($product->discountedPrice ? (float)$product->discountedPrice : (float)$product->price) * $items["qty"] : $items['subtotal'])); ?></p>
                                        </td>
                                    </tr>
                                    <!-- /.single product  -->
                                    <?php if ((empty($items["options"]["mainQuantity"]) || $items["options"]["mainQuantity"] == FALSE)) : ?>
                                        <?php $mainQuantity += ($product->discountedPrice ? (float)$product->discountedPrice : (float)$product->price) * $items["qty"] ?>
                                    <?php endif; ?>
                                    <?php $vat = 0 ?>
                                <?php endif ?>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6"><a rel="dofollow" href="javascript:void(0)" class="emptyCart common-btn btn w-100" title="<?= lang("emptyCart") ?>"><?= lang("emptyCart") ?></a></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-xl-8 position-relative mt-30">
                <?php
                $totalPrice = 0;
                $subTotalPrice = 0;

                $totalPrice = (float)$this->cart->total();
                $subTotalPrice = (float)$this->cart->total() - (float)$totalVat;;
                $subTotalPrice -= $mainQuantity;
                $totalPrice -= $mainQuantity;
                ?>
                <div class="checkout-order">
                    <h3><?= lang("cartTotals") ?>:</h3>
                    <div class="inner">
                        <h4><?= lang("subTotal") ?>:
                            <span>
                                <?= $symbol . $this->cart->format_number($subTotalPrice); ?>
                            </span>
                        </h4>
                    </div>
                    <hr>
                    <?php if ($totalVat > 0) : ?>
                        <div class="inner">
                            <h4><?= lang("vat") ?>:
                                <span>
                                    <?= $symbol . $this->cart->format_number($totalVat); ?>
                                </span>
                            </h4>
                        </div>
                        <hr>
                    <?php endif ?>
                    <div class="inner">
                        <h4><?= lang("total") ?>:
                            <span>
                                <?= $symbol . $this->cart->format_number($totalPrice); ?>
                            </span>
                        </h4>
                        <?php $checkoutData = [
                            "cart" => $this->cart->contents(),
                            "subTotal" => (float)$subTotalPrice,
                            "vat" => (float)$totalVat,
                            "total" => (float)$totalPrice,
                            "symbol" => $symbol
                        ];
                        $this->session->set_userdata("checkout", $checkoutData);
                        ?>
                    </div>
                    <hr>
                    <div class="inner d-flex flex-wrap justify-content-end">
                        <div class="flex-grow-1 mx-1 ms-sm-0 mb-3">
                            <a class="btn common-btn bg-dark-green w-100" rel="dofollow" href="<?= base_url(lang("routes_products")) ?>" title="<?= lang("continueShopping") ?>"><?= lang("continueShopping") ?></a>
                        </div>
                        <div class="flex-grow-1 mx-1 me-sm-0 mb-3">
                            <a class="btn common-btn w-100" rel="dofollow" href="<?= base_url(lang("routes_choose-address")) ?>" title="<?= lang("choosingAddress") ?>"><?= lang("choosingAddress") ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        /**
         * Cart Operations
         */
        $(".btnMinus").on("click", () => {
            let $this = $(this);
            let input = $("input[name='quantity']");
            let value = parseInt(input.val());
            if (value > 1) {
                input.val(value - 1);
                $("input[name='quantity']").trigger("change");
            }
        });
        $(".btnPlus").on("click", () => {
            let input = $("input[name='quantity']");
            let value = parseInt(input.val());
            if (value < parseInt(input.attr("max"))) {
                input.val(value + 1);
                $("input[name='quantity']").trigger("change");
            }
        });
        $("input[name='quantity']").on("change", () => {
            if (parseInt($("input[name='quantity']").val()) < 1) {
                $("input[name='quantity']").val(1);
            }
            if (parseInt($("input[name='quantity']").val()) > parseInt($("input[name='quantity']").attr("max"))) {
                $("input[name='quantity']").val($("input[name='quantity']").attr("max"));
            }
            $(".addToCart").data("quantity", $("input[name='quantity']").val());
        });
    });
</script>


<!--====== Cart Ends ======-->