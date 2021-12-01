<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getAllData()
    {
        $sql = "SELECT * FROM pembelian a
            INNER JOIN supplier b ON a.id_supplier=b.id_supplier";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getIdData($thn)
    {
        $idData = "";
        $sql = "SELECT MAX(id_pembelian) AS maxdata FROM pembelian WHERE id_pembelian LIKE '$thn%'";
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

    public function getDataById($iddata)
    {
        $sql = "SELECT * FROM pembelian a
        INNER JOIN pembelian_detail b ON a.id_pembelian=b.id_pembelian
        INNER JOIN supplier c ON c.id_supplier=a.id_supplier
        WHERE a.id_pembelian='$iddata'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getDetailDataById($idData)
    {
        $sql = "SELECT * FROM pembelian a
            INNER JOIN pembelian_detail b ON a.id_pembelian=b.id_pembelian
            WHERE a.id_pembelian='$idData'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function deleteData($id, $tabel)
    {
        $this->db->where('id_pembelian', $id);
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





    // public function updateData($id, $data, $tabel)
    // {
    //     $this->db->where('idbarangmasuk', $id);
    //     $this->db->update($tabel, $data);
    //     return  "Data " . $id . " Berhasil Diupdate";
    // }

}
