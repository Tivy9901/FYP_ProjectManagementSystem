$(document).on('click','#updateTaskbtn',function(e) {
    var id=$(this).attr("data-id");
    var name=$(this).attr("data-name");
    var desc=$(this).attr("data-desc");
    var priority=$(this).attr("data-priority");
    var deadline=$(this).attr("data-deadline");
    $('#taskID').val(id);
    $('#taskNAME').val(name);
    $('#taskDES').val(desc);
    $('#taskpriority').val(priority);
	$('#taskdeadline').val(deadline);
	console.log(id);
});

$(document).on('click','#btn-updateTask',function(e) {
	var data = $("#updateTaskForm").serialize();
	console.log(data),
    $.ajax({
        data: data,
        type: "POST",
		url: "save.php",
        success: function(data){
            var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("Task updated successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("updateTask").modal('show');
			}
        }
    });
});

$(document).on('click','#mark_done',function(e) {
	var id=$(this).attr("data-tid");
	$.ajax({
		url: "save.php",
		type: "POST",
		cache: false,
		data:{
			type:99,
			id: id
		},
		success: function(dataResult){
			location.reload();
		}
	});
});

$(document).on('click','#mark_undone',function(e) {
	var id=$(this).attr("data-tid");
	$.ajax({
		url: "save.php",
		type: "POST",
		cache: false,
		data:{
			type:98,
			id: id
		},
		success: function(dataResult){
			location.reload();
		}
	});
});

$(document).on('click','#ResignUser',function(e) {
	var id=$(this).attr("data-uid");
    $('#u_id_d').val(id);
    $('#assignUserModal').modal('hide');
});

$(document).on("click", "#UnassginUser", function() { 
	$.ajax({
		url: "save.php",
		type: "POST",
		cache: false,
		data:{
			type:103,
            uid: $("#u_id_d").val(),
            tid: $("#t_id").val()
		},
		success: function(dataResult){
            location.reload();
		}
	});
});

$(document).on('click','#btn-asign-user',function() {
	var data = $("#assignUser_form").serialize();
	console.log(data);
	$.ajax({
		data:data,
		type: "post",
		url: "save.php",
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			if(dataResult.statusCode==200){
				alert('User Assigned successfully !'); 
				location.reload();						
			}else{
			   alert(dataResult.msg);
			}	
		},
	});
});

