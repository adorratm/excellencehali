<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cronjob extends MY_Controller
{
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */
    public $codesConnections = [];
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $this->codesConnections = [];
    }
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */

    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== INDEX ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Index
     */
    public function index()
    {
        //codesLogin();
        $this->codesConnections = $this->general_model->get_all("codes", null, null, ["isActive" => 1]);
        $responseArr = [];
        $responseStock = $this->getStocks();
        $responseArr["stocks"] = json_decode($responseStock);
        $responseCollection = $this->getCollections();
        $responseArr["collections"] = json_decode($responseCollection);
        $responseColor = $this->getColors();
        $responseArr["colors"] = json_decode($responseColor);
        $responseDimension = $this->getDimensions();
        $responseArr["dimensions"] = json_decode($responseDimension);
        $responsePattern = $this->getPatterns();
        $responseArr["patterns"] = json_decode($responsePattern);

        echo json_encode($responseArr);
    }

    public function getCollections()
    {
        try {
            if (!empty($this->codesConnections)) {
                $rank = 1;
                foreach ($this->codesConnections as $codesConnectionsKey => $codesConnectionsValue) {
                    $products = $this->general_model->get_all("products", null, null, ["isActive" => 1, "codes" => $codesConnectionsValue->id], [], [], [], [], true, ["collection_id"]);
                    if (!empty($products)) {
                        foreach ($products as $returnKey => $returnValue) {
                            $this->general_model->replace("product_collections", [
                                'id' => $rank,
                                'codes_id' => intval(clean($returnValue->collection_id)) ?? NULL,
                                'title' => clean($returnValue->collection) ?? NULL,
                                'seo_url' => clean(seo($returnValue->collection)) ?? NULL,
                                'isActive' => 1,
                                'rank' => $rank,
                                'codes' => clean($codesConnectionsValue->id) ?? NULL
                            ]);
                            $rank++;
                        }
                    }
                }
            }
            return json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Koleksiyonları Codes İle Başarıyla Eşitlendi."]);
        } catch (Exception $e) {
            return json_encode(["success" => false, "title" => "Hata!", "message" => $e->getMessage()]);
        }
    }

    public function getColors()
    {
        try {
            if (!empty($this->codesConnections)) {
                $rank = 1;
                foreach ($this->codesConnections as $codesConnectionsKey => $codesConnectionsValue) {
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
            return json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Renkleri Codes İle Başarıyla Eşitlendi."]);
        } catch (Exception $e) {
            return json_encode(["success" => false, "title" => "Hata!", "message" => $e->getMessage()]);
        }
    }

    public function getDimensions()
    {
        try {
            if (!empty($this->codesConnections)) {
                $rank = 1;
                foreach ($this->codesConnections as $codesConnectionsKey => $codesConnectionsValue) {
                    $products = $this->general_model->get_all("products", null, null, ["isActive" => 1, "codes" => $codesConnectionsValue->id], [], [], [], [], true, ["dimension_id"]);
                    if (!empty($products)) {
                        foreach ($products as $returnKey => $returnValue) {
                            $this->general_model->replace("product_dimensions", [
                                'id' => $rank,
                                'codes_id' => intval(clean($returnValue->dimension_id)) ?? NULL,
                                'title' => clean($returnValue->dimension) ?? NULL,
                                'seo_url' => clean(seo($returnValue->dimension)) ?? NULL,
                                'isActive' => 1,
                                'rank' => $rank,
                                'codes' => clean($codesConnectionsValue->id) ?? NULL
                            ]);
                            $rank++;
                        }
                    }
                }
            }
            return json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Ebatları Codes İle Başarıyla Eşitlendi."]);
        } catch (Exception $e) {
            return json_encode(["success" => false, "title" => "Hata!", "message" => $e->getMessage()]);
        }
    }

    public function getPatterns()
    {
        try {
            if (!empty($this->codesConnections)) {
                $rank = 1;
                foreach ($this->codesConnections as $codesConnectionsKey => $codesConnectionsValue) {
                    $products = $this->general_model->get_all("products", null, null, ["isActive" => 1, "codes" => $codesConnectionsValue->id], [], [], [], [], true, ["pattern_id"]);
                    if (!empty($products)) {
                        foreach ($products as $returnKey => $returnValue) {
                            $this->general_model->replace("product_patterns", [
                                'id' => $rank,
                                'codes_id' => intval(clean($returnValue->pattern_id)) ?? NULL,
                                'title' => clean($returnValue->pattern) ?? NULL,
                                'seo_url' => clean(seo($returnValue->pattern)) ?? NULL,
                                'isActive' => 1,
                                'rank' => $rank,
                                'codes' => clean($codesConnectionsValue->id) ?? NULL
                            ]);
                            $rank++;
                        }
                    }
                }
            }
            return json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürün Desenleri Codes İle Başarıyla Eşitlendi."]);
        } catch (Exception $e) {
            return json_encode(["success" => false, "title" => "Hata!", "message" => $e->getMessage()]);
        }
    }

    public function getStocks()
    {
        try {
            if (!empty($this->codesConnections)) {
                $rank = 1;
                foreach ($this->codesConnections as $codesConnectionsKey => $codesConnectionsValue) {
                    $data = @guzzle_request($codesConnectionsValue->host, $codesConnectionsValue->port, "stoklistele", [], ["Content-Type" => "application/json", "Accept" => "application/json", "X-TOKEN" => $codesConnectionsValue->token])->data;
                    if (!empty($data)) {
                        foreach ($data as $returnKey => $returnValue) {
                            $this->general_model->replace("products", [
                                'id' => $rank,
                                'codes_id' => intval(clean($returnValue->Id)) ?? NULL,
                                'unit_id' => intval(clean($returnValue->BirimId)) ?? NULL,
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
                                'dimension_type' => @str_contains(clean($returnValue->Ozelkod4), "XR") ? "ROLL" : "METER",
                            ]);
                            $rank++;
                        }
                    }
                }
            }
            return json_encode(["success" => true, "title" => "Başarılı!", "message" => "Ürünler Codes İle Başarıyla Eşitlendi."]);
        } catch (Exception $e) {
            return json_encode(["success" => false, "title" => "Hata!", "message" => $e->getMessage()]);
        }
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
                                $faturaBaslik["Tarih"] = date("Y-m-d H:i");
                                $faturaBaslik["BelgeNo"] = $order->order_code;
                                $faturaBaslik["CariId"] = $order->dealer_id;
                                $faturaBaslik["Aciklama"] = $order->address;
                                $faturaBaslik["OlusturmaTarihi"] = date("Y-m-d H:i");
                                $faturaBaslik["Vade"] = date("Y-m-d H:i");
                                $faturaBaslik["Durum"] = 0;
                                $faturaBaslik["KasaId"] = 0;
                                $faturaBaslik["BelgeTipi"] = 0;
                                $faturaBaslik["KDVDahil"] = False;
                                $faturaBaslik["SubeId"] = 0;
                                $faturaBaslik["Kur"] = 0;
                                $faturaBaslik["PB"] = NULL;
                                $faturaBaslik["Aciklama2"] = NULL;
                                $faturaBaslik["KullaniciId"] = 0;
                                $faturaBaslik["Iskonto1"] = 0;
                                $faturaBaslik["Iskonto2"] = 0;
                                $faturaBaslik["OzelKod1"] = 0;
                                $faturaBaslik["OzelKod2"] = 0;
                                $faturaBaslik["SonKullaniciId"] = 0;
                                $faturaBaslik["SonBelgeDurum"] = 0;
                                $faturaBaslik["AlinanPara"] = 0;
                                $faturaBaslik["SevkCariId"] = 0;
                                $faturaBaslik["AnaKayitId"] = 0;
                                $faturaBaslik["Mustahsil_BorsaOrani"] = 0;
                                $faturaBaslik["Mustahsil_BagkurOrani"] = 0;
                                $faturaBaslik["Mustahsil_StopajOrani"] = 0;
                                $faturaBaslik["Mustahsil_MeraOrani"] = 0;
                                $faturaBaslik["Mustahsil_SSDFOrani"] = 0;
                                $data = guzzle_request($server->host, $server->port, "faturabaslik", $faturaBaslik, ["Content-Type" => "application/json", "Accept" => "application/json", "X-TOKEN" => $server->token]);
                                if (!empty($data->id)) :
                                    foreach ($order_products as $key => $value) :
                                        $faturaHareket = [];
                                        $faturaHareket["BaslikId"] = $data->id;
                                        $faturaHareket["BirimId"] = $value->unit_id;
                                        $faturaHareket["StokAdi"] = $value->title;
                                        $faturaHareket["Miktar"] = ($value->dimension_type == "ROLL" ? ((@floatval($value->dimension) / 100) * @floatval($value->quantity) * @floatval($value->height))  : @$value->quantity);
                                        $faturaHareket["Termin"] = date("Y-m-d H:i");
                                        $faturaHareket["Aciklama"] = $value->order_note;
                                        $faturaHareket["Durum"] = 0;
                                        $faturaHareket["BarkodId"] = 0;
                                        $faturaHareket["Fiyat"] = 0;
                                        $faturaHareket["ParaBirimi"] = 0;
                                        $faturaHareket["Kur"] = 0;
                                        $faturaHareket["KDV"] = 0;
                                        $faturaHareket["EkVergi"] = 0;
                                        $faturaHareket["Bandrol"] = 0;
                                        $faturaHareket["Iskonto1"] = 0;
                                        $faturaHareket["Iskonto2"] = 0;
                                        $faturaHareket["Iskonto3"] = 0;
                                        $faturaHareket["Iskonto4"] = 0;
                                        $faturaHareket["Opsiyon"] = 0;
                                        $faturaHareket["Personel"] = 0;
                                        $faturaHareket["TransferMiktari"] = 0;
                                        $faturaHareket["SevkDeposu"] = 0;
                                        $faturaHareket["Prim"] = 0;
                                        $faturaHareket["SatisSekli"] = 0;
                                        $faturaHareket["ProtokolId"] = 0;
                                        $faturaHareket["SeriMalId"] = 0;
                                        $faturaHareket["SonKullaniciId"] = 0;
                                        $faturaHareket["AnaHareketId"] = 0;
                                        $faturaHareket["EskiId"] = 0;
                                        $faturaHareket["Olcu"] = 0;
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
