<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>ออกบิล</h3>
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
						<h2>เพิ่มข้อมูล</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>

							<li><a class="close-link"><i class="fa fa-close"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form action="<?= base_url('home/issue_receipt_insert_add') ?>" method="post" novalidate="">
							<input type="hidden" name="USER_ID">
							<input type="hidden" name="IRC_ROOMRENT">

							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">ออกบิลของห้อง<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<select name="RM_ID" class="form-control" required="required" onchange="getIssue_receiptDataRoomFull(this.value)">
										<option  value="">--เลือก--</option>
										<?php foreach ($room_all as $key => $item) : ?>
											<option <?= $RM_ID == $item->RM_ID ? "selected" :"" ?>  value="<?= $item->RM_ID ?>"><?= $item->RM_NAME ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">รอบบิลเดือน<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<select id="IRC_MONTH_ID" name="IRC_MONTH_ID" class="form-control" required="required" onchange="getUSER(this.value)">
										<option value="">--เลือก--</option>
										<?php foreach ($MONTH_ALL as $key => $item) : ?>
											<option value="<?= $item->MONTH_ID  ?>"><?= $item->MONTH_NAME  ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="row p-5">

								<div class="col-3">
									<h6>ชื่อ-นามสกุล : <span id='user_name'></span></h6>
								</div>
								<div class="col-6">
									<h6>รหัสประจำตัวประชาชน : <span id='user_idcard'></span></h6>
								</div>
								<div class="col-3">
									<h6 class=" text-end " >เบอร์มือถือ : <span id='user_phone'></span></h6>
								</div>

							</div>




							<table id="TABELLISTNAME" class="table" style=" width: 100%; ">
								<thead>
									<tr>
										<th style="width: 1%;" scope="col">#</th>
										<th scope="col">รายการ</th>
										<th scope="col">เลขครั้งก่อน</th>
										<th scope="col">เลขครั้งนี้</th>
										<th scope="col">จำนวนหนวยที่ใช้</th>
										<th scope="col">หน่วยละ/บาท</th>
										<th scope="col">ราคารวม</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th>#</th>
										<td>
											<input value="ค่าน้ำปะปา" class="form-control" type="text" name="IRD_LISTNAME[]" data-validate-minmax="1,99999999" required="required" readonly>
										</td>
										<td>
											<input id="IRD_PERVIOUS-WATER" onkeyup="sumValue()" onchange="sumValue()" value="0" min="0" class="form-control " type="number" name="IRD_PERVIOUS[]" data-validate-minmax="1,99999999" data-validate-linked="number" required="required">
										</td>
										<td>
											<input id="IRD_THISNUM-WATER" onkeyup="sumValue()" onchange="sumValue()" value="0" min="0" class="form-control" type="number" name="IRD_THISNUM[]" data-validate-minmax="1,99999999" data-validate-linked="number" required="required">
										</td>
										<td>
											<input id="IRD_UNITSUSED-WATER" onkeyup="sumValue()" onchange="sumValue()" value="0" min="0" class="form-control" type="number" name="IRD_UNITSUSED[]" data-validate-minmax="1,99999999" data-validate-linked="number" required="required" readonly>
										</td>
										<td>
											<input id="RT_WATER" onkeyup="sumValue()" onchange="sumValue()" value="0" min="0" class="form-control" type="number" name="IRD_PERUNITS[]" data-validate-minmax="1,99999999" data-validate-linked="number" required="required" readonly>
										</td>
										<td>
											<input id="IRD_UNITSUM-WATER" onkeyup="sumValue()" onchange="sumValue()" value="0" min="0" class="form-control" type="number" name="IRD_UNITSUM[]" data-validate-minmax="1,99999999" data-validate-linked="number" required="required" readonly>
										</td>
									</tr>
									<tr>
										<th>#</th>
										<td>
											<input value="ค่าไฟฟ้า" class="form-control" type="text" name="IRD_LISTNAME[]" data-validate-minmax="1,99999999" required="required" readonly>
										</td>
										<td>
											<input id="IRD_PERVIOUS-ELE" onkeyup="sumValue()" onchange="sumValue()" value="0" min="0" class="form-control" type="number" name="IRD_PERVIOUS[]" data-validate-minmax="1,99999999" data-validate-linked="number" required="required">
										</td>
										<td>
											<input id="IRD_THISNUM-ELE" onkeyup="sumValue()" onchange="sumValue()" value="0" min="0" class="form-control" type="number" name="IRD_THISNUM[]" data-validate-minmax="1,99999999" data-validate-linked="number" required="required">
										</td>
										<td>
											<input id="IRD_UNITSUSED-ELE" onkeyup="sumValue()" onchange="sumValue()" value="0" min="0" class="form-control" type="number" name="IRD_UNITSUSED[]" data-validate-minmax="1,99999999" data-validate-linked="number" required="required" readonly>
										</td>
										<td>
											<input id="RT_ELECTRICCTY" onkeyup="sumValue()" onchange="sumValue()" value="0" min="0" class="form-control" type="number" name="IRD_PERUNITS[]" data-validate-minmax="1,99999999" data-validate-linked="number" required="required" readonly>
										</td>
										<td>
											<input id="IRD_UNITSUM-ELE" onkeyup="sumValue()" onchange="sumValue()" value="0" min="0" class="form-control" type="number" name="IRD_UNITSUM[]" data-validate-minmax="1,99999999" data-validate-linked="number" required="required" readonly>
										</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="7" scope="col">
											<button class="btn btn-sm btn-outline-primary" onclick="addListOT()" type="button">เพิ่มค่าอื่น ๆ</button>
										</th>
									</tr>
								</tfoot>
							</table>


							<div class="ln_solid">
								<div class="form-group">
									<div class="col-md-6 offset-md-3">
										<button class="btn btn-dark btn-sm" type="button" onclick="history.back(-1)">ย้อนกลับ</button>
										<button type="reset" class="btn btn-sm btn-success">Reset</button>
										<button type="submit" class="btn btn-sm btn-primary">เพิ่มข้อมูล</button>
									</div>
								</div>
							</div>


						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script>
	// initialize a validator instance from the "FormValidator" constructor.
	// A "<form>" element is optionally passed as an argument, but is not a must
	var validator = new FormValidator({
		"events": ['blur', 'input', 'change']
	}, document.forms[0]);
	// on form "submit" event
	document.forms[0].onsubmit = function(e) {
		var submit = true,
			validatorResult = validator.checkAll(this);
		console.log(validatorResult);
		return !!validatorResult.valid;
	};
	// on form "reset" event
	document.forms[0].onreset = function(e) {
		validator.reset();
	};
	// stuff related ONLY for this demo page:
	$('.toggleValidationTooltips').change(function() {
		validator.settings.alerts = !this.checked;
		if (this.checked)
			$('form .alert').remove();
	}).prop('checked', false);
	$(document).ready(function() {
		// checkTypeRoom($("#RT_ID"));
		<?= isset($RM_ID) ? "getIssue_receiptDataRoomFull('$RM_ID')" :"" ?>
		
	});
</script>
