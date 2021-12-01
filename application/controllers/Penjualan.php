<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('penjualan_model', 'customer_model', 'barang_model'));
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['penjualan'] = $this->penjualan_model->getAlldata();
        // echo "<pre/>";
        // print_r($data);
        $this->load->view('vPenjualan', $data);
    }

    public function add()
    {
        $data['idpenjualan']    = $this->penjualan_model->getIdData(date('y'));
        $data['customer']       = $this->customer_model->getAlldata();
        $data['barang']       = $this->barang_model->getAlldata();
        $this->load->view('vPenjualanAdd', $data);
    }

    function saveData()
    {
        $penjualan            = $this->input->post('penjualan');
        $penjualandetail      = $this->input->post('penjualandetail');
        $pembeliandetail      = $this->input->post('pembeliandetail');
        $stock                 = 0;

        //insert Data
        $this->penjualan_model->saveData($penjualan, 'penjualan');

        for ($i = 0; $i < count($penjualandetail); $i++) {
            //insert Data Detail
            $this->penjualan_model->saveData($penjualandetail[$i], 'penjualan_detail');

            //Update Penambahan Stock
            $brgKeluar = $this->barang_model->getBrgKeluarById($pembeliandetail[$i]['id_pembelian_detail']);
            $stock = $brgKeluar[0]['qty_klr'] + $pembeliandetail[$i]['qty_keluar'];
            $arrStock = array(
                'qty_klr' => $stock
            );
            $this->barang_model->updateData($pembeliandetail[$i]['id_pembelian_detail'], $arrStock, 'pembelian_detail');
        }
    }

    public function detail($iddata)
    {
        $data['penjualan'] = $this->penjualan_model->getDataById($iddata);
        $this->load->view('vPenjualanDetail', $data);
    }

    function delete($idData)
    {
        if (isset($idData)) {
            //getpenjualandetail
            $penjualanDetail = $this->penjualan_model->getDetailDataById($idData);
            for ($i = 0; $i < count($penjualanDetail); $i++) {
                //update pengurangan stock
                $brgKeluar = $this->barang_model->getBrgKeluarById($penjualanDetail[$i]['id_pembelian_detail']);
                $stock = $brgKeluar[0]['qty_klr'] - $penjualanDetail[$i]['qty_keluar'];
                $arrStock = array(
                    'qty_klr' => $stock
                );
                $this->barang_model->updateData($penjualanDetail[$i]['id_pembelian_detail'], $arrStock, 'pembelian_detail');
            }
            //delete data
            $this->penjualan_model->deleteData($idData, "penjualan_detail");
            $this->penjualan_model->deleteData($idData, "penjualan");
        }
        return "Data Berhasil Di Delete";
    }









    public function print($idData)
    {
        $data['pengeluaran'] = $this->pengeluaran_model->getDataById($idData);
        $this->load->view('vPengeluaranPrint', $data);
    }

    public function print2($idData)
    {
        $data['pengeluaran'] = $this->pengeluaran_model->getDataById($idData);
        $this->load->view('vPengeluaranPrint2', $data);
    }













    // function edit($idData)
    // {
    //     if (isset($idData)) {
    //         $data['barang']     = $this->barang_model->getDataById($idData);
    //         $data['lokasi'] = $this->lokasi_model->getAlldata();
    //         $data['kategori'] = $this->kategori_model->getAlldata();
    //         $data['satuan'] = $this->satuan_model->getAlldata();
    //     }
    //     $this->load->view('master/vBarangEdit', $data);
    // }

    // public function updateData($idData)
    // {
    //     $barang = $this->input->post('barang');
    //     $this->barang_model->updateData($idData, $barang, 'tblmbarang');
    //     print_r($this->input->post());
    // }
}
