<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User');
        $this->load->library('session');

        // CORS setup for React
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Content-Type: application/json; charset=utf-8");

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }
    }

    // POST /index.php/api/auth/login
    public function login() {
        $data = json_decode($this->input->raw_input_stream, true);

        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        $user = $this->User->get_by_username($username);

        if ($user && password_verify($password, $user->password)) {
            // Save session if needed
            $this->session->set_userdata([
                'user_id' => $user->id,
                'username' => $user->username,
                'logged_in' => TRUE
            ]);

            echo json_encode([
                'status' => 'success',
                'user' => [
                    'id' => $user->id,
                    'username' => $user->username
                ]
            ]);
        } else {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid username or password']);
        }
    }

    // POST /index.php/api/auth/register
    public function register() {
        $data = json_decode($this->input->raw_input_stream, true);

        $insert = [
            'username' => $data['username'] ?? '',
            'email' => $data['email'] ?? '',
            'password' => password_hash($data['password'] ?? '', PASSWORD_DEFAULT),
        ];

        $id = $this->User->insert($insert);

        echo json_encode(['status' => 'success', 'id' => $id]);
    }

    // POST /index.php/api/auth/forgot_password
    public function forgot_password() {
        $data = json_decode($this->input->raw_input_stream, true);

        $email = $data['email'] ?? '';
        $user = $this->User->get_by_email($email);

        if ($user) {
            echo json_encode(['status' => 'success', 'message' => 'Password reset instructions sent.']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Email not found']);
        }
    }

    // GET /index.php/api/auth/logout
    public function logout() {
        $this->session->sess_destroy();
        echo json_encode(['status' => 'success']);
    }
}
