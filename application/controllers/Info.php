<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Info extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modeldata', 'model');
        $this->url = $this->model->getBy('settings', 'nama', 'url')->row('isi');
        $this->apiKey = $this->model->getBy('settings', 'nama', 'apiKey')->row('isi');
    }

    public function rekapHarian($waktu, $tgl)
    {
        $data['waktu'] = $waktu;
        $data['tanggal'] = $tgl;

        $data['sudah'] = $this->model->getBy3('absensi', 'tanggal', $tgl, 'jenis', 'P', $waktu, 1)->num_rows();
        $data['belum'] = $this->model->getBy3('absensi', 'tanggal', $tgl, 'jenis', 'P', $waktu, 0)->num_rows();

        $data['pagi'] = $this->db->query("SELECT SUM(IF(pagi = 1, 1, 0)) AS sudah, SUM(IF(pagi = 0, 1, 0)) AS belum FROM absensi WHERE tanggal = '$tgl' AND jenis = 'P'")->row();
        $data['sore'] = $this->db->query("SELECT SUM(IF(sore = 1, 1, 0)) AS sudah, SUM(IF(sore = 0, 1, 0)) AS belum FROM absensi WHERE tanggal = '$tgl' AND jenis = 'P'")->row();

        $data['data'] = $this->model->getBy2('absensi', 'tanggal', $tgl, 'jenis', 'P')->result();
        $this->load->view('infoHarian', $data);
    }

    public function test()
    {
        $params = [
            'phone' => '085236924510',
            'message' => 'Test hasil',
        ];
        $kirim = callApi($this->url . 'sendMessage', $this->apiKey, 'POST', $params);
        var_dump($kirim);
    }

    public function ssFunc()
    {
        $tglini = date('Y-m-d');
        $w_pagi = $this->model->getBy('settings', 'nama', 'w_pagi')->row('isi');
        $w_sore = $this->model->getBy('settings', 'nama', 'w_sore')->row('isi');
        $url_rekap = $this->model->getBy('settings', 'nama', 'url_rekap')->row('isi');
        $wktTambah5 = date('H:i', strtotime('+5 minutes'));

        if ($wktTambah5 == $w_pagi) {
            file_get_contents($url_rekap . 'pagi/' . $tglini . '&filename=KEBERSIHAN_PAGI_' . $tglini);
        } elseif ($wktTambah5 == $w_sore) {
            file_get_contents($url_rekap . 'sore/' . $tglini . '&filename=KEBERSIHAN_SORE_' . $tglini);
        } else {
            die('Tidak ada jadwal yang cocok');
        }
    }

    public function kirim()
    {
        $tglini = date('Y-m-d');

        $w_pagi = $this->model->getBy('settings', 'nama', 'w_pagi')->row('isi');
        $w_sore = $this->model->getBy('settings', 'nama', 'w_sore')->row('isi');

        $wktnw = date('H:i');
        $datagroup = $this->model->getBy('receiver', 'jenis', 'group')->result();

        if ($wktnw == $w_pagi) {
            $imgurl = "http://31.97.179.141:3100/capture-result/KEBERSIHAN_PAGI_$tglini.png";
            foreach ($datagroup as $key) {
                $params = [
                    'id_group' => $key->kode,
                    'url_file' => $imgurl,
                    'as_document' => 0,
                ];
                callApi($this->url . 'sendMediaFromUrlGroup', $this->apiKey, 'POST', $params);
            }
        } elseif ($wktnw == $w_sore) {
            $imgurl = "http://31.97.179.141:3100/capture-result/KEBERSIHAN_SORE_$tglini.png";
            foreach ($datagroup as $key) {
                $params = [
                    'id_group' => $key->kode,
                    'url_file' => $imgurl,
                    'as_document' => 0,
                ];
                callApi($this->url . 'sendMediaFromUrlGroup', $this->apiKey, 'POST', $params);
            }
        } else {
            die();
        }
    }
}
