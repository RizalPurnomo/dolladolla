<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getAllData()
    {
        $sql = "SELECT * FROM supplier";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }














    public function getDataByIdCabang($idcabang)
    {
        $sql = "SELECT * FROM tblmbarang a
            inner join tblmsatuan b on b.idsatuan=a.idsatuan
            inner join tblmcabang c on c.idcabang=a.idcabang
            where a.idcabang='$idcabang'
            order by idbarang desc";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getIdData($thn)
    {
        $idData = "";
        $sql = "SELECT MAX(idbarang) AS maxdata FROM tblmbarang WHERE idbarang LIKE '$thn%'";
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

    public function saveData($data, $tabel)
    {
        $this->db->insert($tabel, $data);
    }

    public function updateData($id, $data, $tabel)
    {
        $this->db->where('idbarang', $id);
        $this->db->update($tabel, $data);
        return  "Data " . $id . " Berhasil Diupdate";
    }

    public function deleteData($id, $tabel)
    {
        $this->db->where('idbarang', $id);
        $this->db->delete($tabel);
    }

    public function getDataById($idData)
    {
        $query = "SELECT * FROM tblmbarang WHERE idbarang='$idData'";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }

    // ------
    public function getStockById($id)
    {
        $query = "SELECT stock FROM tblmbarang WHERE idbarang='$id'";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }


    // public function getBarangByLokasi($idLokasi)
    // {
    //     $query = "SELECT * FROM tblmbarang a
    //         inner join tblmlokasi b on a.idlokasi=b.idlokasi
    //         inner join tblmkategori c on c.idkategori=a.idkategori
    //         inner join tblmsatuan d on d.idsatuan=a.idsatuan
    //         where a.idlokasi='$idLokasi'
    //         ORDER BY a.idbarang DESC";
    //     $sql = $this->db->query($query);
    //     return $sql->result_array();
    // }
}
