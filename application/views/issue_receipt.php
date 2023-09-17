<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>รายการบิล</h3>
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
						<h2>ข้อมูลประวัติออกบิท</h2>
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
									<th>บิลที่</th>
									<th>ชื่อลูกค้า</th>
									<th>เบอร์มือถือ</th>
									<th>ห้อง</th>
									<th>ประเภทห้อง</th>
									<th>ค่าห้อง</th>
									<th>สถานะ</th>
									<th>วันที่ออกบิล</th>
									<th>บิลของปี</th>
									<th>รอบบิล</th>
									<th>รวมจ่าย</th>
									<th><a class="btn btn-sm btn-outline-success" href="<?= base_url('home/issue_receipt_view_add') ?>">ออกบิล</a></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($Issue_receipt_all as $key => $ii) : ?>
									<tr>
										<th scope="row"><?= $key + 1 ?></th>
										<td><?= sprintf("IRC-%010d", $ii->IRC_ID) ?> </td>
										<td><?= $ii->USER_NAME ?> </td>
										<td><?= $ii->USER_PHONE ?> </td>
										<td><?= $ii->RM_NAME . '/' . $ii->RM_NUMBER ?> </td>
										<td><?= $ii->RT_NAME ?> </td>
										<td><?= $ii->IRC_ROOMRENT ?> </td>
										<td>
											<?php
											$msge = '';
											if ($ii->IRC_STATUS_CANCEL == 1) :
												$msge .= "ถูกยกเลิกบิล - ";
											else :
												$msge .= "";
											endif;

											if ($ii->IRC_PAYMENT_OK == 1) {
												if ($ii->IRC_PAYMENTFORMAT == 1) {
													$msge .= "(จ่ายแล้ว - เงินโอน)";
												} else {
													$msge .= "(จ่ายแล้ว - เงินสด)";
												}
											} else {
												$url = base_url('home/issue_receipt_update_IRC_PAYMENT_OK/' . $ii->IRC_ID);
												$msge .= "<a class=\"text-danger\" href='javascript:if(confirm(\"ยื่นยันกาจ่าย?\")){location.assign(\"$url\")};' >ยังไม่ชำระ</a>";
											}
											echo $msge;

											?>
										</td>
										<td><?= DateThai($ii->IRC_STAMP)  ?> </td>
										<td><?= (int)$ii->IRC_YEAR + 543 ?> </td>
										<td><?= $ii->MONTH_NAME  ?> </td>
										<td><?= $ii->IRC_TOTAL  ?> </td>

										<td>
											<a class="btn btn-sm btn-primary" href="<?= base_url('home/issue_receipt_view_edit/' . $ii->IRC_ID) ?>">รายละเอียด</a>
											<a class="btn btn-sm btn-outline-info" target="_blank" href="<?= base_url('home/issue_receipt_view_print/' . $ii->IRC_ID) ?>">พิมพ์</a>
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
