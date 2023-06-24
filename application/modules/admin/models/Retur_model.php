<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();

    }

    public function count_all_returs()
    {
        return $this->db->get('retur_barang')->num_rows();
    }

    public function get_all_returs()
    {
        $returs = $this->db->query("
            SELECT r.*, o.order_number, c.*, r.id as id
            FROM retur_barang r
            JOIN orders o
                ON o.id = r.order_id
            JOIN customers c
                ON c.user_id = r.user_id
        ");

        return $returs->result();
    }

    public function is_retur_exist($id)
    {
        return ($this->db->where('id', $id)->get('retur_barang')->num_rows() > 0) ? TRUE : FALSE;
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

    public function validasi_proof($status, $retur)
    {
        $data = array(
            'validasi_proof' => $status
        );
    
        return $this->db->where('id', $retur)->update('retur_barang', $data);
    }
    

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('retur_barang');
    }
}