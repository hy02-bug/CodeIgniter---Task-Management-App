<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function index()
    {
        // Simple query
        $query = $this->db->query("SELECT DATABASE() as dbname");
        $row = $query->row();
        echo "Connected to database: " . $row->dbname;
    }
}
