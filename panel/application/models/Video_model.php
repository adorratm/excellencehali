<?php
defined('BASEPATH') or exit('No direct script access allowed');
#[AllowDynamicProperties]
class Video_model extends CI_Model
{
    public $tableName = "videos";
    public function __construct()
    {
        parent::__construct();
        // Set orderable column fields
        $this->column_order = ['videos.rank', 'videos.id', 'videos.id', 'videos.img_url', 'videos.url', 'videos.lang', 'videos.isActive', 'videos.createdAt', 'videos.updatedAt', 'videos.sharedAt'];
        // Set searchable column fields
        $this->column_search = ['videos.rank', 'videos.id', 'videos.id', 'videos.img_url', 'videos.url', 'videos.lang', 'videos.isActive', 'videos.createdAt', 'videos.updatedAt', 'videos.sharedAt'];
        // Set default order
        $this->order = ['videos.rank' => 'ASC'];
    }
    public function get_all($where = [], $order = "id ASC")
    {
        return $this->db->where($where)->order_by($order)->get($this->tableName)->result();;
    }
    public function add($data = [])
    {
        return $this->db->insert($this->tableName, $data);
    }
    public function get($where = [])
    {
        return $this->db->where($where)->get($this->tableName)->row();
    }
    public function update($where = [], $data = [])
    {
        return $this->db->where($where)->update($this->tableName, $data);
    }
    public function delete($where = [])
    {
        return $this->db->where($where)->delete($this->tableName);
    }
    public function rowCount($where = [])
    {
        return $this->db->where($where)->count_all_results($this->tableName);
    }
    public function countFiltered($where = [], $postData = null)
    {
        $this->_get_datatables_query($postData);
        $this->db->select('
            videos.rank,
            videos.id,
            videos.gallery_id,
            videos.description,
            videos.img_url,
            videos.url,
            videos.lang,
            videos.isActive,
            videos.createdAt,
            videos.updatedAt,
            videos.sharedAt',    false);
        $query = $this->db->where($where)->get();
        return $query->num_rows();
    }
    public function getRows($where = [], $postData = [])
    {
        if (!empty($where)) :
            $this->db->where($where);
        endif;
        $this->_get_datatables_query($postData);
        if ($postData['length'] != -1) :
            $this->db->limit($postData['length'], $postData['start']);
        endif;
        $this->db->select('
		videos.rank,
		videos.id,
		videos.gallery_id,
		videos.description,
		videos.img_url,
		videos.url,
        videos.lang,
		videos.isActive,
		videos.createdAt,
        videos.updatedAt,
        videos.sharedAt',    false);
        return $this->db->get()->result();
    }
    private function _get_datatables_query($postData = [])
    {
        $this->db->where(["videos.id!=" => null]);
        $this->db->from($this->tableName);
        $i = 0;
        // loop searchable columns
        if (!empty($this->column_search)) :
            foreach ($this->column_search as $item) :
                // if datatable send POST for search
                if (!empty($postData['search'])) :
                    // first loop
                    if ($i === 0) :
                        // open bracket
                        $this->db->group_start();
                        $this->db->like($item, $postData['search'], 'both');
                        $this->db->or_like($item, strto("lower", $postData['search']), 'both');
                        $this->db->or_like($item, strto("lower|upper", $postData['search']), 'both');
                        $this->db->or_like($item, strto("lower|ucwords", $postData['search']), 'both');
                        $this->db->or_like($item, strto("lower|capitalizefirst", $postData['search']), 'both');
                        $this->db->or_like($item, strto("lower|ucfirst", $postData['search']), 'both');
                    else :
                        $this->db->or_like($item, $postData['search'], 'both');
                        $this->db->or_like($item, strto("lower", $postData['search']), 'both');
                        $this->db->or_like($item, strto("lower|upper", $postData['search']), 'both');
                        $this->db->or_like($item, strto("lower|ucwords", $postData['search']), 'both');
                        $this->db->or_like($item, strto("lower|capitalizefirst", $postData['search']), 'both');
                        $this->db->or_like($item, strto("lower|ucfirst", $postData['search']), 'both');
                    endif;
                    // last loop
                    if (count($this->column_search) - 1 == $i) :
                        // close bracket
                        $this->db->group_end();
                    endif;
                endif;
                $i++;
            endforeach;
        endif;
        if (isset($postData['order'])) :
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        elseif (isset($this->order)) :
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        endif;
    }
}
