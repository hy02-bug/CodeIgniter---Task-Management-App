<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Model {
    // Model code goes here

    private $table = 'tasks';

    //Get All Tasks
    public function getAllTasks() {
        $query = $this->db->get($this->table);
        return $query->result();
    }

	 // Get All Tasks By User
    public function getAllTasksByUser($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($this->table);
        return $query->result();
    }
    // Get Task by ID
    public function getTaskById($id) {
        $query = $this->db->get_where($this->table, array('id' => $id));
        return $query->row();
    }

    // Create Task
    public function createTask($data) {
        return $this->db->insert($this->table, $data);
    }

    // Update Task
    public function updateTask($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Delete Task
    public function deleteTask($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    //Update Task Status
    public function updateTaskStatus($id, $status) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, array('status' => $status));
	}
	//View Task Details	
	public function get($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

}
