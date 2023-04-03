<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "orders_v";
        $this->load->model("order_model");
        $this->load->helper("text");
        if (!get_active_user()) :
            redirect(base_url("login"));
        endif;
    }
    public function index()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $this->order_model->get_all([], "id DESC");
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function datatable()
    {
        $items = $this->order_model->getRows([], $_POST);
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
                        <a class="dropdown-item updateOrderBtn" href="javascript:void(0)" data-url="' . base_url("orders/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                        ';
                $proccessing .= '<a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="ordersTable" data-url="' . base_url("orders/delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                    </div>
                </div>';
                $data[] = [$item->id, $item->first_name, $item->last_name, $item->company_name, $item->email, $item->phone, number_format($item->total, 2), ($item->status <= 1 ? "<span class='text-danger font-weight-bold'>" . $item->statusMessage . "</span>" : "<span class='text-success font-weight-bold'>" . $item->statusMessage . "</span>"), turkishDate("d F Y, l H:i:s", $item->createdAt), turkishDate("d F Y, l H:i:s", $item->updatedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->order_model->rowCount(),
            "recordsFiltered" => $this->order_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        ];
        // Output to JSON format
        echo json_encode($output);
    }
    public function update_form($id)
    {
        $viewData = new stdClass();
        $item = $this->general_model->get(
            "orders",
            null,
            ["orders.id" => $id]
        );
        $viewData->order_data = $this->general_model->get_all("order_products", null, null, ["order_id" => $id]);
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function update($id = null)
    {
        $data = rClean($_POST);
        $alert = [
            "success" => false,
            "title" => lang("error"),
            "message" => lang("order_code_not_found")
        ];
        if (empty($id)) :
            echo json_encode($alert);
            return;
        endif;
        if (!empty($id)) :
            $order = $this->general_model->get("orders", null, ["id" => $id, "user_id" => get_active_user()->id]);
            if (empty($order)) :
                echo json_encode($alert);
                return;
            endif;
            if (!empty($data["statusMessage"])) :
                $this->general_model->update("orders", ["order_code" => $order->order_code], ["status" => $data["status"], "statusMessage" => $data["statusMessage"]]);
                $mailViewData = new stdClass();
                $mailViewData->order_data = (array)$order;
                $mailViewData->order_products = $this->general_model->get_all("order_products", null, null, ["order_id" => $order->id]);
                $mailViewData->message  = "Siparişinizin durumu güncellendi. Sipariş durumunuz: <b>" . $data["statusMessage"] . "</b>";
                $subject = get_settings()->company_name . " - " . lang("order_update");
                $mailViewData->subject = $subject;
                $mailViewData = $this->load->view("includes/mail_template", (array)$mailViewData, true);
                if (!empty($order->email)) :
                    @send_emailv2([$order->email], $subject, $mailViewData);
                endif;
                $alert["success"] = true;
                $alert["title"] = lang("success");
                $alert["message"] = lang("order_updated");
                echo json_encode($alert);
                return;
            endif;
        endif;
    }
    public function delete($id)
    {
        $order = $this->order_model->get(["id" => $id]);
        if (!empty($order)) :
            $order_model = $this->order_model->delete(["id"    => $id]);
            if ($order_model) :
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Sipariş Başarıyla Silindi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Sipariş Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }

    public function syncOrders()
    {
        try {
            $orders = $this->general_model->get_all("orders", null, null, ["status" => 1, "date_add(createdAt, INTERVAL 30 MINUTE) <= " => date("Y-m-d H:i:s")]);
            if (!empty($orders)) :
                foreach ($orders as $order) :
                    $servers = $this->general_model->get_all("codes", null, null, ["isActive" => 1]);
                    if (!empty($servers)) :
                        $i = 1;
                        foreach ($servers as $serverKey => $server) :
                            $order_products = $this->general_model->get_all("order_products", "*,'' as img_url", null, ["order_id" => $order->id, "codes" => $i]);
                            if (!empty($order_products)) :
                                $order->dealer_id = @json_decode($order->codes)[$serverKey];
                                $faturaBaslik = [];
                                $faturaBaslik["Durum"] = "0";
                                $faturaBaslik["KasaId"] = "0";
                                $faturaBaslik["BelgeTipi"] = "0";
                                $faturaBaslik["KDVDahil"] = "False";
                                $faturaBaslik["Tarih"] = date("Y-m-d H:i");
                                $faturaBaslik["SubeId"] = "0";
                                $faturaBaslik["CariId"] = $order->dealer_id ?? "0";
                                $faturaBaslik["BelgeNo"] = $order->order_code ?? "0";
                                $faturaBaslik["Kur"] = "0";
                                $faturaBaslik["PB"] = "";
                                $faturaBaslik["Aciklama"] = $order->address ?? "";
                                $faturaBaslik["Aciklama2"] = "";
                                $faturaBaslik["KullaniciId"] = "0";
                                $faturaBaslik["Iskonto1"] = "0";
                                $faturaBaslik["Iskonto2"] = "0";
                                $faturaBaslik["OzelKod1"] = "0";
                                $faturaBaslik["OzelKod2"] = "0";
                                $faturaBaslik["OlusturmaTarihi"] = date("Y-m-d H:i");
                                $faturaBaslik["SonKullaniciId"] = "0";
                                $faturaBaslik["SonBelgeDurum"] = "0";
                                $faturaBaslik["AlinanPara"] = "0";
                                $faturaBaslik["SevkCariId"] = "0";
                                $faturaBaslik["AnaKayitId"] = "0";
                                $faturaBaslik["Mustahsil_BorsaOrani"] = "0";
                                $faturaBaslik["Mustahsil_BagkurOrani"] = "0";
                                $faturaBaslik["Mustahsil_StopajOrani"] = "0";
                                $faturaBaslik["Mustahsil_MeraOrani"] = "0";
                                $faturaBaslik["Mustahsil_SSDFOrani"] = "0";
                                $faturaBaslik["Vade"] = date("Y-m-d H:i");
                                $data = guzzle_request($server->host, $server->port, "faturabaslik", $faturaBaslik, ["Content-Type" => "application/json", "Accept" => "application/json", "X-TOKEN" => $server->token]);
                                if (!empty($data->id)) :
                                    foreach ($order_products as $key => $value) :
                                        $faturaHareket = [];
                                        $qty = ($value->dimension_type == "ROLL" ? ((@floatval($value->dimension) / 100) * @floatval($value->quantity) * @floatval($value->height))  : @$value->quantity);
                                        $faturaHareket["Durum"] = "0";
                                        $faturaHareket["BaslikId"] = !empty($data->id) ? $data->id : "0";
                                        $faturaHareket["BirimId"] = !empty($value->unit_id) ? $value->unit_id : "0";
                                        $faturaHareket["BarkodId"] = "0";
                                        $faturaHareket["StokAdi"] = !empty($value->title) ? $value->title : "0";
                                        $faturaHareket["Fiyat"] = "0";
                                        $faturaHareket["ParaBirimi"] = "0";
                                        $faturaHareket["Kur"] = "0";
                                        $faturaHareket["Miktar"] = !empty($qty) ? $qty : "0";
                                        $faturaHareket["KDV"] = "0";
                                        $faturaHareket["EkVergi"] = "0";
                                        $faturaHareket["Bandrol"] = "0";
                                        $faturaHareket["Iskonto1"] = "0";
                                        $faturaHareket["Iskonto2"] = "0";
                                        $faturaHareket["Iskonto3"] = "0";
                                        $faturaHareket["Iskonto4"] = "0";
                                        $faturaHareket["Termin"] = date("Y-m-d H:i");
                                        $faturaHareket["Opsiyon"] = "0";
                                        $faturaHareket["Personel"] = "0";
                                        $faturaHareket["TransferMiktari"] = "0";
                                        $faturaHareket["SevkDeposu"] = "0";
                                        $faturaHareket["Prim"] = "0";
                                        $faturaHareket["SatisSekli"] = "0";
                                        $faturaHareket["ProtokolId"] = "0";
                                        $faturaHareket["SeriMalId"] = "0";
                                        $faturaHareket["SonKullaniciId"] = "0";
                                        $faturaHareket["AnaHareketId"] = "0";
                                        $faturaHareket["Aciklama"] = !empty($value->order_note) ? $value->order_note : "0";
                                        $faturaHareket["EskiId"] = "0";
                                        $faturaHareket["Olcu"] = "0";
                                        $data = guzzle_request($server->host, $server->port, "faturahareket", $faturaHareket, ["Content-Type" => "application/json", "Accept" => "application/json", "X-TOKEN" => $server->token]);
                                    endforeach;
                                    $this->general_model->update("orders", ["id" => $order->id], ["status" => 2, "statusMessage" => lang("Siparişiniz Hazırlanıyor.")]);
                                endif;
                            endif;
                            $i++;
                        endforeach;
                    endif;
                endforeach;
            endif;
            echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Siparişler Codes İle Başarıyla Eşitlendi."]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "title" => "Hata!", "message" => $e->getMessage()]);
        }
    }
}
