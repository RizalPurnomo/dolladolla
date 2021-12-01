<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('user_model'));
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['user'] = $this->user_model->getAllUser();
        $this->load->view('master/vUser', $data);
    }

    public function add()
    {
        $data['iduser']   = $this->user_model->getIDUser(date('y'));
        $this->load->view('master/vUserAdd', $data);
    }

    public function saveData()
    {
        $user = $this->input->post('user');
        $this->user_model->saveData($user, 'user');
        print_r($this->input->post());
    }

    public function resetPassword($idData)
    {
        $user = $this->input->post('user');
        $this->user_model->updateData($idData, $user, 'user');
        print_r($this->input->post());
    }

    function edit($idData)
    {
        if (isset($idData)) {
            $data['user']     = $this->user_model->getUserById($idData);
        }
        $this->load->view('master/vUserEdit', $data);
    }

    public function updateData($idData)
    {
        $user = $this->input->post('user');
        $this->user_model->updateData($idData, $user, 'user');
        print_r($this->input->post());
    }

    function delete($idData)
    {
        if (isset($idData)) {
            $this->user_model->deleteData($idData, "user");
        }
        return "Data Berhasil Di Delete";
    }
}
