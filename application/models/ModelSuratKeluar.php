<?php
class ModelSuratKeluar extends CI_Model
{
    public function get()
    {
        return $this->db->get('suratkeluar');
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('suratkeluar', ['id_suratkeluar' => $id]);
    }

    public function insert($array)
    {
        return $this->db->insert('suratkeluar', $array);
    }

    public function update($array, $id)
    {
        return $this->db->update('suratkeluar', $array, ['id_suratkeluar' => $id]);
    }
}
