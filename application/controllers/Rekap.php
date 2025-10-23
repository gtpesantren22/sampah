<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap extends CI_Controller
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
        $qr = $this->db->query("SELECT * FROM absensi WHERE jenis = 'P' GROUP BY tanggal ORDER BY tanggal DESC")->result();
        $datakirim = [];
        foreach ($qr as $row) {
            $pagi = $this->db->query("SELECT SUM(IF(pagi = 1, 1, 0)) AS sudah, SUM(IF(pagi = 0, 1, 0)) AS belum FROM absensi WHERE tanggal = '$row->tanggal' AND jenis = 'P'")->row();
            $sore = $this->db->query("SELECT SUM(IF(sore = 1, 1, 0)) AS sudah, SUM(IF(sore = 0, 1, 0)) AS belum FROM absensi WHERE tanggal = '$row->tanggal' AND jenis = 'P'")->row();
            $datakirim[] = [
                'tanggal' => $row->tanggal,
                'pagi' => round(($pagi->sudah / ($pagi->sudah + $pagi->belum)) * 100, 1),
                'sore' => round(($sore->sudah / ($sore->sudah + $sore->belum)) * 100, 1),
            ];
        }
        $data['data'] = $datakirim;
        $this->load->view('rekap', $data);
    }
}
