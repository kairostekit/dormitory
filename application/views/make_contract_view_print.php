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

	<?php for ($i = 0; $i < 1; $i++): ?>

		<div class="page">
			<!-- Your content here -->
			<h2 class="text-center">สัญญาเช่าห้องพักอาศัย (
				<?= $i == 0 ? "ต้นฉบับ" : "สำเนา" ?>)
			</h2>
			<table style="width: 100%;margin-bottom: 10px;">
				<thead>
					<tr>
						<th style="width: 70%;">
						</th>
						<td class="text-left">
							<p class="text-bold-1">ทำที่
								<?= DORMITORY_NAME ?>
							</p>
							<p>
								<?= DORMITORY_ADDESS ?>
							</p>
						</td>
					</tr>
				</thead>
			</table>

			<p style="text-indent: 4rem;">
				สัญญานี้ทำขึ้นที่ <span class="text-bold-1">
					<?= DORMITORY_NAME ?>
				</span> เมื่อ <span class="text-bold-1">
					<?= DateThaiFull(date("Y-m-d")) ?>
				</span>
				ซึ่งตั้งอยู่เลข <span class="text-bold-1">
					<?= DORMITORY_ADDESS ?>
				</span>
				ซึ่งต่อไปในสัญญานี้จะเรียนว่า “ผู้ให้เช่า” ฝ่ายหนึ่งกับ นาย/นางสาว/นาง
				<?= $LIST_DATA->USER_NAME ?> บัตรประจำตัวประชาชนเลขที่
				<?= $LIST_DATA->USER_CITIZEN ?> เบอร์โทรศัพท์
				<?= $LIST_DATA->USER_PHONE ?>
				ซึ่งต่อไปในสัญญาฉบับนี้เรียกว่า “ผู้ให้เช่าอีกฝ่ายหนึ่ง” ทั้งสองฝ่ายตกลงกันมีข้อความดังต่อไปนี้
			</p>

			<br>

			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๑. </span>
				ผู้เช่าตกลงเช่าและผู้ให้เช่าตกลงให้เช่าห้อง
				<?= $LIST_DATA->RM_NAME ?> ประเภทห้อง
				<?= $LIST_DATA->RT_NAME ?> ที่อยู่
				<?= DORMITORY_ADDESS ?>
				ในวันที่ทำสัญญาฉบับนี้เป็นต้นไป ในราคาค่าเช่าเดือนละ
				<?= $LIST_DATA->RT_ROOMRENT ?> บาท ( <span class="text-bold-1"></span>
				<?= ConvertNume($LIST_DATA->RT_ROOMRENT) ?>)

			</p>

			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๒. </span>
				ผู้เช่าตกลงจ่ายค่าเช่าล่วงหน้าในวันทำสัญญาเป็นเงินจำนวน
				<?= $LIST_DATA->RT_RESERVE ?> บาท (<span class="text-bold-1">
					<?= ConvertNume($LIST_DATA->RT_RESERVE) ?>
				</span> )
				ผู้เช่าตกลงจ่ายค่าเช่าก่อนวันเข้าอยู่เป็นเงินจำนวน
				<?= $LIST_DATA->RT_MOVEIN ?> บาท ( <span class="text-bold-1">
					<?= ConvertNume($LIST_DATA->RT_MOVEIN) ?>
				</span>)
				โดยจะรวมเป็นเงินประกันห้องจำนวน
				<?= $LIST_DATA->RT_DEPOSIT ?> บาท ( <span class="text-bold-1">
					<?= ConvertNume($LIST_DATA->RT_DEPOSIT) ?>
				</span> ) (
				<?= $LIST_DATA->RT_CONDITIONS ?> )
			</p>


			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๓. </span>
				ผู้เช่าตกลงชำระค่าเช่าให้แก่ผู้ให้เช่า ทุกๆ ก่อนวันที่ 5 ของเดือน
				เริ่มตั้งแต่เดือนที่ตกลงทำสัญญาเช่าฉบับนี้เป็นต้นไป หากครบกำหนดดังกล่าวแล้ว
				ผู้เช่ามีสิทธิจะเช่าต่อไปในอัตราค่าเช่าเดิมก็ได้ โดยแจ้งล่วงหน้าให้ผู้ให้เช่าทราบ
				ไม่น้อยกว่า 10 วัน

			</p>

			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๔. </span>
				ผู้เช่าต้องชำระค่าไฟฟ้า ค่าน้ำประปา ตามจำนวนหน่วยที่ใช้ในแต่ละเดือนพร้อมกับการชำระค่าเช่าของเดือนถัดไป
				โดยกำหนดชำระเงินระหว่าง วันที่ 1-5 ของทุกเดือน
				หากผู้เช่าชำระเกินกำหนดผู้เช่ายินยอมจ่ายค่าปรับแก่ผู้ให้เช่าในอัตราวันละ 100 บาท ดังนั้น
				หากผู้เช่าไม่ปฏิบัติตามเงื่อนไขดังกล่าว
				ผู้เช่ายินยอมให้ผู้ให้เช่ามีสิทธิ์ระงับการจ่ายน้ำประปาและไฟฟ้ารวมถึงล็อคห้องได้ทันที
				โดยผู้เช่าจะเรียกร้องค่าเสียหายใดๆจากผู้ให้เช่าไม่ได้ทั้งสิ้น
			</p>

			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๕. </span>
				เพื่อเป็นการประกันในการที่ผู้เช่าจะปฏิบัติตามสัญญานี้
				ผู้เช่าได้วางเงินประกันไว้กับผู้ให้เช่าในวันทำสัญญานี้เป็น จำนวนเงิน 10,000 บาท (หนึ่งหมื่นบาทถ้วน)
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold"> ข้อ ๖. </span>
				ผู้ให้เช่าตกลงจะคืนเงินประกันให้แก่ผู้เช่าเมื่อครบกำหนดการเช่าตามสัญญานี้
				และการคืนเงินประกันให้แก่ผู้เช่านั้น
				ผู้ให้เช่าจะคืนให้แก่ผู้เช่าหลังจากผู้เช่าได้ขนย้ายทรัพย์สินและบริวารออกไปจากห้องที่เช่าแล้ว
				และผู้เช่ามิได้กระทำผิดสัญญาข้อหนึ่งข้อใด และไม่หนี้สินค้างชำระแก่ผู้ให้เช่า
				และไม่มีสิ่งของเครื่องใช้ใดๆภายในพื้นที่ให้เช่าชำรุดเสียหายหรือแตกหักบุบสลาย
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold"> ข้อ ๗. </span>
				กรณีผู้เช่าจะย้ายออก ผู้เช่าต้องแจ้งให้ผู้ให้เช่าทราบล่วงหน้าอย่างน้อย 30 วัน
				และต้องให้ผู้ให้เช่าตรวจสอบทรัพย์สินก่อนย้ายออกไม่น้อยกว่า 7 วัน
				หากพบความเสียหายเกิดขึ้นผู้เช่ายินดีที่จะชดใช้ค่าเสียหายตามความเป็นจริง
			</p>

			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๘. </span>
				ผู้เช่าจะต้องไม่นำสัญญาเช่านี้ไปให้ผู้อื่นเช่าช่วงต่อ หรือโอนสัญญาเช่านี้ไปให้บุคคลอื่น
				โดยไม่ได้รับอนุญาตเป็นหนังสือจากผู้ให้เช่าโดยเด็ดขาด ในกรณีการแก้ไขสัญญาหรือเปลี่ยนชื่อในสัญญามีค่าใช่จ่าย
				1000 บาทต่อครั้ง
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๙. </span>
				ผู้เช่าต้องดูแลห้องเช่าและทรัพย์สินต่างๆ ในห้องพักดังกล่าวเสมือนเป็นทรัพย์สินของตนเอง
				และต้องรักษาความสะอาดตลอดจนรักษาความสงบเรียบร้อย
				ไม่ก่อให้เกิดเสียงให้เป็นที่เดือดร้อนรำคาญแก่ผู้อยู่ห้องพักอาศัยข้างเคียง
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๑๐. </span>
				ผู้เช่าจะไม่ทำการแก้ไข เพิ่มเติม ดัดแปลงทรัพย์สินที่เช่า เว้นแต่จะได้รับอนุญาตเป็นหนังสือจากผู้ให้เช่า
				บรรดาทรัพย์สินใด ที่ผู้เช่าได้ทำการแก้ไข เพิ่มเติม ดังแปลงไปนั้น
				ผู้เช่ายินยอมให้ตกเป็นกรรมสิทธิ์ของผู้ให้เช่าในทันทีที่สัญญาฉบับนี้สิ้นสุดลง
				และผู้เช่าจะไม่เรียกร้องเอาค่าใช้จ่ายและค่าตอบแทนใดๆ ทั้งสิ้น ทั้งนี้
				หากผู้ให้เช่าไม่ต้องการทรัพย์สินดังกล่าวผู้เช่าจะดำเนินการรื้อถอน
				ซ่อมแซมต่อไปให้ทรัพย์สินที่เช่าอยู่ในสภาพเดิมโดยผู้เช่าต้องเป็นผู้เสียค่าใช้จ่ายเองทั้งสิ้น
				และ ผู้เช่าห้ามเปลี่ยนแปลงแก้ไขมิเตอร์ไฟฟ้า หรือปลั๊กไฟ รวมถึงเฟอร์นิเจอร์ทุกชนิด
				และไม่ตอกตะปูหรือเขียนฝาผนังภายในห้องพัก หากผู้เช่าฝ่าฝืนผู้ให้เช่าจะปรับเป็นเงินจำนวน 300 บาทต่อหนึ่งรายการ
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๑๑. </span>
				ผู้เช่ายินยอมให้ผู้ให้เช่าหรือตัวแทนของผู้ให้เช่าเข้าตรวจดูแลห้องเช่าได้ตลอดเวลา
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๑๒. </span>
				ผู้เช่าต้องบำรุงรักษาห้องเช่ารวมถึงอุปกรณ์ไฟฟ้า และอื่น ๆให้อยู่ในสภาพที่ดีอยู่เสมอ หากเกิดชำรุดเสียหายไม่
				ว่าด้วยเหตุใดก็ตาม ผู้เช่าต้องแจ้งผู้ให้เช่าและทำให้กับคืนสู่สภาพเดิมทันทีด้วยค่าใช้จ่ายของผู้เช่า
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๑๓. </span>
				ผู้เช่าสัญญาว่าจะไม่ครอบครองสิ่งผิดกฎหมายหรือกระทำผิดกฎหมายในบริเวณห้องเช่า ผู้เช่า
				จะต้องรับผิกชอบทุกประการ

			</p>

		</div>

		<div class="page">
			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๑๔. </span>
				ห้ามนำบุคคลภายนอกเข้ามามั่วสุม หรือนำสารเสพติดทุกชนิดและสุรา รวมทั้งอาวุธเข้าใน
				อาคารหรือบริเวณสถานที่เช่าเด็ดขาด

			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๑๕. </span>
				การขนย้ายทรัพย์สินเข้าออกจากห้องเช่าต้องกระทำในเวลากลางวัน
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๑๖. </span>
				หากเกิดอัคคีภัย ผู้เช่าไม่มีสิทธิ์เรียกร้องค่าเสียหายจากผู้ให้เช่า
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๑๗. </span>
				หากผู้เช่าประพฤติล่วงละเมิดสัญญาแม้แต่ข้อหนึ่งข้อใด หรือกระทำผิดวัตถุประสงค์ข้อหนึ่งข้อใด
				ผู้เช่ายินยอมให้ผู้เช่าทรงไว้ซึ่งสิทธิ์ที่จะเข้ายึดครอบครองห้องเช่าได้โดยพลันและมีสิทธิ์บอกเลิกสัญญาทันที
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๑๘. </span>
				ผู้เช่าตกลงจะดูแลบรรดาทรัพย์สินที่ผู้เช่าหรือบริวารของผู้เช่าที่นำเข้ามาภายในอาคาร หรือ
				ยานพาหนะของผู้เช่าหรือบริวารของผู้เช่านำมาจอดไว้ที่จอดรถเอง หากเกิดความเสียหาย สูญหาย หรือบุบสลายไปอย่างใดๆ
				ผู้เช่าจะเป็นผู้รับผิดชอบทั้งสิ้น
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๑๙. </span>
				ในวันทำสัญญานี้ผู้เช่าได้ตรวจตราทรัพย์สินที่เช่าแล้วเห็นว่ามีสภาพปกติดีทุกประการและผู้ให้เช่าได้ส่งมอบทรัพย์สินที่เช่าให้แก่ผู้เช่าแล้ว
				หากปรากฏว่าทรัพย์สินที่เช่าอย่างหนึ่งอย่างใดเกิดความเสียหายหรือแตกหักบุบสลายระหว่างการเช่า
				ผู้เช่าจะต้องรับผิดชอบชดใช้ค่าเสียหายทั้งสิ้น
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold">**** กรณีร้านค้า ****</span>
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๒๐. </span>
				ผู้ให้เช่าขอสงวนสิทธิ์ในการปรับปรุงอัตราค่าเช่าต่างๆให้เป็นไปตามความเหมาะสมของสภาวะเศรษฐกิจได้โดยจะแจ้งให้ผู้เช่าทราบล่วงหน้า
				15 วัน
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๒๑. </span>
				ผู้เช่าไม่ชำระเงินค่าเช่าตามกำหนดให้แก่ผู้ให้เช่า ผู้ให้เช่าสามารถยึดสิ่งของในห้องมาไว้เป็นประกันได้ หรือ
				สามารถยึดสิ่งของที่มูลค่าเทียบเท่ากับค่าเช่าที่ค้างอยู่พร้อมกับค่าปรับตามสัญญา
			</p>
			<p style="text-indent: 4rem;">
				<span class="text-bold">ข้อ ๒๒. </span>
				ตามประกาศคณะกรรมการว่าด้วยสัญญา เรื่อง ให้ธุรกิจให้เช่าอาคารเพื่ออยู่อาศัยเป็นธุรกิจที่ควบคุมสัญญานั้น
				ผู้เช่ายินยอมชำระค่าน้ำค่าไฟตามที่ผู้เช่ากำหนด ลงชื่อ……………..........................…………ผู้เช่า
			</p>
			<table style="width: 100%;">
				<thead>
					<tr>
						<td style="width: 30%;">
							<p class="text-bold-1 text-center">ลงชื่อ............................................ผู้เช่า</p>
							<p class="text-center">(
								<?= $LIST_DATA->USER_NAME ?> )
							</p>
						</td>
						<td style="width: 50%;">
							<p class="text-bold-1 text-center">ลงชื่อ............................................ผู้ให้เช่า
							</p>
							<p class="text-center">(..........................................................)</p>
						</td>
					</tr>
					<tr>
						<td style="width: 70%;">
							<p class="text-bold-1 text-center">ลงชื่อ............................................พยาน</p>
							<p class="text-center">(..........................................................)</p>
						</td>
						<td class="text-left">
							<p class="text-bold-1 text-center">ลงชื่อ............................................พยาน</p>
							<p class="text-center">(..........................................................)</p>
						</td>
					</tr>
					<tr>
						<td style="width: 70%;">

						</td>
						<td class="text-left">

						</td>
					</tr>
				</thead>
			</table>

		</div>

	<?php endfor; ?>
</body>
<script>
	window.print();

	(function () {

		var beforePrint = function () {

		};

		var afterPrint = function () {
			window.close();
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
