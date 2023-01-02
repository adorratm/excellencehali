<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userop extends CI_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "users_v";
        $this->load->model("user_model");
    }
    public function login()
    {
        if (get_active_user()) :
            redirect(base_url());
        endif;
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "login";
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function do_login()
    {
        if (get_active_user()) :
            redirect(base_url());
        endif;
        $this->form_validation->set_rules("user_email", "Kullanıcı Adı", "required|trim");
        $this->form_validation->set_rules("user_password", "Şifre", "required|trim|min_length[6]");
        $this->form_validation->set_message(
            [
                "required"  => "<b>{field}</b> alanı doldurulmalıdır!",
                "valid_email" => "Lütfen geçerli bir e-posta adresi giriniz!",
                "min_length" => "{field} en az 6 karakterden oluşmalıdır!"
            ]
        );
        $validate = $this->form_validation->run();
        if ($validate == FALSE) :
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "login";
            $viewData->form_error = true;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        else :
            $user = $this->user_model->get(
                [
                    "email" => $this->input->post("user_email"),
                    "password" => mb_substr(sha1(md5($this->input->post("user_password"))), 0, 32, "utf-8"),
                    "isActive" => 1,
                    "role_id" => 1
                ]
            );
            if (!empty($user)) :
                $alert = [
                    "title" => "İşlem Başarıyla Gerçekleşti.",
                    "text" => "$user->full_name Hoşgeldiniz...",
                    "type" => "success"
                ];
                $this->session->set_userdata("user", $user);
                userRole();
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url());
            else :
                $alert = [
                    "title" => "İşlem Başarısız!.",
                    "text" => "Lütfen giriş bilgilerinizi kontrol ediniz!",
                    "type" => "error"
                ];
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("login"));
            endif;
        endif;
    }
    public function logout()
    {
        $this->session->unset_userdata("user");
        redirect(base_url("login"));
    }
    public function forget_password()
    {
        if (get_active_user()) :
            redirect(base_url());
        endif;
        $viewData = new stdClass();
        $this->load->library("form_validation");
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "forget_password";
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function reset_password()
    {
        $this->form_validation->set_rules("email", "E-Posta", "required|trim|valid_email");
        $this->form_validation->set_message(
            [
                "required"  => "<b>{field}</b> alanı doldurulmalıdır!",
                "valid_email" => "Lütfen geçerli bir <b>e-posta</b> adresi giriniz!"
            ]
        );
        if ($this->form_validation->run() === FALSE) :
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "forget_password";
            $viewData->form_error = true;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        else :
            $user = $this->user_model->get(
                [
                    "isActive" => 1,
                    "email" => $this->input->post("email")
                ]
            );
            if (!empty($user)) :
                $temp_password = random_string();
                $send = send_emailv2($user->email, "Şifremi unuttum", "Sisteme geçiçi olarak <b>{$temp_password}</b> şifresiyle giriş yapabilirsiniz!");
                if (!empty($send)) :
                    echo "E-Posta başarılı bir şekilde gönderildi...";
                    $this->user_model->update(
                        [
                            "id" => $user->id
                        ],
                        [
                            "password" => mb_substr(sha1(md5($temp_password)), 0, 32, "utf-8")
                        ]
                    );
                    $alert = [
                        "title" => "İşlem Başarıyla Gerçekleşti...",
                        "text" => "Şifreniz başarılı bir şekilde resetlendi. Lütfen E-Postanızı kontrol ediniz...",
                        "type" => "success"
                    ];
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("login"));
                else :
                    //echo $this->email->print_debugger();
                    $alert = [
                        "title" => "İşlem Başarısız!.",
                        "text" => "E-Posta gönderilirken bir hata oluştu!",
                        "type" => "error"
                    ];
                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("sifremi-unuttum"));
                    die();
                endif;
            else :
                $alert = [
                    "title" => "İşlem Başarısız!.",
                    "text" => "Böyle bir kullanıcı bulunamadı!",
                    "type" => "error"
                ];
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("sifremi-unuttum"));
            endif;
        endif;
    }
}
