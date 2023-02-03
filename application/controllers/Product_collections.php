<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_collections extends MY_Controller
{
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! =============================== VARIABLES =============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */
    /**
     * Variables
     */
    public $viewFolder = "";
    public $viewData = "";
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! =============================== VARIABLES =============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */
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
        $this->viewData = new stdClass();
        /**
         * Sitemap
         */
        $this->viewData->page_urls = [];
        $this->viewData->lang = (!empty($this->uri->segment(1) && mb_strlen($this->uri->segment(1)) == 2) ? $this->uri->segment(1) : (!empty(get_cookie("lang")) ? get_cookie("lang") : "tr"));
        $this->viewData->settings = $this->general_model->get("settings", null, ["isActive" => 1, "lang" => $this->viewData->lang]);
        $allLanguages = $this->general_model->get_all("settings", null, "rank ASC", ["isActive" => 1]);
        $languages = [];
        if (!empty($allLanguages)) :
            foreach ($allLanguages as $key => $value) :
                array_push($languages, $value->lang);
            endforeach;
        endif;
        $locales = $this->general_model->get("languages", null, ["code" => strto("lower", $this->viewData->lang)]);
        setlocale(LC_ALL, $locales->code . "_" . (strto("lower|upper", $locales->code)));
        $currency = $this->general_model->get("countries", null, ["code" => strto("lower|upper", $this->viewData->lang)]);
        $this->viewData->currency = $currency->currency_code;
        $this->viewData->formatter = new NumberFormatter($locales->code, NumberFormatter::CURRENCY);
        $this->viewData->dateFormatter = new IntlDateFormatter($locales->code . "_" . (strto("lower|upper", ($locales->code == "en" ? "US" : $locales->code))), IntlDateFormatter::LONG, IntlDateFormatter::SHORT);
        $formattedValue = $this->viewData->formatter->formatCurrency(0, $this->viewData->currency);
        $this->viewData->symbol = trim(str_replace('0,00', '', str_replace('0.00', '', $formattedValue)));
        $this->viewData->menus = show_tree('HEADER', $this->viewData->lang);
        //$this->viewData->mobileMenus = show_tree('MOBILE', $this->viewData->lang);
        //$this->viewData->rightMenus = show_tree('HEADER_RIGHT', $this->viewData->lang);
        $this->viewData->footer_menus = show_tree('FOOTER', $this->viewData->lang);
        $this->viewData->footer_menus2 = show_tree('FOOTER2', $this->viewData->lang);
        $this->viewData->footer_menus3 = show_tree('FOOTER3', $this->viewData->lang);
        $this->viewData->languages = $languages;
        /**
         * Get User Data
         */
        $this->viewData->user = get_active_user() ?? [];
        /**
         * Pages
         */
        $this->viewData->pages = $this->general_model->get_all("pages", null, "rank ASC", ["isActive" => 1]);
        $this->cart->product_name_safe = FALSE;
        $this->ci_minifier->set_domparser(2);
        $this->ci_minifier->init(1);
    }
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */
    /**
     * ----------------------------------------------------------------------------------------------
     * ...:::!!! ================================= RENDER ================================= !!!:::...
     * ----------------------------------------------------------------------------------------------
     */
    /**
     * Render
     */
    public function render()
    {
        //$this->benchmark->mark('head_start');
        $this->load->view("includes/head", (array)$this->viewData);
        //$this->benchmark->mark('head_end');
        //$this->benchmark->mark('header_start');
        $this->load->view("includes/header");
        //$this->benchmark->mark('header_end');
        //$this->benchmark->mark('content_start');
        $this->load->view($this->viewFolder);
        //$this->benchmark->mark('content_end');
        //$this->benchmark->mark('footer_start');
        $this->load->view("includes/footer");
        //$this->benchmark->mark('footer_end');
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================= RENDER ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
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
        $this->viewData->page_title = (!empty($collection) ? $collection->title : lang("product_collections"));
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

    /**
     * -------------------------------------------------------------------------------------------------
     * ...:::!!! ============================ PRODUCT COLLECTIONS ============================ !!!:::...
     * -------------------------------------------------------------------------------------------------
     */
}
