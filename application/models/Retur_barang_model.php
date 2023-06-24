<?php

class Retur_barang_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAllReturBarang() {
        // Query untuk mendapatkan semua data pengembalian barang
        return $this->db->get('retur_barang')->result_array();
    }

    public function getReturBarangById($id) {
        // Query untuk mendapatkan data pengembalian barang berdasarkan ID
        $this->db->where('id', $id);
        return $this->db->get('retur_barang')->row_array();
    }

    public function createReturBarang($data) {
        // Menyimpan data pengembalian barang baru ke database
        return $this->db->insert('retur_barang', $data);
    }

    public function updateReturBarang($data) {
        // Memperbarui data pengembalian barang di database
        $this->db->where('id', $data['id']);
        return $this->db->update('retur_barang', $data);
    }

    public function deleteReturBarang($id) {
        // Menghapus data pengembalian barang dari database
        $this->db->where('id', $id);
        return $this->db->delete('retur_barang');
    }
}
