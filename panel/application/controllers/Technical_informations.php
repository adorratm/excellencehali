<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Technical_informations extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "technical_informations_v";
        $this->load->model("technical_information_model");
        $this->load->model("technical_information_category_model");
        $this->load->model("technical_informations_w_categories_model");
        $this->load->model("technical_information_image_model");
        $this->load->model("technical_information_dimension_model");
        if (!get_active_user()) :
            redirect(base_url("login"));
        endif;
    }
    public function index()
    {
        $viewData = new stdClass();
        $items = $this->technical_information_model->get_all([], "rank ASC");
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function datatable()
    {
        $items = $this->technical_information_model->getRows([], $_POST);
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
                        <a class="dropdown-item updateTechnicalInformationBtn" href="javascript:void(0)" data-url="' . base_url("technical_informations/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                        <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="technicalInformationTable" data-url="' . base_url("technical_informations/delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                        <a class="dropdown-item" href="' . base_url("technical_informations/upload_form/$item->id") . '"><i class="fa fa-image mr-2"></i>Resimler</a>
                        <a class="dropdown-item" href="' . base_url("technical_informations/dimensions/$item->id") . '"><i class="fa fa-ruler mr-2"></i>Tablo İşlemleri</a>
                    </div>
                </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("technical_informations/isActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch4' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch4' . $i . '"></label></div>';
                $deleteCheckbox = '<input type="checkbox" name="selectedTechnicalInformation[]" class="editor-active" value="' . $item->id . '">';
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $deleteCheckbox, $item->title, $checkbox, turkishDate("d F Y, l H:i:s", $item->updatedAt), turkishDate("d F Y, l H:i:s", $item->sharedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->technical_information_model->rowCount([]),
            "recordsFiltered" => $this->technical_information_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        ];
        // Output to JSON format
        echo json_encode($output);
    }
    public function new_form()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $viewData->categories = $this->technical_information_category_model->get_all();
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function save()
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"] && checkEmpty($data)["key"] !== "content") :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Teknik Bilgi Kaydı Yapılırken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            $getRank = $this->technical_information_model->rowCount();
            unset($data["category_id"]);
            $data["title"] = stripslashes($data["title"]);
            $data["url"] = seo($data["title"]);
            $data["content"] = $_POST["content"];
            $data["description"] = $_POST["description"];
            $data["features"] = $_POST["features"];
            $data["isActive"] = 1;
            $data["rank"] = $getRank + 1;
            $insert = $this->technical_information_model->add($data);
            if ($insert) :
                if (!empty($_POST["category_id"])) :
                    $this->technical_informations_w_categories_model->delete(["technical_information_id" => $insert]);
                    $arrayOfCategoryIds = [];
                    foreach (array_unique($_POST["category_id"]) as $key => $value) :
                        $this->technical_informations_w_categories_model->add(["technical_information_id" => $insert, "category_id" => $value]);
                        array_push($arrayOfCategoryIds, $value);
                    endforeach;
                endif;
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Teknik Bilgi Başarıyla Eklendi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Teknik Bilgi Eklenirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function update_form($id)
    {
        $viewData = new stdClass();
        $viewData->item = $this->technical_information_model->get(["id" => $id]);
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->selectedCategories = $this->technical_informations_w_categories_model->get_all(["technical_information_id" => $id]);
        $viewData->categories = $this->technical_information_category_model->get_all();
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function update($id)
    {
        $data = $this->input->post();
        if (checkEmpty($data)["error"] && checkEmpty($data)["key"] !== "content") :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Teknik Bilgi Güncelleştirilirken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            $data["title"] = stripslashes($data["title"]);
            $data["url"] = seo($data["title"]);
            $data["content"] = $_POST["content"];
            $data["description"] = $_POST["description"];
            $data["features"] = $_POST["features"];
            unset($data["category_id"]);
            $update = $this->technical_information_model->update(["id" => $id], $data);
            if ($update) :
                if (!empty($_POST["category_id"])) :
                    $this->technical_informations_w_categories_model->delete(["technical_information_id" => $id]);
                    foreach (array_unique($_POST["category_id"]) as $key => $value) :
                        $this->technical_informations_w_categories_model->add(["technical_information_id" => $id, "category_id" => $value]);
                    endforeach;
                endif;
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Teknik Bilgi Başarıyla Güncelleştirildi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Teknik Bilgi Güncelleştirilirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function delete($id)
    {
        $technical_information = $this->technical_information_model->get(["id" => $id]);
        if (!empty($technical_information)) :
            $technical_information_images = $this->technical_information_image_model->get_all(["technical_information_id" => $id]);
            $delete = $this->technical_information_model->delete(["id"    => $id]);
            if ($delete) :
                $this->general_model->delete("technical_information_dimensions", ["technical_information_id" => $id]);
                if (!empty($technical_information_images)) :
                    foreach ($technical_information_images as $key => $value) :
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$value->url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$value->url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$value->url}");
                        endif;
                    endforeach;
                endif;
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Teknik Bilgi Başarıyla Silindi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Teknik Bilgi Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function deleteBulk()
    {
        $technical_informationIds = explode(",", $_POST["technical_information_ids"]);
        $technical_informations = $this->general_model->get_all("technical_informations", null, null, [], [], [], [], ["id" => $technical_informationIds]);
        if (!empty($technical_informations)) :
            $delete = $this->db->where_in("id", $technical_informationIds)->delete("technical_informations");
            if ($delete) :
                $this->db->where_in("technical_information_id", $technical_informationIds)->delete("technical_information_dimensions");
                $technical_information_images = $this->general_model->get_all("technical_information_images", null, null, [], [], [], [], ["technical_information_id" => $technical_informationIds]);
                if (!empty($technical_information_images)) :
                    foreach ($technical_information_images as $key => $value) :
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$value->url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$value->url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$value->url}");
                        endif;
                    endforeach;
                endif;
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Seçili Teknik Bilgiler Başarıyla Silindi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Seçili Teknik Bilgiler Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function rankSetter()
    {
        $rows = $this->input->post("rows");
        if (!empty($rows)) :
            foreach ($rows as $row) :
                $this->technical_information_model->update(
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
            if ($this->technical_information_model->update(["id" => $id], ["isActive" => $isActive])) :
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı."]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı."]);
            endif;
        endif;
    }
    public function detailDatatable($technical_information_id)
    {
        $items = $this->technical_information_image_model->getRows(
            ["technical_information_id" => $technical_information_id],
            $_POST
        );
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
                        <a class="dropdown-item updateSkuBtn" href="javascript:void(0)" data-table="detailTable" data-url="' . base_url("technical_informations/fileUpdate/{$item->id}/{$technical_information_id}") . '"><i class="fa fa-barcode mr-2"></i>SKU Kodu Ekle</a>
                        <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="detailTable" data-url="' . base_url("technical_informations/fileDelete/{$item->id}") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                        </div>
                </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("technical_informations/fileIsActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch' . $i . '"></label></div>';
                $checkbox2 = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-table="detailTable" data-url="' . base_url("technical_informations/fileIsCoverSetter/{$item->id}/$item->technical_information_id/$item->lang") . '" data-status="' . ($item->isCover == 1 ? "checked" : null) . '" id="customSwitch2' . $i . '" type="checkbox" ' . ($item->isCover == 1 ? "checked" : null) . ' class="isCover custom-control-input" >  <label class="custom-control-label" for="customSwitch2' . $i . '"></label></div>';
                $image = '<img src="' . base_url("uploads/{$this->viewFolder}/{$item->url}") . '" width="75">';
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $image, $item->url, $item->lang, $checkbox2, $checkbox, turkishDate("d F Y, l H:i:s", $item->createdAt), turkishDate("d F Y, l H:i:s", $item->updatedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->technical_information_image_model->rowCount(["technical_information_id" => $technical_information_id]),
            "recordsFiltered" => $this->technical_information_image_model->countFiltered(["technical_information_id" => $technical_information_id], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        ];
        // Output to JSON format
        echo json_encode($output);
    }
    public function upload_form($id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $viewData->item = $this->technical_information_model->get(["id" => $id]);
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $viewData->items = $this->technical_information_image_model->get_all(["technical_information_id" => $id], "rank ASC");
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function fileUpdate($id, $technical_information_id)
    {
        $viewData = new stdClass();
        $viewData->technical_information_id =  $technical_information_id;
        $viewData->item = $this->technical_information_image_model->get(["id" => $id, "technical_information_id" => $technical_information_id]);
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "file_update";
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function file_update($id, $technical_information_id)
    {
        $data = rClean($this->input->post());
        $update = $this->technical_information_image_model->update(["id" => $id, "technical_information_id" => $technical_information_id], $data);
        if ($update) :
            echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Teknik Bilgi Görseli Varyasyon Grupları Başarıyla Güncelleştirildi."]);
        else :
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Teknik Bilgi Görseli Varyasyon Grupları Güncelleştirilirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
        endif;
    }
    public function file_upload($technical_information_id, $lang)
    {
        $resize = ['height' => 1280, 'width' => 1920, 'maintain_ratio' => FALSE, 'master_dim' => 'height'];
        $image = upload_picture("file", "uploads/$this->viewFolder/", $resize);
        if ($image["success"]) :
            $getRank = $this->technical_information_image_model->rowCount();
            $this->technical_information_image_model->add(
                [
                    "url"           => $image["file_name"],
                    "rank"          => $getRank + 1,
                    "technical_information_id"    => $technical_information_id,
                    "isActive"      => 1,
                    "lang"          => $lang
                ]
            );
        else :
            echo $image["error"];
        endif;
    }
    public function fileDelete($id)
    {
        $fileName = $this->technical_information_image_model->get(["id" => $id]);
        $delete = $this->technical_information_image_model->delete(["id" => $id]);
        if ($delete) :
            $url = FCPATH . "uploads/{$this->viewFolder}/{$fileName->url}";
            if (!is_dir($url) && file_exists($url)) :
                unlink($url);
            endif;
            echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Teknik Bilgi Görseli Başarıyla Silindi."]);
        else :
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Teknik Bilgi Görseli Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
        endif;
    }
    public function fileIsActiveSetter($id)
    {
        if (!empty($id)) :
            $isActive = (intval($this->input->post("data")) === 1) ? 1 : 0;
            if ($this->technical_information_image_model->update(["id" => $id], ["isActive" => $isActive])) :
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı"]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı"]);
            endif;
        endif;
    }
    public function fileRankSetter($technical_information_id)
    {
        $rows = $this->input->post("rows");
        if (!empty($rows)) :
            foreach ($rows as $row) :
                $this->technical_information_image_model->update(
                    [
                        "id" => $row["id"],
                        "technical_information_id" => $technical_information_id
                    ],
                    ["rank" => $row["position"]]
                );
            endforeach;
        endif;
    }
    public function fileIsCoverSetter($id, $technical_information_id, $lang)
    {
        if (!empty($id) && !empty($lang)) :
            $isCover = (intval($this->input->post("data")) === 1) ? 1 : 0;
            if ($this->technical_information_image_model->update(["id" => $id, "technical_information_id" => $technical_information_id], ["isCover" => $isCover, "lang" => $lang])) :
                $this->technical_information_image_model->update(["id!=" => $id, "technical_information_id" => $technical_information_id], ["isCover" => 0, "lang" => $lang]);
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı"]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı"]);
            endif;
        endif;
    }

    public function dimensions($technical_information_id)
    {
        $viewData = new stdClass();
        $viewData->technical_information_id =  $technical_information_id;
        $viewData->item = $this->technical_information_model->get(["id" => $technical_information_id]);
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "dimensions/list";
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function dimensionsDatatable($technical_information_id)
    {
        $items = $this->technical_information_dimension_model->getRows(["technical_information_id" => $technical_information_id], $_POST);
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
                        <a class="dropdown-item updateTechnicalInformationDimensionsBtn" href="javascript:void(0)" data-url="' . base_url("technical_informations/dimensions_update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                        <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="technicalInformationDimensionsTable" data-url="' . base_url("technical_informations/dimensions_delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                    </div>
                </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("technical_informations/dimensionsIsActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch4' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch4' . $i . '"></label></div>';
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $item->title, $item->lang, $checkbox, turkishDate("d F Y, l H:i:s", $item->createdAt), turkishDate("d F Y, l H:i:s", $item->updatedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->technical_information_dimension_model->rowCount(["technical_information_id" => $technical_information_id]),
            "recordsFiltered" => $this->technical_information_dimension_model->countFiltered(["technical_information_id" => $technical_information_id], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        ];
        // Output to JSON format
        echo json_encode($output);
    }
    public function dimensions_new_form($technical_information_id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "dimensions/add";
        $viewData->technical_information_id = $technical_information_id;
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function dimensionsSave()
    {
        $data = rClean($this->input->post());
        if (!empty($_FILES)) :
            if (empty($_FILES["img_url"]["name"])) :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Teknik Bilgi Tablosu Eklenirken Hata Oluştu. Teknik Bilgi Tablosu Görseli Seçtiğinizden Emin Olup, Lütfen Tekrar Deneyin."]);
                die();
            endif;
            $image = upload_picture("img_url", "uploads/$this->viewFolder", [], "*");
            if ($image["success"]) :
                $data["img_url"] = $image["file_name"];
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Teknik Bilgi Tablosu Kaydı Yapılırken Hata Oluştu. Teknik Bilgi Tablosu Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                die();
            endif;
        endif;
        $getRank = $this->technical_information_dimension_model->rowCount();
        $data["title"] = @stripslashes($data["title"]);
        $data["isActive"] = 1;
        $data["rank"] = $getRank + 1;
        $insert = $this->technical_information_dimension_model->add($data);
        if ($insert) :
            echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Teknik Bilgi Tablosu Başarıyla Eklendi."]);
        else :
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Teknik Bilgi Tablosu Eklenirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
        endif;
    }
    public function dimensions_update_form($id)
    {
        $viewData = new stdClass();
        $viewData->item = $this->technical_information_dimension_model->get(["id" => $id]);
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "dimensions/update";
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function dimensionsUpdate($id)
    {
        $data = rClean($this->input->post());

        $technical_informationDimension = $this->technical_information_dimension_model->get(["id" => $id]);
        if (!empty($technical_informationDimension->img_url)) :
            $data["img_url"] = $technical_informationDimension->img_url;
        endif;
        if (!empty($_FILES["img_url"]["name"])) :
            $image = upload_picture("img_url", "uploads/$this->viewFolder", [], "*");
            if ($image["success"]) :
                $data["img_url"] = $image["file_name"];
                if (!empty($technical_informationDimension->img_url)) :
                    if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$technical_informationDimension->img_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$technical_informationDimension->img_url}")) :
                        unlink(FCPATH . "uploads/{$this->viewFolder}/{$technical_informationDimension->img_url}");
                    endif;
                endif;
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Teknik Bilgi Tablosu Güncelleştirilirken Hata Oluştu. Teknik Bilgi Tablosu Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                die();
            endif;
        endif;
        $data["title"] = @stripslashes($data["title"]);
        $update = $this->technical_information_dimension_model->update(["id" => $id], $data);
        if ($update) :
            echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Teknik Bilgi Tablosu Başarıyla Güncelleştirildi."]);
        else :
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Teknik Bilgi Tablosu Güncelleştirilirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
        endif;
    }
    public function dimensionsDelete($id)
    {
        $technical_informationDimension = $this->technical_information_dimension_model->get(["id" => $id]);
        if (!empty($technical_informationDimension)) :
            $delete = $this->technical_information_dimension_model->delete(["id"    => $id]);
            if ($delete) :
                if (!empty($technical_informationDimension->img_url)) :
                    if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$technical_informationDimension->img_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$technical_informationDimension->img_url}")) :
                        unlink(FCPATH . "uploads/{$this->viewFolder}/{$technical_informationDimension->img_url}");
                    endif;
                endif;
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Teknik Bilgi Tablosu Başarıyla Silindi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Teknik Bilgi Tablosu Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function dimensionsRankSetter()
    {
        $rows = $this->input->post("rows");
        if (!empty($rows)) :
            foreach ($rows as $row) :
                $this->technical_information_dimension_model->update(
                    [
                        "id" => $row["id"]
                    ],
                    ["rank" => $row["position"]]
                );
            endforeach;
        endif;
    }
    public function dimensionsIsActiveSetter($id)
    {
        if (!empty($id)) :
            $isActive = (intval($this->input->post("data")) === 1) ? 1 : 0;
            if ($this->technical_information_dimension_model->update(["id" => $id], ["isActive" => $isActive])) :
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı."]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı."]);
            endif;
        endif;
    }
}
