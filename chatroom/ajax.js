$(document).on('click', '#addchatroom', function(){
    var chatname=$('#chat_name').val();
    var chatpass=$('#chat_password').val();
    var team_id=$('#team_id').val();
        $.ajax({
            url:"save.php",
            method:"POST",
            data:{
                type:1,
                chatname: chatname,
                chatpass: chatpass,
                team_id:team_id,
            },
            success:function(data){
                var data = JSON.parse(data);
                if (data.statusCode == 200){
                    alert("room created successfully!");
                    location.reload();	
                } else {
                    console.log(data.statusCode);
                    alert(data.msg);
                }
            }
        });
    
});

$(document).on('click', '.join_chat', function(){
    var cid=$(this).val();
    if ($('#status'+cid).val()==1){
        window.location.href='chatroom.php?id='+cid;
    }
    else if ($('#status'+cid).val()==2){
        $('#join_chat').modal('show');
        $('.modal-body #chatid').val(cid);
    }
    else{
        $.ajax({
            url:"addmember.php",
            method:"POST",
            data:{
                id: cid,
            },
            success:function(){
            window.location.href='chatroom.php?id='+cid;
            }
        });
    }
});

$(document).on('click', '#confirm_leave', function(){
    var id  =$('#chatroom_id').val();
        $.ajax({
            url:"save.php",
            method:"POST",
            data:{
                type:3,
                chatroom_id:id,
            },
            success:function(data){
                var data = JSON.parse(data);
                if (data.statusCode == 200){
                    window.location.href='index.php';
                } else {
                    console.log(data.statusCode);
                    alert(data.msg);
                }
            }
        });
    
});

$(document).on('click', '#confirm_delete', function(){
    var id  =$('#chatroom_id').val();
        $.ajax({
            url:"save.php",
            method:"POST",
            data:{
                type:4,
                chatroom_id:id,
            },
            success:function(data){
                var data = JSON.parse(data);
                if (data.statusCode == 200){
                    window.location.href='index.php';
                } else {
                    console.log(data.statusCode);
                    alert(data.msg);
                }
            }
        });
    
});

$(document).on('click', '#send_msg', function(){
    var id  =$('#chatroom_id').val();
    var msg =$('#chat_msg').val();
    var uid =$('#user_id').val();
    $.ajax({
        url:"save.php",
        method:"POST",
        data:{
            type:2,
            msg: msg,
            user_id: uid,
            chatroom_id:id,
        },
        success:function(data){
            var data = JSON.parse(data);
            if (data.statusCode == 200){
                document.getElementById('chat_msg').value = '';
            } else {
                console.log(data.statusCode);
                alert(data.msg);
            }
        }
    });	
});

$(document).on('click', '#add_new_member', function(){
    var uid  =$('#user_id_add').val();
    $.ajax({
        url:"save.php",
        method:"POST",
        data:{
            type:5,
            user_id: uid,
        },
        success:function(data){
            var data = JSON.parse(data);
            if (data.statusCode == 200){
                alert("User added successfully!");
                location.reload();
            } else {
                console.log(data.statusCode);
                alert(data.msg);
            }
        }
    });	
});

$(document).on("click", "#delete_user", function() { 
	var id=$(this).attr("data-uid");
	$('#user_id_d').val(id);
});

$(document).on('click', '#deleteUser', function(){
        $.ajax({
            url:"save.php",
            method:"POST",
            data:{
                type:6,
                id: $("#user_id_d").val()
            },
            success:function(data){
                var data = JSON.parse(data);
                if (data.statusCode == 200){
                    alert("User has been kick!");
                    location.reload();
                } else {
                    console.log(data.statusCode);
                    alert(data.msg);
                }
            }
        });
    
});

window.onload=function () {
    var objDiv = document.getElementById("chat_area");
    $("#chat_area").animate({ scrollTop: $('#chat_area').prop("scrollHeight")}, 1000);

}

$(document).ready(function(){
    setInterval(function(){
        $("#chat_area").load("fetch_chat.php");
        // refresh();
    },1000);
});

$("#user_details").hover(function(){
    $('.showme').removeClass('d-none');
    console.log("hover");
},function(){
    $('.showme').addClass('d-inline');
    console.log("hover out");
});

$('#user_details').hover(function() {
    console.log("hover");
});

$(document).on('click','#updateRoom',function(e) {
    var id=$(this).attr("data-id");
    var name=$(this).attr("data-name");
    var password=$(this).attr("data-password");
    $('#room_id').val(id);
    $('#room_name').val(name);
    $('#room_password').val(password);
    console.log(id);
    console.log(name);
    console.log(password);

});

$(document).on('click','#btn-updateChatRoom',function(e) {
    var data = $("#roomdetailupdate").serialize();
    console.log(data);
    $.ajax({
        data: data,
        type: "POST",
        url: "save.php",
        success: function(data){
            var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("Chat Room Details updated successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("#update_room").modal('show');
			}
        }
    });
});