<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pinjam extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('pinjam_model');
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
            $pinjam = $this->pinjam_model->getpinjam();
        } else {
            $pinjam = $this->pinjam_model->getpinjam($id);
        }
        if ($pinjam) {
            $this->response([
                'status' => true,
                'data' => $pinjam

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
            if ($this->pinjam_model->deletepinjam($id) > 0);
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
            'kd_transaksi' => $this->post('kd_p'),
            'id' => $this->post('id_m'),
            'tanggal' => $this->post('tanggal_p'),
            'jam_pinjam' => $this->post('jam_p'),
            'jumlah' => $this->post('jumlah_p')
        ];

        if ($this->pinjam_model->tambahpinjam($data) > 0) {
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
        $id = $this->put('kd_p');
        $data = [
            'id' => $this->put('id_m'),
            'tanggal' => $this->put('tanggal_p'),
            'jam_pinjam' => $this->put('jam_p'),
            'jumlah' => $this->put('jumlah_p')
        ];

        if ($this->pinjam_model->rubahpinjam($data, $id) > 0) {
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
