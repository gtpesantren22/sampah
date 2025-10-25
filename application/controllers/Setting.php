<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Modeldata', 'model');

        $this->token = $this->model->getBy('settings', 'nama', 'token')->row('isi');
    }

    public function index()
    {
        $apiKey = $this->model->getBy('settings', 'nama', 'apiKey')->row('isi');
        $hasil = callApi('http://31.97.179.141:3000/api/getState', $apiKey, 'GET');
        $scr = callApi('http://31.97.179.141:3000/api/getQR', $apiKey, 'GET');

        $data['status'] = $hasil['results']['state'];
        $data['scr'] = $scr;
        $data['w_pagi'] = $this->model->getBy('settings', 'nama', 'w_pagi')->row('isi');
        $data['w_sore'] = $this->model->getBy('settings', 'nama', 'w_sore')->row('isi');
        $data['groups'] = $this->model->getBy('receiver', 'jenis', 'group')->result();

        $this->load->view('setting', $data);
    }

    public function startService()
    {
        $apiKey = $this->model->getBy('settings', 'nama', 'apiKey')->row('isi');
        $hasil = callApi('http://31.97.179.141:3000/api/serviceStart', $apiKey, 'GET');

        if ($hasil && isset($hasil['code']) && $hasil['code'] == 200) {
            redirect('setting');
        }
    }

    public function setKiriman()
    {
        $pagi = $this->input->post('pagi', TRUE);
        $sore = $this->input->post('sore', TRUE);

        $q1 = $this->model->ubah('settings', 'nama', 'w_pagi', ['isi' => $pagi]);
        $q2 = $this->model->ubah('settings', 'nama', 'w_sore', ['isi' => $sore]);
        if ($q1 || $q2) {
            redirect('setting');
        }
    }

    public function groups()
    {
        $apiKey = $this->model->getBy('settings', 'nama', 'apiKey')->row('isi');
        $scr = callApi('http://31.97.179.141:3000/api/getListGroup', $apiKey, 'GET');

        echo json_encode($scr);
        // echo "<pre>";
        // var_dump($scr['results']);
        // echo "</pre>";
    }

    public function addGroup()
    {
        $id = $this->input->post('id', TRUE);
        $nama = $this->input->post('nama', TRUE);
        $cek = $this->model->getBy('receiver', 'kode', $id)->row();
        if ($cek) {
            echo json_encode(['status' => 'error', 'message' => 'Group sudah ada']);
            die();
        } else {
            $data = ['nama' => $nama, 'kode' => $id, 'jenis' => 'group'];
            $this->model->simpan('receiver', $data);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Tambah group berhasil']);
            } else {
                echo json_encode(['status' => 'gagal', 'message' => 'Tambah group gagal']);
            }
        }
    }

    public function delGroup($id)
    {
        $sq = $this->model->hapus('receiver', 'id', $id);
        if ($sq) {
            redirect('setting');
        } else {
            redirect('setting');
        }
    }
}
