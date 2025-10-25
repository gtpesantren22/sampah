<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modeldata extends CI_Model
{
    public function getBy($table, $where, $dtwhere)
    {
        return $this->db->get_where($table, [$where => $dtwhere]);
    }
    public function getBy2($table, $where, $dtwhere, $where1, $dtwhere1)
    {
        return $this->db->get_where($table, [$where => $dtwhere, $where1 => $dtwhere1]);
    }
    public function getBy3($table, $where, $dtwhere, $where1, $dtwhere1, $where2, $dtwhere2)
    {
        return $this->db->get_where($table, [$where => $dtwhere, $where1 => $dtwhere1, $where2 => $dtwhere2]);
    }

    public function simpan($table, $data)
    {
        $this->db->insert($table, $data);
    }
    public function ubah($table, $where, $dtwhere, $data)
    {
        $this->db->where($where, $dtwhere);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function hapus($table, $where, $dtwhere)
    {
        $this->db->where($where, $dtwhere);
        $this->db->delete($table);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
