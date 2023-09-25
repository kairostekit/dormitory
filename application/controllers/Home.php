<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();


		// if (!isset($_SESSION["account"])) {
		// 	redirect(base_url());
		// }
	}



	public function index()
	{
		$data = array();
		$Load = new MY_Loader();
		$Issue_receipt_models = new Issue_receipt_models();
		$Room = new Room_models();
		$Room_type = new Room_type_models();
		$Users = new Users_info_models();
		$Issue_receipt_details_models = new Issue_receipt_details_models();
		$month_tbl_models = new month_tbl_models();
		$Make_contract_models = new Make_contract_models();
		$Account_models = new Account_models();


		$ข้อมูลห้อง = $Room->QueryResources([
			"WHERE" => [
				$Room->TB_NAME() => [
					"RM_STATUS" => 1,
				]
			]
		]);

		$temp = array();
		foreach ($ข้อมูลห้อง as $key => $item):

			$obj = new stdClass();
			$obj->label = $item->RM_NAME;
			$ข้อมูลเดือน = $month_tbl_models->QueryResources([]);
			$tdaamp = array();
			foreach ($ข้อมูลเดือน as $mk => $mi):
				$counst_M = count($Make_contract_models->QueryResources([
					"WHERE" => [
						$Make_contract_models->TB_NAME() => [
							"MONTH_ID" => $mi->MONTH_ID,
						]
					]
				]));
				array_push($tdaamp, $counst_M);
			endforeach;

			$obj->data = $tdaamp;
			array_push($temp, $obj);
		endforeach;


		$จำนวนทำสัญญา = $temp;




		$ข้อมูลเดือน = $month_tbl_models->QueryResources([]);
		$tdaamp = array();
		foreach ($ข้อมูลเดือน as $mk => $mi):
			$ยอดทั้งหมด = 0;

			$บิล = $Issue_receipt_models->QueryResources([
				"WHERE" => [
					$Issue_receipt_models->TB_NAME() => [
						"IRC_STATUS_CANCEL" => 0,
						"IRC_MONTH_ID " => $mi->MONTH_ID,
					]
				]

			]);

			foreach ($บิล as $key => $value) {
				$ยอดทั้งหมด += $value->IRC_TOTAL;
			}

			array_push($tdaamp, $ยอดทั้งหมด);
		endforeach;
		$ยอดทั้งหมดบิล = $tdaamp;
		// echo json_encode($tdaamp);
		// return;


		$ย้ายเข้า = $Make_contract_models->QueryResources([
			"WHERE" => [
				$Make_contract_models->TB_NAME() => [
					"MCO_MOVEIN_PAY" => 1,
				]
			]

		]);
		$รอย้ายเข้า = $Make_contract_models->QueryResources([
			"WHERE" => [
				$Make_contract_models->TB_NAME() => [
					"MCO_MOVEIN_PAY" => 0,
				]
			]

		]);

		$จำนวนบิล = $Issue_receipt_models->QueryResources([
			"WHERE" => [
				$Issue_receipt_models->TB_NAME() => [
					"IRC_STATUS_CANCEL" => 0,
				]
			]

		]);

		$จำนวนบิลชำระ = $Issue_receipt_models->QueryResources([
			"WHERE" => [
				$Issue_receipt_models->TB_NAME() => [
					"IRC_STATUS_CANCEL" => 0,
					"IRC_PAYMENT_OK" => 1
				]
			]

		]);

		$จำนวนบิลค้างชำระ = $Issue_receipt_models->QueryResources([
			"WHERE" => [
				$Issue_receipt_models->TB_NAME() => [
					"IRC_STATUS_CANCEL" => 0,
					"IRC_PAYMENT_OK" => 0
				]
			]

		]);


		$จำนวนลูกค้า = $Users->QueryResources([
			"WHERE" => [
				$Users->TB_NAME() => [
					"USER_STATUS" => 1,
				]
			]

		]);

		$จำนวนห้อง = $Room->QueryResources([
			"WHERE" => [
				$Room->TB_NAME() => [
					"RM_STATUS" => 1,
				]
			]
		]);

		$จำนวนห้องว่าง = $Room->QueryResources([
			"WHERE" => [
				$Room->TB_NAME() => [
					"RM_USE" => 1,
					"RM_STATUS" => 1,
				]
			]
		]);

		$จำนวนห้องไม่ว่าง = $Room->QueryResources([
			"WHERE" => [
				$Room->TB_NAME() => [
					"RM_USE" => 0,
					"RM_STATUS" => 1,
				]
			]
		]);

		$จำนวนห้องถูกจอง = $Room->QueryResources([
			"WHERE" => [
				$Room->TB_NAME() => [
					"RM_USE" => "S",
					"RM_STATUS" => 1,
				]
			]
		]);


		$data = [
			"จำนวนลูกค้า" => count($จำนวนลูกค้า),
			"จำนวนห้อง" => count($จำนวนห้อง),
			"จำนวนห้องว่าง" => count($จำนวนห้องว่าง),
			"จำนวนห้องไม่ว่าง" => count($จำนวนห้องไม่ว่าง),
			"จำนวนห้องถูกจอง" => count($จำนวนห้องถูกจอง),
			"จำนวนบิลชำระ" => count($จำนวนบิลชำระ),
			"จำนวนบิลค้างชำระ" => count($จำนวนบิลค้างชำระ),
			"จำนวนบิล" => count($จำนวนบิล),
			"ย้ายเข้า" => count($ย้ายเข้า),
			"รอย้ายเข้า" => count($รอย้ายเข้า),
			"จำนวนทำสัญญา" => $จำนวนทำสัญญา,
			"ยอดทั้งหมดบิล" => $ยอดทั้งหมดบิล
		];







		$Load->template("dashboard", $data);
	}



	function user_info()
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
				"USER_ID" => $USER_ID
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

		$USER_ID = null;

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

	function admin()
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
				"ACC_ID" => $ACC_ID
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
				"ACC_ID" => $ACC_ID
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

		if (
			$Room->InsertResources([
				"RM_NAME" => $RM_NAME,
				"RT_ID" => $RT_ID,
				"RM_NUMBER" => $RM_NUMBER,
			])
		) {
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
				"RM_ID" => $RM_ID
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
				"RM_ID" => $RM_ID
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

	public function room_update_move($RM_IDX = null)
	{
		$serach = array();

		$Room = new Room_models();
		$RM_ID = null;



		if (isset($RM_IDX)) {
			$RM_ID = $RM_IDX;
		}
		if (isset($_POST["RM_ID"])) {
			$RM_ID = $_POST["RM_ID"];
		}

		$DATA = $Room->QueryResources([
			"WHERE" => [
				$Room::TB_NAME() => [
					"RM_ID" => $RM_ID
				]
			],
			"ONE_ROW" => TRUE,
		]);

		// echo json_encode($DATA);
		// return;




		$USER_ID = $DATA->USER_ID;
		$RM_MCO_ID = $DATA->RM_MCO_ID;
		$USER = new Users_info_models();
		$USER->UpdateResources([
			"WHERE" => [
				"USER_ID" => $USER_ID
			],
			"DATA" => [
				"USER_RM_ID" => NULL,
			],
		]);

		$MCO = new Make_contract_models();
		$MCO->UpdateResources([
			"WHERE" => [
				"MCO_ID" => $RM_MCO_ID
			],
			"DATA" => [
				"MCO_STATUS_SUCCESS" => 1,
				"MCO_STATUS_MOVE" => 1,
			],
		]);

		$check = $Room->UpdateResources([
			"WHERE" => [
				"RM_ID" => $RM_ID
			],
			"DATA" => [
				"RM_STATUS" => 1,
				"USER_ID" => NULL,
				"RM_MOVEINDATE" => NULL,
				"RM_USE" => 1
			],
		]);


		if ($check) {
			$url = base_url('home/room');
			echo "<script>alert('บันทึกข้อมูลสำเร็จ');location.assign('$url')</script>";
		} else {
			echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ');history.back(-1)</script>";
		}
	}


	public function room_update_moveIN($RM_IDX = null)
	{
		$RM_ID = null;
		if (isset($RM_IDX)) {
			$RM_ID = $RM_IDX;
		}
		if (isset($_POST["RM_ID"])) {
			$RM_ID = $_POST["RM_ID"];
		}
		if (isset($_GET["RM_ID"])) {
			$RM_ID = $_GET["RM_ID"];
		}

		$Make_contract = new Make_contract_models();
		$Issue_receipt_models = new Issue_receipt_models();
		$Room = new Room_models();
		$Room_type = new Room_type_models();
		$Users = new Users_info_models();
		$Issue_receipt_details_models = new Issue_receipt_details_models();
		$month_tbl_models = new month_tbl_models();
		$Make_contract_models = new Make_contract_models();
		$Account_models = new Account_models();

		$DATAR = $Room->QueryResources([
			"WHERE" => [
				$Room->TB_NAME() => [
					"RM_ID" => $RM_ID
				]
			],
			"ONE_ROW" => TRUE,
		]);

		$check = $Make_contract->UpdateResources([
			"WHERE" => [
				"MCO_ID" => $DATAR->RM_MCO_ID
			],
			"DATA" => [
				"MCO_MOVEIN_PAY" => 1,
			],
		]);

		$Room->UpdateResources(
			[
				"WHERE" => [
					"RM_ID" => $RM_ID
				],
				"DATA" => [
					"RM_USE" => 0,
				],
			]
		);

		if ($check) {
			$url = base_url('home/make_contract');
			echo "<script>alert('ย้ายเข้าอยู่สำเร็จ');location.assign('$url')</script>";
		} else {
			echo "<script>alert('ย้ายเข้าอยู่ไม่สำเร็จ');history.back(-1)</script>";
		}
	}


	public function room_getData($RM_IDX)
	{


		$serach = array();

		$Room = new Room_models();
		$RM_ID = null;

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
				"RT_ID" => $RT_ID
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
				"RT_ID" => $RT_ID
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
		$RT_ID = null;

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
						"RT_ID" => $RT_ID,
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

		$data = array();

		$Issue_receipt_models = new Issue_receipt_models();
		$Room = new Room_models();
		$Room_type = new Room_type_models();
		$Users = new Users_info_models();
		$Issue_receipt_details_models = new Issue_receipt_details_models();
		$month_tbl_models = new month_tbl_models();
		$data['Issue_receipt_all'] = $Issue_receipt_models->QueryResources([
			"WHERE" => [
				$Issue_receipt_models->TB_NAME() => [
					"IRC_STATUS" => 1
				]
			],
			"JOIN" => [
				// $Issue_receipt_details_models->TB_NAME() => [
				// 	"ON" => "IRC_ID",
				// 	"TYPE" => "INNER"
				// ],
				$month_tbl_models->TB_NAME() => [
					"ON" => "MONTH_ID",
					"TYPE" => "INNER",
					"KEY_JOIN" => "IRC_MONTH_ID ",
				],
				$Room->TB_NAME() => [
					"ON" => "RM_ID",
					"TYPE" => "INNER",
				],
				$Users->TB_NAME() => [
					"ON" => "USER_ID",
					"TYPE" => "INNER",
				],
				$Room_type->TB_NAME() => [
					"ON" => "RT_ID",
					"TYPE" => "INNER",
					"JOIN" => $Room->TB_NAME()
				]
			],
			"TYPE_RESULT" => "object",
		]);

		// echo json_encode($data);
		$Load = new MY_Loader();
		$Load->template("issue_receipt", $data);
	}
	public function issue_receipt_view_add($RM_IDX = null)
	{
		$RM_ID = null;
		if (isset($RM_IDX)) {
			$RM_ID = $RM_IDX;
		}
		if (isset($_POST["RM_ID"])) {
			$RM_ID = $_POST["RM_ID"];
		}
		if (isset($_GET["RM_ID"])) {
			$RM_ID = $_GET["RM_ID"];
		}



		$Issue_receipt_models = new Issue_receipt_models();
		$Issue_receipt_details_models = new Issue_receipt_details_models();
		$month_tbl_models = new month_tbl_models();
		$MONTH = $month_tbl_models->QueryResources([
			"WHERE" => [
				$month_tbl_models->TB_NAME() => [
					"MONTH_STATUS" => 1
				]
			],
		]);

		$data = array();
		$data = [
			"RM_ID" => $RM_ID,
			"MONTH_ALL" => $MONTH
		];

		$RES = new Room_models();
		$data['room_all'] = $RES->QueryResources([
			"WHERE" => [
				"room" => [
					"RM_STATUS" => 1,
				]
			],
			"JOIN" => [
				"room_type" => [
					"ON" => "RT_ID",
					"TYPE" => "INNER",
				],
				"users_info" => [
					"ON" => "USER_ID",
					"TYPE" => "INNER",
				]
			],
			"TYPE_RESULT" => "object",
		]);

		// $RES = new Users_info_models();
		// $data['Users_info_all'] = $RES->QueryResources([
		// 	"WHERE" => [
		// 		"users_info" => [
		// 			"USER_STATUS" => 1,
		// 			"USER_RM_ID" => NULL
		// 		]
		// 	],
		// 	"TYPE_RESULT" => "object",
		// ]);


		// array_push($data,"IRC_ID"=>$IRC_ID);
		// if(isset($_POST["
		// echo json_encode($data);
		$Load = new MY_Loader();
		$Load->template("issue_receipt_view_add", $data);
	}
	public function issue_receipt_view_edit($IRC_IDX = null)
	{

		$IRC_ID = null;
		if (isset($IRC_IDX)) {
			$IRC_ID = $IRC_IDX;
		}
		if (isset($_POST["IRC_ID"])) {
			$IRC_ID = $_POST["IRC_ID"];
		}
		if (isset($_GET["IRC_ID"])) {
			$IRC_ID = $_GET["IRC_ID"];
		}


		$data = array();

		$Issue_receipt_models = new Issue_receipt_models();
		$Room = new Room_models();
		$Room_type = new Room_type_models();
		$Users = new Users_info_models();
		$Issue_receipt_details_models = new Issue_receipt_details_models();
		$month_tbl_models = new month_tbl_models();
		$data['Issue_GET'] = $Issue_receipt_models->QueryResources([
			"WHERE" => [
				$Issue_receipt_models->TB_NAME() => [
					"IRC_STATUS" => 1,
					"IRC_ID" => $IRC_ID
				]
			],
			"JOIN" => [
				// $Issue_receipt_details_models->TB_NAME() => [
				// 	"ON" => "IRC_ID",
				// 	"TYPE" => "INNER"
				// ],
				$month_tbl_models->TB_NAME() => [
					"ON" => "MONTH_ID",
					"TYPE" => "INNER",
					"KEY_JOIN" => "IRC_MONTH_ID ",
				],
				$Room->TB_NAME() => [
					"ON" => "RM_ID",
					"TYPE" => "INNER",
				],
				$Users->TB_NAME() => [
					"ON" => "USER_ID",
					"TYPE" => "INNER",
				],
				$Room_type->TB_NAME() => [
					"ON" => "RT_ID",
					"TYPE" => "INNER",
					"JOIN" => $Room->TB_NAME()
				]
			],
			"TYPE_RESULT" => "object",
			"ONE_ROW" => TRUE,
		]);

		$IRC_ID = $data['Issue_GET']->IRC_ID;


		$RES = new Room_models();
		$data['room_all'] = $RES->QueryResources([
			"WHERE" => [
				"room" => [
					"RM_STATUS" => 1,
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


		$month_tbl_models = new month_tbl_models();
		$MONTH = $month_tbl_models->QueryResources([
			"WHERE" => [
				$month_tbl_models->TB_NAME() => [
					"MONTH_STATUS" => 1
				]
			],
		]);

		$data['MONTH_ALL'] = $MONTH;


		$data['receipt_details'] = $Issue_receipt_details_models->QueryResources([
			"WHERE" => [
				$Issue_receipt_details_models->TB_NAME() => [
					"IRC_ID  " => $IRC_ID
				]
			],
			"TYPE_RESULT" => "object",
			"ONE_ROW" => false,
		]);

		$Load = new MY_Loader();
		$Load->template("issue_receipt_view_edit", $data);

		// $data['Issue_receipt_get']->receipt_details = $data['receipt_details'];

		// echo json_encode($data['room_all']);
	}

	public function issue_receipt_view_print($IRC_IDX = null)
	{


		$IRC_ID = null;
		if (isset($IRC_IDX)) {
			$IRC_ID = $IRC_IDX;
		}
		if (isset($_POST["IRC_ID"])) {
			$IRC_ID = $_POST["IRC_ID"];
		}
		if (isset($_GET["IRC_ID"])) {
			$IRC_ID = $_GET["IRC_ID"];
		}


		$data = array();

		$Issue_receipt_models = new Issue_receipt_models();
		$Room = new Room_models();
		$Room_type = new Room_type_models();
		$Users = new Users_info_models();
		$Issue_receipt_details_models = new Issue_receipt_details_models();
		$month_tbl_models = new month_tbl_models();
		$data['Issue_GET'] = $Issue_receipt_models->QueryResources([
			"WHERE" => [
				$Issue_receipt_models->TB_NAME() => [
					"IRC_STATUS" => 1,
					"IRC_ID" => $IRC_ID
				]
			],
			"JOIN" => [
				// $Issue_receipt_details_models->TB_NAME() => [
				// 	"ON" => "IRC_ID",
				// 	"TYPE" => "INNER"
				// ],
				$month_tbl_models->TB_NAME() => [
					"ON" => "MONTH_ID",
					"TYPE" => "INNER",
					"KEY_JOIN" => "IRC_MONTH_ID ",
				],
				$Room->TB_NAME() => [
					"ON" => "RM_ID",
					"TYPE" => "INNER",
				],
				$Users->TB_NAME() => [
					"ON" => "USER_ID",
					"TYPE" => "INNER",
				],
				$Room_type->TB_NAME() => [
					"ON" => "RT_ID",
					"TYPE" => "INNER",
					"JOIN" => $Room->TB_NAME()
				]
			],
			"TYPE_RESULT" => "object",
			"ONE_ROW" => TRUE,
		]);

		$IRC_ID = $data['Issue_GET']->IRC_ID;


		$RES = new Room_models();
		$data['room_all'] = $RES->QueryResources([
			"WHERE" => [
				"room" => [
					"RM_STATUS" => 1,
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


		$month_tbl_models = new month_tbl_models();
		$MONTH = $month_tbl_models->QueryResources([
			"WHERE" => [
				$month_tbl_models->TB_NAME() => [
					"MONTH_STATUS" => 1
				]
			],
		]);

		$data['MONTH_ALL'] = $MONTH;


		$data['receipt_details'] = $Issue_receipt_details_models->QueryResources([
			"WHERE" => [
				$Issue_receipt_details_models->TB_NAME() => [
					"IRC_ID  " => $IRC_ID
				]
			],
			"TYPE_RESULT" => "object",
			"ONE_ROW" => false,
		]);

		$Load = new MY_Loader();
		$Load->view("issue_receipt_view_print", $data);
	}
	public function issue_receipt_insert_add()
	{


		if (isset($_POST["RM_ID"])) {
			$RM_ID = $_POST["RM_ID"];
			$IRC_MONTH_ID = $_POST["IRC_MONTH_ID"];

			$TABELLISTNAME_length = $_POST["TABELLISTNAME_length"];
			$IRD_LISTNAME = $_POST["IRD_LISTNAME"];
			$IRD_PERVIOUS = $_POST["IRD_PERVIOUS"];
			$IRD_THISNUM = $_POST["IRD_THISNUM"];
			$IRD_UNITSUSED = $_POST["IRD_UNITSUSED"];
			$IRD_PERUNITS = $_POST["IRD_PERUNITS"];
			$IRD_UNITSUM = $_POST["IRD_UNITSUM"];

			$USER_ID = $_POST["USER_ID"];
			$IRC_ROOMRENT = $_POST["IRC_ROOMRENT"];
		}




		$Issue_receipt_models = new Issue_receipt_models();
		$Issue_receipt_details_models = new Issue_receipt_details_models();

		$LasID = $Issue_receipt_models->InsertResources([
			"RM_ID" => $RM_ID,
			"USER_ID" => $USER_ID,
			"IRC_TOTAL" => array_sum($IRD_UNITSUM) + $IRC_ROOMRENT,
			"IRC_ROOMRENT" => $IRC_ROOMRENT,
			"IRC_WATER" => $IRD_UNITSUM[0],
			"IRC_ELECTRICCTY" => $IRD_UNITSUM[1],
			"IRC_YEAR" => date("Y"),
			"IRC_MONTH_ID" => $IRC_MONTH_ID,
		]);

		foreach ($IRD_LISTNAME as $key => $item):
			$Issue_receipt_details_models->InsertResources([
				"IRC_ID" => $LasID,
				"IRD_LISTNAME" => $item,
				"IRD_PERVIOUS" => $IRD_PERVIOUS[$key],
				"IRD_THISNUM" => $IRD_THISNUM[$key],
				"IRD_UNITSUSED" => $IRD_UNITSUSED[$key],
				"IRD_PERUNITS" => $IRD_PERUNITS[$key],
				"IRD_UNITSUM" => $IRD_UNITSUM[$key],
			]);
		endforeach;

		if ($LasID) {
			$url = base_url('home/issue_receipt');
			echo "<script>alert('เพิ่มข้อมูลสำเร็จ');location.assign('$url')</script>";
		} else {
			echo "<script>alert('เพิ่มข้อมูลไม่สำเร็จ');history.back(-1)</script>";
		}
	}
	public function issue_receipt_update_edit($IRC_IDX = null)
	{
	}
	public function issue_receipt_update_delete($IRC_IDX = null)
	{
		$IRC_ID = null;
		if (isset($IRC_IDX)) {
			$IRC_ID = $IRC_IDX;
		}
		if (isset($_POST["IRC_ID"])) {
			$IRC_ID = $_POST["IRC_ID"];
		}
		if (isset($_GET["IRC_ID"])) {
			$IRC_ID = $_GET["IRC_ID"];
		}


		$Issue_receipt_models = new Issue_receipt_models();
		$Room = new Room_models();
		$Room_type = new Room_type_models();
		$Users = new Users_info_models();
		$Issue_receipt_details_models = new Issue_receipt_details_models();
		$month_tbl_models = new month_tbl_models();

		$CHECK = $Issue_receipt_models->UpdateResources([
			"WHERE" => [
				"IRC_ID" => $IRC_ID
			],
			"DATA" => [
				"IRC_STATUS_CANCEL" => "1"
			],
		]);

		if (!$CHECK) {
			echo "<script>alert('ยกเลิกการทำรายการชำระเงินไม่สำเร็จ');history.back(-1)</script>";
			return;
		}
		$url = base_url('home/issue_receipt');
		echo "<script>alert('ยกเลิกการทำรายการชำระเงินสำเร็จ');location.assign('$url')</script>";
	}

	public function issue_receipt_update_IRC_PAYMENT_OK($IRC_IDX = null)
	{
		$IRC_ID = null;
		if (isset($IRC_IDX)) {
			$IRC_ID = $IRC_IDX;
		}
		if (isset($_POST["IRC_ID"])) {
			$IRC_ID = $_POST["IRC_ID"];
		}
		if (isset($_GET["IRC_ID"])) {
			$IRC_ID = $_GET["IRC_ID"];
		}


		$Issue_receipt_models = new Issue_receipt_models();
		$Room = new Room_models();
		$Room_type = new Room_type_models();
		$Users = new Users_info_models();
		$Issue_receipt_details_models = new Issue_receipt_details_models();
		$month_tbl_models = new month_tbl_models();

		$CHECK = $Issue_receipt_models->UpdateResources([
			"WHERE" => [
				"IRC_ID" => $IRC_ID
			],
			"DATA" => [
				"IRC_PAYMENTFORMAT" => "2",
				"IRC_PAYMENT_OK" => "1",
			],
		]);

		if (!$CHECK) {
			echo "<script>alert('ทำรายการชำระเงินไม่สำเร็จ');history.back(-1)</script>";
			return;
		}
		$url = base_url('home/issue_receipt');
		echo "<script>alert('ทำรายการชำระเงินสำเร็จ');location.assign('$url')</script>";
	}



	public function issue_receipt_getDataRom($RM_IDx)
	{
		$serach = array();



		$Room = new Room_models();
		$RM_ID = null;

		if (isset($RM_IDx)) {
			$RM_ID = $RM_IDx;
		}
		if (isset($_POST["RM_ID"])) {
			$RM_ID = $_POST["RM_ID"];
		}

		$Room = new Room_models();
		$serach = array();
		if (isset($RM_ID)) {
			$serach = [
				"WHERE" => [
					"room" => [
						"RM_ID" => $RM_ID,
					],
					"issue_receipt" => [
						"IRC_YEAR" => date("Y"),
						"IRC_STATUS_CANCEL !=" => '1'
						// "IRC_PAYMENT_OK" => 
					]
				],
				"JOIN" => [
					"room_type" => [
						"ON" => "RT_ID",
						"TYPE" => "INNER",
					],
					"users_info" => [
						"ON" => "USER_ID",
						"TYPE" => "INNER",
					],
					"issue_receipt" => [
						"ON" => "RM_ID",
						"TYPE" => "INNER",
					]
				],
				"GROUP_BY" => [
					"issue_receipt" => ["IRC_MONTH_ID"]
				],
				"ONE_ROW" => false,
			];

			$MONTHGroup = $Room->QueryResources($serach);
			$temp_month = array();
			foreach ($MONTHGroup as $key => $value) {
				array_push($temp_month, $value->IRC_MONTH_ID);
			}
			$serach = [
				"WHERE" => [
					"room" => [
						"RM_ID" => $RM_ID,
					],
				],
				"JOIN" => [
					"room_type" => [
						"ON" => "RT_ID",
						"TYPE" => "INNER",
					],
					"users_info" => [
						"ON" => "USER_ID",
						"TYPE" => "INNER",
					],
				],

				"ONE_ROW" => true,
			];

			$ROOMDATA = $Room->QueryResources($serach);

			$data = [
				"MONTH_CHECK" => $temp_month,
				"DATA" => $ROOMDATA,
			];
			echo json_encode($data);
			return;
		} else {
			$serach = array();
		}
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
					"USER_STATUS" => 1,
					"USER_RM_ID" => NULL
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
		$LastID = $make_contract->InsertResources($this->input->post());


		$make_contract->UpdateResources([
			"WHERE" => [
				"MCO_ID" => $LastID
			],
			"DATA" => [
				"MONTH_ID " => date('m'),
			],
		]);




		$ROOM = new Room_models();
		$ROOM->UpdateResources([
			"WHERE" => [
				"RM_ID" => $RM_ID
			],
			"DATA" => [
				"RM_USE" => "S",
				"USER_ID" => $USER_ID,
				"RM_MOVEINDATE" => $_POST["MCO_MOVEIN_DATE"],
				"RM_MCO_ID" => $LastID
			],
		]);

		$USER = new Users_info_models();
		$USER->UpdateResources([
			"WHERE" => [
				"USER_ID" => $USER_ID
			],
			"DATA" => [
				"USER_RM_ID" => $RM_ID,
				"USER_MCO_ID" => $LastID,
			],
		]);

		if ($LastID) {
			$url = base_url('home/make_contract');
			echo "<script>alert('ทำสัญญาสำเร็จ');location.assign('$url')</script>";
		} else {
			echo "<script>alert('เพิ่มข้อมูลไม่สำเร็จ');history.back(-1)</script>";
		}
	}
	public function make_contract_update_edit($MCO_IDX)
	{


		$user_info = new Make_contract_models();

		$MCO_ID = null;
		if (isset($MCO_IDX)) {
			$MCO_ID = $MCO_IDX;
		}
		if (isset($_POST["MCO_ID"])) {
			$MCO_ID = $_POST["MCO_ID"];
		}


		$ROOM = new Room_models();
		$ROOM->UpdateResources([
			"WHERE" => [
				"RM_MCO_ID" => $MCO_ID
			],
			"DATA" => [
				"RM_USE" => 0,
				"USER_ID" => NULL,
				"RM_MOVEINDATE" => NULL,
				"RM_MCO_ID" => NULL
			],
		]);

		$USER = new Users_info_models();
		$USER->UpdateResources([
			"WHERE" => [
				"USER_MCO_ID" => $MCO_ID
			],
			"DATA" => [
				"USER_RM_ID" => NULL,
				"USER_MCO_ID" => NULL,
			],
		]);



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
				
				"MCO_ID" => $MCO_ID
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
		$MCO_ID = null;

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
				"MCO_ID" => $MCO_ID
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
		$Issue_receipt_models = new Issue_receipt_models();
		$Room = new Room_models();
		$Room_type = new Room_type_models();
		$Users = new Users_info_models();
		$Issue_receipt_details_models = new Issue_receipt_details_models();
		$month_tbl_models = new month_tbl_models();
		$Make_contract_models = new Make_contract_models();
		$Account_models = new Account_models();


		$check = $Make_contract->UpdateResources([
			"WHERE" => [
				"MCO_ID" => $MCO_ID
			],
			"DATA" => [
				"MCO_MOVEIN_PAY" => 1,
			],
		]);
		$Room->UpdateResources(
			[
				"WHERE" => [
					"RM_MCO_ID" => $MCO_ID
				],
				"DATA" => [
					"RM_USE" => 0,
				],
			]
		);

		if ($check) {
			$url = base_url('home/make_contract');
			echo "<script>alert('จ่ายสำเร็จ');location.assign('$url')</script>";
		} else {
			echo "<script>alert('จ่ายไม่สำเร็จ');history.back(-1)</script>";
		}
	}





	public function payment_report($MONTH_IDX = null)
	{

		$Issue_receipt_models = new Issue_receipt_models();
		$Room = new Room_models();
		$Room_type = new Room_type_models();
		$Users = new Users_info_models();
		$Issue_receipt_details_models = new Issue_receipt_details_models();
		$month_tbl_models = new month_tbl_models();


		$MONTH_ID = null;
		if (isset($MONTH_IDX)) {
			$MONTH_ID = $MONTH_IDX;
		}
		if (isset($_POST["MONTH_ID"])) {
			$MONTH_ID = $_POST["MONTH_ID"];
		}
		if (isset($_GET["MONTH_ID"])) {
			$MONTH_ID = $_GET["MONTH_ID"];
		}

		$WHERE = [
			$Issue_receipt_models->TB_NAME() => [
				"IRC_STATUS" => 1,
				"IRC_YEAR" => date("Y"),
				"IRC_STATUS_CANCEL" => 0
			],

		];


		if ($MONTH_ID != null) {

			if ($MONTH_ID != "-1") {
				$WHERE[$Issue_receipt_models->TB_NAME()]['IRC_MONTH_ID'] = $MONTH_ID;
			}
		}



		$data['Issue_GET'] = $Issue_receipt_models->QueryResources([
			"WHERE" => $WHERE,
			"JOIN" => [
				$Issue_receipt_details_models->TB_NAME() => [
					"ON" => "IRC_ID",
					"TYPE" => "INNER"
				],
				$month_tbl_models->TB_NAME() => [
					"ON" => "MONTH_ID",
					"TYPE" => "INNER",
					"KEY_JOIN" => "IRC_MONTH_ID",
				],
				$Room->TB_NAME() => [
					"ON" => "RM_ID",
					"TYPE" => "INNER",
				],
				$Users->TB_NAME() => [
					"ON" => "USER_ID",
					"TYPE" => "INNER",
				],
				$Room_type->TB_NAME() => [
					"ON" => "RT_ID",
					"TYPE" => "INNER",
					"JOIN" => $Room->TB_NAME()
				]
			],
			"ORDER_BY" => [
				$Issue_receipt_models->TB_NAME() => [
					"IRC_ID" => "ASC"
				]
				// $Users->TB_NAME() => [
				// 	"USER_NAME" => "ASC"
				// ],
				// $month_tbl_models->TB_NAME() => [
				// 	"MONTH_ID" => "ASC"
				// ],
			],
			"TYPE_RESULT" => "object",
			"ONE_ROW" => false,
		]);



		$month_tbl_models = new month_tbl_models();
		$MONTH = $month_tbl_models->QueryResources([
			"WHERE" => [
				$month_tbl_models->TB_NAME() => [
					"MONTH_STATUS" => 1
				]
			],
		]);

		$data['MONTH_ALL'] = $MONTH;
		$data['MONTH_ID'] = $MONTH_ID;
		// echo json_encode($data);
		$Load = new MY_Loader();
		$Load->template("payment_report", $data);
	}
}
