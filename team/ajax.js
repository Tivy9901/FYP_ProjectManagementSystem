// team.php
$(document).on('click','#btn-add-team',function(e) {
	var data = $("#team_form").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "save.php",
		success: function(data){
			var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("Team created successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("addTeamModal").modal('show');
			}
		}
	});
});

$(document).on('click','#btn-add-user-team',function(e) {
	var data = $("#add_user_team_form").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "save.php",
		success: function(data){
			var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("User added successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("addUserModal").modal('show');
			}
		}
	});
});
$(document).on('click','#update_team',function(e) {
	var id=$(this).attr("data-id");
	var title=$(this).attr("data-title");
	var desc=$(this).attr("data-desc");
	$('#id_u').val(id);
	$('#title_u').val(title);
	$('#desc_u').val(desc);
});
$(document).on('click','#btn-update-team',function(e) {
	console.log("button click");
	var data = $("#update_tform").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "save.php",
		success: function(data){
			var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("Team details update successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("editTeamModal").modal('show');
			}
		}
	});
});

$(document).on('click','#delete_team',function(e) {
	var id=$(this).attr("data-id");
	$('#team_id_d').val(id);
});
$(document).on("click", "#btn-delete-team", function() { 
	$.ajax({
		url: "save.php",
		type: "POST",
		cache: false,
		data:{
			type:3,
			id: $("#team_id_d").val()
		},
		success: function(dataResult){
				$('#deleteProjectModal').modal('hide');
				window.location.href = "index.php";
		}
	});
});

$(document).on("click", "#leaveteam", function() { 
	$.ajax({
		url: "save.php",
		type: "POST",
		cache: false,
		data:{
			type:99,
			team_id: $("#team_id_leave").val(),
			user_id: $("#user_id_leave").val()
		},
		success: function(dataResult){
				$('#deleteProjectModal').modal('hide');
				window.location.href = "index.php";
		}
	});
});

$(document).on("click", "#removeuser", function() { 
	$.ajax({
		url: "save.php",
		type: "POST",
		cache: false,
		data:{
			type:77,
			team_id: $("#team_id_remove").val(),
			user_id: $("#user_id_remove").val()
		},
		success: function(dataResult){
				$('#removeUserModal').modal('hide');
				location.reload();
		}
	});
});
