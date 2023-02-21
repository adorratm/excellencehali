<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
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
        $this->viewFolder = "home_v";
    }
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
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
        /**
         * Product Collections
         */
        $this->viewData->product_collections = $this->general_model->get_all("product_collections", null, "rand()", ["isActive" => 1, "lang" => $this->viewData->lang], [], [], [8]);

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
        $product_collections = $this->general_model->get_all("product_collections", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        if (!empty($product_collections)) :
            foreach ($product_collections as $k => $v) :
                if (!empty($v->seo_url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_product_collections") . "/{$v->seo_url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Products
         */
        $wheres["p.isActive"] = 1;
        $wheres["pi.isCover"] = 1;
        $wheres["p.lang"] = $this->viewData->lang;
        $joins = ["product_collections pc" => ["p.collection_id = pc.id", "left"], "product_images pi" => ["pi.codes_id = p.codes_id AND pi.codes = p.codes", "left"]];
        $select = "p.id,p.title,p.seo_url,pi.url img_url";
        $distinct = true;
        $groupBy = ["p.id"];
        $products = $this->general_model->get_all("products p", $select, "p.id DESC", $wheres, [], $joins, [], [], $distinct, $groupBy);
        if (!empty($products)) :
            foreach ($products as $k => $v) :
                if (!empty($v->url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_product_collections") . "/" . lang("routes_product") . "/{$v->url}"), NULL, 'always', 1);
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
         * Product Collections
         */
        $product_collections = $this->general_model->get_all("product_collections", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        if (!empty($product_collections)) :
            foreach ($product_collections as $k => $v) :
                if (!empty($v->seo_url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_product_collections") . "/{$v->seo_url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Products
         */
        $wheres["p.isActive"] = 1;
        $wheres["pi.isCover"] = 1;
        $wheres["p.lang"] = $this->viewData->lang;
        $joins = ["product_collections pc" => ["p.collection_id = pc.id", "left"], "product_images pi" => ["pi.codes_id = p.codes_id AND pi.codes = p.codes", "left"]];
        $select = "p.id,p.title,p.seo_url,pi.url img_url";
        $distinct = true;
        $groupBy = ["p.id"];
        $products = $this->general_model->get_all("products p", $select, "p.id DESC", $wheres, [], $joins, [], [], $distinct, $groupBy);
        if (!empty($products)) :
            foreach ($products as $k => $v) :
                if (!empty($v->url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_product_collections") . "/" . lang("routes_product") . "/{$v->url}"), NULL, 'always', 1);
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
    function facebook_catalog()
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
        $joins = ["product_images pi" => ["pi.codes_id = p.codes_id AND pi.codes = p.codes", "left"], "product_details pd" => ["pd.codes_id = p.codes_id AND pd.codes = p.codes", "left"]];
        $select = "p.stock,p.codes,pd.description,p.id,p.title,p.seo_url,pi.url img_url,p.isActive";
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
                xml_add_child($item, 'g:link',  base_url(lang("routes_product_collections") . "/" . lang("routes_product") . "/" . $prod->codes . "/" . $prod->seo_url));
                xml_add_child($item, 'g:image_link', get_picture("products_v", $prod->img_url));
                xml_add_child($item, 'g:brand', strto("lower|ucwords", $settings->company_name));
                xml_add_child($item, 'g:condition', 'new');
                xml_add_child($item, 'g:availability', ($prod->stock > 0 ? 'in stock' : 'out stock'));
                xml_add_child($item, 'g:price',  '0 ' . $this->viewData->currency);
                //https://www.google.com/basepages/producttype/taxonomy-with-ids.en-US.txt
                xml_add_child($item, 'g:google_product_category', 2826);
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

    /**
     * ------------------------------------------------------------------------------------------------
     * ...:::!!! ========================== GOOGLE CATALOG MODULE ========================= !!!:::...
     * ------------------------------------------------------------------------------------------------
     */
    function google_catalog()
    {
        $settings = get_settings();

        $dom = xml_dom();
        $rss = xml_add_child($dom, 'rss');
        xml_add_attribute($rss, 'xmlns:g', 'https://base.google.com/ns/1.0');
        xml_add_attribute($rss, 'version', '2.0');

        $channel = xml_add_child($rss, 'channel');
        xml_add_child($channel, 'title', stripslashes($settings->company_name));
        xml_add_child($channel, 'link', base_url());
        xml_add_child($channel, 'description', clean($settings->meta_description));

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
        $joins = ["product_images pi" => ["pi.codes_id = p.codes_id AND pi.codes = p.codes", "left"], "product_details pd" => ["pd.codes_id = p.codes_id AND pd.codes = p.codes", "left"]];
        $select = "p.stock,p.codes,pd.description,p.id,p.title,p.seo_url,pi.url img_url,p.isActive";
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
                $gtin = rand(100000000000, 999999999999);
                xml_add_child($item, 'g:title', strto("lower|ucwords", $prod->title));
                xml_add_child($item, 'g:description', strto("lower|ucwords", (!empty($prod->description) ? clean(@mb_word_wrap($prod->description, 500, "...")) : $prod->title)));
                xml_add_child($item, 'g:link',  base_url(lang("routes_product_collections") . "/" . lang("routes_product") . "/" . $prod->codes . "/" . $prod->seo_url));
                xml_add_child($item, 'g:image_link', get_picture("products_v", $prod->img_url));
                xml_add_child($item, 'g:additional_image_link', get_picture("products_v", $prod->img_url));
                xml_add_child($item, 'g:brand', strto("lower|ucwords", stripslashes($settings->company_name)));
                xml_add_child($item, 'g:condition', 'new');
                xml_add_child($item, 'g:availability', ($prod->stock > 0 ? 'in stock' : 'out of stock'));
                xml_add_child($item, 'g:price', @number_format($prod->newPrice, 2) . ' ' . $this->viewData->currency);
                xml_add_child($item, 'g:sale_price', @number_format($prod->discountedPrice, 2) . ' ' . $this->viewData->currency);
                xml_add_child($item, 'g:mpn', $gtin);
                xml_add_child($item, 'g:identifier_exists', "no");
                $shipping = xml_add_child($item, 'g:shipping');
                xml_add_child($shipping, 'g:country', "TR");
                xml_add_child($shipping, 'g:service', "Standard");
                xml_add_child($shipping, 'g:price', 0 . ' ' . $this->viewData->currency);
                //https://www.google.com/basepages/producttype/taxonomy-with-ids.en-US.txt
                xml_add_child($item, 'g:google_product_category', 2826);
            //xml_add_child($item, 'g:custom_label_0', $prod->);
            endforeach;
        endif;
        $this->output->set_content_type('application/xml')->set_output(xml_print($dom, true));
    }
    /**
     * ------------------------------------------------------------------------------------------------
     * ...:::!!! ========================== GOOGLE CATALOG MODULE ========================= !!!:::...
     * ------------------------------------------------------------------------------------------------
     */

    /**
     * ------------------------------------------------------------------------------------------------
     * ...:::!!! ========================== CATALOG ========================= !!!:::...
     */
    function catalog()
    {
        
        $this->ci_minifier->set_domparser(0);
        $this->ci_minifier->init(1);
        $filepath = get_picture("settings_v", $this->viewData->settings->catalog);

        $this->output
            ->set_header("Content-Disposition: inline; filename={$this->viewData->settings->company_name}.pdf")
            ->set_content_type('application/pdf')
            ->set_output(file_get_contents($filepath));
    }
    /**
     * ------------------------------------------------------------------------------------------------
     * ...:::!!! ========================== CATALOG ========================= !!!:::...
     */
}
