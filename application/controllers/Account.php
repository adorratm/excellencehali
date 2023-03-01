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
            redirect(base_url(lang("routes_dealer-login")));
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
            redirect(base_url(lang("routes_dealer-login")));
        endif;
        $this->form_validation->set_rules("email", lang("email"), "required|trim|valid_email|xss_clean");
        if (!empty(clean($_POST["password"]))) :
            $this->form_validation->set_rules("password", lang("password"), "required|trim|min_length[6]|xss_clean");
            $this->form_validation->set_rules("passwordRepeat", lang("passwordRepeat"), "required|trim|min_length[6]|matches[password]|xss_clean");
        endif;
        $this->form_validation->set_message(["required"  => lang("required"), "valid_email" => lang("valid_email"), "min_length" => lang("min_length"), "matches" => lang("matches")]);
        $this->form_validation->set_error_delimiters('', ',');
        $alert = [
            "title" => lang("error"),
            "message" => lang("errorOnUpdate"),
            "type" => "error"
        ];
        if ($this->form_validation->run()) :
            $data = rClean($_POST);
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
                $alert["message"] = lang("emailExists");
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url(lang("routes_account")));
            endif;
            if (!empty($this->general_model->get("users", null, ["phone" => $data["phone"], "id!=" => get_active_user()->id]))) :
                $alert["message"] = lang("phoneExists");
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url(lang("routes_account")));
            endif;
            unset($data[$this->security->get_csrf_token_name()]);
            if ($this->general_model->update("users", ["id" => get_active_user()->id], $data)) :
                $alert = ["success" => true, "title" => lang("success"), "message" => lang("updatedSuccessfully")];
                $this->session->set_flashdata("alert", $alert);
                $user = $this->general_model->get("users", null, ["email" => $data["email"], "phone" => $data["phone"]]);
                $this->session->set_userdata("user", $user);
                userRole();
            endif;
        endif;
        if (validation_errors()) :
            $alert["message"] =  str_replace("<br />\n", "", nl2br(implode(",", array_filter(explode(",", validation_errors()), 'clean'))));
        endif;
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url(lang("routes_account")));
    }

    public function orders()
    {
        if (!get_active_user()) :
            redirect(base_url(lang("routes_dealer-login")));
        endif;
        $this->viewFolder = "account_v/orders";
        $this->viewData->orders = $this->general_model->get_all("orders", null, "id DESC", ["user_id" => get_active_user()->id]);

        $this->viewData->page_title = clean(strto("lower|ucwords", lang("orders")));
        $this->viewData->meta_title = clean(strto("lower|ucwords", lang("orders"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", stripslashes($this->viewData->settings->meta_description));
        $this->viewData->og_url                 = clean(base_url(lang("routes_account-orders")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "article";
        $this->viewData->og_title           = clean(strto("lower|ucwords", lang("orders"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->render();
    }

    public function order_detail($order_code = null)
    {
        $alert = [
            "success" => false,
            "title" => lang("error"),
            "message" => lang("order_code_not_found")
        ];
        if (!get_active_user()) :
            $alert["message"] = lang("loginFirst");
            echo json_encode($alert);
            return;
        endif;
        if (empty($order_code)) :
            echo json_encode($alert);
            return;
        endif;
        if (!empty($order_code)) :
            $order = $this->general_model->get("orders", null, ["order_code" => $order_code, "user_id" => get_active_user()->id]);
            if (empty($order)) :
                echo json_encode($alert);
                return;
            endif;
            $order_products = $this->general_model->get_all("order_products", null, null, ["order_id" => $order->id]);
            $this->viewData->order = $order;
            $this->viewData->order_products = $order_products;
            $alert["success"] = true;
            $alert["title"] = lang("success");
            $alert["message"] = lang("order_detail");
            $alert["data"] = $this->load->view("includes/orderDetail", (array)$this->viewData, true);
            echo json_encode($alert);
            return;
        endif;
    }

    public function cancel_order($order_code = null)
    {
        $alert = [
            "success" => false,
            "title" => lang("error"),
            "message" => lang("order_code_not_found")
        ];
        if (!get_active_user()) :
            $alert["message"] = lang("loginFirst");
            echo json_encode($alert);
            return;
        endif;
        if (empty($order_code)) :
            echo json_encode($alert);
            return;
        endif;
        if (!empty($order_code)) :
            $order = $this->general_model->get("orders", null, ["order_code" => $order_code, "user_id" => get_active_user()->id]);
            if (empty($order)) :
                echo json_encode($alert);
                return;
            endif;
            if ($order->status != 1 || strtotime("+30 minutes", strtotime($order->createdAt)) <= strtotime("now")) :
                $alert["message"] = lang("order_cannot_be_canceled");
                echo json_encode($alert);
                return;
            endif;
            if ($order->status == 1 && strtotime("+30 minutes", strtotime($order->createdAt)) >= strtotime("now")) :
                $this->general_model->update("orders", ["order_code" => $order->order_code], ["status" => 0, "statusMessage" => lang("Siparişiniz İptal Edildi.")]);
                $this->viewData->order_data = (array)$order;
                $this->viewData->order_products = $this->general_model->get_all("order_products", null, null, ["order_id" => $order->id]);
                $this->viewData->subject = $this->viewData->settings->company_name . " - " . lang("Siparişiniz İptal Edildi.");
                $mailViewData = $this->load->view("includes/mail_template", (array)$this->viewData, true);
                if (@send_emailv2([$this->viewData->user->email], $this->viewData->subject, $mailViewData)) :
                    /**
                     * Send To Admin
                     */
                    $this->viewData->subject = $this->viewData->settings->company_name . " - " . lang("order_canceled");
                    $this->viewData->message = 'Merhaba Sayın Yetkili, "<b>' . $this->viewData->user->first_name . " " . $this->viewData->user->last_name . ' (Email: <a href="mailto:' . $this->viewData->user->email . '">' . $this->viewData->user->email . '</a> - Telefon: <a href="tel:' . $this->viewData->user->phone . '">' . $this->viewData->user->phone . '</a>)</b> İsimli Müşteri Websiteniz Üzerinden <b>' . $this->viewData->order_data["total"] . " " . $this->viewData->symbol . '</b> Tutarındaki Siparişini İptal Etti. Sipariş Kodu: <b>' . $this->viewData->order_data["order_code"].'</b>';
                    $mailViewData = $this->load->view("includes/mail_template", (array)$this->viewData, true);
                    @send_emailv2(null, $this->viewData->subject, $mailViewData);
                endif;
                $alert["success"] = true;
                $alert["title"] = lang("success");
                $alert["message"] = lang("Siparişiniz İptal Edildi.");
            endif;
            echo json_encode($alert);
            return;
        endif;
    }
}
