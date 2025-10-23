<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Info extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modeldata', 'model');
    }

    public function rekapHarian($tgl)
    {

        $data['data'] = $this->model->getBy2('absensi', 'tanggal', $tgl, 'jenis', 'P')->result();
        $this->load->view('infoHarian', $data);
    }
}
