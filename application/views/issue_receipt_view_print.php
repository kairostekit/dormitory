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

	<div class="page">
		
	</div>


</body>
<script>
	// window.print();

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
