<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends MY_Controller
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
        $this->viewFolder = "account_v";
    }
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== ERROR ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Error 
     */
    public function error()
    {
        $this->viewFolder = "404_v/index";
        $this->render();
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== ERROR ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */

    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== ACCOUNT =================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    public function index()
    {
        if (!get_active_user()) :
            redirect(base_url(lang("routes_login")));
        endif;
        $this->viewFolder = "account_v/index";
        $this->viewData->page_title = clean(strto("lower|ucwords", lang("account")));
        $this->viewData->meta_title = clean(strto("lower|ucwords", lang("account"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", stripslashes($this->viewData->settings->meta_description));
        $this->viewData->og_url                 = clean(base_url(lang("routes_account")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "article";
        $this->viewData->og_title           = clean(strto("lower|ucwords", lang("account"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->render();
    }

    public function update()
    {
        if (!get_active_user()) :
            redirect(base_url(lang("routes_login")));
        endif;
        $this->form_validation->set_rules("email", lang("email"), "required|trim|valid_email");
        if (!empty(clean($_POST["password"]))) :
            $this->form_validation->set_rules("password", lang("password"), "required|trim|min_length[6]");
            $this->form_validation->set_rules("passwordRepeat", lang("passwordRepeat"), "required|trim|min_length[6]");
        endif;
        $this->form_validation->set_message(["required"  => lang("required"), "valid_email" => lang("valid_email"), "min_length" => lang("min_length"),]);
        $this->form_validation->set_error_delimiters('', ',');
        $alert = [
            "title" => lang("error"),
            "msg" => lang("errorOnUpdate"),
            "type" => "error"
        ];
        if ($this->form_validation->run()) :
            $data = rClean($_POST);
            if (!empty(clean($_POST["password"])) && !empty(clean($_POST["passwordRepeat"])) && $data["password"] !== $data["passwordRepeat"]) :
                $alert["msg"] = lang("samePassword");
                redirect(base_url(lang("routes_account")));
            endif;
            if (!empty(clean($_POST["password"]))) :
                // Create md5 password
                $data["password"] = mb_substr(sha1(md5($data["password"])), 0, 32);
                unset($data["passwordRepeat"]);
            else :
                // Unset passwordRepeat && Password
                unset($data["password"]);
                unset($data["passwordRepeat"]);
            endif;
            $data["token"] = random_string('alnum', 255);
            $data["phone"] = str_replace(" ", "", $data["phone"]);
            if (!empty($this->general_model->get("users", null, ["email" => $data["email"], "id!=" => get_active_user()->id]))) :
                $alert["msg"] = lang("emailExists");
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url(lang("routes_account")));
            endif;
            if (!empty($this->general_model->get("users", null, ["phone" => $data["phone"], "id!=" => get_active_user()->id]))) :
                $alert["msg"] = lang("phoneExists");
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url(lang("routes_account")));
            endif;
            unset($data[$this->security->get_csrf_token_name()]);
            if ($this->general_model->update("users", ["id" => get_active_user()->id], $data)) :
                $alert = ["success" => true, "title" => lang("success"), "msg" => lang("updatedSuccessfully")];
                $this->session->set_flashdata("alert", $alert);
                $user = $this->general_model->get("users", null, ["email" => $data["email"], "phone" => $data["phone"]]);
                $this->session->set_userdata("user", $user);
                userRole();
            endif;
        endif;
        if (validation_errors()) :
            $alert["msg"] =  str_replace("<br />\n", "", nl2br(implode(",", array_filter(explode(",", validation_errors()), 'clean'))));
        endif;
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url(lang("routes_account")));
    }
}
