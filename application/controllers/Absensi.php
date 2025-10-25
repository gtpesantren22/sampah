<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
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

    public function index() {}

    public function input($waktu)
    {
        $data['waktu'] = $waktu;
        $data['tanggal'] = date('Y-m-d');

        $cek = $this->model->getBy('absensi', 'tanggal', $data['tanggal']);

        if (!$cek->row()) {
            $dtkamar = fetchApiGet('https://data.ppdwk.com/api/datatables?data=pesantren-kamar-santri&page=1&per_page=100&q=&sortby=nama&sortbydesc=ASC', $this->token);
            foreach ($dtkamar['data']['data'] as $key) {

                $data = [
                    'komplek_id' => $key['asrama_id'],
                    'kamar_id' => $key['kamar_id'],
                    'nama' => $key['nama'],
                    'jenis' => $key['asrama']['jenis_asrama'],
                    'pagi' => 0,
                    'sore' => 0,
                    'tanggal' => $data['tanggal'],
                ];
                $this->model->simpan('absensi', $data);
            }
            redirect('absensi/input/' . $waktu);
        } else {
            $data['data'] = $cek->result();
            $this->load->view('absensi', $data);
        }
    }


    public function getKamar()
    {
        $tanggal = $this->input->post('tanggal', TRUE);
        $komplek_id = $this->input->post('komplek_id', TRUE);
        $jkl = $komplek_id == 'Putra' ? 'L' : 'P';

        $dtkamar = $this->db->query("SELECT * FROM absensi WHERE jenis = '$jkl' AND tanggal = '$tanggal' ORDER BY komplek_id ASC, nama ASC ");

        echo json_encode([
            'data' => $dtkamar->result()
        ]);
    }

    public function update()
    {
        $id = $this->input->post('kamar', TRUE);
        $waktu = $this->input->post('waktu', TRUE);
        $action = $this->input->post('action', TRUE);
        $ket = $action == 'sudah' ? 1 : 0;
        $dt = $this->model->getBy('absensi', 'id', $id)->row();
        $jenis = $dt->jenis == 'L' ? 'Putra' : 'Putri';

        $sq = $this->model->ubah('absensi', 'id', $id, [$waktu => $ket]);
        if ($sq) {
            echo json_encode(['status' => 'ok', 'komplek' => $jenis]);
        } else {
            echo json_encode(['status' => 'error', 'komplek' => $jenis]);
        }
    }

    public function reloadKamar($waktu)
    {
        $data['waktu'] = $waktu;
        $data['tanggal'] = date('Y-m-d');

        $dtkamar = fetchApiGet('https://data.ppdwk.com/api/datatables?data=pesantren-kamar-santri&page=1&per_page=100&q=&sortby=nama&sortbydesc=ASC', $this->token);
        foreach ($dtkamar['data']['data'] as $key) {
            $cek = $this->model->getBy2('absensi', 'tanggal', $data['tanggal'], 'kamar_id', $key['kamar_id'])->row();
            if (!$cek) {
                $data = [
                    'komplek_id' => $key['asrama_id'],
                    'kamar_id' => $key['kamar_id'],
                    'nama' => $key['nama'],
                    'jenis' => $key['asrama']['jenis_asrama'],
                    'pagi' => 0,
                    'sore' => 0,
                    'tanggal' => $data['tanggal'],
                ];
                $this->model->simpan('absensi', $data);
            }
        }
        redirect('absensi/input/' . $waktu);
    }
}

    // $dtkomplek = fetchApiGet('https://data.ppdwk.com/api/datatables?data=pesantren-asrama&page=1&per_page=10&q=&sortby=nama&sortbydesc=ASC', $this->token);
    // $data['komplek'] = $dtkomplek['data']['data'];