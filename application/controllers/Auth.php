<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($data = array("sError" => null))
    {
        $this->load->view("login", $data);
    }

    public function checkLogin()
    {

        try {
            if (isset($_SESSION["account"])) {
                return true;
            } else {
                $this->logout();
            }
        } catch (Exception $e) {
            $this->logout();
        }
    }

    public function login()
    {

        $input = new CI_Input();
        $ACC_USERNAME = $input->post('ACC_USERNAME');
        $ACC_USERNAME = $input->post('ACC_PASSWORD');

        $data = [
            "ACC_USERNAME" => $ACC_USERNAME,
        ];

        $ACC = new Account_models();

        $RES = $ACC->QueryResources([
            "WHERE" => [
                "account" => $data
            ],
            "ONE_ROW" => true,
        ]);




        if (!empty($RES)) {
            $_SESSION["account"] = $RES ;
            redirect(base_url("home"));
        } else {
            $this->index([
                'sError' => 'กรุณาตรวจสอบรหัสผ่าน',
            ]);
        }

    }

    public function logout()
    {
        // unset_user_session();
        unset($_SESSION["account"]);
        redirect(base_url());
    }
}
