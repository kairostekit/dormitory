<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>แก้ไขห้อง</h3>
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
						<form class="" action="<?= base_url('home/room_update_edit/'.$room->RM_ID) ?>" method="post" novalidate="">

							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">เลขห้อง<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input type="text" class="form-control" data-validate-minmax="1,99999999" name="RM_NAME" required="required" value="<?= $room->RM_NAME ?>" >
								</div>
							</div>
							<div style=" display: none; "  class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">เลขห้อง<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<input disabled type="text" class="form-control" data-validate-minmax="1,99999999" name="RM_NUMBER" value=""">
								</div>
							</div>

							<script>
								// const checkTypeRoom  = (element) => {
							</script>

							<div class="field item form-group">
								<label class="col-form-label col-md-3 col-sm-3  label-align">ประเภทห้อง<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6">
									<select name="RT_ID" class="form-control" required="required" onchange="checkTypeRoom(this)">
										<option  value="">--เลือก--</option>
										<?php foreach ($room_type_all as $key => $item) : ?>
											<option <?= $room->RT_ID ==  $item->RT_ID ? "selected" : ""?> value="<?= $item->RT_ID ?>"><?= $item->RT_NAME ?></option>
										<?php endforeach; ?>
									</select>
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
								<label class="col-form-label col-md-3 col-sm-3  label-align">รายเอียด</label>
								<div class="col-md-6 col-sm-6">
									<textarea  name="RM_DETAILS" class="form-control"  cols="30" rows="5"><?= $room->RM_DETAILS ?></textarea>

								</div>
							</div>
							<div class="ln_solid">
								<div class="form-group">
									<div class="col-md-6 offset-md-3">
										<button class="btn btn-dark btn-sm" type="button" onclick="history.back(-1)">ย้อนกลับ</button>
										<button class="btn btn-danger btn-sm" type="button" onclick=" if(confirm('ยืนยันการลบ?')){location.assign('<?= base_url('home/room_update_delete/' . $room->RM_ID) ?>')};">ลบข้อมูล</button>
										<button style="display: <?=( $room->RM_MCO_ID != NULL && $room->RM_USE != "S") ? "block" : "none" ?>;" class="btn btn-warning btn-sm" type="button" onclick=" if(confirm('ยืนยันการย้ายออก?')){location.assign('<?= base_url('home/room_update_move/' . $room->RM_ID) ?>')};">ย้ายออก</button>
										<button style="display: <?=( $room->RM_MCO_ID != NULL && $room->RM_USE == "S") ? "block" : "none" ?>;" class="btn btn-warning btn-sm" type="button" onclick=" if(confirm('ยืนยันการย้ายเข้า?')){location.assign('<?= base_url('home/room_update_moveIN/' . $room->RM_ID) ?>')};">เข้าอยู่</button>
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
		checkTypeRoom(<?=$room->RT_ID ?>);
	});
</script>
