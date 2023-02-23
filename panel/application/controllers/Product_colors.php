<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_colors extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "product_colors_v";
        $this->load->model("product_color_model");
        if (!get_active_user()) :
            redirect(base_url("login"));
        endif;
    }
    public function index()
    {
        $viewData = new stdClass();
        $items = $this->product_color_model->get_all();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function datatable()
    {
        $items = $this->product_color_model->getRows([], $_POST);
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
                    <a class="dropdown-item updateProductColorBtn" href="javascript:void(0)" data-url="' . base_url("product_colors/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                </div>
            </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("product_colors/isActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch' . $i . '"></label></div>';
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $item->codes_id, $item->title, $item->codes, $checkbox, turkishDate("d F Y, l H:i:s", $item->createdAt), turkishDate("d F Y, l H:i:s", $item->updatedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->product_color_model->rowCount(),
            "recordsFiltered" => $this->product_color_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        ];
        // Output to JSON format
        echo json_encode($output);
    }
    public function update_form($id)
    {
        $viewData = new stdClass();
        $viewData->item = $this->product_color_model->get(["id" => $id]);
        $color = $this->product_color_model->get_all(["id!=" => $viewData->item->id]);
        $viewData->colors = $color;
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function update($id)
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"] && checkEmpty($data)["key"] != "img_url" && checkEmpty($data)["key"] != "home_url" && checkEmpty($data)["key"] != "banner_url") :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Rengi Güncelleştirilirken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            $product_color = $this->product_color_model->get(["id" => $id]);
            if (!empty($product_color->img_url)) :
                $data["img_url"] = $product_color->img_url;
            endif;
            if (!empty($_FILES["img_url"]["name"])) :
                $image = upload_picture("img_url", "uploads/$this->viewFolder", [], "*");
                if ($image["success"]) :
                    $data["img_url"] = $image["file_name"];
                    if (!empty($product_color->img_url)) :
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$product_color->img_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$product_color->img_url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$product_color->img_url}");
                        endif;
                    endif;
                else :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Rengi Güncelleştirilirken Hata Oluştu. Ürün Rengi Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                    die();
                endif;
            endif;
            if (!empty($product_color->home_url)) :
                $data["home_url"] = $product_color->home_url;
            endif;
            if (!empty($_FILES["home_url"]["name"])) :
                $image = upload_picture("home_url", "uploads/$this->viewFolder", [], "*");
                if ($image["success"]) :
                    $data["home_url"] = $image["file_name"];
                    if (!empty($product_color->home_url)) :
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$product_color->home_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$product_color->home_url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$product_color->home_url}");
                        endif;
                    endif;
                else :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Rengi Güncelleştirilirken Hata Oluştu. Ürün Rengi Anasayfa Yatay Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                    die();
                endif;
            endif;
            if (!empty($product_color->banner_url)) :
                $data["banner_url"] = $product_color->banner_url;
            endif;
            if (!empty($_FILES["banner_url"]["name"])) :
                $image = upload_picture("banner_url", "uploads/$this->viewFolder", [], "*");
                if ($image["success"]) :
                    $data["banner_url"] = $image["file_name"];
                    if (!empty($product_color->banner_url)) :
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$product_color->banner_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$product_color->banner_url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$product_color->banner_url}");
                        endif;
                    endif;
                else :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Rengi Güncelleştirilirken Hata Oluştu. Ürün Rengi Banner Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                    die();
                endif;
            endif;
            $data["seo_url"] = seo($data["title"]);
            $update = $this->product_color_model->update(["id" => $id], $data);
            if ($update) :
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Rengi Başarıyla Güncelleştirildi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Rengi Güncelleştirilirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function rankSetter()
    {
        $rows = $this->input->post("rows");
        if (!empty($rows)) :
            foreach ($rows as $row) :
                $this->product_color_model->update(
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
            if ($this->product_color_model->update(["id" => $id], ["isActive" => $isActive])) :
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı"]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı"]);
            endif;
        endif;
    }

    public function getColors()
    {
        try {
            set_time_limit(0);
            ini_set('memory_limit', '-1');
            $codesConnections = $this->general_model->get_all("codes", null, null, ["isActive" => 1]);
            if (!empty($codesConnections)) {
                $rank = 1;
                foreach ($codesConnections as $codesConnectionsKey => $codesConnectionsValue) {
                    $products = $this->general_model->get_all("products", null, null, ["isActive" => 1, "codes" => $codesConnectionsValue->id], [], [], [], [], true, ["color_id"]);
                    if (!empty($products)) {
                        foreach ($products as $returnKey => $returnValue) {
                            $this->general_model->replace("product_colors", [
                                'id' => $rank,
                                'codes_id' => intval(clean($returnValue->color_id)) ?? NULL,
                                'title' => clean($returnValue->color) ?? NULL,
                                'seo_url' => clean(seo($returnValue->color)) ?? NULL,
                                'isActive' => 1,
                                'rank' => $rank,
                                'codes' => clean($codesConnectionsValue->id) ?? NULL
                            ]);
                            $rank++;
                        }
                    }
                }
            }
            echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Renkleri Codes İle Başarıyla Eşitlendi."]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "title" => "Hata!", "message" => $e->getMessage()]);
        }
    }
}
