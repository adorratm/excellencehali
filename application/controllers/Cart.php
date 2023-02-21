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
            redirect(base_url("login"));
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