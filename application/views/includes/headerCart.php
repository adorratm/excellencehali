<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $vat = 0 ?>
<?php $totalVat = 0 ?>
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
        $joins = ["product_details pd" => ["pd.codes = p.codes_id AND pd.codes = p.codes", "left"], "product_collections pc" => ["p.collection_id = pc.id", "left"], "product_images pi" => ["pi.codes_id = p.codes_id AND pi.codes = p.codes", "left"]];

        $select = "p.vat,p.stock,p.codes_id,p.codes,p.price,p.discounted_price,p.id,p.title,p.seo_url,pi.url img_url,p.isActive";
        $distinct = true;
        $groupBy = ["p.codes_id"];
        $product = $this->general_model->get("products p", $select, $wheres, $joins, [], [], $distinct, $groupBy);
        ?>
        <?php if (!empty($product)) : ?>
            <?php ($product->vat ? $vat =  ((float)$items['price'] * (float)$items["qty"]) - ((float)$items["qty"] * ($product->discounted_price ? (float)$product->discounted_price : (float)$product->price) * ((float)$product->vat / 100)) : 0) ?>
            <?php ($product->vat ? $totalVat +=  ((float)$items["qty"] * ($product->discounted_price ? (float)$product->discounted_price : (float)$product->price) * ((float)$product->vat / 100)) : 0) ?>
            <div class="cartWidgetProduct">
                <a rel="dofollow" href="<?= base_url(lang("routes_product-collections") . "/" . lang("routes_product") . "/" . $product->codes . "/" . $product->seo_url) ?>" title="<?= stripslashes($items["name"]) ?>"><img width="1000" height="1000" loading="lazy" data-src="<?= get_picture("products_v", $product->img_url) ?>" alt="<?= $items['name']; ?>" class="img-fluid lazyload"></a>
                <a rel="dofollow" href="<?= base_url(lang("routes_product-collections") . "/" . lang("routes_product") . "/" . $product->codes . "/" . $product->seo_url) ?>" title="<?= stripslashes($items["name"]) ?>"><?= stripslashes($items["name"]) ?></a>
                <div class="cartProductPrice clearfix">
                    <span class="price"><span><?= $items['qty'] ?> x <?= $this->viewData->symbol . $this->cart->format_number(($product->discounted_price ? (float)$product->discounted_price : (float)$product->price)); ?> <?= ((bool)$product->vat ? ("+" . $this->viewData->symbol . $this->cart->format_number($items["subtotal"] - $vat) . " (KDV)") : null) ?></span><span>= <?= $this->viewData->symbol . $this->cart->format_number($items["subtotal"]); ?></span></span>
                </div>
                <button class="cartRemoveProducts" data-rowid="<?= $items['rowid'] ?>" title="<?= stripslashes($items["name"]) ?>"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <?php $vat = 0 ?>
        <?php endif ?>
    <?php endforeach ?>
<?php endif ?>
<?php if (empty($this->cart->contents())) : ?>
    <div class="cartWidgetProduct px-0 mb-3">
        <div class="alert alert-danger text-center fw-bold" role="alert">
            <?= lang("emptyCart") ?>
        </div>
    </div>
<?php endif ?>
<?php
$totalPrice = 0;
$subTotalPrice = 0;

$totalPrice = (float)$this->cart->total();
$subTotalPrice = (float)$this->cart->total() - (float)$totalVat;
?>
<?php if ($subTotalPrice > 0) : ?>
    <div class="totalPrice"><?= lang("subTotal") ?>: <span class="price"><span><?= $this->viewData->symbol . $this->cart->format_number($subTotalPrice); ?></span></div>
<?php endif ?>
<?php if ($totalVat > 0) : ?>
    <div class="totalPrice"><?= lang("vat") ?>: <span class="price"><span><?= $this->viewData->symbol . $this->cart->format_number($totalVat); ?></span></div>
<?php endif ?>
<?php if ($totalPrice > 0) : ?>
    <div class="totalPrice"><?= lang("total") ?>: <span class="price"><span><?= $this->viewData->symbol . $this->cart->format_number($totalPrice); ?></span></div>
<?php endif ?>
<div class="cartWidgetBTN clearfix">
    <a rel="dofollow" class="cart emptyCart" href="<?= base_url(lang("routes_cart")) ?>" title="<?= lang("clearCart") ?>"><i class="fa fa-trash"></i> <?= lang("clearCart") ?></a>
    <a rel="dofollow" class="checkout" href="<?= base_url(lang("routes_cart")) ?>" title="<?= lang("cart") ?>"><i class="fa fa-shopping-cart"></i> <?= lang("cart") ?></a>
</div>