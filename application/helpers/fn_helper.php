<?php

define('APP_NAME', "ระบบจัดการหอพักรายเดือน");


define('DORMITORY_NAME', "หอพักแมเนอร์", false);
define('DORMITORY_ADDESS', "107 หมู่ 12 ตำบลกำแพงแสน อำเภอกำแพงแสน จังหวัดนครปฐม 73140");




function DateThai($strDate)
{
	$strYear = date("Y", strtotime($strDate)) + 543;
	$strMonth = date("n", strtotime($strDate));
	$strDay = date("j", strtotime($strDate));
	$strHour = date("H", strtotime($strDate));
	$strMinute = date("i", strtotime($strDate));
	$strSeconds = date("s", strtotime($strDate));
	$strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
	$strMonthThai = $strMonthCut[$strMonth];
	return "$strDay $strMonthThai $strYear";
}

function DateThaiFull($strDate)
{
	$strYear = date("Y", strtotime($strDate)) + 543;
	$strMonth = date("n", strtotime($strDate));
	$strDay = date("j", strtotime($strDate));
	$strHour = date("H", strtotime($strDate));
	$strMinute = date("i", strtotime($strDate));
	$strSeconds = date("s", strtotime($strDate));
	$strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
	$strMonthThai = $strMonthCut[$strMonth];
	return "วันที่ {$strDay} เดือน {$strMonthThai} พ.ศ. {$strYear} ";
}



function ConvertNume($amount_number)
{
	$amount_number = number_format($amount_number, 2, ".", "");
	$pt = strpos($amount_number, ".");
	$number = $fraction = "";
	if ($pt === false)
		$number = $amount_number;
	else {
		$number = substr($amount_number, 0, $pt);
		$fraction = substr($amount_number, $pt + 1);
	}

	$ret = "";
	$baht = ReadNumber($number);
	if ($baht != "")
		$ret .= $baht . "บาท";

	$satang = ReadNumber($fraction);
	if ($satang != "")
		$ret .=  $satang . "สตางค์";
	else
		$ret .= "ถ้วน";
	return $ret;
}

function ReadNumber($number)
{
	$position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
	$number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
	$number = $number + 0;
	$ret = "";
	if ($number == 0) return $ret;
	if ($number > 1000000) {
		$ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
		$number = intval(fmod($number, 1000000));
	}

	$divider = 100000;
	$pos = 0;
	while ($number > 0) {
		$d = intval($number / $divider);
		$ret .= (($divider == 10) && ($d == 2)) ? "ยี่" : ((($divider == 10) && ($d == 1)) ? "" : ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
		$ret .= ($d ? $position_call[$pos] : "");
		$number = $number % $divider;
		$divider = $divider / 10;
		$pos++;
	}
	return $ret;
}



function ip_is_private($ip)
{
	$pri_addrs = array(
		'10.0.0.0|10.255.255.255', // single class A network
		'172.16.0.0|172.31.255.255', // 16 contiguous class B network
		'192.168.0.0|192.168.255.255', // 256 contiguous class C network
		'169.254.0.0|169.254.255.255', // Link-local address also refered to as Automatic Private IP Addressing
		'127.0.0.0|127.255.255.255' // localhost
	);

	$long_ip = ip2long($ip);
	if ($long_ip != -1) {
		foreach ($pri_addrs as $pri_addr) {
			list($start, $end) = explode('|', $pri_addr);

			// IF IS PRIVATE
			if ($long_ip >= ip2long($start) && $long_ip <= ip2long($end)) {
				return true;
			}
		}
	}
	return false;
}
