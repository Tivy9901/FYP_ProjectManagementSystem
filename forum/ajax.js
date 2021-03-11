$(document).on('click','#btn-makePost',function(e) {
    var data = $("#makePostForm").serialize();
	$.ajax({
		data: data,
		type: "post",
        url: "save.php",
		success: function(data){
			var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("Post created successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("addPostModal").modal('show');
			}
		}
	});
});

$(document).on("click", "#deletePostbtn", function() { 
    var id=$(this).attr("data-id");
    $('#postId').val(id);
});

$(document).on("click", "#btn-deletePost", function() { 
    $.ajax({
        url: "save.php",
        type: "POST",
        cache: false,
        data:{
            type:1,
            id: $("#postId").val()
        },
        success: function(dataResult){
                $('#deletePostModal').modal('hide');
                $("#"+dataResult).remove();
                location.reload();
        }
    });
});
    
$(document).on('click','#updatePostbtn',function(e) {
    var id=$(this).attr("data-id");
    var title=$(this).attr("data-title");
    var des=$(this).attr("data-des");
    var date=$(this).attr("data-date");
    $('#post_id').val(id);
    $('#post_title').val(title);
    $('#post_description').val(des);
    $('#post_date').val(date);
});

$(document).on('click','#btn-updatePost',function(e) {
    var data = $("#updatePostForm").serialize();
    $.ajax({
        data: data,
        type: "POST",
        url: "save.php",
        success: function(data){
            var data = JSON.parse(data);
			if (data.statusCode == 200){
				alert("Post updated successfully!");
				location.reload();	
			} else {
				console.log(data.statusCode);
				$(".display-error").html("<ul>"+data.msg+"</ul>");
				alert(data.msg);
				$("updatePostModal").modal('show');
			}
        }
    });
});

$(document).on("click", "#deleteCommentbtn", function() { 
    var id=$(this).attr("data-id");
    $('#comment_id').val(id);
    console.log(id);
});

$(document).on("click", "#btn-deleteComment", function() { 
    $.ajax({
        url: "save.php",
        type: "POST",
        cache: false,
        data:{
            type:3,
            id: $("#comment_id").val()
        },
        success: function(dataResult){
                $('#deleteCommentModal').modal('hide');
                $("#"+dataResult).remove();
                location.reload();
        }
    });
});
    
    $(document).on('click','#updateCommentbtn',function(e) {
        var id=$(this).attr("data-id");
        var des=$(this).attr("data-des");
        $('#commentId').val(id);
        $('#commentDes').val(des);
    });
    
    $(document).on('click','#btn-updateComment',function(e) {
        var data = $("#updateCommentForm").serialize();
        $.ajax({
            data: data,
            type: "POST",
            url: "save.php",
            success: function(dataResult){
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        $('#updateCommentForm').modal('hide');
                        alert('Comment updated successfully !'); 
                        location.reload();						
                    }
                    else if(dataResult.statusCode==201){
                       alert(dataResult);
                    }
            }
        });
    });

    $(document).on('click','#btn-comment',function(e) {
        var data = $("#commentForm").serialize();
        console.log(data);
        $.ajax({
            data: data,
            type: "post",
            url: "save.php",
            success: function(data){
                var data = JSON.parse(data);
                if (data.statusCode == 200){
                    alert("Comment created successfully!");
                    location.reload();	
                } else {
                    console.log(data.statusCode);
                    $(".display-error").html("<ul>"+data.msg+"</ul>");
                    alert(data.msg);
                }
            }
        });
    });

    
    