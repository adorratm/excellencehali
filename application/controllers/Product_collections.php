<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_collections extends MY_Controller
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
        $this->viewFolder = "product_collections_v";
    }
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */

    /**
     * ------------------------------------------------------------------------------------------------
     * ...:::!!! =========================== PRODUCT COLLECTIONS ============================ !!!:::...
     * ------------------------------------------------------------------------------------------------
     */

    public function index()
    {
        $search = null;
        if (!empty(clean($this->input->get("search")))) :
            $search = clean($this->input->get("search"));
        endif;
        /**
         * Order
         */
        $order = "pc.id DESC";
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 1) :
            $order = "pc.id DESC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 2) :
            $order = "pc.id ASC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 3) :
            $order = "pc.title ASC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 4) :
            $order = "pc.title DESC";
        endif;
        /**
         * Likes
         */
        $likes = [];
        if (!empty(clean($search))) :
            $likes["pc.title"] = clean($search);
            $likes["pc.codes_id"] = clean($search);
            $likes["pc.createdAt"] = clean($search);
            $likes["pc.updatedAt"] = clean($search);
        endif;
        $wheres = [];
        /**
         * Wheres
         */
        $wheres["pc.isActive"] = 1;

        $wheres["pc.lang"] = $this->viewData->lang;
        $joins = [];

        $select = "pc.codes_id,pc.codes,pc.id,pc.title,pc.seo_url,pc.img_url,pc.isActive";
        $distinct = true;
        $groupBy = ["pc.id"];
        /**
         * Pagination
         */
        $config = [];
        $config['base_url'] = base_url(lang("routes_product_collections") . "/");
        $config['uri_segment'] = (is_numeric($this->uri->segment(3)) ? 3 : 2);
        $config['use_page_numbers'] = TRUE;
        $config["full_tag_open"] = "<ul class='pagination justify-content-center'>";
        $config["first_link"] = "<i class='fa fa-angles-left'></i>";
        $config["first_tag_open"] = "<li class='page-item'>";
        $config["first_tag_close"] = "</li>";
        $config["prev_link"] = "<i class='fa fa-angle-left'></i>";
        $config["prev_tag_open"] = "<li class='page-item'>";
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='page-item active'><a class='page-link active' title='" . $this->viewData->settings->company_name . "' rel='dofollow' href='" . str_replace("tr/index.php/", "", current_url()) . "'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li class='page-item'>";
        $config["num_tag_close"] = "</li>";
        $config["next_link"] = "<i class='fa fa-angle-right'></i>";
        $config["next_tag_open"] = "<li class='page-item'>";
        $config["next_tag_close"] = "</li>";
        $config["last_link"] = "<i class='fa fa-angles-right'></i>";
        $config["last_tag_open"] = "<li class='page-item'>";
        $config["last_tag_close"] = "</li>";
        $config["full_tag_close"] = "</ul>";
        $config['attributes'] = array('class' => 'page-link');
        $config['total_rows'] = $this->general_model->rowCount("product_collections pc", $wheres, $likes, $joins, [], $distinct, $groupBy, "pc.id");
        $config['per_page'] = 24;
        $config["num_links"] = 5;
        $config['reuse_query_string'] = true;
        $this->pagination->initialize($config);
        if (!empty($this->uri->segment(3)) && is_numeric($this->uri->segment(3))) :
            $uri_segment = $this->uri->segment(3);
        else :
            $uri_segment = $this->uri->segment(3);
        endif;
        if (empty($uri_segment)) :
            $uri_segment = 1;
        endif;
        $offset = (!empty($uri_segment) ? $uri_segment - 1 : 0) * $config['per_page'];
        $this->viewData->offset = $offset;
        $this->viewData->per_page = $config['per_page'];
        $this->viewData->total_rows = $config['total_rows'];
        /** 
         * Get Products
         */
        $this->viewData->product_collections = $this->general_model->get_all("product_collections pc", $select, $order, $wheres, $likes, $joins, [$config["per_page"], $offset], [], $distinct, $groupBy);
        /**
         * Meta
         */
        $this->viewData->page_title = (!empty($collection) ? strto("lower|ucwords", $collection->title) : strto("lower|ucwords", lang("product_collections")));
        $this->viewData->meta_title = strto("lower|ucwords", (!empty($collection) ? $collection->title : lang("product_collections"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));
        $this->viewData->og_url                 = clean(base_url(lang("routes_product_collections")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "product.group";
        $this->viewData->og_title           = strto("lower|ucwords", (!empty($collection) ? $collection->title : lang("product_collections"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->viewData->links = $this->pagination->create_links();
        $this->viewFolder = "product_collections_v/index";
        $this->render();
        //$this->output->enable_profiler(true); // OPEN FOR PERFORMANCE
        //$this->benchmark->mark('code_end');
        //echo $this->benchmark->elapsed_time('code_start','code_end');
    }

    public function new()
    {
        $search = null;
        if (!empty(clean($this->input->get("search")))) :
            $search = clean($this->input->get("search"));
        endif;
        /**
         * Order
         */
        $order = "pc.codes ASC,pc.id DESC";
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 1) :
            $order = "pc.codes ASC,pc.id DESC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 2) :
            $order = "pc.codes ASC,pc.id ASC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 3) :
            $order = "pc.codes ASC,pc.title ASC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 4) :
            $order = "pc.codes ASC,pc.title DESC";
        endif;
        /**
         * Likes
         */
        $likes = [];
        if (!empty(clean($search))) :
            $likes["pc.title"] = clean($search);
            $likes["pc.codes_id"] = clean($search);
            $likes["pc.createdAt"] = clean($search);
            $likes["pc.updatedAt"] = clean($search);
        endif;
        $wheres = [];
        /**
         * Wheres
         */
        $wheres["pc.isActive"] = 1;

        $wheres["pc.lang"] = $this->viewData->lang;
        $joins = [];

        $select = "pc.codes_id,pc.codes,pc.id,pc.title,pc.seo_url,pc.img_url,pc.isActive";
        $distinct = true;
        $groupBy = ["pc.id"];
        /**
         * Pagination
         */
        $config = [];
        $config['base_url'] = base_url(lang("routes_product_collections") . "/");
        $config['uri_segment'] = (is_numeric($this->uri->segment(3)) ? 3 : 2);
        $config['use_page_numbers'] = TRUE;
        $config["full_tag_open"] = "<ul class='pagination justify-content-center'>";
        $config["first_link"] = "<i class='fa fa-angles-left'></i>";
        $config["first_tag_open"] = "<li class='page-item'>";
        $config["first_tag_close"] = "</li>";
        $config["prev_link"] = "<i class='fa fa-angle-left'></i>";
        $config["prev_tag_open"] = "<li class='page-item'>";
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='page-item active'><a class='page-link active' title='" . $this->viewData->settings->company_name . "' rel='dofollow' href='" . str_replace("tr/index.php/", "", current_url()) . "'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li class='page-item'>";
        $config["num_tag_close"] = "</li>";
        $config["next_link"] = "<i class='fa fa-angle-right'></i>";
        $config["next_tag_open"] = "<li class='page-item'>";
        $config["next_tag_close"] = "</li>";
        $config["last_link"] = "<i class='fa fa-angles-right'></i>";
        $config["last_tag_open"] = "<li class='page-item'>";
        $config["last_tag_close"] = "</li>";
        $config["full_tag_close"] = "</ul>";
        $config['attributes'] = array('class' => 'page-link');
        $config['total_rows'] = $this->general_model->rowCount("product_collections pc", $wheres, $likes, $joins, [], $distinct, $groupBy, "pc.id");
        $config['per_page'] = 24;
        $config["num_links"] = 5;
        $config['reuse_query_string'] = true;
        $this->pagination->initialize($config);
        if (!empty($this->uri->segment(3)) && is_numeric($this->uri->segment(3))) :
            $uri_segment = $this->uri->segment(3);
        else :
            $uri_segment = $this->uri->segment(3);
        endif;
        if (empty($uri_segment)) :
            $uri_segment = 1;
        endif;
        $offset = (!empty($uri_segment) ? $uri_segment - 1 : 0) * $config['per_page'];
        $this->viewData->offset = $offset;
        $this->viewData->per_page = $config['per_page'];
        $this->viewData->total_rows = $config['total_rows'];
        /** 
         * Get Products
         */
        $this->viewData->product_collections = $this->general_model->get_all("product_collections pc", $select, $order, $wheres, $likes, $joins, [$config["per_page"], $offset], [], $distinct, $groupBy);
        /**
         * Meta
         */
        $this->viewData->page_title = (!empty($collection) ? $collection->title : lang("new_product_collections"));
        $this->viewData->meta_title = strto("lower|ucwords", (!empty($collection) ? $collection->title : lang("new_product_collections"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));
        $this->viewData->og_url                 = clean(base_url(lang("routes_new_product_collections")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "product.group";
        $this->viewData->og_title           = strto("lower|ucwords", (!empty($collection) ? $collection->title : lang("new_product_collections"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->viewData->links = NULL;
        $this->viewFolder = "product_collections_v/index";
        $this->render();
        //$this->output->enable_profiler(true); // OPEN FOR PERFORMANCE
        //$this->benchmark->mark('code_end');
        //echo $this->benchmark->elapsed_time('code_start','code_end');
    }

    /**
     * -------------------------------------------------------------------------------------------------
     * ...:::!!! ============================ PRODUCT COLLECTIONS ============================ !!!:::...
     * -------------------------------------------------------------------------------------------------
     */
}
