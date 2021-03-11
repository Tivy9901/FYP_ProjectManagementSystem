$(document).on('click','#btn-add-project',function(e) {
	var data = $("#project_form").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "save.php",
		success: function(data){
			var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("Project created successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("project_form").modal('show');
			}
		}
	});
});
$(document).on("click", "#update_project", function() {
	var id=$(this).attr("data-id");
	var title=$(this).attr("data-title");
	var desc=$(this).attr("data-desc");
	$('#id_u').val(id);
	$('#title_u').val(title);
	$('#desc_u').val(desc);
});

$(document).on('click','#btn-update-project',function(e) {
	console.log("button click");
	var data = $("#update_pform").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "save.php",
		success: function(data){
			var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("Project updated successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("project_form").modal('show');
			}
		}
	});
});