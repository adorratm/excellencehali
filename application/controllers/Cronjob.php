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
        $this->codesConnections = $this->general_model->get_all("codes", null, null, ["isActive" => 1]);
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
        $responseArr = [];
        $responseCollection = $this->getCollections();
        $responseArr["collections"] = json_decode($responseCollection);
        $responseColor = $this->getColors();
        $responseArr["colors"] = json_decode($responseColor);
        $responseDimension = $this->getDimensions();
        $responseArr["dimensions"] = json_decode($responseDimension);
        $responsePattern = $this->getPatterns();
        $responseArr["patterns"] = json_decode($responsePattern);
        $responseStock = $this->getStocks();
        $responseArr["stocks"] = json_decode($responseStock);
        echo json_encode($responseArr);
    }

    public function getCollections()
    {
        try {
            if (!empty($this->codesConnections)) {
                $rank = 1;
                foreach ($this->codesConnections as $codesConnectionsKey => $codesConnectionsValue) {
                    $data = @curl_request($codesConnectionsValue->host, $codesConnectionsValue->port, "kalite", [], ['Content-Type: application/json', 'Accept: application/json', 'X-TOKEN: ' . $codesConnectionsValue->token])->data;
                    if (!empty($data)) {
                        foreach ($data as $returnKey => $returnValue) {
                            $this->general_model->replace("product_collections", [
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
                    $data = @curl_request($codesConnectionsValue->host, $codesConnectionsValue->port, "renk", [], ['Content-Type: application/json', 'Accept: application/json', 'X-TOKEN: ' . $codesConnectionsValue->token])->data;
                    if (!empty($data)) {
                        foreach ($data as $returnKey => $returnValue) {
                            $this->general_model->replace("product_colors", [
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
                    $data = @curl_request($codesConnectionsValue->host, $codesConnectionsValue->port, "ebat", [], ['Content-Type: application/json', 'Accept: application/json', 'X-TOKEN: ' . $codesConnectionsValue->token])->data;
                    if (!empty($data)) {
                        foreach ($data as $returnKey => $returnValue) {
                            $this->general_model->replace("product_dimensions", [
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
                    $data = @curl_request($codesConnectionsValue->host, $codesConnectionsValue->port, "desen", [], ['Content-Type: application/json', 'Accept: application/json', 'X-TOKEN: ' . $codesConnectionsValue->token])->data;
                    if (!empty($data)) {
                        foreach ($data as $returnKey => $returnValue) {
                            $this->general_model->replace("product_patterns", [
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
                                'codes' => clean($codesConnectionsValue->id) ?? NULL
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
}
