<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>แก้ไขประเภทห้อง</h3>
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
						<h2>แก้ไขข้อมูล</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>

							<li><a class="close-link"><i class="fa fa-close"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form class="" action="<?= base_url('home/room_type_update_edit/' . $RTYPE->RT_ID) ?>" method="post" novalidate="">

							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">ชื่อประเภทห้อง<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input class="form-control" data-validate-minmax="1,99999999" name="RT_NAME" required="required" value="<?= $RTYPE->RT_NAME ?>">
								</div>
							</div>
							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">ค่าเช่ารายเดือน<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input class="form-control" name="RT_ROOMRENT" data-validate-minmax="1,99999999" type="number" value="<?= $RTYPE->RT_ROOMRENT ?>">
								</div>
							</div>
							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">ค่าทำสัญญาจอง<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input class="form-control" name="RT_RESERVE" data-validate-minmax="1,99999999" required="required" type="number" value="<?= $RTYPE->RT_RESERVE ?>">
								</div>
							</div>
							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">ทำสัญญาย้ายเข้า<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input class="form-control" type="number" name="RT_MOVEIN" data-validate-minmax="1,99999999" data-validate-linked="number" required="required" value="<?= $RTYPE->RT_MOVEIN ?>">
								</div>
							</div>
							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">เงินประกันทั้งหมด<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input class="form-control" type="number" name="RT_DEPOSIT" data-validate-minmax="1,99999999" data-validate-linked="number" required="required" value="<?= $RTYPE->RT_DEPOSIT ?>">
								</div>
							</div>
							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">ค่าน้ำ<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input class="form-control" type="number" name="RT_WATER" data-validate-minmax="1,99999999" data-validate-linked="number" required="required" value="<?= $RTYPE->RT_WATER ?>">
								</div>
							</div>


							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">ค่าไฟ <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input class="form-control" type="number" name="RT_ELECTRICCTY" data-validate-minmax="1,99999999" required="required" value="<?= $RTYPE->RT_ELECTRICCTY ?>">
								</div>
							</div>
							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">ขนาดห้อง ตร.ม<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input class="form-control" type="text" name="RT_ROOMSIZE" required="required" value="<?= $RTYPE->RT_ROOMSIZE ?>">
								</div>
							</div>
							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">รายละเอียดขนาดห้อง</label>
								<div class="col-md-6 col-sm-6">
									<input class="form-control" type="text" name="RT_ROOMSIZE_D" value="<?= $RTYPE->RT_ROOMSIZE_D ?>">
								</div>
							</div>

							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">เงือนไขการขอคืนเงิน</label>
								<div class="col-md-6 col-sm-6">
									<textarea name="RT_CONDITIONS" class="form-control" id="" cols="30" rows="5"><?= $RTYPE->RT_CONDITIONS ?></textarea>

								</div>
							</div>

							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">รายเอียด</label>
								<div class="col-md-6 col-sm-6">
									<textarea name="RT_DETAILS" class="form-control" id="" cols="30" rows="5"><?= $RTYPE->RT_DETAILS ?></textarea>

								</div>
							</div>
							<div class="ln_solid">
								<div class="form-group">
									<div class="col-md-6 offset-md-3">
										<button class="btn btn-dark btn-sm" type="button" onclick="history.back(-1)">ย้อนกลับ</button>
										<button class="btn btn-danger btn-sm" type="button" onclick=" if(confirm('ยืนยันการลบ?')){location.assign('<?= base_url('home/room_type_update_delete/' . $RTYPE->RT_ID) ?>')};">ลบข้อมูล</button>
										<button type="submit" class="btn btn-sm btn-primary">แก้ไขข้อมูล</button>
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




<!-- Javascript functions	-->
<script>
	function hideshow() {
		var password = document.getElementById("password1");
		var slash = document.getElementById("slash");
		var eye = document.getElementById("eye");

		if (password.type === 'password') {
			password.type = "text";
			slash.style.display = "block";
			eye.style.display = "none";
		} else {
			password.type = "password";
			slash.style.display = "none";
			eye.style.display = "block";
		}

	}
</script>

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
</script>
