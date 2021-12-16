<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('barang_model', 'penjualan_model'));
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function rptStock()
    {
        $data['barang'] = $this->barang_model->getAlldata();
        $this->load->view('report/vReportStock', $data);
    }

    function rptPenjualan()
    {
        if (!empty($_POST)) {
            $tglAwal = date('Y-m-d', strtotime($_POST['datepicker']));
            $tglAkhir = date('Y-m-d', strtotime($_POST['datepicker2']));
            $data['tglAwal'] = $tglAwal;
            $data['tglAkhir'] = $tglAkhir;
            if ($_POST['proses'] == 'proses') {
                $data['penjualan'] = $this->penjualan_model->reportPenjualan($tglAwal, $tglAkhir);
                $this->load->view('report/vReportPenjualan', $data);
            } else {
                $data['penjualan'] = $this->penjualan_model->reportPenjualan($tglAwal, $tglAkhir);
                $this->load->view('report/vReportPenjualanPrint', $data);
            }
        } else {
            $today = date("Y-m-d");
            $tglAwal = date('Y-m-01', strtotime($today));
            $tglAkhir = date('Y-m-t', strtotime($today));
            $data['tglAwal'] = $tglAwal;
            $data['tglAkhir'] = $tglAkhir;
            $data['penjualan'] = $this->penjualan_model->reportPenjualan($tglAwal, $tglAkhir);
            $this->load->view('report/vReportPenjualan', $data);
        }
    }

    public function printStock()
    {
        $data['barang'] = $this->barang_model->getAlldata();
        $this->load->view('report/vReportStockPrint', $data);
    }

    // public function printPenjualan()
    // {
    //     $data['penjualan'] = $this->penjualan_model->reportPenjualan();
    //     $this->load->view('report/vReportPenjualanPrint', $data);
    // }



    // public function index()
    // {
    //     // $data['penerimaan'] = $this->penerimaan_model->getAlldataDetail();
    //     // $this->load->view('vPenerimaan', $data);
    // }

    // public function stock()
    // {
    //     $data['barang'] = $this->barang_model->getAlldata();
    //     $data['stockmasuk'] = $this->penerimaan_model->getDetailDataByIdBarang('21225');
    //     // echo '<pre>';
    //     // print_r($data);
    //     $this->load->view('report/vReportStock', $data);
    // }

    // public function getStock($idbarang)
    // {
    //     $data['penerimaan'] = $this->penerimaan_model->getDetailDataByIdBarang($idbarang);
    //     $data['pengeluaran'] = $this->pengeluaran_model->getDetailDataByIdBarang($idbarang);
    //     echo json_encode($data);
    //     // print_r($data);
    //     // $this->load->view('report/vReportStock', $data);
    // }

    // public function print()
    // {
    //     if (isset($_POST)) {
    //         $data['penerimaan'] = $this->penerimaan_model->getDetailDataByIdBarang($_POST['barang']);
    //         $data['pengeluaran'] = $this->pengeluaran_model->getDetailDataByIdBarang($_POST['barang']);
    //         // echo "<pre/>";
    //         // print_r($data);
    //         $this->load->view('report/vReportStockPrint', $data);
    //     }
    // }



    // public function detail($idData)
    // {
    //     $data['penerimaan'] = $this->penerimaan_model->getDataById($idData);
    //     $this->load->view('vPenerimaanDetail', $data);
    // }

    // public function print($idData)
    // {
    //     $data['penerimaan'] = $this->penerimaan_model->getDataById($idData);
    //     $this->load->view('vPenerimaanPrint', $data);
    // }

    // public function add()
    // {
    //     $data['idbarangmasuk']   = $this->penerimaan_model->getIdData(date('y'));
    //     $data['barang'] = $this->barang_model->getAlldata();
    //     $data['satuan'] = $this->satuan_model->getAlldata();
    //     $this->load->view('vPenerimaanAdd', $data);
    // }

    // function saveData()
    // {
    //     $penerimaan            = $this->input->post('penerimaan');
    //     $penerimaanDetail      = $this->input->post('penerimaanDetail');
    //     $stock                 = 0;

    //     //insert Data
    //     $this->penerimaan_model->saveData($penerimaan, 'tblbarangmasuk');

    //     for ($i = 0; $i < count($penerimaanDetail); $i++) {
    //         //insert Data Detail
    //         $this->penerimaan_model->saveData($penerimaanDetail[$i], 'tblbarangmasukdetail');

    //         //Update Penambahan Stock
    //         $stockAwal = $this->barang_model->getDataById($penerimaanDetail[$i]['idbarang']);
    //         $stock = $stockAwal[0]['stock'] + $penerimaanDetail[$i]['qtymasuk'];
    //         $arrStock = array(
    //             'stock' => $stock,
    //             'hargaterakhir' => $penerimaanDetail[$i]['hargasatuan']
    //         );
    //         // print_r($stockAwal);
    //         $this->barang_model->updateData($penerimaanDetail[$i]['idbarang'], $arrStock, 'tblmbarang');
    //     }
    // }

    // function delete($idData)
    // {
    //     if (isset($idData)) {
    //         //getpenerimaandetail
    //         $penerimaanDetail = $this->penerimaan_model->getDetailDataById($idData);
    //         // print_r($penerimaanDetail);
    //         for ($i = 0; $i < count($penerimaanDetail); $i++) {
    //             //update pengurangan stock
    //             $stockAwal = $this->barang_model->getStockById($penerimaanDetail[$i]['idbarang']);
    //             $stock = $stockAwal[0]['stock'] - $penerimaanDetail[$i]['qtymasuk'];
    //             $arrStock = array(
    //                 'stock' => $stock
    //             );
    //             $this->barang_model->updateData($penerimaanDetail[$i]['idbarang'], $arrStock, 'tblmbarang');
    //         }
    //         //delete data
    //         $this->penerimaan_model->deleteData($idData, "tblbarangmasuk");
    //     }
    //     return "Data Berhasil Di Delete";
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
