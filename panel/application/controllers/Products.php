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
        $this->load->model("product_category_model");
        $this->load->model("products_w_categories_model");
        $this->load->model("product_image_model");
        $this->load->model("product_dimension_model");
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
                        <a class="dropdown-item updateProductBtn" href="javascript:void(0)" data-url="' . base_url("products/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                        <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="productTable" data-url="' . base_url("products/delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                        <a class="dropdown-item" href="' . base_url("products/upload_form/$item->id") . '"><i class="fa fa-image mr-2"></i>Resimler</a>
                        <a class="dropdown-item" href="' . base_url("products/dimensions/$item->id") . '"><i class="fa fa-ruler mr-2"></i>Tablo İşlemleri</a>
                    </div>
                </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("products/isActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch4' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch4' . $i . '"></label></div>';
                $deleteCheckbox = '<input type="checkbox" name="selectedProduct[]" class="editor-active" value="' . $item->id . '">';
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $deleteCheckbox, $item->title, $checkbox, turkishDate("d F Y, l H:i:s", $item->updatedAt), turkishDate("d F Y, l H:i:s", $item->sharedAt), $proccessing];
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
    public function new_form()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $viewData->categories = $this->product_category_model->get_all();
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $viewData->technical_informations = $this->general_model->get_all("technical_informations", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function save()
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"] && checkEmpty($data)["key"] !== "content") :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Kaydı Yapılırken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            if (!empty($_FILES)) :
                if (!empty($_FILES["img_url"]["name"])) :
                    $resize = ['height' => 1280, 'width' => 1920, 'maintain_ratio' => FALSE, 'master_dim' => 'height'];
                    $image = upload_picture("img_url", "uploads/$this->viewFolder", $resize, "*");
                    if ($image["success"]) :
                        $data["img_url"] = $image["file_name"];
                    else :
                        echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Kaydı Yapılırken Hata Oluştu. Ürün Kullanım Alanı Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                        die();
                    endif;
                endif;
            endif;
            $getRank = $this->product_model->rowCount();
            unset($data["category_id"]);
            $data["title"] = stripslashes($data["title"]);
            $data["url"] = seo($data["title"]);
            $data["content"] = $_POST["content"];
            $data["description"] = $_POST["description"];
            $data["features"] = $_POST["features"];
            $data["isActive"] = 1;
            $data["rank"] = $getRank + 1;
            $insert = $this->product_model->add($data);
            if ($insert) :
                if (!empty($_POST["category_id"])) :
                    $this->products_w_categories_model->delete(["product_id" => $insert]);
                    $arrayOfCategoryIds = [];
                    foreach (array_unique($_POST["category_id"]) as $key => $value) :
                        $this->products_w_categories_model->add(["product_id" => $insert, "category_id" => $value]);
                        array_push($arrayOfCategoryIds, $value);
                    endforeach;
                endif;
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Başarıyla Eklendi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Eklenirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function update_form($id)
    {
        $viewData = new stdClass();
        $viewData->item = $this->product_model->get(["id" => $id]);
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->selectedCategories = $this->products_w_categories_model->get_all(["product_id" => $id]);
        $viewData->categories = $this->product_category_model->get_all();
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $viewData->technical_informations = $this->general_model->get_all("technical_informations", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function update($id)
    {
        $data = $this->input->post();
        if (checkEmpty($data)["error"] && checkEmpty($data)["key"] !== "content") :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Güncelleştirilirken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            if (!empty($_FILES)) :
                if (!empty($_FILES["img_url"]["name"])) :
                    $resize = ['height' => 1280, 'width' => 1920, 'maintain_ratio' => FALSE, 'master_dim' => 'height'];
                    $image = upload_picture("img_url", "uploads/$this->viewFolder", $resize, "*");
                    if ($image["success"]) :
                        $data["img_url"] = $image["file_name"];
                    else :
                        echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Güncelleştirilirken Hata Oluştu. Ürün Kullanım Alanı Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                        die();
                    endif;
                endif;
            endif;
            $data["title"] = stripslashes($data["title"]);
            $data["url"] = seo($data["title"]);
            $data["content"] = $_POST["content"];
            $data["description"] = $_POST["description"];
            $data["features"] = $_POST["features"];
            unset($data["category_id"]);
            $update = $this->product_model->update(["id" => $id], $data);
            if ($update) :
                if (!empty($_POST["category_id"])) :
                    $this->products_w_categories_model->delete(["product_id" => $id]);
                    foreach (array_unique($_POST["category_id"]) as $key => $value) :
                        $this->products_w_categories_model->add(["product_id" => $id, "category_id" => $value]);
                    endforeach;
                endif;
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Başarıyla Güncelleştirildi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Güncelleştirilirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function delete($id)
    {
        $product = $this->product_model->get(["id" => $id]);
        if (!empty($product)) :
            $product_images = $this->product_image_model->get_all(["product_id" => $id]);
            $delete = $this->product_model->delete(["id"    => $id]);
            if ($delete) :
                $this->general_model->delete("product_dimensions", ["product_id" => $id]);
                if (!empty($product_images)) :
                    foreach ($product_images as $key => $value) :
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$value->url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$value->url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$value->url}");
                        endif;
                    endforeach;
                endif;
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Başarıyla Silindi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function deleteBulk()
    {
        $productIds = explode(",", $_POST["product_ids"]);
        $products = $this->general_model->get_all("products", null, null, [], [], [], [], ["id" => $productIds]);
        if (!empty($products)) :
            $delete = $this->db->where_in("id", $productIds)->delete("products");
            if ($delete) :
                $this->db->where_in("product_id", $productIds)->delete("product_dimensions");
                $product_images = $this->general_model->get_all("product_images", null, null, [], [], [], [], ["product_id" => $productIds]);
                if (!empty($product_images)) :
                    foreach ($product_images as $key => $value) :
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$value->url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$value->url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$value->url}");
                        endif;
                    endforeach;
                endif;
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Seçili Ürünler Başarıyla Silindi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Seçili Ürünler Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
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
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı."]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı."]);
            endif;
        endif;
    }
    public function detailDatatable($product_id)
    {
        $items = $this->product_image_model->getRows(
            ["product_id" => $product_id],
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
                        <a class="dropdown-item updateSkuBtn" href="javascript:void(0)" data-table="detailTable" data-url="' . base_url("products/fileUpdate/{$item->id}/{$product_id}") . '"><i class="fa fa-barcode mr-2"></i>SKU Kodu Ekle</a>
                        <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="detailTable" data-url="' . base_url("products/fileDelete/{$item->id}") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                        </div>
                </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("products/fileIsActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch' . $i . '"></label></div>';
                $checkbox2 = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-table="detailTable" data-url="' . base_url("products/fileIsCoverSetter/{$item->id}/$item->product_id/$item->lang") . '" data-status="' . ($item->isCover == 1 ? "checked" : null) . '" id="customSwitch2' . $i . '" type="checkbox" ' . ($item->isCover == 1 ? "checked" : null) . ' class="isCover custom-control-input" >  <label class="custom-control-label" for="customSwitch2' . $i . '"></label></div>';
                $image = '<img src="' . base_url("uploads/{$this->viewFolder}/{$item->url}") . '" width="75">';
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $image, $item->url, $item->lang, $checkbox2, $checkbox, turkishDate("d F Y, l H:i:s", $item->createdAt), turkishDate("d F Y, l H:i:s", $item->updatedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->product_image_model->rowCount(["product_id" => $product_id]),
            "recordsFiltered" => $this->product_image_model->countFiltered(["product_id" => $product_id], (!empty($_POST) ? $_POST : [])),
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
        $viewData->item = $this->product_model->get(["id" => $id]);
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $viewData->items = $this->product_image_model->get_all(["product_id" => $id], "rank ASC");
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function fileUpdate($id, $product_id)
    {
        $viewData = new stdClass();
        $viewData->product_id =  $product_id;
        $viewData->item = $this->product_image_model->get(["id" => $id, "product_id" => $product_id]);
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "file_update";
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function file_update($id, $product_id)
    {
        $data = rClean($this->input->post());
        $update = $this->product_image_model->update(["id" => $id, "product_id" => $product_id], $data);
        if ($update) :
            echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Görseli Varyasyon Grupları Başarıyla Güncelleştirildi."]);
        else :
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Görseli Varyasyon Grupları Güncelleştirilirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
        endif;
    }
    public function file_upload($product_id, $lang)
    {
        $resize = ['height' => 1280, 'width' => 1920, 'maintain_ratio' => FALSE, 'master_dim' => 'height'];
        $image = upload_picture("file", "uploads/$this->viewFolder/", $resize, "*");
        if ($image["success"]) :
            $getRank = $this->product_image_model->rowCount();
            $this->product_image_model->add(
                [
                    "url"           => $image["file_name"],
                    "rank"          => $getRank + 1,
                    "product_id"    => $product_id,
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
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı"]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı"]);
            endif;
        endif;
    }
    public function fileRankSetter($product_id)
    {
        $rows = $this->input->post("rows");
        if (!empty($rows)) :
            foreach ($rows as $row) :
                $this->product_image_model->update(
                    [
                        "id" => $row["id"],
                        "product_id" => $product_id
                    ],
                    ["rank" => $row["position"]]
                );
            endforeach;
        endif;
    }
    public function fileIsCoverSetter($id, $product_id, $lang)
    {
        if (!empty($id) && !empty($lang)) :
            $isCover = (intval($this->input->post("data")) === 1) ? 1 : 0;
            if ($this->product_image_model->update(["id" => $id, "product_id" => $product_id], ["isCover" => $isCover, "lang" => $lang])) :
                $this->product_image_model->update(["id!=" => $id, "product_id" => $product_id], ["isCover" => 0, "lang" => $lang]);
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı"]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı"]);
            endif;
        endif;
    }
    public function dimensions($product_id)
    {
        $viewData = new stdClass();
        $viewData->product_id =  $product_id;
        $viewData->item = $this->product_model->get(["id" => $product_id]);
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "dimensions/list";
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function dimensionsDatatable($product_id)
    {
        $items = $this->product_dimension_model->getRows(["product_id" => $product_id], $_POST);
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
                        <a class="dropdown-item updateProductDimensionsBtn" href="javascript:void(0)" data-url="' . base_url("products/dimensions_update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                        <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="productDimensionsTable" data-url="' . base_url("products/dimensionsDelete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                    </div>
                </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("products/dimensionsIsActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch4' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch4' . $i . '"></label></div>';
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $item->title, $item->lang, $checkbox, turkishDate("d F Y, l H:i:s", $item->createdAt), turkishDate("d F Y, l H:i:s", $item->updatedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->product_dimension_model->rowCount(["product_id" => $product_id]),
            "recordsFiltered" => $this->product_dimension_model->countFiltered(["product_id" => $product_id], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        ];
        // Output to JSON format
        echo json_encode($output);
    }
    public function dimensions_new_form($product_id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "dimensions/add";
        $viewData->product_id = $product_id;
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function dimensionsSave()
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"]) :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Tablosu Kaydı Yapılırken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            if (!empty($_FILES)) :
                if (empty($_FILES["img_url"]["name"])) :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Tablosu Eklenirken Hata Oluştu. Ürün Tablosu Görseli Seçtiğinizden Emin Olup, Lütfen Tekrar Deneyin."]);
                    die();
                endif;
                $image = upload_picture("img_url", "uploads/$this->viewFolder", [], "*");
                if ($image["success"]) :
                    $data["img_url"] = $image["file_name"];
                else :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Tablosu Kaydı Yapılırken Hata Oluştu. Ürün Tablosu Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                    die();
                endif;
            endif;
            $getRank = $this->product_dimension_model->rowCount();
            $data["title"] = stripslashes($data["title"]);
            $data["isActive"] = 1;
            $data["rank"] = $getRank + 1;
            $insert = $this->product_dimension_model->add($data);
            if ($insert) :
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Tablosu Başarıyla Eklendi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Tablosu Eklenirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function dimensions_update_form($id)
    {
        $viewData = new stdClass();
        $viewData->item = $this->product_dimension_model->get(["id" => $id]);
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "dimensions/update";
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function dimensionsUpdate($id)
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"]) :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Tablosu Güncelleştirilirken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            $productDimension = $this->product_dimension_model->get(["id" => $id]);
            if (!empty($productDimension->img_url)) :
                $data["img_url"] = $productDimension->img_url;
            endif;
            if (!empty($_FILES["img_url"]["name"])) :
                $image = upload_picture("img_url", "uploads/$this->viewFolder", [], "*");
                if ($image["success"]) :
                    $data["img_url"] = $image["file_name"];
                    if (!empty($productDimension->img_url)) :
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$productDimension->img_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$productDimension->img_url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$productDimension->img_url}");
                        endif;
                    endif;
                else :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Tablosu Güncelleştirilirken Hata Oluştu. Ürün Tablosu Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                    die();
                endif;
            endif;
            $data["title"] = stripslashes($data["title"]);
            $update = $this->product_dimension_model->update(["id" => $id], $data);
            if ($update) :
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Tablosu Başarıyla Güncelleştirildi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Tablosu Güncelleştirilirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function dimensionsDelete($id)
    {
        $productDimension = $this->product_dimension_model->get(["id" => $id]);
        if (!empty($productDimension)) :
            $delete = $this->product_dimension_model->delete(["id"    => $id]);
            if ($delete) :
                if (!empty($productDimension->img_url)) :
                    if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$productDimension->img_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$productDimension->img_url}")) :
                        unlink(FCPATH . "uploads/{$this->viewFolder}/{$productDimension->img_url}");
                    endif;
                endif;
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Tablosu Başarıyla Silindi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Ürün Tablosu Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function dimensionsRankSetter()
    {
        $rows = $this->input->post("rows");
        if (!empty($rows)) :
            foreach ($rows as $row) :
                $this->product_dimension_model->update(
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
            if ($this->product_dimension_model->update(["id" => $id], ["isActive" => $isActive])) :
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı."]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı."]);
            endif;
        endif;
    }
    public function getStocks()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');
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
                            'brand' => clean($returnValue->Marka) ?? NULL,
                            'price' => clean($returnValue->Fiyat1) ?? NULL,
                            'vat' => clean($returnValue->KDV) ?? NULL,
                            'stock' => clean($returnValue->stok) ?? NULL,
                            'isActive' => clean($returnValue->Durum)  == 0 ? 1 : NULL,
                            'rank' => $rank,
                            'codes' => clean($codesConnectionsValue->id) ?? NULL
                        ]);
                        $rank++;
                    }
                }
            }
        }
    }
}
