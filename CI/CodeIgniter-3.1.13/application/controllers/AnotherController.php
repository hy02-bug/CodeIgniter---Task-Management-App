<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AnotherController extends MY_Controller
{
    public function index()
    {
        // Load tasks from model
        $data['tasks'] = $this->task_model->get_all_tasks();

        // Load the view with the tasks data
        $this->load->view('tasks/index', $data);
    }

    public function view($id)
    {
        // Get task details from model
        $data['task'] = $this->task_model->get_task($id);

        // Load the view with the task data
        $this->load->view('tasks/view', $data);
    }

    public function create()
    {
        // Load the form helper
        $this->load->helper('form');

        // Set validation rules
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            // Load the form view
            $this->load->view('tasks/create');
        }
        else
        {
            // Save the task to the database
            $this->task_model->create_task();

            // Redirect to the tasks list
            redirect('tasks');
        }
    }

    public function edit($id)
    {
        // Load the form helper
        $this->load->helper('form');

        // Get the task details
        $data['task'] = $this->task_model->get_task($id);

        // Set validation rules
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->input->post()) {
            if ($this->form_validation->run() === TRUE) {
                // Update the task in the database
                $this->task_model->update_task($id);

                // Redirect to the tasks list
                redirect('tasks');
            }
        }

        // Load the edit form view
        $this->load->view('tasks/edit', $data);
    }

    public function delete($id)
    {
        // Delete the task from the database
        $this->task_model->delete_task($id);

        // Redirect to the tasks list
        redirect('tasks');
    }
}
