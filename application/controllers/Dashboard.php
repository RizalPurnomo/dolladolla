<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('barang_model', 'penjualan_model', 'pembelian_model'));
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['barang'] = $this->barang_model->getAlldata();
        $data['penjualan'] = $this->penjualan_model->getAlldata();
        $data['pembelian'] = $this->pembelian_model->getAlldata();
        $this->load->view('dashboard', $data);
        // print_r($data);

    }
}
