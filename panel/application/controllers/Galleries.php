<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galleries extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "galleries_v";
        $this->load->model("gallery_model");
        $this->load->model("image_model");
        $this->load->model("video_model");
        $this->load->model("video_url_model");
        $this->load->model("file_model");
        if (!get_active_user()) :
            redirect(base_url("login"));
        endif;
    }
    public function index()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function datatable()
    {
        $items = $this->gallery_model->getRows([], $_POST);
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
                        <a class="dropdown-item updateGalleryBtn" href="javascript:void(0)" data-url="' . base_url("galleries/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                        <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="galleryTable" data-url="' . base_url("galleries/delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                        <a class="dropdown-item" href="' . base_url("galleries/upload_form/$item->id") . '"><i class="fa ' . ($item->gallery_type == "images" ? "fa-image" : ($item->gallery_type == "videos" ? "fa-video" : "fa-file")) . ' mr-2"></i>' . ($item->gallery_type == "images" ? "Resimler" : ($item->gallery_type == "videos" || $item->gallery_type == "video_urls" ? "Videolar" : "Dosyalar")) . '</a>
                        </div>
                </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("galleries/isActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch' . $i . '"></label></div>';
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $item->title, $item->gallery_type, $item->folder_name, $item->url, $item->lang, $checkbox, turkishDate("d F Y, l H:i:s", $item->createdAt), turkishDate("d F Y, l H:i:s", $item->updatedAt), turkishDate("d F Y, l H:i:s", $item->sharedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->gallery_model->rowCount(),
            "recordsFiltered" => $this->gallery_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
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
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function save()
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"] && checkEmpty($data)["key"] != "img_url") :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Galeri Kaydı Yapılırken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            $getRank = $this->gallery_model->rowCount();
            $gallery_type = $data["gallery_type"];
            $folder_name = null;
            $path         = FCPATH . "uploads/$this->viewFolder/";
            $folder_name = seo($data["title"]);
            $path = "$path/$gallery_type/" . $folder_name;
            
            if (!@mkdir($path, 0755, true)) :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Galeri Oluşturulurken Hata Oluştu. Klasör Erişim Yetkinizin Olduğundan Emin Olup Tekrar Deneyin."]);
                die();
            endif;
            if (!empty($_FILES["img_url"]["name"])) :
                $image = upload_picture("img_url", "uploads/$this->viewFolder/$gallery_type/$folder_name", [], "*");
                if ($image["success"]) :
                    $data["img_url"] = $image["file_name"];
                endif;
            endif;
            $data["url"] =  seo($data["title"]);
            $data["folder_name"] = $folder_name;
            $data["rank"] = $getRank + 1;
            $insert = $this->gallery_model->add($data);
            if ($insert) :
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Galeri Başarıyla Eklendi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Galeri Eklenirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function update_form($id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $this->gallery_model->get(["id" => $id]);
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function update($id, $gallery_type)
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"]) :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Galeri Güncellemesi Yapılırken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            $gallery = $this->gallery_model->get(["id" => $id]);
            $oldFolderName = null;
            $folder_name = null;
            if (!empty($gallery)) :
                $data["img_url"] = !empty($gallery->img_url) ? $gallery->img_url : null;
                $data["url"] = !empty($gallery->url) ? seo($gallery->url) : seo($data["title"]);
                $path         = FCPATH . "uploads/$this->viewFolder/";
                $oldFolderName = !empty($gallery->folder_name) ? $gallery->folder_name : seo($data["title"]);
                $folder_name = seo($data["title"]);
                $path = "$path/$gallery_type/";
                if (!file_exists($path . $oldFolderName)) :
                    if (!@mkdir($path . $oldFolderName, 0755, true)) :
                        echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Galeri Oluşturulurken Hata Oluştu. Klasör Erişim Yetkinizin Olduğundan Emin Olup Tekrar Deneyin."]);
                        die();
                    endif;
                endif;
                if (!rename($path . $oldFolderName, $path . $folder_name)) :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Galeri Güncellemesi Yapılırken Hata Oluştu. Klasör Erişim Yetkinizin Olduğundan Emin Olup Tekrar Deneyin."]);
                    die();
                endif;
                if (!empty($_FILES["img_url"]["name"])) :
                    $image = upload_picture("img_url", "uploads/$this->viewFolder/$gallery_type/$folder_name", [], "*");
                    if ($image["success"]) :
                        $data["url"] =  seo($data["title"]);
                        $data["img_url"] = $image["file_name"];
                        if (!empty($gallery->img_url)) :
                            if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/$gallery_type/$folder_name/{$gallery->img_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/$gallery_type/$folder_name/{$gallery->img_url}")) :
                                unlink(FCPATH . "uploads/{$this->viewFolder}/$gallery_type/$folder_name/{$gallery->img_url}");
                            endif;
                        endif;
                    endif;
                endif;
                $data["folder_name"] = $folder_name;
                $update = $this->gallery_model->update(["id" => $id], $data);
                if ($update) :
                    echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Galeri Başarıyla Güncellendi."]);
                else :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Galeri Güncellenirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
                endif;
            endif;
        endif;
    }
    public function delete($id)
    {
        $gallery = $this->gallery_model->get(["id" => $id]);
        if (!empty($gallery)) :
            if (!$gallery->isCover) :
                if ($gallery->gallery_type != "video_urls") :
                    if ($gallery->gallery_type == "images") :
                        $model = "image_model";
                    elseif ($gallery->gallery_type == "videos") :
                        $model = "video_model";
                    else :
                        $model = "file_model";
                    endif;
                    $path = FCPATH . "uploads/$this->viewFolder/$gallery->gallery_type/{$gallery->folder_name}";
                    rrmdir($path);
                else :
                    $model = "video_url_model";
                endif;
                $this->$model->delete(["gallery_id" => $id]);
                $delete = $this->gallery_model->delete(["id" => $id]);
                if ($delete) :
                    echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Galeri Başarıyla Silindi."]);
                else :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Galeri Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
                endif;
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Galeri Silinirken Hata Oluştu. Sabit Galeriyi Silemezsiniz, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function isActiveSetter($id)
    {
        if (!empty($id)) :
            $isActive = (intval($this->input->post("data")) === 1) ? 1 : 0;
            if ($this->gallery_model->update(["id" => $id], ["isActive" => $isActive])) :
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı"]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı"]);
            endif;
        endif;
    }
    public function rankSetter()
    {
        $rows = $this->input->post("rows");
        if (!empty($rows)) :
            foreach ($rows as $row) :
                $this->gallery_model->update(["id" => $row["id"]], ["rank" => $row["position"]]);
            endforeach;
        endif;
    }
    public function detailDatatable($gallery_type, $gallery_id)
    {
        $gallery = $this->gallery_model->get(["id" => $gallery_id]);
        $modelName = ($gallery_type == "images" ? "image_model" : ($gallery_type == "files" ? "file_model" : ($gallery_type == "videos" ? "video_model" : "video_url_model")));
        $items = $this->$modelName->getRows(["gallery_id" => $gallery_id], $_POST);
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
                    <a href="javascript:void(0)" data-url="' . base_url("galleries/fileUpdate/{$item->id}/{$gallery_id}") . '" class="dropdown-item updateGalleryItemBtn"><i class="fa fa-pen"></i> Açıklama Ekle</a>
                        <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="detailTable" data-url="' . base_url("galleries/fileDelete/{$item->id}/{$item->gallery_id}/{$gallery_type}") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                        </div>
                </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("galleries/fileIsActiveSetter/{$item->id}/{$gallery_type}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch' . $i . '"></label></div>';
                if ($gallery_type == "images") :
                    $image = '<img src="' . base_url("uploads/galleries_v/{$gallery_type}/{$gallery->folder_name}/{$item->url}") . '" width="75">';
                elseif ($gallery_type == "files") :
                    $image = '<a href="' . base_url("uploads/galleries_v/{$gallery_type}/{$gallery->folder_name}/{$item->url}") . '" download><i class="fa fa-download fa-2x"></i></a>';
                elseif ($gallery_type == "videos") :
                    $image = '<video id="my-video' . $i . '" playsinline controls preload="auto" width="300" height="150" data-poster="' . get_picture("galleries_v/{$gallery_type}/{$gallery->folder_name}", $item->img_url) . '">';
                    if ($gallery_type == "videos") :
                        $image .= '<source src="' . base_url("uploads/galleries_v/{$gallery_type}/{$gallery->folder_name}/{$item->url}") . '"/>';
                    endif;
                    $image .= '</video>';
                else :
                    $image = htmlspecialchars_decode($item->url);
                endif;
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $image, $item->url, $item->lang, $checkbox, turkishDate("d F Y, l H:i:s", $item->createdAt), turkishDate("d F Y, l H:i:s", $item->updatedAt), turkishDate("d F Y, l H:i:s", $item->sharedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->$modelName->rowCount(["gallery_id" => $gallery_id]),
            "recordsFiltered" => $this->$modelName->countFiltered(["gallery_id" => $gallery_id], (!empty($_POST) ? $_POST : [])),
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
        $viewData->item = $this->gallery_model->get(["id" => $id]);
        $viewData->gallery_type = $viewData->item->gallery_type;
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        if ($viewData->item->gallery_type == "images") :
            $viewData->items = $this->image_model->get_all(["gallery_id" => $id], "rank ASC");
        elseif ($viewData->item->gallery_type == "files") :
            $viewData->items = $this->file_model->get_all(["gallery_id" => $id], "rank ASC");
        elseif ($viewData->item->gallery_type == "videos") :
            $viewData->items = $this->video_model->get_all(["gallery_id" => $id], "rank ASC");
        else :
            $viewData->items = $this->video_url_model->get_all(["gallery_id" => $id], "rank ASC");
        endif;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function fileUpdate($id, $gallery_id)
    {
        $viewData = new stdClass();
        $viewData->gallery = $this->gallery_model->get(['id' => $gallery_id]);
        if ($viewData->gallery->gallery_type == "images") :
            $viewData->item = $this->image_model->get(["id" => $id, "gallery_id" => $viewData->gallery->id]);
        elseif ($viewData->gallery->gallery_type == "files") :
            $viewData->item = $this->file_model->get(["id" => $id, "gallery_id" => $viewData->gallery->id]);
        elseif ($viewData->gallery->gallery_type == "videos") :
            $viewData->item = $this->video_model->get(["id" => $id, "gallery_id" => $viewData->gallery->id]);
        else :
            $viewData->item = $this->video_url_model->get(["id" => $id, "gallery_id" => $viewData->gallery->id]);
        endif;
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "file_update";
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function file_update($id, $gallery_id)
    {
        $data = $this->input->post();
        $gallery = $this->gallery_model->get(['id' => $gallery_id]);
        if ($gallery->gallery_type == "images") :
            $model = "image_model";
        elseif ($gallery->gallery_type == "files") :
            $model = "file_model";
        elseif ($gallery->gallery_type == "videos") :
            $model = "video_model";
        else :
            $model = "video_url_model";
        endif;
        if (!empty($_FILES["img_url"]["name"])) :
            $image = upload_picture("img_url", "uploads/$this->viewFolder/$gallery->gallery_type", [], "*");
            if ($image["success"]) :
                $data["img_url"] = $image["file_name"];
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Galeri İçeriği Güncelleştirilirken Hata Oluştu. İçerik Kapak Görseli Seçtiğinizden Emin Olup, Lütfen Tekrar Deneyin."]);
                die();
            endif;
        endif;
        $update = $this->$model->update(["id" => $id], $data);
        if ($update) :
            echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Galeri İçeriği Başarıyla Güncelleştirildi."]);
        else :
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Galeri İçeriği Güncelleştirilirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
        endif;
    }
    public function file_upload($gallery_id, $gallery_type, $lang)
    {
        $gallery = $this->gallery_model->get(["id" => $gallery_id]);
        if ($gallery_type != "video_urls") :
            if ($gallery_type == "images") :
                $image = upload_picture("file", "uploads/$this->viewFolder/images/{$gallery->folder_name}/", [], "*");
                if ($image["success"]) :
                    $getRank = $this->image_model->rowCount();
                    $this->image_model->add(
                        [
                            "url"           => $image["file_name"],
                            "rank"          => $getRank + 1,
                            "gallery_id"    => $gallery_id,
                            "isActive"      => 1,
                            "lang"          => $lang
                        ]
                    );
                else :
                    echo $image["error"];
                endif;
            elseif ($gallery_type == "videos") :
                $image = upload_picture("file", "uploads/$this->viewFolder/videos/{$gallery->folder_name}/", null, "mpeg|mpg|mpe|qt|mov|avi|movie|3g2|3gp|mp4|f4v|flv|webm|wmv|ogg");
                if ($image["success"]) :
                    $getRank = $this->video_model->rowCount();
                    $this->video_model->add(
                        [
                            "url"           => $image["file_name"],
                            "rank"          => $getRank + 1,
                            "gallery_id"    => $gallery_id,
                            "isActive"      => 1,
                            "lang"          => $lang
                        ]
                    );
                else :
                    echo $image["error"];
                endif;
            else :
                $image = upload_picture("file", "uploads/$this->viewFolder/files/{$gallery->folder_name}/", null, "*");
                if ($image["success"]) :
                    $getRank = $this->file_model->rowCount();
                    $this->file_model->add(
                        [
                            "url"           => $image["file_name"],
                            "rank"          => $getRank + 1,
                            "gallery_id"    => $gallery_id,
                            "isActive"      => 1,
                            "lang"          => $lang
                        ]
                    );
                else :
                    echo $image["error"];
                endif;
            endif;
        else :
            $data = $this->input->post();
            if (checkEmpty($data)["error"] && checkEmpty($data)["key"] !== "url") :
                $key = checkEmpty($data)["key"];
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Galeri İçeriği Kayıt Edilirken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
            else :
                $getRank = $this->video_url_model->rowCount();
                $data["url"] = htmlspecialchars(html_entity_decode($_POST["url"]));
                $data["rank"] = $getRank + 1;
                $data["isActive"] = 1;
                $data["gallery_id"] = $gallery_id;
                $data["lang"] = $lang;
                if ($this->video_url_model->add($data)) :
                    echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Galeri İçeriği Başarıyla Kayıt Edildi."]);
                else :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Galeri İçeriği Kayıt Edilirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
                endif;
            endif;
        endif;
    }
    public function fileDelete($id, $parent_id, $gallery_type)
    {
        $modelName = ($gallery_type == "images" ? "image_model" : ($gallery_type == "files" ? "file_model" : ($gallery_type == "videos" ? "video_model" : "video_url_model")));
        $gallery = $this->gallery_model->get(["id" => $parent_id]);
        $fileName = $this->$modelName->get(["id" => $id]);
        $delete = $this->$modelName->delete(["id" => $id]);
        if ($delete) :
            if ($gallery_type == "images") :
                $url = FCPATH . "uploads/galleries_v/images/{$gallery->url}/{$fileName->url}";
                if (!is_dir($url) && file_exists($url)) :
                    unlink($url);
                endif;
            elseif ($gallery_type == "videos") :
                $url = FCPATH . "uploads/galleries_v/videos/{$gallery->url}/{$fileName->url}";
                $url2 = FCPATH . "uploads/galleries_v/videos/{$gallery->url}/{$fileName->img_url}";
                if (!is_dir($url) && file_exists($url)) :
                    unlink($url);
                endif;
                if (!is_dir($url2) && file_exists($url2)) :
                    unlink($url2);
                endif;
            elseif ($gallery_type == "files") :
                $url = FCPATH . "uploads/galleries_v/files/{$gallery->url}/{$fileName->url}";
                if (!is_dir($url) && file_exists($url)) :
                    unlink($url);
                endif;
            endif;
            echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Galeri İçeriği Başarıyla Silindi."]);
        else :
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Galeri İçeriği Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
        endif;
    }
    public function fileIsActiveSetter($id, $gallery_type)
    {
        if (!empty($id) && !empty($gallery_type)) :
            $modelName = ($gallery_type == "images" ? "image_model" : ($gallery_type == "files" ? "file_model" : ($gallery_type == "videos" ? "video_model" : "video_url_model")));
            $isActive = (intval($this->input->post("data")) === 1) ? 1 : 0;
            if ($this->$modelName->update(["id" => $id], ["isActive" => $isActive])) :
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı"]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı"]);
            endif;
        endif;
    }
    public function fileRankSetter($gallery_type, $gallery_id)
    {
        $modelName = ($gallery_type == "images" ? "image_model" : ($gallery_type == "files" ? "file_model" : ($gallery_type == "videos" ? "video_model" : "video_url_model")));
        $rows = $this->input->post("rows");
        if (!empty($rows)) :
            foreach ($rows as $row) :
                $this->$modelName->update(["id" => $row["id"], "gallery_id" => $gallery_id], ["rank" => $row["position"]]);
            endforeach;
        endif;
    }
}
