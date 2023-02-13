<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends MY_Controller
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
        $this->viewFolder = "products_v";
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
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================ PRODUCTS ================================= !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Products
     */
    public function index()
    {
        $search = null;
        if (!empty(clean($this->input->get("search")))) :
            $search = clean($this->input->get("search"));
        endif;
        $seo_url = $this->uri->segment(4);
        $collection_id = null;
        $collection = null;
        if (!empty($seo_url) && !is_numeric($seo_url)) :
            $collection = $this->general_model->get("product_collections", null, ["isActive" => 1, "lang" => $this->viewData->lang, "seo_url" => $seo_url]);
            if (!empty($collection)) :
                $collection_id = $collection->codes_id;
                $collection->seo_url = (!empty($collection->seo_url) ? $collection->seo_url : null);
                $collection->title = (!empty($collection->title) ? $collection->title : null);
            endif;
        endif;
        /**
         * Order
         */
        $order = "p.id DESC";
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 1) :
            $order = "p.id DESC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 2) :
            $order = "p.id ASC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 3) :
            $order = "p.title ASC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 4) :
            $order = "p.title DESC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 5) :
            $order = "(CASE WHEN discounted_price = NULL then  CAST(price as INT) ELSE CAST(discounted_price as INT) end) ASC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 6) :
            $order = "(CASE WHEN discounted_price = NULL then  CAST(price as INT) ELSE CAST(discounted_price as INT) end) DESC";
        endif;
        /**
         * Likes
         */
        $likes = [];
        if (!empty($search)) :
            $likes["p.title"] = $search;
            $likes["p.createdAt"] = $search;
            $likes["p.updatedAt"] = $search;
            $likes["pd.description"] = $search;
            $likes["pd.features"] = $search;
            $likes["pd.content"] = $search;
        endif;

        /**
         * Apply Filter
         */
        $whereIn = [];
        if (!empty($_GET["patternChecks"])) :
            $whereIn["p.pattern_id"] = array_map("intVal", explode(",", clean($_GET["patternChecks"])));
        endif;
        if (!empty($_GET["dimensionChecks"])) :
            $whereIn["p.dimension_id"] = array_map("intVal", explode(",", clean($_GET["dimensionChecks"])));
        endif;
        if (!empty($_GET["colorChecks"])) :
            $whereIn["p.color_id"] = array_map("intVal", explode(",", clean($_GET["colorChecks"])));
        endif;
        if (!empty($_GET["brandChecks"])) :
            $whereIn["p.brand_id"] = array_map("intVal", explode(",", clean($_GET["brandChecks"])));
        endif;
        /**
         * #Apply Filter
         */

        $wheres = [];
        if (!empty($collection_id)) :
            $wheres["p.collection_id"] = $collection_id;
        endif;
        /**
         * Wheres
         */
        $wheres["p.isActive"] = 1;
        $wheres["pi.isCover"] = 1;
        $wheres["p.lang"] = $this->viewData->lang;
        $joins = ["product_details pd" => ["pd.codes = p.codes_id AND pd.codes = p.codes", "left"], "product_collections pc" => ["p.collection_id = pc.id", "left"], "product_images pi" => ["pi.codes_id = p.codes_id AND pi.codes = p.codes", "left"]];

        $select = "p.codes_id,p.codes,p.price,p.discounted_price,p.id,p.title,p.seo_url,pi.url img_url,p.isActive";
        $distinct = true;
        $groupBy = ["p.id"];
        /**
         * Pagination
         */
        $config = [];
        $config['base_url'] = (!empty($seo_url) && !is_numeric($seo_url) ? base_url(lang("routes_product_collections") . "/" . $this->uri->segment(3) . "/{$seo_url}/") : base_url(lang("routes_product_collections") . "/" . $this->uri->segment(3) . "/"));
        $config['uri_segment'] = (!empty($seo_url) && !is_numeric($seo_url) && !empty($this->uri->segment(5)) ? 5 : (is_numeric($this->uri->segment(4)) ? 4 : 2));
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
        $config['total_rows'] = $this->general_model->rowCount("products p", $wheres, $likes, $joins, $whereIn, $distinct, $groupBy, "p.id");
        $config['per_page'] = 24;
        $config["num_links"] = 5;
        $config['reuse_query_string'] = true;
        $this->pagination->initialize($config);
        if (!empty($seo_url) && !is_numeric($seo_url)) :
            $uri_segment = $this->uri->segment(5);
        elseif (!empty($this->uri->segment(4)) && is_numeric($this->uri->segment(4))) :
            $uri_segment = $this->uri->segment(4);
        else :
            $uri_segment = $this->uri->segment(4);
        endif;
        if (empty($uri_segment)) :
            $uri_segment = 1;
        endif;
        $offset = (!empty($uri_segment) ? $uri_segment - 1 : 0) * $config['per_page'];
        $this->viewData->offset = $offset;
        $this->viewData->per_page = $config['per_page'];
        $this->viewData->total_rows = $config['total_rows'];
        $this->viewData->products_collection = $collection;
        /**
         * Get All Collections
         */
        $this->viewData->collections = $this->general_model->get_all("product_collections", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        /** 
         * Get Product Patterns
         */
        $this->viewData->product_patterns = $this->general_model->get_all("products p", "pattern_id,pattern", "pattern ASC", $wheres, [], $joins, [], [],  $distinct, "pattern");
        /** 
         * Get Product Colors
         */
        $this->viewData->product_colors = $this->general_model->get_all("products p", "color_id,color", "color ASC", $wheres, [], $joins, [], [],  $distinct, "color");
        /** 
         * Get Product Dimensions
         */
        $this->viewData->product_dimensions = $this->general_model->get_all("products p", "dimension_id,dimension", "dimension ASC", $wheres, [], $joins, [], [],  $distinct, "dimension");
        /** 
         * Get Product Brands
         */
        $this->viewData->product_brands = $this->general_model->get_all("products p", "brand_id,brand", "brand ASC", $wheres, [], $joins, [], [],  $distinct, "brand");
        /** 
         * Get Products
         */
        $this->viewData->products = $this->general_model->get_all("products p", $select, $order, $wheres, $likes, $joins, [$config["per_page"], $offset], $whereIn, $distinct, $groupBy);
        /**
         * Meta
         */
        $this->viewData->page_title = (!empty($collection) ? $collection->title : lang("products"));
        $this->viewData->meta_title = strto("lower|ucwords", (!empty($collection) ? $collection->title : lang("products"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));
        $this->viewData->og_url                 = clean(base_url(lang("routes_product_collections")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "product";
        $this->viewData->og_title           = strto("lower|ucwords", (!empty($collection) ? $collection->title : lang("products"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->viewData->links = $this->pagination->create_links();
        $this->viewFolder = "products_v/index";
        $this->render();
        //$this->output->enable_profiler(true); // OPEN FOR PERFORMANCE
        //$this->benchmark->mark('code_end');
        //echo $this->benchmark->elapsed_time('code_start','code_end');
    }
    /**
     * Product Detail
     */
    public function product_detail($codes, $seo_url)
    {
        $wheres["p.isActive"] = 1;
        $wheres["pi.isCover"] = 1;
        $wheres["p.lang"] = $this->viewData->lang;
        $joins = ["product_collections pc" => ["p.collection_id = pc.codes_id", "left"], "product_images pi" => ["pi.codes_id = p.codes_id AND pi.codes = p.codes", "left"], "product_details pd" => ["pd.codes_id = p.codes_id AND pd.codes = p.codes", "left"]];
        $select = "p.pattern_id,p.pattern,p.color_id,p.color,p.dimension_id,p.dimension,p.brand_id,p.brand,p.collection_id,p.collection,p.barcode,p.stock,pc.title collection_title,pc.codes_id collection_codes,pc.seo_url collection_seo_url,p.price,p.discounted_price,p.codes_id,p.codes,p.id,p.title,p.seo_url,pi.url img_url,pd.description,pd.content,pd.features,p.isActive";
        $distinct = true;
        $groupBy = ["p.id"];
        $wheres['p.seo_url'] =  $seo_url;
        $wheres['p.codes'] =  $codes;
        /**
         * Get Product Detail
         */
        $this->viewData->product = $this->general_model->get("products p", $select, $wheres, $joins, [], [], $distinct, $groupBy);

        if (!empty($this->viewData->product)) :
            /**
             * Get All Collections
             */
            $this->viewData->collections = $this->general_model->get_all("product_collections", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
            /**
             * Get Product Images
             */
            $this->viewData->product_own_images = $this->general_model->get_all("product_images", null, "isCover DESC,rank ASC", ["isActive" => 1, "codes_id" => $this->viewData->product->codes_id, "codes" => $this->viewData->product->codes, "lang" => $this->viewData->lang]);
            $imgURL = null;
            if (!empty($this->viewData->product_own_images)) :
                foreach ($this->viewData->product_own_images as $key => $value) :
                    if ($value->isCover) :
                        $imgURL = $value->url;
                    endif;
                endforeach;
            endif;
            /**
             * Get All Cover Product Images
             */
            $this->viewData->product_images = $this->general_model->get_all("product_images", null, "rank ASC", ["isActive" => 1, "isCover" => 1, "lang" => $this->viewData->lang]);
            /** 
             * Get Same Products
             */
            if (!empty($this->viewData->product)) :
                unset($wheres['p.seo_url']);
                $wheres["p.collection_id"] = $this->viewData->product->collection_id;
                $wheres["p.codes_id !="] = $this->viewData->product->codes_id;
                $wheres["p.codes"] = $this->viewData->product->codes;
                $this->viewData->same_products = $this->general_model->get_all("products p", $select, "rand()", $wheres, [], $joins, [12], [], $distinct, $groupBy);
            endif;
            /**
             * Meta
             */
            $this->viewData->meta_title = strto("lower|ucwords", $this->viewData->product->title) . " - " . $this->viewData->settings->company_name;
            $this->viewData->meta_desc  = !empty($this->viewData->product->content) ? str_replace("”", "\"", @stripslashes($this->viewData->product->content)) : str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));
            $this->viewData->og_url                 = clean(base_url(lang("routes_product_collections") . "/" . lang("routes_product") . "/" . $seo_url));
            $this->viewData->og_image           = clean(get_picture("products_v", $imgURL));
            $this->viewData->og_type          = "product.item";
            $this->viewData->og_title           = strto("lower|ucwords", $this->viewData->product->title) . " - " . $this->viewData->settings->company_name;
            $this->viewData->og_description           = clean(str_replace("”", "\"", @stripslashes($this->viewData->product->content)));
            $this->viewFolder = "product_detail_v/index";
        else :
            $this->viewFolder = "404_v/index";
        endif;
        $this->render();
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================ PRODUCTS ================================= !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
}
