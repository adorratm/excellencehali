<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $lang = (!empty($this->uri->segment(1)) && mb_strlen($this->uri->segment(1)) == 2 ? $this->uri->segment(1) : null);
        if (empty(get_cookie("lang", true)) || !isset($_COOKIE["lang"])) :
            set_cookie("lang", "tr", strtotime("+1 Year"));
            $lang = "tr";
        endif;
        if (empty($lang)) :
            $lang = (!empty(get_cookie("lang")) ? get_cookie("lang") : "tr");
        endif;
        /**
         * Load Lang File
         */
        if (file_exists(dirname(APPPATH, 1) . '/panel/application/language/' . $lang)) :
            $this->lang->load($lang, $lang, FALSE, TRUE, dirname(APPPATH, 1) . '/panel/application/');
            if (empty($this->uri->segment(1))) :
                redirect(base_url());
            endif;
        else:
            redirect(base_url("404"));
        endif;
        
    }
}
