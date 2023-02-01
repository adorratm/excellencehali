<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends MY_Controller
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
        $this->viewFolder = "pages_v";
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
         * Menu Categories
         */
        $this->viewData->menuCategories = $this->general_model->get_all("product_categories", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang], [], [], []);
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
