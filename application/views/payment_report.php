<script>
	function printDiv(divName) {
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;

		document.body.innerHTML = printContents;

		window.print();

		document.body.innerHTML = originalContents;

		location.reload();
	}
</script>
<!-- <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script> -->
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<div class="right_col" role="">
	<div class="">
		<div class="row mb-5">
			<div class="page-title">
				<div class="title_left">
					<h1>รายงานการชำระเงิน</h1>
				</div>
			</div>
		</div>





		<div class="row">
			<div class="col-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>รายงานการชำระเงิน</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="pull-left">
								<button class="btn btn-md btn-primary"
									onclick="printDiv('section-to-print') ">พิมพ์รายงาน PDF</button>
								<button class="btn btn-md btn-primary"
									onclick="ExportToExcel('table-id','xlsx')">ออกรายงาน Excel</button>

							</div>
							<div class="pull-right">
								<form id="form-selsect" action="<?= base_url("home/payment_report/") ?>" method="get">
									<select name="MONTH_ID" class="form-control" onchange="$('#form-selsect').submit()">
										<option <?= $MONTH_ID == '-1' ? "selected" : "" ?> value="-1">---เลือกเดือน---
										</option>
										<?php foreach ($MONTH_ALL as $key => $item): ?>
											<option <?= $MONTH_ID == $item->MONTH_ID ? "selected" : "" ?>
												value="<?= $item->MONTH_ID ?>">---
												<?= $item->MONTH_NAME ?>---
											</option>
										<?php endforeach; ?>

									</select>
								</form>
							</div>
						</div>
					</div>

					<div id="section-to-print">
						<h4 id="h-1z" style="display: none;">รายงานการชำระเงิน</h4>

						<table id="table-id" class="table mt-5">
							<thead>
								<tr>
									<th style="width: 8%;"></th>
									<th>รายการ</th>
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

								</tr>
							</thead>

							<tbody>
								<?php

								$temp_IRC_ID = null;
								$icount = 1;
								$sum_to = 0;
								foreach ($Issue_GET as $key => $ii): ?>


									<?php
									if ($temp_IRC_ID != $ii->IRC_ID):
										$temp_IRC_ID = $ii->IRC_ID;
										$icount = 1;
										$sum_to += $ii->IRC_TOTAL;

										?>

										<tr class="table-secondary">
											<td>
												<?= sprintf("IRC-%010d", $ii->IRC_ID) ?>
											</td>
											<td></td>
											<td>
												<?= $ii->USER_NAME ?>
											</td>
											<td>
												<?= $ii->USER_PHONE ?>
											</td>
											<td>
												<?= $ii->RM_NAME . '/' . $ii->RM_NUMBER ?>
											</td>
											<td>
												<?= $ii->RT_NAME ?>
											</td>
											<td>
												<?= $ii->IRC_ROOMRENT ?>
											</td>
											<td>
												<?php
												$msge = '';
												if ($ii->IRC_STATUS_CANCEL == 1):
													$msge .= "ถูกยกเลิกบิล - ";
												else:
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
													$msge .= "<p class=\"text-danger\"  >ยังไม่ชำระ</p>";
												}
												echo $msge;

												?>
											</td>
											<td>
												<?= DateThai($ii->IRC_STAMP) ?>
											</td>
											<td>
												<?= (int) $ii->IRC_YEAR + 543 ?>
											</td>
											<td>
												<?= $ii->MONTH_NAME ?>
											</td>
											<td class="text-right">
												<?= $ii->IRC_TOTAL ?>
											</td>
										</tr>
									<?php endif; ?>

									<?php if ($temp_IRC_ID == $ii->IRC_ID): ?>

									<?php endif; ?>

									<!-- <tr>
										<td></td>

										<td scope="row">
											<?= $icount++ ?>.
											<?= $ii->IRD_LISTNAME ?>
										</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td class="text-right">
											<?= $ii->IRD_UNITSUM ?>
										</td>
									</tr> -->
									<?php
								endforeach; ?>
							</tbody>
							<tfoot>
								<tr>
									<th class="text-right" colspan="12">รวมยอด :
										<?= $sum_to ?> (
										<?= ConvertNume($sum_to) ?>)
									</th>
								</tr>
							</tfoot>
						</table>

						<style>
							@media print {
								/* body {
									visibility: hidden;
								} */

								#section-to-print {
									/* visibility: visible;
									position: absolute; */
									left: 0;
									top: 0;

								}

								#table-id {
									zoom: 60%;
								}

								#h-1z {
									display: block;
								}

								@page {
									size: A4 landscape;
								}


							}
						</style>
					</div>

				</div>

			</div>
		</div>
	</div>
</div>
<script>
	// $(document).ready(function() {

	// });
	// var doc = new jsPDF();
	// var specialElementHandlers = {
	// 	'#editor': function(element, renderer) {
	// 		return true;
	// 	}
	// };

	// $('#btn-pdf').click(function() {
	// 	doc.fromHTML($('#section-to-print').html(), 15, 15, {
	// 		'width': 170,
	// 		'elementHandlers': specialElementHandlers
	// 	});
	// 	doc.save('sample-file.pdf');
	// });
</script>
