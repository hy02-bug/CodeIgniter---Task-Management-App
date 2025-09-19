<?php
defined('BASEPATH') || exit('No direct script access allowed');

class TaskController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Task');
        $this->load->helper(['url', 'form']);
    }

    // List tasks
    public function index() {
		$user_id = $this->session->userdata('user_id');
    	$data['tasks'] = $this->Task->getAllTasksByUser($user_id);
		$data['user'] = $this->session->userdata('username');
        $this->load->view('tasks/index', $data);
    }

    // Show create form
    public function create() {
        if ($this->input->post()) {
            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'status' => 'pending',
				'user_id' => $this->session->userdata('user_id') // add user_id to tasks
            ];
            $this->Task->createTask($data);
            redirect('TaskController/index');
        }
        $this->load->view('tasks/create');
    }

//    Edit task
    public function edit($id) {
        $data['task'] = $this->Task->getTaskById($id);

        if ($this->input->post()) {
            $update = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'status' => $this->input->post('status')
            ];
            $this->Task->updateTask($id, $update);
            redirect('TaskController/index');
        }

        $this->load->view('tasks/edit', $data);
    }

    // Delete task
    public function delete($id) {
        $this->Task->deleteTask($id);
        redirect('TaskController/index');
    }

	// View task details
	public function view($id) {
    $data['task'] = $this->Task->get($id);
    $this->load->view('tasks/task_details', $data);
}
}
