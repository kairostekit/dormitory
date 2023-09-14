<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view("login");
    }

    public function checkLogin(){
        return true;
    }

    public function login()
    {
        redirect(base_url('home'));
    }

    public function logout(){
        redirect(base_url());
    }
}
