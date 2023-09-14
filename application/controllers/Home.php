<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


        if (!isset($_SESSION["account"])) {
            redirect(base_url());
        }
    }



    public function index()
    {

        $CD_models = new CD_models();
        $data = array();
        $Load = new MY_Loader();
        $Load->template("dashboard", $data);
    }



    function user_info(): void
    {
        $data = array();

        $USER_GET = new Users_info_models();
        $data['USER_ALL'] = $USER_GET->QueryResources([
            "WHERE" => [
                "users_info" => [
                    "USER_STATUS" => "1"
                ]
            ],
            "TYPE_RESULT" => "object",
        ]);

        // echo json_encode($data);
        $Load = new MY_Loader();
        $Load->template("user_info", $data);
    }

    function user_info_view_add()
    {
        $data = array();
        $Load = new MY_Loader();
        $Load->template("user_info_view_add", $data);
    }
    function user_info_insert_add()
    {
        $USER_CITIZEN = $_POST["USER_CITIZEN"];
        $USER_NAME = $_POST["USER_NAME"];
        $USER_PHONE = $_POST["USER_PHONE"];
        $USER_DETAILS = $_POST["USER_DETAILS"];


        $USER_GET = new Users_info_models();
        $RES_D = $USER_GET->QueryResources([
            "WHERE" => [
                "users_info" => [
                    "USER_CITIZEN" => $USER_CITIZEN,
                    "USER_STATUS" => 1,
                ]
            ],
            // "ONE_ROW" => true,
        ]);

        if (!empty($RES_D)) {
            $url = base_url('home/user_info_view_add/');
            echo "<script>alert('ตรวจพบข้อมูลที่อยู่อยู่แล้ว');history.back(-1)</script>";
            return;
        }


        $USER_CH = new Users_info_models();
        $CHECK = $USER_CH->InsertResources([
            "USER_CITIZEN" => $USER_CITIZEN,
            "USER_NAME" => $USER_NAME,
            "USER_PHONE" => $USER_PHONE,
            "USER_DETAILS" => $USER_DETAILS,
        ]);

        if (!$CHECK) {
            $url = base_url('home/user_info_view_add/');
            echo "<script>alert('เพิ่มข้อมูลไม่สำเร็จ');history.back(-1)</script>";
            return;
        }
        $url = base_url('home/user_info');
        echo "<script>alert('เพิ่มข้อมูลสำเร็จ');location.assign('$url')</script>";
    }

    function user_info_view_edit($USER_ID)
    {
        $data = array();

        $USER_GET = new Users_info_models();
        $data['USER_ONE'] = $USER_GET->QueryResources([
            "WHERE" => [
                "users_info" => [
                    "USER_ID" => $USER_ID
                ]
            ],
            "TYPE_RESULT" => "object",
            "ONE_ROW" => true,
        ]);

        // echo json_encode($data);
        $Load = new MY_Loader();
        $Load->template("user_info_view_edit", $data);
    }

    function user_info_update_edit($USER_ID)
    {
        $USER_CITIZEN = $_POST["USER_CITIZEN"];
        $USER_NAME = $_POST["USER_NAME"];
        $USER_PHONE = $_POST["USER_PHONE"];
        $USER_DETAILS = $_POST["USER_DETAILS"];


        $USER_GET = new Users_info_models();
        $RES_D = $USER_GET->QueryResources([
            "WHERE" => [
                "users_info" => [
                    "USER_CITIZEN" => $USER_CITIZEN,
                    "USER_ID !=" => $USER_ID
                ]
            ],
            // "ONE_ROW" => true,
        ]);

        if (!empty($RES_D)) {
            $url = base_url('home/user_info_view_edit/');
            echo "<script>alert('ตรวจพบข้อมูลที่อยู่อยู่แล้ว');history.back(-1)</script>";
            return;
        }

        $USER_CH = new Users_info_models();
        $CHECK = $USER_CH->UpdateResources([
            "WHERE" => [
                "USER_ID" => $USER_ID
            ],
            "DATA" => [
                "USER_CITIZEN" => $USER_CITIZEN,
                "USER_NAME" => $USER_NAME,
                "USER_PHONE" => $USER_PHONE,
                "USER_DETAILS" => $USER_DETAILS,
            ],

        ]);

        if (!$CHECK) {
            $url = base_url('home/user_info_view_edit/');
            echo "<script>alert('แก้ไขข้อมูลไม่สำเร็จ');history.back(-1)</script>";
            return;
        }
        $url = base_url('home/user_info');
        echo "<script>alert('แก้ไขข้อมูลสำเร็จ');location.assign('$url')</script>";
    }
    public function user_info_update_delete($USER_ID)
    {
        $USER_ID = $USER_ID;
        $USER_GET = new Users_info_models();
        $check = $USER_GET->UpdateResources([
            "WHERE" => [
                "USER_ID" =>  $USER_ID
            ],
            "DATA" => [
                "USER_STATUS" => 0,
            ],
        ]);

        if ($check) {
            $url = base_url('home/user_info');
            echo "<script>alert('ลบข้อมูลสำเร็จ');location.assign('$url')</script>";
        } else {
            $url = base_url('home/user_info_view_edit/' . $USER_ID);
            echo "<script>alert('ลบข้อมูลไม่สำเร็จ');history.back(-1)</script>";
        }
    }

    function admin(): void
    {
        $data = array();

        $RES = new Account_models();
        $data['account_ACC'] = $RES->QueryResources([
            "WHERE" => [
                "account" => [
                    "ACC_STATUS" => "1"
                ]
            ],
            "TYPE_RESULT" => "object",
        ]);

        // echo json_encode($data['account_ACC'][0]);
        $Load = new MY_Loader();
        $Load->template("admin", $data);
    }
    public function admin_view_edit($ACC_ID)
    {
        $RES = new Account_models();
        $data['ACC'] = $RES->QueryResources([
            "WHERE" => [
                "account" => [
                    "ACC_ID" => $ACC_ID
                ]
            ],
            "TYPE_RESULT" => "object",
            "ONE_ROW" => TRUE,
        ]);
        $Load = new MY_Loader();
        $Load->template("admin_view_edit", $data);
    }
    public function admin_update_edit($ACC_ID)
    {
        $ACC_ID = $ACC_ID;

        $ACC_NAME = $_POST["ACC_NAME"];
        $ACC_USERNAME = $_POST["ACC_USERNAME"];
        $ACC_PASSWORD = $_POST["ACC_PASSWORD"];


        $data = [
            "ACC_USERNAME" => $ACC_USERNAME,
            "ACC_ID !=" => $ACC_ID,
        ];

        $ACC_D = new Account_models();

        $RES_D = $ACC_D->QueryResources([
            "WHERE" => [
                "account" => $data
            ],
            "ONE_ROW" => true,
        ]);

        if (!empty($RES_D)) {
            $url = base_url('home/admin_view_edit/' . $ACC_ID);
            echo "<script>alert('ตรวจพบข้อมูลที่อยู่อยู่แล้ว');history.back(-1)</script>";
            return;
        }

        $ACC = new Account_models();
        $check = $ACC->UpdateResources([
            "WHERE" => [
                "ACC_ID" =>  $ACC_ID
            ],
            "DATA" => [
                "ACC_NAME" => $ACC_NAME,
                "ACC_USERNAME" => $ACC_USERNAME,
                "ACC_PASSWORD" => $ACC_PASSWORD,
            ],
        ]);

        if ($check) {

            $url = base_url('home/admin');
            echo "<script>alert('แก้ไขข้อมูลสำเร็จ');location.assign('$url')</script>";
        } else {
            $url = base_url('home/admin_view_edit/' . $ACC_ID);
            echo "<script>alert('แก้ไขข้อมูลไม่สำเร็จ');history.back(-1)</script>";
        }
    }


    public function admin_view_add()
    {
        $data = array();
        $Load = new MY_Loader();
        $Load->template("admin_view_add", $data);
    }
    public function admin_insert_add()
    {
        $ACC_NAME = $_POST["ACC_NAME"];
        $ACC_USERNAME = $_POST["ACC_USERNAME"];
        $ACC_PASSWORD = $_POST["ACC_PASSWORD"];

        $data = [
            "ACC_USERNAME" => $ACC_USERNAME,
            "ACC_STATUS" => 1,
        ];

        $ACC_D = new Account_models();

        $RES_D = $ACC_D->QueryResources([
            "WHERE" => [
                "account" => $data
            ],
            "ONE_ROW" => true,
        ]);



        if (!empty($RES_D)) {
            $url = base_url('home/admin_view_add/');
            echo "<script>alert('ตรวจพบข้อมูลที่อยู่อยู่แล้ว');history.back(-1)</script>";
            return;
        }


        $ACC = new Account_models();

        $id = $ACC->InsertResources([
            "ACC_NAME" => $ACC_NAME,
            "ACC_USERNAME" => $ACC_USERNAME,
            "ACC_PASSWORD" => $ACC_PASSWORD,
        ]);

        if (!$id) {
            $url = base_url('home/admin_view_add');
            echo "<script>alert('เพิ่มข้อมูลไม่สำเร็จ');history.back(-1)</script>";
        }
        $url = base_url('home/admin');
        echo "<script>alert('เพิ่มข้อมูลสำเร็จ');location.assign('$url')</script>";
    }

    public function admin_update_delete($ACC_ID)
    {
        $ACC_ID = $ACC_ID;


        $ACC = new Account_models();
        $check = $ACC->UpdateResources([
            "WHERE" => [
                "ACC_ID" =>  $ACC_ID
            ],
            "DATA" => [
                "ACC_STATUS" => 0,
            ],
        ]);

        if ($check) {
            $url = base_url('home/admin');
            echo "<script>alert('ลบข้อมูลสำเร็จ');location.assign('$url')</script>";
        } else {
            $url = base_url('home/admin_view_edit/' . $ACC_ID);
            echo "<script>alert('ลบข้อมูลไม่สำเร็จ');history.back(-1)</script>";
        }
    }



    public function room()
    {
    }
    public function room_view_add()
    {
    }
    public function room_view_edit($RM_ID)
    {
    }
    public function room_insert_add()
    {
    }
    public function room_update_edit($RM_ID)
    {
    }
    public function room_update_delete($RM_ID)
    {
    }



    public function room_type()
    {
        $data = array();

        $RES = new Room_type_models();
        $data['room_type_all'] = $RES->QueryResources([
            "WHERE" => [
                "room_type" => [
                    "RT_STATUS" => 1
                ]
            ],
            "TYPE_RESULT" => "object",
        ]);

        // echo json_encode($data);
        $Load = new MY_Loader();
        $Load->template("room_type", $data);
    }
    public function room_type_view_add()
    {
        $data = array();

        $Load = new MY_Loader();
        $Load->template("room_type_view_add", $data);
    }
    public function room_type_view_edit($RT_ID)
    {
    }
    public function room_type_insert_add()
    {
    }
    public function room_type_update_edit($RT_ID)
    {
    }
    public function room_type_update_delete($RT_ID)
    {
    }




    public function issue_receipt()
    {
    }
    public function issue_receipt_view_add()
    {
    }
    public function issue_receipt_view_edit($IRC_ID)
    {
    }
    public function issue_receipt_insert_add()
    {
    }
    public function issue_receipt_update_edit($IRC_ID)
    {
    }
    public function issue_receipt_update_delete($IRC_ID)
    {
    }


    public function issue_receipt_details()
    {
    }
    public function issue_receipt_details_view_add()
    {
    }
    public function issue_receipt_details_view_edit($IRD_ID)
    {
    }
    public function issue_receipt_details_insert_add()
    {
    }
    public function issue_receipt_details_update_edit($IRD_ID)
    {
    }
    public function issue_receipt_details_update_delete($IRD_ID)
    {
    }




    public function make_contract()
    {
    }
    public function make_contract_view_add()
    {
    }
    public function make_contract_view_edit($MCO_ID)
    {
    }
    public function make_contract_insert_add()
    {
    }
    public function make_contract_update_edit($MCO_ID)
    {
    }
    public function make_contract_update_delete($MCO_ID)
    {
    }
}
