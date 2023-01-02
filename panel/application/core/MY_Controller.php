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
    }
}
