// adduser
$(document).on('click','#btn-add-user',function(e) {
    var data = $("#addUserForm").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(data){
            var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("User created successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("#addUserModal").modal('show');
			}
        }
    });
});
//update user
$(document).on('click','#updateUser',function(e) {
    var id=$(this).attr("data-id");
    var name=$(this).attr("data-name");
    var username=$(this).attr("data-username");
    var email=$(this).attr("data-email");
    console.log(email);
    var phoneNumber=$(this).attr("data-phoneNumber");
    var password=$(this).attr("data-password");
    var usertype=$(this).attr("data-type");
    $('#u_id').val(id);
    $('#u_name').val(name);
    $('#u_username').val(username);
    $('#u_email').val(email);
    $('#u_phoneNumber').val(phoneNumber);
    $('#u_password').val(password);
    $('#user_type').val(usertype);
}); 
$(document).on('click','#btn-update',function(e) {
    var data = $("#updateUserForm").serialize();
    // console.log(data);
    $.ajax({
        data: data,
        type: "POST",
        url: "save.php",
        success: function(data){
            var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("User updated successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("#updateUserModal").modal('show');
			}
        }
    });
});    
//disable user
$(document).on('click','#disable',function(e) {
    var id=$(this).attr("data-id");
    console.log(id);
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
//undisable user
$(document).on('click','#enable',function(e) {
	var id=$(this).attr("data-id");
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

// project
 
//disable project
$(document).on('click','#disableProject',function(e) {
    var id=$(this).attr("data-id");
    console.log(id);
	$.ajax({
		url: "save.php",
		type: "POST",
		cache: false,
		data:{
			type:97,
			id: id
		},
		success: function(dataResult){
            console.log(dataResult);
			location.reload();
		}
	});
});
//undisable user
$(document).on('click','#enableProject',function(e) {
    var id=$(this).attr("data-id");
    console.log(id);
	$.ajax({
		url: "save.php",
		type: "POST",
		cache: false,
		data:{
			type:96,
			id: id
		},
		success: function(dataResult){
            console.log(dataResult);
			location.reload();
		}
	});
});     

// add project
$(document).on('click','#btn-add-project',function(e) {
    var data = $("#project_form").serialize();
    $.ajax({
        type: "post",
        url: "save.php",
        data:data,
        success: function(data){
            var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("Project created successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("#addProjectModal").modal('show');
			} 
        }
    });
});    
//update project            
$(document).on('click','#updateProjectbtn',function(e) {
    var id=$(this).attr("data-id");
    var tid=$(this).attr("data-tid");
    var name=$(this).attr("data-name");
    var desc=$(this).attr("data-desc");
    var uid=$(this).attr("data-uid");
    $('#project_id_u').val(id);
    $('#team_id_u').val(tid);
    $('#title_u').val(name);
    $('#desc_u').val(desc);
    $('#user_id_u').val(uid);
});   
$(document).on('click','#updateProject',function(e) {
    var data = $("#update_pform").serialize();
    console.log(data);
    $.ajax({
        data: data,
        type: "POST",
        url: "save.php",
        success: function(data){
            var data = JSON.parse(data);
            if (data.statusCode == 200){
                console.log(data.statusCode);
                alert("Project updated successfully!");
                location.reload();	
            } else {
                console.log(data.statusCode);
                $(".display-error").html("<ul>"+data.msg+"</ul>");
                alert(data.msg);
                $("#editProjectModal").modal('show');
            } 
        }
    });
});           

// team
//add team
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
				$("#addTeamModal").modal('show');
			}
        }
    });
});   
//add notice
$(document).on('click','#btn-notice',function(e) {
    var data = $("#notice_form").serialize();
    console.log(data);
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(data){
            var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("Notice send successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("#noticeModal").modal('show');
			}
        }
    });
});   
//delete team 
$(document).on("click", "#deleteTeam", function() { 
    var id=$(this).attr("data-id");
    $('#team_id_d').val(id);
});
$(document).on("click", "#btn-deleteteam", function() { 
    $.ajax({
        url: "save.php",
        type: "POST",
        cache: false,
        data:{
            type:1,
            id: $("#team_id_d").val()
        },
        success: function(dataResult){
            $('#deleteTeamModal').modal('hide');
            window.location.href = "team.php";
        }
    });
})
//update team   
$(document).on('click','#updateTeam',function(e) {
    var id=$(this).attr("data-id");
    var name=$(this).attr("data-name");
    var dec=$(this).attr("data-dec");
    $('#id_u').val(id);
    $('#title_u').val(name);
    $('#desc_u').val(dec);
});    
$(document).on('click','#btn-updateteam',function(e) {
    var data = $("#update_tform").serialize();
    $.ajax({
        data: data,
        type: "POST",
        url: "save.php",
        success: function(data){
            var data = JSON.parse(data);
            console.log(data);
			if (data.statusCode == 200){
				alert("Team updated successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("#editTeamModal").modal('show');
			}
        }
    });
});    

//team creator
$(document).on("click", "#editCreator", function() { 
    $.ajax({
        url: "save.php",
        type: "POST",
        cache: false,
        data:{
            type:5,
            team_id:$("#team_id_e").val(),
            user_id: $("#user_id_e").val()
        },
        success: function(data){
            var data = JSON.parse(data);
            console.log(data);
			if (data.statusCode == 200){
				alert("Team updated successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("#editCreatorModal").modal('show');
			}					
        }
    });
});   
//team add user
$(document).on('click','#btn-add-user-team',function(e) {
    var data = $("#add_user_team_form").serialize();
    console.log(data);
    $.ajax({
        data: data,
        type: "post",
        url: "save.php",
        success: function(data){
            var data = JSON.parse(data);
            console.log(data);
			if (data.statusCode == 200){
				alert("User added successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("#addTeamUserModal").modal('show');
			}					
        }
    });
});    
//team remove user
$(document).on("click", "#removeuser", function() { 
    $.ajax({
        url: "save.php",
        type: "POST",
        cache: false,
        data:{
            type:7,
            team_id: $("#team_id_remove").val(),
            user_id: $("#user_id_remove").val()
        },
        success: function(dataResult){
            $('#removeUserModal').modal('hide');
            location.reload();
        }
    });
});    
    