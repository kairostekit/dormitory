<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>A4 Paper</title>
	<link rel="stylesheet" href="./A4.css">


	<style>
		@font-face {
			font-family: THSarabun;
			src: url(<?= base_url('public/font/th_sarabun/') ?>THSarabun.ttf)
		}

		:root {
			--bleeding: 0.5cm;
			--margin: 1cm;
		}

		* {
			font-family: 'THSarabun', Tahoma, Geneva, Verdana, sans-serif;
		}

		@page {
			size: A4;
			margin: 0;
		}

		* {
			box-sizing: border-box;
		}

		p {
			font-size: 18px;
			margin: 5px;
		}

		body {
			margin: 0 auto;
			padding: 0;
			background: rgb(204, 204, 204);
			display: flex;
			flex-direction: column;
		}

		.page {
			display: inline-block;
			position: relative;
			height: 148mm;
			width: 210;
			font-size: 12pt;
			margin: 2em auto;
			padding: calc(var(--bleeding) + var(--margin));
			box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
			background: white;
		}

		.pageA5 {
			display: inline-block;
			position: relative;
			height: 210mm;
			width: 148mm;
			font-size: 12pt;
			margin: 2em auto;
			padding: calc(var(--bleeding) + var(--margin));
			box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
			background: white;
		}

		.text-center {
			text-align: center;
		}


		.text-left {
			text-align: left;
		}

		.text-right {
			text-align: right;
		}

		.text-justify {
			text-align: justify;
		}

		.text-bold {
			/* font-weight: bold; */
		}

		@media screen {
			.page::after {
				position: absolute;
				content: '';
				top: 0;
				left: 0;
				width: calc(100% - var(--bleeding) * 2);
				height: calc(100% - var(--bleeding) * 2);
				margin: var(--bleeding);
				outline: thin dashed black;
				pointer-events: none;
				z-index: 9999;
			}

			.pageA5::after {
				position: absolute;
				content: '';
				top: 0;
				left: 0;
				width: calc(100% - var(--bleeding) * 2);
				height: calc(100% - var(--bleeding) * 2);
				margin: var(--bleeding);
				outline: thin dashed black;
				pointer-events: none;
				z-index: 9999;
			}
		}

		@media print {
			.page {
				margin: 0;
				overflow: hidden;
			}

			.pageA5 {
				margin: 0;
				overflow: hidden;
			}
		}
	</style>
</head>

<body style="--bleeding: 0.5cm;--margin: 0cm;">


	<div class="page">
		<h2 class="text-center">ใบแจ้งหนี้/ใบเสร็จรับเงิน</h2>
		<h2 class="text-center">รอบบิลของเดือน
			<?= $Issue_GET->MONTH_NAME ?> ปี
			<?= $Issue_GET->IRC_YEAR + 543 ?>
		</h2>
		<table style="width: 100%;margin-bottom: 10px;">
			<thead>
				<tr>
					<th style="width: 50%;">
					</th>
					<td class="text-left">
						<p class="">
							<?= DORMITORY_NAME ?>
							<?= DORMITORY_ADDESS ?>
						</p>
						<p class="text-bold">ออกเมื่อ
							<?= DateThaiFull(date("Y-m-d")) ?>
						</p>
					</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="100" class="text-left">
						<!-- <p class="text-bold">เรียนคุณ <?= $Issue_GET->USER_NAME ?></p> -->
						<p class="text-bold">ห้อง
							<?= $Issue_GET->RM_NAME ?> ประเภทห้อง
							<?= $Issue_GET->RT_NAME ?>
						</p>
					</td>

				</tr>
				<!-- <tr>
					<td colspan="100">
						<h2 style="margin: 0;" class="text-bold">ยอดจ่ายทั้งหมด : <?= $Issue_GET->IRC_TOTAL ?> (<?= ConvertNume($Issue_GET->IRC_TOTAL) ?>) </h2>
					</td>
				</tr> -->
			</tbody>
		</table>

		<table id="TABELLISTNAME" class="table" style=" width: 100%; ">
			<thead>
				<tr>
					<th style="width: 1%;" scope="col">#</th>
					<td class="text-bold" scope="col">รายการ</td>
					<td class="text-bold" scope="col">เลขครั้งก่อน</td>
					<td class="text-bold" scope="col">เลขครั้งนี้</td>
					<td class="text-bold" scope="col">จำนวนหนวยที่ใช้</td>
					<td class="text-bold" scope="col">หน่วยละ/บาท</td>
					<td class="text-bold" scope="col">ราคารวม</td>
				</tr>
			</thead>
			<thead>
				<tr>
					<th>1</th>
					<td>
						ค่าห้อง
					</td>
					<td colspan="4" class="text-left">
						<?= $Issue_GET->IRC_ROOMRENT ?>
					</td>
					<td colspan="4">
						<?= $Issue_GET->IRC_ROOMRENT ?>
					</td>
				</tr>
			</thead>

			<tbody>

				<?php foreach ($receipt_details as $ik => $ii): ?>
					<tr>
						<th>
							<?= $ik + 2 ?>
						</th>
						<td>
							<?= $ii->IRD_LISTNAME ?>
						</td>
						<td>
							<?= $ii->IRD_PERVIOUS ?>
						</td>
						<td>
							<?= $ii->IRD_PERVIOUS ?>
						</td>
						<td>
							<?= $ii->IRD_PERVIOUS ?>
						</td>
						<td>
							<?= $ii->IRD_PERUNITS ?>
						</td>
						<td>
							<?= $ii->IRD_UNITSUM ?>
						</td>
					</tr>
				<?php endforeach; ?>

			</tbody>

			<tfoot>
				<tr>
					<th class="text-right" colspan="7">
						<h2 style="margin: 0;" class="text-bold">ยอดจ่ายทั้งหมด :
							<?= $Issue_GET->IRC_TOTAL ?> (
							<?= ConvertNume($Issue_GET->IRC_TOTAL) ?>)
						</h2>

						<!-- <h3>ยอดรวม
							<?= $Issue_GET->IRC_TOTAL ?>(
							<?= ConvertNume($Issue_GET->IRC_TOTAL) ?>)</h5> -->
					</th>
				</tr>
			</tfoot>

		</table>
		<table style="width: 100%;margin-bottom: 10px;">

			<tbody>
				<tr>
					<td colspan="100" class="text-left">
						<p class="text-bold">
							กำหนดชำระภายในวันที่ 1-5 ของทุกเดือน(เงินสด) /// ชำระเกินวันที่กำหนด ปรับวันละ 100 บาท ///
						</p>
					</td>

				</tr>
			</tbody>
		</table>

	</div>



</body>
<script>
	window.print();

	(function () {

		var beforePrint = function () {

		};

		var afterPrint = function () {
			// window.close();
		};

		if (window.matchMedia) {
			var mediaQueryList = window.matchMedia('print');
			mediaQueryList.addListener(function (mql) {
				if (mql.matches) {
					beforePrint();
				} else {
					afterPrint();
				}
			});
		}

		window.onbeforeprint = beforePrint;
		window.onafterprint = afterPrint;

	}());
</script>

</html>
