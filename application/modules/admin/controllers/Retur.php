<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        verify_session('admin');

        $this->load->model(array(
            'order_model' => 'order',
            'retur_model' => 'retur',
            'retur_model' => 'retur'
        ));
    }

    public function index()
    {
        $params['title'] = 'Kelola Pembayaran';

        $config['base_url'] = site_url('admin/retur/index');
        $config['total_rows'] = $this->retur->count_all_returs();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = floor($choice);
 
        $config['first_link']       = '«';
        $config['last_link']        = '»';
        $config['next_link']        = '›';
        $config['prev_link']        = '‹';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->load->library('pagination', $config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
 
        $returs['returs'] = $this->retur->get_all_returs($config['per_page'], $page);
        $returs['pagination'] = $this->pagination->create_links();

        $this->load->view('header', $params);
        $this->load->view('retur/reviews', $returs);
        $this->load->view('footer');
    }

    public function view($id = 0)
    {
        if ($this->retur->is_retur_exist($id)) {
            $data = $this->retur->retur_data($id);

            $params['title'] = 'Retur Order #' . $data->order_number;

            $returs['retur'] = $data;
            $returs['flash'] = $this->session->flashdata('retur_flash');

            $this->load->view('header', $params);
            $this->load->view('retur/view', $returs);
            $this->load->view('footer');
        } else {
            show_404();
        }
    }

    public function validasi_proof()
    {
        $status = $this->input->post('status');
        $retur = $this->input->post('retur');

        // Panggil metode validasi_proof dari Retur_model untuk mengonfirmasi retur
        $this->retur->validasi_proof($status, $retur);

        // Set flashdata untuk memberi tahu pengguna bahwa status berhasil diperbarui
        $this->session->set_flashdata('retur_flash', 'Status berhasil diperbarui');

        // Redirect ke halaman view retur yang sesuai
        redirect('admin/retur/index' . $id);
    }

    public function delete($id)
    {
        if ( $this->retur->is_retur_exist($id))
        {
            $this->retur->delete($id);

            $this->session->set_flashdata('retur_flash', 'Retur berhasil dihapus');
            redirect('admin/retur');
        }
        else
        {
            show_404();
        }
    }
}