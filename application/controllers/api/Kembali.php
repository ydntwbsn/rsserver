<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Kembali extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('kembali_model');
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
            $kembali = $this->kembali_model->getkembali();
        } else {
            $kembali = $this->kembali_model->getkembali($id);
        }
        if ($kembali) {
            $this->response([
                'status' => true,
                'data' => $kembali

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
        $id = $this->delete('id');
        if ($id === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'Perintah Ini Membutuhkan ID'
            ], REST_Controller::HTTP_NOT_FOUND);
        } else {
            if ($this->kembali_model->deletekembali($id) > 0);
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
            'kd_transaksi' => $this->post('kd_k'),
            'tanggal_kembali' => $this->post('tanggal_k'),
            'jam_kembali' => $this->post('jam_k'),
            'biaya' => $this->post('biaya_k')
        ];

        if ($this->kembali_model->tambahkembali($data) > 0) {
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
        $id = $this->put('kd_k');
        $data = [
            'tanggal_kembali' => $this->put('tanggal_k'),
            'jam_kembali' => $this->put('jam_k'),
            'biaya' => $this->put('biaya_k')
        ];

        if ($this->kembali_model->rubahkembali($data, $id) > 0) {
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
