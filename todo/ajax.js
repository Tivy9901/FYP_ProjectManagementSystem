$(document).on('click','#btn-add-list',function(e) {
	var data = $("#list_form").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "save.php",
		success: function(data){
			var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("List created successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("addListModal").modal('show');
			}
		}
	});
});

$(document).on('click','#edit_todolist',function(e) {
	var id=$(this).attr("data-id");
	var title=$(this).attr("data-title");
	var desc=$(this).attr("data-desc");
	$('#id_u').val(id);
	$('#title_u').val(title);
	$('#desc_u').val(desc);
});

$(document).on('click','#update',function(e) {
	console.log("button click");
	var data = $("#update_tlform").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "save.php",
		success: function(data){
			var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("List updated successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("editListModal").modal('show');
			}
		}
	});
});


$(document).on("click", "#delete", function() { 
    var id=$(this).attr("data-id");
	$("#list_id_d").val(id);
	console.log(id);
});

$(document).on("click", "#deletelist", function() { 
	$.ajax({
		url: "save.php",
		type: "POST",
		cache: false,
		data:{
			type:3,
			id: $("#list_id_d").val()
		},
		success: function(data){
			var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("List deleted successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				location.reload();	
			}
		}
	});
});


$(document).on('click','#btn-addTaskInList',function(e) {
	var data = $("#addTaskInListForm").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "save.php",
		success: function(data){
			var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("Task created successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("addTaskInList").modal('show');
			}
		}
	});
});

$(document).on("click", "#delete_todo", function() { 
    var id=$(this).attr("data-id");
	$('#todo_id_d').val(id);
	console.log(id);
});

$(document).on("click", "#deleteTask", function() { 
    $.ajax({
        url: "save.php",
        type: "POST",
        cache: false,
        data:{
            type:101,
            id: $("#todo_id_d").val()
        },
        success: function(data){
			var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("Task deleted successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				location.reload();	
			}
        }
    });
});