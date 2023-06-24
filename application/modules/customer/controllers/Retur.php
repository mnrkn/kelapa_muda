<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        verify_session('customer');

        $this->load->model(array(
            'payment_model' => 'payment',
            'order_model' => 'order',
            'retur_model' => 'retur'
        ));
        $this->load->helper(array('form', 'url'));

        $this->retur = new Retur_model();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $params['title'] = 'Retur Barang';

        $config['base_url'] = site_url('customer/retur/index');
        $config['total_rows'] = $this->retur->count_all_returs();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $choice = $config['total_rows'] / $config['per_page'];
        $config['num_links'] = floor($choice);

        // Pagination HTML markup
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

    public function write()
    {
        $params['title'] = 'Retur Barang';
        
        $this->load->model('order_model', 'order'); // Load the order_model
        $retur['orders'] = $this->order->all_orders();

        $this->load->view('header', $params);
        $this->load->view('retur/write', $retur);
        $this->load->view('footer');
    }

    public function view($id = 0)
    {
        if ( $this->retur->is_retur_exist($id))
        {
            $data = $this->retur->retur_data($id);

            $params['title'] = 'Retur Order #'. $data->order_number;

            $retur['retur'] = $data;

            $retur['retur']->validasi_proof = $data->validasi_proof;

            $this->load->view('header', $params);
            $this->load->view('retur/view', $retur);
            $this->load->view('footer');
        }
        else
        {
            show_404();
        }
    }

    public function delete($id)
    {
        if ($this->retur->is_retur_exist($id))
        {
            $this->retur->delete($id);

            $this->session->set_flashdata('retur_flash', 'Retur berhasil dihapus');
            redirect('customer/retur');
        }
        else
        {
            show_404();
        }
    }

    public function write_me() {   

        $this->form_validation->set_error_delimiters('<div class="text-danger font-weight-bold">', '</div>');

        $this->form_validation->set_rules('title', 'Judul Review', 'required');
        $this->form_validation->set_rules('order_id', 'required|numeric');
        $this->form_validation->set_rules('retur', 'Isi retur', 'required');

        if ( $this->form_validation->run() === FALSE){
            $this->write();
        }else{
            if ($this->input->method() === 'post') {
                $title = $this->input->post('title');
                $order = $this->input->post('order_id');
                $retur = $this->input->post('retur');
                // the user id contain dot, so we must remove it
                $file_name = str_replace('.','', rand());
                $config['upload_path']          = 'assets/uploads/proof/';
                $config['allowed_types']        = 'gif|jpg|jpeg|png';
                $config['file_name']            = $file_name;
                $config['overwrite']            = true;
                // $config['max_size']             = 1024; // 1MB
                // $config['max_width']            = 1080;
                // $config['max_height']           = 1080;
    
        
    
                $this->load->library('upload', $config);
    
                if (!$this->upload->do_upload('upload_proof')) {
                    $data['error'] = $this->upload->display_errors();
                    var_dump($data['error']);
                } else {
                    $uploaded_data = $this->upload->data();
    
    
                    $retur = array(
                        'user_id' => get_current_user_id(),
                        'title' => $title,
                        'order_id' => $order,
                        'retur_text' => $retur,
                        'retur_date' => date('Y-m-d H:i:s'),
                        'upload_proof' => $config['upload_path'] . $uploaded_data['file_name']
                    );
                    $id = $this->retur->write_retur($retur);
                    $this->session->set_flashdata('retur_flash', 'Retur berhasil dikirimkan');
                    redirect('customer/retur/view/'. $id);
                }
            }
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
        redirect('customer/retur/index' . $id);
    }

}
