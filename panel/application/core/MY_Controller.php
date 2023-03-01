<?php
class MY_Controller extends CI_Controller{

    public function __construct(){
        parent::__construct();
        if (!isAllowedViewModule()):
            redirect(base_url());
        endif;
        $request= $this->uri->segment(2);
        if($request=="update_form" && !isAllowedUpdateViewModule()):
            redirect(base_url());
        endif;
        if($request=="new_form" && !isAllowedWriteViewModule()):
            redirect(base_url());
        endif;
        if($request=="delete" && !isAllowedDeleteViewModule()):
            redirect(base_url());
        endif;
        $lang = "tr";
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
        if (file_exists(dirname(APPPATH, 1) . '/application/language/' . $lang)) :
            $this->lang->load($lang, $lang, FALSE, TRUE, dirname(APPPATH, 1) . '/application/');
            if (empty($this->uri->segment(1))) :
                redirect(base_url());
            endif;
        else:
            redirect(base_url());
        endif;
    }
}
