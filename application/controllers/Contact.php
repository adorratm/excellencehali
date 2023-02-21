<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends MY_Controller
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
        $this->viewFolder = "contact_v";
    }
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */

     /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================ CONTACT ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Contact
     */
    public function index()
    {
        $this->viewFolder = "contact_v/index";
        $this->viewData->page_title = clean(strto("lower|ucwords", lang("contact")));
        $this->viewData->meta_title = clean(strto("lower|ucwords", lang("contact"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));

        $this->viewData->og_url                 = clean(base_url(lang("routes_contact")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "article";
        $this->viewData->og_title           = clean(strto("lower|ucwords", lang("contact"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->render();
    }
    /**
     * Contact Form
     */
    public function contact_form()
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"]) :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => lang("errorMessageTitleText"), "message" => lang("errorMessageText") . " \"{$key}\" " . lang("emptyMessageText")]);
            die();
        else :
            $message = "\"" . $data['full_name'] . "\" İsimli ziyaretçi yeni mesaj gönderdi. \n <b>Ad Soyad : </b> " . $data["full_name"] . "\n <b>Telefon : </b> " . $data["phone"] . "\n <b>E-mail : </b> " . $data["email"] . "\n <b>Konu : </b>" . $data["subject"] . "\n <b>Mesaj : </b>" . $data["comment"];
            $message = $this->load->view("includes/simple_mail_template", ["settings" => get_settings(), "subject" => "Yeni Bir Mesajınız Var! | " . $this->viewData->settings->company_name, "message" => $message, "lang" => $this->viewData->lang], true);
            if (send_emailv2(null, "Yeni Bir Mesajınız Var! | " . $this->viewData->settings->company_name, $message, [], $this->viewData->lang)) :
                echo json_encode(["success" => true, "title" => lang("successMessageTitleText"), "message" => lang("successMessageText")]);
                die();
            else :
                echo json_encode(["success" => false, "title" => lang("errorMessageTitleText"), "message" => lang("errorEmailMessageText")]);
                die();
            endif;
        endif;
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================ CONTACT ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
}
