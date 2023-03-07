<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "products_v";
        $this->load->model("product_model");
        $this->load->model("product_collection_model");
        $this->load->model("product_image_model");
        $this->load->model("product_dimension_model");
        $this->load->model("product_detail_model");
        if (!get_active_user()) :
            redirect(base_url("login"));
        endif;
    }
    public function index()
    {
        $viewData = new stdClass();
        $items = $this->product_model->get_all([], "rank ASC");
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function datatable()
    {
        $items = $this->product_model->getRows([], $_POST);
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
                        <a class="dropdown-item updateProductBtn" href="javascript:void(0)" data-url="' . base_url("products/update_form/$item->codes_id/$item->codes") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                        <a class="dropdown-item" href="' . base_url("products/upload_form/$item->codes_id/$item->codes") . '"><i class="fa fa-image mr-2"></i>Resimler</a>
                    </div>
                </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("products/isActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch4' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch4' . $i . '"></label></div>';
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $item->codes_id, $item->title, $item->brand, $item->collection, $item->pattern, $item->color, $item->dimension, $item->codes, $checkbox, turkishDate("d F Y, l H:i:s", $item->updatedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->product_model->rowCount([]),
            "recordsFiltered" => $this->product_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        ];
        // Output to JSON format
        echo json_encode($output);
    }
    public function update_form($codes_id, $codes)
    {
        $viewData = new stdClass();
        $viewData->item = $this->general_model->get("products p", "p.*,pd.features features, pd.content content,pd.description description", ["p.codes_id" => $codes_id, "p.codes" => $codes], ["product_details pd" => ["pd.codes = p.codes_id AND pd.codes = p.codes", "left"]], [], [], true, "p.codes_id");
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->collections = $this->product_collection_model->get_all();
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function update($codes_id, $codes)
    {
        $data = $this->input->post();
        if (checkEmpty($data)["error"] && checkEmpty($data)["key"] !== "content" && checkEmpty($data)["key"] !== "description" && checkEmpty($data)["key"] !== "features") :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Güncelleştirilirken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            $data["content"] = clean($_POST["content"]) ? $_POST["content"] : NULL;
            $data["description"] = clean($_POST["description"]) ? $_POST["description"] : NULL;
            $data["features"] = clean($_POST["features"]) ? $_POST["features"] : NULL;
            $update = false;
            if ($this->product_detail_model->rowCount(["codes_id" => $codes_id, "codes" => $codes])) :
                $update = $this->product_detail_model->update(["codes_id" => $codes_id, "codes" => $codes], $data);
            endif;
            if (!$this->product_detail_model->rowCount(["codes_id" => $codes_id, "codes" => $codes])) :
                $data["codes_id"] = $codes_id;
                $data["codes"] = $codes;
                $update = $this->product_detail_model->add($data);
            endif;
            if ($update) :
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Başarıyla Güncelleştirildi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Güncelleştirilirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function rankSetter()
    {
        $rows = $this->input->post("rows");
        if (!empty($rows)) :
            foreach ($rows as $row) :
                $this->product_model->update(
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
            if ($this->product_model->update(["id" => $id], ["isActive" => $isActive])) :
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "message" => "Güncelleme İşlemi Yapıldı."]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "message" => "Güncelleme İşlemi Yapılamadı."]);
            endif;
        endif;
    }
    public function detailDatatable($codes_id, $codes)
    {
        $items = $this->product_image_model->getRows(
            ["codes_id" => $codes_id, "codes" => $codes],
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
                        <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="detailTable" data-url="' . base_url("products/fileDelete/{$item->id}") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                        </div>
                </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("products/fileIsActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch' . $i . '"></label></div>';
                $checkbox2 = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-table="detailTable" data-url="' . base_url("products/fileIsCoverSetter/{$item->id}/$item->codes_id/$item->codes/$item->lang") . '" data-status="' . ($item->isCover == 1 ? "checked" : null) . '" id="customSwitch2' . $i . '" type="checkbox" ' . ($item->isCover == 1 ? "checked" : null) . ' class="isCover custom-control-input" >  <label class="custom-control-label" for="customSwitch2' . $i . '"></label></div>';
                $image = '<img src="' . base_url("uploads/{$this->viewFolder}/{$item->url}") . '" width="75">';
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $image, $item->url, $item->lang, $checkbox2, $checkbox, turkishDate("d F Y, l H:i:s", $item->createdAt), turkishDate("d F Y, l H:i:s", $item->updatedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->product_image_model->rowCount(["codes_id" => $codes_id, "codes" => $codes]),
            "recordsFiltered" => $this->product_image_model->countFiltered(["codes_id" => $codes_id, "codes" => $codes], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        ];
        // Output to JSON format
        echo json_encode($output);
    }
    public function upload_form($codes_id, $codes)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $viewData->item = $this->product_model->get(["codes_id" => $codes_id, "codes" => $codes]);
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $viewData->items = $this->product_image_model->get_all(["codes_id" => $codes_id, "codes" => $codes], "rank ASC");
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function file_upload($codes_id, $codes, $lang)
    {
        $resize = ['height' => 1000, 'width' => 1000, 'maintain_ratio' => FALSE, 'master_dim' => 'height'];
        $image = upload_picture("file", "uploads/$this->viewFolder/", $resize, "*");
        if ($image["success"]) :
            $getRank = $this->product_image_model->rowCount();
            $this->product_image_model->add(
                [
                    "url"           => $image["file_name"],
                    "rank"          => $getRank + 1,
                    "codes_id"      => $codes_id,
                    "codes"         => $codes,
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
        $fileName = $this->product_image_model->get(["id" => $id]);
        $delete = $this->product_image_model->delete(["id" => $id]);
        if ($delete) :
            $url = FCPATH . "uploads/{$this->viewFolder}/{$fileName->url}";
            if (!is_dir($url) && file_exists($url)) :
                unlink($url);
            endif;
            echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Görseli Başarıyla Silindi."]);
        else :
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Görseli Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
        endif;
    }
    public function fileIsActiveSetter($id)
    {
        if (!empty($id)) :
            $isActive = (intval($this->input->post("data")) === 1) ? 1 : 0;
            if ($this->product_image_model->update(["id" => $id], ["isActive" => $isActive])) :
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "message" => "Güncelleme İşlemi Yapıldı"]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "message" => "Güncelleme İşlemi Yapılamadı"]);
            endif;
        endif;
    }
    public function fileRankSetter($codes_id, $codes)
    {
        $rows = $this->input->post("rows");
        if (!empty($rows)) :
            foreach ($rows as $row) :
                $this->product_image_model->update(
                    [
                        "id" => $row["id"],
                        "codes_id" => $codes_id,
                        "codes" => $codes
                    ],
                    ["rank" => $row["position"]]
                );
            endforeach;
        endif;
    }
    public function fileIsCoverSetter($id, $codes_id, $codes, $lang)
    {
        if (!empty($id) && !empty($lang)) :
            $isCover = (intval($this->input->post("data")) === 1) ? 1 : 0;
            if ($this->product_image_model->update(["id" => $id, "codes_id" => $codes_id, "codes" => $codes], ["isCover" => $isCover, "lang" => $lang])) :
                $this->product_image_model->update(["id!=" => $id, "codes_id" => $codes_id, "codes" => $codes], ["isCover" => 0, "lang" => $lang]);
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "message" => "Güncelleme İşlemi Yapıldı"]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "message" => "Güncelleme İşlemi Yapılamadı"]);
            endif;
        endif;
    }
    public function getStocks()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1'); 
        codesLogin();
        $codesConnections = $this->general_model->get_all("codes", null, null, ["isActive" => 1]);
        if (!empty($codesConnections)) {
            $rank = 1;
            foreach ($codesConnections as $codesConnectionsKey => $codesConnectionsValue) {
                $data = @curl_request($codesConnectionsValue->host, $codesConnectionsValue->port, "stoklistele", [], ['Content-Type: application/json', 'Accept: application/json', 'X-TOKEN: ' . $codesConnectionsValue->token])->data;
                if (!empty($data)) {
                    foreach ($data as $returnKey => $returnValue) {
                        $this->general_model->replace("products", [
                            'id' => $rank,
                            'codes_id' => intval(clean($returnValue->Id)) ?? NULL,
                            'title' => clean($returnValue->Baslik) ?? NULL,
                            'seo_url' => clean(seo($returnValue->Baslik)) ?? NULL,
                            'barcode' => clean($returnValue->barcode) ?? NULL,
                            'collection_id' => clean($returnValue->Ok1Id) ?? NULL,
                            'collection' => clean($returnValue->Ozelkod1) ?? NULL,
                            'pattern_id' => clean($returnValue->Ok2Id) ?? NULL,
                            'pattern' => clean($returnValue->Ozelkod2) ?? NULL,
                            'color_id' =>  clean($returnValue->Ok3Id) ?? NULL,
                            'color' =>  clean($returnValue->Ozelkod3) ?? NULL,
                            'dimension_id' =>  clean($returnValue->Ok4Id) ?? NULL,
                            'dimension' =>  clean($returnValue->Ozelkod4) ?? NULL,
                            'brand_id' => clean($returnValue->Ok8Id) ?? NULL,
                            'brand' => clean($returnValue->Ozelkod8) ?? NULL,
                            'price' => clean($returnValue->Fiyat1) ?? NULL,
                            'discounted_price' => clean($returnValue->Fiyat2) ?? NULL,
                            'vat' => clean($returnValue->KDV) ?? NULL,
                            'stock' => clean($returnValue->stok) ?? NULL,
                            'isActive' => clean($returnValue->Durum) == 1 ? 1 : 0,
                            'rank' => $rank,
                            'codes' => clean($codesConnectionsValue->id) ?? NULL,
                            'dimension_type' => @str_contains(clean($returnValue->Ozelkod4),"XR") ? "ROLL" : "METER",
                        ]);
                        $rank++;
                    }
                }
            }
        }
        echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürünler Codes İle Başarıyla Eşitlendi."]);
    }
}
