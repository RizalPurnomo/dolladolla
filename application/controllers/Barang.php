<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('barang_model'));
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }



    function getMaxIdBarang()
    {
        $idbarang   = $this->barang_model->getIdData(date('y'));
        echo $idbarang;
    }












    public function add()
    {
        $data['idbarang']   = $this->barang_model->getIdData(date('y'));
        $data['satuan'] = $this->satuan_model->getAlldata();
        $data['cabang'] = $this->cabang_model->getAlldata();
        $this->load->view('master/vBarangAdd', $data);
    }

    public function print($idCabang)
    {
        $data['barang'] = $this->barang_model->getDataByIdCabang($idCabang);
        $this->load->view('master/vBarangPrint', $data);
    }

    public function saveBatch()
    {
        $jum = count($this->input->post('idbarang'));
        //insert Batch
        for ($i = 0; $i < $jum - 1; $i++) {
            $dataBarang = array(
                'idbarang'        => $this->input->post('idbarang')[$i],
                'kodebarang'    => $this->input->post('kodebarang')[$i],
                'namabarang'    => $this->input->post('namabarang')[$i],
                'stock' => $this->input->post('stock')[$i],
                'idsatuan' => $this->input->post('idsatuan')[$i],
                'hargaterakhir' => $this->input->post('hargabeli')[$i]
            );
            $this->barang_model->saveData($dataBarang, 'tblmbarang');
        }
    }

    public function saveData()
    {
        $data = $this->input->post('barang');
        $this->barang_model->saveData($data, 'tblmbarang');
        print_r($this->input->post());
    }

    function edit($idData)
    {
        if (isset($idData)) {
            $data['barang'] = $this->barang_model->getDataById($idData);
            $data['satuan'] = $this->satuan_model->getAlldata();
            $data['cabang'] = $this->cabang_model->getAlldata();
        }
        $this->load->view('master/vBarangEdit', $data);
    }

    public function updateData($idData)
    {
        $barang = $this->input->post('barang');
        $this->barang_model->updateData($idData, $barang, 'tblmbarang');
        print_r($this->input->post());
    }

    function delete($idData)
    {
        if (isset($idData)) {
            $this->barang_model->deleteData($idData, "tblmbarang");
        }
        return "Data Berhasil Di Delete";
    }


    function getBarangByCabang($idCabang)
    {
        $barang = $this->barang_model->getDataByIdCabang($idCabang);
        echo json_encode($barang);
    }

    public function saveInventarisBatch()
    {
        $jum = count($this->input->post('idinventaris'));
        //insert Batch
        for ($i = 0; $i < $jum - 1; $i++) {
            $dataInventaris = array(
                'idinventaris'        => $this->input->post('idinventaris')[$i],
                'tanggalpembelian'    => $this->input->post('tglpembelian')[$i],
                'kategori'    => $this->input->post('kategori')[$i],
                'kode' => $this->input->post('kode')[$i],
                'serialnumber' => $this->input->post('serialnumber')[$i],
                'nama' => $this->input->post('nama')[$i],
                'merk' => $this->input->post('merk')[$i],
                'lokasi' => $this->input->post('lokasi')[$i],
                'kondisi' => $this->input->post('kondisi')[$i]
            );
            $this->barang_model->saveData($dataInventaris, 'tblminventaris');
        }
    }
}
