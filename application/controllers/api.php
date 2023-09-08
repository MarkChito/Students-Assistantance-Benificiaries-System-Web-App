<?php
header("Content-type: application/json; charset=utf-8");

defined('BASEPATH') or exit('No direct script access allowed');

class api extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('model');
    }

    public function login()
    {
        $response = null;

        $username = $this->input->get("username");
        $password = $this->input->get("password");

        $username_exists = $this->model->MOD_CHECK_USERNAME($username);

        if ($username_exists) {
            foreach ($username_exists as $result) {
                $db_password = $result->password;
            }

            if (password_verify($password, $db_password)) {
                $response = array(
                    "response_code" => 200,
                    "response_content" => json_encode($username_exists)
                );
            } else {
                $response = array(
                    "response_code" => 404,
                    "response_content" => null
                );
            }
        } else {
            $response = array(
                "response_code" => 404,
                "response_content" => null
            );
        }

        echo json_encode($response);
    }
}
