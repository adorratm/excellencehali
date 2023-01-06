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
        $this->viewData->menus = $this->show_tree('HEADER', $this->viewData->lang);
        //$this->viewData->mobileMenus = $this->show_tree('MOBILE', $this->viewData->lang);
        //$this->viewData->rightMenus = $this->show_tree('HEADER_RIGHT', $this->viewData->lang);
        $this->viewData->footer_menus = $this->show_tree('FOOTER', $this->viewData->lang);
        $this->viewData->footer_menus2 = $this->show_tree('FOOTER2', $this->viewData->lang);
        $this->viewData->footer_menus3 = $this->show_tree('FOOTER3', $this->viewData->lang);
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
     * ...:::!!! ================================= RENDER =====?============================ !!!:::...
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
     * ...:::!!! ================================== MENU =================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Show Tree
     */
    public function show_tree($position = 'HEADER', $lang = 'tr')
    {
        // create array to store all menus ids
        $store_all_id = array();
        // get all parent menus ids by using isactive
        $id_result = $this->general_model->get_all("menus", "top_id", "rank ASC", ["position" => $position, "isActive" => 1, "lang" => $lang]);
        // loop through all menus to save parent ids $store_all_id array
        foreach ($id_result as $menu_id) {
            array_push($store_all_id, $menu_id->top_id);
        }
        // return all hierarchical tree data from in_parent by sending
        //  initiate parameters 0 is the main parent,blog id, all parent ids
        return  $this->in_parent(0, $position, $lang, $store_all_id);
    }
    /**
     * recursive function to loop
     * through all comments and retrieve it
     */
    public function in_parent($in_parent = null, $position = null, $lang = null, $store_all_id = null)
    {
        // this variable to save all concatenated html
        $html = "";
        // build hierarchy  html structure based on ul li (parent-child) nodes
        if (in_array($in_parent, $store_all_id)) :
            $result = $this->general_model->get_all("menus", "url,title,id,top_id,page_id,target", "rank ASC", ["position" => $position, "top_id" => $in_parent, "isActive" => 1, "lang" => $lang]);
            $html .=  '<ul ' . ($position == "HEADER" && $in_parent == 0 ? null : null) . '>';
            foreach ($result as $key => $value) :
                $page = $this->general_model->get("pages", "url,title", ["isActive" => 1, "id" => $value->page_id, "lang" => $lang]);
                if ($value->page_id !== 0) :
                    if (!empty($page)) :
                        $page->url = (!empty($page->url) ? $page->url : null);
                    endif;
                endif;
                $value->title = (!empty($value->title) ? $value->title : null);
                if (!empty($value->url)) :
                    $value->url = (!empty($value->url) ? $value->url : null);
                endif;
                $html .= '<li ' . (($position == "HEADER") && (in_array($value->id, $store_all_id)) ? ((!empty($page->url) && ($this->uri->segment(2) == strto("lower", seo($page->url)) || $this->uri->segment(3) == strto("lower", seo($page->url)))) || $this->uri->segment(2) == strto("lower", seo($value->title)) || $this->uri->segment(3) == strto("lower", seo($value->title)) || ($this->uri->segment(2) === null && $value->url === '/') ? "class='menu-item-has-children active'" : "class='menu-item-has-children'") : ((!empty($page->url) && ($this->uri->segment(2) == strto("lower", seo($page->url)) || $this->uri->segment(3) == strto("lower", seo($page->url)))) || ($this->uri->segment(2) === null && $value->url === '/') || $this->uri->segment(2) == strto("lower", seo($value->title)) || $this->uri->segment(3) == strto("lower", seo($value->title)) ? null : null)) . '>';
                if (empty($value->url)) :

                    if (!empty($page->url)) :

                        $html .= '<a rel="dofollow" ' . (($position == "MOBILE" || $position == "HEADER") && in_array($value->id, $store_all_id) ? ((!empty($page->url) && ($this->uri->segment(2) == strto("lower", seo($page->url)) || $this->uri->segment(3) == strto("lower", seo($page->url)))) || $this->uri->segment(2) == strto("lower", seo($value->title)) || $this->uri->segment(3) == strto("lower", seo($value->title)) || ($this->uri->segment(2) === null && $value->url === '/') ? "class='active'" : "class=''") : ((!empty($page->url) && ($this->uri->segment(2) == strto("lower", seo($page->url)) || $this->uri->segment(3) == strto("lower", seo($page->url)))) || ($this->uri->segment(2) === null && $value->url === '/') || $this->uri->segment(2) == strto("lower", seo($value->title)) || $this->uri->segment(3) == strto("lower", seo($value->title)) ? "class='active'" : "class=''")) . ' href="' . base_url(lang("routes_page") . "/" . (!empty($page->url) ? $page->url : null)) . '" target="' . $value->target . '" title="' . $value->title . '">' . $value->title . '</a>';
                        array_push($this->viewData->page_urls, base_url(lang("routes_page") . "/" . (!empty($page->url) ? $page->url : null)));
                    else :
                        $html .= '<a rel="dofollow" ' . (($position == "MOBILE" || $position == "HEADER") && in_array($value->id, $store_all_id) ? ((!empty($page->url) && ($this->uri->segment(2) == strto("lower", seo($page->url)) || $this->uri->segment(3) == strto("lower", seo($page->url)))) || $this->uri->segment(2) == strto("lower", seo($value->title)) || $this->uri->segment(3) == strto("lower", seo($value->title)) || ($this->uri->segment(2) === null && $value->url === '/') ? "class='active'" : "class=''") : ((!empty($page->url) && ($this->uri->segment(2) == strto("lower", seo($page->url)) || $this->uri->segment(3) == strto("lower", seo($page->url)))) || ($this->uri->segment(2) === null && $value->url === '/') || $this->uri->segment(2) == strto("lower", seo($value->title)) || $this->uri->segment(3) == strto("lower", seo($value->title)) ? "class='active'" : "class=''")) . ' href="' . base_url(seo(strto("lower", $value->title))) . '" target="' . $value->target . '" title="' . $value->title . '">' . $value->title . '</a>';
                        array_push($this->viewData->page_urls, base_url(seo(strto("lower", $value->title))));
                    endif;
                else :
                    $url = parse_url($value->url, PHP_URL_SCHEME);
                    if ($url === "http" || $url === "https") :
                        $html .= '<a rel="dofollow" ' . (($position == "MOBILE" || $position == "HEADER") && in_array($value->id, $store_all_id) ? ((!empty($page->url) && ($this->uri->segment(2) == strto("lower", seo($page->url)) || $this->uri->segment(3) == strto("lower", seo($page->url)))) || $this->uri->segment(2) == strto("lower", seo($value->title)) || $this->uri->segment(3) == strto("lower", seo($value->title)) || ($this->uri->segment(2) === null && $value->url === '/') ? "class='active'" : "class=''") : ((!empty($page->url) && ($this->uri->segment(2) == strto("lower", seo($page->url)) || $this->uri->segment(3) == strto("lower", seo($page->url)))) || ($this->uri->segment(2) === null && $value->url === '/') || $this->uri->segment(2) == strto("lower", seo($value->title)) || $this->uri->segment(3) == strto("lower", seo($value->title)) ? "class='active'" : "class=''")) . ' href="' . $value->url . '" target="' . $value->target . '" title="' . $value->title . '">' . $value->title . '</a>';
                        array_push($this->viewData->page_urls, $value->url);
                    else :
                        $html .= '<a rel="dofollow" ' . (($position == "MOBILE" || $position == "HEADER") && in_array($value->id, $store_all_id) ? ((!empty($page->url) && ($this->uri->segment(2) == strto("lower", seo($page->url)) || $this->uri->segment(3) == strto("lower", seo($page->url)))) || $this->uri->segment(2) == strto("lower", seo($value->title)) || $this->uri->segment(3) == strto("lower", seo($value->title)) || ($this->uri->segment(2) === null && $value->url === '/') ? "class='active'" : "class=''") : ((!empty($page->url) && ($this->uri->segment(2) == strto("lower", seo($page->url)) || $this->uri->segment(3) == strto("lower", seo($page->url)))) || ($this->uri->segment(2) === null && $value->url === '/') || $this->uri->segment(2) == strto("lower", seo($value->title)) || $this->uri->segment(3) == strto("lower", seo($value->title)) ? "class='active'" : "class=''")) . ' href="' . base_url($value->url) . '" target="' . $value->target . '" title="' . $value->title . '">' . $value->title . '</a>';
                        array_push($this->viewData->page_urls, base_url($value->url));
                    endif;
                endif;
                $html .= $this->in_parent($value->id, $position, $lang, $store_all_id);
                $html .= "</li>";
            endforeach;
            $html .=  "</ul>";
        endif;

        return $html;
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== MENU =================================== !!!:::...
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
    public function page()
    {
        $seo_url = $this->uri->segment(3);
        $this->viewData->item = $this->general_model->get("pages", null, ["isActive" => 1, "lang" => $this->viewData->lang, 'url' =>  $seo_url]);
        $this->viewData->testimonials = $this->general_model->get_all("testimonials", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
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
            $this->viewFolder = "page_v/index";
        endif;
        $this->render();
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== PAGES ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== BLOGS =================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Blogs
     */
    public function blogs()
    {
        $seo_url = $this->uri->segment(3);
        $search = null;
        if (!empty(clean($this->input->get("search")))) :
            $search = clean($this->input->get("search"));
        endif;
        $category_id = null;
        $category = null;
        if (!empty($seo_url) && !is_numeric($seo_url)) :
            $category = $this->general_model->get("blog_categories", null, ["isActive" => 1, "lang" => $this->viewData->lang, "seo_url" => $seo_url]);
            if (!empty($category)) :
                $category_id = $category->id;
                $category->seo_url = (!empty($category->seo_url) ? $category->seo_url : null);
                $category->title = (!empty($category->title) ? $category->title : null);
            endif;
        endif;
        $config = [];
        $config['base_url'] = (!empty($seo_url) && !is_numeric($seo_url) ? base_url(lang("routes_blog") . "/{$seo_url}/") : base_url(lang("routes_blog") . "/"));
        $config['uri_segment'] = (!empty($seo_url) && !is_numeric($seo_url) && !empty($this->uri->segment(4)) ? 4 : (is_numeric($this->uri->segment(3)) ? 3 : 2));
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
        $config['total_rows'] = (!empty($seo_url) && !is_numeric($seo_url) ? (!empty($search) ? $this->general_model->rowCount("blogs", ["isActive" => 1, "category_id" => $category_id, "lang" => $this->viewData->lang], ["title" =>  $search, "content" =>  $search, "createdAt" => $search, "updatedAt" =>  $search]) : $this->general_model->rowCount("blogs", ["isActive" => 1, "category_id" => $category_id, "lang" => $this->viewData->lang])) : (!empty($search) ? $this->general_model->rowCount("blogs", ["isActive" => 1, "lang" => $this->viewData->lang], ["title" =>  $search, "content" => $search, "createdAt" =>  $search, "updatedAt" =>  $search]) : $this->general_model->rowCount("blogs", ["isActive" => 1, "lang" => $this->viewData->lang])));
        $config['per_page'] = 8;
        $config["num_links"] = 5;
        $config['reuse_query_string'] = true;
        $this->pagination->initialize($config);
        if (!empty($seo_url) && !is_numeric($seo_url)) :
            $uri_segment = $this->uri->segment(4);
        elseif (!empty($this->uri->segment(3)) && is_numeric($this->uri->segment(3))) :
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
        $this->viewData->blog_category = $category;
        $this->viewData->blogs = (!empty($seo_url) && !is_numeric($seo_url) ? (!empty($search) ? $this->general_model->get_all("blogs", null, null, ['category_id' => $category_id, "isActive" => 1, "lang" => $this->viewData->lang], ["title" =>  $search, "content" =>  $search, "createdAt" => $search, "updatedAt" =>  $search], [], [$config["per_page"], $offset]) : $this->general_model->get_all("blogs", null, null, ['category_id' => $category_id, "isActive" => 1, "lang" => $this->viewData->lang], [], [], [$config["per_page"], $offset])) : (!empty($search) ? $this->general_model->get_all("blogs", null, null, ["isActive" => 1, "lang" => $this->viewData->lang], ["title" =>  $search, "content" =>  $search, "createdAt" =>  $search, "updatedAt" =>  $search], [], [$config["per_page"], $offset]) : $this->general_model->get_all("blogs", null, null, ["isActive" => 1, "lang" => $this->viewData->lang], [], [], [$config["per_page"], $offset])));
        $this->viewData->categories = $this->general_model->get_all("blog_categories", null, "id DESC", ["isActive" => 1]);
        $this->viewData->latestBlogs = (!empty($seo_url) && !is_numeric($seo_url) ? $this->general_model->get_all("blogs", null, "id DESC", ['category_id' => $category_id, "isActive" => 1, "lang" => $this->viewData->lang], [], [], [5]) : $this->general_model->get_all("blogs", null, "id DESC", ["isActive" => 1, "lang" => $this->viewData->lang], [], [], [5]));

        $this->viewData->meta_title = clean(strto("lower|ucwords", lang("routes_blog"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));

        $this->viewData->og_url                 = clean(base_url(lang("routes_blog")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "article";
        $this->viewData->og_title           = clean(strto("lower|ucwords", lang("routes_blog"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->viewData->links = $this->pagination->create_links();
        if (empty($this->viewData->blogs)) :
            $this->viewFolder = "404_v/index";
        else :
            $this->viewFolder = "blogs_v/index";
        endif;
        $this->render();
    }
    /**
     * Blog Detail
     */
    public function blog_detail($seo_url)
    {
        $this->viewData->blog = $this->general_model->get("blogs", null, ["isActive" => 1, "lang" => $this->viewData->lang, 'seo_url' => $seo_url]);
        if (!empty($this->viewData->blog->category_id)) :
            $this->viewData->category = $this->general_model->get("blog_categories", null, ["id" => $this->viewData->blog->category_id, "isActive" => 1, "lang" => $this->viewData->lang]);
        endif;
        $this->viewData->categories = $this->general_model->get_all("blog_categories", null, "id DESC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        $this->viewData->meta_title = strto("lower|ucwords", $this->viewData->blog->title) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = clean(str_replace("”", "\"", @stripslashes($this->viewData->blog->content)));
        $this->viewData->og_url                 = clean(base_url(lang("routes_blog") . "/" . lang("routes_blog_detail") . "/" . $seo_url));
        $this->viewData->og_image           = clean(get_picture("blogs_v", $this->viewData->blog->img_url));
        $this->viewData->og_type          = "article";
        $this->viewData->og_title           = strto("lower|ucwords", $this->viewData->blog->title) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean(str_replace("”", "\"", @stripslashes($this->viewData->blog->content)));
        if (empty($this->viewData->blog)) :
            $this->viewFolder = "404_v/index";
        else :
            $this->viewFolder = "blog_detail_v/index";
        endif;
        $this->render();
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== BLOGS =================================== !!!:::...
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
    public function product_categories()
    {
        $search = null;
        if (!empty(clean($this->input->get("search")))) :
            $search = clean($this->input->get("search"));
        endif;
        $seo_url = $this->uri->segment(3);
        $category_id = null;
        $category = null;
        if (!empty($seo_url) && !is_numeric($seo_url)) :
            $category = $this->general_model->get("product_categories", null, ["isActive" => 1, "lang" => $this->viewData->lang, "seo_url" => $seo_url]);
            if (!empty($category)) :
                $category_id = $category->id;
                $category->seo_url = (!empty($category->seo_url) ? $category->seo_url : null);
                $category->title = (!empty($category->title) ? $category->title : null);
            endif;
        endif;
        /**
         * Order
         */
        $order = !empty($_GET["orderBy"]) ? clean($_GET["orderBy"]) : "pc.id DESC";
        /**
         * Likes
         */
        $likes = [];
        if (!empty($search)) :
            $likes["p.title"] = $search;
            $likes["p.createdAt"] = $search;
            $likes["p.updatedAt"] = $search;
        endif;
        $wheres = [];
        if (!empty($category_id)) :
            $wheres["p.category_id"] = $category_id;
        endif;
        /**
         * Wheres
         */
        $wheres["pc.isActive"] = 1;

        $wheres["pc.lang"] = $this->viewData->lang;
        $joins = [];

        $select = "pc.id,pc.title,pc.seo_url,pc.img_url,pc.isActive";
        $distinct = true;
        $groupBy = ["pc.id"];
        /**
         * Pagination
         */
        $config = [];
        $config['base_url'] = (!empty($seo_url) && !is_numeric($seo_url) ? base_url(lang("routes_products") . "/{$seo_url}/") : base_url(lang("routes_products") . "/"));
        $config['uri_segment'] = (!empty($seo_url) && !is_numeric($seo_url) && !empty($this->uri->segment(4)) ? 4 : (is_numeric($this->uri->segment(3)) ? 3 : 2));
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
        $config['total_rows'] = $this->general_model->rowCount("product_categories pc", $wheres, $likes, $joins, [], $distinct, $groupBy, "pc.id");
        $config['per_page'] = 24;
        $config["num_links"] = 5;
        $config['reuse_query_string'] = true;
        $this->pagination->initialize($config);
        if (!empty($seo_url) && !is_numeric($seo_url)) :
            $uri_segment = $this->uri->segment(4);
        elseif (!empty($this->uri->segment(3)) && is_numeric($this->uri->segment(3))) :
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
        $this->viewData->products_category = $category;
        /**
         * Get All Categories
         */
        $this->viewData->categories = $this->general_model->get_all("product_categories", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        /** 
         * Get Products
         */
        $this->viewData->product_categories = $this->general_model->get_all("product_categories pc", $select, $order, $wheres, $likes, $joins, [$config["per_page"], $offset], [], $distinct, $groupBy);
        /**
         * Meta
         */
        $this->viewData->page_title = (!empty($category) ? $category->title : lang("products"));
        $this->viewData->meta_title = strto("lower|ucwords", (!empty($category) ? $category->title : lang("products"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));
        $this->viewData->og_url                 = clean(base_url(lang("routes_products")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "product";
        $this->viewData->og_title           = strto("lower|ucwords", (!empty($category) ? $category->title : lang("products"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->viewData->links = $this->pagination->create_links();
        $this->viewFolder = "products_v/index";
        $this->render();
        //$this->output->enable_profiler(true); // OPEN FOR PERFORMANCE
        //$this->benchmark->mark('code_end');
        //echo $this->benchmark->elapsed_time('code_start','code_end');
    }
    /**
     * Products
     */
    public function products()
    {
        $search = null;
        if (!empty(clean($this->input->get("search")))) :
            $search = clean($this->input->get("search"));
        endif;
        $seo_url = $this->uri->segment(3);
        $category_id = null;
        $category = null;
        if (!empty($seo_url) && !is_numeric($seo_url)) :
            $category = $this->general_model->get("product_categories", null, ["isActive" => 1, "lang" => $this->viewData->lang, "seo_url" => $seo_url]);
            if (!empty($category)) :
                $category_id = $category->id;
                $category->seo_url = (!empty($category->seo_url) ? $category->seo_url : null);
                $category->title = (!empty($category->title) ? $category->title : null);
            endif;
        endif;
        /**
         * Order
         */
        $order = !empty($_GET["orderBy"]) ? clean($_GET["orderBy"]) : "p.id DESC";
        /**
         * Likes
         */
        $likes = [];
        if (!empty($search)) :
            $likes["p.title"] = $search;
            $likes["p.content"] = $search;
            $likes["p.createdAt"] = $search;
            $likes["p.updatedAt"] = $search;
            $likes["p.description"] = $search;
            $likes["p.features"] = $search;
        endif;
        $wheres = [];
        if (!empty($category_id)) :
            $wheres["p.category_id"] = $category_id;
        endif;
        /**
         * Wheres
         */
        $wheres["p.isActive"] = 1;
        $wheres["pi.isCover"] = 1;

        $wheres["p.lang"] = $this->viewData->lang;
        $joins = ["product_categories pc" => ["p.category_id = pc.id", "left"], "product_images pi" => ["pi.product_id = p.id", "left"]];

        $select = "GROUP_CONCAT(pc.seo_url) category_seos,GROUP_CONCAT(pc.title) category_titles,GROUP_CONCAT(pc.id) category_ids,p.id,p.title,p.seo_url,pi.url img_url,p.isActive";
        $distinct = true;
        $groupBy = ["p.id"];
        /**
         * Pagination
         */
        $config = [];
        $config['base_url'] = (!empty($seo_url) && !is_numeric($seo_url) ? base_url(lang("routes_products") . "/{$seo_url}/") : base_url(lang("routes_products") . "/"));
        $config['uri_segment'] = (!empty($seo_url) && !is_numeric($seo_url) && !empty($this->uri->segment(4)) ? 4 : (is_numeric($this->uri->segment(3)) ? 3 : 2));
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
        $config['total_rows'] = $this->general_model->rowCount("products p", $wheres, $likes, $joins, [], $distinct, $groupBy, "p.id");
        $config['per_page'] = 21;
        $config["num_links"] = 5;
        $config['reuse_query_string'] = true;
        $this->pagination->initialize($config);
        if (!empty($seo_url) && !is_numeric($seo_url)) :
            $uri_segment = $this->uri->segment(4);
        elseif (!empty($this->uri->segment(3)) && is_numeric($this->uri->segment(3))) :
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
        $this->viewData->products_category = $category;
        /**
         * Get All Categories
         */
        $this->viewData->categories = $this->general_model->get_all("product_categories", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        /** 
         * Get Products
         */
        $this->viewData->products = $this->general_model->get_all("products p", $select, $order, $wheres, $likes, $joins, [$config["per_page"], $offset], [], $distinct, $groupBy);
        /**
         * Meta
         */
        $this->viewData->page_title = (!empty($category) ? $category->title : lang("products"));
        $this->viewData->meta_title = strto("lower|ucwords", (!empty($category) ? $category->title : lang("products"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));
        $this->viewData->og_url                 = clean(base_url(lang("routes_products")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "product";
        $this->viewData->og_title           = strto("lower|ucwords", (!empty($category) ? $category->title : lang("products"))) . " - " . $this->viewData->settings->company_name;
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
    public function product_detail($seo_url)
    {
        $wheres["p.isActive"] = 1;
        $wheres["pi.isCover"] = 1;
        $wheres["p.lang"] = $this->viewData->lang;
        $joins = ["product_categories pc" => ["p.category_id = pc.id", "left"], "product_images pi" => ["pi.product_id = p.id", "left"]];
        $select = "p.technical_information_id,GROUP_CONCAT(pc.seo_url) category_seos,GROUP_CONCAT(pc.title) category_titles,GROUP_CONCAT(pc.id) category_ids,p.id,p.title,p.seo_url,pi.url img_url,p.img_url cover_url, p.description,p.content,p.features,p.isActive";
        $distinct = true;
        $groupBy = ["p.id"];
        $wheres['p.seo_url'] =  $seo_url;
        /**
         * Get Product Detail
         */
        $this->viewData->product = $this->general_model->get("products p", $select, $wheres, $joins, [], [], $distinct, $groupBy);
        if (!empty($this->viewData->product)) :
            /**
             * Product Dimensions
             */
            $this->viewData->productDimensions = $this->general_model->get_all("product_dimensions", null, "rank ASC", ["isActive" => 1, "product_id" => $this->viewData->product->id, "lang" => $this->viewData->lang]);
            /**
             * Get All Categories
             */
            $this->viewData->categories = $this->general_model->get_all("product_categories", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
            /**
             * Get Product Images
             */
            $this->viewData->product_own_images = $this->general_model->get_all("product_images", null, "isCover DESC,rank ASC", ["isActive" => 1, "product_id" => $this->viewData->product->id, "lang" => $this->viewData->lang]);
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
             * Meta
             */
            $this->viewData->meta_title = strto("lower|ucwords", $this->viewData->product->title) . " - " . $this->viewData->settings->company_name;
            $this->viewData->meta_desc  = !empty($this->viewData->product->content) ? str_replace("”", "\"", @stripslashes($this->viewData->product->content)) : str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));
            $this->viewData->og_url                 = clean(base_url(lang("routes_products") . "/" . lang("routes_product") . "/" . $seo_url));
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
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! =============================== GALLERIES ================================= !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Galleries
     */
    public function galleries()
    {
        $seo_url = $this->uri->segment(3);
        if (!empty($seo_url) && !is_numeric($seo_url)) :
            $gallery_id = $this->general_model->get("galleries", null, ["isActive" => 1, "isCover" => 0, "lang" => $this->viewData->lang, "url" =>  $seo_url])->id;
        endif;
        $config = [];
        $config['base_url'] = (!empty($seo_url) && !is_numeric($seo_url) ? base_url(lang("routes_galleries") . "/{$seo_url}/") : base_url(lang("routes_galleries") . "/"));
        $config['uri_segment'] = (!empty($seo_url) && !is_numeric($seo_url) && !empty($this->uri->segment(4)) ? 4 : (is_numeric($this->uri->segment(3)) ? 3 : 2));
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
        $config['total_rows'] = (!empty($seo_url) && !is_numeric($seo_url) && !empty($gallery_id) ? $this->general_model->rowCount("galleries", ["isActive" => 1, "isCover" => 0, "gallery_id" => $gallery_id, "lang" => $this->viewData->lang]) : $this->general_model->rowCount("galleries", ["isActive" => 1, "lang" => $this->viewData->lang]));
        $config['per_page'] = 8;
        $config["num_links"] = 5;
        $this->pagination->initialize($config);
        if (!empty($seo_url) && !is_numeric($seo_url)) :
            $uri_segment = $this->uri->segment(4);
        elseif (!empty($this->uri->segment(3)) && is_numeric($this->uri->segment(3))) :
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
        $this->viewData->galleries = (!empty($seo_url) && !is_numeric($seo_url) && !empty($gallery_id) ? $this->general_model->get_all("galleries", null, null, ['gallery_id' => $gallery_id, "isCover" => 0, "isActive" => 1, "lang" => $this->viewData->lang], [], [], [$config["per_page"], $offset]) : $this->general_model->get_all("galleries", null, null, ["isActive" => 1, "isCover" => 0, "lang" => $this->viewData->lang], [], [], [$config["per_page"], $offset]));

        $this->viewData->links = $this->pagination->create_links();
        $this->viewData->meta_title = clean(strto("lower|ucwords", lang("galleries"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));

        $this->viewData->og_url                 = clean(base_url(lang("routes_galleries")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "article";
        $this->viewData->og_title           = clean(strto("lower|ucwords", lang("galleries"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        if (empty($this->viewData->galleries)) :
            $this->viewFolder = "404_v/index";
        else :
            $this->viewFolder = "galleries_v/index";
        endif;
        $this->render();
    }
    /**
     * Gallery Detail
     */
    public function gallery_detail($seo_url)
    {
        $this->viewData->gallery = $this->general_model->get("galleries", null, ["isActive" => 1, "lang" => $this->viewData->lang, 'url' =>  $seo_url]);
        $gallery_type = !empty($this->viewData->gallery->gallery_type) ? $this->viewData->gallery->gallery_type : null;

        $this->viewData->meta_title = strto("lower|ucwords", $this->viewData->gallery->title) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));

        $this->viewData->og_url                 = clean(base_url(lang("routes_galleries") . "/" . lang("routes_gallery") . "/" . $seo_url));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "article";
        $this->viewData->og_title           = strto("lower|ucwords", $this->viewData->gallery->title) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->viewData->gallery_items = !empty($gallery_type) ? $this->general_model->get_all("{$gallery_type}", null, "rank ASC", ["gallery_id" => $this->viewData->gallery->id, "isActive" => 1, "lang" => $this->viewData->lang]) : [];
        if (empty($this->viewData->gallery_items)) :
            $this->viewFolder = "404_v/index";
        else :
            $this->viewFolder = "gallery_detail_v/index";
        endif;
        $this->render();
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! =============================== GALLERIES ================================= !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================ CONTACT ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Contact
     */
    public function contact()
    {
        $this->viewFolder = "contact_v/index";

        $this->viewData->meta_title = clean(strto("lower|ucwords", lang("contact"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));

        $this->viewData->og_url                 = clean(base_url(lang("routes_contact")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "article";
        $this->viewData->og_title           = clean(strto("lower|ucwords", lang("contact"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->render();
    }
    /**
     * Contact Form
     */
    public function contact_form()
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"]) :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => lang("errorMessageTitleText"), "message" => lang("errorMessageText") . " \"{$key}\" " . lang("emptyMessageText")]);
            die();
        else :
            $message = "\"" . $data['full_name'] . "\" İsimli ziyaretçi yeni mesaj gönderdi. \n <b>Ad Soyad : </b> " . $data["full_name"] . "\n <b>Telefon : </b> " . $data["phone"] . "\n <b>E-mail : </b> " . $data["email"] . "\n <b>Konu : </b>" . $data["subject"] . "\n <b>Mesaj : </b>" . $data["comment"];
            $message = $this->load->view("includes/simple_mail_template", ["settings" => get_settings(), "subject" => "Yeni Bir Mesajınız Var! | " . $this->viewData->settings->company_name, "message" => $message, "lang" => $this->viewData->lang], true);
            if (send_emailv2(null, "Yeni Bir Mesajınız Var! | " . $this->viewData->settings->company_name, $message, [], $this->viewData->lang)) :
                echo json_encode(["success" => true, "title" => lang("successMessageTitleText"), "message" => lang("successMessageText")]);
                die();
            else :
                echo json_encode(["success" => false, "title" => lang("errorMessageTitleText"), "message" => lang("errorEmailMessageText")]);
                die();
            endif;
        endif;
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================ CONTACT ================================== !!!:::...
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
                    $this->sitemapmodel->add(base_url(lang("routes_products") . "/{$v->seo_url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Products
         */
        $wheres["p.isActive"] = 1;
        $wheres["pi.isCover"] = 1;
        $wheres["p.lang"] = $this->viewData->lang;
        $joins = ["product_categories pc" => ["p.category_id = pc.id", "left"], "product_images pi" => ["pi.product_id = p.id", "left"]];
        $select = "GROUP_CONCAT(pc.seo_url) category_seos,GROUP_CONCAT(pc.title) category_titles,GROUP_CONCAT(pc.id) category_ids,p.id,p.title,p.seo_url,pi.url img_url";
        $distinct = true;
        $groupBy = ["p.id"];
        $products = $this->general_model->get_all("products p", $select, "p.id DESC", $wheres, [], $joins, [], [], $distinct, $groupBy);
        if (!empty($products)) :
            foreach ($products as $k => $v) :
                if (!empty($v->url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_products") . "/" . lang("routes_product") . "/{$v->url}"), NULL, 'always', 1);
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
                    $this->sitemapmodel->add(base_url(lang("routes_products") . "/{$v->seo_url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Products
         */
        $wheres["p.isActive"] = 1;
        $wheres["pi.isCover"] = 1;
        $wheres["p.lang"] = $this->viewData->lang;
        $joins = ["product_categories pc" => ["p.category_id = pc.id", "left"], "product_images pi" => ["pi.product_id = p.id", "left"]];
        $select = "GROUP_CONCAT(pc.seo_url) category_seos,GROUP_CONCAT(pc.title) category_titles,GROUP_CONCAT(pc.id) category_ids,p.id,p.title,p.seo_url,pi.url img_url";
        $distinct = true;
        $groupBy = ["p.id"];
        $products = $this->general_model->get_all("products p", $select, "p.id DESC", $wheres, [], $joins, [], [], $distinct, $groupBy);
        if (!empty($products)) :
            foreach ($products as $k => $v) :
                if (!empty($v->url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_products") . "/" . lang("routes_product") . "/{$v->url}"), NULL, 'always', 1);
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
        $joins = ["product_images pi" => ["pi.product_id = p.id", "left"]];
        $select = "p.id,p.title,p.seo_url,pi.url img_url,p.description description,p.isActive";
        $distinct = true;
        $groupBy = ["p.product_id"];
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
                xml_add_child($item, 'g:link',  base_url(lang("routes_products") . "/" . lang("routes_product") . "/{$prod->url}"));
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
