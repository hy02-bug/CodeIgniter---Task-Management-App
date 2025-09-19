<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User');  // We'll create User model
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
    }

    // Show login page
    public function login() {
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->User->get_by_username($username);

            if ($user && password_verify($password, $user->password)) {
                // Save user session
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'logged_in' => TRUE
                ]);
                redirect('TaskController'); // redirect to tasks
            } else {
                $data['error'] = "Invalid username or password.";
                $this->load->view('welcome_message', $data);
                return;
            }
        }
        $this->load->view('welcome_message');
    }

    // Register page
    public function register() {
        if ($this->input->post()) {
            $data = [
                'username' => $this->input->post('username'),
                'email'    => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            ];
            $this->User->insert($data);
            redirect('auth/login');
        }
        $this->load->view('auth/register');
    }

    // Forgot password page (simple placeholder)
    public function forgot_password() {
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $user = $this->User->get_by_email($email);

            if ($user) {
                // In real app: send email with reset link
                $data['message'] = "Password reset instructions sent to your email.";
            } else {
                $data['error'] = "Email not found.";
            }
            $this->load->view('auth/forgot_password', $data);
            return;
        }
        $this->load->view('auth/forgot_password');
    }

    // Logout
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
