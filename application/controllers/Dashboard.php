<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
        $harini = date('Y-m-d');
        $data['pagi'] = $this->db->query("SELECT SUM(IF(pagi = 1, 1, 0)) AS sudah, SUM(IF(pagi = 0, 1, 0)) AS belum FROM absensi WHERE tanggal = '$harini' AND jenis = 'P'")->row();
        $data['sore'] = $this->db->query("SELECT SUM(IF(sore = 1, 1, 0)) AS sudah, SUM(IF(sore = 0, 1, 0)) AS belum FROM absensi WHERE tanggal = '$harini' AND jenis = 'P'")->row();

        $this->load->view('dashboard', $data);
    }
}
