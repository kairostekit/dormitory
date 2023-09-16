let base_url = document.getElementById('base_url').content;

function checkTypeRoom(value) {

	$.ajax({
		type: "POST",
		url: base_url + "home/room_type_getData/" +value,
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
			$("input[name='RT_DETAILS']").val(response.RT_DETAILS);
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
			console.log(response);

			$("input[name='RT_WATER']").val(response.RT_WATER);
			$("input[name='RT_ELECTRICCTY']").val(response.RT_ELECTRICCTY);
			$("input[name='RT_ROOMSIZE']").val(response.RT_ROOMSIZE);
			$("input[name='RT_ROOMRENT']").val(response.RT_ROOMRENT);
			$("input[name='RT_RESERVE']").val(response.RT_RESERVE);
			$("input[name='RT_MOVEIN']").val(response.RT_MOVEIN);
			$("input[name='RT_DEPOSIT']").val(response.RT_DEPOSIT);
			$("input[name='RT_DETAILS']").val(response.RT_DETAILS);
			$("input[name='RT_NAME']").val(response.RT_NAME);
			$("input[name='RT_CONDITIONS']").val(response.RT_CONDITIONS);


			$("input[name='MCO_DEPOSIT']").val(response.RT_DEPOSIT);
			$("input[name='MCO_RESERVE']").val(response.RT_RESERVE);
			$("input[name='MCO_MOVEIN']").val(response.RT_MOVEIN);
			$("input[name='MCO_ROOM_TYPE_NAME']").val(response.RT_NAME);
			$("input[name='MCO_RM_NAME']").val(response.RM_NAME);
			$("input[name='MCO_RM_NUMBER']").val(response.RM_NUMBER);

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
			console.log(response);
			$("input[name='MCO_USER_NAME']").val(response.USER_NAME);
			$("input[name='USER_NAME']").val(response.USER_NAME);

			$("input[name='MCO_USER_PHONE']").val(response.USER_PHONE);
			$("input[name='USER_PHONE']").val(response.USER_PHONE);
		}
	});

	// console.log(element);
}




