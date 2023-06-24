<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur_model extends CI_Model {
    public $user_id;
    
    public function __construct()
    {
        parent::__construct();

        $this->user_id = get_current_user_id();
    }

    public function count_all_returs()
    {
        return $this->db->where('user_id', $this->user_id)->get('retur_barang')->num_rows();
    }

    public function get_all_returs($limit, $start)
    {
        $returs = $this->db->query("
            SELECT r.*, o.order_number
            FROM retur_barang r
            JOIN orders o
                ON o.id = r.order_id
            WHERE r.user_id = '$this->user_id'
            LIMIT $start, $limit
        ");

        return $returs->result();
    }

    public function write_retur($data)
    {
        $this->db->insert('retur_barang', $data);

        return $this->db->insert_id();
    }

    public function is_retur_exist($id)
    {
        return ($this->db->where(array('id' => $id, 'user_id' => $this->user_id))->get('retur_barang')->num_rows() > 0) ? TRUE : FALSE;
    }

    public function retur_data($id)
    {
        $retur = $this->db->query("
            SELECT r.*, o.order_number
            FROM retur_barang r
            JOIN orders o
                ON o.id = r.order_id
            WHERE r.id = '$id'
        ");

        return $retur->row();
    }

    public function delete($id)
    {
        return $this->db->where(array('id' => $id, 'user_id' => $this->user_id))->delete('retur_barang');
    }

    public function update_admin_status($id, $admin_status)
    {
        $this->db->where('id', $id);
        $this->db->update('retur_barang', array('admin_status' => $admin_status));
    }

    public function update_upload_proof($id, $upload_proof)
    {
        $this->db->where('id', $id);
        $this->db->update('retur_barang', array('upload_proof' => $upload_proof));
    }

}
