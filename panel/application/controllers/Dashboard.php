<?php

use Egulias\EmailValidator\Result\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public $viewData = null;
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "dashboard_v";
        $this->load->model("general_model");
        $this->viewData = new stdClass();
        if (!get_active_user()) :
            redirect(base_url("login"));
        endif;
        $this->viewData->settings = get_settings();
    }
    public function index()
    {
        //$whereOrder["status"] = 'Tamamlandı.';
        $items = $this->general_model->get_all("orders", [], [], []) ?? [];
        $this->viewData->viewFolder = $this->viewFolder;
        $this->viewData->subViewFolder = "list";
        $this->viewData->items = $items;
        $order = "stock ASC";
        $likes = [];
        $wheres["p.isActive"] = 1;
        $joins = ["product_collections pc" => ["pc.id=p.collection_id", "left"]];
        $select = "SUM(CAST(p.stock AS FLOAT)) AS stock,pc.title AS collection ";
        $distinct = false;
        $groupBy = ["collection"];
        $this->viewData->products = $this->general_model->get_all("products p", $select, $order, $wheres, $likes, $joins, [], [], $distinct, $groupBy);
        $this->viewData->total_products_count = $this->general_model->rowCount("products");
        $this->load->view("{$this->viewData->viewFolder}/{$this->viewData->subViewFolder}/index", $this->viewData);
    }

    public function syncInstagramPosts()
    {
        $userName = str_replace("/", "", (str_replace("https://www.instagram.com/", "", str_replace("https://instagram.com/", "", $this->viewData->settings->instagram))));
        if (!empty($userName)) {
            $files = glob(__DIR__ . '/../../../panel/uploads/instastory/*'); // get all file names
            foreach ($files as $file) { // iterate files
                if (is_file($file)) {
                    unlink($file); // delete file
                }
            }
            $this->instastory->login($this->viewData->settings->crawler_email, $this->viewData->settings->crawler_password);
            $this->instastory->getProfile($userName);
            $medias = $this->instastory->getMedias();
            $i = 1;
            foreach ($medias as $mediaKey => $mediaValue) :
                $url = substr(str_replace('/', '-', parse_url($mediaValue->getDisplaySrc(), PHP_URL_PATH)), 1);
                $this->general_model->replace("instagram_posts", ["id" => $i, "img_url" => $url, "link" => $mediaValue->getLink()]);
                $i++;
            endforeach;
            $this->instastory->downloadMedias();
        }
        echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Instagram Paylaşımları Senkronize Edildi"]);
    }

    public function makeWebp()
    {
        rWebp2(str_replace("panel\\", "", FCPATH) . "public/images");
    }
    public function phpinfo()
    {
        phpinfo();
    }
    public function orderTotalMonth()
    {
        $year = date("Y");
        if (!empty($_POST["year"])) :
            $year = $_POST["year"];
        endif;
        //$status = "Tamamlandı.";
        $status = null;
        if (!empty($_POST["status"])) :
            $status = $_POST["status"];
        endif;
        //$whereOrder["status"] = $status;
        $whereOrder = [];
        $items = $this->general_model->get_all("orders", [], "updatedAt ASC", $whereOrder);
        $monthArray = [];
        $beforeMonth = null;
        foreach ($items as $key => $value) :
            $monthAndYear = strtotime($value->updatedAt);
            $month = date("m/Y", $monthAndYear);
            $findYear = date("Y", $monthAndYear);
            if ($findYear == $year) :
                if ($beforeMonth != $month) :
                    $object = new stdClass();
                    $object->month = $month;
                    $object->value = $value->total;
                    array_push($monthArray, $object);
                endif;
                if ($beforeMonth == $month) :
                    foreach ($monthArray as $k => $v) :
                        if ($v->month == $this->findObjectById($monthArray, $month)->month) :
                            $monthArray[$k]->value += $value->total;
                        endif;
                    endforeach;
                endif;
                $beforeMonth = $month;
            endif;
        endforeach;
        $monthArray = [];
        echo json_encode(["data" => $monthArray]);
    }
    public function orderTotalYear()
    {
        //$status = "Tamamlandı.";
        $status = null;
        if (!empty($_POST["status"])) :
            $status = $_POST["status"];
        endif;
        $whereOrder = [];
        //$whereOrder["status"] = $status;
        $items = $this->general_model->get_all("orders", [], "updatedAt ASC", $whereOrder);
        $yearArray = [];
        $total_order = 0;
        $beforeYear = null;
        foreach ($items as $key => $value) :
            $total_order += 1;
            $year = strtotime($value->updatedAt);
            $year = date("Y", $year);
            if ($beforeYear != $year) :
                $object = new stdClass();
                $object->year = $year;
                $object->value = $value->total;
                array_push($yearArray, $object);
            endif;
            if ($beforeYear == $year) :
                foreach ($yearArray as $ke => $va) :
                    if ($va->year == $this->findObjectByIdYear($yearArray, $year)->year) :
                        $yearArray[$ke]->value += $value->total;
                    endif;
                endforeach;
            endif;
            $beforeYear = $year;
        endforeach;
        $yearArray = [];
        echo json_encode(["data" => $yearArray]);
    }
    public function findObjectById($array = [], $id = null)
    {
        if (!empty($array)) :
            foreach ($array as $element) :
                if ($id == $element->month) :
                    return $element;
                endif;
            endforeach;
        endif;
        return false;
    }
    public function findObjectByIdYear($array = [], $id = null)
    {
        foreach ($array as $element) :
            if ($id == $element->year) :
                return $element;
            endif;
        endforeach;
        return false;
    }

    public function language($language = '', $file = '', $action = '')
    {
        //Load library
        $this->load->library('linguo');
        $this->linguo->render($language, $file, $action);
        return;
    }
}
