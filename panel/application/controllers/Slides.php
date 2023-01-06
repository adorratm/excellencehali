<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slides extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "slides_v";
        $this->load->model("slide_model");
        $this->load->helper("text");
        if (!get_active_user()) :
            redirect(base_url("login"));
        endif;
    }
    public function datatable()
    {
        $items = $this->slide_model->getRows([], $_POST);
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
                    <a class="dropdown-item updateSlideBtn" href="javascript:void(0)" data-url="' . base_url("slides/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                    <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="sliderTable" data-url="' . base_url("slides/delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                </div>
            </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("slides/isActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch' . $i . '"></label></div>';
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $item->title, mb_word_wrap($item->description, 30, "..."), $item->lang,  $checkbox, turkishDate("d F Y, l H:i:s", $item->createdAt), turkishDate("d F Y, l H:i:s", $item->updatedAt), turkishDate("d F Y, l H:i:s", $item->sharedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->slide_model->rowCount(),
            "recordsFiltered" => $this->slide_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        ];
        // Output to JSON format
        echo json_encode($output);
    }
    public function index()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $this->slide_model->get_all([], "rank ASC");
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function new_form()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $viewData->pages = $this->general_model->get_all("pages",null,"rank ASC", ["isActive" => 1]);
        $viewData->services = $this->general_model->get_all("services",null,"rank ASC", ["isActive" => 1]);
        $viewData->categories = $this->general_model->get_all("product_categories",null,"rank ASC", ["isActive" => 1]);
        $viewData->products = $this->general_model->get_all("products p","p.id,p.title","p.rank ASC", ["p.isActive" => 1,"pi.isCover" => 1],[],["product_categories pc" => ["p.category_id = pc.id", "left"], "product_images pi" => ["pi.product_id = p.id", "left"]],[],[],true,["p.id"]);
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function save()
    {
        $data = rClean($this->input->post());
        if (!empty($data["allowButton"]) && $data["allowButton"] == "on" && (empty($data["button_caption"]))) :
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Slayt Kaydı Yapılırken Hata Oluştu. Buton Başlık ve URL Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
            die();
        else :
            if (empty($data["lang"])) :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Slayt Kaydı Yapılırken Hata Oluştu. Dil Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
                die();
            endif;
            $data["allowButton"] = (!empty($data["allowButton"]) && $data["allowButton"] == "on") ? 1 : 0;
        endif;
        $getRank = $this->slide_model->rowCount();
        if (empty($_FILES["img_url"]["name"])) :
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Slayt Eklenirken Hata Oluştu. Slayt Görseli Seçtiğinizden Emin Olup, Lütfen Tekrar Deneyin."]);
            die();
        endif;
        $image = upload_picture("img_url", "uploads/$this->viewFolder",["width" => 1920,"height" => 750]);
        if ($image["success"]) :
            $data["img_url"] = $image["file_name"];
        else :
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Slayt Kaydı Yapılırken Hata Oluştu. Slayt Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
            die();
        endif;
        $data["description"] = $_POST["description"];
        $data["isActive"] = 1;
        $data["rank"] = $getRank + 1;
        $insert = $this->slide_model->add($data);
        if ($insert) :
            echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Slayt Başarıyla Eklendi."]);
        else :
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Slayt Eklenirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
        endif;
    }
    public function update_form($id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $this->slide_model->get(["id" => $id]);
        $viewData->pages = $this->general_model->get_all("pages",null,"rank ASC", ["isActive" => 1]);
        $viewData->services = $this->general_model->get_all("services",null,"rank ASC", ["isActive" => 1]);
        $viewData->categories = $this->general_model->get_all("product_categories",null,"rank ASC", ["isActive" => 1]);
        $viewData->products = $this->general_model->get_all("products p","p.id,p.title","p.rank ASC", ["p.isActive" => 1,"pi.isCover" => 1],[],["product_categories pc" => ["p.category_id = pc.id", "left"], "product_images pi" => ["pi.product_id = p.id", "left"]],[],[],true,["p.id"]);
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function update($id)
    {
        $data = rClean($this->input->post());
        $slide = $this->slide_model->get(["id" => $id]);
        if (!empty($data["allowButton"]) && $data["allowButton"] == "on" && (empty($data["button_caption"]))) :
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Slayt Kaydı Yapılırken Hata Oluştu. Buton Başlık ve URL Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
            die();
        else :
            $data["allowButton"] = (!empty($data["allowButton"]) && $data["allowButton"] == "on") ? 1 : 0;
        endif;
        $data["img_url"] = $slide->img_url;
        if (!empty($_FILES["img_url"]["name"])) :
            $image = upload_picture("img_url", "uploads/$this->viewFolder",["width" => 1920,"height" => 750]);
            if ($image["success"]) :
                $data["img_url"] = $image["file_name"];
                if (!empty($slide->img_url)) :
                    if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$slide->img_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$slide->img_url}")) :
                        unlink(FCPATH . "uploads/{$this->viewFolder}/{$slide->img_url}");
                    endif;
                endif;
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Slayt Güncelleştirilirken Hata Oluştu. Slayt Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                die();
            endif;
        endif;
        $data["description"] = $_POST["description"];
        $update = $this->slide_model->update(["id" => $id], $data);
        if ($update) :
            echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Slayt Başarıyla Güncelleştirildi."]);
        else :
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Slayt Güncelleştirilirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
        endif;
    }
    public function delete($id)
    {
        $slide = $this->slide_model->get(["id" => $id]);
        if (!empty($slide)) :
            $delete = $this->slide_model->delete(["id"    => $id]);
            if (!empty($slide->img_url)) :
                if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$slide->img_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$slide->img_url}")) :
                    unlink(FCPATH . "uploads/{$this->viewFolder}/{$slide->img_url}");
                endif;
            endif;
            if ($delete) :
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Slayt Başarıyla Silindi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Slayt Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function rankSetter()
    {
        $rows = $this->input->post("rows");
        if (!empty($rows)) :
            foreach ($rows as $row) :
                $this->slide_model->update(
                    [
                        "id" => $row["id"]
                    ],
                    ["rank" => $row["position"]]
                );
            endforeach;
        endif;
    }
    public function isActiveSetter($id)
    {
        if (!empty($id)) :
            $isActive = (intval($this->input->post("data")) === 1) ? 1 : 0;
            if ($this->slide_model->update(["id" => $id], ["isActive" => $isActive])) :
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı"]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı"]);
            endif;
        endif;
    }
}
