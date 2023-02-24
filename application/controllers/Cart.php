<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends MY_Controller
{
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "cart_v";
    }
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== INDEX ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Index
     */
    public function index()
    {
        if (!get_active_user()) :
            $alert = [
                "success" => false,
                "title" => lang("error"),
                "msg" => lang("you_must_login_to_use_the_cart")
            ];
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url(lang("dealer-login")));
        endif;
        $this->viewData->page_title = clean(strto("lower|ucwords", lang("cart")));
        $this->viewData->meta_title = clean(strto("lower|ucwords", lang("cart"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));

        $this->viewData->og_url                 = clean(base_url());
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "website";
        $this->viewData->og_title           = clean(strto("lower|ucwords", lang("cart"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->viewFolder = "cart_v/index";
        $this->render();
        //$this->output->enable_profiler(TRUE);
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== INDEX ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */

    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== HEADER ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Header Cart
     */
    public function header_cart()
    {
        $this->load->view("includes/headerCart");
    }
    /**
     * Cart Page
     */
    public function cart_page()
    {
        $this->load->view("includes/cart");
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== HEADER ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */

    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== QUANTITY ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Quantity
     */
    public function quantity()
    {
        echo count($this->cart->contents());
        return;
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== QUANTITY ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */

    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== ADD ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    public function add()
    {
        if (!get_active_user()) :
            echo json_encode([
                "success" => false,
                "title" => lang("error"),
                "message" => lang("you_must_login_to_use_the_cart")
            ]);
            return;
        endif;
        unset($_POST[$this->security->get_csrf_token_name()]);
        $data = rClean($_POST);
        $alert = ["success" => false, "title" => lang("error"), "message" => lang("youCannotAddThisItemMoreToCart")];
        if (!empty($data) && !empty($data["codes_id"]) && !empty($data["codes"]) && !empty($data["quantity"])) :
            /**
             * Get Product 
             */
            $wheres["p.isActive"] = 1;
            $wheres["pi.isCover"] = 1;
            $wheres["p.lang"] = $this->viewData->lang;
            $wheres["p.codes_id"] = $data["codes_id"];
            $wheres["p.codes"] = $data["codes"];
            $wheres["p.stock>="]  = 1;
            $joins = ["product_details pd" => ["pd.codes = p.codes_id AND pd.codes = p.codes", "left"], "product_collections pc" => ["p.collection_id = pc.id", "left"], "product_images pi" => ["pi.codes_id = p.codes_id AND pi.codes = p.codes", "left"]];

            $select = "p.vat,p.stock,p.codes_id,p.codes,p.price,p.discounted_price,p.id,p.title,p.seo_url,pi.url img_url,p.isActive";
            $distinct = true;
            $groupBy = ["p.codes_id"];
            $product = $this->general_model->get("products p", $select, $wheres, $joins, [], [], $distinct, $groupBy);
            if (!empty($product)) :
                $price = ($product->discounted_price ? $product->discounted_price : $product->price);
                $cartData = ["id" => $product->codes_id, "qty" => $data["quantity"], "price" => $price, "name" => clean(stripslashes(trim($product->title))), "options" => ["codes" => $product->codes]];
                $rowid = null;
                if (!empty($this->cart->contents())) :
                    foreach ($this->cart->contents() as $itemKey => $itemValue) :
                        if ($itemValue["id"] == $product->codes_id && $itemValue["options"]["codes"] == $product->codes) :
                            $cartData["qty"] = $data["quantity"] + $itemValue["qty"];
                            $rowid = $itemValue["rowid"];
                        endif;
                    endforeach;
                endif;
                if (!empty($this->cart->get_item($rowid)["qty"]) && !empty($cartData["qty"]) && (float)$cartData["qty"] > 0 && !empty($product->stock) && (float)$product->stock > 0 && (float)$cartData["qty"] <= (float)$product->stock && !empty($cartData["price"]) && $cartData["price"] > 0) :
                    $cartData["rowid"] = $rowid;
                    $this->cart->update($cartData);
                    $alert = ["success" => true, "title" => lang("success"), "message" => lang("cartItemUpdated")];
                endif;
                if (empty($this->cart->get_item($rowid)["qty"]) && !empty($cartData["qty"]) && (float)$cartData["qty"] > 0 && !empty($product->stock) && (float)$product->stock > 0 && (float)$cartData["qty"] <= (float)$product->stock && !empty($cartData["price"]) && $cartData["price"] > 0) :
                    $this->cart->insert($cartData);
                    $alert = ["success" => true, "title" => lang("success"), "message" => lang("itemAddedToCart")];
                endif;
            endif;
        endif;
        echo json_encode($alert);
        return;
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== ADD ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */

    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== UPDATE ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    public function update()
    {
        if (!get_active_user()) :
            echo json_encode([
                "success" => false,
                "title" => lang("error"),
                "message" => lang("you_must_login_to_use_the_cart")
            ]);
            return;
        endif;
        unset($_POST[$this->security->get_csrf_token_name()]);
        $data = rClean($_POST);
        $alert = ["success" => false, "title" => lang("error"), "message" => lang("youCannotAddThisItemMoreToCart")];
        if (!empty($data) && !empty($data["rowid"]) && !empty($data["quantity"])) :
            /**
             * Get Product 
             */
            $cartData = $this->cart->get_item($data["rowid"]);
            /**
             * Get Product 
             */
            $wheres["p.isActive"] = 1;
            $wheres["pi.isCover"] = 1;
            $wheres["p.lang"] = $this->viewData->lang;
            $wheres["p.codes_id"] = $cartData["id"];
            $wheres["p.codes"] = $cartData["options"]["codes"];
            $wheres["p.stock>="]  = 1;
            $joins = ["product_details pd" => ["pd.codes = p.codes_id AND pd.codes = p.codes", "left"], "product_collections pc" => ["p.collection_id = pc.id", "left"], "product_images pi" => ["pi.codes_id = p.codes_id AND pi.codes = p.codes", "left"]];

            $select = "p.vat,p.stock,p.codes_id,p.codes,p.price,p.discounted_price,p.id,p.title,p.seo_url,pi.url img_url,p.isActive";
            $distinct = true;
            $groupBy = ["p.codes_id"];
            $product = $this->general_model->get("products p", $select, $wheres, $joins, [], [], $distinct, $groupBy);
            if (!empty($product)) :
                $price = ($product->discounted_price ? $product->discounted_price : $product->price);
                $cartData = ["id" => $product->codes_id, "qty" => $data["quantity"], "price" => $price, "name" => clean(stripslashes(trim($product->title))), "options" => ["codes" => $product->codes]];
                $cartData["qty"] = $data["quantity"];

                if (!empty($this->cart->get_item($data["rowid"])["qty"]) && !empty($cartData["qty"]) && (float)$cartData["qty"] > 0 && !empty($product->stock) && (float)$product->stock > 0 && (float)$cartData["qty"] <= (float)$product->stock && !empty($cartData["price"]) && $cartData["price"] > 0) :
                    $cartData["rowid"] = $data["rowid"];
                    $this->cart->update($cartData);
                    $alert = ["success" => true, "title" => lang("success"), "message" => lang("cartItemUpdated")];
                endif;
            endif;
        endif;
        echo json_encode($alert);
        return;
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== UPDATE ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */

    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== DELETE ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    public function delete()
    {
        if (!get_active_user()) :
            echo json_encode([
                "success" => false,
                "title" => lang("error"),
                "message" => lang("you_must_login_to_use_the_cart")
            ]);
            return;
        endif;
        $alert = ["success" => false, "title" => lang("error"), "message" => lang("errorWhileRemovingCartItem")];
        $data = rClean($_POST);
        if (!empty($data) && !empty($data["rowid"])) :
            /**
             * Remove Product 
             */
            $this->cart->remove($data["rowid"]);
            $alert = ["success" => true, "title" => lang("success"), "message" => lang("removedFromCartSuccessfully")];
        endif;
        echo json_encode($alert);
        return;
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== DELETE ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */

    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== CLEAR ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    public function clear()
    {
        if (!get_active_user()) :
            echo json_encode([
                "success" => false,
                "title" => lang("error"),
                "message" => lang("you_must_login_to_use_the_cart")
            ]);
            return;
        endif;
        /**
         * Remove Product 
         */
        $this->cart->destroy();
        $alert = ["success" => true, "title" => lang("success"), "message" => lang("emptyCartSuccessfully")];
        echo json_encode($alert);
        return;
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== CLEAR ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */

    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== ORDER ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    public function order()
    {
        print_r("order");
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== ORDER ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
}
