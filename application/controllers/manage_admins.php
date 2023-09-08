<?php
defined('BASEPATH') or exit('No direct script access allowed');

class manage_admins extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('model');
    }

    public function index()
    {
        if ($this->session->userdata("primary_key")) {
            if ($this->session->userdata("user_type") == "super admin") {
                $this->session->set_userdata("title", "Administrators");
                $this->session->set_userdata("current_tab", "manage_admins");

                $this->load->view('templates/header.php');
                $this->load->view('pages/manage_admins_view.php');
                $this->load->view('templates/footer.php');
            } else {
                http_response_code(403);
                exit();
            }
        } else {
            $this->session->set_userdata("alert", array(
                "title" => "Opps...",
                "message" => "You must login first",
                "type" => "error"
            ));

            redirect(base_url() . "login");
        }
    }
}
