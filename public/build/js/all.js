let base_url = document.getElementById('base_url').content;

function checkTypeRoom(value) {

	$.ajax({
		type: "POST",
		url: base_url + "home/room_type_getData/" + value,
		data: {
			"RT_ID": value
		},
		dataType: "json",
		success: function (response) {


			$("input[name='RT_WATER']").val(response.RT_WATER);
			$("input[name='RT_ELECTRICCTY']").val(response.RT_ELECTRICCTY);
			$("input[name='RT_ROOMSIZE']").val(response.RT_ROOMSIZE);
			$("input[name='RT_ROOMRENT']").val(response.RT_ROOMRENT);
			$("input[name='RT_RESERVE']").val(response.RT_RESERVE);
			$("input[name='RT_MOVEIN']").val(response.RT_MOVEIN);
			$("input[name='RT_DEPOSIT']").val(response.RT_DEPOSIT);
			$("textarea[name='RT_DETAILS']").val(response.RT_DETAILS);
			$("input[name='RM_DETAILS']").val(response.RT_DETAILS);


		}
	});

	// console.log(element);
}



function checkRoom(value) {

	$.ajax({
		type: "POST",
		url: base_url + "home/room_getData/" + value,
		data: {
			"RM_ID": value
		},
		dataType: "json",
		success: function (response) {


			$("input[name='RT_WATER']").val(response.RT_WATER);
			$("input[name='RT_ELECTRICCTY']").val(response.RT_ELECTRICCTY);
			$("input[name='RT_ROOMSIZE']").val(response.RT_ROOMSIZE);
			$("input[name='RT_ROOMRENT']").val(response.RT_ROOMRENT);
			$("input[name='RT_RESERVE']").val(response.RT_RESERVE);
			$("input[name='RT_MOVEIN']").val(response.RT_MOVEIN);
			$("input[name='RT_DEPOSIT']").val(response.RT_DEPOSIT);
			$("textarea[name='RT_DETAILS']").val(response.RT_DETAILS);
			$("input[name='RT_NAME']").val(response.RT_NAME);
			$("input[name='RT_CONDITIONS']").val(response.RT_CONDITIONS);


			$("input[name='MCO_DEPOSIT']").val(response.RT_DEPOSIT);
			$("input[name='MCO_RESERVE']").val(response.RT_RESERVE);
			$("input[name='MCO_MOVEIN']").val(response.RT_MOVEIN);
			$("input[name='MCO_ROOM_TYPE_NAME']").val(response.RT_NAME);
			$("input[name='MCO_RM_NAME']").val(response.RM_NAME);
			$("input[name='MCO_RM_NUMBER']").val(response.RM_NUMBER);
			$("input[name='MCO_ROOMRENT']").val(response.RT_ROOMRENT);


			// $("input[name='RM_MCO_ID']").val(response.RM_MCO_ID);


			$("textarea[name='RM_DETAILS']").val(response.RM_DETAILS);
			$("textarea[name='RT_CONDITIONS']").val(response.RT_CONDITIONS);


		}
	});

	// console.log(element);
}

function getUSER(value) {

	$.ajax({
		type: "POST",
		url: base_url + "home/user_info_getData/" + value,
		data: {
			"USER_ID": value
		},
		dataType: "json",
		success: function (response) {

			$("input[name='MCO_USER_NAME']").val(response.USER_NAME);
			$("input[name='USER_NAME']").val(response.USER_NAME);

			$("input[name='MCO_USER_PHONE']").val(response.USER_PHONE);
			$("input[name='USER_PHONE']").val(response.USER_PHONE);
		}
	});

	// console.log(element);
}


function getIssue_receiptDataRoomFull(value) {

	$.ajax({
		type: "POST",
		url: base_url + "home/issue_receipt_getDataRom/" + value,
		data: {
			"RM_ID": value
		},
		dataType: "json",
		success: function (response) {
			let resp = response.DATA;

			response.MONTH_CHECK.forEach(option => {
				document.querySelectorAll("#IRC_MONTH_ID option").forEach(opt => {
					if (opt.value == option) {
						opt.disabled = true;
					}
				});
			})

			// console.log();

			$("input[name='USER_ID']").val(resp.USER_ID);
			$("input[name='IRC_ROOMRENT']").val(resp.RT_ROOMRENT);

			$("#user_name").html(resp.USER_NAME);
			$("#user_idcard").html(resp.USER_CITIZEN);
			$("#user_phone").html(resp.USER_PHONE);

			$("#RT_WATER").val(resp.RT_WATER);
			$("#RT_ELECTRICCTY").val(resp.RT_ELECTRICCTY);



		}
	});

	// console.log(element);
}


function sumValue() {

	$("#IRD_UNITSUSED-WATER").val(parseInt($("#IRD_THISNUM-WATER").val()) - parseInt($("#IRD_PERVIOUS-WATER").val()));

	let sumWater = parseInt($("#IRD_UNITSUSED-WATER").val()) * parseInt($("#RT_WATER").val());
	$("#IRD_UNITSUM-WATER").val(sumWater <= 100 ? 100 : sumWater)


	$("#IRD_UNITSUSED-ELE").val(parseInt($("#IRD_THISNUM-ELE").val()) - parseInt($("#IRD_PERVIOUS-ELE").val()));
	$("#IRD_UNITSUM-ELE").val(parseInt($("#IRD_UNITSUSED-ELE").val()) * parseInt($("#RT_ELECTRICCTY").val()))
}

function addListOT() {
	$('#TABELLISTNAME').append(`
	<tr>
		<th>#</th>
		<td>
			<input value="ค่าอื่น ๆ" class="form-control" type="text" name="IRD_LISTNAME[]" data-validate-minmax="1,99999999" >
		</td>
		<td>
			<input class="form-control" type="number" name="IRD_PERVIOUS[]" data-validate-minmax="1,99999999" data-validate-linked="number" >
		</td>
		<td>
			<input class="form-control" type="number" name="IRD_THISNUM[]" data-validate-minmax="1,99999999" data-validate-linked="number" >
		</td>
		<td>
			<input class="form-control" type="number" name="IRD_UNITSUSED[]" data-validate-minmax="1,99999999" data-validate-linked="number" >
		</td>
		<td>
			<input class="form-control" type="number" name="IRD_PERUNITS[]" data-validate-minmax="1,99999999" data-validate-linked="number" >
		</td>
		<td>
			<input class="form-control" type="number" name="IRD_UNITSUM[]" data-validate-minmax="1,99999999" data-validate-linked="number" >
		</td>
	</tr>
	`);
}




function htmlTableToExcel(tableID, type) {
	var data = document.getElementById(tableID);
	var excelFile = XLSX.utils.table_to_book(data, { sheet: "sheet1" });
	XLSX.write(excelFile, { bookType: type, bookSST: true, type: 'base64' });
	XLSX.writeFile(excelFile, 'ExportedFile:HTMLTableToExcel' + type);
}



function ExportToExcel(tableID,type, fn, dl) {
	var elt = document.getElementById(tableID);
	var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
	return dl ?
		XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
		XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
}
