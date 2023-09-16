<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>อัพเดทสัญญา</h3>
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
						<h2>อัพเดทสัญญา</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>

							<li><a class="close-link"><i class="fa fa-close"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form class="" action="<?= base_url('home/make_contract_update_edit/'. $MCO->MCO_ID) ?>" method="post" novalidate="">


							<input type="hidden" name="MCO_USER_PHONE" required value='<?= $MCO->MCO_USER_PHONE ?>'  >
							<input type="hidden" name="MCO_USER_NAME" required value='<?= $MCO->MCO_USER_PHONE ?>' >
							<input type="hidden" name="MCO_DEPOSIT" required value='<?= $MCO->MCO_USER_PHONE ?>' >
							<input type="hidden" name="MCO_RESERVE" required value='<?= $MCO->MCO_USER_PHONE ?>' >
							<input type="hidden" name="MCO_MOVEIN" required value='<?= $MCO->MCO_USER_PHONE ?>' > 
							<input type="hidden" name="MCO_ROOM_TYPE_NAME" required value='<?= $MCO->MCO_USER_PHONE ?>' >
							<input type="hidden" name="MCO_RM_NAME" required value='<?= $MCO->MCO_USER_PHONE ?>' >
							<input type="hidden" name="MCO_RM_NUMBER" required value='<?= $MCO->MCO_USER_PHONE ?>' >





							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3   label-align">วันที่ทำสัญญา<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input disabled class="form-control" type="date" name="MCO_DATE" required="required" value="<?= $MCO->MCO_DATE ?>" >
								</div>
							</div>


							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">ลูกค้า<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<select disabled  id="USER_ID" name="USER_ID" class="form-control" required="required" onchange="getUSER(this)">
										<option   value="">--เลือก--</option>
										<?php foreach ($Users_info_all as $key => $item) : ?>
											<option <?= $MCO->USER_ID == $item->USER_ID ? "selected" : ""  ?>  value="<?= $item->USER_ID ?>"><?= $item->USER_NAME  ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>


							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3   label-align">วันที่ย้ายเข้า<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input disabled class="form-control" type="date" name="MCO_MOVEIN_DATE" required="required" value="<?= $MCO->MCO_MOVEIN_DATE ?>" >
								</div>
							</div>




							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3   label-align">ชื่อลูกค้า<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input disabled class="form-control" type="text" name="USER_NAME" data-validate-minmax="1,99999999" required="required">
								</div>
							</div>
							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3   label-align">เบอร์มือถือ<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input disabled class="form-control" type="text" name="USER_PHONE" data-validate-minmax="1,99999999" required="required">
								</div>
							</div>



							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">เข้าพักห้อง<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<select disabled id="RM_ID" name="RM_ID" class="form-control" required="required" onchange="checkRoom(this.value)">
										<option value="">--เลือก--</option>
										<?php foreach ($room_all as $key => $item) : ?>
											<option <?= $MCO->RM_ID == $item->RM_ID ? "selected" : ""  ?> value="<?= $item->RM_ID ?>"><?= $item->RM_NAME.'/'.$item->RM_NUMBER ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>


							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3   label-align">ประเภทห้อง<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input disabled class="form-control" type="text" name="RT_NAME">
								</div>
							</div>



							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3   label-align">ค่าน้ำ<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input disabled class="form-control" type="number" name="RT_WATER" data-validate-minmax="1,99999999" data-validate-linked="number" required="required">
								</div>
							</div>


							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">ค่าไฟ <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input disabled class="form-control" type="number" name="RT_ELECTRICCTY" data-validate-minmax="1,99999999" required="required">
								</div>
							</div>
							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">ขนาดห้อง ตร.ม<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input disabled class="form-control" type="text" name="RT_ROOMSIZE" required="required">
								</div>
							</div>
							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">ค่าเช่ารายเดือน<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input disabled class="form-control" name="RT_ROOMRENT" data-validate-minmax="1,99999999" type="number">
								</div>
							</div>
							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">ค่าทำสัญญาจอง<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input disabled class="form-control" name="RT_RESERVE" data-validate-minmax="1,99999999" required="required" type="number">
								</div>
							</div>
							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">ทำสัญญาย้ายเข้า<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input disabled class="form-control" type="number" name="RT_MOVEIN" data-validate-minmax="1,99999999" data-validate-linked="number" required="required">
								</div>
							</div>
							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">รวมเงินประกัน<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input disabled class="form-control" type="number" name="RT_DEPOSIT" data-validate-minmax="1,99999999" data-validate-linked="number" required="required">
								</div>
							</div>
							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">รายเอียดห้อง</label>
								<div class="col-md-6 col-sm-6">
									<textarea disabled name="RT_DETAILS" class="form-control"   rows="2"></textarea>

								</div>
							</div>
							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">เงือนไขคืนเงินประกัน</label>
								<div class="col-md-6 col-sm-6">
									<textarea disabled name="RT_CONDITIONS" class="form-control"   rows="2"></textarea>

								</div>
							</div>

							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">รายเอียดทำสัญญา</label>
								<div class="col-md-6 col-sm-6">
									<textarea  name="MCO_DETAILS" class="form-control"   rows="5"><?= $MCO->MCO_DETAILS ?></textarea>
								</div>
							</div>
							<div class="ln_solid">
								<div class="form-group">
									<div class="col-md-6 offset-md-3">
										<button class="btn btn-dark btn-sm" type="button" onclick="history.back(-1)">ย้อนกลับ</button>
										<button class="btn btn-danger btn-sm" type="button" onclick=" if(confirm('ยื่นยันการลบ?')){location.assign('<?= base_url('home/make_contract_update_delete/' . $MCO->MCO_ID) ?>')};">ยกเลิกสัญญา</button>
										<button type="submit" class="btn btn-sm btn-primary">แก้ไข</button>
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
		getUSER(<?=$MCO->USER_ID?>);
		checkRoom(<?=$MCO->RM_ID?>);
	});
</script>
