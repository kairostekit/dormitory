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
			"SELECT" => [
				"users_info" => ["*"],
				"room" => ["RM_NAME", "RM_NUMBER"],
			],
			"WHERE" => [
				"users_info" => [
					"USER_STATUS" => "1"
				]
			],
			"JOIN" => [
				"room" => [
					"ON" => "RM_ID",
					"TYPE" => "LEFT",
					"JOIN" => NULL,
					"KEY_JOIN" => "USER_RM_ID",
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


	public function user_info_getData($USER_IDX)
	{
		$user_info = new Users_info_models();

		$USER_ID  = null;

		if (isset($USER_IDX)) {
			$USER_ID = $USER_IDX;
		}
		if (isset($_POST["USER_ID"])) {
			$USER_ID = $_POST["USER_ID"];
		}

		$serach = array();
		if (isset($USER_ID)) {
			$serach = [
				"WHERE" => [
					"users_info" => [
						"USER_ID " => $USER_ID,
					]
				],
				"ONE_ROW" => true,
			];
		} else {
			$serach = array();
		}

		$RES_D = $user_info->QueryResources($serach);
		echo json_encode($RES_D);
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
		$data = array();

		$RES = new Room_models();
		$data['room_all'] = $RES->QueryResources([
			"SELECT" => [
				"room" => ["*"],
				"room_type" => ["*"],
				"users_info" => ["*"],
			],
			"WHERE" => [
				"room" => [
					"RM_STATUS" => 1
				]
			],
			"JOIN" => [

				"room_type" => [
					"ON" => "RT_ID  ",
					"TYPE" => "INNER",
				],
				"users_info" => [
					"ON" => "USER_ID ",
					"TYPE" => "LEFT",
				],
			],
			"TYPE_RESULT" => "object",
		]);

		// echo json_encode($data);

		// return;
		$Load = new MY_Loader();
		$Load->template("room", $data);
	}
	public function room_view_add()
	{

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
		$Load->template("room_view_add", $data);
	}
	public function room_view_edit($RM_ID)
	{
		$RES = new Room_type_models();
		$data['room_type_all'] = $RES->QueryResources([
			"WHERE" => [
				"room_type" => [
					"RT_STATUS" => 1
				]
			],
			"TYPE_RESULT" => "object",
		]);


		$RES = new Room_models();
		$data['room'] = $RES->QueryResources([
			"WHERE" => [
				"room" => [
					"RM_ID" => $RM_ID
				]
			],
			"ONE_ROW" => TRUE,
			"TYPE_RESULT" => "object",
		]);


		// echo json_encode($data);
		$Load = new MY_Loader();
		$Load->template("room_view_edit", $data);
	}
	public function room_insert_add()
	{

		$RM_NAME = $_POST["RM_NAME"];
		$RT_ID = $_POST["RT_ID"];
		$RM_NUMBER = $_POST["RM_NUMBER"];

		$Room = new Room_models();
		$RES_D = $Room->QueryResources([
			"WHERE" => [
				"room" => [
					"RM_NAME" => $RM_NAME,
					"RM_STATUS !=" => 0,
				]
			],
			"ONE_ROW" => true,
		]);


		if (!empty($RES_D)) {
			echo "<script>alert('ตรวจพบข้อมูลที่อยู่อยู่แล้ว');history.back(-1)</script>";
			return;
		}

		if ($Room->InsertResources([
			"RM_NAME" => $RM_NAME,
			"RT_ID" => $RT_ID,
			"RM_NUMBER" => $RM_NUMBER,
		])) {
			$url = base_url('home/room');
			echo "<script>alert('เพิ่มข้อมูลสำเร็จ');location.assign('$url')</script>";
		} else {
			echo "<script>alert('เพิ่มข้อมูลไม่สำเร็จ');history.back(-1)</script>";
		}
	}
	public function room_update_edit($RM_ID)
	{
		$RM_NAME = $_POST["RM_NAME"];
		$RT_ID = $_POST["RT_ID"];
		$RM_NUMBER = $_POST["RM_NUMBER"];

		$Room = new Room_models();
		$RES_D = $Room->QueryResources([
			"WHERE" => [
				"room" => [
					"RM_NAME" => $RM_NAME,
					"RM_ID !=" => $RM_ID,
					"RM_STATUS !=" => 0,
				]
			],
			"ONE_ROW" => true,
		]);


		if (!empty($RES_D)) {
			echo "<script>alert('ตรวจพบข้อมูลที่อยู่อยู่แล้ว');history.back(-1)</script>";
			return;
		}



		$check = $Room->UpdateResources([
			"WHERE" => [
				"RM_ID" =>  $RM_ID
			],
			"DATA" => $this->input->post(),
		]);

		if ($check) {
			$url = base_url('home/room');
			echo "<script>alert('แก้ไขข้อมูลสำเร็จ');location.assign('$url')</script>";
		} else {
			echo "<script>alert('แก้ไขข้อมูลไม่สำเร็จ');history.back(-1)</script>";
		}
	}
	public function room_update_delete($RM_ID)
	{
		$Room_ = new Room_models();
		$check = $Room_->UpdateResources([
			"WHERE" => [
				"RM_ID" =>  $RM_ID
			],
			"DATA" => [
				"RM_STATUS" => 0,
			],
		]);

		if ($check) {
			$url = base_url('home/room');
			echo "<script>alert('ลบข้อมูลสำเร็จ');location.assign('$url')</script>";
		} else {
			echo "<script>alert('ลบข้อมูลไม่สำเร็จ');history.back(-1)</script>";
		}
	}

	public function room_getData($RM_IDX)
	{


		$serach = array();

		$Room = new Room_models();
		$RM_ID  = null;

		if (isset($RM_IDX)) {
			$RM_ID = $RM_IDX;
		}
		if (isset($_POST["RM_ID"])) {
			$RM_ID = $_POST["RM_ID"];
		}



		if ($RM_ID != null) {
			$serach = [
				"WHERE" => [
					"room" => [
						"RM_ID" => $RM_ID,
					]
				],
				"JOIN" => [
					"room_type" => [
						"ON" => "RT_ID",
						"TYPE" => "INNER",
					]
				],
				"ONE_ROW" => true,
			];
		} else {
			$serach = array();
		}
		$RES_D = $Room->QueryResources($serach);
		echo json_encode($RES_D);
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

		$RES = new Room_type_models();
		$data['RTYPE'] = $RES->QueryResources([
			"WHERE" => [
				"room_type" => [
					"RT_ID" => $RT_ID
				]
			],
			"TYPE_RESULT" => "object",
			"ONE_ROW" => TRUE,
		]);
		$Load = new MY_Loader();

		$Load->template("room_type_view_edit", $data);
	}
	public function room_type_insert_add()
	{

		$RT_NAME = $_POST["RT_NAME"];
		// $RT_ROOMRENT = $_POST["RT_ROOMRENT"];
		// $RT_RESERVE = $_POST["RT_RESERVE"];
		// $RT_MOVEIN = $_POST["RT_MOVEIN"];
		// $RT_WATER = $_POST["RT_WATER"];
		// $RT_ELECTRICCTY = $_POST["RT_ELECTRICCTY"];
		// $RT_ROOMSIZE = $_POST["RT_ROOMSIZE"];
		// $RT_ROOMSIZE_D = $_POST["RT_ROOMSIZE_D"];
		// $RT_CONDITIONS = $_POST["RT_CONDITIONS"];
		// $RT_DETAILS = $_POST["RT_DETAILS"];


		$Room_type = new Room_type_models();

		$RES_D = $Room_type->QueryResources([
			"WHERE" => [
				"room_type" => [
					"RT_NAME" => $RT_NAME,
					"RT_STATUS !=" => 0,
				]
			],
			"ONE_ROW" => true,
		]);

		if (!empty($RES_D)) {
			echo "<script>alert('ตรวจพบข้อมูลที่อยู่อยู่แล้ว');history.back(-1)</script>";
			return;
		}

		if ($Room_type->InsertResources($this->input->post())) {
			$url = base_url('home/Room_type');
			echo "<script>alert('เพิ่มข้อมูลสำเร็จ');location.assign('$url')</script>";
		} else {
			echo "<script>alert('เพิ่มข้อมูลไม่สำเร็จ');history.back(-1)</script>";
		}
	}
	public function room_type_update_edit($RT_ID)
	{
		$Room_type = new Room_type_models();
		$RT_NAME = $_POST["RT_NAME"];

		$RES_D = $Room_type->QueryResources([
			"WHERE" => [
				"room_type" => [
					"RT_NAME" => $RT_NAME,
					"RT_ID !=" => $RT_ID,
					"RT_STATUS !=" => 0,
				]
			],
			"ONE_ROW" => true,
		]);

		if (!empty($RES_D)) {
			echo "<script>alert('ตรวจพบข้อมูลที่อยู่อยู่แล้ว');history.back(-1)</script>";
			return;
		}


		$Room_type = new Room_type_models();
		$check = $Room_type->UpdateResources([
			"WHERE" => [
				"RT_ID" =>  $RT_ID
			],
			"DATA" => $this->input->post(),
		]);

		if ($check) {
			$url = base_url('home/room_type');
			echo "<script>alert('แก้ไขข้อมูลสำเร็จ');location.assign('$url')</script>";
		} else {
			echo "<script>alert('แก้ไขข้อมูลไม่สำเร็จ');history.back(-1)</script>";
		}
	}
	public function room_type_update_delete($RT_ID)
	{

		$Room_type_ = new Room_type_models();
		$check = $Room_type_->UpdateResources([
			"WHERE" => [
				"RT_ID" =>  $RT_ID
			],
			"DATA" => [
				"RT_STATUS" => 0,
			],
		]);

		if ($check) {
			$url = base_url('home/room_type');
			echo "<script>alert('ลบข้อมูลสำเร็จ');location.assign('$url')</script>";
		} else {
			echo "<script>alert('ลบข้อมูลไม่สำเร็จ');history.back(-1)</script>";
		}
	}

	public function room_type_getData($RT_IDx)
	{

		$serach = array();

		$Room_type = new Room_type_models();
		$RT_ID  = null;

		if (isset($RT_IDx)) {
			$RT_ID = $RT_IDx;
		}
		if (isset($_POST["RT_ID"])) {
			$RT_ID = $_POST["RT_ID"];
		}

		$Room_type = new Room_type_models();
		$serach = array();
		if (isset($RT_ID)) {
			$serach = [
				"WHERE" => [
					"room_type" => [
						"RT_ID " => $RT_ID,
					]
				],
				"ONE_ROW" => true,
			];
		} else {
			$serach = array();
		}
		$RES_D = $Room_type->QueryResources($serach);

		echo json_encode($RES_D);
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

		$data = array();

		$RES = new Make_contract_models();
		$data['Make_all'] = $RES->QueryResources([
			"WHERE" => [
				"make_contract" => [
					"MCO_STATUS" => "1"
				]
			],
			"TYPE_RESULT" => "object",
		]);

		// echo json_encode($data);
		$Load = new MY_Loader();
		$Load->template("make_contract", $data);
	}
	public function make_contract_view_add()
	{
		$data = array();

		$RES = new Room_models();
		$data['room_all'] = $RES->QueryResources([
			"WHERE" => [
				"room" => [
					"RM_STATUS" => 1,
					"RM_USE" => '1'
				]
			],
			"JOIN" => [
				"room_type" => [
					"ON" => "RT_ID",
					"TYPE" => "INNER",
				]
			],
			"TYPE_RESULT" => "object",
		]);


		$RES = new Users_info_models();
		$data['Users_info_all'] = $RES->QueryResources([
			"WHERE" => [
				"users_info" => [
					"USER_STATUS" => 1
				]
			],
			"TYPE_RESULT" => "object",
		]);


		// echo json_encode($data);

		$Load = new MY_Loader();
		$Load->template("make_contract_view_add", $data);
	}
	public function make_contract_view_edit($MCO_ID)
	{

		$RES = new Room_models();
		$data['room_all'] = $RES->QueryResources([
			"WHERE" => [
				"room" => [
					"RM_STATUS" => 1,
					"RM_USE" => '1'

				]
			],
			"JOIN" => [
				"room_type" => [
					"ON" => "RT_ID",
					"TYPE" => "INNER",
				]
			],
			"TYPE_RESULT" => "object",
		]);

		$RES = new Users_info_models();
		$data['Users_info_all'] = $RES->QueryResources([
			"WHERE" => [
				"users_info" => [
					"USER_STATUS" => 1
				]
			],
			"TYPE_RESULT" => "object",
		]);


		$RES = new Make_contract_models();
		$data['MCO'] = $RES->QueryResources([
			"WHERE" => [
				"make_contract" => [
					"MCO_ID" => $MCO_ID
				]
			],
			"TYPE_RESULT" => "object",
			"ONE_ROW" => TRUE,
		]);
		$Load = new MY_Loader();
		$Load->template("make_contract_view_edit", $data);
	}
	public function make_contract_insert_add()
	{

		$RM_ID = $_POST["RM_ID"];
		$USER_ID = $_POST["USER_ID"];



		$make_contract = new Make_contract_models();
		$Last = $make_contract->InsertResources($this->input->post());

		$ROOM = new Room_models();
		$ROOM->UpdateResources([
			"WHERE" => [
				"RM_ID" => $RM_ID
			],
			"DATA" => [
				"RM_USE" => "S",
			],
		]);

		$USER = new Users_info_models();
		$USER->UpdateResources([
			"WHERE" => [
				"USER_ID" => $USER_ID
			],
			"DATA" => [
				"USER_RM_ID" => $RM_ID,
			],
		]);
		if ($Last) {
			$url = base_url('home/make_contract');
			echo "<script>alert('ทำสัญญาสำเร็จ');location.assign('$url')</script>";
		} else {
			echo "<script>alert('เพิ่มข้อมูลไม่สำเร็จ');history.back(-1)</script>";
		}
	}
	public function make_contract_update_edit($MCO_IDX)
	{


		$user_info = new Make_contract_models();

		$MCO_ID  = null;

		if (isset($MCO_IDX)) {
			$MCO_ID = $MCO_IDX;
		}
		if (isset($_POST["MCO_ID"])) {
			$MCO_ID = $_POST["MCO_ID"];
		}


		$CLASS = new Make_contract_models();
		$CHECK = $CLASS->UpdateResources([
			"WHERE" => [
				"MCO_ID" => $MCO_ID
			],
			"DATA" => $this->input->post(),

		]);

		if (!$CHECK) {
			echo "<script>alert('แก้ไขข้อมูลไม่สำเร็จ');history.back(-1)</script>";
			return;
		}
		$url = base_url('home/make_contract');
		echo "<script>alert('แก้ไขข้อมูลสำเร็จ');location.assign('$url')</script>";
	}
	public function make_contract_update_delete($MCO_ID)
	{
		$Make_contract = new Make_contract_models();
		$check = $Make_contract->UpdateResources([
			"WHERE" => [
				"MCO_ID" =>  $MCO_ID
			],
			"DATA" => [
				// "RT_STATUS" => 0,
				"MCO_STATUS_CANCEL" => 1,
			],
		]);

		if ($check) {
			$url = base_url('home/make_contract');
			echo "<script>alert('ยกเลิกสำเร็จ');location.assign('$url')</script>";
		} else {
			echo "<script>alert('ยกเลิกไม่สำเร็จ');history.back(-1)</script>";
		}
	}

	public function make_contract_view_print($MCO_IDX)
	{
		$MCO_ID  = null;

		if (isset($MCO_IDX)) {
			$MCO_ID = $MCO_IDX;
		}
		if (isset($_POST["MCO_ID"])) {
			$MCO_ID = $_POST["MCO_ID"];
		}
		if (isset($_GET["MCO_ID"])) {
			$MCO_ID = $_GET["MCO_ID"];
		}


		$data = array();

		$CLASS = new Make_contract_models();
		$data['LIST_DATA'] = $CLASS->QueryResources([
			"WHERE" => [
				"make_contract" => [
					"MCO_ID" => $MCO_ID
				]
			],
			"JOIN" => [
				"room" => [
					"ON" => "RM_ID",
					"TYPE" => "INNER",
				],
				"room_type" => [
					"ON" => "RT_ID",
					"TYPE" => "INNER",
					"JOIN" => 'room',
				],
				"users_info" => [
					"ON" => "USER_ID",
					"TYPE" => "INNER",
				]
			],
			"TYPE_RESULT" => "object",
			"ONE_ROW" => TRUE,
		]);



		// echo json_encode($data);
		$Load = new MY_Loader();
		$Load->view("make_contract_view_print", $data);
	}


	public function make_contract_update_RESERVE_PAY($MCO_ID)
	{
		$Make_contract = new Make_contract_models();
		$check = $Make_contract->UpdateResources([
			"WHERE" => [
				"MCO_ID" =>  $MCO_ID
			],
			"DATA" => [
				// "RT_STATUS" => 0,
				"MCO_RESERVE_PAY" => 1,
			],
		]);

		if ($check) {
			$url = base_url('home/make_contract');
			echo "<script>alert('จ่ายสำเร็จ');location.assign('$url')</script>";
		} else {
			echo "<script>alert('จ่ายไม่สำเร็จ');history.back(-1)</script>";
		}
	}

	public function make_contract_update_MOVEIN_PAY($MCO_ID)
	{
		$Make_contract = new Make_contract_models();
		$check = $Make_contract->UpdateResources([
			"WHERE" => [
				"MCO_ID" =>  $MCO_ID
			],
			"DATA" => [
				// "RT_STATUS" => 0,
				"MCO_MOVEIN_PAY" => 1,
			],
		]);

		if ($check) {
			$url = base_url('home/make_contract');
			echo "<script>alert('จ่ายสำเร็จ');location.assign('$url')</script>";
		} else {
			echo "<script>alert('จ่ายไม่สำเร็จ');history.back(-1)</script>";
		}
	}
}
