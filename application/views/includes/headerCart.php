<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $vat = 0 ?>
<?php $totalVat = 0 ?>
<?php $mainQuantity = 0 ?>
<?php foreach ($this->cart->contents() as $items) : ?>
    <?php
    /**
     * Cart & Wishlist Products
     */
    $wheres["p.isActive"] = 1;
    $wheres["pi.isCover"] = 1;
    $wheres["p.id"] = $items["id"];
    $wheres["p.lang"] = $lang;
    $joins = ["product_images pi" => ["pi.product_id = p.id", "left"]];
    $select = "p.id,p.title,p.seo_url,pi.url img_url,p.price price,p.vat vat,p.stock stock,p.stockStatus stockStatus,p.isActive";
    $distinct = null;
    $groupBy = ["p.product_id"];
    $product = $this->general_model->get("products p", $select, $wheres, $joins, [], [], $distinct, $groupBy);
    ?>
    <?php if (!empty($product)) : ?>
        <?php ((bool)$product->vat ? $vat =  ((float)$items['price'] * (float)$items["qty"]) - ((float)$items["qty"] * ($product->isDiscount ? (float)$product->discountedPrice : (float)$product->price)) : 0) ?>
        <?php ($product->vat ? $totalVat +=  ((float)$items['price'] * (float)$items["qty"]) - ((float)$items["qty"] * ($product->isDiscount ? (float)$product->discountedPrice : (float)$product->price)) : 0) ?>
        <div class="cartWidgetProduct">
            <a rel="dofollow" href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/{$product->url}") ?>" title="<?= stripslashes($items["name"]) ?>"><img width="1920" height="1280" loading="lazy" data-src="<?= get_picture("products_v", $product->img_url) ?>" alt="<?= $items['name']; ?>" class="img-fluid lazyload"></a>
            <a rel="dofollow" href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/{$product->url}") ?>" title="<?= stripslashes($items["name"]) ?>"><?= stripslashes($items["name"]) ?></a>
            <div class="cartProductPrice clearfix">
                <span class="price"><span><?= $items['qty'] ?> x <?= $symbol . $this->cart->format_number((empty($items["options"]["mainQuantity"]) || (bool)$items["options"]["mainQuantity"] == FALSE ? $items["price"] - ($product->isDiscount ? (float)$product->discountedPrice : (float)$product->price) : $items['price'])); ?> <?= ((bool)$product->vat ? ("+" . $symbol . $this->cart->format_number($vat) . " (KDV)") : null) ?></span><span>= <?= $symbol . $this->cart->format_number((empty($items["options"]["mainQuantity"]) || (bool)$items["options"]["mainQuantity"] == FALSE ? $items["subtotal"] - ($product->isDiscount ? (float)$product->discountedPrice : (float)$product->price) * $items["qty"] : $items['subtotal'])); ?></span></span>
            </div>
            <a rel="dofollow" href="<?= base_url(lang("routes_products") . "/" . lang("routes_product") . "/{$product->url}") ?>" class="remove-btn removeItem cartRemoveProducts" data-rowid="<?= $items['rowid'] ?>" title="<?= stripslashes($items["name"]) ?>"><i class="fa-solid fa-xmark"></i></a>
        </div>
        <?php if ((empty($items["options"]["mainQuantity"]) || (bool)$items["options"]["mainQuantity"] == FALSE)) : ?>
            <?php $mainQuantity += ($product->isDiscount ? (float)$product->discountedPrice : (float)$product->price) * $items["qty"] ?>
        <?php endif; ?>
        <?php $vat = 0 ?>
    <?php endif ?>
<?php endforeach ?>
<?php
$totalPrice = 0;
$subTotalPrice = 0;

$totalPrice = (float)$this->cart->total();
$subTotalPrice = (float)$this->cart->total() - (float)$totalVat;
if ((empty($items["options"]["mainQuantity"]) || (bool)$items["options"]["mainQuantity"] == FALSE)) :
    $subTotalPrice -= $mainQuantity;
    $totalPrice -= $mainQuantity;
endif;
?>
<?php if ($subTotalPrice > 0) : ?>
    <div class="totalPrice"><?= lang("subTotal") ?>: <span class="price"><span><?= $symbol . $this->cart->format_number($subTotalPrice); ?></span></div>
<?php endif ?>
<?php if ($totalVat > 0) : ?>
    <div class="totalPrice"><?= lang("vat") ?>: <span class="price"><span><?= $symbol . $this->cart->format_number($totalVat); ?></span></div>
<?php endif ?>
<?php if ($totalPrice > 0) : ?>
    <div class="totalPrice"><?= lang("total") ?>: <span class="price"><span><?= $symbol . $this->cart->format_number($totalPrice); ?></span></div>
<?php endif ?>
<div class="cartWidgetBTN clearfix">
    <a rel="dofollow" class="cart emptyCart" href="<?= base_url(lang("routes_cart")) ?>" title="<?= lang("emptyCart") ?>"><i class="fa fa-trash"></i> <?= lang("emptyCart") ?></a>
    <a rel="dofollow" class="checkout" href="<?= base_url(lang("routes_cart")) ?>" title="<?= lang("cart") ?>"><i class="fa fa-shopping-cart"></i> <?= lang("cart") ?></a>
</div>