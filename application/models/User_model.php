<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getValidUser($username, $password)
    {
        $sql = "SELECT * FROM user 
 				where username='" . $username . "' and password='" . $password . "'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function updateLastLogin($username, $data, $tabel)
    {
        $this->db->where('username', $username);
        $this->db->update($tabel, $data);
        return  "Data " . $username . " Berhasil Diupdate";
    }

    public function getAllUser()
    {
        $sql = "SELECT * FROM user where level!='Super Administrator' order by id_user desc";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getIDUser($thn)
    {
        $idUser = "";
        $sql = "SELECT MAX(id_user) AS maxuser FROM user WHERE id_user LIKE '$thn%'";
        $qry = $this->db->query($sql)->result_array();
        $maxUser = $qry[0]['maxuser'];
        if (empty($maxUser)) {
            $idUser = $thn . "001";
        } else {
            $maxUser++;
            $idUser = $maxUser;
        }
        return $idUser;
    }

    public function saveData($data, $tabel)
    {
        $this->db->insert($tabel, $data);
    }

    public function updateData($id, $data, $tabel)
    {
        $this->db->where('id_user', $id);
        $this->db->update($tabel, $data);
        return  "Data " . $id . " Berhasil Diupdate";
    }

    public function deleteData($id, $tabel)
    {
        $this->db->where('id_user', $id);
        $this->db->delete($tabel);
    }

    public function getUserById($idUser)
    {
        $query = "SELECT * FROM user WHERE id_user='$idUser'";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }
}
