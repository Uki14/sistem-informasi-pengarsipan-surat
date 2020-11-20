<?php
class ModelSuratMasuk extends CI_Model
{
    public function get()
    {
        return $this->db->get('suratmasuk');
    }

    public function insert($array)
    {
        return $this->db->insert('suratmasuk', $array);
    }

    public function update($array, $id)
    {
        return $this->db->update('suratmasuk', $array, ['id_suratmasuk' => $id]);
    }
}
