<div class="right_col" role="">
	<div class="">
		<div class="row mb-3">
			<div class="page-title">
				<div class="title_left">
					<h1>แดชบอร์ด</h1>
				</div>
			</div>
			<hr>
		</div>


		<div class="row">
			<div class="tile_count w-100">
				<div class="col-md-2 col-sm-4  tile_stats_count">
					<span class="count_top"> <i class="fa fa-user"></i> ลูกค้าทั้งหมด</span>
					<div class="count"><?= $จำนวนลูกค้า ?> คน</div>

				</div>
				<div class="col-md-2 col-sm-4  tile_stats_count">
					<span class="count_top"><i class="fa fa-clock-o"></i> ห้องทั้งหมด</span>
					<div class="count"><?= $จำนวนห้อง ?> ห้อง</div>

				</div>

				<div class="col-md-2 col-sm-4  tile_stats_count">
					<span class="count_top"> <i class="fa fa-clock-o"></i> ห้องว่าง</span>
					<div class="count"><?= $จำนวนห้องว่าง ?> ห้อง</div>
				</div>
				<div class="col-md-2 col-sm-4  tile_stats_count">
					<span class="count_top"> <i class="fa fa-clock-o"></i> ห้องว่างไม่ว่าง</span>
					<div class="count"><?= $จำนวนห้องไม่ว่าง ?> ห้อง</div>
				</div>
				<!-- <div class="col-md-2 col-sm-4  tile_stats_count">
					<span class="count_top"> <i class="fa fa-clock-o"></i> ห้องถูกจอง</span>
					<div class="count"><?= $จำนวนห้องถูกจอง ?> ห้อง</div>
				</div> -->
				<div class="col-md-2 col-sm-4  tile_stats_count">
					<span class="count_top"> <i class="fa fa-clock-o"></i> บิลค้างชำระ</span>
					<div class="count"><?= $จำนวนบิลค้างชำระ ?> บิล</div>
				</div>
			</div>
		</div>

		<div class="x_panel">
			<div class="x_title">
				<h2>แสดงข้อมูลพื้นฐาน</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
			</div>
			<div class="row">
				<div class="col-12">
					<div class="row">
						<div class="col-sm-6 col-md-4">
							<h3 class="">รายการจ่าย</h3>
							<div>
								<canvas id="myChart"></canvas>
							</div>
							<script>
								const ctx = document.getElementById('myChart');
								new Chart(ctx, {
									type: 'doughnut',
									data: {
										labels: ['ชำระแล้ว', 'จำนวนบิลค้างชำระ'],
										datasets: [{
											label: 'ยอด',
											data: [<?= $จำนวนบิลชำระ ?>, <?= $จำนวนบิลค้างชำระ ?>, ],
											borderWidth: 1
										}]
									},
									options: {
										title: {
											display: true,
											text: "สรุปรายการจ่าย"
										},
										scales: {
											y: {
												beginAtZero: true
											},
											x: {
												beginAtZero: true
											}
										}
									}
								});
							</script>
						</div>
						<div class="col-sm-6 col-md-4" >
							<h3 class="">สถานะห้องว่าง</h3>

							<div>
								<canvas id="myChartx"></canvas>
							</div>

							<script>
								const ctxx = document.getElementById('myChartx');
								const chx = new Chart(ctxx, {
									type: 'doughnut',
									data: {
										labels: ['ห้องว่าง', 'ห้องไม่ว่าง'],
										// labels: ['ห้องว่าง', 'ห้องไม่ว่าง', "ห้องถูกจอง"],
										datasets: [{
											label: 'จำนวน',
											data: [<?= $จำนวนห้องว่าง ?>, <?= $จำนวนห้องไม่ว่าง ?>],
											// data: [<?= $จำนวนห้องว่าง ?>, <?= $จำนวนห้องไม่ว่าง ?>, <?= $จำนวนห้องถูกจอง ?>],
											borderWidth: 1
										}]
									},
									options: {
										title: {
											display: true,
											text: "สรุปรายการจ่าย"
										},
										scales: {
											y: {
												beginAtZero: false
											},
											x: {
												beginAtZero: false
											}
										}
									}
								});
							</script>
						</div>
						<div class="col-sm-6 col-md-4" style="display: none;">
							<h3 class="">สถานะการเข้าอยู่</h3>

							<div>
								<canvas id="myChartxx"></canvas>
							</div>

							<script>
								const ctxxx = document.getElementById('myChartxx');
								const chxx = new Chart(ctxxx, {
									type: 'doughnut',
									data: {
										labels: ['ย้ายเข้า', 'รอย้ายเข้า'],
										datasets: [{
											label: 'จำนวน',
											data: [<?= $ย้ายเข้า ?>, <?= $รอย้ายเข้า ?>],
											borderWidth: 1
										}]
									},
									options: {
										title: {
											display: true,
											text: "สรุปรายการจ่าย"
										},
										scales: {
											y: {
												beginAtZero: false
											},
											x: {
												beginAtZero: false
											}
										}
									}
								});
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
