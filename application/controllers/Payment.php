<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends MY_Controller
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
        $this->viewFolder = "payment_v";
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
                "message" => lang("you_must_login_to_use_the_cart")
            ];
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url(lang("routes_dealer-login")));
        endif;
        $this->viewData->page_title = clean(strto("lower|ucwords", lang("choose_payment_method")));
        $this->viewData->meta_title = clean(strto("lower|ucwords", lang("choose_payment_method"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));

        $this->viewData->og_url                 = clean(base_url());
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "website";
        $this->viewData->og_title           = clean(strto("lower|ucwords", lang("choose_payment_method"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->viewFolder = "payment_v/index";
        $this->render();
        //$this->output->enable_profiler(TRUE);
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== INDEX ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */

    public function payment_method_change()
    {
        if (!get_active_user()) :
            echo json_encode([
                "success" => false,
                "title" => lang("error"),
                "message" => lang("you_must_login_to_use_the_cart")
            ]);
            return;
        endif;
        if (empty($this->cart->contents())) :
            echo json_encode([
                "success" => false,
                "title" => lang("error"),
                "message" => lang("emptyCart")
            ]);
            return;
        endif;
        if ($this->input->post("payment_method", true)) :
            $this->session->set_userdata("payment_method", $this->input->post("payment_method", true));
            echo json_encode([
                "success" => true,
                "title" => lang("success"),
                "message" => lang("payment_method_changed")
            ]);
            return;
        endif;
    }

    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== ORDER ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */

    public function order()
    {
        try {

            if (!get_active_user()) :
                $alert = [
                    "success" => false,
                    "title" => lang("error"),
                    "message" => lang("you_must_login_to_use_the_cart")
                ];
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url(lang("routes_dealer-login")));
            endif;
            if (empty($this->cart->contents())) :
                $alert = [
                    "success" => false,
                    "title" => lang("error"),
                    "message" => lang("emptyCart")
                ];
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url(lang("routes_cart")));
            endif;
            if (!$this->session->userdata("choosedAddress")) :
                $alert = [
                    "success" => false,
                    "title" => lang("error"),
                    "message" => lang("no_choosed_address_found")
                ];
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url(lang("routes_order-address")));
            endif;
            if (!$this->session->userdata("payment_method")) :
                $alert = [
                    "success" => false,
                    "title" => lang("error"),
                    "message" => lang("payment_method_not_found")
                ];
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url(lang("routes_choose-payment-method")));
            endif;

            $alert = [
                "success" => false,
                "title" => lang("error"),
                "message" => lang("an_error_occured_while_creating_order")
            ];
            /**
             * Stock Checker
             */
            /*
            foreach ($this->cart->contents() as $cartKey => $cartProduct) :
                if (!empty($cartProduct["id"]) && !empty($cartProduct["options"]["codes"])) :
                    $stock = @json_decode(getStock($cartProduct["id"], $cartProduct["options"]["codes"]))->data;
                    if (!empty($stock) && $stock->stock > 0 && $cartProduct["qty"] >= $stock->stock) :
                        $this->cart->update([
                            "rowid" => $cartProduct["rowid"],
                            "qty" => $stock->stock
                        ]);
                        $alert["message"] = "<b>".$stock->title."</b> ".lang("product_not_in_stock_and_updated_from_cart");
                        $this->session->set_flashdata("alert", $alert);
                        redirect(base_url(lang("routes_cart")));
                    endif;

                    if (empty($stock) || $stock->stock <= 0) :
                        $this->cart->remove($cartProduct["rowid"]);
                        $alert["message"] = "<b>".$stock->title."</b> ".lang("product_not_in_stock_and_removed_from_cart");
                        $this->session->set_flashdata("alert", $alert);
                        redirect(base_url(lang("routes_cart")));
                    endif;
                endif;
            endforeach;
            */
            $orderData = [];
            if ($this->session->userdata("payment_method") == 1) :
                $address = $this->general_model->get("user_addresses", null, ["user_id" => get_active_user()->id, "id" => $this->session->userdata("choosedAddress")]);
                if (!empty($address)) :
                    $orderData["user_id"] = @get_active_user()->id;
                    $orderData["address_title"] = $address->title;
                    $orderData["first_name"] = $address->first_name;
                    $orderData["last_name"] = $address->last_name;
                    $orderData["phone"] = $address->phone;
                    $orderData["company_name"] = $address->company_name;
                    $orderData["tax_number"] = $address->tax_number;
                    $orderData["tax_administration"] = $address->tax_administration;
                    $orderData["address"] = $address->address;
                    $orderData["vat"] = @$this->session->userdata("checkout")["vat"];
                    $orderData["sub_total"] = @$this->session->userdata("checkout")["subTotal"];
                    $orderData["total"] = @$this->session->userdata("checkout")["total"];
                    $orderData["payment_method"] = @$this->session->userdata("payment_method");
                    $orderData["symbol"] = @$this->viewData->symbol;
                    $orderData["codes"] = @get_active_user()->codes;
                    $orderData["status"] = 1;
                    $orderData["order_code"] = "ORD-" . random_string('alnum', 28);
                    /**
                     * Stock Checker
                     */
                    /*
                    if(empty($orderData["codes"])):
                        $alert["message"] = lang("codes_not_found");
                        $this->session->set_flashdata("alert", $alert);
                        redirect(base_url(lang("routes_cart")));
                    endif;
                    */
                    $order_id = $this->general_model->add("orders", $orderData);
                    if (!empty($order_id)) :
                        foreach ($this->cart->contents() as $cartKey => $cartValue) :
                            $wheres["p.isActive"] = 1;
                            $wheres["pi.isCover"] = 1;
                            $wheres["p.lang"] = $this->viewData->lang;
                            $joins = ["product_collections pc" => ["p.collection_id = pc.codes_id", "left"], "product_images pi" => ["pi.codes_id = p.codes_id AND pi.codes = p.codes", "left"], "product_details pd" => ["pd.codes_id = p.codes_id AND pd.codes = p.codes", "left"]];
                            $select = "p.pattern_id,p.pattern,p.color_id,p.color,p.dimension_id,p.dimension,p.brand_id,p.brand,p.collection_id,p.collection,p.barcode,p.stock,pc.title collection_title,pc.codes_id collection_codes,pc.seo_url collection_seo_url,p.price,p.discounted_price,p.codes_id,p.codes,p.id,p.title,p.seo_url,pi.url img_url,pd.description,pd.content,pd.features,p.isActive";
                            $distinct = true;
                            $groupBy = ["p.id"];
                            $wheres['p.codes_id'] =  $cartValue["id"];
                            $wheres['p.codes'] =  $cartValue["options"]["codes"];
                            /**
                             * Get Product Detail
                             */
                            $product = $this->general_model->get("products p", $select, $wheres, $joins, [], [], $distinct, $groupBy);
                            $orderItemDataArray = [];
                            if (!empty($product)) :
                                $orderItemData = [];
                                $orderItemData["order_id"] = $order_id;
                                $orderItemData["codes_id"] = $product->codes_id;
                                $orderItemData["title"] = $product->title;
                                $orderItemData["seo_url"] = $product->seo_url;
                                $orderItemData["barcode"] = $product->barcode;
                                $orderItemData["collection_id"] = $product->collection_id;
                                $orderItemData["collection"] = $product->collection;
                                $orderItemData["pattern_id"] = $product->pattern_id;
                                $orderItemData["pattern"] = $product->pattern;
                                $orderItemData["color_id"] = $product->color_id;
                                $orderItemData["color"] = $product->color;
                                $orderItemData["dimension_id"] = $product->dimension_id;
                                $orderItemData["dimension"] = $product->dimension;
                                $orderItemData["brand_id"] = $product->brand_id;
                                $orderItemData["brand"] = $product->brand;
                                $orderItemData["price"] = $product->price;
                                $orderItemData["discounted_price"] = $product->discounted_price;
                                $orderItemData["stock"] = $product->stock;
                                $orderItemData["codes"] = $product->codes;
                                $orderItemData["img_url"] = @file_get_contents(get_picture("products_v", $product->img_url));
                                $orderItemData["quantity"] = $cartValue["qty"];
                                $orderItemData["sub_total"] = $cartValue["subtotal"];
                                array_push($orderItemDataArray, $orderItemData);
                            endif;
                            if (!empty($orderItemDataArray)) :
                                $this->general_model->insert_batch("order_products", $orderItemDataArray);
                            endif;
                        endforeach;
                        $order_products = $this->general_model->get_all("order_products", null, null, ["order_id" => $order_id]);
                        if (!empty($order_products)) :
                            $alert = [
                                "success" => true,
                                "title" => lang("success"),
                                "message" => lang("order_success")
                            ];
                            // TODO : Send Codes Data To Api
                            /**
                             * Send To User
                             */
                            $orderData["order_id"] = $order_id;
                            $this->viewData->order_data = $orderData;
                            $this->viewData->order_products = $order_products;
                            $this->viewData->subject = $this->viewData->settings->company_name . " - " . lang("your_order_has_been_received");
                            $mailViewData = $this->load->view("includes/mail_template", (array)$this->viewData, true);
                            if (@send_emailv2([$this->viewData->user->email], $this->viewData->subject, $mailViewData)) :
                                /**
                                 * Send To Admin
                                 */
                                $this->viewData->subject = $this->viewData->settings->company_name . " - " . lang("new_order_has_been_received");
                                $this->viewData->message = 'Merhaba Sayın Yetkili, "<b>' . $this->viewData->user->first_name . " " . $this->viewData->user->last_name . ' (Email: <a href="mailto:' . $this->viewData->user->email . '">' . $this->viewData->user->email . '</a> - Telefon: <a href="tel:' . $this->viewData->user->phone . '">' . $this->viewData->user->phone . '</a>)</b> İsimli Müşteri Websiteniz Üzerinden <b>' . $orderData["total"] . " " . $this->viewData->symbol . '</b> Tutarında Sipariş Oluşturdu.';

                                $mailViewData = $this->load->view("includes/mail_template", (array)$this->viewData, true);
                                @send_emailv2(null, $this->viewData->subject, $mailViewData);
                            endif;
                        endif;
                    endif;
                endif;
            endif;
            $this->cart->destroy();
            unset($_SESSION["payment_method"]);
            unset($_SESSION["choosedAddress"]);
            unset($_SESSION["checkout"]);
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url(lang("routes_order-success") . "/" . $orderData["order_code"]));
        } catch (Exception $e) {
            $alert["message"] = $e->getMessage();
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url(lang("routes_cart")));
        }
    }

    public function order_success($order_code = null)
    {
        if (!get_active_user()) :
            $alert = [
                "success" => false,
                "title" => lang("error"),
                "message" => lang("you_must_login_to_use_the_cart")
            ];
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url(lang("routes_dealer-login")));
        endif;
        if (!empty($order_code)) :
            $order = $this->general_model->get("orders", null, ["order_code" => $order_code]);
            if (empty($order)) :
                $alert = [
                    "success" => false,
                    "title" => lang("error"),
                    "message" => lang("order_code_not_found")
                ];
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url(lang("routes_cart")));
            endif;
        endif;
        $this->viewData->page_title = clean(strto("lower|ucwords", lang("order_successfully_created")));
        $this->viewData->meta_title = clean(strto("lower|ucwords", lang("order_successfully_created"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));
        $this->viewData->order_code = $order_code;
        $this->viewData->og_url                 = clean(base_url());
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "website";
        $this->viewData->og_title           = clean(strto("lower|ucwords", lang("order_successfully_created"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->viewFolder = "payment_v/success";
        $this->render();
        //$this->output->enable_profiler(TRUE);
    }


    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== ORDER ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
}
