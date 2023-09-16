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
			height: 297mm;
			width: 210mm;
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
			font-weight: bold;
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
		}

		@media print {
			.page {
				margin: 0;
				overflow: hidden;
			}
		}
	</style>
</head>

<body style="--bleeding: 0.5cm;--margin: 0cm;">

	<?php for ($i = 0; $i < 2; $i++) : ?>

		<div class="page">
			<!-- Your content here -->
			<h2 class="text-center">สัญญาเช่าห้องพักอาศัย (<?= $i == 0 ? "ต้นฉบับ" : "สำเนา" ?>)</h2>
			<table style="width: 100%;margin-bottom: 10px;">
				<thead>
					<tr>
						<th style="width: 70%;">
						</th>
						<td class="text-left">
							<p class="text-bold">ทำที่ <?= DORMITORY_NAME ?></p>
							<p><?= DORMITORY_ADDESS ?></p>
						</td>
					</tr>
				</thead>
			</table>

			<p style="text-indent: 4rem;">
				สัญญานี้ทำขึ้นที่ <span class="text-bold"> <?= DORMITORY_NAME ?></span> เมื่อ <span class="text-bold"><?= DateThaiFull(date("Y-m-d")) ?></span>
				ซึ่งตั้งอยู่เลข <span class="text-bold"><?= DORMITORY_ADDESS ?></span>
				ซึ่งต่อไปในสัญญานี้จะเรียนว่า “ผู้ให้เช่า” ฝ่ายหนึ่งกับ นาย/นางสาว/นาง <?= $LIST_DATA->USER_NAME ?> บัตรประจำตัวประชาชนเลขที่ <?= $LIST_DATA->USER_CITIZEN ?> เบอร์โทรศัพท์ <?= $LIST_DATA->USER_PHONE ?>
				ซึ่งต่อไปในสัญญาฉบับนี้เรียกว่า “ผู้ให้เช่าอีกฝ่ายหนึ่ง” ทั้งสองฝ่ายตกลงกันมีข้อความดังต่อไปนี้
			</p>

			<br>

			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๑. </span>
				ผู้เช่าตกลงเช่าและผู้ให้เช่าตกลงให้เช่าห้อง <?= $LIST_DATA->RM_NAME . '/' . $LIST_DATA->RM_NUMBER ?> ประเภทห้อง <?= $LIST_DATA->RT_NAME ?> ที่อยู่ <?= DORMITORY_ADDESS ?>
				ในวันที่ทำสัญญาฉบับนี้เป็นต้นไป ในราคาค่าเช่าเดือนละ <?= $LIST_DATA->RT_ROOMRENT ?> บาท ( <span class="text-bold"></span> <?= ConvertNume($LIST_DATA->RT_ROOMRENT) ?>)

			</p>

			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๒. </span>
				ผู้เช่าตกลงจ่ายค่าเช่าล่วงหน้าในวันทำสัญญาเป็นเงินจำนวน <?= $LIST_DATA->RT_RESERVE ?> บาท (<span class="text-bold"><?= ConvertNume($LIST_DATA->RT_RESERVE) ?></span> )
				ผู้เช่าตกลงจ่ายค่าเช่าก่อนวันเข้าอยู่เป็นเงินจำนวน <?= $LIST_DATA->RT_MOVEIN ?> บาท ( <span class="text-bold"> <?= ConvertNume($LIST_DATA->RT_MOVEIN) ?></span>)
				โดยจะรวมเป็นเงินประกันห้องจำนวน <?= $LIST_DATA->RT_DEPOSIT ?> บาท ( <span class="text-bold"><?= ConvertNume($LIST_DATA->RT_DEPOSIT) ?></span> ) (<?= $LIST_DATA->RT_CONDITIONS ?> )
			</p>


			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๓. </span>
				ผู้เช่าตกลงชำระค่าเช่าให้แก่ผู้ให้เช่า ทุกๆ ก่อนวันที่ 5 ของเดือน เริ่มตั้งแต่เดือนที่ตกลงทำสัญญาเช่าฉบับนี้เป็นต้นไป หากครบกำหนดดังกล่าวแล้ว ผู้เช่ามีสิทธิจะเช่าต่อไปในอัตราค่าเช่าเดิมก็ได้ โดยแจ้งล่วงหน้าให้ผู้ให้เช่าทราบ
				ไม่น้อยกว่า 10 วัน

			</p>

			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๔. </span>
				ผู้ให้เช่าตกลงให้ผู้เช่าใช้สอยทรัพย์สินทุกชนิดที่อยู่ในห้องเช่าและตามรายการทรัพย์สินที่แนบท้ายสัญญานี้ โดยผู้เช่าจะดูแลรักษาเสมือนหนึ่งว่าเป็นทรัพย์สินของตน หากชำรุดบกพร่องใดๆผู้เช่าจะต้องซ่อมแซมให้คงเดิมอยู่เสมอ
			</p>

			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๕. </span>
				ผู้เช่าตกลงที่จะดูแลรักษาห้องที่เช่าให้คงสภาพดีดังเดิมทุกประการ และยินยอมให้ผู้ให้เช่า หรือผู้ที่ได้รับมอบหมายเข้ามาในห้องที่เช่าได้ตลอดเวลา เพื่อตรวจดูสภาพห้องที่เช่าได้ทุกเวลา โดยผู้เช่าให้สัญญาว่าจะไม่นำสิ่งผิดกฎหมายเข้ามาในห้องที่เช่า หากผู้ให้เช่าพบหรือบุคคลอื่นพบสิ่งผิดกฎหมาย ผู้เช่ายอมให้ผู้ให้เช่าบอกเลิกสัญญาเช่าได้ทันที
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold"> ข้อ ๖. </span>
				การเช่าตามข้อ ๑ ให้รวมถึงอุปกรณ์ หรือทรัพย์สินต่างๆ ที่อยู่ในห้องเช่าและ รายการทรัพย์สินตามรายการแนบท้ายหนังสือสัญญาเช่านี้
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold"> ข้อ ๗. </span>
				ผู้เช่าตกลงที่จะเช่าเพื่อเป็นที่พักอาศัยเท่านั้น และให้สัญญาว่าจะไม่นำห้องที่เช่าออกให้ผู้อื่นเช่าช่วง เว้นแต่จะได้รับความยินยอมเป็นหนังสือจากผู้ให้เช่า
			</p>

			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๘. </span>
				หากผู้เช่าผิดสัญญาข้อหนึ่งข้อใด ยอมให้ผู้ให้เช่าบอกเลิกสัญญาเช่าได้ทันที และยอมชดใช้ค่าเสียหาย ค่าขาดประโยชน์ตามความเหมาะสมและตามสมควร เท่าที่ผู้ให้เช่าจะเสียหาย
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๙. </span>
				หากสัญญาเช่าสิ้นสุดลง โดยไม่มีการต่อสัญญาเช่า หรือผู้ให้เช่าบอกเลิกสัญญาเช่าตามข้อ ๘ ดังกล่าว ผู้เช่ายอมขนย้ายทรัพย์สินและบริวารออกไปจากห้องที่เช่าทันทีโดยค่าใช้จ่ายของผู้เช่าเอง
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๑๐. </span>
				ผู้เช่าสัญญาว่าจะปฏิบัติตามระเบียบข้อบังคับของอาคารโดยถือเป็นส่วนหนึ่งแห่งสัญญาเช่านี้ด้วย หากผู้เช่าไม่ปฏิบัติตาม หรือละเมิดข้อบังคับดังกล่าว ผู้เช่ายินดีให้ถือว่าสัญญาเช่านี้เป็นอันยกเลิกต่อกัน และยินยอมมอบการครอบครองห้องเช่าคืนแก่ผู้ให้เช่าทันที
			</p>
			<p style="text-indent: 4rem;">
				คู่สัญญาทั้งสองฝ่ายได้อ่านข้อความดังกล่าวแล้ว ตกลงที่จะทำสัญญาฉบับนี้ จึงลงลายมือชื่อไว้เป็นสำคัญ
			</p>

			<table style="width: 100%;">
				<thead>
					<tr>
						<td style="width: 30%;">
							<p class="text-bold text-center">ลงชื่อ............................................ผู้เช่า</p>
							<p class="text-center">( <?= $LIST_DATA->USER_NAME ?> )</p>
						</td>
						<td style="width: 50%;">
							<p class="text-bold text-center">ลงชื่อ............................................ผู้ให้เช่า</p>
							<p class="text-center">( <?= DORMITORY_NAME ?> )</p>
						</td>
					</tr>
					<tr>
						<th style="width: 70%;">
						</th>
						<td class="text-left">
							<p class="text-bold text-center">ลงชื่อ............................................พยาน</p>
							<p class="text-center">(..........................................................)</p>
						</td>
					</tr>
					<tr>
						<th style="width: 70%;">
						</th>
						<td class="text-left">
							<p class="text-bold text-center">ลงชื่อ............................................พยาน</p>
							<p class="text-center">(..........................................................)</p>
						</td>
					</tr>
				</thead>
			</table>

		</div>

	<?php endfor;  ?>
</body>
<script>
	window.print();

	(function() {

		var beforePrint = function() {

		};

		var afterPrint = function() {
			window.close();
		};

		if (window.matchMedia) {
			var mediaQueryList = window.matchMedia('print');
			mediaQueryList.addListener(function(mql) {
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
