<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('supplier_model', 'pembelian_model'));
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['pembelian'] = $this->pembelian_model->getAlldata();
        // echo "<pre/>";
        // print_r($data);
        $this->load->view('vPembelian', $data);
    }

    public function add()
    {
        $data['idpembelian']    = $this->pembelian_model->getIdData(date('y'));
        $data['supplier']       = $this->supplier_model->getAlldata();
        $this->load->view('vPembelianAdd', $data);
    }

    function saveData()
    {
        $pembelian            = $this->input->post('pembelian');
        $pembeliandetail      = $this->input->post('pembeliandetail');

        //insert Data
        $this->pembelian_model->saveData($pembelian, 'pembelian');

        for ($i = 0; $i < count($pembeliandetail); $i++) {
            //insert Data Detail
            $this->load->library('ciqrcode'); //pemanggilan library QR CODE

            $config['cacheable']    = true; //boolean, the default is true
            $config['cachedir']     = './assets/'; //string, the default is application/cache/
            $config['errorlog']     = './assets/'; //string, the default is application/logs/
            $config['imagedir']     = './assets/images/'; //direktori penyimpanan qr code
            $config['quality']      = true; //boolean, the default is true
            $config['size']         = '1024'; //interger, the default is 1024
            $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
            $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
            $this->ciqrcode->initialize($config);

            $image_name = $pembeliandetail[$i]['id_barang'] . '.png'; //buat name dari qr code sesuai dengan nim

            $params['data'] = $pembeliandetail[$i]['id_barang']; //data yang akan di jadikan QR CODE
            $params['level'] = 'H'; //H=High
            $params['size'] = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

            $this->pembelian_model->saveData($pembeliandetail[$i], 'pembelian_detail');
        }
    }

    public function detail($iddata)
    {
        $data['pembelian'] = $this->pembelian_model->getDataById($iddata);
        $this->load->view('vPembelianDetail', $data);
    }

    function cekRelasi($iddata)
    {
        $relasi = 0;
        $pembelian = $this->pembelian_model->getDataById($iddata);
        for ($i = 0; $i < count($pembelian); $i++) {
            if ($pembelian[$i]['qty_klr'] > 0) {
                $relasi++;
            }
        }
        echo $relasi;
    }

    function delete($idData)
    {
        if (isset($idData)) {
            //getpembeliandetail
            $pembelianDetail = $this->pembelian_model->getDetailDataById($idData);
            for ($i = 0; $i < count($pembelianDetail); $i++) {
                //update penambahan stock
                // $brgKeluar = $this->barang_model->getBrgKeluarById($pembelianDetail[$i]['id_pembelian_detail']);
                // $stock = $brgKeluar[0]['qty_klr'] + $pembelianDetail[$i]['qty_keluar'];
                // $arrStock = array(
                //     'qty_klr' => $stock
                // );
                // $this->barang_model->updateData($pembelianDetail[$i]['id_pembelian_detail'], $arrStock, 'pembelian_detail');
            }
            //delete data
            $this->pembelian_model->deleteData($idData, "pembelian_detail");
            $this->pembelian_model->deleteData($idData, "pembelian");
        }
        return "Data Berhasil Di Delete";
    }










    // public function print($idData)
    // {
    //     $data['penerimaan'] = $this->penerimaan_model->getDataById($idData);
    //     $this->load->view('vPenerimaanPrint', $data);
    // }

    // public function print2($idData)
    // {
    //     $data['penerimaan'] = $this->penerimaan_model->getDataById($idData);
    //     $this->load->view('vPenerimaanPrint2', $data);
    // }
















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
