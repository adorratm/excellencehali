<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
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
        $this->viewFolder = "login_v";
    }
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */

    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== LOGIN ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Login Form
     */
    public function login_form()
    {
        if (get_active_user()) :
            redirect(base_url());
        endif;
        $this->viewFolder = "login_v/index";
        $this->viewData->page_title = clean(strto("lower|ucwords", lang("dealerLogin")));
        $this->viewData->meta_title = clean(strto("lower|ucwords", lang("dealerLogin"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", stripslashes($this->viewData->settings->meta_description));
        $this->viewData->og_url                 = clean(base_url(lang("routes_dealer-login")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "article";
        $this->viewData->og_title           = clean(strto("lower|ucwords", lang("dealerLogin"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->render();
    }
    /**
     * Login
     */
    public function login()
    {
        if (get_active_user()) :
            redirect(base_url());
        endif;
        $this->form_validation->set_rules("email", lang("email"), "required|trim|valid_email");
        $this->form_validation->set_rules("password", lang("password"), "required|trim|min_length[6]");
        $this->form_validation->set_message(["required"  => lang("required"), "valid_email" => lang("valid_email"), "min_length" => lang("min_length"),]);
        $this->form_validation->set_error_delimiters('', ',');
        $alert = [
            "title" => lang("error"),
            "msg" => lang("errorOnLogin"),
            "type" => "error"
        ];
        if ($this->form_validation->run()) :
            $data = rClean($_POST);
            // Create md5 password
            $data["password"] = mb_substr(sha1(md5($data["password"])), 0, 32);
            $user = $this->general_model->get("users", null, ["email" => $data["email"], "password" => $data["password"]]);
            if (!empty($user)) :
                if ($user->isActive) :
                    if ($data["rememberme"]) :
                        set_cookie("email", $data["email"], 3600 * 24 * 30);
                        set_cookie("password", base64_encode(clean($_POST["password"])), 3600 * 24 * 30);
                        set_cookie("rememberme", $data["rememberme"], 3600 * 24 * 30);
                    endif;
                    if (!$data["rememberme"]) :
                        delete_cookie("email");
                        delete_cookie("password");
                        delete_cookie("rememberme");
                    endif;
                    $this->session->set_userdata("user", $user);
                    userRole();
                    $alert = ["success" => true, "title" => lang("success"), "msg" => lang("welcomeMessage") . " <b>" . $user->first_name . " " . $user->last_name . "</b>"];
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url());
                endif;
                $alert["msg"] = lang("errorOnLoginActivation");
            endif;
            $alert["msg"] = lang("errorOnLogin");
        endif;
        if (validation_errors()) :
            $alert["msg"] =  str_replace("<br />\n", "", nl2br(implode(",", array_filter(explode(",", validation_errors()), 'clean'))));
        endif;
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url(lang("routes_dealer-login")));
    }
    /**
     * Register Form
     */
    public function register_form()
    {
        if (get_active_user()) :
            redirect(base_url());
        endif;
        $this->viewFolder = "register_v/index";
        $this->viewData->page_title = clean(strto("lower|ucwords", lang("dealerRegister")));
        $this->viewData->meta_title = clean(strto("lower|ucwords", lang("dealerRegister"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", stripslashes($this->viewData->settings->meta_description));
        $this->viewData->og_url                 = clean(base_url(lang("routes_dealer-register")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "article";
        $this->viewData->og_title           = clean(strto("lower|ucwords", lang("dealerRegister"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->render();
    }
    /**
     * Register
     */
    public function register()
    {
        if (get_active_user()) :
            redirect(base_url());
        endif;
        $this->form_validation->set_rules("email", lang("email"), "required|trim|valid_email");
        $this->form_validation->set_rules("phone", lang("phone"), "required|trim|min_length[11]|max_length[20]");
        $this->form_validation->set_rules("company_name", lang("phone"), "required|trim|min_length[2]|max_length[255]");
        $this->form_validation->set_rules("tax_number", lang("tax_number"), "required|trim|min_length[10]|max_length[11]");
        $this->form_validation->set_rules("tax_administration", lang("tax_administration"), "required|trim|min_length[2]|max_length[255]");
        $this->form_validation->set_rules("address", lang("address"), "required|trim|min_length[2]");
        $this->form_validation->set_rules("password", lang("password"), "required|trim|min_length[6]");
        $this->form_validation->set_rules("passwordRepeat", lang("passwordRepeat"), "required|trim|min_length[6]");
        $this->form_validation->set_message(["required"  => lang("required"), "valid_email" => lang("valid_email"), "min_length" => lang("min_length"),]);
        $alert = [
            "title" => lang("error"),
            "msg" => lang("errorOnRegister"),
            "type" => "error"
        ];
        if ($this->form_validation->run()) :
            $data = rClean($_POST);
            if ($data["password"] !== $data["passwordRepeat"]) :
                $alert["msg"] = lang("samePassword");
                redirect(base_url(lang("routes_dealer-register")));
            endif;
            if (!empty($this->general_model->get("users", null, ["email" => $data["email"]]))) :
                $alert["msg"] = lang("emailExists");
                redirect(base_url(lang("routes_dealer-register")));
            endif;
            if (!empty($this->general_model->get("users", null, ["phone" => $data["phone"]]))) :
                $alert["msg"] = lang("phoneExists");
                redirect(base_url(lang("routes_dealer-register")));
            endif;
            // Unset passwordRepeat
            unset($data["passwordRepeat"]);
            // Create md5 password
            $data["password"] = mb_substr(sha1(md5($data["password"])), 0, 32);
            $data["token"] = random_string('alnum', 255);
            $data["phone"] = str_replace(" ", "", $data["phone"]);
            unset($data[$this->security->get_csrf_token_name()]);
            if ($this->general_model->add("users", $data)) :
                $alert = ["success" => true, "title" => lang("success"), "msg" => lang("registerSuccessfully")];
                $activationLink = "<a href='" . base_url(lang("routes_activation") . "/?email=" . $data["email"] . "&phone=" . $data["phone"] . "&token=" . $data["token"]) . "' rel='dofollow' target='_blank'>" . lang("activationLinkText") . "</a>";
                $message = lang("registerEmailMessage") . $activationLink;
                $message = $this->load->view("includes/simple_mail_template", ["settings" => get_settings(), "subject" => $this->viewData->settings->company_name . " " . lang("registerMailTitle"), "message" => $message, "lang" => $this->viewData->lang], true);
                send_emailv2([], $this->viewData->settings->company_name . " " . lang("registerMailTitle"), $message, [], $this->viewData->lang);
            endif;
        endif;
        if (validation_errors()) :
            $alert["msg"] =  str_replace("<br />\n", "", nl2br(implode(",", array_filter(explode(",", validation_errors()), 'clean'))));
        endif;
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url(lang("routes_dealer-register")));
    }
    /**
     * Forgot Password Form
     */
    public function forgot_password_form()
    {
        if (get_active_user()) :
            redirect(base_url());
        endif;
        $this->viewFolder = "forgot_password_v/index";
        $this->viewData->page_title = clean(strto("lower|ucwords", lang("forgotPassword")));
        $this->viewData->meta_title = clean(strto("lower|ucwords", lang("forgotPassword"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", stripslashes($this->viewData->settings->meta_description));
        $this->viewData->og_url                 = clean(base_url(lang("routes_forgot-password")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "article";
        $this->viewData->og_title           = clean(strto("lower|ucwords", lang("forgotPassword"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->render();
    }
    /**
     * Forgot Password
     */
    public function forgot_password()
    {
        if (get_active_user()) :
            redirect(base_url());
        endif;

        if (!empty($_POST["email"]) && empty($_POST["token"])) :
            $this->form_validation->set_rules("email", lang("email"), "required|trim|valid_email");
            $this->form_validation->set_message(["required"  => lang("required"), "valid_email" => lang("valid_email"), "min_length" => lang("min_length"),]);
            $alert = ["success" => false, "title" => lang("error"), "msg" => lang("errorOnForgotPassword")];
            if ($this->form_validation->run()) :
                $data = rClean($_POST);
                $user = $this->general_model->get("users", null, ["isActive" => 1, "email" => $data["email"]]);
                if (!empty($user)) :
                    $data["token"] = random_string('alnum', 255);
                    $message = "<a href='" . base_url(lang("routes_forgot-password-reset") . "?email=" . $user->email . "&phone=" . $user->phone . "&token=" . $data["token"]) . "' rel='dofollow' target='_blank'>" . lang("resetLinkText") . "</a>";
                    $message = $this->load->view("includes/simple_mail_template", ["settings" => get_settings(), "subject" => $this->viewData->settings->company_name . " " . lang("forgotMailTitle"), "message" => $message, "lang" => $this->viewData->lang], true);
                    if (send_emailv2([$data["email"]], $this->viewData->settings->company_name . " " . lang("forgotMailTitle"), $message, [], $this->viewData->lang)) :
                        $this->general_model->update("users", ["email" => $data["email"]], ["token" => $data["token"]]);
                        $alert = ["success" => true, "title" => lang("success"), "msg" => lang("resetMailSuccessfully")];
                        $this->session->set_flashdata("alert", $alert);
                        redirect(base_url(lang("routes_dealer-login")));
                    endif;
                endif;
            endif;
            if (validation_errors()) :
                $alert["msg"] =  str_replace("<br />\n", "", nl2br(implode(",", array_filter(explode(",", validation_errors()), 'clean'))));
            endif;
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url(lang("routes_forgot-password")));
        endif;
        if (!empty($_POST["token"]) && !empty($_POST["password"] && !empty($_POST["email"]) && !empty($_POST["passwordRepeat"]) && !empty($_POST["phone"]))) :
            $data = rClean($_POST);
            $user = $this->general_model->get("users", null, ["isActive" => 1, "email" => $data["email"], "token" => $_POST["token"]]);
            if (!empty($user)) :
                if ($data["password"] === $data["passwordRepeat"]) :
                    $data["password"] = mb_substr(sha1(md5($data["password"])), 0, 32);
                    if ($this->general_model->update("users", ["token" => $data["token"], "email" => $data["email"], "phone" => $data["phone"]], ["password" => $data["password"], "token" => random_string("alnum", 255)])) :
                        $this->session->set_flashdata("alert", ["success" => true, "title" => lang("success"), "msg" => lang("resetSuccessfully")]);
                        redirect(base_url(lang("routes_dealer-login")));
                    else :
                        $this->session->set_flashdata("alert", ["success" => false, "title" => lang("error"), "msg" => lang("errorOnForgotPassword")]);
                        redirect(base_url(lang("routes_forgot-password")));
                    endif;
                else :
                    $this->session->set_flashdata("alert", ["success" => false, "title" => lang("error"), "msg" => lang("samePassword")]);
                    redirect(base_url(lang("routes_forgot-password-reset") . "?email=" . $data["email"] . "&phone=" . $data["phone"] . "&token=" . $data["token"]));
                endif;
            else :
                $this->session->set_flashdata("alert", ["success" => false, "title" => lang("error"), "msg" => lang("errorOnForgotPassword")]);
                redirect(base_url(lang("routes_forgot-password")));
            endif;
        endif;

        $this->viewFolder = "forgot_password_reset_v/index";
        $this->viewData->page_title = clean(strto("lower|ucwords", lang("forgotPassword")));
        $this->viewData->meta_title = clean(strto("lower|ucwords", lang("forgotPassword"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", stripslashes($this->viewData->settings->meta_description));
        $this->viewData->og_url                 = clean(base_url(lang("routes_forgot-password")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "article";
        $this->viewData->og_title           = clean(strto("lower|ucwords", lang("forgotPassword"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->render();
    }
    /**
     * Activation
     */
    public function activation()
    {
        if (!get_active_user() || get_active_user()->role_id != 1) :
            redirect(base_url());
        endif;
        $alert = ["success" => false, "title" => lang("error"), "msg" => lang("errorOnActivation")];
        if (!empty($_GET["email"]) && !empty($_GET["phone"]) && !empty($_GET["token"])) :
            $getUser = $this->general_model->get("users", null, ["isActive" => 0, "email" => clean($_GET["email"]), "phone" => clean($_GET["phone"]), "token" => clean($_GET["token"])]);
            if (!empty($getUser)) :
                if ($this->general_model->update("users", ["id" => $getUser->id], ["isActive" => 1, "token" => random_string("alnum", 255)])) :
                    $message = lang("activationEmailMessage");
                    $message = $this->load->view("includes/simple_mail_template", ["settings" => get_settings(), "subject" => $this->viewData->settings->company_name . " " . lang("activationMailTitle"), "message" => $message, "lang" => $this->viewData->lang], true);
                    send_emailv2([$getUser->email], $this->viewData->settings->company_name . " " . lang("activationMailTitle"), $message, [], $this->viewData->lang);
                    $alert  = ["success" => true, "title" => lang("success"), "msg" => lang("activatedSuccessfully")];
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url());
                endif;
            endif;
            $alert["msg"] = lang("errorOnActivationLink");
        endif;
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url());
    }
    /**
     * Logout
     */
    public function logout()
    {
        if (!get_active_user()) :
            redirect(base_url());
        endif;
        $this->session->unset_userdata("user");
        $this->session->unset_userdata("user_roles");
        $this->session->set_flashdata("alert", ["success" => true, "title" => lang("success"), "msg" => lang("logoutSuccessfully")]);
        redirect(base_url());
    }
}
