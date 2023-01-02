<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_role extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "user_role_v";
        $this->load->model("user_role_model");
        if (!get_active_user()) :
            redirect(base_url("login"));
        endif;
    }
    public function permissions_form($id)
    {
        $viewData = new stdClass();
        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->user_role_model->get(["id" => $id]);
        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "permissions";
        $viewData->item = $item;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function update_permissions($id)
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"]) :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Kullanıcı Yetkisi Güncelleştirilirken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            $data["permissions"] = json_encode($data["permissions"]);
            $update = $this->user_role_model->update(["id" => $id], $data);
            if ($update) :
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Kullanıcı Yetkisi Başarıyla Güncelleştirildi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Kullanıcı Yetkisi Güncelleştirilirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function index()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $this->user_role_model->get_all();
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function datatable()
    {
        $items = $this->user_role_model->getRows([], $_POST);
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
                    <a class="dropdown-item updateUserRoleBtn" href="javascript:void(0)" data-url="' . base_url("user_role/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                    <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="userRoleTable" data-url="' . base_url("user_role/delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                    <a class="dropdown-item updatePermissionBtn" href="javascript:void(0)" data-url="' . base_url("user_role/permissions_form/$item->id") . '"><i class="fa fa-eye mr-2"></i>Yetki Tanımı</a>

                    </div>
            </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("user_role/isActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch' . $i . '"></label></div>';
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $item->title, $checkbox, turkishDate("d F Y, l H:i:s", $item->createdAt), turkishDate("d F Y, l H:i:s", $item->updatedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->user_role_model->rowCount(),
            "recordsFiltered" => $this->user_role_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
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
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function save()
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"]) :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Kullanıcı Yetkisi Kaydı Yapılırken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            $getRank = $this->user_role_model->rowCount();
            $data["isActive"] = 1;
            $data["rank"] = $getRank + 1;
            $insert = $this->user_role_model->add($data);
            if ($insert) :
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Kullanıcı Yetkisi Başarıyla Eklendi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Kullanıcı Yetkisi Eklenirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function update_form($id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $this->user_role_model->get(["id" => $id]);
        $this->load->view("{$this->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function update($id)
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"]) :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Kullanıcı Yetkisi Güncelleştirilirken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            $update = $this->user_role_model->update(["id" => $id], $data);
            if ($update) :
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Kullanıcı Yetkisi Başarıyla Güncelleştirildi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Kullanıcı Yetkisi Güncelleştirilirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function delete($id)
    {
        $user_role = $this->user_role_model->get(["id" => $id]);
        if (!empty($user_role)) :
            $delete = $this->user_role_model->delete(["id"    => $id]);
            if ($delete) :
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Kullanıcı Yetkisi Başarıyla Silindi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Kullanıcı Yetkisi Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function rankSetter()
    {
        $rows = $this->input->post("rows");
        if (!empty($rows)) :
            foreach ($rows as $row) :
                $this->user_role_model->update(
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
            if ($this->user_role_model->update(["id" => $id], ["isActive" => $isActive])) :
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "msg" => "Güncelleme İşlemi Yapıldı"]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "msg" => "Güncelleme İşlemi Yapılamadı"]);
            endif;
        endif;
    }
}
