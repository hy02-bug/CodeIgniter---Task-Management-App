<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Task_model');
        // CORS (DEV): allow React (http://localhost:3000)
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json; charset=utf-8");

        // handle preflight
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }
    }

    // GET    /index.php/api/task
    public function index() {
        echo json_encode($this->Task_model->get_all());
    }

    // GET    /index.php/api/task/{id}
    public function view($id = null) {
        if (!$id) { http_response_code(400); echo json_encode(['error'=>'Missing id']); return; }
        $task = $this->Task_model->get($id);
        if ($task) echo json_encode($task);
        else { http_response_code(404); echo json_encode(['error'=>'Not found']); }
    }

    // POST   /index.php/api/task   (create)
    public function create() {
        $data = json_decode($this->input->raw_input_stream, true);
        if (empty($data['title'])) { http_response_code(400); echo json_encode(['error'=>'Title required']); return; }
        $insert = [
            'title' => $data['title'],
            'description' => isset($data['description']) ? $data['description'] : null,
            'status' => isset($data['status']) ? $data['status'] : 'pending',
        ];
        $id = $this->Task_model->insert($insert);
        echo json_encode(['status'=>'success', 'id'=>$id]);
    }

    // PUT    /index.php/api/task/{id}   (update)
    public function update($id = null) {
        if (!$id) { http_response_code(400); echo json_encode(['error'=>'Missing id']); return; }
        $data = json_decode($this->input->raw_input_stream, true);
        // allow partial updates
        $update = [];
        if (isset($data['title'])) $update['title'] = $data['title'];
        if (isset($data['description'])) $update['description'] = $data['description'];
        if (isset($data['status'])) $update['status'] = $data['status'];
        if (empty($update)) { http_response_code(400); echo json_encode(['error'=>'Nothing to update']); return; }
        $this->Task_model->update($id, $update);
        echo json_encode(['status'=>'success']);
    }

    // DELETE /index.php/api/task/{id}
    public function delete($id = null) {
        if (!$id) { http_response_code(400); echo json_encode(['error'=>'Missing id']); return; }
        $this->Task_model->delete($id);
        echo json_encode(['status'=>'success']);
    }
}
