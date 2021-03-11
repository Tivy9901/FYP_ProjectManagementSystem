//-------------------------------Folder-------------------------------
$(document).on('click','#btn-add-folder',function(e) {
	var data = $("#folder_form").serialize();
	console.log(data);
	$.ajax({
		data: data,
        type: "post",
        cache: false, 
		url: "save.php",
		success: function(data){
			var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("Folder created successfully!");
				console.log(data.statusCode);
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("addFolderModal").modal('show');
			}
		}
	});
});

$(document).on("click", "#delete_folder", function() { 
	var id=$(this).attr("data-id");
	$('#folder_id_d').val(id);
	
});

$(document).on("click", "#deletefolder", function() { 
	$.ajax({
		url: "save.php",
		type: "POST",
		cache: false,
		data:{
			type:3,
			id: $("#folder_id_d").val()
		},
		success: function(dataResult){
				$('#deleteFolderModal').modal('hide');
				$("#"+dataResult).remove();
				location.reload();
		}
	});
});

$(document).on('click','#update_folder',function(e) {
	var id=$(this).attr("data-id");
	var name=$(this).attr("data-name");
	$('#id_u').val(id);
	$('#name_u').val(name);
});

$(document).on('click','#update',function(e) {
	var data = $("#update_form").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "save.php",
		success: function(data){
			var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("Folder Updated successfully!");
				console.log(data.statusCode);
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("editEmployeeModal").modal('show');
			}
		}
	});
});

$(document).on('click','#btn-add-file',function(e) {
	var form = $("#file_form")[0];
	var data = new FormData(form);
	$.ajax({
		data: data,
        type: "post",
        contentType: false,
        cache: false,
   		processData:false, 
		url: "upload.php",
		success: function(dataResult){
			$('#addFileModal').modal('hide');
			alert('File uploaded successfully !');
			for (var pair of data.entries()) {
				console.log(pair[0]+ ', ' + pair[1]); 
			} 
			location.reload();	
		}
	});
});

$(document).on("click", "#delete_file", function() { 
	var id=$(this).attr("data-fid");
	var path=$(this).attr("data-fpath");
	$('#file_id_d').val(id);
	$('#file_path_d').val(path);
	
});

$(document).on("click", "#deletefile", function() { 
	$.ajax({
		url: "save.php",
		type: "POST",
		cache: false,
		data:{
			type:9,
			id: $("#file_id_d").val(),
			path:$("#file_path_d").val()
		},
		success: function(dataResult){
				$('#deleteFileModal').modal('hide');
				$("#"+dataResult).remove();
				location.reload();
		}
	});
});

