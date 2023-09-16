<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>รายละเอียดประวัติทำสัญญา</h3>
			</div>

			<div class="title_right">
				<div class="col-md-5 col-sm-5   form-group pull-right top_search">

				</div>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12  ">
				<div class="x_panel">
					<div class="x_title">
						<h2>ข้อมูลประวัติทำสัญญา</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
							<li><a class="close-link"><i class="fa fa-close"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table class="table" style=" zoom: 80%; ">
							<thead>
								<tr>
									<th>#</th>
									<th>เลขที่สัญญา</th>
									<th>ชื่อลูกค้า</th>
									<th>เบอร์มือถือ</th>
									<th>ห้อง</th>
									<th>ประเภทห้อง</th>
									<th>ค่าห้อง</th>
									<th>ค่าสัญญา</th>
									<th>ค่าย้ายเข้า</th>
									<th>เงินประกัน</th>
									<th>สถานะ</th>
									<th>วันที่จอง</th>
									<th>วันที่ย้ายเข้า</th>
									<th>รายละเอียด</th>
									<th><a class="btn btn-sm btn-outline-success" href="<?= base_url('home/make_contract_view_add') ?>">เพิ่ม</a></th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($Make_all as $key => $ii) :
									$urlli = base_url('home/make_contract_update_RESERVE_PAY/' . $ii->MCO_ID);
									$urllix = base_url('home/make_contract_update_MOVEIN_PAY/' . $ii->MCO_ID);
								?>
								<tr>
									<th scope="row"><?= $key + 1 ?></th>
									<td><?= sprintf("MC-%04d", $ii->MCO_ID) ?> </td>
									<td><?= $ii->MCO_USER_NAME ?> </td>
									<td><?= $ii->MCO_USER_PHONE ?> </td>
									<td><?= $ii->MCO_RM_NAME . '/' . $ii->MCO_RM_NUMBER ?> </td>
									<td><?= $ii->MCO_ROOM_TYPE_NAME ?> </td>
									<td><?= $ii->MCO_ROOMRENT ?> </td>

									<td> <?= $ii->MCO_RESERVE ?> <?= $ii->MCO_RESERVE_PAY == 1 ? "(จ่ายแล้ว)" : "<a href='{$urlli}'>(ยังไม่จ่าย)</a>"  ?></td>
									<td><?= $ii->MCO_MOVEIN ?> <?= $ii->MCO_MOVEIN_PAY == 1 ? "(จ่ายแล้ว)" : "<a href='{$urllix}'>(ยังไม่จ่าย)</a>"  ?></td>
									<td> <?= $ii->MCO_DEPOSIT ?></td>
									<td> <?= $ii->MCO_STATUS_CANCEL == 0 ? "<span class='badge  badge-primary'>ปกติ</span>" : "<span class='badge badge-danger'>ถูกยกเลิก</span>" ?> </td>
									<td><?= $ii->MCO_DATE == null ? "-" : DateThai($ii->MCO_DATE)   ?> </td>
									<td><?= $ii->MCO_MOVEIN_DATE == null ? "-" : DateThai($ii->MCO_MOVEIN_DATE)   ?> </td>
									<td><?= $ii->MCO_DETAILS ?> </td>
									<td>
										<a class="btn btn-sm btn-warning" href="<?= base_url('home/make_contract_view_edit/' . $ii->MCO_ID) ?>">รายละเอียด</a>
										<a class="btn btn-sm btn-outline-primary" target="_blank" href="<?= base_url('home/make_contract_view_print/' . $ii->MCO_ID) ?>">พิมพ์</a>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>

						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
