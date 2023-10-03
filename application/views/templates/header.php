<!DOCTYPE html>
<html lang="en">




<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta id="base_url" name="base_url" content="<?= base_url() ?>">

	<title>หน้า |
		<?= APP_NAME ?>
	</title>
	<link
		href="https://cdn.datatables.net/v/bs4/jq-3.7.0/dt-1.13.6/b-2.4.2/b-html5-2.4.2/r-2.5.0/sc-2.2.0/sl-1.7.0/datatables.min.css"
		rel="stylesheet">

	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
	<!-- <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script> -->

	<link href="<?= base_url('public/') ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url('public/') ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?= base_url('public/') ?>vendors/nprogress/nprogress.css" rel="stylesheet">
	<link href="<?= base_url('public/') ?>vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css"
		rel="stylesheet" />
	<link href="<?= base_url('public/') ?>build/css/custom.min.css" rel="stylesheet">



	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
	<script
		src="https://cdn.datatables.net/v/bs4/jq-3.7.0/dt-1.13.6/b-2.4.2/b-html5-2.4.2/r-2.5.0/sc-2.2.0/sl-1.7.0/datatables.min.js"></script>


	<script src="<?= base_url('public/') ?>vendors/jquery/dist/jquery.min.js"></script>
	<script src="<?= base_url('public/') ?>vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url('public/') ?>vendors/fastclick/lib/fastclick.js"></script>
	<script src="<?= base_url('public/') ?>vendors/nprogress/nprogress.js"></script>
	<script
		src="<?= base_url('public/') ?>vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="<?= base_url('public/') ?>vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
	<script src="<?= base_url('public/') ?>vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
	<script src="<?= base_url('public/') ?>vendors/google-code-prettify/src/prettify.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> -->

	<script src="<?= base_url('public/') ?>vendors/validator/multifield.js"></script>
	<script src="<?= base_url('public/') ?>vendors/validator/validator.js"></script>

	<script src="<?= base_url('public/') ?>build/js/all.js"></script>

	<script>
		$(document).ready(function () {
			// $.fn.dataTable.ext.errMode = 'none';
			$('select').select2();

			new DataTable('table', {
				// dom: 'Blfrtip',
				"lengthMenu": [
					[100, -1, 50, 25], [100, "All", 50, 25]
				],
				"language": {
					"sProcessing": " กำลังดำเนินการ... ",
					"sLengthMenu": " แสดง _MENU_ แถว",
					"sZeroRecords": " ไม่พบข้อมูล ",
					"sInfo": " แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว ",
					"sInfoEmpty": " แสดง 0 ถึง 0 จาก 0 แถว",
					"sInfoFiltered": "( กรองข้อมูล _MAX_ ทุกแถว )",
					"sInfoPostFix": "",
					"sSearch": " ค้นหา :",
					"sUrl": "",
					"oPaginate": {
						"sFirst": " เริ่มต้น ",
						"sPrevious": " ก่อนหน้า ",
						"sNext": " ถัดไป ",
						"sLast": " สุดท้าย "
					}
				}
			});
		});
	</script>



</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col menu_fixed">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="<?= base_url("/home") ?>" class="site_title"><i class="fa fa-paw"></i> <span>
								<?= APP_NAME ?>
							</span></a>
					</div>

					<div class="clearfix"></div>

					<div class="profile clearfix">
						<div class="profile_pic">
							<img src="<?= base_url('public/') ?>images/<?= $account->ACC_IMGE ?>" alt="..."
								class="img-circle profile_img">
						</div>
						<div class="profile_info">
							<span>ยินดีตอนรับ,</span>
							<h2>
								<?= $account->ACC_NAME ?>
							</h2>
						</div>
					</div>
					<br />
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<h3>ทั่วไป</h3>
							<ul class="nav side-menu">

								<li><a><i class="fa fa-dashboard"></i> Dashboard <span
											class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?= base_url('home') ?>">Dashboard</a></li>
										<li><a href="<?= base_url('home/payment_report') ?>">รายงานการชำระเงิน</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-dashboard"></i> จัดการบิล <span
											class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?= base_url('home/issue_receipt') ?>">รายการบิล</a></li>
										<li><a href="<?= base_url('home/issue_receipt_view_add') ?>">ออกบิล</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-file"></i> จัดการสัญญา <span
											class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?= base_url('home/make_contract_view_add') ?>">ทำสัญญา</a></li>
										<li><a href="<?= base_url('home/make_contract') ?>">ประวัติทำสัญญา</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-users"></i> จัดการลูกค้า <span
											class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?= base_url('home/user_info') ?>">ข้อมูลลูกค้า</a></li>
										<li><a href="<?= base_url('home/user_info_view_add') ?>">เพิ่มข้อมูลลูกค้า</a>
										</li>
									</ul>
								</li>

								<li><a><i class="fa fa-desktop"></i>จัดการห้อง <span
											class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?= base_url('home/room') ?>">ข้อมูลห้อง</a></li>
										<li><a href="<?= base_url('home/room_view_add') ?>">เพิ่มห้อง</a></li>
										<li><a href="<?= base_url('home/room_type') ?>">ข้อมูลประเภทห้อง</a></li>
										<li><a href="<?= base_url('home/room_type_view_add') ?>">เพิ่มประเภทห้อง</a>
										</li>
									</ul>
								</li>

								<li><a><i class="fa fa-desktop"></i>จัดการผู้ดูแล <span
											class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="<?= base_url('home/admin') ?>">ข้อมูลผู้ดูแล</a></li>
										<li><a href="<?= base_url('home/admin_view_add') ?>">เพิ่มผู้ดูแล</a></li>
									</ul>
								</li>
							</ul>
						</div>


					</div>
					<!-- /sidebar menu -->

					<!-- /menu footer buttons -->
					<div class="sidebar-footer hidden-small ">
						<!-- <a data-toggle="tooltip" class="pull-right" data-placement="top" title="Logout" href="<?= base_url("Auth/logout") ?>">
							<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
						</a> -->
					</div>
					<!-- /menu footer buttons -->
				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">
				<div class="nav_menu">
					<div class="nav toggle">
						<a id="menu_toggle"><i class="fa fa-bars"></i></a>
					</div>
					<nav class="nav navbar-nav">
						<ul class=" navbar-right">
							<li class="">
								<a class="btn btn-sm btn-secondary" href="<?= base_url("Auth/logout") ?>"><i
										class="fa fa-sign-out pull-right"></i>
									Logout</a>
							</li>


						</ul>
					</nav>
				</div>
			</div>
			<!-- /top navigation -->
