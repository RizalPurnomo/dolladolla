<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getIdData($thn)
    {
        $idData = "";
        $sql = "SELECT MAX(id_barang) AS maxdata FROM pembelian_detail WHERE id_barang LIKE '$thn%'";
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

    public function getAllData()
    {
        $sql = "SELECT (qty_masuk-qty_klr) AS stock,a.*,b.* FROM pembelian_detail a
            INNER JOIN pembelian b ON a.id_pembelian=b.id_pembelian
            WHERE (qty_masuk-qty_klr) >0
            ORDER BY id_pembelian_detail desc";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function updateData($idpembeliandetail, $data, $tabel)
    {
        $this->db->where('id_pembelian_detail', $idpembeliandetail);
        $this->db->update($tabel, $data);
        return  "Data " . $idpembeliandetail . " Berhasil Diupdate";
    }

    public function getBrgKeluarById($id)
    {
        $query = "SELECT * FROM pembelian_detail WHERE id_pembelian_detail='$id'";
        $sql = $this->db->query($query);
        return $sql->result_array();
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



    public function saveData($data, $tabel)
    {
        $this->db->insert($tabel, $data);
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
