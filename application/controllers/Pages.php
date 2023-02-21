<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends MY_Controller
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
        $this->viewFolder = "pages_v";
    }
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */

    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== PAGES ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Pages
     */
    public function index()
    {
        $seo_url = $this->uri->segment(3);
        $this->viewData->item = $this->general_model->get("pages", null, ["isActive" => 1, "lang" => $this->viewData->lang, 'url' =>  $seo_url]);
        $this->viewData->page_title = strto("lower|ucwords", $this->viewData->item->title);
        $this->viewData->meta_title = strto("lower|ucwords", $this->viewData->item->title) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = clean(str_replace("”", "\"", @stripslashes($this->viewData->item->content)));
        $this->viewData->og_url                 = clean(base_url(lang("routes_page") . "/" . $seo_url));
        $this->viewData->og_image           = clean(get_picture("pages_v", $this->viewData->item->img_url));
        $this->viewData->og_type          = "article";
        $this->viewData->og_title           = strto("lower|ucwords", $this->viewData->item->title) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean(str_replace("”", "\"", @stripslashes($this->viewData->item->content)));
        if (empty($this->viewData->item)) :
            $this->viewFolder = "404_v/index";
        else :
            $this->viewFolder = "pages_v/index";
        endif;
        $this->render();
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== PAGES ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
}
