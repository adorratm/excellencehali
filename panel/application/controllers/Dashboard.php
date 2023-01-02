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
    }
    public function index()
    {
        redirect(base_url("settings"));
        $whereOrder["status"] = 'Tamamlandı.';
        $items = $this->general_model->get_all("orders", [], [], $whereOrder);
        $this->viewData->viewFolder = $this->viewFolder;
        $this->viewData->subViewFolder = "list";
        $this->viewData->items = $items;
        $order = "stock ASC";
        $likes = [];
        $wheres["p.isActive"] = 1;
        $joins = ["products_w_categories pwc" => ["p.id = pwc.product_id", "left"], "product_categories pc" => ["pc.id=pwc.category_id", "left"]];
        $select = "SUM(CAST(IFNULL(pvg.stock,p.stock) AS FLOAT)) AS stock,pc.title AS category ";
        $distinct = false;
        $groupBy = ["category"];
        $this->viewData->products = $this->general_model->get_all("products p", $select, $order, $wheres, $likes, $joins, [], [], $distinct, $groupBy);
        $this->viewData->total_products_count = $this->general_model->rowCount("products");
        $this->load->view("{$this->viewData->viewFolder}/{$this->viewData->subViewFolder}/index", $this->viewData);
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
        $status = "Tamamlandı.";
        if (!empty($_POST["status"])) :
            $status = $_POST["status"];
        endif;
        $whereOrder["status"] = $status;
        $items = $this->general_model->get_all("orders", [], "updatedAt ASC", $whereOrder,);
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
        echo json_encode(["data" => $monthArray]);
    }
    public function orderTotalYear()
    {
        $status = "Tamamlandı.";
        if (!empty($_POST["status"])) :
            $status = $_POST["status"];
        endif;
        $whereOrder["status"] = $status;
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

    public function language($language='', $file='', $action=''){
        //Load library
        $this->load->library('linguo');
        $this->linguo->render($language, $file, $action);
        return;
    }
}
