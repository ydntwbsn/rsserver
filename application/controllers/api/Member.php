<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Member extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('member_model');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id === null) {
            $member = $this->member_model->getmember();
        } else {
            $member = $this->member_model->getmember($id);
        }
        if ($member) {
            $this->response([
                'status' => true,
                'data' => $member

            ], REST_Controller::HTTP_OK);
        } else {
            // Set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'ID Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
    public function index_delete()
    {
        $id = $this->delete('id_m');
        if ($id === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'Perintah Ini Membutuhkan ID'
            ], REST_Controller::HTTP_NOT_FOUND);
        } else {
            if ($this->member_model->deletemember($id) > 0);
            $this->response([
                'status' => true,
                'data' => $id,
                'message' => 'Data Berhasil Dihapus'

            ], REST_Controller::HTTP_OK);
        } {
            $this->response([
                'status' => FALSE,
                'message' => 'ID Tidak Ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function index_post()
    {
        $data = [
            'id' => $this->post('id_m'),
            'nama' => $this->post('nama_m'),
            'kitas' => $this->post('kitas_m'),
            'tipe' => $this->post('tipe_m'),
            'telp' => $this->post('telp_m')
        ];

        if ($this->member_model->tambahmember($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data Berhasil Ditambah'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data Gagal Untuk Ditambahkan'
            ], REST_Controller::HTTP_BAD_REQUEST); // NOT_FOUND (404) being the HTTP response code

        }
    }

    public function index_put()
    {
        $id = $this->put('id_m');
        $data = [
            'nama' => $this->put('nama_m'),
            'kitas' => $this->put('kitas_m'),
            'tipe' => $this->put('tipe'),
            'telp' => $this->put('telp_m')
        ];

        if ($this->member_model->rubahmember($data, $id) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data Berhasil Dirubah'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Data Gagal Untuk Dirubah'
            ], REST_Controller::HTTP_BAD_REQUEST); // NOT_FOUND (404) being the HTTP response code

        }
    }
}
