<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }



    public function index()
    {

        $Load = new MY_Loader();
        $CD_models = new CD_models();
        // $this->load->tee

        $Load->template("home",[]);
    }
}
