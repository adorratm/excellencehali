<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
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
        $this->viewFolder = "home_v";
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
     * ...:::!!! ================================== INDEX ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Index
     */
    public function index()
    {

        /**
         * Slides
         */
        $this->viewData->slides = $this->general_model->get_all("slides", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        /**
         * Galleries
         */
        $this->viewData->gallery = $this->general_model->get("galleries", null, ["isActive" => 1, "lang" => $this->viewData->lang, "id" => 2]);
        if (!empty($this->viewData->gallery)) :
            $this->viewData->gallery_items = $this->general_model->get_all("video_urls", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang, "gallery_id" => $this->viewData->gallery->id]);
        endif;
        /**
         * Home Items
         */
        $this->viewData->homeitems = $this->general_model->get_all("home_items", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang], [], [], [4]);
        $this->viewData->homeitemsFooter = $this->general_model->get_all("home_items", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang], [], [], [4, 4]);
        /**
         * Instagram Posts
         */
        $this->viewData->instagramPosts = $this->general_model->get_all("instagram_posts", null, "id ASC");

        $this->viewData->meta_title = clean(strto("lower|ucwords", lang("home"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));

        $this->viewData->og_url                 = clean(base_url());
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "website";
        $this->viewData->og_title           = clean(strto("lower|ucwords", lang("home"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->viewFolder = "home_v/index";
        $this->render();
        //$this->output->enable_profiler(TRUE);
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== INDEX ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */ 
    
    
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================ LANGUAGE ================================= !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Change Language
     */
    public function switchLanguage()
    {
        if (!empty($this->input->post("lang"))) :
            $lang = $this->input->post("lang");
        else :
            $lang = "tr";
        endif;
        if (!empty(get_active_user())) :
            $this->general_model->update("users", ["id" => get_active_user()->id], ["lang" => $lang]);
        endif;
        set_cookie("lang", $lang, strtotime("+1 year"));
        redirect(base_url());
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================ LANGUAGE ================================= !!!:::...
     * -----------------------------------------------------------------------------------------------
     */

    /**
     * ------------------------------------------------------------------------------------------------
     * ...:::!!! ============================== SITEMAP MODULE ============================== !!!:::...
     * ------------------------------------------------------------------------------------------------
     */
    /**
     * Generate a sitemap index file
     * More information about sitemap indexes: http://www.sitemaps.org/protocol.html#index
     */
    public function sitemapindex()
    {
        $this->load->model("sitemapmodel");
        /**
         * Page URLs
         */
        if (!empty($this->viewData->page_urls)) :
            foreach (array_unique($this->viewData->page_urls) as $key => $value) :
                $this->sitemapmodel->add($value, NULL, 'always', 1);
            endforeach;
        endif;
        /**
         * Blog Categories
         */
        $blog_categories = $this->general_model->get_all("blog_categories", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        if (!empty($blog_categories)) :
            foreach ($blog_categories as $k => $v) :
                if (!empty($v->seo_url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_blog") . "/{$v->seo_url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Blogs
         */
        $blogs = $this->general_model->get_all("blogs", null, "id DESC", ['isActive' => 1, "lang" => $this->viewData->lang], [], [], []);
        if (!empty($blogs)) :
            foreach ($blogs as $k => $v) :
                if (!empty($v->seo_url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_blog") . "/" . lang("routes_blog_detail") . "/{$v->seo_url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Product Categories
         */
        $product_categories = $this->general_model->get_all("product_categories", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        if (!empty($product_categories)) :
            foreach ($product_categories as $k => $v) :
                if (!empty($v->seo_url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_product_categories") . "/{$v->seo_url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Products
         */
        $wheres["p.isActive"] = 1;
        $wheres["pi.isCover"] = 1;
        $wheres["p.lang"] = $this->viewData->lang;
        $joins = ["product_categories pc" => ["p.category_id = pc.id", "left"], "product_images pi" => ["pi.codes_id = p.codes_id AND pi.codes = p.codes", "left"]];
        $select = "p.id,p.title,p.seo_url,pi.url img_url";
        $distinct = true;
        $groupBy = ["p.id"];
        $products = $this->general_model->get_all("products p", $select, "p.id DESC", $wheres, [], $joins, [], [], $distinct, $groupBy);
        if (!empty($products)) :
            foreach ($products as $k => $v) :
                if (!empty($v->url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_product_categories") . "/" . lang("routes_product") . "/{$v->url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Slides
         */
        $slides = $this->general_model->get_all("slides", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        if (!empty($slides)) :
            foreach ($slides as $k => $v) :
                if (!empty($v->button_url)) :
                    $this->sitemapmodel->add($v->button_url, NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Galleries
         */
        $galleries = $this->general_model->get_all("galleries", null, "rank ASC", ["isActive" => 1, "isCover" => 0, "lang" => $this->viewData->lang], [], [], []);
        if (!empty($galleries)) :
            foreach ($galleries as $k => $v) :
                if (!empty($v->url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_galleries") . "/" . lang("routes_gallery") . "/{$v->url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        $this->sitemapmodel->output('sitemapindex');
    }
    /**
     * Generate a sitemap url file
     * More information about sitemap example xml: https://www.sitemaps.org/protocol.html#sitemapXmlExample
     */
    public function sitemap()
    {
        $this->load->model("sitemapmodel");
        /**
         * Page URLs
         */
        if (!empty($this->viewData->page_urls)) :
            foreach (array_unique($this->viewData->page_urls) as $key => $value) :
                $this->sitemapmodel->add($value, NULL, 'always', 1);
            endforeach;
        endif;
        /**
         * Blog Categories
         */
        $blog_categories = $this->general_model->get_all("blog_categories", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        if (!empty($blog_categories)) :
            foreach ($blog_categories as $k => $v) :
                if (!empty($v->seo_url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_blog") . "/{$v->seo_url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Blogs
         */
        $blogs = $this->general_model->get_all("blogs", null, "id DESC", ['isActive' => 1, "lang" => $this->viewData->lang], [], [], []);
        if (!empty($blogs)) :
            foreach ($blogs as $k => $v) :
                if (!empty($v->seo_url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_blog") . "/" . lang("routes_blog_detail") . "/{$v->seo_url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Product Categories
         */
        $product_categories = $this->general_model->get_all("product_categories", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        if (!empty($product_categories)) :
            foreach ($product_categories as $k => $v) :
                if (!empty($v->seo_url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_product_categories") . "/{$v->seo_url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Products
         */
        $wheres["p.isActive"] = 1;
        $wheres["pi.isCover"] = 1;
        $wheres["p.lang"] = $this->viewData->lang;
        $joins = ["product_categories pc" => ["p.category_id = pc.id", "left"], "product_images pi" => ["pi.codes_id = p.codes_id AND pi.codes = p.codes", "left"]];
        $select = "p.id,p.title,p.seo_url,pi.url img_url";
        $distinct = true;
        $groupBy = ["p.id"];
        $products = $this->general_model->get_all("products p", $select, "p.id DESC", $wheres, [], $joins, [], [], $distinct, $groupBy);
        if (!empty($products)) :
            foreach ($products as $k => $v) :
                if (!empty($v->url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_product_categories") . "/" . lang("routes_product") . "/{$v->url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Slides
         */
        $slides = $this->general_model->get_all("slides", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        if (!empty($slides)) :
            foreach ($slides as $k => $v) :
                if (!empty($v->button_url)) :
                    $this->sitemapmodel->add($v->button_url, NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Galleries
         */
        $galleries = $this->general_model->get_all("galleries", null, "rank ASC", ["isActive" => 1, "isCover" => 0, "lang" => $this->viewData->lang], [], [], []);
        if (!empty($galleries)) :
            foreach ($galleries as $k => $v) :
                if (!empty($v->url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_galleries") . "/" . lang("routes_gallery") . "/{$v->url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        $this->sitemapmodel->output();
    }
    /**
     * ------------------------------------------------------------------------------------------------
     * ...:::!!! ============================== SITEMAP MODULE ============================== !!!:::...
     * ------------------------------------------------------------------------------------------------
     */
    /**
     * ------------------------------------------------------------------------------------------------
     * ...:::!!! ========================== FACEBOOK CATALOG MODULE ========================= !!!:::...
     * ------------------------------------------------------------------------------------------------
     */
    function catalog()
    {
        $settings = get_settings();

        $dom = xml_dom();
        $rss = xml_add_child($dom, 'rss');
        xml_add_attribute($rss, 'xmlns:g', 'https://base.google.com/ns/1.0');
        xml_add_attribute($rss, 'version', '2.0');

        $channel = xml_add_child($rss, 'channel');
        xml_add_child($channel, 'title', $settings->company_name);
        xml_add_child($channel, 'link', base_url());
        xml_add_child($channel, 'description', $settings->meta_description);

        /**
         * Order
         */
        $order = "p.id DESC";
        /**
         * Likes
         */
        $likes = [];
        $wheres = [];
        /**
         * Wheres
         */
        $wheres["p.isActive"] = 1;
        $wheres["pi.isCover"] = 1;
        $wheres["p.lang"] = $this->viewData->lang;
        $joins = ["product_images pi" => ["pi.codes_id = p.codes_id AND pi.codes = p.codes", "left"]];
        $select = "p.id,p.title,p.seo_url,pi.url img_url,p.description description,p.isActive";
        $distinct = true;
        $groupBy = ["p.id"];
        /** 
         * Get Products
         */
        $products = $this->general_model->get_all("products p", $select, $order, $wheres, $likes, $joins, [], [], $distinct, $groupBy);
        $this->viewData->products = $products;

        //logg($prods);
        if (!empty($products)) :
            foreach ($products as $key => $prod) :
                $item = xml_add_child($channel, 'item');
                xml_add_child($item, 'g:id', $prod->id);
                xml_add_child($item, 'g:title', strto("lower|ucwords", $prod->title));
                xml_add_child($item, 'g:description', strto("lower|ucwords", $prod->title));
                xml_add_child($item, 'g:link',  base_url(lang("routes_product_categories") . "/" . lang("routes_product") . "/{$prod->url}"));
                xml_add_child($item, 'g:image_link', get_picture("products_v", $prod->img_url));
                xml_add_child($item, 'g:brand', strto("lower|ucwords", $settings->company_name));
                xml_add_child($item, 'g:condition', 'new');
                xml_add_child($item, 'g:availability', ($prod->stock > 0 ? 'in stock' : 'out stock'));
                xml_add_child($item, 'g:price',  '0 ' . $this->viewData->currency);
                //https://www.google.com/basepages/producttype/taxonomy-with-ids.en-US.txt
                /**
                 * Get All Categories
                 */
                $categories = $this->general_model->get_all("product_categories", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang], [], [], []);
                $category = null;
                foreach ($categories as $k => $v) :
                    if ($v->id == $prod->category_id) :
                        $category = $v->title;
                    endif;
                endforeach;
                xml_add_child($item, 'g:google_product_category', strto("lower|ucwords", $category));
            //xml_add_child($item, 'g:custom_label_0', $prod->);
            endforeach;
        endif;
        $this->output->set_content_type('application/xml')->set_output(xml_print($dom, true));
    }
    /**
     * ------------------------------------------------------------------------------------------------
     * ...:::!!! ========================== FACEBOOK CATALOG MODULE ========================= !!!:::...
     * ------------------------------------------------------------------------------------------------
     */
}
