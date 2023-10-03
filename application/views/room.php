<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>รายละเอียดห้องพัก</h3>
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
						<h2>ข้อมูลห้องพัก</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>

							<li><a class="close-link"><i class="fa fa-close"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>เลขห้อง</th>
									<!-- <th>เลขที่ห้อง</th> -->
									<th>ประเภทห้อง</th>
									<th>ค่าห้อง</th>
									<th>ขนาดห้อง</th>
									<th>ค่าน้ำ/ไฟ</th>

									<th>รายละเอียด</th>

									<th>สถานะ</th>
									<th>ชื่อลูกค้า</th>
									<th>เข้าอยู่</th>

									<th><a class="btn btn-sm btn-outline-success" href="<?= base_url('home/room_view_add') ?>">เพิ่ม</a></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($room_all as $key => $ii) : ?>
								<tr>
									<th scope="row"><?= $key + 1 ?></th>
									<td><?= $ii->RM_NAME ?> </td>
									<!-- <td><?= $ii->RM_NUMBER ?> </td> -->
									<td><?= $ii->RT_NAME ?> </td>
									<td><?= $ii->RT_ROOMRENT ?> </td>
									<td><?= $ii->RT_ROOMSIZE ?> </td>
									<td><?= $ii->RT_WATER . '/' . $ii->RT_ELECTRICCTY ?> </td>
									<td><?= $ii->RM_DETAILS ?> </td>
									<td><?= $ii->RM_USE == '0' ? "<span class='badge badge-danger'>ไม่ว่าง</span>" : "<span class='badge  badge-primary'>ห้องว่าง</span>"?> </td>
									<td><?= $ii->USER_NAME == null ? "-" : $ii->USER_NAME  ?> </td>
									<td><?= $ii->RM_MOVEINDATE == null ? "-" : DateThai($ii->RM_MOVEINDATE)   ?> </td>
									<td>
										<?php if ($ii->USER_NAME != null && $ii->RM_USE != "S") :  ?>
											<a class="btn btn-sm btn-primary" href="<?= base_url('home/issue_receipt_view_add/' . $ii->RM_ID) ?>">ออกบิล</a>
										<?php endif;  ?>
										<a class="btn btn-sm btn-outline-secondary" href="<?= base_url('home/room_view_edit/' . $ii->RM_ID) ?>">แก้ไข</a>
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
