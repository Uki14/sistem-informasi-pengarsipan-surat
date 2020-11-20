<?php
class ModelUsers extends CI_Model
{
    public function get()
    {
        return $this->db->get('user');
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('user', ['id_user' => $id]);
    }

    public function insert($array)
    {
        return $this->db->insert('user', $array);
    }

    public function update($array, $id)
    {
        return $this->db->update('user', $array, ['id_user' => $id]);
    }
}
