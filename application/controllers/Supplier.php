<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('supplier_model'));
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    function getMaxIdSupplier()
    {
        $idSupplier   = $this->supplier_model->getIdData(date('y'));
        echo $idSupplier;
    }

    public function saveData()
    {
        $data = $this->input->post('supplier');
        $this->supplier_model->saveData($data, 'supplier');
        print_r($this->input->post());
    }

    public function index()
    {
        $data['supplier'] = $this->supplier_model->getAllData();
        $this->load->view('master/vSupplier', $data);
    }

    public function add()
    {
        $data['idSupplier']   = $this->supplier_model->getIdData(date('y'));
        $this->load->view('master/vSupplierAdd', $data);
    }

    function edit($idData)
    {
        if (isset($idData)) {
            $data['supplier']     = $this->supplier_model->getDataById($idData);
        }
        $this->load->view('master/vSupplierEdit', $data);
    }

    public function updateData($idData)
    {
        $supplier = $this->input->post('supplier');
        $this->supplier_model->updateData($idData, $supplier, 'supplier');
        print_r($this->input->post());
    }

    function delete($idData)
    {
        if (isset($idData)) {
            $this->supplier_model->deleteData($idData, "supplier");
        }
        return "Data Berhasil Di Delete";
    }
}
