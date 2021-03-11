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
			alert('Data added successfully !');
			for (var pair of data.entries()) {
				console.log(pair[0]+ ', ' + pair[1]); 
			} 
			location.reload();	
		}
	});
});
$(document).on('click','#btn-profile',function(e) {
	var data = $("#userProfileForm").serialize();
	$.ajax({
		data: data,
		type: "post",
		url: "save.php",
		success: function(data){
			var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("Profile updated successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
			}
		}
	});
});