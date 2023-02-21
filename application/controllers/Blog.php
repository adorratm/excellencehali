<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends MY_Controller
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
        $this->viewFolder = "blogs_v";
    }
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
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
     * ...:::!!! ================================== BLOGS =================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Blogs
     */
    public function index()
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
        $this->viewData->page_title = clean(strto("lower|ucwords", lang("routes_blog")));
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
        $this->viewData->page_title = clean(strto("lower|ucwords", $this->viewData->blog->title));
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
}
