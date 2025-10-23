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
}
