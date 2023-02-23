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
     * Quantity
     */
    public function header_cart()
    {
        $this->load->view("includes/headerCart");
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
        echo $this->cart->total_items();
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
                if (!empty($cartData["qty"]) && $cartData["qty"] > 0) :
                    if ((float)$product->stock > 0 && (float)$cartData["qty"] <= (float)$product->stock) :
                        $this->cart->insert($cartData);
                        $alert = ["success" => true, "title" => lang("success"), "message" => lang("itemAddedToCart")];
                    endif;
                endif;
            endif;
        endif;
        echo json_encode($alert);
        return;

        if (!empty($product)) :
            $counterArr = [];
            $product->price = ((int)$product->vat ?  ($product->price + $product->price * ($product->vat / 100)) : $product->price);
            $price = ($product->discounted_price ? $product->discounted_price : $product->price);
            if (empty($data["quantity"]) || (float)$data["quantity"] == 0) :
                $options["mainQuantity"] = FALSE;
            else :
                $options["mainQuantity"] = TRUE;
            endif;

            $cartData = ["codes_id" => $product->codes_id, "qty" => (empty($data["quantity"]) ? 1 : $data["quantity"]), "price" => $price, "name" => clean(stripslashes(trim($product->title)))];
            if ((float)$cartData["price"] <= 0) :
                echo json_encode(["success" => false, "title" => lang("error"), "msg" => lang("youCannotAddThisItemMoreToCart")]);
                die();
            endif;
            $cartData["options"] = $options;
            $stockStatus = $product->stockStatus;
            /**
             * IF NOT EMPTY THE CART
             */
            if ($cartData["qty"] <= 0 && empty($counterArr)) :
                $cartData = [];
            endif;
            if (empty($cartData)) :
                echo json_encode($alert);
                return;
            endif;
            if (!empty($this->cart->contents())) :
                $contentIds = [];
                foreach ($this->cart->contents() as $items) :
                    if (!in_array($items["id"], $contentIds)) :
                        array_push($contentIds, $items["id"]);
                    endif;
                    if ($items["id"] === $cartData["id"] && empty($product->pvgId)) :
                        if ((float)$items["qty"] >= (float)$product->stock || !$stockStatus) :
                            echo json_encode(["success" => false, "title" => lang("error"), "msg" => lang("youCannotAddThisItemMoreToCart")]);
                            die();
                        else :
                            $this->cart->insert($cartData);
                            echo json_encode(["success" => true, "title" => lang("success"), "msg" => lang("addedToCartSuccessfully"), "cartData" => $cartData]);
                            die();
                        endif;
                    endif;
                endforeach;
                if (!in_array($cartData["id"], $contentIds) && $stockStatus && (float)$cartData["qty"] <= (float)$product->stock) :
                    $this->cart->insert($cartData);
                    echo json_encode(["success" => true, "title" => lang("success"), "msg" => lang("addedToCartSuccessfully"), "cartData" => $cartData]);
                    die();
                elseif (in_array($cartData["id"], $contentIds) && $stockStatus && (float)$cartData["qty"] <= (float)$product->stock && $product->pvgId !== $items["options"]["pvgId"]) :
                    $this->cart->insert($cartData);
                    echo json_encode(["success" => true, "title" => lang("success"), "msg" => lang("addedToCartSuccessfully"), "cartData" => $cartData]);
                    die();
                else :
                    echo json_encode(["success" => false, "title" => lang("error"), "msg" => lang("youCannotAddThisItemMoreToCart")]);
                    die();
                endif;
            else :
                /**
                 * ELSE EMPTY CART
                 */
                if ($stockStatus && (float)$cartData["qty"] <= (float)$product->stock) :
                    $this->cart->insert($cartData);
                    echo json_encode(["success" => true, "title" => lang("success"), "msg" => lang("addedToCartSuccessfully")]);
                    die();
                else :
                    echo json_encode(["success" => false, "title" => lang("error"), "msg" => lang("youCannotAddThisItemMoreToCart")]);
                    die();
                endif;
            endif;
        else :
            die();
        endif;
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
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== CLEAR ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
}
