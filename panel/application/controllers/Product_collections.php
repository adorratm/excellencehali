<?php
defined('BASEPATH') or exit('No direct script access allowed');

class product_collections extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "product_collections_v";
        $this->load->model("product_collection_model");
        $this->load->model("product_image_model");
        $this->load->model("product_model");
        if (!get_active_user()) :
            redirect(base_url("login"));
        endif;
    }
    public function index()
    {
        $viewData = new stdClass();
        $items = $this->product_collection_model->get_all();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function datatable()
    {
        $items = $this->product_collection_model->getRows([], $_POST);
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
                    <a class="dropdown-item updateProductCollectionBtn" href="javascript:void(0)" data-url="' . base_url("product_collections/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                </div>
            </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("product_collections/isActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch' . $i . '"></label></div>';
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $item->codes_id, $item->title, $item->codes, $checkbox, turkishDate("d F Y, l H:i:s", $item->createdAt), turkishDate("d F Y, l H:i:s", $item->updatedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->product_collection_model->rowCount(),
            "recordsFiltered" => $this->product_collection_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        ];
        // Output to JSON format
        echo json_encode($output);
    }
    public function update_form($id)
    {
        $viewData = new stdClass();
        $viewData->item = $this->product_collection_model->get(["id" => $id]);
        $collection = $this->product_collection_model->get_all(["id!=" => $viewData->item->id]);
        $viewData->collections = $collection;
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
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Koleksiyonu Güncelleştirilirken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            $product_collection = $this->product_collection_model->get(["id" => $id]);
            if (!empty($product_collection->img_url)) :
                $data["img_url"] = $product_collection->img_url;
            endif;
            if (!empty($_FILES["img_url"]["name"])) :
                $image = upload_picture("img_url", "uploads/$this->viewFolder", [], "*");
                if ($image["success"]) :
                    $data["img_url"] = $image["file_name"];
                    if (!empty($product_collection->img_url)) :
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$product_collection->img_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$product_collection->img_url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$product_collection->img_url}");
                        endif;
                    endif;
                else :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Koleksiyonu Güncelleştirilirken Hata Oluştu. Ürün Koleksiyonu Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                    die();
                endif;
            endif;
            if (!empty($product_collection->home_url)) :
                $data["home_url"] = $product_collection->home_url;
            endif;
            if (!empty($_FILES["home_url"]["name"])) :
                $image = upload_picture("home_url", "uploads/$this->viewFolder", [], "*");
                if ($image["success"]) :
                    $data["home_url"] = $image["file_name"];
                    if (!empty($product_collection->home_url)) :
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$product_collection->home_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$product_collection->home_url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$product_collection->home_url}");
                        endif;
                    endif;
                else :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Koleksiyonu Güncelleştirilirken Hata Oluştu. Ürün Koleksiyonu Anasayfa Yatay Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                    die();
                endif;
            endif;
            if (!empty($product_collection->banner_url)) :
                $data["banner_url"] = $product_collection->banner_url;
            endif;
            if (!empty($_FILES["banner_url"]["name"])) :
                $image = upload_picture("banner_url", "uploads/$this->viewFolder", [], "*");
                if ($image["success"]) :
                    $data["banner_url"] = $image["file_name"];
                    if (!empty($product_collection->banner_url)) :
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$product_collection->banner_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$product_collection->banner_url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$product_collection->banner_url}");
                        endif;
                    endif;
                else :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Koleksiyonu Güncelleştirilirken Hata Oluştu. Ürün Koleksiyonu Banner Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                    die();
                endif;
            endif;
            $data["seo_url"] = seo($data["title"]);
            $update = $this->product_collection_model->update(["id" => $id], $data);
            if ($update) :
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Koleksiyonu Başarıyla Güncelleştirildi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Koleksiyonu Güncelleştirilirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function rankSetter()
    {
        $rows = $this->input->post("rows");
        if (!empty($rows)) :
            foreach ($rows as $row) :
                $this->product_collection_model->update(
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
            if ($this->product_collection_model->update(["id" => $id], ["isActive" => $isActive])) :
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı"]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı"]);
            endif;
        endif;
    }

    public function getCollections(){
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $codesConnections = $this->general_model->get_all("codes",null, null, ["isActive" => 1]);

        if (!empty($codesConnections)) {
            $rank = 1;
            foreach ($codesConnections as $codesConnectionsKey => $codesConnectionsValue) {
                $data = @curl_request($codesConnectionsValue->host, $codesConnectionsValue->port, "kalite", [], ['Content-Type: application/json', 'Accept: application/json', 'X-TOKEN: ' . $codesConnectionsValue->token])->data;
                if (!empty($data)) {
                    foreach ($data as $returnKey => $returnValue) {
                        $this->general_model->replace("product_collections",[
                            'id' => $rank,
                            'codes_id' => intval(clean($returnValue->Id)) ?? NULL,
                            'title' => clean($returnValue->Kod) ?? NULL,
                            'seo_url' => clean(seo($returnValue->Kod)) ?? NULL,
                            'isActive' => clean($returnValue->Durum) == 0 ? 1 : 0,
                            'rank' => $rank,
                            'codes' => clean($codesConnectionsValue->id) ?? NULL
                        ]);
                        $rank++;
                    }
                }
            }
        }
        echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Koleksiyonları Codes İle Başarıyla Eşitlendi."]);
    }
}
