<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {

    public function get_all() {
        return $this->db->get('tasks')->result();
    }

    public function get($id) {
        return $this->db->where('id', $id)->get('tasks')->row();
    }

    public function insert($data) {
        $this->db->insert('tasks', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id)->update('tasks', $data);
        return $this->db->affected_rows();
    }

    public function delete($id) {
        $this->db->where('id', $id)->delete('tasks');
        return $this->db->affected_rows();
    }
}
