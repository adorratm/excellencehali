<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blogs extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "blogs_v";
        $this->load->model("blog_model");
        $this->load->model("blog_category_model");
        $this->load->model("user_model");
        if (!get_active_user()) :
            redirect(base_url("login"));
        endif;
    }
    public function index()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $this->blog_model->get_all([], "rank ASC");
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function datatable()
    {
        $items = $this->blog_model->getRows([], $_POST);
        $data = [];
        $i = (!empty($_POST['start']) ? $_POST['start'] : 0);
        if (!empty($items)) :
            foreach ($items as $item) :
                $i++;
                $proccessing = '
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-primary rounded-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        İşlemler
                    </button>
                    <div class="dropdown-menu rounded-0 dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item updateBlogBtn" href="javascript:void(0)" data-url="' . base_url("blogs/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                        <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="blogsTable" data-url="' . base_url("blogs/delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                    </div>
                </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("blogs/isActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch' . $i . '"></label></div>';
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $item->title,$item->lang,  $checkbox, turkishDate("d F Y, l H:i:s", $item->createdAt), turkishDate("d F Y, l H:i:s", $item->updatedAt), turkishDate("d F Y, l H:i:s", $item->sharedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->blog_model->rowCount(),
            "recordsFiltered" => $this->blog_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        ];
        // Output to JSON format
        echo json_encode($output);
    }
    public function new_form()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->categories = $this->blog_category_model->get_all();
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $viewData->subViewFolder = "add";
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function save()
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"]) :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Blog Kaydı Yapılırken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            $getRank = $this->blog_model->rowCount();
            if (!empty($_FILES)) :
                if (empty($_FILES["img_url"]["name"])) :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Blog Eklenirken Hata Oluştu. Blog Görseli Seçtiğinizden Emin Olup, Lütfen Tekrar Deneyin."]);
                    die();
                endif;
                $image = upload_picture("img_url", "uploads/$this->viewFolder",[],"*");
                if ($image["success"]) :
                    $data["img_url"] = $image["file_name"];
                else :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Blog Kaydı Yapılırken Hata Oluştu. Blog Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                    die();
                endif;
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Blog Kaydı Yapılırken Hata Oluştu. Blog Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                die();
            endif;
            $data["seo_url"] = seo($data["title"]);
            $data["content"] = $_POST["content"];
            $data["isActive"] = 1;
            $data["rank"] = $getRank + 1;
            $insert = $this->blog_model->add($data);
            if ($insert) :
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Blog Başarıyla Eklendi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Blog Eklenirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function update_form($id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->categories = $this->blog_category_model->get_all();
        $viewData->item = $this->blog_model->get(["id" => $id]);
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function update($id)
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"]) :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Blog Güncelleştirilirken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            $blog = $this->blog_model->get(["id" => $id]);
            $data["img_url"] = $blog->img_url;
            if (!empty($_FILES["img_url"]["name"])) :
                $image = upload_picture("img_url", "uploads/$this->viewFolder",[],"*");
                if ($image["success"]) :
                    $data["img_url"] = $image["file_name"];
                    if (!empty($blog->img_url)) :
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$blog->img_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$blog->img_url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$blog->img_url}");
                        endif;
                    endif;
                else :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Blog Güncelleştirilirken Hata Oluştu. Blog Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                    die();
                endif;
            endif;
            $data["seo_url"] = seo($data["title"]);
            $data["content"] = $_POST["content"];
            $update = $this->blog_model->update(["id" => $id], $data);
            if ($update) :
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Blog Başarıyla Güncelleştirildi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Blog Güncelleştirilirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function delete($id)
    {
        $blog = $this->blog_model->get(["id" => $id]);
        if (!empty($blog)) :
            $delete = $this->blog_model->delete(["id"    => $id]);
            if (!empty($blog->img_url)) :
                if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$blog->img_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$blog->img_url}")) :
                    unlink(FCPATH . "uploads/{$this->viewFolder}/{$blog->img_url}");
                endif;
            endif;
            if ($delete) :
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Blog Başarıyla Silindi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Blog Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function rankSetter()
    {
        $rows = $this->input->post("rows");
        if (!empty($rows)) :
            foreach ($rows as $row) :
                $this->blog_model->update(["id" => $row["id"]], ["rank" => $row["position"]]);
            endforeach;
        endif;
    }
    public function isActiveSetter($id)
    {
        if (!empty($id)) :
            $isActive = (intval($this->input->post("data")) === 1) ? 1 : 0;
            if ($this->blog_model->update(["id" => $id], ["isActive" => $isActive])) :
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı"]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı"]);
            endif;
        endif;
    }
}
