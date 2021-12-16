<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getAllData()
    {
        $sql = "SELECT * FROM penjualan a
            INNER JOIN customer b ON a.id_customer=b.id_customer
            ORDER BY id_penjualan desc";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getIdData($thn)
    {
        $idData = "";
        $sql = "SELECT MAX(id_penjualan) AS maxdata FROM penjualan WHERE id_penjualan LIKE '$thn%'";
        $qry = $this->db->query($sql)->result_array();
        $maxData = $qry[0]['maxdata'];
        if (empty($maxData)) {
            $idData = $thn . "001";
        } else {
            $maxData++;
            $idData = $maxData;
        }
        return $idData;
    }

    public function reportPenjualan($tglAwal, $tglAkhir)
    {
        $sql = "SELECT * FROM penjualan_detail a
            INNER JOIN penjualan b ON a.id_penjualan=b.id_penjualan
            INNER JOIN pembelian_detail c ON c.id_pembelian_detail=a.id_pembelian_detail
            INNER JOIN customer d ON d.id_customer=b.id_customer
            WHERE tgl_penjualan BETWEEN '$tglAwal' AND '$tglAkhir'
            ORDER BY a.id_penjualan DESC";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getDataById($iddata)
    {
        $sql = "SELECT * FROM penjualan a
        INNER JOIN penjualan_detail b ON a.id_penjualan=b.id_penjualan
        INNER JOIN customer c ON c.id_customer=a.id_customer
        INNER JOIN pembayaran d ON d.id_penjualan=a.id_penjualan
        WHERE a.id_penjualan='$iddata'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getDetailDataById($idData)
    {
        $sql = "SELECT * FROM penjualan a
            INNER JOIN penjualan_detail b ON a.id_penjualan=b.id_penjualan
            WHERE a.id_penjualan='$idData'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function deleteData($id, $tabel)
    {
        $this->db->where('id_penjualan', $id);
        $this->db->delete($tabel);
    }







    public function getDataByIdCabang($idcabang)
    {
        $sql = "select * from tblbarangmasuk a
            inner join tblmuser b on b.iduser=a.iduser
            INNER JOIN tblbarangmasukdetail c ON c.idbarangmasuk=a.idbarangmasuk
            inner join tblmbarang d on d.idbarang=c.idbarang
            where a.idcabang='$idcabang'
            order by a.idbarangmasuk desc";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getAllDataDetail()
    {
        $sql = "SELECT * FROM tblbarangmasuk a
            INNER JOIN tblbarangmasukdetail b ON a.idbarangmasuk=b.idbarangmasuk
            INNER JOIN tblmbarang c ON c.idbarang=b.idbarang
            INNER JOIN tblmuser d ON d.iduser=a.iduser
            ORDER BY a.idbarangmasuk DESC";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }





    public function getDetailDataByIdBarang($idBarang)
    {
        $sql = "select * from tblbarangmasukdetail a
            inner join tblbarangmasuk b on a.idbarangmasuk=b.idbarangmasuk
            inner join tblmbarang c on a.idbarang=c.idbarang
            where a.idbarang='$idBarang'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }


    public function saveData($data, $tabel)
    {
        $this->db->insert($tabel, $data);
    }

    public function updateData($id, $data, $tabel)
    {
        $this->db->where('id_penjualan', $id);
        $this->db->update($tabel, $data);
        return  "Data " . $id . " Berhasil Diupdate";
    }
}
