<meta id="meta-data-x" content='<?= json_encode($จำนวนทำสัญญา) ?>'>
<meta id="ยอดทั้งหมดบิล" content='<?= json_encode($ยอดทั้งหมดบิล) ?>'>

<?php
// echo json_encode($จำนวนทำสัญญา);
// exit

?>
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
					<div class="count">
						<?= $จำนวนลูกค้า ?> คน
					</div>

				</div>
				<div class="col-md-2 col-sm-4  tile_stats_count">
					<span class="count_top"><i class="fa fa-clock-o"></i> ห้องทั้งหมด</span>
					<div class="count">
						<?= $จำนวนห้อง ?> ห้อง
					</div>

				</div>

				<div class="col-md-2 col-sm-4  tile_stats_count">
					<span class="count_top"> <i class="fa fa-clock-o"></i> ห้องว่าง</span>
					<div class="count">
						<?= $จำนวนห้องว่าง ?> ห้อง
					</div>
				</div>
				<div class="col-md-2 col-sm-4  tile_stats_count">
					<span class="count_top"> <i class="fa fa-clock-o"></i> ห้องว่างไม่ว่าง</span>
					<div class="count">
						<?= $จำนวนห้องไม่ว่าง ?> ห้อง
					</div>
				</div>
				<!-- <div class="col-md-2 col-sm-4  tile_stats_count">
					<span class="count_top"> <i class="fa fa-clock-o"></i> ห้องถูกจอง</span>
					<div class="count"><?= $จำนวนห้องถูกจอง ?> ห้อง</div>
				</div> -->
				<div class="col-md-2 col-sm-4  tile_stats_count">
					<span class="count_top"> <i class="fa fa-clock-o"></i> บิลค้างชำระ</span>
					<div class="count">
						<?= $จำนวนบิลค้างชำระ ?> บิล
					</div>
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
						<div class="col-sm-6 col-md-3">
							<h3 class="">รายการจ่าย</h3>
							<div>
								<canvas id="myChart"></canvas>
							</div>
							<script>
								const ctx = document.getElementById('myChart');
								new Chart(ctx, {
									type: 'doughnut',
									data: {
										labels: ['ชำระแล้ว', 'ค้างชำระ'],
										datasets: [{
											label: 'ยอด',
											data: [<?= $จำนวนบิลชำระ ?>, <?= $จำนวนบิลค้างชำระ ?>,],
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
						<div class="col-sm-6 col-md-3">
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
						<div class="col-sm-6 col-md-3" style="display: none;">
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

						<div class="col-sm-12 col-md-6" style="display: block ;">
							<h3 class="">ยอดเงินเรียกเก็บ</h3>

							<div>
								<canvas id="myChartxxd"></canvas>
							</div>

							<script>
								const myChartxxd = document.getElementById('myChartxxd');
								const chxxd = new Chart(myChartxxd, {
									type: 'bar',
									data: {
										labels: ["มกราคม", "กุมภาพันธ์", 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
										datasets: [{
											label: 'จำนวน',
											data: JSON.parse(document.getElementById("ยอดทั้งหมดบิล").content),
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

						<div class="col-sm-12 col-md-12" style="display: block ;">
							<h3 class="">จำนวนทำสัญญารายเดือน</h3>

							<div>
								<canvas id="myChartxxx"></canvas>
							</div>

							<script>
								const myChartxxx = document.getElementById('myChartxxx');
								const meta_data = JSON.parse(document.getElementById("meta-data-x").content)
								console.log(meta_data);
								const myChartxxxx = new Chart(myChartxxx, {
									type: 'bar',
									data: {
										labels: ["มกราคม", "กุมภาพันธ์", 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
										datasets: [{
											label: 'จำนวน',
											data: meta_data,
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

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
